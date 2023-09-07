@extends('layouts.backend.app')

@section('title', 'Units')

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
                                    <h4 class="card-title">Unit List</h4>
                                    <a href="{{ route('add.unit') }}" class="btn mr-1 mb-1 btn-outline-primary"> Add Unit</a>
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
                                            @foreach($units as $key => $unit)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $unit->name }}</td>
                                                    <td>
                                                        <a href="{{ route('edit.unit',$unit->id) }}" ><i class="bx bx-edit"></i></a>&nbsp;&nbsp;&nbsp;

                                                        @php
                                                            $count_unit = \App\Models\Product::where('unit_id', $unit->id)->count();
                                                        @endphp

                                                        @if($count_unit < 1)
                                                            <a href="javascript:void(0)" id="delete" type="button" onclick="deleteData({{ $unit->id }})">
                                                                <i class="bx bx-trash-alt"></i>
                                                            </a>
                                                            <form id="delete-form-{{ $unit->id }}" action="{{ route('destroy.unit', $unit->id) }}" method="post" style="display: none">
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
