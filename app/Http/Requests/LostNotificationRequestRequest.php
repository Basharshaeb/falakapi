<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LostNotificationRequestRequest extends FormRequest
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
			'request_title' => 'required|string',
			'child_id' => 'required',
			// 'notification_status' => 'string',
			'comments' => 'string',
			'more_info' => 'string',
			'parent_phone' => 'string',
			'child_age' => 'string',
        ];
    }
}
