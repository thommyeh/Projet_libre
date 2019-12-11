<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefaultFilters extends Model
{
    protected $fillable = [
        'name', 'url', 'type',
    ];
}
