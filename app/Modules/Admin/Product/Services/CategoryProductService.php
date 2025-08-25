<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 19:05:30
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Admin\Product\Services;

use App\Modules\Admin\Product\Models\CategoryProduct;
use App\Modules\Admin\Product\Requests\CategoryProductRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class CategoryProductService
{

    public function save(
        CategoryProductRequest $request,
        Model $model
    ): Model
    {
        $model->fill($request->only($model->getFillable()));
        if(isset($request->image)){
            $name = $request->file('image')->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('images/categories', $request->file('image'), $name);
            $request->image->move(public_path('images/categories'), $name);
            $model->src = $path;
        }
        if(isset($request->icon)){
            $nameIcon = $request->file('icon')->getClientOriginalName();
            $pathIcon = Storage::disk('public')->putFileAs('images/categories', $request->file('icon'), $nameIcon);
            $request->icon->move(public_path('images/categories'), $nameIcon);
            $model->icon = $pathIcon;
        }
        $model->save();
        return $model;
    }

    /**
     *
     * @param CategoryProduct $categoryProduct
     * @return Collection
     */
    public function getAllCategoryProduct(
        CategoryProduct $categoryProduct
    ): Collection
    {
        return $categoryProduct::all();
    }
}
