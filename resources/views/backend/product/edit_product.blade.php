@extends('layouts.backend.app')

@section('title', 'Edit Product')

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
                                    <h4 class="card-title">Edit Product</h4>
                                    <a href="{{ route('view.product') }}" class="btn mr-1 mb-1 btn-outline-primary"> Product List</a>
                                </div><hr style="margin: 0">
                                <div class="card-body card-dashboard">
                                    <form class="form" id="quickForms" action="{{ route('update.product',$product->id) }}" method="post">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="supplier_id">Supplier Name</label>
                                                        <select name="supplier_id" id="supplier_id" class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                            <option value="">Select Supplier</option>
                                                            @foreach($suppliers as $supplier)
                                                                <option {{ $product->supplier_id == $supplier->id ? 'selected' : '' }} value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span style="color:red">{{ $errors->has('supplier_id') ? $errors->first('supplier_id') : '' }}</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="category_id">Category Name</label>
                                                        <select name="category_id" id="category_id" class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                            <option value="">Select Category</option>
                                                            @foreach($categories as $category)
                                                                <option {{ $product->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span style="color:red">{{ $errors->has('category_id') ? $errors->first('category_id') : '' }}</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="name">Product Name</label>
                                                        <input type="text" name="name" class="form-control" id="name" value="{{ $product->name }}" placeholder="Enter Product Name">
                                                        <span style="color:red">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="unit_id">Unit</label>
                                                        <select name="unit_id" id="unit_id" class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                            <option value="">Select Unit</option>
                                                            @foreach($units as $unit)
                                                                <option {{ $product->unit_id == $unit->id ? 'selected' : '' }} value="{{ $unit->id }}">{{ $unit->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span style="color:red">{{ $errors->has('unit_id') ? $errors->first('unit_id') : '' }}</span>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary mr-1">Update</button>
                                                    <button type="reset" class="btn btn-light-secondary">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
            $("#quickForms").validate({
                rules: {
                    supplier_id: {
                        required: true,
                    },
                    category_id : {
                        required: true,
                    },
                    name: {
                        required: true,
                        minlength: 2,
                    },
                    unit_id: {
                        required: true,
                    },
                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a <em>vaild</em> email address"
                    },
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
