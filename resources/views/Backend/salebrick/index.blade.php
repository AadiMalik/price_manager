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
                                <i class="fa fa-tasks"></i><span> Sale Bricks</span>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <a href="{{route('SaleCreate')}}" class="btn btn-primary fa fa-plus"> Add Sale Bricks</a>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Bill No</th>
                                        <th>Customer Code</th>
                                        <th>Vender Name</th>
                                        <th>Product Name</th>
                                        <th>Vehicle No</th>
                                        <th>Sale Rate</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>User Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($sale as $index => $item)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$item->bill_no}}</td>
                                        <td>{{$item->code}}</td>
                                        <td>{{$item->vender_name->name}}</td>
                                        <td>{{$item->product_name->name}}</td>
                                        <td>{{$item->vehicle}}</td>
                                        <td style="text-align:right;">{{$item->sale_rate}}</td>
                                        <td style="text-align:right;">{{$item->qty}}</td>
                                        <td style="text-align:right;">{{$item->sale_rate*$item->qty}}</td>
                                        <td>
                                            @if($item->status==0)
                                            <b style="color:blue;">ON</b>
                                            @else
                                            <b style="color:red;">Cancel</b>
                                            @endif
                                        </td>
                                        <td>{{$item->user_name->name}}</td>
                                        <td>{{$item->description}}</td>
                                        <td><a href="{{route('SaleEdit',$item->id)}}" class="btn btn-warning" style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span class="fa fa-edit"> Edit</span></a>
                                        {{--<a href="javascript:void(0)" onclick="deleteCity({{$city->id}})" class="btn btn-danger" style="font-weight:bold;margin-bottom:5px;"><span class="fa fa-remove"> Delete</span></a>--}}
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
        function deleteCity(city) {
            $.ajax({
                type:'get',
                url:'city/'+city+'/delete',
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