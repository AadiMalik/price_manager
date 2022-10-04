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
                                <i class="fa fa-tasks"></i><span> Invoice Images</span>
                            </h2>
                            @if(auth()->user()->email != 'admin@gmail.com' )
                            <ul class="header-dropdown m-r--5">
                                <a href="{{route('createInvoiceImage')}}" class="btn btn-primary fa fa-plus"> Add Invoice Image</a>
                            </ul>
                            @endif
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Invoice No</th>
                                        <th>Images</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($invoiceImages as $index => $invoiceImage)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$invoiceImage->invoice_id}}</td>
                                        <td><img height="50" src="{{asset($invoiceImage->image_url)}}"></td>
                                        <td>
                                            @if(isset($invoiceImage->invoice))
                                            @if($invoiceImage->invoice->status == 0)
                                            <span class="badge badge-danger" style="background:blue;color:white;">Pending</span>
                                            @elseif($invoiceImage->invoice->status == 1)
                                                <span class="badge badge-success"  style="background:green;color:white;">Approved</span>
                                            @elseif($invoiceImage->invoice->status == 2)
                                            <span class="badge badge-success"  style="background:red;color:white;">Rejected</span>
                                            @endif
                                            @endif
                                        </td>
                                        <td>
                                        @if(isset($invoiceImage->invoice))
                                            @if(auth()->user()->email == 'admin@gmail.com' )
                                            <a href="{{route('invoiceImageShow',$invoiceImage->id)}}" class="btn btn-warning" style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span class="fa fa-show"> Show</span></a>
                                            @else
                                            @if($invoiceImage->invoice->status == 0)
                                            <a href="{{route('invoiceImageEdit',$invoiceImage->id)}}" class="btn btn-warning" style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span class="fa fa-edit"> Edit</span></a>
                                            <a href="javascript:void(0)" onclick="deleteOffice({{$invoiceImage->id}})" class="btn btn-danger" style="font-weight:bold;margin-bottom:5px;"><span class="fa fa-remove"> Delete</span></a>
                                            @elseif($invoiceImage->invoice->status == 2)<a href="javascript:void(0)" onclick="deleteOffice({{$invoiceImage->id}})" class="btn btn-danger" style="font-weight:bold;margin-bottom:5px;"><span class="fa fa-remove"> Delete</span></a>
                                            
                                            @else
                                            You cannot update or delete this
                                            @endif
                                            @endif
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

    <script>
        function deleteOffice(office) {
            $.ajax({
                type:'get',
                url:'invoice-image/'+office+'/delete',
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