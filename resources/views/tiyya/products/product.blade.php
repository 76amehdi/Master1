@extends('tiyya.index')
@section('content')
    <div>
        <div id="shop-section-template--15972022124794__main" class="shop-section">
            <div id="ProductSection-template--15972022124794__main-8663781474554" class="product-section"
                data-section-id="template--15972022124794__main" data-product-id="8663781474554" data-section-type="product"
                data-product-handle="mini-evasions-florales-kit-4-huiles-seches-miniatures"
                data-product-title="Évasion en Quatre Parfums"
                data-product-url="/collections/accessoires/products/mini-evasions-florales-kit-4-huiles-seches-miniatures"
                data-aspect-ratio="133.33333333333334"
                data-img-url="../../../cdn/shop/files/pack4huilesmodifie_%7bwidth%7dx368e.html?v=1731455235"
                data-history="true" data-modal="false">

                <div class="page-content page-content--product">
                    <div class="page-width">

                        <div class="grid grid--product-images--partial">
                            <style>
                            
                            .text1{
                                text-transform: uppercase;
                                font-family: 'Tenor Sans';
                                font-size: 27px;
                            }
                                .container-product {
                                    max-width: 1200px;
                                    margin: 40px auto;
                                    display: flex;
                                    flex-direction: row;
                                    position: relative;
                                }

                                .product-image-section {
                                    width: 65%;
                                    position: relative;
                                }

                                .image-images {
                                    display: flex;
                                    flex-direction: column;
                                    gap: 7px;
                                    position: absolute;
                                    top: 33px;
                                    left: 22px;
                                    z-index: 2;
                                }

                                .image-images img {
                                    width: 60px;
                                    object-fit: cover;
                                    cursor: pointer;
                                    
                                    margin-bottom: 7px;
                                    height: 60px;
                                }

                                .main-image {
                                    position: sticky;
                                    top: 20px;
                                    margin: 0px;
                                    z-index: 1;
                                }

                                .main-image img {
                                    width: 100%;
                                    height: auto;
                                    object-fit: cover;
                                }

                                .circles {
                                    display: flex;
                                    justify-content: center;
                                    gap: 10px;
                                    margin-top: 10px;
                                    display: none;
                                }

                                .circle {
                                    width: 15px;
                                    height: 15px;
                                    border-radius: 50%;
                                    background-color: white;
                                    border: 1px solid #ddd;
                                    cursor: pointer;
                                }

                                .active {
                                    background-color: gray;
                                }

                                .product-info {
                                    width: 100%;
                                    padding: 20px;
                                }

                                .price {
                                    font-size: 24px;
                                    font-weight: bold;
                                }

                                .taxes {
                                    font-size: 14px;
                                    color: #666;
                                }

                                .product-details select {
                                    width: 100%;
                                    padding: 10px;
                                    border: 1px solid #ddd;
                                    border-radius: 5px;
                                }

                                .purchase-buttons {
                                    display: flex;
                                    flex-direction: row;
                                    gap: 10px;
                                }

                                .add-to-cart {
                                    background-color: #fff;
                                    color: #000;
                                    padding: 10px 20px;
                                    border: 1px solid #000;
                                    border-radius: 0px !important;
                                    cursor: pointer;
                                }

                                .buy-now {
                                    background-color: #c6efce;
                                    color: #000;
                                    padding: 10px 20px;
                                    border: none;
                                    border-radius: 0px;
                                    cursor: pointer;
                                }

                                .shipping-info {
                                    margin-top: 20px;
                                }

                                .shipping-info p {
                                    font-size: 14px;
                                    color: #666;
                                }

                                .shipping-info a {
                                    text-decoration: none;
                                    color: #337ab7;
                                }

                                .product-description {
                                    margin-top: 20px;
                                }

                                .product-description h3 {
                                    font-size: 18px;
                                    margin-bottom: 10px;
                                }

                                .product-description p {
                                    font-size: 14px;
                                    color: #666;
                                }

                                .product-description ul {
                                    list-style: none;
                                    padding: 0;
                                    margin: 0;
                                }

                                .product-description li {
                                    font-size: 14px;
                                    color: #666;
                                    margin-bottom: 10px;
                                }

                                .additional-features {
                                    margin-top: 20px;
                                }

                                .shipping-toggle {
                                    background-color: #fff;
                                    color: #000;
                                    padding: 10px 20px;
                                    border: 1px solid #ddd;
                                    border-radius: 0px;
                                    cursor: pointer;
                                }

                                .shipping-content {
                                    display: none;
                                }

                                .shipping-content.show {
                                    display: block;
                                    margin-top: 20px;
                                    padding: 20px;
                                    border: 1px solid #ddd;
                                    border-radius: 5px;
                                }

                                .navigation-buttons {
                                    position: absolute;
                                    top: 50%;
                                    width: 100%;
                                    display: flex;
                                    justify-content: space-between;
                                    transform: translateY(-50%);
                                    z-index: 10;
                                }

                                .navigation-buttons button {
                                    background-color: transparent;
                                    color: white;
                                    font-size: 30px;
                                    border: none;
                                    cursor: pointer;
                                }

                                .navigation-symbols {
                                    display: none;
                                    position: absolute;
                                    top: 50%;
                                    left: 0;
                                    right: 0;
                                    transform: translateY(-50%);
                                    z-index: 5;
                                    justify-content: space-between;
                                    color: #fff;
                                    font-size: 30px;
                                    opacity: 0.7;
                                }

                                .navigation-symbols span {
                                    background-color: rgba(0, 0, 0, 0.5);
                                    padding: 10px;
                                    cursor: pointer;
                                }

                                @media (max-width: 768px) {
                                    .product-image-section {
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        position: relative;
                                        height: 100%;
                                        width: 100%;
                                        flex-direction: column;
                                        margin-left: 10px;
                                    }

                                    .image-images {
                                        display: flex;
                                        flex-direction: column;
                                        gap: 7px;
                                        position: absolute;

                                        left: 22px;
                                        z-index: 2;
                                    }

                                    .main-image {
                                        position: relative;
                                        width: 100%;
                                    }

                                    .circles {
                                        display: flex;
                                        justify-content: center;
                                        gap: 10px;
                                        margin-top: 30px;
                                    }

                                    .navigation-symbols {
                                        display: flex;
                                        justify-content: space-between;
                                        position: absolute;
                                        top: 50%;
                                        left: 0;
                                        right: 0;
                                        transform: translateY(-50%);
                                        z-index: 5;
                                        color: #fff;
                                        font-size: 30px;
                                        opacity: 0.7;
                                    }

                                    .container-product {
                                        flex-direction: column;
                                    }

                                    .image-images {
                                        display: none;
                                    }

                                    .navigation-buttons {
                                        display: flex;
                                        justify-content: center;
                                        gap: 20px;
                                        margin-top: 10px;
                                    }

                                    .navigation-buttons button {
                                        padding: 10px;
                                        background-color: #c6efce;
                                        border: none;
                                        cursor: pointer;
                                    }

                                    .product-info {
                                        width: 50%;
                                        padding: 20px;
                                        display: flex;
                                        flex-direction: column;
                                        align-items: center;
                                        /* Center horizontally */
                                        justify-content: center;
                                        /* Center vertically */
                                        text-align: center;
                                        /* Center text */
                                        margin: 0 auto;
                                        /* Ensure the container is centered within its parent */
                                    }

                                }

                                @media (min-width: 769px) {
                                    .image-images {
                                        display: flex;
                                    }
                                }

                                .image-images.hidden {
                                    display: none;
                                }
                            </style>


                            <div class="container-product" id="container-product">
                                <div class="product-image-section">
                                    <div class="image-images">
                                        @foreach ($product->images as $index => $image)
                                            <img src="{{ asset( $image->image_path) }}"
                                                alt="Image {{ $index + 1 }}"
                                                onclick="changeImage('{{ asset( $image->image_path) }}', {{ $index + 1 }})">
                                        @endforeach
                                    </div>
                                    <div class="main-image">
                                        <img id="main-image"
                                            src="{{ asset( $product->images->first()->image_path) }}"
                                            alt="{{ $product->title }}">

                                    </div>

                                    <!-- symbols for mobile -->
                                    <div class="navigation-symbols">
                                        <span onclick="prevImage()"><</span>
                                        <span onclick="nextImage()">></span>
                                    </div>

                                    <div class="circles">
                                        @foreach ($product->images as $index => $image)
                                            <div class="circle" id="circle-0"
                                                onclick="changeImage('{{ asset( $image->image_path) }}', {{ $index + 1 }})">
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="grid__item medium-up--one-half">

                                    <div class="product-single__meta">
                                        <div class="product-block product-block--header">
                                            <h1 class="h2 product-single__title text1">
                                                {{ $product->title }}
                                            </h1>
                                        </div>

                                        <div data-product-blocks>
                                            <div class="product-block product-block--price"><span data-a11y-price
                                                    class="visually-hidden">Prix régulier</span><span data-product-price
                                                    class="product__price">

                                                    <div id="price"></div>

                                                </span><span data-save-price class="product__price-savings hide"></span>
                                                <div data-unit-price-wrapper
                                                    class="product__unit-price product__unit-price--spacing  hide"><span
                                                        data-unit-price></span>/<span data-unit-base></span>
                                                </div>
                                                <div class="product__policies rte small--text-center">{{ __('product.taxes_included') }}
                                                </div>
                                            </div>
                                            <div class="product-block">
                                                <hr>
                                            </div>
                                            <div class="product-block"></div>
                                            <div class="product-block">
                                                <div class="product-block">
                                                    <ul id="unitList">
                                                        <style>
                                                            ul {
                                                                list-style-type: none;
                                                                padding: 0;
                                                            }

                                                            li.unit-item {
                                                                padding: 10px;
                                                                margin: 5px;
                                                                border: 1px solid #ccc;
                                                                cursor: pointer;
                                                                display: inline-block;
                                                                /* Show the next li beside the current one */
                                                                transition: border 0.3s ease;
                                                            }

                                                            li.unit-item.selected {
                                                                border: 2px solid #000000;
                                                            }

                                                            li.unit-item:hover {
                                                                border-color: #000;
                                                            }

                                                            #price {
                                                                margin-top: 20px;
                                                                
                                                            }
                                                        </style>
                                                        <h1>{{ __('product.capacity') }}</h1>
                                                        @foreach ($product->units as $index => $unit)
                                                            <li class="unit-item {{ $index === 0 ? 'selected' : '' }}"
                                                                data-unit="{{ $unit->unit }}"
                                                                data-price="{{ $unit->price }}"
                                                                id="{{$unit->id}}">
                                                                {{ $unit->unit }}
                                                            </li>
                                                        @endforeach
                                                    </ul>


                                                    <form>

                                                        <!-- Hidden inputs -->
                                                        <input type="hidden" name="form_type" value="product" />
                                                        <input type="hidden" name="utf8" value="✓" />

                                                        <!-- Hidden inputs -->
                                                        <input type="hidden" name="price" id="hiddenPrice"
                                                            value="{{ $product->units[0]->price ?? '' }}">
                                                        <input type="hidden" name="unit" id="hiddenUnit"
                                                            value="{{ $product->units[0]->unit ?? '' }}">
                                                        <input type="hidden" name="product_id" id="hiddenProductId"
                                                            value="{{ $product->id }}">
                                                        <input type="hidden" name="product_name" id="hiddenProductName"
                                                            value="{{ $product->title }}">
                                                        <input type="hidden" name="product_image" id="hiddenProductImage"
                                                            value="{{ $product->images->first()->image_path }}">



                                                        <script>
                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                const unitList = document.getElementById('unitList');
                                                                const priceDiv = document.getElementById('price');
                                                                const hiddenPrice = document.getElementById('hiddenPrice');
                                                                const hiddenUnit = document.getElementById('hiddenUnit');
                                                                const addToCartButton = document.querySelector('.add-to-cart');
                                                                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                                                                // Restore drawer state on reload
                                                                if (localStorage.getItem('drawerOpen') === 'true') {
                                                                    document.getElementById('drawer').style.right = '0px';
                                                                    document.getElementById('overlaydrawer').style.display = 'block';
                                                                    document.body.style.overflow = 'hidden';
                                                                    localStorage.removeItem('drawerOpen'); // Remove the flag after applying the style
                                                                }

                                                                // Add to cart button click event
                                                                addToCartButton.addEventListener('click', function(event) {
                                                                    event.preventDefault();

                                                                    // Get product details
                                                                    const productId = document.getElementById('hiddenProductId').value;
                                                                    const productName = document.getElementById('hiddenProductName').value;
                                                                    const productImage = document.getElementById('hiddenProductImage').value;
                                                                    const productPrice = hiddenPrice.value;
                                                                    const productUnit = hiddenUnit.value;

                                                                    // Prepare cart item
                                                                    const cartItem = {
                                                                        id: productId,
                                                                        name: productName,
                                                                        image: productImage,
                                                                        quantity: 1,
                                                                        price: productPrice,
                                                                        unit: productUnit
                                                                    };

                                                                    // Get existing cart from local storage
                                                                    let cart = JSON.parse(localStorage.getItem('cart')) || [];

                                                                    // Check if product exists in cart
                                                                    const existingItemIndex = cart.findIndex(item => item.id === productId && item.unit ===
                                                                        productUnit);

                                                                    if (existingItemIndex !== -1) {
                                                                        // Update quantity if product exists
                                                                        cart[existingItemIndex].quantity += 1;
                                                                    } else {
                                                                        // Add new item to the cart
                                                                        cart.push(cartItem);
                                                                    }

                                                                    // Save updated cart to local storage
                                                                    localStorage.setItem('cart', JSON.stringify(cart));

                                                                    // Backend update only for authenticated users
                                                                    @if (Auth::check())
                                                                        fetch(`/add-to-cart/${productId}`, {
                                                                                method: 'POST',
                                                                                headers: {
                                                                                    'Content-Type': 'application/json',
                                                                                    'X-CSRF-TOKEN': csrfToken,
                                                                                },
                                                                                body: JSON.stringify(cartItem)
                                                                            })
                                                                            .then(response => {
                                                                                if (!response.ok) throw new Error(
                                                                                    'Failed to update the cart in the database.');
                                                                                return response.json();
                                                                            })
                                                                            .then(data => {
                                                                                console.log('Cart updated successfully in the database:', data);
                                                                                console.log('Cart item: ', cartItem);
                                                                            })
                                                                            .catch(error => console.error('Error:', error));
                                                                    @else
                                                                        console.log('User is not authenticated. Item only added to local storage.');
                                                                    @endif

                                                                    // Set flag in localStorage to keep the drawer open on reload
                                                                    localStorage.setItem('drawerOpen', 'true');

                                                                    // Reload the page
                                                                    location.reload();
                                                                });

                                                                // Function to update unit selection
                                                                function updateSelection(selectedItem) {
                                                                    document.querySelectorAll('.unit-item').forEach(item => item.classList.remove('selected'));
                                                                    selectedItem.classList.add('selected');
                                                                    const price = selectedItem.getAttribute('data-price');
                                                                    const unit = selectedItem.getAttribute('data-unit');
                                                                    priceDiv.textContent = ` ${price} {{$settings->currency}} `;
                                                                    hiddenPrice.value = price;
                                                                    hiddenUnit.value = unit;
                                                                }

                                                                // Handle unit selection
                                                                if (unitList) {
                                                                    const firstSelected = unitList.querySelector('.unit-item.selected');
                                                                    if (firstSelected) updateSelection(firstSelected);

                                                                    unitList.addEventListener('click', function(event) {
                                                                        if (event.target.classList.contains('unit-item')) {
                                                                            updateSelection(event.target);
                                                                        }
                                                                    });
                                                                }
                                                            });
                                                        </script>


                                                        <div class="payment-buttons">
                                                            <!-- Disable button if qty == 0.00 -->
                                                            <button type="submit" name="add" data-add-to-cart
                                                                class="btn btn--full add-to-cart btn--secondary"
                                                                @if ($product->qty == 0.0) disabled @endif>
                                                                <span data-add-to-cart-text
                                                                    data-default-text="Ajouter au panier">
                                                                     {{ __('product.add_to_cart') }}
                                                                </span>
                                                            </button>

                                                            <div data-shop="payment-button" class="shop-payment-button">
                                                                <shop-accelerated-checkout recommended="null"
                                                                    fallback="{"name":"buy_it_now","wallet_params":{}}"
                                                                    access-token="37990dc236f63a8f4f52b51cf35977fb"
                                                                    buyer-country="MA" buyer-locale="fr"
                                                                    buyer-currency="{{$settings->currency}}"
                                                                    variant-params="[{"id":42856464089338,"requiresShipping":true},{"id":42856464154874,"requiresShipping":true}]"
                                                                    shop-id="64108429562" requires-shipping="">
                                                                    <shop-buy-it-now-button
                                                                        access-token="37990dc236f63a8f4f52b51cf35977fb"
                                                                        buyer-country="MA" buyer-currency="{{$settings->currency}}"
                                                                        wallet-params="{}" page-type="product"
                                                                        slot="button" requires-shipping=""
                                                                        call-to-action="">
                                                                        <a  id="shopNow" href="{{route('checkout.show',['lang' => app()->getLocale()])}}" > <button style="width: 100%; padding: 15px; margin: 24px 0px; background-color: #e0f4e1;"
                                                                        onmouseover="this.style.backgroundColor=''"
                                                                        onmouseout="this.style.backgroundColor='#e0f4e1'" type="button"
                                                                            class="shop-payment-button__button shop-payment-button__button--unbranded"
                                                                            @if ($product->qty == 0.0) disabled @endif>{{ __('product.buy_now') }} </button></a>
                                                                            
                                                                            <script>
                                                                                document.addEventListener('DOMContentLoaded', function() {
                                                                                    const buyNowButton = document.querySelector('#shopNow');

                                                                                    buyNowButton.addEventListener('click', function(event) {
                                                                                        event.preventDefault();
                                                                                        // Get product details
                                                                                        const productId = document.getElementById('hiddenProductId').value;
                                                                                        const productName = document.getElementById('hiddenProductName').value;
                                                                                        const productImage = document.getElementById('hiddenProductImage').value;
                                                                                        const productPrice = document.getElementById('hiddenPrice').value;
                                                                                        const productUnit = document.getElementById('hiddenUnit').value;

                                                                                        // Prepare product object
                                                                                        const oneProduct = {
                                                                                            id: productId,
                                                                                            name: productName,
                                                                                            image: productImage,
                                                                                            price: productPrice,
                                                                                            unit: productUnit
                                                                                        };

                                                                                        // Save product to local storage
                                                                                        localStorage.setItem('oneProduct', JSON.stringify(oneProduct));

                                                                                        // Redirect to the checkout page
                                                                                        window.location.href = event.target.parentElement.href;
                                                                                    });
                                                                                });
                                                                            </script>

                                                                    </shop-buy-it-now-button>
                                                                </shop-accelerated-checkout>
                                                                <!--<small id="shop-buyer-consent" class="hidden"
                                                                    aria-hidden="true">
                                                                    Cet article constitue un achat récurrent ou différé. En
                                                                    continuant, j’accepte la
                                                                    <span id="shop-subscription-policy-button">politique
                                                                        de résiliation</span>
                                                                    et vous autorise à facturer mon moyen de paiement aux
                                                                    prix, fréquences et dates listées
                                                                    sur cette page jusqu’à ce que ma commande soit traitée
                                                                    ou que je l’annule, si autorisé.
                                                                </small>-->
                                                            </div>
                                                        </div>
                                                    </form>




                                                    <div data-shop="payment-button" class="shop-payment-button">
                                                        <small id="shop-buyer-consent" class="hidden" aria-hidden="true">
                                                            {!! $product->description !!} </small>
                                                    </div>
                                                </div>
                                                <style>     
                                                .flex-container{
                                                    display: flex;
                                                        align-items: center; /* This aligns items vertically in the center */
                                                        margin-left:10px; 
                                                    }
                                                </style>
                                                <div class="shop-payment-terms product__policies flex-container">
                                                    <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-in-stock" viewBox="0 0 12 10">
                                                        <!-- Directly setting the fill color here -->
                                                        <path style="color:green" fill-rule="evenodd" clip-rule="evenodd" d="M3.293 9.707l-3-3a.999.999 0 1 1 1.414-1.414l2.236 2.236 6.298-7.18a.999.999 0 1 1 1.518 1.3l-7 8a1 1 0 0 1-.72.35 1.017 1.017 0 0 1-.746-.292z" fill="green"></path>
                                                    </svg>
                                                    <span style="margin-left:  20px;"> Récupération
                                                    disponible à Tiyya Shop .
                                                    <br>

                                                    <small>Habituellement prête en 4 heures</small>

                                                     </span>
                                                </div>
                                            </div>
                                            <div data-store-availability-holder
                                                data-product-name="Évasion en Quatre Parfums"
                                                data-base-url="../../../index.html"></div>
                                        </div>
                                        <div class="product-block">
                                            <div class="rte">
                                                @if ($product->ingredient)
                                                    <h1 style="font-weight: bolder;"> {{ __('product.ingredients') }}</h1>
                                                    <div>{!! $product->ingredient ?? '' !!}</div>
                                                @endif
                                                @if ($product->utilisation)
                                                    <h1 style="font-weight: bolder;">{{ __('product.usage') }}</h1>
                                                    <div>{!! $product->utilisation ?? '' !!}</div>
                                                @endif
                                                @if ($product->result)
                                                    <h1 style="font-weight: bolder;"> {{ __('product.results') }}</h1>
                                                    <div>{!! $product->result ?? '' !!}</div>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="product-block product-block--tab">


                                            <div class="collapsibles-wrapper collapsibles-wrapper--border-bottom">
                                                <button type="button"
                                                    class="label collapsible-trigger collapsible-trigger-btn collapsible-trigger-btn--borders collapsible--auto-height"
                                                    aria-controls="Product-content-tab8663781474554">
                                                   {{ __('product.delivery') }}
                                                    <span class="collapsible-trigger__icon collapsible-trigger__icon--open"
                                                        role="presentation">
                                                        <svg aria-hidden="true" focusable="false" role="presentation"
                                                            class="icon icon--wide icon-chevron-down" viewBox="0 0 28 16">
                                                            <path d="M1.57 1.59l12.76 12.77L27.1 1.59" stroke-width="2"
                                                                stroke="#000" fill="none" fill-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                </button>
                                                <div id="Product-content-tab8663781474554"
                                                    class="collapsible-content collapsible-content--all">
                                                    <div class="collapsible-content__inner rte">
                                                        <p>
                                                            {{ __('product.free_delivery', ['amount' => $settings->free_delivery_threshold, 'currency' => $settings->currency]) }}
                                                        </p>
                                                        <p>
                                                            {{ __('product.delivery_less_350', ['amount' => $settings->free_delivery_threshold, 'currency' => $settings->currency]) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>

                        </div>
                        <script>
                            let currentImageIndex = 0;
                            const images = [
                                @foreach ($product->images as $image)
                                    '{{ asset( $image->image_path) }}',
                                @endforeach
                            ];

                            // Function to change the main image
                            function changeImage(imageSrc, index) {
                                document.getElementById("main-image").src = imageSrc;
                                currentImageIndex = index;

                                // Update the active circle
                                const circles = document.querySelectorAll('.circle');
                                circles.forEach((circle, i) => {
                                    if (i === index) {
                                        circle.classList.add('active');
                                    } else {
                                        circle.classList.remove('active');
                                    }
                                });
                            }

                            // Function to move to the next image
                            function nextImage() {
                                currentImageIndex = (currentImageIndex + 1) % images.length;
                                changeImage(images[currentImageIndex], currentImageIndex);
                            }

                            // Function to move to the previous image
                            function prevImage() {
                                currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
                                changeImage(images[currentImageIndex], currentImageIndex);
                            }
                            window.addEventListener('scroll', () => {
                                const container = document.getElementById('container-product');
                                const imageImages = document.querySelector('.image-images');
                                const containerTop = container.offsetTop;
                                const containerHeight = container.offsetHeight;

                                // Check if we are inside the container
                                if (window.scrollY > containerTop + 100) { // 100px offset to trigger hiding
                                    imageImages.classList.add('hidden');
                                } else {
                                    imageImages.classList.remove('hidden');
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="shop-section">
        <div>
            
            <div class="index-section related-products-section" style="margin-top: 20px;">
                <div class="page-width">
                    <header class="section-header" style="text-align: center;">
                        <h3 class="section-header__title" >
                             {{ __('product.you_may_like') }}
                        </h3>
                    </header>
                </div>
                <div class="related-products-container" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                    @if ($product->category && $product->category->products->count() > 0)
                        <div class="related-products-grid" >
                            @foreach ($product->category->products->take(4) as $relatedProduct)
                                <div class="related-product-card" style="flex: 0 0 auto; width: 100%; text-align: left;">
                                    <a href="./{{ $relatedProduct->id }}" style="text-decoration: none; color: #333; display: block;">
                                        @if ($relatedProduct->images->first())
                                            <img src="{{ asset( $relatedProduct->images->first()->image_path) }}" 
                                                alt="Default Product Image" style="width: 100%; display: block; height: auto; max-height: 220px; object-fit: contain; margin-bottom: 5px;">
                                        @else
                                            <img src="{{ asset('path/to/default/image.jpg') }}"
                                                alt="Default Product Image" style="width: 100%; display: block; height: auto; max-height: 220px; object-fit: contain; margin-bottom: 5px;">
                                        @endif
                                        <p class="related-product-title" style="margin-bottom: 5px; font-size: 1em; font-weight: normal;">{{ $relatedProduct->title }}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                    
                    @endif
                </div>
            </div>
            <style>
                /*Default Style*/
                .related-products-grid {
                    display: flex; 
                    gap: 15px; 
                    padding: 10px; 
                    justify-content: space-around;
                }
            
                /* Media query for small screens (phone size) */
                @media (max-width: 767px) { /* Adjust breakpoint as needed */
                    .related-products-grid {
                        /* Specific mobile phone styles */
                        display: flex;
                        gap: 15px;
                        padding: 10px;
                        justify-content: space-around;
                    }
                    .related-product-card{
                        width: 40% !important;
                    }
                }
               </style>
        </div>
    </div>
    
    <div class="shop-section">
        <div>
            <hr class="hr--large">
            <div class="index-section index-section--small">
                <div class="page-width">
                    <header class="section-header" style="text-align: center;">
                        <h3 class="">{{ __('product.recently_viewed') }}</h3>
                    </header>
                </div>
    
                <div class="page-width page-width--flush-small">
                    <div class="grid-overflow-wrapper">
                        <div id="RecentlyViewed-template--15972022124794__recently-viewed" class="grid grid--uniform"
                            data-aos="overflow__animation" style="display: flex; overflow-x: auto; justify-content: space-evenly;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to get recently viewed products from local storage
            function getRecentlyViewedProducts() {
                const viewedProducts = localStorage.getItem('recentlyViewedProducts');
                return viewedProducts ? JSON.parse(viewedProducts) : [];
            }
    
            // Function to update the "Recently Viewed" section
            function updateRecentlyViewedSection() {
                const recentlyViewedProducts = getRecentlyViewedProducts();
                const recentlyViewedContainer = document.getElementById(
                    'RecentlyViewed-template--15972022124794__recently-viewed');
    
    
                if (recentlyViewedContainer) {
                    recentlyViewedContainer.innerHTML = ''; // Clear previous content
    
                    if (recentlyViewedProducts.length > 0) {
                        recentlyViewedProducts.forEach(product => {
                            const productDiv = document.createElement('div');
                            productDiv.classList.add('recently-viewed-product');
                            productDiv.style.cssText = 'display: flex; flex-direction: column;  align-items: center; text-align: center; margin: 10px; width: 22%;';
    
                            const productLink = document.createElement('a');
                            productLink.href = `./${product.id}`;
                            productLink.style.cssText = 'text-decoration: none; color: #333;';
    
    
                            const productImage = document.createElement('img');
                            productImage.src = `{{ asset('') }}${product.image}`;
                             productImage.style.cssText = 'width: 100%; display: block;';
                            productImage.alt = product.title;
    
                            const productTitle = document.createElement('p');
                            productTitle.textContent = product.title;
    
                            productLink.appendChild(productImage);
                            productLink.appendChild(productTitle);
                            productDiv.appendChild(productLink);
                            recentlyViewedContainer.appendChild(productDiv);
                        });
                    } else {
                        recentlyViewedContainer.innerHTML = '<p></p>'
                    }
                }
            }
    
    
            // Function to set a product as recently viewed
            function setRecentlyViewedProduct(productId, productTitle, productImage) {
                let recentlyViewedProducts = getRecentlyViewedProducts();
    
                // Check if the product is already in the list
                const existingIndex = recentlyViewedProducts.findIndex(item => item.id === productId);
    
                if (existingIndex !== -1) {
                    // Move existing item to the beginning
                    const existingItem = recentlyViewedProducts[existingIndex];
                    recentlyViewedProducts.splice(existingIndex, 1);
                    recentlyViewedProducts.unshift(existingItem);
                } else {
                    // Add the new product to the beginning
                    recentlyViewedProducts.unshift({
                        id: productId,
                        title: productTitle,
                        image: productImage
                    });
                    // Limit to 4 items
                    if (recentlyViewedProducts.length > 4) {
                        recentlyViewedProducts = recentlyViewedProducts.slice(0, 4);
                    }
                }
    
    
    
                localStorage.setItem('recentlyViewedProducts', JSON.stringify(recentlyViewedProducts));
                updateRecentlyViewedSection(); // Update immediately after setting
            }
    
    
            // Get product data from the blade template and set as recently viewed
            const productId = '{{ $product->id }}';
            const productTitle = '{{ $product->title }}';
            const productImage = '{{ $product->images->first()->image_path ?? '' }}';
    
    
            if (productId && productTitle && productImage) {
                setRecentlyViewedProduct(productId, productTitle, productImage);
            }
    
            updateRecentlyViewedSection();
        });
    </script>
    <style>
        @media (min-width: 768px) {
            .related-products-container {
                overflow-x: hidden;
            }
    
            .related-products-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 20px;
                padding: 10px;
            }
    
            .related-product-card {
                width: auto;
                flex: 1;
            }
    
            .related-product-card img {
                max-height: 200px;
            }
    
            .related-product-title {
                text-align: center;
            }
        }
    </style>
    
    </div>

    <div id="shop-section-newsletter-popup" class="shop-section index-section--hidden">
    </div>
    <div id="VideoModal" class="modal modal--solid">
        <div class="modal__inner">
            <div class="modal__centered page-width text-center">
                <div class="modal__centered-content">
                    <div class="video-wrapper video-wrapper--modal">
                        <div id="VideoHolder"></div>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="modal__close js-modal-close text-link">
            <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-close" viewBox="0 0 64 64">
                <path d="M19 17.61l27.12 27.13m0-27.12L19 44.74" />
            </svg>
            <span class="icon__fallback-text">"Fermer (Esc)"</span>
        </button>
    </div>
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <div class="pswp__ui pswp__ui--hidden">
                <button class="btn btn--body btn--circle pswp__button pswp__button--arrow--left" title="Précédent">
                    <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-chevron-left"
                        viewBox="0 0 284.49 498.98">
                        <path
                            d="M249.49 0a35 35 0 0 1 24.75 59.75L84.49 249.49l189.75 189.74a35.002 35.002 0 1 1-49.5 49.5L10.25 274.24a35 35 0 0 1 0-49.5L224.74 10.25A34.89 34.89 0 0 1 249.49 0z" />
                    </svg>
                </button>

                <button class="btn btn--body btn--circle btn--large pswp__button pswp__button--close"
                    title="Fermer (Esc)">
                    <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-close"
                        viewBox="0 0 64 64">
                        <path d="M19 17.61l27.12 27.13m0-27.12L19 44.74" />
                    </svg>
                </button>

                <button class="btn btn--body btn--circle pswp__button pswp__button--arrow--right" title="Suivant">
                    <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-chevron-right"
                        viewBox="0 0 284.49 498.98">
                        <path
                            d="M35 498.98a35 35 0 0 1-24.75-59.75l189.74-189.74L10.25 59.75a35.002 35.002 0 0 1 49.5-49.5l214.49 214.49a35 35 0 0 1 0 49.5L59.75 488.73A34.89 34.89 0 0 1 35 498.98z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
@endsection