@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Update Price Table</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST"
                                action="{{ route('price-table-update', $price_table->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <label class="form-label">Product Name</label>
                                                <input type="text" value="{{ $price_table->product_name->name ?? '' }}"
                                                    class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <label class="form-label">Category Name</label>
                                                <input type="text" value="{{ $price_table->category_name->name ?? '' }}"
                                                    class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <label class="form-label">City Name</label>
                                                <input type="text" value="{{ $price_table->city_name->name ?? '' }}"
                                                    class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <label class="form-label">Min Price <span
                                                    class="text text-danger">*</span></label>
                                                <input type="number" name="price" value="{{ $price_table->price ?? '' }}"
                                                    class="form-control" min="0" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <label class="form-label">Max Price <span
                                                    class="text text-danger">*</span></label>
                                                <input type="number" name="max_price" value="{{ $price_table->max_price ?? '' }}"
                                                    class="form-control" min="0" required>
                                            </div>
                                        </div>
                                    </div>
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
