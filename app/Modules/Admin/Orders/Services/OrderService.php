<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2023-06-03 16:43:27
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Admin\Orders\Services;

use App\Models\OrdersProducts;
use App\Modules\Admin\Orders\Requests\OrderRequest;
use App\Modules\Admin\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;

class OrderService
{
    public function save(OrderRequest $request, Model $model): Model
    {
        $products = $request->products;
        $model->fill($request->only($model->getFillable()));
        $model->total = 0;
        $model->save();
        $total = 0;
        if (!empty($model->ordersProducts[0])){
            foreach ($model->ordersProducts as $ordersProduct) {
                $ordersProduct->delete();
            }
        }
        if (!empty($products)) {
            foreach ($products as $product) {
                if (!is_null($product['count'])) {

                    $getProduct = Product::find($product['id']);
                    $count = (int)$product['count'];
                    $orderProduct = new OrdersProducts();
                    $orderProduct->orders_id = $model->id;
                    $orderProduct->products_id = $product['id'];
                    $orderProduct->count = $count;
                    $orderProduct->countPrice = $getProduct->price * $count;
                    $orderProduct->quantity = $count;
                    $orderProduct->price = $getProduct->price;
                    $orderProduct->product_code = $getProduct->product_code;

                    $total += $orderProduct->countPrice;
                    $orderProduct->save();
                }
            }
        }
        $model->total = $total + 150;
        $model->save();
        return $model;
    }
}
