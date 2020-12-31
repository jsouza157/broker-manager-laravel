<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Broker;
use App\User;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth/login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if(Auth::guard('broker')->attempt($credentials)) {
            $broker = Broker::where('email', '=', $request->email)
                    ->where('active', 1)
                    ->get();
            if($broker && $broker->count() != 0) {
                return redirect()->intended('/admin');
            } else {
                Auth::logout();
                return redirect('/admin');
            }
        } elseif(Auth::guard('web')->attempt($credentials)) {
            $user = User::where('email', '=', $request->email)
                    ->where('active', 1)
                    ->get();
            if($user && $user->count() != 0) {
                return redirect()->intended('/admin');
            } else{
                Auth::logout();
                return redirect('/admin');
            }
        } else {
            Auth::logout();
            return redirect('/admin');
        }

    }


}
