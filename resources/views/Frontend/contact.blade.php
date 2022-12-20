@extends('layouts.frontend')

@section('content')

    {{-- <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 style="color:#fff;">{{$siteContents[0]->where('id',15)->first()->content}}</h2>
                </div>

            </div>
        </div>
    </div> --}}
    @if(Session('success'))
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            <strong>Success:</strong>&nbsp; {{ Session('success') }} </div>

    @endif
    <!-- Page Header End -->
    <!-- <div class="container"> -->
    <!-- <div class="row"> -->
    <!-- <div class="col-lg-12"> -->
    <!-- <div class="section-header"> -->
    <!-- <h2>Contact Us</h2> -->
    <!-- </div> -->
    <!-- </div> -->
    <!-- </div> -->
    <!-- </div> -->
    <div class="about">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <!-- Contact Start -->
                    <div class="contact">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="contact-info">
                                    <div class="contact-item">
                                        <i class="fa fa-map-marker-alt"></i>
                                        <div class="contact-text">
                                            <h2>Location</h2>
                                            <p>{{$siteContents[0]->where('id',22)->first()->content}}</p>
                                        </div>
                                    </div>
                                    <div class="contact-item">
                                        <i class="fa fa-phone-alt"></i>
                                        <div class="contact-text">
                                            <h2>Phone</h2>
                                            <p>{{$siteContents[0]->where('id',23)->first()->content}}</p>
                                        </div>
                                    </div>
                                    <div class="contact-item">
                                        <i class="fa fa-envelope"></i>
                                        <div class="contact-text">
                                            <h2>Email</h2>
                                            <p>{{$siteContents[0]->where('id',24)->first()->content}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-form">
                                    <form action="{{route('frontendStoreContact')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input name="name" type="text" class="form-control" placeholder="{{$siteContents[0]->where('id',17)->first()->content}}" required="required" />
                                        </div>
                                        <div class="form-group">
                                            <input name="email" type="email" class="form-control" placeholder="{{$siteContents[0]->where('id',18)->first()->content}}" required="required" />
                                        </div>
                                        <div class="form-group">
                                            <input name="subject" type="text" class="form-control" placeholder="{{$siteContents[0]->where('id',19)->first()->content}}" required="required" />
                                        </div>
                                        <div class="form-group">
                                            <textarea name="message" maxlength="400" class="form-control" placeholder="{{$siteContents[0]->where('id',20)->first()->content}}" required="required" ></textarea>
                                        </div>
                                        <div>
                                            <button class="btn" type="submit">Send Message</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Contact End -->



                </div>
            </div>
        </div>
    </div>


@endsection

