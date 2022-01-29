<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrantsCategory extends Model
{
    protected $table = 'grants_categories';
    protected $fillable = ['title','status','lang'];
}
