<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function city()
    {
        return $this->hasOne('App\City', 'id', 'city_id');
    }

    public function bank()
    {
        return $this->hasOne('App\Bank', 'id', 'bank_id');
    }

    public function donations()
    {
        return $this->hasMany('App\Donation', 'client_id', 'id');
    }

    public function getTotal()
    {
        $sum = 0;

        foreach ($this->donations as $donation){
            if ($donation->is_visible){
                $sum+= $donation->amount;
            }
        }

        return $sum;
    }

    public function getCount()
    {
        return $this->donations()->count();
    }
}
