<?php

namespace App\Providers;

use App\Models\User;
use App\Modules\Admin\Larder\Models\Larder;
use App\Modules\Admin\Larder\Policies\LarderPolicy;
use App\Modules\Admin\Menu\Models\Menu;
use App\Modules\Admin\Menu\Policies\MenuPolicy;
use App\Modules\Admin\News\Models\News;
use App\Modules\Admin\News\Policies\NewsPolicy;
use App\Modules\Admin\Pages\Models\Page;
use App\Modules\Admin\Pages\Policies\PagePolicy;
use App\Modules\Admin\Product\Models\CategoryProduct;
use App\Modules\Admin\Product\Models\Product;
use App\Modules\Admin\Product\Policies\ProductPolicy;
use App\Modules\Admin\Role\Models\Role;
use App\Modules\Admin\Role\Policies\RolePolicy;
use App\Modules\Admin\User\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Role::class => RolePolicy::class,
        User::class => UserPolicy::class,
        Menu::class => MenuPolicy::class,
        Page::class => PagePolicy::class,
        News::class => NewsPolicy::class,
        Product::class => ProductPolicy::class,
        CategoryProduct::class => ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::tokensExpireIn(now()->addSeconds(30000000));
        Passport::refreshTokensExpireIn(now()->addDays(30));

        Passport::personalAccessTokensExpireIn(now()->addSeconds(100000));

        //
    }
}
