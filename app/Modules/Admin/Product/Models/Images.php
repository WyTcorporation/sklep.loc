<?php

namespace App\Modules\Admin\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Images  extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'path',
        'sort_order',
        'is_main'
    ];

    protected $casts = [
        'is_main' => 'boolean'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
