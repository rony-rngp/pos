<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Dashboard</title>

    <link rel="apple-touch-icon" href="{{ asset('public/backend') }}/app-assets/images/ico/apple-icon-120.html">
    <link rel="shortcut icon" type="image/x-icon" href="https://www.pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/app-assets/vendors/css/extensions/dragula.min.css">
    <!-- BEGIN: Datatable-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
    <!-- BEGIN: Sweetalert-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/app-assets/vendors/css/extensions/sweetalert2.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/app-assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/app-assets/css/components.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/app-assets/css/themes/dark-layout.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/app-assets/css/themes/semi-dark-layout.min.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/app-assets/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/app-assets/css/pages/widgets.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/app-assets/css/pages/dashboard-analytics.min.css">
    <!-- BEGIN: Validation-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/app-assets/css/plugins/forms/validation/form-validation.css">
    <!-- BEGIN: Toastr-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/toastr/toastr.min.css">
    <!-- BEGIN: Select2-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/app-assets/vendors/css/forms/select/select2.min.css">
    <!-- BEGIN: Datepicker-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/app-assets/vendors/css/pickers/daterange/daterangepicker.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/assets/css/style.css">
    <!-- END: Custom CSS-->

    @stack('css')

</head>
<body class="vertical-layout vertical-menu-modern boxicon-layout no-card-shadow 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<!-- BEGIN: Header-->
@include('layouts.backend.partial.header')
<!-- END: Header-->

<!-- BEGIN: Main Menu-->
@include('layouts.backend.partial.sidebar')
<!-- END: Main Menu-->

<!-- BEGIN: Content-->
@yield('content')
<!-- END: Content-->


