<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required',  'email', 'max:255',],
            'class_id' => ['required' ,'exists:classes,id'],
            'section_id' => ['required', 'exists:sections,id']
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'student name',
            'email' => 'student email',
            'class_id' => 'class',
            'section_id' => 'section'
        ];
    }
}
