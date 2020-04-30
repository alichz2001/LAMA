<?php

namespace App\Http\Controllers\LAMA;

use App\Http\Controllers\LAMA\Objects\AdminDetails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index() {
        $currentRoleId = session()->get('currentRoleId');
        $currentOrganId = session()->get('currentOrganId');
        $SC = session()->get('_SC');
        if ($currentRoleId == null || $currentOrganId == null || $currentOrganId == 0 || $currentRoleId == 0 || $SC == null) {
            $adminDetails = new AdminDetails(Auth::id());
            //TODO handle users without role to send request to admin
            if ($adminDetails->accessibleRoles == [])
                return redirect('404');
            $defaultRole = $adminDetails->getDefaultRole();
            //return dump($defaultRole['role']['id']);
            session()->put(['currentRoleId' => $defaultRole['role']['id']]);
            session()->put(['currentOrganId' => $defaultRole['organ']['id']]);
            //put security code as SC in session Hash::make['user_id' + 'organ_id' + 'role_id']
            session()->put(['_SC' => Hash::make(Auth::id() . $defaultRole['organ']['id'] . $defaultRole['role']['id'])]);
            return redirect()->refresh();
        } else {
            return view('LAMA.index')->with(['_SC' => $SC]);
        }
    }
}
