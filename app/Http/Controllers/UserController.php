<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\UserPlan;


class UserController extends Controller
{
    public function __construct()
    {
    }

    public function viewRegister(){
        return view('user/user_create');
    }

    public function register(Request $request){
        $input = $request->all();
        // Validação
        $validacao = Validator::make($input, User::validacao($input , $update = false));
        if ($validacao->passes()){
            User::firstOrCreate([
                'company'   => $request->company,
                'name'      => $request->name,
                'email'     => $request->email,
                'site'      => $request->site,
                'api_token' => md5($request->email.Carbon::now()),
                'password'  => bcrypt($request->password),
            ]);

            UserPlan::firstOrCreate([
                'plan_id'       => 4,
                'user_id'       => rootId(), 
                'pay_day'       => Carbon::now(), 
                'status_pay'    => 'free',
                'token'         => '000000000',
                'correlationid' => '000000000',
                'build'         => '000000000',
                'PayerID'       => null
            ]);
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Registro realizado com sucesso.');
            return redirect('/admin');
        } else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Ocorreu um problema ao atualizar, tente novamente.');
            return redirect('/admin/user/create/')->
            withErrors($validacao)->
            withInput();
        }
    }

    public function viewUpdate(){      
        if(Auth::guard('web')->check() || Auth::guard('broker')->check()){
            if($this->middleware('auth:web,broker')){
                if(Auth::guard('web')->check()){
                    $user_id = Auth::guard('web')->user();
                }
                $userArray = User::where('id', '=', $user_id->id)->get();
                $user =  $userArray[0];
                return view('user.user_update', compact('user'));
            }
        } else{
            return redirect('/admin/login');
        }
    }

    public function update(Request $request){
        $input = $request->all();
        // Validação
        $validacao = Validator::make($input, User::validacao($input, $update = true));
        if ($validacao->passes()){
            User::find($request->id)->update([
                'company'   => $request->company,
                'name'      => $request->name,
                'email'     => $request->email,
                'site'      => $request->site,
            ]);
            Session()->flash('success', 'Atualizado com sucesso.');
            return redirect('/admin/user/update/view');
        } else{
            Session()->flash('danger', 'Ocorreu um problema ao atualizar, tente novamente.');
            return redirect('/admin/user/update/view')->
            withErrors($validacao)->
            withInput();
        }
    }
    
    public function passwordUpdate(Request $request){
        $input = $request->all();
        // Validação
        $validacao = Validator::make($input, User::validacao($input, $update = false));
        if ($validacao->passes()){
            User::find($request->id)->update([
                'password'   => bcrypt($request->password),
            ]);
            Session()->flash('success', 'Atualizado com sucesso.');
            return redirect('/admin/user/update/view');
        } else{
            Session()->flash('danger', 'Ocorreu um problema ao atualizar, tente novamente.');
            return redirect('/admin/user/update/view')->
            withErrors($validacao)->
            withInput();
        }
    }

}
