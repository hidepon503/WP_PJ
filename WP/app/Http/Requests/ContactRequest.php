<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ContactRequest extends FormRequest
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
            'gname' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'name_kana' => ['required', 'string', 'max:255', 'regex:/^[ァ-ロワンヴー]*$/u'],
            'phone' => ['required', 'regex:/^0(\d-?\d{4}|\d{2}-?\d{3}|\d{3}-?\d{2}|\d{4}-?\d|\d0-?\d{4})-?\d{4}$/'],
            'email' => ['required', 'email'],
            'body' => ['required', 'string', 'max:2000']
        ];
    }

    public function attributes()
    {
        return [
            'gname' => '動物保護団体名',
            'name' => '代表者氏名',
            'name_kana' => '代表者氏名(カナ)',
            'phone' => '電話番号',
            'email' => 'メールアドレス',
            'body' => 'お問い合わせ内容'
        ];
    }

    public function messages()
    {
        return[
            'phone.regex' => ':attributeは数字で入力してください',
            'name_kana.regex' => ':attributeはカタカナで入力してください'
        ];
    }
}
