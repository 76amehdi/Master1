<!doctype html>
<html class="no-js" lang="fr" dir="ltr">

<head>
    <link href="{{ asset('user/assets/css/theme91c5.css') }}" rel="stylesheet" type="text/css" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Questrial&family=Tenor+Sans&display=swap" rel="stylesheet">
    <style>
        body {
            top: 0px !important;
        }
    </style>

    <script>
        document.documentElement.className =
            document.documentElement.className.replace("no-js", "js");

        window.theme = window.theme || {};

        theme.strings = {
            soldOut: "Épuisé",
            unavailable: "Non disponible",
            inStockLabel: "En stock",
            stockLabel: "",
            willNotShipUntil: "Sera expédié après [date]",
            willBeInStockAfter: "Sera en stock à compter de [date]",
            waitingForStock: "Inventaire sur le chemin",
            savePrice: "Réduction de [saved_amount]",
            cartEmpty: "Votre panier est vide.",
            cartTermsConfirmation: "Vous devez accepter les termes et conditions de vente pour vérifier",
            searchCollections: "Collections:",
            searchPages: "Pages:",
            searchArticles: "Des articles:",
        };
        theme.settings = {
            dynamicVariantsEnable: true,
            cartType: "drawer",
            isCustomerTemplate: true,
            moneyFormat: "amount {{ $settings->currency }}",
            saveType: "percent",
            productImageSize: "natural",
            productImageCover: false,
            predictiveSearch: true,
            predictiveSearchType: "product,article,page,collection",
            quickView: false,
            themeName: "Impulse",
            themeVersion: "5.5.3",
        };
    </script>
    <script src="{{ asset('user/assets/js/vendor-scripts-v11.js') }}" defer="defer"></script>
    <script src="{{ asset('user/assets/js/themed4c9.js?v=135810884792292150381651752836') }}" defer="defer"></script>
    <style>
        .text-center .site-navigation{
            margin: 40px 0px !important;
        }
        .announcement-bar {
            color: white;
            background-color: #eca7ba;
            padding: 10px;
            margin-top: 145px;
        }
        
        @media (max-width: 768px){
            .announcement-bar {
            color: white;
            background-color: #eca7ba;
            padding: 10px;
            margin-top: 90px;
        }
        }
.announcement-text {
                font-family: 'questrial';
    font-weight: bold;
    text-transform: uppercase;
    font-size: 13px;
    letter-spacing: 0.1rem;
}
     .announcement-link-text {
                font-family: 'questrial';
   
    font-size: 13px;

}   
        @media only screen and (max-width: 768px) {
            .announcement-bar {
                margin-top: 0px !important;
                color: white;
                background-color: #eca7ba;
                padding: 10px;
                padding-top: 90px;
            }

            .site-header {
                padding: 0;
                width: 100%;
                /* Ensures the header spans the full width */
                height: 80px;
                /* Ensure header has a fixed height */
                position: fixed;
                top: 0;
                /* Keeps the header pinned at the top */
                left: 0;
                right: 0;
                z-index: 999;
                margin-bottom: 50px;
                /* Adds space below the header */
            }

            .header-layout {
                width: 100%;
                /* Prevents layout overflow */
            }

            .site-header__logo img {
                position: relative;
                /* Fixed positioning for logo */
                left: 20%;
                /* Adjust logo position */
                max-width: 80%;
                /* Limits logo size to 80% of its container */
            }

            .site-header__logo img {
                top: 50%;
                left: 0%;
                transform: translate(0%, 0%)
            }

            .site-header__logo-link {
                padding-top: 0 !important;
                /* Removes unnecessary padding */
            }


        }

        .main-content {
            display: inline;
            min-height: 300px;
        }

        .site-header__logo-link {
            padding-top: 68%;
        }
    </style>
</head>

<body>
    @if (session('clearCart'))
        <script>
            localStorage.removeItem('cart');
            sessionStorage.setItem('cartCleared', 'true');
            console.log('Cart cleared from localStorage due to redirect flag');
        </script>
    @endif

    <script>
        if (sessionStorage.getItem('cartCleared') === 'true') {
            sessionStorage.removeItem('cartCleared');
            console.log('Cart clear flag session cleared');
        }
    </script>

    @if (request()->query('clearCart'))
        <script>
            localStorage.removeItem('cart');
            console.log('Cart cleared from localStorage due to redirect parameter');
        </script>
    @endif



    <div id="PageContainer" class="page-container">
        <div class="transition-body">
            <div id="shop-section-header" class="shop-section">

                <div data-section-id="header" data-section-type="header">
                    <div class="toolbar small--hide">
                        <div class="page-width">
                            <div class="toolbar__content"></div>

                        </div>
                    </div>
                    <div>
                        <div id="HeaderWrapper" class="header-wrapper">
                            <header id="SiteHeader" class="site-header site-header--heading-style" data-sticky="true" style="élément {
  width: 100%;"
                                data-overlay="true">
                                <div class="page-width">
                                    <div class="header-layout header-layout--left-center" data-logo-align="left">
                                        <div class="header-item header-item--logo">

                                            <h1 class="site-header__logo">
                                                <span class="visually-hidden">Tiyya Shop</span>
                                                <a href="{{ url('/') }}" itemprop="url"
                                                    class="site-header__logo-link">
                                                    <img class="small--hide"
                                                        src="https://tiyyashop.ma/cdn/shop/files/LOGO_Tiyya_HD_120x@2x.png"
                                                        srcset="https://tiyyashop.ma/cdn/shop/files/LOGO_Tiyya_HD_120x@2x.png"
                                                        alt="Tiyya Shop" itemprop="logo">
                                                    <img class="medium-up--hide"
                                                        src="https://tiyyashop.ma/cdn/shop/files/LOGO_Tiyya_HD_120x@2x.png"
                                                        srcset="https://tiyyashop.ma/cdn/shop/files/LOGO_Tiyya_HD_120x@2x.png"
                                                        alt="Tiyya Shop">
                                                </a>
                                            </h1>
                                        </div>
                                        <!-- translations -->
                                        <!-- links -->
                                        <div class="header-item header-item--navigation text-center">
                                            <ul class="site-nav site-navigation small--hide" role="navigation"
                                                aria-label="Primary">
                                                
                                                <li class="site-nav__item site-nav__expanded-item">
                                                    <a href="{{ route('category.nouvotes', ['lang' => app()->getLocale()]) }}"
                                                        class="site-nav__link site-nav__link--underline">Nouveautés</a>
                                                </li>
