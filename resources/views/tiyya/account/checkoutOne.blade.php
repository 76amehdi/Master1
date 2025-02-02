<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('checkout.checkout_page')</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            overflow-y: scroll;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #fff;
            padding: 20px 0;
            border-bottom: 1px solid #ddd;
        }

        .header img {
            height: 50px;
        }

        .header .logo-container {
            flex: 1;
            display: flex;
            justify-content: end;
        }

        .header .cart-container {
            flex: 1;
            display: flex;
            justify-content: center;

        }

        .header a {
            display: inline-block;
        }

        .cart-container svg {
            width: 24px;
            height: 24px;
            fill: #333;
            cursor: pointer;
        }

        .container {
            display: flex;
            width: 100%;
            box-sizing: border-box;
            height: 100vh;
            margin-top: 0px;
        }

        
        .form-section {
            padding: 20px;
            flex: 60%;
            box-sizing: border-box;
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            margin-left: 60px;
        }

        .form-section::-webkit-scrollbar {
            display: none;
        }

        .cart-section {
            padding: 30px;
            flex: 50%;
            margin-left: 20px;
            background-color: #f4f9f4;
            box-sizing: border-box;
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .cart-section::-webkit-scrollbar {
            display: none;
        }

        h1 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;

        }

        input[type="radio"] {
            margin-right: 10px;
        }

        .cart-items {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .cart-items li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px;
        }

        .cart-items img {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
        }

        .cart-items span {
            font-size: 14px;
            color: #333;
        }

        .cart-summary {
            margin-top: 20px;
            padding: 10px 0;
            border-top: 1px solid #ccc;
        }

        .cart-summary span {
            display: flex;
            justify-content: space-between;
        }

        .cart-summary .total {
            font-weight: bold;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;

            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        .check-form {
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }

        .cart-centered {
            width: 460px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        .cart-items {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .cart-summary {
            margin-top: 15px;
        }

        @media screen and (max-width: 768px) {
            .container {
                flex-direction: column;
                height: auto;
            }

            .form-section,
            .cart-section {
                flex: none;
                width: 100%;
                margin: 0;
                padding: 15px;
                overflow: visible;
                border-radius: 0px !important;
            }

            .form-section {
                order: 2;
            }

            .cart-section {
                order: 1;
                background-color: #fff;
            }

            .cart-centered {
                width: 100%;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                padding: 10px 15px;
            }

            .header .logo-container,
            .header .cart-container {
                justify-content: flex-start;
            }

        }
    </style>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            overflow-y: scroll;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #fff;
            padding: 20px 0;
            border-bottom: 1px solid #ddd;
        }

        .header img {
            height: 50px;
        }

        .header .logo-container {
            flex: 1;
            display: flex;
            justify-content: end;
        }

        .header .cart-container {
            flex: 1;
            display: flex;
            justify-content: center;
        }

        .header a {
            display: inline-block;
        }

        .cart-container svg {
            width: 24px;
            height: 24px;
            fill: #333;
            cursor: pointer;
        }

        .container {
            display: flex;
            width: 100%;
            box-sizing: border-box;
            height: 100vh;
            margin-top: 0px;
        }

        .form-section {
            padding: 30px;
            flex: 60%;
            box-sizing: border-box;
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .form-section::-webkit-scrollbar {
            display: none;
        }

        .cart-section {
            padding: 30px;
            flex: 50%;
            margin-left: 20px;
            background-color: #f4f9f4;
            box-sizing: border-box;
        }

        .cart-centered {
            width: 460px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        /* Dropdown Style */
        .dropdown-btn {
            display: none;
            background: none;
            border: none;
            font-size: 18px;
            font-weight: bold;
            padding: 10px;
            cursor: pointer;
            margin-bottom: 10px;
            text-align: left;
            width: 100%;
            color: #333;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 0px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .dropdown-btn:hover {
            background-color: #f4f4f4;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .dropdown-btn:after {
            content: '\25BC';
            float: right;
            font-size: 12px;
            transition: transform 0.3s ease;
        }

        .dropdown-btn.active:after {
            transform: rotate(180deg);
        }

        .dropdown-content {
            display: none;
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 0px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .dropdown-btn.active+.dropdown-content {
            display: block;
        }

        .cart-summary {
            margin-top: 15px;
        }

        .cart-summary span {
            display: flex;
            justify-content: space-between;
        }

        .cart-summary .total {
            font-weight: bold;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        @media screen and (max-width: 768px) {
            .container {
                flex-direction: column;
                height: auto;
            }

            .form-section,
            .cart-section {
                flex: none;
                width: 100%;
                margin: 0;
                padding: 15px;
                overflow: visible;
            }

            .cart-centered {
                width: 80%;
                background-color: #f4f9f4;
            }

            .dropdown-content {
                background-color: #f4f9f4;
            }

            .form-section {
                order: 2;
            }

            .cart-section {
                order: 1;
                background-color: #fff;
            }

            .dropdown-btn {
                display: block;
            }
        }

        @media screen and (min-width: 1024px) {
            .dropdown-content {
                display: block;
                background-color: transparent !important;
                padding: 15px;
                border: none !important;
                box-shadow: none !important;
            }
        }
    </style>


</head>

<body>
    <div class="header">
        <div class="logo-container">
            <a href="{{ route('home', ['lang' => app()->getLocale()]) }}">
                <img src="https://cdn.shopify.com/s/files/1/0641/0842/9562/files/LOGO_Tiyya_HD_x320.png?v=1651754193"
                    alt="Logo" />
            </a>
        </div>
        <div class="cart-container">
            <a id="cart-link" aria-label="Panier" href="{{ route('cart', ['lang' => app()->getLocale()]) }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true">
                    <path
                        d="M2.675 10.037 3.072 4.2h7.856l.397 5.837A2.4 2.4 0 0 1 8.932 12.6H5.069a2.4 2.4 0 0 1-2.394-2.563">
                    </path>
                    <path d="M4.9 3.5a2.1 2.1 0 1 1 4.2 0v1.4a2.1 2.1 0 0 1-4.2 0z"></path>
                </svg>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="form-section">


            <form id="form-sec" action="{{ route('orders.create') }}" method="POST">
                @csrf
                @method('POST')
                <div style="max-width: 800px; margin: 40px auto; padding: 0 20px;">
                    <!-- Contact Section -->
                    <div style="margin-bottom: 40px;">
                        <div
                            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <h2 style="font-size: 20px; font-weight: bold;">@lang('checkout.contact')</h2>
                            @guest
                                <a href="/login"
                                    style="color: #ff4444; text-decoration: none; font-size: 14px;">@lang('checkout.open_session')</a>
                            @endguest
                            @auth
                                <a href="{{ route('user.logout') }}"
                                    style="color: #ff4444; text-decoration: none; font-size: 14px;">@lang('checkout.close_session')</a>
                            @endauth
                        </div>
                        @guest
                        <input type="text" name="contact_email_or_phone"
                            style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 16px; font-size: 14px;"
                            placeholder="@lang('checkout.email_or_mobile_number')">
                        @endguest
                        @auth
                            <input type="text" name="contact_email_or_phone"
                                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 16px; font-size: 14px;"
                                placeholder="@lang('checkout.email_or_mobile_number')" value="{{ Auth::user()->email }}">
                        @endauth
                        <label
                            style="display: flex; align-items: center; gap: 8px; font-size: 14px; margin-bottom: 8px;">
                            <input type="checkbox" name="contact_newsletter">
                            <span>@lang('checkout.send_me_news_and_offers_by_email')</span>
                        </label>
                    </div>

                    <!-- Delivery Section -->
                    <div style="margin-bottom: 40px;">
                        <h2 style="font-size: 20px; font-weight: bold;">@lang('checkout.delivery')</h2>
                        <div class="radio-card"
                            style="display: flex; align-items: center; padding: 16px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 8px; background-color: #fff1f1; border-color: #ff4444; color: #ff4444; cursor: pointer;">
                            <input type="radio" name="delivery" checked>
                            <span>@lang('checkout.ship')</span>
                        </div>
                        <div class="radio-card"
                            style="display: flex; align-items: center; padding: 16px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 8px; cursor: pointer;">
                            <input type="radio" name="delivery">
                            <span>@lang('checkout.pickup_in_store')</span>
                        </div>

                        <select name="delivery_country"
                            style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 16px; font-size: 14px;">
                            <option>@lang('checkout.country')</option>
                        </select>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 45px;">
                            <input type="text" name="delivery_firstname"
                                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 16px; font-size: 14px;"
                                placeholder="@lang('checkout.first_name')">
                            <input type="text" name="delivery_lastname"
                                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 16px; font-size: 14px;"
                                placeholder="@lang('checkout.last_name')">
                        </div>

                        <input type="text" name="delivery_company"
                            style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 16px; font-size: 14px;"
                            placeholder="@lang('checkout.company_optional')">
                        <input type="text" name="delivery_address"
                            style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 16px; font-size: 14px;"
                            placeholder="@lang('checkout.address')">
                        <input type="text" name="delivery_apartment"
                            style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 16px; font-size: 14px;"
                            placeholder="@lang('checkout.apartment_optional')">

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 45px;">
                            <input type="text" name="delivery_postcode"
                                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 16px; font-size: 14px;"
                                placeholder="@lang('checkout.postcode_optional')">
                            <input type="text" name="delivery_city"
                                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 16px; font-size: 14px;"
                                placeholder="@lang('checkout.city')">
                        </div>

                        <div style="display: flex; align-items: center; gap: 8px;">
                            <input type="tel" name="delivery_phone"
                                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 16px; font-size: 14px;"
                                placeholder="@lang('checkout.phone')">
                            <span
                                style="width: 20px; height: 20px; border-radius: 50%; border: 1px solid #ddd; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #666;">?</span>
                        </div>

                        <label
                            style="display: flex; align-items: center; gap: 8px; font-size: 14px; margin-bottom: 8px;">
                            <input type="checkbox" name="delivery_save_data">
                            <span>@lang('checkout.save_my_details_for_next_time')</span>
                        </label>
                        <label
                            style="display: flex; align-items: center; gap: 8px; font-size: 14px; margin-bottom: 8px;">
                            <input type="checkbox" name="delivery_sms_offers">
                            <span>@lang('checkout.send_me_news_and_offers_by_sms')</span>
                        </label>
                    </div>

                    <!-- Payment Section -->
                    <div style="margin-bottom: 40px;">
                        <h2 style="font-size: 20px; font-weight: bold;">@lang('checkout.payment_method')</h2>
                        <div class="radio-card"
                            style="display: flex; align-items: center; padding: 16px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 8px; cursor: pointer;">
                            <input type="radio" name="payment" value="Paiement-par-bankily">
                            <span>@lang('checkout.payment_by_bankily')</span>
                            <div style="display: flex; gap: 8px; margin-left: auto;">
                                <div style=" border-radius: 4px;">
                                    <img style="width: 40px" id="image-13-225" alt="Bankily banque mauritanie"
                                        src="https://www.bankily.mr/wp-content/uploads/2019/09/logo.png"
                                        class="ct-image lazyloaded"
                                        data-src="https://www.bankily.mr/wp-content/uploads/2019/09/logo.png"
                                        decoding="async" data-eio-rwidth="245" data-eio-rheight="150">
                                </div>


                            </div>
                        </div>
                        <div class="radio-card"
                            style="display: flex; align-items: center; padding: 16px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 8px; background-color: #fff1f1; border-color: #ff4444; color: #ff4444; cursor: pointer;">
                            <input type="radio" name="payment" value="Paiement-a-livraison">
                            <span>@lang('checkout.cash_on_delivery')</span>
                        </div>
                        <div
                            style="padding: 16px; background-color: #f8f8f8; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; color: #666;">
                            @lang('checkout.pay_in_cash_only_when_you_receive_your_order')
                        </div>
                    </div>

                    <!-- Billing Address Section -->
                    <div style="margin-bottom: 40px;">
                        <h2 style="font-size: 20px; font-weight: bold;">@lang('checkout.billing_address')</h2>
                        <div class="radio-card"
                            style="display: flex; align-items: center; padding: 16px; border: 1px solid #ddd; 
                            border-radius: 8px; margin-bottom: 8px; background-color: #fff1f1; 
                            border-color: #ff4444; color: #ff4444; cursor: pointer;">
                            <input type="radio" name="billing">
                            <span>@lang('checkout.same_as_delivery_address')</span>
                        </div>
                        <div class="radio-card"
                            style="display: flex; align-items: center; padding: 16px; 
                            border: 1px solid #ddd; border-radius: 8px; margin-bottom: 8px; cursor: pointer;">
                            <input type="radio" name="billing" checked>
                            <span>@lang('checkout.use_a_different_billing_address')</span>
                        </div>

                        <div class="billing-address-form" style="display: none; margin-top: 16px;">
                            <select name="billing_country"
                                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 16px; font-size: 14px;">
                                <option>@lang('checkout.country')</option>
                            </select>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 45px;">
                                <input type="text" name="billing_firstname"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 16px; font-size: 14px;"
                                    placeholder="@lang('checkout.first_name')">
                                <input type="text" name="billing_lastname"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 16px; font-size: 14px;"
                                    placeholder="@lang('checkout.last_name')">
                            </div>
                            <input type="text" name="billing_company"
                                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 16px; font-size: 14px;"
                                placeholder="@lang('checkout.company_optional')">
                            <input type="text" name="billing_address"
                                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 16px; font-size: 14px;"
                                placeholder="@lang('checkout.address')">
                            <input type="text" name="billing_apartment"
                                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 16px; font-size: 14px;"
                                placeholder="@lang('checkout.apartment_optional')">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 45px;">
                                <input type="text" name="billing_postcode"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 16px; font-size: 14px;"
                                    placeholder="@lang('checkout.postcode_optional')">
                                <input type="text" name="billing_city"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 16px; font-size: 14px;"
                                    placeholder="@lang('checkout.city')">
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <input type="tel" name="billing_phone"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 16px; font-size: 14px;"
                                    placeholder="@lang('checkout.phone_optional')">
                                <span
                                    style="width: 20px; height: 20px; border-radius: 50%; border: 1px solid #ddd; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #666;">?</span>
                            </div>
                        </div>
                    </div>

                    <button
                        style="width: 100%; padding: 16px; background-color: #000; color: #fff; border: none; border-radius: 8px; font-size: 16px; font-weight: 500; cursor: pointer; transition: background-color 0.2s;">@lang('checkout.submit_payment')</button>
                </div>
            </form>
            <script></script>



            <script>
                // Handle radio card selection
                document.querySelectorAll('.radio-card').forEach(card => {
                    card.addEventListener('click', function() {
                        const radio = this.querySelector('input[type="radio"]');
                        const name = radio.name;

                        // Unselect all cards in the same group
                        document.querySelectorAll(`input[name="${name}"]`).forEach(input => {
                            input.closest('.radio-card').classList.remove('selected');
                        });

                        // Select this card
                        this.classList.add('selected');
                        radio.checked = true;

                        // Handle billing address form visibility
                        if (name === 'billing') {
                            const billingForm = document.querySelector('.billing-address-form');
                            billingForm.style.display = radio.parentElement.textContent.includes('différente') ?
                                'block' : 'none';
                        }
                    });
                });

                // Initialize billing form visibility
                const billingForm = document.querySelector('.billing-address-form');
                const differentBillingRadio = document.querySelector('input[name="billing"]:not(:checked)');
                billingForm.style.display = differentBillingRadio ? 'block' : 'none';
            </script>


        </div>

        <div class="cart-section">
            <button class="dropdown-btn" id="dropdown-btn">@lang('checkout.order_summary')</button>
            <div class="dropdown-content" id="dropdown-content">
                <div class="cart-centered">
                    <style>
                        
                            
                        
                        .cart-items li {
                            padding-top: 50px; /* Adjust the value as needed */
                            padding-bottom: 20px;
                        }
                    </style>
                    <h1>@lang('checkout.your_cart')</h1>
                    <ul class="cart-items" id="cart-items-list">
                        <!-- Cart items will be populated here -->
                    </ul>
                    <div class="cart-summary">
                        <span style="padding-top: 50px;">@lang('checkout.subtotal') . (1 articles) <span id="subtotal">0,00
                                {{ $settings->currency }}</span></span>
                        <span style="padding-top: 50px;">@lang('checkout.shipping'): <span id="shipped">{{ $settings->normal_delivery_price }}
                                {{ $settings->currency }}</span></span>
                        <span style="padding-top: 50px;" class="total">@lang('checkout.total'): <span id="total">0,00
                                {{ $settings->currency }}</span></span>
                        <span style="padding-top: 50px;">@lang('checkout.taxes_including') <span id="taxes"> </span>
                            incluse</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownBtn = document.getElementById('dropdown-btn');
            const dropdownContent = document.getElementById('dropdown-content');

            dropdownBtn.addEventListener('click', function() {
                dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' :
                    'block';
                dropdownBtn.classList.toggle('active');
            });
            // Get the oneProduct from local storage
            const oneProductString = localStorage.getItem('oneProduct');
            const cartItemsList = document.getElementById('cart-items-list');
            const form = document.getElementById('form-sec');
            let subtotal = 0;
            let total = 0;

            let delivery_price = {{ $settings->normal_delivery_price }};
            let productsArray = []; // Array to hold product data

            if (oneProductString) {
                const oneProduct = JSON.parse(oneProductString);

                // Create a cart item from the oneProduct

                const cartItem = {
                    title: oneProduct.name,
                    price: parseFloat(oneProduct.price), // Ensure price is a number
                    image: oneProduct.image,
                    unit: oneProduct.unit,
                    id: oneProduct.id,

                };
                const productString =
                `{${cartItem.id},${cartItem.title},${cartItem.price},1,10}`; // Format as string
                productsArray.push(productString)

                const li = document.createElement('li');

                const img = document.createElement('img');
                img.src = `{{ asset('') }}${cartItem.image}`;
                img.alt = cartItem.title;
                li.appendChild(img);

                const textSpan = document.createElement('span');
                textSpan.textContent =
                `${cartItem.title} - ${cartItem.price.toFixed(2)} {{ $settings->currency }}`;
                li.appendChild(textSpan)
                cartItemsList.appendChild(li);
                subtotal = cartItem.price;

                if (subtotal < {{ $settings->free_delivery_threshold }}) {
                    total = subtotal + delivery_price;
                }else{
                    total = subtotal;
                }

            }

            // Create a hidden input for products array
            const productsInput = document.createElement('input');
            productsInput.type = 'hidden';
            productsInput.name = 'products';
            productsInput.value = productsArray;

            // Append the input to the form
            form.appendChild(productsInput);




            document.getElementById('subtotal').textContent = `${subtotal.toFixed(2)} {{ $settings->currency }}`;
            document.getElementById('total').textContent = `${total.toFixed(2)} {{ $settings->currency }}`;
            document.getElementById('shipped').textContent =
                `{{ $settings->normal_delivery_price }} {{ $settings->currency }}`;
            if (subtotal < {{ $settings->free_delivery_threshold }}) {
                document.getElementById('shipped').textContent =
                    `{{ $settings->normal_delivery_price }} {{ $settings->currency }}`;
            } else {
                document.getElementById('shipped').textContent = `0,00 {{ $settings->currency }}`;
            }

        });
    </script>

</body>

</html>
