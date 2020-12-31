<?php

namespace App\Http\Controllers;

use App\Plan;
use Illuminate\Http\Request;

class planController extends Controller
{
    public function index()
    {
        $plans = Plan::where('tasting', '=', false)->get();

        return view('plan.plan', compact('plans'));
    }

    public function store(Request $request)
    {

    }
}
