<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 16:40:45
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Admin\Pages\Controllers;

use App\Modules\Admin\Pages\Models\Page;
use App\Modules\Admin\Pages\Requests\PageRequest;
use App\Modules\Admin\Pages\Services\PageService;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\Role\Models\Role;
use Illuminate\Http\Response;

class PagesController extends Base
{
    /**
     * PagesController constructor.
     */
    public function __construct(PageService $pageService)
    {
        parent::__construct();
        $this->service = $pageService;
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


        $pages = Page::all();

        $this->title = "Title Page Index";

        $this->content = view('Admin::Pages.index')->
        with([
            'pages' => $pages,
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

        $this->title = "Pages";

        $this->content = view('Admin::Pages.create')->
        with([
            'title' => $this->title,
        ])->
        render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PageRequest $request
     * @return Response
     */
    public function store(PageRequest $request)
    {
        $this->service->save($request, new Page());
        return  \Redirect::route('pages.index')->with([
            'message' => __('Success')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Page $page
     * @return Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Page $page
     * @return Application|Factory|View
     * @throws AuthorizationException
     */

    public function edit(Page $page)
    {
        $this->authorize('edit', Role::class);

        $this->title = "Pages";
        $this->content = view('Admin::Pages.edit')->
        with([
            'title' => $this->title,
            'item' => $page

        ])->
        render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PageRequest $request
     * @param Page $page
     * @return Response
     */
    public function update(PageRequest $request, Page $page)
    {
        $this->service->save($request, $page);
        return  \Redirect::route('pages.index')->with([
            'message' => __('Success')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     * @return Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return  \Redirect::route('pages.index')->with([
            'message' => __('Success')
        ]);
    }
}