<!-- BEGIN: Customizer-->
<div class="customizer d-none d-md-block"><a class="customizer-toggle" href="javascript:void(0);"><i class="bx bx-cog bx bx-spin white"></i></a><div class="customizer-content p-2">
        <h4 class="text-uppercase mb-0">Theme Customizer</h4>
        <small>Customize & Preview in Real Time</small>
        <a href="javascript:void(0)" class="customizer-close">
            <i class="bx bx-x"></i>
        </a>
        <hr>
        <!-- Theme options starts -->
        <h5 class="mt-1">Theme Layout</h5>
        <div class="theme-layouts">
            <div class="d-flex justify-content-start">
                <div class="mx-50">
                    <fieldset>
                        <div class="radio">
                            <input type="radio" name="layoutOptions" value="false" id="radio-light" class="layout-name" data-layout=""
                                   checked>
                            <label for="radio-light">Light</label>
                        </div>
                    </fieldset>
                </div>
                <div class="mx-50">
                    <fieldset>
                        <div class="radio">
                            <input type="radio" name="layoutOptions" value="false" id="radio-dark" class="layout-name"
                                   data-layout="dark-layout">
                            <label for="radio-dark">Dark</label>
                        </div>
                    </fieldset>
                </div>
                <div class="mx-50">
                    <fieldset>
                        <div class="radio">
                            <input type="radio" name="layoutOptions" value="false" id="radio-semi-dark" class="layout-name"
                                   data-layout="semi-dark-layout">
                            <label for="radio-semi-dark">Semi Dark</label>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <!-- Theme options starts -->
        <hr>

        <!-- Menu Colors Starts -->
        <div id="customizer-theme-colors">
            <h5>Menu Colors</h5>
            <ul class="list-inline unstyled-list">
                <li class="color-box bg-primary selected" data-color="theme-primary"></li>
                <li class="color-box bg-success" data-color="theme-success"></li>
                <li class="color-box bg-danger" data-color="theme-danger"></li>
                <li class="color-box bg-info" data-color="theme-info"></li>
                <li class="color-box bg-warning" data-color="theme-warning"></li>
                <li class="color-box bg-dark" data-color="theme-dark"></li>
            </ul>
            <hr>
        </div>
        <!-- Menu Colors Ends -->
        <!-- Menu Icon Animation Starts -->
        <div id="menu-icon-animation">
            <div class="d-flex justify-content-between align-items-center">
                <div class="icon-animation-title">
                    <h5 class="pt-25">Icon Animation</h5>
                </div>
                <div class="icon-animation-switch">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" checked id="icon-animation-switch">
                        <label class="custom-control-label" for="icon-animation-switch"></label>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <!-- Menu Icon Animation Ends -->
        <!-- Collapse sidebar switch starts -->
        <div class="collapse-sidebar d-flex justify-content-between align-items-center">
            <div class="collapse-option-title">
                <h5 class="pt-25">Collapse Menu</h5>
            </div>
            <div class="collapse-option-switch">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="collapse-sidebar-switch">
                    <label class="custom-control-label" for="collapse-sidebar-switch"></label>
                </div>
            </div>
        </div>
        <!-- Collapse sidebar switch Ends -->
        <hr>

        <!-- Navbar colors starts -->
        <div id="customizer-navbar-colors">
            <h5>Navbar Colors</h5>
            <ul class="list-inline unstyled-list">
                <li class="color-box bg-white border selected" data-navbar-default=""></li>
                <li class="color-box bg-primary" data-navbar-color="bg-primary"></li>
                <li class="color-box bg-success" data-navbar-color="bg-success"></li>
                <li class="color-box bg-danger" data-navbar-color="bg-danger"></li>
                <li class="color-box bg-info" data-navbar-color="bg-info"></li>
                <li class="color-box bg-warning" data-navbar-color="bg-warning"></li>
                <li class="color-box bg-dark" data-navbar-color="bg-dark"></li>
            </ul>
            <small><strong>Note :</strong> This option with work only on sticky navbar when you scroll page.</small>
            <hr>
        </div>
        <!-- Navbar colors starts -->
        <!-- Navbar Type Starts -->
        <h5>Navbar Type</h5>
        <div class="navbar-type d-flex justify-content-start">
            <div class="hidden-ele mx-50">
                <fieldset>
                    <div class="radio">
                        <input type="radio" name="navbarType" value="false" id="navbar-hidden">
                        <label for="navbar-hidden">Hidden</label>
                    </div>
                </fieldset>
            </div>
            <div class="mx-50">
                <fieldset>
                    <div class="radio">
                        <input type="radio" name="navbarType" value="false" id="navbar-static">
                        <label for="navbar-static">Static</label>
                    </div>
                </fieldset>
            </div>
            <div class="mx-50">
                <fieldset>
                    <div class="radio">
                        <input type="radio" name="navbarType" value="false" id="navbar-sticky" checked>
                        <label for="navbar-sticky">Fixed</label>
                    </div>
                </fieldset>
            </div>
        </div>
        <hr>
        <!-- Navbar Type Starts -->

        <!-- Footer Type Starts -->
        <h5>Footer Type</h5>
        <div class="footer-type d-flex justify-content-start">
            <div class="mx-50">
                <fieldset>
                    <div class="radio">
                        <input type="radio" name="footerType" value="false" id="footer-hidden">
                        <label for="footer-hidden">Hidden</label>
                    </div>
                </fieldset>
            </div>
            <div class="mx-50">
                <fieldset>
                    <div class="radio">
                        <input type="radio" name="footerType" value="false" id="footer-static" checked>
                        <label for="footer-static">Static</label>
                    </div>
                </fieldset>
            </div>
            <div class="mx-50">
                <fieldset>
                    <div class="radio">
                        <input type="radio" name="footerType" value="false" id="footer-sticky">
                        <label for="footer-sticky" class="">Sticky</label>
                    </div>
                </fieldset>
            </div>
        </div>
        <!-- Footer Type Ends -->
        <hr>

        <!-- Card Shadow Starts-->
        <div class="card-shadow d-flex justify-content-between align-items-center py-25">
            <div class="hide-scroll-title">
                <h5 class="pt-25">Card Shadow</h5>
            </div>
            <div class="card-shadow-switch">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" checked id="card-shadow-switch">
                    <label class="custom-control-label" for="card-shadow-switch"></label>
                </div>
            </div>
        </div>
        <!-- Card Shadow Ends-->
        <hr>

        <!-- Hide Scroll To Top Starts-->
        <div class="hide-scroll-to-top d-flex justify-content-between align-items-center py-25">
            <div class="hide-scroll-title">
                <h5 class="pt-25">Hide Scroll To Top</h5>
            </div>
            <div class="hide-scroll-top-switch">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="hide-scroll-top-switch">
                    <label class="custom-control-label" for="hide-scroll-top-switch"></label>
                </div>
            </div>
        </div>
        <!-- Hide Scroll To Top Ends-->
    </div>

