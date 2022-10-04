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
                        <div class="body"
                            <div class="form-group form-float">
                            <p>Invoice ID : {{$invoice->invoice_id}}</p>
                                    <img src="{{asset($invoice->image_url)}}" style="width:100%; height:100%;">
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Validation -->
        </div>
    </section>

@endsection


