<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 18:33:37
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Admin\News\Controllers;


use App\Modules\Admin\News\Models\News;
use App\Modules\Admin\News\Requests\NewsRequest;
use App\Modules\Admin\News\Services\NewsService;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\Role\Models\Role;
use Illuminate\Http\Response;

class NewsController  extends Base
{
    /**
     * NewsController constructor.
     */
    public function __construct(NewsService $newsService)
    {
        parent::__construct();
        $this->service = $newsService;
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


        $news = News::all();

        $this->title = "Title News Index";

        $this->content = view('Admin::News.index')->
        with([
            'news' => $news,
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

        $this->title = "News";

        $this->content = view('Admin::News.create')->
        with([
            'title' => $this->title,
        ])->
        render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewsRequest $request
     * @return Response
     */
    public function store(NewsRequest $request)
    {
        $this->service->save($request, new News());
        return  \Redirect::route('news.index')->with([
            'message' => __('Success')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param News $news
     * @return Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param News $news
     * @return Application|Factory|View
     * @throws AuthorizationException
     */

    public function edit(News $news)
    {
        $this->authorize('edit', Role::class);

        $this->title = "News";
        $this->content = view('Admin::News.edit')->
        with([
            'title' => $this->title,
            'item' => $news

        ])->
        render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NewsRequest $request
     * @param News $news
     * @return Response
     */
    public function update(NewsRequest $request, News $news)
    {
        $this->service->save($request, $news);
        return  \Redirect::route('news.index')->with([
            'message' => __('Success')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return Response
     */
    public function destroy(News $news)
    {
        $news->delete();
        return  \Redirect::route('news.index')->with([
            'message' => __('Success')
        ]);
    }
}
