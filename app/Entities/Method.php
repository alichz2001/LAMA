<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    protected $hidden = ['pivot'];
    protected $fillable = ['public_name', 'sys_name', 'type', 'status', 'module_id'];
}
