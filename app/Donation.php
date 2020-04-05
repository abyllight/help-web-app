<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
