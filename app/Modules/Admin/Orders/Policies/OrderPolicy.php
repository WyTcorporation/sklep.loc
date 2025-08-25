<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2023-06-03 16:43:27
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Admin\Orders\Policies;



use App\Models\Orders;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(Orders $order) {
        return $order->canDo(['SUPER_ADMIN','ORDER_ACCESS']);
    }

    public function create(Orders $order) {
        return $order->canDo(['SUPER_ADMIN','ORDER_ACCESS']);
    }

    public function edit(Orders $order) {
        return $order->canDo(['SUPER_ADMIN','ORDER_ACCESS']);
    }

    public function delete(Orders $order) {
        return $order->canDo(['SUPER_ADMIN','ROLES_ACCESS']);
    }
}
