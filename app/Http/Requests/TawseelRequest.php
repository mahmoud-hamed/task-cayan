<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TawseelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'refrenceCode' => 'unique:clients,refrenceCode',
            'identityTypeId' => 'required',
            'idNumber' =>  ['unique:tawseels,idNumber,' . auth()->user()->id, 'required', 'regex:/^[12]\d{9}$/'],
            'dateOfBirth' => 'required',
            'regionId' => 'required',
            'phone' => ['regex:/^05\d{8}$/'],

            'carTypeId' => 'required',
            'cityId' => 'required',
            'carNumber' =>  'unique:tawseels,carNumber,' . auth()->user()->id,
            'vehicleSequenceNumber' => 'unique:tawseels,vehicleSequenceNumber,' . auth()->user()->id,
            'identityType' => 'nullable',
            'region' => 'nullable',
            'carType' => 'nullable',
            'city' => 'nullable',
            'name'=>'required',

        ];
    }

    public function messages(): array
    {
        return [
            'idNumber.regex' => __('apis.id_12'),
            'phone.regex' => __('apis.phone_05'),
            'idNumber.unique' => __('apis.idNumber'),
            'carNumber.unique' => __('apis.carNumber'),
            'vehicleSequenceNumber.unique' => __('apis.vehicleSequenceNumber'),
            'idNumber.regex' => 'The ID number must start with 1 or 2 and have a length of 10 digits.',
            'phone.regex' => 'The phone number must start with "05" and have a length of 10 digits.',

        ];
    }



    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $firstError = $errors->first();

        throw new HttpResponseException(response()->json(['error' => $firstError], 422));
    }
}
