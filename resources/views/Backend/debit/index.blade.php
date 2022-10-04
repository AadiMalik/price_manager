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
                                <i class="fa fa-tasks"></i><span> Debit and Credit</span>
                            </h2>
                            {{--<ul class="header-dropdown m-r--5">
                                <a href="{{route('CustomerCreate')}}" class="btn btn-primary fa fa-plus"> Add Customer</a>
                            </ul>--}}
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer Code</th>
                                        <th>Jamma</th>
                                        <th>Banam</th>
                                        <th>Description</th>
                                        <th>User Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($debit as $index => $item)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$item->code}}</td>
                                        <td style="text-align:right;">{{$item->jamma}}</td>
                                        <td style="text-align:right;">{{$item->banam}}</td>
                                        <td>{{$item->description}}</td>
                                        <td>{{$item->user_name->name}}</td>
                                        {{--<td><a href="{{route('CustomerEdit',$item->id)}}" class="btn btn-warning" style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span class="fa fa-edit"> Edit</span></a>
                                        <a href="{{url('CustomerInvoice/'.$item->id)}}" class="btn btn-success" style="font-weight:bold;margin-bottom:5px;"><span class="fa fa-print"> Print</span></a>
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