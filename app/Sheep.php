<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sheep extends Model
{
    protected $table = 'sheeps';

    protected $fillable = ['name', 'yard_id'];
}
