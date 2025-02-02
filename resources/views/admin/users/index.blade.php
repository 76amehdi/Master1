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
                        
                        <h1>{{ __('users.users') }}</h1>
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal"
                            data-target="#addUserModal">{{ __('users.create_new_user') }}</button>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('users.name') }}</th>
                                    <th>{{ __('users.email') }}</th>
                                    <th>{{ __('users.roles') }}</th>
                                    <th>{{ __('users.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->roles)
                                                @foreach ($user->roles->getAttributes() as $role => $value)
                                                    @if ($value && !in_array($role, ['id', 'user_id', 'updated_at']))
                                                        {{ ucfirst(str_replace('_', ' ', $role)) }} <br>
                                                    @endif
                                                @endforeach
                                            @else
                                               {{ __('users.no_roles') }}
                                            @endif
                                        </td>

                                        <td>
                                            <a href="#" class="btn btn-warning" data-toggle="modal"
                                                data-target="#editUserModal{{ $user->id }}" onclick="return confirm('{{ __('users.edit_confirmation') }}')">{{ __('users.edit') }}</a>
                                            <a href="#" class="btn btn-info" data-toggle="modal"
                                                data-target="#manageRolesModal{{ $user->id }}" onclick="return confirm('{{ __('users.manage_roles_confirmation') }}')">{{ __('users.manage_roles') }}</a>
                                            <form action="{{ route('users.destroy', ['lang' => app()->getLocale(),'user'=> $user->id ]) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('{{ __('users.delete_confirmation') }}')">{{ __('users.delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Edit User Modal -->
                                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="editUserModalLabel{{ $user->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">{{ __('users.edit_user') }}
                                                        </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('users.update',  ['lang' => app()->getLocale(),'user'=> $user->id ]) }}"
                                                        method="POST" onsubmit="return confirm('{{ __('users.update_user_confirmation') }}')">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">{{ __('users.name') }}</label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" value="{{ $user->name }}"
                                                                required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">{{ __('users.email') }}</label>
                                                            <input type="email" id="email" name="email"
                                                                class="form-control" value="{{ $user->email }}"
                                                                required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="password" class="form-label">{{ __('users.password') }}</label>
                                                            <input type="password" id="password" name="password"
                                                                class="form-control">
                                                            <small>{{ __('users.password_leave_blank') }}</small>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="phone" class="form-label">{{ __('users.phone') }}</label>
                                                            <input type="text" id="phone" name="phone"
                                                                class="form-control" value="{{ $user->phone }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="address" class="form-label">{{ __('users.address') }}</label>
                                                            <input type="text" id="address" name="address"
                                                                class="form-control" value="{{ $user->address }}">
                                                        </div>
                                                          <div class="mb-3">
                                                            <label for="usertype" class="form-label">{{ __('users.user_type') }}</label>
                                                            <input type="number" id="usertype" name="usertype"
                                                                class="form-control" value="{{ $user->usertype }}"
                                                                required>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ __('users.close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-success">{{ __('users.update') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Manage Roles Modal -->
                                    <div class="modal fade" id="manageRolesModal{{ $user->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="manageRolesModalLabel{{ $user->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="manageRolesModalLabel{{ $user->id }}">{{ __('users.manage_roles_for') }}
                                                        {{ $user->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('users.roles.update', ['lang' => app()->getLocale(),'id'=> $user->id ]) }}"
                                                        method="POST" onsubmit="return confirm('{{ __('users.update_roles_confirmation') }}')">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            @foreach (['manage_categories', 'manage_products', 'manage_users', 'manage_orders', 'manage_warehouses', 'admin'] as $role)
                                                                <div class="form-check">
                                                                    <input type="checkbox"
                                                                        name="roles[{{ $role }}]"
                                                                        class="form-check-input"
                                                                        {{ isset($user->roles->$role) && $user->roles->$role ? 'checked' : '' }}>
                                                                    <label class="form-check-label me-2"
                                                                        for="{{ $role }}">
                                                                        {{ ucfirst(str_replace('_', ' ', $role)) }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ __('users.close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-success">{{ __('users.update_roles') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                         <!-- Add User Modal -->
                        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog"
                            aria-labelledby="addUserModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addUserModalLabel">{{ __('users.create_user') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                         <form action="{{ route('users.store',['lang' => app()->getLocale()]) }}" method="POST">
                                          @csrf
                                            <div class="mb-3">
                                                <label for="name" class="form-label">{{ __('users.name') }}</label>
                                                <input type="text" id="name" name="name"
                                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                                    required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">{{ __('users.email') }}</label>
                                                <input type="email" id="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ old('email') }}" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">{{ __('users.password') }}</label>
                                                <input type="password" id="password" name="password"
                                                    class="form-control @error('password') is-invalid @enderror" required>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">{{ __('users.phone') }}</label>
                                                <input type="text" id="phone" name="phone"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    value="{{ old('phone') }}">
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="address" class="form-label">{{ __('users.address') }}</label>
                                                <input type="text" id="address" name="address"
                                                    class="form-control @error('address') is-invalid @enderror"
                                                    value="{{ old('address') }}">
                                                @error('address')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="usertype" class="form-label"></label>
                                                <input type="hidden" value="1" id="usertype" name="usertype"
                                                    class="form-control @error('usertype') is-invalid @enderror"
                                                    value="{{ old('usertype') }}" required disabled>
                                                @error('usertype')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!--<div class="mb-3">
                                                <label>{{ __('users.roles') }}</label>
                                                <div>
                                                    @foreach (['manage_categories', 'manage_products', 'manage_users', 'manage_orders', 'manage_warehouses', 'admin'] as $role)
                                                        <div class="form-check">
                                                            <input type="checkbox" name="roles[{{ $role }}]"
                                                                class="form-check-input" {{ old('roles.' . $role) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="{{ $role }}">
                                                                {{ ucfirst(str_replace('_', ' ', $role)) }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>-->
                                           <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ __('users.close') }}</button>
                                                <button type="submit" class="btn btn-success">{{ __('users.create') }}</button>
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
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>