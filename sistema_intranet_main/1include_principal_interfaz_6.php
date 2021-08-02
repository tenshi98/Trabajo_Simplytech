<?php
/*****************************************************************************************************************/
/*                                               Transacciones                                                   */
/*****************************************************************************************************************/
//variable de numero de permiso
$x_nperm = 0;

//CrossCheking
$x_nperm++; $trans[$x_nperm] = "cross_solicitud_aplicacion_crear.php";          //01 - Solicitud Aplicacion - 01 Crear
$x_nperm++; $trans[$x_nperm] = "cross_solicitud_aplicacion_ejecutar.php";       //02 - Solicitud Aplicacion - 02 Programar
$x_nperm++; $trans[$x_nperm] = "cross_solicitud_aplicacion_ejecucion.php";      //03 - Solicitud Aplicacion - 03 Cerrar
$x_nperm++; $trans[$x_nperm] = "cross_solicitud_aplicacion_terminar.php";       //04 - Solicitud Aplicacion - 04 Verificar cierre
$x_nperm++; $trans[$x_nperm] = "cross_solicitud_aplicacion_borrar.php";         //05 - Solicitud Aplicacion - Borrar
$x_nperm++; $trans[$x_nperm] = "informe_cross_checking_06.php";                 //06 - 1 - Informe resumen de aplicaciones
$x_nperm++; $trans[$x_nperm] = "informe_cross_checking_05.php";                 //07 - 2 - Resumen Ejecutivo de aplicaciones
$x_nperm++; $trans[$x_nperm] = "informe_cross_checking_04.php";                 //08 - 3 - Trazabilidad y homogeneidad de aplicación
$x_nperm++; $trans[$x_nperm] = "informe_cross_checking_02.php";                 //09 - 4 - Informe monitoreo de dispositivos
$x_nperm++; $trans[$x_nperm] = "informe_cross_checking_01.php";                 //10 - 5 - Listado solicitudes de aplicaciones
$x_nperm++; $trans[$x_nperm] = "informe_cross_checking_03.php";                 //11 - 6 - Cuaderno de Campo - Exportador datos
$x_nperm++; $trans[$x_nperm] = "cross_checking_monitor_aplicaciones.php";       //12 - Monitor de Aplicaciones

//CrossC
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_errores_2.php";              //13 - Alerta Sensores
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_registro_sensores_4.php";    //14 - Exportar Datos
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_fuera_linea_2.php";          //15 - Fuera de Linea
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_registro_promedios_4.php";   //16 - Max – Min Camara 
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_registro_promedios_2.php";   //17 - Max – Min Sensor
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_registro_promedios_6.php";   //18 - Promedio Diario
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_registro_sensores_6.php";    //19 - Registro Camara 
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_registro_sensores_2.php";    //20 - Registro Sensores
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_registro_sensores_12.php";   //21 - Trazabilidad

//CrossTrack
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_errores_1.php";              //22 - Alerta Sensores
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_detenciones.php";            //23 - Detenciones
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_fuera_linea_1.php";          //24 - Fuera de Linea
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_fuera_geocerca_1.php";       //25 - Fuera de Linea
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_registro_kilometraje.php";   //26 - Kilometros Recorridos
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_registro_promedios_3.php";   //27 - Max – Min Camara
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_registro_promedios_1.php";   //28 - Max – Min Sensor
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_registro_promedios_5.php";   //29 - Promedio Diario
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_registro_sensores_5.php";    //30 - Registro Camara
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_registro_sensores_1.php";    //31 - Registro Sensores
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_registro_ruta.php";          //32 - Rutas Realizadas
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_registro_sensores_11.php";   //33 - Trazabilidad
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_registro_velocidad.php";     //34 - Velocidad
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_registro_sensores_3.php";    //35 - Exportar Datos

//CrossWeather
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_registro_sensores_13.php";   //36 - Exportar Datos

//CrossCrane
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_activaciones_05.php";        //37 - Activaciones Trabajo
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_uso_03.php";                 //38 - Uso Equipos
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_uso_04.php";                 //39 - Tiempo Motores
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_registro_sensores_17.php";   //40 - Trazabilidad Camara
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_errores_6.php";              //41 - Alerta Sensores

//CrossEnergy
$x_nperm++; $trans[$x_nperm] = "informe_telemetria_errores_7.php";              //42 - Alerta Sensores


