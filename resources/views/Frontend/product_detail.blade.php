@extends('layouts.frontend')
@section('style')
    <link rel="stylesheet" href="{{ asset('asset\css\tabs.css') }}">
    <style>
        .picZoomer {
            position: relative;
            /*margin-left: 40px;
                                                padding: 15px;*/
        }

        .picZoomer-pic-wp {
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .picZoomer-pic-wp:hover .picZoomer-cursor {
            display: block;
        }

        .picZoomer-zoom-pic {
            position: absolute;
            top: 0;
            left: 0;
        }

        .picZoomer-pic {
            /*width: 100%;
                                             height: 100%;*/
        }

        .picZoomer-zoom-wp {
            display: none;
            position: absolute;
            z-index: 999;
            overflow: hidden;
            border: 1px solid #eee;
            height: 460px;
            margin-top: -19px;
        }

        .picZoomer-cursor {
            display: none;
            cursor: crosshair;
            width: 100px;
            height: 100px;
            position: absolute;
            top: 0;
            left: 0;
            border-radius: 50%;
            border: 1px solid #eee;
            background-color: rgba(0, 0, 0, .1);
        }

        .picZoomCursor-ico {
            width: 23px;
            height: 23px;
            position: absolute;
            top: 40px;
            left: 40px;
            background: url(images/zoom-ico.png) left top no-repeat;
        }

        .my_img {
            vertical-align: middle;
            position: absolute;
            top: 0;
            bottom: 0;
            margin: auto;
            height: 100%;
        }

        .piclist li {
            display: inline-block;
            width: 90px;
            height: 114px;
            border: 1px solid #eee;
        }

        .piclist li img {
            width: 97%;
            height: auto;
        }

        /* custom style */
        .picZoomer-pic-wp,
        .picZoomer-zoom-wp {
            border: 1px solid #eee;
        }



        .section-bg {
            background-color: #fff1e0;
        }

        /* section {
                            padding: 60px 0;
                        } */

        .row-sm .col-md-6 {
            padding-left: 5px;
            padding-right: 5px;
        }

        /*===pic-Zoom===*/
        ._boxzoom .zoom-thumb {
            width: 90px;
            display: inline-block;
            vertical-align: top;
            margin-top: 0px;
        }

        ._boxzoom .zoom-thumb ul.piclist {
            padding-left: 0px;
            top: 0px;
        }

        ._boxzoom ._product-images {
            width: 80%;
            display: inline-block;
        }

        ._boxzoom ._product-images .picZoomer {
            width: 100%;
        }

        ._boxzoom ._product-images .picZoomer .picZoomer-pic-wp img {
            left: 0px;
        }

        ._boxzoom ._product-images .picZoomer img.my_img {
            width: 100%;
        }

        .piclist li img {
            height: 100px;
            object-fit: cover;
        }

        /*======products-details=====*/
        ._product-detail-content {
            background: #fff;
            padding: 15px;
            border: 1px solid lightgray;
        }

        ._product-detail-content p._p-name {
            color: black;
            font-size: 20px;
            border-bottom: 1px solid lightgray;
            padding-bottom: 12px;
        }

        .p-list span {
            margin-right: 15px;
        }

        .p-list span.price {
            font-size: 25px;
            color: #318234;
        }

        ._p-qty>span {
            color: black;
            margin-right: 15px;
            font-weight: 500;
        }

        ._p-qty .value-button {
            display: inline-flex;
            border: 0px solid #ddd;
            margin: 0px;
            width: 30px;
            height: 35px;
            justify-content: center;
            align-items: center;
            background: #da5c22;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            color: #fff;
        }

        ._p-qty .value-button {
            border: 0px solid #fe0000;
            height: 35px;
            font-size: 20px;
            font-weight: bold;
        }

        ._p-qty input#number {
            text-align: center;
            border: none;
            border-top: 1px solid #fe0000;
            border-bottom: 1px solid #fe0000;
            margin: 0px;
            width: 50px;
            height: 35px;
            font-size: 14px;
            box-sizing: border-box;
        }

        ._p-add-cart {
            margin-left: 0px;
            margin-bottom: 15px;
        }

        .p-list {
            margin-bottom: 10px;
        }

        ._p-features>span {
            display: block;
            font-size: 16px;
            color: #000;
            font-weight: 500;
        }

        ._p-add-cart .buy-btn {
            background-color: #da5c22;
            color: #fff;
        }

        ._p-add-cart .btn {
            text-transform: capitalize;
            padding: 6px 20px;
            /* width: 200px; */
            border-radius: 52px;
        }

        ._p-add-cart .btn {
            margin: 0px 8px;
        }

        /*=========Recent-post==========*/
        .title_bx h3.title {
            font-size: 22px;
            text-transform: capitalize;
            position: relative;
            color: #da5c22;
            font-weight: 700;
            line-height: 1.2em;
        }

        .title_bx h3.title:before {
            content: "";
            height: 2px;
            width: 20%;
            position: absolute;
            left: 0px;
            z-index: 1;
            top: 40px;
            background-color: #da5c22;
        }

        .title_bx h3.title:after {
            content: "";
            height: 2px;
            width: 100%;
            position: absolute;
            left: 0px;
            top: 40px;
            background-color: #ffc107;
        }

        .common_wd .owl-nav .owl-prev,
        .common_wd .owl-nav .owl-next {
            background-color: #da5c22 !important;
            display: block;
            height: 30px;
            width: 30px;
            text-align: center;
            border-radius: 0px !important;
        }

        .owl-nav .owl-next {
            right: -10px;
        }

        .owl-nav .owl-prev,
        .owl-nav .owl-next {
            top: 50%;
            position: absolute;
        }

        .common_wd .owl-nav .owl-prev i,
        .common_wd .owl-nav .owl-next i {
            color: #fff;
            font-size: 14px !important;
            position: relative;
            top: -1px;
        }

        .common_wd .owl-nav {
            position: absolute;
            top: -21%;
            right: 4px;
            width: 65px;
        }

        .owl-nav .owl-prev i,
        .owl-nav .owl-next i {
            left: 0px;
        }

        ._p-qty .decrease_ {
            position: relative;
            right: -5px;
            top: 3px;
        }

        ._p-qty .increase_ {
            position: relative;
            top: 3px;
            left: -5px;
        }

        /*========box========*/
        .sq_box {
            padding-bottom: 5px;
            border-bottom: solid 2px #da5c22;
            background-color: #fff;
            text-align: center;
            padding: 15px 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .item .sq_box span.wishlist {
            right: 5px !important;
        }

        .sq_box span.wishlist {
            position: absolute;
            top: 10px;
            right: 20px;
        }

        .sq_box span {
            font-size: 14px;
            font-weight: 600;
            margin: 0px 10px;
        }

        .sq_box span.wishlist i {
            color: #adb5bd;
            font-size: 20px;
        }

        .sq_box h4 {
            font-size: 18px;
            text-align: center;
            font-weight: 500;
            color: #343a40;
            margin-top: 10px;
            margin-bottom: 10px !important;
        }

        .sq_box .price-box {
            margin-bottom: 15px !important;
        }

        .sq_box .btn {
            border-radius: 50px;
            padding: 5px 13px;
            font-size: 15px;
            color: #fff;
            background-color: #da5c22;
            font-weight: 600;
        }

        .sq_box .price-box span.price {
            text-decoration: line-through;
            color: #6c757d;
        }

        .sq_box span {
            font-size: 14px;
            font-weight: 600;
            margin: 0px 10px;
        }

        .sq_box .price-box span.offer-price {
            color: #28a745;
        }

        .sq_box img {
            object-fit: cover;
            height: 150px !important;
            margin-top: 20px;
        }

        .sq_box span.wishlist i:hover {
            color: #da5c22;
        }

        /* Rating */
        .rating {
            margin-top: 20px;
            margin-left: -110px;
            border: none;
            float: left;
        }

        .rating>label {
            color: #90A0A3;
            float: right;
        }

        .rating>label:before {
            margin: 5px;
            font-size: 2em;
            font-family: FontAwesome;
            content: "\f005";
            display: inline-block;
        }

        .rating>input {
            display: none;
        }

        .rating>input:checked~label,
        .rating:not(:checked)>label:hover,
        .rating:not(:checked)>label:hover~label {
            color: #F79426;
        }

        .rating>input:checked+label:hover,
        .rating>input:checked~label:hover,
        .rating>label:hover~input:checked~label,
        .rating>input:checked~label:hover~label {
            color: #FECE31;
        }
    </style>
@endsection
@section('content')
    {{-- <div class="page-header" style="margin-bottom: 0px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 style="color:#fff;">Product Information</h2>
                </div>

            </div>
        </div>
    </div> --}}

    <section id="services" class="services">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11" style="margin-top:20px;">
                    <h3>Product Detail</h3>
                    <hr>
                    <div class="row row-sm">
                        <div class="col-md-6 _boxzoom">
                            <div class="zoom-thumb">
                                <ul class="piclist">
                                    <li><img src="{{ asset($product->image1) ?? 'https://s.fotorama.io/1.jpg' }}"
                                            alt=""></li>
                                    @if (isset($product->image2))
                                        <li><img src="{{ asset($product->image2) ?? 'https://s.fotorama.io/1.jpg' }}"
                                                alt=""></li>
                                    @endif
                                    @if (isset($product->image3))
                                        <li><img src="{{ asset($product->image3) ?? 'https://s.fotorama.io/1.jpg' }}"
                                                alt=""></li>
                                    @endif
                                    @if (isset($product->image4))
                                        <li><img src="{{ asset($product->image4) ?? 'https://s.fotorama.io/1.jpg' }}"
                                                alt=""></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="_product-images">
                                <div class="picZoomer">
                                    <img class="my_img" src="{{ asset($product->image1) ?? 'https://s.fotorama.io/1.jpg' }}"
                                        alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="_product-detail-content">
                                <h3 class="_p-name"> {{ $product->name ?? '' }} </h3>
                                <hr>
                                <div class="_p-price-box">
                                    <div class="p-list">
                                        {{-- <span> M.R.P. : <i class="fa fa-inr"></i> <del> 1399 </del> </span> --}}
                                        <h3 class="p_price" style="font-weight: bold; font-family: fantasy;"> Rs.
                                            {{ number_format($product->price ?? '0', 2) }} @if (isset($product->old_price))
                                                &nbsp;&nbsp;&nbsp;<small><del
                                                        style="color: #444444;">{{ number_format($product->old_price ?? '0', 2) }}</del></small>
                                            @endif
                                        </h3>
                                        <?php $rating = 0; ?>
                                        <?php if (count($comment) != 0) {
                                            $rating = $comment->sum('rate') / count($comment);
                                        } ?>
                                        @for ($i = 0; $i < round($rating); $i++)
                                            <span class="fa fa-star" style="color:#F79426; margin-right:0px;"></span>
                                        @endfor
                                        @for ($i = 0; $i < 5 - round($rating); $i++)
                                            <span class="fa fa-star" style="color:#b1a7a7; margin-right:0px;"></span>
                                        @endfor
                                        ({{ round($rating ?? '0') }})
                                        <br>
                                        <table>
                                            <tr>
                                                <td><b>Category:</b></td>
                                                <td>{{ $product->category_name->name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Brand:</b></td>
                                                <td>{{ $product->brand_name->name ?? '' }}</td>
                                            </tr>
                                        </table>
                                        {{-- <b>Category:</b><span> </span><br>
                                        <b>Brand:</b><span> {{ $product->brand_name->name ?? '' }}</span> --}}

                                    </div>

                                    <form action="{{ url('detail-to-cart') }}" method="post" accept-charset="utf-8">
                                        @csrf
                                        <div class="_p-add-cart">
                                            <div class="_p-qty">
                                                <b>Quantity</b>
                                                <div class="value-button decrease_" id="" value="Decrease Value">-
                                                </div>
                                                <input type="number" min="1" name="qty" id="number"
                                                    value="1" />
                                                <div class="value-button increase_" id="" value="Increase Value">+
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="_p-features">
                                            <b> Description About this Product:- </b>
                                            {{ $product->description ?? '' }}
                                        </div> --}}
                                        <ul class="spe_ul"></ul>
                                        <div class="_p-qty-and-cart">
                                            <div class="_p-add-cart">
                                                <button type="submit" name="add" value="buy"
                                                    class="btn-theme btn buy-btn" tabindex="0">
                                                    <i class="fa fa-shopping-cart"></i> Buy Now
                                                </button>
                                                <button type="submit" name="add" value="add"
                                                    class="btn-theme btn btn-success" tabindex="0">
                                                    <i class="fa fa-shopping-cart"></i> Add to Cart
                                                </button>
                                                <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                                <input type="hidden" name="price" value="{{ $product->price }}" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr style="margin-bottom: 0px;">
                            @if (Session('success'))
                                <div class="alert alert-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                    <strong>Success:</strong>&nbsp; {{ Session('success') }}
                                </div>
                            @endif
                            <div class="tabs effect-3">
                                <!-- tab-title -->
                                <input type="radio" id="tab-1" name="tab-effect-3" checked="checked">
                                <span>Description</span>

                                <input type="radio" id="tab-2" name="tab-effect-3">
                                <span>Review</span>

                                {{-- <input type="radio" id="tab-3" name="tab-effect-3">
                                <span>Book Mark</span>

                                <input type="radio" id="tab-4" name="tab-effect-3">
                                <span>Upload</span>

                                <input type="radio" id="tab-5" name="tab-effect-3">
                                <span>Settings</span> --}}

                                <div class="line ease"></div>

                                <!-- tab-content -->
                                <div class="tab-content">
                                    <section id="tab-item-1" style="padding: 0px;">
                                        <p>{!! $product->description ?? '' !!}</p>
                                    </section>
                                    <section id="tab-item-2" style="padding: 0px;">
                                        <div class="col-md-12">

                                            <form action="{{ route('comment.post') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <b style="float: left;">Post Comment:</b>
                                                <div class="rating">
                                                    <input type="radio" id="star5" name="rate" value="5"
                                                        checked />
                                                    <label class="star" for="star5" title="Awesome"
                                                        aria-hidden="true"></label>
                                                    <input type="radio" id="star4" name="rate"
                                                        value="4" />
                                                    <label class="star" for="star4" title="Great"
                                                        aria-hidden="true"></label>
                                                    <input type="radio" id="star3" name="rate"
                                                        value="3" />
                                                    <label class="star" for="star3" title="Very good"
                                                        aria-hidden="true"></label>
                                                    <input type="radio" id="star2" name="rate"
                                                        value="2" />
                                                    <label class="star" for="star2" title="Good"
                                                        aria-hidden="true"></label>
                                                    <input type="radio" id="star1" name="rate" value="1"
                                                        required />
                                                    <label class="star" for="star1" title="Bad"
                                                        aria-hidden="true"></label>
                                                </div>
                                                <input type="text" name="description" placeholder="Write here.."
                                                    class="form-control" id="" required>
                                                <br>
                                                <button class="btn btn-primary" type="submit">Post</button>
                                            </form>
                                            <hr>

                                        </div>
                                        <div class="col-md-12">
                                            @foreach ($comment as $item)
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <img src="{{ asset($item->user_name->image_url ?? 'userProfile/miDYaOzIIYrVsTTlnDek42Xp3VrLy5tfsQAulyXk.png') }}"
                                                            style="height: 85px; width:85px;
                                                    border-radius: 50%;
                                                    border: 2px solid #000;"
                                                            alt="">
                                                    </div>
                                                    <div class="col-md-7">
                                                        <b>{{ $item->user_name->name ?? '' }}</b><br>
                                                        <span>{{ $item->created_at->format('d M Y h:i A') }}</span> <br>
                                                        @for ($i = 0; $i < $item->rate; $i++)
                                                            <span class="fa fa-star" style="color:#F79426;"></span>
                                                        @endfor
                                                    </div>
                                                    <div class="col-md-12">
                                                        {{ $item->description ?? '' }}
                                                    </div>
                                                </div>
                                                <hr>
                                            @endforeach
                                        </div>
                                    </section>
                                    {{-- <section id="tab-item-3">
                                        <h1>Three</h1>
                                    </section>
                                    <section id="tab-item-4">
                                        <h1>Four</h1>
                                    </section>
                                    <section id="tab-item-5">
                                        <h1>Five</h1>
                                    </section> --}}
                                </div>
                            </div>

                            {{-- <b>Description:</b>
                            <p>{!! $product->description ?? '' !!}</p> --}}
                        </div>
                        {{-- <div class="col-md-12">
                            @if (Session('success'))
                                <div class="alert alert-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                    <strong>Success:</strong>&nbsp; {{ Session('success') }}
                                </div>
                            @endif
                            <hr>
                            <form action="{{ route('comment.post') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <b style="float: left;">Post Comment:</b>
                                <div class="rating">
                                    <input type="radio" id="star5" name="rate" value="5" checked />
                                    <label class="star" for="star5" title="Awesome" aria-hidden="true"></label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label class="star" for="star4" title="Great" aria-hidden="true"></label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label class="star" for="star3" title="Very good" aria-hidden="true"></label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label class="star" for="star2" title="Good" aria-hidden="true"></label>
                                    <input type="radio" id="star1" name="rate" value="1" required />
                                    <label class="star" for="star1" title="Bad" aria-hidden="true"></label>
                                </div>
                                <input type="text" name="description" placeholder="Write here.." class="form-control"
                                    id="" required>
                                <br>
                                <button class="btn btn-primary" type="submit">Post</button>
                            </form>
                            <hr>

                        </div>
                        <div class="col-md-12">
                            @foreach ($comment as $item)
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{ asset($item->user_name->image_url ?? 'userProfile/miDYaOzIIYrVsTTlnDek42Xp3VrLy5tfsQAulyXk.png') }}"
                                            style="height: 85px; width:85px;
                                    border-radius: 50%;
                                    border: 2px solid #000;"
                                            alt="">
                                    </div>
                                    <div class="col-md-7">
                                        <b>{{ $item->user_name->name ?? '' }}</b><br>
                                        <span>{{ $item->created_at->format('d M Y h:i A') }}</span> <br>
                                        @for ($i = 0; $i < $item->rate; $i++)
                                            <span class="fa fa-star" style="color:#F79426;"></span>
                                        @endfor
                                    </div>
                                    <div class="col-md-12">
                                        {{ $item->description ?? '' }}
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="sec bg-light">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <div class="row">
                        <div class="col-sm-12 title_bx" style="margin-top:10px;">
                            <h3 class="title"> Recent Products </h3>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-11">
                                <div class="row">
                                    <div class="MultiCarousel" data-items="1,3,5,4" data-slide="1" id="MultiCarousel"
                                        data-interval="1000">
                                        <div class="MultiCarousel-inner">
                                            <div class="row">
                                                <div class="MultiCarousel" data-items="1,3,5,4" data-slide="1"
                                                    id="MultiCarousel" data-interval="1000">
                                                    <div class="MultiCarousel-inner">
                                                        @foreach ($new as $item)
                                                            <div class="item">
                                                                <div class="pad15"
                                                                    style="padding: 0px; background:none;">
                                                                    <a href="{{ url('product-detail/' . $item->id) }}">
                                                                        <img src="{{ asset($item->image1 ?? 'asset/img/portfolio-1.jpg') }}"
                                                                            title=""
                                                                            style="width:100%; height:250px;" />
                                                                        <div style="margin-top:10px; text-align: left;">
                                                                            <b
                                                                                style="text-align:center; display: inline-block; font-size:14px;">
                                                                                {{ $item->name ?? '' }}</b><br>
                                                                            <hr style="margin: 0;">
                                                                            <span
                                                                                style="display: inline-block; font-size:14px;">
                                                                                Rs<b style="font-size:14px;">
                                                                                    {{ $item->price ?? '' }}</b>
                                                                                @if (isset($item->old_price))
                                                                                    <del
                                                                                        style="font-size:12px;">{{ $item->old_price ?? '' }}</del>
                                                                                @endif
                                                                            </span><br>
                                                                            <span
                                                                                style="text-align:left; display: inline-block; font-size:14px;">
                                                                                <?php $rating = 0; ?>
                                                                                <?php if (count($new_comment->where('product_id', $item->id)) != 0) {
                                                                                    $rating = $new_comment->where('product_id', $item->id)->sum('rate') / count($new_comment->where('product_id', $item->id));
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
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary leftLst">
                                            < </button>
                                                <button class="btn btn-primary rightLst">></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('after-script')
    <script>
        (function($) {
            $.fn.picZoomer = function(options) {
                var opts = $.extend({}, $.fn.picZoomer.defaults, options),
                    $this = this,
                    $picBD = $('<div class="picZoomer-pic-wp"></div>').css({
                        'width': opts.picWidth + 'px',
                        'height': opts.picHeight + 'px'
                    }).appendTo($this),
                    $pic = $this.children('img').addClass('picZoomer-pic').appendTo($picBD),
                    $cursor = $('<div class="picZoomer-cursor"><i class="f-is picZoomCursor-ico"></i></div>')
                    .appendTo($picBD),
                    cursorSizeHalf = {
                        w: $cursor.width() / 2,
                        h: $cursor.height() / 2
                    },
                    $zoomWP = $(
                        '<div class="picZoomer-zoom-wp"><img src="" alt="" class="picZoomer-zoom-pic"></div>')
                    .appendTo($this),
                    $zoomPic = $zoomWP.find('.picZoomer-zoom-pic'),
                    picBDOffset = {
                        x: $picBD.offset().left,
                        y: $picBD.offset().top
                    };


                opts.zoomWidth = opts.zoomWidth || opts.picWidth;
                opts.zoomHeight = opts.zoomHeight || opts.picHeight;
                var zoomWPSizeHalf = {
                    w: opts.zoomWidth / 2,
                    h: opts.zoomHeight / 2
                };

                //初始化zoom容器大小
                $zoomWP.css({
                    'width': opts.zoomWidth + 'px',
                    'height': opts.zoomHeight + 'px'
                });
                $zoomWP.css(opts.zoomerPosition || {
                    top: 0,
                    left: opts.picWidth + 30 + 'px'
                });
                //初始化zoom图片大小
                $zoomPic.css({
                    'width': opts.picWidth * opts.scale + 'px',
                    'height': opts.picHeight * opts.scale + 'px'
                });

                //初始化事件
                $picBD.on('mouseenter', function(event) {
                    $cursor.show();
                    $zoomWP.show();
                    $zoomPic.attr('src', $pic.attr('src'))
                }).on('mouseleave', function(event) {
                    $cursor.hide();
                    $zoomWP.hide();
                }).on('mousemove', function(event) {
                    var x = event.pageX - picBDOffset.x,
                        y = event.pageY - picBDOffset.y;

                    $cursor.css({
                        'left': x - cursorSizeHalf.w + 'px',
                        'top': y - cursorSizeHalf.h + 'px'
                    });
                    $zoomPic.css({
                        'left': -(x * opts.scale - zoomWPSizeHalf.w) + 'px',
                        'top': -(y * opts.scale - zoomWPSizeHalf.h) + 'px'
                    });

                });
                return $this;

            };
            $.fn.picZoomer.defaults = {
                picHeight: 460,
                scale: 2.5,
                zoomerPosition: {
                    top: '0',
                    left: '380px'
                },

                zoomWidth: 400,
                zoomHeight: 460
            };
        })(jQuery);



        $(document).ready(function() {
            $('.picZoomer').picZoomer();
            $('.piclist li').on('click', function(event) {
                var $pic = $(this).find('img');
                $('.picZoomer-pic').attr('src', $pic.attr('src'));
            });

            var owl = $('#recent_post');
            owl.owlCarousel({
                margin: 20,
                dots: false,
                nav: true,
                navText: [
                    "<i class='fa fa-chevron-left'></i>",
                    "<i class='fa fa-chevron-right'></i>"
                ],
                autoplay: true,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    },
                    1200: {
                        items: 4
                    }
                }
            });

            $('.decrease_').click(function() {
                decreaseValue(this);
            });
            $('.increase_').click(function() {
                increaseValue(this);
            });

            function increaseValue(_this) {
                var value = parseInt($(_this).siblings('input#number').val(), 10);
                value = isNaN(value) ? 0 : value;
                value++;
                $(_this).siblings('input#number').val(value);
            }

            function decreaseValue(_this) {
                var value = parseInt($(_this).siblings('input#number').val(), 10);
                value = isNaN(value) ? 0 : value;
                value < 1 ? value = 1 : '';
                value--;
                $(_this).siblings('input#number').val(value);
            }
        });
    </script>
@endsection
