@extends('layouts.frontend')
@section('style')
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

        section {
            padding: 60px 0;
        }

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
    </style>
@endsection
@section('content')
    <div class="page-header" style="margin-bottom: 0px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 style="color:#fff;">Product Information</h2>
                </div>

            </div>
        </div>
    </div>
    <section id="services" class="services section-bg">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11">
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
                                <p class="_p-name"> {{ $product->name ?? '' }} </p>
                                <div class="_p-price-box">
                                    <div class="p-list">
                                        {{-- <span> M.R.P. : <i class="fa fa-inr"></i> <del> 1399 </del> </span> --}}
                                        <h3 class="p_price" style="font-weight: bold; font-family: fantasy;"> Rs.
                                            {{ number_format($product->price ?? '0', 2) }} </h3>
                                        <b>Category:</b><span> {{ $product->category_name->name ?? '' }}</span>
                                        <b>Brand:</b><span> {{ $product->brand_name->name ?? '' }}</span>
                                    </div>

                                    <form action="{{ url('add-to-cart') }}" method="post" accept-charset="utf-8">
                                        @csrf
                                        <div class="_p-add-cart">
                                            <div class="_p-qty">
                                                <b>Add Quantity</b>
                                                <div class="value-button decrease_" id="" value="Decrease Value">-
                                                </div>
                                                <input type="number" name="qty" id="number" value="1" />
                                                <div class="value-button increase_" id="" value="Increase Value">+
                                                </div>
                                            </div>
                                        </div>
                                        <div class="_p-features">
                                            <b> Description About this Product:- </b>
                                            {{ $product->description ?? '' }}
                                        </div>
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
                        <div class="col-sm-12 title_bx">
                            <h3 class="title"> Recent Products </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 list-slider mt-4">
                            <div class="owl-carousel common_wd  owl-theme" id="recent_post">
                                @foreach ($new as $item)
                                    <div class="item">
                                        <div class="sq_box shadow">
                                            <div class="pdis_img">
                                                {{-- <span class="wishlist">
                                                <a alt="Add to Wish List" title="Add to Wish List"
                                                    href="javascript:void(0);"> <i class="fa fa-heart"></i></a>
                                            </span> --}}
                                                <a href="{{ url('product-detail/' . $item->id) }}">
                                                    <img
                                                        src="{{ asset($item->image1 ?? 'https://ucarecdn.com/05f649bf-b70b-4cf8-90f7-2588ce404a08/-/resize/680x/') }}">
                                                </a>
                                            </div>
                                            <h4 class="mb-1"> <a href="{{ url('product-detail/' . $item->id) }}">
                                                    {{ $item->name ?? '' }} </a> </h4>
                                            <div class="price-box mb-2">
                                                {{-- <span class="price"> Price <i class="fa fa-inr"></i> 200 </span> --}}
                                                <span class="offer-price"><i class="fa fa-inr"></i>Rs.
                                                    {{ number_format($item->price ?? '0', 2) }} </span>
                                            </div>
                                            {{-- <div class="btn-box text-center">
                                            <a class="btn btn-sm" href="javascript:void(0);"> <i
                                                    class="fa fa-shopping-cart"></i> Add to Cart </a>
                                        </div> --}}
                                        </div>
                                    </div>
                                @endforeach
                                {{-- <div class="item">
                                    <div class="sq_box shadow">
                                        <div class="pdis_img">
                                            <span class="wishlist">
                                                <a alt="Add to Wish List" title="Add to Wish List"
                                                    href="javascript:void(0);"> <i class="fa fa-heart"></i></a>
                                            </span>
                                            <a href="#">
                                                <img
                                                    src="https://ucarecdn.com/05f649bf-b70b-4cf8-90f7-2588ce404a08/-/resize/680x/">
                                            </a>
                                        </div>
                                        <h4 class="mb-1"> <a href="details.php"> Milton Bottle </a> </h4>
                                        <div class="price-box mb-2">
                                            <span class="price"> Price <i class="fa fa-inr"></i> 200 </span>
                                            <span class="offer-price"> Offer Price <i class="fa fa-inr"></i> 120 </span>
                                        </div>
                                        <div class="btn-box text-center">
                                            <a class="btn btn-sm" href="javascript:void(0);"> <i
                                                    class="fa fa-shopping-cart"></i> Add to Cart </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="sq_box shadow">
                                        <div class="pdis_img">
                                            <span class="wishlist">
                                                <a alt="Add to Wish List" title="Add to Wish List"
                                                    href="javascript:void(0);"> <i class="fa fa-heart"></i></a>
                                            </span>
                                            <a href="#">
                                                <img
                                                    src="https://ucarecdn.com/05f649bf-b70b-4cf8-90f7-2588ce404a08/-/resize/680x/">
                                            </a>
                                        </div>
                                        <h4 class="mb-1"> <a href="#"> Milton Bottle </a> </h4>
                                        <div class="price-box mb-2">
                                            <span class="price"> Price <i class="fa fa-inr"></i> 200 </span>
                                            <span class="offer-price"> Offer Price <i class="fa fa-inr"></i> 120 </span>
                                        </div>
                                        <div class="btn-box text-center">
                                            <a class="btn btn-sm" href="javascript:void(0);"> <i
                                                    class="fa fa-shopping-cart"></i> Add to Cart </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="sq_box shadow">
                                        <div class="pdis_img">
                                            <span class="wishlist">
                                                <a alt="Add to Wish List" title="Add to Wish List"
                                                    href="javascript:void(0);"> <i class="fa fa-heart"></i></a>
                                            </span>
                                            <a href="#">
                                                <img
                                                    src="https://ucarecdn.com/05f649bf-b70b-4cf8-90f7-2588ce404a08/-/resize/680x/">
                                            </a>
                                        </div>
                                        <h4 class="mb-1"> <a href="#"> Milton Bottle </a> </h4>
                                        <div class="price-box mb-2">
                                            <span class="price"> Price <i class="fa fa-inr"></i> 200 </span>
                                            <span class="offer-price"> Offer Price <i class="fa fa-inr"></i> 120 </span>
                                        </div>
                                        <div class="btn-box text-center">
                                            <a class="btn btn-sm" href="javascript:void(0);"> <i
                                                    class="fa fa-shopping-cart"></i> Add to Cart </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="sq_box shadow">
                                        <div class="pdis_img">
                                            <span class="wishlist">
                                                <a alt="Add to Wish List" title="Add to Wish List"
                                                    href="javascript:void(0);"> <i class="fa fa-heart"></i></a>
                                            </span>
                                            <a href="#">
                                                <img
                                                    src="https://ucarecdn.com/05f649bf-b70b-4cf8-90f7-2588ce404a08/-/resize/680x/">
                                            </a>
                                        </div>
                                        <h4 class="mb-1"> <a href="details.php"> Milton Bottle </a> </h4>
                                        <div class="price-box mb-2">
                                            <span class="price"> Price <i class="fa fa-inr"></i> 200 </span>
                                            <span class="offer-price"> Offer Price <i class="fa fa-inr"></i> 120 </span>
                                        </div>
                                        <div class="btn-box text-center">
                                            <a class="btn btn-sm" href="javascript:void(0);"> <i
                                                    class="fa fa-shopping-cart"></i> Add to Cart </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="sq_box shadow">
                                        <div class="pdis_img">
                                            <span class="wishlist">
                                                <a alt="Add to Wish List" title="Add to Wish List"
                                                    href="javascript:void(0);"> <i class="fa fa-heart"></i></a>
                                            </span>
                                            <a href="#">
                                                <img
                                                    src="https://ucarecdn.com/05f649bf-b70b-4cf8-90f7-2588ce404a08/-/resize/680x/">
                                            </a>
                                        </div>
                                        <h4 class="mb-1"> <a href="details.php"> Milton Bottle </a> </h4>
                                        <div class="price-box mb-2">
                                            <span class="price"> Price <i class="fa fa-inr"></i> 200 </span>
                                            <span class="offer-price"> Offer Price <i class="fa fa-inr"></i> 120 </span>
                                        </div>
                                        <div class="btn-box text-center">
                                            <a class="btn btn-sm" href="javascript:void(0);"> <i
                                                    class="fa fa-shopping-cart"></i> Add to Cart </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="sq_box shadow">
                                        <div class="pdis_img">
                                            <span class="wishlist">
                                                <a alt="Add to Wish List" title="Add to Wish List"
                                                    href="javascript:void(0);"> <i class="fa fa-heart"></i></a>
                                            </span>
                                            <a href="#">
                                                <img
                                                    src="https://ucarecdn.com/05f649bf-b70b-4cf8-90f7-2588ce404a08/-/resize/680x/">
                                            </a>
                                        </div>
                                        <h4 class="mb-1"> <a href="details.php"> Milton Bottle </a> </h4>
                                        <div class="price-box mb-2">
                                            <span class="price"> Price <i class="fa fa-inr"></i> 200 </span>
                                            <span class="offer-price"> Offer Price <i class="fa fa-inr"></i> 120 </span>
                                        </div>
                                        <div class="btn-box text-center">
                                            <a class="btn btn-sm" href="javascript:void(0);"> <i
                                                    class="fa fa-shopping-cart"></i> Add to Cart </a>
                                        </div>
                                    </div>
                                </div> --}}
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
