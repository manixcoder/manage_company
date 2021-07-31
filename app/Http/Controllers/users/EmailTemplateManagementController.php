<?php
namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplates;
use Crypt;
use Illuminate\Http\Request;
use Redirect;
use Validator;
use Yajra\Datatables\Datatables;

class EmailTemplateManagementController extends Controller
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

        return view('admin.emails.index', $data);
    }

    /**
     * Display a listing of the resource using Datatables.
     * */

    public function templateData()
    {
        $result = EmailTemplates::get();
        return Datatables::of($result)
        ->addColumn('action', function ($result) {
            return '<a href ="' . env('APP_URL') . 'admin/email-management/' . Crypt::encrypt($result->id) . '/edit"  class="btn btn-xs btn-primary edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
            | <a href ="' . env('APP_URL') . 'admin/email-management/' . Crypt::encrypt($result->id) . '/view"  class="btn btn-xs btn-warning view"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
            | <a data-id =' . Crypt::encrypt($result->id) . ' class="btn btn-xs btn-danger delete" style="color:#fff"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>';
        })->make(true);
    }
    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        return view('admin.emails.create', $data);
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
            'subject' => 'required|min:2',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $templateData = EmailTemplates::create([
                'name' => $request->name,
                'subject' => $request->subject,
                'content' => $request->content,
                "status" => $request->has('status') ? '1' : '0',
            ]);
            return redirect('/admin/email-management')->with(['status' => 'success', 'message' => 'New Template successfully created!']);
        } catch (\Exception $e) {
            // return back()->with(['status' => 'danger', 'message' => $e->getMessage()]);
            return back()->with(['status' => 'danger', 'message' => 'Some thing went wrong! Please try again later.']);
        }
    }
    /**
     * Display the specified resource.
     * @param  \App\Models\EmailTemplates  $emailTemplates
     * @return \Illuminate\Http\Response
     */
    public function show(EmailTemplates $emailTemplates, $id)
    {
        try {
            $pageData = EmailTemplates::find(Crypt::decrypt($id));
            if ($pageData) {
                $data['pageData'] = $pageData;
                return view('admin.emails.view', $data);
            } else {
                return back()->with(['status' => 'danger', 'message' => 'Requested page not found!']);
            }
        } catch (\Exception $e) {
            return back()->with(['status' => 'danger', 'message' => 'Some thing went wrong! Please try again later.']);
            return back()->with(['status' => 'danger', 'message' => $e->getMessage()]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\EmailTemplates  $emailTemplates
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailTemplates $emailTemplates, $id)
    {
        try {
            $pageData = EmailTemplates::find(Crypt::decrypt($id));
            if ($pageData) {
                $data['pageData'] = $pageData;
                return view('admin.emails.edit', $data);
            } else {
                return back()->with(['status' => 'danger', 'message' => 'Requested page not found!']);
            }
        } catch (\Exception $e) {
            // return back()->with(['status' => 'danger', 'message' => 'Some thing went wrong! Please try again later.']);
            return back()->with(['status' => 'danger', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmailTemplates  $emailTemplates
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmailTemplates $emailTemplates, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
            'subject' => 'required|min:2',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $pageData = EmailTemplates::find(\Crypt::decrypt($id));
            $updateData = array(
                "name" => $request->has('name') ? $request->name : "",
                "subject" => $request->has('subject') ? $request->name : "",
                "content" => $request->has('content') ? $request->content : "",
                "status" => $request->has('status') ? 'Active' : 'Disable',
            );
            $pageData->update($updateData);
            return redirect('/admin/email-management')->with(['status' => 'success', 'message' => 'Update record successfully.']);
        } catch (\exception $e) {
            return back()->with(['status' => 'danger', 'message' => $e->getMessage()]);
            //return back()->with(['status' => 'danger', 'message' => 'Some thing went wrong! Please try again later.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\EmailTemplates  $emailTemplates
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailTemplates $emailTemplates, $id)
    {
        EmailTemplates::find(Crypt::decrypt($id))->delete();
    }
}
