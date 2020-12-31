<?php

namespace App\Http\Controllers;

use function App\Helpers\saveImageS3;
use App\Image;
use App\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ValidateController;

class PropertyController extends ValidateController
{
    public function __construct()
    {
        $this->middleware('auth:web,broker');
    }

    public function index()
    {
        if($this->validatePlanFree() == false) {
            session()->flash('danger', 'Seus dias de teste acabaram, acesse o menu de planos e faça uma assinatura para continuar.');
            return redirect('/admin');
        }

        $properties = Property::with(['Image'])
            ->where('user_id', '=', rootId())
            ->orderBy('created_at', 'DESC')
            ->paginate(15);

        return view('properties.properties', compact('properties'));
    }

    public function viewStore()
    {
        if($this->myProperties() == false) {
            Session()->flash('danger', 'Você chegou ao limite de imóveis, para cadastrar mais migre seu plano para um superior.');
            return redirect('/admin/imoveis');
        }

        $max_pictures = $this->myPictutes();

        return view('properties.property_create', compact('max_pictures'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|max:85',
            'address'   => 'required',
            'city'      => 'required',
            'state'     => 'required',
            'cep'       => 'required',
            'image.*'   => 'image|mimes:jpg,jpeg,png'
        ]);

        try {
            $property = Property::create([
                "name"              => $request->name,
                "address"           => $request->address,
                "city"              => $request->city,
                "state"             => $request->state,
                "cep"               => cleanNumber($request->cep),
                "type"              => $request->type,
                "floor"             => $request->floor,
                "garage"            => $request->garage,
                "garage_vacancy"    => $request->garage_vacancy,
                "contact_phone"     => cleanNumber($request->contact_phone),
                "contact_email"     => $request->contact_email,
                "price"             => $request->price ? cleanReal($request->price) : 0,
                "rentals"           => $request->rentals ? cleanReal($request->rentals) : 0,
                "property_detail"   => $request->property_detail,
                "user_id"           => rootId()
            ]);

            if(isset($request->img) && count($request->img) > 0) {
                for ($x = 0; count($request->img) > $x; $x++){
                    $imagePath = saveImageS3($request->img[$x]);

                    Image::create([
                        "user_id"       => rootId(),
                        "property_id"   => $property->id,
                        "image"         => 'https://s3-sa-east-1.amazonaws.com/easymovel'.$imagePath
                    ]);
                }
            }

            Session()->flash('success', 'Imóvel inserido com sucesso.');
            return redirect('/admin/imoveis');
        }catch (\Exception $e){
            Session()->flash('danger', 'Ocorreu um erro ao inserir o imóvel, tente novamente.');
            return redirect('/admin/imoveis');
        }
    }

    public function view(Request $request)
    {
        $property = Property::with(['Image'])
        ->where('id', '=', $request->id)
        ->where('user_id', '=', rootId())
        ->first();

        return view('properties.property_view', compact('property'));
    }


    public function viewUpdate(Request $request)
    {
        $property = Property::with(['Image'])
        ->where('id', '=', $request->id)
        ->where('user_id', '=', rootId())
        ->first();

        $max_pictures   = ($this->myPictutes() - $property->Image->count());
        $plan_limit     = $this->myPictutes();

        return view('properties.property_edit', compact('property', 'max_pictures', 'plan_limit'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'name'      => 'required|max:85',
            'address'   => 'required',
            'city'      => 'required',
            'state'     => 'required',
            'cep'       => 'required',
            'image.*'   => 'image|mimes:jpg,jpeg,png'
        ]);

        try {
            $property = Property::find($request->id)->update([
                "name"              => $request->name,
                "address"           => $request->address,
                "city"              => $request->city,
                "state"             => $request->state,
                "cep"               => cleanNumber($request->cep),
                "type"              => $request->type,
                "floor"             => $request->floor,
                "garage"            => $request->garage,
                "garage_vacancy"    => $request->garage_vacancy,
                "contact_phone"     => cleanNumber($request->contact_phone),
                "contact_email"     => $request->contact_email,
                "price"             => $request->price ? cleanReal($request->price) : 0,
                "rentals"           => $request->rentals ? cleanReal($request->rentals) : 0,
                "property_detail"   => $request->property_detail
            ]);

            if(isset($request->img) && count($request->img) > 0) {
                for ($x = 0; count($request->img) > $x; $x++){
                    $imagePath = saveImageS3($request->img[$x]);

                    Image::create([
                        "user_id"       => rootId(),
                        "property_id"   => $request->id,
                        "image"         => 'https://s3-sa-east-1.amazonaws.com/easymovel'.$imagePath
                    ]);
                }
            }

            Session()->flash('success', 'Imóvel atualizado com sucesso.');
            return redirect('/admin/imoveis/view?id='.$request->id);
        }catch (\Exception $e){
            Session()->flash('danger', 'Ocorreu um erro ao editar o imóvel, tente novamente.');
            return redirect('/admin/imoveis/view?id='.$request->id);
        }
    }

    public function status(Request $request)
    {
      try {
      $property = Property::find($request->id);

      if($property->active == 1) {
        Property::where('id', '=', $request->id)->update([
          'active'  => 0
        ]);
      }else{
        Property::where('id', '=', $request->id)->update([
          'active'  => 1
        ]);
      }
      Session()->flash('success', 'Status do imóvel atualizado.');
      return redirect('/admin/imoveis');
    }catch(\Exception $e){
      Session()->flash('danger', 'Ocorreu um erro ao mudar status do imóvel');
      return redirect('/admin/imoveis');
    }
  }
}
