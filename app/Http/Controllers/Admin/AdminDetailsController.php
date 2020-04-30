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

        //session()->put(['currentOrganId' => 1, 'currentRoleId' => 2]);
    }

    public function getMyOrgans() {
        $adminDetails = new AdminDetails(Auth::id());
        return Response::Handle(true, $adminDetails->accessibleOrgans, 1,20000);
    }

    public function getMyCurrentOrgan() {
        //session(['currentOrganId' => 1]);
        $adminDetails = new AdminDetails(Auth::id());
        //return dump($adminDetails->getCurrentOrganDetails());
        return Response::Handle(true, $adminDetails->currentOrganDetails, 1,20001);

    }

    public function getMyRoles() {
        $adminDetails = new AdminDetails(Auth::id());
        return Response::Handle(true, $adminDetails->accessibleRoles, 1,20002);
    }

    public function getMyCurrentRole() {
        $adminDetails = new AdminDetails(Auth::id());
        if ($adminDetails->errors == [])
            return Response::Handle(true, $adminDetails->currentRoleWithOrgan, 1,20003);
        return Response::Handle(false, '', 2, $adminDetails->errors);
    }

    public function getMyModules() {
        $adminDetails = new AdminDetails(Auth::id());
        return Response::Handle(true, $adminDetails->modules, 1, 20004);
    }

    public function getMyRolesOfCurrentOrgan() {
        $adminDetails = new AdminDetails(Auth::id());
        return Response::Handle(true, $adminDetails->rolesOfCurrentOrgan, 1, 20005);
    }

    public function getUserDetails() {
        //TODO more details of user should returns
        $data = [
            'username' => Auth::user()->username,
            'first_name' => Auth::user()->first_name,
            'last_name' => Auth::user()->last_name
        ];
        return Response::Handle(true, $data, 1, 20006);
    }
}
