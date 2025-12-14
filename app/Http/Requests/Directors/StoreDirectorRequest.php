<?php

namespace App\Http\Requests\Directors;

use Illuminate\Foundation\Http\FormRequest;

class StoreDirectorRequest extends FormRequest
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
            'DirectorName' => 'required|string|max:55',
            'DirectorNationality' => 'nullable|string|max:55',
            'DirectorDate' => 'nullable|date',
            "DirectorAvatar" => "nullable|file"
        ];
    }
    public function messages(): array
    {
        return [
            "DirectorName.required" => "Không được để trống!",
            "DirectorName.max" => "Tên không được phép vượt 55 ký tự!"
        ];
    }
}
