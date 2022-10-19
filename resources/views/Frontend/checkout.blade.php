@extends('layouts.frontend')
@section('style')
    <style>
        .product-image {
            float: left;
            width: 20%;
        }

        .product-details {
            float: left;
            width: 37%;
        }

        .product-price {
            float: left;
            width: 12%;
        }

        .product-quantity {
            float: left;
            width: 10%;
        }

        .product-removal {
            float: left;
            width: 9%;
        }

        .product-line-price {
            float: left;
            width: 12%;
            text-align: right;
        }

        /* This is used as the traditional .clearfix class */
        .group:before,
        .shopping-cart:before,
        .column-labels:before,
        .product:before,
        .totals-item:before,
        .group:after,
        .shopping-cart:after,
        .column-labels:after,
        .product:after,
        .totals-item:after {
            content: '';
            display: table;
        }

        .group:after,
        .shopping-cart:after,
        .column-labels:after,
        .product:after,
        .totals-item:after {
            clear: both;
        }

        .group,
        .shopping-cart,
        .column-labels,
        .product,
        .totals-item {
            zoom: 1;
        }

        /* Apply clearfix in a few places */
        /* Apply dollar signs */
        .product .product-price:before,
        .product .product-line-price:before,
        .totals-value:before {
            content: 'Rs ';
        }


        /* Column headers */
        .column-labels label {
            padding-bottom: 15px;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        /* Product entries */
        .product {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .product .product-image {
            text-align: center;
        }

        .product .product-image img {
            width: 100px;
        }

        .product .product-details .product-title {
            margin-right: 20px;
            font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
        }

        .product .product-details .product-description {
            margin: 5px 20px 5px 0;
            line-height: 1.4em;
        }

        .product .product-quantity input {
            width: 40px;
        }

        .product .remove-product {
            border: 0;
            padding: 4px 8px;
            background-color: #c66;
            color: #fff;
            font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
            font-size: 12px;
            border-radius: 3px;
        }

        .product .remove-product:hover {
            background-color: #a44;
        }

        /* Totals section */
        .totals .totals-item {
            float: right;
            clear: both;
            width: 100%;
            margin-bottom: 10px;
        }

        .totals .totals-item label {
            float: left;
            clear: both;
            width: 79%;
            text-align: right;
        }

        .totals .totals-item .totals-value {
            float: right;
            width: 21%;
            text-align: right;
        }

        .totals .totals-item-total {
            font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
        }

        .checkout {
            float: right;
            border: 0;
            margin-top: 20px;
            padding: 6px 25px;
            background-color: #6b6;
            color: #fff;
            font-size: 25px;
            border-radius: 3px;
        }

        .checkout:hover {
            background-color: #494;
        }

        /* Make adjustments for tablet */
        @media screen and (max-width: 650px) {
            .shopping-cart {
                margin: 0;
                padding-top: 20px;
                border-top: 1px solid #eee;
            }

            .column-labels {
                display: none;
            }

            .product-image {
                float: right;
                width: auto;
            }

            .product-image img {
                margin: 0 0 10px 10px;
            }

            .product-details {
                float: none;
                margin-bottom: 10px;
                width: auto;
            }

            .product-price {
                clear: both;
                width: 70px;
            }

            .product-quantity {
                width: 100px;
            }

            .product-quantity input {
                margin-left: 20px;
            }

            .product-quantity:before {
                content: 'x';
            }

            .product-removal {
                width: auto;
            }

            .product-line-price {
                float: right;
                width: 70px;
            }
        }

        /* Make more adjustments for phone */
        @media screen and (max-width: 350px) {
            .product-removal {
                float: right;
            }

            .product-line-price {
                float: right;
                clear: left;
                width: auto;
                margin-top: 10px;
            }

            .product .product-line-price:before {
                content: 'Item Total: $';
            }

            .totals .totals-item label {
                width: 60%;
            }

            .totals .totals-item .totals-value {
                width: 40%;
            }
        }
    </style>
@endsection
@section('content')
    <div class="page-header" style="margin-bottom: 0px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 style="color:#fff;">Check Out</h2>
                </div>
            </div>
        </div>
    </div>
    <section id="services" class="services section-bg">
        <div class="container-fluid">
            <form action="#" method="#">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Shipping Detail</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Full Name</label>
                                            <input type="text" name="name" value="{{ Auth()->user()->name ?? '' }}"
                                                class="form-control" id="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" name="email" value="{{ Auth()->user()->email ?? '' }}"
                                                class="form-control" id="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Phone</label>
                                            <input type="number" step="any"
                                                value="{{ Auth()->user()->phone_no ?? '' }}" name="phone"
                                                class="form-control" id="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <input type="text" name="address" value="{{ Auth()->user()->address ?? '' }}"
                                                class="form-control" id="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">City</label>
                                            <input type="text" name="city" class="form-control" id="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">State</label>
                                            <input type="text" name="state" class="form-control" id="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Payment Method</label>
                                            <select name="payment_method" class="form-control" id="">
                                                <option value="Cash on Delivery">Cash on Delivery</option>
                                                <option value="Jazz Cash">Jazz Cash</option>
                                                <option value="Easy Paisa">Easy Paisa</option>
                                                <option value="Bank">Bank</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Payment Source</h4>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Bank</th>
                                                    <th>Account Name</th>
                                                    <th>Account No</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>JazzCash</td>
                                                    <td>Waseem Butt</td>
                                                    <td>12345678</td>
                                                </tr>
                                                <tr>
                                                    <td>Easypaisa</td>
                                                    <td>Waseem Butt</td>
                                                    <td>12345678</td>
                                                </tr>
                                                <tr>
                                                    <td>Bank</td>
                                                    <td>Waseem Butt</td>
                                                    <td>12345678</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Total</h4>
                            </div>
                            <div class="card-body">
                                <h5>Shopping Cart</h5>
                                <table class="table">
                                    <thead>
                                        <th>Product Name</th>
                                        <th>QTY</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sub_total = 0;
                                            $total = 0;
                                            $tax = 0;
                                        @endphp
                                        @foreach ($cart as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->product_name->name ?? '' }}
                                                </td>
                                                <td>
                                                    {{ $item->qty ?? '' }}
                                                </td>
                                                <td>
                                                    {{ $item->qty * $item->product_name->price }}
                                                </td>
                                            </tr>
                                            @php
                                                
                                                $sub_total += $item->product_name->price * $item->qty;
                                                $total += $sub_total * 0.17 + $sub_total * 1;
                                                $tax += $sub_total * 0.17;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr>
                                <h5>Checkout</h5>
                                <hr>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Sub Total</th>
                                        <td>Rs {{ $sub_total ?? '0' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping Charge</th>
                                        <td>Rs 200</td>
                                    </tr>
                                    <tr>
                                        <th>Tax(17%)</th>
                                        <td>Rs {{ $tax ?? '0' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td>Rs {{ $total + 200 }}</td>
                                    </tr>
                                    <tr>

                                        <td colspan="2">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('after-script')
    <script>
        /* Set rates + misc */
        var taxRate = 0.17;
        var shippingRate = 15.00;
        var fadeTime = 300;


        /* Assign actions */
        $('.product-quantity input').change(function() {
            updateQuantity(this);
        });

        $('.product-removal button').click(function() {
            removeItem(this);
        });


        /* Recalculate cart */
        function recalculateCart() {
            var subtotal = 0;

            /* Sum up row totals */
            $('.product').each(function() {
                subtotal += parseFloat($(this).children('.product-line-price').text());
            });

            /* Calculate totals */
            var tax = subtotal * taxRate;
            var shipping = (subtotal > 0 ? shippingRate : 0);
            var total = subtotal + tax + shipping;

            /* Update totals display */
            $('.totals-value').fadeOut(fadeTime, function() {
                $('#cart-subtotal').html(subtotal.toFixed(2));
                $('#cart-tax').html(tax.toFixed(2));
                $('#cart-shipping').html(shipping.toFixed(2));
                $('#cart-total').html(total.toFixed(2));
                if (total == 0) {
                    $('.checkout').fadeOut(fadeTime);
                } else {
                    $('.checkout').fadeIn(fadeTime);
                }
                $('.totals-value').fadeIn(fadeTime);
            });
        }


        /* Update quantity */
        function updateQuantity(quantityInput) {
            /* Calculate line price */
            var productRow = $(quantityInput).parent().parent();
            var price = parseFloat(productRow.children('.product-price').text());
            var quantity = $(quantityInput).val();
            var linePrice = price * quantity;

            /* Update line price display and recalc cart totals */
            productRow.children('.product-line-price').each(function() {
                $(this).fadeOut(fadeTime, function() {
                    $(this).text(linePrice.toFixed(2));
                    recalculateCart();
                    $(this).fadeIn(fadeTime);
                });
            });
        }


        /* Remove item from cart */
        function removeItem(removeButton) {
            /* Remove row from DOM and recalc cart total */
            var productRow = $(removeButton).parent().parent();
            productRow.slideUp(fadeTime, function() {
                productRow.remove();
                recalculateCart();
            });
        }
    </script>
@endsection