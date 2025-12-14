<?php

namespace App\Http\Requests\ActorRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreActorReqeust extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'ActorName' => 'required|string|max:55',
            // 'ActorNationality' => 'nullable|string|max:55',
            // 'ActorDate' => 'nullable|date',
            // "ActorAvatar" => "nullable|file"
        ];
    }
    public function messages(): array
    {
        return [
            // "ActorName.required" => "Không được để trống!",
            // "ActorName.max" => "Tên không được phép vượt 55 ký tự!"
        ];
    }
}
