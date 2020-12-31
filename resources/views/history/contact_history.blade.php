@extends('layouts.dash')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('danger'))
                <div class="alert alert-danger">{{ session('danger') }}</div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">{{ $contact->name }} - Status : <div class="badge badge-danger">PENDENTE</div></h5>
                    <form>
                      {{ csrf_field() }}
                      <input type="hidden" name="id" value="{{ $contact->id }}">
                      <div class="form-group">
                          <label>Designar atendimento :</label>
                          <select class="form-control">
                            <option>Júlio</option>
                            <option>Claudio</option>
                            <option>Maomé</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Imóvel interessado :</label>
                          <select class="form-control">
                            <option>AP guarujá 3 dorms.</option>
                            <option>Casa copacabana beira-mar</option>
                            <option>Teste</option>
                          </select>
                      </div>
                      <button class="btn btn-sm btn-primary">Designar</button>
                      <a href="#" class="btn btn-sm btn-danger">Cancelar contato</a>
                    </form>
                </div>
            </div>
            <br />
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 text-center">HISTÓRICO 11/01/2018</h5>
                    <div class="form-group">
                        <label>Corretor : Júlio</label>
                        <textarea class="form-control">TESTE</textarea>
                    </div>
                </div>
            </div>
            <br />
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 text-center">HISTÓRICO 21/12/2017</h5>
                    <div class="form-group">
                        <label>Corretor : Júlio</label>
                        <textarea class="form-control">TESTE 2</textarea>
                    </div>
                </div>
            </div>
          </div>
      </div>
  @endsection
