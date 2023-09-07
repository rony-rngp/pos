@extends('layouts.backend.app')

@section('title', 'Customers')

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
                                    <h4 class="card-title">Customer List</h4>
                                    <a href="{{ route('add.customer') }}" class="btn mr-1 mb-1 btn-outline-primary"> Add Customer</a>
                                </div><hr style="margin: 0">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>#SL</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($customers as $key => $customer)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $customer->name }}</td>
                                                    <td>{{ $customer->mobile }}</td>
                                                    <td>{{ $customer->email }}</td>
                                                    <td>{{ $customer->address }}</td>
                                                    <td>
                                                        <a href="{{ route('edit.customer',$customer->id) }}" ><i class="bx bx-edit"></i></a>&nbsp;&nbsp;&nbsp;

                                                        @php
                                                            $count_customer = \App\Models\Payment::where('customer_id', $customer->id)->count();
                                                        @endphp

                                                        @if($count_customer < 1)
                                                            <a href="javascript:void(0)" id="delete" type="button" onclick="deleteData({{ $customer->id }})">
                                                                <i class="bx bx-trash-alt"></i>
                                                            </a>
                                                            <form id="delete-form-{{ $customer->id }}" action="{{ route('destroy.customer', $customer->id) }}" method="post" style="display: none">
                                                                @csrf
                                                                @method('post')
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <th>#SL</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Address</th>
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
