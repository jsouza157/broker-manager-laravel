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
      <form class="forms-sample" autocomplete="off" action="{{ route('properties_store') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="card-header card-header-text" data-background-color="blue">
          <h4 class="card-title">Cadastrar imóvel</h4>
        </div>
        <div class="card-content">

          <div class="row form-group">
            <label>Nome : <span class="label label-danger">Obrigatório</span></label>
            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="EX: Apartamento em frente ao shopping Iguatemi">
            @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
              <strong>Este campo é obrigatório</strong>
            </span>
            @endif
          </div>
          <div class="row form-group">
            <label>Endereço : <span class="label label-danger">Obrigatório</span></label>
            <input type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}">
            @if ($errors->has('address'))
            <span class="invalid-feedback" role="alert">
              <strong>Este campo é obrigatório</strong>
            </span>
            @endif
          </div>
          <div class="row form-group">
            <label>Cidade : <span class="label label-danger">Obrigatório</span></label>
            <input type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}">
            @if ($errors->has('city'))
            <span class="invalid-feedback" role="alert">
              <strong>Este campo é obrigatório</strong>
            </span>
            @endif
          </div>
          <div class="row form-group">
            <label>Estado : <span class="label label-danger">Obrigatório</span></label>
            <input type="text" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" value="{{ old('state') }}">
            @if ($errors->has('state'))
            <span class="invalid-feedback" role="alert">
              <strong>Este campo é obrigatório</strong>
            </span>
            @endif
          </div>
          <div class="row form-group">
            <label>CEP : <span class="label label-danger">Obrigatório</span></label>
            <input type="text" class="form-control{{ $errors->has('cep') ? ' is-invalid' : '' }} cep" name="cep" value="{{ old('cep') }}">
            @if ($errors->has('cep'))
            <span class="invalid-feedback" role="alert">
              <strong>Este campo é obrigatório</strong>
            </span>
            @endif
          </div>
          <div class="row form-group">
            <label>Tipo : </label>
            <select class="form-control" name="type">
              <option value="casa" selected>Casa</option>
              <option value="apartamento">Apartamento</option>
            </select>
          </div>
          <div class="row form-group">
            <label>Andar : </label>
            <input type="number" class="form-control" name="floor" value="{{ old('floor') }}">
          </div>
          <div class="row form-group">
            <label>Garagem : </label>
            <select class="form-control" name="garage">
              <option value="1" selected>Sim</option>
              <option value="0">Não</option>
            </select>
          </div>
          <div class="row form-group">
            <label>Vagas na garagem : </label>
            <input type="text" class="form-control" name="garage_vacancy" value="{{ old('garage_vacancy') }}">
          </div>
          <div class="row form-group">
            <label>Fone para contato : </label>
            <input type="text" class="form-control phone_with_ddd" name="contact_phone" value="{{ old('contact_phone') }}">
          </div>
          <div class="row form-group">
            <label>E-mail para contato : </label>
            <input type="text" class="form-control" name="contact_email" value="{{ old('contact_email') }}">
          </div>
          <div class="row form-group">
            <label>Valor do imóvel R$ : </label>
            <input type="text" class="form-control money" name="price" value="{{ old('price') }}">
          </div>
          <div class="row form-group">
            <label>Aluguel R$ : </label>
            <input type="text" class="form-control money" name="rentals" value="{{ old('rentals') }}">
          </div>
          <div class="row col-md-12">
            <label>Imagens : <span class="label label-info">Extenções aceitas: JPG, JPEG e PNG</span></label>
            <input type="file" name="img[]" required style="margin-top: 15px">
            <div id="newImageAppend"></div>
          </div>
          <label class="mb-2 mt-2 text-success text-uppercase" style="cursor: pointer; margin-top: 15px" onclick="addImage()">+ mais imagens (máximo {{ $max_pictures }})</label>
          <div class="row form-group">
            <label>Descrição do imóvel : </label>
            <textarea name="property_detail" class="form-control" placeholder="EX: Imóvel com 2 quartos, sacada, vista para a praia etc.."></textarea>
          </div>
          <button type="submit" class="btn btn-info mr-2 btn-round">Cadastrar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
  var max_pictures = {{ $max_pictures }};
  var pictures_add = 1;

  function addImage() {
    if(pictures_add < max_pictures){
      $("#newImageAppend").append("<input type='file' name='img[]' style='margin-top: 15px'>");
    }else{
      $.notify({
        icon: "notifications",
        message: "<b>Atenção</b> - Seu plano não permite mais que "+max_pictures+" imagens."

      },{
        type: 'danger',
        timer: 3000,
        placement: {
          from: 'top',
          align: 'right'
        }
      });
    }

    pictures_add++;
  }
</script>
@endsection
