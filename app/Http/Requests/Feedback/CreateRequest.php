<?php

namespace App\Http\Requests\Feedback;

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
    #[ArrayShape(['sendername' => "string[]", 'senderemail' => "string[]", 'message' => "string[]"])]
    public function rules(): array
    {
        return [
            'sendername'  => ['required', 'string', 'min:2', 'max:255'],
            'senderemail' => ['nullable', 'string', 'min:5', 'max:255'],
            'message'     => ['required', 'min:5']
        ];
    }

    /***
     * Get the validation Attributes that apply to the request.
     *
     * @return string[]
     */
    #[ArrayShape(['sendername' => "string", 'senderemail' => "string", 'message' => "string"])]
    public function attributes(): array
    {
        return [
            'sendername' => 'Имя отправителя',
            'senderemail' => 'E-mail отправителя',
            'message' => 'Сообщение'
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
