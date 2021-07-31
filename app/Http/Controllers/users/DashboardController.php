<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\CountryModel;
use App\Models\LicenseClassModel;
use App\User;
use Auth;
use Crypt;
use Illuminate\Http\Request;
use Validator;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth', 'users']);

    }
    public function index()
    {
        $userData = User::with(['getRole'])
            ->whereHas('roles', function ($q) {
                $q->where('name', 'user');
            })->get()->count();
        $companyData = User::with(['getRole'])
            ->whereHas('roles', function ($q) {
                $q->where('name', 'company');
            })->get()->count();

        return view('users.dashboard.index')->with(
            array(
                'user_data' => $userData,
                'masjid_data' => $companyData,
            )
        );
    }
    /**
     * Show the Admin Profile.
     * */
    public function myAccount()
    {
        $data['userData'] = User::where('id', Auth::user()->id)->first();
        $data['country'] = CountryModel::get();
        $data['licenseClass'] = LicenseClassModel::Where('country_id', Auth::user()->addressCountry)->orderBy('license_class', 'ASC')->get();
        $data['company'] = User::with(['getRole'])
            ->whereHas('roles', function ($q) {
                $q->where('name', 'company');
            })->get();
        return view('users.dashboard.profileSetting', $data);
    }
    public function userProfileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'firstName' => 'required|min:2',
            'lastName' => 'required|min:2',
            'info' => 'required|min:2',
            'phone' => 'numeric|min:10',
            'addressCountry' => 'required',
            'driver_license_class' => 'required',
            'addressLine' => 'required',
            'driver_license_id' => 'required',
            'driver_license_expiry' => 'required',
        ));
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $driver_license_class = implode(",", $request->driver_license_class);
            $save_profile = User::find(Auth::user()->id);
            $save_profile->name = $request->name;
            $save_profile->firstName = $request->firstName;
            $save_profile->lastName = $request->lastName;
            $save_profile->phone = $request->phone;
            $save_profile->info = $request->info;
            $save_profile->addressCountry = $request->addressCountry;
            $save_profile->driver_license_class = $driver_license_class;
            $save_profile->driver_license_expiry = $request->driver_license_expiry;
            $save_profile->driver_license_id = $request->driver_license_id;
            $save_profile->ontrac_username = $request->ontrac_username;
            $save_profile->ontrac_password = Crypt::encrypt($request->ontrac_password);
            $save_profile->save();
            return redirect('/user/profile')->with(array('status' => 'success', 'message' => 'Profile details updated successfully!'));
        } catch (\Exception $e) {
            return back()->with(array('status' => 'danger', 'message' => $e->getMessage()));
            //return back()->with(array('status' => 'danger' , 'message' => 'Something went wrong. Please try again later.'));
        }
    }
}
