<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    public function game()
    {
        return $this->hasMany('App\Game');
    }
}
