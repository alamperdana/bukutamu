<?php

namespace App\Http\Requests\Biaya;

use Illuminate\Foundation\Http\FormRequest;

class CostTaxiRequest extends FormRequest
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
            'harga' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:255',
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
            'harga.required' => 'Biaya untuk Taxi wajib diisi.',
            'harga.numeric' => 'Biaya untuk Taxi harus berupa angka.',
            'harga.min' => 'Biaya untuk Taxi tidak boleh kurang dari 0.',
            'satuan.required' => 'Satuan wajib diisi.',
            'satuan.string' => 'Satuan harus berupa teks.',
            'satuan.max' => 'Satuan tidak boleh lebih dari 255 karakter.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $cleanedData = [];

        foreach ($this->input() as $key => $value) {
            if (in_array($key, ['harga'])) {
                $cleanedValue = str_replace(['.', ','], ['', ''], $value ?? '');
                $cleanedData[$key] = intval($cleanedValue);
            } else {
                $cleanedData[$key] = $value;
            }
        }

        $this->merge($cleanedData);
    }
}
