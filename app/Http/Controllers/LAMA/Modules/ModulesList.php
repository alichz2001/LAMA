<?php
namespace App\Http\Controllers\LAMA\Modules;

use App\Entities\Module;
use App\Http\Controllers\LAMA\Handler\Response;

class ModulesList
{
    public function view() {
        return view('LAMA.Modules.ModulesList');
    }

    public function getModulesList() {
        $modules = Module::all()->toArray();
        return Response::Handle(true, ['modules' => $modules], 1, 20000);
    }

    public function getModuleDetails($req) {
        $moduleDetails = Module::where(['id' => $req['id']])->with('subModules', 'methods')->get()->makeVisible(['file_name', 'status'])->toArray();
        if (isset($moduleDetails[0])) {
            return Response::Handle(true, ['module_details' => $moduleDetails[0]], 1,20000);
        } else {
            return Response::Handle(false, '', 2, 40050);
        }

    }


}
