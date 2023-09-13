@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Update Price Product</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('price-product-update',$product->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{$product->name??old('name')}}" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}" name="name" required>
                                        <label class="form-label">Name <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Category <span class="text text-danger">*</span></label>
                                        <select name="category_id" id="category_id" class="form-control {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                            @foreach ($category as $item)
                                                <option value="{{$item->id}}" {{($item->id==$product->category_id)?'selected':''}}>{{$item->name??''}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                    </div>
                                </div>

                                <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Validation -->
        </div>
    </section>

@endsection
