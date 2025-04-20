<?php

namespace App\Http\Requests\MasterData;

use App\Models\Satker;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SubKegiatanRequest extends FormRequest
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
            'kode_subkegiatan' => [
                'required',
                'size:17',
                Rule::unique('subkegiatan')->where(function ($query) use ($kodesatker, $tahun) {
                    return $query->where('instansi_anggaran', $this->instansi_anggaran)
                        ->where('kode_subkegiatan', $this->kode_subkegiatan)
                        ->whereJsonContains('session_input', [
                            'tahun' => $tahun,
                            'kode_satker' => $kodesatker,
                            'username' => auth()->user()->username,
                        ]);
                })->ignore($this->route('subkegiatan')),
            ],
            'subkegiatan' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'instansi_anggaran' => [
                'required'
            ]
        ];
    }

    /**
     * Customize the error messages for validation rules.
     */
    public function messages(): array
    {
        // Mendapatkan instansi_anggaran dari input form
        $instansi_anggaran = $this->input('instansi_anggaran');

        // Mencari nama satker berdasarkan instansi_anggaran
        $satker_name = Satker::where('kode_satker', $instansi_anggaran)->value('name');

        // Jika tidak ditemukan, default ke "instansi yang dipilih"
        $satker_name = $satker_name ?? 'instansi yang dipilih';
        return [
            'kode_subkegiatan.required' => 'Kode Sub Kegiatan wajib diisi.',
            'kode_subkegiatan.string' => 'Kode Sub Kegiatan harus berupa teks.',
            'kode_subkegiatan.size' => 'Kode Sub Kegiatan harus terdiri dari 17 karakter.',
            'kode_subkegiatan.unique' => 'Kode SubKegiatan ":input" untuk instansi pembeban anggaran "' . $satker_name . '" sudah terdaftar.',
            'subkegiatan.required' => 'Nama Sub Kegiatan wajib diisi.',
            'subkegiatan.regex' => 'Nama Sub Kegiatan hanya boleh terdiri dari huruf dan spasi.',
            'instansi_anggaran.required' => 'Instansi Pembeban Anggaran wajib diisi.',

        ];
    }
}
