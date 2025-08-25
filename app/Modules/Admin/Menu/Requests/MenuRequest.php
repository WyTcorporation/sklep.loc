<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 31.07.2022
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Admin\Menu\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->canDo(['SUPER_ADMINISTRATOR','MENU_ACCESS']);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'title' => 'required',
            'path' => 'required',
            'parent' => 'required',
            'type' => 'required',
            'sort_order' => 'required'
        ];
    }
}
