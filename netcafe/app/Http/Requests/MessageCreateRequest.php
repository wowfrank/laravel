<?php

namespace Netcafe\Http\Requests;

use Netcafe\Http\Requests\Request;

class MessageCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
            'msg_content'   => 'required | max:255',
        ];
    }
}
