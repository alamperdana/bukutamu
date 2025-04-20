<?php

namespace App\Http\Requests\Auth;

use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
            'tahun' => ['required', 'exists:tahun,tahun'],
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();
    
        $login_name = filter_var($this->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    
        $this->merge([
            $login_name => $this->input('login')
        ]);
    
        if (!Auth::attempt($this->only($login_name, 'password'), $this->boolean('remember'))) {
    
            RateLimiter::hit($this->throttleKey());
    
            throw ValidationException::withMessages([
                'login' => trans('auth.failed'),
            ]);
        }
    
        $user = Auth::user();
    
        // Simpan session ID ke database
        $user->session_id = Session::getId();
        $user->save();
    
        // Simpan tahun dan kode satker ke session Laravel
        session([
            'tahun' => $this->input('tahun'),
            'kode_satker' => $user->kode_satker,
        ]);
    
        RateLimiter::clear($this->throttleKey());
    }

    protected function logoutPreviousSession($sessionId)
    {
        Session::getHandler()->destroy($sessionId);
    }

    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'login' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('login')) . '|' . $this->ip());
    }
}
