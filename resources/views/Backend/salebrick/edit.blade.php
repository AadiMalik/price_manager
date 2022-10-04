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
                            <h2>Edit Sale Bricks</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('SaleUpdate',$saleBrick)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                            <div class="form-line">
                                                <select class="form-control" name="status" required>
                                                    <option value="">-- Select Status--</option>
                                                    <option value="0">ON</option>
                                                    <option value="1">Cancel</option>
                                                </select>
                                                <span class="text-danger">{{ $errors->first('status') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" value="{{old('description')}}" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" name="description" required>
                                                <label class="form-label">Reason <span class="text text-danger">*</span></label>
                                                <span class="text-danger">{{ $errors->first('description') }}</span>
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

