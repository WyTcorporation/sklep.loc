<?php

namespace App\Modules\Pub\Home\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Pages\Models\Page;
use App\Models\Categories;
use App\Modules\Admin\Product\Models\Product;
use App\Modules\Pub\Base;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Base
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $this->title = __('Home');
        $page = Page::where(['id' => 1])->first();
        $banners = [];
        foreach ($page->banners as $item) {
            if (!empty($item)) {
                $banners[] = [
                    'id' => $item->id,
                    'src' => $item->src,
                    'link' => $item->link,
                    'alt' => $item->alt,
                    'title' => $item->title,
                    'text' => $item->text,
                    'button' => $item->button
                ];
            }
        }
        $categories = Categories::where(['parent_id' => null])->get();
        $newProducts = Product::with(['mainImage', 'images'])
            ->where(['new' => 1], ['category_product_id' => 1])
            ->where('status', '>', 0)->limit(8)->get();
        $hitProducts = Product::with(['mainImage', 'images'])
            ->where(['hit' => 1], ['category_product_id' => 1])
            ->where('status', '>', 0)->limit(8)->get();
        $this->content = view('Pub::Home.index')->with([
            'title' => $page->title,
            'banners' => $banners,
            'page' => $page,
            'categories' => $categories,
            'newProducts' => $newProducts,
            'hitProducts' => $hitProducts,
        ])->render();
        return $this->renderOutput();
    }
}
