<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
	<link rel="icon" type="image/png" href="../assets/img/favicon.png" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Broker Manager</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />

	<!-- Bootstrap core CSS     -->
	<link href="{{ url('/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
	<!--  Material Dashboard CSS    -->
	<link href="{{ url('/assets/css/material-dashboard.css?v=1.3.0' )}}" rel="stylesheet"/>
	<!--  CSS for Demo Purpose, don't include it in your project     -->
	<link href="{{ url('/assets/css/demo.css') }}" rel="stylesheet" />
	<!--     Fonts and icons     -->
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.5/css/bootstrap-select.min.css">

</head>
<body >
	<div class="wrapper">
	    <div class="sidebar" data-active-color="blue" data-background-color="white" data-image="{{ url('/assets/img/sidebar-1.jpg') }}">
    <!--
        Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
        Tip 2: you can also add an image using data-image tag
        Tip 3: you can change the color of the sidebar with data-background-color="white | black"
    -->
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
             BM
        </a>
        <a href="#" class="simple-text logo-normal">
            Broker Manager
        </a>
    </div>

    <div class="sidebar-wrapper">
        <div class="user">
            <!--<div class="photo">
                <img src="../assets/img/faces/avatar.jpg" />
            </div>-->
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <span class="text-center">
                     Bem-vindo, @if(Auth::guard('broker')->check())
									@if($strUsuario = explode(' ', Auth::guard('broker')->user()->name))
										{{ $strUsuario[0] }}
									@endif
                    			 @elseif(Auth::guard('web')->check())
                    			 	@if($strUsuario = explode(' ', Auth::guard('web')->user()->name))
                    			 	 	{{ $strUsuario[0] }}
                    			 	@endif
                    			 @endif !  
                    <b class="caret"></b>    
                    </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                        @if(Auth::guard('broker')->check())
                            <a href="{{ url('/admin/brokers/update/view') }}">
                                <span class="sidebar-mini"> MP </span>
                                <span class="sidebar-normal"> Meu perfil </span>
                            </a>
                        @elseif(Auth::guard('web')->check())
                        	<a href="{{ url('/admin/user/update/view') }}">
                                <span class="sidebar-mini"> MP </span>
                                <span class="sidebar-normal"> Meu perfil </span>
                            </a>
                        @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="active">
                <a href="{{ route('home') }}">
                    <i class="material-icons">dashboard</i>
                    <p> Dashboard </p>
                </a>
            </li>
            @if(userAdmin() == true)
            <li class="active">
            	<a href="{{ url('/admin/brokers') }}">
            		<i class="material-icons">supervisor_account</i>
            		<p> Gerenciar corretores </p>
            	</a>
            </li>
            @endif
            <li class="active">
                <a href="{{ route('contacts') }}">
                    <i class="material-icons">face</i>
                    <p> Contatos </p>
                </a>
            </li>
            <li class="active">
                <a href="{{ route('properties') }}">
                    <i class="material-icons">room</i>
                    <p> Imóveis </p>
                </a>
            </li>
            <li class="active">
                <a href="#">
                    <i class="material-icons">assessment</i>
                    <p> Relatórios </p>
                </a>
            </li>
            <li class="active">
                <a href="{{ route('plans') }}">
                    <i class="material-icons">shopping_cart</i>
                    <p> Planos </p>
                </a>
            </li>
            <li class="active">
                <a href="{{ route('document') }}">
                    <i class="material-icons">notes</i>
                    <p> Documentação API </p>
                </a>
            </li>
            <li class="active">
                <a href="{{ route('logout') }}">
                    <i class="material-icons">reply</i>
                    <p> Sair </p>
                </a>
            </li>
        </ul>
    </div>
</div>
	    <div class="main-panel">

			<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container-fluid">
        <div class="navbar-minimize">
            <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons visible-on-sidebar-mini">view_list</i>
            </button>
        </div>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"> Dashboard </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                @yield('top_menu')
            </ul>
        </div>
    </div>
</nav>
				<div class="content">
					<div class="container-fluid">
					 	<div class="row">
              @yield('content')
					</div>
				</div>
			<footer class="footer">
    <div class="container-fluid">
        <nav class="pull-left">

        </nav>
        <p class="copyright pull-right">
            &copy; <script>document.write(new Date().getFullYear())</script> <a href="/"> Manager Broker </a>, um novo jeito de gerenciar.
        </p>
    </div>
</footer>
		</div>
	</div>
</body>

	<!--   Core JS Files   -->
<script src="{{ url('/assets/js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/js/material.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="{{ url('/assets/js/arrive.min.js') }}" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="{{ url('/assets/js/jquery.validate.min.js') }}"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="{{ url('/assets/js/moment.min.js') }}"></script>
<!--  Charts Plugin, full documentation here: https://gionkunz.github.io/chartist-js/ -->
<script src="{{ url('/assets/js/chartist.min.js') }}"></script>
<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{ url('/assets/js/jquery.bootstrap-wizard.js')}}"></script>
<!--  Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->
<script src="{{ url('/assets/js/bootstrap-notify.js')}}"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="{{ url('/assets/js/bootstrap-datetimepicker.js')}}"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="{{ url('/assets/js/jquery-jvectormap.js') }}"></script>
<!-- Sliders Plugin, full documentation here: https://refreshless.com/nouislider/ -->
<script src="{{ url('/assets/js/nouislider.min.js') }}"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{ url('/assets/js/jquery.select-bootstrap.js') }}"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="{{ url('/assets/js/jquery.datatables.js') }}"></script>
<!-- Sweet Alert 2 plugin, full documentation here: https://limonte.github.io/sweetalert2/ -->
<script src="{{ url('/assets/js/sweetalert2.js') }}"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{ url('/assets/js/jasny-bootstrap.min.js') }}"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="{{ url('/assets/js/fullcalendar.min.js') }}"></script>
<!-- Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{ url('/assets/js/jquery.tagsinput.js') }}"></script>
<!-- Material Dashboard javascript methods -->
<script src="{{ url('/assets/js/material-dashboard.js?v=1.3.0') }}"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ url('/assets/js/demo.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<!-- End custom js for this page-->
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.5/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.5/js/i18n/defaults-*.min.js"></script>
<script>
$(document).ready(function(){
  $('.date').mask("00/00/0000", {placeholder: "__/__/____"});
  $('.time').mask('00:00:00');
  $('.date_time').mask('00/00/0000 00:00:00');
  $('.cep').mask('00000-000', {placeholder: "EX: 99999-999"});
  $('.phone').mask('00000-0000');
  $('.phone_with_ddd').mask('(00) 00000-0000', {placeholder: "EX: (99) 99999-9999"});
  $('.cpf').mask('000.000.000-00', {reverse: true});
  $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
  $('.money').mask('000.000.000.000.000,00', {reverse: true});
  $('.money2').mask("#.##0,00", {reverse: true});
  $('.ip_address').mask('099.099.099.099');
  $('.percent').mask('##0,00%', {reverse: true});
});
</script>
@yield('js')
<script type="text/javascript">
    $(document).ready(function(){

		// Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

		demo.initVectorMap();
    });
</script>
</html>
