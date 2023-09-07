@extends('layouts.backend.app')

@section('title', 'Products')

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
                                    <h4 class="card-title">Product List</h4>
                                    <a href="{{ route('add.product') }}" class="btn mr-1 mb-1 btn-outline-primary"> Add Product</a>
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
                                                <th>Unit</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($products as $key => $product)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $product->supplier->name }}</td>
                                                    <td>{{ $product->category->name }}</td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->unit->name }}</td>
                                                    <td>
                                                        <a href="{{ route('edit.product',$product->id) }}" ><i class="bx bx-edit"></i></a>&nbsp;&nbsp;&nbsp;

                                                        @php
                                                            $count_product = \App\Models\Purchase::where('product_id', $product->id)->count();
                                                        @endphp

                                                        @if($count_product < 1)
                                                            <a href="javascript:void(0)" id="delete" type="button" onclick="deleteData({{ $product->id }})">
                                                                <i class="bx bx-trash-alt"></i>
                                                            </a>
                                                            <form id="delete-form-{{ $product->id }}" action="{{ route('destroy.product', $product->id) }}" method="post" style="display: none">
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
