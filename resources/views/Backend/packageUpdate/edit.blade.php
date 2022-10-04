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
                            <h2>Update Package</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{url('packageupdate',$user->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="date" value="{{$user->expiry_date}}" class="form-control {{ $errors->has('expiry') ? 'has-error' : '' }}" name="expiry" required>
                                            <label class="form-label">Expiry Date<span class="text text-danger">*</span></label>
                                            <span class="text-danger">{{ $errors->first('expiry') }}</span>
                                        </div>
                                </div>

                                <button class="btn btn-primary waves-effect" type="submit">UPDATE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Validation -->
        </div>
    </section>

@endsection
