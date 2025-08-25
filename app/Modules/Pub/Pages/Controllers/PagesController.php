<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 16:40:45
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Pub\Pages\Controllers;


use App\Modules\Pub\Base;
use App\Modules\Pub\Pages\Models\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PagesController extends Base
{
    /**
     * PagesController constructor.
     */

    /**
     * Display the specified resource.
     *
     * @param Page $page
     * @return Application|Factory|View
     */
    public function show(Page $page): View|Factory|Application
    {
        $this->title = $page->meta_title;
        $this->meta_description = $page->meta_desc;
        $this->meta_keys = $page->meta_key;
        $this->content  = view('Pub::Pages.show')->with([
            'title' => $this->title,
            'page' => $page
        ])->render();
        return $this->renderOutput();
    }

}
