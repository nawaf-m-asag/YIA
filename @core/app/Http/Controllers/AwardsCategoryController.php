<?php

namespace App\Http\Controllers;

use App\Awards;
use App\AwardsCategory;
use App\Language;
use Illuminate\Http\Request;

class AwardsCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function all_awards_category(){

        $all_category = AwardsCategory::all()->groupBy('lang');
        $all_languages = Language::all();
        return view('backend.awards.all-awards-category')->with(['all_category' => $all_category,'all_languages' => $all_languages] );
    }

    public function store_awards_category(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191|unique:awards_categories',
            'lang' => 'required|string|max:191',
            'status' => 'required|string|max:191'
        ]);

        AwardsCategory::create($request->all());

        return redirect()->back()->with([
            'msg' => __('New Category Added...'),
            'type' => 'success'
        ]);
    }

    public function update_awards_category(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'status' => 'required|string|max:191'
        ]);

        AwardsCategory::find($request->id)->update([
            'title' => $request->title,
            'status' => $request->status,
            'lang' => $request->lang,
        ]);

        return redirect()->back()->with([
            'msg' => __('Category Update Success...'),
            'type' => 'success'
        ]);
    }

    public function delete_awards_category(Request $request,$id){
        if (Awards::where('category_id',$id)->first()){
            return redirect()->back()->with([
                'msg' => __('You Can Not Delete This Category, It Already Associated With A Post...'),
                'type' => 'danger'
            ]);
        }
        AwardsCategory::find($id)->delete();
        return redirect()->back()->with([
            'msg' => __('Category Delete Success...'),
            'type' => 'danger'
        ]);
    }

    public function Language_by_slug(Request $request){
        $all_category = AwardsCategory::where('lang',$request->lang)->get();

        return response()->json($all_category);
    }

    public function bulk_action(Request $request){
        $all = AwardsCategory::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }

}
