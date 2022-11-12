<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'userId.required' => 'Не указан id пользователя',
            'userId.int'      => 'Не верный тип данных',
            'event.required'  => 'Не указано событие',
            'event.array'     => 'Не верный тип данных',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'userId' => 'int|required',
            'event'  => 'array:xmlId,name|required',
        ];
    }
}
