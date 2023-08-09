<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'company_name' => ['required', 'max:50'],
            'pic_name' => ['required', 'max:50'],
            'pic_kana'=> ['required', 'max:50', 'regex:/\A[ァ-ヴー\　]+\z/u'],
            'gender'=> ['required'],
            'tel' => ['required', 'max:20', 'unique:customers,tel'],
            'email' => ['required', 'email', 'max:255', 'unique:customers,email'],
            'postcode' => ['required', 'max:7'],
            'address' => ['required', 'max:100'],
            'startDate' => ['date'],
            'memo' => ['max:1000'],
        ];
    }
}
