<?php

namespace App\Models;

use App\Enums\OrdersEnumStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery',
        'payment',
        'np',
        'np_warehouses',
        'fio',
        'status',
        'phone',
        'email',
        'total'
    ];

    /**
     * Доставка
     *
     * @var array
     */
    private $deliveryList = [
        1 => 'Нова Пошта'
    ];
    /**
     * Оплата
     *
     * @var array
     */
    private $paymentList = [
        1 => 'Швидкі онлайн-платежі',
        2 => 'Банківський переказ',
        3 => 'Оплата при доставці'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => OrdersEnumStatus::class
    ];

//    /**
//     * Interact with the user's first name.
//     *
//     * @return Attribute
//     */
//    protected function google2faSecret(): Attribute
//    {
//        return new Attribute(
//            get: fn($value) => decrypt($value),
//            set: fn($value) => encrypt($value),
//        );
//    }

    public function ordersProducts(): hasMany
    {
        return $this->hasMany(OrdersProducts::class);
    }

    public function renderData(): array
    {
        return [
            "id" => $this->id,
            'delivery' => $this->delivery,
            'payment' => $this->payment,
            'np_warehouses' => $this->np_warehouses,
            'fio' => $this->fio,
            'phone' => $this->phone,
            'status' => $this->status,
            'total' => $this->total,
            'products' => $this->ordersProducts(),
            "created_at" => $this->created_at?->toDateTimeString(),
            "updated_at" => $this->updated_at?->toDateTimeString()
        ];
    }
}
