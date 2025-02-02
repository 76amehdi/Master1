<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ajouter un paiement</title>
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet">
    <!-- plugins:css -->
    <link rel="stylesheet" href="/admin/assets/vendors/css/vendor.bundle.base.css">
    <!-- inject:css -->
    <link rel="stylesheet" href="/admin/assets/css/style.css">
    <style>
        .custom-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 8px 12px;
        }
        .form-control:focus {
            border-color: #4B49AC;
            box-shadow: 0 0 0 0.2rem rgba(75, 73, 172, 0.25);
        }
        select.form-control {
            padding-right: 30px;
            background-position: right 10px center;
        }
        .btn-primary {
            background-color: #4B49AC;
            border-color: #4B49AC;
            padding: 10px 20px;
        }
        .btn-primary:hover {
            background-color: #3f3e91;
            border-color: #3f3e91;
        }
        .alert {
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .text-danger {
            margin-top: 5px;
            display: block;
            font-size: 0.875em;
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
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="custom-container">
                        <h2 class="mb-4">Ajouter un paiement - Achat #{{ $purchase->id }}</h2>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Montant total:</strong> {{ number_format($purchase->amount_to_pay, 2) }} DH</p>
                                <p class="mb-0"><strong>Montant restant:</strong> {{ number_format($remainingAmount, 2) }} DH</p>
                            </div>
                        </div>

                        <form action="{{ route('purchases.payment.store', $purchase->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment_date">Date de paiement</label>
                                        <input type="date" name="payment_date" id="payment_date" class="form-control"
                                            value="{{ old('payment_date', date('Y-m-d')) }}">
                                        @error('payment_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="amount">Montant</label>
                                        <input type="number" name="amount" id="amount" class="form-control"
                                            value="{{ old('amount') ?: $remainingAmount }}" required step="0.01" min="0">
                                        @error('amount')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment_method">Méthode de paiement</label>
                                        <select name="payment_method" id="payment_method" class="form-control" required>
                                            <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>
                                                <i class="mdi mdi-cash"></i> Espèces
                                            </option>
                                            <option value="credit" {{ old('payment_method') == 'credit' ? 'selected' : '' }}>
                                                <i class="mdi mdi-credit-card"></i> Carte bancaire
                                            </option>
                                            <option value="check" {{ old('payment_method') == 'check' ? 'selected' : '' }}>
                                                <span class="mdi mdi-check-circle"></span> Chèque
                                            </option>
                                        </select>
                                        @error('payment_method')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="transaction_reference">Référence de transaction</label>
                                        <input type="text" name="transaction_reference" id="transaction_reference"
                                            class="form-control" value="{{ old('transaction_reference') }}"
                                            placeholder="Ex: Numéro de chèque, référence de transaction...">
                                        @error('transaction_reference')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-check-circle mr-1"></i>
                                    Enregistrer le paiement
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="/admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="/admin/assets/js/off-canvas.js"></script>
    <script src="/admin/assets/js/hoverable-collapse.js"></script>
    <script src="/admin/assets/js/misc.js"></script>
</body>

</html>