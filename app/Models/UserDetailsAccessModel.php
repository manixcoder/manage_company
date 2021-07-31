<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetailsAccessModel extends Model
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'users_details_access';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'user_id', 'company_id', 'assets_id', 'accept_status', 'created_at', 'updated_at',
    ];
}
