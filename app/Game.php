<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function category()
    {
        return $this->hasOne('App\Category');
    }

    public function lending()
    {
        return $this->belongsTo('App\Lending');
    }
}
