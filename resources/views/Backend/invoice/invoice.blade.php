
<!DOCTYPE html>

<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <title>Invoice</title>

    <link href="{{asset('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="{{asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- Custom Css -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

</head>
<body>
<div>
    <div class="container bootdey">
        <div class="row invoice row-printable">
            <div class="col-md-10">
                <!-- col-lg-12 start here -->
                <div class="panel panel-primary plain" id="dash_0" style="padding:20px;">
                    <!-- Start .panel -->
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-7 pull-left">
                                <!-- col-lg-6 start here -->
                                    <div class="invoice-logo"><img width="100" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Invoice logo"></div>
                                    <div class="invoice-from">
                                        <ul class="list-unstyled text-left">
                                            <li>pricemanager.pk</li>
                                            <li>Al-Raheem Garden Phase-5 Khalid Building</li>
                                            <li> Near Quaid-e-Azam Interchange Lahore</li>
                                            <li>Phone No.+92-42-36557189</li>
                                        </ul>
                                    </div>
                                <!-- col-lg-6 start here -->
                                <!--<div class="invoice-logo"><img width="100" src="{{asset('storage/'.auth()->user()->image_url)}}" alt="Invoice logo"></div>-->
                                <!--<div class="invoice-from">-->
                                <!--    <ul class="list-unstyled text-left">-->
                                <!--        <li></li>-->
                                <!--        <li>{{auth()->user()->address}}</li>-->
                                <!--        {{--<li>Austin TX 78754</li>--}}-->
                                <!--        {{--<li>VAT Number EU826113958</li>--}}-->
                                <!--    </ul>-->
                                <!--</div>-->
                            </div>
                            <!-- col-lg-6 end here -->
                            <div class="col-lg-5 pull-right" style="padding:20px;">
                                <!-- col-lg-6 start here -->
                                <table>
                                    <tbody>
                                    <tr>
                                        <th style="width:150px; text-align:right;">Invoice #:</th>
                                        <td>{{$invoice->id}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:150px; text-align:right;">Invoice Date:</th>
                                        <td> {{date('F d Y', strtotime($invoice->created_at))}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:150px; text-align:right;">Due Date:</th>
                                        <td> {{date('F d Y', strtotime($invoice->created_at. '+4 days'))}}</td>
                                    </tr>

                                    </tbody>
                                </table>
                                <!-- <ul class="list-unstyled mb0"> -->
                                <!-- <li><span class="label label-warning" style="font-size:25px; border-radius:0px;">UNPAID</span></li> -->
                                <!-- <br /> -->
                                <!-- <li><strong>Invoice:</strong> #936988</li> -->
                                <!-- <li><strong>Invoice Date:</strong> Monday, October 10th, 2015</li> -->
                                <!-- <li><strong>Due Date:</strong> Thursday, December 1th, 2015</li> -->

                                <!-- </ul> -->
                                <div id="pager" class="pull-right" style="margin-top:20px;">
                                    <b>Payment Methods</b><br />
                                    <select id="purpose" class="form-control" style="border-radius:0px;" name="Payment Methods">
                                        <option hidden>Select Payment Method</option>
                                        <option value="Account">Bank</option>
                                        <option value="Jazz Cash">Jazz Cash</option>
                                        <option value="Easy Paisa">Easy Paisa</option>
                                    </select>
                                </div>
                            </div>
                            <!-- col-lg-6 end here -->
                        </div>
                    </div>
                    <div class="panel-body p30">
                        <div class="row">
                            <!-- Start .row -->
                            <div class="col-lg-7 pull-left">
                                <!-- col-lg-12 start here -->
                                <div class="invoice-details mt25">
                                    <div>
                                        <ul class="list-unstyled">
                                            <li><strong>Invoiced To</strong></li>
                                            <li>{{$user->name}}</li>
                                            <li>{{$user->phone_no}}</li>
                                            <li>{{$user->address}}</li>
                                            <li>Pakistan</li>
                                        </ul>
                                    </div>
                                </div><br />
                            </div>
                            <div class="col-lg-5 table-responsive" id="payment" style=" outline: none;" tabindex="0">
                                <div id="Bank">
                                    <table class="table text-right" style="margin-bottom:0px;">
                                        <!-- <thead> -->
                                        <!-- <tr> -->
                                        <!-- <th colspan="2">Account Detail</th> -->
                                        <!-- </tr> -->
                                        <!-- </thead> -->
                                        <tbody>
                                        <tr>
                                            <th style="width:150px;">Account Title:</th>
                                            <td>Account holder name</td>
                                        </tr>
                                        <tr>
                                            <th style="width:150px;">Account No:</th>
                                            <td>12345678901234</td>
                                        </tr>
                                        <tr>
                                            <th style="width:150px;">Brach Name:</th>
                                            <td>12345678901234</td>
                                        </tr>
                                        <tr>
                                            <th style="width:150px;">Account No:</th>
                                            <td>12345678901234</td>
                                        </tr>
                                        <tr>
                                            <th style="width:150px;">Account No:</th>
                                            <td>12345678901234</td>
                                        </tr>
                                        <tr>
                                            <th style="width:150px;">Account No:</th>
                                            <td>12345678901234</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="row" style="overflow-x:hidden; margin-bottom:20px; margin-top:10px;">
                                        <div class="col-lg-12 text-center">
                                            <a href="#" id="paid" style=" margin-bottom:10px; line-height:30px; text-decoration:none;"><i class="label label-primary" style="color:#fff; font-size:18px; box-shadow:1px 1px 10px 1px #808080;">Pay Now<br /></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div id="Jazz">
                                    <table class="table  text-right" style="margin-bottom:0px;">
                                        <tbody>
                                        <tr>
                                            <th style="width:150px;">Account Title:</th>
                                            <td>Account holder name</td>
                                        </tr>
                                        <tr>
                                            <th style="width:150px;">Account Number:</th>
                                            <td>12345678901234</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                    <div class="row" style="overflow-x:hidden; margin-top:10px;">
                                        <div class="col-lg-12 text-center">
                                            <a href="#" id="paid" style=" margin-bottom:10px; line-height:30px; text-decoration:none;"><i class="label label-primary" style="color:#fff; font-size:18px; box-shadow:1px 1px 10px 1px #808080;">Pay Now<br /></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div id="Easy">
                                    <table class="table  text-right" style="margin-bottom:0px;">
                                        <tbody>
                                        <tr>
                                            <th style="width:150px;">Account Title:</th>
                                            <td>Account holder name</td>
                                        </tr>
                                        <tr>
                                            <th style="width:150px;">Account Number:</th>
                                            <td>12345678901234</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                    <div class="row" style="overflow-x:hidden; margin-top:10px;">
                                        <div class="col-lg-12 text-center">
                                            <a href="#" id="paid" style=" margin-bottom:10px; line-height:30px; text-decoration:none;"><i class="label label-primary" style="color:#fff; font-size:18px; box-shadow:1px 1px 10px 1px #808080;">Pay Now<br /></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="invoice-items">
                                    <div class="table-responsive" style=" outline: none;" tabindex="0">
                                        <table class="table table-bordered">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th class="per70 text-center bg-primary">Description</th>
                                                <th class="per5 text-center bg-primary">Qty</th>
                                                <th class="per25 text-center bg-primary">Total<span style="font-size:12px;"> (PKR)</span></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{{$package->description}}</td>
                                                <td class="text-center">1</td>
                                                <td class="text-center">{{$package->price}}</td>
                                            </tr>

                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="2" class="text-right">Sub Total:</th>
                                                <th class="text-center">{{$package->price}}</th>
                                            </tr>
                                            @php
                                            $discountPrice = 0;
                                            if ($discount) {
                                            $changeIntoFloat =  $discount->percentage / 100;
                                            $discountPrice = $package->price * $changeIntoFloat;
                                            }
                                            @endphp
                                            <tr>
                                                <th colspan="2" class="text-right">Discount({{$discount ? $discount->percentage : '0'}}%):</th>
                                                <th class="text-center">{{round($discountPrice)}}</th>
                                            </tr>
                                            
                                            <tr>
                                                <th colspan="2" class="text-right" style="font-size:16px;">Total:</th>
                                                <th class="badge" style="font-size:20px; border-radius:0px; background:#337ab7; width:100%;">{{round($package->price - $discountPrice)}}</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="invoice-footer mt25">
                                <p><button onclick="dashboard()" id="printbtn" class="btn btn-default ml15"><i class="fa fa-print mr5"></i> Print</button></p>

                            </div>

                        </div>
                    </div>
                    <!-- col-lg-12 end here -->
                </div>
                <!-- End .row -->
            </div>
            <!-- End .panel -->
        </div>
        <!-- col-lg-12 end here -->
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function () {


        function HideSections() {

            $("#Jazz").hide();
            $("#Easy").hide();
            $("#Bank").hide();
        }


        HideSections();

        $('#purpose').on('change', function () {

            if (this.value == "Account") {
                $("#Bank").show();
                $("#Jazz").hide();
                $("#Easy").hide();
            }
            else if (this.value == 'Jazz Cash') {
                $("#Bank").hide();
                $("#Jazz").show();
                $("#Easy").hide();
            } else if (this.value == 'Easy Paisa') {
                $("#Bank").hide();
                $("#Jazz").hide();
                $("#Easy").show();
            }else {
                $("#Bank").hide();
                $("#Jazz").hide();
                $("#Easy").hide();
            }
        });
        $("#printbtn").click(function(){
			  $("#printbtn").hide();
				$("#purpose").hide();
				$("#paid").hide();
			});
    });
    function dashboard(){
        window.print();
        setTimeout(function(){ 
            window.location.href = '{{route('frontendHome')}}'
            
        }, 3000);
    }
</script>
</body>
</html>
