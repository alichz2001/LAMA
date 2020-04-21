<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $hidden = ['sys_title', 'status', 'pivot', 'created_at', 'updated_at'];
}
