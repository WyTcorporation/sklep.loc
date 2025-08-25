<?php

namespace App\Models;

use App\Modules\Admin\Product\Models\Images;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'characteristics',
        'category_product_id',
        'price',
        'url',
        'meta_title',
        'meta_description',
        'meta_keys'
    ];

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function categoryProduct(): BelongsTo
    {
        return $this->belongsTo(Categories::class);
    }

    public function images(): hasMany
    {
        return $this->hasMany(Images::class)->orderBy('id');
    }

    public function ordersProducts():hasMany
    {
        return $this->hasMany(OrdersProducts::class);
    }

    public function comments():hasMany
    {
        return $this->hasMany(Comments::class,'products_id', 'id');
    }
}

