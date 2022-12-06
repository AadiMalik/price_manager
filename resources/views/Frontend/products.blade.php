@extends('layouts.frontend')
@section('style')
    <style>
        .section-products {
            padding: 80px 0 54px;
        }

        .section-products .header {
            margin-bottom: 50px;
        }

        .section-products .header h3 {
            font-size: 1rem;
            color: #fe302f;
            font-weight: 500;
        }

        .section-products .header h2 {
            font-size: 2.2rem;
            font-weight: 400;
            color: #444444;
        }

        .section-products .single-product {
            margin-bottom: 26px;
        }

        .section-products .single-product .part-1 {
            position: relative;
            height: 290px;
            max-height: 290px;
            margin-bottom: 20px;
            overflow: hidden;
            transition: 0.3s;
        }

        .section-products .single-product .part-1:hover {
            -webkit-transform: scale(1.06);
            -moz-transform: scale(1.06);
            -ms-transform: scale(1.06);
            -o-transform: scale(1.06);
            transform: scale(1.06);
        }

        .section-products .single-product .part-1::before {
            position: absolute;
            content: "";
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            transition: all 0.3s;
        }

        /* .section-products .single-product:hover .part-1::before {
                transform: scale(1.2, 1.2) rotate(5deg);
            } */

        .section-products .single-product .part-1 .discount,
        .section-products .single-product .part-1 .new {
            position: absolute;
            top: 15px;
            left: 20px;
            color: #ffffff;
            background-color: #fe302f;
            padding: 2px 8px;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .section-products .single-product .part-1 .new {
            left: 0;
            background-color: #444444;
        }

        .section-products .single-product .part-1 ul {
            position: absolute;
            bottom: -41px;
            left: 20px;
            margin: 0;
            padding: 0;
            list-style: none;
            opacity: 0;
            transition: bottom 0.5s, opacity 0.5s;
        }

        .section-products .single-product:hover .part-1 ul {
            bottom: 30px;
            opacity: 1;
        }

        .section-products .single-product .part-1 ul li {
            display: inline-block;
            margin-right: 4px;
        }

        .section-products .single-product .part-1 ul li a {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            background-color: #ffffff;
            color: #444444;
            text-align: center;
            box-shadow: 0 2px 20px rgb(50 50 50 / 10%);
            transition: color 0.2s;
        }

        .section-products .single-product .part-1 ul li a:hover {
            color: #fe302f;
        }

        .section-products .single-product .part-2 .product-title {
            font-size: 1rem;
        }

        .section-products .single-product .part-2 h4 {
            display: inline-block;
            font-size: 1rem;
        }

        .section-products .single-product .part-2 .product-old-price {
            position: relative;
            padding: 0 7px;
            margin-right: 2px;
            opacity: 0.6;
        }

        .section-products .single-product .part-2 .product-old-price::after {
            position: absolute;
            content: "";
            top: 50%;
            left: 0;
            width: 100%;
            height: 1px;
            background-color: #444444;
            transform: translateY(-50%);
        }
    </style>
@endsection
@section('content')
    <section class="section-products">
        <div class="container-fluid justify-content-center">
            <div class="row">
                <div class="col-md-3">
                    <ul class="list-group">
                        <li class="list-group-item active">
                            <h5>Categories</h5>
                        </li>
                        @foreach ($category as $item)
                            <li class="list-group-item">
                                <a href="{{ url('products/' . $item->id) }}"><b
                                        style="color:#000;">{{ $item->name ?? '' }}</b></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-9">
                    <form action="{{ url('product-search') }}" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-md-10">
                                <input type="text" name="search" class="form-control" id="">
                            </div>
                            <div class="col-md-2">
                                <button style="submit" class="btn btn-primary form-control">Search</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="row">
                        <!-- Single Product -->
                        @if (count($product) > 0)
                            @foreach ($product as $item)
                                <div class="col-md-6 col-lg-4 col-xl-3">

                                    <div id="product-1" class="single-product">
                                        <a href="{{ url('product-detail/' . $item->id) }}"`style="over-flow:hidden;">
                                            <div class="part-1"
                                                style="background: url({{ asset($item->image1 ?? 'https://i.ibb.co/L8Nrb7p/1.jpg') }}) no-repeat center; background-size: cover; transition: all 0.3s;">
                                                {{-- <span class="discount">15% off</span> --}}
                                                {{-- <ul>
                                                    <li><a style="cursor: pointer;" onclick="Cart({{ $item->id }})"><i
                                                                class="fas fa-shopping-cart"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-heart"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-plus"></i></a></li>
                                                    <li><a href="{{ url('product-detail/' . $item->id) }}"><i
                                                                class="fas fa-expand"></i></a></li>
                                                </ul> --}}
                                            </div>
                                        </a>
                                        <div class="part-2">
                                            <h3 class="product-title" style="font-family:'Roboto', sans-serif;"><a
                                                    href="{{ url('product-detail/' . $item->id) }}">{{ $item->name ?? '' }}</a>
                                            </h3>
                                            {{-- <h4 class="product-old-price">R79.99</h4> --}}
                                            <h4 class="product-price"
                                                style="margin-top:0px;font-family:'Roboto', sans-serif;">Rs.
                                                {{ $item->price ?? '' }}
                                                &nbsp;&nbsp; @if (isset($item->old_price))
                                                    <small><del>{{ $item->old_price ?? '0' }}</del></small>
                                                @endif
                                            </h4><br>
                                            <span style="text-align:left; display: inline-block; font-size:14px;">
                                                <?php $rating = 0; ?>
                                                <?php if (count($comment->where('product_id', $item->id)) != 0) {
                                                    $rating = $comment->where('product_id', $item->id)->sum('rate') / count($comment->where('product_id', $item->id));
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
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12" style="text-align: center;">
                                <p>No Product Found!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('after-script')
    <script>
        function Cart(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            <?php if (auth()->user() != null) { ?>
            $.ajax({
                type: 'POST',
                url: "{{ route('cart.store') }}",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    product_id: id,
                },

                success: function(data) {
                    alert('Product add to cart!');
                    location.reload();
                }
            });
            <?php } else { ?>
            alert('Please Login First!');
            <?php } ?>
        }
    </script>
@endsection
