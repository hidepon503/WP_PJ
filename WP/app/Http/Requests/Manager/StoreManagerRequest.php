<?php

namespace App\Http\Requests\Manager;

use Illuminate\Foundation\Http\FormRequest;

class StoreManagerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:managers,email'],
            'password' => ['required','string','min:8','confirmed'],
        ];
    }
    
    // 属性名の翻訳
    public function attributes()
    {
        return [
            // 'name' => '名前',
            // 'email' => 'メールアドレス',
            // 'password' => 'パスワード'
        ];
    }
}
