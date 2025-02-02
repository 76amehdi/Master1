<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin | {{ __('purchases_index.title') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}" />
    <style>
        body {
            color: #000000 !important;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }
        .table-container {
            overflow-x: auto;
            /* Enable horizontal scroll */
            max-width: 100%;
            /* Use max-width for responsive width */
            margin-bottom: 20px;
            border: 1px solid #ddd;

        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #000000;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 0.5rem;
            vertical-align: top;
            border-top: 1px solid #6c757d;
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
        }


        .table thead th {
            vertical-align: bottom;
            color: black;
            font-size: 0.9rem;
        }


        .table-bordered {
            border: 1px solid #6c757d;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #6c757d;
        }

        .report-card {
            border: 1px solid #ddd;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
        }

        .report-card h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            font-weight: bold;
            color: #000000 !important;
        }

        .report-card p {
            color: #000000 !important;
        }

        .report-card table th,
        .report-card table td {
            color: #000000 !important;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('admin.sidebar')
        <div class="container-fluid page-body-wrapper">
            @include('admin.navbar')
            <div class="main-panel">
                <div class="content-wrapper">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title"> <i class="mdi mdi-chart-line"></i> Combined Reports</h2>
                                <form method="GET"
                                    action="{{ route('combined.reports', ['lang' => app()->getLocale()]) }}"
                                    class="form-inline">
                                    <div class="form-group mr-2">
                                        <label for="start_date" class="mr-1"> <i class="mdi mdi-calendar-range"></i>
                                            Start Date:</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control"
                                            value="{{ $startDate ?? '' }}">
                                    </div>
                                    <div class="form-group mr-2">
                                        <label for="end_date" class="mr-1"><i class="mdi mdi-calendar-range"></i> End
                                            Date:</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control"
                                            value="{{ $endDate ?? '' }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary"> <i class="mdi mdi-filter"></i>
                                        Filter</button>
                                </form>
                            </div>
                        </div>
                        @if ($startDate && $endDate)
                            <p> <i class="mdi mdi-information"></i> Showing data from: {{ $startDate }} To:
                                {{ $endDate }}</p>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <div class="report-card">
                                    <h3><i class="mdi mdi-chart-bar"></i> Gross Profit Report</h3>
                                    <p> <i class="mdi mdi-cash-usd"></i> <strong>Total Sales:</strong>
                                        {{ number_format($totalSales, 2) }}</p>
                                    <p> <i class="mdi mdi-cash-usd"></i> <strong>Total Purchases Cost:</strong>
                                        {{ number_format($totalPurchaseCost, 2) }}</p>
                                    <p> <i class="mdi mdi-cash-usd"></i> <strong>Gross Profit:</strong>
                                        {{ number_format($grossProfit, 2) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="report-card">
                                    <h3><i class="mdi mdi-truck"></i> Supplier Purchases</h3>
                                    @if ($supplierPurchases->count() > 0)
                                        <div class="table-container">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th><i class="mdi mdi-account"></i> Supplier</th>
                                                        <th> <i class="mdi mdi-cash-usd"></i> Total Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($supplierPurchases as $supplier => $total)
                                                        <tr>
                                                            <td>{{ $supplier }}</td>
                                                            <td>{{ $total }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p>No Purchases from any Suppliers</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="report-card">
                                    <h3><i class="mdi mdi-warehouse"></i> Warehouse Purchases</h3>
                                    @if ($warehousePurchases->count() > 0)
                                        <div class="table-container">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th><i class="mdi mdi-home"></i> Warehouse</th>
                                                        <th> <i class="mdi mdi-cash-usd"></i> Total Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($warehousePurchases as $warehouse => $total)
                                                        <tr>
                                                            <td>{{ $warehouse }}</td>
                                                            <td>{{ $total }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p>No Purchases from any Warehouse</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="report-card">
                                    <h3><i class="mdi mdi-credit-card"></i> Payment Analysis</h3>
                                    <p> <i class="mdi mdi-cash-usd"></i> <strong>Total Payments Received:</strong>
                                        {{ number_format($totalPayments, 2) }}</p>
                                    <h3><i class="mdi mdi-credit-card-multiple"></i> Payments by Method</h3>
                                    @if ($paymentsByMethod->count() > 0)
                                        <div class="table-container">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th><i class="mdi mdi-credit-card"></i> Payment Method</th>
                                                        <th> <i class="mdi mdi-cash-usd"></i> Total Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($paymentsByMethod as $method => $amount)
                                                        <tr>
                                                            <td>{{ $method }}</td>
                                                            <td>{{ number_format($amount, 2) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p>No Payment Made</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>

    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>


    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('admin/assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('admin/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('admin/assets/js/misc.js') }}"></script>
    <script src="{{ asset('admin/assets/js/settings.js') }}"></script>
    <script src="{{ asset('admin/assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('admin/assets/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->

</body>

</html>
