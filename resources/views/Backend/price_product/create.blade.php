@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Price Product</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{ route('price-product-store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="result"></div>
                                <div class="form-group form-float">
                                    <button id="addRow" type="button" class="btn btn-success">Add Item</button>
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Validation -->
        </div>
    </section>
@endsection
@section('after-script')
    <script>
        $("#addRow").click(function() {
            var html = '';
            html += '<div class="form-group form-float">';
            html += '<label class="form-label">Name <span class="text text-danger">*</span></label>';
            html += '<div class="form-line">';
            html +='<input type="text" value="{{ old("name") }}" class="form-control" name="name[]" required>';
            html += '</div>';
            html += '</div>';
            html += '<div class="form-group form-float">';
            html += '<label class="form-label">Category <span class="text text-danger">*</span></label>';
            html += '<div class="form-line">';
            html +='<select name="category_id[]" id="category_id" class="form-control">';
            @foreach ($category as $item)
                html += '<option value="{{ $item->id }}">{{ $item->name ?? '' }}</option>';
            @endforeach
            html += '</select>';
            html += '</div>';
            html += '</div>';


            $('.result').append(html);
        });
    </script>
@endsection
