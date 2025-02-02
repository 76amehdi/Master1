<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin | {{ __('show_product.title') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}" />
</head>

<body>
    @include('sweetalert::alert');
    <div class="container-scroller">
        @include('admin.sidebar')
        <div class="container-fluid page-body-wrapper">
            @include('admin.navbar')
            <div class="main-panel">
                <div class="content-wrapper">

                    <form action="{{ url('/search-product') }}" class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" method="GET" id="searchForm">
                        @csrf
                        <input type="text" name="search" class="form-control" placeholder="{{ __('show_product.search_products') }}" id="searchInput">
                        
                        <!-- Category Filter -->
                        <select name="category_id" class="form-control" id="categorySelect">
                            <option value="">{{ __('show_product.all_categories') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </form>
                    
                    <script>      
                        document.getElementById('searchInput').addEventListener('blur', function() {
                            document.getElementById('searchForm').submit();
                        });                 
                    
                        document.getElementById('categorySelect').addEventListener('change', function() {
                            document.getElementById('searchForm').submit();
                        });
                    </script>
                    
                    
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{ __('show_product.all_products') }}</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('show_product.product_image') }}</th>
                                                <th>{{ __('show_product.name') }}</th>
                                                <th>{{ __('show_product.category') }}</th>
                                                <th>{{ __('show_product.unit_price') }}</th>
                                                <th>{{ __('show_product.quantity') }}</th>
                                                 <th>{{ __('show_product.warehouse') }}</th>
                                                <th>{{ __('show_product.brand') }}</th>
                                               
                                                <th>{{ __('show_product.delete') }}</th>
                                                <th>{{ __('show_product.edit') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($products as $product)
                                                <tr>
                                                    <td>
                                                        @if ($product->images->isNotEmpty())
                                                            <img src="{{ asset( $product->images->first()->image_path) }}"
                                                                alt="{{ $product->images->first()->image_path }}" />
                                                        @else
                                                            <p>{{ __('show_product.no_image_available') }}</p>
                                                        @endif
                                                    </td>
                                                    <td>{{ $product->title }}</td>

                                                     <td>
                                                      @if($product->category)
                                                          {{ $product->category->category_name }}
                                                      @else
                                                          <span class="text-danger">{{ __('show_product.no_category_assigned') }}</span>
                                                      @endif
                                                  </td>
                                                  
                                                    <td style="color: orange">
                                                        @foreach ($product->units as $unit)
                                                            <p>{{ $unit->unit }} : {{ $unit->price }}</p>
                                                        @endforeach
                                                    </td>

                                                    <td class="text-danger">{{ $product->qty }}</td>
                                                    <td>{{ $product->warehouse->name }} {{ $product->processor }}</td>
                                                    <td>{{ $product->brand }}</td>

                                                    <td>
                                                        <a href="{{ url('delete_product', $product->id) }}"
                                                            style="font-size: 25px; color:#FF6D60"><i
                                                                class="mdi mdi-delete-sweep"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.edit_product', ['lang' => app()->getLocale(),"id"=>$product->id] ) }}"
                                                            style="font-size: 20px;color:#7149C6"><i
                                                                class="mdi mdi-tooltip-edit"></i></a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="16">
                                                        <div class="text-center">
                                                            <img style="width: 25%;height: 25%;"
                                                                src="/user/assets/imgs/no-search-result.png"
                                                                alt="no-search-result">
                                                            <h4>{{ __('show_product.no_product_found') }}</h4>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
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