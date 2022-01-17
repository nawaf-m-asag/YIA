<?php

namespace App\Http\Controllers;

use App\Helpers\NexelitHelpers;
use App\AwardApplicant;
use App\Awards;
use App\AwardsCategory;
use App\Language;
use App\Mail\BasicMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AwardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function all_awards(){
        $all_awards = Awards::all()->groupBy('lang');
        return view('backend.awards.all-awards')->with(['all_awards' => $all_awards]);
    }

    public function edit_award($id){

        $award_post  = Awards::find($id);
        $all_category  = AwardsCategory::where(['status' => 'publish','lang' => $award_post->lang])->get();
        $all_language = Language::all();

        return view('backend.awards.edit-award')->with([
            'all_languages' => $all_language,
            'all_category' => $all_category,
            'award_post' => $award_post
        ]);
    }

    public function new_award(){
        $all_category  = AwardsCategory::where(['status' => 'publish','lang' => get_default_language()])->get();
        $all_language = Language::all();
        return view('backend.awards.new-award')->with(['all_languages' => $all_language,'all_category' => $all_category]);
    }

    public function store_award(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'position' => 'required|string|max:191',
            'company_name' => 'required|string|max:191',
            'category_id' => 'required|string|max:191',
            'vacancy' => 'required|string|max:191',
            'award_responsibility' => 'required|string',
            'employment_status' => 'required|string',
            'education_requirement' => 'nullable|string',
            'award_context' => 'nullable|string',
            'experience_requirement' => 'nullable|string',
            'additional_requirement' => 'nullable|string',
            'award_location' => 'required|string',
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

        Awards::create([
            'title' => $request->title,
            'position' => $request->position,
            'company_name' => $request->company_name,
            'category_id' => $request->category_id,
            'vacancy' => $request->vacancy,
            'award_responsibility' => $request->award_responsibility,
            'employment_status' => $request->employment_status,
            'education_requirement' => $request->education_requirement,
            'award_context' => $request->award_context,
            'experience_requirement' => $request->experience_requirement,
            'additional_requirement' => $request->additional_requirement,
            'award_location' => $request->award_location,
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

        return redirect()->back()->with(['msg' => __('New award Post Added'),'type' => 'success']);
    }

    public function update_award(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'position' => 'required|string|max:191',
            'company_name' => 'required|string|max:191',
            'category_id' => 'required|string|max:191',
            'vacancy' => 'required|string|max:191',
            'award_responsibility' => 'required|string',
            'employment_status' => 'required|string',
            'education_requirement' => 'nullable|string',
            'experience_requirement' => 'nullable|string',
            'additional_requirement' => 'nullable|string',
            'award_context' => 'nullable|string',
            'award_location' => 'required|string',
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

        Awards::find($request->award_id)->update([
            'title' => $request->title,
            'position' => $request->position,
            'company_name' => $request->company_name,
            'category_id' => $request->category_id,
            'vacancy' => $request->vacancy,
            'award_responsibility' => $request->award_responsibility,
            'employment_status' => $request->employment_status,
            'education_requirement' => $request->education_requirement,
            'award_context' => $request->award_context,
            'experience_requirement' => $request->experience_requirement,
            'additional_requirement' => $request->additional_requirement,
            'award_location' => $request->award_location,
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

        return redirect()->back()->with(['msg' => __('award Post Update Success...'),'type' => 'success']);
    }
    public function clone_award(Request $request){
        $award_post  = Awards::find($request->item_id);
        Awards::create([
            'title' => $award_post->title,
            'position' => $award_post->position,
            'company_name' => $award_post->company_name,
            'category_id' => $award_post->category_id,
            'vacancy' => $award_post->vacancy,
            'award_responsibility' => $award_post->award_responsibility,
            'employment_status' => $award_post->employment_status,
            'education_requirement' => $award_post->education_requirement,
            'award_context' => $award_post->award_context,
            'experience_requirement' => $award_post->experience_requirement,
            'additional_requirement' => $award_post->additional_requirement,
            'award_location' => $award_post->award_location,
            'salary' => $award_post->salary,
            'lang' => $award_post->lang,
            'other_benefits' => $award_post->other_benefits,
            'email' => $award_post->email,
            'status' => 'draft',
            'deadline' => $award_post->deadline,
            'meta_tags' => $award_post->meta_tags,
            'meta_description' => $award_post->meta_description,
            'application_fee' => $award_post->application_fee,
            'application_fee_status' => $award_post->application_fee_status,
            'slug' => $award_post->title.random_int(999,9999),
            'image' => $request->image,
        ]);
        return redirect()->back()->with(['msg' => __('award Post Clone Success...'),'type' => 'success']);
    }
    public function delete_award(Request $request,$id){
        Awards::find($id)->delete();

        return redirect()->back()->with(['msg' => __('award Post Deleted Success'),'type' => 'danger']);
    }
    public function page_settings(){
        $all_languages = Language::all();
        return view('backend.awards.award-page-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_page_settings(Request $request){
        $this->validate($request,[
           'site_award_post_items' => 'required|string|max:191'
        ]);
        $all_languages = Language::all();
        foreach ($all_languages as $lang){
            $this->validate($request,[
               'site_awards_category_'.$lang->slug.'_title'  => 'nullable|string'
            ]);
            $site_awards_category_title = 'site_awards_category_'.$lang->slug.'_title';
            update_static_option('site_awards_category_'.$lang->slug.'_title',$request->$site_awards_category_title);
        }
        update_static_option('site_award_post_items',$request->site_award_post_items);
        return redirect()->back()->with(['msg' => __('award Page Settings Success...'),'type' => 'success']);
    }

    public function single_page_settings(){
        $all_languages = Language::all();
        return view('backend.awards.award-single-page-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_single_page_settings(Request $request){
        $this->validate($request,[
            'award_single_page_apply_form' => 'nullable|string|max:191',
            'award_single_page_applicant_mail' => 'required|string|max:191',
        ]);

        $all_languages = Language::all();
        foreach ($all_languages as $lang){
            $this->validate($request,[
                'award_single_page_'.$lang->slug.'_award_context_label'  => 'nullable|string',
                'award_single_page_'.$lang->slug.'_award_responsibility_label'  => 'nullable|string',
                'award_single_page_'.$lang->slug.'_education_requirement_label'  => 'nullable|string',
                'award_single_page_'.$lang->slug.'_experience_requirement_label'  => 'nullable|string',
                'award_single_page_'.$lang->slug.'_additional_requirement_label'  => 'nullable|string',
                'award_single_page_'.$lang->slug.'_others_benefits_label'  => 'nullable|string',
                'award_single_page_'.$lang->slug.'_apply_button_text'  => 'nullable|string',
                'award_single_page_'.$lang->slug.'_award_info_text'  => 'nullable|string',
                'award_single_page_'.$lang->slug.'_company_name_text'  => 'nullable|string',
                'award_single_page_'.$lang->slug.'_award_category_text'  => 'nullable|string',
                'award_single_page_'.$lang->slug.'_award_position_text'  => 'nullable|string',
                'award_single_page_'.$lang->slug.'_award_type_text'  => 'nullable|string',
                'award_single_page_'.$lang->slug.'_salary_text'  => 'nullable|string',
                'award_single_page_'.$lang->slug.'_award_location_text'  => 'nullable|string',
                'award_single_page_'.$lang->slug.'_award_deadline_text'  => 'nullable|string',
                'award_single_page_'.$lang->slug.'_award_application_fee_text'  => 'nullable|string',
            ]);

            $all_fileds = [
                'award_single_page_'.$lang->slug.'_award_context_label',
                'award_single_page_'.$lang->slug.'_award_responsibility_label',
                'award_single_page_'.$lang->slug.'_education_requirement_label',
                'award_single_page_'.$lang->slug.'_experience_requirement_label',
                'award_single_page_'.$lang->slug.'_additional_requirement_label',
                'award_single_page_'.$lang->slug.'_others_benefits_label',
                'award_single_page_'.$lang->slug.'_apply_button_text',
                'award_single_page_'.$lang->slug.'_award_info_text',
                'award_single_page_'.$lang->slug.'_company_name_text',
                'award_single_page_'.$lang->slug.'_award_category_text',
                'award_single_page_'.$lang->slug.'_award_position_text',
                'award_single_page_'.$lang->slug.'_award_type_text',
                'award_single_page_'.$lang->slug.'_salary_text',
                'award_single_page_'.$lang->slug.'_award_location_text',
                'award_single_page_'.$lang->slug.'_award_deadline_text',
                'award_single_page_'.$lang->slug.'_award_application_fee_text',
            ];
            foreach ($all_fileds as $field){
                update_static_option($field,$request->$field);
            }
        }

        update_static_option('award_single_page_apply_form',$request->award_single_page_apply_form);
        update_static_option('award_single_page_applicant_mail',$request->award_single_page_applicant_mail);

        return redirect()->back()->with(['msg' => __('award Page Settings Success...'),'type' => 'success']);
    }

    public function all_awards_applicant(){
        $all_applicant = AwardApplicant::all();
        return view('backend.awards.all-applicant')->with(['all_applicant' => $all_applicant]);
    }

    public function delete_award_applicant(Request $request,$id){
        $award_details = AwardApplicant::find($id);
        $all_attachment = unserialize($award_details->attachment);
        foreach($all_attachment as $name => $path){
            if(file_exists($path)){
                @unlink($path);
            }
        }
        AwardApplicant::find($id)->delete();
        return redirect()->back()->with(['msg' => __('award Application Delete Success...'),'type' => 'danger']);
    }

    public function bulk_action(Request $request){
        Awards::whereIn('id',$request->ids)->delete();

        return response()->json(['status' => 'ok']);
    }
    public function award_applicant_bulk_delete(Request $request){
        AwardApplicant::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function award_applicant_report(Request  $request){
        $order_data = '';
        $awards  = Awards::where(['status' => 'publish','lang' => get_default_language()])->get();
        $query = AwardApplicant::query();
        if (!empty($request->start_date)){
            $query->whereDate('created_at','>=',$request->start_date);
        }
        if (!empty($request->end_date)){
            $query->whereDate('created_at','<=',$request->end_date);
        }
        if (!empty($request->award_id)){
            $query->where(['awards_id' => $request->award_id ]);
        }
        $error_msg = __('select start & end date to generate applicant report');
        if (!empty($request->start_date) && !empty($request->end_date)){
            $query->orderBy('id','DESC');
            $order_data =  $query->paginate($request->items);
            $error_msg = '';
        }

        return view('backend.awards.applicant-report')->with([
            'order_data' => $order_data,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'items' => $request->items,
            'award_id' => $request->award_id,
            'awards' => $awards,
            'error_msg' => $error_msg
        ]);
    }

    public function success_page_settings(){
        $all_languages = Language::all();
        return view('backend.awards.award-success-page')->with(['all_languages' => $all_languages]);
    }
    public function cancel_page_settings(){
        $all_languages = Language::all();
        return view('backend.awards.award-cancel-page')->with(['all_languages' => $all_languages]);
    }
    public function update_cancel_page_settings(Request $request){
        $all_languages = Language::all();
        foreach ($all_languages as $lang){
            $this->validate($request,[
                'award_cancel_page_'.$lang->slug.'_title'  => 'nullable|string',
                'award_cancel_page_'.$lang->slug.'_description'  => 'nullable|string',
            ]);

            $all_fileds = [
                'award_cancel_page_'.$lang->slug.'_title',
                'award_cancel_page_'.$lang->slug.'_description',
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
                'award_success_page_'.$lang->slug.'_title'  => 'nullable|string',
                'award_success_page_'.$lang->slug.'_description'  => 'nullable|string',
            ]);

            $all_fileds = [
                'award_success_page_'.$lang->slug.'_title',
                'award_success_page_'.$lang->slug.'_description',
            ];
            foreach ($all_fileds as $field){
                update_static_option($field,$request->$field);
            }
        }
        return redirect()->back()->with(['msg' => __('Settings Update'),'type' => 'success']);
    }
    public function award_applicant_mail(Request $request){
        $this->validate($request,[
           'applicant_id' => 'required',
           'name' => 'nullable',
           'email' => 'nullable',
           'subject' => 'required',
           'message' => 'required',
        ]);

        $applicant_details = AwardApplicant::find($request->applicant_id);

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
        $query  = Awards::where(['slug' => $user_given_slug]);
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
