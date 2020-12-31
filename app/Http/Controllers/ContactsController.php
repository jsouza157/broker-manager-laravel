<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Broker;
use App\Status;
use App\ContactStatus;
use App\Property;

class ContactsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web,broker');
    }

    public function index(Request $request)
    {
        $contacts = Contact::with(['ContactStatus'])
            ->where('user_id', '=', rootId())
            ->orderBy('created_at', 'DESC')
            ->paginate(15);
        $status = Status::all();
        $brokers = Broker::all();

        return view('contacts.contacts', compact('contacts', 'status', 'brokers'));
    }

    public function viewStore()
    {
        $brokers = Broker::where('user_id', '=', rootId())->get();
        $status = Status::all();
        $properties = Property::where('user_id', '=', rootId())
            ->orderBy('created_at', 'DESC')
            ->paginate(15);

        return view('contacts.contact_create', compact('brokers', 'status', 'properties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:55',
            'email' => 'required|string|email|max:95',
        ]);

        try {
            $contact = Contact::firstOrCreate([
                "property_id"       => $request->property_id ? $request->property_id : null,
                "user_id"           => rootId(),
                "name"              => $request->name,
                "email"             => $request->email,
                "company"           => $request->company,
                "address"           => $request->address,
                "phone"             => cleanNumber($request->phone),
                "twitter"           => $request->twitter,
                "linkedin"          => $request->linkedin,
                "skype"             => $request->skype,
                "description"       => $request->description,
            ]);

            ContactStatus::create([
                'contact_id'    => $contact->id,
                'status'        => $request->status,
                'broker_id'     => $request->broker,
                'property_id'   => $request->property_id
            ]);

            Session()->flash('success', 'Contato cadastrado');
            return redirect('/admin/contacts');
        } catch (\Exception $e) {
            Session()->flash('danger', 'Ocorreu um erro ao realizar o cadastro');
            return redirect('/admin/contacts');
        }
    }


    public function view(Request $request)
    {
        $contact = Contact::where('id', '=', $request->id)
            ->where('user_id', '=', rootId())
            ->with(['ContactStatus'])
            ->first();

        $broker = Broker::where('user_id', '=', rootId())
            ->where('id', '=', $contact->ContactStatus->broker_id)
            ->first();
        $status = Status::where('id', '=', $contact->ContactStatus->status)
            ->first();

        $property = Property::where('user_id', '=', rootId())
            ->where('id', '=', $contact->property_id)
            ->first();

        return view('contacts.contact_view', compact('contact', 'broker', 'status', 'property'));
    }


    public function viewUpdate(Request $request)
    {
        $contact = Contact::where('id', '=', $request->id)
            ->where('user_id', '=', rootId())
            ->with(['ContactStatus'])
            ->first();

        $brokers = Broker::where('user_id', '=', rootId())->get();
        $status = Status::all();
        $properties = Property::where('user_id', '=', rootId())
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('contacts.contact_update', compact('contact', 'brokers', 'status', 'properties'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:55',
            'email' => 'required|string|email|max:95',
        ]);

        try {
            Contact::find($request->id)
                ->update([
                    "property_id"       => $request->property_id ? $request->property_id : null,
                    "name"              => $request->name,
                    "email"             => $request->email,
                    "company"           => $request->company,
                    "address"           => $request->address,
                    "phone"             => cleanNumber($request->phone),
                    "twitter"           => $request->twitter,
                    "linkedin"          => $request->linkedin,
                    "skype"             => $request->skype,
                    "description"       => $request->description
                ]);

            ContactStatus::where('contact_id', '=', $request->id)
                ->update([
                    'contact_id' => $request->id,
                    'status' => $request->status,
                    'broker_id' => $request->broker
                ]);

            Session()->flash('success', 'Atualizado com sucesso.');
            return redirect('/admin/contacts/view?id=' . $request->id);
        } catch (\Exception $e) {
            Session()->flash('danger', 'Ocorreu um problema ao atualizar, tente novamente.');
            return redirect('/admin/contacts/view?id=' . $request->id);
        }
    }

    public function delete(Request $request)
    {
        try {
            Contact::find($request->id)->delete();

            Session()->flash('success', 'Contato excluído com sucesso.');
            return redirect('/admin/contacts');
        } catch (\Exception $e) {
            Session()->flash('danger', 'Ocorreu um problema ao excluir contato, tente novamente.');
            return redirect('/admin/contacts/update/view?id=' . $request->id);
        }
    }

}
