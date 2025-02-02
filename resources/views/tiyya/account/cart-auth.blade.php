@extends('tiyya.index')
@section('content')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My cart</title>
</head>
<div class="main-container" style="display: flex; flex-wrap: wrap;">
    <!-- Product Display Section -->
    <div class="product-display-section" style="width: 60%; padding: 20px;">
        <div class="product-list">
            @foreach ($cart as $item)
                <div class="product-card"
                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; padding: 10px 0;"
                    data-id="{{ $item->id }}" data-unit="{{ $item->unit }}">
                    <div style="flex: 1; display: flex; align-items: center;">
                        <img src="{{ asset( $item->image) }}"
                            alt="{{ $item->product_title ?? $item->name }}"
                            style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                        <div>
                            <h5>{{ $item->product_title ?? $item->name }}</h5>
                            <p>{{ $item->unit }}</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <button class="decrement-btn" data-id="{{ $item->id }}" data-unit="{{ $item->unit }}">−</button>
                        <input type="number" value="{{ $item->quantity }}" class="quantity-field"
                            data-id="{{ $item->id }}" data-unit="{{ $item->unit }}"
                            style="width: 50px; text-align: center; margin: 0 5px;">
                        <button class="increment-btn" data-id="{{ $item->id }}" data-unit="{{ $item->unit }}">+</button>
                    </div>
                    <p style="margin-left: 10px;">{{ $item->price * $item->quantity }} dh</p>
                    <button class="remove-btn" data-id="{{ $item->id }}" data-unit="{{ $item->unit }}">Retirer</button>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Payment Section -->
    <div class="payment-summary-section" style="width: 40%; padding: 20px; text-align: center;">
        <div class="cart-summary">
            <div class="cart-totals">
                <p class="total-amount">
                    Total: <span data-subtotal="{{ $cart->sum(fn($item) => $item->price * $item->quantity) }}">
                        {{ number_format($cart->sum(fn($item) => $item->price * $item->quantity), 2) }} dh
                    </span>
                </p>
            </div>
            <div class="checkout-btn-wrapper">
                <a href="{{ route('checkoutt') }}">
                    <button type="button" name="checkout" class="checkout-btn">
                        Procéder au paiement
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const subtotalElement = document.querySelector('[data-subtotal]');
        const productCards = document.querySelectorAll('.product-card');

        // Function to update the subtotal
        function updateSubtotal() {
            let total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            subtotalElement.textContent = total.toFixed(2) + " dh";
        }

        // Event listeners for increment, decrement, and remove buttons
        productCards.forEach(card => {
            const id = card.dataset.id;
            const unit = card.dataset.unit;

            const decrementBtn = card.querySelector('.decrement-btn');
            const incrementBtn = card.querySelector('.increment-btn');
            const quantityField = card.querySelector('.quantity-field');
            const removeBtn = card.querySelector('.remove-btn');

            // Decrement quantity
            decrementBtn.addEventListener('click', function() {
                let item = cart.find(i => i.id == id && i.unit == unit);
                if (item && item.quantity > 1) {
                    item.quantity--;
                    updateCart(item);
                } else {
                    removeFromCart(id, unit);
                }
            });

            // Increment quantity
            incrementBtn.addEventListener('click', function() {
                let item = cart.find(i => i.id == id && i.unit == unit);
                if (item) {
                    item.quantity++;
                    updateCart(item);
                }
            });

            // Quantity field change
            quantityField.addEventListener('change', function() {
                let newQuantity = parseInt(quantityField.value);
                if (newQuantity > 0) {
                    let item = cart.find(i => i.id == id && i.unit == unit);
                    if (item) {
                        item.quantity = newQuantity;
                        updateCart(item);
                    }
                } else {
                    removeFromCart(id, unit);
                }
            });

            // Remove button
            removeBtn.addEventListener('click', function() {
                removeFromCart(id, unit);
            });
        });

        // Update cart in database and localStorage
        function updateCart(item) {
            // Save to database
            fetch(`/add-to-cart/${item.id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(item)
            }).then(response => {
                if (response.ok) {
                    console.log("Item updated in database.");
                } else {
                    console.error("Failed to update item in database.");
                }
            });

            // Update localStorage
            localStorage.setItem('cart', JSON.stringify(cart));
            updateSubtotal();
        }

        // Remove from cart
        function removeFromCart(id, unit) {
            let index = cart.findIndex(i => i.id == id && i.unit == unit);
            if (index > -1) {
                cart.splice(index, 1);
                localStorage.setItem('cart', JSON.stringify(cart));
                document.querySelector(`.product-card[data-id="${id}"][data-unit="${unit}"]`).remove();
                updateSubtotal();
            }
        }

        // Initial subtotal update
        updateSubtotal();
    });
</script>
@endsection
