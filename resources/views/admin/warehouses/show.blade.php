<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ __('purchasedetails.page_title') }}</title>
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
    <style>
        .sidebar .nav .nav-item.active>.nav-link {
            background: none !important;
        }

         .image-cell img {
            max-width: 100px; /* Adjust as needed */
            height: auto; /* Maintain aspect ratio */
            display: block;
             margin-left: auto; /* Center the image */
            margin-right: auto;
             border-radius: 4px;
            border: 1px solid #ddd;
        }
        .units-list {
            padding-left: 20px;
             margin: 0;
        }

        .units-list li {
             list-style: none;
             padding: 0;
            margin: 0;

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
                                <h1 class="card-title"> <i class="mdi mdi-warehouse"></i> Warehouse Details: {{ $warehouse->name }}</h1>
                                 <p> <i class="mdi mdi-map-marker"></i> <strong>Location:</strong> {{ $warehouse->location }}</p>

                            </div>
                         </div>



                            <div class="card">
                                <div class="card-body">
                                   <h2 class="card-title"> <i class="mdi mdi-package-variant"></i> Products in this Warehouse</h2>
                                 @if ($warehouse->products->isEmpty())
                                     <p>No products in this warehouse.</p>
                                 @else
                                   <div style="overflow-x: auto">
                                       <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th> <i class="mdi mdi-key"></i> ID</th>
                                                  <th> <i class="mdi mdi-text"></i> Title</th>
                                                   <th> <i class="mdi mdi-bookmark"></i> Category</th>
                                                  <th><i class="mdi mdi-label"></i> Brand</th>
                                                <th> <i class="mdi mdi-format-list-bulleted"></i> Units</th>
                                                 <th> <i class="mdi mdi-image"></i> Image</th>
                                              </tr>
                                           </thead>
                                             <tbody>
                                              @foreach ($warehouse->products as $product)
                                               <tr>
                                                   <td>{{ $product->id }}</td>
                                                    <td>{{ $product->title }}</td>
                                                   <td>{{ $product->category->category_name ?? 'N/A' }}</td>
                                                    <td>{{ $product->brand }}</td>
                                                    <td>
                                                        @if ($product->units->isNotEmpty())
                                                        <ul class="units-list">
                                                            @foreach ($product->units as $unit)
                                                            <li>{{ $unit->unit }} - {{ $unit->price }}</li>
                                                            @endforeach
                                                        </ul>
                                                         @else
                                                            No Units
                                                        @endif
                                                   </td>
                                                    <td class="image-cell">
                                                        @if ($product->images->isNotEmpty())
                                                          <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                                                alt="Product Image">
                                                        @else
                                                        No Image
                                                       @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                         </tbody>
                                    </table>
                                 </div>
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