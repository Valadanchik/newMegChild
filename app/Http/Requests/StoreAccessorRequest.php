<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccessorRequest extends FormRequest
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
            'category_id' => 'required|integer',
            'title_hy' => 'required|string|max:255|unique:accessors,title_hy',
            'description_hy' => 'required|string',
            'age' => 'required|string',
            'price' => 'required|integer',
            'in_stock' => 'required|integer',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'required|string|max:255|unique:accessors,slug',
            'isbn' => 'required|string|max:255',
            'status' => 'required|integer',
        ];
    }
}
