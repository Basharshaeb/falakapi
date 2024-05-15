<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FollowChild;
use App\Models\TrackingChildMasterDetail;

/**
 * Class TrackingChildMaster
 *
 * @property $id
 * @property $link_child_id
 * @property $start_tracking_date
 * @property $start_child_location_long
 * @property $start_child_location_lat
 * @property $end_tracking_time
 * @property $child_tracking_statues
 * @property $parent_reaction
 * @property $last_child_location_longitude
 * @property $last_child_location_latitude
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TrackingChildMaster extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['link_child_id', 'child_id','start_tracking_date', 'start_child_location_long', 'start_child_location_lat', 'end_tracking_time', 'child_tracking_statues', 'parent_reaction', 'last_child_location_longitude', 'last_child_location_latitude'];


    public function followChild(){

        return $this->belongsTo(FollowChild::class,'link_child_id','id');
    }
    public function details(){

        return $this->hasMany(TrackingChildMasterDetail::class,'master_id','id');
    }
    public function child(){

        return $this->belongsTo(User::class,'child_id','id');
    }
}
