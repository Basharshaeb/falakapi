<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FollowChildRequest extends FormRequest
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
        // protected $fillable = ['user_id', 'child_id', 'track_by_app', 'track_by_device', 'has_card', 'tracking_active_type', 'allow_to_track'];

        return [
			// 'PersonInChargeID' => 'required',
			'child_id' => 'required',
			'track_by_app' => 'string',
			'track_by_device' => 'string',
			'has_card' => 'string',
			'tracking_active_type' => 'required|string',
			'allow_to_track' => 'required|string',
        ];
    }
}
