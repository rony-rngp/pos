@extends('layouts.backend.app')

@section('title', 'Home')

@push('css')

@endpush

@section('content')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body"><!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics">
                    <div class="row">
                        <!-- Website Analytics Starts-->
                        <div class="col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Application Analytics</h4>
                                    <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                                </div>
                                <div class="card-body pb-1">
                                    <div class="d-flex justify-content-around align-items-center flex-wrap">
                                        <div class="user-analytics mr-2">
                                            <i class="bx bx-user mr-25 align-middle"></i>
                                            <span class="align-middle text-muted">Users</span>
                                            <div class="d-flex">
                                                <div id="radial-success-chart"></div>
                                                <h3 class="mt-1 ml-50">{{ \App\Models\User::count() }}</h3>
                                            </div>
                                        </div>
                                        <div class="sessions-analytics mr-2">
                                            <i class="bx bx-trending-up align-middle mr-25"></i>
                                            <span class="align-middle text-muted">Supplier</span>
                                            <div class="d-flex">
                                                <div id="radial-warning-chart"></div>
                                                <h3 class="mt-1 ml-50">{{ \App\Models\Supplier::count() }}</h3>
                                            </div>
                                        </div>
                                        <div class="bounce-rate-analytics">
                                            <i class="bx bx-pie-chart-alt align-middle mr-25"></i>
                                            <span class="align-middle text-muted">Customer</span>
                                            <div class="d-flex">
                                                <div id="radial-danger-chart"></div>
                                                <h3 class="mt-1 ml-50">{{ \App\Models\Customer::count() }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="analytics-bar-chart" class="my-75"></div>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-12 dashboard-referral-impression">
                            <div class="row">
                                <!-- Referral Chart Starts-->
                                <div class="col-xl-12 col-12">
                                    <div class="card">
                                        <div class="card-body text-center pb-0">
                                            <h3>{{ \App\Models\Purchase::where('status', 1)->sum('buying_price') }}</h3>
                                            <span class="text-muted">Total Purchase Amount</span>
                                            <div id="success-line-chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Impression Radial Chart Starts-->
                                <div class="col-xl-12 col-12">
                                    <div class="card">
                                        <div class="card-body donut-chart-wrapper">
                                            <div id="donut-chart" class="d-flex justify-content-center"></div>
                                            <ul class="list-inline d-flex justify-content-around mb-0">
                                                <li> <span class="bullet bullet-xs bullet-primary mr-50"></span>Social</li>
                                                <li> <span class="bullet bullet-xs bullet-info mr-50"></span>Email</li>
                                                <li> <span class="bullet bullet-xs bullet-warning mr-50"></span>Search</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-12 col-sm-12">
                            <div class="row">
                                <!-- Conversion Chart Starts-->
                                <div class="col-xl-12 col-md-6 col-12">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between pb-xl-0 pt-xl-1">
                                            <h3>
                                                <?php $invoices  = \App\Models\Invoice::with('payment')->where('status', 1)->get();
                                                foreach($invoices as $invoice){
                                                    $total =  $invoice->payment->sum('total_amount');
                                                }
                                                ?>
                                                {{ @$total }}
                                            </h3>
                                            <span class="text-muted">Total Invoice Amount</span>
                                        </div>
                                        <div class="card-body text-center">
                                            <div id="bar-negative-chart" class="negative-bar-chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-6 col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-rgba-primary m-0 p-25 mr-75 mr-xl-2">
                                                            <div class="avatar-content">
                                                                <i class="bx bx-user text-primary font-medium-2"></i>
                                                            </div>
                                                        </div>
                                                        <div class="total-amount">
                                                            <h5 class="mb-0">$38,566</h5>
                                                            <small class="text-muted">Conversion</small>
                                                        </div>
                                                    </div>
                                                    <div id="primary-line-chart"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-rgba-warning m-0 p-25 mr-75 mr-xl-2">
                                                            <div class="avatar-content">
                                                                <i class="bx bx-dollar text-warning font-medium-2"></i>
                                                            </div>
                                                        </div>
                                                        <div class="total-amount">
                                                            <h5 class="mb-0">$53,659</h5>
                                                            <small class="text-muted">Income</small>
                                                        </div>
                                                    </div>
                                                    <div id="warning-line-chart"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Dashboard Analytics end -->

            </div>
        </div>
    </div>

@endsection

@push('js')

@endpush
