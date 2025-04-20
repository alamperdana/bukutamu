<?php

namespace App\Http\Requests\Biaya;

use Illuminate\Foundation\Http\FormRequest;

class CostHarianRequest extends FormRequest
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
            'eselon_3' => 'required|numeric|min:0',
            'eselon_4' => 'required|numeric|min:0',
            'gol_4' => 'required|numeric|min:0',
            'gol_3' => 'required|numeric|min:0',
            'gol_2' => 'required|numeric|min:0',
            'gol_1' => 'required|numeric|min:0',
            'tkk' => 'required|numeric|min:0',
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
            'eselon_3.required' => 'Biaya untuk Eselon 3 wajib diisi.',
            'eselon_3.numeric' => 'Biaya untuk Eselon 3 harus berupa angka.',
            'eselon_3.min' => 'Biaya untuk Eselon 3 tidak boleh kurang dari 0.',
            'eselon_4.required' => 'Biaya untuk Eselon 4 wajib diisi.',
            'eselon_4.numeric' => 'Biaya untuk Eselon 4 harus berupa angka.',
            'eselon_4.min' => 'Biaya untuk Eselon 4 tidak boleh kurang dari 0.',
            'gol_4.required' => 'Biaya untuk Golongan 4 wajib diisi.',
            'gol_4.numeric' => 'Biaya untuk Golongan 4 harus berupa angka.',
            'gol_4.min' => 'Biaya untuk Golongan 4 tidak boleh kurang dari 0.',
            'gol_3.required' => 'Biaya untuk Golongan 3 wajib diisi.',
            'gol_3.numeric' => 'Biaya untuk Golongan 3 harus berupa angka.',
            'gol_3.min' => 'Biaya untuk Golongan 3 tidak boleh kurang dari 0.',
            'gol_2.required' => 'Biaya untuk Golongan 2 wajib diisi.',
            'gol_2.numeric' => 'Biaya untuk Golongan 2 harus berupa angka.',
            'gol_2.min' => 'Biaya untuk Golongan 2 tidak boleh kurang dari 0.',
            'gol_1.required' => 'Biaya untuk Golongan 1 wajib diisi.',
            'gol_1.numeric' => 'Biaya untuk Golongan 1 harus berupa angka.',
            'gol_1.min' => 'Biaya untuk Golongan 1 tidak boleh kurang dari 0.',
            'tkk.required' => 'Biaya untuk TKK wajib diisi.',
            'tkk.numeric' => 'Biaya untuk TKK harus berupa angka.',
            'tkk.min' => 'Biaya untuk TKK tidak boleh kurang dari 0.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $cleanedData = [];

        foreach ($this->input() as $key => $value) {
            if (in_array($key, ['walkot', 'sekda', 'eselon_2', 'eselon_3', 'eselon_4', 'gol_4', 'gol_3', 'gol_2', 'gol_1', 'tkk'])) {
                $cleanedValue = str_replace(['.', ','], ['', ''], $value ?? '');
                $cleanedData[$key] = intval($cleanedValue);
            } else {
                $cleanedData[$key] = $value;
            }
        }

        $this->merge($cleanedData);
    }
}
