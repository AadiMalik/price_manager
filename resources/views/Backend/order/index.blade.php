@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        @if (Session('success'))
                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                                <strong>Success:</strong>&nbsp; {{ Session('success') }}
                            </div>
                        @endif
                        <div class="header">
                            <h2>
                                <i class="fa fa-tasks"></i><span> Orders</span>
                            </h2>
                            {{-- <ul class="header-dropdown m-r--5"> --}}
                            {{-- <a href="{{route('industryCreate')}}" class="btn btn-primary fa fa-plus"> Add Industry</a> --}}
                            {{-- </ul> --}}
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>QTY</th>
                                            <th>Tax</th>
                                            <th>Sub Total</th>
                                            <th>Total</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($order as $index => $item)
                                            <tr>
                                                <td>{{ $item->name ?? '' }}</td>
                                                <td>{{ $item->email ?? '' }}</td>
                                                <td>{{ $item->phone ?? '' }}</td>
                                                <td>{{ $item->address ?? '' }},{{ $item->city ?? '' }},{{ $item->state ?? '' }}
                                                </td>
                                                <td>{{ $item->qty ?? '0' }}</td>
                                                <td>{{ $item->tax ?? '0' }}</td>
                                                <td>{{ $item->sub_total ?? '0' }}</td>
                                                <td>{{ $item->total ?? '0' }}</td>
                                                <td>{{ $item->payment_method ?? '' }}</td>
                                                <td>{{ $item->status ?? '' }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                                        data-target="#Order{{ $item->id }}"
                                                        style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span
                                                            class="fa fa-eye"> Show</span></button>
                                                    <a href="javascript:void(0)" class="btn btn-warning"
                                                        onclick="statusChange(1,{{ $item->id }})"
                                                        style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span
                                                            class="fa fa-check"> Paid</span></a>
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
    @foreach ($order as $item)
        <!-- Modal -->
        <div class="modal fade" id="Order{{$item->id}}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document"  style="padding-left:17px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Order Detail
                        </h5>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>QTY</th>
                                <th>Total</th>
                            </thead>
                            <tbody>
                                
                                @foreach ($order_detail->where('order_id',$item->id) as $item1)
                                <tr>
                                    <td>{{$item1->product_name->name??''}}</td>
                                    <td>{{$item1->price??''}}</td>
                                    <td>{{$item1->qty??''}}</td>
                                    <td>{{$item1->total??''}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection


@section('after-script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function statusChange(ele, invoice) {
            // alert(invoice)
            console.log(invoice)
            $.ajax({
                type: 'get',
                url: 'invoice/' + invoice + '/statusChange',
                success: function(response) {
                    if (response.status == 1) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout('window.location.reload()', 1500);
                    }
                    console.log(response);
                }
            });
        }
    </script>
@endsection
