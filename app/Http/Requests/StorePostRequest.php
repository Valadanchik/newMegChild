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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
//        dd($this->all());
        return [
            'title_hy' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_hy' => 'required|string|max:255',
            'description_en' => 'required|string|max:255',
            'text_hy' => 'required|string',
            'text_en' => 'required|string',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'integer',
            'slug' => 'required|string|max:255',
        ];
    }
}
