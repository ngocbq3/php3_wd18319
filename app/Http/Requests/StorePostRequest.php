<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

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
            'title' => ['required', 'min:10'],
            'image' => ['required', 'image'],
            'description' => ['required', 'min:5'],
            'content' => ['required', 'min:25'],
            'view' => ['required', 'integer', 'min:0']
        ];
    }

    //Thông báo
    public function messages()
    {
        return [
            'title.required' => "Title không được để trống",
            'title.min' => "Title phải được nhập từ 10 ký tự",
            'description.required' => "Mô tả không được để trống",
            'description.min' => "Mô tả phải nhập ít nhất 5 ký tự",
            'content.required' => "Nội dung không được để trống",
            'content.min' => "Nội dung ít nhất từ 25 ký tự",
            'view.required' => "View không được để trống",
            'view.integer' => "View phải là số nguyên",
            'view.min' => "View phải là số >= 0",
            'image.required' => "Bạn chưa nhập ảnh",
            'image.image' => "Định dạng file không đúng",
        ];
    }
}
