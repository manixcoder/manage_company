<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\UserRoleRelation;
use App\Notifications\Users\UserCreation;
use App\User;
use Crypt;
use Illuminate\Http\Request;
use Redirect;
use Validator;
use Yajra\Datatables\Datatables;

class UserManagementController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'users']);
    }
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['roles'] = Role::get();
        return view('users.users.index', $data);
    }
    /**
     * Process datatables ajax request.
     * @return \Illuminate\Http\JsonResponse
     */
    public function userData()
    {
        $result = User::with(['getRole'])
            ->whereHas('roles', function ($q) {
                $q->where('name', 'user');
            })->get();
        return Datatables::of($result)
            ->addColumn('action', function ($result) {
                return '<a href ="' . url('user/user-management') . '/' . Crypt::encrypt($result->id) . '/edit"  class="btn btn-xs btn-primary edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                <a data-id =' . Crypt::encrypt($result->id) . ' class="btn btn-xs btn-danger delete" style="color:#fff"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>';
            })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['roles'] = Role::get();
        return view('users.users.create', $data);
    }
    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:users',
            'firstName' => 'required|min:2',
            'lastName' => 'required|min:2',
            'info' => 'required|min:2',
            'phone' => 'numeric|min:10',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $randomPassword = $this->randomSting(10);
        try {
            $userData = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'phone' => $request->phone,
                "info" => $request->info,
                "is_active" => $request->has('is_active') ? '1' : '0',
                'password' => bcrypt($randomPassword),
            ]);
            $roleArray = array(
                'user_id' => $userData->id,
                'role_id' => 3,
            );
            UserRoleRelation::insert($roleArray);
            $user = User::where('id', $userData->id)
                ->first();
            if ($userData) {
                $notificationData = [
                    "username" => $userData->name,
                    "message" => $userData->name,
                    "useremail" => $userData->email,
                    'userPassword' => $randomPassword,
                ];
                $user->notify(new UserCreation($notificationData));
            }
            return redirect('/user/user-management')->with(['status' => 'success', 'message' => 'New user Successfully created!']);
        } catch (\Exception $e) {
            //return back()->with(['status' => 'danger', 'message' => $e->getMessage()]);
            return back()->with(['status' => 'danger', 'message' => 'Some thing went wrong! Please try again later.']);
        }
    }

    /**
     * Genrate a new random string .
     * @param  $length (int)
     * @return string
     */
    public function randomSting($length)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size = strlen($chars);
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }
        return $str;
    }
    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = User::find(\Crypt::decrypt($id));
            if ($user) {
                $data['user'] = $user;
                $data['roles'] = Role::get();
                return view('admin.users.edit', $data);
            }
        } catch (\Exception $e) {
            return back()->with(['status' => 'danger', 'message' => $e->getMessage()]);
        }
    }
    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:2',
            'firstName' => 'required|min:2',
            'lastName' => 'required|min:2',
            'info' => 'required|min:2',
            'phone' => 'numeric|min:10',
        ];
        $messages = [
            'name.min' => 'First name should contain at least 2 characters.',
            'phone.min' => 'Phone Number should be min 10 digit.',
            'phone.numeric' => 'only digit are allowed',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $user = User::find(\Crypt::decrypt($id));
            $updateData = array(
                "name" => $request->has('name') ? $request->name : "",
                "firstName" => $request->has('firstName') ? $request->firstName : "",
                "lastName" => $request->has('lastName') ? $request->lastName : "",
                "info" => $request->has('info') ? $request->info : "",
                "phone" => $request->has('phone') ? $request->phone : "",
                "is_active" => $request->has('is_active') ? '1' : '0',
            );
            $user->update($updateData);
            return redirect('/user/user-management')->with(['status' => 'success', 'message' => 'Update record successfully.']);
        } catch (\exception $e) {
            // return back()->with(['status' => 'danger', 'message' =>  $e->getMessage()]);
            return back()->with(['status' => 'danger', 'message' => 'Some thing went wrong! Please try again later.']);
        }
    }
    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find(Crypt::decrypt($id))->delete();
    }
}
