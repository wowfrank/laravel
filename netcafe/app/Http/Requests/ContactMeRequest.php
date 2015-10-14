<?php

namespace Netcafe\Http\Requests;

use Netcafe\Http\Requests\Request;

class ContactMeRequest extends Request
{
    protected $redirect = '/#contact-form';

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
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ];
    }

    /**
     * Get the proper failed validation response for the request.
     * The reason why extending this method is because I dont wanna redirect->back().
     *
     * @param  array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    // public function response(array $errors)
    // {
    //     if ($this->ajax() || $this->wantsJson())
    //     {
    //         return new JsonResponse($errors, 422);
    //     }
    //     return $this->redirector->to($this->getRedirectUrl() . '#contact-form')
    //                                     ->withInput($this->except($this->dontFlash))
    //                                     ->withErrors($errors, $this->errorBag);
    // }
}
