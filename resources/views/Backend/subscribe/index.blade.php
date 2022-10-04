@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        @if(Session('success'))
                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                <strong>Success:</strong>&nbsp; {{ Session('success') }} </div>

                        @endif
                        <div class="header">
                            <h2>
                                <i class="fa fa-tasks"></i><span>Message</span>
                            </h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{url('emailsubscribe')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea type="text" style="min-height:250px;" class="form-control" name="message" required>{{old('message')}}</textarea>
                                        <label class="form-label">Write Email Here.. <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('message') }}</span>
                                    </div>
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <i class="fa fa-tasks"></i><span> Subscribe Emails</span>
                            </h2>
                            {{--<ul class="header-dropdown m-r--5">
                                <a href="{{route('socialMediaCreate')}}" class="btn btn-primary fa fa-plus"> Add Social Media</a>
                            </ul>--}}
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table  class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($subscribe as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->email}}</td>
                                        {{--<td>
                                            <a href="{{route('socialMediaEdit',$socialMedia->id)}}" class="btn btn-warning" style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span class="fa fa-edit"> Edit</span></a>
                                        <a href="javascript:void(0)" onclick="deleteSubscribe({{$item->id}})" class="btn btn-danger" style="font-weight:bold;margin-bottom:5px;"><span class="fa fa-remove"> Delete</span></a>
                                        </td>--}}
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
@endsection


@section('after-script')



    @endsection