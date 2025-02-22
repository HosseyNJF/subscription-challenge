<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:512', 'unique:posts'],
            'content' => ['required', 'string'],
            'website_domain' => ['required', 'string', 'regex:/^([a-zA-Z0-9-_]+\.)*[a-zA-Z0-9-_]+\.[a-z]+$/'],
        ];
    }
}
