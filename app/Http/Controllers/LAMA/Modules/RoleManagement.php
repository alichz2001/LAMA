<?php


namespace App\Http\Controllers\LAMA\Modules;


use App\Entities\Role;
use App\Http\Controllers\LAMA\Handler\Response;

class RoleManagement
{
    public function view() {
        return view('LAMA.Modules.RoleManagement');
    }

    public function getRolesList() {
        $roles = Role::all()->toArray();
        return Response::Handle(true, ['roles' => $roles], 1, 20000);
    }
}
