<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin | {{ __('user_orders.title') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- End Bootstrap CDN -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- Layout styles -->
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
                    <form action="{{ url('/search-order') }}" class="nav-link mt-2 mt-md-0 d-none d-lg-flex search"
                        method="GET">
                        @csrf
                        <input type="text" name="search" class="form-control"
                            placeholder="{{ __('user_orders.search_by_tracking_id') }}" style="color: #777272">
                    </form>
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">{{ __('user_orders.users_orders') }}</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('user_orders.tracking_id') }}</th>
                                                    <th>{{ __('user_orders.email') }}</th>
                                                    <th>{{ __('user_orders.phone') }}</th>
                                                    <th>{{ __('user_orders.payment_status') }}</th>
                                                    <th>{{ __('user_orders.delivery_status') }}</th>
                                                    <th>{{ __('user_orders.order_date') }}</th>
                                                    <th>{{ __('user_orders.bill') }}</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td style="color: #000000">{{ $order->tracking_id }}</td>
                                                        <td style="color: #000000">{{ $order->email }}</td>
                                                        <td style="color: #000000">{{ $order->phone }}</td>

                                                        <td>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <button
                                                                        class="btn btn-sm btn-outline-success dropdown-toggle"
                                                                        type="button" data-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false">
                                                                        {{ $order->payment_status }}
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('update-payment', ['lang' => app()->getLocale(), 'order_id' => $order->id, 'payment_status' => 'pending']) }}">{{ __('user_orders.pending') }}</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('update-payment', ['lang' => app()->getLocale(), 'order_id' => $order->id, 'payment_status' => 'paid']) }}">{{ __('user_orders.paid') }}</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('update-payment', ['lang' => app()->getLocale(), 'order_id' => $order->id, 'payment_status' => 'cancelled']) }}">{{ __('user_orders.cancelled') }}</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('update-payment', ['lang' => app()->getLocale(),'order_id' => $order->id, 'payment_status' => 'cash_on_delivery']) }}">{{ __('user_orders.cash_on_delivery') }}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <button
                                                                        class="btn btn-sm btn-outline-warning dropdown-toggle"
                                                                        type="button" data-toggle="dropdown"
                                                                        aria-haspopup="true"
                                                                        aria-expanded="false">{{ $order->delivery_status }}</button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item"
                                                                            href="{{ url('/update-order/' . $order->id . '/processing?lang='.app()->getLocale()) }}">{{ __('user_orders.processing') }}</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ url('/update-order/' . $order->id . '/pending?lang='.app()->getLocale()) }}">{{ __('user_orders.pending') }}</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ url('/update-order/' . $order->id . '/shipped?lang='.app()->getLocale()) }}">{{ __('user_orders.shipped') }}</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ url('/update-order/' . $order->id . '/on_the_way?lang='.app()->getLocale()) }}">{{ __('user_orders.on_the_way') }}</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ url('/update-order/' . $order->id . '/delivered?lang='.app()->getLocale()) }}">{{ __('user_orders.delivered') }}</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ url('/update-order/' . $order->id . '/cancel_order?lang='.app()->getLocale()) }}">{{ __('user_orders.cancel_order') }}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td style="color: #000000">{{ $order->created_at }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button
                                                                    class="btn btn-outline-info dropdown-toggle d-flex align-items-center"
                                                                    type="button"
                                                                    id="dropdownMenuButton{{ $order->id }}"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="mdi mdi-menu me-2"></i>
                                                                </button>

                                                                <ul class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuButton{{ $order->id }}">
                                                                    <li>
                                                                        <a class="dropdown-item d-flex align-items-center"
                                                                            href="{{ url('print-bill', $order->id).'?lang='.app()->getLocale() }}">
                                                                            <i class="mdi mdi-file-pdf me-2"></i>
                                                                            <span
                                                                                style="font-size: 0.9rem;">{{ __('user_orders.print_bill') }}</span>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item d-flex align-items-center"
                                                                            href="{{ url('print-ticket', $order->id).'?lang='.app()->getLocale() }}">
                                                                            <i class="mdi  mdi-ticket-percent-outline"></i>
                                                                            <span
                                                                                style="font-size: 0.9rem;">{{ __('user_orders.print_ticket') }}</span>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item d-flex align-items-center"
                                                                            href="#" data-bs-toggle="modal"
                                                                            data-bs-target="#orderDetailsModal"
                                                                            onclick="showOrderDetails({{ $order->id }})">
                                                                            <i class="mdi mdi-eye me-2"></i>
                                                                            <span
                                                                                style="font-size: 0.9rem;">{{ __('user_orders.view_details') }}</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Details Modal -->
                <div class="modal fade" id="orderDetailsModal" tabindex="-1"
                    aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="orderDetailsModalLabel">
                                    {{ __('user_orders.order_details') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="orderDetailsContent">
                                <!-- Order details will be populated here via JavaScript -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">{{ __('user_orders.close') }}</button>
                            </div>
                        </div>
                    </div>
                </div>

                 
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS to show order details in the modal -->
    <script>
        function showOrderDetails(orderId) {
            // Send an AJAX request to fetch the order details
            fetch('/order-details/' + orderId)
                .then(response => response.json())
                .then(data => {
                    // Populate the modal with the order details
                    let orderDetailsContent = document.getElementById('orderDetailsContent');
                    orderDetailsContent.innerHTML = `
                <h6>{{ __('user_orders.tracking_id') }}: ${data.tracking_id}</h6>
                <p><strong>{{ __('user_orders.email') }}:</strong> ${data.email}</p>
                <p><strong>{{ __('user_orders.phone') }}:</strong> ${data.phone}</p>
                <p><strong>{{ __('user_orders.payment_status') }}:</strong> ${data.payment_status}</p>
                <p><strong>{{ __('user_orders.delivery_status') }}:</strong> ${data.delivery_status}</p>
                <p><strong>{{ __('user_orders.order_date') }}:</strong> ${data.created_at}</p>
                <h6>{{ __('user_orders.items') }}:</h6>
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('user_orders.product_title') }}</th>
                            <th>{{ __('user_orders.price') }}</th>
                            <th>{{ __('user_orders.quantity') }}</th>
                             <th>{{ __('user_orders.total') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${data.order_details.map(detail => `
                                        <tr>
                                            <td>${detail.product_title}</td>
                                            <td>$${detail.price}</td>
                                            <td>${detail.quantity}</td>
                                            <td>$${(detail.quantity * detail.price).toFixed(2)}</td>
                                        </tr>
                                    `).join('')}
                    </tbody>
                </table>
            `;
                });
        }
    </script>
</body>

</html>