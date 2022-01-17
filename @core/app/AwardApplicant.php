<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AwardApplicant extends Model
{
    protected $table = 'awards_applicants';
    protected $fillable = [
        'form_content',
        'awards_id',
        'attachment',
        'track',
        'transaction_id',
        'name',
        'email',
        'application_fee',
        'payment_gateway',
        'payment_status',
    ];

    public function award(){
        return $this->belongsTo('App\Awards','awards_id');
    }
}
