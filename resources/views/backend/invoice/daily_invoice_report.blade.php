@extends('layouts.backend.app')

@section('title', 'Daily Report')

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
                                    <h4 class="card-title">Daily Invoice Report</h4>
                                    <a href="{{ route('view.invoice') }}" class="btn mr-1 mb-1 btn-outline-primary"> Invoice List</a>
                                </div><hr style="margin: 0">
                                <div class="card-body card-dashboard">
                                    <form class="form" id="quickForms" target="_blank" action="{{ route('daily.invoice.report.pdf') }}" method="get">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="start_date">Start Date</label>
                                                        <fieldset class="form-group position-relative has-icon-left">
                                                            <input type="text" name="start_date" class="form-control pickadate-months-year picker__input" id="start_date" value="{{ old('start_date') }}" placeholder="Enter Start Date">
                                                            <div class="form-control-position">
                                                                <i class='bx bx-calendar'></i>
                                                            </div>
                                                            <span style="color:red">{{ $errors->has('start_date') ? $errors->first('start_date') : '' }}</span>
                                                        </fieldset>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="end_date">End Date</label>
                                                        <fieldset class="form-group position-relative has-icon-left">
                                                            <input type="text" name="end_date" class="form-control pickadate-months-year picker__input" id="end_date" value="{{ old('end_date') }}" placeholder="Enter End Date">
                                                            <div class="form-control-position">
                                                                <i class='bx bx-calendar'></i>
                                                            </div>
                                                            <span style="color:red">{{ $errors->has('end_date') ? $errors->first('end_date') : '' }}</span>
                                                        </fieldset>
                                                    </div>
                                                </div>


                                                <div class="col-4 justify-content-end">
                                                    <button style="margin-top: 22px" type="submit" class="btn btn-outline-primary">Search</button>
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
                    start_date: {
                        required: true,
                    },
                    end_date: {
                        required: true,
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
