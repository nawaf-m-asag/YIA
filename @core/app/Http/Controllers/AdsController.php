<?php

namespace App\Http\Controllers;

use App\Actions\SlugChecker;
use App\Ads;
use App\AdsCategory;
use App\Events;
use App\Helpers\SanitizeInput;
use App\Http\Requests\SlugCheckRequest;
use App\Language;
use App\Page;
use App\Services;
use App\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;


class AdsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $all_ads = Ads::all()->groupBy('lang');
        return view('backend.pages.ads.index')->with([
            'all_ads' => $all_ads
        ]);
    }
    public function new_ads(){
        $all_category = AdsCategory::where('lang',get_default_language())->get();
        $all_language = Language::all();
        return view('backend.pages.ads.new')->with([
            'all_category' => $all_category,
            'all_languages' => $all_language,
        ]);
    }
    public function store_new_ads(Request $request){
        $this->validate($request,[
           'category' => 'required',
           'ads_content' => 'required',
           'tags' => 'required',
           'excerpt' => 'required',
           'title' => 'required',
           'lang' => 'required',
           'status' => 'required',
           'author' => 'required',
           'slug' => 'nullable',
           'meta_tags' => 'nullable|string',
           'meta_description' => 'nullable|string',
           'image' => 'nullable|string|max:191',
        ]);
        $slug = !empty($request->slug) ? $request->slug : Str::slug($request->title,$request->lang);

        Ads::create([
            'ads_categories_id' => $request->category,
            'slug' => $slug ,
            'content' => SanitizeInput::kses_basic($request->ads_content),
            'tags' => $request->tags,
            'title' => $request->title,
            'status' => $request->status,
            'meta_tags' => $request->meta_tags,
            'meta_description' => $request->meta_description,
            'excerpt' => $request->excerpt,
            'lang' => $request->lang,
            'image' => $request->image,
            'user_id' => Auth::user()->id,
            'author' => $request->author,
        ]);
        return redirect()->back()->with([
            'msg' => __('New Ads Post Added...'),
            'type' => 'success'
        ]);
    }
    public function clone_ads(Request $request)
    {
        $ads_details = Ads::find($request->item_id);
        Ads::create([
            'ads_categories_id' => $ads_details->ads_categories_id,
            'slug' => $ads_details->slug.'33',
            'content' => $ads_details->content,
            'tags' => $ads_details->tags,
            'title' => $ads_details->title,
            'status' => 'draft',
            'meta_tags' => $ads_details->meta_tags,
            'meta_description' => $ads_details->meta_description,
            'excerpt' => $ads_details->excerpt,
            'lang' => $ads_details->lang,
            'image' => $ads_details->image,
            'user_id' => null,
            'author' => $ads_details->author,
        ]);

        return redirect()->back()->with([
            'msg' => __('Ads Post cloned success...'),
            'type' => 'success'
        ]);
    }

    public function edit_ads($id){
        $ads_post = Ads::find($id);
        $all_category = AdsCategory::where('lang',$ads_post->lang)->get();
        $all_language = Language::all();
        return view('backend.pages.ads.edit')->with([
            'all_category' => $all_category,
            'ads_post' => $ads_post,
            'all_languages' => $all_language,
        ]);
    }
    public function update_ads(Request $request,$id){
        $this->validate($request,[
            'category' => 'required',
            'ads_content' => 'required',
            'tags' => 'required',
            'excerpt' => 'required',
            'title' => 'required',
            'lang' => 'required',
            'status' => 'required',
            'author' => 'required',
            'slug' => 'nullable',
            'meta_tags' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'image' => 'nullable|string|max:191',
        ]);
        $slug = !empty($request->slug) ? $request->slug : Str::slug($request->title,$request->lang);
        Ads::where('id',$id)->update([
            'ads_categories_id' => $request->category,
            'slug' => $slug,
            'content' => $request->ads_content,
            'tags' => $request->tags,
            'title' => $request->title,
            'status' => $request->status,
            'meta_tags' => $request->meta_tags,
            'meta_description' => $request->meta_description,
            'excerpt' => $request->excerpt,
            'lang' => $request->lang,
            'image' => $request->image,
            'user_id' => Auth::user()->id,
            'author' => $request->author,
        ]);

        return redirect()->back()->with([
            'msg' => __('Ads Post updated...'),
            'type' => 'success'
        ]);
    }
    public function delete_ads(Request $request,$id){
        Ads::find($id)->delete();

        return redirect()->back()->with([
            'msg' => __('Ads Post Delete Success...'),
            'type' => 'danger'
        ]);
    }

    public function category(){
        $all_category = AdsCategory::all()->groupBy('lang');
        $all_language = Language::all();
        return view('backend.pages.ads.category')->with([
            'all_category' => $all_category,
            'all_languages' => $all_language
        ]);
    }
    public function new_category(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191|unique:ads_categories',
            'lang' => 'required|string|max:191',
            'status' => 'required|string|max:191'
        ]);

        AdsCategory::create($request->all());

        return redirect()->back()->with([
            'msg' => __('New Category Added...'),
            'type' => 'success'
        ]);
    }

    public function update_category(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'status' => 'required|string|max:191'
        ]);

        AdsCategory::find($request->id)->update([
            'name' => $request->name,
            'status' => $request->status,
            'lang' => $request->lang,
        ]);

        return redirect()->back()->with([
            'msg' => __('Category Update Success...'),
            'type' => 'success'
        ]);
    }

    public function delete_category(Request $request,$id){
        if (Ads::where('ads_categories_id',$id)->first()){
            return redirect()->back()->with([
                'msg' => __('You Can Not Delete This Category, It Already Associated With A Post...'),
                'type' => 'danger'
            ]);
        }
        AdsCategory::find($id)->delete();
        return redirect()->back()->with([
            'msg' => __('Category Delete Success...'),
            'type' => 'danger'
        ]);
    }

    public function Language_by_slug(Request $request){
        $all_category = AdsCategory::where('lang',$request->lang)->get();

        return response()->json($all_category);
    }

    public function ads_page_settings(){
        $all_languages = Language::all();
        return view('backend.pages.ads.page-settings.ads')->with(['all_languages' => $all_languages]);
    }
    public function ads_single_page_settings(){
        $all_languages = Language::all();
        return view('backend.pages.ads.page-settings.ads-single')->with(['all_languages' => $all_languages]);
    }

    public function update_ads_single_page_settings(Request $request){
        $this->validate($request,[
            'ads_single_page_recent_post_item' => 'nullable|string|max:191'
        ]);
        $all_languages = Language::all();

        foreach ($all_languages as $lang){
            $this->validate($request, [
                'ads_single_page_'.$lang->slug.'_related_post_title' => 'nullable|string',
                'ads_single_page_'.$lang->slug.'_share_title' => 'nullable|string',
                'ads_single_page_'.$lang->slug.'_category_title' => 'nullable|string',
                'ads_single_page_'.$lang->slug.'_recent_post_title' => 'nullable|string',
                'ads_single_page_'.$lang->slug.'_tags_title' => 'nullable|string'
            ]);

            $fields = [
                'ads_single_page_'.$lang->slug.'_related_post_title',
                'ads_single_page_'.$lang->slug.'_share_title',
                'ads_single_page_'.$lang->slug.'_category_title',
                'ads_single_page_'.$lang->slug.'_recent_post_title',
                'ads_single_page_'.$lang->slug.'_tags_title'
            ];

            foreach ($fields as $field){
                update_static_option($field, $request->$field);
            }
        }
        update_static_option('ads_single_page_recent_post_item',$request->ads_single_page_recent_post_item);

        return redirect()->back()->with([
            'msg' => __('Settings Update Success...'),
            'type' => 'success'
        ]);
    }

    public function update_ads_page_settings(Request $request){

        $this->validate($request,[
           'ads_page_recent_post_widget_items' => 'nullable|string|max:191',
           'ads_page_item' => 'nullable|string|max:191'
        ]);

        $all_languages = Language::all();
        foreach ($all_languages as $lang){
            $this->validate($request, [
                'ads_page_'.$lang->slug.'_read_more_btn_text' => 'nullable|string',
            ]);
            $read_more_btn_text = 'ads_page_'.$lang->slug.'_read_more_btn_text';
            update_static_option($read_more_btn_text, $request->$read_more_btn_text);
        }

        update_static_option('ads_page_item',$request->ads_page_item);
        update_static_option('ads_page_recent_post_widget_items',$request->ads_page_recent_post_widget_items);

        return redirect()->back()->with([
            'msg' => __('Settings Update Success...'),
            'type' => 'success'
        ]);
    }

    public function bulk_action(Request $request){
        Ads::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function category_bulk_action(Request $request){
        AdsCategory::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }


    public function slug_check(SlugCheckRequest $request){
        $user_given_slug = $request->slug;
        $query = Events::Blog(['slug' => $user_given_slug]);

        return SlugChecker::Check($request,$query);
    }
}
