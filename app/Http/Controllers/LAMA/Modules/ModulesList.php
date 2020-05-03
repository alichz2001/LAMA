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


}
