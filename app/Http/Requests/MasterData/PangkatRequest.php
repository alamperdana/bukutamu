<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class PangkatRequest extends FormRequest
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
            'pangkat' => 'required|string',
            'golongan' => 'required|string',
            'pnsyes' => 'required'
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'pangkat.required' => 'Kolom pangkat wajib diisi.',
            'golongan.required' => 'Kolom golongan wajib diisi.',
            'pnsyes.required' => 'Tipe ASN wajib diisi.'
        ];
    }
}
