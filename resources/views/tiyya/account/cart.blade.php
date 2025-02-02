@extends('tiyya.index')
@section('content')
<style>
    .product-item{
        border: none !important;
    }
</style>
<head><title>
    cart
</title></head>
<div class="container" style="display: flex; flex-wrap: wrap;">
    <!-- Product Display Section -->
    <div class="product-display" style="width: 60%; padding: 20px;">
        <div class="product-container" id="cart-items">
            <!-- Cart items will be rendered here -->
        </div>
    </div>

    <!-- Payment Section -->
    <div class="payment-section" style="width: 40%; padding: 20px; text-align: center;">
        <div class="cart__summary">
            <div class="cart__totals">
                <p class="cart__total">
                    @lang('cart.total'): <span id="cart-total">0.00 {{$settings->currency}} </span>
                </p>
            </div>
            <div class="cart__checkout-wrapper">
                <a href="{{ route('checkoutt',['lang' => app()->getLocale()]) }}">
                    <button type="button" name="checkout" class="btn btn-primary">
                       @lang('cart.proceed_to_checkout')
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
class CartManager {
    constructor() {
        this.cartContainer = document.getElementById('cart-items');
        this.totalElement = document.getElementById('cart-total');
        this.isAuthenticated = @json(Auth::check());
        this.initializeCart();
    }

    initializeCart() {
        let cartItems = this.getCartFromStorage();
        
        if (this.isAuthenticated && !cartItems.length && @json(isset($cart))) {
            cartItems = @json($cart ?? []);
            this.saveCartToStorage(cartItems);
        }

        this.renderCart(cartItems);
        this.updateTotal(cartItems);
    }

    getCartFromStorage() {
        try {
            const cartData = localStorage.getItem('cart');
            if (!cartData) return [];
            
            let parsed = JSON.parse(cartData);
            if (typeof parsed === 'string') {
                parsed = JSON.parse(parsed);
            }
            return Array.isArray(parsed) ? parsed : [];
        } catch (e) {
            console.error('Error parsing cart:', e);
            return [];
        }
    }

    saveCartToStorage(cart) {
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    renderCart(cartItems) {
        this.cartContainer.innerHTML = '';

        cartItems.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.className = 'product-item';
            itemElement.style.cssText = 'display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;  padding: 10px 0;';
            
            // Ensure we're using the correct product_id property
            const productId = item.product_id || item.id;
            
            itemElement.innerHTML = `
                <div style="flex: 1;">
                    <img src="/storage/${item.image}" 
                         alt="${item.product_title}" 
                         style="width: 50px; height: 50px; object-fit: cover;">
                    <div>
                        <h5>${item.product_title}</h5>
                        <p>${item.unit}</p>
                    </div>
                </div>
                <div style="display: flex; align-items: center;">
                    <button class="btn btn-light btn-sm quantity-minus" data-product-id="${productId}">−</button>
                    <input type="number" 
                           value="${item.quantity}" 
                           class="quantity-input" 
                           data-product-id="${productId}"
                           style="width: 50px; text-align: center; margin: 0 5px;">
                    <button class="btn btn-light btn-sm quantity-plus" data-product-id="${productId}">+</button>
                </div>
                <p>${item.price} {{$settings->currency}} </p>
                <button class="btn btn-danger btn-sm remove-item" data-product-id="${productId}">@lang('cart.remove_item')</button>
            `;

            // Add event listeners
            const quantityInput = itemElement.querySelector('.quantity-input');
            const plusBtn = itemElement.querySelector('.quantity-plus');
            const minusBtn = itemElement.querySelector('.quantity-minus');
            const removeBtn = itemElement.querySelector('.remove-item');

            plusBtn.onclick = () => this.updateQuantity(productId, item.unit, 1);
            minusBtn.onclick = () => this.updateQuantity(productId, item.unit, -1);
            quantityInput.onchange = (e) => this.setQuantity(productId, item.unit, parseInt(e.target.value));
            removeBtn.onclick = () => this.removeItem(productId, item.unit);

            this.cartContainer.appendChild(itemElement);
        });
    }

    updateQuantity(productId, unit, change) {
        const cartItems = this.getCartFromStorage();
        const cartItem = cartItems.find(i => 
            (i.product_id === productId || i.id === productId) && i.unit === unit
        );

        if (cartItem) {
            cartItem.quantity = Math.max(1, parseInt(cartItem.quantity) + change);
            // Ensure product_id is set correctly
            cartItem.product_id = productId;
            this.saveCartToStorage(cartItems);
            this.renderCart(cartItems);
            this.updateTotal(cartItems);
            this.syncWithServer(cartItems);
        }
    }

    setQuantity(productId, unit, newQuantity) {
        const cartItems = this.getCartFromStorage();
        const cartItem = cartItems.find(i => 
            (i.product_id === productId || i.id === productId) && i.unit === unit
        );

        if (cartItem) {
            cartItem.quantity = Math.max(1, newQuantity);
            // Ensure product_id is set correctly
            cartItem.product_id = productId;
            this.saveCartToStorage(cartItems);
            this.renderCart(cartItems);
            this.updateTotal(cartItems);
            this.syncWithServer(cartItems);
        }
    }

    removeItem(productId, unit) {
        const cartItems = this.getCartFromStorage();
        const updatedCart = cartItems.filter(i => 
            !((i.product_id === productId || i.id === productId) && i.unit === unit)
        );
        
        this.saveCartToStorage(updatedCart);
        this.renderCart(updatedCart);
        this.updateTotal(updatedCart);
        this.syncWithServer(updatedCart);
    }

    updateTotal(cartItems) {
        const total = cartItems.reduce((sum, item) => {
            return sum + (parseFloat(item.price) || 0);
        }, 0);
        this.totalElement.textContent = total.toFixed(2) + ' {{$settings->currency}} ';
    }

    async syncWithServer(cartItems) {
        if (!this.isAuthenticated) return;

        try {
            const response = await fetch('/add-to-cart/sync', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ 
                    items: cartItems.map(item => ({
                        ...item,
                        product_id: item.product_id || item.id // Ensure product_id is always set
                    }))
                })
            });
            
            if (!response.ok) {
                console.error('Error syncing cart with server');
            }
        } catch (error) {
            console.error('Error syncing cart:', error);
        }
    }
}

// Initialize cart manager when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new CartManager();
});
</script>
@endsection