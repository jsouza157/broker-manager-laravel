<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png" />
	<link rel="icon" type="image/png" href="../../assets/img/favicon.png" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>BM | Cadastre-se</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />
	<!-- Bootstrap core CSS     -->
	<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
	<!--  Material Dashboard CSS    -->
	<link href="../../assets/css/material-dashboard.css?v=1.3.0" rel="stylesheet"/>
	<!--  CSS for Demo Purpose, don't include it in your project     -->
	<link href="../../assets/css/demo.css" rel="stylesheet" />
	<!--     Fonts and icons     -->
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>

<body class="off-canvas-sidebar">
  <div class="wrapper wrapper-full-page">
        <div class="full-page register-page" filter-color="black" data-image="../../assets/img/register.jpeg">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="card card-signup">
                    <h2 class="card-title text-center">CADASTRE-SE</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="social text-center">
                                <h4> Um novo jeito de gerenciar </h4>
                            </div>

                            <form action="{{ route('register_store') }}">
                                <div class="card-content">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">store</i>
                                        </span>
                                        <input type="text" name="company" class="form-control {{ $errors->has('company') ? 'has-danger' : '' }}" placeholder="Empresa" value="{{ old('company') }}" {{ $errors->has('company') ? 'style=border-color:#e65251' : '' }}>
                                        <div class="input-group-append">
                                       	  <span class="input-group-text" {{ $errors->has('company') ? 'style=border-color:#e65251' : '' }}>
                                          	<i class="mdi mdi-check-circle-outline"></i>
                                          </span>
                                        </div>
                                    </div>
                                    <div>
                                          @if($errors->has('company'))
                                          <label class="error form-control-label col-form-label">{{ $errors->first('company') }}</label>
                                          @endif
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">web</i>
                                        </span>
                                        <input type="text" name="site" class="form-control {{ $errors->has('site') ? 'has-danger' : '' }}" placeholder="Site" value="{{ old('site') }}" {{ $errors->has('site') ? 'style=border-color:#e65251' : '' }}>
                                        <div class="input-group-append">
                                       	  <span class="input-group-text" {{ $errors->has('site') ? 'style=border-color:#e65251' : '' }}>
                                          	<i class="mdi mdi-check-circle-outline"></i>
                                          </span>
                                        </div>
                                    </div>
                                    <div>
                                          @if($errors->has('site'))
                                          <label class="error form-control-label col-form-label">{{ $errors->first('site') }}</label>
                                          @endif
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">face</i>
                                        </span>
                                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'has-danger' : '' }}" placeholder="Nome" value="{{ old('name') }}" {{ $errors->has('name') ? 'style=border-color:#e65251' : '' }}>
                                        <div class="input-group-append">
                                       	  <span class="input-group-text" {{ $errors->has('name') ? 'style=border-color:#e65251' : '' }}>
                                          	<i class="mdi mdi-check-circle-outline"></i>
                                          </span>
                                        </div>
                                    </div>
                                    <div>
                                          @if($errors->has('name'))
                                          <label class="error form-control-label col-form-label">{{ $errors->first('name') }}</label>
                                          @endif
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">email</i>
                                        </span>
                                        <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'has-danger' : '' }}" placeholder="E-mail" value="{{ old('email') }}" {{ $errors->has('email') ? 'style=border-color:#e65251' : '' }}>
                                        <div class="input-group-append">
                                       	  <span class="input-group-text" {{ $errors->has('email') ? 'style=border-color:#e65251' : '' }}>
                                          	<i class="mdi mdi-check-circle-outline"></i>
                                          </span>
                                        </div>
                                    </div>
                                    <div>
                                          @if($errors->has('email'))
                                          <label class="error form-control-label col-form-label">{{ $errors->first('email') }}</label>
                                          @endif
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'has-danger' : '' }}" placeholder="Senha" value="{{ old('password') }}" {{ $errors->has('password') ? 'style=border-color:#e65251' : '' }}>
                                        <div class="input-group-append">
                                       	  <span class="input-group-text" {{ $errors->has('password') ? 'style=border-color:#e65251' : '' }}>
                                          	<i class="mdi mdi-check-circle-outline"></i>
                                          </span>
                                        </div>
                                    </div>
                                    <div>
                                          @if($errors->has('password'))
                                          <label class="error form-control-label col-form-label">{{ $errors->first('password') }}</label>
                                          @endif
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                                        <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'has-danger' : '' }}" placeholder="Confirmar senha" value="{{ old('password_confirmation') }}" {{ $errors->has('password_confirmation') ? 'style=border-color:#e65251' : '' }}>
                                        <div class="input-group-append">
                                       	  <span class="input-group-text" {{ $errors->has('password_confirmation') ? 'style=border-color:#e65251' : '' }}>
                                          	<i class="mdi mdi-check-circle-outline"></i>
                                          </span>
                                        </div>
                                    </div>
                                    <div>
                                          @if($errors->has('password_confirmation'))
                                          <label class="error form-control-label col-form-label">{{ $errors->first('password_confirmation') }}</label>
                                          @endif
                                    </div>

                                    <!-- If you want to add a checkbox to this form, uncomment this code -->

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="optionsCheckboxes" checked>
                                            Eu concordo com os <a href="#">termos e condições de uso.</a>.
                                        </label>
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    <button class="btn btn-info btn-round">Concluir</button>
                                </div>
                                <div class="text-block text-center my-3">
                                  <span class="font-weight-semibold">Já possui uma conta?</span>
                                  <a href="{{ url('/admin') }}" class="text-black">Entre aqui</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
    <div class="container">
        <p class="copyright pull-right">
            &copy; <script>document.write(new Date().getFullYear())</script> <a href="/"> Manager Broker </a>, um novo jeito de gerenciar.
        </p>
    </div>
</footer>
</body>

    <!--   Core JS Files   -->
<script src="../../assets/js/jquery.min.js" type="text/javascript"></script>
<script src="../../assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../assets/js/material.min.js" type="text/javascript"></script>
<script src="../../assets/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="../../assets/js/arrive.min.js" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="../../assets/js/jquery.validate.min.js"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="../../assets/js/moment.min.js"></script>
<!--  Charts Plugin, full documentation here: https://gionkunz.github.io/chartist-js/ -->
<script src="../../assets/js/chartist.min.js"></script>
<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="../../assets/js/jquery.bootstrap-wizard.js"></script>
<!--  Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->
<script src="../../assets/js/bootstrap-notify.js"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="../../assets/js/bootstrap-datetimepicker.js"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="../../assets/js/jquery-jvectormap.js"></script>
<!-- Sliders Plugin, full documentation here: https://refreshless.com/nouislider/ -->
<script src="../../assets/js/nouislider.min.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="../../assets/js/jquery.select-bootstrap.js"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="../../assets/js/jquery.datatables.js"></script>
<!-- Sweet Alert 2 plugin, full documentation here: https://limonte.github.io/sweetalert2/ -->
<script src="../../assets/js/sweetalert2.js"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="../../assets/js/jasny-bootstrap.min.js"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="../../assets/js/fullcalendar.min.js"></script>
<!-- Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="../../assets/js/jquery.tagsinput.js"></script>
<!-- Material Dashboard javascript methods -->
<script src="../../assets/js/material-dashboard.js?v=1.3.0"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="../../assets/js/demo.js"></script>
    <script type="text/javascript">
        $().ready(function(){
            demo.checkFullPageBackgroundImage();

            setTimeout(function(){
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>
</html>
