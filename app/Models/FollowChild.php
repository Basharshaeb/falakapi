<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TrackingChildMaster;

/**
 * Class FollowChild
 *
 * @property $id
 * @property $PersonInChargeID
 * @property $ChildId
 * @property $TrackByApp
 * @property $TrackByDevice
 * @property $HasCard
 * @property $TrackingActiveType
 * @property $AllowTorack
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class FollowChild extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'child_id', 'track_by_app', 'track_by_device', 'has_card', 'tracking_active_type', 'allow_to_track'];

public function child(){

    return $this->belongsTo(User::class,'child_id','id');
}
public function user(){

    return $this->belongsTo(User::class,'user_id','id');
}
public function trackingMaster(){

    return $this->hasMany(TrackingChildMaster::class,'link_child_id','id');
}
}
