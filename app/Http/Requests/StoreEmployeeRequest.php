<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_code' => 'required|string|max:20|unique:users,employee_code',
            'departement_id' => 'required|exists:departemens,id',
            'position_id' => 'required|exists:positions,id',

            'name' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|max:100|unique:users,email',

            'phone' => 'nullable|string|max:20',
            'hire_date' => 'required|date',

            'status' => 'required|in:active,inactive',

            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
