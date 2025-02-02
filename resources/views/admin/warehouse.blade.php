<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin | {{ __('users.title') }}</title>
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
                                <div class="">
                                    <div class="">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="card-title">{{ __('warehouses.all_warehouses') }}</h4>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#addWarehouseModal">
                                                {{ __('warehouses.add_new_warehouse') }}
                                            </button>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <style>
                                                        th {
                                                            text-align: center;
                                                            color: white;
                                                        }
                                                    </style>
                                                    <tr>
                                                        <th>{{ __('warehouses.name') }}</th>
                                                        <th>{{ __('warehouses.location') }}</th>
                                                        <th>{{ __('warehouses.actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <style>
                                                        table td {
                                                            text-align: center;
                                                            color: #000000;
                                                        }
                                                    </style>
                                                    @foreach ($warehouses as $warehouse)
                                                        <tr>
                                                            <td>{{ $warehouse->name }}</td>
                                                            <td>{{ $warehouse->location }}</td>
                                                            <td>
                                                                <a href="#" class="btn btn-sm btn-primary"
                                                                    data-toggle="modal"
                                                                    data-target="#editWarehouseModal{{ $warehouse->id }}">{{ __('warehouses.edit') }}</a>
                                                                <a href="{{ route('warehouses.show', $warehouse->id) }}"
                                                                    class="btn btn-sm btn-info">{{ __('warehouses.view_products') }}</a>
                                                                <a href="{{ url('delete_warehouse', $warehouse->id) }}"
                                                                    class="btn btn-sm btn-danger"
                                                                    type="Delete">{{ __('warehouses.delete') }}</a>
                                                            </td>
                                                        </tr>

                                                        <div class="modal fade"
                                                            id="editWarehouseModal{{ $warehouse->id }}" tabindex="-1"
                                                            role="dialog"
                                                            aria-labelledby="editWarehouseModalLabel{{ $warehouse->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content"
                                                                    style="background: rgb(175, 173, 173);">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="editWarehouseModalLabel{{ $warehouse->id }}">
                                                                            {{ __('warehouses.edit_warehouse') }}</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('admin.update_warehouse', $warehouse->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="form-group row">
                                                                                <label for="name"
                                                                                    class="col-sm-3 col-form-label">{{ __('warehouses.warehouse_name') }}</label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text" name="name"
                                                                                        class="form-control"
                                                                                        id="name"
                                                                                        value="{{ $warehouse->name }}"
                                                                                        required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="location"
                                                                                    class="col-sm-3 col-form-label">{{ __('warehouses.warehouse_location') }}</label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text"
                                                                                        name="location"
                                                                                        class="form-control"
                                                                                        id="location"
                                                                                        value="{{ $warehouse->location }}"
                                                                                        required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">{{ __('warehouses.close') }}</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">{{ __('warehouses.update_warehouse') }}</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </tbody>
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
    </div>

    <!-- Add Warehouse Modal -->
    <div class="modal fade" id="addWarehouseModal" tabindex="-1" role="dialog"
        aria-labelledby="addWarehouseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addWarehouseModalLabel">{{ __('warehouses.add_new_warehouse') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" action="{{ route('admin.add_warehouse') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="name"
                                class="col-sm-3 col-form-label">{{ __('warehouses.warehouse_name') }}</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="{{ __('warehouses.enter_warehouse_name') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="location"
                                class="col-sm-3 col-form-label">{{ __('warehouses.warehouse_location') }}</label>
                            <div class="col-sm-9">
                                <input type="text" name="location" class="form-control" id="location"
                                    placeholder="{{ __('warehouses.enter_warehouse_location') }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('warehouses.close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('warehouses.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('admin/assets/js/misc.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
