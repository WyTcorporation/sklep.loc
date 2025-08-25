<?php

namespace App\Modules\Pub\Categories\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Modules\Admin\Product\Models\CategoryProduct;
use App\Modules\Pub\Base;
use App\Modules\Pub\Products\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\Response;
use App\Models\Categories as Category;

class CategoriesController extends Base
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $this->title = __('Categories');
        $this->content  = view('Pub::Categories.index')->with([
            'title' => $this->title
        ])->render();

        return $this->renderOutput();
    }


    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request,Category $category)
    {
        $priceFrom = '0';
        $priceTo = '1000000';
        $all = $request->all();
//        dd($all);
        $ids = $category->products->pluck('id')->toArray();
        if (isset($all['priceFrom']) && isset($all['priceTo'])){
            $priceFrom = $all['priceFrom'];
            $priceTo = $all['priceTo'];
            if ($priceFrom !== '0' || $priceTo !== '1000000') {
                $products = Product::whereIn('id', $ids)->whereBetween('price', [$all['priceFrom'], $all['priceTo']])->paginate(config('settings.pagination'));
            }
        } else {
            $products = Product::whereIn('id',$ids)->paginate(config('settings.pagination'));
        }
        $this->title = $category->meta_title;
        $this->meta_description = $category->meta_description;
        $this->meta_keys = $category->meta_keys;
        $this->content  = view('Pub::Categories.show')->with([
            'title' => $this->title,
            'products' => $products,
            'categories' => Categories::where(['parent_id' => null])->get(),
            'priceFrom' => $priceFrom,
            'priceTo' => $priceTo,
            'category' => $category
        ])->render();
        return $this->renderOutput();
    }
}
