<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PptkRequest extends FormRequest
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
            'nama_lengkap' => 'required|string',
            'nip' => [
                'required',
                'numeric',
                'digits:18'
            ],
            'pangkat_id' => 'required|exists:pangkat,id',
            'jabatan' => 'required|string',
            'subkegiatan_id' => [
                'required',
                Rule::unique('pptk')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                })->ignore($this->route('pptk')),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.string' => 'Nama harus berupa teks.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.numeric' => 'NIP berupa angka dan tanpa spasi.',
            'nip.digits' => 'NIP harus terdiri dari 18 angka.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'pangkat_id.required' => 'Pangkat wajib dipilih.',
            'pangkat_id.exists' => 'Pangkat tidak valid.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'jabatan.string' => 'Jabatan harus berupa teks.',
            'subkegiatan_id.required' => 'Subkegiatan wajib dipilih.',
            'subkegiatan_id.unique' => 'Subkegiatan ini sudah memiliki PPTK.',
        ];
    }
}
