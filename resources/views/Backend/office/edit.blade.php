@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Office</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('officeUpdate',$office->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{$office->name}}" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}" name="name" required>
                                        <label class="form-label">Office Name <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control {{ $errors->has('address') ? 'has-error' : '' }}" value="{{$office->address}}" name="address" required>
                                        <label class="form-label">Office Address <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control {{ $errors->has('phone_no') ? 'has-error' : '' }}" value="{{$office->phone_no}}" name="phone_no" required>
                                        <label class="form-label">Phone Number <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('phone_no') }}</span>

                                    </div>
                                    {{--<div class="help-info">Starts with http://, https://, ftp:// etc</div>--}}
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" class="form-control {{ $errors->has('size') ? 'has-error' : '' }}" value="{{$office->email}}" name="email" required>
                                        <label class="form-label">Email <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('email') }}</span>

                                    </div>
                                    {{--<div class="help-info">YYYY-MM-DD format</div>--}}
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input spellcheck="true" type="text" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" value="{{  $office->description}}" name="description" required>
                                        <label class="form-label">Description <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('description') }}</span>

                                    </div>
                                    {{--<div class="help-info">Numbers only</div>--}}
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">

                                        <input type="file" class="form-control {{ $errors->has('image') ? 'has-error' : '' }}" name="image">

                                        <span class="text-danger">{{ $errors->first('image') }}</span>

                                    </div>
                                    {{--<div class="help-info">Ex: 1234-5678-9012-3456</div>--}}
                                </div>
                                <div class="form-group form-float">
                                    <img src="{{asset('storage/app/public/'.$office->image_url)}}" height="100">
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
