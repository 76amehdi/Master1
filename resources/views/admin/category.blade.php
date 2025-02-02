<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin | {{ __('manage_category.title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/admin/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/admin/assets/css/style.css">
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1.5rem;
        }
        .form-group label {
            font-weight: 500;
            color: #555;
            margin-bottom: 0.5rem;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 0.75rem;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #4B49AC;
            box-shadow: 0 0 0 0.2rem rgba(75, 73, 172, 0.25);
        }
        .btn {
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s;
        }
        .btn-primary {
            background-color: #4B49AC;
            border: none;
        }
        .btn-primary:hover {
            background-color: #3c3a87;
            transform: translateY(-1px);
        }
        .table {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }
        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            color: #495057;
            font-weight: 600;
            padding: 1rem;
        }
        .table td {
            vertical-align: middle;
            padding: 1rem;
        }
        .dropdown-menu {
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 0.5rem;
        }
        .dropdown-item {
            border-radius: 6px;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        .dropdown-item i {
            font-size: 1.1rem;
        }
        .category-image {
            max-width: 100px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h2 class="card-title mb-0">{{ __('manage_category.manage_categories') }}</h2>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#createCategoryModal">
                                        <i class="mdi mdi-plus me-2"></i>
                                        {{ __('manage_category.add_new_category') }}
                                    </button>
                                </div>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('manage_category.category_name') }}</th>
                                                <th>{{ __('manage_category.category_image') }}</th>
                                                <th class="text-center">{{ __('manage_category.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td>{{ $category->category_name }}</td>
                                                    <td>
                                                        @if ($category->image)
                                                            <img src="{{ asset($category->image) }}"
                                                                alt="Category Image" class="category-image">
                                                        @else
                                                            {{ __('manage_category.no_image_available') }}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="mdi mdi-dots-vertical"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <button type="button" class="dropdown-item edit-category"
                                                                        data-id="{{ $category->id }}" data-bs-toggle="modal"
                                                                        data-bs-target="#editCategoryModal">
                                                                        <i class="mdi mdi-pencil"></i>
                                                                        {{ __('manage_category.edit') }}
                                                                    </button>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ url('delete_category', $category->id) }}"
                                                                        class="dropdown-item text-danger"
                                                                        onclick="return confirm('{{ __('manage_category.confirm_delete') }}')">
                                                                        <i class="mdi mdi-delete"></i>
                                                                        {{ __('manage_category.delete') }}
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

                    <!-- Create Modal -->
                    <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createCategoryModalLabel">{{ __('manage_category.add_new_category') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.add_category') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="category_name" class="form-label">{{ __('manage_category.category_name') }}</label>
                                            <input type="text" class="form-control" id="category_name" name="category" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="category_image" class="form-label">{{ __('manage_category.category_image') }}</label>
                                            <input type="file" class="form-control" id="category_image" name="categorieImage" accept="image/*" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('manage_category.cancel') }}</button>
                                        <button type="submit" class="btn btn-primary">{{ __('manage_category.add_category') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editCategoryModalLabel">{{ __('manage_category.edit_category') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form will be loaded here by JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="/admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="/admin/assets/js/off-canvas.js"></script>
    <script src="/admin/assets/js/hoverable-collapse.js"></script>
    <script src="/admin/assets/js/misc.js"></script>
    <script src="/admin/assets/js/settings.js"></script>
    <script src="/admin/assets/js/todolist.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Bootstrap dropdowns
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
            var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl)
            });

            // Edit Category
            $('.edit-category').click(function() {
                let categoryId = $(this).data('id');
                
                $.ajax({
                    url: `/admin/categories/${categoryId}/edit`,
                    type: 'GET',
                    success: function(response) {
                        let formHtml = `
                            <form action="/update_category/${categoryId}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="category_name" class="form-label">${response.translations.category_name}</label>
                                    <input type="text" class="form-control" id="category_name" name="category" 
                                           value="${response.category.category_name}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="category_image" class="form-label">${response.translations.category_image}</label>
                                    <input type="file" class="form-control" id="category_image" name="categorieImage" accept="image/*">
                                    ${response.category.image ? 
                                        `<img src="{{ asset('') }}${response.category.image}" class="mt-2 category-image" alt="Current Image">` : 
                                        ''}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">${response.translations.cancel}</button>
                                    <button type="submit" class="btn btn-primary">${response.translations.update}</button>
                                </div>
                            </form>
                        `;
                        
                        $('#editCategoryModal .modal-body').html(formHtml);
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        alert('Error loading category data');
                    }
                });
            });
        });
    </script>
</body>

</html>