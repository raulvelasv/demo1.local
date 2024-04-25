<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules():array
    {
        return [
            'file' => 'required',
            'label' => 'required',
            'description' => 'required',
            ];
    }

    public function messages(): array
    {
        return [
            'label.required' => 'El título es obligatorio',
            'file.required' => 'El archivo es obligatorio',
            'description.required' => 'La descripción es obligatoria',
        ];
    }
}
