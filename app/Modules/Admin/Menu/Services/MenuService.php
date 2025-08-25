<?php
/**
 * Created by PhpStorm.
 * User: note
 * Date: 13.12.2020
 * Time: 14:21
 */

namespace App\Modules\Admin\Menu\Services;


use App\Modules\Admin\Menu\Models\Menu;
use App\Modules\Admin\Menu\Requests\MenuRequest;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Admin\Role\Models\PermissionMenu;
use Illuminate\Database\Eloquent\Collection;

class MenuService
{
    public function save(MenuRequest $request, Model $model)
    {
        $model->fill($request->only($model->getFillable()));
        $model->save();
        $permission_menu = $request->get('permission_menu');
        $permissionMenu = PermissionMenu::where(['permission_id' => 1, 'menu_id' => $model->id])->first();
        if (!isset($permissionMenu) && $permission_menu === 'on') {
            $permissionMenu = new PermissionMenu();
            $permissionMenu->permission_id = 1;
            $permissionMenu->menu_id = $model->id;
            $permissionMenu->save();
        } elseif (isset($permissionMenu) && $permission_menu === null){
            $permissionMenu->delete();
        }
        return true;
    }

    /**
     *
     * @param Menu $menu
     * @return Collection
     */
    public function getMenu(
        Menu $menu
    ): Collection
    {
        return $menu::all();
    }
}
