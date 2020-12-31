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
      <form class="forms-sample" autocomplete="off" action="{{ route('properties_update') }}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{ $property->id }}" />
        <div class="card-header card-header-text" data-background-color="blue">
          <h4 class="card-title">Cadastrar imóvel</h4>
        </div>
        <div class="card-content">

          <div class="row form-group">
              <label>Nome : <span class="label label-danger">Obrigatório</span></label>
              <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $property->name }}" placeholder="EX: Apartamento em frente ao shopping Iguatemi">
              @if ($errors->has('name'))
                  <span class="invalid-feedback" role="alert">
                      <strong>Este campo é obrigatório</strong>
                  </span>
              @endif
          </div>
          <div class="row form-group">
              <label>Endereço : <span class="label label-danger">Obrigatório</span></label>
              <input type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $property->address }}">
              @if ($errors->has('address'))
                  <span class="invalid-feedback" role="alert">
                      <strong>Este campo é obrigatório</strong>
                  </span>
              @endif
          </div>
          <div class="row form-group">
              <label>Cidade : <span class="label label-danger">Obrigatório</span></label>
              <input type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="city" value="{{ $property->city }}">
              @if ($errors->has('city'))
                  <span class="invalid-feedback" role="alert">
                      <strong>Este campo é obrigatório</strong>
                  </span>
              @endif
          </div>
          <div class="row form-group">
              <label>Estado : <span class="label label-danger">Obrigatório</span></label>
              <input type="text" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" value="{{ $property->state }}">
              @if ($errors->has('state'))
                  <span class="invalid-feedback" role="alert">
                      <strong>Este campo é obrigatório</strong>
                  </span>
              @endif
          </div>
          <div class="row form-group">
              <label>CEP : <span class="label label-danger">Obrigatório</span></label>
              <input type="text" class="form-control{{ $errors->has('cep') ? ' is-invalid' : '' }} cep" name="cep" value="{{ $property->cep }}">
              @if ($errors->has('cep'))
                  <span class="invalid-feedback" role="alert">
                      <strong>Este campo é obrigatório</strong>
                  </span>
              @endif
          </div>
          <div class="row form-group">
              <label>Tipo : </label>
              <select class="form-control" name="type">
                  <option value="casa" {{ $property->type == 'casa' ? 'selected' : '' }}>Casa</option>
                  <option value="apartamento" {{ $property->type == 'apartamento' ? 'selected' : '' }}>Apartamento</option>
              </select>
          </div>
          <div class="row form-group">
              <label>Andar : </label>
              <input type="number" class="form-control" name="floor" value="{{ $property->floor }}">
          </div>
          <div class="row form-group">
            <label>Garagem : </label>
            <select class="form-control" name="garage">
                <option value="1" {{ $property->garage ? 'selected' : '' }}>Sim</option>
                <option value="0" {{ !$property->garage ? 'selected' : '' }}>Não</option>
            </select>
          </div>
          <div class="row form-group">
            <label>Vagas na garagem : </label>
            <input type="text" class="form-control" name="garage_vacancy" value="{{ $property->garage_vacancy }}">
          </div>
          <div class="row form-group">
              <label>Fone para contato : </label>
              <input type="text" class="form-control phone_with_ddd" name="contact_phone" value="{{ $property->contact_phone }}">
          </div>
          <div class="row form-group">
              <label>E-mail para contato : </label>
              <input type="text" class="form-control" name="contact_email" value="{{ $property->contact_email }}">
          </div>
          <div class="row form-group">
              <label>Valor do imóvel R$ : </label>
              <input type="text" class="form-control money" name="price" value="{{ $property->price }}">
          </div>
          <div class="row form-group">
              <label>Aluguel R$ : </label>
              <input type="text" class="form-control money" name="rentals" value="{{ $property->rentals }}">
          </div>
          <div class="row col-md-12">
              <label>Imagens : <span class="label label-info">Extenções aceitas: JPG, JPEG e PNG</span></label>
              <input type="file" name="img[]" style="margin-top: 15px">
              <div id="newImageAppend"></div>
          </div>
          <label class="mb-2 mt-2 text-success text-uppercase" style="cursor: pointer; margin-top: 15px" onclick="addImage()">+ mais imagens (seu plano permite no máximo {{ $plan_limit }})</label>
          <br />
          <div class="row col-md-12" style="margin-top: 20px">
            @foreach($property->Image as $image)
            <div class="col-md-4">
              <div class="card card-chart">
                <div class="card-header" data-background-color="primary" data-header-animation="false">
                  <img class="card-img-top" src="{{ $image->image }}">
                  <div class="ct-chart" id="dailySalesChart"></div>
                </div>
                <div class="card-content">

                </div>
                <div class="card-footer text-center">
                  <a href="{{ route('delete_image', ['image_id' => $image->id]) }}" class="btn btn-danger btn-round btn-xs">Remover</a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="row form-group">
              <label>Descrição do imóvel : </label>
              <textarea name="property_detail" class="form-control" placeholder="EX: Imóvel com 2 quartos, sacada, vista para a praia etc..">{{ $property->property_detail }}</textarea>
          </div>
          <button type="submit" class="btn btn-info mr-2 btn-round">Salvar</button>
          <a href="{{ route('properties_status', ['id' => $property->id]) }}" class="btn {{ $property->active == 1 ? 'btn-danger' : 'btn-success' }} btn-round mr-2">{{ $property->active == 1 ? 'Desativar imóvel' : 'Ativar imóvel' }}</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
  var max_pictures = {{ $max_pictures }};
  var plan_limit   = {{ $plan_limit }};
  var pictures_add = 1;

    function addImage() {
      if(pictures_add < max_pictures){
        $("#newImageAppend").append("<input type='file' name='img[]' style='margin-top: 15px'>");
      }else{
          $.notify({
          icon: "notifications",
          message: "<b>Atenção</b> - Seu plano não permite mais que "+plan_limit+" imagens."

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
