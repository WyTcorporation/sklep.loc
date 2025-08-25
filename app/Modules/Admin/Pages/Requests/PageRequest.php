<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 17:17:04
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

namespace App\Modules\Admin\Pages\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->canDo(['SUPER_ADMINISTRATOR','PAGE_ACCESS']);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'meta_title' => 'required',
            'meta_key' => 'required',
            'meta_desc' => 'required',
            'alias' => 'required',
            'title' => 'required',
            'content' => 'required'
        ];
    }
}
