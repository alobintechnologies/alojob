<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function account()
    {
        return $this->belongsTo('App\Account');
    }

    public function activatable()
    {
        return $this->morphTo();
    }
}
