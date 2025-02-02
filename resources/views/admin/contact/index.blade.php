<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin </title>
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
    <style>
        .table {
            background-color: transparent !important;
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
                        <h1>{{ __('Contact Management') }}</h1>
                        <div class="d-flex justify-content-end mb-3">
                            @if (!$contact)
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addContactModal">
                                    {{ __('Add Contact') }}
                                </button>
                            @endif
                        </div>

                        <table id="contacts-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Phone') }}</th>
                                    <th>{{ __('Message') }}</th>
                                    <th>{{ __('Localisation') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($contact)
                                    <tr>
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($contact->message, 15, '...') }}</td>
                                        <td>{{ $contact->localisation }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editContactModal">{{ __('Edit') }}</button>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteContactModal">{{ __('Delete') }}</button>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <!--Add Contact Modal -->
                        @if (!$contact)
                            <div class="modal fade" id="addContactModal" tabindex="-1"
                                aria-labelledby="addContactModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addContactModalLabel">
                                                {{ __('Add New Contact') }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="addContactForm" method="POST"
                                                action="{{ route('contacts.store', ['lang' => app()->getLocale()]) }}">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="email"
                                                        class="form-label">{{ __('Email') }}</label>
                                                    <input type="email" class="form-control" id="email"
                                                        name="email" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone"
                                                        class="form-label">{{ __('Phone') }}</label>
                                                    <input type="text" class="form-control" id="phone"
                                                        name="phone">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="message"
                                                        class="form-label">{{ __('Message') }}</label>
                                                    <textarea class="form-control" id="message" name="message"></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="localisation"
                                                        class="form-label">{{ __('Localisation') }}</label>
                                                    <input type="text" class="form-control" id="localisation"
                                                        name="localisation">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-primary">{{ __('Save Contact') }}</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Edit Contact Modal -->
                        <!-- Edit Contact Modal -->
                        <div class="modal fade" id="editContactModal" tabindex="-1"
                            aria-labelledby="editContactModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editContactModalLabel">{{ __('Edit Contact') }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($contact)
                                            <form id="editContactForm" method="POST"
                                                action="{{ route('contacts.update', ['contact' => $contact->id, 'lang' => app()->getLocale()]) }}">
                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" id="edit_id" name="id"
                                                    value="{{ $contact->id }}">
                                                <div class="mb-3">
                                                    <label for="edit_email"
                                                        class="form-label">{{ __('Email') }}</label>
                                                    <input type="email" class="form-control" id="edit_email"
                                                        name="email" required value="{{ $contact->email }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_phone"
                                                        class="form-label">{{ __('Phone') }}</label>
                                                    <input type="text" class="form-control" id="edit_phone"
                                                        name="phone" value="{{ $contact->phone }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_message"
                                                        class="form-label">{{ __('Message') }}</label>
                                                    <textarea class="form-control" id="edit_message" name="message">{{ $contact->message }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_localisation"
                                                        class="form-label">{{ __('Localisation') }}</label>
                                                    <input type="text" class="form-control" id="edit_localisation"
                                                        name="localisation" value="{{ $contact->localisation }}">
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-primary">{{ __('Update Contact') }}</button>
                                                </div>

                                            </form>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Delete Contact Modal -->
                        <div class="modal fade" id="deleteContactModal" tabindex="-1"
                            aria-labelledby="deleteContactModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteContactModalLabel">
                                            {{ __('Delete Contact') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ __('Are you sure you want to delete this contact?') }}</p>
                                        @if ($contact)
                                            <form id="deleteContactForm" method="POST"
                                                action="{{ route('contacts.destroy', ['contact' => $contact->id, 'lang' => app()->getLocale()]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" id="delete_id" name="id"
                                                    value="{{ $contact->id }}">
                                                <button type="submit"
                                                    class="btn btn-danger">{{ __('Delete') }}</button>
                                            </form>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
                    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
