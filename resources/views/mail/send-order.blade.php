<!DOCTYPE html>
<html>
<head>
    <title>{{env('APP_NAME')}} - Замовлення № {{ $order->id }}</title>
</head>
<body style="text-align: center">
<h1>Ваше замовлення прийнято {{ $order->fio }}! Замовлення № {{ $order->id }}!</h1>
<h3>Вам перетелефонує наш менеджер на {{ $order->phone }}</h3>
<table style="width:100%">
    <thead>
    <tr>
        <th>#</th>
        <th>Назва</th>
        <th>Кількість</th>
        <th>Ціна</th>
        <th>Сума</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{$product['number']}}</td>
            <td>{{$product['title']}}</td>
            <td>{{$product['count']}}</td>
            <td>{{$product['price']}}</td>
            <td>{{$product['countPrice']}}</td>
        </tr>
    @endforeach
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="2">Доставка:</td>
        <td>150 грн</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="2">Разом:</td>
        <td>{{ $order->total }} грн</td>
    </tr>

    <tr>
        <td></td>
        <td>Місце доставки:</td>
        <td>{{ $order->np }}</td>
        <td colspan="2">{{ $order->np_warehouses }}</td>
    </tr>
    </tbody>
</table>
<h3>Дякуюємо за замовлення!</h3>
</body>
</html>