//Genero los permisos
for ($i = 1; $i <= $x_nperm; $i++) {
	//Seteo la variable a 0
	$prm_x[$i] = 0;
	//recorro los permisos
	if(isset($_SESSION['usuario']['menu'])){
		foreach($_SESSION['usuario']['menu'] as $menu=>$productos) {
			foreach($productos as $producto) {
				//elimino los datos extras
				$str = str_replace("?pagina=1", "", $producto['TransaccionURL']);
				//le asigno el valor 1 en caso de que exista
				if($trans[$i]==$str){
					$prm_x[$i] = 1;
				}
			}
		}
	}
}

/*CrossChecking*/   $Tab_1 = $prm_x[1] + $prm_x[2] + $prm_x[3] + $prm_x[4] + $prm_x[5] + $prm_x[6] + $prm_x[7] + $prm_x[8] + $prm_x[9] + $prm_x[10] + $prm_x[11] + $prm_x[12];
/*CrossC*/          $Tab_2 = $prm_x[13] + $prm_x[14] + $prm_x[15] + $prm_x[16] + $prm_x[17] + $prm_x[18] + $prm_x[19] + $prm_x[20] + $prm_x[21];
/*CrossTrack*/      $Tab_3 = $prm_x[22] + $prm_x[23] + $prm_x[24] + $prm_x[25] + $prm_x[26] + $prm_x[27] + $prm_x[28] + $prm_x[29] + $prm_x[30] + $prm_x[31] + $prm_x[32] + $prm_x[33] + $prm_x[34] + $prm_x[35];
/*CrossWeather*/    $Tab_4 = $prm_x[36];
/*CrossWater*/      $Tab_5 = 0;
/*CrossCrane*/      $Tab_6 = $prm_x[37] + $prm_x[38] + $prm_x[39] + $prm_x[40] + $prm_x[41];
/*CrossEnergy*/     $Tab_7 = $prm_x[42];

