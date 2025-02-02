<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ __('astuce.title') }}</title>
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
        .astuce-image {
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
                                    <h2 class="card-title mb-0">{{ __('astuce.title') }}</h2>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#createAstuceModal">
                                        <i class="mdi mdi-plus me-2"></i>
                                        {{ __('astuce.add_new') }}
                                    </button>
                                </div>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('astuce.category') }}</th>
                                                <th>{{ __('astuce.title') }}</th>
                                                <th>{{ __('astuce.text') }}</th>
                                                <th>{{ __('astuce.image') }}</th>
                                                <th class="text-center">{{ __('astuce.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($astuces as $astuce)
                                                <tr>
                                                    <td>{{ $astuce->category }}</td>
                                                    <td>{{ $astuce->title }}</td>
                                                    <td>{{ \Illuminate\Support\Str::limit($astuce->text, 50) }}</td>
                                                    <td>
                                                        @if ($astuce->image)
                                                            <img src="{{ asset($astuce->image) }}"
                                                                alt="Astuce Image" class="astuce-image">
                                                        @else
                                                            {{ __('astuce.no_image') }}
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
                                                                    <button type="button" class="dropdown-item show-astuce"
                                                                        data-id="{{ $astuce->id }}" data-bs-toggle="modal"
                                                                        data-bs-target="#showAstuceModal">
                                                                        <i class="mdi mdi-eye"></i>
                                                                        Afficher
                                                                    </button>
                                                                </li>
                                                                <li>
                                                                    <button type="button" class="dropdown-item edit-astuce"
                                                                        data-id="{{ $astuce->id }}" data-bs-toggle="modal"
                                                                        data-bs-target="#editAstuceModal">
                                                                        <i class="mdi mdi-pencil"></i>
                                                                        {{ __('astuce.edit') }}
                                                                    </button>
                                                                </li>
                                                                <li>
                                                                    <form action="{{ route('admin.astuces.destroy', $astuce->id) }}"
                                                                        method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="dropdown-item text-danger"
                                                                            onclick="return confirm('{{ __('astuce.confirm_delete') }}')">
                                                                            <i class="mdi mdi-delete"></i>
                                                                            {{ __('astuce.delete') }}
                                                                        </button>
                                                                    </form>
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
                    <div class="modal fade" id="createAstuceModal" tabindex="-1"
                        aria-labelledby="createAstuceModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createAstuceModalLabel">
                                        {{ __('astuce.create_astuce') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.astuces.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="title" class="form-label">{{ __('astuce.title') }}</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="category" class="form-label">{{ __('astuce.category') }}</label>
                                            <input type="text" name="category" id="category"
                                                class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="text" class="form-label">{{ __('astuce.text') }}</label>
                                            <textarea name="text" id="text" class="form-control" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">{{ __('astuce.image') }}</label>
                                            <input type="file" name="image" id="image"
                                                class="form-control" accept="image/*">
                                        </div>
                                        <button type="submit" class="btn btn-primary">{{ __('astuce.add') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editAstuceModal" tabindex="-1"
                        aria-labelledby="editAstuceModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editAstuceModalLabel">
                                        {{ __('astuce.edit_astuce') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Edit form will be loaded here via AJAX -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Show Modal -->
                    <div class="modal fade" id="showAstuceModal" tabindex="-1"
                        aria-labelledby="showAstuceModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="showAstuceModalLabel">
                                        {{ __('astuce.view_astuce') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Show details will be loaded here via AJAX -->
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

            // Edit Astuce
            $('.edit-astuce').click(function() {
                let astuceId = $(this).data('id');
                
                $.ajax({
                    url: `/admin/astuces/${astuceId}/edit`,
                    type: 'GET',
                    success: function(response) {
                        // Create the edit form HTML
                        let formHtml = `
                            <form action="/admin/astuces/${astuceId}/update" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="title" class="form-label">${response.translations.title}</label>
                                    <input type="text" name="title" class="form-control" value="${response.astuce.title}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">${response.translations.category}</label>
                                    <input type="text" name="category" class="form-control" value="${response.astuce.category}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="text" class="form-label">${response.translations.text}</label>
                                    <textarea name="text" class="form-control" required>${response.astuce.text}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">${response.translations.image}</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                    ${response.astuce.image ? 
                                        `<img src="{{ asset('') }}${response.astuce.image}" class="mt-2 astuce-image" alt="Current Image">` : 
                                        ''}
                                </div>
                                <button type="submit" class="btn btn-primary">${response.translations.update}</button>
                            </form>
                        `;
                        
                        $('#editAstuceModal .modal-body').html(formHtml);
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        alert('Error loading astuce data');
                    }
                });
            });

            // Show Astuce Details
            $('.show-astuce').click(function() {
                let astuceId = $(this).data('id');
                
                $.ajax({
                    url: `/admin/astuces/${astuceId}/show`,
                    type: 'GET',
                    success: function(response) {
                        let detailsHtml = `
                            <div class="astuce-details">
                                <div class="mb-3">
                                    <strong>${response.translations.title}:</strong>
                                    <p>${response.astuce.title}</p>
                                </div>
                                <div class="mb-3">
                                    <strong>${response.translations.category}:</strong>
                                    <p>${response.astuce.category}</p>
                                </div>
                                <div class="mb-3">
                                    <strong>${response.translations.text}:</strong>
                                    <p>${response.astuce.text}</p>
                                </div>
                                ${response.astuce.image ? 
                                    `<div class="mb-3">
                                        <strong>${response.translations.image}:</strong><br>
                                        <img src="{{ asset('') }}${response.astuce.image}" class="mt-2 astuce-image" alt="Astuce Image">
                                    </div>` : 
                                    ''}
                            </div>
                        `;
                        
                        $('#showAstuceModal .modal-body').html(detailsHtml);
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        alert('Error loading astuce details');
                    }
                });
            });
        });
    </script>
</body>

</html>