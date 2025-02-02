<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ __('purchases.page_title') }}</title>
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
                        <h2 class="mb-4">{{ __('purchases.create_purchase') }}</h2>

                        <form action="{{ route('purchases.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="purchase_date">{{ __('purchases.purchase_date') }}</label>
                                        <input type="date" id="purchase_date" name="purchase_date" class="form-control"
                                            value="{{ old('purchase_date', date('Y-m-d')) }}">
                                        @error('purchase_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fournisseur_id">{{ __('purchases.fournisseur') }}</label>
                                        <select name="fournisseur_id" id="fournisseur_id" class="form-control" required>
                                            <option value="">Sélectionner un fournisseur</option>
                                            @foreach ($fournisseurs as $fournisseur)
                                                <option value="{{ $fournisseur->id }}" {{ old('fournisseur_id') == $fournisseur->id ? 'selected' : '' }}>
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
                                        <label for="warehouse_id">{{ __('purchases.warehouse') }}</label>
                                        <select name="warehouse_id" id="warehouse_id" class="form-control" required>
                                            <option value="">Sélectionner un entrepôt</option>
                                            @foreach ($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}" {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
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
                                    <h4 class="card-title mb-4">{{ __('purchases.product') }}</h4>
                                    
                                    <div class="form-group">
                                        <label for="product_id">{{ __('purchases.search_product') }}</label>
                                        <div class="custom-select-container">
                                            <input type="text" id="product_search" class="form-control mb-2"
                                                placeholder="{{ __('purchases.search_product') }}...">
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
                                                    <th>{{ __('purchases.product_table_header.product') }}</th>
                                                    <th>{{ __('purchases.product_table_header.image') }}</th>
                                                    <th>{{ __('purchases.product_table_header.quantity_in_stock') }}</th>
                                                    <th>{{ __('purchases.product_table_header.quantity_to_buy') }}</th>
                                                    <th>{{ __('purchases.product_table_header.unit_price') }}</th>
                                                    <th>{{ __('purchases.product_table_header.action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Selected products will be added here -->
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
                                        <label for="reduction_type">{{ __('purchases.reduction_type') }}</label>
                                        <select name="reduction_type" id="reduction_type" class="form-control">
                                            <option value="fixed">{{ __('purchases.fixed_amount') }}</option>
                                            <option value="percentage">{{ __('purchases.percentage') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="reduction">{{ __('purchases.reduction') }}</label>
                                        <input type="number" id="reduction" name="reduction" class="form-control"
                                            step="0.01" min="0" value="{{ old('reduction', '0.00') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="amount_due">Total de l'achat</label>
                                        <input type="text" name="amount_to_pay" id="amount_due" class="form-control"
                                            value="0.00" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-content-save me-1"></i>
                                    {{ __('purchases.save_purchase') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- main-panel ends -->

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('product_search');
            const productSelect = document.getElementById('product_id');
            const productImage = document.getElementById('product-image');
            const productTable = document.getElementById('product-table').getElementsByTagName('tbody')[0];
            const hiddenInputsContainer = document.getElementById('hidden-product-inputs');

            let productIndex = 0; // Index to create unique keys
            let productsData = {}; // Store products by unique key

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

            // Fetch product details on selection
            productSelect.addEventListener('change', function() {
                const productId = productSelect.value;

                if (!productId) {
                    productImage.style.display = 'none';
                    return;
                }

                // Get selected product details
                const selectedOption = productSelect.options[productSelect.selectedIndex];
                const productTitle = selectedOption.getAttribute('data-title');
                const productImageSrc = selectedOption.getAttribute('data-image');
                const productQty = selectedOption.getAttribute('data-qty');
                const units = JSON.parse(selectedOption.getAttribute('data-units'));

                // Increment index for unique key
                const uniqueKey = `product_${productId}_${productIndex++}`;

                // Create a dropdown for selecting the unit and price
                let unitOptions = units.map(unit => {
                    return `<option value="${unit.id}" data-price="${unit.price}">${unit.unit} - $${unit.price}</option>`;
                }).join('');

                const unitSelectHTML = `
            <select class="form-control">
                ${unitOptions}
            </select>
        `;

                // Display product image and details in the table
                const newRow = productTable.insertRow();
                const cell1 = newRow.insertCell(0);
                const cell2 = newRow.insertCell(1);
                const cell3 = newRow.insertCell(2);
                const cell4 = newRow.insertCell(3);
                const cell5 = newRow.insertCell(4);
                const cell6 = newRow.insertCell(5);

                cell1.textContent = productTitle;
                cell2.innerHTML =
                    `<img src="{{ asset('') }}${productImageSrc}" alt="${productTitle}" style="max-width: 100px;">`;
                cell3.textContent = productQty;

                // New column for quantity input
                cell4.innerHTML = `<input type="number" class="form-control" value="1" min="1">`;

                cell5.innerHTML = unitSelectHTML;
                cell6.innerHTML = `<button class="btn btn-danger btn-sm remove-product">Remove</button>`;

                // Clear the selection and hide the image
                productSelect.value = '';
                productImage.style.display = 'none';

                // Add event listener to the "Remove" button
                const removeButton = newRow.querySelector('.remove-product');
                removeButton.addEventListener('click', function() {
                    productTable.deleteRow(newRow.rowIndex - 1); // Remove the row
                    delete productsData[uniqueKey]; // Remove the product data
                    updateHiddenInputs(); // Rebuild the hidden inputs
                    calculateAmountToPay(); // Recalculate the total
                });

                // Add event listener to the quantity input
                const qtyInput = newRow.querySelector('input[type="number"]');
                const unitSelect = newRow.querySelector('select');
                qtyInput.addEventListener('input', updateProductData);
                unitSelect.addEventListener('change', updateProductData);

                function updateProductData() {
                    const updatedQty = qtyInput.value;
                    const selectedUnitId = unitSelect.value;
                    const selectedUnitPrice = unitSelect.selectedOptions[0].getAttribute('data-price');

                    // Update or add the product in productsData
                    productsData[uniqueKey] = {
                        product_id: productId,
                        unit_id: selectedUnitId,
                        achat_quantity: updatedQty,
                        unit_price: selectedUnitPrice
                    };

                    // Rebuild the hidden inputs and recalculate total
                    updateHiddenInputs();
                    calculateAmountToPay();
                }

                // Initialize the product data
                updateProductData();
            });

            // Function to update hidden input fields
            function updateHiddenInputs() {
                hiddenInputsContainer.innerHTML = ''; // Clear previous hidden inputs
                Object.values(productsData).forEach(productObject => {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'products[]';
                    hiddenInput.value = JSON.stringify(productObject);
                    hiddenInputsContainer.appendChild(hiddenInput);
                });
            }

            // Function to calculate the total amount to pay
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
