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
        $product->load(['images', 'mainImage', 'categoryProduct']);
        $related = $product->categoryProduct->products()
            ->with(['mainImage', 'images'])
            ->get()
            ->filter(function ($item) {
                if ((int)$item->price !== 0) {
                    return $item;
                }
            })->forPage(0, 6);

        $this->title = $product->title;
        $this->content = view('Pub::Products.show')->with([
            'title' => $this->title,
            'product' => $product,
            'comments' => $product->comments,
            'products' => $related,
            'phone' => config('settings.phone'),
            'delivery' => config('settings.delivery')
        ])->render();

        return $this->renderOutput();
    }

}
