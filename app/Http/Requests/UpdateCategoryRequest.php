<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('category')?->id ?? null;

        return [
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,' . $id],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome da categoria é obrigatório.',
            'name.unique' => 'Já existe uma categoria com esse nome.',
            'name.max' => 'O nome da categoria deve ter no máximo 255 caracteres.',
        ];
    }
}
