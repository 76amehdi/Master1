<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin | {{ __('fournisseurs.title') }}</title>
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
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal"
                            data-target="#addFournisseurModal">{{ __('fournisseurs.add_fournisseur') }}</button>


                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('fournisseurs.id') }}</th>
                                    <th>{{ __('fournisseurs.name') }}</th>
                                    <th>{{ __('fournisseurs.email') }}</th>
                                    <th>{{ __('fournisseurs.phone') }}</th>
                                    <th>{{ __('fournisseurs.address') }}</th>
                                    <th>{{ __('fournisseurs.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fournisseurs as $fournisseur)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $fournisseur->name }}</td>
                                        <td>{{ $fournisseur->email }}</td>
                                        <td>{{ $fournisseur->phone }}</td>
                                        <td>{{ $fournisseur->address }}</td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#editFournisseurModal{{ $fournisseur->id }}"
                                               onclick="return confirm('{{ __('fournisseurs.edit_confirmation') }}')">{{ __('fournisseurs.edit') }}</a>
                                            <form action="{{ route('fournisseurs.destroy', $fournisseur->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('{{ __('fournisseurs.delete_confirmation') }}')">{{ __('fournisseurs.delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editFournisseurModal{{ $fournisseur->id }}"
                                        tabindex="-1" role="dialog"
                                        aria-labelledby="editFournisseurLabel{{ $fournisseur->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="editFournisseurLabel{{ $fournisseur->id }}">{{ __('fournisseurs.edit_fournisseur') }}
                                                        </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('fournisseurs.update', $fournisseur->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="name">{{ __('fournisseurs.name') }}</label>
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" value="{{ $fournisseur->name }}"
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">{{ __('fournisseurs.email') }}</label>
                                                            <input type="email" class="form-control" id="email"
                                                                name="email" value="{{ $fournisseur->email }}"
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="phone">{{ __('fournisseurs.phone') }}</label>
                                                            <input type="text" class="form-control" id="phone"
                                                                name="phone" value="{{ $fournisseur->phone }}"
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="address">{{ __('fournisseurs.address') }}</label>
                                                            <input type="text" class="form-control" id="address"
                                                                name="address" value="{{ $fournisseur->address }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ __('fournisseurs.close') }}</button>
                                                        <button type="submit" class="btn btn-primary">{{ __('fournisseurs.save_changes') }}
                                                            </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>

                        </table>

                         <!-- Add Fournisseur Modal -->
                        <div class="modal fade" id="addFournisseurModal" tabindex="-1" role="dialog"
                            aria-labelledby="addFournisseurModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addFournisseurModalLabel">{{ __('fournisseurs.add_fournisseur') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                     <form action="{{ route('fournisseurs.store') }}" method="POST">
                                          @csrf
                                            <div class="modal-body">
                                               <div class="form-group">
                                                    <label for="name">{{ __('fournisseurs.name') }}</label>
                                                    <input type="text" class="form-control" id="name"
                                                        name="name"  required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">{{ __('fournisseurs.email') }}</label>
                                                    <input type="email" class="form-control" id="email"
                                                        name="email" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">{{ __('fournisseurs.phone') }}</label>
                                                    <input type="text" class="form-control" id="phone"
                                                        name="phone" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">{{ __('fournisseurs.address') }}</label>
                                                    <input type="text" class="form-control" id="address"
                                                        name="address" >
                                                </div>
                                           </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ __('fournisseurs.close') }}</button>
                                            <button type="submit" class="btn btn-primary">{{ __('fournisseurs.save') }}</button>
                                        </div>
                                    </form>
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