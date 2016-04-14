<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function ticket_category()
    {
        return $this->belongsTo('App\TicketCategory');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function assigned_user()
    {
        return $this->hasOne('App\User', 'id', 'assigned_user_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function status()
    {
        switch($this->ticket_status) {
          case 0:
            return "Open";
          case 1:
            return "On Hold";
          case 2:
            return "Invalid";
          case 3:
            return "Fixed";
          case 4:
            return "Closed";
        }
    }
}
