<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
        protected $fillable = [
        'name', 'creation_date', 'user_id', 'choosen'
    ];
}
