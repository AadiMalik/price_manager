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
                            <h2>Update Package History</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{url('packagehistoryupdate',$packagehistory->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="hidden" value="{{$packagehistory->user_id}}" class="form-control" name="user_id">
                                            <input type="text" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" name="description" required>
                                            <label class="form-label">Reason<span class="text text-danger">*</span></label>
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        </div>
                                </div>

                                <button class="btn btn-primary waves-effect" type="submit">BLOCK</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Validation -->
        </div>
    </section>

@endsection
