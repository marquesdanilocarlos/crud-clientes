<?php

namespace App\Http\Requests\Auth;

use Urameshibr\Requests\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;

class RegisterRequest extends FormRequest
{
    /**
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|between:1,20',
            'last_name' => 'required|between:1,20',
            'email' => 'required|unique:App\Models\Auth\User,email|email',
            'password' => 'required|between:6,255',
            'gender' => 'required|in:m,f'
        ];
    }

    /**
     *
     * @return JSON
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
