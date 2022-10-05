@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add Feature Package</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('f-package.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{old('name')}}" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}" name="name" required>
                                        <label class="form-label">Name <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{old('price')}}" class="form-control {{ $errors->has('price') ? 'has-error' : '' }}" name="price" required>
                                        <label class="form-label">Price <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{old('days')}}" class="form-control {{ $errors->has('days') ? 'has-error' : '' }}" name="days" required>
                                        <label class="form-label">Days <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('days') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{old('icon')}}" class="form-control {{ $errors->has('icon') ? 'has-error' : '' }}" name="icon" required>
                                        <label class="form-label">Icon <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('icon') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{old('description')}}" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" name="description" required>
                                        <label class="form-label">Description <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
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
