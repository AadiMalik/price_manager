@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Reply</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('messageSendContactUsAdmin',$contact->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        {{--<label class="form-label">Email :</label>--}}
                                        <span class="text-danger">{{$contact->email}}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        {{--<label class="form-label">Message :</label>--}}
                                        <span class="text-danger">{{$contact->message}}</span>
                                    </div>
                                </div>


                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea class="form-control {{ $errors->has('message') ? 'has-error' : '' }}" name="message" required></textarea>
                                        <label class="form-label">Enter Your Message <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('message') }}</span>
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