<li class="site-nav__item site-nav__expanded-item">
                                                    <a href="{{ route('home', ['lang' => app()->getLocale()]) }}"
                                                        class="site-nav__link site-nav__link--underline">Accueil</a>
                                                </li>
                                                @foreach ($routes as $category)
                                                    <li class="site-nav__item site-nav__expanded-item">
                                                        <a href="{{ route('category.page', ['lang' => app()->getLocale(), 'name' => $category->category_name]) }}"
                                                            class="site-nav__link site-nav__link--underline">
                                                            {{ $category->category_name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                                <li class="site-nav__item site-nav__expanded-item site-nav--has-dropdown"
                                                    aria-haspopup="true">
                                                    <a href="#"
                                                        class="site-nav__link site-nav__link--underline site-nav__link--has-dropdown">
                                                        Astuces beauté
                                                    </a>
                                                    <ul class="site-nav__dropdown text-left">
                                                        @foreach ($beautyTips as $name => $url)
                                                            <li>
                                                                <a href="{{ route('blog.category', ['category' => $name, 'lang' => app()->getLocale()]) }}"
                                                                    class="site-nav__dropdown-link site-nav__dropdown-link--second-level">
                                                                    {{ $name }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- end links -->
                                        <div class="header-item header-item--icons">
                                            <div class="site-nav">

                                                <div class="site-nav__icons">
                                                    @if (Auth::check() && Auth::user()->usertype == 1)
                                                        <a style="    border: 2px solid #ddd;
    padding: 5px;
    /* margin: 20px; */
    background-color: #ffffff;
    margin-top: 60px;
    margin-right: -160px;"
                                                            class="site-nav__link site-nav__link--icon small--hide"
                                                            href="{{ route('dashboard', ['lang' => app()->getLocale()]) }}">
                                                            <span>Go to Dashboard</span>
                                                        </a>
                                                    @endif
                                                    @if (Auth::check())
                                                        <a class="site-nav__link site-nav__link--icon small--hide"
                                                            href="{{ route('account', ['lang' => app()->getLocale()]) }}">
                                                            <svg aria-hidden="true" focusable="false"
                                                                role="presentation" class="icon icon-user"
                                                                viewBox="0 0 64 64">
                                                                <path
                                                                    d="M35 39.84v-2.53c3.3-1.91 6-6.66 6-11.41 0-7.63 0-13.82-9-13.82s-9 6.19-9 13.82c0 4.75 2.7 9.51 6 11.41v2.53c-10.18.85-18 6-18 12.16h42c0-6.19-7.82-11.31-18-12.16z"
                                                                    style="stroke-width: 2;" />
                                                            </svg>
                                                            <span class="icon__fallback-text">Account
                                                            </span>
                                                        </a>
                                                    @else
                                                        <a class="site-nav__link site-nav__link--icon small--hide"
                                                            href="{{ route('login', ['lang' => app()->getLocale()]) }}">
                                                            <svg aria-hidden="true" focusable="false"
                                                                role="presentation" class="icon icon-user"
                                                                viewBox="0 0 64 64">
                                                                <path
                                                                    d="M35 39.84v-2.53c3.3-1.91 6-6.66 6-11.41 0-7.63 0-13.82-9-13.82s-9 6.19-9 13.82c0 4.75 2.7 9.51 6 11.41v2.53c-10.18.85-18 6-18 12.16h42c0-6.19-7.82-11.31-18-12.16z"
                                                                    style="stroke-width: 2;" />
                                                            </svg>
                                                            <span class="icon__fallback-text">Se connecter
                                                            </span>
                                                        </a>
                                                    @endif

                                                    <a class="search-btn" id="searchBtn"
                                                        class="site-nav__link site-nav__link--icon js-search-header">
                                                        <svg aria-hidden="true" focusable="false" role="presentation"
                                                            class="icon icon-search" viewBox="0 0 64 64">
                                                            <path
                                                                d="M47.16 28.58A18.58 18.58 0 1 1 28.58 10a18.58 18.58 0 0 1 18.58 18.58zM54 54L41.94 42"
                                                                style="stroke-width: 2;" />
                                                        </svg>
                                                        <span class="icon__fallback-text">Rechercher</span>
                                                    </a>
                                                    <a class="lang-btn site-nav__link site-nav__link--icon">
                                                        <svg aria-hidden="true" focusable="false" role="presentation"
                                                            class="icon icon-translate" viewBox="0 0 24 24">
                                                            <path
                                                                d="M12.87,15.07L10.33,12.55L10.36,12.51C12.15,10.74 13.34,8.74 13.94,6.39H16V4H9V2H7V4H1.93C3.03,7.37 4.54,10.34 6.3,12.55L3.28,15.57L4.7,17L7.81,13.87C8.4,14.27 9.14,14.73 9.9,15.07L12.87,15.07M18.5,10H16.5L12,22H14L17.1,12H17.7L20.8,22H22.5L18.5,10M15.88,12L17.2,18.6L18.51,12H15.88Z" />
                                                        </svg>
                                                        <span class="icon__fallback-text">Language</span>
                                                        <ul class="lang-dropdown">
                                                            <li><a
                                                                    href="{{ route('home', ['lang' => 'en']) }}">English</a>
                                                            </li>
                                                            <li><a
                                                                    href="{{ route('home', ['lang' => 'fr']) }}">Français</a>
                                                            </li>
                                                            <li><a
                                                                    href="{{ route('home', ['lang' => 'ar']) }}">العربية</a>
                                                            </li>
                                                        </ul>

                                                    </a>
                                                    <style>
                                                        /* General Styles for header icons container*/
                                                        .header-item--icons .site-nav {
                                                            display: flex;
                                                            justify-content: flex-end;
                                                        }

                                                        .header-item--icons .site-nav__icons {
                                                            display: flex;
                                                            align-items: center;
                                                        }

                                                        /* Style for language dropdown */
                                                        .lang-btn {
                                                            position: relative;
                                                            cursor: pointer;
                                                            display: inline-flex;
                                                            /* Ensure the lang-btn is an inline flex container */
                                                            align-items: center;
                                                        }

                                                        .lang-dropdown {
                                                            display: none;
                                                            position: absolute;
                                                            top: 0%;
                                                            background-color: #fff;
                                                            border: 1px solid #ddd;
                                                            padding: 5px 0;
                                                            min-width: 100px;
                                                            right: 8%;
                                                            z-index: 1000;
                                                        }
                                                        .lang-btn:hover .lang-dropdown {
                                                            display: block;
                                                        }

                                                        .lang-dropdown li {
                                                            list-style: none;
                                                            padding: 5px 10px;
                                                        }

                                                        .lang-dropdown li a {
                                                            display: block;
                                                            text-decoration: none;
                                                            color: #333;
                                                        }

                                                        .lang-dropdown li a:hover {
                                                            background-color: #f0f0f0;
                                                        }
                                                    </style>
                                                    <script>
                                                        document.addEventListener('DOMContentLoaded', function() {
                                                            const langBtn = document.querySelector('.lang-btn');
                                                            const langDropdown = document.querySelector('.lang-dropdown');

                                                            if (langBtn && langDropdown) {
                                                                document.addEventListener('click', function(event) {
                                                                    if (!langBtn.contains(event.target) && !langDropdown.contains(event.target)) {
                                                                        langDropdown.style.display = 'none';
                                                                    } else if (langBtn.contains(event.target)) {
                                                                        if (langDropdown.style.display === 'block') {
                                                                            langDropdown.style.display = 'none';
                                                                        } else {
                                                                            langDropdown.style.display = 'block';
                                                                        }
                                                                    }

                                                                });
                                                            }
                                                        });
                                                    </script>
                                                    <button type="button"
                                                        class="site-nav__link site-nav__link--icon js-drawer-open-nav medium-up--hide">
                                                        <svg aria-hidden="true" focusable="false" role="presentation"
                                                            class="icon icon-hamburger" viewBox="0 0 64 64">
                                                            <path d="M7 15h51M7 32h43M7 49h51"
                                                                style="stroke-width: 8;" />
                                                        </svg>
                                                        <span class="icon__fallback-text">Navigation</span>
                                                    </button></a>

                                                    <a id="openDrawerBtn"
                                                        class="site-nav__link site-nav__link--icon js-drawer-open-cart"
                                                        aria-controls="CartDrawer" data-icon="bag-minimal">
                                                        <span class="cart-link">
                                                            <svg aria-hidden="true" focusable="false"
                                                                role="presentation" class="icon icon-bag-minimal"
                                                                viewBox="0 0 64 64">
                                                                <path stroke="null" id="svg_4"
                                                                    fill-opacity="null" stroke-opacity="null"
                                                                    fill="null"
                                                                    d="M11.375 17.863h41.25v36.75h-41.25z"></path>
                                                                <path stroke="null" id="svg_2"
                                                                    d="M22.25 18c0-7.105 4.35-9 9.75-9s9.75 1.895 9.75 9"
                                                                    style="stroke-width: 4;"></path>
                                                            </svg>
                                                            <span class="icon__fallback-text">Panier</span>
                                                            <span class="cart-link__bubble" id="cartBubble"></span>
                                                        </span>

                                                        <style>
                                                            /* Style for the red bubble */
                                                            .cart-link__bubble {
                                                                position: absolute;
                                                                top: 5px;
                                                                /* Adjust as needed */
                                                                left: 1px;
                                                                /* Adjust as needed */
                                                                background-color: red;
                                                                color: white;
                                                                border-radius: 50%;
                                                                width: 9px;
                                                                height: 9px;
                                                                display: none;
                                                                /* Initially hidden */
                                                                justify-content: center;
                                                                align-items: center;
                                                                font-size: 10px;
                                                                font-weight: bold;
                                                            }
                                                        </style>

                                                        <script>
                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                const cartBubble = document.getElementById('cartBubble');

                                                                // Check if the cart exists in localStorage and has items
                                                                const cart = JSON.parse(localStorage.getItem('cart')) || [];

                                                                if (cart.length > 0) {
                                                                    // Show the bubble and optionally display the item count
                                                                    cartBubble.style.display = 'flex';
                                                                    // Number of items in the cart
                                                                } else {
                                                                    // Hide the bubble if the cart is empty
                                                                    cartBubble.style.display = 'none';
                                                                }
                                                            });
                                                        </script>

                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <style>
                                    #NavDrawer.drawer--is-open {
                                        height: 100vh;
                                        overflow-y: auto;
                                        position: fixed;
                                        top: 0;
                                        z-index: 9999999999999999999999;
                                        background-color: white;
                                    }
                                </style>
                                <div id="NavDrawer" class="drawer drawer--right">

                                    <div class="drawer__contents">
                                        <div class="drawer__fixed-header">
                                            <div class="drawer__header appear-delay-1">
                                                <button type="button" style="margin-left: 230px;}"
                                                    class="drawer__close-button js-drawer-close">
                                                    <svg aria-hidden="true" focusable="false" role="presentation"
                                                        class="icon icon-close" viewBox="0 0 64 64">
                                                        <path d="M19 17.61l27.12 27.13m0-27.12L19 44.74" />
                                                    </svg>
                                                    <span class="icon__fallback-text">Fermer le menu</span>
                                                </button>

                                            </div>
                                        </div>
                                        <div class="drawer__scrollable">
                                            <ul class="mobile-nav mobile-nav--heading-style" role="navigation"
                                                aria-label="Primary">
                                                <li class="mobile-nav__item  appear-delay-2">

                                                    @if (Auth::check() && Auth::user()->usertype == 1)
                                                        <a class="mobile-nav__link mobile-nav__link--top-level"
                                                            href="{{ url('dashboard') }}">
                                                            <span>Go to Dashboard</span>
                                                        </a>
                                                    @endif

                                                </li>
                                                <li class="mobile-nav__item  appear-delay-2">
                                                    <a href="{{ route('category.nouvotes', ['lang' => app()->getLocale(), 'name' => $category->category_name]) }}"
                                                        class="mobile-nav__link mobile-nav__link--top-level">Nouveautés</a>
                                                </li>


                                                @foreach ($routes as $category)
                                                    <li class="mobile-nav__item  appear-delay-2"><a
                                                            href="{{ route('category.page', ['lang' => app()->getLocale(), 'name' => $category->category_name]) }}"
                                                            class="mobile-nav__link mobile-nav__link--top-level">{{ $category->category_name }}</a>
                                                    </li>
                                                @endforeach

                                                <li class="mobile-nav__item  appear-delay-13">
                                                    <div class="mobile-nav__has-sublist"><button type="button"
                                                            aria-controls="Linklist-12"
                                                            class="mobile-nav__link--button mobile-nav__link--top-level collapsible-trigger collapsible--auto-height">
                                                            <span class="mobile-nav__faux-link">
                                                                Astuces beauté
                                                            </span>
                                                            <div class="mobile-nav__toggle">
                                                                <span class="faux-button"><span
                                                                        class="collapsible-trigger__icon collapsible-trigger__icon--open"
                                                                        role="presentation">
                                                                        <svg aria-hidden="true" focusable="false"
                                                                            role="presentation"
                                                                            class="icon icon--wide icon-chevron-down"
                                                                            viewBox="0 0 28 16">
                                                                            <path d="M1.57 1.59l12.76 12.77L27.1 1.59"
                                                                                stroke-width="2" stroke="#000"
                                                                                fill="none" fill-rule="evenodd" />
                                                                        </svg>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </button></div>
                                                    <div id="Linklist-12"
                                                        class="mobile-nav__sublist collapsible-content collapsible-content--all">
                                                        <div class="collapsible-content__inner">
                                                            <ul class="mobile-nav__sublist">
                                                                @foreach ($beautyTips as $name => $url)
                                                                    <li class="mobile-nav__item">
                                                                        <div class="mobile-nav__child-item">

                                                                            <a href="{{ route('blog.category', ['category' => $name, 'lang' => app()->getLocale()]) }}"
                                                                                class="mobile-nav__link"
                                                                                id="Sublabel-blogs-soins-visage1">
                                                                                {{ $name }}
                                                                            </a>


                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mobile-nav__item mobile-nav__item--secondary">
                                                    <div class="grid">

                                                        <div
                                                            class="grid__item one-half appear-animation appear-delay-14">
                                                            @if (Auth::check())
                                                                <a class="mobile-nav__link"
                                                                    href="{{ url('user/logout') }}">
                                                                    déconnecter
                                                                </a>
                                                            @else
                                                                <a href="{{ route('login', ['lang' => app()->getLocale()]) }}"
                                                                    class="mobile-nav__link">Se
                                                                    connecter
                                                                </a>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <ul class="mobile-nav__social appear-animation appear-delay-15">
                                                <li class="mobile-nav__social-item">
                                                    <a target="_blank" rel="noopener"
                                                        href="https://www.instagram.com/tiyya.mr/"
                                                        title="Tiyya Shop sur Instagram">
                                                        <svg aria-hidden="true" focusable="false" role="presentation"
                                                            class="icon icon-instagram" viewBox="0 0 32 32">
                                                            <path fill="#444"
                                                                d="M16 3.094c4.206 0 4.7.019 6.363.094 1.538.069 2.369.325 2.925.544.738.287 1.262.625 1.813 1.175s.894 1.075 1.175 1.813c.212.556.475 1.387.544 2.925.075 1.662.094 2.156.094 6.363s-.019 4.7-.094 6.363c-.069 1.538-.325 2.369-.544 2.925-.288.738-.625 1.262-1.175 1.813s-1.075.894-1.813 1.175c-.556.212-1.387.475-2.925.544-1.663.075-2.156.094-6.363.094s-4.7-.019-6.363-.094c-1.537-.069-2.369-.325-2.925-.544-.737-.288-1.263-.625-1.813-1.175s-.894-1.075-1.175-1.813c-.212-.556-.475-1.387-.544-2.925-.075-1.663-.094-2.156-.094-6.363s.019-4.7.094-6.363c.069-1.537.325-2.369.544-2.925.287-.737.625-1.263 1.175-1.813s1.075-.894 1.813-1.175c.556-.212 1.388-.475 2.925-.544 1.662-.081 2.156-.094 6.363-.094zm0-2.838c-4.275 0-4.813.019-6.494.094-1.675.075-2.819.344-3.819.731-1.037.4-1.913.944-2.788 1.819S1.486 4.656 1.08 5.688c-.387 1-.656 2.144-.731 3.825-.075 1.675-.094 2.213-.094 6.488s.019 4.813.094 6.494c.075 1.675.344 2.819.731 3.825.4 1.038.944 1.913 1.819 2.788s1.756 1.413 2.788 1.819c1 .387 2.144.656 3.825.731s2.213.094 6.494.094 4.813-.019 6.494-.094c1.675-.075 2.819-.344 3.825-.731 1.038-.4 1.913-.944 2.788-1.819s1.413-1.756 1.819-2.788c.387-1 .656-2.144.731-3.825s.094-2.212.094-6.494-.019-4.813-.094-6.494c-.075-1.675-.344-2.819-.731-3.825-.4-1.038-.944-1.913-1.819-2.788s-1.756-1.413-2.788-1.819c-1-.387-2.144-.656-3.825-.731C20.812.275 20.275.256 16 .256z" />
                                                            <path fill="#444"
                                                                d="M16 7.912a8.088 8.088 0 0 0 0 16.175c4.463 0 8.087-3.625 8.087-8.088s-3.625-8.088-8.088-8.088zm0 13.338a5.25 5.25 0 1 1 0-10.5 5.25 5.25 0 1 1 0 10.5zM26.294 7.594a1.887 1.887 0 1 1-3.774.002 1.887 1.887 0 0 1 3.774-.003z" />
                                                        </svg>
                                                        <span class="icon__fallback-text">Instagram kjlkjkljlkjl</span>
                                                    </a>
                                                </li>
                                                <li class="mobile-nav__social-item">
                                                    <a target="_blank" rel="noopener"
                                                        href="https://web.facebook.com/profile.php?id=61570191375582"
                                                        title="Tiyya Shop sur Facebook">
                                                        <svg aria-hidden="true" focusable="false" role="presentation"
                                                            class="icon icon-facebook" viewBox="0 0 14222 14222">
                                                            <path
                                                                d="M14222 7112c0 3549.352-2600.418 6491.344-6000 7024.72V9168h1657l315-2056H8222V5778c0-562 275-1111 1159-1111h897V2917s-814-139-1592-139c-1624 0-2686 984-2686 2767v1567H4194v2056h1806v4968.72C2600.418 13603.344 0 10661.352 0 7112 0 3184.703 3183.703 1 7111 1s7111 3183.703 7111 7111zm-8222 7025c362 57 733 86 1111 86-377.945 0-749.003-29.485-1111-86.28zm2222 0v-.28a7107.458 7107.458 0 0 1-167.717 24.267A7407.158 7407.158 0 0 0 8222 14137zm-167.717 23.987C7745.664 14201.89 7430.797 14223 7111 14223c319.843 0 634.675-21.479 943.283-62.013z" />
                                                        </svg>
                                                        <span class="icon__fallback-text">Facebook</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                        </div>
                    </div>








                    </header>
                </div>
            </div>

            <div class="announcement-bar">
                <div class="page-width">
                    <div class="slideshow-wrapper">
                        <div id="AnnouncementSlider" class="announcement-slider" data-compact="true"
                            data-block-count="1">
                            <div id="AnnouncementSlide-1524770292306" class="announcement-slider__slide"
                                data-index="0">
                                <center>
                                    <span class="announcement-text">Livraison gratuite</span>
                                    <span class="announcement-link-text">pour toute commande >
                                        {{ $settings->free_delivery_threshold }} MRU</span>
                                </center>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>
    <main>
        <!-- Main countent-->
        @yield('content')
    </main>
    <!-- Search Bar -->

    <form action="{{route('saerch.page',['lang'=>app()->getLocale()])}}"
        method="GET" id="searchBar" class="search-bar">
        
            @csrf
        <button type="submit" style="background-color: transparent;color:black; font-size:10px;"
            class="site-nav__link site-nav__link--icon js-search-header">
            <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-search"
                viewBox="0 0 64 64">
                <path d="M47.16 28.58A18.58 18.58 0 1 1 28.58 10a18.58 18.58 0 0 1 18.58 18.58zM54 54L41.94 42" />
            </svg>
            <span class="icon__fallback-text">Rechercher</span>
        </button>

        <input type="text" id="searchInput" placeholder="Search..." name="query">
        
        <button type="button" style="background-color: transparent;color:black; font-size:10px;" id="closeSearchBtn"
            class="js-search-header-close text-link site-header__search-btn">
            <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-close"
                viewBox="0 0 64 64">
                <path d="M19 17.61l27.12 27.13m0-27.12L19 44.74" style="stroke-width: 4;"></path>
            </svg>
            <span class="icon__fallback-text">Fermer (Esc)</span>
        </button>
    </form>

    <div id="overlay" class="overlay"></div>

    <style>
        /* Basic Styles */
        body {
            font-family: Arial, sans-serif;
        }

        .search-bar {
            position: fixed;
            top: 0;
            padding: 20px 0;
            background-color: white;
            width: 100%;
            height: 136px;
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1001;
        }

        .search-bar input {
            width: 80%;
            font-size: 16px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
        }

        .search-bar button {
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: none;
        }
    </style>

    <script>
        // Get references to buttons, the search bar, and the overlay
        const searchBtn = document.getElementById('searchBtn');
        const closeSearchBtn = document.getElementById('closeSearchBtn');
        const searchBar = document.getElementById('searchBar');
        const overlay = document.getElementById('overlay');

        // Open the search bar
        searchBtn.addEventListener('click', () => {
            searchBar.style.display = 'flex'; // Show the search bar
            overlay.style.display = 'block'; // Show the overlay
            document.body.style.overflow = 'hidden'; // Disable scrolling
        });

        // Close the search bar when the close button is clicked
        closeSearchBtn.addEventListener('click', () => {
            searchBar.style.display = 'none'; // Hide the search bar
            overlay.style.display = 'none'; // Hide the overlay
            document.body.style.overflow = ''; // Enable scrolling
        });

        // Close the search bar if the overlay is clicked
        overlay.addEventListener('click', () => {
            searchBar.style.display = 'none'; // Hide the search bar
            overlay.style.display = 'none'; // Hide the overlay
            document.body.style.overflow = ''; // Enable scrolling
        });
    </script>


    <!-- Drawer -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        @media screen and (max-width: 700px) {
            .drawer {
                width: 70% !important;
                /* Adjust width to 70% on mobile */
            }
        }

        /* Style for the drawer */
        .drawer {
            position: fixed;
            top: 0;
            right: -100%;
            /* Start hidden off-screen */
            width: 35%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            transition: right 0.3s ease-in-out;
            display: flex;
            justify-content: flex-end;
            z-index: 1001;
        }

        .drawer-content {
            background-color: white;
            padding: 20px;
            width: 100%;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        button {
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }

        /* Style for the overlay */
        #overlaydrawer {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Semi-transparent */
            display: none;
            /* Hidden by default */
            z-index: 99999999999;
        }

        #drawer {
            z-index: 9999999999999999;
        }

        @media (max-width: 767px) {

            /* You can adjust 767px to your specific break point */
            .slideshow-wrapper {
                z-index: 99 !important;
                /* Add other styles here if you need */
            }
        }
    </style>


    <div id="overlaydrawer"></div>

    <div id="drawer" class="drawer">

        <div class="drawer-content" style="padding: 0px">
            @guest
                <form id="CartDrawerForm" novalidate="" class="drawer__contents">
                    <div class="drawer__fixed-header">
                        <div class="drawer__header  appear-delay-1">
                            <div class="h2 drawer__title">Panier</div>
                            <div class="drawer__close">
                                <button type="button" id="closeDrawerBtn" class="drawer__close-button js-drawer-close">
                                    <svg aria-hidden="true" focusable="false" role="presentation"
                                        class="icon icon-close" viewBox="0 0 64 64">
                                        <path d="M19 17.61l27.12 27.13m0-27.12L19 44.74"></path>
                                    </svg>
                                    <span class="icon__fallback-text">Fermer le panier</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="drawer__inner">
                        <div class="drawer__scrollable">
                            <div data-products="" class="appear-delay-2"></div>
                            <div class="product-container">


                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const productContainer = document.querySelector('.product-container');
                                        const subtotalElement = document.querySelector('[data-subtotal]');
                                        const cartFooter = document.querySelector('.drawer__footer');
                                        const checkoutButton = document.querySelector('.cart__checkout');

                                        // Get the cart data from localStorage
                                        let cart = JSON.parse(localStorage.getItem('cart')) || [];

                                        // Function to update the cart container with data from localStorage
                                        function displayCart() {
                                            // Clear any existing products in the container
                                            productContainer.innerHTML = '';

                                            // Iterate over the cart items and create HTML for each
                                            cart.forEach(item => {
                                                const productItem = document.createElement('div');
                                                productItem.classList.add('product-item');

                                                // Create product image element
                                                // Create a link element
                                                const productImageLink = document.createElement('a');
                                                productImageLink.href =
                                                    `/product_details/${item.id}`; // Link to the product details page

                                                // Create product image element
                                                const productImage = document.createElement('img');
                                                productImage.src = `{{ asset('') }}${item.image}`;
                                                productImage.alt = item.name;
                                                productImage.classList.add('product-image');

                                                // Append the image to the link
                                                productImageLink.appendChild(productImage);


                                                // Create product details element
                                                const productDetails = document.createElement('div');
                                                productDetails.classList.add('product-details');

                                                const productTitle = document.createElement('h3');
                                                productTitle.classList.add('product-title');
                                                productTitle.innerHTML = `<a href="product_details/${item.id}" > ${item.name} </a>`;

                                                const productInfo = document.createElement('p');
                                                productInfo.classList.add('product-info');
                                                productInfo.innerHTML =
                                                    `<a href="/product_details/${item.id}">Contenance: ${item.unit}</a>`;

                                                const productActions = document.createElement('div');
                                                productActions.classList.add('product-actions');

                                                const quantityControls = document.createElement('div');
                                                quantityControls.classList.add('quantity-controls');

                                                const quantityMinus = document.createElement('button');
                                                quantityMinus.classList.add('quantity-btn');
                                                quantityMinus.textContent = '−';

                                                // Decrement quantity when minus button is clicked
                                                quantityMinus.addEventListener('click', function() {
                                                    if (item.quantity > 1) {
                                                        item.quantity -= 1;
                                                        updateCartInDatabase(item); // Update the database
                                                    } else {
                                                        removeProductFromCart(item);
                                                    }
                                                    updateCartInLocalStorage();
                                                    displayCart();
                                                    updateTotalPrice(); // Update total price
                                                });

                                                const quantityInput = document.createElement('input');
                                                quantityInput.type = 'text';
                                                quantityInput.value = item.quantity;
                                                quantityInput.classList.add('quantity-input');
                                                quantityInput.addEventListener('change', function() {
                                                    const newQuantity = parseInt(quantityInput.value);
                                                    if (newQuantity > 0) {
                                                        item.quantity = newQuantity;
                                                        updateCartInDatabase(item); // Update the database
                                                    } else {
                                                        // Remove product if quantity is 0 or less
                                                        removeProductFromCart(item);
                                                    }
                                                    updateCartInLocalStorage();
                                                    displayCart();
                                                    updateTotalPrice(); // Update total price
                                                });

                                                const quantityPlus = document.createElement('button');
                                                quantityPlus.classList.add('quantity-btn');
                                                quantityPlus.textContent = '+';

                                                // Increment quantity when plus button is clicked
                                                quantityPlus.addEventListener('click', function() {
                                                    item.quantity += 1;
                                                    updateCartInDatabase(item); // Update the database
                                                    updateCartInLocalStorage();
                                                    displayCart();
                                                    updateTotalPrice(); // Update total price
                                                });

                                                quantityControls.appendChild(quantityMinus);
                                                quantityControls.appendChild(quantityInput);
                                                quantityControls.appendChild(quantityPlus);

                                                const productPrice = document.createElement('p');
                                                productPrice.classList.add('product-price');
                                                productPrice.textContent = `${item.price} {{ $settings->currency }}`;

                                                productActions.appendChild(quantityControls);
                                                productActions.appendChild(productPrice);

                                                productDetails.appendChild(productTitle);
                                                productDetails.appendChild(productInfo);
                                                productDetails.appendChild(productActions);

                                                productItem.appendChild(productImageLink);
                                                productItem.appendChild(productDetails);

                                                // Append the product item to the container
                                                productContainer.appendChild(productItem);
                                            });

                                            // Update the total price when the cart is displayed
                                            updateTotalPrice();
                                        }

                                        // Function to calculate and update the total price
                                        function updateTotalPrice() {
                                            let total = 0;
                                            cart.forEach(item => {
                                                total += parseFloat(item.price) * item.quantity; // Ensure price is treated as a number
                                            });

                                            // Update the subtotal in the footer
                                            if (subtotalElement) {
                                                subtotalElement.textContent = total.toFixed(2) + " {{ $settings->currency }}";
                                            }

                                            // Check if the cart is empty
                                            if (total === 0) {
                                                // Hide the footer section and show the "Cart is empty" message
                                                cartFooter.innerHTML = `<h3 class="empty-cart">Your cart is empty</h3>`;
                                            } else {
                                                // Show the regular footer with cart details and checkout button
                                                cartFooter.innerHTML = `
                                                    <div data-discounts=""></div>
                                                    <div class="cart__item-sub cart__item-row">
                                                        <div class="ajaxcart__subtotal">Sous-total</div>
                                                        <div data-subtotal="${total.toFixed(2)} {{ $settings->currency }}">${total.toFixed(2)} {{ $settings->currency }}</div>
                                                    </div>
                                                    <div class="cart__item-row text-center">
                                                        <small>Les codes promo, les frais d'envoi et les taxes seront ajoutés à la caisse.<br></small>
                                                    </div>
                                                    <div class="cart__checkout-wrapper">
                                                        <a href="{{ route('checkoutt', ['lang' => app()->getLocale()]) }}">
                                                            <button type="button" name="checkout" 
                                                                data-terms-required="false" class="btn cart__checkout">
                                                                Procéder au paiement
                                                            </button>
                                                        </a>
                                                    </div>
                                                `;
                                            }
                                        }

                                        // Function to update cart in localStorage
                                        function updateCartInLocalStorage() {
                                            localStorage.setItem('cart', JSON.stringify(cart));
                                        }

                                        // Function to remove product from the cart
                                        function removeProductFromCart(itemToRemove) {
                                            itemToRemove.quantity = 0;
                                            updateCartInDatabase(itemToRemove);
                                            // Filter out the product with matching ID and unit
                                            cart = cart.filter(item => item.id !== itemToRemove.id || item.unit !== itemToRemove.unit);
                                            updateCartInLocalStorage();
                                            console.log('Removing product from cart finished');
                                        }

                                        // Function to update cart item in the database
                                        function updateCartInDatabase(item) {
                                            if (item.unit) {
                                                @if (Auth::check())
                                                    fetch(`/add-to-cart/${item.id}`, {
                                                            method: 'POST',
                                                            headers: {
                                                                'Content-Type': 'application/json',
                                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                            },
                                                            body: JSON.stringify({
                                                                id: item.id,
                                                                name: item.name,
                                                                image: item.image,
                                                                quantity: item.quantity,
                                                                price: item.price,
                                                                unit: item.unit
                                                            })
                                                        })
                                                        .then(response => {
                                                            if (response.ok) {
                                                                return response.json();
                                                            } else {
                                                                throw new Error('Failed to update item in the database.');
                                                            }
                                                        })
                                                        .then(data => {
                                                            console.log('Item updated in the database successfully!', data);
                                                        })
                                                        .catch(error => console.error('Error:', error));
                                                @else
                                                    console.log('User not authenticated. Database update skipped.');
                                                @endif
                                            } else {
                                                console.log('Item has no units left, not updating in database.');
                                            }
                                        }

                                        // Call the function to display the cart when the page loads
                                        displayCart();
                                    });
                                </script>










                                <!-- Product 1 -->

                            </div>




                        </div>

                        <div class="drawer__footer appear-delay-4">
                            <div data-discounts="">


                            </div>

                            <div class="cart__item-sub cart__item-row">
                                <div class="ajaxcart__subtotal">Sous-total</div>
                                <div data-subtotal="">0.00 {{ $settings->currency }}</div>
                            </div>

                            <div class="cart__item-row text-center">
                                <small>
                                    Les codes promo, les frais d'envoi et les taxes seront ajoutés à la caisse.<br>
                                </small>
                            </div>



                            <div class="cart__checkout-wrapper">
                                <button type="submit" name="checkout" data-terms-required="false"
                                    class="btn cart__checkout">
                                    Procéder au paiement
                                </button>


                            </div>
                        </div>
                    </div>
                </form>
            @endguest
            <style>
                .product-container {
                    width: 400px;
                    margin: 20px auto;
                    font-family: Arial, sans-serif;
                    color: #333;
                }

                .product-item {
                    display: flex;
                    align-items: center;
                    padding: 15px 0;
                    border-bottom: 1px solid #ccc;
                }

                .product-image {
                    width: 70px;
                    height: 70px;
                    margin-right: 15px;
                    object-fit: cover;
                }

                .product-details {
                    flex: 1;
                }

                .product-title {
                    font-size: 16px;
                    margin: 0 0 5px;
                    font-weight: bold;
                }

                .product-info {
                    font-size: 14px;
                    margin: 5px 0;
                    color: #666;
                }

                .product-actions {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-top: 10px;
                }

                .quantity-controls {
                    display: flex;
                    align-items: center;
                }

                .quantity-btn {
                    width: 30px;
                    height: 30px;
                    padding: 0px !important;
                    border: 1px solid #ccc;
                    background: #f9f9f9;
                    font-size: 18px;
                    cursor: pointer;
                    text-align: center;
                    line-height: 28px;
                }

                .quantity-btn:hover {
                    background: #000000;
                    color: #fff;
                }

                .quantity-input {
                    width: 40px;
                    height: 30px;
                    text-align: center;
                    border: 1px solid #ccc;
                    margin: 0 5px;
                }

                .product-price {
                    font-size: 16px;
                    font-weight: bold;
                    color: #000;
                }
            </style>
            @auth
                <form id="CartDrawerForm" novalidate="" class="drawer__contents">
                    <div class="drawer__fixed-header">
                        <div class="drawer__header appear-delay-1">
                            <div class="h2 drawer__title">Panier</div>
                            <div class="drawer__close">
                                <button type="button" id="closeDrawerBtn" class="drawer__close-button js-drawer-close">
                                    <svg aria-hidden="true" focusable="false" role="presentation"
                                        class="icon icon-close" viewBox="0 0 64 64">
                                        <path d="M19 17.61l27.12 27.13m0-27.12L19 44.74"></path>
                                    </svg>
                                    <span class="icon__fallback-text">Fermer le panier</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="drawer__inner">
                        <div class="drawer__scrollable">
                            <div data-products="" class="appear-delay-2"></div>
                            <div class="product-container"></div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const productContainer = document.querySelector('.product-container');
                                const subtotalElement = document.querySelector('[data-subtotal]');
                                const cartFooter = document.querySelector('.drawer__footer');
                                const checkoutButton = document.querySelector('.cart__checkout');

                                // Get the cart data from localStorage
                                let cart = JSON.parse(localStorage.getItem('cart')) || [];

                                // Function to update the cart container with data from localStorage
                                function displayCart() {
                                    // Clear any existing products in the container
                                    productContainer.innerHTML = '';

                                    // Iterate over the cart items and create HTML for each
                                    cart.forEach(item => {
                                        const productItem = document.createElement('div');
                                        productItem.classList.add('product-item');

                                        // Create product image element
                                        // Create a link element
                                        const productImageLink = document.createElement('a');
                                        productImageLink.href =
                                            `/product_details/${item.id}`; // Link to the product details page

                                        // Create product image element
                                        const productImage = document.createElement('img');
                                        productImage.src = `{{ asset('') }}${item.image}`;
                                        productImage.alt = item.name;
                                        productImage.classList.add('product-image');

                                        // Append the image to the link
                                        productImageLink.appendChild(productImage);


                                        // Create product details element
                                        const productDetails = document.createElement('div');
                                        productDetails.classList.add('product-details');

                                        const productTitle = document.createElement('h3');
                                        productTitle.classList.add('product-title');
                                        productTitle.innerHTML = `<a href="product_details/${item.id}" > ${item.name} </a>`;

                                        const productInfo = document.createElement('p');
                                        productInfo.classList.add('product-info');
                                        productInfo.innerHTML =
                                            `<a href="/product_details/${item.id}">Contenance: ${item.unit}</a>`;

                                        const productActions = document.createElement('div');
                                        productActions.classList.add('product-actions');

                                        const quantityControls = document.createElement('div');
                                        quantityControls.classList.add('quantity-controls');

                                        const quantityMinus = document.createElement('button');
                                        quantityMinus.classList.add('quantity-btn');
                                        quantityMinus.textContent = '−';

                                        // Decrement quantity when minus button is clicked
                                        quantityMinus.addEventListener('click', function() {
                                            if (item.quantity > 1) {
                                                item.quantity -= 1;
                                                updateCartInDatabase(item); // Update the database
                                            } else {
                                                removeProductFromCart(item);
                                            }
                                            updateCartInLocalStorage();
                                            displayCart();
                                            updateTotalPrice(); // Update total price
                                        });

                                        const quantityInput = document.createElement('input');
                                        quantityInput.type = 'text';
                                        quantityInput.value = item.quantity;
                                        quantityInput.classList.add('quantity-input');
                                        quantityInput.addEventListener('change', function() {
                                            const newQuantity = parseInt(quantityInput.value);
                                            if (newQuantity > 0) {
                                                item.quantity = newQuantity;
                                                updateCartInDatabase(item); // Update the database
                                            } else {
                                                // Remove product if quantity is 0 or less
                                                removeProductFromCart(item);
                                            }
                                            updateCartInLocalStorage();
                                            displayCart();
                                            updateTotalPrice(); // Update total price
                                        });

                                        const quantityPlus = document.createElement('button');
                                        quantityPlus.classList.add('quantity-btn');
                                        quantityPlus.textContent = '+';

                                        // Increment quantity when plus button is clicked
                                        quantityPlus.addEventListener('click', function() {
                                            item.quantity += 1;
                                            updateCartInDatabase(item); // Update the database
                                            updateCartInLocalStorage();
                                            displayCart();
                                            updateTotalPrice(); // Update total price
                                        });

                                        quantityControls.appendChild(quantityMinus);
                                        quantityControls.appendChild(quantityInput);
                                        quantityControls.appendChild(quantityPlus);

                                        const productPrice = document.createElement('p');
                                        productPrice.classList.add('product-price');
                                        productPrice.textContent = `${item.price} {{ $settings->currency }}`;

                                        productActions.appendChild(quantityControls);
                                        productActions.appendChild(productPrice);

                                        productDetails.appendChild(productTitle);
                                        productDetails.appendChild(productInfo);
                                        productDetails.appendChild(productActions);

                                        productItem.appendChild(productImageLink);
                                        productItem.appendChild(productDetails);

                                        // Append the product item to the container
                                        productContainer.appendChild(productItem);
                                    });

                                    // Update the total price when the cart is displayed
                                    updateTotalPrice();
                                }

                                // Function to calculate and update the total price
                                function updateTotalPrice() {
                                    let total = 0;
                                    cart.forEach(item => {
                                        total += parseFloat(item.price) * item.quantity; // Ensure price is treated as a number
                                    });

                                    // Update the subtotal in the footer
                                    if (subtotalElement) {
                                        subtotalElement.textContent = total.toFixed(2) + " {{ $settings->currency }}";
                                    }

                                    // Check if the cart is empty
                                    if (total === 0) {
                                        // Hide the footer section and show the "Cart is empty" message
                                        cartFooter.innerHTML = `<h3 class="empty-cart">Your cart is empty</h3>`;
                                    } else {
                                        // Show the regular footer with cart details and checkout button
                                        cartFooter.innerHTML = `
                                                    <div data-discounts=""></div>
                                                    <div class="cart__item-sub cart__item-row">
                                                        <div class="ajaxcart__subtotal">Sous-total</div>
                                                        <div data-subtotal="${total.toFixed(2)} {{ $settings->currency }}">${total.toFixed(2)} {{ $settings->currency }}</div>
                                                    </div>
                                                    <div class="cart__item-row text-center">
                                                        <small>Les codes promo, les frais d'envoi et les taxes seront ajoutés à la caisse.<br></small>
                                                    </div>
                                                    <div class="cart__checkout-wrapper">
                                                        <a href="{{ route('checkoutt', ['lang' => app()->getLocale()]) }}">
                                                            <button type="button" name="checkout" 
                                                                data-terms-required="false" class="btn cart__checkout">
                                                                Procéder au paiement
                                                            </button>
                                                        </a>
                                                    </div>
                                                `;
                                    }
                                }

                                // Function to update cart in localStorage
                                function updateCartInLocalStorage() {
                                    localStorage.setItem('cart', JSON.stringify(cart));
                                }

                                // Function to remove product from the cart
                                function removeProductFromCart(itemToRemove) {
                                    itemToRemove.quantity = 0;
                                    updateCartInDatabase(itemToRemove);
                                    // Filter out the product with matching ID and unit
                                    cart = cart.filter(item => item.id !== itemToRemove.id || item.unit !== itemToRemove.unit);
                                    updateCartInLocalStorage();
                                    console.log('Removing product from cart finished');
                                }

                                // Function to update cart item in the database
                                function updateCartInDatabase(item) {
                                    if (item.unit) {
                                        @if (Auth::check())
                                            fetch(`/add-to-cart/${item.id}`, {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                    },
                                                    body: JSON.stringify({
                                                        id: item.id,
                                                        name: item.name,
                                                        image: item.image,
                                                        quantity: item.quantity,
                                                        price: item.price,
                                                        unit: item.unit
                                                    })
                                                })
                                                .then(response => {
                                                    if (response.ok) {
                                                        return response.json();
                                                    } else {
                                                        throw new Error('Failed to update item in the database.');
                                                    }
                                                })
                                                .then(data => {
                                                    console.log('Item updated in the database successfully!', data);
                                                })
                                                .catch(error => console.error('Error:', error));
                                        @else
                                            console.log('User not authenticated. Database update skipped.');
                                        @endif
                                    } else {
                                        console.log('Item has no units left, not updating in database.');
                                    }
                                }

                                // Call the function to display the cart when the page loads
                                displayCart();
                            });
                        </script>
                        <div class="drawer__footer appear-delay-4">
                            <div data-discounts="">


                            </div>

                            <div class="cart__item-sub cart__item-row">
                                <div class="ajaxcart__subtotal">Sous-total</div>
                                <div data-subtotal="">0.00 {{ $settings->currency }}</div>
                            </div>

                            <div class="cart__item-row text-center">
                                <small>
                                    Les codes promo, les frais d'envoi et les taxes seront ajoutés à la caisse.<br>
                                </small>
                            </div>



                            <div class="cart__checkout-wrapper">
                                <button type="submit" name="checkout" data-terms-required="false"
                                    class="btn cart__checkout">
                                    Procéder au paiement
                                </button>


                            </div>
                        </div>
                    </div>
                </form>
            @endauth


        </div>
    </div>

    <script>
        // Get references to elements
        const openDrawerBtn = document.getElementById("openDrawerBtn");
        const closeDrawerBtn = document.getElementById("closeDrawerBtn");
        const drawer = document.getElementById("drawer");
        const overlaydrawer = document.getElementById("overlaydrawer");

        // Open drawer and show overlay
        openDrawerBtn.addEventListener("click", () => {
            drawer.style.right = "0"; // Slide the drawer in
            overlaydrawer.style.display = "block"; // Show the overlay
            document.body.style.overflow = "hidden"; // Disable scrolling
        });

        // Close drawer and hide overlay
        const closeDrawer = () => {
            drawer.style.right = "-100%"; // Slide the drawer out
            overlaydrawer.style.display = "none"; // Hide the overlay
            document.body.style.overflow = ""; // Enable scrolling
        };

        closeDrawerBtn.addEventListener("click", closeDrawer);
        overlaydrawer.addEventListener("click", closeDrawer); // Allow clicking the overlay to close the drawer
    </script>




    <div id="shop-section-footer-promotions" class="shop-section index-section--footer">
    </div>
    <div id="shop-section-footer" class="shop-section">

        <footer class="site-footer" data-section-id="footer" data-section-type="footer-section">
            <div class="page-width">

                <div class="grid">
                    <div class="grid__item footer__item--1494301487049" data-type="menu">

                        <div>
                            <div class="collapsible-content__inner">
                                <div class="footer__collapsible footer_collapsible--disabled">
                                    <ul class="no-bullets site-footer__linklist" style="
    text-align-last: left;
