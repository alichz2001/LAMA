<?php


namespace App\Http\Controllers\LAMA;


use App\Entities\Module;
use App\Entities\Role_Module;
use App\Http\Controllers\LAMA\Handler\Response;
use App\Http\Controllers\LAMA\Objects\AdminDetails;
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

    public function index($moduleSysName, $method)
    {
        //security code check TODO
        if (!isset($this->req['_SC']) || $this->req['_SC'] != session()->get('_SC'))
            return Response::Handle(false, '', 2,44000);

        $module = Module::where(['sys_title' => $moduleSysName, 'status' => 1])->with('methods')->get()->makevisible(['file_name'])->toArray();

        //check module exist or not OR is enable or not
        if (!isset($module[0]) || $module[0]['has_child'] != 0)
            return Response::Handle(false, '', 2, 40003);

        //return dump($module);
        $roleModule = Role_Module::where(['status' => 1, 'role_id' => session()->get('currentRoleId'), 'module_id' => $module[0]['id']])->get()->toArray();

        //check this role has access to this module and its status is true
        if (!isset($roleModule[0]))
            return Response::Handle(false, '', 2, 40004);


        $moduleClassName = 'App\Http\Controllers\LAMA\Modules\\' . ucfirst($module[0]['file_name']);
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
            if (view()->exists('LAMA.Modules.' . $module[0]['file_name']))
                return view('LAMA.Modules.' . $module[0]['file_name']);
            else
                return Response::Handle(false, '', 2,40005);
        }
    }
}
