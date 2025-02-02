<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

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
    <div class="container mt-5">


        <a href="{{route("dashboard",['lang'=>app()->getLocale()])}}" class="btn btn-secondary mb-3"> {{ __('homepage_settings.dashboard') }}</a>
        <!-- Homepage Settings Section -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>{{ __('homepage_settings.homepage_settings') }}</h5>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#settingsModal">
                    {{ $settings ? __('homepage_settings.update_settings') : __('homepage_settings.create_settings') }}
                </button>
            </div>
            <div class="card-body">
                @if ($settings)
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>{{ __('homepage_settings.currency') }}:</strong> {{ $settings->currency }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>{{ __('homepage_settings.normal_delivery_price') }}:</strong>
                                {{ $settings->normal_delivery_price }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>{{ __('homepage_settings.free_delivery_threshold') }}:</strong>
                                {{ $settings->free_delivery_threshold }}</p>
                        </div>
                    </div>
                @else
                    <p>{{ __('homepage_settings.no_settings_configured') }}</p>
                @endif
            </div>
        </div>

        <!-- Featured Products Section -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>{{ __('homepage_settings.featured_products') }}</h5>
                @if (count($featuredProducts) < 3)
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#featuredProductModal">
                        {{ __('homepage_settings.add_featured_product') }}
                    </button>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($featuredProducts as $product)
                        <div class="col-md-4 position-relative">
                            <div class="card">
                                <span class="badge bg-primary order-badge">{{ __('homepage_settings.order') }}:
                                    {{ $product->display_order }}</span>
                                <img src="{{ asset($product->featured_image_path) }}"
                                    class="featured-product-img card-img-top" alt="Product Image">
                                <div class="card-body">
                                    <h6>{{ $product->product->title }}</h6>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-warning edit-featured"
                                            data-id="{{ $product->id }}" data-product="{{ $product->product_id }}"
                                            data-order="{{ $product->display_order }}"
                                            data-image="{{ $product->featured_image_path }}">
                                            {{ __('homepage_settings.edit') }}
                                        </button>
                                        <form method="POST"
                                            action="{{ route('admin.featured_products.destroy', $product->id) }}"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-danger">{{ __('homepage_settings.delete') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Category Display Section -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>{{ __('homepage_settings.category_display') }}</h5>
                @if (count($categoryDisplays) < 4)
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">
                        {{ __('homepage_settings.add_category_display') }}
                    </button>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($categoryDisplays as $categoryDisplay)
                        <div class="col-md-3 position-relative">
                            <div class="card">
                                <span class="badge bg-primary order-badge">{{ __('homepage_settings.order') }}:
                                    {{ $categoryDisplay->display_order }}</span>
                                <img src="{{ asset( $categoryDisplay->display_image_path) }}"
                                    class="category-img card-img-top" alt="Category Image">
                                <div class="card-body">
                                    <h6>{{ $categoryDisplay->category->category_name }}</h6>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-warning edit-category"
                                            data-id="{{ $categoryDisplay->id }}"
                                            data-category="{{ $categoryDisplay->category_id }}"
                                            data-order="{{ $categoryDisplay->display_order }}"
                                            data-image="{{ $categoryDisplay->display_image_path }}">
                                            {{ __('homepage_settings.edit') }}
                                        </button>
                                        <form method="POST"
                                            action="{{ route('admin.category_displays.destroy', $categoryDisplay->id) }}"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-danger">{{ __('homepage_settings.delete') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Modal -->
    <div class="modal fade" id="settingsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('homepage_settings.homepage_settings') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="settingsForm" method="POST" action="{{ route('admin.settings.store') }}">
                    @csrf
                    @if ($settings)
                        @method('PUT')
                        <input type="hidden" name="settings_id" value="{{ $settings->id }}">
                    @endif
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>{{ __('homepage_settings.currency') }}</label>
                            <input type="text" name="currency" class="form-control"
                                value="{{ $settings->currency ?? '' }}" required>
                        </div>
                        <div class="mb-3">
                            <label>{{ __('homepage_settings.normal_delivery_price') }}</label>
                            <input type="number" step="0.01" name="normal_delivery_price" class="form-control"
                                value="{{ $settings->normal_delivery_price ?? '' }}" required>
                        </div>
                        <div class="mb-3">
                            <label>{{ __('homepage_settings.free_delivery_threshold') }}</label>
                            <input type="number" step="0.01" name="free_delivery_threshold" class="form-control"
                                value="{{ $settings->free_delivery_threshold ?? '' }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('homepage_settings.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('homepage_settings.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Featured Product Modal -->
    <div class="modal fade" id="featuredProductModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('homepage_settings.featured_product') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="featuredProductForm" method="POST" enctype="multipart/form-data"
                    action="{{ route('admin.featured_products.store') }}">
                    @csrf
                    <input type="hidden" name="featured_id" id="featured_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>{{ __('homepage_settings.product') }}</label>
                            <select name="product_id" class="form-control" required>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>{{ __('homepage_settings.display_order') }} (1-3)</label>
                            <input type="number" min="1" max="3" name="display_order"
                                class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>{{ __('homepage_settings.image') }}</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <div id="imagePreview" style="max-width: 100px; max-height: 100px; display: none;">
                                <img id="previewImage" src="#" alt="Image Preview"
                                    style="max-width: 100%; max-height: 100%;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('homepage_settings.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('homepage_settings.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Category Display Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('homepage_settings.category_display') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="categoryForm" method="POST" enctype="multipart/form-data"
                    action="{{ route('admin.category_displays.store') }}">
                    @csrf
                    <input type="hidden" name="category_display_id" id="category_display_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>{{ __('homepage_settings.category') }}</label>
                            <select name="category_id" class="form-control" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>{{ __('homepage_settings.display_order') }} (1-4)</label>
                            <input type="number" min="1" max="4" name="display_order"
                                class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>{{ __('homepage_settings.image') }}</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <div id="categoryImagePreview"
                                style="max-width: 100px; max-height: 100px; display: none;">
                                <img id="previewCategoryImage" src="#" alt="Category Image Preview"
                                    style="max-width: 100%; max-height: 100%;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('homepage_settings.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('homepage_settings.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Image Preview
            function setupImagePreview(inputElement, previewElement) {
                inputElement.on('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            previewElement.attr('src', e.target.result).parent().show();
                        };
                        reader.readAsDataURL(file);
                    } else {
                        previewElement.attr('src', '#').parent().hide();
                    }
                });
            }

            setupImagePreview($('#featuredProductModal [name="image"]'), $('#featuredProductModal #previewImage'));
            setupImagePreview($('#categoryModal [name="image"]'), $('#categoryModal #previewCategoryImage'));

            // Edit Featured Product
            $('.edit-featured').click(function() {
                const modal = $('#featuredProductModal');
                modal.find('#featuredProductForm').attr('action',
                    `/admin/featured-products/${$(this).data('id')}`);
                modal.find('#featured_id').val($(this).data('id'));
                modal.find('[name=product_id]').val($(this).data('product'));
                modal.find('[name=display_order]').val($(this).data('order'));
                // modal.find('[name=image]').val('');
                modal.find('form').append('@method('PUT')');
                modal.modal('show');
            });
            $('#featuredProductModal').on('hidden.bs.modal', function() {
                $(this).find('form').removeAttr('action').find('input[name="_method"]').remove();
                $(this).find('form')[0].reset();
                $('#featuredProductModal #previewImage').attr('src', '#').parent().hide();
            });

            // Edit Category Display
            $('.edit-category').click(function() {
                const modal = $('#categoryModal');
                modal.find('#categoryForm').attr('action',
                `/admin/category-displays/${$(this).data('id')}`);
                modal.find('#category_display_id').val($(this).data('id'));
                modal.find('[name=category_id]').val($(this).data('category'));
                modal.find('[name=display_order]').val($(this).data('order'));
                //  modal.find('[name=image]').val('');
                modal.find('form').append('@method('PUT')');
                modal.modal('show');
            });
            $('#categoryModal').on('hidden.bs.modal', function() {
                $(this).find('form').removeAttr('action').find('input[name="_method"]').remove();
                $(this).find('form')[0].reset();
                $('#categoryModal #previewCategoryImage').attr('src', '#').parent().hide();
            });


            // Edit Settings
            $('#settingsModal').on('show.bs.modal', function(event) {
                const modal = $(this);
                @if ($settings)
                    modal.find('#settingsForm').attr('action', `/admin/settings/{{ $settings->id }}`);
                    modal.find('form').append('@method('PUT')');
                @else
                    modal.find('#settingsForm').attr('action', `/admin/settings`);
                @endif
            });
            $('#settingsModal').on('hidden.bs.modal', function() {
                $(this).find('form').removeAttr('action').find('input[name="_method"]').remove();
                $(this).find('form')[0].reset();
            });
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