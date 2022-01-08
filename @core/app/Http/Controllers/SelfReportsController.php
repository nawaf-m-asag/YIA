<?php

namespace App\Http\Controllers;

use App\SelfReports;
use Illuminate\Http\Request;

class SelfReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $all_self_reports = SelfReports::all();
        return view('backend.pages.self_reports')->with(['all_self_reports' => $all_self_reports]);
    }

    public function reports_status_update(Request $request)
    {

        $this->validate($request, [
            'id'=>'required',
            'status' => 'required',
        ]);
        SelfReports::find($request->id)->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with(['msg' => __('User Status Update Success..'), 'type' => 'success']);
    }
    public function bulk_action(Request $request){
        SelfReports::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
