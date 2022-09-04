<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['title' => "string[]", 'description' => "string[]", 'tabindex' => "string[]"])]
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['nullable', 'string', 'min:5'],
            'tabindex' => ['nullable', 'integer', 'min:1', 'max:1264'],
        ];
    }

    /***
     * Get the validation Attributes that apply to the request.
     *
     * @return string[]
     */
    #[ArrayShape(['title' => "string", 'description' => "string", 'tabindex' => "string"])]
    public function attributes(): array
    {
        return [
            'title' => 'Наименование',
            'description' => 'Описание',
            'tabindex' => 'Порядковый №'
        ];
    }

    /***
     * Validation messages
     *
     * @return string[][]
     */
    #[ArrayShape(['min' => "string[]", 'max' => "string[]"])]
    public function messages(): array
    {
        return [
            'min' => [
                'string'  => 'Поле :attribute должно быть не меньше :min символов.',
            ],
            'max' => [
                'string'  => 'Поле :attribute должно быть не больше :max символов.',
            ]
        ];
    }
}
