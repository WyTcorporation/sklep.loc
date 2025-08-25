<?php
/**
 * Created by WyTcorp.
 * NickName: WyTcorp
 * User: Vladyslav Gladyr
 * Date: 10.06.23
 * Email: wild.savedo@gmail.com
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'products_id',
        'fio',
        'starts',
        'content'
    ];

    /**
     * Get the post that owns the comment.
     *
     * Syntax: return $this->belongsTo(Post::class, 'foreign_key', 'owner_key');
     *
     * Example: return $this->belongsTo(Post::class, 'post_id', 'id');
     *
     */
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class,'products_id', 'id');
    }

}
