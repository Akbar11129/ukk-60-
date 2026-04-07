<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'user_type' => ['required', 'in:admin,siswa'],
            'username' => ['nullable', 'required_if:user_type,admin', 'string'],
            'nis' => ['nullable', 'required_if:user_type,siswa', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'user_type.required' => 'Pilih tipe login Anda',
            'user_type.in' => 'Tipe login tidak valid',
            'username.required_if' => 'Username harus diisi',
            'nis.required_if' => 'NIS harus diisi',
            'password.required' => 'Password harus diisi',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $userType = $this->input('user_type');

        if ($userType === 'admin') {
            if (! Auth::guard('admin')->attempt([
                'username' => $this->input('username'),
                'password' => $this->input('password'),
            ], $this->boolean('remember'))) {
                RateLimiter::hit($this->throttleKey());

                throw ValidationException::withMessages([
                    'password' => trans('auth.failed'),
                ]);
            }
        } elseif ($userType === 'siswa') {
            if (! Auth::guard('siswa')->attempt([
                'nis' => $this->input('nis'),
                'password' => $this->input('password'),
            ], $this->boolean('remember'))) {
                RateLimiter::hit($this->throttleKey());

                throw ValidationException::withMessages([
                    'password' => trans('auth.failed'),
                ]);
            }
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'password' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for this request.
     */
    protected function throttleKey(): string
    {
        $key = $this->input('user_type') === 'admin'
            ? $this->input('username')
            : $this->input('nis');

        return 'login.attempts.' . $key . '.' . $this->ip();
    }
}
