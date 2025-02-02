<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@5.9.55/css/materialdesignicons.min.css">
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {background-color: #f1f1f1}

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-btn {
            background-color: #4c50af;
    color: white;
    padding: 10px;
    border: none;
    cursor: pointer;
    border-radius: 50px;
    margin-top: 10px;
        }
        .dropdown-btn i {
            margin-right: 5px;
        }
    </style>
</head>
<div class="content-wrapper">

    <div class="row mb-3">
         <div class="col-12">
                <div class="dropdown">
                    <button class="dropdown-btn"> <i class="mdi mdi-file-export"></i>{{ __('dashboard.export_reports') }}</button>
                    <div class="dropdown-content">
                         <a href="{{ route('reports.products',['lang' => app()->getLocale()]) }}"><i class="mdi mdi-basket"></i>{{ __('dashboard.products_report') }}</a>
                        <a href="{{ route('reports.orders',['lang' => app()->getLocale()]) }}"><i class="mdi mdi-cart"></i> {{ __('dashboard.orders_report') }}</a>
                         <a href="{{ route('reports.purchases',['lang' => app()->getLocale()]) }}"><i class="mdi mdi-cash-usd"></i>{{ __('dashboard.purchases_report') }}</a>
                        <a href="{{ route('reports.customers',['lang' => app()->getLocale()]) }}"><i class="mdi mdi-account-multiple"></i> {{ __('dashboard.customers_report') }}</a>

                    </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $total_users }}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success ">
                                <a href="{{ url('/customers') }}">
                                    <span class="mdi mdi-account-star text-warning icon-item"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">{{ __('dashboard.total_customers') }}</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $total_product }}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success ">
                                <a href="{{ route('admin.show_product',['lang' => app()->getLocale()]) }}">
                                    <span class="mdi mdi-basket text-info icon-item"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">{{ __('dashboard.total_products') }}</h6>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $revenue }} MRU</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success">
                                <span class="mdi mdi-codepen text-danger icon-item"></span>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">{{ __('dashboard.revenue') }}</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $sold_products }}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success">
                                <span class="mdi mdi-sale text-warning icon-item"></span>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">{{ __('dashboard.sold_products') }}</h6>
                </div>
            </div>
        </div>


    </div>
    <div class="row pt-3 mt-2 mb-2 ">
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $total_orders }}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success">
                                <a href="{{ route('admin.user_orders',['lang' => app()->getLocale()]) }}">
                                    <span class="mdi mdi-basket-fill text-success icon-item"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">{{ __('dashboard.total_active_orders') }}</h6>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $delivered_orders }}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success">
                                <a href="{{ route('admin.user_orders',['lang' => app()->getLocale()]) }}">
                                    <span class="mdi mdi-truck-delivery text-danger icon-item"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">{{ __('dashboard.orders_delivered') }}</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $processing_orders }}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success">
                                <a href="{{ route('admin.user_orders',['lang' => app()->getLocale()]) }}">
                                    <span class="mdi mdi-autorenew icon-item"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">{{ __('dashboard.orders_processing') }}</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $canclled_orders }}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success">
                                <a href="{{ route('admin.user_orders',['lang' => app()->getLocale()]) }}">
                                    <span class="mdi mdi-close-circle-outline text-danger icon-item"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">{{ __('dashboard.cancelled_orders') }}</h6>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $payed_orders }}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success">
                                <a href="{{ route('admin.user_orders',['lang' => app()->getLocale()]) }}">
                                    <span class="mdi mdi-cash-multiple text-success icon-item"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">{{ __('dashboard.paid_orders') }}</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $on_the_way_orders }}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success">
                                <a href="{{ route('admin.user_orders',['lang' => app()->getLocale()]) }}">
                                    <span class="mdi mdi-truck text-primary icon-item"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">{{ __('dashboard.orders_on_the_way') }}</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $shipped_orders }}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success">
                                <a href="{{ route('admin.user_orders',['lang' => app()->getLocale()]) }}">
                                    <span class="mdi mdi-truck-check text-info icon-item"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">{{ __('dashboard.shipped_orders') }}</h6>
                </div>
            </div>
        </div>


    </div>





    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('dashboard.doughnut_chart') }}</h4>
                    <canvas id="doughnutChart" style="height:250px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('dashboard.bar_chart') }}</h4>
                    <canvas id="barChart" style="height:230px"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Top Selling Products -->
        <div class="col-xl-6 col-sm-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('dashboard.top_selling_products') }}</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('dashboard.product') }}</th>
                                <th>{{ __('dashboard.sold') }}</th>
                                <th>{{ __('dashboard.status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topSellingProducts as $product)
                                <tr>
                                    <td>{{ $product->product_title }}</td>
                                    <td>{{ $product->total_sold }}</td>
                                    <td>
                                        <span class="badge badge-success">
                                            <i class="fas fa-check-circle"></i> {{ __('dashboard.selling') }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Top Sellers -->
        <div class="col-xl-6 col-sm-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('dashboard.top_sellers') }}</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('dashboard.seller') }}</th>
                                <th>{{ __('dashboard.orders') }}</th>
                                <th>{{ __('dashboard.status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topSellers as $seller)
                                <tr>
                                    <td>{{ $seller->email }}</td>
                                    <td>{{ $seller->order_count }}</td>
                                    <td>
                                        <span class="badge badge-primary">
                                            <i class="fas fa-trophy"></i> {{ __('dashboard.top_seller') }}
                                        </span>
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