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
    <div class="card card-profile">
      <div class="card-avatar">
        <img class="img" src="{{ url('assets/img/avatar.svg') }}" />
      </div>
      <div class="card-content">
        <h4 class="card-title">{{ $contact->name }}</h4>
        <h6 class="category text-gray">
          <strong>E-mail:</strong>
          {{ $contact->email }}
          /
          <strong>Fone: </strong>
          {{ isset($contact->phone) ? $contact->phone : 'Não cadastrado' }}
        </h6>
        <h6 class="category text-gray">
          <strong>Status: </strong>
          {{ $status->name }}
          /
          <strong>Corretor: </strong>
          {{ $broker->name }}
          @if(isset($property->name))
          /
          <strong>Imóvel : </strong>
          <a href="{{ route('properties_view', ['id' => $property->id]) }}">
            {{ $property->name }}
          </a>
          @endif
        </h6>
        <p class="description">
          <strong>Descrição: </strong>
          {{ $contact->description ? $contact->description : 'Descrição não cadastrada' }}
        </p>
        <a href="{{ route('contact_view_update', ['id' => $property->id]) }}" class="btn btn-info btn-round">
          <i class="material-icons">create</i>
          Editar
        </a>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
