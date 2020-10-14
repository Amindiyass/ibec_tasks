<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Yard extends Model
{
    protected $table = 'yards';
    protected $fillable = ['name', 'order'];
}
