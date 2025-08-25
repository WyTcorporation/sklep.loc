<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 19:05:30
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Admin\Product\Policies;

use App\Modules\Admin\Product\Models\Product;
use App\Modules\Admin\Product\Models\CategoryProduct;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

//    public function view(CategoryProduct $categoryProduct) {
//        return $categoryProduct->canDo(['SUPER_ADMINISTRATOR','PRODUCT_ACCESS']);
//    }
//
//    public function create(CategoryProduct $categoryProduct) {
//        return $categoryProduct->canDo(['SUPER_ADMINISTRATOR','PRODUCT_ACCESS']);
//    }
//
//    public function edit(CategoryProduct $categoryProduct) {
//        return $categoryProduct->canDo(['SUPER_ADMINISTRATOR','PRODUCT_ACCESS']);
//    }
//
//    public function delete(CategoryProduct $categoryProduct) {
//        return $categoryProduct->canDo(['SUPER_ADMINISTRATOR','ROLES_ACCESS']);
//    }

    public function view(Product $product) {
        return $product->canDo(['SUPER_ADMINISTRATOR','SUPER_ADMIN','PRODUCT_ACCESS']);
    }

    public function create(Product $product) {
        return $product->canDo(['SUPER_ADMINISTRATOR','SUPER_ADMIN','PRODUCT_ACCESS']);
    }

    public function edit(Product $product) {
        return $product->canDo(['SUPER_ADMINISTRATOR','SUPER_ADMIN','PRODUCT_ACCESS']);
    }

    public function delete(Product $product) {
        return $product->canDo(['SUPER_ADMINISTRATOR','SUPER_ADMIN','ROLES_ACCESS']);
    }
}
