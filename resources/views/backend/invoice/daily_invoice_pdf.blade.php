<!doctype html>
<html lang="en">
<head>
    <title>Daily Invoice Report Pdf</title>
</head>
<style>
    table, td, th {
        border: 1px solid #ddd;
        text-align: center;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        padding: 5px;
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
<div class="row invoice-info" style="width:100%;margin-top: -25px">
    <p style="text-align: center;"><i>Daily Invoice Report ( {{ $start_date }}  -  {{ $end_date }} )</i></p>
</div>
<!-- Table row -->
<div class="row">
    <div class="col-12 table-responsive " style="width: 100%">
        <table>
            <thead>
            <tr class="text-center">
            <tr>
                <th>SL</th>
                <th>Customer Name</th>
                <th>Invoice No</th>
                <th>Date</th>
                <th>Amount</th>
            </tr>
            </thead>
            <tbody>
            @php
                $sl = 1;
                $total_sum = 0;
            @endphp
            @foreach($all_data as $row)
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td>{{ $row->payment->customer->name }} ( {{ $row->payment->customer->mobile }} - {{ $row->payment->customer->address }})</td>
                    <td>#{{ $row->invoice_no }}</td>
                    <td>{{ $row->date }}</td>
                    <td>{{ $row->payment->total_amount }}</td>
                    @php
                        $total_sum += $row->payment->total_amount;
                    @endphp
                </tr>
            @endforeach
            <tr>
                <td style="text-align: right" colspan="4"><b>Grant Total : </b></td>
                <td colspan="1"><b>{{ $total_sum }}</b></td>
            </tr>
            </tbody>
        </table>
    </div>
    <!-- /.col -->
</div><hr>
@php
    $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
@endphp
<p><i>Printing Time : {{  $dt->format('j-F-Y, g:i a') }}</i></p>

</body>
</html>


