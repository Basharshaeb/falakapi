<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
/**
 * Class User
 *
 * @property $id
 * @property $name
 * @property $email
 * @property $email_verified_at
 * @property $password
 * @property $username
 * @property $user_type
 * @property $full_name
 * @property $phone
 * @property $gender
 * @property $username_type
 * @property $latitude
 * @property $longitude
 * @property $volunteer_activation_status
 * @property $voulnteer_child_location_id
 * @property $fcm_token
 * @property $main_image_path
 * @property $verification_code
 * @property $qe_code_info
 * @property $kinshipT
 * @property $main_person_in_charge_id
 * @property $child_status
 * @property $boundry
 * @property $todayimagePath
 * @property $AdditionalInformation
 * @property $year_of_birth
 * @property $qr_code_link
 * @property $is_connect
 * @property $voulnteer_child_Location_id_child
 * @property $remember_token
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable,HasApiTokens;
use InteractsWithMedia;
    protected $perPage = 20;
    protected $with=['media'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name','password', 'email', 'username', 'user_type', 'full_name', 'phone', 'gender', 'username_type', 'latitude', 'longitude', 'volunteer_activation_status', 'voulnteer_child_location_id', 'fcm_token', 'main_image_path', 'verification_code', 'qe_code_info', 'kinshipT', 'main_person_in_charge_id', 'child_status', 'boundry', 'todayimagePath', 'AdditionalInformation', 'year_of_birth', 'qr_code_link', 'is_connect', 'voulnteer_child_Location_id_child'];

        public function scopeOfType($query, $type)
{
    return $query->where('user_type', $type);
}
public function children()
{
    return $this->hasMany(User::class, 'main_person_in_charge_id')->with('followChild');
}
public function followChild(){
    return $this->hasOne(FollowChild::class,'child_id','id');
}
// $admins = User::ofType('admin')->get();

}
