@extends('layouts.dash')

@section('content')
<div class="container">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if(session('danger'))
    <div class="alert alert-danger">{{ session('danger') }}</div>
  @endif
  <div class="col-12 grid-margin">
    <a href="{{ route('properties_create') }}" class="btn btn-info btn-round">
      <i class="material-icons">add</i>
      Cadastrar imóvel
    </a>
  </div>
  <div class="card">
      <div class="card-header card-header-icon" data-background-color="blue">
          <i class="material-icons">assignment</i>
      </div>
      <div class="card-content">
        <div class="row">
          <h4 class="card-title">Meus imóveis</h4>
          @foreach($properties as $property)
              <div class="col-md-4">
            		<div class="card card-chart">
            			<div class="card-header" data-background-color="primary" data-header-animation="false">
                    <img class="card-img-top" src="{{ isset($property->Image[0]->image) ? $property->Image[0]->image : 'https://png.pngtree.com/element_our/md/20180516/md_5afc6f72777ce.jpg' }}" style="max-height: 220px">
            				<div class="ct-chart" id="dailySalesChart"></div>
            			</div>
            			<div class="card-content">
            				<div class="card-actions">
            					<button type="button" class="btn btn-danger btn-simple fix-broken-card">
            						<i class="material-icons">build</i> Fix Header!
            					</button>
            				</div>

            				<h4 class="card-title">{{ 'ID #'.$property->id.' - '.$property->name  }}</h4>
            				<p class="category"><strong> {{ $property->address . ' - ' . $property->city }} </strong></p>
                    <span class="label {{ $property->active == 1 ? 'label-success' : 'label-danger' }}">{{ $property->active == 1 ? 'Imóvel ativo' : 'Imóvel inátivo' }}</span>
            			</div>
            			<div class="card-footer">
            				<div class="stats">
            					<i class="material-icons">access_time</i> Cadastrado {{ \Carbon\Carbon::createFromTimeStamp(strtotime($property->created_at))->diffForHumans() }}
            				</div>
                    <a href="{{ route('properties_view', ['id' => $property->id]) }}" class="btn btn-info btn-sm pull-right btn-round">Detalhes</a>
            			</div>
            		</div>
            	</div>
          @endforeach
        </div>
        {{ $properties->links() }}
      </div>
  </div>
</div>
@endsection
