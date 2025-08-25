<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 18:33:37
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Admin\News\Services;

use App\Modules\Admin\News\Requests\NewsRequest;
use Illuminate\Database\Eloquent\Model;

class NewsService
{
    public function save(NewsRequest $request, Model $model) {
        $model->fill($request->only($model->getFillable()));
        $model->save();
        return true;
    }
}
