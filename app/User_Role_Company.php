<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Role_Company extends Model
{
    protected $table = 'user__role__company';

    protected $hidden = ['id', 'role_id', 'company_id', 'user_id', 'status'];

    public function company() {
        return $this->hasOne(Company::class, 'id', 'company_id')->where(['status' => 1]);
    }

    public function role() {
        return $this->hasOne(Role::class, 'id', 'role_id')->where(['status' => 1]);
    }
}
