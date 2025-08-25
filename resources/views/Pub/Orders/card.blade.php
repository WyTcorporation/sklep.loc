@extends('Pub::layouts.content')
@section('content')
    <link rel="stylesheet" href="{{asset('css/main.css?v=1.1')}}">
    <main class="main">
        <div class="layout-box layout-box-type-cart with-header" id="layout-box-435">
            <section class="section-basket">
                <div class="container">
                    <form action="{{route('buy')}}" id="cart-contents">
                        <div class="row">
                            <div class="basket-all-form col-md-12">
                                <h1 class="brand-name">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Кошик</font>
                                    </font>
                                </h1>
                                <div class="basket-header">
                                    <div class="basket-header-title">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Найменування товару</font>
                                        </font>
                                    </div>
                                    <div class="basket-header-price">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Ціна</font>
                                        </font>
                                    </div>
                                    <div class="basket-header-count">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Кількість</font>
                                        </font>
                                    </div>
                                    <div class="basket-header-total">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Цінить</font>
                                        </font>
                                    </div>
                                </div>
                                @if($products)
                                    @foreach($products as $key=>$product)
                                        <div id="product-{{$product['id']}}" class="basket-item-group">
                                            <div class="basket-product-img">
                                                <img src="{{$product['image']}}" alt="{{$product['title']}}">
                                            </div>
                                            <div class="basket-product-title">
                                                <h2>
                                                    <font style="vertical-align: inherit;">
                                                        <font
                                                            style="vertical-align: inherit;">{{$product['title']}}</font>
                                                    </font>
                                                </h2>
                                            </div>
                                            <div class="basket-product-price">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">
                                                        {{$product['price']}} ₴
                                                    </font>
                                                </font>
                                            </div>
                                            <div class="basket-product-count">
                                                <button
                                                    onclick="--document.getElementById('products[{{$key}}][quantity]').value;changePrice(document.getElementById('products[{{$key}}][quantity]').value,{{$key}},{{$product['price']}});"
                                                    class="button-spinner-plus" type="button">
                                                    <i class="ion-minus-round"></i>
                                                </button>
                                                <input id="products[{{$key}}][quantity]" type="number"
                                                       name="products[{{$key}}][quantity]" data-stock="8"
                                                       data-value="1" data-packagesize="1.0000"
                                                       value="{{$product['count']}}" data-productid="97"
                                                       onchange="changePrice(document.getElementById('products[{{$key}}][quantity]').value,{{$key}},{{$product['price']}});"
                                                       data-trackstock="1">
                                                <input type="hidden" name="products[{{$key}}][id]"
                                                       value="{{$product['id']}}">
                                                <input type="hidden" name="products[{{$key}}][price]"
                                                       value="{{$product['price']}}">
                                                <input type="hidden" name="products[{{$key}}][product_code]"
                                                       value="{{$product['product_code']}}">
                                                <input type="hidden" name="products[{{$key}}][count]"
                                                       value="{{$product['count']}}">
                                                <input id="products[{{$key}}][countPrice]"
                                                       type="hidden"
                                                       name="products[{{$key}}][countPrice]"
                                                       value="{{$product['countPrice']}}">
                                                <button
                                                    onclick="++document.getElementById('products[{{$key}}][quantity]').value;changePrice(document.getElementById('products[{{$key}}][quantity]').value,{{$key}},{{$product['price']}});"
                                                    class="button-spinner-minus" type="button">
                                                    <i class="ion-plus-round"></i>
                                                </button>
                                            </div>
                                            <div class="basket-product-total">
                                                <font style="vertical-align: inherit;">
                                                    <font id="products[{{$key}}][countPrice][new]"  style="vertical-align: inherit;">
                                                        {{$product['countPrice']}} ₴
                                                    </font>
                                                </font>
                                                <span class="basket-product-peritem">для мистецтва <span
                                                        class="countPrice">{{$product['countPrice']}}</span> ₴ </span>
                                            </div>
                                            <div class="basket-product-delete">
                                                <button
                                                    onclick="document.getElementById('product-{{$product['id']}}').remove();"
                                                    type="button">
                                                    <i class="ion-close"></i>
                                                    <span>Видалити</span>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>


                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="box-method">
                                    <h3>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Способи доставки</font>
                                        </font>
                                    </h3>
                                    <hr>
                                    <h4>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Виберіть спосіб доставки</font>
                                        </font>
                                    </h4>
                                    <ul class="delivery-radio">
                                        <li class="">
                                            <input checked type="radio" name="delivery" id="delivery-2" value="1">
                                            <label for="delivery-2">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Нова пошта</font>
                                                </font>
                                            </label>
                                            <div class="check"></div>
                                            <img src="{{asset('/images/np.png')}}" alt="Нова пошта">
                                            <span class="price">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">{{$delivery}} ₴</font>
                                                </font>
                                            </span>

                                            <div class="">
                                                <label for="np" style="border: none;">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Місто: </font>
                                                    </font>
                                                </label>
                                                {{--                                                <input type="text" id="np" class="form-control" aria-label="...">--}}
                                                <select id="np" name="np" class="form-control select2"
                                                        style="width: 100%;">
                                                    <option>м. Київ</option>
                                                </select>
                                            </div>
                                            <div class="">
                                                <label for="np-warehouses" style="border: none;">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Відділення: </font>
                                                    </font>
                                                </label>
                                                {{--                                                <input type="text" id="np" class="form-control" aria-label="...">--}}
                                                <select id="np-warehouses" name="np_warehouses"
                                                        class="form-control select2"
                                                        style="width: 100%;">
                                                    <option>Відділення №1: вул. Пирогівський шлях</option>
                                                </select>
                                            </div>
                                            <div class="">
                                                <label for="fio" style="border: none;">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">ФІО: </font>
                                                    </font>
                                                </label>
                                                <input type="text" required name="fio" id="fio" class="form-control" aria-label="...">
                                            </div>
                                            <div class="">
                                                <label for="phone" style="border: none;">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Телефон: </font>
                                                    </font>
                                                </label>
                                                <input type="tel"  required name="phone" id="phone" class="form-control" aria-label="...">
                                            </div>
                                            <div class="">
                                                <label for="email" style="border: none;">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Email: </font>
                                                    </font>
                                                </label>
                                                <input type="email"  required name="email" id="email" class="form-control" aria-label="...">
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="box-method">
                                    <h3>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Оберіть спосіб оплати</font>
                                        </font>
                                    </h3>
                                    <ul class="payment-radio">
                                        <li class="payment-img">
                                            <input
                                                type="radio" class="radio" name="payment"
                                                id="payment-11" value="1" checked="checked">
                                            <label for="payment-11">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Швидкі онлайн-платежі</font>
                                                </font>
                                            </label>
                                            <div class="check"></div>
                                            <img src="{{asset('/images/paymant24.png')}}" alt="Швидкі онлайн-платежі">
                                        </li>
                                        <li>
                                            <input type="radio" class="radio" name="payment" id="payment-4" value="2">
                                            <label for="payment-4">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">банківський переказ</font>
                                                </font>
                                            </label>
                                            <div class="check"></div>
                                        </li>
                                        <li>
                                            <input type="radio" class="radio"
                                                   name="payment" id="payment-5" value="3">
                                            <label for="payment-5">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">оплата при доставці</font>
                                                </font>
                                            </label>
                                            <div class="check"></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="box-summary">
                                    <h3>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Резюме</font>
                                        </font>
                                    </h3>
                                    <div class="summary-item-group">
                                        <div class="summary-name">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    Вартість покупки
                                                </font>
                                            </font>
                                        </div>
                                        <div class="summary-value">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    <span id="productsPrice"> {{$price}}</span> ₴
                                                </font>
                                            </font>
                                        </div>
                                    </div>
                                    <div class="summary-item-group">
                                        <div class="summary-name">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    Доставка
                                                </font>
                                            </font>
                                        </div>
                                        <div class="summary-value">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    <span id="deliveryPrice">{{$delivery}}</span> ₴
                                                </font>
                                            </font>
                                        </div>
                                    </div>
                                    <div class="summary-item-group">
                                        <div class="summary-name">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    Способ оплаты
                                                </font>
                                            </font>
                                        </div>
                                        <div class="summary-value">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    <span id="paymentName">Швидкі онлайн-платежі</span>
                                                </font>
                                            </font>
                                        </div>
                                    </div>
                                    <div class="summary-item-group summary-together">
                                        <div class="summary-name">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    Итого к оплате
                                                </font>
                                            </font>
                                        </div>
                                        <div class="summary-value">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">
                                                    <span id="totalPrice">{{($price+$delivery)}}</span> ₴
                                                </font>
                                            </font>
                                        </div>
                                    </div>
                                    <button type="submit" class="button-next-step">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Перейти до оплати</font>
                                        </font>
                                        <i class="ion-ios-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main>
@endsection
