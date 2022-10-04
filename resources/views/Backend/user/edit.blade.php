@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Edit User</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('userUpdate',$user->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{$user->name}}" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}" name="name" disabled>
                                        <label class="form-label">Company Name <small>Must be unique</small></label>
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" value="{{$user->email}}" name="email" disabled>
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control {{ $errors->has('first_name') ? 'has-error' : '' }}" value="{{$user->first_name}}" name="first_name" required>
                                        <label class="form-label">First Name</label>
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>

                                    </div>
                                    {{--<div class="help-info">Starts with http://, https://, ftp:// etc</div>--}}
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control {{ $errors->has('last_name') ? 'has-error' : '' }}" value="{{$user->last_name}}" name="last_name" required>
                                        <label class="form-label">Last Name</label>
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>

                                    </div>
                                    {{--<div class="help-info">YYYY-MM-DD format</div>--}}
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control {{ $errors->has('address') ? 'has-error' : '' }}" value="{{ $user->address}}" name="address" required>
                                        <label class="form-label">Address</label>
                                        <span class="text-danger">{{ $errors->first('address') }}</span>

                                    </div>
                                    {{--<div class="help-info">Numbers only</div>--}}
                                </div>
                                {{--<div class="form-group form-float">--}}
                                    {{--<div class="form-line">--}}
                                        {{--<input type="url" class="form-control {{ $errors->has('website_url') ? 'has-error' : '' }}" value="{{$user->website_url}}" name="website_url">--}}
                                        {{--<label class="form-label">Website Url</label>--}}
                                        {{--<span class="text-danger">{{ $errors->first('website_url') }}</span>--}}

                                    {{--</div>--}}
                                    {{--<div class="help-info">Ex: 1234-5678-9012-3456</div>--}}
                                {{--</div>--}}

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control {{ $errors->has('phone_no') ? 'has-error' : '' }}" value="{{ $user->phone_no}}" name="phone_no" max="11" disabled>
                                        <label class="form-label">Phone no <small>Must be unique</small></label>
                                        <span class="text-danger">{{ $errors->first('phone_no') }}</span>

                                    </div>
                                    {{--<div class="help-info">Ex: 1234-5678-9012-3456</div>--}}
                                </div>
                            
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
                                        <label class="form-label">User Type</label>
                                    <div class="form-line">
                                        <select class="form-control" name="user_type" required>
                                            <option value="">-- Please select User Type--</option>
                                            @foreach($userTypes as $userType)
                                            <option value="{{$userType->id}}" {{ $user->user_type == $userType->id ? 'selected' : ''}}>{{$userType->name}}</option>
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
                                                {{--<option value="{{$userType->id}}" {{ $user->user_rating == $userType->id ? 'selected' : ''}}>{{$userType->rating_name}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                <div class="form-group form-float">
                                        <label class="form-label">Package</label>
                                    <div class="form-line">
                                        <select class="form-control" name="package" required>
                                            <option value="">-- Please select Package --</option>
                                            @foreach($userPackages as $userPackage)
                                                <option value="{{$userPackage->id}}" {{ $user->user_package == $userPackage->id ? 'selected' : ''}}>{{$userPackage->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{ $errors->first('package') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                        <label class="form-label">City</label>
                                    <div class="form-line">
                                        <select class="form-control" name="city" required>
                                            <option value="">-- Please select City --</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}" {{ $user->city_id == $city->id ? 'selected' : ''}}>{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{ $errors->first('city') }}</span>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                        <label class="form-label">Industry</label>
                                    <div class="form-line">
                                        <select class="form-control" name="industry" required>
                                            <option value="">-- Please select Industry --</option>
                                            @foreach($industries as $industry)
                                            <option value="{{$industry->id}}" {{ $user->industry_id == $industry->id ? 'selected' : ''}}>{{$industry->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{ $errors->first('industry') }}</span>
                                    </div>
                                </div>
                                
                                <div class="form-group form-check">
                                    <input type="checkbox" name="brand_id" class="form-check-input" id="exampleCheck1" {{$user->brand_id ? 'checked' : ''}}>
                                    <label class="form-check-label" for="exampleCheck1">Are your sure you want made this as Brand ?</label>
                                </div>
                                
                                  
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" name="description"  required>{{ $user->description}}</textarea>
                                        <label class="form-label">Description</label>
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control" name="status" required>
                                            <option value="">-- Please select Status --</option>
                                                <option value="1" @if($user->status == 1) selected @endif>Active</option>
                                                <option value="2" @if($user->status == 2) selected @endif>Block</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" name="packageUpdate" class="form-check-input" id="updatePackage">
                                    <label class="form-check-label" for="updatePackage">Are your sure you want update Package ?</label>
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

