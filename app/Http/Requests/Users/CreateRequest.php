<?php

namespace App\Http\Requests\Users;

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
    #[ArrayShape(['name' => "string[]", 'email' => "string[]", 'password' => "string[]",
        'confirmPassword' => "string[]", 'is_admin' => "string[]"])]
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'min:5', 'max:255'],
            'password' => ['required_with:confirmPassword', 'string', 'same:confirmPassword', 'min:8'],
            'confirmPassword' => ['required', 'string', 'min:8'],
            'is_admin' => ['required', 'integer', 'digits_between:0,10']
        ];
    }

    #[ArrayShape(['name' => "string", 'email' => "string", 'password' => "string",
        'confirmPassword' => "string", 'is_admin' => "string"])]
    public function attributes(): array
    {
        return [
            'name' => 'Имя пользователя',
            'email' => 'Электронная почта',
            'password' => 'Пароль',
            'confirmPassword' => 'Подтверждение пароля',
            'is_admin' => 'Права'
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
