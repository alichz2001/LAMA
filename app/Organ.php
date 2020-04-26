<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organ extends Model
{
    protected $table = 'organs';

    protected $hidden = ['sys_title', 'status', 'pivot', 'created_at', 'updated_at'];
}
