<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LostNotificationResponseRequest extends FormRequest
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
			'request_id' => 'required',
			'response_by_person_id' => 'required',
			'response_status' => 'required|string',
			'response_date' => 'required',
			'longitude' => 'required',
			'latitude' => 'required',
			'current_image_path' => 'string',
			'comments' => 'string',
        ];
    }
}
