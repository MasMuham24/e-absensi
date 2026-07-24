<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_code' => [
                'required',
                'string',
                'max:20',
                Rule::unique('users', 'employee_code')->ignore($this->route('employee')),
            ],

            'departement_id' => 'required|exists:departemens,id',
            'position_id' => 'required|exists:positions,id',

            'name' => 'required|string|max:100',

            'username' => [
                'required',
                'string',
                'max:50',
                Rule::unique('users', 'username')->ignore($this->route('employee')),
            ],

            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('users', 'email')->ignore($this->route('employee')),
            ],

            'phone' => 'nullable|string|max:20',
            'hire_date' => 'required|date',
            'status' => 'required|in:active,inactive',
            'password' => 'nullable|string|min:8|confirmed',
        ];
    }
}
