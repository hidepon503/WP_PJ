<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
    public function rules()
    {
    return [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'image' => [
            'file', // ファイルがアップロードされている
            'image', // 画像ファイルである
            'max:20480', // ファイル容量が20MB以下である
            'mimes:jpeg,jpg,png', // 形式はjpegかpng
            'dimensions:min_width=100,min_height=100,max_width=1500,max_height=1500', // 画像の解像度が100px * 100px ~ 300px * 300px
        ],
        'introduction' => ['nullable','string', 'max:255'],
    ];
    }

    // 属性名の翻訳
    public function attributes()
    {
        return [
            'introduction' => '自己紹介文'
        ];
    }
}
