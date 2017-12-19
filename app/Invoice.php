<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function game()
    {
        return $this->hasOne('App\Game');
    }
}
