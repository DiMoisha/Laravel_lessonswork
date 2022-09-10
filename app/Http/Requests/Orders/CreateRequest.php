<?php

namespace App\Http\Requests\Orders;

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
    #[ArrayShape(['sourceemail' => "string[]", 'customername' => "string[]",
        'customertel' => "string[]", 'customeremail' => "string[]",
        'description' => "string[]"])]
    public function rules(): array
    {
        return [
            'sourceemail' => ['required', 'string', 'min:5', 'max:255'],
            'customername' => ['required', 'string', 'min:5', 'max:255'],
            'customertel' => ['nullable', 'string', 'min:5', 'max:255'],
            'customeremail' => ['nullable', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'min:5']
        ];
    }

    /***
     * Get the validation Attributes that apply to the request.
     *
     * @return string[]
     */
    #[ArrayShape(['sourceemail' => "string", 'customername' => "string",
        'customertel' => "string", 'customeremail' => "string",
        'description' => "string"])]
    public function attributes(): array
    {
        return [
            'sourceemail' => 'E-mail источника',
            'customername' => 'Ваше имя',
            'customertel' => 'Номер телефона',
            'customeremail' => 'E-mail адрес',
            'description' => 'Какая информация вас интересует'
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
