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
                                <i class="fa fa-tasks"></i><span> User</span>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <a href="{{route('userCreate')}}" class="btn btn-primary fa fa-plus"> Add User</a>
                            </ul>
                        </div>
                       


                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone #</th>
                                        <th>Password</th>
                                        <th>Industry</th>
                                        <th>City</th>
                                        <th>Type</th>
                                        <th>Validity Day</th>
                                        <th>Expiry</th>

                                        <th>Status</th>
                                        <th>View</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    @foreach($users as $index => $user)
                                     @php
                                        $fdate= date('Y-m-d');
                                        $tdate=$user->expiry_date;
                                        $datetime1 = new DateTime($fdate);
                                        $datetime2 = new DateTime($tdate);
                                        $interval = $datetime1->diff($datetime2);
                                        $days = $interval->format('%a');
                                    @endphp
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone_no}}</td>
                                            <td>{{$user->password_without_hash}}</td>
                                            <td>{{$user->industry->name ?? '' }}</td>
                                            <td>{{$user->city->name ?? '' }}</td>
                                            <td>{{$user->userType->name ?? ''}}</td>
                                            <td>{{$days}}</td>
                                            <td>{{$user->expiry_date}}</td>

                                            <td>@if($user->status == 1) <span class="badge badge-success" style="background:green"> Active </span> @elseif($user->status == 2) <span class="badge badge-danger" style="background:red"> Block </span> @endif</td>
                                            <td>{{$user->view}}</td>
                                            <td><a href="{{route('userEdit',$user->id)}}" class="btn btn-warning" style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span class="fa fa-edit"> Edit</span>
                                                <a href="{{route('userVerify',$user->id)}}" class="btn btn-info" style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span class="fa fa-checked">@if($user->verify==0) Verify @else Normal @endif</span>
                                            </a>
                                            {{--<a href="javascript:void(0)" onclick="deleteUser({{$user->id}})" class="btn btn-danger" style="font-weight:bold;margin-bottom:5px;"><span class="fa fa-remove"> Delete</span></a>--}}
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
        function deleteUser(user) {
            $.ajax({
                type:'get',
                url:'user/'+user+'/delete',
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
                    if (response.status == 0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    console.log(response);
                }
            });
        }
    </script>


@endsection
