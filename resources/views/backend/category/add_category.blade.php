@extends('layouts.backend.app')

@section('title', 'Add Category')

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
                                    <h4 class="card-title">Add Category</h4>
                                    <a href="{{ route('view.category') }}" class="btn mr-1 mb-1 btn-outline-primary"> Category List</a>
                                </div><hr style="margin: 0">
                                <div class="card-body card-dashboard">
                                    <form class="form" id="quickForms" action="{{ route('store.category') }}" method="post">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="name">Category Name</label>
                                                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Enter Name">
                                                        <span style="color:red">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                                    </div>
                                                </div>


                                                <div class="col-12 justify-content-end">
                                                    <button type="submit" class="btn btn-primary mr-1">Submit</button>
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
