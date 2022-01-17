<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AwardsCategory extends Model
{
    protected $table = 'awards_categories';
    protected $fillable = ['title','status','lang'];
}
