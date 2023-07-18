<style>
.formLogin .form-horizontal .form-group {margin-left: 0px;margin-right: 0px;}
.formLogin .formbox {background-color: #ffffff;border-radius: 3px;border: 1px solid #6F777F;}
.formLogin .formbox .leftPanel{height: 500px;background: linear-gradient(0deg, rgba(44, 62, 80,1) 0%, rgba(66, 86, 105,1) 100%);border-top-left-radius: 3px;border-bottom-left-radius: 3px;}
.formLogin .formbox .leftPanel .img-logo{margin-top:80px;}
.formLogin .formbox .leftPanel h2 {margin-top:80px;font-size: 2em;color: #fff;text-align: center;}
.formLogin .formbox .leftPanel h2 span {padding: 5px 0;border: solid #B6EDE3;border-top-width: medium;border-right-width: medium;border-bottom-width: medium;border-left-width: medium;border-width: 1px 0;}
.formLogin .formbox .leftPanel p {color: #fff;text-align: center;display: block;}
.formLogin .formbox .leftPanel .imgLeft{width: 100%;}
.formLogin .formbox .rightPanel ul{margin-top:20px;}
.formLogin .formbox .rightPanel ul .active{padding-bottom: 4px;border-bottom: 1px solid #043380;}
.formLogin .formbox .rightPanel .field{margin-bottom:5px;}
.formLogin .formbox .rightPanel .textRegister{margin-top:15px;margin-bottom:15px;}
</style>

<div class="formLogin col-md-6 fcenter clearfix">
	<div class="row formbox">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 leftPanel">
			<div class="row">
				<img src="<?php echo $nombre_fichero; ?>" alt="icon" width="80%" class="img-logo img-responsive center-block">
				<h2><span><?php echo DB_SOFT_NAME; ?></span></h2>
				<p><?php echo DB_SOFT_SLOGAN; ?></p>
				<img class="imgLeft" src="http://res.cloudinary.com/dpcloudinary/image/upload/v1506186248/dots.png" alt="icon" >
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 rightPanel" style="min-height: 400px;">

			<div class="text-center">
				<ul class="list-inline">
					<li class="active"> <a class="text-muted" href="#login"  data-toggle="tab" aria-expanded="true">Ingresar</a>  </li>
					<li class="">       <a class="text-muted" href="#forgot" data-toggle="tab" aria-expanded="false">Recuperar contraseña</a>  </li>
				</ul>
			</div>

			<div class="tab-content" style="min-height: 200px !important;">
				<div id="login" class="tab-pane active">
					<form class="" method="post"  name="form1" autocomplete="off" novalidate>
						<h1 class="text-center text-info">Iniciar sesión</h1>
						<p class="text-center color-gray-light">Ingrese su nombre de usuario y contraseña para acceder</p>
						<?php
						/******************************************/
						//Muestro los accesos erroneos
						if(isset($NAccesos)&&$NAccesos!=''){
							alert_post_data(4,1,1, $NAccesos.' Accesos erroneos de 5 disponibles');
						}

						/******************************************/
						//Se verifican si existen los datos
						if(isset($usuario)){    $x1  = $usuario;   }else{$x1  = '';}
						if(isset($password)){   $x2  = $password;  }else{$x2  = '';}

						//se dibujan los inputs
						$Form_Inputs = new Inputs();
						$Form_Inputs->input_login_usr('Usuario', 'usuario', $x1);
						$Form_Inputs->input('password','Contraseña', 'password', $x2, 2);
						$Form_Inputs->input_hidden('fkinput1', '', 1);

						//Boton Ingresar
						echo '<input type="submit" name="submit_login" class="btn btn-lg btn-primary btn-block fa-input" value="&#xf007; Iniciar sesión" />';
						//Boton registrar
						switch ($intRegistro) {
							//Mostrar
							case 1:
								echo '<p class="textRegister text-center color-gray-light">— O Tambien Puede —</p>';
								echo '<a href="registrar.php" class="btn btn-lg btn-success btn-block"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Registrarse</a>';
								break;
							//No se muestra
							case 2:
								break;
						}
						?>

					</form>
				</div>
				<div id="forgot" class="tab-pane">
					<form class="" method="post"  name="form2" autocomplete="off" novalidate>
						<h1 class="text-center text-info">¿Olvidaste tu contraseña?</h1>
						<p class="text-center color-gray-light">Ingresa tu Email para recuperar tu contraseña.Revisa la bandeja de entrada o spam de tu correo.</p>
						<?php
						//Se verifican si existen los datos
						if(isset($email)){    $x1  = $email;   }else{$x1  = '';}

						//se dibujan los inputs
						$Form_Inputs->input_login_mail('mimail@midominio.cl', 'email', $x1);

						$Form_Inputs->input_hidden('fkinput2', '', 1);
						?>

						<input type="submit" name="submit_pass" class="btn btn-lg btn-danger btn-block fa-input" value="&#xf003; Recuperar contraseña" />
					</form>
				</div>
			</div>

		</div>
	</div>
</div>

<!--Bootstrap -->
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
(function($) {
	$(document).ready(function() {
		$('.list-inline li > a').click(function() {
			var activeForm = $(this).attr('href') + ' > form';
			//console.log(activeForm);
			$(activeForm).addClass('animated fadeIn');
			//set timer to 1 seconds, after that, unload the animate animation
			setTimeout(function() {
			$(activeForm).removeClass('animated fadeIn');
			}, 1000);
		});
	});
})(jQuery);
</script>
