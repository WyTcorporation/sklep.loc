<?php

namespace App\Modules\Admin\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Banners extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'link',
        'src',
        'alt',
        'title',
        'text',
        'button',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
