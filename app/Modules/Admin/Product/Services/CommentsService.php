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
use App\Modules\Admin\Product\Models\Images;
use App\Modules\Admin\Product\Requests\ProductRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentsService
{
    public function save(
        array $params,
        int $products_id,
        Model          $model
    ): Model
    {
        $model->fill($params);
        $model->products_id = $products_id;
        $model->save();
        return $model;
    }
}
