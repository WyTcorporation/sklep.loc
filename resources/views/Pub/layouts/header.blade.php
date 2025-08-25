<header class="header-main ">
    <div class="container">
        <div class="header-main__top">
            <a href="/" class="header-main__logo" title="ETA">
                <img src="{{asset('images/eta-logo.svg')}}" class="img-fluid" width="150"
                     height="67" alt="">
            </a>
            <form class="header-main__search product-search-form" id="product-search">
                <input type="text" class="form-control field__search product-search-phrase GSearch"
                       placeholder="Що шукаєте..." id="product-search-phrase" name="query" autocomplete="off">
                <div id="livesearch"></div>
                <button type="submit" class="header-main__search-btn">
                    <svg class="icon-magnifying-glass">
                        <use xlink:href="{{asset('images/icons.svg')}}#icon-magnifying-glass"></use>
                    </svg>
                </button>
            </form>
            <div class="header-main__account">
{{--                <button type="button" class="header-main__account__search">--}}
{{--                    <svg class="icon-magnifying-glass">--}}
{{--                        <use xlink:href="fonts/icons.svg#icon-magnifying-glass"></use>--}}
{{--                    </svg>--}}
{{--                </button>--}}
                <a href="#" title="Moje konto" class="header-main__account__btn">
                    <svg class="icon-magnifying-glass">
                        <use
                            xlink:href="{{asset('images/icons.svg')}}#icon-user-profile"></use>
                    </svg>
                    <span class="header-main__account__btn__txt"></span>
                </a>
                <div id="topBasket">
                    <a href="{{route('card')}}" class="header-main__account__basket" title="Корзина">
                        <span class="header-basket__icon">
                            <svg class="icon-shopping-basket-1"><use
                                    xlink:href="{{asset('images/icons.svg')}}#icon-shopping-basket-1"></use></svg>
                        </span>
                        @if ($orders = Session::get('orders'))
                            <span class="header-basket__price"> {{$orders['price']}} ₴.</span>
                        @else
                            <span class="header-basket__price"> 0.00 ₴.</span>
                        @endif
                    </a>
                </div>

                <button type="button" class="header-main__account__nav-btn">
                    <svg class="icon-iconfinder-menu-5925630">
                        <use
                            xlink:href="{{asset('images/icons.svg')}}#icon-iconfinder-menu-5925630"></use>
                    </svg>
                </button>
            </div>
        </div>
        <div class="header-main__bottom">
            <nav class="header-main__nav">
                <ul class="header-main__nav__list">
                    @include('Pub::layouts.menuItems',['items'=>$menu->roots()])
                </ul>
            </nav>
            <div class="header-main__benefits">
                <div class="header-main__benefits__item">
                    <svg class="icon-delivery-truck">
                        <use
                            xlink:href="{{asset('images/icons.svg')}}#icon-delivery-truck"></use>
                    </svg>
                    <span>{!!__('front.header.delivery') !!}</span>
                </div>
                <div class="header-main__benefits__item">
                    <svg class="icon-quality">
                        <use
                            xlink:href="{{asset('images/icons.svg')}}#icon-quality"></use>
                    </svg>
                    <span>{!!__('front.header.guarantee') !!}</span>
                </div>
            </div>
            <div class="header-main__contact">
                <span class="header-main__contact__title">{!!__('front.header.line') !!}</span>
                <a href="tel:{{$phone}}">{{$phone}}</a>
            </div>
        </div>
    </div>
</header>
