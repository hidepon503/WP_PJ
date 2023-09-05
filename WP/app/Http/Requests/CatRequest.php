<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'admin_id' => 'required|integer|exists:admins,id',
            'user_id' => 'nullable|integer|exists:users,id',
            'gender_id' => 'required|integer|exists:genders,id',
            'kind_id' => 'required|integer|exists:kinds,id', // ここではexistsルールは追加していませんが、必要に応じて追加してください。
            'weight' => 'required|numeric|min:0',
            'birthday' => 'nullable|date',
            'introduction' => 'nullable|string',
            // その他のユニークなIDのバリデーションルール
            'soracom' => 'nullable|integer|unique:cats,soracom',
            'hellolight' => 'nullable|integer|unique:cats,hellolight',
            'apple' => 'nullable|integer|unique:cats,apple',
            // 'lostchild' はboolean型なので、入力フォームがある場合は以下のように追加します。
            // 'lostchild' => 'required|boolean',
        ];
    }
}
