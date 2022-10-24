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

        .section-products .single-product:hover .part-1::before {
            transform: scale(1.2, 1.2) rotate(5deg);
        }

        .section-products #product-1 .part-1::before {
            background: url("https://i.ibb.co/L8Nrb7p/1.jpg") no-repeat center;
            background-size: cover;
            transition: all 0.3s;
        }

        .section-products #product-2 .part-1::before {
            background: url("https://i.ibb.co/cLnZjnS/2.jpg") no-repeat center;
            background-size: cover;
        }

        .section-products #product-3 .part-1::before {
            background: url("https://i.ibb.co/L8Nrb7p/1.jpg") no-repeat center;
            background-size: cover;
        }

        .section-products #product-4 .part-1::before {
            background: url("https://i.ibb.co/cLnZjnS/2.jpg") no-repeat center;
            background-size: cover;
        }

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
                        <li class="list-group-item active">Categories</li>
                        @foreach ($category as $item)
                        <li class="list-group-item"><a href="{{url('products/'.$item->id)}}">{{$item->name??''}}</a></li>
                        @endforeach
                      </ul>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <!-- Single Product -->
                        @foreach ($product as $item)
                            <div class="col-md-6 col-lg-4 col-xl-3">

                                <div id="product-1" class="single-product">
                                    <div class="part-1"
                                        style="background: url({{ asset($item->image1 ?? 'https://i.ibb.co/L8Nrb7p/1.jpg') }}) no-repeat center;
                                background-size: cover;
                                transition: all 0.3s;">
                                        {{-- <span class="discount">15% off</span> --}}
                                        <ul>
                                            <li><a style="cursor: pointer;" onclick="Cart({{ $item->id }})"><i
                                                        class="fas fa-shopping-cart"></i></a></li>
                                            {{-- <li><a href="#"><i class="fas fa-heart"></i></a></li> --}}
                                            {{-- <li><a href="#"><i class="fas fa-plus"></i></a></li> --}}
                                            <li><a href="{{ url('product-detail/' . $item->id) }}"><i
                                                        class="fas fa-expand"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="part-2">
                                        <h3 class="product-title"><a
                                                href="{{ url('product-detail/' . $item->id) }}">{{ $item->name ?? '' }}</a></h3>
                                        {{-- <h4 class="product-old-price">R79.99</h4> --}}
                                        <h4 class="product-price" style="margin-top:0px;">Rs. {{ $item->price ?? '' }}</h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
