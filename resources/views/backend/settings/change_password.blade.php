@extends('layouts.backend.app')

@section('title', 'Change Password')

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
                                    <h4 class="card-title">Change Password</h4>
                                </div><hr style="margin: 0">
                                <div class="card-body">
                                    <form id="quickForms" action="{{ route('update.password') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="c_pwd"> Current Password</label>
                                                    <input type="password" name="c_pwd" class="form-control" id="c_pwd" placeholder="Enter Current Password">
                                                    <span id="check_C_pwd"></span>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="n_pwd">New Password</label>
                                                    <input type="password" class="form-control" name="n_pwd" id="n_pwd" placeholder="Enter New Password">
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="con_pwd">Confirm Password</label>
                                                    <input type="password" name="con_pwd" class="form-control" id="con_pwd" placeholder="Enter Confirm Password">
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
                    c_pwd: {
                        required: true,
                        remote: "{{ route('check.current.pwd') }}"
                    },
                    n_pwd: {
                        required: true,
                        minlength: 8
                    },
                    con_pwd: {
                        required: true,
                        equalTo: "#n_pwd"
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
