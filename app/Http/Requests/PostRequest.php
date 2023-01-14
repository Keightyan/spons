<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::check()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:70',
            'body' => 'required|max:1000',
            'image'=> 'file|image|max:1024|mimes:jpg,png,gif',
        ];
    }

    public function messages() {
        return [
            'title.required' => '※募集タイトルは必須入力です。',
            'title.max' => '※70字以内で入力してください。',
            'body.required' => '※募集文は必須入力です。',
            'body.max' => '※1000字以内で入力してください。',
            'image.max' => '※画像は1MB以内のものにしてください。',
            'image.mimes' => '※画像は jpg か png か gif 形式のものにしてください。',
        ];
    }
}
