<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard() {
        $roleId = session()->get('currentRoleId');
        $organId = session()->get('currentOrganId');
        if ($roleId == null || $organId == null || $organId == 0 || $roleId == 0)
            return view('Admin.setRole');
        return view('Admin.index');
    }
}
