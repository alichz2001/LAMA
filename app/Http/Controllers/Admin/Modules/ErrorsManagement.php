<?php


namespace App\Http\Controllers\Admin\Modules;


use App\Http\Controllers\Admin\Handler\Response;

class ErrorsManagement
{

    public function view() {
        return view('Admin.Modules.ErrorsManagement');
    }

    public function getErrorsList() {
        $errorsManagement = \App\Entities\Errors_management::all()->toArray();
        return Response::Handle(true, $errorsManagement, 1, 20000);
    }

    public function addError() {

        //TODO validation
        $err = new \App\Entities\Errors_management();
        $err->code = request('name');
        $err->description = request('description');
        $err->file = request('file');
        $err->method = request('method');
        $err->type = request('type');
        $err->save();
        return Response::Handle(true, '', 1, 20050);
    }
}
