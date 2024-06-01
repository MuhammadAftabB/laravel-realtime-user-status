<?php

namespace MuhammadAftab\RealTimeUserStatus\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivityLog extends Model
{
    protected $fillable = ['user_id', 'activity'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
