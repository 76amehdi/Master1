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
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1600px;
            /* Increased max-width for more space */
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }


        .container {
            max-width: 1600px;
            /* Increased max-width for more space */
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Header */
        h2 {
            text-align: center;
            color: #4a90e2;
            font-weight: bold;
            margin-bottom: 30px;
            /* Increased margin */
        }

        /* Form */
        form {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
            /* Increased margin */
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: bold;
            display: block;
        }

        input[type="date"] {
            width: 180px;
            /* Set width for better form layout*/
            padding: 8px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #4a90e2;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            align-self: flex-end;
            /*Align button with the group form*/
        }

        button[type="submit"]:hover {
            background-color: #357abd;
        }

        /* Card Grid */
        .report-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            /* Adjusted minmax for 3 columns */
            gap: 30px;
            /* Increased gap */
            margin-bottom: 30px;
            /* Increased margin */
        }

        .report-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .report-card h3 {
            color: #333;
            border-bottom: 2px solid #4a90e2;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .report-card p {
            font-size: 1rem;
            margin: 5px 0;
        }

        .chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        /* Charts */
        canvas {
            max-height: 250px;
            /* Set a max-height for all canvas */
        }


        /* Responsive Design */
        @media (max-width: 1024px) {

            /* For tablets */
            .report-grid {
                grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
                /* Show 2 columns */
            }
        }

        @media (max-width: 768px) {
            .report-grid {
                grid-template-columns: 1fr;
                /* One column on smaller screens */
            }

            .form-group {
                flex-direction: column;
                /* Stack form elements */
            }

            input[type="date"] {
                width: 100%;
            }
        }
    </style>
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}" />

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

                        <h2>{{ __('purchase_reports.title') }}</h2>
                        <form method="GET" action="{{ route('all.reports', ['lang' => app()->getLocale()]) }}">
                            <div class="form-group">
                                <label for="start_date">{{ __('purchase_reports.start_date') }}</label>
                                <input type="date" name="start_date" id="start_date" class="form-control"
                                    value="{{ $startDate ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="end_date">{{ __('purchase_reports.end_date') }}</label>
                                <input type="date" name="end_date" id="end_date" class="form-control"
                                    value="{{ $endDate ?? '' }}">
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('purchase_reports.filter') }}</button>
                        </form>
                        <div class="report-grid">
                             <div class="report-card">
                                <h3>{{ __('purchase_reports.financial_summary') }}</h3>
                                <p><strong>{{ __('purchase_reports.total_sales') }}</strong> {{ number_format($totalSales, 2) }}</p>
                                <p><strong>{{ __('purchase_reports.total_paid_supplier') }}</strong>
                                    {{ number_format($totalAmountPaidToFournisseur, 2) }}</p>
                                <p><strong>{{ __('purchase_reports.total_credit') }}</strong> {{ number_format($totalCredit, 2) }}</p>
                                <p><strong>{{ __('purchase_reports.total_amount_to_pay') }}</strong>
                                    {{ number_format($totalAmountToPay, 2) }}</p>
                            </div>
                            <div class="report-card">
                                <h3>{{ __('purchase_reports.sales_report') }}</h3>
                                <p><strong>{{ __('purchase_reports.total_sales') }}</strong> {{ number_format($totalSales, 2) }}</p>
                                <p><strong>{{ __('purchase_reports.average_order_value') }}</strong> {{ number_format($averageOrderValue, 2) }}</p>
                                <div class="chart-container">
                                    <canvas id="salesChart"></canvas>
                                </div>
                            </div>
                            <div class="report-card">
                                <h3>{{ __('purchase_reports.purchases_report') }}</h3>
                                <p><strong>{{ __('purchase_reports.total_purchase_cost') }}</strong> {{ number_format($totalPurchaseCost, 2) }}</p>
                                <p><strong>{{ __('purchase_reports.total_purchase_amount') }}</strong> {{ number_format($totalPurchaseAmount, 2) }}
                                </p>
                                <p><strong>{{ __('purchase_reports.average_purchase_amount') }}</strong>
                                    {{ number_format($averagePurchaseAmount, 2) }}</p>
                                <div class="chart-container">
                                    <canvas id="purchaseChart"></canvas>
                                </div>
                            </div>
                           <div class="report-card">
                                <h3>{{ __('purchase_reports.purchase_vs_sales') }}</h3>
                                <div class="chart-container">
                                    <canvas id="purchaseVsSalesChart"></canvas>
                                </div>
                            </div>
                            <div class="report-card">
                                <h3>{{ __('purchase_reports.gross_profit_report') }}</h3>
                                <p><strong>{{ __('purchase_reports.gross_profit') }}</strong> {{ number_format($grossProfit, 2) }}</p>
                                <div class="chart-container">
                                    <canvas id="grossProfitChart"></canvas>
                                </div>
                            </div>
                            <div class="report-card">
                                <h3>{{ __('purchase_reports.supplier_purchases') }}</h3>
                                <div class="chart-container">
                                    <canvas id="supplierChart"></canvas>
                                </div>
                            </div>
                            <div class="report-card">
                                <h3>{{ __('purchase_reports.warehouse_purchases') }}</h3>
                                <div class="chart-container">
                                    <canvas id="warehouseChart"></canvas>
                                </div>
                            </div>
                            <div class="report-card">
                                <h3>{{ __('purchase_reports.payment_analysis') }}</h3>
                                <p><strong>{{ __('purchase_reports.total_payments_received') }}</strong> {{ number_format($totalPayments, 2) }}</p>
                                <div class="chart-container">
                                    <canvas id="paymentChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {

                            // Sales Chart
                            const salesChartCanvas = document.getElementById('salesChart');
                            if (salesChartCanvas) {
                                new Chart(salesChartCanvas, {
                                    type: 'line',
                                    data: {
                                        labels: @json($salesLabels), // Use sales dates as labels
                                        datasets: [{
                                            label: 'Sales Over Time',
                                            data: @json($salesValues), // Use sales amounts
                                            fill: false,
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            tension: 0.4
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            }
                            // Purchase Chart
                            const purchaseChartCanvas = document.getElementById('purchaseChart');
                            if (purchaseChartCanvas) {
                                 new Chart(purchaseChartCanvas, {
                                    type: 'line',
                                    data: {
                                        labels: @json($purchaseLabels),
                                        datasets: [{
                                            label: 'Purchase Cost Over Time',
                                            data: @json($purchaseValues),
                                            fill: false,
                                            borderColor: 'rgba(255, 99, 132, 1)',
                                            tension: 0.4
                                        }]
                                    },
                                     options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            }
                              // Purchase vs Sales Chart
                            const purchaseVsSalesChartCanvas = document.getElementById('purchaseVsSalesChart');
                             if (purchaseVsSalesChartCanvas) {
                             new Chart(purchaseVsSalesChartCanvas, {
                                  type: 'bar',
                                  data: {
                                     labels: @json($combinedLabels),
                                      datasets: [{
                                         label: 'Sales Amount',
                                         data: @json($combinedSalesValues),
                                         backgroundColor: 'rgba(75, 192, 192, 0.7)',
                                          borderColor: 'rgba(75, 192, 192, 1)',
                                          borderWidth: 1
                                       }, {
                                         label: 'Purchase Amount',
                                         data:  @json($combinedPurchaseAmountValues),
                                          backgroundColor: 'rgba(255, 99, 132, 0.7)',
                                           borderColor: 'rgba(255, 99, 132, 1)',
                                           borderWidth: 1
                                        }]
                                       },
                                      options: {
                                          scales: {
                                            y: {
                                               beginAtZero: true
                                                }
                                             }
                                         }
                                      });
                               }
                            // Gross Profit Chart
                            const grossProfitChartCanvas = document.getElementById('grossProfitChart');
                            if (grossProfitChartCanvas) {
                                new Chart(grossProfitChartCanvas, {
                                    type: 'bar',
                                    data: {
                                        labels: ['Gross Profit'],
                                        datasets: [{
                                            label: 'Gross Profit',
                                            data: [{{ $grossProfit }}],
                                            backgroundColor: ['rgba(255, 205, 86, 0.8)'],
                                            borderColor: ['rgba(255, 205, 86, 1)'],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            }
                            // Supplier Chart
                            const supplierChartCanvas = document.getElementById('supplierChart');
                            if (supplierChartCanvas) {
                                const supplierPurchasesData = @json($supplierPurchases);
                                const supplierLabels = Object.keys(supplierPurchasesData);
                                const supplierValues = Object.values(supplierPurchasesData);

                                new Chart(supplierChartCanvas, {
                                    type: 'doughnut',
                                    data: {
                                        labels: supplierLabels,
                                        datasets: [{
                                            label: 'Supplier Purchases',
                                            data: supplierValues,
                                            backgroundColor: [
                                                'rgba(255, 99, 132, 0.8)',
                                                'rgba(54, 162, 235, 0.8)',
                                                'rgba(255, 205, 86, 0.8)',
                                                'rgba(75, 192, 192, 0.8)',
                                                'rgba(153, 102, 255, 0.8)',
                                                'rgba(255, 159, 64, 0.8)'
                                            ],
                                            borderColor: [
                                                'rgba(255, 99, 132, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 205, 86, 1)',
                                                'rgba(75, 192, 192, 1)',
                                                'rgba(153, 102, 255, 1)',
                                                'rgba(255, 159, 64, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    }
                                });
                            }
                            // Warehouse Chart
                            const warehouseChartCanvas = document.getElementById('warehouseChart');
                            if (warehouseChartCanvas) {
                                const warehousePurchasesData = @json($warehousePurchases);
                                const warehouseLabels = Object.keys(warehousePurchasesData);
                                const warehouseValues = Object.values(warehousePurchasesData);

                                new Chart(warehouseChartCanvas, {
                                    type: 'bar',
                                    data: {
                                        labels: warehouseLabels,
                                        datasets: [{
                                            label: 'Warehouse Purchases',
                                            data: warehouseValues,
                                            backgroundColor: [
                                                'rgba(255, 99, 132, 0.8)',
                                                'rgba(54, 162, 235, 0.8)',
                                                'rgba(255, 205, 86, 0.8)',
                                                'rgba(75, 192, 192, 0.8)',
                                                'rgba(153, 102, 255, 0.8)',
                                                'rgba(255, 159, 64, 0.8)'
                                            ],
                                            borderColor: [
                                                'rgba(255, 99, 132, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 205, 86, 1)',
                                                'rgba(75, 192, 192, 1)',
                                                'rgba(153, 102, 255, 1)',
                                                'rgba(255, 159, 64, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            }
                            // Payments Chart
                            const paymentChartCanvas = document.getElementById('paymentChart');
                            if (paymentChartCanvas) {
                                const paymentMethodData = @json($paymentsByMethod);
                                const paymentLabels = Object.keys(paymentMethodData);
                                const paymentValues = Object.values(paymentMethodData);
                                new Chart(paymentChartCanvas, {
                                    type: 'pie',
                                    data: {
                                        labels: paymentLabels,
                                        datasets: [{
                                            label: 'Payments by Method',
                                            data: paymentValues,
                                            backgroundColor: [
                                                'rgba(255, 99, 132, 0.8)',
                                                'rgba(54, 162, 235, 0.8)',
                                                'rgba(255, 205, 86, 0.8)',
                                                'rgba(75, 192, 192, 0.8)',
                                                'rgba(153, 102, 255, 0.8)',
                                                'rgba(255, 159, 64, 0.8)'
                                            ],
                                            borderColor: [
                                                'rgba(255, 99, 132, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 205, 86, 1)',
                                                'rgba(75, 192, 192, 1)',
                                                'rgba(153, 102, 255, 1)',
                                                'rgba(255, 159, 64, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    }
                                });
                            }
                        });
                    </script>
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