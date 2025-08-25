<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Categories extends Model
{
    use HasFactory;

   protected $table = 'category_products';

    /**
     * @var mixed
     */
    public $parent;

    protected $fillable = [
        'title',
        'parent_id',
        'sort_order',
        'url',
        'meta_title',
        'meta_description',
        'meta_keys',
    ];

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function products(): hasMany
    {
        return $this->hasMany(Product::class,'category_product_id','id');
    }

    public function parent(): belongsTo
    {
//        return $this->belongsTo(__CLASS__, 'parent_id')->where('parent_id')->with('parent');
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(__CLASS__, 'parent_id')->with('children');
    }
}
