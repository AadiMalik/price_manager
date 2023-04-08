@php
    use Carbon\Carbon;
@endphp
@extends('layouts.frontend')

@section('content')

    <!-- Service Start -->
    <div class="service">
        <div class="container">
            <div class="section-header">
                <h2>Supplier & Manufacturer</h2>
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
                                @foreach($users as $user)

                                    @if($user->products->where('price','>', 0)->count() > 0)
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <a href="{{route('frontendUserPackageDetail',$user)}}">
                                                <div class="service-item">
                                                    <div class="service-icon item">
                                                        @if($user->verify==1)
                                                        <span class="notify-badge" style="color:#fff; text-transform:capitalize;">Verified</span>
                                                        @endif
                                                        <img src="{{$user->image_url ? asset($user->image_url) : asset('asset/img/portfolio-1.jpg') }}"/>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                        <span class="badge"
                                                              style="background:#da5c22; color:#fff; float:left; margin-left:15px; font-size:14px; border-radius:0px; margin-top:23px;">{{isset($user->UserType->name)?$user->UserType->name:''}}</span><br>
                                                            <br/>
                                                            <div class="star-hidden"
                                                                 style="float:right; text-align: right; margin-right: 2px; font-size:14px;">
                                                                @if($user->reviews->avg('rating') < 0.5)
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
                                                                @if(isset($user->reviews))
                                                                    ({{count($user->reviews)}})
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h3 style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap; width:100%;text-transform:capitalize;">
                                                          {{$user->name?$user->name:''}}</h3>
                                                    <span class="fa fa-map-marker-alt"
                                                          style=" float:left; margin-left:15px;"><b> {{$user->city ? $user->city->name : ''}}</b></span>
                                                          @if ($user->f_expiry != null && $user->f_expiry >= Carbon::now()->format('Y-m-d'))
                                                            <span class="badge badge-success"
                                                                style="font-size: 14px; font-wieght:bold; float:right; margin-right:7px; border-radius:0px;">Featured</span>
                                                        @endif
                                                        <br/>
                                                    <div class="row" style="margin:0px;">
                                                        <div class="col-md-12 col-sm-12" style="padding:0px;">
                                                            <table class="table table-bordered"
                                                                   style="line-height:15px; margin:0px; font-size:14px;">
                                                                <thead style="background:#da5c22; color:#fff;">
                                                                <tr>
                                                                    <th scope="col" style="width:30px;">Sr</th>
                                                                    <th scope="col" style="text-align:left;">Name</th>
                                                                    <th scope="col" style="text-align:left;">Quality
                                                                    </th>
                                                                    <th scope="col" style="text-align:left;">Price</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody style="color:#000;">
                                                                @if($user->products->count() != 0)
                                                                    @php
                                                                        $products = $user->products->where('price','>',0);
                                                                    @endphp
                                                                    @foreach($products as $index => $product)
                                                                        @if($index < 3 )

                                                                            {{--@else--}}
                                                                            <tr>
                                                                                <td scope="col"
                                                                                    style="text-align:left;"><P class="size">{{$index+1}}</P></td>
                                                                                <td scope="col"
                                                                                    style="text-align:left; overflow:hidden !important;">
                                                                                    <p class="cut-text size">{{$product->name?$product->name:''}}</p></td>
                                                                                <td scope="col"
                                                                                    style="text-align:left; overflow:hidden !important;">
                                                                                    <p class="cut-text size">{{$product->quality?$product->quality:''}}</p></td>
                                                                                <td scope="col"
                                                                                    style="text-align:right;"><P class="size">{{number_format($product->price)}}</P></td>
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
                    <!--@if($users->count()>16)-->
                    <!--<div class="container">-->
                    <!--    <div class="row justify-content-center">-->
                    <!--        <div class="col-lg-2 col-lg-offset-5">-->
                    <!--            <a class="btn" id="loadcompany" href="{{route('frontendUser')}}">Load More</a>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--@endif-->
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

@endsection
