<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Handler\Response;
use App\Http\Controllers\Admin\Objects\AdminDetails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDetailsController extends Controller
{
    public function __construct()
    {

        session()->put(['currentCompanyId' => 1, 'currentRoleId' => 2]);
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

    public function getMyRolesOfCurrentCompany() {
        $adminDetails = new AdminDetails(Auth::id());
        return Response::Handle(true, $adminDetails->rolesOfCurrentCompany, 1, 20005);
    }
}
