<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Na API já está protegido por auth:sanctum e no Web por auth middleware
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'tag' => ['required', 'string', 'max:255'],
            'summary' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O título é obrigatório.',
            'title.max' => 'O título deve ter no máximo 255 caracteres.',

            'tag.required' => 'A tag é obrigatória.',
            'tag.max' => 'A tag deve ter no máximo 255 caracteres.',

            'summary.required' => 'O resumo é obrigatório.',
            'summary.max' => 'O resumo deve ter no máximo 255 caracteres.',

            'content.required' => 'O conteúdo é obrigatório.',

            'category_id.required' => 'A categoria é obrigatória.',
            'category_id.exists' => 'A categoria informada não existe.',
        ];
    }
}
