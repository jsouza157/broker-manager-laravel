<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserPlan;
use carbon\Carbon;
use App\Broker;
use App\Property;

class ValidateController extends Controller
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

    public function validatePlanFree()
    {
    	$plan = UserPlan::with(['plan'])
        ->where('user_id', '=', rootId())
        ->orderBy('created_at', 'DESC')
        ->first();

		$value = $plan->created_at->diffInDays(Carbon::now());

		if($plan->plan->id == 4 && $value >= 7) {
			return false;
		}

		return true;
    }
}
