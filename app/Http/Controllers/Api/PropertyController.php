<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Property;

class PropertyController extends Controller
{

    public function show($per_page = 15)
    {
    	try {
    		$properties = Property::with(['Image'])
            ->where('user_id', '=', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate($per_page);

            return response()->json(['properties' => $properties], 200);
    	}catch(\Exception $e) {
    		return response()->json(['properties' => 0, 'error' => $e->getMessage()], 400);
    	}
    }

    public function showProperty($id)
    {
    	try {
    		$property = Property::with(['Image'])
        	->where('id', '=', $id)
        	->where('user_id', '=', 1)
        	->first();

        	return response()->json(['property' => $property], 200);
    	} catch(\Exception $e) {
    		return response()->json(['property' => 0, 'error' => $e->getMessage()], 400);
    	}
    }

}
