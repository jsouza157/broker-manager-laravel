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
          <div class="card-header card-header-text" data-background-color="blue">
            <h4 class="card-title">Editar Corretor</h4>
          </div>
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Meus dados</a></li>
            <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Alterar senha</a></li>
    	  </ul>
    	  <div class="tab-content col-md-12">
    	  	<div id="tab1" class="tab-pane fade in active">
              <div class="card-content">
                    <form class="forms-sample" autocomplete="off" action="{{ route('broker_update') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $broker->id }}">
                        <div class="form-group">
                            <label>Nome: <span class="label label-danger">Obrigatório</span></label>
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ? old('name') : $broker->name}}">
                            @if($errors->has('name'))
                            <label class="error form-control-label col-form-label">{{ $errors->first('name') }}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>E-mail:</label>
                            <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') ? old('email') : $broker->email }}">
                            @if($errors->has('email'))
                            <label class="error form-control-label col-form-label">{{ $errors->first('email') }}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Telefone: </label>
                            <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') ? old('phone') : $broker->phone }}">
                            @if($errors->has('phone'))
                            <label class="error form-control-label col-form-label">{{ $errors->first('phone') }}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Ativo: </label>
                            <div class="checkbox">
                              <label>
                                  <input type="checkbox" name="status" <?php echo (old('status') != '' || $broker->active == 1 ) ? 'checked' : ''; ?> >
                              </label>
                          	</div>
                        </div>
                        <div class="form-group">
                            <label>Administrador: </label>
                            <div class="checkbox">
                              <label>
                                  <input type="checkbox" name="admin" <?php echo (old('admin') != '' || $broker->admin == 1 ) ? 'checked' : ''; ?> >
                              </label>
                          	</div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Salvar</button>
                    </form>
              </div>
          	</div>    
          	<div id="tab2" class="tab-pane fade in">
            	<div class="card-content">
            	<form class="forms-sample" autocomplete="off" action="{{ route('broker_password_update') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $broker->id }}">
                	<div class="form-group">
                        <label>Nova senha: <span class="label label-danger">Obrigatório</span></label></label>
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}">
                        @if($errors->has('password'))
                        <label class="error form-control-label col-form-label">{{ $errors->first('password') }}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Confirmar Senha: </label>
                        <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" value="{{ old('password_confirmation') }}">
                        @if($errors->has('password_confirmation'))
                        <label class="error form-control-label col-form-label">{{ $errors->first('password_confirmation') }}</label>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Salvar</button>
                </form>
            	</div>
            </div>    
          </div>
        </div>
    </div>
</div>

@endsection
