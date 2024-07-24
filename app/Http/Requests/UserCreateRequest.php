<?php

namespace App\Http\Requests;

use App\Constants\StatusCode;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ];
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json(['detail' => $validator->errors()->first()], StatusCode::UNPROCESSABLE_ENTITY));
    }
}
