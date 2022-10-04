@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Discount</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('discountUpdate',$discount->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{$discount->voucher_code}}" class="form-control {{ $errors->has('voucher_code') ? 'has-error' : '' }}" name="voucher_code" required>
                                        <label class="form-label">Voucher Code <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('voucher_code') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" min="0" max="100"  step="0.01" value="{{$discount->percentage}}" class="form-control {{ $errors->has('percentage') ? 'has-error' : '' }}" name="percentage" required>
                                        <label class="form-label">Percentage <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('percentage') }}</span>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="date" value="{{$discount->expiry_date}}" class="form-control {{ $errors->has('expiry_date') ? 'has-error' : '' }}" name="expiry_date" required>
                                        <label class="form-label">Expiry Date <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('expiry_date') }}</span>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control" name="user">
                                            <option value="">-- Please select User --</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}" {{$discount->user_id == $user->id ? 'selected' : ''}}>{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{ $errors->first('user') }}</span>
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
