<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'title_hy' => 'required|string|max:255|unique:books,title_hy,' . $this->id,
            'title_en' => 'required|string|max:255|unique:books,title_en,' . $this->id,
            'text_hy' => 'required|string',
            'text_en' => 'required|string',
            'description_hy' => 'required|string',
            'description_en' => 'required|string',
            'book_size_hy' => 'required|string',
            'book_size_en' => 'required|string',
            'video_url' => 'string',
            'slug' => 'required|string|max:255|unique:books,slug,' . $this->id,
            'price' => 'required|integer',
            'word_count' => 'required|integer',
            'page_count' => 'required|integer',
            'font_size' => 'required|string',
            'isbn' => 'required|string|max:255',
            'in_stock' => 'required|integer',
            'published_date' => 'required|string',
            'authors' => 'required|array',
            'translators' => 'required|array',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
