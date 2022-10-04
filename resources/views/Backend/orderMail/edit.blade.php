@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Edit Order Mail</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('orderMailUpdate',$orderMail->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" value="{{$orderMail->email}}" class="form-control {{ $errors->has('email') ? 'has-error' : '' }}" name="email" required>
                                        <label class="form-label">Email <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{$orderMail->user_name}}" class="form-control {{ $errors->has('user_name') ? 'has-error' : '' }}" name="user_name" required>
                                        <label class="form-label">User Name <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('user_name') }}</span>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{$orderMail->password}}" class="form-control {{ $errors->has('password') ? 'has-error' : '' }}" name="password" required>
                                        <label class="form-label">Password <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{$orderMail->host}}" class="form-control {{ $errors->has('host') ? 'has-error' : '' }}" name="host" required>
                                        <label class="form-label">Host<span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('host') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" value="{{$orderMail->port}}" class="form-control {{ $errors->has('port') ? 'has-error' : '' }}" name="port" required>
                                        <label class="form-label">Port<span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('port') }}</span>
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
