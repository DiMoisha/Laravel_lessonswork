<?php

namespace App\Http\Requests\Feedsources;

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
    #[ArrayShape(['sourcename' => "string[]", 'sourceurl' => "string[]"])]
    public function rules(): array
    {
        return [
            'sourcename' => ['required', 'string', 'min:5', 'max:255'],
            'sourceurl'  => ['nullable', 'string', 'min:5']
        ];
    }

    /***
     * Get the validation Attributes that apply to the request.
     *
     * @return string[]
     */
    #[ArrayShape(['sourcename' => "string", 'sourceurl' => "string"])]
    public function attributes(): array
    {
        return [
            'sourcename' => 'Наименование источника',
            'sourceurl' => 'URL источника'
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
