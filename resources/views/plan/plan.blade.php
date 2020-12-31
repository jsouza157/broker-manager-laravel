<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>BM | Planos</title>

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

    <script src="https://www.paypalobjects.com/api/checkout.js"></script>

    <style>

    /* Media query for mobile viewport */
    @media screen and (max-width: 400px) {
        #paypal-button-container {
            width: 100%;
        }
    }

    /* Media query for desktop viewport */
    @media screen and (min-width: 400px) {
        #paypal-button-container {
            width: 250px;
            display: inline-block;
        }
    }

</style>

</head>

<body class="off-canvas-sidebar">
    <nav class="navbar navbar-primary navbar-transparent navbar-absolute">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="{{ route('home') }}">BROKER MANAGER</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{{ url('admin/') }}">
                            <i class="material-icons">dashboard</i>
                            Dashboard
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="wrapper wrapper-full-page">
        <div class="full-page pricing-page" data-image="{{ url('/assets/img/bg-pricing.jpeg') }}">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if(session('danger'))
                            <div class="alert alert-danger">{{ session('danger') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6 col-md-offset-3 text-center">
                            <h2 class="title">Escolha o melhor plano para você</h2>
                            <h5 class="description">Confira os termos e condições de compra.</h5>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($plans as $plan)
                        <div class="col-md-4">
                            <div class="card card-pricing card-raised">
                                <div class="card-content">
                                    <h6 class="category">{{ $plan->name }}</h6>
                                    <div class="icon icon-info">
                                        <i class="material-icons">{{ $plan->name == 'Básico' ? 'home' : ($plan->name == 'Intermediário' ? 'business' : 'account_balance') }}</i>
                                    </div>
                                    <h3 class="card-title">R$ {{ real($plan->value) }}</h3>
                                    <p class="card-description">Até {{ $plan->qtd_users }} usuários</p>
                                    <p class="card-description">{{ $plan->qtd_properties == null ? 'Cadastro de imóveis ilimitado' : 'Até '.$plan->qtd_properties.' imóveis para cadastrar' }}</p>
                                    <p class="card-description">Até {{ $plan->qtd_imgs }} imagens por imóvel</p>
                                    <div class=" text-center" style="max-height: 80px">
                                        <form action="{{ route('buy') }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="plan" value="{{ $plan->name }}">
                                            <input type="hidden" name="value" value="{{ $plan->value }}">
                                            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                            <input type="image" src="https://www.paypalobjects.com/pt_BR/BR/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - A maneira fácil e segura de enviar pagamentos online!" style="max-height: 80px">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="{{ route('home') }}">
                                    Home
                                </a>
                            </li>
                        </ul>
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
