<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 31.07.2022
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Admin\Role\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'permission_id',
        'menu_id',
    ];
}
