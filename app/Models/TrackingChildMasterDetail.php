<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrackingChildMasterDetail
 *
 * @property $id
 * @property $master_id
 * @property $date_time_loc
 * @property $latitude
 * @property $longitude
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TrackingChildMasterDetail extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['master_id', 'date_time_loc', 'latitude', 'longitude'];


}
