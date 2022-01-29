<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grants extends Model
{
    protected $table = 'grants';
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
        'grant_location',
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
        'grant_context',
        'image'
        ];

    public function category(){
        return $this->hasOne('App\GrantsCategory','id','category_id');
    }
}
