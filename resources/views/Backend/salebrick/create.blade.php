@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-3"></div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Sale Bricks</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('SaleStore',$bill_no)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select class="form-control" name="customer" required>
                                                    <option value="">-- Select Customer--</option>
                                                    @foreach($customer as $item)
                                                    <option value="{{$item->code}}">{{$item->name}}</option>
                                                        @endforeach
                                                </select>
                                                <span class="text-danger">{{ $errors->first('customer') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" value="{{old('vehicle')}}" class="form-control {{ $errors->has('vehicle') ? 'has-error' : '' }}" name="vehicle" required>
                                                <label class="form-label">Vehicle No <span class="text text-danger">*</span></label>
                                                <span class="text-danger">{{ $errors->first('vehicle') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select class="form-control" name="vendor" required>
                                                    <option value="">-- Select Vendor--</option>
                                                    @foreach($users as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                </select>
                                                <span class="text-danger">{{ $errors->first('vendor') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group form-float" style="height: 155px;background: #808080;text-align: center;color: #fff; padding:40px;">
                                                <b style="font-size: 18px;font-weight: bold;">Bill No:</b><br><br><b style="font-size: 26px;font-weight: bold;">{{$bill_no}}</b>
                                                <input type="hidden" style="text-align:right;" name="bill_no" value="{{$bill_no}}" class="form-control">
                                                <span class="text-danger">{{ $errors->first('bill_no') }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <table class="table table-bordered">
                                          <thead>
                                            <tr>
                                              <th scope="col"><b style="font-size: 16px;font-weight: bold;">Sr.</b></th>
                                              <th scope="col"><b style="font-size: 16px;font-weight: bold;">Product Name</b></th>
                                              <th scope="col"><b style="font-size: 16px;font-weight: bold;">QTY</b></th>
                                              <th scope="col"><b style="font-size: 16px;font-weight: bold;">Sale Rate</b></th>
                                              <th scope="col"><b style="font-size: 16px;font-weight: bold;">Purchase Rate</b></th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                              @foreach($product as $index=> $item)
                                            <tr>
                                              <th scope="row">{{$index+1}}</th>
                                              <td>
                                                  <b>{{$item->name}}</b>
                                              </td>
                                              <td><input type="number" style="text-align:right;" name="qty{{$item->id}}" class="form-control"></td>
                                              <td><input type="number" style="text-align:right;" name="rate{{$item->id}}" class="form-control"></td>
                                              <td><input type="number" style="text-align:right;" name="purchase_rate{{$item->id}}" class="form-control"></td>
                                            </tr>
                                            @endforeach
                                          </tbody>
                                        </table>
                                    </div>
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Validation -->
        </div>
    </section>

@endsection

