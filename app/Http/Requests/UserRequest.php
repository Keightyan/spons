<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
            'profile_image'=> 'file|image|max:1024|mimes:jpg,png,gif',
            'name' => 'required|max:10',
            'team' => 'max:20',
            'birthday' => 'date',
            'favorites' => 'max:50',
            'introduction' => 'max:200',
        ];
    }

    public function messages() {
        return [
            'profile_image.max' => '※画像は1MB以内のものにしてください。',
            'profile_image.mimes' => '※画像は jpg か png か gif 形式のものにしてください。',
            'name.required' => '※ニックネームは必須入力です。',
            'name.max' => '※10字以内で入力してください。',
            'team.max' => '※20字以内で入力してください。',
            'birthday.date' => '※yyyy/mm/dd もしくは yyyy-mm-dd の形式で入力してください。',
            'favorites.max' => '※50字以内で入力してください。',
            'introduction.max' => '※200字以内で入力してください。',
        ];
    }
}
