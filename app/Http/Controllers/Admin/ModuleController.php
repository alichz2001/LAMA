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

    public function __construct(Request $request)
    {
        $this->req = $request->toArray();
        $this->adminDetails = new AdminDetails(Auth::id());
    }

    public function index($moduleId, $method)
    {

        //return dump($this->req);
        //check if $moduleId is false trow back error
        if (!is_numeric($moduleId))
            return Response::Handle(false, '', 2, 40002);

        $module = Module::where(['id' => $moduleId, 'status' => 1])->with('methods')->get()->makevisible(['sys_title'])->toArray();

        //check module exist or not OR is enable or not
        if (!isset($module[0]) || $module[0]['has_child'] != 0)
            return Response::Handle(false, '', 2, 40003);

        $roleModule = Role_Module::where(['status' => 1, 'role_id' => session()->get('currentRoleId'), 'module_id' => $moduleId])->get()->toArray();

        //check this role has access to this module and its status is true
        if (!isset($roleModule[0]))
            return Response::Handle(false, '', 2, 40004);


        $moduleClassName = 'App\Http\Controllers\Admin\Modules\\' . ucfirst($module[0]['sys_title']);
        if (class_exists($moduleClassName)) {
            $moduleObject = new $moduleClassName();

            foreach ($module[0]['methods'] as $item) {
                if ($item['public_name'] == $method) {
                    if ($roleModule[0][$item['type'] . '_access'] == 1) {
                        $m = $item['sys_name'];
                        if (method_exists($moduleObject, $m))
                            return $moduleObject->$m();
                        else
                            return Response::Handle(false, '', 2, 40007);

                    } else {
                        return Response::Handle(false, '', 2, 40006);
                    }
                }
            }
            return Response::Handle(false, '', 2, 40008);
        } else {
            $viewNameEx = explode('_', $module[0]['sys_title']);
            $viewName = '';
            foreach ($viewNameEx as $item)
                $viewName .= ucfirst($item);

            //check if view dos not exist
            if (view()->exists('Admin.Modules.' . $viewName))
                return view('Admin.Modules.' . $viewName);
            else
                return Response::Handle(false, '', 2,40005);
        }
    }
}
