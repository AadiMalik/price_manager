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
                            <form id="form_advanced_validation" method="POST" action="{{url('update-password')}}" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="password" class="form-control {{ $errors->has('password') ? 'has-error' : '' }}" name="password">
                                        <label class="form-label">Password</label>
                                        <span class="text-danger">{{ $errors->first('password') }}</span>

                                    </div>
                                </div>
                                
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="password" class="form-control {{ $errors->has('password') ? 'has-error' : '' }}" name="password_confirmation">
                                        <label class="form-label">Confirm Password</label>
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>

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
