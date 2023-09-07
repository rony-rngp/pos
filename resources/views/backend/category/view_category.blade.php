@extends('layouts.backend.app')

@section('title', 'Categories')

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
                                    <h4 class="card-title">Category List</h4>
                                    <a href="{{ route('add.category') }}" class="btn mr-1 mb-1 btn-outline-primary"> Add Category</a>
                                </div><hr style="margin: 0">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>#SL</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($categories as $key => $category)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>
                                                        <a href="{{ route('edit.category',$category->id) }}" ><i class="bx bx-edit"></i></a>&nbsp;&nbsp;&nbsp;

                                                        @php
                                                            $count_category = \App\Models\Product::where('category_id', $category->id)->count();
                                                        @endphp
                                                        @if($count_category < 1)
                                                            <a href="javascript:void(0)" id="delete" type="button" onclick="deleteData({{ $category->id }})">
                                                                <i class="bx bx-trash-alt"></i>
                                                            </a>
                                                            <form id="delete-form-{{ $category->id }}" action="{{ route('destroy.category', $category->id) }}" method="post" style="display: none">
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
