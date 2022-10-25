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
                                <i class="fa fa-tasks"></i><span> Payment Methods</span>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <a href="{{ route('payment.create') }}" class="btn btn-primary fa fa-plus"> Add Payment</a>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Name</th>
                                            <th>Bank Name</th>
                                            <th>Account No</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($payment as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->name ?? '' }}</td>
                                                <td>{{ $item->bank ?? '' }}</td>
                                                <td>{{ $item->account_no ?? '' }}</td>
                                                <td>
                                                    <a href="{{ route('payment.edit', $item->id) }}"
                                                        class="btn btn-warning"
                                                        style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span
                                                            class="fa fa-edit"> Edit</span></a>
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

