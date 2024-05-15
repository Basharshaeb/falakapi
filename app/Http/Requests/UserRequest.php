<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
			'name' => 'required|string',
			'email' => 'string',
			'username' => 'string',
			'user_type' => 'string',
			'full_name' => 'string',
			'gender' => 'string',
			'username_type' => 'string',
			'volunteer_activation_status' => 'string',
			'fcm_token' => 'string',
			'main_image_path' => 'string',
			'qe_code_info' => 'string',
			'kinshipT' => 'string',
			'child_status' => 'string',
			'todayimagePath' => 'string',
			'AdditionalInformation' => 'string',
			'qr_code_link' => 'string',
			'is_connect' => 'string',
        ];
    }
}
