<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FindLostChild
 *
 * @property $id
 * @property $response_title
 * @property $helper_id
 * @property $findLost_child_date
 * @property $approximate_age
 * @property $response_image_path
 * @property $notification_status
 * @property $comments
 * @property $location_id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class FindLostChild extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['response_title', 'helper_id', 'findLost_child_date', 'approximate_age', 'response_image_path', 'notification_status', 'comments', 'location_id'];


}
