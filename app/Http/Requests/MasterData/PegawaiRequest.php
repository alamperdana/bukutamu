<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PegawaiRequest extends FormRequest
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
        $kodesatker = session('kode_satker');
        $tahun = session('tahun', date('Y'));

        return [
            'nama_lengkap' => [
                'required',
                'string'
            ],
            'nip' => [
                'required',
                Rule::unique('pegawai')->where(function ($query) use ($kodesatker, $tahun) {
                    return $query->whereJsonContains('session_input', [
                        'tahun' => $tahun,
                        'kode_satker' => $kodesatker,
                        'username' => auth()->user()->username,
                    ]);
                })->ignore($this->route('pegawai'))
            ], 
            'pangkat_id' => [
                'required',
                'exists:pangkat,id'
            ],
            'jabatan' => [
                'required',
                'string'
            ],
            'satker_id' => [
                'required',
                'exists:satker,id'
            ]
        ];
    }

    /**
     * Customize the error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'pangkat_id.required' => 'Pangkat wajib dipilih.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'satker_id.required' => 'Instansi wajib dipilih.',
        ];
    }
}
