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
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #fff;
            border-collapse: collapse; /* Add this for cleaner borders */

        }

        .table th,
        .table td {
            padding: 0.5rem; /* Reduced padding for cells */
            vertical-align: top;
            border-top: 1px solid #6c757d;
             font-size: 0.9rem; /* Smaller font size */
             white-space: nowrap;
             overflow: hidden;
             text-overflow: ellipsis;
             max-width: 150px; /* Added max-width to cell to prevent width expansion */


        }


        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #6c757d;
            background-color: #495057;
            color: white;
             font-size: 0.9rem;
        }


          .table-bordered {
            border: 1px solid #6c757d;
        }
        .table-bordered th,
        .table-bordered td{
            border: 1px solid #6c757d;
        }

        .form-control {
            background-color: #495057;
            color: white;
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
                    <div class="container"
    <h2>Gross Profit Report</h2>
    <form method="GET" action="{{ route('reports.gross_profit', ['lang' => app()->getLocale()]) }}">
        <div class="form-group">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate ?? '' }}">
        </div>
        <div class="form-group">
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate ?? '' }}">
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <p><strong>Total Sales:</strong> {{ $totalSales }}</p>
    <p><strong>Total Purchases Cost:</strong> {{ $totalPurchaseCost }}</p>
    <p><strong>Gross Profit:</strong> {{ $grossProfit }}</p>
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
