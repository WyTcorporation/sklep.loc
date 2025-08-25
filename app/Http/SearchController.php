<?php
/**
 * Created by WyTcorp.
 * NickName: WyTcorp
 * User: Vladyslav Gladyr
 * Date: 04.06.23
 * Email: wild.savedo@gmail.com
 */

namespace App\Http;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Product\Models\Product;
use App\Services\Response\ResponseServise;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param string $search
     * @return JsonResponse
     */
    public function search(Request $request, string $search = ''): JsonResponse
    {
        if (!empty($request->get('term'))) {
            $search = $request->get('term');
        }
        $products = Product::where('title','LIKE',"%{$search}%")->get();
        $json = [];
        foreach ($products as $item) {
            $json[] = [
                'id' => $item->id,
                'text' => $item->title
            ];
        }
        return ResponseServise::sendJsonResponse(true, 200, [], $json);
    }
}
