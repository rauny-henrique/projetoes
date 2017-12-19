<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    public function amigo()
    {
        return $this->belongsTo('App\Friend');
    }
    public function game()
    {
        return $this->hasOne('App\Game');
    }
}
