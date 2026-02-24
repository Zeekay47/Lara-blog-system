<?php
// app/Http/Requests/ProfilePhotoUpdateRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilePhotoUpdateRequest extends FormRequest
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
            'profile_photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // 2MB max
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'profile_photo.required' => 'Please select a photo to upload.',
            'profile_photo.image' => 'The file must be an image.',
            'profile_photo.mimes' => 'Allowed image types: jpeg, png, jpg, gif.',
            'profile_photo.max' => 'Maximum file size is 2MB.',
        ];
    }
}