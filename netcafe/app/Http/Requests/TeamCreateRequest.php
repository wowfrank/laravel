<?php

namespace Netcafe\Http\Requests;

use Netcafe\Http\Requests\Request;

class TeamCreateRequest extends Request
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
        $this->merge(['status' => $this->input('status', 0)]);

        // dd($this->input('status'));die;
        return [
            //
            'name'      => 'required',
            'phone'     => 'required|digits_between:10,12',
            'gender'    => 'required|boolean',
            'imgname'   => 'required',
        ];
    }
}
