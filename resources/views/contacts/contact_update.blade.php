@extends('layouts.dash')

@section('content')
<div class="container">
  <div class="col-md-12">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('danger'))
        <div class="alert alert-danger">{{ session('danger') }}</div>
    @endif
    <div class="card">
      <form class="forms-sample" autocomplete="off" action="{{ route('contact_update') }}" method="POST">
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{ $contact->id }}">
        <div class="card-header card-header-text" data-background-color="blue">
          <h4 class="card-title">Editar contato | <a href="{{ route('properties_edit', ['id' => $contact->property_id]) }}" class="text-info">Imóvel interessado</a></h4>
        </div>
        <div class="card-content">
          <div class="row">
            <label class="col-sm-2 label-on-left">Nome: <span class="label label-danger">Obrigatório</span></label>
            <div class="col-sm-10">
              <div class="form-group label-floating">
                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $contact->name }}" placeholder="Digite o nome aqui...">
                <span class="help-block">Este campo é obrigatório</span>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>Este campo é obrigatório</strong>
                    </span>
                @endif
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-sm-2 label-on-left">E-mail: <span class="label label-danger">Obrigatório</span></label>
            <div class="col-sm-10">
              <div class="form-group label-floating">
                <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $contact->email }}" placeholder="Digite o e-mail aqui....">
                <span class="help-block">Este campo é obrigatório</span>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>Este campo é obrigatório e deve conter um @</strong>
                    </span>
                @endif
              </div>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-2 label-on-left">Empresa </label>
            <div class="col-sm-10">
              <div class="form-group label-floating">
                <input type="text" class="form-control" name="company" value="{{ $contact->company }}" placeholder="Digite o nome da empresa aqui...">
              </div>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-2 label-on-left">Endereço </label>
            <div class="col-sm-10">
              <div class="form-group label-floating">
                <input type="text" class="form-control" name="address" value="{{ $contact->address }}" placeholder="Digite o endereço aqui...">
              </div>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-2 label-on-left">Fone </label>
            <div class="col-sm-10">
              <div class="form-group label-floating">
                <input type="text" class="form-control phone_with_ddd" name="phone" value="{{ $contact->phone }}" placeholder="Digite aqui o fone...">
              </div>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-2 label-on-left">Twitter </label>
            <div class="col-sm-10">
              <div class="form-group label-floating">
                <input type="text" class="form-control" name="twitter" value="{{ $contact->twitter }}" placeholder="Digite aqui o Twitter...">
              </div>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-2 label-on-left">Linkedin </label>
            <div class="col-sm-10">
              <div class="form-group label-floating">
                <input type="text" class="form-control" name="linkedin" value="{{ $contact->linkedin }}" placeholder="Digite aqui o Linkedin...">
              </div>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-2 label-on-left">Skype </label>
            <div class="col-sm-10">
              <div class="form-group label-floating">
                <input type="text" class="form-control" name="skype" value="{{ $contact->skype }}" placeholder="Digite aqui o Skype...">
              </div>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-2 label-on-left">Status: <span class="label label-danger">Obrigatório</span></label>
            <div class="col-sm-10">
              <select class="selectpicker form-control" data-style="btn btn-primary btn-round" title="Status" data-size="7" name="status">
                @foreach($status as $s)
                  <option value="{{ $s->id }}" {{ $s->id == $contact->ContactStatus->status ? 'selected' : '' }}>{{ $s->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-2 label-on-left">Designar: <span class="label label-danger">Obrigatório</span></label>
            <div class="col-sm-10">
              <select class="selectpicker form-control" data-style="btn btn-primary btn-round" title="Esolha o corretor" data-size="7" name="broker">
                @foreach($brokers as $b)
                  <option value="{{ $b->id }}" {{ $b->id == $contact->ContactStatus->broker_id ? 'selected' : '' }}>{{ $b->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-2 label-on-left">Imóvel interessado </label>
            <div class="col-sm-10">
              <select class="selectpicker form-control" data-style="btn btn-primary btn-round" data-live-search="true" name="property_id" title="Selecione um imóvel" data-size="5">
                @foreach($properties as $property)
                <option data-tokens="{{ $property->name }}" value="{{ $property->id }}" {{ $property->id == $contact->property_id ? 'selected' : ''}}>{{ '# '.$property->id .' : '. $property->name .' - '. $property->city .' / '. $property->state }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <br />
          <div class="row">
            <label class="col-sm-2 label-on-left">Descrição </label>
            <div class="col-sm-10">
              <textarea class="form-control" name="description" value="{{ old('description') }}" placeholder="Coloque aqui uma breve descrição sobre este contato">{{ $contact->description }}</textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-info mr-2 btn-round">Editar</button>
          <a href="{{ route('contact_delete', ['id' => $contact->id]) }}" class="btn btn-danger mr-2 btn-round">Excluir</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
