@extends('layouts.backend.app')

@section('title', 'Invoices')

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
                                    <h4 class="card-title">Main Invoice</h4>
                                </div><hr style="margin: 0">
                                <div class="card-body card-dashboard">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="invoice ">
                                                <!-- title row -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h4 style="float: left">
                                                            <i class="fas fa-mobile-phone"></i> Approve Invoice
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
                                                <form action="{{ route('approve.store.invoice', $invoice->id) }}" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-12 table-responsive ">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                <tr>
                                                                    <th class="text-center">Serial #</th>
                                                                    <th class="text-center">Category</th>
                                                                    <th class="text-center">Product</th>
                                                                    <th class="text-center" style="background-color: #c0c0c069">Current Stock</th>
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
                                                                        <input type="hidden" name="category_id[]" value="{{ $invoice_detail->category_id }}">
                                                                        <input type="hidden" name="product_id[]" value="{{ $invoice_detail->product_id }}">
                                                                        <input type="hidden" name="selling_qty[{{ $invoice_detail->id }}]" value="{{ $invoice_detail->selling_qty }}">
                                                                        <td>{{ $key+1 }}</td>
                                                                        <td>{{ $invoice_detail->category->name }}</td>
                                                                        <td>{{ $invoice_detail->product->name }}</td>
                                                                        <td style="background-color: #c0c0c069">{{ $invoice_detail->product->quantity }}</td>
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


                                                    <!-- /.col -->
                                                    <div class="col-md-6 col-md-offset-3" style="float: right">
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
                                                                </tr>
                                                                <tr class="text-center">
                                                                    <th>Grand Total :</th>
                                                                    <td><strong>{{ $invoice->payment->total_amount }}</strong></td>
                                                                </tr>

                                                                </tbody></table>
                                                            <div class="col-12 text-center">
                                                                <button class="btn btn-success"> Submit Payment</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </form></div>
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

@endpush
