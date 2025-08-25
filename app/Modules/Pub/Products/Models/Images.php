<?php

namespace App\Modules\Pub\Products\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Images  extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'path'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
