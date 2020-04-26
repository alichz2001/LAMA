<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Role_Organ extends Model
{
    protected $table = 'user__role__organ';

    protected $hidden = ['id', 'role_id', 'organ_id', 'user_id', 'status'];

    public function organ() {
        return $this->hasOne(Organ::class, 'id', 'organ_id')->where(['status' => 1]);
    }

    public function role() {
        return $this->hasOne(Role::class, 'id', 'role_id')->where(['status' => 1]);
    }
}