">
                                        <li><a href="#">Chercher sur le site</a></li>
                                        <li><a
                                                href="{{ route('contact', ['lang' => app()->getLocale()]) }}">Contact</a>
                                        </li>
                                        <li><a href="{{ route('apropos', ['lang' => app()->getLocale()]) }}">A propos
                                                de Tiyya</a></li>
                                        <li><a
                                                href="{{ route('terms-of-service', ['lang' => app()->getLocale()]) }}">terms</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid__item footer__item--1494292487693" data-type="newsletter">
                        <style>
                            .site-footer {
                                border-top: 1px solid #e8e8e1;
                                font-size: 15px !important;
                                text-align-last: center;
                            }

                            .site-nav__link,
                            .site-nav__dropdown-link:not(.site-nav__dropdown-link--top-level) {
                                font-size: 12px;
                            }

                            .site-nav__link,
                            .mobile-nav__link--top-level {
                                text-transform: uppercase;
                                letter-spacing: 0.2em;
                            }

                            .mobile-nav__link--top-level {
                                font-size: 1.1em;
                            }

                            .header-item--logo,
                            .header-layout--left-center .header-item--logo,
                            .header-layout--left-center .header-item--icons {
                                flex: 0 1 110px;
                            }

                            @media only screen and (min-width: 769px) {

                                .header-item--logo,
                                .header-layout--left-center .header-item--logo,
                                .header-layout--left-center .header-item--icons {
                                    flex: 0 0 120px;
                                }

                                .site-header__logo a {
                                    width: 120px;
                                }

                                .is-light .site-header__logo .logo--inverted {
                                    width: 120px;
                                }
                            }

                            .site-header__logo a {
                                width: 110px;
                            }

                            .is-light .site-header__logo .logo--inverted {
                                width: 110px;
                            }

                            @media only screen and (min-width: 769px) and (max-width: 959px) {

                                .footer__item--1494301487049,
                                .footer__item--1494292487693,
                                .footer__item--1494301487048 {
                                    width: 50%;
                                    padding-top: 40px;
                                    texte-align: center;
                                }

                                .footer__item--1494301487049:nth-child(2n + 1),
                                .footer__item--1494292487693:nth-child(2n + 1),
                                .footer__item--1494301487048:nth-child(2n + 1) {
                                    clear: left;
                                }
                            }

                            @media only screen and (min-width: 960px) {

                                .footer__item--1494301487049,
                                .footer__item--1494292487693,
                                .footer__item--1494301487048 {
                                    width: 25%;
                                }
                            }

                            .footer__logo a {
                                height: 120px;
                            }
                        </style>
                        <div class="footer__item-padding">
                            <p class="h4 footer__title small--hide">Newsletter</p>
                            <button type="button"
                                class="h4 footer__title collapsible-trigger collapsible-trigger-btn medium-up--hide"
                                aria-controls="Footer-1494292487693">
                                Newsletter
                                <span class="collapsible-trigger__icon collapsible-trigger__icon--open"
                                    role="presentation">
                                    <svg aria-hidden="true" focusable="false" role="presentation"
                                        class="icon icon--wide icon-chevron-down" viewBox="0 0 28 16">
                                        <path d="M1.57 1.59l12.76 12.77L27.1 1.59" stroke-width="2" stroke="#000"
                                            fill="none" fill-rule="evenodd" />
                                    </svg>
                                </span>
                            </button>
                            <div id="Footer-1494292487693" class="collapsible-content collapsible-content--small">
                                <div class="collapsible-content__inner">
                                    <div class="footer__collapsible">
                                        <p style="
    text-align-last: left;
