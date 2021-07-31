<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    // protected $table = 'email_templates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'token',
    ];
}
