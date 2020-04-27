<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Objects\AdminDetails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $currentRoleId = session()->get('currentRoleId');
        $currentOrganId = session()->get('currentOrganId');
        if ($currentRoleId == null || $currentOrganId == null || $currentOrganId == 0 || $currentRoleId == 0) {
            $adminDetails = new AdminDetails(Auth::id());
            //TODO handle users without role to send request to admin
            if ($adminDetails->accessibleRoles == [])
                return redirect('404');

            $defaultRole = $adminDetails->getDefaultRole();
            session()->put(['currentRoleId' => $defaultRole['role']['id'], 'currentOrganId' => $defaultRole['organ']['id']]);
            return redirect()->refresh();
        } else {
            return view('Admin.index');
        }
    }
}
