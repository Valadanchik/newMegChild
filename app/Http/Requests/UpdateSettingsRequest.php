<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
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
            'site_name' => 'required|string|max:255',
            'website_url' => 'required|string|max:255',
            'admin_email' => 'required|email|max:255',
            'public_email' => 'required|email|max:255',
            'fb_link' => 'required|string|max:255',
            'twitter_link' => 'required|string|max:255',
//            'instagram_link' => 'required|string|max:255',
            'linkedin_link' => 'required|string|max:255',
            'youtube_link' => 'required|string|max:255',
            'order_email_addresses' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ];
    }
}
