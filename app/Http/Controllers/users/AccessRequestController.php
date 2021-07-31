<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\CompanyRequestPermissionModel;
use App\Models\PermissionPolicyHolderModel;
use App\Models\UserDetailsAccessModel;
use App\Notifications\Users\UsersReaction;
use App\Services\UserService;
use App\User;
use Auth;
use Crypt;
use DB;
use Illuminate\Http\Request;
use Redirect;
use Yajra\Datatables\Datatables;

class AccessRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth', 'users']);
    }
    public function index(Request $request, UserService $userService)
    {
        $data = array();
        $data['permissionPolicy'] = PermissionPolicyHolderModel::get();
        $login = 'user/auth?login=' . Auth::user()->ontrac_username . '&password=' . Crypt::decrypt(Auth::user()->ontrac_password);
        $userData = $userService->callAPI($login);
        if ($userData['success'] == 'true') {
            if (isset($userData['hash'])) {
                $hash = $userData['hash'];
            } else {
                $hash = '';
            }
            $request->session()->put('hash', $hash);
            $sessiondata = $request->session()->all();
            $trackerListUrl = "tracker/list?hash=" . $sessiondata['hash'];
            $data['trackerData'] = $userService->callAPI($trackerListUrl);
            $data['trackerData'] = $data['trackerData']['list'];
            //$data['permission'] = $result;
        } else {
            $data['trackerData'] = array();
            //$data['permission'] = $result;
        }
        return view('users.companyAccessRequest.index', $data);
    }
    public function requestData()
    {
        $result = DB::table('users_details_access')
            ->select('users.name', 'assets.reg_number', 'users_details_access.*')
            ->join('users', 'users_details_access.company_id', '=', 'users.id')
            ->join('assets', 'assets.assets_id', '=', 'users_details_access.assets_id')
            ->where('users_details_access.user_id', Auth::user()->id)
            ->get();
        return Datatables::of($result)
            ->addColumn('action', function ($result) {
                if ($result->accept_status == 0) {
                    return '<button type="button" class="btn btn-primary request_access" data-id=' . $result->id . ' data-toggle="modal"  data-target="#permissionModal"> Grant Access</button>';
                } else if ($result->accept_status == 1) {
                    return '<a href ="' . url('user/access-request-management') . '/' . Crypt::encrypt($result->id) . '/withdraw"  class="btn btn-xs btn-success"><i class="fa fa-handshake-o" aria-hidden="true"></i>Withdraw</a>
                    <a href ="' . url('user/access-request-management') . '/' . Crypt::encrypt($result->id) . '/reject"  class="btn btn-xs btn-danger"><i class="fa fa-ban" aria-hidden="true"></i>Reject</a>';
                } else if ($result->accept_status == 2) {
                    return '<button type="button" class="btn btn-primary request_access" data-id=' . $result->id . ' data-toggle="modal"  data-target="#permissionModal"> Grant Access</button>';
                } else {
                    return '<button type="button" class="btn btn-primary request_access" data-id=' . $result->id . ' data-toggle="modal"  data-target="#permissionModal"> Grant Access</button>
                    <a href ="' . url('user/access-request-management') . '/' . Crypt::encrypt($result->id) . '/reject"  class="btn btn-xs btn-danger"><i class="fa fa-ban" aria-hidden="true"></i>Reject</a>';
                }
            })->make(true);
    }
    public function getRequestedData($id)
    {
        $result = DB::table('users_details_access')
            ->select('users_details_access.*', 'company_request_permission.id as req_id', 'company_request_permission.accept_status', 'permission_policy_holder.*')
            ->join('company_request_permission', 'users_details_access.id', '=', 'company_request_permission.users_detail_id')
            ->join('permission_policy_holder', 'permission_policy_holder.id', '=', 'company_request_permission.permission_policy_id')
            ->where('users_details_access.id', $id)
            ->get();
        $content = view('renders.permissionRender')->with(['result' => $result])->render();
        return response()->json(['content' => $content]);
    }
    public function getRequestedTrackerData($id, $tr_d)
    {
        $result = DB::table('users_details_access')
            ->select('users_details_access.*', 'company_request_permission.id as req_id', 'company_request_permission.accept_status', 'permission_policy_holder.*')
            ->join('company_request_permission', 'users_details_access.id', '=', 'company_request_permission.users_detail_id')
            ->join('permission_policy_holder', 'permission_policy_holder.id', '=', 'company_request_permission.permission_policy_id')
            ->where('users_details_access.id', $id)
            ->get();
        $content = view('renders.multplePermissionRender')->with(['result' => $result, 'tr_id' => $tr_d])->render();
        return response()->json(['content' => $content]);
    }
    public function grantAccessToCompany($id, Request $request, UserService $userService)
    {
        $data = array();
        // $result = DB::table('users_details_access')
        //     ->select('users_details_access.*', 'company_request_permission.id as req_id', 'company_request_permission.accept_status', 'permission_policy_holder.*')
        //     ->join('company_request_permission', 'users_details_access.id', '=', 'company_request_permission.users_detail_id')
        //     ->join('permission_policy_holder', 'permission_policy_holder.id', '=', 'company_request_permission.permission_policy_id')
        //     ->where('users_details_access.id', $id)
        //     ->get();
        $login = 'user/auth?login=' . Auth::user()->ontrac_username . '&password=' . Crypt::decrypt(Auth::user()->ontrac_password);
        $userData = $userService->callAPI($login);
        if ($userData['success'] == 'true') {
            if (isset($userData['hash'])) {
                $hash = $userData['hash'];
            } else {
                $hash = '';
            }
            $request->session()->put('hash', $hash);
            $sessiondata = $request->session()->all();
            $trackerListUrl = "tracker/list?hash=" . $sessiondata['hash'];
            $data['trackerData'] = $userService->callAPI($trackerListUrl);
            $data['trackerData'] = $data['trackerData']['list'];
        } else {
            $data['trackerData'] = array();
        }
        $data['permissionData'] = $result;
        return view('users.companyAccessRequest.grantAccess', $data);
    }
    public function acceptRequest(Request $request)
    {
        try {
            $detailsAccess = UserDetailsAccessModel::where('id', $request->requestUserId)->first();
            $companyData = User::where('id', $detailsAccess->company_id)->first();
            $authUserData = Auth::user();
            if ($request->permission) {
                foreach ($request->permission as $tracker) {
                    DB::table('company_request_permission')
                        ->where('users_detail_id', $request->requestUserId)
                        ->update(array('accept_status' => '1', 'updated_at' => date('Y-m-d H:i:s')));
                }
                DB::table('users_details_access')
                    ->where('id', $request->requestUserId)
                    ->update(array('accept_status' => '1'));
                $permissionData = CompanyRequestPermissionModel::whereIn('id', $request->permission)->get()->toArray();
                foreach ($permissionData as $key => $value) {
                    $perMissionId[] = $value['permission_policy_id'];
                }
                $permissionPolicyData = PermissionPolicyHolderModel::whereIn('id', $perMissionId)->get()->toArray();
                foreach ($permissionPolicyData as $key => $value) {
                    $perString[] = $value['permissions_name'];
                }
                $strPrer = implode(',', $perString);
                $companyData = User::where('id', $detailsAccess->company_id)->first();
                if ($companyData) {
                    $notificationData = array(
                        "subject" => "User give access permission",
                        "username" => "User give access permission",
                        "message" => ucfirst(Auth::user()->name) . " has given you access to " . strtoupper($strPrer) . " permissions for Vehicle " . Auth::user()->driver_license_id,
                        "useremail" => Auth::user()->name,
                        "companyName" => Auth::user()->name,
                        "permission" => $strPrer,
                    );
                    $companyData->notify(new UsersReaction($notificationData));
                }
                return redirect('/user/access-request-management')->with(['status' => 'success', 'message' => 'Permission Successfully created!']);
            }
            if ($request->tracker_id) {
                DB::table('company_request_permission')
                    ->where('users_detail_id', $request->requestUserId)
                    ->update(array('accept_status' => '2'));
                foreach ($request->tracker_id as $key => $permissionId) {
                    DB::table('company_request_permission')
                        ->where('id', $permissionId)
                        ->update(array('accept_status' => '1'));
                }
                if ($request->tracker_id) {
                    DB::table('users_details_access')
                        ->where('id', $request->requestUserId)
                        ->update(array('accept_status' => '1'));
                    $companyData = User::where('id', $detailsAccess->company_id)->first();
                    if ($companyData) {
                        $notificationData = array(
                            "subject" => "User give access permission",
                            "username" => "User give access permission",
                            "message" => ucfirst(Auth::user()->name) . " has given you access to " . strtoupper($strPrer) . " permissions for Vehicle " . Auth::user()->driver_license_id,
                            "useremail" => Auth::user()->name,
                            "companyName" => Auth::user()->name,
                            "permission" => $strPrer,
                        );
                        $companyData->notify(new UsersReaction($notificationData));
                    }
                } else {
                    DB::table('users_details_access')
                        ->where('id', $request->requestUserId)
                        ->update(array('accept_status' => '0'));
                    $companyData = User::where('id', $detailsAccess->company_id)->first();
                    $notificationData = array(
                        "subject" => "User remove access permission",
                        "username" => "User remove access permission",
                        "message" => ucfirst(Auth::user()->name) . " has given you access to " . strtoupper($strPrer) . " permissions for Vehicle " . Auth::user()->driver_license_id,
                        "useremail" => Auth::user()->name,
                        "companyName" => Auth::user()->name,
                        "permission" => "User remove access permission",
                    );
                    $companyData->notify(new UsersReaction($notificationData));
                }
            } else {
                DB::table('users_details_access')
                    ->where('id', $request->requestUserId)
                    ->update(array('accept_status' => '0'));
                DB::table('company_request_permission')
                    ->where('users_detail_id', $request->requestUserId)
                    ->update(array('accept_status' => '0'));
                $notificationData = array(
                    "subject" => "User remove access permission",
                    "username" => "User remove access permission",
                    "message" => ucfirst(Auth::user()->name) . " has removed access permission for Vehicle" . Auth::user()->driver_license_id,
                    "useremail" => Auth::user()->name,
                    "companyName" => Auth::user()->name,
                    "permission" => "removePermission",
                );
                $companyData->notify(new UsersReaction($notificationData));
                return redirect('/user/access-request-management')->with(['status' => 'success', 'message' => 'Permission Successfully created!']);
            }
            return redirect('/user/access-request-management')->with(['status' => 'success', 'message' => 'Permission Successfully created!']);
        } catch (\Exception $e) {
            //return back()->with(['status' => 'danger', 'message' => $e->getMessage()]);
            return back()->with(['status' => 'danger', 'message' => 'Some thing went wrong! Please try again later.']);
        }
    }
    /**
     * Reject request .
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function requestReject($id)
    {
        try {
            $accessDetails = UserDetailsAccessModel::where('id', \Crypt::decrypt($id))->first();
            if ($accessDetails) {
                $updateData = array("accept_status" => '2', "updated_at" => date('Y-m-d H:i:s'));
                $accessDetails->update($updateData);
                $permissionData = array("accept_status" => '2', "updated_at" => date('Y-m-d H:i:s'));
                DB::table('company_request_permission')
                    ->where('users_detail_id', \Crypt::decrypt($id))
                    ->update($permissionData);
                $user = User::where('id', Auth::user()->id)->first();
                $userData = User::where('id', $accessDetails->company_id)->first();
                if ($user) {
                    $notificationData = array(
                        'username' => $user->name,
                        'message' => ucfirst($user->name) . ' reject your request.',
                        'useremail' => $user->email,
                        'userPassword' => '',
                        "permission" => "removePermission",
                    );
                    $userData->notify(new UsersReaction($notificationData));
                }
                return redirect('/user/access-request-management')->with(array('status' => 'success', 'message' => 'Request reject Successfully!'));
            }
        } catch (\Exception $e) {
            return back()->with(array('status' => 'danger', 'message' => $e->getMessage()));
        }
    }
    /**
     * Withdraw request .
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function requestWithdraw($id)
    {
        try {
            $accessDetails = UserDetailsAccessModel::where('id', \Crypt::decrypt($id))->first();
            if ($accessDetails) {
                $updateData = array("accept_status" => '2', "updated_at" => date('Y-m-d H:i:s'));
                $accessDetails->update($updateData);
                $permissionData = array("accept_status" => '2', "updated_at" => date('Y-m-d H:i:s'));
                DB::table('company_request_permission')
                    ->where('users_detail_id', \Crypt::decrypt($id))
                    ->update($permissionData);
                $user = User::where('id', Auth::user()->id)->first();
                $userData = User::where('id', $accessDetails->company_id)->first();
                if ($user) {
                    $notificationData = array(
                        'username' => $user->name,
                        'message' => ucfirst($user->name) . " withdrow all permissions for Vehicle " . Auth::user()->driver_license_id,
                        'useremail' => $user->email,
                        'userPassword' => '',
                        "permission" => "removePermission",
                    );
                    $userData->notify(new UsersReaction($notificationData));
                }
                return redirect('/user/access-request-management')->with(array('status' => 'success', 'message' => 'Request Withdraw Successfully!'));
            }
        } catch (\Exception $e) {
            return back()->with(array('status' => 'danger', 'message' => $e->getMessage()));
        }
    }
}
