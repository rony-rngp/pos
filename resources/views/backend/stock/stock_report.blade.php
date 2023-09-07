@extends('layouts.backend.app')

@section('title', 'Stocks')

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
                                    <h4 class="card-title">Stock Report</h4>
                                    <a href="{{ route('stock.report.pdf') }}" target="_blank" class="btn mr-1 mb-1 btn-success"><i class="bx bxs-download"></i> Download PDF</a>
                                </div><hr style="margin: 0">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>#SL</th>
                                                <th>Supplier</th>
                                                <th>Category</th>
                                                <th>Product Name</th>
                                                <th>In Qty</th>
                                                <th>Out Qty</th>
                                                <th>Stock</th>
                                                <th>Unit</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($products as $key => $product)
                                                <tr>
                                                    @php
                                                        $buying_total = \App\Models\Purchase::where('category_id', $product->category_id)->where('product_id', $product->id)->where('status', 1)->sum('buying_qty');
                                                        $selling_total = \App\Models\InvoiceDetails::where('category_id', $product->category_id)->where('product_id', $product->id)->where('status', 1)->sum('selling_qty');
                                                    @endphp
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $product->supplier->name }}</td>
                                                    <td>{{ $product->category->name }}</td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $buying_total }}</td>
                                                    <td>{{ $selling_total }}</td>
                                                    <td>{{ $product->quantity }}</td>
                                                    <td>{{ $product->unit->name }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <th>#SL</th>
                                            <th>Supplier</th>
                                            <th>Category</th>
                                            <th>Product Name</th>
                                            <th>In Qty</th>
                                            <th>Out Qty</th>
                                            <th>Stock</th>
                                            <th>Unit</th>
                                            </tfoot>
                                        </table>
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
