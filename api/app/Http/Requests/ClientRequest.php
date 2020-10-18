<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Urameshibr\Requests\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;

class ClientRequest extends FormRequest
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
            'name' => 'required|between:1,100',
            'email' => [
                'required',
                Rule::unique('clients','email')->ignore($this->input('id'))
            ],
            'selectedTags' => 'required'
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
