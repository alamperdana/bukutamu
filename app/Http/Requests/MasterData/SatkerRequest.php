<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SatkerRequest extends FormRequest
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
            'kode_satker' => [
                'required',
                'string',
                'size:22',
                Rule::unique('satker')->ignore($this->route('satker'))
            ],
            'name' => 'required'
        ];
    }

    /**
     * Customize the error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'kode_satker.required' => 'Kode Satker wajib diisi.',
            'kode_satker.string' => 'Kode Satker harus berupa string.',
            'kode_satker.size' => 'Kode Satker harus 22 karakter.',
            'kode_satker.unique' => 'Kode Satker sudah digunakan.',
            'name.required' => 'Nama satker wajib diisi.'
        ];
    }
}
