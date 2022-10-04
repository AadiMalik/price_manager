@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Package</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('userPackageStore')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{old('name')}}" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}" name="name" required>
                                        <label class="form-label">Package Name <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control {{ $errors->has('price') ? 'has-error' : '' }}" value="{{old('price')}}" name="price" required>
                                        <label class="form-label">Package Price <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" value="{{old('description')}}" name="description" required>
                                        <label class="form-label">Package Description <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('description') }}</span>

                                    </div>
                                    {{--<div class="help-info">Starts with http://, https://, ftp:// etc</div>--}}
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control {{ $errors->has('feature[0]') ? 'has-error' : '' }}" value="{{old('feature[0]')}}" name="feature[]" required>
                                        <label class="form-label">Feature 1 <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('feature[0]') }}</span>

                                    </div>
                                    {{--<div class="help-info">YYYY-MM-DD format</div>--}}
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control {{ $errors->has('feature[1]') ? 'has-error' : '' }}" value="{{old('feature[1]')}}" name="feature[]" required>
                                        <label class="form-label">Feature 2 <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('feature[2]') }}</span>

                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control {{ $errors->has('feature[2]') ? 'has-error' : '' }}" value="{{old('feature[2]')}}" name="feature[]" required>
                                        <label class="form-label">Feature 3 <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('feature[2]') }}</span>

                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control {{ $errors->has('validity_day') ? 'has-error' : '' }}" value="{{old('validity_day')}}" name="validity_day" required>
                                        <label class="form-label">Validity day <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('validity_day') }}</span>

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
