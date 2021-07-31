<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\UserRoleRelation;
use App\Notifications\Masjid\MasjidCreation;
use App\User;
use Crypt;
use Illuminate\Http\Request;
use Redirect;
use Validator;
use Yajra\Datatables\Datatables;

class CompanyManagementController extends Controller
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
        $data = array();
        return view('users.masjid.index', $data);
    }
    public function masjidData()
    {
        $result = User::with(['getRole'])
            ->whereHas('roles', function ($q) {
                $q->where('name', 'company');
            })->get();
        return Datatables::of($result)
            ->addColumn('action', function ($result) {
                return '<a href ="' . url('user/insurance-company-management') . '/' . Crypt::encrypt($result->id) . '/edit"  class="btn btn-xs btn-warning edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                <a data-id =' . Crypt::encrypt($result->id) . ' class="btn btn-xs btn-danger delete" style="color:#fff"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>';
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        return view('users.masjid.create', $data);
    }
    public function recursive($text)
    {
        if (count($user) > 0) {
            $this->recursive($user[0]->slug . "-" . rand(10, 1000));
        } else {
            return $text;
        }
    }
    public function slugify($text)
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        if ($text) {
            return $this->recursive($text);
        } else {
            return $text;
        }
    }
    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:users',
            'name' => 'required|max:255|min:2|unique:users',
            'phone' => 'numeric|min:10',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $randomPassword = $this->randomSting(10);
            $companyData = User::create([
                'name' => $request->name,
                'email' => $request->email,
                "password" => bcrypt($randomPassword),
                "info" => $request->info,
                "phone" => $request->phone,
                "is_active" => 1,
            ]);
            $roleArray = array(
                'user_id' => $companyData->id,
                'role_id' => 2, // masjid user
            );
            UserRoleRelation::insert($roleArray);
            // Send Welcome email
            $user = User::where('id', $companyData->id)
                ->first();
            if ($companyData) {
                $notificationData = array(
                    "username" => $companyData->name,
                    "message" => $companyData->name,
                    "useremail" => $companyData->email,
                    'userPassword' => $randomPassword,
                );
                $user->notify(new MasjidCreation($notificationData));
            }
            return redirect('/user/insurance-company-management')->with(array('status' => 'success', 'message' => 'New Company Successfully created!'));
        } catch (\Exception $e) {
            //return back()->with(array('status' => 'danger', 'message' =>  $e->getMessage()));
            return back()->with(array('status' => 'danger', 'message' => 'Something went wrong. Please try again later.'));
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
     * Display the specified resource.
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $masjidData = User::find(\Crypt::decrypt($id));
        return view('users.masjid.masjid_view')->with(array('masjidData' => $masjidData));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Masjid  $Masjid
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $masjid = User::find(\Crypt::decrypt($id));
            if ($masjid) {
                $data['masjid'] = $masjid;
                return view('users.masjid.edit', $data);
            }
        } catch (\Exception $e) {
            return back()->with(
                array(
                    'status' => 'danger',
                    'message' => $e->getMessage(),
                )
            );
        }
    }
    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $User, $id)
    {
        $validator = Validator::make($request->all(), array(
            'name' => 'required|max:255|min:2|unique:users,name,' . \Crypt::decrypt($id),
            'email' => 'required|min:2',
            'info' => 'required|min:2',
            'phone' => 'numeric|min:10',
        ));
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $companyData = User::find(\Crypt::decrypt($id));
            $updateData = array(
                "name" => $request->has('name') ? $request->name : "",
                "email" => $request->has('email') ? $request->email : "",
                "info" => $request->has('info') ? $request->info : "",
                "phone" => $request->has('phone') ? $request->phone : "",
                "is_active" => $request->has('is_active') ? '1' : '0',
            );
            $companyData->update($updateData);
            return redirect('/user/insurance-company-management')->with(array('status' => 'success', 'message' => 'Update record successfully.'));
        } catch (\exception $e) {
            //return back()->with(array('status' => 'danger','message' =>  $e->getMessage()));
            return back()->with(array('status' => 'danger', 'message' => 'Some thing went wrong! Please try again later.'));
        }
    }
    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User, $id)
    {
        User::find(Crypt::decrypt($id))->delete();
    }
}