">Découvrez en avant-première nos offres INCROYABLES et nouveautés,
                                            inscrivez-vous pour suivre toute l’actualité Tiyya !</p>
                                        <form method="post" id="newsletter-footer" accept-charset="UTF-8"
                                            class="contact-form"><input type="hidden" name="form_type"
                                                value="customer" /><input type="hidden" name="utf8"
                                                value="✓" /><label for="Email-1494292487693"
                                                class="hidden-label">Votre email</label>
                                            <input type="hidden" name="contact[tags]" value="prospect,newsletter">
                                            <input type="hidden" name="contact[context]" value="footer">
                                            <div class="footer__newsletter">
                                                <input type="email" value="" placeholder="Votre email"
                                                    name="contact[email]" id="Email-1494292487693"
                                                    class="footer__newsletter-input" autocorrect="off"
                                                    autocapitalize="off">
                                                <button type="submit" class="footer__newsletter-btn" name="commit"
                                                    aria-label="S&#39;inscrire">
                                                    <svg aria-hidden="true" focusable="false" role="presentation"
                                                        class="icon icon-email" viewBox="0 0 64 64">
                                                        <path
                                                            d="M63 52H1V12h62zM1 12l25.68 24h9.72L63 12M21.82 31.68L1.56 51.16m60.78.78L41.27 31.68" />
                                                    </svg>
                                                    <span class="footer__newsletter-btn-label">
                                                        S&#39;inscrire
                                                    </span>
                                                </button>
                                            </div>
                                        </form>
                                        <ul class="no-bullets footer__social">
                                            <li>
                                                <a target="_blank" rel="noopener" href="https://www.instagram.com/tiyya.mr/"
                                                    title="Tiyya Shop sur Instagram">
                                                    <svg aria-hidden="true" focusable="false" role="presentation"
                                                        class="icon icon-instagram" viewBox="0 0 32 32">
                                                        <path fill="#444"
                                                            d="M16 3.094c4.206 0 4.7.019 6.363.094 1.538.069 2.369.325 2.925.544.738.287 1.262.625 1.813 1.175s.894 1.075 1.175 1.813c.212.556.475 1.387.544 2.925.075 1.662.094 2.156.094 6.363s-.019 4.7-.094 6.363c-.069 1.538-.325 2.369-.544 2.925-.288.738-.625 1.262-1.175 1.813s-1.075.894-1.813 1.175c-.556.212-1.387.475-2.925.544-1.663.075-2.156.094-6.363.094s-4.7-.019-6.363-.094c-1.537-.069-2.369-.325-2.925-.544-.737-.288-1.263-.625-1.813-1.175s-.894-1.075-1.175-1.813c-.212-.556-.475-1.387-.544-2.925-.075-1.663-.094-2.156-.094-6.363s.019-4.7.094-6.363c.069-1.537.325-2.369.544-2.925.287-.737.625-1.263 1.175-1.813s1.075-.894 1.813-1.175c.556-.212 1.388-.475 2.925-.544 1.662-.081 2.156-.094 6.363-.094zm0-2.838c-4.275 0-4.813.019-6.494.094-1.675.075-2.819.344-3.819.731-1.037.4-1.913.944-2.788 1.819S1.486 4.656 1.08 5.688c-.387 1-.656 2.144-.731 3.825-.075 1.675-.094 2.213-.094 6.488s.019 4.813.094 6.494c.075 1.675.344 2.819.731 3.825.4 1.038.944 1.913 1.819 2.788s1.756 1.413 2.788 1.819c1 .387 2.144.656 3.825.731s2.213.094 6.494.094 4.813-.019 6.494-.094c1.675-.075 2.819-.344 3.825-.731 1.038-.4 1.913-.944 2.788-1.819s1.413-1.756 1.819-2.788c.387-1 .656-2.144.731-3.825s.094-2.212.094-6.494-.019-4.813-.094-6.494c-.075-1.675-.344-2.819-.731-3.825-.4-1.038-.944-1.913-1.819-2.788s-1.756-1.413-2.788-1.819c-1-.387-2.144-.656-3.825-.731C20.812.275 20.275.256 16 .256z" />
                                                        <path fill="#444"
                                                            d="M16 7.912a8.088 8.088 0 0 0 0 16.175c4.463 0 8.087-3.625 8.087-8.088s-3.625-8.088-8.088-8.088zm0 13.338a5.25 5.25 0 1 1 0-10.5 5.25 5.25 0 1 1 0 10.5zM26.294 7.594a1.887 1.887 0 1 1-3.774.002 1.887 1.887 0 0 1 3.774-.003z" />
                                                    </svg>
                                                    <span class="icon__fallback-text">Instagram</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a target="_blank" rel="noopener" href="https://web.facebook.com/profile.php?id=61570191375582"
                                                    title="Tiyya Shop sur Facebook">
                                                    <svg aria-hidden="true" focusable="false" role="presentation"
                                                        class="icon icon-facebook" viewBox="0 0 14222 14222">
                                                        <path
                                                            d="M14222 7112c0 3549.352-2600.418 6491.344-6000 7024.72V9168h1657l315-2056H8222V5778c0-562 275-1111 1159-1111h897V2917s-814-139-1592-139c-1624 0-2686 984-2686 2767v1567H4194v2056h1806v4968.72C2600.418 13603.344 0 10661.352 0 7112 0 3184.703 3183.703 1 7111 1s7111 3183.703 7111 7111zm-8222 7025c362 57 733 86 1111 86-377.945 0-749.003-29.485-1111-86.28zm2222 0v-.28a7107.458 7107.458 0 0 1-167.717 24.267A7407.158 7407.158 0 0 0 8222 14137zm-167.717 23.987C7745.664 14201.89 7430.797 14223 7111 14223c319.843 0 634.675-21.479 943.283-62.013z" />
                                                    </svg>
                                                    <span class="icon__fallback-text">Facebook</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid__item footer__item--1494301487048" data-type="logo_social">

                        <div class="footer__logo">
                            <a href="{{ url('/') }}">
                                <img src="https://tiyyashop.ma/cdn/shop/files/LOGO_Tiyya_HD_120x@2x.png"
                                    alt="Tiyya Shop">
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </footer>


    </div>
    </div>
    </div>
    <div id="shop-section-newsletter-popup" class="shop-section index-section--hidden">
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            console.log("cart: ", cart);

            // Check if the user is authenticated (pass this from Blade)
            const isAuthenticated = @json(auth()->check());

            if (isAuthenticated && cart.length > 0) {
                fetch('{{ route('cart.sync') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            cart: cart
                        }),
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to sync cart.');
                        }
                        return response.json(); // Parse response as JSON
                    })
                    .then(data => {
                        console.log("Response data: ", data);
                        if (data.success) {
                            console.log("Cart synced successfully");
                        } else {
                            console.log("Cart sync failed");
                        }
                    })
                    .catch(error => {
                        console.error('Error syncing cart:', error);
                    });
            }
        });
    </script>


</body>

</html>
