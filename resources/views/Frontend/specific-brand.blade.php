@extends('layouts.frontend')

@section('content')

    <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 style="color:#fff;">{{$siteContents[0]->where('id',8)->first()->content}}</h2>
                </div>

            </div>
        </div>
    </div>

    <div class="about">
        <div class="container">
            <div class="section-header">
                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$brand->name}}</font></font></h2>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <div class="row">
                        <h3></h3>
                        @foreach($users as $user)

                                    @if($user->products->where('price','>', 0)->count() > 0)
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <a href="{{route('frontendUserPackageDetail',$user)}}">
                                                <div class="service-item">
                                                    <div class="service-icon item">
                                                        <span class="notify-badge">{{$user->city ? $user->city->name : ''}}</span>
                                                        <img src="{{$user->image_url ? asset($user->image_url) : asset('asset/img/portfolio-1.jpg') }}"/>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                        <span class="badge"
                                                              style="background:#aa9166; color:#000; float:left; margin-left:15px; font-size:14px; border-radius:0px; margin-top:23px;">{{$user->userRating ? $user->userRating->rating_name : 'Gold'}}</span><br>
                                                            <div class="star-hidden"
                                                                 style="float:right; margin-right:10px; font-size:14px;">
                                                                @if($user->reviews->avg('rating') < 0.5)
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                @elseif($user->reviews->avg('rating') < 1)
                                                                    <span class="fa fa-star-half-alt"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                @elseif($user->reviews->avg('rating') < 1.5)
                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>

                                                                @elseif($user->reviews->avg('rating') < 2)

                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star-half-alt"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>

                                                                @elseif($user->reviews->avg('rating') < 2.5)

                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>

                                                                @elseif($user->reviews->avg('rating') < 3)

                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star-half-alt"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>

                                                                @elseif($user->reviews->avg('rating') < 3.5)

                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>

                                                                @elseif($user->reviews->avg('rating') < 4)

                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star-half-alt"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"></span>

                                                                @elseif($user->reviews->avg('rating') < 4.5)

                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"></span>
                                                                @elseif($user->reviews->avg('rating') < 5)

                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star-half-alt"
                                                                          style="color:#aa9166;"></span>
                                                                @else

                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>

                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h3>{{$user->name}}</h3>
                                                    <span class="fa fa-map-marker-alt"
                                                          style=" float:left; margin-left:15px;"><b> {{$user->city ? $user->city->name : ''}}</b></span><br/>
                                                    <div class="row" style="margin:0px;">
                                                        <div class="col-md-12 col-sm-12" style="padding:0px;">
                                                            <table class="table table-bordered"
                                                                   style="line-height:15px; margin:0px; font-size:14px;">
                                                                <thead style="background:#aa9166; color:#000;">
                                                                <tr>
                                                                    <th scope="col" style="width:50px;">Sr</th>
                                                                    <th scope="col" style="text-align:left;">Name</th>
                                                                    <th scope="col" style="text-align:left;">Quality
                                                                    </th>
                                                                    <th scope="col" style="text-align:left;">Price</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody style="color:#aa9166;">
                                                                @if($user->products->count() != 0)
                                                                    @php
                                                                        $products = $user->products->where('price','>',0);
                                                                    @endphp
                                                                    @foreach($products as $index => $product)
                                                                        @if($index < 3 )

                                                                            {{--@else--}}
                                                                            <tr>
                                                                                <td scope="col"
                                                                                    style="text-align:left;">{{$index+1}}</td>
                                                                                <td scope="col"
                                                                                    style="text-align:left; font-size:14px; overflow:hidden !important;">
                                                                                    <p class="cut-text" style="font-size: 14px; padding: 0px;color: #aa9166;">{{$product->name}}</p></td>
                                                                                <td scope="col"
                                                                                    style="text-align:left; font-size:14px; overflow:hidden !important;"><p class="cut-text" style="font-size: 14px; padding: 0px;color: #aa9166;">{{$product->quality}}</p></td>
                                                                                <td scope="col"
                                                                                    style="text-align:right;">{{$product->price}}</td>
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


@endsection
