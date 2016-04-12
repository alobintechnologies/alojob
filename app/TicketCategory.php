<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function account()
    {
        return $this->belongsTo('App\Account');
    }
}
