<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 18:33:37
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Admin\News\Policies;

use App\Modules\Admin\News\Models\News;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(News $news) {
        return $news->canDo(['SUPER_ADMIN','NEWS_ACCESS']);
    }

    public function create(News $news) {
        return $news->canDo(['SUPER_ADMIN','NEWS_ACCESS']);
    }

    public function edit(News $news) {
        return $news->canDo(['SUPER_ADMIN','NEWS_ACCESS']);
    }

    public function delete(News $news) {
        return $news->canDo(['SUPER_ADMIN','ROLES_ACCESS']);
    }
}
