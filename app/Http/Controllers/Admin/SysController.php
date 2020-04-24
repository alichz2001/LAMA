<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Http\Controllers\Admin\Handler\Response;
use App\Http\Controllers\Admin\Objects\AdminDetails;
use App\Http\Controllers\Controller;
use App\Module;
use App\User;
use App\User_Role_Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SysController extends Controller
{

    private $req;
    public function __construct(Request $req)
    {
        $this->req = $req->toArray();
    }

    public function changeCompany() {
        $adminDetails = new AdminDetails(Auth::id());
        $accessibleCompanies = $adminDetails->accessibleCompanies;
        $access = 0;
        foreach ($accessibleCompanies as $company)
            if ($company['id'] == $this->req['id']) {
                $access = 1;
                break;
            }
        if ($access == 1) {
            session()->put(['currentCompanyId' => $this->req['id']]);
            session()->put(['currentRoleId' => 0]);
            return Response::Handle(true, '', 1, 20020);
        } else {
            return Response::Handle(false, '', 2, 40040);
        }
    }

    public function changeRole() {
        $adminDetails = new AdminDetails(Auth::id());
        $accessibleRoles = $adminDetails->rolesOfCurrentCompany;
        //return dump(session()->all());
        $access = 0;
        foreach ($accessibleRoles as $role)
            if ($role['id'] == $this->req['id']) {
                $access = 1;
                break;
            }


        //TODO if send his current role id send back him warning that you are already have this role
        if ($access == 1) {
            session()->put(['currentRoleId' => $this->req['id']]);
            return Response::Handle(true, '', 1, 20021);
        } else {
            return Response::Handle(false, '', 2, 40041);
        }


    }

    public function getModule() {
        $module = Module::where(['id' => $this->req['id'], 'status' => 1])->get()->makevisible(['sys_title'])->toArray();

        return 1;
        if (!isset($module[0]))
            return Response::Handle(false, '', 3, 50000);
        elseif ($module[0]['has_child'] != 0)
            return Response::Handle(false, '', 3, 50001);
        elseif (!view()->exists('Admin.Modules.dashboard'))
            return Response::Handle(false, '', 2, 40050);
        else
            return view('Admin.Modules.dashboard');
        //TODO not send view like this
        // Response::Handle(true, view('Admin.Modules.dashboard'), 1, 20050);

    }
}
