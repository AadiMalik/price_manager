@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Settings</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('settingUpdate',$setting->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" value="{{$setting->tax??'0'}}" class="form-control {{ $errors->has('tax') ? 'has-error' : '' }}" name="tax" required>
                                        <label class="form-label">Tax(%) <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('tax') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" value="{{$setting->shipping_limit??'0'}}" class="form-control {{ $errors->has('shipping_limit') ? 'has-error' : '' }}" name="shipping_limit" required>
                                        <label class="form-label">Shipping Limit <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('shipping_limit') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" value="{{$setting->shipping_charge??'0'}}" class="form-control {{ $errors->has('shipping_charge') ? 'has-error' : '' }}" name="shipping_charge" required>
                                        <label class="form-label">Shipping Charge <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('shipping_charge') }}</span>
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
