<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function account()
    {
        return $this->belongsTo('App\Account');
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }
}
