<?php


namespace App\Http\Controllers\LAMA\Modules;


use App\Entities\Module;
use App\Http\Controllers\LAMA\Handler\Response;
use App\Http\Controllers\LAMA\Helpers\Validation;

class ModuleManagement
{
    public function view() {
        return view('LAMA.Modules.ModuleManagement');
    }

    public function getModulesList() {
        $modules = Module::all()->toArray();
        return Response::Handle(true, ['modules' => $modules], 1, 20000);
    }

    public function addModule($req) {
        $V = new Validation($req, [
            'title' => 'notNull:0|lengthBetween:3-255|unique:Module.title',
            'sys_title' => 'notNull:0|lengthBetween:3-255|unique:Module.sys_title',
            'file_name' => 'notNull:0|lengthBetween:3-255|unique:Module.file_name',
            'status' => 'numberBetween:0-1'
        ]);

        if ($V->getStatus() != true) {
            return Response::Handle(false, ['formErrors' => $V->getErrors()], 2, 40050);
        } else {

        }
    }
}
