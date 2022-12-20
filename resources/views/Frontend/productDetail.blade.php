@extends('layouts.frontend')
@section('style')
    <style>
        nav {
            display: block;
            width: 100%;
        }

        ul {
            list-style: none;
            margin-bottom: 20px;
        }

        nav>ul>li {
            display: inline-block;
        }

        nav>ul>li>a {
            text-transform: uppercase;
            padding: 4px 10px;
            margin-right: 2px;
            margin-left: 2px;
            text-decoration: none;
            color: #da5c22;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 15px;
            border: 1px solid #da5c22;
            -webkit-transition: all 300ms ease-in-out;
            -moz-transition: all 300ms ease-in-out;
            transition: all 300ms ease-in-out;
        }

        .link_active {
            background: #da5c22;
            color: #fff;
        }
    </style>
@endsection
@section('content')

    <!-- Carousel Start -->
    <div id="carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel" data-slide-to="0" class="active"></li>
            <li data-target="#carousel" data-slide-to="1"></li>
            <li data-target="#carousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            @if (count($slider_images) > 0)
                @foreach ($slider_images as $index => $image)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ asset($image->image_url) }}" class="d-block w-100" alt="Carousel Image">
                    </div>
                @endforeach
            @else
                <div class="carousel-item active">
                    <img src="{{ asset('images/dummy.jfif') }}" class="d-block w-100" alt="Carousel Image">
                </div>
            @endif
        </div>

        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- Carousel End -->


    <!-- Top Feature Start-->
    @if($user->verify==1)
    <div class="feature-top">
        <div class="container-fluid">
            <div class="row" style="height:100%;">
                <div class="col-md-2 col-sm-6">
                    <div class="feature-item" style="padding:0px;">
                        <img src="{{ asset('asset/img/legel.png') }}" style="width: 70px; height: 70px;border-radius: 50%;">
                        <!--<i class="far fa-check-circle"></i>-->
                        <h3 style="font-size:20px;">Legal</h3>
                        <p style="font-size:16px;">Approved</p>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="feature-item" style="padding:0px;">
                        <img src="{{ asset('asset/img/reliability.png') }}"
                            style="width: 70px; height: 70px;border-radius: 50%;">
                        <!--<i class="fa fa-user-tie"></i>-->
                        <h3 style="font-size:20px;">Reliability</h3>
                        <p style="font-size:16px;">99.99%</p>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="feature-item" style="padding:0px;">
                        <img src="{{ asset('asset/img/accessibility.png') }}"
                            style="width: 70px; height: 70px;border-radius: 50%;">
                        <!--<i class="far fa-thumbs-up"></i>-->
                        <h3 style="font-size:20px;">Accessibility</h3>
                        <p style="font-size:16px;">100% Easy</p>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="feature-item" style="padding:0px;">
                        <img src="{{ asset('asset/img/support.png') }}"
                            style="width: 70px; height: 70px;border-radius: 50%;">
                        <!--<i class="fa fa-handshake"></i>-->
                        <h3 style="font-size:20px;">Support</h3>
                        <p style="font-size:16px;">24/7</p>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="feature-item" style="padding:0px;">
                        <img src="{{ asset('asset/img/honesty.png') }}"
                            style="width: 70px; height: 70px;border-radius: 50%;">
                        <!--<i class="fa fa-leaf"></i>-->
                        <h3 style="font-size:20px;">Honesty</h3>
                        <p style="font-size:16px;">100% </p>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="feature-item" style="padding:0px;">
                        <img src="{{ asset('asset/img/quality.png') }}"
                            style="width: 70px; height: 70px;border-radius: 50%;">
                        <!--<i class="fa fa-heartbeat"></i>-->
                        <h3 style="font-size:20px;">Quality</h3>
                        <p style="font-size:16px;">On your demand</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Top Feature End-->

    <!-- Service Start -->
    <div class="service">
        <div class="container">
            <div class="section-header">
                <h2>{{ $user->UserType->name }}</h2>
            </div>
            <div class="alert collapse" id="collapseExample"
                style=" 
    font-size: 25px;
    text-align: center;
    font-weight: bold;
    color: #fff;
     background:#da5c22;
    border-radius: 0px;">
                {{ $user->phone_no }}
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12" style="text-align:right;">
                            <img class="img-thumbnail" style="width:100%; height:350px;"
                                src="{{ $user->image_url ? asset($user->image_url) : asset('asset/img/portfolio-1.jpg') }}" />

                        </div>
                        <div class="col-lg-6" style="line-space:10px;">
                            <h2 style="font-size:40px; color:#da5c22; text-transform:capitalize;">{{ $user->name }}</h2>
                            <h3 style="text-transform:capitalize;">{{ $user->first_name . ' ' . $user->last_name }}</h3>
                            <table>
                                <tr>
                                    <td style="width: 130px;"><b>Phone #:</b></td>
                                    <td><span>@auth

                                                &nbsp;&nbsp;&nbsp;&nbsp;<button id="butsave" data-toggle="collapse"
                                                    data-target="#collapseExample" aria-expanded="false"
                                                    aria-controls="collapseExample"
                                                    style="font-size: 12px; color: #fff; height: 30px; line-height: 10px;">Show</button>
                                            @else
                                            &nbsp;&nbsp;&nbsp;&nbsp;Login First then Show @endauth
                                    </span>

                                    </td>
                                <tr>
                                    <td style="width: 160px;"><b>Member Status:</b></td>
                                    <td>&nbsp;&nbsp;&nbsp;<span> {{ $user->userPackage->name ?? '' }}</span></td>
                                </tr>
                                @if(isset($user->open))
                                <tr>
                                    <td style="width: 160px;"><b>Working Schedule:</b></td>
                                    <td>&nbsp;&nbsp;&nbsp;<span> {{ $user->open }} - {{ $user->close }} &nbsp;&nbsp; {{ $user->holiday }} &nbsp;Closed</span></td>
                                </tr>
                                @endif
                                <tr colspan="2">
                                    <td>
                                        <br>
                                    </td>
                                </tr>
                                <!--<tr colspan="2">-->
                                <!--    <td>-->
                                <!--        <a href="{{ route('user.chat', $user->id) }}" style="margin-top: 20px; width:100px; font-size:14px; text-align: center;" target="_blank" class="remarks-btn"><span class="fab fa-meetup"></span> Message </a>-->
                                <!--    </td>-->
                                <!--</tr>-->
                            </table>
                        </div>
                        <div class="col-lg-2" style="text-align:right;">
                            <div style="float:right; margin-right:10px; font-size:14px;">
                                @if (($user->reviews ? $user->reviews->avg('rating') : 0) < 0.5)
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                @elseif($user->reviews->avg('rating') < 1)
                                    <span class="fa fa-star-half-alt" style="color:#da5c22;"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                @elseif($user->reviews->avg('rating') < 1.5)
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                @elseif($user->reviews->avg('rating') < 2)
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star-half-alt" style="color:#da5c22;"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                @elseif($user->reviews->avg('rating') < 2.5)
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                @elseif($user->reviews->avg('rating') < 3)
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star-half-alt" style="color:#da5c22;"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                @elseif($user->reviews->avg('rating') < 3.5)
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                @elseif($user->reviews->avg('rating') < 4)
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star-half-alt" style="color:#da5c22;"></span>
                                    <span class="fa fa-star"></span>
                                @elseif($user->reviews->avg('rating') < 4.5)
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star"></span>
                                @elseif($user->reviews->avg('rating') < 5)
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star-half-alt" style="color:#da5c22;"></span>
                                @else
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                    <span class="fa fa-star" style="color:#da5c22;"></span>
                                @endif
                                @if (isset($user->reviews))
                                    ({{ count($user->reviews) }})
                                @endif
                            </div>
                        </div>
                        <!-- <div class="row"> -->
                        <!-- <div class="col-lg-7"> -->
                        <!-- <div class="w3-content" style="max-width:1200px"> -->
                        <!-- <img class="mySlides" src="img/carousel-1.jpg" style="width:100%;display:none"> -->
                        <!-- <img class="mySlides" src="img/carousel-1.jpg" style="width:100%;"> -->
                        <!-- <img class="mySlides" src="img/carousel-1.jpg" style="width:100%;display:none"> -->

                        <!-- </div> -->
                        <!-- <div class="w3-row-padding w3-section"> -->
                        <!-- <div class="w3-col s4"> -->
                        <!-- <img class="demo w3-opacity w3-hover-opacity-off" src="img/carousel-1.jpg" style="width:100%;cursor:pointer" onclick="currentDiv(1)"> -->
                        <!-- </div> -->
                        <!-- <div class="w3-col s4"> -->
                        <!-- <img class="demo w3-opacity w3-hover-opacity-off" src="img/carousel-1.jpg" style="width:100%;cursor:pointer" onclick="currentDiv(2)"> -->
                        <!-- </div> -->
                        <!-- <div class="w3-col s4"> -->
                        <!-- <img class="demo w3-opacity w3-hover-opacity-off" src="img/carousel-1.jpg" style="width:100%;cursor:pointer" onclick="currentDiv(3)"> -->
                        <!-- </div> -->
                        <!-- </div> -->
                        <!-- </div> -->
                        <!-- <div class="col-lg-5"> -->
                        <!-- <div style="border:2px solid #aa9166;"> -->
                        <!-- <div style="background:#aa9166; color:#000; line-height:40px; height:40px; border-raduis:0px; text-align:center;"> -->
                        <!-- <b>User Profile</b> -->
                        <!-- </div> -->
                        <!-- <div class="row" style="padding:15px;"> -->
                        <!-- <div class="col-lg-6"> -->
                        <!-- <b>Name:</b> -->
                        <!-- </div> -->
                        <!-- <div class="col-lg-6"> -->
                        <!-- <i>Fine Bricks Company</i> -->
                        <!-- </div> -->
                        <!-- </div> -->
                        <!-- <div class="row" style="padding:15px;"> -->
                        <!-- <div class="col-lg-6"> -->
                        <!-- <b>Phone #:</b> -->
                        <!-- </div> -->
                        <!-- <div class="col-lg-6"> -->
                        <!-- <i>0300123456789</i> -->
                        <!-- </div> -->
                        <!-- </div> -->
                        <!-- <div class="row" style="padding:15px;"> -->
                        <!-- <div class="col-lg-6"> -->
                        <!-- <b>Type:</b> -->
                        <!-- </div> -->
                        <!-- <div class="col-lg-6"> -->
                        <!-- <i>Manufacturer</i> -->
                        <!-- </div> -->
                        <!-- </div> -->
                        <!-- <div class="row" style="padding:15px;"> -->
                        <!-- <div class="col-lg-6"> -->
                        <!-- <b>Member Status:</b> -->
                        <!-- </div> -->
                        <!-- <div class="col-lg-6"> -->
                        <!-- <i>Gold/Demand</i> -->
                        <!-- </div> -->
                        <!-- </div> -->
                        <!-- <div class="row" style="padding:15px;"> -->
                        <!-- <div class="col-lg-6"> -->
                        <!-- <b>Rating()/5:</b> -->
                        <!-- </div> -->
                        <!-- <div class="col-lg-6"> -->
                        <!-- <div style=" margin-right:10px; font-size:14px;"> -->
                        <!-- <span class="fa fa-star"></span> -->
                        <!-- <span class="fa fa-star"></span> -->
                        <!-- <span class="fa fa-star"></span> -->
                        <!-- <span class="fa fa-star"></span> -->
                        <!-- <span class="fa fa-star"></span> -->
                        <!-- </div> -->
                        <!-- </div> -->
                        <!-- </div> -->
                        <!-- <div class="row"> -->
                        <!-- <div class="col-lg-12"> -->
                        <!-- <img class="thumbnail" src="img/carousel-1.jpg" style="width:100%;cursor:pointer; height:230px;"> -->
                        <!-- </div> -->
                        <!-- </div> -->
                        <!-- </div> -->
                        <!-- </div> -->
                        <!-- </div> -->
                        <!-- <div class="row"> -->
                        <!-- <div class="col-lg-3" -->
                        <!-- </div> -->
                        <!-- </div> -->
                    </div>
                    <div class="row" style="margin-top:20px;">
                        <div class="col-lg-12">
                            <table>
                                <tr>
                                    <td colspan="2">
                                        <b style="color:#da5c22;">Company Information:</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="wells">
                                            {!! nl2br(e($user->description)) !!}
                                            <br>
                                            <br>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <b style="color:#da5c22;">Note:</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 140px;">
                                        <b>Delivery Charges:</b>
                                    </td>
                                    <td>
                                        <span>Delivery Charges will be applicable</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 140px;">
                                        <b>Payment Method:</b>
                                    </td>
                                    <td>
                                        <span>Advance</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top:30px;">
            <div class="section-header">
                <h2>All Products</h2>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11 mb-3">
                    <nav>
                        <ul>
                            <!--<li class="current"><a href="#">All</a></li>-->
                            <li><a @if (Request::is('package/' . $user->id . '/0')) class="link_active" @endif
                                    href="{{ url('package/' . $user->id . '/0') }}">All</a></li>
                            @foreach ($productcategory as $item)
                                @if ($item->name != null)
                                    <li><a @if (Request::is('package/' . $user->id . '/' . $item->id)) class="link_active" @endif
                                            href="{{ url('package/' . $user->id . '/' . $item->id) }}">{{ $item->name }}</a>
                                    </li>
                                @endif
                            @endforeach

                        </ul>
                    </nav>
                </div>
                <div class="col-lg-11">
                    <div class="row">
                        @if ($product->count() > 0)
                            @foreach ($product as $index => $product)
                                <div class="col-lg-2 col-md-4 col-sm-6 popup" style="margin-bottom:20px;">
                                    <a data-toggle="modal" data-target="#packageDetail{{ $index + 1 }}"
                                        href="#">
                                        <div class="card" style="border-radius: 0%; background: none; border:none;">
                                            <div class="card-body" style="padding: 0px;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <img style="height: 250px; width:100%; border-radius:0px; box-shadow: 0px 0px 10px 0px #808080;"
                                                            src="{{ asset($product->image_url) }}" />
                                                    </div>
                                                </div>

                                                <div class="row" style="padding-left:5px; margin-top:10px;">
                                                    <div class="col-md-12"
                                                        style="width:100%;text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
                                                        <b>{{ $product->name }}</b><br>
                                                        <b style="color:#da5c22;">{{ number_format($product->price) }}
                                                            <small>PKR</small></b>&nbsp;&nbsp;&nbsp;@if ($product->pre_price != null)
                                                            <small><del>{{ number_format($product->pre_price) }}PKR</del></small>
                                                        @endif
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </a>
                                    <hr />
                                </div>
                                <div class="modal fade modal-fullscreen" id="packageDetail{{ $index + 1 }}"
                                    style="padding-right:90px;" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" style="width:100%; padding:17px;">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background:#da5c22; padding:5px 1rem;">
                                                <h5 class="modal-title" style="color:#fff; font-size:25px;"
                                                    id="exampleModalLabel">{{ $user->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-6" class="img-thumbnail"
                                                        style="background-image:url('{{ asset($product->image_url) }}');width:100%; text-align:center; height:600px; background-size: contain; background-position: center; background-repeat: no-repeat;">
                                                        <div class="row"
                                                            style="    height: 100px;
    padding: 85px;
    font-size: 30px;
    color: #A9A9A9; transform: rotate(45deg);">
                                                            <div class="col-lg-12">
                                                                <b>pricemanager.pk</b>
                                                            </div>
                                                        </div>
                                                        <div class="row"
                                                            style="    height: 200px;
    padding: 100px;
    font-size: 30px;
    color: #A9A9A9; transform: rotate(45deg)">
                                                            <div class="col-lg-12">
                                                                <b>pricemanager.pk</b>
                                                            </div>
                                                        </div>
                                                        <div class="row"
                                                            style="    height: 200px;
    padding: 100px;
    font-size: 30px;
    color: #A9A9A9; transform: rotate(45deg)">
                                                            <div class="col-lg-12">
                                                                <b>pricemanager.pk</b>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6" style="border-left:2px solid #da5c22;">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <h3>{{ $product->name }}</h3>
                                                            </div>
                                                        </div>
                                                        <!--<div class="row" style="margin-top:15px;">-->
                                                        <!--    <div class="col-lg-12">-->
                                                        <!--        <div style="font-size:14px;">-->
                                                        <!--            <span class="fa fa-star" style="color:#aa9166;"></span>-->
                                                        <!--            <span class="fa fa-star" style="color:#aa9166;"></span>-->
                                                        <!--            <span class="fa fa-star-half-alt"-->
                                                        <!--                  style="color:#aa9166;"></span>-->
                                                        <!--            <span class="fa fa-star"></span>-->
                                                        <!--            <span class="fa fa-star"></span>-->
                                                        <!--        </div>-->
                                                        <!--    </div>-->
                                                        <!--</div>-->
                                                        <div class="row" style="margin-top:15px;">
                                                            <div class="col-lg-12">
                                                                <table>
                                                                    <tr>
                                                                        <td><span>Product Company:</span></td>
                                                                        <td><b>&nbsp;&nbsp;&nbsp;{{ $user->name }}</b>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><span>Product Quality: </span></td>
                                                                        <td><b>&nbsp;&nbsp;&nbsp;{{ $product->quality }}</b>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><span>Product Size: </span></td>
                                                                        <td><b>&nbsp;&nbsp;&nbsp;{{ $product->size }}</b>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin-top:15px;">
                                                            <div class="col-lg-12">
                                                                <span class="badge"
                                                                    style="font-size:45px; background:#da5c22; color:#fff; border-raduis:0px;">{{ number_format($product->price) }}
                                                                    <i style="font-size:12px;">PKR</i><br>
                                                                    @if ($product->pre_price != null)
                                                                        <small
                                                                            style="font-size:20px; float:right;"><del>{{ number_format($product->pre_price) }}&nbsp;&nbsp;PKR</del></small>
                                                                    @endif
                                                                </span>

                                                            </div>

                                                        </div>
                                                        <div class="row" style="margin-top:15px;">
                                                            <div class="col-lg-12">
                                                                <b>Description:</b>
                                                                <p style="font-style:justify;">{{ $product->description }}
                                                                <p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="padding:0px 1.75rem; background:#da5c22;">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <b>No Product Found</b>
                        @endif
                    </div>
                    {{-- <div class="container"> --}}
                    {{-- <div class="row justify-content-center"> --}}
                    {{-- <div class="col-lg-2 col-lg-offset-5"> --}}
                    {{-- <a class="btn" href="">load more</a> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
        @if ($imageRemarks->count() > 0)
            <div class="container" style="margin-top:30px;">
                <div class="section-header">
                    <h2>Image Remarks</h2>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <div class="row">
                            @foreach ($imageRemarks as $index => $imageRemark)
                                <div class="col-lg-2 col-md-4 col-sm-6" style="margin-top:5px;">

                                    <a data-toggle="modal" data-target="#ImageModel{{ $index + 1 }}" href="#">
                                        <img class="img-thumbnail" title="{{ $imageRemark->name }}"
                                            src="{{ asset($imageRemark->image_url) }}"
                                            style="height:200px; width:100%;" />
                                    </a>
                                </div>
                                <div class="modal fade modal-fullscreen" id="ImageModel{{ $index + 1 }}"
                                    style="padding-right:90px;" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" style="width:100%; padding:17px;">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{ $user->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <img class="img-thumbnail" style="width:100%; height:600px;"
                                                            src="{{ asset($imageRemark->image_url) }}" />
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- <div class="container"> --}}
                        {{-- <div class="row justify-content-center"> --}}
                        {{-- <div class="col-lg-2 col-lg-offset-5"> --}}
                        {{-- <a class="btn" href="">load more</a> --}}
                        {{-- </div> --}}
                        {{-- </div> --}}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        @endif
        @if ($videoRemarks->count() > 0)
            <div class="container" style="margin-top:30px;">
                <div class="section-header">
                    <h2>Video Remarks</h2>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <div class="row">
                            @foreach ($videoRemarks as $videoRemark)
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <iframe class="img-thumbnail" style="height:300px; width:100%;"
                                        src="{{ $videoRemark->video_url }}" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen=""></iframe>
                                    <h6 class="caption">{{ $videoRemark->description }} </h6>
                                </div>
                            @endforeach
                        </div>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-2 col-lg-offset-5">
                                    {{ $videoRemarks->links() }}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <hr />
        <!-- Service End -->
        <!-- Comment Section-->
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    @auth

                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Remarks</h4>
                                <hr />
                            </div>
                        </div>

                        @if (auth()->user()->id != $user->id)
                            <form method="post" action="{{ route('frontendUserReview', $user) }}"
                                enctype="multipart/form-data">

                                <div class="row">
                                    @csrf
                                    <div class="col-lg-4">
                                        <label class="mt-1">Rate us</label><br />
                                        <span class="myratings">4.5</span>
                                        <fieldset class="rating">
                                            <input type="radio" id="star5" name="rating" value="5" /><label
                                                class="full" for="star5" title="Awesome - 5 stars"></label> <input
                                                type="radio" id="star4half" name="rating" value="4.5" /><label
                                                class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                            <input type="radio" id="star4" name="rating" value="4" /><label
                                                class="full" for="star4" title="Pretty good - 4 stars"></label>
                                            <input type="radio" id="star3half" name="rating" value="3.5" /><label
                                                class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                            <input type="radio" id="star3" name="rating" value="3" /><label
                                                class="full" for="star3" title="Meh - 3 stars"></label>
                                            <input type="radio" id="star2half" name="rating" value="2.5" /><label
                                                class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                            <input type="radio" id="star2" name="rating" value="2" /><label
                                                class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                            <input type="radio" id="star1half" name="rating" value="1.5" /><label
                                                class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                            <input type="radio" id="star1" name="rating" value="1" /><label
                                                class="full" for="star1" title="Sucks big time - 1 star"></label>
                                            <input type="radio" id="starhalf" name="rating" value="0.5"
                                                required="required" />
                                            <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                            <input type="radio" class="reset-option" name="rating" value="reset" />
                                        </fieldset>
                                        {{ $errors->first('rating') }}


                                        {{-- <label>Image</label>
                                    <input type="file" name="image" class="form-control" id="file" required="required"/>
                                    {{ $errors->first('image') }} --}}
                                        <label>Message:</label>
                                        <textarea name="message" class="form-control" maxlength="100" placeholder="Message Write here.."
                                            style="min-height:130px;">{{ old('message') }}</textarea>
                                        {{ $errors->first('message') }}
                                        <div class="row" style="margin-top:20px;">
                                            <div class="col-lg-5 col-md-6 col-sm-12">
                                                <button class="remarks-btn form-control" type="submit"><span
                                                        class="fa fa-paper-plane"></span> Send
                                                </button>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </form>
                        @else
                            <h2>Your are not remarks own products</h2>
                        @endif
                    @else
                        <div class="row">
                            <div class="col-lg-2 col-md-6 col-sm-12">
                                <a href="{{ route('login') }}" class="remarks-btn form-control">Add Review <span
                                        class="fa fa-paper-plane"></span>
                                </a>
                            </div>
                        </div>
                    @endauth
                    <hr />
                    <hr />
                    @if ($reviews->count() != null)
                        @foreach ($reviews as $review)
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="media">
                                        @if ($review->reviewUser->image_url != null)
                                            <img class="mr-3" src="{{ asset($review->reviewUser->image_url) }}"
                                                style="width:70px; height:70px;" alt="Generic placeholder image">
                                        @else
                                            <i class="fa fa-user" style="font-size:20px; margin-right:15px;"></i>
                                        @endif
                                        <div class="media-body">
                                            <h5 class="mt-0">{{ $review->reviewUser->name }} <span
                                                    style="font-size:14px; float:right;">{{ date('d-M-y', strtotime($review->created_at)) }}</span>
                                            </h5>
                                            @if ($review->message != null)
                                                {{ $review->message }}
                                            @else
                                                <span style="color:red;">No Message</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                        @endforeach
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-2 col-lg-offset-5">
                                    {{ $reviews->links() }}

                                </div>
                            </div>
                        </div>
                    @else
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-2 col-lg-offset-5">
                                    No Reviews
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
        <!-- Service Start -->
        <div class="service">
            <div class="container">
                <div class="section-header">
                    <h2>Related Companies</h2>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row justify-content-center">
                            <div class="col-lg-11">
                                <div class="row" id="userSearch">

                                </div>
                                <div class="row" id="userData">
                                    @foreach ($users->take(4) as $user)
                                        @if ($user->products->where('price', '>', 0)->count() > 0)
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <a href="{{ route('frontendUserPackageDetail', $user) }}">
                                                    <div class="service-item">
                                                        <div class="service-icon item">
                                                            @if($user->verify==1)
                                                            <span class="notify-badge"
                                                                style="color:#fff; text-transform:capitalize;">Verified</span>
                                                                @endif
                                                            <img
                                                                src="{{ $user->image_url ? asset($user->image_url) : asset('asset/img/portfolio-1.jpg') }}" />
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <span class="badge"
                                                                    style="background:#da5c22; color:#fff; float:left; margin-left:15px; font-size:14px; border-radius:0px; margin-top:23px;">{{ $user->UserType->name }}</span><br>
                                                                <br />
                                                                <div class="star-hidden"
                                                                    style="float:right; text-align: right; margin-right: 2px; font-size:14px;">
                                                                    @if ($user->reviews->avg('rating') < 0.5)
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                    @elseif($user->reviews->avg('rating') < 1)
                                                                        <span class="fa fa-star-half-alt"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                    @elseif($user->reviews->avg('rating') < 1.5)
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                    @elseif($user->reviews->avg('rating') < 2)
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star-half-alt"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                    @elseif($user->reviews->avg('rating') < 2.5)
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                    @elseif($user->reviews->avg('rating') < 3)
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star-half-alt"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                    @elseif($user->reviews->avg('rating') < 3.5)
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                    @elseif($user->reviews->avg('rating') < 4)
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star-half-alt"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"></span>
                                                                    @elseif($user->reviews->avg('rating') < 4.5)
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"></span>
                                                                    @elseif($user->reviews->avg('rating') < 5)
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star-half-alt"
                                                                            style="color:#da5c22;"></span>
                                                                    @else
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                        <span class="fa fa-star"
                                                                            style="color:#da5c22;"></span>
                                                                    @endif
                                                                    @if (isset($user->reviews))
                                                                        ({{ count($user->reviews) }})
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h3
                                                            style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap; width:100%;text-transform:capitalize;">
                                                            {{ $user->name }}</h3>
                                                        <span class="fa fa-map-marker-alt"
                                                            style=" float:left; margin-left:15px;"><b>
                                                                {{ $user->city ? $user->city->name : '' }}</b></span><br />
                                                        <div class="row" style="margin:0px;">
                                                            <div class="col-md-12 col-sm-12" style="padding:0px;">
                                                                <table class="table table-bordered"
                                                                    style="line-height:15px; margin:0px; font-size:14px;">
                                                                    <thead style="background:#da5c22; color:#fff;">
                                                                        <tr>
                                                                            <th scope="col" style="width:30px;">Sr</th>
                                                                            <th scope="col" style="text-align:left;">
                                                                                Name</th>
                                                                            <th scope="col" style="text-align:left;">
                                                                                Quality
                                                                            </th>
                                                                            <th scope="col" style="text-align:left;">
                                                                                Price</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody style="color:#000;">
                                                                        @if ($user->products->count() != 0)
                                                                            @php
                                                                                $products = $user->products->where('price', '>', 0);
                                                                            @endphp
                                                                            @foreach ($products as $index => $product)
                                                                                @if ($index < 3)
                                                                                    {{-- @else --}}
                                                                                    <tr>
                                                                                        <td scope="col"
                                                                                            style="text-align:left;">
                                                                                            <P class="size">
                                                                                                {{ $index + 1 }}</P>
                                                                                        </td>
                                                                                        <td scope="col"
                                                                                            style="text-align:left; overflow:hidden !important;">
                                                                                            <p class="cut-text size">
                                                                                                {{ $product->name }}</p>
                                                                                        </td>
                                                                                        <td scope="col"
                                                                                            style="text-align:left; overflow:hidden !important;">
                                                                                            <p class="cut-text size">
                                                                                                {{ $product->quality }}</p>
                                                                                        </td>
                                                                                        <td scope="col"
                                                                                            style="text-align:right;">
                                                                                            <P class="size">
                                                                                                {{ number_format($product->price) }}
                                                                                            </P>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif

                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </a>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->
        <!--<div class="row">-->
        <!--    <div class="col-lg-12">-->

        <!-- Modal -->

        <!--    </div>-->
        <!--    <div class="modal fade modal-fullscreen" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel"-->
        <!--         aria-hidden="true">-->
        <!--        <div class="modal-dialog">-->
        <!--            <div class="modal-content">-->
        <!--                <div class="modal-header">-->
        <!--                    <h5 class="modal-title" id="exampleModalLabel">Fine Bricks Company</h5>-->
        <!--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
        <!--                        <span aria-hidden="true">&times;</span>-->
        <!--                    </button>-->
        <!--                </div>-->
        <!--                <div class="modal-body">-->
        <!--                    <div class="row">-->
        <!--                        <div class="col-lg-8">-->
        <!--                            <img class="img-thumbnail" style="width:100%; height:600px;"-->
        <!--                                 src="{{ asset('asset/img/portfolio-1.jpg') }}"/>-->
        <!--                        </div>-->
        <!--                        <div class="col-lg-4" style="border-left:2px solid #aa9166;">-->
        <!--                            <div class="row">-->
        <!--                                <div class="col-lg-12">-->
        <!--                                    <h3>Product Name with Full Defination</h3>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                            <div class="row" style="margin-top:15px;">-->
        <!--                                <div class="col-lg-12">-->
        <!--                                    <div style="font-size:14px;">-->
        <!--                                        <span class="fa fa-star" style="color:#aa9166;"></span>-->
        <!--                                        <span class="fa fa-star" style="color:#aa9166;"></span>-->
        <!--                                        <span class="fa fa-star-half-alt" style="color:#aa9166;"></span>-->
        <!--                                        <span class="fa fa-star"></span>-->
        <!--                                        <span class="fa fa-star"></span>-->
        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                            <div class="row" style="margin-top:15px;">-->
        <!--                                <div class="col-lg-12">-->
        <!--                                    <span>Product Company: </span><b>Fine Bricks Company</b>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                            <div class="row" style="margin-top:15px;">-->
        <!--                                <div class="col-lg-12">-->
        <!--                                    <span>Product Quality: </span><b>Super High Quality</b>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                            <div class="row" style="margin-top:15px;">-->
        <!--                                <div class="col-lg-12">-->
        <!--                                    <span>Product Size: </span><b>9 x 4.5 x 3</b>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                            <div class="row" style="margin-top:15px;">-->
        <!--                                <div class="col-lg-12">-->
        <!--                                    <span class="badge"-->
        <!--                                          style="font-size:45px; background:#aa9166; color:#000; border-raduis:0px;">12500<i-->
        <!--                                                style="font-size:12px;">PKR</i></span>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                            <div class="row" style="margin-top:15px;">-->
        <!--                                <div class="col-lg-12">-->
        <!--                                    <b>Description:</b>-->
        <!--                                    <p style="font-style:justify;">The aspect ratio of an image describes the-->
        <!--                                        proportional relationship between its width and its height. Two common-->
        <!--                                        video aspect ratios are 4:3 (the universal video format of the 20th-->
        <!--                                        century), and 16:9 (universal for HD television and European digital-->
        <!--                                        television).-->
        <!--                                    <p>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="modal-footer">-->
        <!--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
    </div>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <h2>{{ $user->phone_no }}</h2>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('after-script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>
    <script>
        $(".alert").delay(100000).slideUp(300);
    </script>
    <script type="text/javascript">
        function fetchRecords(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'getViews/' + id,
                type: 'get',
                dataType: 'json',
                encode: true,
                success: function(response) {

                    var len = 0;
                    $('#Display').empty(); // Empty <tbody>
                    if (response['data'] != null) {

                        len = response['data'].length;

                    }

                    if (len > 0) {
                        for (var i = 0; i < len; i++) {
                            var id = response['data'][i].id;
                            var image = response['data'][i].image;
                            var name = response['data'][i].name;
                            var profession = response['data'][i].profession;
                            var rating = response['data'][i].rating;
                            var description = response['data'][i].description;
                            //  alert(image);
                            $("#imageBox").attr("src", "assets/images/blog/" + image);

                            //  alert(image);
                            var tr_str =
                                "<div class='col-md-4'>" +
                                "<div class='single-testi2'>" +
                                "<div class='upper-cont'>" +
                                "<div class='img-box'>" +
                                "<img  id='imageBox'>" +
                                "</div>" +
                                "<div class='cont-box'>" +
                                "<div class='review'>" +
                                "<span><i class='icofont-star'></i></span>" +
                                "<span><i class='icofont-star'></i></span>" +
                                "<span><i class='icofont-star'></i></span>" +
                                "<span><i class='icofont-star'></i></span>" +
                                "<span><i class='icofont-star'></i></span>" +
                                "</div>" +
                                "<h4>" + name + "</h4>" +
                                "<h6>" + profession + "</h6>" +
                                "</div>" +
                                "</div>" +
                                "<div class='lower-cont'>" +
                                "<p>" + description + "</p>" +
                                "</div>" +
                                "</div>" +
                                "</div>";
                            var tr_str = "<tr>" +
                                "<td align='center'>" + (i + 1) + "</td>" +
                                "<td align='center'>" + username + "</td>" +
                                "<td align='center'>" + name + "</td>" +
                                "<td align='center'>" + email + "</td>" +
                                "</tr>";

                            $("#Display").append(tr_str);
                        }
                    }

                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
                    // Search by userid
                    @foreach ($productcategory as $item)
                        $('#function{{ $item->id }}').click(function() {
                            alert('ok');
                            var userid = 2;

                            // fetchRecords(userid);

                        });
                    @endforeach

                    $('[data-toggle="collapse"]').click(function() {
                        $(this).toggleClass("active");
                        if ($(this).hasClass("active")) {
                            $(this).text("Hide");
                        } else {
                            $(this).text("Show");
                        }
                    });
    </script>
    // @Auth
        // $(document).ready(function() {
        // $('#display').hide();
        // $('#butsave').on('click', function(e) {
        // {{-- $.ajax({
//               url: "{{route('frontendUserphone',$user->id)}}",
//               headers: {
//                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                   },
//               type: "POST",
//               data: {
//                   _token : $('meta[name="csrf-token"]').attr('content'),
//                   user_id:{{Auth()->user()->id}},
//                   user_detail_id:{{$user->id}}
//               },
//               cache: false,
//               success: function(dataResult){
//                   console.log(dataResult);
//                   var dataResult = JSON.parse(dataResult);
//                   if(dataResult.statusCode==200){
//                     $('#display').show();			
//                   }
//                   else if(dataResult.statusCode==201){
//                      alert("Error occured !");
//                   }
                  
//               }
//           });
                
//                 }); --}}
        // $('#display').show();
        // });
    // @endauth
@endsection
