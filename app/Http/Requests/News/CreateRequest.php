<?php

namespace App\Http\Requests\News;

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
    #[ArrayShape(['categoryid' => "string[]", 'feedsourceid' => "string[]", 'title' => "string[]",
        'description' => "string[]", 'author' => "string[]", 'image' => "string[]", 'status' => "string[]"])]
    public function rules():array
    {
        return [
            'categoryid' => ['required', 'integer', 'exists:categories,categoryid'],
            'feedsourceid' => ['nullable','integer', 'exists:feedsources,feedsourceid'],
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:3'],
            'author' => ['required', 'string', 'min:3', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,png'],
            'status' => ['required', 'string', 'min:5', 'max:10']
        ];
    }

    /***
     * Get the validation Attributes that apply to the request.
     *
     * @return string[]
     */
    #[ArrayShape(['categoryid' => "string", 'feedsourceid' => "string", 'title' => "string",
        'description' => "string", 'author' => "string", 'image' => "string", 'status' => "string"])]
    public function attributes(): array
    {
        return [
            'categoryid' => 'Выбрать категорию',
            'feedsourceid' => 'Выбрать источник новости',
            'title' => 'Заголовок',
            'description' => 'Содержание',
            'author' => 'Автор',
            'image' => 'Изображение',
            'status' => 'Статус'
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
