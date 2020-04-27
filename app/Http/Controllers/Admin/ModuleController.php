<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\Handler\Response;
use App\Http\Controllers\Controller;
use App\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{

    private $req;
    public function __construct(Request $request)
    {
        $this->req = $request;
    }

    public function main() {
        //TODO check exist id in data
        $module = Module::where(['id' => $this->req['id'], 'status' => 1])->get()->makevisible(['sys_title'])->toArray();
        if (!isset($module[0]))
            return Response::Handle(false, '', 3, 50000);
        elseif ($module[0]['has_child'] != 0)
            return Response::Handle(false, '', 3, 50001);
        else {
            //return dump($module);
            if (class_exists('App\Http\Controllers\Admin\Modules\\' . ucfirst($module[0]['sys_title']))) {
                $moduleClass = 'App\Http\Controllers\Admin\Modules\\' . ucfirst($module[0]['sys_title']);
                $moduleObject = new $moduleClass();
                return $moduleObject->view();
            } else {
                if (view()->exists('Admin.Modules.' . ucfirst($module[0]['sys_title'])))
                    return view('Admin.Modules.' . ucfirst($module[0]['sys_title']));
                else
                    return 404;
            }
            return 2;
        }


    }
}
