<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 17:34:38
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Admin\Pages\Policies;

use App\Modules\Admin\Pages\Models\Page;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
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

    public function view(Page $page) {
        return $page->canDo(['SUPER_ADMIN','PAGE_ACCESS']);
    }

    public function create(Page $page) {
        return $page->canDo(['SUPER_ADMIN','PAGE_ACCESS']);
    }

    public function edit(Page $page) {
        return $page->canDo(['SUPER_ADMIN','PAGE_ACCESS']);
    }

    public function delete(Page $page) {
        return $page->canDo(['SUPER_ADMIN','ROLES_ACCESS']);
    }
}
