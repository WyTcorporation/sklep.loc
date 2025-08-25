<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 16:40:45
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Admin\Pages\Controllers;

use App\Modules\Admin\Pages\Models\Banners;
use App\Modules\Admin\Pages\Models\Page;
use App\Modules\Admin\Pages\Requests\BannersRequest;
use App\Modules\Admin\Pages\Services\BannersService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\Role\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class BannersController extends Base
{
    /**
     * @var Collection
     */
    private $pages;

    /**
     * BannersController constructor.
     */
    public function __construct(BannersService $bannersService)
    {
        parent::__construct();
        $this->service = $bannersService;
        $this->pages = $bannersService->getPages(new Page);
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

        $banners = Banners::all();

        $this->title = "Title Banners Index";

        $this->content = view('Admin::Banners.index')->
        with([
            'banners' => $banners,
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

        $this->title = "Banners";

        $this->content = view('Admin::Banners.create')->
        with([
            'title' => $this->title,
            'pages' => $this->pages,
        ])->
        render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BannersRequest $request
     * @return Response
     */
    public function store(BannersRequest $request)
    {
        $this->service->save($request, new Banners());
        return  \Redirect::route('banners.index')->with([
            'message' => __('Success')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Banners $banner
     * @return Response
     */
    public function show(Banners $banner)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Banners $banner
     * @return Application|Factory|View
     * @throws AuthorizationException
     */

    public function edit(Banners $banner)
    {
        $this->authorize('edit', Role::class);

        $this->title = "Banners";
        $this->content = view('Admin::Banners.edit')->
        with([
            'title' => $this->title,
            'pages' => $this->pages,
            'item' => $banner

        ])->
        render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BannersRequest $request
     * @param Banners $banner
     * @return Response
     */
    public function update(BannersRequest $request, Banners $banner)
    {
        $this->service->save($request, $banner);
        return  \Redirect::route('banners.index')->with([
            'message' => __('Success')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Banners $banner
     * @return Response
     */
    public function destroy(Banners $banner)
    {
        $banner->delete();
        return  \Redirect::route('banners.index')->with([
            'message' => __('Success')
        ]);
    }
}
