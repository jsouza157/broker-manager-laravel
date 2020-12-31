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
    <a href="{{ route('brokers_create') }}" class="btn btn-info btn-round">
      <i class="mdi mdi-account-plus"></i>
      Cadastrar corretor
    </a>
  </div>
  <div class="card">
      <div class="card-header card-header-icon" data-background-color="blue">
          <i class="material-icons">assignment</i>
      </div>
      <div class="card-content">
          <h4 class="card-title">Corretores</h4>
          <div class="table-responsive">
              <table class="table">
                  <thead class="text-default">
                    <th class="text-center">Nome do corretor</th>
                    <th class="text-center">E-mail do corretor</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Administrador</th>
                    <th class="text-center">#</th>
                  </thead>
                  <tbody>
                    <tbody>
                      @foreach($brokers as $broker)
                      <tr>
                        <td class="text-center">{{ $broker->name }}</td>
                        <td class="text-center">{{ $broker->email }}</td>
                        <td class="text-info text-center">{{ $broker->active ? 'Ativo' : 'Inativo' }}</td>
                        <td class="text-info text-center">{{ $broker->admin ? 'Sim' : 'Nao' }}</td>
                        <td class="text-center">
                            <a href="{{ route('broker_view_update', ['id' => $broker->id]) }}" class="btn btn-primary btn-sm">
                              Editar
                            </a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>
@endsection
