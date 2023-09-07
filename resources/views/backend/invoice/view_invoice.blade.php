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
                                    <h4 class="card-title">Invoice List</h4>
                                    <a href="{{ route('add.invoice') }}" class="btn mr-1 mb-1 btn-outline-primary"> Add Invoice</a>
                                </div><hr style="margin: 0">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>#SL</th>
                                                <th>Customer</th>
                                                <th>Invoice No</th>
                                                <th>Date</th>
                                                <th>Amount </th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($invoices as $key => $invoice)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $invoice->payment->customer->name }}</td>
                                                    <td>#{{ $invoice->invoice_no }}</td>
                                                    <td>{{ $invoice->date }}</td>
                                                    <td>{{ $invoice->payment->total_amount }}</td>

                                                    <td>
                                                        @if($invoice->status == 1)
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
                                            <th>Customer</th>
                                            <th>Invoice No</th>
                                            <th>Date</th>
                                            <th>Amount </th>
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
