@extends('layouts.dash')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="col-12 grid-margin">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('danger'))
        <div class="alert alert-danger">{{ session('danger') }}</div>
        @endif
        <a href="{{ route('properties_edit', ['id' => $property->id]) }}" class="btn btn-info btn-round">
          <i class="material-icons">create</i>
          Editar imóvel
        </a>
      </div>
      <div class="card">
        <div class="card-content text-center">
          <div class="col-md-12" style="padding: 20px">

            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                @for($o=0; $property->Image->count() > $o; $o++)
                <li data-target="#carousel-example-generic" data-slide-to="{{ $o }}" class="{{ $o == 0 ? 'active' : '' }}"></li>
                @endfor
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner">
                @for($i=0; $property->Image->count() > $i; $i++)
                <div class="item {{ $i == 0 ? 'active' : '' }}" style="max-height: 515px; width: 100%; height: auto; background: no-repeat center; background-size: cover; ">
                  <img src="{{ $property->Image[$i]->image }}" alt="...">
                  <div class="carousel-caption">
                   <!--<h3>Caption Text</h3>-->
                 </div>
               </div>
               @endfor
             </div>
           </div> <!-- Carousel -->

         </div>
       </div>
     </div>
   </div>
   <div class="col-md-6">
    <div class="card">
      <div class="card-header card-header-icon" data-background-color="blue">
        <i class="material-icons">assignment</i>
      </div>
      <div class="card-content">
        <h4 class="card-title">Dados do local</h4>
        <div class="row">
          <div class="col-md-12">
            <h6 class="category text-gray">
              <strong>Imóvel: </strong> {{ $property->name }}
            </h6>
          </div>
          <div class="col-md-12">
            <h6 class="category text-gray">
              <strong>Endereço: </strong> {{ $property->address }}
            </h6>
          </div>
          <div class="col-md-12">
            <h6 class="category text-gray">
              <strong>Cidade: </strong> {{ $property->city }}
            </h6>
          </div>
          <div class="col-md-12">
            <h6 class="category text-gray">
              <strong>Estado: </strong> {{ $property->state }}
            </h6>
          </div>
          <div class="col-md-12">
            <h6 class="category text-gray">
              <strong>CEP: </strong> {{ cep($property->cep) }}
            </h6>
          </div>
          @if(isset($property->rentals))
          <div class="col-md-12">
            <h6 class="category text-gray">
              <strong>Alugel do imóvel : </strong> <strong class="text-success">R$ {{ real($property->rentals) }}</strong>
            </h6>
          </div>
          @endif
          @if(isset($property->price))
          <div class="col-md-12">
            <h6 class="category text-gray">
              <strong>Valor do imóvel : </strong> <strong class="text-success">R$ {{ real($property->price) }}</strong>
            </h6>
          </div>
          @endif
        </div>
      </div>
      <div class="card-footer">
        Cadastrado {{ \Carbon\Carbon::createFromTimeStamp(strtotime($property->created_at))->diffForHumans() }}
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card">
      <div class="card-header card-header-icon" data-background-color="blue">
        <i class="material-icons">assignment</i>
      </div>
      <div class="card-content">
        <h4 class="card-title">Comodidades/Contato</h4>
        <div class="row">
          <div class="col-md-12">
            <h6 class="category text-gray">
              <strong>Tipo de imóvel: </strong> {{ $property->type == 'casa' ? 'Casa' : 'Apartamento' }}
            </h6>
          </div>
          @if(isset($property->floor))
          <div class="col-md-12">
            <h6 class="category text-gray">
              <strong>Andar : </strong> {{ $property->floor }}
            </h6>
          </div>
          @endif
          <div class="col-md-12">
            <h6 class="category text-gray">
              <strong>Garagem: </strong> {{ isset($property->garage) ? 'SIM' : 'NÃO' }}
            </h6>
          </div>
          @if(isset($property->garage_vacancy))
          <div class="col-md-12">
            <h6 class="category text-gray">
              <strong>Vagas na garagem: </strong> {{ $property->garage_vacancy }}
            </h6>
          </div>
          @endif
          @if(isset($property->contact_phone))
          <div class="col-md-12">
            <h6 class="category text-gray">
              <strong>Fone para contato : </strong> {{ phone($property->contact_phone) }}
            </h6>
          </div>
          @endif
          @if(isset($property->contact_email))
          <div class="col-md-12">
            <h6 class="category text-gray">
              <strong>E-mail para contato : </strong> {{ $property->contact_email }}
            </h6>
          </div>
          @endif
        </div>
      </div>
      <div class="card-footer">
        Cadastrado {{ \Carbon\Carbon::createFromTimeStamp(strtotime($property->created_at))->diffForHumans() }}
      </div>
    </div>
  </div>
  @if(isset($property->property_detail))
  <div class="col-md-12">
    <div class="card">
      <div class="card-content">
        <h4 class="card-title">Comodidades/Contato</h4>
        <div class="row">
          <div class="col-md-12">
            <h6 class="category text-gray">
              <strong>Descrição do imóvel : </strong> {{ $property->property_detail }}
            </h6>
          </div>
        </div>
      </div>
      <div class="card-footer">
        Cadastrado {{ \Carbon\Carbon::createFromTimeStamp(strtotime($property->created_at))->diffForHumans() }}
      </div>
    </div>
  </div>
  @endif
</div>
@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
@endsection
