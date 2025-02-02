@extends('tiyya.index')
@section('content')
<head><title>
    home    
</title></head>
    <div >
        @if (session('clear_cart'))
            <script>
                    localStorage.removeItem('cart');
                    console.log('Cart cleared from localStorage');
            </script>
        @endif
        <div id="shop-section-template--15972021797114__slideshow" class="shop-section index-section--hero">
            <div data-section-id="template--15972021797114__slideshow" data-section-type="slideshow-section">
                <div class="slideshow-wrapper" style="z-index: 9999999999999">
                  
                    <button type="button" class="visually-hidden slideshow__pause"
                        data-id="template--15972021797114__slideshow" aria-live="polite">
                        <span class="slideshow__pause-stop"><svg aria-hidden="true" focusable="false" role="presentation"
                                class="icon icon-pause" viewBox="0 0 10 13">
                                <g fill="#000" fill-rule="evenodd">
                                    <path d="M0 0h3v13H0zM7 0h3v13H7z" />
                                </g>
                            </svg><span class="icon__fallback-text">Diaporama Pause</span></span><span
                            class="slideshow__pause-play"><svg aria-hidden="true" focusable="false" role="presentation"
                                class="icon icon-play" viewBox="18.24 17.35 24.52 28.3">
                                <path fill="#323232" d="M22.1 19.151v25.5l20.4-13.489-20.4-12.011z" />
                            </svg><span class="icon__fallback-text">Lire le diaporama</span></span>
                    </button>
                    <div class="">
                        <div id="Slideshow-template--15972021797114__slideshow"
                            class="hero hero--650px hero--template--15972021797114__slideshow hero--mobile--auto loading loading--delayed"
                            data-mobile-natural="false" data-autoplay="true" data-speed="5000" data-dots="true"
                            data-bars="true" data-slide-count="2">
                            <div class="slideshow__slide slideshow__slide--slideshow-0" data-index="0"
                                data-id="slideshow-0">
                                <style data-shop>
                                    .slideshow__slide--slideshow-0 .hero__title {
                                        font-size: 20px;
                                    }

                                    @media only screen and (min-width: 769px) {
                                        .slideshow__slide--slideshow-0 .hero__title {
                                            font-size: 40px;
                                        }
                                    }

                                    .slideshow__slide--slideshow-0 .btn {
                                        background: #e0f4e1 !important;
                                        border: none;
                                        color: #000 !important;
                                    }
                                </style>
                                
                                <div class="hero__image-wrapper">
                                    <img class="hero__image hero__image--slideshow-0 lazyload"
                                        src="https://tiyyashop.ma/cdn/shop/files/hv_8.jpg?v=1732881194"
                                        data-aspectratio="1.3275862068965518" data-sizes="auto" alt=""
                                        style="object-position: center center" /><noscript>
                                        <img class="hero__image hero__image--slideshow-0"
                                            src="https://tiyyashop.ma/cdn/shop/files/hv_8.jpg?v=1732881194" alt="" />
                                    </noscript>
                                </div>
                                <div class="hero__text-wrap">
                                    <div class="page-width">
                                        <div class="hero__text-content vertical-center horizontal-left">
                                            <div class="hero__text-shadow">
                                                <h2 class="h1 hero__title">
                                                    <div class="animation-cropper">
                                                        <div class="animation-contents">
                                                             {{ __('home.discover_new_products') }}<br />
                                                            {{ __('home.plant_oils_range') }}
                                                        </div>
                                                    </div>
                                                </h2>
                                                <div class="hero__subtitle">
                                                    <div class="animation-cropper">
                                                        <div class="animation-contents">
                                                            {{ __('home.pure_essence_nature') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hero__link">
                                                    <a href="category/nouvotes" class="btn">
                                                        {{ __('home.new_products') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slideshow__slide slideshow__slide--image_aMVNnD" data-index="1"
                                data-id="image_aMVNnD">
                                <style data-shop>
                                    .slideshow__slide--image_aMVNnD .hero__title {
                                        font-size: 20px;
                                    }

                                    @media only screen and (min-width: 769px) {
                                        .slideshow__slide--image_aMVNnD .hero__title {
                                            font-size: 40px;
                                        }
                                    }

                                    .slideshow__slide--image_aMVNnD .btn {
                                        background: #e0f4e1 !important;
                                        border: none;
                                        color: #000 !important;
                                    }
                                </style>
                                <div class="hero__image-wrapper">
                                    <img class="hero__image hero__image--image_aMVNnD lazyload"
                                        src="{{asset($featuredProducts->first()->featured_image_path)}}"
                                        data-aspectratio="2.0161637931034484" data-sizes="auto" alt=""
                                        style="object-position: 20% 50%" /><noscript>
                                        <img class="hero__image hero__image--image_aMVNnD"
                                            src="{{asset($featuredProducts->first()->featured_image_path)}}"
                                            alt="{{$featuredProducts}}" />
                                    </noscript>
                                </div>
                                <a href="{{route('productDetails' , ['lang' => app()->getLocale(), 'id' => $featuredProducts->first()->product_id])}}"
                                    class="hero__slide-link" aria-hidden="true"></a>
                                <div class="hero__text-wrap">
                                    <div class="page-width">
                                        <div class="hero__text-content vertical-center horizontal-left">
                                            <div class="hero__text-shadow">
                                                <h2 class="h1 hero__title">
                                                    <div class="animation-cropper">
                                                        <div class="animation-contents">
                                                            {{ __('home.discover_new_products') }}
                                                            :<br />
                                                            {{ __('home.plant_oils_range') }}
                                                        </div>
                                                    </div>
                                                </h2>
                                                <div class="hero__subtitle">
                                                    <div class="animation-cropper">
                                                        <div class="animation-contents">
                                                           {{ __('home.pure_essence_nature') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hero__link">
                                                    <a href="{{route('productDetails' , ['lang' => app()->getLocale(), 'id' => $featuredProducts->first()->product_id])}}"
                                                        class="btn">
                                                        {{$featuredProducts->first()->product->title}}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="shop-section-template--15972021797114__rich-text" class="shop-section index-section">
            <div class="text-center page-width page-width--narrow">
                <div class="theme-block" style="
    font-size: 28px;
">
                    <h2>{{ __('home.richness_moroccan_products') }}</h2>
                </div>
                <div class="theme-block">
                    <div class="rte">
                        <div class="enlarge-text">
                           <p style="
    font-size: 1.28em;
    line-height: 30px;">
                               {{ __('home.products_tiyya_incomparable') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="theme-block">
                    <div class="rte">
                        <a href="{{ route('apropos', ['lang' => app()->getLocale()]) }}" class="btn">
                            {{ __('home.learn_more_tiyya') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="shop-section-template--15972021797114__promo-grid" class="shop-section">
            <style>
                .promo-grid {
                    display: grid;
                    grid-template-columns: repeat(2, 1fr);
                    gap: 20px;
                    margin: 0 auto;
                    max-width: 100%;
                    padding: 0 15px;
                    height: 100vh;
                    margin-bottom: 50px;
                }

                .promo-item {
                    position: relative;
                    overflow: hidden;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    height: 100%;
                    margin-bottom: 50px;
                    /* Margin at the bottom of each item */
                }

                .promo-background {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-size: cover;
                    background-position: center;
                    filter: brightness(90%);
                    transition: filter 0.3s ease;
                }

                .promo-border {
                    position: absolute;
                    top: 10px;
                    left: 10px;
                    right: 10px;
                    bottom: 10px;
                    border: 2px solid #fff;
                    z-index: 1;
                    pointer-events: none;
                }

                .promo-item:hover .promo-background {
                    
                }

                .promo-content {
                    position: absolute;
                    width: 100%;
                    padding: 20px;
                    text-align: center;
                    color: white;
                    z-index: 2;
                    opacity: 0.8;
                    transition: opacity 0.3s ease;
                }

                .promo-heading {
                    font-size: 13px;
    letter-spacing: 4px;
    margin-bottom: 10px;
    text-transform: uppercase;
    margin-top: 25px;
    text-align-last: auto;
                }

                .promo-title {
                    font-size: 1.8rem;
                    margin-bottom: 15px;
                }

                .btn {
                    display: inline-block;
                    text-decoration: none;
                    color: #ffffff;
                    background-color: #ffffff00;
                    padding: 13px 20px;
                    font-size: 12px;
                    font-weight: bold;
                    border: 2px solid #fff;
                    transition: all 0.3s ease;
                }

                
                /* Position the content */
                .promo-item:first-child .promo-content {
                    top: 10px;
                }

                .promo-item:nth-child(2) .promo-content {
                    bottom: 40px;
                }

                @media (max-width: 768px) {
                    .promo-grid {
                        grid-template-columns: 1fr;
                    }
                }
            </style>
            <section class="promo-grid">
                <!-- First Grid Item -->
                <div class="promo-item">
                    <!-- White border -->
                    <div class="promo-border"></div>
                    <!-- Background Image -->
                    <div class="promo-background"
                    style="background-image: url('{{ asset( $featuredProducts[1]->featured_image_path) }}');">
                    </div>
                    <!-- Content -->
                    <div class="promo-content">
                        <p class="promo-heading">{{$featuredProducts[1]->product->title}}</p>
                        <h2 class="promo-title">{{ __('home.radiant_regeneration') }}</h2>
                        <a  href="{{route('productDetails' , ['lang' => app()->getLocale(), 'id' => $featuredProducts[1]->product_id])}}" class="btn">{{ __('home.see_product') }}</a>
                    </div>
                </div>

                <!-- Second Grid Item -->
                <div class="promo-item">
                    <!-- White border -->
                    <div class="promo-border"></div>
                    <!-- Background Image -->
                    <div class="promo-background"       
                    style="background-image: url('{{ asset( $featuredProducts[2]->featured_image_path) }}');"
                    
                        >
                    </div>
                    <!-- Content -->
                    <div class="promo-content">
                        <p class="promo-heading">{{ __('home.oriental_harmony_title') }}</p>
                        <h2 class="promo-title">{{ __('home.oriental_harmony') }}</h2>
                        <a href="{{route('productDetails' , ['lang' => app()->getLocale(), 'id' => $featuredProducts[2]->product_id])}}"  class="btn">{{ __('home.see_selection') }}</a>
                    </div>
                </div>
            </section>
        </div>
        <div id="shop-section-template--15972021797114__1659609468f9ecf62b" class="shop-section index-section--hero">
            <div data-section-id="template--15972021797114__1659609468f9ecf62b" data-section-type="slideshow-section">
                <div class="slideshow-wrapper">
                    <style data-shop>
                        [data-bars][data-autoplay="true"] .flickity-page-dots .dot:after {
                            animation-duration: 5000ms;
                        }
                    </style>
                    <button type="button" class="visually-hidden slideshow__pause"
                        data-id="template--15972021797114__1659609468f9ecf62b" aria-live="polite">
                        <span class="slideshow__pause-stop"><svg aria-hidden="true" focusable="false"
                                role="presentation" class="icon icon-pause" viewBox="0 0 10 13">
                                <g fill="#000" fill-rule="evenodd">
                                    <path d="M0 0h3v13H0zM7 0h3v13H7z" />
                                </g>
                            </svg><span class="icon__fallback-text">Diaporama Pause</span></span><span
                            class="slideshow__pause-play"><svg aria-hidden="true" focusable="false" role="presentation"
                                class="icon icon-play" viewBox="18.24 17.35 24.52 28.3">
                                <path fill="#323232" d="M22.1 19.151v25.5l20.4-13.489-20.4-12.011z" />
                            </svg><span class="icon__fallback-text">Lire le diaporama</span></span>
                    </button>
                    <div class="">
                        <div id="Slideshow-template--15972021797114__1659609468f9ecf62b"
                            class="hero hero--650px hero--template--15972021797114__1659609468f9ecf62b hero--mobile--auto loading loading--delayed"
                            data-mobile-natural="false" data-autoplay="true" data-speed="5000" data-dots="true"
                            data-bars="true" data-slide-count="2">
                            <div class="slideshow__slide slideshow__slide--16596094682a885fe1-1" data-index="0"
                                data-id="16596094682a885fe1-1">
                                <style data-shop>
                                    .slideshow__slide--16596094682a885fe1-1 .hero__title {
                                        font-size: 40px;
                                    }

                                    @media only screen and (min-width: 769px) {
                                        .slideshow__slide--16596094682a885fe1-1 .hero__title {
                                            font-size: 80px;
                                        }
                                    }

                                    .slideshow__slide--16596094682a885fe1-1 .btn {
                                        background: #e0f4e1 !important;
                                        border: none;
                                        color: #000 !important;
                                    }
                                </style>
                                <div class="hero__image-wrapper">
                                    <img class="hero__image hero__image--16596094682a885fe1-1 lazyload"
                                        src="https://tiyyashop.ma/cdn/shop/files/DSC_0059-tiyya-maroc.jpg?v=1659609617"
                                        data-aspectratio="1.5" data-sizes="auto" alt=""
                                        style="object-position: center center" /><noscript>
                                        <img class="hero__image hero__image--16596094682a885fe1-1"
                                            src="https://tiyyashop.ma/cdn/shop/files/DSC_0059-tiyya-maroc.jpg?v=1659609617"
                                            alt="" />
                                    </noscript>
                                </div>
                                <a href="{{$localisation->localisation}}" class="hero__slide-link"
                                    aria-hidden="true"></a>
                                <div class="hero__text-wrap">
                                    <div class="page-width">
                                        <div class="hero__text-content vertical-center horizontal-center">
                                            <div class="hero__text-shadow">
                                                <h2 class="h1 hero__title">
                                                    <div class="animation-cropper">
                                                        <div class="animation-contents">
                                                        {{ __('home.tiyya_shop') }}
                                                        </div>
                                                    </div>
                                                </h2>
                                                <div class="hero__subtitle">
                                                    <div class="animation-cropper">
                                                        <div class="animation-contents">
                                                           {{ __('home.discover_universe') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hero__link">
                                                    <a href="{{$localisation->localisation}}" class="btn">
                                                    {{ __('home.location') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slideshow__slide slideshow__slide--16596094682a885fe1-0" data-index="1"
                                data-id="16596094682a885fe1-0">
                                <style data-shop>
                                    .slideshow__slide--16596094682a885fe1-0 .hero__title {
                                        font-size: 40px;
                                    }

                                    @media only screen and (min-width: 769px) {
                                        .slideshow__slide--16596094682a885fe1-0 .hero__title {
                                            font-size: 80px;
                                        }
                                    }

                                    .slideshow__slide--16596094682a885fe1-0 .btn {
                                        background: #e0f4e1 !important;
                                        border: none;
                                        color: #000 !important;
                                    }
                                </style>
                                <div class="hero__image-wrapper">
                                    <img class="hero__image hero__image--16596094682a885fe1-0 lazyload"
                                        src="https://tiyyashop.ma/cdn/shop/files/interieur-shop-tiyya-rabat.jpg?v=1660154914"
                                        data-aspectratio="1.5" data-sizes="auto" alt=""
                                        style="object-position: center center" /><noscript>
                                        <img class="hero__image hero__image--16596094682a885fe1-0"
                                            src="https://tiyyashop.ma/cdn/shop/files/interieur-shop-tiyya-rabat.jpg?v=1660154914"
                                            alt="" />
                                    </noscript>
                                </div>
                                <a href="" class="hero__slide-link" aria-hidden="true"></a>
                                <div class="hero__text-wrap">
                                    <div class="page-width">
                                        <div class="hero__text-content vertical-center horizontal-center">
                                            <div class="hero__text-shadow">
                                                <h2 class="h1 hero__title">
                                                    <div class="animation-cropper">
                                                        <div class="animation-contents">
                                                          {{ __('home.tiyya_shop') }}
                                                        </div>
                                                    </div>
                                                </h2>
                                                <div class="hero__subtitle">
                                                    <div class="animation-cropper">
                                                        <div class="animation-contents">
                                                             {{ __('home.discover_universe') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hero__link">
                                                    <a href="" class="btn">
                                                     {{ __('home.location') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="shop-section-template--15972021797114__featured-collections" class="shop-section index-section">
            <style>
                
              
                /* Section Styling */
                .categories {
                  text-align: center;
                padding: 2rem 5.5rem;
                }
                
                
                @media (max-width: 768px) {
              .categories1 {
                  text-align: center;
                padding: 0rem 0rem;
                }
                }
                .categories h2 {
                  font-size: 1.8rem;
                  margin-bottom: 50px;
                  letter-spacing: 0.5px;
                }
              
                /* Grid Layout */
                .category-grid {
                  display: grid;
                  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                  gap: 1.5rem;
                  justify-items: center;
                }
              
                .category-item {
                  position: relative;
                  width: 100%;
                  max-width: 400px;
                  /* Larger size for the cards */
                  height: 335px;
                  /* Fixed height for uniformity */
                  overflow: hidden;
                  background-color: #f7f7f7;
                }
              
                .category-item img {
                  width: 100%;
                  height: 100%;
                  object-fit: cover;
                  display: block;
                  transition: transform 0.9s ease, opacity 0.3s ease;
                  opacity: 0.85;
                  /* Light opacity for the image */
                }
              
                /* Gray Overlayproducts */
                .category-item::before {
                  content: '';
                  position: absolute;
                  top: 0;
                  left: 0;
                  width: 100%;
                  height: 100%;
                  background: rgb(0 0 0 / 9%);
                  /* Gray opacity */
                  z-index: 1;
                  transition: background 0.3s ease;
                }
              
                .overlayproducts {
                  position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    text-align: center;
    z-index: 2;
    transition: opacity 0.3s ease;
    font-size: 18px;
    text-shadow: 0 0 50px #000;
    font-family: 'Questrial';
    font-weight: 600;
    letter-spacing: 0.05rem;
                  
                  text-align: center;
                  z-index: 2;
                  /* Text appears above the overlayproducts */
                  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6);
                  transition: opacity 0.3s ease;
                }
              
                .category-item:hover img {
                  transform: scale(1.1);
                  opacity: 1;
                  /* Fully visible on hover */
                }
              
                .category-item:hover::before {
                  background: rgb(0 0 0 / 25%);
                  /* Darker gray on hover */
                }
              
                @media (max-width: 768px) {
                  .category-grid {
                    grid-template-columns: repeat(2, 1fr);
                    /* 2 items per row on mobile */
                  }
              
                  .category-item {
                    max-width: 180px;
                    /* Smaller width for mobile */
                    height: 150px;
                    /* Smaller height for mobile */
                  }
              
                  .overlayproducts {
                    font-size: 1rem;
                    /* Adjust text size for mobile */
                  }
                }
              </style>
              <section class="categories categories1">
                <h2>{{ __('home.shop_by_category') }}</h2>
                <div class="category-grid">
                    @foreach ( $categoryDisplays as $categoryDisplay )
                    <a href="{{ route('category.page', ['lang' => app()->getLocale(), 'name' => $categoryDisplay->category->category_name]) }}">
                        <div class="category-item">
                        <img src=" {{asset($categoryDisplay->display_image_path)}}" alt="Soins éclat">
                        <div class="overlayproducts">{{$categoryDisplay->category->category_name}}</div>
                      </div>
                       </a>
                    @endforeach
                  
                  
                </div>
              </section>
        </div>
        
    </div>
@endsection