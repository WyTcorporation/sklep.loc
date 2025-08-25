<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 19:05:30
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Admin\Product\Services;

use App\Models\Comments;
use App\Modules\Admin\Product\Models\CategoryProduct;
use App\Modules\Admin\Product\Models\Images;
use App\Modules\Admin\Product\Requests\ProductRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;

class ProductService
{

    public function save(
        ProductRequest $request,
        Model          $model
    ): Model
    {
        //dd($request->all(),$request->allFiles());
        $model->fill($request->only($model->getFillable()));
        $hit = $request->hit;
        $hit === 'on' ? $model->hit = 1 : $model->hit = 0;
        $new = $request->new;
        $new === 'on' ? $model->new = 1 : $model->new = 0;
        $model->save();
        $images = $request->images;
        if (!empty($images) && $images !== 'null') {
            foreach (json_decode($images) as $image) {
                $sortOrder = (int) ($image->sort_order ?? 0);
                $isMain = filter_var($image->is_main ?? false, FILTER_VALIDATE_BOOLEAN);

                $imageModel = Images::where(['title' => $image->name])->first();
                if (empty($imageModel)) {
                    $imageModel = new Images();
                    $imageModel->title = $image->name;
                }

                if ($isMain) {
                    Images::where('product_id', $model->id)->update(['is_main' => false]);
                }

                $imageModel->path = '/images/products/' . $model->id . '/' . $image->name;
                $imageModel->product_id = $model->id;
                $imageModel->sort_order = $sortOrder;
                $imageModel->is_main = $isMain;
                $imageModel->save();
            }
        }
        $comments = $request->comments;
        if (!empty($comments['fio']) && !empty($comments['content'])) {
            (new CommentsService)->save($comments, $model->id, new Comments());
        }
        $commentsUpdate = $request->commentsUpdate;
        if (!empty($commentsUpdate)) {
            foreach ($commentsUpdate as $update) {
                (new CommentsService)->save($update, $model->id, Comments::find($update['id']));
            }
        }
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
