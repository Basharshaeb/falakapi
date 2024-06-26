<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FindLostChildRequest extends FormRequest
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
			'response_title' => 'string|required',
			'response_image_path' => 'string',
			'notification_status' => 'string',
			'comments' => 'string',
        ];
    }
}
