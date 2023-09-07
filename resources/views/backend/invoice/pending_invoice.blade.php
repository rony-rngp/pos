@extends('layouts.backend.app')

@section('title', 'Pending Invoice')

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
                                    <h4 class="card-title">Pending Invoices</h4>
                                </div><hr style="margin: 0">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>Invoice No</th>
                                                <th>Customer</th>
                                                <th>Date</th>
                                                <th>Amount </th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($invoices as $key => $invoice)
                                                <tr>
                                                    <td>#{{ $invoice->invoice_no }}</td>
                                                    <td>{{ $invoice->payment->customer->name }}</td>
                                                    <td>{{ $invoice->date }}</td>
                                                    <td>{{ $invoice->payment->total_amount }}</td>

                                                    <td>
                                                        @if($invoice->status == 1)
                                                            <span class="badge badge-success">Active</span>
                                                        @else
                                                            <span class="badge badge-danger">Pending</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-primary" href="{{ route('approve.invoice',$invoice->id) }}" title="Approve">Approve</a>&nbsp;

                                                        <a class="btn btn-sm btn-danger" href="javascript:void(0)" id="delete" type="button" title="Delete" onclick="deleteData({{ $invoice->id }})">
                                                            <i class="bx bx-trash"></i>
                                                        </a>
                                                        <form id="delete-form-{{ $invoice->id }}" action="{{ route('destroy.invoice', $invoice->id) }}" method="post" style="display: none">
                                                            @csrf
                                                            @method('post')
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <th>Invoice No</th>
                                            <th>Customer</th>
                                            <th>Date</th>
                                            <th>Amount </th>
                                            <th>Status</th>
                                            <th>Action</th>
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
