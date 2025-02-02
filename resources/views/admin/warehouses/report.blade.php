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
                        <div class="row">
                            <div class="col-12">
                                <h1>Warehouse Report for {{ $warehouse->name }}</h1>
                            </div>
                            <div class="col-12 mb-3">

                                <form method="GET"
                                    action="{{ route('reports.warehouse_details_report', ['warehouse' => $warehouse->id, 'lang' => app()->getLocale()]) }}">
                                    <div class="form-row align-items-end">
                                        <div class="form-group col-md-3">
                                            <label for="start_date">Start Date:</label>
                                            <input type="date" name="start_date" id="start_date" class="form-control"
                                                value="{{ $startDate ?? '' }}">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="end_date">End Date:</label>
                                            <input type="date" name="end_date" id="end_date" class="form-control"
                                                value="{{ $endDate ?? '' }}">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @if ($startDate && $endDate)
                                <div class="col-12">
                                    <p>Showing data from: {{ $startDate }} To: {{ $endDate }}</p>
                                </div>
                            @endif
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        Warehouse Details
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th>Name</th>
                                                <td>{{ $warehouse->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <td>{{ $warehouse->location }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        Financial Summary
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th>Total Purchase Amount</th>
                                                <td>{{ $totalAmount }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total Paid Amount</th>
                                                <td>{{ $totalPaid }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total Unpaid Amount</th>
                                                <td>{{ $totalUnpaid }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <div class="card">
                                    <div class="card-header">
                                        Purchases
                                    </div>
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Purchase ID</th>
                                                    <th>Date</th>
                                                    <th>Fournisseur</th>
                                                    <th>Total Amount</th>
                                                    <th>Paid Amount</th>
                                                    <th>Payment status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($purchases as $purchase)
                                                    <tr>
                                                        <td>{{ $purchase->id }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('Y-m-d') }}
                                                        </td>
                                                        <td>{{ $purchase->fournisseur->name }}</td>
                                                        <td>{{ $purchase->amount_to_pay }}</td>
                                                        <td>{{ $purchase->payments->sum('amount') }}</td>
                                                        <td>
                                                            {{ $purchase->payment_status }}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6">No Purchase for this Warehouse</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <div class="card">
                                    <div class="card-header">
                                        Orders
                                    </div>
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Customer Name</th>
                                                    <th>Order Date</th>
                                                    <th>Total Amount</th>
                                                    <th>Payment Status</th>
                                                    <th>Delivery Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($orders as $order)
                                                    <tr>
                                                        <td>{{ $order->id }}</td>
                                                        <td>{{ $order->name }}</td>
                                                        <td>{{ $order->created_at }}</td>
                                                        @php
                                                            $totalOrderAmount = 0;
                                                        foreach ($order->orderDetails as $detail) {
                                                            $totalOrderAmount += $detail->price * $detail->quantity;
                                                        }
                                                        @endphp
                                                        <td>{{ $totalOrderAmount }}</td>
                                                        <td>{{ $order->payment_status }}</td>
                                                        <td>{{ $order->delivery_status }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6">No orders found for this warehouse.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <div class="card">
                                    <div class="card-header">
                                        Product Quantities
                                    </div>
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Unit</th>
                                                    <th>Purchase Quantity</th>
                                                    <th>Order Quantity</th>
                                                    <th>Total Quantity</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $allProducts = [];
                                                    $totalPurchaseQuantity = 0;
                                                    $totalOrderQuantity = 0;
                                                    $totalQuantity = 0;
                                                    foreach ($productQuantities as $product_id => $productData) {
                                                        $orderQuantity = $productOrderQuantities[$product_id]['totalQuantity'] ?? 0;
                                                        $purchaseQuantity = $productData['totalQuantity'];
                                                        $total = $orderQuantity + $purchaseQuantity;

                                                       $allProducts[$product_id] = [
                                                            'title' => $productData['title'],
                                                            'units' => $productData['units'],
                                                            'purchaseTotal' => $purchaseQuantity,
                                                            'orderTotal' =>  $orderQuantity,
                                                            'total' => $total,
                                                        ];

                                                       $totalPurchaseQuantity += $purchaseQuantity;
                                                        $totalOrderQuantity +=  $orderQuantity;
                                                         $totalQuantity += $total;

                                                    }
                                                @endphp
                                                    @forelse ($allProducts as $productId => $product)

                                                        @if(isset($product['units']) && !empty($product['units']))
                                                            @foreach($product['units'] as $unitId => $unitData)

                                                                <tr>
                                                                    <td>{{ $product['title'] }}</td>
                                                                    <td>{{ $unitData['unitName'] }}</td>
                                                                    <td>{{ $unitData['quantity'] }}</td>
                                                                    <td></td>
                                                                    <td></td>

                                                                </tr>

                                                            @endforeach
                                                            @else
                                                                 <tr>
                                                                    <td>{{ $product['title'] }}</td>
                                                                     <td></td>
                                                                     <td></td>
                                                                        <td>{{ $product['orderTotal'] }}</td>
                                                                    <td>{{ $product['total'] }}</td>


                                                               </tr>
                                                          @endif


                                                @empty
                                                    <tr>
                                                        <td colspan="5">No Products found</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Total</th>
                                                      <th></th>
                                                      <th> {{ $totalPurchaseQuantity }}</th>
                                                    <th>{{ $totalOrderQuantity }}</th>
                                                    <th>{{ $totalQuantity }}</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
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