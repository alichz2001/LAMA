<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_Module extends Model
{
    protected $table = 'role__module';

    protected $hidden = ['id', 'pivot', 'role_id', 'module_id', 'status', 'created_at', 'updated_at'];

    public function module() {
        return $this->hasOne(Module::class, 'id', 'module_id')->where(['status' => 1]);
    }
}
