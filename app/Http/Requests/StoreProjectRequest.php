<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            //mi accerto che il type_id esista nella tabella types, nella colonna id
            'type_id' => 'required|exists:types,id',
            //controllo che la technology che arriva dal form sia contenuto nella tabella delle technologies per essere valido
            'technologies' => 'exists:technologies,id',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'title.require' => 'The Title is mandatory',
            'title.string' => 'The Title must be a text',
            'title.max' => 'The Title must be a maximum of :max characters',
            'content.require' => 'The Content is mandatory',
            'content.string' => 'The Content must be a text',
            'type_id.required' => 'The Type field is required',
            'type_id.exists' => 'The Type must be one of the avaiable options',
        ];
    }
}
