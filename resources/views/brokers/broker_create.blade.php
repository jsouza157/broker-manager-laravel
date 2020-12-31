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
      <form class="forms-sample" autocomplete="off" action="{{ route('broker_store') }}" method="POST">
        {{ csrf_field() }}
        <div class="card-header card-header-text" data-background-color="blue">
          <h4 class="card-title">Cadastrar corretor</h4>
        </div>
        <div class="card-content">
          <div class="row">
            <label class="col-sm-2 label-on-left">Nome: <span class="label label-danger">Obrigatório</span></label>
            <div class="col-sm-10">
              <div class="form-group label-floating">
                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}">
                @if($errors->has('name'))
                <label class="error form-control-label col-form-label">{{ $errors->first('name') }}</label>
                @endif
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-sm-2 label-on-left">E-mail: <span class="label label-danger">Obrigatório</span></label>
            <div class="col-sm-10">
              <div class="form-group label-floating">
                <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <label class="error form-control-label col-form-label">{{ $errors->first('email') }}</label>
                @endif
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-sm-2 label-on-left">Senha: <span class="label label-danger">Obrigatório</span></label>
            <div class="col-sm-10">
              <div class="form-group label-floating">
                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}">
                @if($errors->has('password'))
                    <label class="error form-control-label col-form-label">{{ $errors->first('password') }}</label>
                @endif
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-sm-2 label-on-left">Confirmar Senha: <span class="label label-danger">Obrigatório</span></label>
            <div class="col-sm-10">
              <div class="form-group label-floating">
                <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" value="{{ old('password_confirmation') }}">
                @if($errors->has('password_confirmation'))
                    <label class="error form-control-label col-form-label">{{ $errors->first('password_confirmation') }}</label>
                @endif
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-sm-2 label-on-left">Fone:</label>
            <div class="col-sm-10">
              <div class="form-group label-floating">
                <input type="text" class="form-control phone_with_ddd" name="phone" value="{{ old('phone') }}">
                @if($errors->has('phone'))
                    <label class="error form-control-label col-form-label">{{ $errors->first('phone') }}</label>
                @endif
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-sm-2 label-on-left">Ativo: </label>
            <div class="col-sm-10">
              <div class="checkbox">
                  <label>
                      <input type="checkbox" name="status" checked>
                  </label>
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-sm-2 label-on-left">Administrador: </label>
            <div class="col-sm-10">
              <div class="checkbox">
                  <label>
                      <input type="checkbox" name="admin">
                  </label>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-info mr-2 btn-round">Cadastrar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
