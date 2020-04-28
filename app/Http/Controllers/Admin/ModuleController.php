<?php


namespace App\Http\Controllers\Admin;


use App\Entities\Module;
use App\Entities\Role_Module;
use App\Http\Controllers\Admin\Handler\Response;
use App\Http\Controllers\Admin\Objects\AdminDetails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{

    private $req;
    private $adminDetails;
    private $module;

    public function __construct(Request $request)
    {
        $this->req = $request;
        $this->adminDetails = new AdminDetails(Auth::id());
    }


    public function index($moduleId, $type)
    {

        //check if $type is false trow back error
        if (!in_array($type, ['read', 'save', 'edit', 'remove']))
            return Response::Handle(false, '', 2, 40001);

        //check if $moduleId is false trow back error
        if (!is_numeric($moduleId))
            return Response::Handle(false, '', 2, 40002);

        $this->module = Module::where(['id' => $moduleId, 'status' => 1])->get()->makevisible(['sys_title'])->toArray();

        //check module exist or not OR is enable or not
        if (!isset($this->module[0]) || $this->module[0]['has_child'] != 0)
            return Response::Handle(false, '', 2, 40003);

        $roleModule = Role_Module::where(['status' => 1, 'role_id' => session()->get('currentRoleId'), 'module_id' => $moduleId])->get()->toArray();

        //check this role has access to this module and its status is true
        if (!isset($roleModule[0]))
            return Response::Handle(false, '', 2, 40004);

        //check has type access to module
        if ($roleModule[0][$type . '_access'] != 1)
            return Response::Handle(false, '', 2, 40005);

        return $this->$type($moduleId);
    }


    private function read($moduleId)
    {
        if (class_exists('App\Http\Controllers\Admin\Modules\\' . ucfirst($this->module[0]['sys_title']))) {
            $moduleClass = 'App\Http\Controllers\Admin\Modules\\' . ucfirst($this->module[0]['sys_title']);
            $moduleObject = new $moduleClass();
            return $moduleObject->read();
        } else {
            if (view()->exists('Admin.Modules.' . ucfirst($this->module[0]['sys_title'])))
                return view('Admin.Modules.' . ucfirst($this->module[0]['sys_title']));
            else
                return view('Admin.Modules.404');
            //TODO return true error when dont exist module view
        }


    }
}
