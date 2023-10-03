@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        @if(Session('error'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                <strong>Note:</strong>&nbsp; {{ Session('error') }} </div>

                        @endif
                        <div class="header">
                            <h2>Delete Price Table</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST"
                                action="{{ route('confirm-price-table-delete') }}" enctype="multipart/form-data">
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
                                                        <option value="{{ $item->id }}">
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
                                                        <option value="{{ $item->id }}">{{ $item->name ?? '' }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">{{ $errors->first('city_id') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-danger waves-effect" type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Validation -->
        </div>
    </section>
@endsection
