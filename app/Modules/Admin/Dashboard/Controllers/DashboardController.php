<?php

namespace App\Modules\Admin\Dashboard\Controllers;

use App\Modules\Admin\Dashboard\Classes\Base;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class DashboardController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {

        $this->title = __("admin.dashboard_title_page");
        $this->content  = view('Admin::Dashboard.index')->with([
            'title' => $this->title
        ])->render();

        return $this->renderOutput();
    }

}
