@extends('tiyya.index')
@section('content')
<head><title>
    {{ $category->category_name }}    
</title></head>
<div>
    <div id="shop-section-template--15972021698810__collection-header" class="shop-section">
        <style>
            #CollectionHeaderSection {
                position: relative;
                overflow: hidden;
            }

            .collection-hero__content {
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                align-items: center;
                justify-content: center;
                background: rgb(0 0 0 / 8%);
                color: #fff;
                animation: slideIn 1s ease forwards;
                z-index: 1;
            }

            .collection-hero__image {
                z-index: 0;
            }

            @keyframes slideIn {
                from {
                    left: -100%;
                }

                to {
                    left: 0;
                }
            }
            .section-header__title {
    margin: 0;
    font-size: 49px;
    text-align: center;
    text-transform: uppercase;
}

@media (max-width: 768px) {
    .section-header__title {
        font-size: 30px;
    }
}
            

            .collection-grid__wrapper {
                margin-top: 80px;
            }
        </style>

        <div id="CollectionHeaderSection" data-section-id="template--15972021698810__collection-header"
            data-section-type="collection-header">
            <div class="collection-hero">
                <img class="collection-hero__image image-fit lazyload" style="display: block; width: 100%; height: 420px;"
                    src="{{ asset( $category->image) }}" data-aspectratio="1.7777777777777777"
                    data-widths="[720, 900, 1080, 1800, 2400]" data-sizes="auto" alt="Soins Exfoliants">

                <div class="collection-hero__content">
                    <div class="page-width">
                        <header class="section-header section-header--hero">
                            <div class="section-header__shadow">
                                <h1 class="section-header__title">{{ $category->category_name }}</h1>
                            </div>
                        </header>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div id="shop-section-template--15972021698810__main-collection" class="shop-section">
        <div class="collection-content" data-section-id="template--15972021698810__main-collection"
            data-section-type="collection-grid">
            <div id="CollectionAjaxContent">
                <div class="page-width">
                    <div class="grid">
                        <div class="grid__item medium-up--one-fifth grid__item--sidebar">
                            <div id="CollectionSidebar" data-style="sidebar">
                                <div class="collection-sidebar small--hide">
                                    <ul class="no-bullets tag-list tag-list--active-tags"></ul>
                                    <form class="filter-form">
                                        <div class="collection-sidebar__group--1">
                                            <div class="collection-sidebar__group">
                                                <button type="button"
                                                    class="collapsible-trigger collapsible-trigger-btn collapsible--auto-height tag-list__header"
                                                    aria-controls="CollectionSidebar-1-filter-prix"
                                                    data-collapsible-id="filter-prix">
                                                   {{ __('category.price') }}
                                                    <span
                                                        class="collapsible-trigger__icon collapsible-trigger__icon--open"
                                                        role="presentation">
                                                        <svg aria-hidden="true" focusable="false" role="presentation"
                                                            class="icon icon--wide icon-chevron-down"
                                                            viewBox="0 0 28 16">
                                                            <path d="M1.57 1.59l12.76 12.77L27.1 1.59" stroke-width="2"
                                                                stroke="#000" fill="none" fill-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                </button>
                                                <div id="CollectionSidebar-1-filter-prix"
                                                    class="collapsible-content collapsible-content--sidebar"
                                                    data-collapsible-id="filter-prix">
                                                    <div class="collapsible-content__inner">

                                                        <div class="price-range" data-min-value=""
                                                            data-min-name="filter.v.price.gte" data-min=""
                                                            data-max-value="215.00" data-max-name="filter.v.price.lte"
                                                            data-max="215.00">
                                                            <div class="price-range__display-wrapper">
                                                                <span class="price-range__display-min">0</span>
                                                                <span class="price-range__display-max">215</span>
                                                            </div>
                                                            <div class="price-range__slider-wrapper">
                                                                <div class="price-range__slider"></div>
                                                            </div>
                                                            <input class="price-range__input price-range__input-min"
                                                                name="filter.v.price.gte" value="" readonly>
                                                            <input class="price-range__input price-range__input-max"
                                                                name="filter.v.price.lte" value="" readonly>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="grid__item medium-up--four-fifths grid__item--content">
                            <div></div>
                            <div>
                            </div>
                            <style>
                                /* Styles for Filter Drawer */
                                body.drawer-open {
                                    overflow: hidden;

                                }

                                #FilterDrawer {

                                    top: 0;
                                    left: 0;
                                    height: 100%;
                                    background-color: rgba(0, 0, 0, 0.8);
                                    color: white;
                                    width: 70% !important;
                                    transform: translateX(-100%);
                                    transition: transform 0.3s ease-in-out;
                                    z-index: 100000;
                                }

                                #FilterDrawer.drawer--is-open {
                                    transform: translateX(0);
                                }

                                .drawer__contents {
                                    padding: 0px;
                                    background: white;
                                    color: black;
                                    height: 100%;
                                    width: 100% !important;
                                }

                                .drawer-overlay {
                                    position: fixed;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 100%;
                                    background-color: rgba(0, 0, 0, 0.5);
                                    z-index: 999;
                                    display: none;
                                }

                                .drawer-overlay.active {
                                    display: block;
                                }

                                /* Image hover effect */
                                .grid-product__image:hover {
                                    transform: scale(1.2);
                                    transition: transform 0.3s ease;
                                }

                                @media screen and (min-width: 769px) {
                                    .collection-filter__item--drawer {
                                        display: none;
                                    }

                                    .collection-filter__item--count {
                                        text-align: left;
                                    }

                                    html[dir="rtl"] .collection-filter__item--count {
                                        text-align: right;
                                    }
                                }

                                .collection-filter {
                                    margin-bottom: 40px !important;
                                }
                            </style>

                            <div data-scroll-to>
                                <div class="collection-grid__wrapper">
                                    <div class="collection-filter">
                                        <!-- Drawer Toggle Button -->
                                        <div class="collection-filter__item collection-filter__item--drawer">
                                            <button type="button" id="toggleDrawerButton" class="btn btn--tertiary">
                                                <svg aria-hidden="true" focusable="false" role="presentation"
                                                    class="icon icon-filter" viewBox="0 0 64 64">
                                                    <path
                                                        d="M48 42h10M48 42a5 5 0 1 1-5-5 5 5 0 0 1 5 5zM7 42h31M16 22H6M16 22a5 5 0 1 1 5 5 5 5 0 0 1-5-5zM57 22H26" />
                                                </svg>
                                                 {{ __('category.filter') }}
                                            </button>
                                        </div>

                                        <!-- Filter Drawer -->
                                        <div id="FilterDrawer" class="drawer">
                                            <div class="drawer__contents">

                                                <div class="drawer__fixed-header">
                                                    <div class="drawer__header  ">
                                                        <div class="h2 drawer__title">
                                                        {{ __('category.filter') }}
                                                        </div>
                                                        <div class="drawer__close">
                                                            <button type="button" id="closeDrawerButton"
                                                                class="drawer__close-button js-drawer-close">
                                                                <svg aria-hidden="true" focusable="false"
                                                                    role="presentation" class="icon icon-close"
                                                                    viewBox="0 0 64 64">
                                                                    <path d="M19 17.61l27.12 27.13m0-27.12L19 44.74">
                                                                    </path>
                                                                </svg>
                                                                <span class="icon__fallback-text"> {{ __('category.close_menu') }}</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="drawer__scrollable  appear-delay-2">

                                                    <ul class="no-bullets tag-list tag-list--active-tags"></ul>

                                                    <form class="filter-form">
                                                        <div class="collection-sidebar__group--1">
                                                            <div class="collection-sidebar__group">
                                                                <button type="button"
                                                                    class="collapsible-trigger collapsible-trigger-btn collapsible--auto-height tag-list__header"
                                                                    aria-controls="SidebarDrawer-1-filter-prix"
                                                                    data-collapsible-id="filter-prix"
                                                                    aria-expanded="false">
                                                                    {{ __('category.price') }}
                                                                    <span
                                                                        class="collapsible-trigger__icon collapsible-trigger__icon--open"
                                                                        role="presentation">
                                                                        <svg aria-hidden="true" focusable="false"
                                                                            role="presentation"
                                                                            class="icon icon--wide icon-chevron-down"
                                                                            viewBox="0 0 28 16">
                                                                            <path d="M1.57 1.59l12.76 12.77L27.1 1.59"
                                                                                stroke-width="2" stroke="#000"
                                                                                fill="none" fill-rule="evenodd">
                                                                            </path>
                                                                        </svg>
                                                                    </span>
                                                                </button>
                                                                <div id="SidebarDrawer-1-filter-prix"
                                                                    class="collapsible-content collapsible-content--sidebar"
                                                                    data-collapsible-id="filter-prix">
                                                                    <div class="collapsible-content__inner">

                                                                        <div class="price-range" data-min-value=""
                                                                            data-min-name="filter.v.price.gte"
                                                                            data-min="" data-max-value=""
                                                                            data-max-name="filter.v.price.lte"
                                                                            data-max="95.00">
                                                                            <div class="price-range__display-wrapper">
                                                                                <span
                                                                                    class="price-range__display-min">0.00
                                                                                    dh</span>
                                                                                <span
                                                                                    class="price-range__display-max">95.00
                                                                                    dh</span>
                                                                            </div>
                                                                            <div class="price-range__slider-wrapper">
                                                                                <div
                                                                                    class="price-range__slider noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr">
                                                                                    <div class="noUi-base">
                                                                                        <div class="noUi-connects">
                                                                                            <div class="noUi-connect"
                                                                                                style="transform: translate(0%) scale(1);">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="noUi-origin"
                                                                                            style="transform: translate(-1000%); z-index: 5;">
                                                                                            <div class="noUi-handle noUi-handle-lower"
                                                                                                data-handle="0"
                                                                                                tabindex="0"
                                                                                                role="slider"
                                                                                                aria-orientation="horizontal"
                                                                                                aria-valuemin="0.0"
                                                                                                aria-valuemax="95.0"
                                                                                                aria-valuenow="0.0"
                                                                                                aria-valuetext="0.00">
                                                                                                <div
                                                                                                    class="noUi-touch-area">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="noUi-origin"
                                                                                            style="transform: translate(0%); z-index: 4;">
                                                                                            <div class="noUi-handle noUi-handle-upper"
                                                                                                data-handle="1"
                                                                                                tabindex="0"
                                                                                                role="slider"
                                                                                                aria-orientation="horizontal"
                                                                                                aria-valuemin="0.0"
                                                                                                aria-valuemax="95.0"
                                                                                                aria-valuenow="95.0"
                                                                                                aria-valuetext="95.00">
                                                                                                <div
                                                                                                    class="noUi-touch-area">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <input
                                                                                class="price-range__input price-range__input-min"
                                                                                name="filter.v.price.gte"
                                                                                value="" readonly="">
                                                                            <input
                                                                                class="price-range__input price-range__input-max"
                                                                                name="filter.v.price.lte"
                                                                                value="" readonly="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>



                                            </div>
                                        </div>
                                        <div class="drawer-overlay" id="drawerOverlay"></div>

                                        <!-- Item Count -->
                                        <div
                                            class="collection-filter__item collection-filter__item--count small--hide">
                                            {{ $category->products->count() }}   {{ __('category.articles') }}
                                        </div>

                                        <!-- Sort Options -->

                                        <div>
                                            <div>
                                                <select id="storFF">
                                                    <option value="title-ascending">{{ __('category.alphabetical_a_z') }}</option>
                                                    <option value="title-descending">{{ __('category.alphabetical_z_a') }}</option>
                                                    <option value="price-ascending">{{ __('category.price_low_high') }}</option>
                                                    <option value="price-descending">{{ __('category.price_high_low') }}</option>
                                                    <option value="created-ascending">{{ __('category.date_old_new') }}</option>
                                                    <option value="created-descending">{{ __('category.date_new_old') }}</option>
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            const sortSelect = document.getElementById("storFF");
                                            const productGrid = document.querySelector(".grid.grid--uniform");

                                            // Event listener for sort dropdown
                                            sortSelect.addEventListener("change", function() {
                                                const sortValue = sortSelect.value;
                                                const products = Array.from(productGrid.children);

                                                const getValue = (product, key) => {
                                                    switch (key) {
                                                        case "title":
                                                            return product.querySelector(".grid-product__title").textContent.trim();
                                                        case "price":
                                                            return parseFloat(product.querySelector(".grid-product__price").textContent
                                                                .trim().replace(/[^0-9.-]+/g, ""));
                                                        case "created":
                                                            // Assuming data-created is added to products for sorting by date
                                                            return new Date(product.getAttribute("data-created"));
                                                        default:
                                                            return "";
                                                    }
                                                };

                                                // Sorting logic
                                                products.sort((a, b) => {
                                                    const [key, order] = sortValue.split("-");
                                                    const valueA = getValue(a, key);
                                                    const valueB = getValue(b, key);

                                                    if (valueA < valueB) return order === "ascending" ? -1 : 1;
                                                    if (valueA > valueB) return order === "ascending" ? 1 : -1;
                                                    return 0;
                                                });

                                                // Append sorted products back to the grid
                                                productGrid.innerHTML = "";
                                                products.forEach((product) => productGrid.appendChild(product));
                                            });
                                        });
                                    </script>


                                    <!-- Product Grid -->
                                    <div class="grid grid--uniform">
                                        @foreach ($category->products as $product)
                                            @if ($product->images->isNotEmpty() && $product->images->first()->image_path)
                                                <div class="grid__item grid-product small--one-half medium-up--one-quarter"
                                                    data-aos="row-of-4">
                                                    <div class="grid-product__content">
                                                        <a href="{{ route('productDetails', ['lang' => app()->getLocale(), 'id' => $product->id]) }}"
                                                            class="grid-product__link">
                                                            <div class="grid-product__image-mask">
                                                                <div class="image-wrap"
                                                                    style="height: 0; padding-bottom: 66.625%;">
                                                                    <img class="grid-product__image lazyload"
                                                                        src="{{ asset( $product->images->first()->image_path) }}"
                                                                        data-aspectratio="1.5009380863039399"
                                                                        data-sizes="auto"
                                                                        alt="{{ $product->title }}" />
                                                                </div>
                                                            </div>
                                                            <center>
                                                                <div class="grid-product__meta">
                                                                    <div
                                                                        class="grid-product__title grid-product__title--body">
                                                                        {{ $product->title }}
                                                                    </div>
                                                                    <div class="grid-product__price">
                                                                        {{ $product->units->first()->price }} {{$settings->currency}} 
                                                                    </div>
                                                                </div>
                                                            </center>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <script>
                                const toggleDrawerButton = document.getElementById('toggleDrawerButton');
                                const closeDrawerButton = document.getElementById('closeDrawerButton');
                                const filterDrawer = document.getElementById('FilterDrawer');
                                const drawerOverlay = document.getElementById('drawerOverlay');
                                const header = document.querySelector('header'); // Assuming the header element is <header>

                                toggleDrawerButton.addEventListener('click', () => {
                                    filterDrawer.classList.add('drawer--is-open');
                                    drawerOverlay.classList.add('active');
                                    document.body.classList.add('drawer-open');

                                    // Remove display: flexi from the header when the drawer is open
                                    if (header) {
                                        header.style.display = 'none'; // or any other style you want when drawer is open
                                    }
                                });

                                closeDrawerButton.addEventListener('click', () => {
                                    filterDrawer.classList.remove('drawer--is-open');
                                    drawerOverlay.classList.remove('active');
                                    document.body.classList.remove('drawer-open');

                                    // Reset the header display style when the drawer is closed
                                    if (header) {
                                        header.style.display = ''; // or the default value you want
                                    }
                                });

                                drawerOverlay.addEventListener('click', () => {
                                    filterDrawer.classList.remove('drawer--is-open');
                                    drawerOverlay.classList.remove('active');
                                    document.body.classList.remove('drawer-open');

                                    // Reset the header display style when the drawer is closed
                                    if (header) {
                                        header.style.display = 'none'; // or the default value you want
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
</main>
@endsection