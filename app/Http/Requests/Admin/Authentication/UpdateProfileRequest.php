<?php

namespace App\Http\Requests\Admin\Authentication;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                Rule::unique('admins', 'email')->ignore($this->user()->id),
            ],

            'name' => ['nullable', 'string'],
            'password' => ['nullable', 'string', 'min:2', 'max:16']
        ];
    }
}
