<?php

namespace App\Http\Requests;

use App\Enums\Cuisine;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRecipeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'cuisine' => ['required', 'string', Rule::in(Cuisine::values())],
            'instructions' => ['required', 'string'],
            'ingredients' => ['required', 'array'],
        ];
    }
}
