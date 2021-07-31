<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserRoleRelation;
use Yajra\Datatables\Datatables;
use App\Models\Role;
use Validator;
use Redirect;
use App\User;
use Crypt;

class ComapanyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        return view('admin.company.index', $data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        return view('admin.company.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|max:255|min:2|unique:users',
            'email'         => 'required|email|max:255|unique:users',
            'logo'         =>  'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {

            $companyData =  User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                "password"  => bcrypt($request->password),
            ]);
            if ($request->hasFile('logo')) {
                $user = User::find($companyData->id);
                $file = $request->file('logo');
                $filename = 'compamy-logo-' . time() . '.' . $file->getClientOriginalExtension();
                $file->move('public/uploads/company_logo/', $filename);
                $user->logo = $filename;
                $user->save();
            }
            $roleArray = array(
                'user_id' => $companyData->id,
                'role_id' => 2, // comapny
            );
            UserRoleRelation::insert($roleArray);
            $user = User::where('id', $companyData->id)
                ->first();

            return redirect('/admin/company-management')->with(array('status' => 'success', 'message' => 'New Company Successfully created!'));
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
            $companyData = User::find(\Crypt::decrypt($id));
            if ($companyData) {
                $data['companyData'] = $companyData;
                return view('admin.company.edit', $data);
            }
        } catch (\Exception $e) {
            return back()->with(
                array(
                    'status' => 'danger',
                    'message' => $e->getMessage()
                )
            );
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
        //dd($request->all());
        $validator = Validator::make($request->all(), array(
            'name'          => 'required|max:255|min:2|unique:users,name,' . \Crypt::decrypt($id),
            'email'         => 'required|min:2',
            // 'logo'          => 'required',

        ));
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $companyData = User::find(\Crypt::decrypt($id));
            $updateData = array(
                "name" => $request->has('name') ? $request->name : "",
                "email" => $request->has('email') ? $request->email : "",

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
     *
     * @param  \App\Models\User  $User
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User, $id)
    {
        User::find(Crypt::decrypt($id))->delete();
    }

    /**
     * fetch company data using ajex
     */
    public function company_data()
    {
        $result = User::with(['getRole'])
            ->whereHas('roles', function ($q) {
                $q->where('name', 'company');
            })->get();
        return Datatables::of($result)
            ->addColumn('action', function ($result) {
                return '<a href ="' . url('admin/company-management') . '/' . Crypt::encrypt($result->id) . '/edit"  class="btn btn-xs btn-warning edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
            <a data-id =' . Crypt::encrypt($result->id) . ' class="btn btn-xs btn-danger delete" style="color:#fff"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>';
            })
            ->make(true);
    }
}
