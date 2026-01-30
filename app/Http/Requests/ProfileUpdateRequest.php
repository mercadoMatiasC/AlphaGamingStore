<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        $user = $this->user();

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id),],
            'personal_id' => ['nullable', 'string', 'max:50', function ($attribute, $value, $fail) use ($user) {
                    if ($user->personal_IDSet() && $value !== $user->personal_id && !$user->hasAnyRole(['owner', 'admin']))
                        $fail('No tenés permisos para modificar este campo.');
                    },
            ],
        ];
    }
}