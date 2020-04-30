<?php


namespace App\Http\Controllers\LAMA\Objects;


use App\Entities\Organ;
use App\Entities\Role;
use App\Entities\Role_Module;
use App\Entities\User_Role_Organ;
use Illuminate\Support\Facades\Auth;

class AdminDetails
{


    //TODO there is some way to make better performance for this object


    private $id;

    /**
     * @var array ['organ_title' , ...]
     */
    public $accessibleOrgans = [];

    /**
     * @var array [[role => 'role_title', organ => 'organ_title'], ...]
     */
    public $accessibleRoles = [];

    /**
     * @var int|mixed organ_id
     */
    private $currentOrganId = 0;

    /**
     * @var int|mixed role_id
     */
    private $currentRoleId = 0;

    /**
     * @var array [id => 'organ_id', title => 'organ_title', created_at => 'timestamp, updated_at => 'timestamp]
     */
    public $currentOrganDetails = [];

    /**
     * @var array [role => 'role_title', organ => 'organ_title']
     */
    public $currentRoleWithOrgan = [];

    /**
     * @var array
     */
    public $rolesOfCurrentOrgan = [];

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
        $this->setAllAccessibleOrgans();
        $this->setAllAccessibleRolesInAccessibleOrgans();
        $this->currentRoleId = !session()->has('currentRoleId') ? 0 : session()->get('currentRoleId');
        $this->currentOrganId = !session()->has('currentOrganId') ? 0 : session()->get('currentOrganId');
        $this->setCurrentOrganDetails();
        $this->setRolesOfCurrentOrgan();
        $this->setCurrentRoleDetails();
        $this->setModules();
    }

    /**
     * set all organs with true status that has access with true status in $this->accessibleOrgans
     */
    private function setAllAccessibleOrgans() {
        $userRoleOrgan = User_Role_Organ::where(['user_id' => $this->id, 'status' => 1])->with(['organ'])->get()->toArray();
        $organs = [];
        foreach ($userRoleOrgan as $item)
            if ($item['organ'] != null && !in_array(['title' => $item['organ']['title'], 'id' => $item['organ']['id']], $organs))
                $organs[] = ['title' => $item['organ']['title'], 'id' => $item['organ']['id']];

        $this->accessibleOrgans = $organs;
    }

    /**
     * set all roles with true status and organ true status and access with true status to $this->accessibleRoles
     */
    private function setAllAccessibleRolesInAccessibleOrgans() {
        $userRoleOrgan = User_Role_Organ::where(['user_id' => $this->id])->where(['status' => 1])->with('organ', 'role')->get()->toArray();
        $roles = [];
        foreach ($userRoleOrgan as $item)
            if ($item['organ'] != null && $item['role'] != null)
                $roles[] = ['role' => ['title' => $item['role']['title'], 'id' => $item['role']['id']], 'organ' => ['title' => $item['organ']['title'], 'id' => $item['organ']['id']]];
        $this->accessibleRoles = $roles;
    }

    /**
     * set details of current organ
     * if set currentOrganId in session and that is accessible
     * put to $this->currentOrgan
     * else
     * put 40010 error
     */
    private function setCurrentOrganDetails() {
        $organ = Organ::where(['id' => $this->currentOrganId, 'status' => 1])->get()->makeVisible(['created_at', 'updated_at', 'id'])->toArray();
        if (isset($organ[0]) && in_array(['title' => $organ[0]['title'], 'id' => $organ[0]['id']], $this->accessibleOrgans))
            $this->currentOrganDetails = $organ[0];
        else
            $this->errors[] = 40010;
    }

    /**
     * set details of current role
     * if set currentRoleId in session and that is accessible
     * put to $this->currentRoleWithOrgan
     * else
     * put error 40020
     */
    private function setCurrentRoleDetails() {
        $role = Role::where(['id' => $this->currentRoleId, 'status' => 1])->get()->toArray();
        if (isset($role[0]) && in_array(['role' => ['title' => $role[0]['title'], 'id' => $role[0]['id']], 'organ' => ['title' => $this->currentOrganDetails['title'], 'id' => $this->currentOrganDetails['id']]], $this->accessibleRoles))
            $this->currentRoleWithOrgan = ['role' => $role[0]['title'], 'organ' => $this->currentOrganDetails['title']];
        else
            $this->errors[] = 40020;
    }

    private function setRolesOfCurrentOrgan() {
        $userRoleOrgan = User_Role_Organ::where(['organ_id' => $this->currentOrganId, 'user_id' => Auth::id(), 'status' => 1])->with(['role'])->get()->makeVisible(['id', 'status'])->toArray();
        $roles = [];
        foreach ($userRoleOrgan as $item) {
            $roles[] = $item['role'];
        }
        $this->rolesOfCurrentOrgan = $roles;
    }







    public function getDefaultRole() {
        $userRoleOrgan = User_Role_Organ::where(['status' => 1, 'user_id' => $this->id, 'is_default' => 1])->with(['role', 'organ'])->get()->toArray();
        $out = [];
        if (isset($userRoleOrgan[0]))
            $out = ['role' => $userRoleOrgan[0]['role'], 'organ' => $userRoleOrgan[0]['organ']];
        return $out;
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
