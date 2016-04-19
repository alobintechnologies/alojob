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

    public function tickets()
    {
        return $this->hasMany('App\Ticket')->with('ticket_category', 'assigned_user');
    }

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function status_color()
    {
        switch($this->project_status_id) {
          case 0: // open
            return "info";
          case 1: // archived
            return "default";
          case 2: // closed
            return "default";
        }
    }

    public function project_status()
    {
        switch($this->project_status_id) {
          case 0: // open
            return "Open";
          case 1: // archived
            return "Archived";
          case 2: // closed
            return "Closed";
        }
    }

}
