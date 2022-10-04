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
                                <i class="fa fa-tasks"></i><span> Package History</span>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>New Package</th>
                                        <th>Previous Package</th>
                                        <th>Discount ID</th>
                                        <th>Voucher No</th>
                                        <th>New Expiry</th>
                                        <th>Previous Expiry</th>
                                        <th>Previous Days</th>
                                        <th>Status</th>
                                        <th>Description</th>
                                        <th>Update By</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($packagehistory as $index => $history)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$history->user_id}}</td>
                                        <td>{{$history->package_id}}</td>
                                        <td>{{$history->pre_package}}</td>
                                        <td>{{$history->discount_id}}</td>
                                        <td>{{$history->voucher_number}}</td>
                                        <td>{{$history->expiry}}</td>
                                        <td>{{$history->pre_expiry}}</td>
                                        <td>{{$history->pre_days}}</td>
                                        <td>
                                            @if($history->status==2)
                                            <span class="badge badge-success" style="background:green;">On</span>
                                            @elseif($history->status==1)
                                            <span class="badge badge-danger" style="background:red;">Off</span>
                                            @endif
                                        </td>
                                        <td>{{$history->description}}</td>
                                        <td>{{$history->update_by}}</td>
                                        <td>{{$history->created_at}}</td>
                                        <td>{{$history->updated_at}}</td>
                                        <td>
                                            @if($userhistory->where('user_id',$history->user_id)->max('id') == $history->id && $history->status!=1)
                                            <a href="{{url('packagehistoryedit',$history->id)}}" class="btn btn-danger" style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span class="fa fa-trash"> Block</span></a>
                                            @else
                                            No Action
                                            @endif
                                        </td>
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