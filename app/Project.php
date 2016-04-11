<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function account()
    {
        return $this->belongsTo('App\Account');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
 
}
