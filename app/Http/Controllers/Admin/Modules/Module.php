<?php


namespace App\Http\Controllers\Admin\Modules;


use App\Http\Controllers\Admin\Objects\AdminDetails;

class Module
{
    protected $adminDetails;
    public function __construct()
    {
        $this->adminDetails = new AdminDetails();
    }

    public function view() {
        return 1;
    }
}
