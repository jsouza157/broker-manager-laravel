<?php

namespace App\Traits;

use App\Broker;
use App\Property;
use App\UserPlan;
use carbon\Carbon;

trait PlanTrait
{
    public function myBrokers()
    {
        $brokers = Broker::where('user_id', '=', rootId())->count();
        $limit 	 = UserPlan::with(['plan'])
        ->where('user_id', '=', rootId())
        ->orderBy('created_at', 'DESC')
        ->first();

        if($brokers == $limit->plan->qtd_users) {
        	return false;
        }

        return true;
    }

    public function myPictutes()
    {
        $limit 	 = UserPlan::with(['plan'])
        ->where('user_id', '=', rootId())
        ->orderBy('created_at', 'DESC')
        ->first();

        return $limit->plan->qtd_imgs;
    }

    public function myProperties()
    {
        $properties = Property::where('user_id', '=', rootId())->count();
        $limit 	 = UserPlan::with(['plan'])
        ->where('user_id', '=', rootId())
        ->orderBy('created_at', 'DESC')
        ->first();

        if($properties == $limit->plan->qtd_properties) {
        	return false;
        }

        return true;
    }

    public function validatePlan()
    {
    	$plan = UserPlan::with(['plan'])
        ->where('user_id', '=', rootId())
        ->orderBy('created_at', 'DESC')
        ->first();

       	$created_at = Carbon::createFromFormat('Y-m-d', $plan->created_at);
		$now = Carbon::createFromFormat('Y-m-d');

		$value = $now->diffInDays($created_at);

		if($plan->plan->id == 4 && $value >= 7) {
			return false;
		}

		return true;
    }
}