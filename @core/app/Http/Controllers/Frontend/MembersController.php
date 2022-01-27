<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use App\PricePlan;
use App\Language;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MembersController extends Controller
{
  
    public $base_path = 'frontend.pages.members.';
    public function page(Request $request){
        $default_lang = Language::where('default', 1)->first();
        $lang = !empty(session()->get('lang')) ? session()->get('lang') : $default_lang->slug;
        $user_lang  = get_user_lang();
        $sort = $request->sort ?? '';
        $cat_id = $request->cat ?? '';
        $search_term = $request->s ?? '';
        $date= date('Y-m-d',strtotime('-1 years')) . PHP_EOL;

        $users_query =DB::table('users as u') 
        ->select('u.id','u.name','u.image','o.package_name')  
        ->leftJoin('orders as o',
        function($join) {

            $join->on('o.user_id','=','u.id')
            ->on('o.id','=',DB::raw("(select max(orders.id)  from orders WHERE (orders.user_id = u.id &&orders.status='complete'))"));}
        )

        ->where('o.status','complete')->where('o.created_at','>',$date);
        $all_price_plan = PricePlan::where(['lang' => $lang])->get();
        $all_language = Language::all();
        $sort_by = 'u.id';
        $sorting = 'desc';

        if (!empty($search_term)){
            $users_query->where('name','LIKE','%'.$search_term.'%');
        }

        if (!empty($cat_id)){
            $users_query->where('o.package_id' ,$cat_id);
        }
        //implement search features
        if (!empty($sort)){
            switch ($sort){
                case('oldest'):
                    $sort_by = 'u.id';
                    $sorting = 'asc';
                    break;
                default:
                    $sort_by = 'u.id';
                    $sorting = 'desc';
                    break;
            }
        }
        $users_query->orderBy($sort_by,$sorting);

        $all_users = $users_query->paginate(8);

        $category_list = user::get();
        return view($this->base_path.'members-all')->with([
            'all_users'=>$all_users,
            'all_price_plan'=>$all_price_plan,
            'all_language'=>$all_language,
            'sort'=>$sort,
            'cat_id' => $cat_id,
            'search_term' => $search_term,
        ]);
    }


    public function page_single(Request $request,$id)
    {
       $user=DB::table('users as u') 
       ->select('u.*','o.*')  
       ->leftJoin('orders as o',
       function($join) {

           $join->on('o.user_id','=','u.id')
           ->on('o.id','=',DB::raw("(select max(orders.id)  from orders WHERE (orders.user_id = u.id && orders.status='complete'))"));}
       )
       ->where('o.status','complete')->where('u.id',$id)->first();
       return view($this->base_path.'members_single')->with([
        'user'=>$user,
    ]);

    }
}
