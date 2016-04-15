<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{

    public function url()
    {
      return 'accounts/'.$this->subdomain;
    }

    public function memberships()
    {
      return $this->hasMany('App\Membership');
    }

    public function users()
    {
      return $this->hasManyThrough('App\User', 'App\Membership', 'account_id', 'id');
    }

    public function ownerMembership()
    {
      return $this->hasOne('App\Membership')->where('role', 'owner');
    }

    public function owner()
    {
      return $this->ownerMembership->user;
    }

    public function invitations()
    {
      return $this->hasMany('App\Invitation');
    }

    public function clients()
    {
        return $this->hasMany('App\Client');
    }

    public function projects()
    {
        return $this->hasMany('App\Project');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function ticket_categories()
    {
        return $this->hasMany('App\TicketCategory');
    }

    public function quotes()
    {
        return $this->hasMany('App\Quote');
    }
}
