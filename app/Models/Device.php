<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Device
 *
 * @property $id
 * @property $model_type_id
 * @property $serial_number
 * @property $version
 * @property $device_battery
 * @property $child_id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Device extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['model_type_id', 'serial_number', 'version', 'device_battery', 'child_id'];


}
