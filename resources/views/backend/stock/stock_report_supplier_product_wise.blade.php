@extends('layouts.backend.app')

@section('title', 'Supplier/Product Wise Report')

@push('css')

@endpush

@section('content')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body"><!-- Dashboard Analytics Start -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Supplier/Product Wise Stock Report</h4>
                                </div><hr style="margin: 0">
                                <div class="card-body card-dashboard">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="d-inline-block mr-2 mb-1">
                                                            <fieldset>
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input search_value" name="customRadio" id="customRadio1" value="supplier_wise">
                                                                    <label class="custom-control-label" for="customRadio1">Supplier Wise</label>
                                                                </div>
                                                            </fieldset>
                                                        </li>&nbsp;&nbsp;&nbsp;
                                                        <li class="d-inline-block mr-2 mb-1">
                                                            <fieldset>
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input search_value" name="customRadio" value="product_wise" id="customRadio2">
                                                                    <label class="custom-control-label" for="customRadio2">Product Wise</label>
                                                                </div>
                                                            </fieldset>
                                                        </li>
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>

                                    <div class="show_supplier" style="display: none">
                                        <form id="supplierWiseForm" action="{{ route('stock.report.supplier.wise.pdf') }}" method="GET" target="_blank" id="supplierWiseForm">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="supplier_id">Supplier Name</label>
                                                    <select name="supplier_id" id="supplier_id" class="form-control">
                                                        <option value="">Select Supplier</option>
                                                        @foreach($supplier as $sup)
                                                            <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <button type="submit" style="margin-top: 22px" class="btn btn-primary">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>


                                    <div class="show_product" style="display: none">
                                        <form id="productWiseForm" action="{{ route('stock.report.product.wise.pdf') }}" method="GET" target="_blank" id="productWiseForm">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <label for="category_id">Category</label>
                                                    <select name="category_id" id="category_id" class="form-control">
                                                        <option value="">Select Category</option>
                                                        @foreach($category as $cat)
                                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-5">
                                                    <label for="product_id">Product</label>
                                                    <select name="product_id"  id="product_id" class="form-control">
                                                        <option value="">Select Product</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="submit" style="margin-top: 22px" class="btn btn-primary">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function () {

            $(document).on('change', '.search_value', function () {
                var search_value = $(this).val();
                if(search_value == 'supplier_wise'){
                    $('.show_supplier').show();
                }else{
                    $('.show_supplier').hide();
                }
            });

            $(document).on('change', '.search_value', function () {
                var search_value = $(this).val();
                if(search_value == 'product_wise'){
                    $('.show_product').show();
                }else{
                    $('.show_product').hide();
                }
            });

            $(document).on('change', '#category_id',function () {
                var category_id = $(this).val();
                $.ajax({
                    url : "{{ route('get.product.invoice.report') }}",
                    type : "GET",
                    data : {category_id:category_id},
                    success : function (data) {
                        var html = '<option>Select Product</option>';
                        $.each(data, function (key, v) {
                            html +='<option value="'+v.id+'">'+v.name+'</option>>';
                        });
                        $('#product_id').html(html);
                    }
                });
            });

            $("#productWiseForm").validate({
                rules: {
                    category_id: {
                        required: true,
                    },
                    product_id: {
                        required: true,
                    },
                },
                messages: {

                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            $("#supplierWiseForm").validate({
                rules: {
                    supplier_id: {
                        required: true,
                    },
                },
                messages: {

                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

    </script>
@endpush
