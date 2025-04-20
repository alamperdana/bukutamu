<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BendaharaRequest extends FormRequest
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
                'numeric',
                'digits:18',
                Rule::unique('bendahara')->where(function ($query) use ($kodesatker, $tahun) {
                    return $query->whereJsonContains('session_input', [
                        'tahun' => $tahun,
                        'kode_satker' => $kodesatker,
                        'username' => auth()->user()->username,
                    ]);
                })->ignore($this->route('bendahara'))
            ], 
            'pangkat_id' => [
                'required',
                'exists:pangkat,id'
            ],
            'jabatan' => [
                'required',
                'string'
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
            'nama_lengkap.string' => 'Nama harus berupa teks.',
            'pangkat_id.required' => 'Pangkat wajib dipilih.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.numeric' => 'NIP berupa angka dan tanpa spasi.',
            'nip.digits' => 'NIP terdiri dari 18 angka.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'jabatan.required' => 'Jabatan wajib diisi.',
        ];
    }
}
