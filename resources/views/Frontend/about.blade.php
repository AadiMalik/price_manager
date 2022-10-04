@extends('layouts.frontend')

@section('content')

    <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2 style="color:#fff;">{{$siteContents[0]->where('id',28)->first()->content}}</h2>
                </div>

            </div>
        </div>
    </div>

    <div class="about">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11">

                    <!-- About Start -->
                    <div class="about">
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-md-6">
                                <div class="about-img" style="background:none;">
                                    <img src="{{asset('asset/img/home.png')}}" alt="Image">
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <div class="section-header">
                                    <h2>About Us</h2>
                                </div>
                                <div class="about-text">
                                    <p>
                                        {!!nl2br(e($siteContents[0]->where('id',41)->first()->content))!!}
                                    </p>
                                    
                                </div>
                                <div class="section-header">
                                    <h2>Our Mission</h2>
                                </div>
                                <div class="about-text">
                                    <p>
                                        {!!nl2br(e($siteContents[0]->where('id',48)->first()->content))!!}
                                    </p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- About End -->


                    <!-- Timeline Start -->
                    <div class="timeline">
                        <div class="container">
                            <div class="section-header">
                                <h2>Our Journey</h2>
                            </div>
                        </div>
                        <div class="timeline-start">
                            <div class="timeline-container left">
                                <div class="timeline-content">
                                    <h2><span>2020</span>Lorem ipsum dolor sit amet</h2>
                                    <p>
                                        Lorem ipsum dolor sit amet elit. Aliquam odio dolor, id luctus erat sagittis non. Ut blandit semper pretium.
                                    </p>
                                </div>
                            </div>
                            <div class="timeline-container right">
                                <div class="timeline-content">
                                    <h2><span>2019</span>Lorem ipsum dolor sit amet</h2>
                                    <p>
                                        Lorem ipsum dolor sit amet elit. Aliquam odio dolor, id luctus erat sagittis non. Ut blandit semper pretium.
                                    </p>
                                </div>
                            </div>
                            <div class="timeline-container left">
                                <div class="timeline-content">
                                    <h2><span>2018</span>Lorem ipsum dolor sit amet</h2>
                                    <p>
                                        Lorem ipsum dolor sit amet elit. Aliquam odio dolor, id luctus erat sagittis non. Ut blandit semper pretium.
                                    </p>
                                </div>
                            </div>
                            <div class="timeline-container right">
                                <div class="timeline-content">
                                    <h2><span>2017</span>Lorem ipsum dolor sit amet</h2>
                                    <p>
                                        Lorem ipsum dolor sit amet elit. Aliquam odio dolor, id luctus erat sagittis non. Ut blandit semper pretium.
                                    </p>
                                </div>
                            </div>
                            <div class="timeline-container left">
                                <div class="timeline-content">
                                    <h2><span>2016</span>Lorem ipsum dolor sit amet</h2>
                                    <p>
                                        Lorem ipsum dolor sit amet elit. Aliquam odio dolor, id luctus erat sagittis non. Ut blandit semper pretium.
                                    </p>
                                </div>
                            </div>
                            <div class="timeline-container right">
                                <div class="timeline-content">
                                    <h2><span>2015</span>Lorem ipsum dolor sit amet</h2>
                                    <p>
                                        Lorem ipsum dolor sit amet elit. Aliquam odio dolor, id luctus erat sagittis non. Ut blandit semper pretium.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Timeline End -->


                </div>
            </div>
        </div>
    </div>


@endsection

