@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Invoice Image</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('invoiceImageUpdate',$invoice->id)}}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control" name="invoice_id" required>
                                            <option value="">-- Please select Invoice --</option>
                                            @foreach($invoices as $invoiceImage)
                                            {{$invoiceImage->invoice_id == $invoice->id}}
                                                <option value="{{$invoiceImage->id}}" {{$invoiceImage->id == $invoice->invoice_id ? 'selected' : 'zeesha'}}>{{$invoiceImage->id}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{ $errors->first('invoice_id') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">

                                        <input type="file" class="form-control {{ $errors->has('image') ? 'has-error' : '' }}" name="image" accept="image/*">

                                        <span class="text-danger">{{ $errors->first('image') }}</span>

                                    </div>
                                    {{--<div class="help-info">Ex: 1234-5678-9012-3456</div>--}}
                                </div>
                                <div class="form-group form-float">
                                    <img src="{{asset($invoice->image_url)}}" height="100">
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


