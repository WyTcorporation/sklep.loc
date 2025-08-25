<?php
/**
 * Created by WyTcorp.
 * NickName: WyTcorp
 * User: Vladyslav Gladyr
 * Date: 29.05.23
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Pub\Orders\Services;

use App\Models\Orders;
use App\Models\OrdersProducts;
use App\Modules\Pub\Orders\Requests\OrdersRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class OrdersServices
{

    public function save(OrdersRequest $request, Orders $orders): Model
    {
        $products = $request->products;
        $orders->fill($request->only($orders->getFillable()));
        $orders->total = 0;
        $orders->save();
        $total = 0;
        if (!empty($products)) {
            foreach ($products as $product) {
                $orderProduct = new OrdersProducts();
                $orderProduct->orders_id = $orders->id;
                $orderProduct->products_id = $product['id'];
                $orderProduct->count = $product['quantity'];
                $orderProduct->countPrice = $product['countPrice'];
                $orderProduct->quantity = $product['quantity'];
                $orderProduct->price = $product['price'];
                $orderProduct->product_code = $product['product_code'];
                $total += $product['countPrice'];
                $orderProduct->save();
            }
        }
        $orders->total = $total + 150;
        $orders->save();
        return $orders;
    }
}
