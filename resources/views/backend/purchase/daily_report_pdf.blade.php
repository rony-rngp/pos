<!doctype html>
<html lang="en">
<head>
    <title>Daily Purchase Report Pdf</title>
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
    <p style="text-align: center;"><i>Daily Purchase Report ( {{ $start_date }}  -  {{ $end_date }} )</i></p>
</div>
<!-- Table row -->
<div class="row">
    <div class="col-12 table-responsive " style="width: 100%">
        <table>
            <thead>
            <tr class="text-center">
            <tr>
                <th>SL</th>
                <th>Purchase No</th>
                <th>Date</th>
                <th>Supplier</th>
                <th>Product</th>
                <th width="10%">Qty</th>
                <th width="13%">Unit Price</th>
                <th>Buying Price</th>
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
                    <td>{{ $row->purchase_no }}</td>
                    <td>{{ date('d-m-Y', strtotime($row->date)) }}</td>
                    <td>{{ $row->supplier->name }}</td>
                    <td>{{ $row->product->name }}</td>
                    <td>{{ $row->buying_qty }} {{ $row->product->unit->name }}</td>
                    <td>{{ $row->unit_price }}</td>
                    <td>{{ $row->buying_price }}</td>
                    @php
                        $total_sum += $row->buying_price;
                    @endphp
                </tr>
            @endforeach
            <tr>
                <td style="text-align: right" colspan="7"><b>Grant Total : </b></td>
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


