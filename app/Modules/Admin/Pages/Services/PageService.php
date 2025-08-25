<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 17:17:04
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Admin\Pages\Services;

use App\Modules\Admin\Pages\Requests\PageRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PageService
{
    public function save(PageRequest $request, Model $model) {
        $model->fill($request->only($model->getFillable()));
        $model->save();
        return true;
    }

    public function search(Request $request) {
      dd($request);
        return true;
    }
}
