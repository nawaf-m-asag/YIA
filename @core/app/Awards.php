<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Awards extends Model
{
    protected $table = 'awards';
    protected $fillable = [
        'title',
        'position',
        'company_name',
        'category_id',
        'vacancy',
        'award_responsibility',
        'employment_status',
        'education_requirement',
        'experience_requirement',
        'additional_requirement',
        'award_location',
        'salary',
        'other_benefits',
        'email',
        'deadline',
        'meta_tags',
        'meta_description',
        'status',
        'lang',
        'slug',
        'application_fee_status',
        'application_fee',
        'award_context',
        'image'
        ];

    public function category(){
        return $this->hasOne('App\AwardsCategory','id','category_id');
    }
}
