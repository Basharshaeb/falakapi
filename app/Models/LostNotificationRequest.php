<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LostNotificationRequest
 *
 * @property $id
 * @property $request_title
 * @property $user_id
 * @property $child_id
 * @property $request_lost_notification_date
 * @property $last_location_id
 * @property $notification_status
 * @property $comments
 * @property $last_response_by
 * @property $found_by
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class LostNotificationRequest extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['request_title', 'user_id', 'child_id', 'request_lost_notification_date', 'last_location_id', 'notification_status', 'comments', 'last_response_by', 'found_by'];


}
