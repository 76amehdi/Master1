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
            margin-right: 10px; /* Space between elements */
            margin-bottom: 5px;
        }
         .form-group label {
            font-weight: bold;
            display: block;
            color: #000000 !important;
             margin-bottom: 5px; /* Space between the label and the input */
        }
         input[type="date"] {
                width: 150px;
                padding: 5px;
                border: 1px solid #ddd;
                border-radius: 4px;
                box-sizing: border-box;
                color: #000; /* Set input text color */
        }
         .filter-container {
             display: flex;
            justify-content: space-between; /* Aligns items to ends */
            align-items: center; /* Centers items vertically */
            margin-bottom: 20px; /* Space below the container */
            flex-wrap: wrap; /* Allows items to wrap on smaller screens */
        }
          .filter-container form {
             display: flex;
            align-items: center; /* Vertically align form elements */
            flex-wrap: wrap; /* Allow form elements to wrap on smaller screens */

        }

        .filter-container form > * {
            margin-right: 10px; /* Add some spacing between form elements */
            margin-bottom: 5px; /* Add some spacing between form elements if they wrap */
        }

       .filter-container form label {
            font-weight: bold;
            display: inline-block; /* Display labels on the same line as input */
            margin-right: 5px;
            color: black;
        }

          .filter-container form button {
            padding: 8px 12px;
                background-color: #4a90e2;
                color: #fff;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
        .table-container {
            overflow-x: auto; /* Enable horizontal scroll */
            max-width: 100%; /* Use max-width for responsive width */
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
                                 <h2 class="card-title"> <i class="mdi mdi-cart"></i> Purchase Report</h2>
                                    <div class="filter-container">
                                      <form method="GET" action="{{ route('reports.purchase_report', ['lang' => app()->getLocale()]) }}" class="form-inline">
                                           <label for="start_date"><i class="mdi mdi-calendar-range"></i> Start Date:</label>
                                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate ?? '' }}">

                                         <label for="end_date"><i class="mdi mdi-calendar-range"></i> End Date:</label>
                                         <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate ?? '' }}">

                                        <button type="submit" class="btn btn-primary"> <i class="mdi mdi-filter"></i> Filter</button>
                                     </form>
                                    </div>
                                  <p> <i class="mdi mdi-cash-usd"></i> <strong>Total Purchase Cost:</strong> {{ $totalPurchaseCost }}</p>
                                    <p> <i class="mdi mdi-cash-usd"></i> <strong>Total Purchase Amount:</strong> {{ $totalPurchaseAmount }}</p>
                                    <p> <i class="mdi mdi-cash-usd"></i> <strong>Average Purchase Amount:</strong> {{ $averagePurchaseAmount }}</p>
                            </div>
                        </div>
                        @if ($purchases->count() > 0)
                          <div class="card">
                             <div class="card-body">
                               <div class="table-container">
                                    <table class="table table-bordered">
                                         <thead>
                                               <tr>
                                                    <th><i class="mdi mdi-key"></i> Purchase ID</th>
                                                    <th><i class="mdi mdi-account"></i> Supplier</th>
                                                    <th><i class="mdi mdi-calendar"></i> Purchase Date</th>
                                                     <th><i class="mdi mdi-cash-usd"></i> Amount to pay</th>
                                                    <th><i class="mdi mdi-cash-usd"></i> Total Cost</th>
                                                </tr>
                                            </thead>
                                         <tbody>
                                                @foreach ($purchases as $purchase)
                                                <tr>
                                                    <td>{{ $purchase->id }}</td>
                                                    <td>{{ $purchase->fournisseur->name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('Y-m-d') }}</td>
                                                   <td>{{ $purchase->amount_to_pay }}</td>
                                                   <td>
                                                        {{ $purchase->purchasedetail->sum(function ($detail) {
                                                            return $detail->unit_price * $detail->quantity;
                                                        }) }}
                                                    </td>
                                                 </tr>
                                             @endforeach
                                        </tbody>
                                     </table>
                                </div>
                             </div>
                           </div>

                        @else
                        <p>No purchases found.</p>
                        @endif
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