<?php

namespace App\Modules\Admin\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'meta_title',
        'meta_key',
        'meta_desc',
        'alias',
        'title',
        'content',
    ];

    public function banners():hasMany
    {
        return $this->hasMany(Banners::class);
    }
}