/************************************************************************************/
// Listado con los nombres del tab
$arrTabMenu = array();
$arrTabMenu = db_select_array (false, 'idTab, Nombre', 'core_telemetria_tabs', '', '', 'Nombre ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrTabMenu');
//Recorro																						
foreach ($arrTabMenu as $tab) {
	$arrOrderTabMenu[$tab['idTab']] = $tab['Nombre'];
}
/*****************************************************************************************************************/
/*                                                Modelado                                                       */
/*****************************************************************************************************************/
?>
<style>
.noborderbox{border: none!important;-webkit-box-shadow: none!important;box-shadow: none!important;}
.noborderbox .header {background-color: #fff!important;color: #333!important;border-color: #ddd!important;}
.noborderbox .header .nav-tabs {border-bottom: 1px solid #ddd!important;}
.noborderbox .header .nav-tabs > li.active > a{color: #333 !important;border-color: #ddd!important;border-bottom-color: transparent!important;}
.noborderbox .header .nav-tabs > li > a {color: #665F5F !important;}
.noborderbox .header .nav-tabs > li > a:hover, .noborderbox .header .nav-tabs > li > a:focus {color: #fff !important;background-color: #2E2424;}
.noborderbox .header .nav-tabs > li.active > a:hover, .noborderbox .header .nav-tabs > li.active > a:focus{color: #333 !important;}
</style>
<style>
.tile {display: block;cursor: pointer;float: left;min-width: 75px;min-height: 75px;text-align: center;opacity: 0.9;background-color: #2e8bcc;z-index: 1;color: #ffffff;}
.tile h1,.tile h2,.tile h3,.tile h4,.tile h5,.tile h6 {color: #ffffff;-webkit-user-select: none;}
.tile h2 {margin-top: -20px;margin-left: 0px;}
.tile h3,.tile h4 {margin-top: -15px;}
.tile h1.tile-text,.tile h2.tile-text,.tile h3.tile-text,.tile h4.tile-text {margin-top: 20px;}
.tile h1 {font-size: 36px;}
.tile h2 {font-size: 30px;}
.tile h3 {font-size: 24px;}
.tile h4 {font-size: 18px;}
.tile a:hover {text-decoration: none;}
.tile img {border: 0;}
.tile:hover {opacity: 1;}
.tile .tile-label {position: absolute;bottom: 10px;left: 20px;font-size: 14px;color: #ffffff;text-align: left;}
.tile .tile-label img{width: 10%;}
.tile .tile-content {padding-top: 20px;line-height: normal;position: relative;width: 100%;-moz-box-sizing: border-box;box-sizing: border-box;}
.tile .tile-content img{width: 100%;}
.tile .tile-content .imgw{width: 70%;}
.tile .tile-content .imgx{width: 30%;}
.tile .tile-content .tile-icon-large {margin-left: 0px;vertical-align: middle !important;text-align: center;}
.tile .tile-content .tile-icon-large p{font-size: 16px;color: #222;}
.tile.color_1 {background-color: #FFD734;}
.tile.color_2 {background-color: #F47619;}
.tile.color_3 {background-color: #C6A664;}
.tile.color_4 {background-color: #C9DBED;}
.tile.color_5 {background-color: #00AADB;}
.tile.color_6 {background-color: #D1336C;}
.tile.color_7 {background-color: #79766C;}
.tile.color_8 {background-color: #8B00FF;}
.tile.tile-small {min-height: 70px;}
.tile.tile-medium {min-height: 200px;}
.tile.tile-large {min-height: 310px;}
.tile.tile-wide,.tile.tile-double {height: 150px;width: 310px;}
.btn-cotizar {color: #fff;background-color: #8b00ff;border-color: #8b00ff;}
.xtabtext {white-space: initial;}
</style>

<div class="">
	<div class="box noborderbox">
		<header class="header">
			<ul class="nav nav-tabs nav-center">
				<li class="active">           <a href="principal.php">Inicio</a></li>
				<?php if($Tab_2!=0){ ?><li>   <a href="principal_6_2.php"><?php echo $arrOrderTabMenu[2]; ?></a></li><?php } ?>
				<?php if($Tab_1!=0){ ?><li>   <a href="principal_6_1.php"><?php echo $arrOrderTabMenu[1]; ?></a></li><?php } ?>
				<?php if($Tab_6!=0){ ?><li>   <a href="principal_6_6.php"><?php echo $arrOrderTabMenu[6]; ?></a></li><?php } ?>
				<?php if($Tab_3!=0){ ?><li>   <a href="principal_6_3.php"><?php echo $arrOrderTabMenu[3]; ?></a></li><?php } ?>
				<?php if($Tab_5!=0){ ?><li>   <a href="principal_6_5.php"><?php echo $arrOrderTabMenu[5]; ?></a></li><?php } ?>
				<?php if($Tab_4!=0){ ?><li>   <a href="principal_6_4.php"><?php echo $arrOrderTabMenu[4]; ?></a></li><?php } ?>
				<?php if($Tab_7!=0){ ?><li>   <a href="principal_6_7.php"><?php echo $arrOrderTabMenu[9]; ?></a></li><?php } ?>
			</ul>	
		</header>
        <div class="tab-content">
			<div class="col-md-12 fcenter clearfix">
				<div class="col-md-8">
					<h1>¡Hola <?php echo $_SESSION['usuario']['basic_data']['Nombre'] ?>!</h1>
				</div>
				<div class="col-md-4">
					<p class="xtabtext">Bienvenido a CrossTech. Toma decisiones oportunas, rápidas
					y eficaces. Te apoyamos para que seas más eficiente en los procesos de medición.</p>
				</div>
			</div>
			
			<div class="col-md-12 fcenter">
				
				<a href="<?php if($Tab_2!=0){echo 'principal_6_2.php'; } ?>">
					<div class="tile color_1 tile-medium col-md-3 col-xs-12"  >
						<div class="tile-content">
							<div class="tile-icon-large">
								<img alt="User Picture" class="imgw" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/CrossC.png">
								<p><strong>Ambientes <br/>Controlados</strong></p>
							</div>
						</div>
						<span class="tile-label">
							<img alt="User Picture" class="imgw" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/tile_clima.png">
						</span>
					</div>
				</a>
				
				<a href="<?php if($Tab_1!=0){echo 'principal_6_1.php'; } ?>">
					<div class="tile color_2 tile-medium col-md-3 col-xs-12"  >
						<div class="tile-content">
							<div class="tile-icon-large">
								<img alt="User Picture" class="imgw" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/CrossChecking.png">
								<p><strong>Aplicaciones <br/>Agroquimicas</strong></p>
							</div>
						</div>
						<span class="tile-label">
							<img alt="User Picture" class="imgw" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/tile_tractor.png">
						</span>
					</div>
				</a>
				
				<a href="<?php if($Tab_6!=0){echo 'principal_6_6.php'; } ?>">
					<div class="tile color_3 tile-medium col-md-3 col-xs-12"  >
						<div class="tile-content">
							<div class="tile-icon-large">
								<img alt="User Picture" class="imgw" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/CrossCrane.png">
								<p><strong>Gruas de <br/>Construccion</strong></p>
							</div>
						</div>
						<span class="tile-label">
							<img alt="User Picture" class="imgw" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/tile_grua.png">
						</span>
					</div>
				</a>
				
				<a href="<?php if($Tab_3!=0){echo 'principal_6_3.php'; } ?>">
					<div class="tile color_4 tile-medium col-md-3 col-xs-12"  >
						<div class="tile-content">
							<div class="tile-icon-large">
								<img alt="User Picture" class="imgw" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/CrossTrack.png">
								<p><strong>Gestion de <br/>Flota GPS</strong></p>
							</div>
						</div>
						<span class="tile-label">
							<img alt="User Picture" class="imgw" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/tile_alfiler.png">
						</span>
					</div>
				</a>
				
				<a href="<?php if($Tab_4!=0){echo 'principal_6_4.php'; } ?>">
					<div class="tile color_5 tile-medium col-md-3 col-xs-12"  >
						<div class="tile-content">
							<div class="tile-icon-large">
								<img alt="User Picture" class="imgw" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/CrossWheather.png">
								<p><strong>Unidad <br/>Meteorologica</strong></p>
							</div>
						</div>
						<span class="tile-label">
							<img alt="User Picture" class="imgw" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/tile_wheater.png">
						</span>
					</div>
				</a>
				
				<a href="<?php if($Tab_7!=0){echo 'principal_6_7.php'; } ?>">
					<div class="tile color_6 tile-medium col-md-3 col-xs-12"  >
						<div class="tile-content">
							<div class="tile-icon-large">
								<img alt="User Picture" class="imgw" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/CrossEnergy.png">
								<p><strong>Consumo <br/>Eléctrico</strong></p>
							</div>
						</div>
						<span class="tile-label">
							<img alt="User Picture" class="imgw" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/tile_destello.png">
						</span>
					</div>
				</a>

				<div class="tile color_7 tile-medium col-md-3 col-xs-12"  >
					<div class="tile-content">
						<div class="tile-icon-large">
							<p style="color:#ffffff;"><strong>Asistencia <br/>Tecnica</strong></p>
							<a href="mailto:soporte@crosstech.cl?Subject=Asistencia"><img alt="User Picture" class="imgx" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/tile_asistencia_tecnica.png"></a>
						</div>
					</div>
				</div>
				
				<div class="tile color_8 tile-medium col-md-3 col-xs-12"  >
					<div class="tile-content">
						<div class="tile-icon-large">
							<p style="color:#ffffff;"><strong>Cotizar <br/>Servicio</strong></p>
							<a href="mailto:ventas@crosstech.cl?Subject=Cotizacion"><img alt="User Picture" class="imgx" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/tile_cotizar.png"></a>
						</div>
					</div>
				</div>
				
				
			</div>
			
			<div class="col-md-12 fcenter clearfix">
				<div class="col-md-8">
					<br/>
					<p class="xtabtext">
						Si tienes alguna consulta con tu servicio contratado, puedes escribirnos a soporte@crosstech.cl 
						y responderemos rápidamente a tus preguntas.
					</p>
				</div>
			</div>
			
			<div class="col-md-12 fcenter clearfix">
				<?php
				/******************************************************/
				//Widget Sociales
				if(isset($_SESSION['usuario']['basic_data']['Social_idUso'])&&$_SESSION['usuario']['basic_data']['Social_idUso']==1){
					echo widget_Social($_SESSION['usuario']['basic_data']['Social_facebook'],
										$_SESSION['usuario']['basic_data']['Social_twitter'],
										$_SESSION['usuario']['basic_data']['Social_instagram'],
										$_SESSION['usuario']['basic_data']['Social_linkedin'],
										$_SESSION['usuario']['basic_data']['Social_rss'],
										$_SESSION['usuario']['basic_data']['Social_youtube'],
										$_SESSION['usuario']['basic_data']['Social_tumblr']
										);
									
				}
				?>
			</div>
			
        </div>	
	</div>
</div>








