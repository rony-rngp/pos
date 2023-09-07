@extends('layouts.backend.app')

@section('title', 'Credit Customer')

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
                                    <h4 class="card-title">Credit Customer List</h4>
                                    <a href="{{ route('credit.customer.pdf') }}" target="_blank" class="btn btn-success"><i class="bx bx-download"></i> Download PDF</a>
                                </div><hr style="margin: 0">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>#SL</th>
                                                <th>Name</th>
                                                <th>Invoice No</th>
                                                <th>Date</th>
                                                <th>Due Amount</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($credit_customers as $key => $customer)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $customer->customer->name }}</td>
                                                    <td>#{{ $customer->invoice->invoice_no }}</td>
                                                    <td>{{ $customer->invoice->date }}</td>
                                                    <td>{{ $customer->due_amount }}</td>
                                                    <td>
                                                        <a href="{{ route('edit.credit.customer',$customer->invoice_id) }}" title="Edit"><i class="bx bx-edit"></i></a>&nbsp;&nbsp;&nbsp;
                                                        <a href="{{ route('view.customer.details.pdf',$customer->invoice_id) }}" target="_blank" title="Details" ><i class="bx bxs-show"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <th>#SL</th>
                                            <th>Name</th>
                                            <th>Invoice No</th>
                                            <th>Date</th>
                                            <th>Due Amount</th>
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
