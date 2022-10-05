@extends('layouts.frontend')
@section('style')
    <style>
        .price-sec {
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            /* padding: 100px 0px; */
            /* background-color: #eee; */
        }

        .price-sec .ptables-head {
            font-family: 'Domine', serif;
            box-shadow: 0px 6px 14px rgba(0, 0, 0, 0.3);
            padding: 30px 0;
            margin: 0px 0px 100px 0px;
            border-radius: 3px;
            background: linear-gradient(25deg, #feae3f 15%, transparent 0%),
                linear-gradient(-25deg, #f321d7 15%, transparent 0%),
                linear-gradient(-150deg, #64b5f6 15%, transparent 0%),
                linear-gradient(150deg, #f47 15%, transparent 0%);

        }

        @media all and (max-width:600px) {
            .ptables-head h1 {
                font-size: 30px;
            }
        }


        .price-sec .f_price-table {
            margin: 5px 0px;
        }

        .price-sec .f_price-table .card {
            position: relative;
            max-width: 300px;
            height: auto;
            background: linear-gradient(-45deg, #fe0847, #feae3f);
            border-radius: 15px;
            margin: 0 auto;
            padding: 40px 20px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, .5);
            transition: .5s;
            overflow: hidden;
        }

        .price-sec .f_price-table .card:hover {
            transform: scale(1.1);
        }

        .f_price-table:nth-child(1) .card,
        .f_price-table:nth-child(1) .card .title i {
            background: linear-gradient(-45deg, #f403d1, #64b5f6);

        }

        .f_price-table:nth-child(2) .card,
        .f_price-table:nth-child(2) .card .title i {
            background: linear-gradient(-45deg, #fe6c61, #f321d7);

        }

        .f_price-table:nth-child(3) .card,
        .f_price-table:nth-child(3) .card .title i {
            background: linear-gradient(-45deg, #24ff72, #9a4eff);

        }

        .f_price-table .card:before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 40%;
            background: rgba(255, 255, 255, .1);
            z-index: 1;
            transform: skewY(-5deg) scale(1.5);

        }

        .f_price-table .title i {
            color: #fff;
            font-size: 60px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            text-align: center;
            line-height: 100px;
            box-shadow: 0 10px 10px rgba(0, 0, 0, .2)
        }

        .f_price-table .title h2 {
            position: relative;
            margin: 20px 0 0;
            padding: 0;
            color: #fff;
            font-size: 28px;
            z-index: 2;
        }

        .f_price-table .f_price {
            position: relative;
            z-index: 2;
        }

        .f_price-table .f_price h4 {
            margin: 0;
            padding: 20px 0;
            color: #fff;
            font-size: 60px;

        }

        .option {
            position: relative;
            z-index: 2;
        }

        .option ul {
            margin: 0;
            padding: 0;

        }

        .option ul li {
            margin: 0 0 10px;
            padding: 0px 15px;
            list-style: none;
            color: #fff;
            font-size: 16px;
        }

        .card a {
            position: relative;
            z-index: 2;
            background: #fff;
            color: #000;
            width: 150px;
            height: 40px;
            line-height: 40px;
            display: block;
            text-align: center;
            margin: 20px auto 0;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            border-radius: 40px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .2);

        }

        .card a:hover {
            text-decoration: none;
        }
    </style>
@endsection
@section('content')
    <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 style="color:#fff;">Feature Packages</h2>
                </div>

            </div>
        </div>
    </div>
    <div class="about">
        <section class="price-sec">
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        @foreach ($f_package as $item)
                        <div class="col-sm-3 f_price-table">
                            <div class="card text-center">
                                <div class="title">
                                    <i class="{{$item->icon??''}}"></i>
                                    <h2>{{$item->name??''}}</h2>
                                </div>
                                <div class="f_price">
                                    <h4><sup>Rs</sup>{{$item->price??''}}</h4>
                                </div>
                                <div class="option">
                                    <p>
                                        {{$item->description??''}}
                                    </p>
                                    {{-- <ul>
                                        <li><i class="fa fa-check"></i> 10 GB Space</li>
                                        <li><i class="fa fa-check"></i> 3 Domain Names</li>
                                        <li><i class="fa fa-check"></i> 20 Email address</li>
                                        <li><i class="fa fa-times"></i> Live Support</li>
                                    </ul> --}}
                                </div>
                                <a href="#">Select</a>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
