<?php

namespace App\Http\Controllers\LAMA;

use App\Http\Controllers\LAMA\Handler\Response;
use App\Http\Controllers\LAMA\Objects\AdminDetails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SysController extends Controller
{

    private $req;
    public function __construct(Request $req)
    {
        $this->req = $req->toArray();
    }

    public function changeOrgan() {
        $adminDetails = new AdminDetails(Auth::id());
        $accessibleOrgans = $adminDetails->accessibleOrgans;
        $access = 0;
        foreach ($accessibleOrgans as $organ)
            if ($organ['id'] == $this->req['id']) {
                $access = 1;
                break;
            }
        if ($access == 1) {
            session()->put(['currentOrganId' => $this->req['id']]);
            $adminDetails = new AdminDetails(Auth::id());
            //check has role in this organ or not
            if (isset($adminDetails->rolesOfCurrentOrgan[0])) {
                session()->put(['currentRoleId' => $adminDetails->rolesOfCurrentOrgan[0]['id']]);
                $SC = Hash::make(Auth::id() . session()->get('currentOrganId') . session()->get('currentRoleId'));
                session()->put(['_SC' => $SC]);
                return Response::Handle(true, ['SC' => $SC], 1, 20020);
            } else {
                return Response::Handle(false, '', 2, 40043);
            }
        } else {
            return Response::Handle(false, '', 2, 40040);
        }
    }

    public function changeRole() {
        $adminDetails = new AdminDetails(Auth::id());
        $accessibleRoles = $adminDetails->rolesOfCurrentOrgan;
        //return dump(session()->all());
        $access = 0;
        foreach ($accessibleRoles as $role)
            if ($role['id'] == $this->req['id']) {
                $access = 1;
                break;
            }
        if ($access == 1) {
            session()->put(['currentRoleId' => $this->req['id']]);
            $SC = Hash::make(Auth::id() . session()->get('currentOrganId') . session()->get('currentRoleId'));
            session()->put(['_SC' => $SC]);
            return Response::Handle(true, ['SC' => $SC], 1, 20021);
        } else {
            return Response::Handle(false, '', 2, 40041);
        }
    }

    public function logout() {
        session()->put(['currentRoleId' => 0, 'currentOrganId' => 0]);
        Auth::logout();
        return redirect('/admin');
    }
}
