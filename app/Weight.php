<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email'];

    public function user()
    {
        return $this->hasOne('App\User','email','email');
    }
}