</div>
<!-- End: Customizer-->



<div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Enter Your Password to Erase Yor All Date </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <form action="{{ route('erase.all.data') }}" method="post">
                @csrf
                <div class="modal-body">
                    <label>Password: </label>
                    <div class="form-group mb-0">
                        <input type="password" placeholder="Password" name="password" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Erase</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0"><span class="float-left d-inline-block">2021 &copy; Rony</span><span class="float-right d-sm-inline-block d-none">Crafted with<i class="bx bxs-heart pink mx-50 font-small-3"></i>by<a class="text-uppercase" href="#" target="_blank">Rony</a></span>
        <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="bx bx-up-arrow-alt"></i></button>
    </p>
</footer>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="{{ asset('public/backend') }}/app-assets/vendors/js/vendors.min.js"></script>
<script src="{{ asset('public/backend') }}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.min.js"></script>
<script src="{{ asset('public/backend') }}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.min.js"></script>
<script src="{{ asset('public/backend') }}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>

<!-- BEGIN Vendor JS-->


<!-- BEGIN: DataTable-->
<script src="{{ asset('public/backend') }}/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
<script src="{{ asset('public/backend') }}/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('public/backend') }}/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
<script src="{{ asset('public/backend') }}/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
<script src="{{ asset('public/backend') }}/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="{{ asset('public/backend') }}/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('public/backend') }}/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
<script src="{{ asset('public/backend') }}/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
<script src="{{ asset('public/backend') }}/app-assets/js/scripts/datatables/datatable.min.js"></script>
<!-- END: DataTable-->

<!-- BEGIN: Validation-->
<script src="{{ asset('public/backend') }}/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
<script src="{{ asset('public/backend') }}/app-assets/js/scripts/forms/validation/form-validation.js"></script>
<!-- END: Validation-->

<!-- BEGIN: Select2-->
<script src="{{ asset('public/backend') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{ asset('public/backend') }}/app-assets/js/scripts/forms/select/form-select2.min.js"></script>
<!-- END: Select2-->

<!-- BEGIN: Datepicker-->
<script src="{{ asset('public/backend') }}/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="{{ asset('public/backend') }}/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="{{ asset('public/backend') }}/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.min.js"></script>
<!-- END: Datepicker-->

<!-- HandelBars -->
<script src="{{ asset('public/backend') }}/handlebars/handlebars.min.js"></script>
<script src="{{ asset('public/backend') }}/handlebars/handlebars.amd.min.js"></script>

<!-- BEGIN: Sweetalert-->
<script src="{{ asset('public/backend') }}/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>

<script>
    function deleteData(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            buttonsStyling: !1,
            icon : 'warning'
        }).then((result) => {
            if (result.isConfirmed) {
                event.preventDefault();
                document.getElementById('delete-form-'+id).submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    }
</script>
<!-- END: Sweetalert-->

<!-- BEGIN: Toastr-->
<script src="{{ asset('public/backend') }}/toastr/toastr.min.js"></script>
<script>
        @if(Session::has('messege'))
    var type="{{ Session::get('alert-type', 'info') }}"
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('messege') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('messege') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('messege') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('messege') }}");
            break;
    }
    @endif
</script>
<!-- END: Toastr-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('public/backend') }}/app-assets/vendors/js/charts/apexcharts.min.js"></script>
<script src="{{ asset('public/backend') }}/app-assets/vendors/js/extensions/dragula.min.js"></script>
<!-- END: Page Vendor JS-->


<!-- BEGIN: Theme JS-->
<script src="{{ asset('public/backend') }}/app-assets/js/core/app-menu.min.js"></script>
<script src="{{ asset('public/backend') }}/app-assets/js/core/app.min.js"></script>
<script src="{{ asset('public/backend') }}/app-assets/js/scripts/components.min.js"></script>
<script src="{{ asset('public/backend') }}/app-assets/js/scripts/footer.min.js"></script>
<script src="{{ asset('public/backend') }}/app-assets/js/scripts/customizer.min.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset('public/backend') }}/app-assets/js/scripts/pages/dashboard-analytics.min.js"></script>
<!-- END: Page JS-->
@stack('js')
</body>
</html>
