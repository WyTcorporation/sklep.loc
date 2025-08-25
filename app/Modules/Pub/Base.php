<?php
/**
 * Created by PhpStorm.
 * User: note
 * Date: 24.11.2020
 * Time: 22:51
 */

namespace App\Modules\Pub;

use App\Http\Controllers\Controller;
use App\Modules\Pub\Pages\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Menu;
use App\Modules\Admin\Product\Models\CategoryProduct as Category;

class Base extends Controller
{

    protected $template;
    protected $user;
    protected $title;
    protected $content;
    protected $sidebar;
    protected $vars;
    protected $locale;
    protected $uri;
    protected $banners;
    protected $service;
    protected $menu;
    protected bool $shop = false;
    protected string $meta_description;
    protected string $meta_keys;

    public function __construct()
    {
        $this->template = "Pub::layouts.default";

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            $this->locale = App::getLocale();
            $this->uri = $request->route()->uri;
            return $next($request);
        });
    }

    protected function renderOutput()
    {

        $this->vars = Arr::add($this->vars, 'content', $this->content);
        $this->vars = Arr::add($this->vars, 'title', $this->title);
        $menu = $this->getMenu();
        $this->vars = Arr::add($this->vars, 'menu', $menu);
        $this->vars = Arr::add($this->vars, 'phone', config('settings.phone'));
        $this->vars = Arr::add($this->vars, 'marker', config('settings.marker'));
        $this->vars = Arr::add($this->vars, 'delivery', config('settings.delivery'));
        $this->vars = Arr::add($this->vars, 'email', config('settings.email'));
        $this->vars = Arr::add($this->vars, 'shop', $this->shop);
        $this->vars = Arr::add($this->vars, 'meta_author', config('settings.author'));
        $this->vars = Arr::add($this->vars, 'meta_description', $this->meta_description??env('APP_NAME'));
        $this->vars = Arr::add($this->vars, 'meta_keys', $this->meta_keys??env('APP_NAME'));
        return view($this->template)->with($this->vars);
    }

    private function getMenu()
    {
        return Menu::make('menuRenderer', function ($m) {
            foreach (Category::all()->sortBy('sort_order') as $item) {
                $path = $item->url;
                if ($path && $this->checkRoute($path)) {
                    $path = route($path);
                }

                if ($item->parent_id === null || $item->parent_id === 0) {
                    // $m->add($item->title, $path)->id($item->id)->data('permissions',$this->getPermissions($item));
                    $m->add($item->title, route('categories.show', ['category' => $path]))->id($item->id);
                } else {
                    if ($m->find($item->parent_id)) {
                        //$m->find($item->parent)->add($item->title, $path)->id($item->id)->data('permissions',$this->getPermissions($item));
                        $m->find($item->parent_id)->add($item->title, route('categories.show', ['category' => $path]))->id($item->id);
                    }
                }


            }
        })->filter(function ($item) {
//            if($this->user && $this->user->canDo($item->data('permissions'))) {
//                return true;
//            }
            return true;
        });
    }

    private function checkRoute($path)
    {
        $routes = \Route::getRoutes()->getRoutes();

        foreach ($routes as $route) {
            if ($route->getName() === $path) {
                return true;
            }
        }

        return false;
    }
    public function setCookie(Request $request,$item = 'orders', $value = ''){
        $minutes = 60;
        $response = new Response('Set Cookie');
//        if (is_array($value)){
//            foreach ($value as $item){
//                $response->withCookie(cookie($item, $value, $minutes));
//            }
//        }
        $response->withCookie(cookie($item, $value, $minutes));
        return $response;
    }

    public function getCookie(Request $request,$item = 'orders'){
        $value = $request->cookie($item);
        echo $value;
    }
}
