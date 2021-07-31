<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\PermissionRoleRelation;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionsManagementController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataRoles = Role::get()->toArray();
        foreach ($dataRoles as $key => $role) {
            $dataRoles[$key]['AllPermissions'] = PermissionRoleRelation::where('role_id', $role['id'])->get()->toArray();
        }
        $data['roles'] = $dataRoles;
        $data['permission'] = Permission::get();
        return view('admin.permissions.index', $data);
    }
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name'          => 'required',
        //     'display_name'  => 'required',
        //     'description'   => 'required',
        // ]);
        // if ($validator->fails()) {
        //     return back()->withErrors($validator)->withInput();
        // }
        try {
            $permData = Permission::create([
                'name' => str_replace(' ', '-', $request->display_name),
                'display_name' => $request->display_name,
                'description' => $request->description,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            foreach ($request->role as $role_id) {
                $permArray = array('permission_id' => $permData->id, 'role_id' => $role_id);
                PermissionRoleRelation::insert($permArray);
            }
            return response()->json(['status' => 'success', 'message' => 'New Permission is added successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => 'Something went wrong! Please try again later.']);
            //return response()->json(['status' => 'danger', 'message' => $e->getMessage()]);
        }
    }
    public function update(Request $request)
    {
        $roleId = $request->roleId;
        $permissionId = $request->permissionId;
        $permission = PermissionRoleRelation::where('role_id', $roleId)->where('permission_id', $permissionId)->get()->toArray();
        if (!empty($permission)) {
            PermissionRoleRelation::where('role_id', $roleId)->where('permission_id', $permissionId)->delete();
        } else {
            $permArray = array('permission_id' => $permissionId, 'role_id' => $roleId);
            PermissionRoleRelation::insert($permArray);
        }
    }
}