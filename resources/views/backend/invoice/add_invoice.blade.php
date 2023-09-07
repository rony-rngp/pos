@extends('layouts.backend.app')

@section('title', 'Add Invoice')

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
                                    <h4 class="card-title">Add Invoice</h4>
                                    <a href="{{ route('view.invoice') }}" class="btn mr-1 mb-1 btn-outline-primary"> Invoice List</a>
                                </div><hr style="margin: 0">
                                <div class="card-body card-dashboard">
                                    <form action="javascript:void(0)" method="post">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-2 col-12">
                                                    <div class="form-group">
                                                        <label for="date">Date</label>
                                                        <input type="text" name="date" readonly class="form-control" id="date" value="{{ date('Y-m-d', strtotime(\Carbon\Carbon::now())) }}" placeholder="Enter Date">
                                                    </div>
                                                </div>

                                                <div class="col-md-2 col-12">
                                                    <div class="form-group">
                                                        <label for="invoice_no">Invoice No</label>
                                                        <input type="text" name="invoice_no" readonly class="form-control" id="invoice_no" value="{{ $invoice_no }}" style="background-color: #D8FDBA" placeholder="Enter Invoice No">
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="category_id">Category</label>
                                                        <select name="category_id" id="category_id" class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                            <option value="">Select Category</option>
                                                            @foreach($categories as $category)
                                                                <option {{ old('category_id') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="product_id">Product Name</label>
                                                        <select name="product_id" id="product_id" class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                            <option value="">Select Product</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-2 col-12">
                                                    <div class="form-group">
                                                        <label for="current_stock_qty">Stock</label>
                                                        <input type="text" name="current_stock_qty" readonly class="form-control" id="current_stock_qty" style="background-color: #D8FDBA" placeholder="Enter Stock">
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-end">
                                                    <a class="btn btn-secondary  addeventmore" style="margin-top: 20px"><i class="fa fa-plus-circle"></i> Add Item</a>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div><hr>

                                <div class="card-body card-dashboard">
                                    <form class="form" id="quickForms" action="{{ route('store.invoice') }}" method="post">
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
                                                    <td colspan="4" class="text-right"><b style="margin-right: 9px;">Discount</b></td>
                                                    <td><input  type="text" name="discount_amount" id="discount_amount" class="form-control text-right" autocomplete="off" placeholder="Enter Discount Amount"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right" colspan="4"><b style="margin-right: 9px;">Total Amount</b></td>
                                                    <td>
                                                        <input type="text" name="estimated_amount" value="0" id="estimated_amount"
                                                               class="form-control text-right estimated_amount" readonly style="background-color: #D8FDBA">
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div><br>


                                        <div class="row">
                                            <div class="col-md-5 col-12">
                                                <label for="paid_status">Paid Status</label>
                                                <select name="paid_status" id="paid_status" class="form-control">
                                                    <option value="">Select Status</option>
                                                    <option value="full_paid">Full Paid</option>
                                                    <option value="full_due">Full Due</option>
                                                    <option value="partial_paid">Partial Paid</option>
                                                </select>
                                                <input type="text" name="paid_amount" style="display: none; margin-top: 6px" class="form-control paid_amount" placeholder="Amount">
                                            </div>

                                            <div class="col-md-7 col-12">
                                                <label for="customer_id">Customer Name</label>
                                                <select name="customer_id" id="customer_id" class="select2 form-control">
                                                    <option value="">Select Customer</option>
                                                    <option value="0">New Customer</option>
                                                    @foreach($customers as $customer)
                                                        <option value="{{ $customer->id }}">{{ $customer->name }} ( {{ $customer->mobile }} - {{ $customer->address }} )</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row new_customer" style="display: none;margin-top: 10px" >
                                            <div class="form-group col-md-4">
                                                <input type="text" name="name"  id="name" class="form-control " placeholder="Write Customer Name">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input type="text" name="mobile"  id="mobile" class="form-control " placeholder="Write Customer Mobile No">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input type="text" name="address"  id="address" class="form-control " placeholder="Write Customer Address">
                                            </div>
                                        </div>

                                        <button class="btn btn-primary shadow mt-1" type="submit">Store Invoice</button>
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
            <input type="hidden" name="invoice_no" value="@{{invoice_no}}">
            <td style="text-align: center">
                <input type="hidden" name="category_id[]" value="@{{category_id}}">
                @{{category_name}}
            </td>
            <td style="text-align: center">
                <input type="hidden" name="product_id[]" value="@{{product_id}}">
                @{{product_name}}
            </td>
            <td style="text-align: center">
                <input type="text" min="1" class="form-control text-right selling_qty" name="selling_qty[]" value="1">
            </td>
            <td style="text-align: center">
                <input type="text" class="form-control text-right unit_price"  name="unit_price[]" value="">
            </td>
            <td style="text-align: center">
                <input class="form-control text-right selling_price" name="selling_price[]" value="0" readonly>
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
                var invoice_no = $("#invoice_no").val();
                var category_id = $("#category_id").val();
                var category_name = $("#category_id").find('option:selected').text();
                var product_id = $("#product_id").val();
                var product_name = $("#product_id").find('option:selected').text();


                if(date == ""){
                    toastr.error("Date is Required");
                    return false;
                }
                if(invoice_no == ""){
                    toastr.error("Invoice No is Required");
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
                    invoice_no:invoice_no,
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

                $(document).on("keyup click", ".unit_price, .selling_qty", function () {
                    var unit_price = $(this).closest("tr").find("input.unit_price").val();
                    var qty = $(this).closest("tr").find("input.selling_qty").val();
                    var total = unit_price * qty;
                    $(this).closest("tr").find("input.selling_price").val(total);
                    $('#discount_amount').trigger('keyup');
                });

                $(document).on('keyup', '#discount_amount', function () {
                    totalAmountPrice();
                });

                //calculate sum of amount invoice
                function totalAmountPrice(){
                    var sum = 0;
                    $(".selling_price").each(function(){
                        var value = $(this).val();
                        if(!isNaN(value) && value.length != 0){
                            sum += parseFloat(value);
                        }
                    });

                    var discount_amount = parseFloat($('#discount_amount').val());
                    if(!isNaN(discount_amount) && discount_amount.lenght != 0 ){
                        sum -= parseFloat(discount_amount);
                    }

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
                    "selling_qty[]": {
                        required: true,
                        number : true
                    },
                    "discount_amount": {
                        number : true
                    },
                    paid_status : {
                        required : true,
                    },
                    paid_amount : {
                        required : true,
                        number : true
                    },
                    customer_id : {
                        required : true,
                    },
                    name : {
                        required : true,
                    },
                    mobile : {
                        required : true,
                        number : true
                    },
                    address : {
                        required : true,
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

            //show Product
            $(document).on("change","#category_id", function () {
                var category_id = $(this).val();
                $.ajax({
                    url : "{{ route('invoice.get.product') }}",
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

            //Product Stock
            $(function(){
                $(document).on('change', '#product_id',function () {
                    var product_id = $(this).val();
                    $.ajax({
                        url : "{{ route('check.product.stock') }}",
                        type : "post",
                        data : {product_id:product_id, "_token": "{{ csrf_token() }}"},
                        success : function (data) {
                            $('#current_stock_qty').val(data);
                        }
                    });
                });
            });

            <!-- Paid Status Hide/Show -->

            $(document).on('change', '#paid_status', function () {
                var paid_status = $(this).val();
                if(paid_status == 'partial_paid'){
                    $('.paid_amount').show();
                }else{
                    $('.paid_amount').val("");
                    $('.paid_amount').hide();
                }
            });


            <!-- New Customer Hide/Show -->
            $(document).on('change', '#customer_id', function () {
                var customer_id = $(this).val();
                if(customer_id == '0'){
                    $('.new_customer').show();
                }else{
                    $('#name').val("");
                    $('#mobile').val("");
                    $('#address').val("");
                    $('.new_customer').hide();
                }
            });
            <!-- End New Customer Hide/Show -->
        });
    </script>
@endpush
