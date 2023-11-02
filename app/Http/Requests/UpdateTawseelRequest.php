<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateTawseelRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'refrenceCode' => 'unique:clients,refrenceCode',
            'identityTypeId' => 'nullable',
            'dateOfBirth' => 'nullable',
            'regionId' => 'nullable',
            'carTypeId' => 'nullable',
            'cityId' => 'nullable',
            'carNumber' =>  'nullable',
            'vehicleSequenceNumber' => 'nullable',

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $firstError = $errors->first();

        throw new HttpResponseException(response()->json(['error' => $firstError], 422));
    }
}
