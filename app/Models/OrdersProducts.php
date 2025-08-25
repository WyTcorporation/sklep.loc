<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'orders_id',
        'products_id',
        'count',
        'countPrice',
        'quantity',
        'price',
        'product_code'
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    /**
     * Get the post that owns the comment.
     *
     * Syntax: return $this->belongsTo(Post::class, 'foreign_key', 'owner_key');
     *
     * Example: return $this->belongsTo(Post::class, 'post_id', 'id');
     *
     */
    public function product()
    {
        return $this->belongsTo(Product::class,'products_id', 'id');
    }

}
