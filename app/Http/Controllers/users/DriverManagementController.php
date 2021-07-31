<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\CountryModel;
use App\Models\DriverManagementModel;
use App\Models\Role;
use App\Services\UserService;
use App\User;
use Auth;
use Crypt;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class DriverManagementController extends Controller
{
    /**
     * Construct.
     * */
    public function __construct(Request $request)
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
        return view('users.driversManagement.index', $data);
    }

    public function loginWithNavaxy(Request $request, UserService $userService)
    {
        $validator = Validator::make($request->all(), [
            'userEmail' => 'required|max:255|min:2',
            'userPassword' => 'required|min:2',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        try {
            $login = 'user/auth?login=' . $request->userEmail . '&password=' . $request->userPassword;
            $userData = $userService->callAPI($login);
            // dd($userData);
            if (isset($userData['hash'])) {
                $hash = $userData['hash'];
            } else {
                $hash = '';
            }
            $request->session()->put('hash', $hash);
            $sessiondata = $request->session()->all();
            if ($userData['success'] === false) {
                return response()->json(array('status' => 'error', 'message' => $userData['status']['description']));
            } else {
                DB::table('users')
                    ->where('id', Auth::user()->id)
                    ->update([
                        'ontrac_username' => $request->userEmail,
                        'ontrac_password' => Crypt::encrypt($request->userPassword),
                    ]);
                return response()->json(array('status' => 'success', 'message' => 'login Successfully.'));
            }
        } catch (\Exception $e) {
            return response()->json(array('status' => 'error', 'message' => $e->getMessage()));
        }
    }
    public function driverData(Request $request, UserService $userService)
    {
        $sessiondata = $request->session()->all();
        $requestedUrl = 'employee/list?hash=' . $sessiondata['hash'];
        $result = $userService->callAPI($requestedUrl);
        return $result = json_encode($result);
    }
    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, UserService $userService)
    {
        $data['roles'] = Role::get();
        $data['country'] = CountryModel::get();
        $data['company'] = $result = User::with(['getRole'])
            ->whereHas('roles', function ($q) {
                $q->where('name', 'company');
            })->get();
        $sessiondata = $request->session()->all();
        $requestUrl = "tracker/list?hash=" . $sessiondata['hash'];
        $data['trackerData'] = $userService->callAPI($requestUrl);
        return view('users.driversManagement.create', $data);
    }
    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, UserService $userService)
    {
        if ($request->tracker_id === 'nullTracker') {
            $tracker_id = 'null';
        } else {
            $tracker_id = $request->tracker_id;
        }
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255|min:2',
            'middle_name' => 'required',
            'last_name' => 'required|min:2',
            'email' => 'required|max:255',
            'phone' => 'required|numeric|min:10',
            'driver_license_number' => 'required',
            'driver_license_valid_till' => 'required',
            'personnel_number' => 'required',
            //'tracker_id' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $randomPassword = $this->randomSting(10);
            $driver_license_class = implode(",", $request->driver_license_class);
            $sessiondata = $request->session()->all();
            $hash = $sessiondata['hash'];
            $newDriverData = '{
                "tracker_id": ' . $tracker_id . ',
                "first_name": "' . $request->first_name . '",
                "middle_name": "' . $request->middle_name . '",
                "last_name": "' . $request->last_name . '",
                "email": "' . $request->email . '",
                "phone": "' . $request->phone . '",
                "driver_license_number": "' . $request->driver_license_number . '",
                "driver_license_cats": "' . $driver_license_class . '",
                "driver_license_valid_till":"' . $request->driver_license_valid_till . '",
                "hardware_key": null,
                "icon_id" : 55,
                "avatar_file_name": null,
                "department_id": null,
                "personnel_number": "' . $request->personnel_number . '",
                "tags": [1,2]
            }';
            $realArray = array(
                'hash' => $hash,
                'employee' => $newDriverData,
            );
            $requestUrl = 'employee/create';
            $userData = $userService->postAPI($requestUrl, $realArray);
            if ($userData['success'] === false) {
                return back()->with(['apiErrorData' => $userData, 'status' => 'danger', 'message' => $userData['errors'][0]['parameter']]);
            } else {
                return redirect('/user/driver-management')->with(['status' => 'success', 'message' => 'New Driver Successfully created!']);
            }
        } catch (\Exception $e) {
            //return back()->with(['status' => 'danger', 'message' => $e->getMessage()]);
            return back()->with(['status' => 'danger', 'message' => 'Some thing went wrong! Please try again later.']);
        }
    }
    /**
     * Display the specified resource.
     * @param  \App\Models\DriverManagementModel  $driverManagementModel
     * @return \Illuminate\Http\Response
     */
    public function show(DriverManagementModel $driverManagementModel)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\DriverManagementModel  $driverManagementModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request, UserService $userService)
    {
        $sessiondata = $request->session()->all();
        $requestUrl = "tracker/list?hash=" . $sessiondata['hash'];
        $data['trackerData'] = $userService->callAPI($requestUrl);
        $requestUrl = "employee/read/?employee_id=" . $id . "&hash=" . $sessiondata['hash'];
        $userData = $userService->callAPI($requestUrl);
        $data['userData'] = $userData;
        $data['country'] = CountryModel::get();
        $data['company'] = User::with(['getRole'])
            ->whereHas('roles', function ($q) {
                $q->where('name', 'company');
            })
            ->get();
        return view('users.driversManagement.edit', $data);
    }
    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DriverManagementModel  $driverManagementModel
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, UserService $userService)
    {
        try {
            if ($request->tracker_id === 'nullTracker') {$tracker_id = 'null';} else { $tracker_id = $request->tracker_id;}
            $sessiondata = $request->session()->all();
            $requestUrl = "employee/read/?employee_id=" . $id . "&hash=" . $sessiondata['hash'];
            $userData = $userService->callAPI($requestUrl);
            $driver_license_class = implode(",", $request->driver_license_class);
            $newDriverData = '{
                "id": "' . $id . '",
                "tracker_id": ' . $tracker_id . ',
                "first_name": "' . $request->first_name . '",
                "middle_name": "' . $request->middle_name . '",
                "last_name": "' . $request->last_name . '",
                "email": "' . $request->email . '",
                "phone": "' . $request->phone . '",
                "driver_license_number": "' . $request->driver_license_number . '",
                "driver_license_cats": "' . $driver_license_class . '",
                "driver_license_valid_till":"' . $request->driver_license_valid_till . '",
                "hardware_key": null,
                "icon_id" : 55,
                "avatar_file_name": null,
                "department_id": null,
                "location": {
                    "lat": ' . $request->lat . ',
                    "lng": ' . $request->log . ',
                    "address": "' . $request->lacationaddress . '"
                },
                "personnel_number": "' . $request->personnel_number . '",
                "tags": [1,2]
            }';
            $realArray = array(
                'hash' => $sessiondata['hash'],
                'employee' => $newDriverData,
            );
            $requestUrl = "employee/update";
            $userData = $userService->postAPI($requestUrl, $realArray);
            if ($userData['success'] === false) {
                return back()->with(['status' => 'danger', 'message' => $userData['status']['description'] . " " . $userData['errors'][0]['parameter']]);
            } else {
                return redirect('/user/driver-management')->with(['status' => 'success', 'message' => 'Driver update Successfully!']);
            }

        } catch (\Exception $e) {
            //return back()->with(['status' => 'danger', 'message' => $e->getMessage()]);
            return back()->with(['status' => 'danger', 'message' => 'Some thing went wrong! Please try again later.']);
        }
    }
    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\DriverManagementModel  $driverManagementModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request, UserService $userService)
    {
        $sessiondata = $request->session()->all();
        $requestUrl = "employee/delete/?employee_id=" . $id . "&hash=" . $sessiondata['hash'];
        $data['userData'] = $userService->callAPI($requestUrl);
        return redirect('/user/driver-management')->with(['status' => 'success', 'message' => 'Driver delete successfully!']);
    }
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

    public function getCountryName($localAddress, Request $request, UserService $userService)
    {
        $sessiondata = $request->session()->all();
        $requestUrl = "geocoder/search_address?hash=" . $sessiondata['hash'] . "&q=" . str_replace(' ', '', $localAddress);
        $userData = $userService->callAPI($requestUrl);
        $address = explode(",", $userData['locations'][0]['address']);
        $country = array_reverse($address);
        $datacountry = CountryModel::where('name', trim($country[0]))->get();
        return response()->json(['status' => 'success', 'data' => $datacountry, 'apidata' => $userData, 'message' => ' successfully.']);
    }
}
