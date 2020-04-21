<?php


namespace App\Http\Controllers\Admin\Objects;


use App\Company;
use App\Module;
use App\Role;
use App\Role_Module;
use App\User_Role_Company;
use Illuminate\Support\Facades\Auth;

class AdminDetails
{

    private $id;

    /**
     * @var array ['company_title' , ...]
     */
    public $accessibleCompanies = [];

    /**
     * @var array [[role => 'role_title', company => 'company_title'], ...]
     */
    public $accessibleRoles = [];

    /**
     * @var int|mixed company_id
     */
    private $currentCompanyId;

    /**
     * @var int|mixed role_id
     */
    private $currentRoleId;

    /**
     * @var array [id => 'company_id', title => 'company_title', created_at => 'timestamp, updated_at => 'timestamp]
     */
    public $currentCompanyDetails = [];

    /**
     * @var array [role => 'role_title', company => 'company_title']
     */
    public $currentRoleWithCompany = [];

    /**
     * @var array
     */
    public $modules = [];

    /**
     * @var array ['error_code', 'error_code', ...]
     */
    public $errors = [];

    public function __construct($id)
    {
        $this->id = $id;
        $this->setAllAccessibleCompanies();
        $this->setAllAccessibleRolesInAccessibleCompanies();
        $this->currentRoleId = !session()->has('currentRoleId') ? 0 : session()->get('currentRoleId');
        $this->currentCompanyId = !session()->has('currentCompanyId') ? 0 : session()->get('currentCompanyId');
        $this->setCurrentCompanyDetails();
        $this->setCurrentRoleDetails();
        $this->setModules();
    }

    /**
     * set all companies with true status that has access with true status in $this->accessibleCompanies
     */
    private function setAllAccessibleCompanies() {
        $userRoleCompany = User_Role_Company::where(['user_id' => $this->id, 'status' => 1])->with(['company'])->get()->toArray();
        $companies = [];
        foreach ($userRoleCompany as $item)
            if ($item['company'] != null && !in_array(['title' => $item['company']['title'], 'id' => $item['company']['id']], $companies))
                $companies[] = ['title' => $item['company']['title'], 'id' => $item['company']['id']];

        $this->accessibleCompanies = $companies;
    }

    /**
     * set all roles with true status and company true status and access with true status to $this->accessibleRoles
     */
    private function setAllAccessibleRolesInAccessibleCompanies() {
        $userRoleCompany = User_Role_Company::where(['user_id' => $this->id])->where(['status' => 1])->with('company', 'role')->get()->toArray();
        $roles = [];
        foreach ($userRoleCompany as $item)
            if ($item['company'] != null && $item['role'] != null)
                $roles[] = ['role' => $item['role']['title'], 'company' => $item['company']['title']];
        $this->accessibleRoles = $roles;
    }

    /**
     * set details of current company
     * if set currentCompanyId in session and that is accessible
     * put to $this->currentCompany
     * else
     * put 40010 error
     */
    private function setCurrentCompanyDetails() {
        $company = Company::where(['id' => $this->currentCompanyId, 'status' => 1])->get()->makeVisible(['created_at', 'updated_at', 'id'])->toArray();
        if (isset($company[0]) && in_array(['title' => $company[0]['title'], 'id' => $company[0]['id']], $this->accessibleCompanies))
            $this->currentCompanyDetails = $company[0];
        else
            $this->errors[] = 40010;
    }

    /**
     * set details of current role
     * if set currentRoleId in session and that is accessible
     * put to $this->currentRoleWithCompany
     * else
     * put error 40020
     */
    private function setCurrentRoleDetails() {
        $role = Role::where(['id' => $this->currentRoleId, 'status' => 1])->get()->toArray();
        if (isset($role[0]) && in_array(['role' => $role[0]['title'], 'company' => $this->currentCompanyDetails['title']], $this->accessibleRoles))
            $this->currentRoleWithCompany = ['role' => $role[0]['title'], 'company' => $this->currentCompanyDetails['title']];
        else
            $this->errors[] = 40020;
    }





































    public function setModules() {

        $modulesList = Role_Module::Where(['role_id' => $this->currentRoleId, 'status' => 1])->with('module')->get()->toArray();

        $modulesList1 = [];
        foreach ($modulesList as $item) {
            if ($item['module'] != null) {
                $modulesList1[$item['module']['id']] = $item['module'];
                if ($modulesList1[$item['module']['id']]['has_child'] == 1)
                    $modulesList1[$item['module']['id']]['sub_module'] = [];
            }
        }
        krsort($modulesList1);
        $modulesList2 = $modulesList1;
        foreach ($modulesList1 as $module) {
            if ($module['has_parent'] == 1 && isset($modulesList1[$module['parent_id']])) {
                $modulesList2[$module['parent_id']]['sub_module'][$module['id']] = $modulesList2[$module['id']];

            }
        }
        $modulesList3 = [];
        foreach ($modulesList2 as $module)
            if ($module['has_parent'] == 0)
                $modulesList3[$module['id']] = $module;
        ksort($modulesList3);
        $this->modules = $modulesList3;
    }

}
