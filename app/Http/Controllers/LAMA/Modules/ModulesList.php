<?php
namespace App\Http\Controllers\LAMA\Modules;

use App\Entities\Method;
use App\Entities\Module;
use App\Http\Controllers\LAMA\Handler\Response;
use Illuminate\Support\Facades\DB;

class ModulesList
{
    public function view() {
        return view('LAMA.Modules.ModulesList');
    }

    public function getModulesList() {
        $modules = Module::all()->toArray();
        return Response::Handle(true, ['modules' => $modules], 1, 20000);
    }

    public function getModuleDetails($req) {
        $moduleDetails = Module::where(['id' => $req['id']])->with('subModules', 'methods')->get()->makeVisible(['file_name', 'status'])->toArray();
        if (isset($moduleDetails[0])) {
            return Response::Handle(true, ['module_details' => $moduleDetails[0]], 1,20000);
        } else {
            return Response::Handle(false, '', 2, 40050);
        }

    }

    public function removeModule($req) {
        Module::where(['id' => $req['id']])->delete();
        return Response::Handle(true, '', 1,20000);
    }

    public function editModule($req) {
        //return dump($req);
        try {
            DB::transaction(function () use ($req) {
                $newModule = Module::where(['id' => $req['id']]);
                $newModule->update([
                    'title' => $req['title'],
                    'sys_title' => $req['sys_title'],
                    'file_name' => $req['file_name'],
                    'parent_id' => ($req['parent_id'] == null) ? null : $req['parent_id'],
                    'has_parent' => ($req['parent_id'] == null) ? 0 : 1,
                ]);

                Method::where(['module_id' => $req['id']])->delete();
                if (isset($req['methods']))
                    foreach ($req['methods'] as $item)
                        if (isset($item['public_name']))
                            Method::create([
                                'module_id' => $req['id'],
                                'public_name' => $item['public_name'],
                                'sys_name' => $item['sys_name'],
                                'type' => $item['type'],
                            ]);
                if ((int)$req['parent_id'] != 0) {
                    Module::where(['id' => $req['parent_id']])->update(['has_child' => 1]);
                }

            });

            return Response::Handle(true, '', 1, 60000);
        } catch (\Exception $e) {
            return Response::Handle(false, ['errorCode' => $e->getMessage()], 2, 70000);
        }
    }


}
