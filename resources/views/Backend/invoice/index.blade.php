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
                                <i class="fa fa-tasks"></i><span> Invoice</span>
                            </h2>
                            {{--<ul class="header-dropdown m-r--5">--}}
                                {{--<a href="{{route('industryCreate')}}" class="btn btn-primary fa fa-plus"> Add Industry</a>--}}
                            {{--</ul>--}}
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Invoice No</th>
                                        <th>Package ID</th>
                                        <th>Price</th>
                                        <th>Invoice Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($invoices as $index => $invoice)
                                    <tr>
                                        <td>{{$invoice->user ? $invoice->user->name : '---'}}</td>
                                        <td>{{$invoice->id}}</td>
                                        <td>{{$invoice->package ? $invoice->package->name :''}}</td>
                                        <td>{{$invoice->price}}</td>
                                        <td>@if($invoice->invoice)
                                        <img height="50" src="{{asset($invoice->invoice->image_url)}}"> 
                                        @else
                                        ----
                                        @endif
                                        </td>
                                        <td>
                                            @if($invoice->status == 0)
                                                UnPaid
                                            @elseif($invoice->status == 1)
                                                Paid
                                            @elseif($invoice->status == 2)
                                                Rejected
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('invoiceShow',$invoice->id)}}" class="btn btn-info" style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span class="fa fa-eye"> Show</span></a>
                                            @if($invoice->status == 0)
                                            <a href="javascript:void(0)" class="btn btn-warning" onclick="statusChange(1,{{$invoice->id}})" style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span class="fa fa-check"> Paid</span></a>
                                            @endif
                                            @if($invoice->status == 0)
                                            <a href="javascript:void(0)" class="btn btn-danger" onclick="statusRejected(2,{{$invoice->id}})" style="font-weight:bold; width:100px; margin-right:5px; margin-bottom:5px;"><span class="fa fa-check"> Rejected</span></a>
                                            @endif
                                                <!-- <a href="javascript:void(0)" onclick="deleteIndustry({{$invoice->id}})" class="btn btn-danger" style="font-weight:bold;margin-bottom:5px;"><span class="fa fa-remove"> Delete</span></a> -->
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

    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        function statusChange(ele,invoice) {
            // alert(invoice)
            console.log(invoice)
            $.ajax({
                type:'get',
                url: 'invoice/'+invoice+'/statusChange',
                success:function(response) {
                if (response.status == 1) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout('window.location.reload()',1500);
                }
                    console.log(response);
                }
            });
        }
        function statusRejected(ele,invoice) {
            // alert(invoice)
            console.log(invoice)
            $.ajax({
                type:'get',
                url: 'invoice/'+invoice+'/statusRejected',
                success:function(response) {
                    if (response.status == 1) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout('window.location.reload()',1500);
                    }
                    console.log(response);
                }
            });
        }
        
         function deleteIndustry(orderMail) {
            $.ajax({
                type:'get',
                url:'invoice/'+orderMail+'/delete',
                success:function(response) {
                    if (response.status == 1) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout('window.location.reload()',1500);
                    }
                    console.log(response);
                }
            });
        }
    </script>


    @endsection