<?php

namespace App\Modules\Admin\Product\Models;

use App\Models\Comments;
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
        'meta_keys',
        'product_code',
        'new',
        'hit',
        'status'
    ];

//    public function getRouteKeyName()
//    {
//        return 'url';
//    }

    public function categoryProduct(): BelongsTo
    {
        return $this->belongsTo(CategoryProduct::class);
    }

    public function images(): hasMany
    {
        return $this->hasMany(Images::class)->orderBy('sort_order');
    }

    public function mainImage(): hasOne
    {
        return $this->hasOne(Images::class)->where('is_main', true);
    }

    public function comments():hasMany
    {
        return $this->hasMany(Comments::class,'products_id', 'id');
    }
}

