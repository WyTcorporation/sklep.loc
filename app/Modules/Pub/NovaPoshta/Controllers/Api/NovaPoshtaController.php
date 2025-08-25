<?php

namespace App\Modules\Pub\NovaPoshta\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Response\ResponseServise;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class NovaPoshtaController extends Controller
{

    /**
     * @param Request $request
     * @param string $search
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function city(Request $request, string $search = 'Київ'): JsonResponse
    {

        if (!empty($request->get('term'))) {
            $search = $request->get('term');
        }
        $endpoint = 'https://api.novaposhta.ua/v2.0/json/';

        $client = new \GuzzleHttp\Client(
            ['cookies' => true]
        );


        try {
            $response = $client->post($endpoint, [
                'content-type' => 'application/json',
                'charset' => 'utf-8',
                'json' => [
                    "apiKey" => "30ebf26a0f890e9a58d7932483147d9d",
                    "modelName" => "Address",
                    "calledMethod" => "searchSettlements",
//                    "calledMethod" => "getWarehouses",
                    "methodProperties" => [
                        "CityName" => $search,
                        "Page" => "1",
                        "Limit" => "50",
                        "Language" => "UA",
                    ]
                ]
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return ResponseServise::sendJsonResponse(false, 500, [], $e);
        }

        $json = [
            "0" => [
                "id" => "105",
                "text" => "Відділення №1: вул. Пирогівський шлях, 135"
            ],
            "1" => [
                "id" => "45",
                "text" => "Відділення №2: вул. Богатирська, 11"
            ],
            "2" => [
                "id" => "50",
                "text" => "Відділення №3 (до 30 кг на одне місце): вул. Калачівська, 13 (Стара Дарниця)"
            ],
            "3" => [
                "id" => "52",
                "text" => "Відділення №4: вул. Верховинна, 69"
            ],
            "4" => [
                "id" => "53",
                "text" => "Відділення №5: вул. Федорова, 32 (м. Олімпійська)"
            ],
            "5" => [
                "id" => "74",
                "text" => "Відділення №6: вул. Миколи Василенка, 2 (метро Берестейська)"
            ],
            "6" => [
                "id" => "58",
                "text" => "Відділення №7 (до 10 кг): вул. Гната Хоткевича, 8 (м.Чернігівська)"
            ],
            "7" => [
                "id" => "57",
                "text" => "Відділення №8 (до 30 кг на одне місце): вул. Набережно-Хрещатицька, 33"
            ],
            "8" => [
                "id" => "97",
                "text" => "Відділення №9: пров. В'ячеслава Чорновола, 54а (р-н Жулянського мосту)"
            ],
            "9" => [
                "id" => "13796",
                "text" => "Відділення №10: вул. Василя Жуковського, 22А"
            ]
        ];

        if ($response->getStatusCode() === 200) {
            $body = $response->getBody();
            $bodyContents = $body->getContents();
            $content = json_decode($bodyContents, false, 512);
           // dd($content);
                $json = [];
                foreach ($content->data[0]->Addresses as $item) {
                    $json[] = [
                        'id' => $item->Present,
                        'text' => $item->Present
                    ];
                }

        }
//dd($content);
        return ResponseServise::sendJsonResponse(true, 200, [], $json);
    }

    /**
     * @param Request $request
     * @param string $search
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function warehouses(Request $request, string $search = 'Київ'): JsonResponse
    {

        $endpoint = 'https://api.novaposhta.ua/v2.0/json/';

        $client = new \GuzzleHttp\Client(
            ['cookies' => true]
        );

        if (!empty($request->get('search'))) {
            $search = $request->get('search');
        }

        $cityName = explode(',',$search);
        $cityName = explode('.',$cityName[0]);

        try {
            $response = $client->post($endpoint, [
                'content-type' => 'application/json',
                'charset' => 'utf-8',
                'json' => [
                    "apiKey" => "30ebf26a0f890e9a58d7932483147d9d",
                    "modelName" => "Address",
                    "calledMethod" => "getWarehouses",
                    "methodProperties" => [
                        "CityName" => trim($cityName[1]),
                       // "CityRef" => $request->get('id'),
                        "Page" => "1",
                        "Limit" => "50",
                        "Language" => "UA"
                    ]
                ]
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return ResponseServise::sendJsonResponse(false, 500, [], $e);
        }

        if ($response->getStatusCode() === 200) {
            $body = $response->getBody();
            $bodyContents = $body->getContents();
            $content = json_decode($bodyContents, false, 512);
           // dd($content);
            $json = [];
            foreach ($content->data as $item) {
                $json[] = [
                    'id' => $search.' , '.$item->Description,
                    'text' => $item->Description
                ];
            }
        }
//dd($content);
        return ResponseServise::sendJsonResponse(true, 200, [], $json);
    }
}
