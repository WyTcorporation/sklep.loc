<!DOCTYPE html>
<html>
<head>
    <title>{{env('APP_NAME')}} - Замовлення в один клік</title>
</head>
<body style="text-align: center">
<h1>{{env('APP_NAME')}} - Замовлення в один клік!</h1>
<h3>Товар - {{$product->title}} - код товару - {{$product->product_code}}</h3>
<h3>Номер телефону - {{$phone}}</h3>
</body>
</html>
