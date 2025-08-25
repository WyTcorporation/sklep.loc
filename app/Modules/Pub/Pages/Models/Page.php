<?php

namespace App\Modules\Pub\Pages\Models;

use App\Modules\Admin\Pages\Models\Banners;
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

    public function getRouteKeyName()
    {
        return 'alias';
    }

    public function banners():hasMany
    {
        return $this->hasMany(Banners::class);
    }
}
