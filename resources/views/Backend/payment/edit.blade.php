@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Payment Method</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('payment.update',$payment->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{$payment->name}}" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}" name="name" required>
                                        <label class="form-label">Account Holder Name <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{$payment->bank}}" class="form-control {{ $errors->has('bank') ? 'has-error' : '' }}" name="bank" required>
                                        <label class="form-label">Bank Name <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('bank') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{$payment->account_no}}" class="form-control {{ $errors->has('account_no') ? 'has-error' : '' }}" name="account_no" required>
                                        <label class="form-label">Account No <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('account_no') }}</span>
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
