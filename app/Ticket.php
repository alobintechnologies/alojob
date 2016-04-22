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

    public function priority_icon()
    {
        switch($this->priority_id) {
          case 0:
            return "fa-arrow-down";
          case 1:
            return "fa-exclamation-circle";
          case 2:
            return "fa-arrow-up";
          case 3:
            return "fa-times-circle-o";
        }
    }

    public function priority()
    {
       switch($this->priority_id) {
         case 0:
           return "Low";
         case 1:
           return "Medium";
         case 2:
           return "High";
         case 3:
           return "Critical";
       }
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
