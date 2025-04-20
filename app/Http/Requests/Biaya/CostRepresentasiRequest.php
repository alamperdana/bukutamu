<?php

namespace App\Http\Requests\Biaya;

use Illuminate\Foundation\Http\FormRequest;

class CostRepresentasiRequest extends FormRequest
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
            'walkot' => 'required|numeric|min:0',
            'sekda' => 'required|numeric|min:0',
            'eselon_2' => 'required|numeric|min:0',
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
            'walkot.required' => 'Biaya untuk Walkot wajib diisi.',
            'walkot.numeric' => 'Biaya untuk Walkot harus berupa angka.',
            'walkot.min' => 'Biaya untuk Walkot tidak boleh kurang dari 0.',
            'sekda.required' => 'Biaya untuk Sekda wajib diisi.',
            'sekda.numeric' => 'Biaya untuk Sekda harus berupa angka.',
            'sekda.min' => 'Biaya untuk Sekda tidak boleh kurang dari 0.',
            'eselon_2.required' => 'Biaya untuk Eselon 2 wajib diisi.',
            'eselon_2.numeric' => 'Biaya untuk Eselon 2 harus berupa angka.',
            'eselon_2.min' => 'Biaya untuk Eselon 2 tidak boleh kurang dari 0.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $cleanedData = [];

        foreach ($this->input() as $key => $value) {
            if (in_array($key, ['walkot', 'sekda', 'eselon_2'])) {
                $cleanedValue = str_replace(['.', ','], ['', ''], $value ?? '');
                $cleanedData[$key] = intval($cleanedValue);
            } else {
                $cleanedData[$key] = $value;
            }
        }

        $this->merge($cleanedData);
    }
}
