<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:80'],
            'last_name' => ['required', 'string', 'max:200'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'phone_number' => ['nullable', 'max:30', 'unique:users,phone_number,'.$this->user()->id,'regex:/^(07|01)\d{8,}$/'],
            'phone_other' => [
                'nullable', 'max:30', 'regex:/^(07|01)\d{8,}$/',
                function ($attribute, $value, $fail) {
                    if ($value && !$this->user()->phone_number) {
                        $fail('First add a primary phone number then add an alternative.');
                    }
                },
            ],
            'image' => ['nullable', 'file', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone_number.regex' => 'Phone number must start with 07xxx or 01xxx',
            'phone_number.unique' => 'That phone number has been used.',
        ];
    }
}
