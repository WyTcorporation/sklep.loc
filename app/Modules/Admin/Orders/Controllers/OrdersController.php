<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2023-06-03 16:43:27
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Admin\Orders\Controllers;

use App\Mail\SendOrderMail;
use App\Models\Orders;
use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\Orders\Requests\OrderRequest;
use App\Modules\Admin\Orders\Services\OrderService;
use App\Modules\Admin\Role\Models\Role;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class OrdersController  extends Base
{
    protected $service;

    protected $deliveryList = [
        1 => 'Нова Пошта'
    ];
    protected $paymentList =  [
        1 => 'Швидкі онлайн-платежі',
        2 => 'Банківський переказ',
        3 => 'Оплата при доставці'
    ];

    protected $statusList =  [
        0 => 'Не оплачено',
        1 => 'Оплачено',
        2 => 'Доставлено'
    ];
    /**
     * OrdersController constructor.
     */
    public function __construct(OrderService $orderService)
    {
        parent::__construct();
        $this->service = $orderService;
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
        $orders = Orders::orderBy('id', 'desc')->paginate(500);
        $this->title = "Title Orders Index";
        $this->content = view('Admin.Orders.index')->
        with([
            'title' => $this->title,
            'paymentList' => $this->paymentList,
            'deliveryList' => $this->deliveryList,
            'statusList' => $this->statusList,
            'orders' => $orders,
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
    public function create(): View|Factory|Application
    {
        $this->authorize('create', Role::class);
        $this->title = "Create Order";
        $this->content = view('Admin.Orders.create')->
        with([
            'title' => $this->title,
            'paymentList' => $this->paymentList,
            'deliveryList' => $this->deliveryList,
            'statusList' => $this->statusList,
        ])->
        render();
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     * @return Response
     */
    public function store(OrderRequest $request)
    {
        $this->service->save($request, new Orders());
        return \Redirect::route('orders.index')->with([
            'message' => __('Success')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Orders\Models\Order  $order
     * @return Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Orders $order
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(Orders $order): View|Factory|Application
    {
        $this->authorize('edit', Role::class);

        $this->title = "Order";
        $products = [];
        foreach($order->ordersProducts as $product){
            $products[] = [
                'id'=>$product->product->id,
                'title'=>$product->product->title,
                'count'=>$product->count,
            ];
        }
        $this->content = view('Admin::Orders.edit')->
        with([
            'title' => $this->title,
            'paymentList' => $this->paymentList,
            'deliveryList' => $this->deliveryList,
            'statusList' => $this->statusList,
            'item' => $order,
            'products' => $products
        ])->
        render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     * @param OrderRequest $request
     * @param Orders $order
     * @return Redirect
     */
    public function update(OrderRequest $request, Orders $order)
    {
        $this->service->save($request, $order);
        return \Redirect::route('orders.index')->with([
            'message' => __('Success')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modules\Admin\Orders\Models\Order  $order
     * @return Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
