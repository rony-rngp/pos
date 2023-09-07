@extends('layouts.backend.app')

@section('title', 'Add Purchase')

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
                                    <h4 class="card-title">Add Purchase</h4>
                                    <a href="{{ route('view.purchase') }}" class="btn mr-1 mb-1 btn-outline-primary"> Purchase List</a>
                                </div><hr style="margin: 0">
                                <div class="card-body card-dashboard">
                                    <form action="javascript:void(0)" method="post">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="date">Date</label>
                                                        <input type="text" name="date" readonly class="form-control" id="date" value="{{ date('Y-m-d', strtotime(\Carbon\Carbon::now())) }}" placeholder="Enter Date">
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="purchase_no">Purchase No</label>
                                                        <input type="text" name="purchase_no" readonly class="form-control" id="purchase_no" value="{{ $purchase_no }}" placeholder="Enter Purchase No">
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="supplier_id">Supplier Name</label>
                                                        <select name="supplier_id" id="supplier_id" class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                            <option value="">Select Supplier</option>
                                                            @foreach($suppliers as $supplier)
                                                                <option {{ old('supplier_id') == $supplier->id ? 'selected' : '' }} value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="category_id">Category Name</label>
                                                        <select name="category_id" id="category_id" class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                            <option value="">Select Category</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="product_id">Product Name</label>
                                                        <select name="product_id" id="product_id" class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                            <option value="">Select Product</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group" style="padding-top: 22px">
                                                        <a class="btn btn-primary  addeventmore"><i class="fa fa-plus-circle"></i> Add Item</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div><hr>

                                <div class="card-body card-dashboard">
                                    <form class="form" id="quickForms" action="{{ route('store.purchase') }}" method="post">
                                        @csrf
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0 table-sm">
                                                <thead>
                                                <tr style="text-align: center">
                                                    <th>Category</th>
                                                    <th>Product</th>
                                                    <th width="12%">Quantity</th>
                                                    <th width="12%">Unit Price</th>
                                                    <th width="12%">Total Price</th>
                                                    <th>ACTION</th>
                                                </tr>
                                                </thead>
                                                <tbody id="addRow" class="addRow">

                                                </tbody>
                                                <tbody>
                                                <tr>
                                                    <td colspan="4"></td>
                                                    <td>
                                                        <input type="text" name="estimated_amount" value="0" id="estimated_amount"
                                                               class="form-control text-right estimated_amount" readonly style="background-color: #D8FDBA">
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <button class="btn btn-primary shadow mt-1" type="submit">Store Purchase</button>
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
    <!-- Handlebar Js -->
    <script id="document-template" type="text/x-handlebars-template">
        <tr class="delete_add_more_item" id="delete_add_more_item">
            <input type="hidden" name="date" value="@{{date}}">
            <input type="hidden" name="purchase_no" value="@{{purchase_no}}">
            <input type="hidden" name="supplier_id[]" value="@{{supplier_id}}">
            <td style="text-align: center">
                <input type="hidden" name="category_id[]" value="@{{category_id}}">
                @{{category_name}}
            </td>
            <td style="text-align: center">
                <input type="hidden" name="product_id[]" value="@{{product_id}}">
                @{{product_name}}
            </td>
            <td style="text-align: center">
                <input type="text" min="1" class="form-control text-right buying_qty" name="buying_qty[]" value="1">
            </td>
            <td style="text-align: center">
                <input type="text" class="form-control text-right unit_price"  name="unit_price[]" value="">
            </td>
            <td style="text-align: center">
                <input class="form-control text-right buying_price" name="buying_price[]" value="0" readonly>
            </td>
            <td style="text-align: center">
                <i class=" btn btn-danger btn-sm fa fa-window-close removeeventmore"><span class="bx bx-trash"></span></i>
            </td>

        </tr>

    </script>

<script>
    $(document).ready(function () {
        //Handlebar js
        $(document).on("click", ".addeventmore", function(){
            var date = $("#date").val();
            var purchase_no = $("#purchase_no").val();
            var supplier_id = $("#supplier_id").val();
            var category_id = $("#category_id").val();
            var category_name = $("#category_id").find('option:selected').text();
            var product_id = $("#product_id").val();
            var product_name = $("#product_id").find('option:selected').text();

            if(date == ""){
                toastr.error("Date is Required");
                return false;
            }
            if(purchase_no == ""){
                toastr.error("Purchase No is Required");
                return false;
            }
            if(supplier_id == ""){
                toastr.error("Supplier is Required");
                return false;
            }
            if(category_id == ""){
                toastr.error("Category is Required");
                return false;
            }
            if(product_id == ""){
                toastr.error("Product is Required");
                return false;
            }

            var source = $("#document-template").html();
            var template = Handlebars.compile(source);
            var data = {
                date:date,
                purchase_no:purchase_no,
                supplier_id:supplier_id,
                category_id:category_id,
                category_name:category_name,
                product_id:product_id,
                product_name:product_name
            }

            var html = template(data);
            $("#addRow").append(html);

            //remove item
            $(document).on("click", ".removeeventmore", function () {
                $(this).closest(".delete_add_more_item").remove();
                totalAmountPrice();
            });

            $(document).on("keyup click", ".unit_price, .buying_qty", function () {
                var unit_price = $(this).closest("tr").find("input.unit_price").val();
                var qty = $(this).closest("tr").find("input.buying_qty").val();
                var total = unit_price * qty;
                $(this).closest("tr").find("input.buying_price").val(total);
                totalAmountPrice();
            });

            //calculate sum of amount invoice
            function totalAmountPrice(){
                var sum = 0;
                $(".buying_price").each(function(){
                    var value = $(this).val();
                    if(!isNaN(value) && value.length != 0){
                        sum += parseFloat(value);
                    }
                });
                $('#estimated_amount').val(sum);
            }

        });
        //End Handlebar

        //validation
        $("#quickForms").validate({
            rules: {
                "unit_price[]": {
                    required: true,
                    number : true
                },
                "buying_qty[]": {
                    required: true,
                    number : true
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

        //show category
        $(document).on("change","#supplier_id", function () {
            var supplier_id = $(this).val();
            $("#category_id").html("");
            $("#product_id").html("");
            $.ajax({
                url : "{{ route('purchase.get.category') }}",
                type : "post",
                data : {supplier_id:supplier_id, "_token": "{{ csrf_token() }}"},
                success:function (res) {
                    var html = '<option value="">Select Category</option>';
                    $.each(res, function (key, v) {
                        html +='<option value="'+v.category.id+'">'+v.category.name+'</option>';
                    });
                    $('#category_id').html(html);
                }
            });
        });

        //show Product
        $(document).on("change","#category_id", function () {
            var category_id = $(this).val();
            $.ajax({
                url : "{{ route('purchase.get.product') }}",
                type : "post",
                data : {category_id:category_id, "_token": "{{ csrf_token() }}"},
                success:function (res) {
                    var html = '<option value="">Select Product</option>';
                    $.each(res, function (key, v) {
                        html +='<option value="'+v.id+'">'+v.name+'</option>';
                    });
                    $('#product_id').html(html);
                }
            });
        });
    });
</script>
@endpush
