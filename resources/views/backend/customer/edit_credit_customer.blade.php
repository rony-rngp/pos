@extends('layouts.backend.app')

@section('title', 'Edit Credit Customer')

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
                                    <h4 class="card-title">Edit Credit Customer</h4>
                                </div><hr style="margin: 0">
                                <div class="card-body card-dashboard">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="invoice ">
                                                <!-- title row -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h4 style="float: left">
                                                            <i class="fas fa-mobile-phone"></i> Edit Payment Details
                                                        </h4>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h4 style="float: right">
                                                            Date: {{ $invoice->date }}
                                                        </h4>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- info row -->
                                                <div class="row invoice-info">
                                                    <div class="col-sm-4 invoice-col">
                                                        From
                                                        <address>
                                                            <strong>{{ Auth::user()->name }} ( Owner )</strong><br>
                                                            @if(Auth::user()->address)
                                                                {{ Auth::user()->address }} <br>
                                                            @else

                                                            @endif

                                                            @if(Auth::user()->mobile)
                                                                Phone: {{ Auth::user()->mobile }} <br>
                                                            @else
                                                                Phone: <i>Null</i> <br>
                                                            @endif
                                                            Email: {{ Auth::user()->email }}
                                                        </address>
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-sm-4 invoice-col">
                                                        To
                                                        <address>
                                                            <strong>{{ $invoice->payment->customer->name }}</strong><br>
                                                            {{ $invoice->payment->customer->address }}<br>
                                                            Phone: {{ $invoice->payment->customer->mobile }}<br>
                                                            @if($invoice->payment->customer->email)
                                                                Phone: {{ $invoice->payment->customer->email }} <br>
                                                            @else
                                                                Email: <i>Null</i>
                                                            @endif

                                                        </address>
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-sm-4 invoice-col">

                                                        <b>Invoice : #{{ $invoice->invoice_no }}</b><br>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                                <form action="{{ route('update.credit.customer', $invoice->id) }}" id="quickForms" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-12 table-responsive ">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                <tr>
                                                                    <th class="text-center">Serial #</th>
                                                                    <th class="text-center">Category</th>
                                                                    <th class="text-center">Product</th>
                                                                    <th class="text-center">Qty (PCS/KG)</th>
                                                                    <th class="text-center">Unit Price</th>
                                                                    <th class="text-center">Total Price</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @php
                                                                    $total_sum = 0;
                                                                @endphp

                                                                @foreach($invoice->invoice_details as $key => $invoice_detail)
                                                                    <tr class="text-center">
                                                                        <td>{{ $key+1 }}</td>
                                                                        <td>{{ $invoice_detail->category->name }}</td>
                                                                        <td>{{ $invoice_detail->product->name }}</td>
                                                                        <td>{{ $invoice_detail->selling_qty }}</td>
                                                                        <td>{{ $invoice_detail->unit_price }}</td>
                                                                        <td>{{ $invoice_detail->selling_price }}</td>
                                                                    </tr>
                                                                    @php
                                                                        $total_sum +=  $invoice_detail->selling_price;
                                                                    @endphp
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.row -->

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group col-md-8"><br>
                                                                <p class="text-center lead">Enter Your Paid Status :</p><br>
                                                                <label for="paid_status">Paid Status</label>
                                                                <select name="paid_status" id="paid_status"  id="paid_status" class="form-control ">
                                                                    <option value="">Select Status</option>
                                                                    <option value="full_paid">Full Paid</option>
                                                                    <option value="partial_paid">Partial Paid</option>
                                                                </select>
                                                                <input type="text" name="paid_amount" style="display: none" class="form-control paid_amount mt-1" placeholder="Enter Amount">
                                                            </div>
                                                            <div class="form-group col-md-8">
                                                                <label for="date">Date</label>
                                                                <input  type="date" name="date" id="date" class="form-control datepicker" placeholder="YYY-MM-DD" >
                                                            </div>
                                                        </div>

                                                    <!-- /.col -->
                                                        <div class="col-md-6 " style="float: right">
                                                            <p class="text-center lead">Your Final Payment :</p>
                                                            <div class="table-responsive text-right float-right">
                                                                <table class="table">
                                                                    <tbody><tr class="text-center">
                                                                        <th style="width:50%">Subtotal :</th>
                                                                        <td><strong>{{$total_sum}}</strong></td>
                                                                    </tr>
                                                                    <tr class="text-center">
                                                                    <tr class="text-center">
                                                                        <th>Discount : </th>
                                                                        @if($invoice->payment->discount_amount)
                                                                            <td><strong>{{ $invoice->payment->discount_amount }}</strong></td>
                                                                        @else
                                                                            <td><strong>0</strong></td>
                                                                        @endif
                                                                    </tr>
                                                                    <tr class="text-center">
                                                                        <th>Paid Amount :</th>
                                                                        <td><strong>{{ $invoice->payment->paid_amount }}</strong></td>
                                                                    </tr>
                                                                    <tr class="text-center">
                                                                        <th>Due Amount :</th>
                                                                        <td><strong>{{ $invoice->payment->due_amount }}</strong></td>
                                                                        <input type="hidden" name="new_paid_amount" value="{{ $invoice->payment->due_amount }}">
                                                                    </tr>
                                                                    <tr class="text-center">
                                                                        <th>Grand Total :</th>
                                                                        <td><strong>{{ $invoice->payment->total_amount }}</strong></td>
                                                                    </tr>

                                                                    </tbody></table>
                                                                <div class="col-12 text-center">
                                                                    <button class="btn btn-success"> Update Payment</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </form>
                                            </div>
                                            <!-- /.row -->


                                        </div>
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

            $(document).on('change', '#paid_status', function () {
                var paid_status = $(this).val();
                if(paid_status == 'partial_paid'){
                    $('.paid_amount').show();
                }else{
                    $('.paid_amount').val("");
                    $('.paid_amount').hide();
                }
            });

            $("#quickForms").validate({
                rules: {
                    paid_status: {
                        required: true,
                    },

                    paid_amount: {
                        required : true,
                        number : true,
                    },

                    date: {
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
