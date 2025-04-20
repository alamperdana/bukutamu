<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'username' => ['required', Rule::unique('users')->ignore($this->user)],
            'email' => ['required', Rule::unique('users')->ignore($this->user)],
            'kode_satker' => 'required',
            'password' => [Rule::requiredIf(function() {
                return request()->routeIs('master-data.users.store');
            }), 'confirmed'],
            'roles' => 'required|array',
        ];
    }

    /**
     * Pesan error.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'username.required'  => 'Username wajib diisi.',
            'username.unique'  => 'Username sudah digunakan.',
            'email.required'  => 'Email wajib diisi.',
            'email.unique'  => 'Email sudah digunakan.',
            'kode_satker.required'  => 'Satuan Kerja wajib diisi.',
            'password.requiredIf'  => 'Password wajib diisi.',
            'password.confirmed'  => 'Konfirmasi Password tidak sama.',
            'roles.required' => 'Minimal satu role harus dipilih.',
        ];
    }
}
