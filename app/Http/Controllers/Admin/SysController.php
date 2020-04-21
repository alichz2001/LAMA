<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Http\Controllers\Admin\Handler\Response;
use App\Http\Controllers\Admin\Objects\AdminDetails;
use App\Http\Controllers\Controller;
use App\User;
use App\User_Role_Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SysController extends Controller
{

    public function __construct()
    {
        session()->put(['currentRoleId' => 1, 'currentCompanyId' => 1]);

    }

    public function getMyCompanies() {
        $adminDetails = new AdminDetails(Auth::id());
        return Response::Handle(true, $adminDetails->accessibleCompanies, 1,20000);
    }

    public function getMyCurrentCompany() {
        //session(['currentCompanyId' => 1]);
        $adminDetails = new AdminDetails(Auth::id());
        //return dump($adminDetails->getCurrentCompanyDetails());
        if ($adminDetails->errors == [])
            return Response::Handle(true, $adminDetails->currentCompanyDetails, 1,20001);
        return Response::Handle(false, '', 2,$adminDetails->errors);

    }

    public function getMyRoles() {
        $adminDetails = new AdminDetails(Auth::id());
        return Response::Handle(true, $adminDetails->accessibleRoles, 1,20002);
    }

    public function getMyCurrentRole() {
        $adminDetails = new AdminDetails(Auth::id());
        if ($adminDetails->errors == [])
            return Response::Handle(true, $adminDetails->currentRoleWithCompany, 1,20003);
        return Response::Handle(false, '', 2, $adminDetails->errors);
    }

    public function getMyModules() {
        $adminDetails = new AdminDetails(Auth::id());
        return Response::Handle(true, $adminDetails->modules, 1, 20004);
    }
}
