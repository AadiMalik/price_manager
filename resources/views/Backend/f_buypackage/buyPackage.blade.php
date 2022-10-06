@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-1"></div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background:#f44336;">
                            <h2 style="color:#fff;">Discount Voucher</h2>
                        </div>
                        <div class="body" style="height: 185px;">
                            <form id="form_advanced_validation" method="POST" action="{{route('f_storeBuyPackage',$package->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control {{ $errors->has('voucher_number') ? 'has-error' : '' }}" value="{{old('price')}}" name="voucher_number" >
                                        <label class="form-label">Discount Voucher Code</label>
                                        <span class="text-danger">{{ $errors->first('voucher_number') }}</span>
                                    </div>
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit">Generate Invoice</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                <div class="card">
                        <div class="header" style="background:#f44336;">
                            <h2 style="color:#fff;">Selected Feature Pckage Detail</h2>
                        </div>
                        <div class="body">
                            <table class="table bordered-table">
                                <tr>
                                    <td>Package Name:</td>
                                    <td><b>{{$package->name??''}}</b></td>
                                </tr>
                                <tr>
                                    <td>Package Price:</td>
                                    <td><b>{{number_format($package->price??'0')}}</b></td>
                                </tr>
                                <tr>
                                    <td>Validity days:</td>
                                    <td><b>{{$package->days??''}}</b></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
            <!-- #END# Advanced Validation -->
        </div>
    </section>

@endsection
