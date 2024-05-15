<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LostNotificationResponse
 *
 * @property $id
 * @property $request_id
 * @property $response_by_person_id
 * @property $response_status
 * @property $response_date
 * @property $longitude
 * @property $latitude
 * @property $current_image_path
 * @property $accuracy
 * @property $comments
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class LostNotificationResponse extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['request_id', 'response_by_person_id', 'response_status', 'response_date', 'longitude', 'latitude', 'current_image_path', 'accuracy', 'comments'];


}
