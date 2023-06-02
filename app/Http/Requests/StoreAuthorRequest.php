<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class StoreAuthorRequest extends FormRequest
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
            'name_hy' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'about_hy' => 'required|string',
            'about_en' => 'required|string',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
