<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionRoleRelation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permission_role';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['permission_id', 'role_id'];
    /**
     * Return current login user role here.
     *
     * @var string
     */
    public function getPermissions()
    {
        return $this->belongsTo('App\Models\Permission', 'permission_id');
    }
}
