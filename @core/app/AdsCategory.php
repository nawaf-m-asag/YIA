<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdsCategory extends Model
{
    protected $table ='ads_categories';
    protected $fillable = ['name','lang','status'];
}
