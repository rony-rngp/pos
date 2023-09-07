@extends('layouts.backend.app')

@section('title', 'Suppliers')

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
                                    <h4 class="card-title">Supplier List</h4>
                                    <a href="{{ route('add.supplier') }}" class="btn mr-1 mb-1 btn-outline-primary"> Add Supplier</a>
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
                                                @foreach($suppliers as $key => $supplier)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $supplier->name }}</td>
                                                        <td>{{ $supplier->mobile }}</td>
                                                        <td>{{ $supplier->email }}</td>
                                                        <td>{{ $supplier->address }}</td>
                                                        <td>
                                                            <a href="{{ route('edit.supplier',$supplier->id) }}" ><i class="bx bx-edit"></i></a>&nbsp;&nbsp;&nbsp;

                                                            @php
                                                                $count_supplier = \App\Models\Product::where('supplier_id', $supplier->id)->count();
                                                            @endphp
                                                            @if($count_supplier < 1)
                                                                <a href="javascript:void(0)" id="delete" type="button" onclick="deleteData({{ $supplier->id }})">
                                                                    <i class="bx bx-trash-alt"></i>
                                                                </a>
                                                                <form id="delete-form-{{ $supplier->id }}" action="{{ route('destroy.supplier', $supplier->id) }}" method="post" style="display: none">
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
