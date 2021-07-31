<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserRoleRelation;
use App\User;
use Auth;
use Crypt;
use Redirect;
use Validator;
use App\Models\Role;
use Yajra\Datatables\Datatables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        return view('admin.employee.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $company = User::with(['getRole'])
            ->whereHas('roles', function ($q) {
                $q->where('name', 'company');
            })->get();
        $data['company'] = $company;

        return view('admin.employee.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [

            'firstName'         =>  'required',
            'lastName'         =>  'required',
            'name'          => 'required|max:255|min:2|unique:users',
            'email'         => 'required|email|max:255|unique:users',
            'salary'         =>  'required',
            'phone'         =>  'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {

            $employeeData =  User::create([
                'firstName'      => $request->firstName,
                'lastName'       => $request->lastName,
                'name'           => $request->name,
                'email'          => $request->email,
                "password"       => bcrypt($request->password),
                'salary'         => $request->salary,
                'phone'          => $request->phone,
                'company_id'     => $request->company_id,
            ]);

            $roleArray = array(
                'user_id' => $employeeData->id,
                'role_id' => 3, // employee
            );
            UserRoleRelation::insert($roleArray);
            $user = User::where('id', $employeeData->id)
                ->first();

            return redirect('/admin/employee-management')->with(array('status' => 'success', 'message' => 'New Employee Successfully created!'));
        } catch (\Exception $e) {
            //return back()->with(array('status' => 'danger', 'message' =>  $e->getMessage()));
            return back()->with(array('status' => 'danger', 'message' =>  'Something went wrong. Please try again later.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $employeData = User::find(\Crypt::decrypt($id));
            if ($employeData) {
                $data['employeData'] = $employeData;
                return view('admin.employee.edit', $data);
            }
        } catch (\Exception $e) {
            return back()->with(array('status' => 'danger', 'message' => $e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $User, $id)
    {
        $validator = Validator::make($request->all(), array(
            'firstName'     => 'required',
            'lastName'      => 'required',
            'name'          => 'required|max:255|min:2|unique:users,name,' . \Crypt::decrypt($id),
            'phone'         => 'required',
            'salary'        => 'required',

        ));
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $companyData = User::find(\Crypt::decrypt($id));
            $updateData = array(
                "firstName" => $request->has('firstName') ? $request->firstName : "",
                "lastName" => $request->has('lastName') ? $request->lastName : "",
                "phone" => $request->has('phone') ? $request->phone : "",
                "salary" => $request->has('salary') ? $request->salary : "",
                "name" => $request->has('name') ? $request->name : "",

            );
            $companyData->update($updateData);
            return redirect('/admin/company-management')->with(array('status' => 'success', 'message' => 'Update record successfully.'));
        } catch (\exception $e) {
            //return back()->with(array('status' => 'danger', 'message' =>  $e->getMessage()));
            return back()->with(array('status' => 'danger', 'message' => 'Some thing went wrong! Please try again later.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\User  $User
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User, $id)
    {
        User::find(Crypt::decrypt($id))->delete();
    }
    public function employee_data()
    {

        $result = User::with(['getRole'])
            ->whereHas('roles', function ($q) {
                $q->where('name', 'employee');
            })->get();
        return Datatables::of($result)
            ->addColumn('action', function ($result) {
                return '<a href ="' . url('admin/employee-management') . '/' . Crypt::encrypt($result->id) . '/edit"  class="btn btn-xs btn-warning edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
            <a data-id =' . Crypt::encrypt($result->id) . ' class="btn btn-xs btn-danger delete" style="color:#fff"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>';
            })
            ->make(true);
    }
}
