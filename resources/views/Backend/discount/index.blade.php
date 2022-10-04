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
                                <i class="fa fa-tasks"></i><span> Discount</span>
                            </h2>
                            @if(auth()->user()->email == 'admin@gmail.com')
                            <ul class="header-dropdown m-r--5">
                                <a href="{{route('discountCreate')}}" class="btn btn-primary fa fa-plus"> Add Discount</a>
                            </ul>
                                @endif
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Voucher Code</th>
                                        <th>Percentage</th>
                                        <th>Expiry Date</th>
                                        <th>User Name</th>
                                        <th>Voucher Used</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($discounts as $index => $discount)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$discount->voucher_code}}</td>
                                        <td>{{$discount->percentage}}</td>
                                        <td>{{$discount->expiry_date}}</td>
                                        <td>{{$discount->user ? $discount->user->name : '--'}}</td>
                                        <td>{{$discount->code_used ? $discount->code_used : 0}}</td>
                                        
                                        <td>
                                            <a href="{{route('discountUserName',$discount->id)}}" class="btn btn-info" style="font-weight:bold; width:100px; margin-right:5px; margin-bottom:5px;"><span class="fa fa-eye"> Show User</span></a>
                                            @if(auth()->user()->email == 'admin@gmail.com')
                                            <a href="{{route('discountEdit',$discount->id)}}" class="btn btn-warning" style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span class="fa fa-edit"> Edit</span></a>
                                        {{--<a href="javascript:void(0)" onclick="deleteDiscount({{$discount->id}})" class="btn btn-danger" style="font-weight:bold;margin-bottom:5px;"><span class="fa fa-remove"> Delete</span></a>--}}
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
        function deleteDiscount(discount) {
            $.ajax({
                type:'get',
                url:'discount/'+discount+'/delete',
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