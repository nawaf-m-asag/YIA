<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrantApplicant extends Model
{
    protected $table = 'grants_applicants';
    protected $fillable = [
        'form_content',
        'grants_id',
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
        return $this->belongsTo('App\Grants','grants_id');
    }
}
