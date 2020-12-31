<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\email;
use App\Broker;
use App\User;
use Illuminate\Support\Str;

class EmailController extends Controller
{
    public function index(){
        return view('auth/recovery');
    }
    
    public function sendEmail(Request $request){
        $emailBroker = Broker::where('email', $request->email)->first();   
        $emailUser = User::where('email', $request->email)->first();
        if($emailBroker && $emailBroker->email != ''){
            $request['emailfound'] = $emailBroker->email;
            $newPassword  = Str::random(10);
            $name = $emailBroker->name;
            Broker::find($emailBroker->id)->update([
                'password'  => bcrypt($newPassword),
            ]);
        } elseif($emailUser && $emailUser->email != ''){
            $request['emailfound'] = $emailUser->email;
            $newPassword  = Str::random(10);
            $name = $emailUser->name;
            User::find($emailUser->id)->update([
                'password'  => bcrypt($newPassword),
            ]);
        } else {
            return 'não existe!';
        }
        /* Mail::to($request->email)->send(new email()); */
        if($request['emailfound'] && $request['emailfound'] != ''){
            $data = array( 'name' => $name,  'email' => $request['emailfound'], 'newPassword' => $newPassword);
            try{
                Mail::send('email.email', $data, function($message)  use ($request){
                    $message->to($request['emailfound']);
                    $message->subject('Nova senha, Broker Manager.');
                });
                return redirect('/admin/login');
            } catch (\Exception $e) {
                return $e;
            }
        }
    }
}
