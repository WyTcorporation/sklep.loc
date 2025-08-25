<?php

namespace App\Modules\Pub\UkrPoshta\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Response\ResponseServise;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class UkrPoshtaController extends Controller
{

    /**
     * @param string $search
     * @return JsonResponse
     */
    public function auth(Request $request)
    {

        $endpoint = 'https://ukrposhta.ua/ecom/0.0.1';

        $client = new \GuzzleHttp\Client(
            ['cookies' => true]
        );


        try {
            $response = $client->post($endpoint, [
                'content-type' => 'application/json',
                // 'Authorization'=>"Bearer {$access_token}",
                'charset' => 'utf-8',
                'json' => [
                    "country" => "UA",
                    "region" => "Київська",
                    "city" => "Бровари"

                ]
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return ResponseServise::sendJsonResponse(false, 500, [], $e);
        }


        $json = [];
        if ($response->getStatusCode() === 200) {
            $body = $response->getBody();
            $bodyContents = $body->getContents();
            $content = json_decode($bodyContents, false, 512);
            dd($content);
        }

        return ResponseServise::sendJsonResponse(true, 200, [], $json);
    }

}
