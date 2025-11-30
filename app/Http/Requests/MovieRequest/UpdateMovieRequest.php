<?php

namespace App\Http\Requests\MovieRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
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
            'MovieName' => 'required',
            'MovieYear' => 'required',
            'MovieDescription' => 'required',
            'MovieEvaluate' => 'required',
            'MovieStatus' => 'required|min:0|max:10',
            'MovieLink' => 'required|url',
            'GenreID' => 'required',
            "ActorID" => "required",
            "DirectorID" => "required",
            "CountryID" => "required",
            "TypeID" => "required",
             'MovieImage' => 'sometimes|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }
}
