@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <i class="fa fa-tasks"></i><span> Discount</span>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Voucher Code</th>
                                        <th>Percentage</th>
                                        <th>Code Used</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($discounts as $index => $discount)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$discount->voucher_code}}</td>
                                        <td>{{$discount->percentage}}</td>
                                        <td>{{$discount->code_used}}</td>
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
