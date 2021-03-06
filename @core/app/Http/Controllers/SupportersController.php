<?php

namespace App\Http\Controllers;

use App\Supporters;
use Illuminate\Http\Request;

class SupportersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $all_supporters = Supporters::all();
        return view('backend.pages.supporters')->with(['all_supporters' => $all_supporters]);
    }

    public function store(Request $request){

        $this->validate($request,[
            'title' => 'required|string|max:191',
            'image' => 'nullable|string|max:191',
            'url' => 'nullable|string|max:191',
        ]);

        Supporters::create($request->all());

        return redirect()->back()->with(['msg' => __('New Supporter Added...'),'type' => 'success']);
    }

    public function update(Request $request){

        $this->validate($request,[
            'title' => 'required|string|max:191',
            'image' => 'nullable|string|max:191',
            'url' => 'nullable|string|max:191',
        ]);

        Supporters::find($request->id)->update([
            'title' => $request->title,
            'image' => $request->image,
            'url' => $request->url,
        ]);

        return redirect()->back()->with(['msg' => __('Supporters Updated...'),'type' => 'success']);
    }

    public function delete($id){

        Supporters::find($id)->delete();
        return redirect()->back()->with(['msg' =>__( 'Delete Success...'),'type' => 'danger']);
    }

    public function bulk_action(Request $request){
        Supporters::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
