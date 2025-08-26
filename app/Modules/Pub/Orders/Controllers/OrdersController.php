<?php

namespace App\Modules\Pub\Orders\Controllers;

use App\Enums\OrdersEnumStatus;
use App\Mail\SendOneClickAdmin;
use App\Mail\SendOrderMail;
use App\Models\Orders;
use App\Modules\Admin\Product\Models\Product;
use App\Modules\Pub\Base;
use App\Modules\Pub\Orders\Requests\OrdersRequest;
use App\Modules\Pub\Orders\Services\OrdersServices;
use Cloudipsp\Exception\ApiException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrdersController extends Base
{

    /**
     * OrdersController constructor.
     */
    public function __construct(OrdersServices $ordersServices)
    {
        parent::__construct();
        $this->service = $ordersServices;
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function index(Request $request, Product $product)
    {
        if (in_array($product->status, [0, 3])) {
            return redirect()->back()->with(['error' => __('front.card.unavailable')]);
        }

        $session = $request->session()->get('orders');
        //  $cache = Cache::get('orders');
        //  $value = Cache::put('','','');
        //   dd($cache);
        //$value = $request->session()->all();
        if (is_null($session)) {
            $orders = [
                'items' => [
                    0 => [
                        'product_id' => $product->id,
                        'product_title' => $product->title,
                        'price' => $product->price,
                        'count' => 1
                    ]
                ],
                'price' => $product->price

            ];
            $request->session()->put('orders', $orders);
            // Cache::add('orders',$orders);
        } else {
            $add = null;
            foreach ($session['items'] as $key => $items) {
                if ($items['product_id'] === $product->id) {
                    $session['items'][$key]['count'] = $session['items'][$key]['count'] + 1;
                    $session['price'] = $session['price'] + $product->price;
                    $request->session()->put('orders', $session);
                } else {
                    $add = $product->id;
                }
            }
            if (!is_null($add)) {
                $newProduct = [
                    'product_id' => $product->id,
                    'product_title' => $product->title,
                    'price' => $product->price,
                    'count' => 1
                ];
                $session['price'] = $session['price'] + $product->price;
                $session['items'][] = $newProduct;
                $request->session()->put('orders', $session);
                //Cache::add('orders',$session);
            }
        }
        //$session = $request->session()->get('orders');
        // $cache = Cache::get('orders');
        //  dd($cache);
        return redirect()->back()->with(['success' => __('front.card.success'), 'productName' => $product->title]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function card(Request $request): \Illuminate\Contracts\View\View|Factory|Application
    {
        $this->title = __('Card');
        $session = $request->session()->get('orders');
        $products = [];
        $price = 0;
        if (is_null($session)) {
            $message = __('front.card.empty');
        } else {
            $message = __('front.card.empty');
            $unavailable = false;
            foreach ($session['items'] as $key => $item) {
                $product = Product::with(['mainImage', 'images'])->find($item['product_id']);

                if (in_array($product->status, [0, 3])) {
                    $session['price'] -= round($item['count'] * $product->price);
                    unset($session['items'][$key]);
                    $unavailable = true;
                    continue;
                }

                $image = $product->mainImage->path ?? ($product->images[0]->path ?? null);
                $products[] = [
                    'id' => $product->id,
                    'title' => $product->title,
                    'url' => $product->url,
                    'price' => $product->price,
                    'product_code' => $product->product_code,
                    'count' => $item['count'],
                    'image' => $image,
                    'countPrice' => round($item['count'] * $product->price)
                ];
                $price += round($item['count'] * $product->price);
            }

            if ($unavailable) {
                $session['price'] = $price;
                if (empty($session['items'])) {
                    $request->session()->forget('orders');
                } else {
                    $request->session()->put('orders', $session);
                }
                session()->flash('error', __('front.card.unavailable'));
            }
        }
        $this->content = view('Pub::Orders.card')->with([
            'message' => $message,
            'products' => $products,
            'price' => $price,
            'delivery' => config('settings.delivery')
        ])->render();

        return $this->renderOutput();
    }

    /**
     * @param OrdersRequest $request
     * @return RedirectResponse
     */

    public function buy(OrdersRequest $request)
    {
        $session = $request->session()->get('orders');
        if ($session) {
            foreach ($session['items'] as $item) {
                $product = Product::find($item['product_id']);
                if (in_array($product->status, [0, 3])) {
                    return Redirect::route('card')->with(['error' => __('front.card.unavailable')]);
                }
            }
        }

        $payment = $request->payment;
        $order = $this->service->save($request, new Orders());
        $request->session()->forget('orders');
        if ($payment === '1') {
            return Redirect::route('order.fondy', ['order' => $order]);
        } else {
            return Redirect::route('order.success', ['order' => $order]);
        }
    }

    /**
     * @param Orders $order
     * @return Application|Factory|View
     */
    public function success(Orders $order)
    {
//        https://mailtrap.io/
        Mail::to($order->email)->send(new SendOrderMail($order));
//        if (!Mail::failures()) {
//
//        }
        $this->title = __('front.success.title', ['number' => $order->id]);
        $text = [
            'title' => $this->title,
            'subTitle' => __('front.success.subTitle'),
            'contacts' => __('front.success.contacts', ['fio' => $order->fio, 'phone' => $order->phone]),
            'thanks' => __('front.success.thanks'),
        ];
        $this->content = view('Pub::Orders.success')->with([
            'order' => $order,
            'text' => $text,
        ])->render();
        return $this->renderOutput();
    }

    /**
     * @param Orders $order
     * @return RedirectResponse
     */
    public function successPost(Orders $order): RedirectResponse
    {
        $order->status = OrdersEnumStatus::Payed;
        $order->save();
        return Redirect::route('order.success', ['order' => $order]);
    }

    /**
     * @param Orders $order
     * @return RedirectResponse
     * @throws ApiException
     */
    public function fondy(Orders $order): RedirectResponse
    {
        Session::put("_token", csrf_token());
        \Cloudipsp\Configuration::setMerchantId(env('FONDY_MERCHAND_ID'));
        \Cloudipsp\Configuration::setSecretKey(env('FONDY_SECRET_KEY'));

        $payment = $order->total . '00';
        $orderId = $order->id;
        $order_desc = __('front.fondy.payment', ['number' => $orderId]);
        $checkoutData = [
            'response_url' => route('order.success.post', ['order' => $order]),
            'currency' => 'UAH',
            'amount' => $payment,
            'order_desc' => $order_desc,
            'product_id' => $orderId,
            'lang' => 'uk',
            'merchant_data' => [
                'custom_data1' => 'Some string'
            ]
        ];

        $data = \Cloudipsp\Checkout::url($checkoutData);
        $url = $data->getUrl();
        return redirect($url);
    }

    /**
     * @param OrdersRequest $request
     * @return RedirectResponse
     */

    public function oneClick(OrdersRequest $request)
    {
        Mail::to(env('MAIL_ADMIN_ADDRESS'))->send(
            new SendOneClickAdmin($request->phone,
                $product =  \App\Modules\Pub\Products\Models\Product::find($request->product)
            )
        );
        return redirect()->back()->with(['successOneClick' => 'Ваша заявка прийнята!', 'productName' => $product->title]);
    }
}
