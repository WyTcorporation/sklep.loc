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
use App\Modules\Admin\Product\Models\Images;
use App\Modules\Admin\Product\Models\Product;
use App\Modules\Admin\Product\Requests\ProductRequest;
use App\Modules\Admin\Product\Services\ProductService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\Role\Models\Role;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class ProductController extends Base
{
    /**
     * @var Collection
     */
    private $categories;

    /**
     * @var array
     */
    private $status = [
        0 => 'Немає',
        1 => 'Є',
        2 => 'Під замовлення',
        3 => 'В дорозі'
    ];

    /**
     * PagesController constructor.
     */
    public function __construct(ProductService $productService)
    {
        parent::__construct();
        $this->service = $productService;
        $this->categories = $productService->getAllCategoryProduct(new CategoryProduct);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function index()
    {

//        $products = Product::latest()->paginate(5);
//
//        return view('products.index',compact('products'))
//            ->with('i', (request()->input('page', 1) - 1) * 5);

        $this->authorize('view', Role::class);
        $products = Product::all()->sortByDesc('id');
        $this->title = "Title Products Index";
        $this->content = view('Admin.Product.index')->
        with([
            'title' => $this->title,
            'products' => $products,
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
        $this->title = "Create Product";
        $this->content = view('Admin.Product.create')->
        with([
            'title' => $this->title,
            'status' => $this->status,
            'categories' => $this->categories
        ])->
        render();
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return Response
     */
    public function store(ProductRequest $request)
    {
//        $request->validate([
//            'title' => 'required',
//            'price' => 'required',
//            'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//        ]);

        $this->service->save($request, new Product());
        return \Redirect::route('products.index')->with([
            'message' => __('Success')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return string
     */
    public function images(Request $request)
    {
        $input = [];
        if ($image = $request->file('images')) {
            $profileImage = $image->getClientOriginalName();
            $imageModel = Images::where(['title' => $profileImage])->first();
            $productId = $request->get('product_id');

            $destinationPath = $productId ? 'images/products/' . $productId : 'images/products/tmp';
            $fullDestination = public_path($destinationPath);

            if (!File::exists($fullDestination)) {
                File::makeDirectory($fullDestination, 0755, true);
            }

            if (empty($imageModel)) {
                $image->move($fullDestination, $profileImage);
                $imageModel = new Images();
                $imageModel->title = $profileImage;
                $imageModel->path = '/' . trim($destinationPath, '/') . '/' . $profileImage;
                if ($productId) {
                    $imageModel->product_id = $productId;
                }
                $imageModel->save();
            }

            $input = [
                'path' => '/' . trim($destinationPath, '/') . '/' . $profileImage,
                'name' => $profileImage,
                'sort_order' => 0,
                'is_main' => false
            ];
        }
        return response()->json($input);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View
     * @throws AuthorizationException
     */

    public function edit(Product $product)
    {
        $this->authorize('edit', Role::class);
        $this->title = "Product";
        $images = null;
        if (isset($product->images)) {
            foreach ($product->images as $image) {
                $images[] = [
                    'id' => $image->id,
                    'path' => $image->path,
                    'name' => $image->title,
                    'sort_order' => $image->sort_order,
                    'is_main' => $image->is_main,
                ];
            }
        }
        $this->content = view('Admin.Product.edit')->
        with([
            'title' => $this->title,
            'item' => $product,
            'comments' => $product->comments,
            'status' => $this->status,
            'images' => $images,
            'categories' => $this->categories
        ])->
        render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param Product $product
     * @return Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $this->service->save($request, $product);
        return \Redirect::route('products.index')->with([
            'message' => __('Success')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        $directory = public_path('images/products/' . $product->id);
        if (File::exists($directory)) {
            File::deleteDirectory($directory);
        }

        $product->delete();
        return \Redirect::route('products.index')->with([
            'message' => __('Success')
        ]);
    }
}
