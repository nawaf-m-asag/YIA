<?php

namespace App\Http\Controllers;

use App\Branches;
use Illuminate\Http\Request;

class BrancheController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $all_branches = Branches::all();
        return view('backend.pages.branches')->with(['all_branches' => $all_branches]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|string',
            'price' => 'required|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string|max:191',
        ]);

        Branches::create([
            'name' => $request->name,
            'price' => $request->price,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);


        return redirect()->back()->with(['msg' => __('New Faq Added...'),'type' => 'success']);
    }

    public function update(Request $request){

        $this->validate($request,[
            'name' => 'required|string',
            'price' => 'required|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string|max:191',
        ]);

        Branches::find($request->id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->back()->with(['msg' => __('Faq Updated...'),'type' => 'success']);
    }

    public function delete($id){
        Branches::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Delete Success...'),'type' => 'danger']);
    }


    public function bulk_action(Request $request){
        $all = Branches::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }

}
