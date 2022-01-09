<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelfReports extends Model
{
    protected $table ='self_reports';
    protected $fillable =['course_name','credit','credit_type','status','user_id','submitted_on','file'];
    public function User(){
        return $this->hasOne('App\User','id','user_id');
    }
}

