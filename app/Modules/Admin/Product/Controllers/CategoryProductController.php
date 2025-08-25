<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 19:05:30
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Admin\Product\Controllers;

use App\Modules\Admin\Product\Models\CategoryProduct;
use App\Modules\Admin\Product\Models\Product;
use App\Modules\Admin\Product\Requests\CategoryProductRequest;
use App\Modules\Admin\Product\Requests\ProductRequest;
use App\Modules\Admin\Product\Services\CategoryProductService;
use App\Modules\Admin\Product\Services\ProductService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\Role\Models\Role;
use Illuminate\Http\Response;

class CategoryProductController extends Base
{
    /**
     * @var Collection
     */
    private $categories;

    /**
     * PagesController constructor.
     */
    public function __construct(CategoryProductService $categoryProductService)
    {
        parent::__construct();
        $this->service = $categoryProductService;
        $this->categories = $categoryProductService->getAllCategoryProduct(new CategoryProduct);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', Role::class);

        $category_products = CategoryProduct::with('parent')->get();
        $this->title = "Title Category Product Index";

        $this->content = view('Admin.CategoryProduct.index')->
        with([
            'category_products' => $category_products,
            'title' => $this->title,
        ])->
        render();

        return $this->renderOutput();
    }

    /**
     * Create of the resource.
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Role::class);

        $this->title = "Category Products";

        $this->content = view('Admin.CategoryProduct.create')->
        with([
            'title' => $this->title,
            'categories' => $this->categories
        ])->
        render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryProductRequest $request
     * @return Response
     */
    public function store(CategoryProductRequest $request)
    {
        $this->service->save($request, new CategoryProduct());
        return \Redirect::route('products.categories.index')->with([
            'message' => __('Success')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param CategoryProduct $categoryProduct
     * @return Response
     */
    public function show(CategoryProduct $categoryProduct)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param CategoryProduct $categoryProduct
     * @return Application|Factory|View
     * @throws AuthorizationException
     */

    public function edit(CategoryProduct $categoryProduct)
    {
        $this->authorize('edit', Role::class);
        $this->title = "Category Product";
        //dd($categoryProduct);
        $this->content = view('Admin.CategoryProduct.edit')->
        with([
            'title' => $this->title,
            'item' => $categoryProduct,
            'categories' => $this->categories
        ])->
        render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryProductRequest $request
     * @param CategoryProduct $categoryProduct
     * @return Response
     */
    public function update(CategoryProductRequest $request, CategoryProduct $categoryProduct)
    {
        $this->service->save($request, $categoryProduct);
        return \Redirect::route('products.categories.index')->with([
            'message' => __('Success')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CategoryProduct $categoryProduct
     * @return Response
     */
    public function destroy(CategoryProduct $categoryProduct)
    {
        $categoryProduct->delete();
        return \Redirect::route('products.categories.index')->with([
            'message' => __('Success')
        ]);
    }
}
