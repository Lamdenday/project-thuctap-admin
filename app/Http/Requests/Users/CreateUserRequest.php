<?php

namespace App\Http\Requests\Users;

use App\Rules\Users\PhoneNumberVnRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CreateUserRequest extends FormRequest
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
            'name' => 'bail|required|string|max:255',
            'phone_number' => ['bail', 'required', new PhoneNumberVnRule()],
            'email' => 'bail|required|string|email:filter|max:255|unique:users',
            'password' => 'bail|required|min:8|confirmed',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new Response([
            'errors' => $validator->errors()
        ], Response::HTTP_UNPROCESSABLE_ENTITY);

        throw (new ValidationException($validator, $response));
    }
}
