
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Parvulario | Iniciar Sesión</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<link href="assets/css/material/app.min.css" rel="stylesheet" />
	
</head>
<body class="pace-top">
	
	<div id="page-loader" class="fade show">
		<div class="material-loader">
			<svg class="circular" viewBox="25 25 50 50">
				<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
			</svg>
			<div class="message">Loading...</div>
		</div>
	</div>
	
	
	
	<div id="page-container" class="fade">
		
		<div class="login login-with-news-feed">
			
			<div class="news-feed">
				<div class="news-image" style="background-image: url(../assets/img/user/login-bg-11.jpg)"></div>
				
			</div>
			
			
			<div class="right-content">
				
				<div class="login-header">
					<div class="brand">
						<span class="logo"></span> <b>Parvulario</b> Mundo del Saber
					</div>
					<div class="icon">
						<i class="fa fa-sign-in-alt"></i>
					</div>
				</div>
				
				
				<div class="login-content">
					<form action="{{ route('login') }}" method="POST" class="margin-bottom-0">
						@csrf
                        <div class="form-group m-b-20">
                            <label class="col-lg-1 text-lg-right col-form-label">USUARIO </label>
                            <input class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" type="text" name="email" placeholder="INGRESE AQUÍ SU USUARIO" value="{{ old('email') }}" required autocomplete="email" autofocus onkeyup="convertirEnMayusculas(this)" {{-- onkeypress="return solo_letras(event)" --}}>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
						<div class="form-group m-b-20">
                            <label class="col-lg-1 text-lg-right col-form-label">CONTRASEÑA </label>
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="INGRESE AQUÍ SU CONTRASEÑA" required autocomplete="current-password">
    
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
						<div class="checkbox checkbox-css m-b-30">
							<input type="checkbox" id="remember_me_checkbox" value="" />
							<label for="remember_me_checkbox">
							Recuérdame
							</label>
						</div>
						<div class="login-buttons">
							<button type="submit" class="btn btn-aqua btn-block btn-lg">Iniciar Sesión</button>
						</div>
						<div class="m-t-20 m-b-40 p-b-40 text-inverse">
							No recuerda la contraseña? Presione <a href="register_v3.html">aquí</a> para registrarse.
						</div>
						<hr />
						
					</form>
				</div>
				
			</div>
			
		</div>
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		
	</div>
	
	
	
	<script src="assets/js/app.min.js"></script>
	<script src="assets/js/theme/material.min.js"></script>
	
    <script>
		function convertirEnMayusculas(e){
			e.value = e.value.toUpperCase();
		}

		function solo_letras (e) {
			key=e.keyCode || e.which;
			teclado=String.fromCharCode(key).toLowerCase();
			letras_num="abcdefghijklmnñopqrstuvwxyz";
			especiales="8-37-38-46-164";
			teclado_especial=false;
			for (var i in especiales) {
				if (key==especiales[i]) {
					teclado_especial=true;break;
				}
			}
			if (letras_num.indexOf(teclado)==-1 && !teclado_especial) {
				return false;
			}
		}
	</script>
</body>
</html>