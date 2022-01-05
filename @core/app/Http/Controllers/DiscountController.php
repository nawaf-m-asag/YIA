<?php

namespace App\Http\Controllers;

use App\Discounts;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $all_discount = Discounts::all();
        return view('backend.pages.discounts')->with(['all_discount' => $all_discount]);
    }

    public function store(Request $request){

        $this->validate($request,[
            'title' => 'required|string|max:191',
            'image' => 'nullable|string|max:191',
            'url' => 'nullable|string|max:191',
        ]);

        Discounts::create($request->all());

        return redirect()->back()->with(['msg' => __('New Discount Added...'),'type' => 'success']);
    }

    public function update(Request $request){

        $this->validate($request,[
            'title' => 'required|string|max:191',
            'image' => 'nullable|string|max:191',
            'url' => 'nullable|string|max:191',
        ]);

        Discounts::find($request->id)->update([
            'title' => $request->title,
            'image' => $request->image,
            'url' => $request->url,
        ]);

        return redirect()->back()->with(['msg' => __('Discounts Updated...'),'type' => 'success']);
    }

    public function delete($id){

        Discounts::find($id)->delete();
        return redirect()->back()->with(['msg' =>__( 'Delete Success...'),'type' => 'danger']);
    }

    public function bulk_action(Request $request){
        Discounts::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
