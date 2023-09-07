@extends('layouts.backend.app')

@section('title', 'Shop Details')

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
                                    <h4 class="card-title">Shop Details</h4>
                                </div><hr style="margin: 0">
                                <div class="card-body">
                                    <form id="quickForms" action="{{ route('update.shop.details', $shop->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="name">Shop Name</label>
                                                    <input type="text" name="name" class="form-control" id="name" value="{{ $shop->name }}" placeholder="Enter Shop Name">
                                                    <span style="color:red">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="address">Shop Address</label>
                                                    <input type="text" class="form-control" name="address" id="address" value="{{ $shop->address }}" placeholder="Enter Address">
                                                    <span style="color:red">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                                                </div>

                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary mr-1">Update</button>
                                                    <button type="reset" class="btn btn-light-secondary">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
    <script type="text/javascript">
        $(document).ready(function () {
            $("#quickForms").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    address: {
                        required: true,
                        minlength: 4
                    },
                },
                messages: {
                    c_pwd: {
                        remote: "Current password is wrong (:",
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

    </script>
@endpush
