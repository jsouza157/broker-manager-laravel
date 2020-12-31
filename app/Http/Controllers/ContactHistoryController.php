<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactHistoryController extends Controller
{
    public function viewHistory(Request $request){
      $contact = Contact::find($request->id);
      return view('history.contact_history', compact('contact'));
    }
}
