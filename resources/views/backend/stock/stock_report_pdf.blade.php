<!doctype html>
<html lang="en">
<head>
    <title>Stocks Report Pdf</title>
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
        padding: 10px;
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
@php
    $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
@endphp
<!-- info row -->
<div class="row invoice-info" style="width:100%;margin-top: -25px">
    <p style="text-align: center;"><i>Stocks Report ( {{  $dt->format('j-F-Y') }} )</i></p>
</div>
<!-- Table row -->
<div class="row">
    <div class="col-12 table-responsive " style="width: 100%">
        <table>
            <thead>
            <tr class="text-center">
                <th >SL</th>
                <th>Supplier</th>
                <th>Category</th>
                <th>Product Name</th>
                <th width="10%">In Qty</th>
                <th width="12%">Out Qty</th>
                <th>Stock</th>
                <th>Unit</th>
            </tr>
            </thead>
            <tbody>
            @php
                $sl = 1;
            @endphp
            @foreach($all_data as $row)
                @php
                    $buying_total = \App\Models\Purchase::where('category_id', $row->category_id)->where('product_id', $row->id)->where('status', 1)->sum('buying_qty');
                    $selling_total = \App\Models\InvoiceDetails::where('category_id', $row->category_id)->where('product_id', $row->id)->where('status', 1)->sum('selling_qty');
                @endphp
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td>{{ $row->supplier->name }}</td>
                    <td>{{ $row->category->name }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $buying_total }}</td>
                    <td>{{ $selling_total }}</td>
                    <td>{{ $row->quantity }}</td>
                    <td>{{ $row->unit->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.col -->
</div>

<p><i>Printing Time : {{  $dt->format('j-F-Y, g:i a') }}</i></p>

</body>
</html>


