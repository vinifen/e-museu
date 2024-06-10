<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class UpdateItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $itemId = $this->route()->parameter('item') ?? null;

        return [
            'name' => [
                'required',
                'string',
                'min:1',
                'max:200',
                Rule::unique('items')->ignore($itemId),
            ],
            'date' => 'date',
            'description' => 'required|string|min:1|max:1000',
            'detail' => 'required|string|min:1|max:10000',
            'history' => 'required|string|min:1|max:50000',
            'section_id' => 'required|integer|numeric|exists:sections,id',
            'proprietary_id' => 'required|integer|numeric|exists:proprietaries,id',
            'identification_code' => 'required|string|min:1|max:50',
            'validation' => 'required|boolean',
            'image' => 'sometimes|image|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'data.required' => 'O campo data é obrigatório.',
            'description.required' => 'O campo descrição é obrigatório.',
            'detail.required' => 'O campo detalhes é obrigatório.',
            'history.required' => 'O campo história é obrigatório.',
            'section_id.required' => 'O campo seção é obrigatório.',
            'validation.required' => 'O campo validado é obrigatório.',
            'identification_code.required' => 'O campo código de identificação é obrigatório.',
            'proprietary_id.required' => 'O campo proprietário é obrigatório.',
        ];
    }
}
