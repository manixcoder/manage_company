<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compain extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'compains';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'compains_slug', 'masjid_id', 'compainName', 'compainDesc', 'compainLogo',
    ];

    public function masjidData()
    {
        return $this->belongsTo('App\User', 'masjid_id');
    }
}
