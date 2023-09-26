@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Price Table</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{ route('price-table-store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <label class="form-label">Category <span
                                                        class="text text-danger">*</span></label>
                                                <select name="category_id" id="category_id"
                                                    class="form-control {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                                    <option disabled selected>--Select Category--</option>
                                                    @foreach ($category as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == $category_id ? 'selected' : '' }}>
                                                            {{ $item->name ?? '' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <label class="form-label">City <span
                                                        class="text text-danger">*</span></label>
                                                <select name="city_id" id="city_id"
                                                    class="form-control {{ $errors->has('city_id') ? 'has-error' : '' }}">
                                                    <option disabled selected>--Select City--</option>
                                                    @foreach ($city as $item)
                                                        <option value="{{ $item->id }}" {{ $item->id == $city_id ? 'selected' : '' }}>{{ $item->name ?? '' }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">{{ $errors->first('city_id') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @if (isset($products))
                                        @foreach ($products as $item)
                                            <div class="col-md-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="hidden" value="{{ $item['id'] ?? 0 }}"
                                                            class="form-control" name="product_id[]">
                                                        <input type="text" value="{{ $item['name'] ?? '' }}" disabled
                                                            class="form-control">
                                                        <label class="form-label">Product <span
                                                                class="text text-danger">*</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="number" min="0" value="{{$item['price']??old('price')}}" name="price[]"
                                                            class="form-control">
                                                        <label class="form-label">Min Price <span
                                                                class="text text-danger">*</span></label>
                                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="number" min="0" value="{{$item['max_price']??old('max_price')}}" name="max_price[]"
                                                            class="form-control">
                                                        <label class="form-label">Max Price <span
                                                                class="text text-danger">*</span></label>
                                                        <span class="text-danger">{{ $errors->first('max_price') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="col-md-12">
                                        <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Validation -->
        </div>
    </section>
@endsection
@section('after-script')
    <script>
        $("#category_id,#city_id").on('change', function() {
            var category_id = $("#category_id").val();
            var city_id = $("#city_id").val();
            window.location.href = '?category_id=' + category_id+'&city_id='+city_id;
        });
    </script>
@endsection
