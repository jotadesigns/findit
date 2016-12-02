<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@lang('layouts.title')</title>
	<script src="https://code.jquery.com/jquery-1.12.0.min.js" charset="utf-8"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">

	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600i,700,900" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	<script src="{{ asset('/js/modernizr.custom.js') }}" type="text/javascript"></script>
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<!--    <script src="{{ asset('js/app.js') }}"></script> -->
		<link href="{{ asset('/css/main.css') }}" rel="stylesheet" type="text/css"/>
		<link href="{{ asset('/css/admin.css') }}" rel="stylesheet" type="text/css"/>
		<link href="{{ asset('/css/image-picker.css') }}" rel="stylesheet" type="text/css"/>
		<script src="{{ asset('/js/image-picker.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('/js/demo1.js') }}" type="text/javascript"></script>

<script src="js/msdropdown/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/msdropdown/jquery.dd.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/msdropdown/dd.css" />
		<!-- CSS VARIABLE -->
		@if(isset($tiempo))
			@if($tiempo=="dia")
				<link href="{{ asset('/css/dia.css') }}" rel="stylesheet" type="text/css"/>
			@else
				<link href="{{ asset('/css/noche.css') }}" rel="stylesheet" type="text/css"/>
			@endif
		@endif



</head>
<body>
	<nav class="hdnav">
		<div class="hdnavpad">
			<div class="row">
				<div class="nav-logo col-xs-5 col-sm-5 col-md-6 col-lg-6">
						<a class="link link--nukun" href="{{ url('/').'/'.LaravelLocalization::getCurrentLocale() }}">Fin<span>d</span> it</a>
				</div>

				<div class="col-xs-7 col-sm-7 col-md-6 col-lg-6">

			        <ul class="nav-enlaces">
			            <!-- Authentication Links -->
			            @if (Auth::guest())
			                <li class="nav-login"><a href="{{ url('/').'/'.LaravelLocalization::getCurrentLocale().'/login' }}">@lang('layouts.login')</a></li>
							<div class="nav-separator"></div>
			                <li class="nav-register"><a href="{{ url('/').'/'.LaravelLocalization::getCurrentLocale().'/register' }}">@lang('layouts.register')</a></li>
			            @else
							<li class="nav-estrella">
								<a href="{{ url('/').'/'.LaravelLocalization::getCurrentLocale().'/login' }}"><i class="ion-android-star-outline"></i></a>
							</li>
							<div class="nav-separator"></div>
			                <li class="nav-user">
								@if(!empty(Session::get('userExtra')["avatar"]))
									<img width=30 height="30" src="{!! Session::get('userExtra')['avatar'] !!}" />
								@endif
								<a href="{{ url('/').'/'.LaravelLocalization::getCurrentLocale().'/perfil/favoritos' }}">{{ Auth::user()->name }}</a>
								<i class="ion-android-arrow-dropdown"></i>
								<!--
								<div class="header-menuContent">
									<div class="header-menuShadow">
										<ul class="header-accountServices list-unstyled">
											<li><a class="icon-reservation" data-requires-auth="" href="/mi-cuenta/reservas">Mis reservas</a></li>
											<li><a class="icon-rate" href="/mi-cuenta/opiniones">Opiniones</a></li>
											<li><a class="icon-star-empty-small" data-requires-auth="" href="https://www.eltenedor.es/mi-cuenta/favoritos">Mis favoritos</a></li>
											<li><a class="icon-yums" href="/mi-cuenta/yums">Mis Yums</a></li>
											<li><a class="icon-parameters" data-requires-auth="" href="/mi-cuenta/datos">Mis ajustes</a></li>
											<li><a class="icon-email" data-requires-auth="" href="/mi-cuenta/suscripciones">Mis suscripciones</a></li>
										</ul>
										<div class="header-accountLogout">
											<a class="icon-logout" href="{{ url('/logout') }}">Desconectar</a>
										</div>
									</div>
								</div>
								-->
							</li>
			            @endif
						<div class="nav-separator"></div>
						<nav class="nav-languages">
							<div class="nav-languages-text">
								<a class="language-activate" >@lang('layouts.language')</a>
							</div>
							<div class="nav-languages-selector">
								<ul class="language_bar_chooser">
										@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
											<li>
												<a rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
												<img src="{{asset('assets/imagenes/banderas/'.$localeCode.'.png')}}" />
													{{ $properties['native'] }}
												</a>
											</li>
										@endforeach
								</ul>
							</div>
						</nav>
			        </ul>
				</div>
			</div>
		</div>
	</nav>

	<div id="wrapper">
	<div class='container'>
	  <div id="perfil_leftgrid" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<ul id="menu_admin">
	<li><a href="{{url('/perfil/favoritos')}}"><i class="ion-ios-body"></i></a></li>


	  <div class="nav-separator"></div>
			<li>
				<a href="{{ url('/administracion/ingresar') }}">
					<i class="ion-cash profile_icons"></i>
					<p>Captar clientes</p>
				</a>
			</li>
			  <div class="nav-separator"></div>
			<li>
				<a href="{{ url('/verFichados') }}">
					<i class="ion-android-done profile_icons"></i>
					<p>Locales pendientes</p>
				</a>
			</li>
			  <div class="nav-separator"></div>
			<li>
				<a href="{{ url('/verFichadosParaMasivo') }}">
					<i class="ion-android-done-all profile_icons"></i>
					<p>Ingreso masivo</p>
				</a>
			</li>
			  <div class="nav-separator"></div>
			<li>
				<a href="{{ url('/administracion/userspendientes') }}">
					<i class="ion-ios-people profile_icons"></i>
					<p>Dueños pendientes</p>
				</a>
			</li>
			<li><a href="{{ url('/').'/'.LaravelLocalization::getCurrentLocale().'/logout' }}"><i class="ion-power profile_icons"></i></a></li>

	</ul>
	</div>
		</div>
        @yield('content')

		<!-- FOOTER --><!-- FOOTER --><!-- FOOTER --><!-- FOOTER --><!-- FOOTER -->
		<footer>
			<div class="container">
				<div class="col-xs-10 col-sm-3 col-md-3 col-lg-3 col-xs-offset-1 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
				    <ul>
						<li class="footer-title"><a class="link link--nukun" href="{{ url('/') }}">Fin<span>d</span> it</a></li>
				    	<li><a href="{{ url('/').'/'.LaravelLocalization::getCurrentLocale().'/empresas' }}">Para empresas</a></li>
				    	<li><a href="#">Lorem Ipsum</a></li>
				    	<li><a href="#">Lorem Ipsum</a></li>
				    	<li><a href="#">Lorem Ipsum</a></li>
					</ul>
				</div>
				<div class="col-xs-10 col-sm-3 col-md-3 col-lg-3 col-xs-offset-1 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
				    <ul>
						<li class="footer-title"><a href="#">Lorem Ipsum</a></li>
				    	<li><a href="#">Lorem Ipsum</a></li>
				    	<li><a href="#">Lorem Ipsum</a></li>
				    	<li><a href="#">Lorem Ipsum</a></li>
				    	<li><a href="#">Lorem Ipsum</a></li>
					</ul>
				</div>
				<div class="col-xs-10 col-sm-3 col-md-3 col-lg-3 col-xs-offset-1 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
				    <ul>
						<li class="footer-title"><a href="#">Lorem Ipsum</a></li>
				    	<li><a href="#">Lorem Ipsum</a></li>
				    	<li><a href="#">Lorem Ipsum</a></li>
				    	<li><a href="#">Lorem Ipsum</a></li>
				    	<li><a href="#">Lorem Ipsum</a></li>
					</ul>
				</div>
			</div>

		</footer>
	</div>

    <!-- Scripts -->
	<script>
	jQuery(document).ready(function($) {

	  $(window).scroll(function() {
	    var scrollPos = $(window).scrollTop(),
	        navbar = $('.hdnav');
			navbar2 = $('#perfil_leftgrid');

	    if (scrollPos > 1) {
	      navbar.addClass('head-opaque');
	    } else {
	      navbar.removeClass('head-opaque');
	    }
		if (scrollPos > 60) {
			 navbar2.addClass('profile-menu-open');
		}else{
			navbar2.removeClass('profile-menu-open');
		}
	  });
	});

	</script>

</body>

</html>
