<?php

namespace App\Http\Requests\Api;

use App\Constants\StatusCode;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $segments = $this->segments();
        if(in_array('update', $segments)) {
            return [
                'name' => 'required|min:4|max:160',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ];
        } else {
            return [
                'name' => 'required|min:4|max:160',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ];
        }
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json(['detail' => $validator->errors()->first()], StatusCode::UNPROCESSABLE_ENTITY));
    }

}
