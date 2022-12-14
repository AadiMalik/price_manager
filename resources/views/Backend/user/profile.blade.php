@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>User Profile</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{ route('updateUserProfile') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{ $user->name, old('name') }}"
                                            class="form-control {{ $errors->has('name') ? 'has-error' : '' }}"
                                            name="name" disabled>
                                        <label class="form-label">User Name <small>Must be unique</small></label>
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" value="{{ $user->email }}"
                                            name="email" disabled>
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text"
                                            class="form-control {{ $errors->has('first_name') ? 'has-error' : '' }}"
                                            value="{{ $user->first_name, old('first_name') }}" name="first_name" required>
                                        <label class="form-label">First Name</label>
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>

                                    </div>
                                    {{-- <div class="help-info">Starts with http://, https://, ftp:// etc</div> --}}
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text"
                                            class="form-control {{ $errors->has('last_name') ? 'has-error' : '' }}"
                                            value="{{ $user->last_name, old('last_name') }}" name="last_name" required>
                                        <label class="form-label">Last Name</label>
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>

                                    </div>
                                    {{-- <div class="help-info">YYYY-MM-DD format</div> --}}
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text"
                                            class="form-control {{ $errors->has('address') ? 'has-error' : '' }}"
                                            value="{{ $user->address, old('address') }}" name="address" required>
                                        <label class="form-label">Address</label>
                                        <span class="text-danger">{{ $errors->first('address') }}</span>

                                    </div>
                                    {{-- <div class="help-info">Numbers only</div> --}}
                                </div>
                                {{-- <div class="form-group form-float"> --}}
                                {{-- <div class="form-line"> --}}
                                {{-- <input type="url" class="form-control {{ $errors->has('website_url') ? 'has-error' : '' }}" value="{{$user->website_url,old('website_url')}}" name="website_url"> --}}
                                {{-- <label class="form-label">Website Url</label> --}}
                                {{-- <span class="text-danger">{{ $errors->first('website_url') }}</span> --}}

                                {{-- </div> --}}
                                {{-- <div class="help-info">Ex: 1234-5678-9012-3456</div> --}}
                                {{-- </div> --}}

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number"
                                            class="form-control {{ $errors->has('phone_no') ? 'has-error' : '' }}"
                                            value="{{ $user->phone_no, old('phone_no') }}" name="phone_no" maxlength="11"
                                            disabled>
                                        <label class="form-label">Phone no <small>Must be unique</small></label>
                                        <span class="text-danger">{{ $errors->first('phone_no') }}</span>

                                    </div>
                                    {{-- <div class="help-info">Ex: 1234-5678-9012-3456</div> --}}
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">City</label>
                                        <select class="form-control" name="city">
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"
                                                    @if ($city->id == $user->city_id) selected @endif>{{ $city->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{ $errors->first('city') }}</span>

                                    </div>
                                    {{-- <div class="help-info">Ex: 1234-5678-9012-3456</div> --}}
                                </div>
                                {{-- <div class="form-group form-float"> --}}
                                {{-- <div class="form-line"> --}}
                                {{-- <input type="number" class="form-control {{ $errors->has('validity_day') ? 'has-error' : '' }}" value="{{old('validity_day'), $user->validity_day}}" name="validity_day"> --}}
                                {{-- <label class="form-label">Validity Day</label> --}}
                                {{-- <span class="text-danger">{{ $errors->first('validity_day') }}</span> --}}

                                {{-- </div> --}}
                                {{-- <div class="help-info">Ex: 1234-5678-9012-3456</div> --}}
                                {{-- </div> --}}
                                <div class="form-group form-float">

                                    <label class="form-label">Profile Image</label>
                                    <div class="form-line">
                                        <input type="file"
                                            class="form-control {{ $errors->has('image') ? 'has-error' : '' }}"
                                            name="image">

                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    </div>
                                </div>
                                <!-- <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="file" class="form-control {{ $errors->has('images') ? 'has-error' : '' }}" name="images[]" multiple>
                                            <label class="form-label">Display Image on Product</label>
                                            <span class="text-danger">{{ $errors->first('images') }}</span>
                                        </div>
                                    </div> -->
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" value="{{ $user->description }}"
                                            name="description" required>{{ $user->description }}</textarea>
                                        <label class="form-label">Description</label>
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    </div>
                                </div>

                                <!-- <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="form-control {{ $errors->has('password') ? 'has-error' : '' }}" name="password">
                                            <label class="form-label">Password</label>
                                            <span class="text-danger">{{ $errors->first('password') }}</span>

                                        </div>
                                    </div>
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="form-control {{ $errors->has('password') ? 'has-error' : '' }}" name="password_confirmation">
                                            <label class="form-label">Password</label>
                                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>

                                        </div>
                                    </div> -->
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="time" class="form-control" value="{{ $user->open, old('open') }}"
                                            name="open" id="time">
                                        <label class="form-label">Opening Time</label>
                                        {{-- <span class="text-danger">{{ $errors->first('phone_no') }}</span> --}}

                                    </div>
                                    {{-- <div class="help-info">Ex: 1234-5678-9012-3456</div> --}}
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="time" class="form-control" id="time"
                                            value="{{ $user->close, old('close') }}" name="close">
                                        <label class="form-label">Closing Time</label>
                                        {{-- <span class="text-danger">{{ $errors->first('phone_no') }}</span> --}}

                                    </div>
                                    {{-- <div class="help-info">Ex: 1234-5678-9012-3456</div> --}}
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control"
                                            value="{{ $user->holiday, old('holiday') }}" name="holiday">
                                        <label class="form-label">Close Day</label>
                                        {{-- <span class="text-danger">{{ $errors->first('phone_no') }}</span> --}}

                                    </div>
                                    {{-- <div class="help-info">Ex: 1234-5678-9012-3456</div> --}}
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
