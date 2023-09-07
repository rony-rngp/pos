<!doctype html>
<html lang="en">
<head>
    <title>Customer Payment Pdf</title>
</head>
<style>
    table, td, th {
        border: 1px solid #ddd;
        text-align: left;
        text-align: center;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        padding: 8px;
    }
</style>
<body>
<div class="col-12">
    <h4 style="text-align: center">
        @php
            $shop = \App\Models\ShopDetails::first();
        @endphp
        <i class="fas fa-globe">{{ $shop->name }}</i><br>
        <i class="fas fa-globe">{{ $shop->address }}</i>
    </h4>
</div>
<!-- info row -->
<div class="row invoice-info" style="width:100%">
    <div class="left_content" style="width: 33.33%;float: left">
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
    <div class="middle_content" style="float: left; width: 33.33%">
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
    <div class="right_content" style="float: right; width: 30.33%"><br>
        <b>Date </b>: {{ date('d-m-Y', strtotime($invoice->date))}}<br>
        <b>Invoice : #{{ $invoice->invoice_no }}</b><br>
    </div>
    <!-- /.col -->
</div>
<br>

<!-- Table row -->
<div class="row">
    <div class="col-12 table-responsive " style="width: 100%">
        <table>
            <thead>
            <tr class="text-center">
                <th>Serial #</th>
                <th>Category</th>
                <th>Product</th>
                <th>Qty (PCS/KG)</th>
                <th>Unit Price</th>
                <th>Total Price</th>
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

<div style="width: 100%">
    <!-- accepted payments column -->

    <div style="width: 48%;float: left; padding-right: 1px">
        <p class="lead"><b><i>Payment Summary :</i></b></p>
        <table class="table">
            <tbody>
            <tr class="text-center">
                <th>Date</th>
                <th>Ammount</th>
            </tr>
            @foreach($invoice->payment_details as $rows)
                <tr>
                    <td>{{ date('d-m-Y', strtotime($rows->date))}}</td>
                    <td>{{ $rows->current_paid_amount }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- /.col -->
    <div style="width: 50%; float: right" >
        <p style="text-align: center"><b><i>Your Final Paymen</i>t</b> </p>
        <div class="table-responsive text-right float-right">
            <table class="table">
                <tbody><tr class="text-center">
                    <th>Subtotal :</th>
                    <td><strong>{{$total_sum}}</strong></td>
                </tr>
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
        </div>
    </div>
    <!-- /.col -->
</div><hr>
@php
    $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
@endphp
<p><i>Printing Time : {{  $dt->format('j-F-Y, g:i a') }}</i></p>

<div style="width: 100%; margin: 0;padding:0">
    <div style="width: 30%; float: left">
        <p style="text-align:center; border-bottom: 0.5px solid">Customer Signature</p>
    </div>
    <div style="width: 30%;float: right;">
        <p style="text-align:center; border-bottom: 0.5px solid">Seller Signature</p>
    </div>
</div>
</body>
</html>


