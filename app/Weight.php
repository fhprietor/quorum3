<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    public function user()
    {
        return $this->hasOne('App\User','email','email');
    }
}
