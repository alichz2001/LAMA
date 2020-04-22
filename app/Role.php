<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $hidden = ['sys_title', 'description', 'status', 'pivot', 'created_at', 'updated_at'];

    public function modules() {
        return $this->belongsToMany(Module::class, Role_Module::class, 'role_id', 'module_id')->where(['status' => 1]);
    }
}
