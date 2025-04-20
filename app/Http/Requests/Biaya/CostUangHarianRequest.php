<?php

namespace App\Http\Requests\Biaya;

use Illuminate\Foundation\Http\FormRequest;

class CostUangHarianRequest extends FormRequest
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
            'tujuan' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
            'lev_1' => 'required|numeric|min:0',
            'lev_2' => 'required|numeric|min:0',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'tujuan.required' => 'Tujuan wajib diisi.',
            'tujuan.string' => 'Tujuan harus berupa teks.',
            'tujuan.max' => 'Tujuan tidak boleh lebih dari 255 karakter.',
            'satuan.required' => 'Satuan wajib diisi.',
            'satuan.string' => 'Satuan harus berupa teks.',
            'satuan.max' => 'Satuan tidak boleh lebih dari 255 karakter.',
            'lev_1.required' => 'Biaya untuk SKPD & Lainnya wajib diisi.',
            'lev_1.numeric' => 'Biaya untuk SKPD & Lainnya harus berupa angka.',
            'lev_1.min' => 'Biaya untuk SKPD & Lainnya tidak boleh kurang dari 0.',
            'lev_2.required' => 'Biaya untuk Inspektorat wajib diisi.',
            'lev_2.numeric' => 'Biaya untuk Inspektorat harus berupa angka.',
            'lev_2.min' => 'Biaya untuk Inspektorat tidak boleh kurang dari 0.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $cleanedData = [];

        foreach ($this->input() as $key => $value) {
            if (in_array($key, ['lev_1', 'lev_2'])) {
                $cleanedValue = str_replace(['.', ','], ['', ''], $value ?? '');
                $cleanedData[$key] = intval($cleanedValue);
            } else {
                $cleanedData[$key] = $value;
            }
        }

        $this->merge($cleanedData);
    }
}
