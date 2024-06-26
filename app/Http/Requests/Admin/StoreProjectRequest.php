<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:3'],
            'description' => ['required'],
            'type_id' => 'required',
            'technologies' => ['nullable', 'exists:technologies,id']
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Il titolo non può essere vuoto',
            'title.min' =>  'Il titolo non può essere minore di tre caratteri',
            'description.required' => 'La descrizione è richiesta',
            'type_id.required' => 'Il tipo è richiesto',
            'technologies' => 'La tecnologia inserita non è corretta'
        ];
    }
}
