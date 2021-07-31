<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRoleRelation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'role_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'role_id'];

    /**
     * Return current login user role here.
     *
     * @var string
     */

}
