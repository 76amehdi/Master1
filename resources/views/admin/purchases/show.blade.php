<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ __('purchasedetails.page_title') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/admin/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/admin/assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="/admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/admin/assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="/admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="/admin/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="/admin/assets/images/favicon.png" />
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
                        <h1>{{ __('purchasedetails.purchase_details') }}</h1>
                        <h3>{{ __('purchasedetails.purchase_information') }}</h3>
                        <table class="table table-bordered">
                            <tr>
                                <th>{{ __('purchasedetails.id') }}</th>
                                <td>{{ $purchase->id }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('purchasedetails.fournisseur') }}</th>
                                <td>{{ $purchase->fournisseur->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('purchasedetails.warehouse') }}</th>
                                <td>{{ $purchase->warehouse->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('purchasedetails.purchase_date') }}</th>
                                <td>{{ $purchase->purchase_date }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('purchasedetails.payment_status') }}</th>
                                <td>{{ $purchase->payment_status }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('purchasedetails.amount_to_pay') }}</th>
                                <td>{{ $purchase->amount_to_pay }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('purchasedetails.reduction') }}</th>
                                <td>{{ $purchase->reduction }}</td>
                            </tr>
                        </table>

                        <h3>{{ __('purchasedetails.purchased_details') }}</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('purchasedetails.id') }}</th>
                                    <th>{{ __('purchasedetails.product') }}</th>
                                    <th>{{ __('purchasedetails.quantity') }}</th>
                                    <th>{{ __('purchasedetails.unit') }}</th>
                                    <th>{{ __('purchasedetails.unit_price') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchase->purchasedetail as $detail)
                                    <tr>
                                        <td>{{ $detail->id }}</td>
                                        <td class="product-details">


                                            <strong>{{ $detail->product->title ?? 'N/A' }}</strong>


                                        </td>

                                        <td>{{ $detail->quantity }}</td>
                                        <td>
                                            @php
                                                $unit = $productUnits->firstWhere('id', $detail->product_unit_id);
                                            @endphp
                                            {{ $unit ? $unit->unit : 'N/A' }}
                                        </td>
                                        <td>{{ $detail->unit_price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($purchase->payments)


                            <h3>{{ __('purchasedetails.payments') }}</h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('purchasedetails.payment_date') }}</th>
                                        <th>{{ __('purchasedetails.amount') }}</th>
                                        <th>{{ __('purchasedetails.payment_method') }}</th>
                                        <th>{{ __('purchasedetails.transaction_reference') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalPaid = 0;
                                    @endphp
                                    @foreach ($purchase->payments as $payment)
                                        @php
                                            $totalPaid += $payment->amount;
                                        @endphp
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') }}
                                            </td>
                                            <td>{{ number_format($payment->amount, 2) }} USD</td>
                                            <td>{{ ucfirst($payment->payment_method) }}</td>
                                            <td>{{ $payment->transaction_reference ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <style>
                                .summary {
                                    text-align: right;
                                    margin-top: 20px;
                                    font-size: 18px;
                                    color: #6c7293;
                                }

                                .summary h5 {
                                    margin: 5px 0;
                                }

                                .summary h5 span {
                                    border: solid 1px;
                                    padding: 8px;
                                    width: 300px;
                                    border-color: #6c7293;
                                    display: inline-block;
                                }
                            </style>
                            <div class="summary">
                                <h5><span><strong>{{ __('purchasedetails.total_amount') }}:</strong>
                                        {{ number_format($purchase->amount_to_pay - $purchase->reduction, 2) }} </span>
                                </h5>
                                <h5><span><strong>{{ __('purchasedetails.total_paid') }}:</strong>
                                        {{ number_format($totalPaid, 2) }} </span></h5>
                                <h5><span><strong>{{ __('purchasedetails.remaining_balance') }}:</strong>
                                        {{ number_format($purchase->amount_to_pay - $purchase->reduction - $totalPaid, 2) }}
                                    </span></h5>
                            </div>

                        @endif

                        <h3>{{ __('purchasedetails.product_details') }}</h3>
                        <div class="row">
                            @foreach ($purchase->purchasedetail as $detail)
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <div class="card">
                                        <img src="{{ asset( $detail->product->images->first()->image_path) }}"
                                            alt="{{ $detail->product->images->first()->image_path }}"
                                            class="card-img-top" />
                                        <div class="card-body">
                                            <h4 class="card-title">{{ $detail->product->title }}</h4>

                                            <p>{{ __('purchasedetails.quantity_in_stock') }}:
                                                {{ $detail->product->qty }}</p>
                                            <p> {{ __('purchasedetails.unit') }} :
                                                @php
                                                    $unit = $productUnits->firstWhere('id', $detail->product_unit_id);
                                                @endphp
                                                {{ $unit ? $unit->unit : 'N/A' }}


                                            </p>
                                            <p>
                                                {{ __('purchasedetails.unit_price') }} :
                                                {{ $unit ? $unit->price : 'N/A' }}
                                            </p>
                                            <p>{{ __('purchasedetails.brand') }}: {{ $detail->product->brand }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                    </div>



                    <a href="{{ route('purchases.index',['lang' => app()->getLocale()]) }}"
                        class="btn btn-secondary mt-3">{{ __('purchasedetails.back_to_purchases') }}</a>

                </div>

            </div>

        </div>
    </div>
    <!-- main-panel ends -->

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="/admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="/admin/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="/admin/assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="/admin/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="/admin/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="/admin/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/admin/assets/js/off-canvas.js"></script>
    <script src="/admin/assets/js/hoverable-collapse.js"></script>
    <script src="/admin/assets/js/misc.js"></script>
    <script src="/admin/assets/js/settings.js"></script>
    <script src="/admin/assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="/admin/assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
</body>

</html>
