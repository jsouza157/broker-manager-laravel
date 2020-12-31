@extends('layouts.dash')

@section('content')
<div class="container">
  <div class="col-12 grid-margin">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('danger'))
    <div class="alert alert-danger">{{ session('danger') }}</div>
    @endif
    <a href="{{ route('contacts_create') }}" class="btn btn-info btn-round">
      <i class="material-icons">add</i>
      Cadastrar contato
    </a>
  </div>
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if(session('danger'))
    <div class="alert alert-danger">{{ session('danger') }}</div>
  @endif
  <div class="card">
      <div class="card-header card-header-icon" data-background-color="blue">
          <i class="material-icons">assignment</i>
      </div>
      <div class="card-content">
          <h4 class="card-title">Meus contatos</h4>
          <div class="table-responsive">
              <table class="table">
                  <thead class="text-default">
                    <th class="text-center">Nome do contato</th>
                    <th class="text-center">Data do contato</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Corretor</th>
                    <th class="text-center">#</th>
                  </thead>
                  <tbody>
                    <tbody>
                      @foreach($contacts as $contact)
                      <tr>
                        <td class="text-center">{{ $contact->name }}</td>
                        <td class="text-center">{{ date('d/m/Y H:i:s', strtotime($contact->created_at)) }}</td>
                        <td class="text-center">
                          @foreach($status as $s)
                            @if($s->id == $contact->ContactStatus->status)
                            <span class="label label-info">{{ $s->name }}</span>
                            @endif
                          @endforeach
                        </td>
                        <td class="text-center">
                          @foreach($brokers as $broker)
                            @if($broker->id == $contact->ContactStatus->broker_id)
                            <label>{{ $broker->name }}</label>
                            @endif
                          @endforeach
                        </td>
                        <td class="text-center">
                            <a href="{{ route('contact_view', ['id' => $contact->id]) }}" class="btn btn-primary btn-sm">
                              Visualizar
                            </a>
                            <!--<a href="{{ route('history', ['id' => $contact->id]) }}" class="btn btn-success btn-sm">
                              Histórico
                            </a>-->
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </tbody>
              </table>
              {{ $contacts->links() }}
          </div>
      </div>
  </div>
</div>
@endsection
