@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Coupons</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('coupon.update',$coupon->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{$coupon->code}}" class="form-control {{ $errors->has('code') ? 'has-error' : '' }}" name="code" required>
                                        <label class="form-label">Coupon Code <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('code') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" value="{{$coupon->amount}}" class="form-control {{ $errors->has('amount') ? 'has-error' : '' }}" name="amount" required>
                                        <label class="form-label">Discount Amount <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('amount') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="datetime-local" value="{{$coupon->expiry}}" class="form-control {{ $errors->has('expiry') ? 'has-error' : '' }}" name="expiry" required>
                                        <label class="form-label">Expiry <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('expiry') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control {{ $errors->has('status') ? 'has-error' : '' }}" name="status" required>
                                            <option value="0" {{($coupon->status==0)?'selected':''}}>Active</option>
                                            <option value="1" {{($coupon->status==1)?'selected':''}}>Block</option>
                                        </select>
                                        <label class="form-label">Status <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
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
