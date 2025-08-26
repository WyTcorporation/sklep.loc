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
use Illuminate\Support\Facades\File;

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
        $deleted = $request->input('deleted_images', []);
        if (!empty($deleted)) {
            foreach ((array)$deleted as $imageId) {
                $imageModel = Images::find($imageId);
                if ($imageModel) {
                    $filePath = public_path(ltrim($imageModel->path, '/'));
                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }
                    $imageModel->delete();
                }
            }
        }

        $images = $request->input('image_payload');
        if (!empty($images) && $images !== 'null') {
            $images = is_string($images) ? json_decode($images) : $images;

            $hasMain = false;
            foreach ($images as $img) {
                if (filter_var($img->is_main ?? false, FILTER_VALIDATE_BOOLEAN)) {
                    $hasMain = true;
                    break;
                }
            }

            foreach ($images as $index => $image) {
                $sortOrder = (int) ($image->sort_order ?? 0);
                $isMain = filter_var($image->is_main ?? false, FILTER_VALIDATE_BOOLEAN);
                if (!$hasMain && $index === 0) {
                    $isMain = true;
                }

                $imageModel = Images::where(['title' => $image->name])->first();
                if (empty($imageModel)) {
                    $imageModel = new Images();
                    $imageModel->title = $image->name;
                }

                if ($isMain) {
                    Images::where('product_id', $model->id)->update(['is_main' => false]);
                }

                $destinationDir = public_path('images/products/' . $model->id);
                if (!File::exists($destinationDir)) {
                    File::makeDirectory($destinationDir, 0755, true);
                }

                $sourcePath = $imageModel->path
                    ? public_path(ltrim($imageModel->path, '/'))
                    : public_path('images/products/tmp/' . $image->name);
                $targetPath = $destinationDir . '/' . $image->name;

                if (File::exists($sourcePath) && $sourcePath !== $targetPath) {
                    File::move($sourcePath, $targetPath);
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
