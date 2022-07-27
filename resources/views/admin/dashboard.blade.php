@extends('layouts/contentLayoutMaster')

@section('title', 'Home')

@section('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}" />
@endsection

@section('content')
<div class="row match-height">
    <!-- Statistics Card -->
    <div class="col-xl-8 col-md-6 col-12">
        <div class="card card-statistics">
            <div class="card-header">
                <h4 class="card-title">Statistics</h4>
                <div class="d-flex align-items-center">
                    <p class="card-text font-small-2 me-25 mb-0">Updated 1 month ago</p>
                </div>
            </div>
            <div class="card-body statistics-body">
                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                        <div class="d-flex flex-row">
                            <div class="avatar bg-light-primary me-2">
                                <div class="avatar-content">
                                    <i data-feather="trending-up" class="avatar-icon"></i>
                                </div>
                            </div>
                            <div class="my-auto">
                                <h4 class="fw-bolder mb-0">230k</h4>
                                <p class="card-text font-small-3 mb-0">Sales</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                        <div class="d-flex flex-row">
                            <div class="avatar bg-light-info me-2">
                                <div class="avatar-content">
                                    <i data-feather="user" class="avatar-icon"></i>
                                </div>
                            </div>
                            <div class="my-auto">
                                <h4 class="fw-bolder mb-0">8.549k</h4>
                                <p class="card-text font-small-3 mb-0">Customers</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                        <div class="d-flex flex-row">
                            <div class="avatar bg-light-danger me-2">
                                <div class="avatar-content">
                                    <i data-feather="box" class="avatar-icon"></i>
                                </div>
                            </div>
                            <div class="my-auto">
                                <h4 class="fw-bolder mb-0">1.423k</h4>
                                <p class="card-text font-small-3 mb-0">Products</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="d-flex flex-row">
                            <div class="avatar bg-light-success me-2">
                                <div class="avatar-content">
                                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                                </div>
                            </div>
                            <div class="my-auto">
                                <h4 class="fw-bolder mb-0">$9745</h4>
                                <p class="card-text font-small-3 mb-0">Revenue</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Statistics Card -->

    <div class="col-lg-4 col-12">
        <div class="row match-height">
            <!-- Bar Chart - Orders -->
            <div class="col-lg-6 col-md-3 col-6">
                <div class="card">
                    <div class="card-body pb-50">
                        <h6>Orders</h6>
                        <h2 class="fw-bolder mb-1">2,76k</h2>
                        <div id="statistics-order-chart"></div>
                    </div>
                </div>
            </div>
            <!--/ Bar Chart - Orders -->

            <!-- Line Chart - Profit -->
            <div class="col-lg-6 col-md-3 col-6">
                <div class="card card-tiny-line-stats">
                    <div class="card-body pb-50">
                        <h6>Profit</h6>
                        <h2 class="fw-bolder mb-1">6,24k</h2>
                        <div id="statistics-profit-chart"></div>
                    </div>
                </div>
            </div>
            <!--/ Line Chart - Profit -->
        </div>
    </div>
</div>
<div class="row match-height">

    <!-- Revenue Report Card -->
    <div class="col-12">
        <div class="card card-revenue-budget">
            <div class="row mx-0">
                <div class="col-md-8 col-12 revenue-report-wrapper">
                    <div class="d-sm-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-50 mb-sm-0">Revenue Report</h4>
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center me-2">
                                <span class="bullet bullet-primary font-small-3 me-50 cursor-pointer"></span>
                                <span>Earning</span>
                            </div>
                            <div class="d-flex align-items-center ms-75">
                                <span class="bullet bullet-warning font-small-3 me-50 cursor-pointer"></span>
                                <span>Expense</span>
                            </div>
                        </div>
                    </div>
                    <div id="revenue-report-chart"></div>
                </div>
                <div class="col-md-4 col-12 budget-wrapper">
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle budget-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            2020
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">2020</a>
                            <a class="dropdown-item" href="#">2019</a>
                            <a class="dropdown-item" href="#">2018</a>
                        </div>
                    </div>
                    <h2 class="mb-25">$25,852</h2>
                    <div class="d-flex justify-content-center">
                        <span class="fw-bolder me-25">Budget:</span>
                        <span>56,800</span>
                    </div>
                    <div id="budget-chart"></div>
                    <button type="button" class="btn btn-primary">Increase Budget</button>
                </div>
            </div>
        </div>
    </div>
    <!--/ Revenue Report Card -->
</div>
@endsection

@section('page-script')
<script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/pages/dashboard-ecommerce.js')) }}"></script>
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}" />
<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
@endsection
