@extends('Pub::layouts.content')
@section('content')
    <main class="main main-subpage">
        <div class="layout-box layout-box-type-product with-header" id="layout-box-436">
            <section class="template-product-cart">
                <div class="container">
                    <nav class="breadcrumbs">
                        <ul class="breadcrumbs__list">
                            <li><a href="{{route('home')}}">Додому</a></li>
                            <li>
                                <a href="{{route('products.show',['product'=>$product->url])}}">{{$product->categoryProduct->title}}</a>
                            </li>
                            <li><a href="{{route('products.show',['product'=>$product->url])}}">{{$product->title}}</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="row">
                        <div class="col-12 col-md-12 col-xl-12">
                            <div class="row">
                                <!-- product end -->
                                <div class="col-12" itemscope="" itemtype="https://schema.org/Product">
                                    <div class="product-list-item product-list-item--cart">
                                        <div class="product-list-item__outer">
                                            <div class="product-list-item__heading">
                                                <h1 class="product-list-item__heading__title"
                                                    itemprop="name">{{$product->title}}</h1>
                                                <div class="product-list-item__heading__benefits">
                                                    {{--                                                <span class="product-list-item__heading__benefits__item">--}}
                                                    {{--                                                    <svg class="icon-delivery-truck"><use xlink:href="{{asset('images/icons.svg')}}#icon-delivery-truck"></use></svg>--}}
                                                    {{--                                                    <span class="product-list-item__heading__benefits__item__txt">Wysyłka: do 24h</span>--}}
                                                    {{--                                                </span>--}}
                                                    {{--                                                    <span class="product-list-item__heading__benefits__item">--}}
                                                    {{--                                                    <svg class="icon-return-1"><use xlink:href="{{asset('images/icons.svg')}}#icon-return-1"></use></svg>--}}
                                                    {{--                                                    <span class="product-list-item__heading__benefits__item__txt">14 dni na zwrot</span>--}}
                                                    {{--                                                </span>--}}
                                                </div>
                                            </div>
                                            <div class="product-list-item__content">
                                                <div class="product-list-item__content__flex">
                                                    <div
                                                        class="product-list-item__content__gallery gallery__large gallery-ps swiper-container swiper-initialized swiper-horizontal swiper-pointer-events">
                                                        <div class="swiper-wrapper" id="swiper-wrapper-886a03e508edd86a"
                                                             aria-live="polite"
                                                             style="transform: translate3d(0px, 0px, 0px);">
                                                            @if ($product->images)
                                                                @php($x=1)
                                                                @foreach($product->images as $image)
                                                                    <div class="swiper-slide"
                                                                         style="width: 551px; margin-right: 10px;"
                                                                         role="group"
                                                                         aria-label="{{$x}} / {{count($product->images)}}">
                                                                        <a href="" title="{{$product->title}}">
                                                                            @if($product->new)
                                                                                <img
                                                                                    style="position: absolute;width: 50px;right: 0;"
                                                                                    src="{{asset('images/new.png')}}"
                                                                                    alt="{{$product->title}}">
                                                                            @endif
                                                                            @if($product->hit)
                                                                                <img
                                                                                    style="position: absolute;width: 50px;left: 0;"
                                                                                    src="{{asset('images/hot-deal.png')}}"
                                                                                    alt="{{$product->title}}">
                                                                            @endif
                                                                            <picture
                                                                                class="product-list-item__content__img">
                                                                                <source type="image/webp"
                                                                                        media="(max-width: 500px)"
                                                                                        data-srcset="{{$image->path}}">
                                                                                <source itemprop="image"
                                                                                        type="image/webp"
                                                                                        media="(min-width: 992px)"
                                                                                        data-srcset="{{$image->path}}">
                                                                                <img itemprop="image"
                                                                                     src="{{$image->path}}"
                                                                                     data-src="{{$image->path}}"
                                                                                     class="img-fluid lazy"
                                                                                     alt="{{$product->title}}">
                                                                            </picture>
                                                                        </a>
                                                                    </div>
                                                                    @php($x++)
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div
                                                            class="swiper-pagination d-xl-none swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                                                            <span
                                                                class="swiper-pagination-bullet swiper-pagination-bullet-active"
                                                                tabindex="0" role="button" aria-label="Go to slide 1"
                                                                aria-current="true"></span><span
                                                                class="swiper-pagination-bullet" tabindex="0"
                                                                role="button" aria-label="Go to slide 2"></span><span
                                                                class="swiper-pagination-bullet" tabindex="0"
                                                                role="button" aria-label="Go to slide 3"></span><span
                                                                class="swiper-pagination-bullet" tabindex="0"
                                                                role="button" aria-label="Go to slide 4"></span><span
                                                                class="swiper-pagination-bullet" tabindex="0"
                                                                role="button" aria-label="Go to slide 5"></span><span
                                                                class="swiper-pagination-bullet" tabindex="0"
                                                                role="button" aria-label="Go to slide 6"></span></div>
                                                        <div class="swiper-nav">
                                                            <button type="button"
                                                                    class="swiper-button-prev d-none d-lg-inline-flex swiper-button-disabled"
                                                                    disabled="" tabindex="-1"
                                                                    aria-label="Previous slide"
                                                                    aria-controls="swiper-wrapper-886a03e508edd86a"
                                                                    aria-disabled="true">
                                                                <svg class="icon-arrow-1">
                                                                    <use
                                                                        xlink:href="{{asset('images/icons.svg')}}#icon-arrow-1"></use>
                                                                </svg>
                                                            </button>
                                                            <button type="button"
                                                                    class="swiper-button-next d-none d-lg-inline-flex"
                                                                    tabindex="0" aria-label="Next slide"
                                                                    aria-controls="swiper-wrapper-886a03e508edd86a"
                                                                    aria-disabled="false">
                                                                <svg class="icon-arrow-1">
                                                                    <use
                                                                        xlink:href="{{asset('images/icons.svg')}}#icon-arrow-1"></use>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <span class="swiper-notification" aria-live="assertive"
                                                              aria-atomic="true"></span></div>
                                                    <div
                                                        class="product-card__gallery-small thumb-gallery swiper-container d-none d-lg-block swiper-initialized swiper-horizontal swiper-pointer-events swiper-free-mode swiper-thumbs">
                                                        <div class="swiper-wrapper"
                                                             id="swiper-wrapper-43eb964e10bf413107" aria-live="polite"
                                                             style="transform: translate3d(0px, 0px, 0px);">
                                                            @if ($product->images)
                                                                @php($x=1)
                                                                @foreach($product->images as $image)
                                                                    <div class="swiper-slide swiper-slide-visible"
                                                                         style="width: 79.3333px; margin-right: 15px;"
                                                                         role="group"
                                                                         aria-label="{{$x}} / {{count($product->images)}}">
                                                                        <img src="{{$image->path}}" class="img-fluid"
                                                                             alt="{{$product->title}}">
                                                                    </div>
                                                                    @php($x++)
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="swiper-nav">
                                                            <button type="button"
                                                                    class="swiper-button-prev d-none d-lg-inline-flex swiper-button-disabled swiper-button-lock"
                                                                    disabled="" tabindex="-1"
                                                                    aria-label="Previous slide"
                                                                    aria-controls="swiper-wrapper-43eb964e10bf413107"
                                                                    aria-disabled="true">
                                                                <svg class="icon-arrow-1">
                                                                    <use
                                                                        xlink:href="{{asset('images/icons.svg')}}#icon-arrow-1"></use>
                                                                </svg>
                                                            </button>
                                                            <button type="button"
                                                                    class="swiper-button-next d-none d-lg-inline-flex swiper-button-disabled swiper-button-lock"
                                                                    disabled="" tabindex="-1" aria-label="Next slide"
                                                                    aria-controls="swiper-wrapper-43eb964e10bf413107"
                                                                    aria-disabled="true">
                                                                <svg class="icon-arrow-1">
                                                                    <use
                                                                        xlink:href="{{asset('images/icons.svg')}}#icon-arrow-1"></use>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <span class="swiper-notification" aria-live="assertive"
                                                              aria-atomic="true"></span></div>
                                                </div>
                                                <div class="product-list-item__content__description">
                                                    {!! $product->characteristics !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-list-item__basket">
                                            <div class="product-list-item__basket__price" itemprop="offers" itemscope=""
                                                 itemtype="https://schema.org/Offer">
                                                <ins itemprop="price" style="text-decoration: none;"
                                                     content="{{$product->price}}">
                                                    {{$product->price}}
                                                    <span itemprop="priceCurrency" content="UAH">₴</span></ins>
                                                <span class="product-list-item__basket__price__delivery available"><svg
                                                        class="icon-delivery-truck">
                                                        <use
                                                            xlink:href="{{asset('images/icons.svg')}}#icon-delivery-truck"></use>
                                                    </svg>Вартість доставки від: <span> {{$delivery}} ₴</span></span>

                                                @if($product->status == 1)
                                                    <p itemprop="availability" href="https://schema.org/InStock"
                                                       class="product-list-item__basket__available available">Є</p>
                                                    <a href="{{route('order',['product'=>$product->id])}}" type="button"
                                                       class="product-list-item__basket__btn add-cart available"
                                                       id="add-cart">Додати в кошик</a>
                                                    <button type="button"
                                                            class="byProduct"
                                                            data-toggle="modal"
                                                            data-target="#byProduct"
                                                            style="padding: 15px 25px;border-radius: 25px;background: #51AD33;color: white;font-weight: bold;">
                                                        Купити в один клік
                                                    </button>
                                                @elseif($product->status == 2)
                                                    <p itemprop="availability" href="https://schema.org/InStock"
                                                       class="product-list-item__basket__available available">Під замовлення</p>
                                                    <a href="{{route('order',['product'=>$product->id])}}" type="button"
                                                       class="product-list-item__basket__btn add-cart available"
                                                       id="add-cart">Додати в кошик</a>
                                                    <button type="button"
                                                            class="byProduct"
                                                            data-toggle="modal"
                                                            data-target="#byProduct"
                                                            style="padding: 15px 25px;border-radius: 25px;background: #51AD33;color: white;font-weight: bold;">
                                                        Купити в один клік
                                                    </button>
                                                @elseif($product->status == 3)
                                                    <p itemprop="availability" href="https://schema.org/InStock"
                                                       class="product-list-item__basket__available">В дорозі</p>
                                                @endif
                                                <div class="product-list-item__basket__benefits available">
                                                    <span>
                                                        <svg class="icon-return"><use
                                                                xlink:href="{{asset('images/icons.svg')}}#icon-return"></use></svg>
                                                        <b>14 днів</b> для повернення</span>
                                                </div>
                                                <div class="product-list-item__basket__call">
                                                    <span>Телефонуйте і замовляйте</span>
                                                    <a href="tel:{{$phone}}">{{$phone}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- product end -->
                                <div class="col-12">
                                    <div class="product-card__description">
                                        <a href="#opis" class="product-card__description__link link--active">Опис
                                            продукту</a>
                                        @if(!empty($comments[0]))
                                        <a href="#produkty" class="product-card__description__link current">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">Відгуки кліентів</font>
                                            </font>
                                        </a>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-12 col-lg-9 offset-lg-2" id="opis">
                                    <div class="product-card__description__editor text-editor">
                                        {!! $product->content !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @if(!empty($comments[0]))
            <div class="layout-box layout-box-type-product-list with-header" id="layout-box-453">
                <section class="product-grid" id="produkty">
                    <div class="container">
                        <header class="product-grid__header">
                            <h2 class="product-grid__header__title">
                            <span>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Відгуки</font>
                                </font>
                            </span>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">кліентів</font>
                                </font>
                            </h2>
                        </header>
                        <div class="row">
                            @foreach($comments as $comment)
                                <div class="col-6 col-sm-4 col-lg-2-muted col-xl-2">
                                    <div class="product-item">
                                        <span class="product-item__label"><span class="label-outer"></span></span>
                                        <div class="product-item__price ">
                                            <span class="promotion-price-mobile"></span>
                                            <ins itemprop="price" content=" 429.00 ">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">{{$comment->fio}}</font>
                                                </font>
                                            </ins>
                                        </div>
                                        <div style="margin: 5px 0 0;
    font-size: 1.4rem;
    line-height: 1.7rem;
    font-weight: 400;
    text-align: center;
    height: 273px;
    overflow: hidden;">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;    height: 148px;">
                                                    {{$comment->content}}
                                                </font>
                                            </font>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
        @endif
        @if(!empty($products))
            <div class="layout-box layout-box-type-product-list with-header" id="layout-box-471">
                <section class="product-grid" id="inne">
                    <div class="container">
                        <header class="product-grid__header">
                            <h2 class="product-grid__header__title">
                            <span>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Інші</font>
                                </font>
                            </span>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">товари</font>
                                </font>
                            </h2>
                        </header>
                        <div class="row">
                            @foreach($products as $item)
                                <div class="col-6 col-sm-4 col-lg-2-muted col-xl-2">
                                    <a href="{{route('products.show',['product'=>$item->url])}}"
                                       title="{{$item->title}}" itemprop="url"
                                       class="product-item" itemscope="" itemtype="https://schema.org/Product">
                                        <link itemprop="url"
                                              href="{{route('products.show',['product'=>$item->url])}}">
                                        <meta itemprop="availability" content="https://schema.org/InStock">
                                        <meta itemprop="priceCurrency" content="UAH">
                                        <meta itemprop="itemCondition" content="https://schema.org/UsedCondition">
                                        <meta itemprop="price" content="{{$item->price}}">

                                        @php($image = $item->mainImage->path ?? ($item->images[0]->path ?? null))
                                        @if ($image)
                                            <picture class="product-item__img">
                                                <source type="image/webp" media="(max-width:991px)" srcset="{{$image}}">
                                                <source itemprop="image" type="image/webp" media="(min-width: 992px)" srcset="{{$image}}">
                                                <img src="{{$image}}" width="168"
                                                     height="155"
                                                     data-src="{{$image}}"
                                                     alt="{{$item->title}}"
                                                     class="img-fluid lazy loaded" data-was-processed="true">
                                            </picture>
                                        @endif
                                        <span class="product-item__label">
                                            <span class="label-outer"></span>
                                        </span>
                                        <div class="product-item__price" itemprop="offers" itemscope=""
                                             itemtype="https://schema.org/Offer">
                                            <span class="promotion-price-mobile"></span>
                                            <ins itemprop="price" content="{{$item->price}}">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">
                                                        {{$item->price}}
                                                    </font>
                                                </font>
                                                <span itemprop="priceCurrency" content="UAH">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">₴</font>
                                                    </font>
                                                </span>
                                            </ins>
                                        </div>
                                        <h3 class="product-item__title" itemprop="name">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">{{$item->title}}</font>
                                            </font>
                                        </h3>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
        @endif
    </main>
    <div style="opacity: 1;" class="modal fade" id="byProduct" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('one.click')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Замовити в один клік!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3>Додайте свій номер телефону і наш менеджер зв'яжеться з вами!</h3>
                        <input id="phone" type="text" required="" name="phone" class="form-control"
                               placeholder="(095) 000 00 00">
                        <input type="hidden" name="product" value="{{$product->id}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрити</button>
                        <button type="submit" class="btn btn-primary">Відправити</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <button id="successProductBtn" class="hidden" type="button" data-toggle="modal" data-target="#successProduct">Launch
        modal
    </button>
    <div style="opacity: 1;" class="modal fade" id="successProduct" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Замовити в один клік!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>Дякуємо за замовлення!</h3>
                    <h5>Наш менеджер звами зв'яжеться!</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрити</button>
                </div>
            </div>
        </div>
    </div>
@endsection
