<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ __('purchases_index.purchases') }}</title>
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
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
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
        .filter-section {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 500;
            text-align: center;
        }
        .status-unpaid {
            background-color: #ffebee;
            color: #c62828;
        }
        .status-partial {
            background-color: #fff3e0;
            color: #ef6c00;
        }
        .status-paid {
            background-color: #e8f5e9;
            color: #2e7d32;
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
        .pagination {
            margin-top: 2rem;
            justify-content: center;
        }
        .page-link {
            border-radius: 8px;
            margin: 0 0.25rem;
            padding: 0.75rem 1rem;
            color: #4B49AC;
        }
        .page-item.active .page-link {
            background-color: #4B49AC;
            border-color: #4B49AC;
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
                                    <h2 class="card-title mb-0">{{ __('purchases_index.purchases') }}</h2>
                                    <div class="action-buttons">
                                        <a href="{{ route('purchases.create', ['lang' => app()->getLocale()]) }}"
                                            class="btn btn-primary">
                                            <i class="mdi mdi-plus me-2"></i>
                                            {{ __('purchases_index.add_purchase') }}
                                        </a>
                                        <form method="GET"
                                            action="{{ route('purchases.print_filtered', ['lang' => app()->getLocale()]) }}"
                                            class="d-inline">
                                            <button type="submit" class="btn btn-secondary">
                                                <i class="mdi mdi-printer me-2"></i>
                                                Imprimer la sélection
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="filter-section">
                                    <form method="GET" action="{{ route('purchases.index', ['lang' => app()->getLocale()]) }}">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Du:</label>
                                                    <input type="date" class="form-control" name="date_from"
                                                        value="{{ request('date_from') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Au:</label>
                                                    <input type="date" class="form-control" name="date_to"
                                                        value="{{ request('date_to') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Statut:</label>
                                                    <select class="form-control" name="payment_status">
                                                        <option value="">Tous les statuts</option>
                                                        <option value="paid" @if (request('payment_status') === 'paid') selected @endif>Payé
                                                        </option>
                                                        <option value="partial" @if (request('payment_status') === 'partial') selected @endif>
                                                            Partiellement payé</option>
                                                        <option value="unpaid" @if (request('payment_status') === 'unpaid') selected @endif>Non
                                                            payé</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <button type="submit" class="btn btn-primary w-100">
                                                        <i class="mdi mdi-filter me-2"></i>
                                                        {{ __('purchases_index.filter') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('purchases_index.id') }}</th>
                                                <th>{{ __('purchases_index.fournisseur') }}</th>
                                                <th>{{ __('purchases_index.warehouse') }}</th>
                                                <th>{{ __('purchases_index.date') }}</th>
                                                <th>Statut</th>
                                                <th>Montant restant</th>
                                                <th>Réduction</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($purchasesPaginated as $purchase)
                                                <tr>
                                                    <td>{{ $purchase->id }}</td>
                                                    <td>{{ $purchase->fournisseur->name }}</td>
                                                    <td>{{ $purchase->warehouse->name }}</td>
                                                    <td>{{ $purchase->purchase_date }}</td>
                                                    <td>
                                                        <span class="status-badge status-{{ $purchase->payment_status }}">
                                                            {{ __('purchases_index.' . $purchase->payment_status) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $purchase->amount_to_pay - $purchase->payments->sum('amount') }}</td>
                                                    <td>{{ $purchase->reduction }}</td>
                                                    <td class="text-center">
                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="mdi mdi-dots-vertical"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('purchases.show', ['lang' => app()->getLocale(), 'purchase' => $purchase->id]) }}">
                                                                        <i class="mdi mdi-eye"></i>
                                                                        {{ __('purchases_index.show') }}
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('purchases.edit', ['lang' => app()->getLocale(), 'purchase' => $purchase->id]) }}">
                                                                        <i class="mdi mdi-pencil"></i>
                                                                        {{ __('purchases_index.edit') }}
                                                                    </a>
                                                                </li>
                                                                @if ($purchase->payment_status !== 'paid')
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('purchases.payment.form', ['lang' => app()->getLocale(), 'purchaseId' => $purchase->id]) }}">
                                                                            <i class="mdi mdi-cash-multiple"></i>
                                                                            {{ __('purchases_index.add_payment') }}
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('purchases.print', ['lang' => app()->getLocale(), 'purchase_id' => $purchase->id]) }}">
                                                                        <i class="mdi mdi-printer"></i>
                                                                        {{ __('purchases_index.print') }}
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <form action="{{ route('purchases.destroy', ['lang' => app()->getLocale(), 'purchase' => $purchase->id]) }}"
                                                                        method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="dropdown-item text-danger" 
                                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet achat?');">
                                                                            <i class="mdi mdi-delete"></i>
                                                                            Supprimer
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

                                <div class="mt-4">
                                    {{ $purchasesPaginated->links('pagination::bootstrap-5') }}
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

    <!-- Bootstrap 5 Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
