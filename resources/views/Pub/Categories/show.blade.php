@extends('Pub::layouts.content')
@section('content')
    <section class="template-product-list">
        <div class="container">
            <header class="template-product-list__header">
                <h1 class="template-product-list__header__title">{{$title}} <span>({{count($products)}})</span></h1>
            </header>
            <div class="row">

                <div class="col-12 col-md-4 col-xl-3">
                    <div class="layout-box layout-box-type-categorymenu without-header" id="layout-box-433">


                        <nav class="product-list-nav">
                            <span class="product-list-nav__title">{{__('front.categories.title')}}</span>
                            <nav class="nav">
                                <ul class="product-list-nav__category">
                                    @include('Pub::layouts.menuCategoriesItems',['items'=>$categories])
                                </ul>
                            </nav>
                        </nav>


                    </div>
                    <div class="layout-box layout-box-type-layered-navigation with-header" id="layout-box-457">

                        <div class="product-list-mobile">
                            <button type="button" class="product-list-mobile__btn mobile-btn-filter btn-main">
                                {{__('front.categories.filter')}}
                            </button>
                        </div>
                        <form class="form category-filter product-list-filter" id="filter-form" method="post"
                              action="{{ route('categories.show.post',['category'=>$category->url]) }}">
                            @csrf
                            @method('POST')
                            <span class="product-list-filter__title">   {{__('front.categories.filter')}}</span>
                            <div class="product-list-filter__section">
                                <span
                                    class="product-list-filter__section__heading">{{__('front.categories.price')}}</span>
                                <div class="product-list-filter__section__content">
                                    <div class="range-slider">
                                        {{--                                        <div class="range-slider-inner">--}}
                                        {{--                                            <span class="incl-range"></span>--}}
                                        {{--                                            <input value="0" min="0" max="10000" step="50" type="range">--}}
                                        {{--                                            <input value="0" min="0" max="10000" step="50" type="range">--}}
                                        {{--                                        </div>--}}
                                        <div class="field-content" id="result">
                                            <div class="field-range">
                                                <span>{{__('front.categories.from')}}</span>
                                                <input type="number" class="form-control" min="0" max="1000000"
                                                       name="priceFrom" value="{{$priceFrom}}">
                                            </div>
                                            <div class="field-range">
                                                <span>{{__('front.categories.to')}}</span>
                                                <input type="number" class="form-control" min="0" max="1000000"
                                                       name="priceTo" value="{{$priceTo}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="product-list-filter__buttons">
                                {{--                                <button name="layered_submitted" value="1" type="button" class="btn-clear" id="clear-button">--}}
                                {{--                                    <svg class="icon-close">--}}
                                {{--                                        <use--}}
                                {{--                                            xlink:href="{{asset('images/icons.svg')}}#icon-close"></use>--}}
                                {{--                                    </svg>--}}
                                {{--                                   {{__('front.categories.reset')}}--}}
                                {{--                                </button>--}}
                                <button type="submit"
                                        class="btn-filter btn-main"> {{__('front.categories.filter')}}</button>
                            </div>
                        </form>


                    </div>
                </div>
                <div class="col-12 col-md-8 col-xl-9">

                    <div class="layout-box layout-box-type-product-list with-header" id="layout-box-437">


                        <div class="product-list-grid row">
                            @foreach($products as $product)
                                <!-- product start -->
                                <div class="col-12" itemscope="" itemtype="https://schema.org/Product">
                                    <link itemprop="url"
                                          href="{{route('products.show',['product'=>$product->url])}}">
                                    <meta itemprop="availability" content="https://schema.org/InStock">
                                    <meta itemprop="priceCurrency" content="UAH">
                                    <meta itemprop="itemCondition" content="https://schema.org/UsedCondition">
                                    <meta itemprop="price" content="{{$product->price}}">

                                    <div itemprop="url" title="" class="product-list-item">
                                        <a href="{{route('products.show',['product'=>$product->url])}}"
                                           class="product-list-item__heading"
                                           title="{{$product->title}}">
                                            <h2 class="product-list-item__heading__title"
                                                itemprop="name">{{$product->title}}</h2>
                                            <div class="product-list-item__heading__benefits">
                                                {{--                                                <span class="product-list-item__heading__benefits__item">--}}
                                                {{--                                                    <svg class="icon-delivery-truck"><use--}}
                                                {{--                                                            xlink:href="{{asset('images/icons.svg')}}#icon-delivery-truck"></use></svg>--}}
                                                {{--                                                    <span class="product-list-item__heading__benefits__item__txt">Wysyłka: do 24h</span>--}}
                                                {{--                                                </span>--}}
                                                {{--                                                <span class="product-list-item__heading__benefits__item">--}}
                                                {{--                                                    <svg class="icon-return-1"><use--}}
                                                {{--                                                            xlink:href="{{asset('images/icons.svg')}}#icon-return-1"></use></svg>--}}
                                                {{--                                                    <span class="product-list-item__heading__benefits__item__txt">14 dni na zwrot</span>--}}
                                                {{--                                                </span>--}}
                                            </div>
                                        </a>

                                        <div class="product-list-item__outer">
                                            <div class="product-list-item__content">
                                                <a href="{{route('products.show',['product'=>$product->url])}}"
                                                   title="{{$product->title}}">
                                                    @if($product->new)
                                                        <img style="position: absolute;width: 50px;right: 0;"
                                                             src="{{asset('images/new.png')}}"
                                                             alt="{{$product->title}}">
                                                    @endif
                                                    @if($product->hit)
                                                        <img style="position: absolute;width: 50px;left: 0;"
                                                             src="{{asset('images/hot-deal.png')}}"
                                                             alt="{{$product->title}}">
                                                    @endif
                                                    @php($image = $product->mainImage->path ?? ($product->images[0]->path ?? ''))
                                                    <picture class="product-list-item__content__img">
                                                        <source type="image/webp" media="(max-width: 500px)"
                                                                data-srcset="{{$image}}"
                                                                srcset="{{$image}}">
                                                        <source itemprop="image" type="image/webp"
                                                                media="(min-width: 992px)"
                                                                data-srcset="{{$image}}"
                                                                srcset="{{$image}}">
                                                        <img itemprop="image"
                                                             src="{{$image}}"
                                                             data-src="{{$image}}"
                                                             class="img-fluid lazy loaded"
                                                             alt="{{$product->title}}"
                                                             data-was-processed="true">
                                                    </picture>
                                                </a>
                                                <div class="product-list-item__content__description">
                                                    {!! $product->characteristics !!}
                                                </div>
                                            </div>
                                            <div class="product-list-item__basket">
                                                <div class="product-list-item__basket__price" itemprop="offers"
                                                     itemscope="" itemtype="https://schema.org/Offer">
                                                    <ins itemprop="price" style="text-decoration: none;"
                                                         content="{{$product->price}}">
                                                        {{$product->price}}
                                                        <span itemprop="priceCurrency" content="UAH">₴</span></ins>

                                                    @if($product->status == 1)
                                                        <p itemprop="availability" href="https://schema.org/InStock"
                                                           class="product-list-item__basket__available">Є</p>
                                                        <a href="{{route('order',['product'=>$product->id])}}"
                                                           class="product-list-item__basket__btn">додати до кошика</a>
                                                    @elseif($product->status == 2)
                                                        <p itemprop="availability" href="https://schema.org/InStock"
                                                           class="product-list-item__basket__available">Під замовлення</p>
                                                        <a href="{{route('order',['product'=>$product->id])}}"
                                                           class="product-list-item__basket__btn">додати до кошика</a>
                                                    @elseif($product->status == 3)
                                                        <p itemprop="availability" href="https://schema.org/InStock"
                                                           class="product-list-item__basket__available">В дорозі</p>
                                                    @endif
                                                    <a href="{{route('products.show',['product'=>$product->url])}}"
                                                       class="product-list-item__basket__btn product-list-item__basket__btn-more"
                                                       title="Подробиці продукт">Подробиці продукт</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- product end -->

                            @endforeach


                        </div>


                        <!-- pagination -->
                        <div class="row">
                            <div class="col-12">
                                {!! $products->withQueryString()->links('pagination::custom') !!}
                            </div>
                        </div>
                        <!-- -->

                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
