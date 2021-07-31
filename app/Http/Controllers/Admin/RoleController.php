<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Crypt;
use Illuminate\Http\Request;
use Redirect;
use Validator;
use Yajra\Datatables\Datatables;

class RoleController extends Controller
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
     * View Front end form for report
     * @return void
     */

    public function index()
    {
        return view('admin.roles.index');
    }
    /**
     * save role
     * @return void
     */

    public function RoleSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name|regex:/^[A-Za-z. -]+$/',
            'display_name' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        try {
            Role::create($request->all());
            return response()->json(['status' => 'success', 'message' => 'New Role is added successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => 'Something went wrong! Please try again later.']);
            //return response()->json(['status' => 'danger','message' =>  $e->getMessage()]);
        }
    }
    /**
     * Process datatables ajax request.
     * @return \Illuminate\Http\JsonResponse
     */
    public function roleData()
    {
        $result = Role::get();
        return Datatables::of($result)
            ->addColumn('action', function ($result) {
                $deleteIcon = "";
                if ($result->name != 'admin' && $result->name != 'recruiter') {
                    $deleteIcon = "  <a data-id ='" . Crypt::encrypt($result->id) . "' class='btn btn-xs btn btn-danger delete' style='color:#fff'><i class='fa fa-trash-o' aria-hidden='true'></i></a>";
                }
                return '<a href ="' . env('APP_URL') . 'admin/role-management/' . $result->id . '/role-edit"  class="btn waves-effect waves-light btn-xs btn-info edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> ' . $deleteIcon;
            })->make(true);
    }
    /**
     * Edit role form show here
     * @return void
     */
    public function editRole($id)
    {
        $data['role'] = Role::find($id);
        return view('admin.roles.edit-role', $data);
    }
    /**
     * Edit Save Role
     * @return void
     */
    public function saveEditRole(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'display_name' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            Role::find($id)->update($request->all());
            return redirect('/admin/role-management');
        } catch (\Exception $e) {
            return back()->with(['status' => 'danger', 'message' => 'Some thing went wrong! Please try again later.']);
        }
    }
    /**
     * Delete Role
     * @return void
     */
    public function RoleDelete($id)
    {
        return Role::whereId(Crypt::decrypt($id))->delete();
    }
    /**
     * assign Permission for Roles
     * @return void
     */

    public function assignPermission($id)
    {
        $data = array();
        $data['roleDate'] = Role::find($id);
        $data['permissions'] = Permission::get();
        return view('admin.roles.assign-permissions', $data);
    }
    /**
     * save Permission
     * @return void
     */

    public function permissionAssign(Request $request)
    {
        try {
            if (!empty($request->permission_id)) {
                $role = Role::find($request->role_id);
                $role->perms()->sync($request->permission_id);
                return back()->with(['status' => 'success', 'message' => 'Permission assigned successfully.']);
            } else {
                return back()->with(['status' => 'danger', 'message' => 'Permission can not be empty.']);
            }
        } catch (\Exception $e) {
            return back()->with(['status' => 'danger', 'message' => $e->getMessage()]);
        }
    }
    /****************** Permission Functions ******************************/
    /**
     * View Front end form for permissions
     * @return void
     */
    public function permissionIndex()
    {
        $data['allRoles'] = Role::all();
        return view('admin.permissions.index', $data);
    }
    /**
     * save Permission
     * @return void
     */
    public function PermissionSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name|regex:/^[A-Za-z. -]+$/',
            'display_name' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        try {
            Permission::create($request->all());
            return response()->json(['status' => 'success', 'message' => 'New Permission is added successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => 'Something went wrong! Please try again later.']);
        }
    }
    /**
     * Process datatables ajax request.
     * @return \Illuminate\Http\JsonResponse
     */
    public function permissionData()
    {
        $result = Permission::select(['*']);
        return Datatables::of($result)
            ->addColumn('action', function ($result) {
                return '<a href ="' . env('APP_URL') . 'admin/role-management/' . $result->id . '/permission-edit"  class="btn btn-xs btn-primary edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            <a data-id =' . Crypt::encrypt($result->id) . ' class="btn btn-xs btn btn-danger delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
            })->make(true);
    }
    /**
     * Edit permission form show here
     * @return void
     */
    public function editPermission($id)
    {
        $data['permission'] = Permission::find($id);
        return view('admin.permissions.edit-permission', $data);
    }
    /**
     * Edit Save Permission
     * @return void
     */
    public function saveEditPermission(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'display_name' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            Permission::find($id)->update($request->all());
            return redirect('/admin/role-management/permissions');
        } catch (\Exception $e) {
            return back()->with(['status' => 'danger', 'message' => 'Some thing went wrong! Please try again later.']);
        }
    }
    /**
     * Delete Permission
     * @return void
     */
    public function PermissionDelete($id)
    {
        Permission::find(Crypt::decrypt($id))->delete();
    }
}
