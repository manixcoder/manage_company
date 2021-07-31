<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\AssestModel;
use App\Models\FuelModel;
use App\Models\Role;
use App\Models\VehicleModel;
use App\Services\UserService;
use Auth;
use Illuminate\Http\Request;
use Validator;

class VehicleManagementController extends Controller
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
        return view('users.vehicleManagement.index', $data);
    }
    public function driverData(Request $request, UserService $userService)
    {
        $sessiondata = $request->session()->all();
        $requestedUrl = 'vehicle/list/?hash=' . $sessiondata['hash'];
        $vehicleData = $userService->callAPI($requestedUrl);
        $assestData = AssestModel::where('user_id', Auth::user()->id)->get()->toArray();
        $arr = array();
        foreach ($assestData as $key => $assestValue) {
            $arr[] = $assestValue['assets_id'];
        }
        $arr2 = array();
        foreach ($vehicleData['list'] as $key => $assets) {
            $data['assest'] = AssestModel::where('user_id', Auth::user()->id)
                ->where('assets_id', $assets['id'])
                ->get()
                ->toArray();
            $arr2[] = $assets['id'];
            if (count($data['assest']) > 0) {
                $assetsData = AssestModel::where('assets_id', $assets['id'])->first();
                $assetData = AssestModel::find($assetsData['id']);
                $assetData->tracker_id = $assets['tracker_id'];
                $assetData->label = $assets['label'];
                $assetData->max_speed = $assets['max_speed'];
                $assetData->model = $assets['model'];
                $assetData->type = $assets['type'];
                if (isset($assets['subtype'])) {
                    $assetData->subtype = $assets['subtype'];
                } else {
                    $assetData->subtype = null;
                }
                $assetData->garage_id = $assets['garage_id'];
                $assetData->status_id = $assets['status_id'];
                $assetData->trailer = $assets['trailer'];
                $assetData->manufacture_year = $assets['manufacture_year'];
                $assetData->color = $assets['color'];
                $assetData->additional_info = $assets['additional_info'];
                $assetData->reg_number = $assets['reg_number'];
                $assetData->vin = $assets['vin'];
                $assetData->frame_number = $assets['frame_number'];
                $assetData->payload_weight = $assets['payload_weight'];
                $assetData->payload_height = $assets['payload_height'];
                $assetData->payload_length = $assets['payload_length'];
                $assetData->payload_width = $assets['payload_width'];
                $assetData->passengers = $assets['passengers'];
                $assetData->gross_weight = $assets['gross_weight'];
                $assetData->fuel_type = $assets['fuel_type'];
                $assetData->fuel_grade = $assets['fuel_grade'];
                $assetData->norm_avg_fuel_consumption = $assets['norm_avg_fuel_consumption'];
                $assetData->fuel_tank_volume = $assets['fuel_tank_volume'];
                $assetData->fuel_cost = $assets['fuel_cost'];
                $assetData->wheel_arrangement = $assets['wheel_arrangement'];
                $assetData->tyre_size = $assets['tyre_size'];
                $assetData->tyres_number = $assets['tyres_number'];
                $assetData->liability_insurance_policy_number = $assets['liability_insurance_policy_number'];
                $assetData->liability_insurance_valid_till = $assets['liability_insurance_valid_till'];
                $assetData->free_insurance_policy_number = $assets['free_insurance_policy_number'];
                $assetData->free_insurance_valid_till = $assets['free_insurance_valid_till'];
                $assetData->save();
            } else {
                $userData = AssestModel::create([
                    'user_id' => Auth::user()->id,
                    'assets_id' => $assets['id'],
                    'tracker_id' => $assets['tracker_id'],
                    'label' => $assets['label'],
                    'max_speed' => $assets['max_speed'],
                    "model" => $assets['model'],
                    "type" => $assets['type'],
                    //'subtype' => $assets['subtype'],
                    'garage_id' => $assets['garage_id'],
                    'status_id' => $assets['status_id'],
                    'trailer' => $assets['trailer'],
                    'manufacture_year' => $assets['manufacture_year'],
                    'color' => $assets['color'],
                    'additional_info' => $assets['additional_info'],
                    'reg_number' => $assets['reg_number'],
                    'vin' => $assets['vin'],
                    'frame_number' => $assets['frame_number'],
                    'payload_weight' => $assets['payload_weight'],
                    'payload_height' => $assets['payload_height'],
                    'payload_length' => $assets['payload_length'],
                    'payload_width' => $assets['payload_width'],
                    'passengers' => $assets['passengers'],
                    'gross_weight' => $assets['gross_weight'],
                    'fuel_type' => $assets['fuel_type'],
                    'fuel_grade' => $assets['fuel_grade'],
                    'norm_avg_fuel_consumption' => $assets['norm_avg_fuel_consumption'],
                    'fuel_tank_volume' => $assets['fuel_tank_volume'],
                    'fuel_cost' => $assets['fuel_cost'],
                    'wheel_arrangement' => $assets['wheel_arrangement'],
                    'tyre_size' => $assets['tyre_size'],
                    'tyres_number' => $assets['tyres_number'],
                    'liability_insurance_policy_number' => $assets['liability_insurance_policy_number'],
                    'liability_insurance_valid_till' => $assets['liability_insurance_valid_till'],
                    'free_insurance_policy_number' => $assets['free_insurance_policy_number'],
                    'free_insurance_valid_till' => $assets['free_insurance_valid_till'],
                ]);
            }
        }
        $diffArray = array_diff($arr, $arr2);
        if (!empty($diffArray)) {
            DB::table('assets')->whereIn('assets_id', $diffArray)->delete();
        }

        return $result = json_encode($vehicleData);
    }
    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, UserService $userService)
    {
        $data['roles'] = Role::get();
        $data['vehicleData'] = VehicleModel::get();
        $data['fuelData'] = FuelModel::get();
        $sessiondata = $request->session()->all();
        $requestUrl = "tracker/list?hash=" . $sessiondata['hash'];
        $data['trackerData'] = $userService->callAPI($requestUrl);
        return view('users.vehicleManagement.create', $data);
    }
    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, UserService $userService)
    {
        $validator = Validator::make($request->all(), [
            'label' => 'required|max:255|min:2',
            'model' => 'required',
            'fuel_type' => 'required',
            'type' => 'required',
            'manufacture_year' => 'required',
            'max_speed' => 'required|numeric',
            'fuel_tank_volume' => 'required|numeric',
            'reg_number' => 'required',
            'liability_insurance_policy_number' => 'required',
            'liability_insurance_valid_till' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            if ($request->tracker_id === 'nullTracker') {$tracker_id = 'null';} else { $tracker_id = $request->tracker_id;}
            $sessiondata = $request->session()->all();
            $hash = $sessiondata['hash'];
            $newVehicleData = '{
                "tracker_id":' . $tracker_id . ',
                "label": "' . $request->label . '",
                "max_speed": ' . $request->max_speed . ',
                "model": "' . $request->model . '",
                "type": "' . $request->type . '",
                "subtype": null,
                "garage_id": null,
                "trailer" : "' . $request->trailer . '",
                "manufacture_year" : ' . $request->manufacture_year . ',
                "color" : "' . $request->color . '",
                "additional_info" : "' . $request->additional_info . '",
                "reg_number": "' . $request->reg_number . '",
                "vin": "TMBJF25LXC6080000",
                "chassis_number": "' . $request->chassis_number . '",
                "frame_number" : "",
                "payload_weight": 32000,
                "payload_height": 1.2,
                "payload_length": 1.0,
                "payload_width": 1.0,
                "passengers": ' . $request->passengers . ',
                "gross_weight" : null,
                "fuel_type": "' . $request->fuel_type . '",
                "fuel_grade": "' . $request->fuel_grade . '",
                "norm_avg_fuel_consumption": 9.0,
                "fuel_tank_volume": ' . $request->fuel_tank_volume . ',
                "fuel_cost" : 100.3,
                "wheel_arrangement": "4x2",
                "tyre_size": "255/65 R16",
                "tyres_number": 4,
                "liability_insurance_policy_number": "' . $request->liability_insurance_policy_number . '",
                "liability_insurance_valid_till": "' . $request->liability_insurance_valid_till . '",
                "free_insurance_policy_number": "",
                "free_insurance_valid_till": null,
                "icon_id" : 55,
                "avatar_file_name": null
            }';
            $realArray = array(
                'hash' => $hash,
                'vehicle' => $newVehicleData,
            );
            $requestUrl = 'vehicle/create';
            $userData = $userService->postAPI($requestUrl, $realArray);
            if ($userData['success'] === false) {
                return back()->with(['apiErrorData' => $userData, 'status' => 'danger', 'message' => $userData['errors'][0]['error']]);
            } else {
                return redirect('/user/assets-management')->with(['status' => 'success', 'message' => 'New Vehicle Successfully created!']);
            }
        } catch (\Exception $e) {
            //return back()->with(['status' => 'danger', 'message' => $e->getMessage()]);
            return back()->with(['status' => 'danger', 'message' => 'Some thing went wrong! Please try again later.']);
        }
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request, UserService $userService)
    {
        $sessiondata = $request->session()->all();
        $requestUrl = "tracker/list?hash=" . $sessiondata['hash'];
        $data['trackerData'] = $userService->callAPI($requestUrl);
        $requestUrl = "vehicle/read/?vehicle_id=" . $id . "&hash=" . $sessiondata['hash'];
        $userData = $userService->callAPI($requestUrl);
        $data['userData'] = $userData;
        $data['vehicleData'] = VehicleModel::get();
        $data['fuelData'] = FuelModel::get();
        return view('users.vehicleManagement.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, UserService $userService)
    {
        $validator = Validator::make($request->all(), [
            'label' => 'required|max:255|min:2',
            'model' => 'required',
            'fuel_type' => 'required',
            'type' => 'required',
            'manufacture_year' => 'required',
            'max_speed' => 'required|numeric',
            'fuel_tank_volume' => 'required|numeric',
            'reg_number' => 'required',
            'liability_insurance_policy_number' => 'required',
            'liability_insurance_valid_till' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            if ($request->tracker_id === 'nullTracker') {$tracker_id = 'null';} else { $tracker_id = $request->tracker_id;}
            $sessiondata = $request->session()->all();
            $requestUrl = "vehicle/read/?vehicle_id=" . $id . "&hash=" . $sessiondata['hash'];
            $userData = $userService->callAPI($requestUrl);
            $newVehicleData = '{
                "id": ' . $id . ',
                "tracker_id":' . $tracker_id . ',
                "label": "' . $request->label . '",
                "max_speed": ' . $request->max_speed . ',
                "model": "' . $request->model . '",
                "type": "' . $request->type . '",
                "subtype": null,
                "garage_id": null,
                "trailer" : "' . $request->trailer . '",
                "manufacture_year" : ' . $request->manufacture_year . ',
                "color" : "' . $request->color . '",
                "additional_info" : "' . $request->additional_info . '",
                "reg_number": "' . $request->reg_number . '",
                "vin": "TMBJF25LXC6080000",
                "chassis_number": "' . $request->chassis_number . '",
                "frame_number" : "",
                "payload_weight": 32000,
                "payload_height": 1.2,
                "payload_length": 1.0,
                "payload_width": 1.0,
                "passengers": ' . $request->passengers . ',
                "gross_weight" : null,
                "fuel_type": "' . $request->fuel_type . '",
                "fuel_grade":  "' . $request->fuel_grade . '",
                "norm_avg_fuel_consumption": 9.0,
                "fuel_tank_volume": ' . $request->fuel_tank_volume . ',
                "fuel_cost" : 100.3,
                "wheel_arrangement": "4x2",
                "tyre_size": "255/65 R16",
                "tyres_number": 4,
                "liability_insurance_policy_number": "' . $request->liability_insurance_policy_number . '",
                "liability_insurance_valid_till": "' . $request->liability_insurance_valid_till . '",
                "free_insurance_policy_number": "",
                "free_insurance_valid_till": null,
                "icon_id" : 55,
                "avatar_file_name": null
            }';
            //dd($newVehicleData);
            $realArray = array(
                'hash' => $sessiondata['hash'],
                'vehicle' => $newVehicleData,
            );
            $requestUrl = "vehicle/update";
            $userData = $userService->postAPI($requestUrl, $realArray);
            //dd($userData);
            if ($userData['success'] === false) {
                return back()->with(['status' => 'danger', 'message' => $userData['status']['description'] . " " . $userData['errors'][0]['error']]);
            } else {
                return redirect('/user/assets-management')->with(['status' => 'success', 'message' => 'Vehicle update Successfully!']);
            }

        } catch (\Exception $e) {
            //return back()->with(['status' => 'danger', 'message' => $e->getMessage()]);
            return back()->with(['status' => 'danger', 'message' => 'Some thing went wrong! Please try again later.']);
        }
    }
    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request, UserService $userService)
    {
        $sessiondata = $request->session()->all();
        $requestUrl = "vehicle/delete/?vehicle_id=" . $id . "&hash=" . $sessiondata['hash'];
        $data['userData'] = $userService->callAPI($requestUrl);
        return redirect('/user/assets-management')->with(['status' => 'success', 'message' => 'Vehicle delete successfully!']);
    }
}
