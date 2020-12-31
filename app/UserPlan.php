<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Plan;

class UserPlan extends Model
{
    protected $fillable = 
    [	
    	'plan_id', 
    	'user_id', 
    	'pay_day', 
    	'status_pay',
    	'token',
    	'correlationid', 
    	'build',
    	'PayerID',
    	'profileID',
    	'profile_status'
    ];

    public function plan()
    {
        return $this->hasOne(Plan::class, 'id', 'plan_id');
    }
}
