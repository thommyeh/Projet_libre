<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
       protected $fillable = [
        'name', 'url', 'user_id',
    ];


    public function filters(){

        return $this->hasMany('App\Filter');
    }
}
