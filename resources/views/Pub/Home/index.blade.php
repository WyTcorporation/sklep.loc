@extends('Pub::layouts.content')

@section('content')
    @if ($banners)
        <div class="layout-box layout-box-type-slideshow with-header" id="layout-box-483">
            <section class="section-entry">
                <div class="container">
                    <div
                        class="swiper-container swiper-container-initialized main-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-autoheight">
                        <div class="swiper-wrapper"
                             style="transform: translate3d(-4770px, 0px, 0px); transition-duration: 0ms;"
                             id="swiper-wrapper-fe73d210e98b2c21f" aria-live="off">
                            @php($x=1);
                            @foreach($banners as $banner)
                                <a href="{{$banner['link']}}" class="swiper-slide" style="width: 1590px;" role="group"
                                   aria-label="{{$x}} / {{count($banners)}}">
                                    <picture>
                                        <source type="image/webp" media="(min-width: 767px) and (max-width:991px)"
                                                srcset="{{$banner['src']}}">
                                        <source type="image/webp" media="(min-width: 992px)"
                                                srcset="{{$banner['src']}}">
                                        <img src="{{$banner['src']}}" width="400" height="304" class="img-fluid"
                                             alt="{{$banner['alt']}}">
                                    </picture>
                                </a>
                                @php($x++);
                            @endforeach
                        </div>
                        <div
                            class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                            @php($x=1);
                            @foreach($banners as $banner)
                                <span class="swiper-pagination-bullet @if($x === 1) swiper-pagination-bullet-active @endif" tabindex="0" role="button"
                                      aria-label="Go to slide {{$x}}"></span>
                                @php($x++);
                            @endforeach
                        </div>
                        <div class="swiper-nav">
                            <button type="button" class="swiper-button-prev d-none d-lg-inline-flex" tabindex="0"
                                    aria-label="Previous slide" aria-controls="swiper-wrapper-fe73d210e98b2c21f"
                                    aria-disabled="false">
                                <svg class="icon-arrow-1">
                                    <use
                                        xlink:href="{{asset('images/icons.svg')}}#icon-arrow-1"></use>
                                </svg>
                            </button>
                            <button type="button" class="swiper-button-next d-none d-lg-inline-flex" tabindex="0"
                                    aria-label="Next slide" aria-controls="swiper-wrapper-fe73d210e98b2c21f"
                                    aria-disabled="false">
                                <svg class="icon-arrow-1">
                                    <use
                                        xlink:href="{{asset('images/icons.svg')}}#icon-arrow-1"></use>
                                </svg>
                            </button>
                        </div>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                </div>
            </section>
        </div>
    @endif
    @if ($categories)
        <div class="layout-box layout-box-type-textraw with-header" id="layout-box-484">
            <section class="grid-category">
                <div class="container">
                    <div class="swiper-container category-slider">
                        <div class="row-lg swiper-wrapper ">
                            @foreach($categories as $category)
                                <div class="swiper-slide">
                                    <a href="{{ route('categories.show',['category'=>$category->url]) }}"
                                       class="category-link">
                                        <picture>
                                            <source type="image/webp" media="(min-width:768px)"
                                                    srcset="{{$category->icon}}">
                                            <img src="{{$category->icon}}" loading="lazy" class="img-fluid" width="70"
                                                 height="70" alt="{{$category->title}}">
                                        </picture>
                                        <span class="category-link__title">{{$category->title}}</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </section>
        </div>
    @endif


    <section class="main-block">
        <div class="layout-box layout-box-type-product-list with-header" id="layout-box-472">

            <section class="product-section">
                <div class="container">

                    <div class="product-section__category">
                        <h2 class="product-section__title"> {!! __('front.home.new') !!}</h2>
                        @if ($categories)
                            <a href="{{ route('categories.show',['category'=>$categories[0]->url]) }}"
                               title="{{$categories[0]->title}}"
                               class="product-section__category__txt">{{$categories[0]->title}}
                                <svg class="icon-fast-forward-double-right-arrows-symbol">
                                    <use
                                        xlink:href="{{asset('images/icons.svg')}}#icon-fast-forward-double-right-arrows-symbol"></use>
                                </svg>
                            </a>
                        @endif
                    </div>
                    <div
                        class="swiper-container product-slider swiper-initialized swiper-horizontal swiper-pointer-events off">
                        <div class="swiper-wrapper" id="swiper-wrapper-e322882ee4568a62" aria-live="polite"
                             style="transform: translate3d(0px, 0px, 0px);">
                            @if ($newProducts)
                                @php($x = 1)
                                @foreach($newProducts as $new)
                                    <div class="swiper-slide col-6 col-sm-4 col-lg-2-muted col-xl-2 swiper-slide-active"
                                         style="width: 237.75px; margin-right: 20px;" role="group"
                                         aria-label="{{$x}} / {{count($newProducts)}}">
                                        <a href="{{ route('products.show',['product'=>$new->url]) }}"
                                           title="{{$new->title}}" itemprop="url"
                                           class="product-item"
                                           itemscope="" itemtype="https://schema.org/Product">
                                            <link itemprop="url"
                                                  href="{{ route('products.show',['product'=>$new->url]) }}">
                                            <meta itemprop="availability" content="https://schema.org/InStock">
                                            <meta itemprop="priceCurrency" content="UAH">
                                            <meta itemprop="itemCondition" content="https://schema.org/UsedCondition">
                                            <meta itemprop="price" content="{{$new->price}}">
                                            @php($image = $new->mainImage->path ?? ($new->images[0]->path ?? null))
                                            @if ($image)
                                                <picture class="product-item__img">
                                                    <source type="image/webp" media="(max-width:991px)" srcset="{{$image}}">
                                                    <source itemprop="image" type="image/webp" media="(min-width: 992px)" srcset="{{$image}}">
                                                    <img src="{{$image}}" width="168" height="155" data-src="{{$image}}" alt="{{$new->title}}" class="img-fluid lazy">
                                                </picture>
                                            @endif
                                            <span class="product-item__label">
                                                <span class="label-outer"></span>
                                           </span>
                                            <div class="product-item__price   " itemprop="offers" itemscope=""
                                                 itemtype="https://schema.org/Offer">
                                                <span class="promotion-price-mobile"> </span>
                                                <ins itemprop="price" content=" {{$new->price}} ">
                                                    {{$new->price}}.00
                                                    <span itemprop="priceCurrency" content="UAH">₴</span>
                                                </ins>
                                            </div>
                                            <h3 class="product-item__title" itemprop="name">{{$new->title}}</h3>
                                        </a>
                                    </div>
                                    @php($x++)
                                @endforeach
                            @endif
                        </div>
                        <div
                            class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                            <span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0"
                                  role="button" aria-label="Go to slide 1" aria-current="true"></span><span
                                class="swiper-pagination-bullet" tabindex="0" role="button"
                                aria-label="Go to slide 2"></span><span class="swiper-pagination-bullet"
                                                                        tabindex="0"
                                                                        role="button"
                                                                        aria-label="Go to slide 3"></span><span
                                class="swiper-pagination-bullet" tabindex="0" role="button"
                                aria-label="Go to slide 4"></span><span class="swiper-pagination-bullet"
                                                                        tabindex="0"
                                                                        role="button"
                                                                        aria-label="Go to slide 5"></span><span
                                class="swiper-pagination-bullet" tabindex="0" role="button"
                                aria-label="Go to slide 6"></span><span class="swiper-pagination-bullet"
                                                                        tabindex="0"
                                                                        role="button"
                                                                        aria-label="Go to slide 7"></span><span
                                class="swiper-pagination-bullet" tabindex="0" role="button"
                                aria-label="Go to slide 8"></span><span class="swiper-pagination-bullet"
                                                                        tabindex="0"
                                                                        role="button"
                                                                        aria-label="Go to slide 9"></span><span
                                class="swiper-pagination-bullet" tabindex="0" role="button"
                                aria-label="Go to slide 10"></span><span class="swiper-pagination-bullet"
                                                                         tabindex="0"
                                                                         role="button"
                                                                         aria-label="Go to slide 11"></span><span
                                class="swiper-pagination-bullet" tabindex="0" role="button"
                                aria-label="Go to slide 12"></span><span class="swiper-pagination-bullet"
                                                                         tabindex="0"
                                                                         role="button"
                                                                         aria-label="Go to slide 13"></span></div>
                        <div class="swiper-nav">
                            <button type="button"
                                    class="swiper-button-prev d-none d-lg-inline-flex swiper-button-disabled"
                                    disabled="" tabindex="-1" aria-label="Previous slide"
                                    aria-controls="swiper-wrapper-e322882ee4568a62" aria-disabled="true">
                                <svg class="icon-arrow-1">
                                    <use
                                        xlink:href="{{asset('images/icons.svg')}}#icon-arrow-1"></use>
                                </svg>
                            </button>
                            <button type="button" class="swiper-button-next d-none d-lg-inline-flex" tabindex="0"
                                    aria-label="Next slide" aria-controls="swiper-wrapper-e322882ee4568a62"
                                    aria-disabled="false">
                                <svg class="icon-arrow-1">
                                    <use
                                        xlink:href="{{asset('images/icons.svg')}}#icon-arrow-1"></use>
                                </svg>
                            </button>
                        </div>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <section class="main-block">
        <div class="layout-box layout-box-type-product-list with-header" id="layout-box-485">

            <section class="product-section">
                <div class="container">
                    <div class="product-section__category">
                        <h2 class="product-section__title"> {!! __('front.home.hit') !!}</h2>
                        @if ($categories)
                            <a href="{{ route('categories.show',['category'=>$categories[0]->url]) }}"
                               title="{{$categories[0]->title}}"
                               class="product-section__category__txt">{{$categories[0]->title}}
                                <svg class="icon-fast-forward-double-right-arrows-symbol">
                                    <use
                                        xlink:href="{{asset('images/icons.svg')}}#icon-fast-forward-double-right-arrows-symbol"></use>
                                </svg>
                            </a>
                        @endif
                    </div>
                    <div
                        class="swiper-container product-slider swiper-initialized swiper-horizontal swiper-pointer-events off">
                        <div class="swiper-wrapper" id="swiper-wrapper-4f1e7ad720bbef0e" aria-live="polite"
                             style="transform: translate3d(0px, 0px, 0px);">
                            @if ($hitProducts)
                                @php($x = 1)
                                @foreach($hitProducts as $hit)

                                    <div class="swiper-slide col-6 col-sm-4 col-lg-2-muted col-xl-2 swiper-slide-active"
                                         style="width: 237.75px; margin-right: 20px;" role="group"
                                         aria-label="{{$x}} / {{count($newProducts)}}">
                                        <a href="{{ route('products.show',['product'=>$hit->url]) }}"
                                           title="{{$hit->title}}" itemprop="url"
                                           class="product-item"
                                           itemscope="" itemtype="https://schema.org/Product">
                                            <link itemprop="url"
                                                  href="{{ route('products.show',['product'=>$hit->url]) }}">
                                            <meta itemprop="availability" content="https://schema.org/InStock">
                                            <meta itemprop="priceCurrency" content="UAH">
                                            <meta itemprop="itemCondition" content="https://schema.org/UsedCondition">
                                            <meta itemprop="price" content="{{$hit->price}}">
                                            @php($image = $hit->mainImage->path ?? ($hit->images[0]->path ?? null))
                                            @if ($image)
                                                <picture class="product-item__img">
                                                    <source type="image/webp" media="(max-width:991px)" srcset="{{$image}}">
                                                    <source itemprop="image" type="image/webp" media="(min-width: 992px)" srcset="{{$image}}">
                                                    <img src="{{$image}}" width="168" height="155" data-src="{{$image}}" alt="{{$hit->title}}" class="img-fluid lazy">
                                                </picture>
                                            @endif
                                            <span class="product-item__label">
                                                <span class="label-outer"></span>
                                           </span>
                                            <div class="product-item__price   " itemprop="offers" itemscope=""
                                                 itemtype="https://schema.org/Offer">
                                                <span class="promotion-price-mobile"> </span>
                                                <ins itemprop="price" content=" {{$hit->price}} ">
                                                    {{$hit->price}}.00
                                                    <span itemprop="priceCurrency" content="UAH">₴</span>
                                                </ins>
                                            </div>
                                            <h3 class="product-item__title" itemprop="name">{{$hit->title}}</h3>
                                        </a>
                                    </div>
                                    @php($x++)
                                @endforeach
                            @endif
                        </div>
                        <div
                            class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                            <span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0"
                                  role="button" aria-label="Go to slide 1" aria-current="true"></span><span
                                class="swiper-pagination-bullet" tabindex="0" role="button"
                                aria-label="Go to slide 2"></span><span class="swiper-pagination-bullet" tabindex="0"
                                                                        role="button" aria-label="Go to slide 3"></span><span
                                class="swiper-pagination-bullet" tabindex="0" role="button"
                                aria-label="Go to slide 4"></span><span class="swiper-pagination-bullet" tabindex="0"
                                                                        role="button" aria-label="Go to slide 5"></span><span
                                class="swiper-pagination-bullet" tabindex="0" role="button"
                                aria-label="Go to slide 6"></span><span class="swiper-pagination-bullet" tabindex="0"
                                                                        role="button" aria-label="Go to slide 7"></span><span
                                class="swiper-pagination-bullet" tabindex="0" role="button"
                                aria-label="Go to slide 8"></span><span class="swiper-pagination-bullet" tabindex="0"
                                                                        role="button" aria-label="Go to slide 9"></span><span
                                class="swiper-pagination-bullet" tabindex="0" role="button"
                                aria-label="Go to slide 10"></span><span class="swiper-pagination-bullet" tabindex="0"
                                                                         role="button"
                                                                         aria-label="Go to slide 11"></span><span
                                class="swiper-pagination-bullet" tabindex="0" role="button"
                                aria-label="Go to slide 12"></span><span class="swiper-pagination-bullet" tabindex="0"
                                                                         role="button"
                                                                         aria-label="Go to slide 13"></span></div>
                        <div class="swiper-nav">
                            <button type="button"
                                    class="swiper-button-prev d-none d-lg-inline-flex swiper-button-disabled"
                                    disabled="" tabindex="-1" aria-label="Previous slide"
                                    aria-controls="swiper-wrapper-4f1e7ad720bbef0e" aria-disabled="true">
                                <svg class="icon-arrow-1">
                                    <use
                                        xlink:href="{{asset('images/icons.svg')}}#icon-arrow-1"></use>
                                </svg>
                            </button>
                            <button type="button" class="swiper-button-next d-none d-lg-inline-flex" tabindex="0"
                                    aria-label="Next slide" aria-controls="swiper-wrapper-4f1e7ad720bbef0e"
                                    aria-disabled="false">
                                <svg class="icon-arrow-1">
                                    <use
                                        xlink:href="{{asset('images/icons.svg')}}#icon-arrow-1"></use>
                                </svg>
                            </button>
                        </div>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                </div>
            </section>
        </div>
    </section>
    <section class="main-block">
        <div class="layout-box layout-box-type-product-list with-header" id="layout-box-486">
        </div>
    </section>



    <section class="seo-section">
        <div class="container">
            <div class="row">
                {!! $page->content !!}
            </div>
        </div>
    </section>
@endsection
