<?php

namespace App\Http\Requests\System;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $validate = [];
        if ($request->method() == 'POST') {

            $validate = [
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8',
                'confirm_password' => 'required|string|min:8|same:password',
                'bio' => 'max:255|nullable',

            ];
        }
        if ($request->method() == 'PUT') {
            $validate = [
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username,' . $request->user,
                'email' => 'required|email|unique:users,email,' . $request->user,
                'bio' => 'max:255|nullable',
            ];
        }
        return $validate;
    }

    public function messages()
    {
        return [];
    }
}
