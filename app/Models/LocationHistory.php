<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LocationHistory
 *
 * @property $id
 * @property $user_id
 * @property $latitude
 * @property $longitude
 * @property $source
 * @property $date_time
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class LocationHistory extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'latitude', 'longitude', 'source', 'date_time','city','street','country'];


}
