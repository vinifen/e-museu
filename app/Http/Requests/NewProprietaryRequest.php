<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;


class NewProprietaryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->route())
            $proprietaryId = $this->route()->parameter('proprietary');

        return [
            'full_name' => 'required|string|min:1|max:200',
            'contact' => [
                'required',
                'email:rfc,dns',
                'min:1',
                'max:200',
                Rule::unique('proprietaries')->ignore($proprietaryId),
            ],
            'blocked' => 'sometimes|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'O campo Nome Completo é obrigatório.',
            'contact.required' => 'O campo Email é obrigatório.',
        ];
    }
}
