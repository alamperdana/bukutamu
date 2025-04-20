<?php

namespace App\Http\Requests\MasterData;

use App\Models\Satker;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BelanjaRequest extends FormRequest
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
            'subkegiatan_id' => [
                'required',
                'exists:subkegiatan,id', 
            ],
            'kode_belanja' => [
                'required',
                Rule::unique('belanja')->where(function ($query) use ($kodesatker, $tahun) {
                    return $query->where('subkegiatan_id', $this->subkegiatan_id)
                        ->where('kode_belanja', $this->kode_belanja)
                        ->whereJsonContains('session_input', [
                            'tahun' => $tahun,
                            'kode_satker' => $kodesatker,
                            'username' => auth()->user()->username,
                        ]);
                })->ignore($this->route('rekening')),
            ],
            'rekening_belanja' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/',
            ]
        ];
    }

    /**
     * Customize the error messages for validation rules.
     */
    public function messages(): array
    {
        $kodesatker = session('kode_satker');
        $satker = Satker::where('kode_satker', $kodesatker)->first(); // Mengambil data satker berdasarkan kode_satker

        // Jika data satker ditemukan, ambil name-nya, jika tidak, default ke 'Kode Satker'
        $satker_name = $satker ? $satker->name : 'Kode Satker';
        
        return [
            'subkegiatan_id.required' => 'Sub Kegiatan wajib dipilih.',
            'subkegiatan_id.exists' => 'Sub Kegiatan yang dipilih tidak valid.',
            'kode_belanja.required' => 'Kode Belanja wajib diisi.',
            'kode_belanja.unique' => 'Kode Belanja ":input" untuk Sub Kegiatan ini pada Satker ' . $satker_name . ' sudah terdaftar.',
            'rekening_belanja.required' => 'Rekening Belanja wajib diisi.',
            'rekening_belanja.regex' => 'Nama Sub Kegiatan hanya boleh terdiri dari huruf dan spasi.',
        ];
    }
}
