<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 17:17:04
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Admin\Pages\Services;

use App\Modules\Admin\Pages\Models\Page;
use App\Modules\Admin\Pages\Requests\BannersRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BannersService
{
    public function save(BannersRequest $request, Model $model) {

        if(isset($request->image)){
            $name = $request->file('image')->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('images/banners', $request->file('image'), $name);
            $request->image->move(public_path('images/banners'), $name);
            $model->src = $path;
        }
        $model->fill($request->only($model->getFillable()));
        $model->save();
        return true;
    }

    /**
     *
     * @param Page $page
     * @return Collection
     */
    public function getPages(
        Page $page
    ): Collection
    {
        return $page::all();
    }
}
