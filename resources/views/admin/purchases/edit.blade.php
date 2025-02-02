<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Modifier l'achat</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/admin/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Layout styles -->
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
        .card {
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
        }
        .card-body {
            padding: 25px;
        }
        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            color: #495057;
            font-weight: 600;
        }
        .text-danger {
            margin-top: 5px;
            display: block;
            font-size: 0.875em;
        }
        .img-thumbnail {
            border-radius: 5px;
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
                    <div class="custom-container">
                        <h2 class="mb-4">Modifier l'achat #{{ $purchase->id }}</h2>

                        <form action="{{ route('purchases.update', ['lang' => app()->getLocale(), 'purchase' => $purchase->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="purchase_date">Date d'achat</label>
                                        <input type="date" id="purchase_date" name="purchase_date" class="form-control"
                                            value="{{ old('purchase_date', $purchase->purchase_date) }}">
                                        @error('purchase_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fournisseur_id">Fournisseur</label>
                                        <select name="fournisseur_id" id="fournisseur_id" class="form-control" required>
                                            <option value="">Sélectionner un fournisseur</option>
                                            @foreach ($fournisseurs as $fournisseur)
                                                <option value="{{ $fournisseur->id }}" {{ old('fournisseur_id', $purchase->fournisseur_id) == $fournisseur->id ? 'selected' : '' }}>
                                                    {{ $fournisseur->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('fournisseur_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="warehouse_id">Entrepôt</label>
                                        <select name="warehouse_id" id="warehouse_id" class="form-control" required>
                                            <option value="">Sélectionner un entrepôt</option>
                                            @foreach ($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}" {{ old('warehouse_id', $purchase->warehouse_id) == $warehouse->id ? 'selected' : '' }}>
                                                    {{ $warehouse->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('warehouse_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-4">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Produits</h4>
                                    
                                    <div class="form-group">
                                        <label for="product_id">Rechercher un produit</label>
                                        <div class="custom-select-container">
                                            <input type="text" id="product_search" class="form-control mb-2"
                                                placeholder="Rechercher un produit...">
                                            <select name="product_id" id="product_id" class="form-control" size="5">
                                                <option value="">Sélectionner un produit</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" data-title="{{ $product->title }}"
                                                        data-image="{{ $product->images()->first()->image_path??'' }}"
                                                        data-qty="{{ $product->qty }}"
                                                        data-units="{{ json_encode($product->units) }}"
                                                        style="{{ $product->qty < 10 ? 'color: red;' : '' }}">
                                                        {{ $product->id }} {{ $product->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div id="product-details" class="mt-3">
                                        <img id="product-image" src="" alt="" class="img-thumbnail"
                                            style="max-width: 300px; display: none;" />
                                    </div>

                                    <div class="table-responsive mt-4">
                                        <table class="table" id="product-table">
                                            <thead>
                                                <tr>
                                                    <th>Produit</th>
                                                    <th>Image</th>
                                                    <th>Stock actuel</th>
                                                    <th>Quantité à acheter</th>
                                                    <th>Prix unitaire</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($purchase->purchasedetail as $detail)
                                                    <tr data-product-id="{{ $detail->product_id }}">
                                                        <td>{{ $detail->product->title }}</td>
                                                        <td>
                                                            <img src="{{ asset($detail->product->images()->first()->image_path ?? '') }}" 
                                                                alt="{{ $detail->product->title }}" style="max-width: 100px;">
                                                        </td>
                                                        <td>{{ $detail->product->qty }}</td>
                                                        <td>
                                                            <input type="number" class="form-control quantity-input" 
                                                                value="{{ $detail->quantity }}" min="1">
                                                        </td>
                                                        <td>
                                                            <select class="form-control unit-select">
                                                                @foreach($detail->product->units as $unit)
                                                                    <option value="{{ $unit->id }}" 
                                                                        data-price="{{ $unit->price }}"
                                                                        {{ $detail->product_unit_id == $unit->id ? 'selected' : '' }}>
                                                                        {{ $unit->unit }} - {{ $unit->price }} DH
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-sm remove-product">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden inputs will be appended here when a product is selected -->
                            <div id="hidden-product-inputs"></div>

                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="reduction_type">Type de réduction</label>
                                        <select name="reduction_type" id="reduction_type" class="form-control">
                                            <option value="fixed" {{ $purchase->reduction_type == 'fixed' ? 'selected' : '' }}>Montant fixe</option>
                                            <option value="percentage" {{ $purchase->reduction_type == 'percentage' ? 'selected' : '' }}>Pourcentage</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="reduction">Réduction</label>
                                        <input type="number" id="reduction" name="reduction" class="form-control"
                                            step="0.01" min="0" value="{{ old('reduction', $purchase->reduction) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="amount_due">Total de l'achat</label>
                                        <input type="text" name="amount_to_pay" id="amount_due" class="form-control"
                                            value="{{ $purchase->amount_to_pay }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-content-save me-1"></i>
                                    Enregistrer les modifications
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('product_search');
            const productSelect = document.getElementById('product_id');
            const productImage = document.getElementById('product-image');
            const productTable = document.getElementById('product-table').getElementsByTagName('tbody')[0];
            const hiddenInputsContainer = document.getElementById('hidden-product-inputs');

            let productIndex = {{ count($purchase->purchasedetail) }}; // Start from existing products count
            let productsData = {}; // Store products by unique key

            function updateHiddenInputs() {
                hiddenInputsContainer.innerHTML = '';
                Object.entries(productsData).forEach(([uniqueKey, productObject]) => {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'products[]';
                    hiddenInput.value = JSON.stringify({
                        product_id: productObject.product_id,
                        unit_id: productObject.unit_id,
                        achat_quantity: productObject.achat_quantity,
                        unit_price: productObject.unit_price
                    });
                    hiddenInputsContainer.appendChild(hiddenInput);
                });
            }

            // Initialize existing products
            document.querySelectorAll('#product-table tbody tr').forEach((row, index) => {
                const productId = row.getAttribute('data-product-id');
                if (productId) {
                    const uniqueKey = `product_${productId}_${index}`;
                    const quantityInput = row.querySelector('.quantity-input');
                    const unitSelect = row.querySelector('.unit-select');
                    
                    productsData[uniqueKey] = {
                        product_id: productId,
                        unit_id: unitSelect.value,
                        achat_quantity: quantityInput.value,
                        unit_price: unitSelect.selectedOptions[0].getAttribute('data-price')
                    };

                    addRowEventListeners(row, uniqueKey);
                }
            });

            // Initial update of hidden inputs and total
            updateHiddenInputs();
            calculateAmountToPay();

            // Filter options in the select dropdown
            searchInput.addEventListener('input', function() {
                const searchValue = searchInput.value.toLowerCase();
                Array.from(productSelect.options).forEach(option => {
                    if (option.text.toLowerCase().includes(searchValue)) {
                        option.style.display = '';
                    } else {
                        option.style.display = 'none';
                    }
                });
            });

            // Add new product
            productSelect.addEventListener('change', function() {
                const productId = productSelect.value;
                if (!productId) return;

                const selectedOption = productSelect.options[productSelect.selectedIndex];
                const productTitle = selectedOption.getAttribute('data-title');
                const productImageSrc = selectedOption.getAttribute('data-image');
                const productQty = selectedOption.getAttribute('data-qty');
                const units = JSON.parse(selectedOption.getAttribute('data-units'));

                const uniqueKey = `product_${productId}_${productIndex++}`;

                // Create new row
                const newRow = productTable.insertRow();
                newRow.setAttribute('data-product-id', productId);
                
                // Add cells
                newRow.innerHTML = `
                    <td>${productTitle}</td>
                    <td><img src="${productImageSrc}" alt="${productTitle}" style="max-width: 100px;"></td>
                    <td>${productQty}</td>
                    <td><input type="number" class="form-control quantity-input" value="1" min="1"></td>
                    <td>
                        <select class="form-control unit-select">
                            ${units.map(unit => `
                                <option value="${unit.id}" data-price="${unit.price}">
                                    ${unit.unit} - ${unit.price} DH
                                </option>
                            `).join('')}
                        </select>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-product">
                            <i class="mdi mdi-delete"></i>
                        </button>
                    </td>
                `;

                // Add event listeners
                addRowEventListeners(newRow, uniqueKey);

                // Clear selection
                productSelect.value = '';
            });

            function addRowEventListeners(row, uniqueKey) {
                const quantityInput = row.querySelector('.quantity-input');
                const unitSelect = row.querySelector('.unit-select');
                const removeButton = row.querySelector('.remove-product');

                quantityInput.addEventListener('input', () => updateProductData(uniqueKey, quantityInput, unitSelect));
                unitSelect.addEventListener('change', () => updateProductData(uniqueKey, quantityInput, unitSelect));
                
                removeButton.addEventListener('click', function() {
                    row.remove();
                    delete productsData[uniqueKey];
                    updateHiddenInputs();
                    calculateAmountToPay();
                });

                // Initial update
                updateProductData(uniqueKey, quantityInput, unitSelect);
            }

            function updateProductData(uniqueKey, quantityInput, unitSelect) {
                const productId = quantityInput.closest('tr').getAttribute('data-product-id');
                const quantity = quantityInput.value;
                const unitId = unitSelect.value;
                const unitPrice = unitSelect.selectedOptions[0].getAttribute('data-price');

                productsData[uniqueKey] = {
                    product_id: productId,
                    unit_id: unitId,
                    achat_quantity: quantity,
                    unit_price: unitPrice
                };

                updateHiddenInputs();
                calculateAmountToPay();
            }

            function calculateAmountToPay() {
                let totalAmount = 0;
                Object.values(productsData).forEach(product => {
                    totalAmount += parseFloat(product.achat_quantity) * parseFloat(product.unit_price);
                });

                const reduction = parseFloat(document.getElementById('reduction').value) || 0;
                const reductionType = document.getElementById('reduction_type').value;

                if (reductionType === 'percentage') {
                    totalAmount -= totalAmount * (reduction / 100);
                } else {
                    totalAmount -= reduction;
                }

                document.getElementById('amount_due').value = totalAmount.toFixed(2);
            }

            // Add event listeners for reduction inputs
            document.getElementById('reduction').addEventListener('input', calculateAmountToPay);
            document.getElementById('reduction_type').addEventListener('change', calculateAmountToPay);
        });
    </script>
</body>

</html>
