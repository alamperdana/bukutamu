<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class PaguRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan untuk membuat request ini.
     */
    public function authorize(): bool
    {
        return true; // Atur ke true jika ingin semua pengguna bisa mengakses request ini
    }

    /**
     * Persiapkan data input sebelum validasi.
     */
    protected function prepareForValidation()
    {
        $cleanedPagu = [];

        foreach ($this->input('pagu', []) as $index => $pagu) {
            $cleanedAmount = str_replace(['.', ','], ['', '.'], $pagu['amount'] ?? '');
            $cleanedAmount = intval($cleanedAmount);

            $cleanedPagu[$index] = [
                'amount' => $cleanedAmount,
                'description' => $pagu['description'] ?? null,
            ];
        }

        $this->merge(['pagu' => $cleanedPagu]);
    }

    /**
     * Mendapatkan aturan validasi untuk request ini.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pagu' => 'required|array', // Pastikan `pagu` adalah array
            'pagu.*.amount' => 'required|numeric|min:0', // Pastikan amount adalah angka dan minimal 0
            'pagu.*.description' => 'nullable|string|max:255', // Keterangan opsional, jika ada maksimal 255 karakter
        ];
    }

    /**
     * Sesuaikan pesan error untuk aturan validasi.
     */
    public function messages(): array
    {
        return [
            'pagu.required' => 'Anda harus menambahkan minimal satu pagu.',
            'pagu.array' => 'Format input pagu tidak valid.',
            'pagu.*.amount.required' => 'Nilai pagu wajib diisi.',
            'pagu.*.amount.numeric' => 'Nilai pagu harus berupa angka.',
            'pagu.*.amount.min' => 'Nilai pagu harus lebih besar dari 0.',
            'pagu.*.description.string' => 'Keterangan harus berupa teks.',
            'pagu.*.description.max' => 'Keterangan maksimal 255 karakter.',
        ];
    }
}
