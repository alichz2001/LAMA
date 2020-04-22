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

    private $req;
    public function __construct(Request $req)
    {
        $this->req = $req->toArray();
    }

    public function changeCompany() {
        $adminDetails = new AdminDetails(Auth::id());
        return dump($this->req);
    }
}
