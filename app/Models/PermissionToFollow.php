<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PermissionToFollow
 *
 * @property $id
 * @property $parent_id
 * @property $child_id
 * @property $to_person_id
 * @property $kinship
 * @property $active
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PermissionToFollow extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['parent_id', 'child_id', 'to_person_id', 'kinship', 'active'];


}
