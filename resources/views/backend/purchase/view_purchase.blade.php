@extends('layouts.backend.app')

@section('title', 'Purchases')

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
                                    <h4 class="card-title">Purchase List</h4>
                                    <a href="{{ route('add.purchase') }}" class="btn mr-1 mb-1 btn-outline-primary"> Add Purchase</a>
                                </div><hr style="margin: 0">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>#SL</th>
                                                <th>Purchase No</th>
                                                <th>Date</th>
                                                <th>Supplier</th>
                                                <th>Category</th>
                                                <th>Product </th>
                                                <th>Quantity</th>
                                                <th>Unit Price</th>
                                                <th>Buying Price</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($purchases as $key => $purchase)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $purchase->purchase_no }}</td>
                                                    <td>{{ $purchase->date }}</td>
                                                    <td>{{ $purchase->supplier->name }}</td>
                                                    <td>{{ $purchase->category->name }}</td>
                                                    <td>{{ $purchase->product->name }}</td>
                                                    <td>{{ $purchase->buying_qty }}</td>
                                                    <td>{{ $purchase->unit_price }}</td>
                                                    <td>{{ $purchase->buying_price }}</td>
                                                    <td>
                                                        @if($purchase->status == 1)
                                                            <span class="badge badge-success">Active</span>
                                                        @else
                                                            <span class="badge badge-danger">Pending</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <th>#SL</th>
                                            <th>Purchase No</th>
                                            <th>Date</th>
                                            <th>Supplier</th>
                                            <th>Category</th>
                                            <th>Product </th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Buying Price</th>
                                            <th>Status</th>
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
