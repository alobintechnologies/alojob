<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function name()
    {
      return $this->title . ' ' . $this->first_name . ' ' . $this->last_name;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function account()
    {
        return $this->belongsTo('App\Account');
    }
}
