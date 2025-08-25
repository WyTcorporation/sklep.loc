<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 16:40:45
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Admin\Pages\Controllers\Api;

use App\Modules\Admin\Pages\Models\Page;
use App\Modules\Admin\Pages\Services\PageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class PagesController extends Controller
{
    /**
     * PagesController constructor.
     */
    public function __construct(PageService $pageService)
    {
        $this->service = $pageService;
    }
    /**
     * Display a listing of the resource.
     *@param Request $request
     * @return JsonResponse
     */
    public function search(Request  $request): JsonResponse
    {
        $json = $this->service->search($request);
        return response()->json(
            (object)$json
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Create of the resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Pages\Models\Page  $page
     * @return Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Pages\Models\Page  $page
     * @return Response
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Modules\Admin\Pages\Models\Page  $page
     * @return Response
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modules\Admin\Pages\Models\Page  $page
     * @return Response
     */
    public function destroy(Page $page)
    {
        //
    }
}
