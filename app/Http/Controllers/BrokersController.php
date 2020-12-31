<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Broker;
use App\Http\Controllers\ValidateController;

class BrokersController extends ValidateController
{

    public function __construct()
    {
        $this->middleware('auth:web,broker');
    }

    public function index(Request $request)
    {
        if($this->validatePlanFree() == false) {
            session()->flash('danger', 'Seus dias de teste acabaram, acesse o menu de planos e faça uma assinatura para continuar.');
            return redirect('/admin');
        }

        $brokers = Broker::where('user_id', '=', rootId())->get();
        return view('brokers.brokers', compact('brokers'));
    }

    public function viewStore()
    {
        if($this->myBrokers() == false) {
            Session()->flash('danger', 'Você chegou ao limite de corretores, para cadastrar mais migre seu plano para um superior.');
            return redirect('/admin/brokers');
        }

        return view('brokers.broker_create');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validacao = Validator::make($input, Broker::validacao($input, $update = false));
        if ($validacao->passes()) {
            if (Auth::guard('broker')->check()) {
                $user = Auth::guard('broker')->user();
            }
            if (Auth::guard('web')->check()) {
                $user = Auth::guard('web')->user();
            }
            $request['user_id'] = $user->id;
            Broker::firstOrCreate([
                "user_id"       => $request['user_id'],
                "name"          => $request->name,
                "email"         => $request->email,
                "password"      => bcrypt($request->password),
                "phone"         => cleanNumber($request->phone),
                "active"        => $request->status ? 1 : 0,
                "admin"         => $request->admin ? 1 : 0 ,
            ]);
            Session()->flash('success', 'Corretor cadastrado');
            return redirect('/admin/brokers');
        } else {
            Session()->flash('danger', 'Ocorreu um erro ao realizar o cadastro');
            return redirect('/admin/brokers/create')->
            withErrors($validacao)->
            withInput();
        }
    }

    public function viewUpdate(Request $request)
    {
        if($request->id == ''){
            $broker_id = Auth::guard('broker')->user();
            $brokerArray = Broker::where('id', '=', $broker_id->id)
            ->where('user_id', '=', rootId())->get();
        } else{
            $brokerArray = Broker::where('id', '=', $request->id)
            ->where('user_id', '=', rootId())->get();
        }   
        $broker =  $brokerArray[0];
        return view('brokers.broker_update', compact('broker'));
    }

    public function update(Request $request)
    {
        $input = $request->all();
        // Validação
        $validacao = Validator::make($input, Broker::validacao($input, $update = true));
        if ($validacao->passes()) {
            Broker::find($request->id)->update([
                "name"      => $request->name,
                "email"     => $request->email,
                "phone"     => cleanNumber($request->phone),
                "active"    => $request->status ? 1 : 0,
                "admin"        => $request->admin ? 1 : 0 ,
            ]);

            Session()->flash('success', 'Atualizado com sucesso.');
            return redirect('/admin/brokers');
        } else {
            Session()->flash('danger', 'Ocorreu um problema ao atualizar, tente novamente.');
            return redirect('/admin/brokers/update/view?id=' . $request->id)->
            withErrors($validacao)->
            withInput();
        }
    }
    
    public function passwordUpdate(Request $request){
        $input = $request->all();
        // Validação
        $validacao = Validator::make($input, Broker::validacao($input, $update = false));
        if ($validacao->passes()){
            Broker::find($request->id)->update([
                'password'   => bcrypt($request->password),
            ]);
            Session()->flash('success', 'Atualizado com sucesso.');
            return redirect()->route('broker_view_update', ['id' => $request->id]);
        } else{
            Session()->flash('danger', 'Ocorreu um problema ao atualizar, tente novamente.');
            return redirect()->route('broker_view_update', ['id' => $request->id])->
            withErrors($validacao)->
            withInput();
        }
    }

    public function delete(Request $request)
    {
        try {
            Broker::find($request->id)->delete();

            Session()->flash('success', 'Corretor excluído com sucesso.');
            return redirect('/admin/brokers');
        } catch (\Exception $e) {
            Session()->flash('danger', 'Ocorreu um problema ao excluir corretor, tente novamente.');
            return redirect('/admin/brokers/update/view?id=' . $request->id);
        }
    }

}
