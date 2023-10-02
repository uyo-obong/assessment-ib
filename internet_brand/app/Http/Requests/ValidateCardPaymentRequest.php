<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;

class ValidateCardPaymentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'card_name' => 'required|min:3|max:50',
            'card_number' => 'required|min:15|max:19',
            'card_cvv' => 'required|min:3|max:4',
            'card_expiry_month' => 'required|numeric|between:1,12',
            'card_expiry_year' => 'required|numeric',
        ];
    }

    public function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => $validator->errors(),
        ], 400));
    }
}
