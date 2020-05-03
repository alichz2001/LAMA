<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $hidden = ['pivot', 'file_name', 'status', 'created_at', 'updated_at', 'type'];

    public function subModules() {
        return $this->hasMany(Module::class, 'parent_id', 'id')->where(['status' => 1])->with('subModules');
    }
    public function methods() {
        return $this->belongsToMany(Method::class, Module_Method::class, 'module_id', 'method_id')->where(['status' => 1]);
    }
}
