@extends('layouts.backend.app')

@section('title', 'Edit Profile')

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
                                    <h4 class="card-title">Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                    <form id="quickForms" action="{{ route('update.profile',$user->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" id="name" class="form-control" name="name" value="{{ $user->name }}" placeholder="Enter Name">
                                                        <span style="color:red">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" id="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="Enter E-Mail">
                                                        <span style="color:red">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="mobile">Mobile</label>
                                                        <input type="text" id="mobile" class="form-control" name="mobile" value="{{ $user->mobile }}" placeholder="Enter Mobile">
                                                        <span style="color:red">{{ $errors->has('mobile') ? $errors->first('mobile') : '' }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <input type="text" id="address" class="form-control" name="address" value="{{ $user->address }}" placeholder="Enter Address">
                                                        <span style="color:red">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="gender">Gender</label>
                                                        <select name="gender" id="gender" class="form-control">
                                                            <option value="">Select Gender</option>
                                                            <option {{ $user->gender == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                                                            <option {{ $user->gender == 'Female' ? 'selected' : '' }} value="Female">Female</option>
                                                            <option {{ $user->gender == 'Other' ? 'selected' : '' }} value="Other">Other</option>
                                                        </select>
                                                        <span style="color:red">{{ $errors->has('gender') ? $errors->first('gender') : '' }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="image">Image</label>
                                                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                                        <span style="color:red">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                                                    </div>
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
                        minlength: 2,
                    },
                    email: {
                        required: true,
                        email :true
                    },
                    mobile : {
                        number : true
                    }
                },
                messages: {

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
