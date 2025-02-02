@extends('tiyya.index')
@section('content')
<head><title>
    carte
</title></head>
    <div>
        <style>
            /* In your CSS file, for example style.css */
            .text-center {
                text-align: center;
            }

            .big-category-title {
                font-size: 1.5em;
                /* Adjust this value as needed */
            }
             .article__grid-meta .article__title {
                display: block;
                }
        </style>

        <div id="shopify-section-template--15972021600506__main" class="shopify-section">
            <div data-section-id="template--15972021600506__main" data-section-type="blog">
                <div class="page-width page-content">
                    <header class="section-header" style="text-align: center;">
                        <h1 class="section-header__title">{{ $categoryData->first()->category ?? 'Category Title' }}</h1>
                    </header>

                    <div class="grid grid--uniform">
                        @foreach ($categoryData as $astuce)
                            <div class="grid__item medium-up--one-third" data-aos="row-of-3">
                                <div class="grid">
                                    <div class="grid__item small--one-third">
                                        <a href="{{route('blog_astuce.showastuce',['lang'=>  app()->getLocale(), 'category_id'=>$astuce->id])}}" class="article__grid-image" aria-label="{{ $astuce->title }}">
                                            <div class="image-wrap">
                                                <img class="lazyloaded" src="{{ asset( $astuce->image) }}"
                                                    alt="{{ $astuce->title }}" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="grid__item small--two-thirds">
                                        <div class="article__grid-meta text-center">
                                            <a href="#" class="article__title">{{ $astuce->title }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div id="shopify-section-template--15972021600506__featured-collections" class="shopify-section index-section">
            <div class="section--divider">
                <div class="page-width">
                    <div class="section-header" style="text-align: center;">
                        <h2 class="section-header__title">Découvrez notre gamme</h2>
                    </div>
                    <div class="grid grid--uniform">
                        @foreach ($game as $category)
                            <div class="grid__item small--one-half medium-up--one-fifth">
                                <a href="#" class="collection-item collection-item--overlaid" data-aos="row-of-5">
                                    <div class="collection-image collection-image--square image-wrap">
                                        <img class="lazyloaded" src="{{ asset( $category->image) }}"
                                            alt="{{ $category->category_name }}" />
                                    </div>
                                    <span
                                        class="collection-item__title collection-item__title--overlaid collection-item__title--body collection-item__title--center text-center big-category-title">
                                        <span>{{ $category->category_name }}</span>
                                    </span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection