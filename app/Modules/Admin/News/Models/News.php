<?php

namespace App\Modules\Admin\News\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
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
}
