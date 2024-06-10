<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContributionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => 'required|string|min:1|max:50000',
            'item_id' => 'required|integer|numeric|exists:items,id',
            'proprietary_id' => 'sometimes|integer|numeric|exists:proprietaries,id',
            'validation' => 'sometimes|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'O campo conteúdo é obrigatório.',
        ];
    }
}
