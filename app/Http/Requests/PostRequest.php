<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required'],
            'slug' => ['required', Rule::unique('posts')->ignore($this->post)],
            'description' => ['required'],
            'status' => ['required'],
            'photo_id' => ['required'],
            'category_id' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'عنوان پست را مشخص کنید',
            'slug.required' => 'نام مستعار پست را وارد کنید',
            'slug.unique' => 'نام مستعار وجود دارد لطفا نام دیگری انتخاب کنید',
            'description.required' => 'توضیحات پست را وارد کنید',
            'status.required' => 'وضعیت پست را انتخاب کنید',
            'photo_id.required' => 'تصویری را برای پست انتخاب کنید',
            'category_id.required' => 'دسته بندی را انتخاب کنید'
        ];
    }
}
