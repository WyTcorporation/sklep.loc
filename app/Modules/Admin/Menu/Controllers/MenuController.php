<?php

namespace App\Modules\Admin\Menu\Controllers;

use App\Modules\Admin\Menu\Models\Menu;
use App\Modules\Admin\Menu\Requests\MenuRequest;
use App\Modules\Admin\Menu\Services\MenuService;
use App\Modules\Admin\Role\Models\Permission;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\Role\Models\Role;
use Illuminate\Http\Response;

class MenuController extends Base
{
    /**
     * @var Collection
     */
    private $allMenus;

    //Нужно бужет сделать для других ролей кроме Супер Админа
    /**
     * MenuController constructor.
     */
    public function __construct(MenuService $menuService)
    {
        parent::__construct();
        $this->service = $menuService;
        $this->allMenus = $menuService->getMenu(new Menu);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $this->authorize('view', Role::class);


        $menus = Menu::all();

        $this->title = "Title Menu Index";

        $this->content = view('Admin::Menu.index')->
        with([
            'menus' => $menus,
            'title' => $this->title,
        ])->
        render();

        return $this->renderOutput();
    }

    /**
     * Create of the resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $this->authorize('create', Role::class);

        $this->title = "Menus";

        $this->content = view('Admin::Menu.create')->
        with([
            'title' => $this->title,
            'menus' => $this->allMenus
        ])->
        render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MenuRequest $request
     * @return Response
     */
    public function store(MenuRequest $request)
    {
        $this->service->save($request, new Menu());
        return  \Redirect::route('menus.index')->with([
            'message' => __('Success')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Menu $menu
     * @return Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Menu $menu
     * @return Application|Factory|View
     */
    public function edit(Menu $menu,Permission $permission)
    {
        $this->authorize('edit', Role::class);

        $this->title = "Menus";

        $perms =$menu->perms;
        $permission_menus = false;
        if(isset($perms[0])){
            $permission_menus = true;
        }
        $this->content = view('Admin::Menu.edit')->
        with([
            'title' => $this->title,
            'item' => $menu,
            'menus' => $this->allMenus,
            'permission_menus'=>$permission_menus,

        ])->
        render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MenuRequest $request
     * @param Menu $menu
     * @return Response
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $this->service->save($request, $menu);
        return  \Redirect::route('menus.index')->with([
            'message' => __('Success')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Menu $menu
     * @return Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return  \Redirect::route('menus.index')->with([
            'message' => __('Success')
        ]);
    }
}
