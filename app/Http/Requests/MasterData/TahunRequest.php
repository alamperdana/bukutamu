<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TahunRequest extends FormRequest
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

    public function rules()
    {
        return [
            'tahun' => 'required|integer|digits:4|unique:tahun,tahun,' . $this->route('tahun')
        ];
    }

    /**
     * Pesan error.
     */
    public function messages(): array
    {
        return [
            'tahun.required' => 'Tahun wajib diisi.',
            'tahun.integer'  => 'Tahun harus berupa angka.',
            'tahun.digits' => 'Tahun harus terdiri dari 4 angka.',
            'tahun.unique'   => 'Tahun sudah ada.',
        ];
    }
}
