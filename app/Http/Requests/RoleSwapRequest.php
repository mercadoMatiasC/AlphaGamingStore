<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleSwapRequest extends FormRequest
{
    public function authorize(): bool {
        return $this->user()->hasRole('owner');
    }

    public function rules(): array {
        return [
            'role_id' => ['required', 'exists:roles,id'],
        ];
    }
}
