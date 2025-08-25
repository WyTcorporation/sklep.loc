<?php

namespace App\Modules\Pub\Products\Controllers;

use App\Models\Product;
use App\Modules\Pub\Base;
use Illuminate\Http\Response;

class ProductsController extends Base
{

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function show(Product $product)
    {
        $this->title = $product->title;
        $this->content = view('Pub::Products.show')->with([
            'title' => $this->title,
            'product' => $product,
            'comments' => $product->comments,
            'products' => $product->categoryProduct->products->filter(function ($item, $key) {
                if ((int)$item->price !== 0) {
                    return $item;
                }
            })->forPage(0, 6),
            'phone' => config('settings.phone'),
            'delivery' => config('settings.delivery')
        ])->render();

        return $this->renderOutput();
    }

}
