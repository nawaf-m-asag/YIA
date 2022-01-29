<?php

namespace App\Http\Controllers;

use App\Helpers\NexelitHelpers;
use App\GrantApplicant;
use App\Grants;
use App\GrantsCategory;
use App\Language;
use App\Mail\BasicMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class GrantsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function all_grants(){
        $all_grants = Grants::all()->groupBy('lang');
        return view('backend.grants.all-grants')->with(['all_grants' => $all_grants]);
    }

    public function edit_grant($id){

        $grant_post  = Grants::find($id);
        $all_category  = GrantsCategory::where(['status' => 'publish','lang' => $grant_post->lang])->get();
        $all_language = Language::all();

        return view('backend.grants.edit-grant')->with([
            'all_languages' => $all_language,
            'all_category' => $all_category,
            'grant_post' => $grant_post
        ]);
    }

    public function new_grant(){
        $all_category  = GrantsCategory::where(['status' => 'publish','lang' => get_default_language()])->get();
        $all_language = Language::all();
        return view('backend.grants.new-grant')->with(['all_languages' => $all_language,'all_category' => $all_category]);
    }

    public function store_grant(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'position' => 'required|string|max:191',
            'company_name' => 'required|string|max:191',
            'category_id' => 'required|string|max:191',
            'vacancy' => 'required|string|max:191',
            'grant_responsibility' => 'required|string',
            'employment_status' => 'required|string',
            'education_requirement' => 'nullable|string',
            'grant_context' => 'nullable|string',
            'experience_requirement' => 'nullable|string',
            'additional_requirement' => 'nullable|string',
            'grant_location' => 'required|string',
            'salary' => 'required|string',
            'lang' => 'required|string|max:191',
            'other_benefits' => 'nullable|string',
            'email' => 'nullable|string|max:191',
            'status' => 'nullable|string|max:191',
            'deadline' => 'required|string|max:191',
            'meta_tags' => 'nullable|string|max:191',
            'meta_description' => 'nullable|string|max:191',
            'slug' => 'nullable|string|max:191',
            'image' => 'nullable|string|max:191',
        ]);
        $slug = !empty($request->slug) ? $request->slug : Str::slug($request->title,$request->lang);

        Grants::create([
            'title' => $request->title,
            'position' => $request->position,
            'company_name' => $request->company_name,
            'category_id' => $request->category_id,
            'vacancy' => $request->vacancy,
            'grant_responsibility' => $request->grant_responsibility,
            'employment_status' => $request->employment_status,
            'education_requirement' => $request->education_requirement,
            'grant_context' => $request->grant_context,
            'experience_requirement' => $request->experience_requirement,
            'additional_requirement' => $request->additional_requirement,
            'grant_location' => $request->grant_location,
            'salary' => $request->salary,
            'lang' => $request->lang,
            'other_benefits' => $request->other_benefits,
            'email' => $request->email,
            'status' => $request->status,
            'deadline' => $request->deadline,
            'meta_tags' => $request->meta_tags,
            'meta_description' => $request->meta_description,
            'application_fee' => $request->application_fee,
            'application_fee_status' => $request->application_fee_status,
            'slug' => $slug,
            'image' => $request->image,
        ]);

        return redirect()->back()->with(['msg' => __('New grants Post Added'),'type' => 'success']);
    }

    public function update_grant(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'position' => 'required|string|max:191',
            'company_name' => 'required|string|max:191',
            'category_id' => 'required|string|max:191',
            'vacancy' => 'required|string|max:191',
            'grant_responsibility' => 'required|string',
            'employment_status' => 'required|string',
            'education_requirement' => 'nullable|string',
            'experience_requirement' => 'nullable|string',
            'additional_requirement' => 'nullable|string',
            'grant_context' => 'nullable|string',
            'grant_location' => 'required|string',
            'salary' => 'required|string',
            'lang' => 'required|string|max:191',
            'other_benefits' => 'nullable|string',
            'email' => 'nullable|string|max:191',
            'status' => 'nullable|string|max:191',
            'deadline' => 'required|string|max:191',
            'meta_tags' => 'nullable|string|max:191',
            'meta_description' => 'nullable|string|max:191',
            'slug' => 'nullable|string|max:191',
            'image' => 'nullable|string|max:191',
        ]);
        $slug = !empty($request->slug) ? $request->slug : Str::slug($request->title,$request->lang);

        Grants::find($request->grant_id)->update([
            'title' => $request->title,
            'position' => $request->position,
            'company_name' => $request->company_name,
            'category_id' => $request->category_id,
            'vacancy' => $request->vacancy,
            'grant_responsibility' => $request->grant_responsibility,
            'employment_status' => $request->employment_status,
            'education_requirement' => $request->education_requirement,
            'grant_context' => $request->grant_context,
            'experience_requirement' => $request->experience_requirement,
            'additional_requirement' => $request->additional_requirement,
            'grant_location' => $request->grant_location,
            'salary' => $request->salary,
            'lang' => $request->lang,
            'other_benefits' => $request->other_benefits,
            'email' => $request->email,
            'status' => $request->status,
            'deadline' => $request->deadline,
            'meta_tags' => $request->meta_tags,
            'meta_description' => $request->meta_description,
            'slug' => $slug,
            'application_fee' => $request->application_fee,
            'application_fee_status' => $request->application_fee_status,
            'image' => $request->image,
        ]);

        return redirect()->back()->with(['msg' => __('grants Post Update Success...'),'type' => 'success']);
    }
    public function clone_grant(Request $request){
        $grant_post  = Grants::find($request->item_id);
        Grants::create([
            'title' => $grant_post->title,
            'position' => $grant_post->position,
            'company_name' => $grant_post->company_name,
            'category_id' => $grant_post->category_id,
            'vacancy' => $grant_post->vacancy,
            'grant_responsibility' => $grant_post->grant_responsibility,
            'employment_status' => $grant_post->employment_status,
            'education_requirement' => $grant_post->education_requirement,
            'grant_context' => $grant_post->grant_context,
            'experience_requirement' => $grant_post->experience_requirement,
            'additional_requirement' => $grant_post->additional_requirement,
            'grant_location' => $grant_post->grant_location,
            'salary' => $grant_post->salary,
            'lang' => $grant_post->lang,
            'other_benefits' => $grant_post->other_benefits,
            'email' => $grant_post->email,
            'status' => 'draft',
            'deadline' => $grant_post->deadline,
            'meta_tags' => $grant_post->meta_tags,
            'meta_description' => $grant_post->meta_description,
            'application_fee' => $grant_post->application_fee,
            'application_fee_status' => $grant_post->application_fee_status,
            'slug' => $grant_post->title.random_int(999,9999),
            'image' => $request->image,
        ]);
        return redirect()->back()->with(['msg' => __('grants Post Clone Success...'),'type' => 'success']);
    }
    public function delete_grant(Request $request,$id){
        Grants::find($id)->delete();

        return redirect()->back()->with(['msg' => __('grants Post Deleted Success'),'type' => 'danger']);
    }
    public function page_settings(){
        $all_languages = Language::all();
        return view('backend.grants.grant-page-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_page_settings(Request $request){
        $this->validate($request,[
           'site_grant_post_items' => 'required|string|max:191'
        ]);
        $all_languages = Language::all();
        foreach ($all_languages as $lang){
            $this->validate($request,[
               'site_grants_category_'.$lang->slug.'_title'  => 'nullable|string'
            ]);
            $site_grants_category_title = 'site_grants_category_'.$lang->slug.'_title';
            update_static_option('site_grants_category_'.$lang->slug.'_title',$request->$site_grants_category_title);
        }
        update_static_option('site_grant_post_items',$request->site_grant_post_items);
        return redirect()->back()->with(['msg' => __('grants Page Settings Success...'),'type' => 'success']);
    }

    public function single_page_settings(){
        $all_languages = Language::all();
        return view('backend.grants.grant-single-page-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_single_page_settings(Request $request){
        $this->validate($request,[
            'grant_single_page_apply_form' => 'nullable|string|max:191',
            'grant_single_page_applicant_mail' => 'required|string|max:191',
        ]);

        $all_languages = Language::all();
        foreach ($all_languages as $lang){
            $this->validate($request,[
                'grant_single_page_'.$lang->slug.'_grant_context_label'  => 'nullable|string',
                'grant_single_page_'.$lang->slug.'_grant_responsibility_label'  => 'nullable|string',
                'grant_single_page_'.$lang->slug.'_education_requirement_label'  => 'nullable|string',
                'grant_single_page_'.$lang->slug.'_experience_requirement_label'  => 'nullable|string',
                'grant_single_page_'.$lang->slug.'_additional_requirement_label'  => 'nullable|string',
                'grant_single_page_'.$lang->slug.'_others_benefits_label'  => 'nullable|string',
                'grant_single_page_'.$lang->slug.'_apply_button_text'  => 'nullable|string',
                'grant_single_page_'.$lang->slug.'_grant_info_text'  => 'nullable|string',
                'grant_single_page_'.$lang->slug.'_company_name_text'  => 'nullable|string',
                'grant_single_page_'.$lang->slug.'_grant_category_text'  => 'nullable|string',
                'grant_single_page_'.$lang->slug.'_grant_position_text'  => 'nullable|string',
                'grant_single_page_'.$lang->slug.'_grant_type_text'  => 'nullable|string',
                'grant_single_page_'.$lang->slug.'_salary_text'  => 'nullable|string',
                'grant_single_page_'.$lang->slug.'_grant_location_text'  => 'nullable|string',
                'grant_single_page_'.$lang->slug.'_grant_deadline_text'  => 'nullable|string',
                'grant_single_page_'.$lang->slug.'_grant_application_fee_text'  => 'nullable|string',
            ]);

            $all_fileds = [
                'grant_single_page_'.$lang->slug.'_grant_context_label',
                'grant_single_page_'.$lang->slug.'_grant_responsibility_label',
                'grant_single_page_'.$lang->slug.'_education_requirement_label',
                'grant_single_page_'.$lang->slug.'_experience_requirement_label',
                'grant_single_page_'.$lang->slug.'_additional_requirement_label',
                'grant_single_page_'.$lang->slug.'_others_benefits_label',
                'grant_single_page_'.$lang->slug.'_apply_button_text',
                'grant_single_page_'.$lang->slug.'_grant_info_text',
                'grant_single_page_'.$lang->slug.'_company_name_text',
                'grant_single_page_'.$lang->slug.'_grant_category_text',
                'grant_single_page_'.$lang->slug.'_grant_position_text',
                'grant_single_page_'.$lang->slug.'_grant_type_text',
                'grant_single_page_'.$lang->slug.'_salary_text',
                'grant_single_page_'.$lang->slug.'_grant_location_text',
                'grant_single_page_'.$lang->slug.'_grant_deadline_text',
                'grant_single_page_'.$lang->slug.'_grant_application_fee_text',
            ];
            foreach ($all_fileds as $field){
                update_static_option($field,$request->$field);
            }
        }

        update_static_option('grant_single_page_apply_form',$request->grant_single_page_apply_form);
        update_static_option('grant_single_page_applicant_mail',$request->grant_single_page_applicant_mail);

        return redirect()->back()->with(['msg' => __('grants Page Settings Success...'),'type' => 'success']);
    }

    public function all_grants_applicant(){
        $all_applicant = GrantApplicant::all();
        return view('backend.grants.all-applicant')->with(['all_applicant' => $all_applicant]);
    }

    public function delete_grant_applicant(Request $request,$id){
        $grant_details = GrantApplicant::find($id);
        $all_attachment = unserialize($grant_details->attachment);
        foreach($all_attachment as $name => $path){
            if(file_exists($path)){
                @unlink($path);
            }
        }
        GrantApplicant::find($id)->delete();
        return redirect()->back()->with(['msg' => __('grants Application Delete Success...'),'type' => 'danger']);
    }

    public function bulk_action(Request $request){
        Grants::whereIn('id',$request->ids)->delete();

        return response()->json(['status' => 'ok']);
    }
    public function grant_applicant_bulk_delete(Request $request){
        GrantApplicant::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function grant_applicant_report(Request  $request){
        $order_data = '';
        $grants  = Grants::where(['status' => 'publish','lang' => get_default_language()])->get();
        $query = GrantApplicant::query();
        if (!empty($request->start_date)){
            $query->whereDate('created_at','>=',$request->start_date);
        }
        if (!empty($request->end_date)){
            $query->whereDate('created_at','<=',$request->end_date);
        }
        if (!empty($request->grant_id)){
            $query->where(['grants_id' => $request->grant_id ]);
        }
        $error_msg = __('select start & end date to generate applicant report');
        if (!empty($request->start_date) && !empty($request->end_date)){
            $query->orderBy('id','DESC');
            $order_data =  $query->paginate($request->items);
            $error_msg = '';
        }

        return view('backend.grants.applicant-report')->with([
            'order_data' => $order_data,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'items' => $request->items,
            'grant_id' => $request->grant_id,
            'grants' => $grants,
            'error_msg' => $error_msg
        ]);
    }

    public function success_page_settings(){
        $all_languages = Language::all();
        return view('backend.grants.grant-success-page')->with(['all_languages' => $all_languages]);
    }
    public function cancel_page_settings(){
        $all_languages = Language::all();
        return view('backend.grants.grant-cancel-page')->with(['all_languages' => $all_languages]);
    }
    public function update_cancel_page_settings(Request $request){
        $all_languages = Language::all();
        foreach ($all_languages as $lang){
            $this->validate($request,[
                'grant_cancel_page_'.$lang->slug.'_title'  => 'nullable|string',
                'grant_cancel_page_'.$lang->slug.'_description'  => 'nullable|string',
            ]);

            $all_fileds = [
                'grant_cancel_page_'.$lang->slug.'_title',
                'grant_cancel_page_'.$lang->slug.'_description',
            ];
            foreach ($all_fileds as $field){
                update_static_option($field,$request->$field);
            }
        }
        return redirect()->back()->with(['msg' => __('Settings Update'),'type' => 'success']);
    }
    public function update_success_page_settings(Request $request){
        $all_languages = Language::all();
        foreach ($all_languages as $lang){
            $this->validate($request,[
                'grant_success_page_'.$lang->slug.'_title'  => 'nullable|string',
                'grant_success_page_'.$lang->slug.'_description'  => 'nullable|string',
            ]);

            $all_fileds = [
                'grant_success_page_'.$lang->slug.'_title',
                'grant_success_page_'.$lang->slug.'_description',
            ];
            foreach ($all_fileds as $field){
                update_static_option($field,$request->$field);
            }
        }
        return redirect()->back()->with(['msg' => __('Settings Update'),'type' => 'success']);
    }
    public function grant_applicant_mail(Request $request){
        $this->validate($request,[
           'applicant_id' => 'required',
           'name' => 'nullable',
           'email' => 'nullable',
           'subject' => 'required',
           'message' => 'required',
        ]);

        $applicant_details = GrantApplicant::find($request->applicant_id);

        try {
            Mail::to($applicant_details->email)->send(new BasicMail([
                'subject' => $request->subject,
                'message' => $request->message
            ]));
        }catch (\Exception $e){
            return redirect()->back()->with(NexelitHelpers::item_delete($e->getMessage()));
        }

        return redirect()->back()->with(['msg' => __('Mail Send Success'),'type' => 'success']);
    }

    public function slug_check(Request $request){
        $this->validate($request,[
            'slug' => 'required|string',
            'type' => 'required|string',
            'lang' => 'required|string',
        ]);
        $user_given_slug = $request->slug;
        $query  = Grants::where(['slug' => $user_given_slug]);
        if (!empty($request->lang)){
            $query->where('lang' , $request->lang);
        }
        $slug_count = $query->count();

        if ($request->type === 'new' && $slug_count > 0){
            return $user_given_slug.'-'.$slug_count;
        }elseif ($request->type === 'update' && $slug_count > 1){
            return $user_given_slug.'-'.$slug_count;
        }
        return $user_given_slug;
    }
}
