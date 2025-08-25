<footer class="footer-main">
    <div class="container">
        <div class="footer-main__content">
            <nav class="footer-main__content__nav">
                <h4 class="footer-main__content__nav__title">Про нас</h4>
                <ul class="footer-main__content__nav__list">
                    <li><a href="{{route('front.pages.index',['page'=>'istoriia-kompanii'])}}">Історія компанії</a></li>
                    <li><a href="{{route('front.pages.index',['page'=>'kontaktna-informatsiia'])}}">Контактна інформація</a></li>
                </ul>
            </nav>
            <nav class="footer-main__content__nav">
                <h4 class="footer-main__content__nav__title">Норматівни документи</h4>
                <ul class="footer-main__content__nav__list">
                    <li><a href="{{route('front.pages.index',['page'=>'dohovir-publichnoi-oferty'])}}">Договір публічної оферти</a></li>
                    <li><a href="{{route('front.pages.index',['page'=>'polytika-vykoristannia-failyv-cookie'])}}">Политіка викорістання файлив cookie</a></li>
                </ul>
            </nav>
            <nav class="footer-main__content__nav">
                <h4 class="footer-main__content__nav__title">Корисна информація</h4>
                <ul class="footer-main__content__nav__list">
                    <li><a href="{{route('front.pages.index',['page'=>'harantiia'])}}">Гарантія</a></li>
                    <li><a href="{{route('front.pages.index',['page'=>'servisnyi-tsentr'])}}">Сервісний центр</a></li>
                    <li><a href="{{route('front.pages.index',['page'=>'dostavka-ta-oplata'])}}">Доставка та оплата</a></li>
                </ul>
            </nav>
        </div>
        <div class="footer-main__contact">
            <h5 class="footer-main__contact__title">Є питання?</h5>
            <span class="footer-main__contact__txt">Телефон довіри працює (пн-пт: з 9.00 до 19.00)</span>
            <a href="tel:{{$phone}}" class="footer-main__contact__phone">{{$phone}}</a>
            <a href="mailto:{{$email}}" class="footer-main__contact__mail">{{$email}}</a>
            <div class="footer-main__contact__socials">
                <a href="#" rel="noopener" class="footer-socials">
                    <svg class="icon-facebook">
                        <use xlink:href="{{asset('images/icons.svg')}}#icon-facebook"></use>
                    </svg>
                </a>
                <a href="#" rel="noopener" class="footer-socials">
                    <svg class="icon-youtube">
                        <use xlink:href="{{asset('images/icons.svg')}}#icon-youtube"></use>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="footer-main__copyright">
            <span>© 2021, lockit.com.ua. - Всі права захищені. Дизайн і реалізація: <a href="https://lockit.com.ua" title="Розробка сайтів під замовлення" rel="noopener">
                  lockit.com.ua
                </a>
            </span>
        </div>
    </div>
</footer>
