@extends('layouts.dash')

@section('content')
<div class="row">
	<div class="container">
		<div class="col-md-12">
        <ul class="timeline timeline-simple">
		    <li class="timeline-inverted">
		        <div class="timeline-badge success">
					GET
			    </div>
		    	<div class="timeline-panel">
			        <div class="timeline-heading">
			        	<h5>IMÓVEIS</h5>
			        	<span class="label label-success" style="font-size: 15px">
			        		http://localhost:8000/api/v1/properties
			        	</span>
			        </div>
			        <div class="timeline-body">
			        	<p>Através desta chamada você receberá uma paginação dos imóveis cadastrados
			        	em formato JSON para utilizar em seu site, blog etc...</p>

			        	<p>* Os dados de autenticação da api encontram-se em seu perfil.</p>
			        	<p>* Para aumentar ou diminuir a quantidade de itens na paginação utilize o seguinte parametro na url : <strong>http://localhost:8000/api/v1/properties/15</strong></p>
			        </div>
					<h6>
						<i class="ti-time"></i>
						Parametros da chamada:
					</h6>
					<br>
					<strong>HEADER</strong>
					<p>Authorizarion : {api_token} - <strong class="text-danger">REQUIRED</strong></p>
		    	</div>
		    </li>
		    <li class="timeline-inverted">
		        <div class="timeline-badge success">
					GET
			    </div>
		    	<div class="timeline-panel">
			        <div class="timeline-heading">
			        	<h5>DETALHAR IMÓVEL</h5>
			        	<span class="label label-success" style="font-size: 15px">
			        		http://localhost:8000/api/v1/property/{id}
			        	</span>
			        </div>
			        <div class="timeline-body">
			        	<p>Através desta chamada você receberá os dados completo de um único imóvel.</p>
			        </div>
					<h6>
						<i class="ti-time"></i>
						Parametros da chamada:
					</h6>
					<br>
					<strong>HEADER</strong>
					<p>Authorizarion : {api_token} - <strong class="text-danger">REQUIRED</strong></p>
		    	</div>
		    </li>
		    <li class="timeline-inverted">
		        <div class="timeline-badge info">
					POST
			    </div>
		    	<div class="timeline-panel">
			        <div class="timeline-heading">
			        	<h5>CADASTRAR UM CONTATO</h5>
			        	<span class="label label-info" style="font-size: 15px">
			        		http://localhost:8000/api/v1/contact/create
			        	</span>
			        </div>
			        <div class="timeline-body">
			        	<p>Cadastro de contatos na plataforma do Broker Manager.</p>
			        </div>
					<h6>
						<i class="ti-time"></i>
						Parametros da chamada:
					</h6>
					<br>
					<strong>HEADER</strong>
					<p>Authorizarion : {api_token} - <strong class="text-danger">REQUIRED</strong></p>
					<br>
					<strong>BODY</strong>
					<p>{property_id} : Imóvel interessado</p>
					<p>{name} : Nome do contato - <strong class="text-danger">REQUIRED</strong></p>
					<p>{email} : E-mail do contato- <strong class="text-danger">REQUIRED</strong></p>
					<p>{company} : Empresa</p>
					<p>{address} : Endereço</p>
					<p>{phone} : Fone com DDD</p>
					<p>{twitter}</p>
					<p>{linkedin}</p>
					<p>{skype}</p>
					<p>{description} : Informação passada pelo contato sobre algum imóvel.</p>
		    	</div>
		    </li>
		</ul>
    </div>
	</div>
</div>
@endsection
