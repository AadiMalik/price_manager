@php
    use Carbon\Carbon;
@endphp
@extends('layouts.frontend')

@section('content')
    <!-- Carousel Start -->
    <div id="carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel" data-slide-to="0" class="active"></li>
            <li data-target="#carousel" data-slide-to="1"></li>
            <li data-target="#carousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            @foreach ($siteContents[0]->where('id', 35)->orWhere('id', 37)->orWhere('id', 38)->orWhere('id', 39)->orWhere('id', 40)->get() as $index => $image)
                <div class="carousel-item {{ $image->id == 35 ? 'active' : '' }}">
                    <img src="{{ asset($image->content) }}" alt="Carousel Image">
                    <div class="carousel-caption">
                        {{-- <h1 class="animated fadeInLeft">{{$image->heading_name}}</h1>
                        <p class="animated fadeInRight">{{$image->page}}</p> --}}
                        {{-- <a class="btn animated fadeInUp" href="#">Get free consultation</a> --}}
                    </div>
                </div>
            @endforeach

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
    <!-- Top Feature End-->


    <!-- About Start -->
    <div class="about">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11">

                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-6">
                            <div class="about-img" style="background:none;">
                                <img class="img-zoom" src="{{ asset('asset/img/about_us.png') }}" alt="Image">
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6">
                            <div class="section-header" style="text-align:left;">
                                <h2>About Us</h2>
                            </div>
                            <div class="about-text">

                                <p>
                                    {!! nl2br(e($siteContents[0]->where('id', 41)->first()->content)) !!}
                                </p>
                                <a class="btn" href="{{ route('frontendAbout') }}">Load More</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    <!-- Search section-->
    <div class="container">
        <div class="section-header">
            <h3>{{ $siteContents[0]->where('id', 3)->first()->content }}</h3>
        </div>
    </div>
    <div class="container">

        <div class="row">
            <table style="width:100%;">
                <tr>
                    <td>
                        <label>Select {{ $siteContents[0]->where('id', 5)->first()->content }}</label>
                    </td>

                    <td>
                        <label>Select {{ $siteContents[0]->where('id', 7)->first()->content }}</label>
                    </td>
                    <td>
                        <label>Select {{ $siteContents[0]->where('id', 6)->first()->content }}</label>
                    </td>
                </tr>
                {{-- <tr>
                        <td style="width:25%;">
                    <input class="form-control" style="width:100%;border-bottom: 2px solid #da5c22; border-top: none; border-left: none; border-right: none; border-radius: 0px;" name="user_type" placeholder="Enter Product Name.." id="user_type">
                        
                    </td> --}}
                <td style="width:25%;">
                    <select class="js-example-basic-single form-control" style="width:100%;" name="user_type"
                        id="user_type">
                        <option value="all">All</option>
                        @foreach ($category as $index => $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </td>

                <td style="width:25%;">
                    <select class="js-example-basic-single form-control" style="width:100%;" name="industry"
                        id="industry">
                        <option value="all">All</option>
                        @foreach ($industries as $index => $industry)
                            <option value="{{ $industry->id }}">{{ $industry->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td style="width:25%;">
                    <select class="js-example-basic-single form-control" style="width:100%;" name="city"
                        id="city">
                        <option value="all">All</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </td>


                <td style="width:25%;">
                    <button type="submit" onclick="SearchUser()" class="remarks-btn form-control"><span
                            class="fa fa-search"></span> Search
                    </button>
                </td>
                </tr>

            </table>
        </div>

    </div>
    <!-- end Search section-->
    <!-- Service Start -->
    <div class="service">
        <div class="container">
            <div class="section-header">
                <h2>Verified Supplier & Manufacturer</h2>
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
                                @if ($users->count() > 0)
                                    @foreach ($users->where('verify', 1)->take(8) as $user)
                                        @if ($user->products->where('price', '>', 0)->count() > 0)
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <a href="{{ route('frontendUserPackageDetail', $user) }}">
                                                    <div class="service-item">
                                                        <div class="service-icon item">
                                                            {{-- <span class="notify-badge"
                                                                style="color:#fff; text-transform:capitalize;">{{ $user->city ? $user->city->name : '' }}</span> --}}
                                                            <span class="notify-badge"
                                                                style="color:#fff; text-transform:capitalize;">Verified</span>
                                                            <img
                                                                src="{{ $user->image_url ? asset($user->image_url) : asset('asset/img/portfolio-1.jpg') }}" />
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <span class="badge"
                                                                    style="background:#da5c22; color:#fff; float:left; margin-left:15px; font-size:14px; border-radius:0px; margin-top:23px;">{{ $user->UserType->name ?? '' }}</span><br>
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
                                                            {{ $user->name }}
                                                        </h3>
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
                                @else
                                    <div class="col-md-12">
                                        <b>No Found!</b>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                    @if ($users->where('verify', 1)->count() > 8)
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-2 col-lg-offset-5">
                                    <a class="btn" id="loadcompany" href="{{ route('frontendUser') }}">Load More</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
    {{-- featured companies --}}
    <div class="service">
        <div class="container">
            <div class="section-header">
                <h2>Featured Supplier & Manufacturer</h2>
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
                                @if (count($users->where('f_expiry', '>', Carbon::now()->format('Y-m-d'))) > 0)
                                    @foreach ($users->where('f_expiry', '>', Carbon::now()->format('Y-m-d'))->take(8) as $user)
                                        @if ($user->products->where('price', '>', 0)->count() > 0)
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <a href="{{ route('frontendUserPackageDetail', $user) }}">
                                                    <div class="service-item">
                                                        <div class="service-icon item">
                                                            {{-- <span class="notify-badge"
                                                                style="color:#fff; text-transform:capitalize;">{{ $user->city ? $user->city->name : '' }}</span> --}}
                                                            <img
                                                                src="{{ $user->image_url ? asset($user->image_url) : asset('asset/img/portfolio-1.jpg') }}" />
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <span class="badge"
                                                                    style="background:#da5c22; color:#fff; float:left; margin-left:15px; font-size:14px; border-radius:0px; margin-top:23px;">{{ $user->UserType->name ?? '' }}</span><br>
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
                                                            {{ $user->name }}
                                                        </h3>
                                                        <span class="fa fa-map-marker-alt"
                                                            style=" float:left; margin-left:15px;"><b>
                                                                {{ $user->city ? $user->city->name : '' }}</b></span>
                                                        <span class="badge badge-success"
                                                            style="font-size: 14px; font-wieght:bold; float:right; margin-right:7px; border-radius:0px;">Featured</span><br />
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
                                @else
                                    <div class="col-md-12">
                                        <b>No Found!</b>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                    @if (count($users->where('f_expiry', '>=', Carbon::now())) > 8)
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-2 col-lg-offset-5">
                                    <a class="btn" id="loadcompany" href="{{ route('frontendUser') }}">Load More</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- End featured company --}}
    {{-- featured companies --}}
    <div class="service">
        <div class="container">
            <div class="section-header">
                <h2>New Arrival</h2>
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
                                @if ($users->where('verify', 0)->where('f_expiry', '<', Carbon::now()->format('Y-m-d') || 'f_expiry', '=', null)->count() > 0)
                                    @foreach ($users->where('verify', 0)->where('f_expiry', '<', Carbon::now()->format('Y-m-d') || 'f_expiry', '=', null)->take(8) as $user)
                                        @if ($user->products->where('price', '>', 0)->count() > 0)
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <a href="{{ route('frontendUserPackageDetail', $user) }}">
                                                    <div class="service-item">
                                                        <div class="service-icon item">
                                                            {{-- <span class="notify-badge"
                                                                style="color:#fff; text-transform:capitalize;">{{ $user->city ? $user->city->name : '' }}</span> --}}
                                                            <img
                                                                src="{{ $user->image_url ? asset($user->image_url) : asset('asset/img/portfolio-1.jpg') }}" />
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <span class="badge"
                                                                    style="background:#da5c22; color:#fff; float:left; margin-left:15px; font-size:14px; border-radius:0px; margin-top:23px;">{{ $user->UserType->name ?? '' }}</span><br>
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
                                                            {{ $user->name }}
                                                        </h3>
                                                        <span class="fa fa-map-marker-alt"
                                                            style=" float:left; margin-left:15px;"><b>
                                                                {{ $user->city ? $user->city->name : '' }}</b></span>
                                                        @if ($user->f_expiry != null && $user->f_expiry >= Carbon::now()->format('Y-m-d'))
                                                            <span class="badge badge-success"
                                                                style="font-size: 14px; font-wieght:bold; float:right; margin-right:7px; border-radius:0px;">Featured</span>
                                                        @endif
                                                        <br />
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
                                @else
                                    <div class="col-md-12">
                                        <b>No Found!</b>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                    @if ($users->where('verify', 0)->where('f_expiry', '<', Carbon::now()->format('Y-m-d') || 'f_expiry', '=', null)->count() > 8)
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-2 col-lg-offset-5">
                                    <a class="btn" id="loadcompany" href="{{ route('frontendUser') }}">Load More</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- End featured company --}}
    <!-- Popular Brand Start -->
    <div class="container" style="margin-top:20px;">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header">
                    <h2>Our Products</h2>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                @foreach ($category as $item1)
                    @if ($e_product->where('category_id', $item1->id)->count() > 0)
                        <h4>{{ ucwords($item1->name ?? '') }}</h4>
                        <hr>
                        <div class="row">
                            <div class="MultiCarousel" data-items="1,3,5,4" data-slide="1" id="MultiCarousel"
                                data-interval="1000">
                                <div class="MultiCarousel-inner">
                                    @foreach ($e_product->where('category_id', $item1->id) as $item)
                                        <div class="item">
                                            <div class="pad15">
                                                <a href="{{ url('product-detail/' . $item->id) }}">
                                                    <img src="{{ asset($item->image1 ?? 'asset/img/portfolio-1.jpg') }}"
                                                        title="" style="width:100%; height:250px;" />
                                                    <div>
                                                        <b
                                                            style="text-align:center; display: inline-block; font-size:14px;">
                                                            {{ $item->name ?? '' }}</b><br>
                                                        <hr style="margin: 0;">
                                                        <span style="display: inline-block; font-size:14px;">
                                                            Rs<b style="font-size:14px;"> {{ $item->price ?? '' }}</b>
                                                            @if (isset($item->old_price))
                                                                <del
                                                                    style="font-size:12px;">{{ $item->old_price ?? '' }}</del>
                                                            @endif
                                                        </span><br>
                                                        <span
                                                            style="text-align:left; display: inline-block; font-size:14px;">
                                                            <?php $rating = 0; ?>
                                                            <?php if (count($comment->where('product_id',$item->id)) != 0) {
                                                                $rating = $comment->where('product_id',$item->id)->sum('rate') / count($comment->where('product_id',$item->id));
                                                            } ?>
                                                            @for ($i = 0; $i < round($rating); $i++)
                                                                <span class="fa fa-star"
                                                                    style="color:#F79426; margin-right:0px;"></span>
                                                            @endfor
                                                            @for ($i = 0; $i < 5 - round($rating); $i++)
                                                                <span class="fa fa-star"
                                                                    style="color:#b1a7a7; margin-right:0px;"></span>
                                                            @endfor
                                                            ({{ round($rating ?? '0') }})
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button class="btn btn-primary leftLst">
                                    < </button>
                                        <button class="btn btn-primary rightLst">></button>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- Popular Brand Start -->
    <div class="container" style="margin-top:20px;">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header">
                    <h2>{{ $siteContents[0]->where('id', 1)->first()->content }}</h2>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="row">
                    <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"
                        data-interval="1000">
                        <div class="MultiCarousel-inner">
                            @foreach ($users as $user)
                                @if ($user->products->where('price', '>', 0)->count() > 0 && $user->brand_id)
                                    <div class="item">
                                        <div class="pad15">
                                            <a href="{{ route('frontendUserPackageDetail', $user->id) }}">
                                                <img src="{{ $user->image_url ? asset($user->image_url) : asset('asset/img/portfolio-1.jpg') }}"
                                                    title="{{ $user->image_title }}" style="width:100%; height:200px;" />
                                                <div>
                                                    <span
                                                        style="text-align:left; display: inline-block; font-size:14px;">{{ $user->name }}</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                        <button class="btn btn-primary leftLst">
                            < </button>
                                <button class="btn btn-primary rightLst">></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->
    <div class="service">
        <div class="container">
            <div class="section-header">
                <h2>New Companies</h2>
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
                                @foreach ($new->take(8) as $user)
                                    @if ($user->created_at->addDays(6) >= now())
                                        @if ($user->products->where('price', '>', 0)->count() > 0)
                                            @if ($user->reviews->avg('rating') < 1)
                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                    <a href="{{ route('frontendUserPackageDetail', $user) }}">
                                                        <div class="service-item">
                                                            <div class="service-icon item">
                                                                <span class="notify-badge"
                                                                    style="color:#fff; text-transform:capitalize;">{{ $user->city ? $user->city->name : '' }}</span>
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
                                                                                <th scope="col" style="width:30px;">Sr
                                                                                </th>
                                                                                <th scope="col"
                                                                                    style="text-align:left;">Name</th>
                                                                                <th scope="col"
                                                                                    style="text-align:left;">Quality
                                                                                </th>
                                                                                <th scope="col"
                                                                                    style="text-align:left;">Price</th>
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
                                                                                                    {{ $product->name }}
                                                                                                </p>
                                                                                            </td>
                                                                                            <td scope="col"
                                                                                                style="text-align:left; overflow:hidden !important;">
                                                                                                <p class="cut-text size">
                                                                                                    {{ $product->quality }}
                                                                                                </p>
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
                                        @endif
                                    @elseif($loop->first)
                                        <div class="col-md-12" style="text-align:center;">
                                            <span style="font-size:18px;">No New Company</span>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>

                    </div>
                    {{-- @if ($new->count() > 8)
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-2 col-lg-offset-5">
                                <a class="btn" href="{{route('frontendUser')}}">Load More</a>
                            </div>
                        </div>
                    </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
    <!-- Review Section Start -->
    <div class="testimonial">
        <div class="container">
            <div class="section-header">
                <h2>Review From Client</h2>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="owl-carousel testimonials-carousel">
                        @foreach ($reviews as $review)
                            <div class="testimonial-item">
                                <i class="fa fa-quote-right"></i>
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <img src="{{ asset($review->image_url) }}" alt="" style="height:70px">
                                    </div>
                                    <div class="col-9">
                                        <h2>{{ $review->name }}</h2>
                                        <p>{{ $review->type }}</p>
                                    </div>
                                    <div class="col-12">
                                        <p>
                                            {{ $review->description }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach()

                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Blog Start -->
    <div class="blog">
        <div class="container">
            <div class="section-header">
                <h2>Construction Help</h2>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center" style="margin-bottom:30px;">
                <div class="col-lg-11">
                    <div class="row">
                        @foreach ($constructorVideos as $constructorVideo)
                            <div class="col-lg-4" style="margin-bottom:10px;">
                                <iframe class="img-thumbnail" style="height:300px; width:100%;"
                                    src="{{ $constructorVideo->video_url }}" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen=""></iframe>
                                <h6 class="caption">{{ $constructorVideo->video_name }} </h6>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->
    <div class="newsletter">
        <div class="container">
            <div class="section-header">
                <h2>Subscribe Our Newsletter</h2>
            </div>
            <div class="form">

                <form action="{{ route('storeSubscribe') }}" method="POST" id="Subscribe">
                    @csrf
                    <input type="email" class="form-control" name="email" id="email"
                        value="{{ old('email') }}" required="required" placeholder="Email here">

                    <button class="btn" id="save">Submit</button>
                    {!! $errors->first('email', "<span class='text-dark'>:message</span>") !!}
                </form>
            </div>
        </div>
    </div>
@endsection


@section('after-script')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

        function SearchUser(e) {

            let data = {
                city: jQuery('#city').val(),
                industry: jQuery('#industry').val(),
                user_type: jQuery('#user_type').val(),
            }
            // console.log(data)
            // alert(data)

            $.ajax({
                type: 'get',
                url: 'user-search',
                data: data,
                success: function(response) {
                    $('#userData').remove();
                    $('#userSearch').empty();
                    $('.remove').remove();
                    if (response.status == 1) {
                        var html = '';
                        let notFound = true;

                        $.each(response.data, function(value, index) {

                            var productData = '';
                            var url = '{{ url('/package') }}';
                            var productURL = url + '/' + index.id;
                            var URL = '{{ url('/') }}';
                            let productLength = index.products.length;

                            var imageUrl = URL;
                            var imageUrl = index.image_url != null ? index.image_url :
                                'asset/img/portfolio-1.jpg';
                            // var image = index.products[0] == 'undefined' ? index.products[0].image_url : index.image_url;
                            if (productLength > 0) {
                                let userRating = index.user_type ? index.user_type.name : 'Importer';
                                console.log(index)
                                let countReview = 0;
                                let totalReview = 0;
                                $.each(index.reviews, function(value, index) {
                                    countReview += parseFloat(index.rating);
                                    totalReview = value + 1;
                                })
                                let rating = countReview / totalReview;
                                console.log(rating)
                                let RatingDisplay = '';
                                if (isNaN(rating) || rating < 0.5) {
                                    RatingDisplay +=
                                        '<span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>'
                                } else if (rating < 1) {
                                    RatingDisplay +=
                                        '<span class="fa fa-star-half-alt" style="color:#da5c22;"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>'
                                } else if (rating < 1.5) {
                                    RatingDisplay +=
                                        '<span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>'
                                } else if (rating < 2) {
                                    RatingDisplay +=
                                        '<span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star-half-alt" style="color:#da5c22;"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>'
                                } else if (rating < 2.5) {
                                    RatingDisplay +=
                                        '<span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>'
                                } else if (rating < 3) {
                                    RatingDisplay +=
                                        '<span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star-half-alt" style="color:#da5c22;"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>'
                                } else if (rating < 3.5) {
                                    RatingDisplay +=
                                        '<span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>'
                                } else if (rating < 4) {
                                    RatingDisplay +=
                                        '<span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star-half-alt" style="color:#da5c22;"></span><span class="fa fa-star"></span>'
                                } else if (rating < 4.5) {
                                    RatingDisplay +=
                                        '<span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star"></span>'
                                } else if (rating < 5) {
                                    RatingDisplay +=
                                        '<span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star" style="color:#da5c22;"><span class="fa fa-star-half-alt" style="color:#da5c22;"></span>'
                                } else {
                                    RatingDisplay +=
                                        '<span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star" style="color:#da5c22;"></span><span class="fa fa-star" style="color:#da5c22;"><span class="fa fa-star" style="color:#da5c22;">'

                                }

                                let cityName = index.city ? index.city.name : '';

                                html += '<div class="col-lg-3 col-md-6 col-sm-12 remove"> \n' +
                                    '                                        <a href="' + productURL +
                                    '">\n' +
                                    '                                            <div class="service-item" style="height: 485px;">\n' +
                                    '                                                <div class="service-icon item">\n' +
                                    '                                                    <span class="notify-badge">' +
                                    cityName + '</span>\n' +
                                    '                                                    <img src="' +
                                    imageUrl + '" />\n' +
                                    '                                                </div>\n' +
                                    '                                                <div class="row">\n' +
                                    '                                                    <div class="col-lg-12">\n' +
                                    '                                                        <span class="badge"\n' +
                                    '                                                              style="background:#da5c22; color:#000; float:left; margin-left:15px; font-size:14px; border-radius:0px; margin-top:23px;">' +
                                    userRating + '</span><br>\n' +
                                    '                                                        <div class="star-hidden"\n' +
                                    '                                                             style="float:right; margin-right:10px; font-size:14px;"> ' +
                                    RatingDisplay + ' (' + totalReview + ')\n' +
                                    '                                                        </div>\n' +
                                    '                                                    </div>\n' +
                                    '                                                </div>\n' +
                                    '                                                <h3 style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap; width:100%;text-transform:capitalize;">' +
                                    index.name + '</h3>\n' +
                                    '                                                <span class="fa fa-map-marker-alt"\n' +
                                    '                                                      style=" float:left; margin-left:15px;"><b>' +
                                    cityName + ' </b></span><br/>\n' +
                                    '                                                <div class="row" style="margin:0px;">\n' +
                                    '                                                    <div class="col-md-12 col-sm-12" style="padding:0px;"> \n' +
                                    '                                                        <table  class="table table-bordered" id="userTable-' +
                                    index.id + '"\n' +
                                    '                                                               style="line-height:15px; margin:0px; font-size:14px;">\n' +
                                    '                                                            <thead style="background:#da5c22; color:#fff;">\n' +
                                    '                                                            <tr>\n' +
                                    '                                                                <th scope="col" style="width:50px;">Sr</th>\n' +
                                    '                                                                <th scope="col" style="text-align:left;">Name</th>\n' +
                                    '                                                                <th scope="col" style="text-align:left;">Quality</th>\n' +
                                    '                                                                <th scope="col" style="text-align:left;">Price</th>\n' +
                                    '                                                            </tr>\n' +
                                    '                                                            </thead>\n' +
                                    '                                                        </table>\n' +
                                    '                                                    </div>\n' +
                                    '                                                </div>\n' +
                                    '                                            </div>\n' +
                                    '                                        </a>\n' +
                                    '                                    </div>';
                                setTimeout(function() {

                                    productData += '<tbody>'
                                    $.each(index.products, function(index, product) {
                                        if (product.price == 0) {

                                        } else if (index < 3) {
                                            productData +=
                                                '<tr><td scope="col" style="text-align:left;"><p class="size">' +
                                                (index + 1) +
                                                '</p></td><td scope="col" style="text-align:left; overflow:hidden !important;"> <p class="cut-text size">' +
                                                product.name +
                                                '</p></td><td scope="col" style="text-align:left; font-size:14px; overflow:hidden !important;"><p class="cut-text size">' +
                                                product.quality +
                                                '</p></td><td scope="col" style="text-align:right;"><p class="size">' +
                                                product.price + '</p></td></tr>'
                                        }
                                    })
                                    productData += '</tbody>'
                                    var tbodyId = '#userTable-' + index.id;

                                    $(tbodyId).append(productData);

                                }, 500);
                                notFound = false;

                            }
                        })

                        if (notFound == true) {
                            html += '<h3>Not Found</h3>';
                        }

                        $("#userSearch").append(html);


                    }
                }
            });
        }
    </script>
@endsection
