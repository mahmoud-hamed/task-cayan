<?php

namespace App\Http\Requests;

use App\Rules\AgeCheck;
use App\Rules\SaudiIdNumber;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class completeProfileRequest extends FormRequest
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
            'name'=> 'required',
            'id_number' => ['required', new SaudiIdNumber],
            'birth_date'=> ['required',
            'date',
            Rule::unique('clients')->ignore($this->user()->id), // If you want to make sure it's unique among users
            new AgeCheck,]
            ,
            'id_image'=> ['required','image'],
            'profile_image'=> ['required','image'],
            'face_image'=> ['required','image'],
        ];


        
    }

    public function messages()
    {
        return [
            'birthdate.age_check' => 'The birthdate must be over 18 and below 60 years old.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $firstError = $errors->first();

        throw new HttpResponseException(response()->json(['error' => $firstError], 422));
    }
}
