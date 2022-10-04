@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add User</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('userStore')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{old('name')}}" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}" name="name" required>
                                        <label class="form-label">Company Name <small>Must be unique</small></label>
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" value="{{old('email')}}" name="email" required>
                                        <label class="form-label">Email</label>
                                           <span class="text-danger">{{ $errors->first('email') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control {{ $errors->has('first_name') ? 'has-error' : '' }}" value="{{old('first_name')}}" name="first_name" required>
                                        <label class="form-label">First Name</label>
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>

                                    </div>
                                    {{--<div class="help-info">Starts with http://, https://, ftp:// etc</div>--}}
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control {{ $errors->has('last_name') ? 'has-error' : '' }}" value="{{old('last_name')}}" name="last_name" required>
                                        <label class="form-label">Last Name</label>
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>

                                    </div>
                                    {{--<div class="help-info">YYYY-MM-DD format</div>--}}
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control {{ $errors->has('address') ? 'has-error' : '' }}" value="{{ old('address')}}" name="address" required>
                                        <label class="form-label">Address</label>
                                        <span class="text-danger">{{ $errors->first('address') }}</span>

                                    </div>
                                    {{--<div class="help-info">Numbers only</div>--}}
                                </div>
                                {{--<div class="form-group form-float">--}}
                                    {{--<div class="form-line">--}}
                                        {{--<input type="url" class="form-control {{ $errors->has('website_url') ? 'has-error' : '' }}" value="{{old('website_url')}}" name="website_url">--}}
                                        {{--<label class="form-label">Website Url</label>--}}
                                        {{--<span class="text-danger">{{ $errors->first('website_url') }}</span>--}}

                                    {{--</div>--}}
                                    {{--<div class="help-info">Ex: 1234-5678-9012-3456</div>--}}
                                {{--</div>--}}

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control {{ $errors->has('phone_no') ? 'has-error' : '' }}" value="{{ old('phone_no')}}" name="phone_no" maxlength="11">
                                        <label class="form-label">Phone no <small>Must be unique & number must be in form 03001234567</small></label>
                                        <span class="text-danger">{{ $errors->first('phone_no') }}</span>

                                    </div>
                                    {{--<div class="help-info">Ex: 1234-5678-9012-3456</div>--}}
                                </div>
                                <!--<div class="form-group form-float">-->
                                <!--    <div class="form-line">-->
                                <!--        <input type="number" class="form-control {{ $errors->has('validity_day') ? 'has-error' : '' }}" value="{{old('validity_day')}}" name="validity_day">-->
                                <!--        <label class="form-label">Validity Day</label>-->
                                <!--        <span class="text-danger"></span>-->

                                <!--    </div>-->
                                <!--    {{--<div class="help-info">Ex: 1234-5678-9012-3456</div>--}}-->
                                <!--</div>-->
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="file" class="form-control {{ $errors->has('image') ? 'has-error' : '' }}" name="image">
                                        {{--<label class="form-label">Image</label>--}}
                                        <span class="text-danger">{{ $errors->first('image') }}</span>

                                    </div>
                                </div>
                                {{--<div class="form-group form-float">--}}
                                    {{--<div class="form-line">--}}
                                        {{--<input type="password" class="form-control {{ $errors->has('image') ? 'has-error' : '' }}" name="password" required>--}}
                                        {{--<label class="form-label">Enter Password</label>--}}
                                        {{--<span class="text-danger">{{ $errors->first('password') }}</span>--}}

                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group form-float">--}}
                                    {{--<div class="form-line">--}}
                                        {{--<input type="password" class="form-control {{ $errors->has('image') ? 'has-error' : '' }}" name="password_confirmation" required>--}}
                                        {{--<label class="form-label">Enter Password</label>--}}
                                        {{--<span class="text-danger">{{ $errors->first('password') }}</span>--}}

                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control" name="user_type" required>
                                            <option value="">-- Please select User Type--</option>
                                            @foreach($userTypes as $userType)
                                            <option value="{{$userType->id}}" @if(old('user_type') == $userType->id )  selected="" @endif>{{$userType->name}}</option>
                                                @endforeach
                                        </select>
                                        <span class="text-danger">{{ $errors->first('user_type') }}</span>
                                    </div>
                                </div>

                                {{--<div class="form-group form-float">--}}
                                    {{--<div class="form-line">--}}
                                        {{--<select class="form-control" name="user_rating" required>--}}
                                            {{--<option value="">-- Please select User Rating--</option>--}}
                                            {{--@foreach($userRatings as $userType)--}}
                                                {{--<option value="{{$userType->id}}">{{$userType->rating_name}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control" name="package" required>
                                            <option value="">-- Please select Package --</option>
                                            @foreach($userPackages as $userPackage)
                                                <option value="{{$userPackage->id}}" @if(old('package') == $userPackage->id )  selected="" @endif)>{{$userPackage->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{ $errors->first('package') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control" name="city" required>
                                            <option value="">-- Please select City --</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}" @if(old('city') == $city->id )  selected="" @endif  >{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{ $errors->first('city') }}</span>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control" name="industry" required>
                                            <option value="">-- Please select Industry --</option>
                                            @foreach($industries as $industry)
                                                <option value="{{$industry->id}}"  @if(old('industry') == $industry->id )  selected @endif >{{$industry->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{ $errors->first('industry') }}</span>
                                    </div>
                                </div>
                                
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" name="description" required>{{ old('description')}}</textarea>
                                        <label class="form-label">Description</label>
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    </div>
                                </div>
                                
                                <div class="form-group form-check">
                                    <input type="checkbox" name="brand_id" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Are your sure you want made this as Brand ?</label>
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

