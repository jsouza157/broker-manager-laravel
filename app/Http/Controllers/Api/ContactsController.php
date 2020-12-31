<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;
use App\ContactStatus;

class ContactsController extends Controller
{
	public function store(Request $request)
	{
		try {
			$contact = Contact::firstOrCreate([
				"property_id"       => $request->property_id ? $request->property_id : null,
				"user_id"           => 1,
				"name"              => $request->name,
				"email"             => $request->email,
				"company"           => $request->company ? $request->company : null,
				"address"           => $request->address ? $request->address : null,
				"phone"             => $request->phone ? cleanNumber($request->phone) : null,
				"twitter"           => $request->twitter ? $request->twitter : null,
				"linkedin"          => $request->linkedin ? $request->linkedin : null,
				"skype"             => $request->skype ? $request->skype : null,
				"description"       => $request->description ? $request->description : null,
			]);

			ContactStatus::firstOrCreate([
				'contact_id'    => $contact->id,
				'status'        => 1,
				'broker_id'     => null,
				'property_id'   => $request->property_id ? $request->property_id : null
			]);

			return response()->json(['status' => 'success', 'message' => 'Contact created']);
		} catch (\Exception $e) {
			return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
		}
	}

}
