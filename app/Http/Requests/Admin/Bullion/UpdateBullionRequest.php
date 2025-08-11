<?php

namespace App\Http\Requests\Admin\Bullion;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBullionRequest extends FormRequest
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
            
            'status' => 'nullable|boolean',
            'icon' =>['nullable', 'image', 'max:5048'],
            'ordering' => 'nullable|integer',
            'percentage_increase'=>'nullable|numeric'
        ];
    }
}
