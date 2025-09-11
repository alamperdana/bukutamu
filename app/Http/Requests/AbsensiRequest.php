<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbsensiRequest extends FormRequest
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
            'lokasi_layanan_id' => 'required', 
            'asal' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'no_telp' => 'required|numeric|digits_between:10,15',
            'layanan_id' => 'required',
            'catatan' => 'nullable|string|max:255',
            'photo_path' => 'nullable|string',
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
            'lokasi_layanan_id.required' => 'Lokasi Layanan wajib diisi.',
            'lokasi_layanan_id.exists' => 'Lokasi Layanan tidak valid.',
            'asal.required' => 'Asal wajib diisi.',
            'asal.string' => 'Asal harus berupa teks.',
            'asal.max' => 'Asal tidak boleh lebih dari 255 karakter.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'jabatan.string' => 'Jabatan harus berupa teks.',
            'jabatan.max' => 'Jabatan tidak boleh lebih dari 255 karakter.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'no_telp.required' => 'Nomor Telepon wajib diisi.',
            'no_telp.numeric' => 'Nomor Telepon harus berupa angka.',
            'no_telp.digits_between' => 'Nomor Telepon antara 10 hingga 15 digit.',
            'layanan_id.required' => 'Layanan wajib diisi.',
            'layanan_id.exists' => 'Layanan tidak valid.',
            'catatan.string' => 'Catatan harus berupa teks.',
            'catatan.max' => 'Catatan tidak boleh lebih dari 255 karakter.',
            'photo_path.string' => 'Foto harus berupa string.',
        ];
    }
}
