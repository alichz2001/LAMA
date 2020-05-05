<?php


namespace App\Http\Controllers\LAMA\Modules;


use App\Entities\Role;
use App\Entities\Role_Module;
use App\Http\Controllers\LAMA\Handler\Response;
use Illuminate\Support\Facades\DB;

class RoleManagement
{
    public function view() {
        return view('LAMA.Modules.RoleManagement');
    }


    public function getRolesList() {
        $roles = Role::all()->makeVisible(['status', 'sys_title'])->toArray();
        return Response::Handle(true, ['roles' => $roles], 1, 20000);
    }

    public function addRole($req) {
        try {

            DB::transaction(function () use ($req) {
                $newRole = new Role();
                $newRole->title = $req['en_title'];
                $newRole->sys_title = str_replace(' ', '_', $req['en_title']);
                $newRole->fa_title = $req['fa_title'];
                $newRole->description = $req['description'];
                $newRole->save();
                if (isset($req['modules']))
                    foreach ($req['modules'] as $module) {
                        $newRM = new Role_Module();
                        $newRM->module_id = $module;
                        $newRM->role_id = $newRole->id;
                        $newRM->save();
                    }

            });
            return Response::Handle(true, '',1,60001);
        } catch (\Exception $e) {
            return Response::Handle(false, ['errorCode' => $e->getMessage()], 2, 70001);
        }
    }

    public function removeRole($req) {
        Role::where(['id' => $req['id']])->delete();
        return Response::Handle(true, '', 1,20000);
    }
}
