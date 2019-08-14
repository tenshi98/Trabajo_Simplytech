<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                  Funciones                                                      */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/
//construye el listado de errores
function notifications_list($errores){
	
	$despliegue = '<div id="notifications_list">Notificaciones <a id="close_btn_noti">cerrar</a>';
	
	if (!empty($errores)) {  
		foreach ($errores as $mensaje) { 
			list($tipo, $error) = explode("/", $mensaje);
			$despliegue .= '<p><img src="'.DB_SITE.'/Legacy/gestion_modular/img/icon_'.$tipo.'.png" height="24" width="24">  '.$error.'</p>';
		} 
	}

	$despliegue .= '</div>';
	
	$despliegue .= "<script type='text/javascript'>
						document.getElementById('close_btn_noti').addEventListener('click', function() {
							document.getElementById('notifications_list').style.display = 'none';
						}, false);
					</script>";
		
	return $despliegue;
}
/*******************************************************************************************************************/
//Muestra un explorador de archivos personalizado
function file_explorer($type, $conector, $emp_path, $id_emp, $prm){

	//generacion del input
	$input = '
		<style>
			.iframe_elfinder{height: 700px;}
			iframe{float:right;width: 100%;height: 100%;padding: 0;margin: 0;border:none;}
		</style>
			
		<div class="iframe_elfinder">
			<iframe class="embed-responsive-item" src="'.DB_SITE.'/LIBS_js/elFinder/index.php?type='.$type.'&conector='.$conector.'&emp_path='.$emp_path.'&id_emp='.$id_emp.'&prm='.$prm.'" allowfullscreen></iframe>
		</div>';
		
	//Imprimir dato	
	return $input;
}
/*******************************************************************************************************************/
//paginador
function paginador_1($total_paginas, $original, $search, $num_pag){
	$paginador='';
	

	//Verifico si hay mas de una pagina, sino coulto el paginador
	if($total_paginas>1){
	//Cargamos la ubicacion original
	$location = $original;
	$location .='?pagina=';

	$paginador .='<div class="row">
			<div class="contaux">
				<div class="dataTables_paginate paging_bootstrap">
					<ul class="pagination menucent">';
						if(($num_pag - 1) > 0) { 
							$paginador .='<li class="prev"><a href="'.$location.($num_pag-1).$search.'">← Anterior</a></li>';
						} else {
							$paginador .='<li class="prev disabled"><a href="">← Anterior</a></li>';
						} 
						
						if ($total_paginas>10){
							if(0>$num_pag-5){
								for ($i = 1; $i <= 10; $i++) { 
									if ($i==$num_pag){ $xx='class="active"';}else{ $xx='';}
									$paginador .='<li '.$xx.'><a href="'.$location.$i.$search.'">'.$i.'</a></li>';
								 }
							}elseif($total_paginas<$num_pag+5){
								for ($i = $num_pag-5; $i <= $total_paginas; $i++) {
									if ($i==$num_pag){ $xx='class="active"';}else{ $xx='';}
									$paginador .='<li '.$xx.'><a href="'.$location.$i.$search.'">'.$i.'</a></li>';
								 }	
							}else{
								for ($i = $num_pag-4; $i <= $num_pag+5; $i++) { 
									if ($i==$num_pag){ $xx='class="active"';}else{ $xx='';}
									$paginador .='<li '.$xx.'><a href="'.$location.$i.$search.'">'.$i.'</a></li>';
								}	
							}		
						}else{
							for ($i = 1; $i <= $total_paginas; $i++) { 
								if ($i==$num_pag){ $xx='class="active"';}else{ $xx='';}
								$paginador .='<li '.$xx.'><a href="'.$location.$i.$search.'">'.$i.'</a></li>';
							}
						}
						if(($num_pag + 1)<=$total_paginas) { 
							$paginador .='<li class="next"><a href="'.$location.($num_pag+1).$search.'">Siguiente → </a></li>';
						} else {
							$paginador .='<li class="next disabled"><a href="">Siguiente → </a></li>';
						} 
					$paginador .='</ul>
				</div> 
			</div>
		</div>';
	}	
	return $paginador; 
}
/*******************************************************************************************************************/
//paginador
function paginador_2($nombre, $total_paginas, $original, $search, $num_pag){
	$paginador='';
	

	//Verifico si hay mas de una pagina, sino coulto el paginador
	if($total_paginas>1){
	//Cargamos la ubicacion original
	$location = $original;
	$location .='?pagina=';

	$paginador .='
				<div id="dataTable_paginate" class="dataTables_paginate paging_simple_numbers fright">
					<ul class="pagination tablepag custom-pagination">';
						if(($num_pag - 1) > 0) { 
							$paginador .='<li class="prev"><a href="'.$location.($num_pag-1).$search.'"><i class="fa fa-angle-double-left"></i></a></li>';
						} else {
							$paginador .='<li class="prev disabled"><a href=""><i class="fa fa-angle-double-left"></i></a></li>';
						} 
						
						
						$paginador .='<li>
						<select class="form-control" id="'.$nombre.'" onchange="myFunction'.$nombre.'()">';
						for ($i = 1; $i <= $total_paginas; $i++) { 
							if ($i==$num_pag){ $xx='selected="selected"';}else{ $xx='';}
							$paginador .='<option value="'.$i.'" '.$xx.' >'.$i.'</option>';
						}
						$paginador .='</select>
						</li>
						<script>
							function myFunction'.$nombre.'() {
								var npage = document.getElementById("'.$nombre.'").value;
								window.location.href = "'.$location.'"+npage+"'.$search.'";
							}
						</script>';
						
						if(($num_pag + 1)<=$total_paginas) { 
							$paginador .='<li class="next"><a href="'.$location.($num_pag+1).$search.'"><i class="fa fa-angle-double-right"></i></a></li>';
						} else {
							$paginador .='<li class="next disabled"><a href=""><i class="fa fa-angle-double-right"></i></a></li>';
						} 
					$paginador .='</ul>
				</div>
				<div class="clearfix"></div>';
	}	
	return $paginador; 
}
/*******************************************************************************************************************/
//Muestra el nombre de la transaccion a solicitar
function widget_nombre($dato){
	switch ($dato) {
		case "tipo1": return 'Compras';                         break;//Compras
		case "tipo2": return 'Ventas';                          break;//Ventas
		case "tipo3": return 'Gastos';                          break;//Gastos
		case "tipo4": return 'Traspaso entre Bodegas';          break;//Traspaso entre Bodegas
		case "tipo5": return 'Transformacion';                  break;//Transformacion
		case "tipo6": return 'Traspaso otra empresa';           break;//Traspaso otra empresa
		case "tipo7": return 'Gasto de materiales OT';          break;//Gasto de materiales OT
		case "tipo8": return 'Traspaso Manual a otra Empresa';  break;//Traspaso Manual a otra Empresa
		case "tipo9": return 'Ingreso Manual';                  break;//Ingreso Manual
			
	}							
}
/*******************************************************************************************************************/
//Muestra el nombre de la transaccion a solicitar
function widget_pagina($dato, $type){
	
	//bodegas de productos
	if($type==1){
		switch ($dato) {
			case "tipo1": return 'bodegas_productos_ingreso.php?pagina=1';                  break;//Compras
			case "tipo2": return 'bodegas_productos_egreso.php?pagina=1';                   break;//Ventas
			case "tipo3": return 'bodegas_productos_gasto.php?pagina=1';                    break;//Gastos
			case "tipo4": return 'bodegas_productos_traspaso.php?pagina=1';                 break;//Traspaso entre Bodegas
			case "tipo5": return 'bodegas_productos_transformacion.php?pagina=1';           break;//Transformacion
			case "tipo6": return 'bodegas_productos_traspaso_empresa.php?pagina=1';         break;//Traspaso otra empresa
			case "tipo7": return 'bodegas_productos_egreso_ot.php?pagina=1';                break;//Gasto de materiales OT
			case "tipo8": return 'bodegas_productos_traspaso_empresa_manual.php?pagina=1';  break;//Traspaso Manual a otra Empresa
			case "tipo9": return 'bodegas_productos_ingreso_manual.php?pagina=1';           break;//Ingreso Manual
				
		}
	//bodegas de insumos
	}elseif($type==2){
		switch ($dato) {
			case "tipo1": return 'bodegas_insumos_ingreso.php?pagina=1';                  break;//Compras
			case "tipo2": return 'bodegas_insumos_ventas.php?pagina=1';                   break;//Ventas
			case "tipo3": return 'bodegas_insumos_egreso.php?pagina=1';                   break;//Gastos
			case "tipo4": return 'bodegas_insumos_traspaso.php?pagina=1';                 break;//Traspaso entre Bodegas
			case "tipo5": return '';                                                      break;//Transformacion
			case "tipo6": return 'bodegas_insumos_traspaso_empresa.php?pagina=1';         break;//Traspaso otra empresa
			case "tipo7": return 'bodegas_insumos_egreso_ot.php?pagina=1';                break;//Gasto de materiales OT	
			case "tipo8": return 'bodegas_insumos_traspaso_empresa_manual.php?pagina=1';  break;//Traspaso Manual a otra Empresa	
			case "tipo9": return 'bodegas_insumos_ingreso_manual.php?pagina=1';           break;//Ingreso Manual
			
		}
	//bodegas de arriendos	
	}elseif($type==3){
		switch ($dato) {
			case "tipo1": return 'bodegas_arriendos_ingreso.php?pagina=1';                break;//Compras
			case "tipo2": return 'bodegas_arriendos_egreso.php?pagina=1';                 break;//Ventas
		}
	//bodegas de servicios	
	}elseif($type==4){
		switch ($dato) {
			case "tipo1": return 'bodegas_servicios_ingreso.php?pagina=1';                break;//Compras
			case "tipo2": return 'bodegas_servicios_egreso.php?pagina=1';                 break;//Ventas
		}
	}							
}
/*******************************************************************************************************************/
//Muestra el nombre de la transaccion a solicitar
function widget_barcolor($dato){
	switch ($dato) {
		case "tipo1": return '#FF6961';   break;//Compras
		case "tipo2": return '#779ECB';   break;//Ventas
		case "tipo3": return '#836953';   break;//Gastos
		case "tipo4": return '#B19CD9';   break;//Traspaso entre Bodegas
		case "tipo5": return '#AEC6CF';   break;//Transformacion
		case "tipo6": return '#77DD77';   break;//Traspaso otra empresa
		case "tipo7": return '#CFCFC4';   break;//Gasto de materiales OT
		case "tipo8": return '#B39EB5';   break;//Traspaso Manual a otra Empresa
		case "tipo9": return '#FFB347';   break;//Ingreso Manual
			
	}							
}
/*******************************************************************************************************************/
//Muestra el nombre de la transaccion a solicitar
function widget_widgetcolor($dato){
	switch ($dato) {
		case "tipo1": return 'bg-pastel_red';             break;//Compras
		case "tipo2": return 'bg-dark_pastel_blue';       break;//Ventas
		case "tipo3": return 'bg-pastel_brown';           break;//Gastos
		case "tipo4": return 'bg-light_pastel_purple';    break;//Traspaso entre Bodegas
		case "tipo5": return 'bg-pastel_blue';            break;//Transformacion
		case "tipo6": return 'bg-pastel_green';           break;//Traspaso otra empresa
		case "tipo7": return 'bg-pastel_gray';            break;//Gasto de materiales OT
		case "tipo8": return 'bg-pastel_purple';          break;//Traspaso Manual a otra Empresa
		case "tipo9": return 'bg-pastel_orange';          break;//Ingreso Manual
			
	}							
}
/*******************************************************************************************************************/
//Muestra los widget de acceso comun			
function widget_comunes($com_tras, $Wheater, $NombreUsuario, $Notificacion,$CuentaContactos,$CuentaEventos){
	
	$comunes='
	<div class="row">
		
		<script src="'.DB_SITE.'/Legacy/gestion_modular/lib/weather/jquery.simpleWeather.js"></script>
		<script src="'.DB_SITE.'/Legacy/gestion_modular/lib/skycons/skycons.js"></script>

		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="info-box bg-aqua" id="weather">
			</div>
		</div>';
		
		$comuna = 'Santiago';
		if(isset($com_tras)&&$com_tras!=''){$comuna = $com_tras;}
		
		$comunes.='
		<script>
				$(document).ready(function() {
				  $.simpleWeather({
					location: \''.$comuna.', Chile\',
					woeid: \'\',
					unit: \'c\',
					success: function(weather) {
						
						var meteo;
						switch (weather.code) {
							case \'1\':
							case \'2\':
							case \'3\':
							case \'4\':
							case \'37\':
							case \'38\':
							case \'39\':
							case \'45\':
							case \'47\':
								meteo = "rain";
								break;
								
							case \'5\':
							case \'6\':
							case \'7\':
							case \'8\':
							case \'10\':
							case \'15\':
							case \'17\':
							case \'18\':
							case \'35\':
							case \'40\':
							case \'42\':
							case \'43\':
							case \'46\':
								meteo = "sleet";
								break;
							
							
							case \'9\':
							case \'11\':
							case \'12\':
							case \'13\':
							case \'14\':
							case \'16\':
							case \'42\':
								meteo = "snow";
								break;
								
							case \'19\':
							case \'20\':
							case \'21\':
							case \'22\':
							case \'23\':
								meteo = "fog";
								break;
								
							case \'19\':
							case \'20\':
							case \'21\':
							case \'22\':
							case \'23\':
								meteo = "fog";
								break;
								
							case \'24\':
							case \'25\':
								meteo = "wind";
								break;    
									
							case \'27\':
							case \'29\':
							case \'44\':
								meteo = "partly-cloudy-night";
								break; 
								
							case \'28\':
							case \'30\':
								meteo = "wind";
								break;
								
							case \'31\':
							case \'33\':
								meteo = "clear-night";
								break;    
									
							case \'32\':
							case \'34\':
							case \'36\':
								meteo = "clear-day";
								break;
								
							case \'26\':
								meteo = "cloudy";
								break;
											 
						}
						
						html  = \'<span class="info-box-icon"><canvas id="\'+meteo+\'" width="64" height="64" style="margin-top:12px;"></canvas></span>\';
						html += \'<div class="info-box-content">\';
						html += \'	<span class="info-box-text">El Tiempo</span>\';
						html += \'	<span class="info-box-number">\'+weather.temp+\'&deg;\'+weather.units.temp+\'</span>\';
						html += \'	<div class="progress">\';
						html += \'		<div class="progress-bar" style="width: 100%"></div>\';
						html += \'	</div>\';
						html += \'	<span class="progress-description">\';
						html += \'		<a target="_blank" href="'.$Wheater.'">\';
						html += \'         '.$comuna.', Chile\';
						html += \'		</a>\';
						html += \'	</span>\';
						html += \'</div>\';
				
					  $("#weather").html(html);
					  //agrego los icono animados
					  var icons = new Skycons({"color": "white"}),
						  list  = [
							"clear-day", "clear-night", "partly-cloudy-day",
							"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
							"fog"
						  ],
						  i;

					  for(i = list.length; i--; )
						icons.set(list[i], list[i]);

					  icons.play();
					  
					},
					error: function(error) {
					  $("#weather").html(\'<p>\'+error+\'</p>\');
					}
				  });
				});
			</script>
			
			
			
		
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="info-box bg-green">
				<span class="info-box-icon"><i class="fa fa-user"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Perfil</span>
					<span class="info-box-number">'.$NombreUsuario.'</span>
					<div class="progress">
						<div class="progress-bar" style="width: 100%"></div>
					</div>
					<span class="progress-description">
						<a class="faa-parent animated-hover" href="principal_datos.php">
							Editar Mis Datos
							<i class="fa fa-arrow-circle-right faa-passing"></i>
						</a>
					</span>
				</div>
			</div>
		</div>';
		
		$animated = '';
		if($Notificacion!=0){ $animated = 'faa-horizontal animated'; }
		
		
		$comunes.='
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="info-box bg-yellow">
				<span class="info-box-icon"><i class="fa fa-commenting-o '.$animated.'" ></i><br/></span>
				<div class="info-box-content">
					<span class="info-box-text">Notificaciones</span>
					<span class="info-box-number">'.$Notificacion.' sin leer</span>
					<div class="progress">
						<div class="progress-bar" style="width: 100%"></div>
					</div>
					<span class="progress-description">
						<a class="faa-parent animated-hover" href="principal_notificaciones.php?pagina=1">
							Ver Notificaciones
							<i class="fa fa-arrow-circle-right faa-passing"></i>
						</a>
					</span>
				</div>
			</div>
		</div>
	 
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="info-box bg-red">
				<span class="info-box-icon"><i class="fa fa-question"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Archivos de ayuda</span>
					<span class="info-box-number">Archivos</span>
					<div class="progress">
						<div class="progress-bar" style="width: 100%"></div>
					</div>
					<span class="progress-description">
						<a class="faa-parent animated-hover" href="principal_ayuda.php?pagina=1">
							Ver Archivos
							<i class="fa fa-arrow-circle-right faa-passing"></i>
						</a>
					</span>
				</div>
			</div>
		</div>
		
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="info-box bg-purple">
				<span class="info-box-icon"><i class="fa fa-file-word-o"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Procedimientos</span>
					<span class="info-box-number">Archivos</span>
					<div class="progress">
						<div class="progress-bar" style="width: 100%"></div>
					</div>
					<span class="progress-description">
						<a class="faa-parent animated-hover" href="principal_procedimientos.php?pagina=1">
							Ver Procedimientos
							<i class="fa fa-arrow-circle-right faa-passing"></i>
						</a>
					</span>
				</div>
			</div>
		</div>
		
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="info-box bg-black">
				<span class="info-box-icon"><i class="fa fa-phone"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Contactos</span>
					<span class="info-box-number">'.$CuentaContactos.' Contactos</span>
					<div class="progress">
						<div class="progress-bar" style="width: 100%"></div>
					</div>
					<span class="progress-description">
						<a class="faa-parent animated-hover" href="principal_agenda_telefonica.php?pagina=1">
							Ver Contactos
							<i class="fa fa-arrow-circle-right faa-passing"></i>
						</a>
					</span>
				</div>
			</div>
		</div>
		
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="info-box bg-aqua">
				<span class="info-box-icon"><i class="fa fa-calendar"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Calendario</span>
					<span class="info-box-number">'.$CuentaEventos.' Este Mes</span>
					<div class="progress">
						<div class="progress-bar" style="width: 100%"></div>
					</div>
					<span class="progress-description">
						<a class="faa-parent animated-hover" href="principal_calendario.php?pagina=1">
							Ver Eventos
							<i class="fa fa-arrow-circle-right faa-passing"></i>
						</a>
					</span>
				</div>
			</div>
		</div> 
		
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="info-box bg-green">
				<span class="info-box-icon"><i class="fa fa-desktop"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Programas Recomendados</span>
					<span class="info-box-number">0 Programas</span>
					<div class="progress">
						<div class="progress-bar" style="width: 100%"></div>
					</div>
					<span class="progress-description">
						<a class="faa-parent animated-hover" href="principal_software.php?pagina=1">
							Ver Programas
							<i class="fa fa-arrow-circle-right faa-passing"></i>
						</a>
					</span>
				</div>
			</div>
		</div> 
		
		
		
			
	</div>';
	

	return $comunes; 
}
/*******************************************************************************************************************/
//Muestra los widget de acceso especificos	
function widget_especificos($idTipoUsuario,
							$n_link_1,$link_1,$cant_link_1,
							$n_link_2,$link_2,$cant_link_2,
							$n_link_3,$link_3,$cant_link_3,
							$n_link_4,$link_4,$cant_link_4){
	
	$especificos='
	<div class="row">';
		
		/*****************************************************************************************************************/
		/*                                         Administracion de clientes                                            */
		/*****************************************************************************************************************/
		if($n_link_1=='1' or $idTipoUsuario==1) {
			$especificos.='
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="small-box btn-primary">
					<div class="innerbox">
						<h3>'.$cant_link_1.'</h3>
						<p>Clientes</p>
					</div>
					<div class="icon">
						<i class="fa fa-user"></i>
					</div>
					<a href="'.$link_1.'?pagina=1" class="small-box-footer faa-parent animated-hover">
						Administrar <i class="fa fa-arrow-circle-right faa-passing"></i>
					</a>
				</div>
			</div>';
		}
		/*****************************************************************************************************************/
		/*                                         Administracion de Usuarios                                            */
		/*****************************************************************************************************************/
		if($n_link_2=='1' or $idTipoUsuario==1) {  
			$especificos.='
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="small-box bg-green">
					<div class="innerbox">
						<h3>'.$cant_link_2.'</h3>
						<p>Usuarios</p>
					</div>
					<div class="icon">
						<i class="fa fa-users"></i>
					</div>
					<a href="'.$link_2.'?pagina=1" class="small-box-footer faa-parent animated-hover">
						Administrar <i class="fa fa-arrow-circle-right faa-passing"></i>
					</a>
				</div>
			</div>';
		}
		/*****************************************************************************************************************/
		/*                                        Administracion de Proveedores                                          */
		/*****************************************************************************************************************/
		if($n_link_3=='1' or $idTipoUsuario==1) {  
			$especificos.='
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="small-box bg-yellow">
					<div class="innerbox">
						<h3>'.$cant_link_3.'</h3>
						<p>Proveedores</p>
					</div>
					<div class="icon">
						<i class="fa fa-truck"></i>
					</div>
					<a href="'.$link_3.'?pagina=1" class="small-box-footer faa-parent animated-hover">
						Administrar <i class="fa fa-arrow-circle-right faa-passing"></i>
					</a>
				</div>
			</div>';
		}
		/*****************************************************************************************************************/
		/*                                      Administracion de Trabajadores                                           */
		/*****************************************************************************************************************/
		if($n_link_4=='1' or $idTipoUsuario==1) {   
			$especificos.='
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="small-box bg-red">
					<div class="innerbox">
						<h3>'.$cant_link_4.'</h3>
						<p>Trabajadores</p>
					</div>
					<div class="icon">
						<i class="fa fa-male"></i>
					</div>
					<a href="'.$link_4.'?pagina=1" class="small-box-footer faa-parent animated-hover">
						Administrar <i class="fa fa-arrow-circle-right faa-passing"></i>
					</a>
				</div>
			</div>';
		}
		
	
	$especificos.='      
	</div>';
	
	
	
	return $especificos; 
}	
/*******************************************************************************************************************/
//Muestra los widget de acceso a recordatorios	
function widget_recordatorios($idTipoUsuario,
							  $n_link_1,$cant_link_1,
							  $n_link_2,$cant_link_2,
							  $n_link_3,$cant_link_3,
							  $n_link_4,$cant_link_4a,$cant_link_4b,
							  $n_link_5,$cant_link_5,
							  $n_link_6,$cant_link_6,
							  $n_link_7,$cant_link_7,
							  $n_link_8,$cant_link_8){
	
	$recordatorios = '';
	/////////////////////////////////////////////////////////////////////////////////////
	$recordatorios .= '<h3 class="supertittle text-primary">Recordatorios</h3>';
	$recordatorios .= '<div class="row">';
		/*****************************************************************************************************************/
		/*                                       Cargas por vencer esta semana                                           */
		/*****************************************************************************************************************/
		if($n_link_1=='1' or $idTipoUsuario==1) {
			$recordatorios.='
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="info-box bg-aqua">
					<span class="info-box-icon"><i class="fa fa-usd"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Cargas por Vencer</span>
						<span class="info-box-number">'.$cant_link_1.' Esta Semana</span>
						<div class="progress">
							<div class="progress-bar" style="width: 100%"></div>
						</div>
						<span class="progress-description">
							<a class="faa-parent animated-hover" href="principal_cargas.php?pagina=1">
								Ver Cargas
								<i class="fa fa-arrow-circle-right faa-passing"></i>
							</a>
						</span>
					</div>
				</div>
			</div>';
		}
		/*****************************************************************************************************************/
		/*                                       Solicitudes sin OC Asignada                                             */
		/*****************************************************************************************************************/
		if($n_link_2=='1' or $idTipoUsuario==1) {
			$recordatorios.='
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="info-box bg-green">
					<span class="info-box-icon"><i class="fa fa-cube"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Solicitudes sin OC</span>
						<span class="info-box-number">'.$cant_link_2.' Sin Asignar</span>
						<div class="progress">
							<div class="progress-bar" style="width: 100%"></div>
						</div>
						<span class="progress-description">
							<a class="faa-parent animated-hover" href="ocompra_generacion.php">
								Ver Solicitudes
								<i class="fa fa-arrow-circle-right faa-passing"></i>
							</a>
						</span>
					</div>
				</div>
			</div>';
		}
		
		/*****************************************************************************************************************/
		/*                                             OC sin Aprobar                                                    */
		/*****************************************************************************************************************/
		if($n_link_3=='1' or $idTipoUsuario==1) {
			$recordatorios.='
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="info-box bg-yellow">
					<span class="info-box-icon"><i class="fa fa-database"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">OC sin Aprobar</span>
						<span class="info-box-number">'.$cant_link_3.' Pendientes</span>
						<div class="progress">
							<div class="progress-bar" style="width: 100%"></div>
						</div>
						<span class="progress-description">
							<a class="faa-parent animated-hover" href="ocompra_listado_sin_aprobar.php?pagina=1">
								Ver OC sin Aprobar
								<i class="fa fa-arrow-circle-right faa-passing"></i>
							</a>
						</span>
					</div>
				</div>
			</div>';
		}
	$recordatorios.='</div>';
	/////////////////////////////////////////////////////////////////////////////////////
	$recordatorios .= '<h3 class="supertittle text-primary">Compras</h3>';
	$recordatorios .= '<div class="row">';
		/*****************************************************************************************************************/
		/*                                       Facturas a pagar o retrasadas                                           */
		/*****************************************************************************************************************/
		if($n_link_4!='0' or $idTipoUsuario==1) {
			if($cant_link_4b!=0){
				$recordatorios.='
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="info-box bg-red">
						<span class="info-box-icon"><i class="fa fa-cc-paypal" aria-hidden="true"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Facturas atrasadas</span>
							<span class="info-box-number">'.$cant_link_4b.' Pago Atrasado</span>
							<div class="progress">
								<div class="progress-bar" style="width: 100%"></div>
							</div>
							<span class="progress-description">
								<a class="faa-parent animated-hover" href="principal_facturas.php?pagina=1&idTipo=1">
									Ver Facturas
									<i class="fa fa-arrow-circle-right faa-passing"></i>
								</a>
							</span>
						</div>
					</div>
				</div>';
			}else{
				$recordatorios.='
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="info-box bg-black">
						<span class="info-box-icon"><i class="fa fa-cc-paypal" aria-hidden="true"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Facturas x Pagar</span>
							<span class="info-box-number">'.$cant_link_4a.' Esta Semana</span>
							<div class="progress">
								<div class="progress-bar" style="width: 100%"></div>
							</div>
							<span class="progress-description">
								<a class="faa-parent animated-hover" href="principal_facturas.php?pagina=1&idTipo=1">
									Ver Facturas
									<i class="fa fa-arrow-circle-right faa-passing"></i>
								</a>
							</span>
						</div>
					</div>
				</div>';
			}
		}
		
		/*****************************************************************************************************************/
		/*                                     Arriendos por vencer esta semana                                          */
		/*****************************************************************************************************************/
		if($n_link_5=='1' or $idTipoUsuario==1) {
			$recordatorios.='
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="info-box bg-yellow">
					<span class="info-box-icon"><i class="fa fa-calendar-o"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Devolucion Arriendos</span>
						<span class="info-box-number">'.$cant_link_5.' Devoluciones</span>
						<div class="progress">
							<div class="progress-bar" style="width: 100%"></div>
						</div>
						<span class="progress-description">
							<a class="faa-parent animated-hover" href="principal_arriendos.php?pagina=1&idTipo=1">
								Ver Devolucion Arriendos
								<i class="fa fa-arrow-circle-right faa-passing"></i>
							</a>
						</span>
					</div>
				</div>
			</div>';
		}
		/*****************************************************************************************************************/
		/*                                          Documentos por pagar                                                 */
		/*****************************************************************************************************************/
		if($n_link_8!=0 or $idTipoUsuario==1) {
			$recordatorios.='
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="info-box bg-aqua">
					<span class="info-box-icon"><i class="fa fa-credit-card"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Documentos por Pagar</span>
						<span class="info-box-number">'.$cant_link_8.' Esta Semana</span>
						<div class="progress">
							<div class="progress-bar" style="width: 100%"></div>
						</div>
						<span class="progress-description">
							<a class="faa-parent animated-hover" href="principal_cheques_pagar.php?pagina=1">
								Ver Documentos
								<i class="fa fa-arrow-circle-right faa-passing"></i>
							</a>
						</span>
					</div>
				</div>
			</div>';
		}
	$recordatorios.='</div>';
	/////////////////////////////////////////////////////////////////////////////////////
	$recordatorios .= '<h3 class="supertittle text-primary">Ventas</h3>';
	$recordatorios .= '<div class="row">';
		/*****************************************************************************************************************/
		/*                                            Facturas a Cobrar                                                  */
		/*****************************************************************************************************************/
		if($n_link_6!='0' or $idTipoUsuario==1) {
		
			$recordatorios.='
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="info-box bg-black">
						<span class="info-box-icon"><i class="fa fa-cc-paypal" aria-hidden="true"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Facturas x Cobrar</span>
							<span class="info-box-number">'.$cant_link_6.' Esta Semana</span>
							<div class="progress">
								<div class="progress-bar" style="width: 100%"></div>
							</div>
							<span class="progress-description">
								<a class="faa-parent animated-hover" href="principal_facturas.php?pagina=1&idTipo=2">
									Ver Facturas
									<i class="fa fa-arrow-circle-right faa-passing"></i>
								</a>
							</span>
						</div>
					</div>
				</div>';
			
		}
		/*****************************************************************************************************************/
		/*                                     Arriendos por vencer esta semana                                          */
		/*****************************************************************************************************************/
		if($n_link_7=='1' or $idTipoUsuario==1) {
			$recordatorios.='
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="info-box bg-yellow">
					<span class="info-box-icon"><i class="fa fa-calendar-o"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Devolucion Arriendos</span>
						<span class="info-box-number">'.$cant_link_7.' Devoluciones</span>
						<div class="progress">
							<div class="progress-bar" style="width: 100%"></div>
						</div>
						<span class="progress-description">
							<a class="faa-parent animated-hover" href="principal_arriendos.php?pagina=1&idTipo=2">
								Ver Devolucion Arriendos
								<i class="fa fa-arrow-circle-right faa-passing"></i>
							</a>
						</span>
					</div>
				</div>
			</div>';
		}
	$recordatorios.='</div>';
		
		
		
		
	

	
	
	
	return $recordatorios; 
}	
/*******************************************************************************************************************/
//Despliega un detalle de las bodegas
function widget_bodega($titulo, 
					   $bodega, $bodega_existencia, $bodega_tipo, 
					   $producto, $uml, $required,$type,
					   $enlace,$dbConn,
					   $tablaPermiso, $idSistema){
	
	/***********************************************************/
	//Se limitan los permisos a las bodegas asignadas
	if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
		//$x1 ="idSistema>=0";
		$x2 ="idUsuario>=0";		
	}else{
		//$x1 ="idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	
		$x2 ="idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
	}
	$x1 ="idSistema=".$idSistema;
	//Variables
	$join_1  = "";
	$where_1 = "";
	//Si existe el dato de la tabla
	if($tablaPermiso!=''){
		$join_1  = "INNER JOIN ".$tablaPermiso." ON ".$tablaPermiso.".idBodega = ".$bodega_existencia.".idBodega";
		$where_1 = " AND ".$bodega_existencia.".".$x1." AND ".$tablaPermiso.".".$x2."";
	}
	

		
		
	//Variable
	$Graficos = '';
	
	
	

	/***********************************************************/
	// Se trae un listado con los valores de las existencias actuales
	$año_pasado = ano_actual()-1;
	if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
		$z = "WHERE idSistema>=0";
		$z.= " AND Creacion_ano >= ".$año_pasado;
	}else{
		$z = "WHERE idSistema='{$_SESSION['usuario']['basic_data']['idSistema']}'";
		$z.= " AND Creacion_ano >= ".$año_pasado;
	}
	//se consulta
	$arrExistencias = array();
	$query = "SELECT Creacion_ano,Creacion_mes,Cantidad_ing,Cantidad_eg,idTipo,SUM(ValorTotal) AS Valor
	FROM `".$bodega_existencia."`
	".$join_1."
	".$z."
	".$where_1."
	GROUP BY Creacion_ano,Creacion_mes,idTipo
	ORDER BY Creacion_ano ASC, Creacion_mes ASC";
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	//Si ejecuto correctamente la consulta
	if(!$resultado){
		//Genero numero aleatorio
		$vardata = genera_password(8,'alfanumerico');
					
		//Guardo el error en una variable temporal
		$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
		$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
		$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
	}
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrExistencias,$row );
	}
	
	/***********************************************************/
	//Se verifica si existe tabla relacionada a los permisos
	if(isset($uml)&&$uml!=''&&$uml!='0'){
		// Se trae un listado con todos los movimientos de bodega
		if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
			$z = " AND ".$bodega_existencia.".idSistema>=0";
		}else{
			$z = " AND ".$bodega_existencia.".idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";
		}
		//se consulta
		$arrMovimientos = array();
		$query = "SELECT 
		".$bodega_existencia.".Creacion_fecha,
		".$bodega_existencia.".Cantidad_ing,
		".$bodega_existencia.".Cantidad_eg,
		".$bodega_existencia.".idFacturacion,
		".$bodega_tipo.".Nombre AS TipoMovimiento,
		".$producto.".Nombre AS NombreProducto,
		".$uml.".Nombre AS UnidadMedida,
		".$bodega.".Nombre AS NombreBodega

		FROM `".$bodega_existencia."`
		LEFT JOIN `".$bodega_tipo."`  ON ".$bodega_tipo.".idTipo    = ".$bodega_existencia.".idTipo
		LEFT JOIN `".$producto."`     ON ".$producto.".idProducto   = ".$bodega_existencia.".idProducto
		LEFT JOIN `".$uml."`          ON ".$uml.".idUml             = ".$producto.".idUml
		LEFT JOIN `".$bodega."`       ON ".$bodega.".idBodega       = ".$bodega_existencia.".idBodega
		".$join_1."
		
		WHERE ".$bodega_existencia.".Creacion_ano=".ano_actual()."
		".$z."
		".$where_1."
		ORDER BY ".$bodega_existencia.".Creacion_fecha DESC 
		LIMIT 10";
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
		//Si ejecuto correctamente la consulta
		if(!$resultado){
			//Genero numero aleatorio
			$vardata = genera_password(8,'alfanumerico');
						
			//Guardo el error en una variable temporal
			$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
			$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
			$_SESSION['ErrorListing'][$vardata]['query']        = $query;
						
		}
		while ( $row = mysqli_fetch_assoc ($resultado)) {
		array_push( $arrMovimientos,$row );
		}
		
		/***********************************************************/
		//Productos con bajo stock
		$arrProductos = array();
		$query = "SELECT
		".$producto.".StockLimite,
		".$producto.".Nombre AS NombreProd,
		".$uml.".Nombre AS UnidadMedida,
		(SELECT SUM(Cantidad_ing) FROM ".$bodega_existencia." WHERE idProducto = ".$producto.".idProducto AND idSistema = {$_SESSION['usuario']['basic_data']['idSistema']} ) AS stock_entrada,
		(SELECT SUM(Cantidad_eg)  FROM ".$bodega_existencia." WHERE idProducto = ".$producto.".idProducto AND idSistema = {$_SESSION['usuario']['basic_data']['idSistema']} ) AS stock_salida
		FROM `".$producto."`
		LEFT JOIN `".$uml."` ON ".$uml.".idUml = ".$producto.".idUml
		WHERE ".$producto.".StockLimite >0  
		ORDER BY ".$producto.".StockLimite DESC, ".$producto.".Nombre ASC
		LIMIT 10";
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
		//Si ejecuto correctamente la consulta
		if(!$resultado){
			//Genero numero aleatorio
			$vardata = genera_password(8,'alfanumerico');
						
			//Guardo el error en una variable temporal
			$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
			$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
			$_SESSION['ErrorListing'][$vardata]['query']        = $query;
						
		}
		while ( $row = mysqli_fetch_assoc ($resultado)) {
		array_push( $arrProductos,$row );
		} 
	}
	
	
	/***********************************************************/
	//Calculo para los graficos
	$mes = array();
	foreach ($arrExistencias as $existencias) { 
		//se crean las variables con valor 0
		if(!isset($mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo1'])){   $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo1']  = 0;}
		if(!isset($mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo2'])){   $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo2']  = 0;}
		if(!isset($mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo3'])){   $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo3']  = 0;}
		if(!isset($mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo4'])){   $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo4']  = 0;}
		if(!isset($mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo5'])){   $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo5']  = 0;}
		if(!isset($mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo6'])){   $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo6']  = 0;}
		if(!isset($mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo7'])){   $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo7']  = 0;}
		if(!isset($mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo8'])){   $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo8']  = 0;}
		if(!isset($mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo9'])){   $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo9']  = 0;}
		
		//se comienza a guardar los datos	
		switch ($existencias['idTipo']) {
			//Compra de Productos a bodega
			case 1:
				$mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo1'] = $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo1'] + $existencias['Valor'];
				break;
										
			//Venta de Productos de bodega
			case 2:
				$mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo2'] = $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo2'] + $existencias['Valor'];
				break;
										
			//Gasto de Productos
			case 3:
				$mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo3'] = $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo3'] + $existencias['Valor'];
				break;
			
			//Traspaso de Productos entre bodegas
			case 4:
				$mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo4'] = $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo4'] + $existencias['Valor'];
				break;
										
			//Transformacion de Productos
			case 5:
				$mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo5'] = $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo5'] + $existencias['Valor'];
				break;
										
			//Traspaso de Productos a otra Empresa
			case 6:
				if($existencias['Cantidad_ing']!=0){
					$mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo1'] = $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo1'] + $existencias['Valor'];
				}else{
					$mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo6'] = $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo6'] + $existencias['Valor'];
				}
				break;
			
			//Gasto de Productos en una Orden de Trabajo
			case 7:
				$mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo7'] = $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo7'] + $existencias['Valor'];
				break;
				
			//Traspaso Manual de Productos a otra Empresa
			case 8:
				$mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo8'] = $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo8'] + $existencias['Valor'];
				break;
			//Ingreso Manual
			case 9:
				$mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo9'] = $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['tipo9'] + $existencias['Valor'];
				break;
		}							
	}
	
	//guardo los datos correspondientes							
	$xmes = mes_actual();
	$xaño = ano_actual();
	$grafico = array();
	for ($xcontador = 12; $xcontador > 0; $xcontador--) {
									
		if($xmes>0){
			
			$grafico[$xcontador]['mes'] = $xmes;
			$grafico[$xcontador]['año'] = $xaño;
			if(isset($mes[$xaño][$xmes]['tipo1'])){  $grafico[$xcontador]['tipo1'] = $mes[$xaño][$xmes]['tipo1'];  }else{$grafico[$xcontador]['tipo1'] = 0;};
			if(isset($mes[$xaño][$xmes]['tipo2'])){  $grafico[$xcontador]['tipo2'] = $mes[$xaño][$xmes]['tipo2'];  }else{$grafico[$xcontador]['tipo2'] = 0;};
			if(isset($mes[$xaño][$xmes]['tipo3'])){  $grafico[$xcontador]['tipo3'] = $mes[$xaño][$xmes]['tipo3'];  }else{$grafico[$xcontador]['tipo3'] = 0;};
			if(isset($mes[$xaño][$xmes]['tipo4'])){  $grafico[$xcontador]['tipo4'] = $mes[$xaño][$xmes]['tipo4'];  }else{$grafico[$xcontador]['tipo4'] = 0;};
			if(isset($mes[$xaño][$xmes]['tipo5'])){  $grafico[$xcontador]['tipo5'] = $mes[$xaño][$xmes]['tipo5'];  }else{$grafico[$xcontador]['tipo5'] = 0;};
			if(isset($mes[$xaño][$xmes]['tipo6'])){  $grafico[$xcontador]['tipo6'] = $mes[$xaño][$xmes]['tipo6'];  }else{$grafico[$xcontador]['tipo6'] = 0;};
			if(isset($mes[$xaño][$xmes]['tipo7'])){  $grafico[$xcontador]['tipo7'] = $mes[$xaño][$xmes]['tipo7'];  }else{$grafico[$xcontador]['tipo7'] = 0;};
			if(isset($mes[$xaño][$xmes]['tipo8'])){  $grafico[$xcontador]['tipo8'] = $mes[$xaño][$xmes]['tipo8'];  }else{$grafico[$xcontador]['tipo8'] = 0;};
			if(isset($mes[$xaño][$xmes]['tipo9'])){  $grafico[$xcontador]['tipo9'] = $mes[$xaño][$xmes]['tipo9'];  }else{$grafico[$xcontador]['tipo9'] = 0;};
							
		}else{
			
			$xmes = 12;
			$xaño = $xaño-1;
			$grafico[$xcontador]['mes'] = $xmes;
			$grafico[$xcontador]['año'] = $xaño;
			if(isset($mes[$xaño][$xmes]['tipo1'])){  $grafico[$xcontador]['tipo1'] = $mes[$xaño][$xmes]['tipo1'];  }else{$grafico[$xcontador]['tipo1'] = 0;};
			if(isset($mes[$xaño][$xmes]['tipo2'])){  $grafico[$xcontador]['tipo2'] = $mes[$xaño][$xmes]['tipo2'];  }else{$grafico[$xcontador]['tipo2'] = 0;};
			if(isset($mes[$xaño][$xmes]['tipo3'])){  $grafico[$xcontador]['tipo3'] = $mes[$xaño][$xmes]['tipo3'];  }else{$grafico[$xcontador]['tipo3'] = 0;};
			if(isset($mes[$xaño][$xmes]['tipo4'])){  $grafico[$xcontador]['tipo4'] = $mes[$xaño][$xmes]['tipo4'];  }else{$grafico[$xcontador]['tipo4'] = 0;};
			if(isset($mes[$xaño][$xmes]['tipo5'])){  $grafico[$xcontador]['tipo5'] = $mes[$xaño][$xmes]['tipo5'];  }else{$grafico[$xcontador]['tipo5'] = 0;};
			if(isset($mes[$xaño][$xmes]['tipo6'])){  $grafico[$xcontador]['tipo6'] = $mes[$xaño][$xmes]['tipo6'];  }else{$grafico[$xcontador]['tipo6'] = 0;};
			if(isset($mes[$xaño][$xmes]['tipo7'])){  $grafico[$xcontador]['tipo7'] = $mes[$xaño][$xmes]['tipo7'];  }else{$grafico[$xcontador]['tipo7'] = 0;};
			if(isset($mes[$xaño][$xmes]['tipo8'])){  $grafico[$xcontador]['tipo8'] = $mes[$xaño][$xmes]['tipo8'];  }else{$grafico[$xcontador]['tipo8'] = 0;};
			if(isset($mes[$xaño][$xmes]['tipo9'])){  $grafico[$xcontador]['tipo9'] = $mes[$xaño][$xmes]['tipo9'];  }else{$grafico[$xcontador]['tipo9'] = 0;};
										
		}
		$xmes = $xmes-1;
									
	}
	

	
	
	//Separo los datos solicitados
	$datos = explode(",", $required);
	if(count($datos)==1){
		$data_required = ",'".widget_nombre($datos[0])."'";
		$colors = "'".widget_barcolor($datos[0])."'";
	}else{
		$data_required = '';
		$colors = '';
		foreach($datos as $dato){
			$data_required .= ",'".widget_nombre($dato)."'";
			$colors .= "'".widget_barcolor($dato)."',";
		}
	}
	

$Graficos = '';	

	//verifico si se envio un dato en enlace para asi ver si imprimo o no el marco contenedor del grafico
	if(isset($enlace)&&$enlace!=''){
		$Graficos .= '
		<div class="row">    
			<div class="col-sm-12">
				<div class="box">
					<header>
						<div class="icons"><i class="fa fa-table"></i></div><h5>'.$titulo.'</h5>        
						<div class="toolbar">
							<a target="new" href="'.$enlace.'?pagina=1" class="btn btn-xs btn-primary btn-line">Ver Mas</a>
						</div>
								  
					</header>  
					
					<div id="div-1" class="body">
						<div class="box-body">';
	}				
					
        $Graficos .= '
					<div class="row">
						<div class="col-md-8">
							<div class="chart">';
		
								
		$Graficos .= "						
								<script type='text/javascript'>
								  google.charts.setOnLoadCallback(drawChart_".$type.");
								  function drawChart_".$type."() {
									var data = google.visualization.arrayToDataTable([
									
									  ['Meses'".$data_required."]";
									
										//Recorro los meses
										for ($xyz = 1; $xyz <= 12; $xyz++) {
											//Se agrega el mes
											$Graficos .= ",['".numero_a_mes_corto($grafico[$xyz]['mes'])."'";
											//Se agregan los datos
											if(count($datos)==1){
												$Graficos .= ", ".$grafico[$xyz][$datos[0]];
											}else{
												foreach($datos as $dato){
													$Graficos .= ", ".$grafico[$xyz][$dato];
												}
											}
											$Graficos .= " ]";
										}
									
										
		$Graficos .= '
									
									]);

									var options = {
									  chart_'.$type.': {
										title: \'Balance\',
										subtitle: \'Movimientos ultimos 12 Meses\',
										
									  },
									  vAxis: {format: \'none\'},
									  legend: { position: \'none\' },
									  colors: ['.$colors.'],
									 
									};

									var chart_'.$type.' = new google.charts.Bar(document.getElementById(\'columnchart_'.$type.'_material\'));
									var table_'.$type.' = new google.visualization.Table(document.getElementById(\'table_div_'.$type.'\'));
									table_'.$type.'.draw(data, {showRowNumber: true, width: \'100%\', height: \'100%\'});
									
									 google.visualization.events.addListener(chart_'.$type.', \'error\', function (googleError) {
										  google.visualization.errors.removeError(googleError.id);
										  document.getElementById("error_'.$type.'_msg").innerHTML = "Message removed = \'" + googleError.message + "\'";
									  });
  

									chart_'.$type.'.draw(data, options);
								  }
								</script>
								
								<div id="columnchart_'.$type.'_material" style="width: 100%; height: 500px;"></div>
								<div id="table_div_'.$type.'" ></div>
								<div id="error_'.$type.'_msg"></div>

							</div>
						</div>
						<div class="col-md-4">';
						
						
						


							
					
			//Se crean los widget de forma dinamica
			if(count($datos)==1){
				if(isset($grafico[12][$datos[0]])&&$grafico[12][$datos[0]]!=''){
					$Graficos .= '
					<div class="info-box '.widget_widgetcolor($datos[0]).'">
						<span class="info-box-icon"><i class="fa fa-cubes"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Total '.widget_nombre($datos[0]).' del mes</span>
							<span class="info-box-number">';
							if(isset($grafico[12][$datos[0]])&&$grafico[12][$datos[0]]!=''){
								$Graficos .= Valores($grafico[12][$datos[0]], 0);
							}else{
								$Graficos .= Valores(0, 0);
							}
						$Graficos .= '</span>
							<div class="progress">
								<div class="progress-bar" style="width: 100%"></div>
							</div>
							<span class="progress-description">
								<a href="'.widget_pagina($datos[0], $type).'" class="faa-parent animated-hover">
									Ver '.widget_nombre($datos[0]).' <i class="fa fa-arrow-circle-right faa-passing"></i>
								</a>
							</span>
						</div>
					</div>';
				}
			
			}else{
				foreach($datos as $dato){
					if(isset($grafico[12][$dato])&&$grafico[12][$dato]!=''){
						$Graficos .= '
						<div class="info-box '.widget_widgetcolor($dato).'">
							<span class="info-box-icon"><i class="fa fa-cubes"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">Total '.widget_nombre($dato).' del mes</span>
								<span class="info-box-number">';
								if(isset($grafico[12][$dato])&&$grafico[12][$dato]!=''){
									$Graficos .= Valores($grafico[12][$dato], 0);
								}else{
									$Graficos .= Valores(0, 0);
								}
							$Graficos .= '</span>
								<div class="progress">
									<div class="progress-bar" style="width: 100%"></div>
								</div>
								<span class="progress-description">
									<a href="'.widget_pagina($dato, $type).'" class="faa-parent animated-hover">
										Ver '.widget_nombre($dato).' <i class="fa fa-arrow-circle-right faa-passing"></i>
									</a>
								</span>
							</div>
						</div>';
					}
				}
			}
															
	
              
						$Graficos .= '</div>
					</div>';
					
					
	//verifico si se envio un dato en enlace para asi ver si imprimo o no el marco contenedor del grafico
	if(isset($enlace)&&$enlace!=''){				
				$Graficos .= '	
                </div>
                <div class="box-footer"></div>
            </div>
		</div>
	</div>        
</div>'; 
}            
/**************************************************************************/           
//Si el usuario es distinto a los gerentes        
if ($_SESSION['usuario']['basic_data']['idTipoUsuario']!=4&&isset($uml)&&$uml!=''&&$uml!='0'){        
$Graficos .= '<div class="row">
		
		<div class="col-sm-6">
			<div class="box">	
				<header>		
					<div class="icons"><i class="fa fa-table"></i></div><h5>Ultimos movimientos</h5>	
				</header>
				<div class="table-responsive">    
					<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
						<thead>
							<tr role="row">
								<th>Movimiento</th>
								<th>Fecha</th>
								<th>Producto</th>
								<th>Bodega</th>
								<th>Cantidad</th>
							</tr>
						</thead>
		  
						<tbody role="alert" aria-live="polite" aria-relevant="all">';
						foreach ($arrMovimientos as $mov) { 
							
							$Graficos .= '<tr class="odd">
								<td>'.$mov['TipoMovimiento'].'</td>
								<td>'.Fecha_estandar($mov['Creacion_fecha']).'</td>
								<td>'.$mov['NombreProducto'].'</td>
								<td>'.$mov['NombreBodega'].'</td>
								<td>'; 
								if(isset($mov['Cantidad_ing'])&&$mov['Cantidad_ing']!=0){
									$Graficos .= 'Ingreso '.Cantidades_decimales_justos($mov['Cantidad_ing']).' '.$mov['UnidadMedida'];
								}else{
									$Graficos .= 'Egreso '.Cantidades_decimales_justos($mov['Cantidad_eg']).' '.$mov['UnidadMedida'];
								}
								
							$Graficos .= '</td>
							</tr>';
						}                      
						$Graficos .= '</tbody>
					</table>
				</div>
			</div>
		</div>


		<div class="col-sm-6">
			<div class="box">
				<header>
					<div class="icons"><i class="fa fa-table"></i></div><h5>Productos con bajo Stock</h5>        			  
				</header> 
				<div class="table-responsive">                 
					<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
						<thead>
							<tr role="row">
								<th>Producto</th>
								<th>Stock Min</th>
								<th>Stock Act</th>
							</tr>
						</thead>               
						<tbody role="alert" aria-live="polite" aria-relevant="all">';
						foreach ($arrProductos as $productos) { 
							$stock_actual = $productos['stock_entrada'] - $productos['stock_salida'];
							if ($productos['StockLimite']>$stock_actual){
							$Graficos .= '<tr class="odd">
								<td>'.$productos['NombreProd'].'</td>
								<td>'.Cantidades_decimales_justos($productos['StockLimite']).' '.$productos['UnidadMedida'].'</td>
								<td>'.Cantidades_decimales_justos($stock_actual).' '.$productos['UnidadMedida'].'</td>
							</tr>';
							} 
						}                    
						$Graficos .= '</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>';
}



return $Graficos;
}
/*******************************************************************************************************************/
//Muestra el calendario de OT
function widget_GPS_equipos($titulo,$nombreEquipo, $seguimiento, $map_visibility, $idSistema,
							$IDGoogle, $idTipoUsuario, $idUsuario, $dbConn){
	
	//Si no existe una ID se utiliza una por defecto
	if(!isset($IDGoogle) OR $IDGoogle==''){
		$GPS = '<p>No ha ingresado Una API de Google Maps</p>';
	}else{
		
		
		//variables
		$HoraSistema    = hora_actual(); 
		$FechaSistema   = fecha_actual();
		$eq_alertas     = 0; 
		$eq_fueralinea  = 0; 
		$eq_fueraruta   = 0;
		$eq_detenidos   = 0;
		$eq_gps_fuera   = 0;
		$eq_ok          = 0;

		$google = $IDGoogle;
			
		//Variable
		$z = "WHERE telemetria_listado.idEstado = 1 ";//solo equipos activos
		//solo los equipos que tengan el seguimiento activado
		if(isset($seguimiento)&&$seguimiento!=''&&$seguimiento!=0){
			$z .= " AND telemetria_listado.id_Geo = ".$seguimiento;
		}
		//Filtro el sistema al cual pertenece	
		if(isset($idTipoUsuario)&&$idTipoUsuario!=1){
			if(isset($idSistema)&&$idSistema!=''&&$idSistema!=0){
				$z .= " AND telemetria_listado.idSistema = ".$idSistema;	
			}
		}
		//Verifico el tipo de usuario que esta ingresando y el id
		$join = "";	
		if(isset($idTipoUsuario)&&$idTipoUsuario!=1&&isset($idUsuario)&&$idUsuario!=0){
			$join = " INNER JOIN usuarios_equipos_telemetria ON usuarios_equipos_telemetria.idTelemetria = telemetria_listado.idTelemetria ";	
			$z .= " AND usuarios_equipos_telemetria.idUsuario = ".$idUsuario;	
		}
			
		//Listar los equipos
		$arrEquipo = array();
		$query = "SELECT LastUpdateFecha,LastUpdateHora,cantSensores,GeoLatitud, GeoLongitud, NDetenciones,
		TiempoFueraLinea,GeoErrores,NErrores,

		SensoresMedErrores_1, SensoresMedErrores_2, SensoresMedErrores_3, SensoresMedErrores_4, SensoresMedErrores_5, 
		SensoresMedErrores_6, SensoresMedErrores_7, SensoresMedErrores_8, SensoresMedErrores_9, SensoresMedErrores_10, 
		SensoresMedErrores_11, SensoresMedErrores_12, SensoresMedErrores_13, SensoresMedErrores_14, SensoresMedErrores_15, 
		SensoresMedErrores_16, SensoresMedErrores_17, SensoresMedErrores_18, SensoresMedErrores_19, SensoresMedErrores_20, 
		SensoresMedErrores_21, SensoresMedErrores_22, SensoresMedErrores_23, SensoresMedErrores_24, SensoresMedErrores_25, 
		SensoresMedErrores_26, SensoresMedErrores_27, SensoresMedErrores_28, SensoresMedErrores_29, SensoresMedErrores_30, 
		SensoresMedErrores_31, SensoresMedErrores_32, SensoresMedErrores_33, SensoresMedErrores_34, SensoresMedErrores_35, 
		SensoresMedErrores_36, SensoresMedErrores_37, SensoresMedErrores_38, SensoresMedErrores_39, SensoresMedErrores_40, 
		SensoresMedErrores_41, SensoresMedErrores_42, SensoresMedErrores_43, SensoresMedErrores_44, SensoresMedErrores_45, 
		SensoresMedErrores_46, SensoresMedErrores_47, SensoresMedErrores_48, SensoresMedErrores_49, SensoresMedErrores_50,
			
		SensoresErrorActual_1, SensoresErrorActual_2, SensoresErrorActual_3, SensoresErrorActual_4, SensoresErrorActual_5, 
		SensoresErrorActual_6, SensoresErrorActual_7, SensoresErrorActual_8, SensoresErrorActual_9, SensoresErrorActual_10, 
		SensoresErrorActual_11, SensoresErrorActual_12, SensoresErrorActual_13, SensoresErrorActual_14, SensoresErrorActual_15, 
		SensoresErrorActual_16, SensoresErrorActual_17, SensoresErrorActual_18, SensoresErrorActual_19, SensoresErrorActual_20, 
		SensoresErrorActual_21, SensoresErrorActual_22, SensoresErrorActual_23, SensoresErrorActual_24, SensoresErrorActual_25, 
		SensoresErrorActual_26, SensoresErrorActual_27, SensoresErrorActual_28, SensoresErrorActual_29, SensoresErrorActual_30, 
		SensoresErrorActual_31, SensoresErrorActual_32, SensoresErrorActual_33, SensoresErrorActual_34, SensoresErrorActual_35, 
		SensoresErrorActual_36, SensoresErrorActual_37, SensoresErrorActual_38, SensoresErrorActual_39, SensoresErrorActual_40, 
		SensoresErrorActual_41, SensoresErrorActual_42, SensoresErrorActual_43, SensoresErrorActual_44, SensoresErrorActual_45, 
		SensoresErrorActual_46, SensoresErrorActual_47, SensoresErrorActual_48, SensoresErrorActual_49, SensoresErrorActual_50
			
			
		FROM `telemetria_listado`
		".$join."
		".$z."
		ORDER BY telemetria_listado.Nombre ASC  ";
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
		//Si ejecuto correctamente la consulta
		if(!$resultado){
			//Genero numero aleatorio
			$vardata = genera_password(8,'alfanumerico');
							
			//Guardo el error en una variable temporal
			$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
			$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
			$_SESSION['ErrorListing'][$vardata]['query']        = $query;
							
		}
		while ( $row = mysqli_fetch_assoc ($resultado)) {
		array_push( $arrEquipo,$row );
		}



		foreach ($arrEquipo as $data) {
			
			/**********************************************/
			//Se resetean
			$in_eq_alertas     = 0;
			$in_eq_fueralinea  = 0;
			$in_eq_fueraruta   = 0;
			$in_eq_detenidos   = 0;
			$in_eq_gps_fuera   = 0;
			$in_eq_ok          = 1;
												
			/**********************************************/
			//Fuera de linea
			$diaInicio   = fecha_estandar($data['LastUpdateFecha']);
			$diaTermino  = $FechaSistema;
			$tiempo1     = $data['LastUpdateHora'];
			$tiempo2     = $HoraSistema;
			//calculo diferencia de dias
			$n_dias = dias_transcurridos($diaInicio,$diaTermino);
			//calculo del tiempo transcurrido
			$Tiempo = restahoras($tiempo1, $tiempo2);
			//Calculo del tiempo transcurrido
			if($n_dias!=0){
				if($n_dias>=2){
					$n_dias = $n_dias-1;
					$horas_trans2 = multHoras('24:00:00',$n_dias);
					$Tiempo = sumahoras($Tiempo,$horas_trans2);
				}
				if($n_dias==1&&$tiempo1<$tiempo2){
					$horas_trans2 = multHoras('24:00:00',$n_dias);
					$Tiempo = sumahoras($Tiempo,$horas_trans2);
				}
			}	
			if($Tiempo>$data['TiempoFueraLinea']&&$data['TiempoFueraLinea']!='00:00:00'){	
				$in_eq_fueralinea++;
			}
			
			/**********************************************/
			//GPS con problemas
			if($data['GeoErrores']>0){
				$in_eq_gps_fuera++;	
			}
			
			/**********************************************/
			//alertas
			$xx = 0;
			for ($i = 1; $i <= $data['cantSensores']; $i++) {
				$xx = $data['SensoresMedErrores_'.$i] - $data['SensoresErrorActual_'.$i];
				if($xx<0){
					$in_eq_alertas++;
				}
			}

			/**********************************************/
			//Equipos Errores
			if($data['NErrores']>0){
				$in_eq_alertas++;	
			}
			
			/**********************************************/
			//Equipos detenidos
			if($data['NDetenciones']>0){
				$in_eq_detenidos++;	
			}
						
			/*******************************************************/
			//rearmo
			if($in_eq_detenidos>0){  $in_eq_ok = 0;$in_eq_detenidos = 1;}
			if($in_eq_alertas>0){    $in_eq_ok = 0;$in_eq_alertas = 1;    $in_eq_detenidos = 0;}
			if($in_eq_fueraruta>0){  $in_eq_ok = 0;$in_eq_fueraruta = 1;  $in_eq_alertas = 0;   $in_eq_detenidos = 0;}
			if($in_eq_gps_fuera>0){  $in_eq_ok = 0;$in_eq_gps_fuera = 1;  $in_eq_fueraruta = 0; $in_eq_alertas = 0;    $in_eq_detenidos = 0;}
			if($in_eq_fueralinea>0){ $in_eq_ok = 0;$in_eq_fueralinea = 1; $in_eq_gps_fuera = 0; $in_eq_fueraruta = 0;  $in_eq_alertas = 0;  $in_eq_detenidos = 0;}
			
			//Se guardan los valores
			$eq_alertas     = $eq_alertas + $in_eq_alertas; 
			$eq_fueralinea  = $eq_fueralinea + $in_eq_fueralinea; 
			$eq_fueraruta   = $eq_fueraruta + $in_eq_fueraruta; 
			$eq_detenidos   = $eq_detenidos + $in_eq_detenidos; 
			$eq_gps_fuera   = $eq_gps_fuera + $in_eq_gps_fuera; 
			$eq_ok          = $eq_ok + $in_eq_ok; 

		}



			$GPS = '<h3 class="supertittle text-primary">'.$titulo.'</h3>';
			
		if(isset($map_visibility)&&$map_visibility!=''&&$map_visibility==1){	
			$GPS .= '
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-blue xbox box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">'.$titulo.'</h3>
						<div class="box-tools pull-right">';
						if(isset($seguimiento)&&$seguimiento!=''&&$seguimiento==1){
							$GPS .= '<a target="new" href="telemetria_gestion_flota.php" class="btn btn-xs btn-primary btn-line">Ver Mas</a>';
						}elseif(isset($seguimiento)&&$seguimiento!=''&&$seguimiento==2){
							$GPS .= '';
						}		
						$GPS .= '</div>
					</div>
					<div class="box-body">
						<div class="">
							<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key='.$google.'&sensor=false"></script>
							<div id="map_canvas" style="width: 100%; height: 550px;"></div>
							<div id="consulta"></div>
					
							<script>
											
								var map;
								var marker;
								/* ************************************************************************** */
								function initialize() {
									var myLatlng = new google.maps.LatLng(-33.477271996598965, -70.65170304882815);

									var myOptions = {
										zoom: 12,
										zoomControl: false,
										scaleControl: false,
										scrollwheel: false,
										disableDoubleClickZoom: true,
										disableDefaultUI: true,
										center: myLatlng,
										mapTypeId: google.maps.MapTypeId.ROADMAP
									};
									map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);';
						
									if(isset($seguimiento)&&$seguimiento!=''&&$seguimiento==1){
										$GPS .= '
										//Ubicacion de los distintos dispositivos
										transMarker(10000);';
									}elseif(isset($seguimiento)&&$seguimiento!=''&&$seguimiento==2){
										$GPS .= 'ubiquity();';
									}	
										
									$GPS .= '	
								}
								/* ************************************************************************** */
								function ubiquity() {
								
									var locations = [ ';
									
									$ordenx=1;
									foreach ( $arrEquipo as $pos ) {
										$GPS .= "['".$ordenx."', ".$pos['GeoLatitud'].", ".$pos['GeoLongitud']."], ";					
										$ordenx++;
									} 
									$GPS .= '];
									
									//Se ocultan y eliminan los iconos
									hideMarkers(\'transMarkers\');
									deleteMarkers(\'transMarkers\');
														
									for(var i in locations){
										transporte = addMarker(icon_transMarker);
										transporte.show().setPosition(new google.maps.LatLng(locations[i][1], locations[i][2]));	
									}
								}
								/* ************************************************************************** */
								var icon_transMarker = {
										name: \'transMarkers\',
										visible: true
								}
											
								var markers={}

								function transMarker(time) {
									setInterval(function(){myTimer2()},time);
								}
											
								var mapax = 0;	
								function myTimer2() {

									switch(mapax) {
										//Ejecutar formulario con el recorrido y la ruta
										case 1:
											$(\'#consulta\').load(\'principal_update_map.php?idSistema='.$idSistema.'\');
										break;
										//se dibujan los iconos 	
										case 2:
											//Se ocultan y eliminan los iconos
											hideMarkers(\'transMarkers\');
											deleteMarkers(\'transMarkers\');
														
											for(var i in locations){
												transporte = addMarker(icon_transMarker);
												transporte.show().setPosition(new google.maps.LatLng(locations[i][1], locations[i][2]));	
											}

										break;		
									}

									mapax++;	
									if(mapax==3){mapax=1}
								}
											
											
								/* ************************************************************************** */
								var foreachMarkerByName=function(name,callback){
									
									var toRet=false
												
									if (typeof name != \'object\') {
										name=[name]
									}
												
									for (var a in name){
										var tmp=name[a];
													
										if (tmp==undefined||markers[tmp]==undefined) {
											continue;
										}
													
										toRet=true;
													
										for (var a in markers[tmp]) callback(markers[tmp][a]);
									}
												
									return toRet;
								}
								/* ************************************************************************** */
								hideMarkers=function(name){
									foreachMarkerByName(name,function(el){
										el.hide();
									});
									return this;
								}
								/* ************************************************************************** */
								deleteMarkers=function(name){
									foreachMarkerByName(name,function(el){            
										el.delete();
									});
									delete markers[name];
									return this;
								}
								/* ************************************************************************** */
								addMarker=function(opt){
									
									if (opt == undefined) return false;
												
									opt.map=map;
												
									var tmp=new google.maps.Marker(opt);
												
									if (opt.pos) tmp.setPosition(opt.pos);
									//tmp.setVisible(opt.visible||true);
											
									if (opt.name) {	
										if (markers[opt.name] == undefined) markers[opt.name]=[];
										
										markers[opt.name].push(tmp);
										
										tmp.markerFamilyName=opt.name;
										tmp.markerFamilyPos=markers[opt.name].length-1;
									}
									
									if (opt.events) {
										for (var a in opt.events) {
											google.maps.event.addListener(tmp,a,opt.events[a].bind(tmp));
										}
									}
									
									// Borrar, esconder y mostrar
									tmp.delete=function(){
										this.deleteInfo();
										this.setMap(null);
										
										return this;
									}.bind(tmp);
									
									tmp.hide=function(){
										this.setVisible(false);
										
										return this;
									}.bind(tmp);
									
									tmp.show=function(){
										google.maps.event.trigger(this, \'show\');
										this.setVisible(true);
										
										return this;
									}.bind(tmp)
									
									tmp.isVisible=function(){
										return this.visible
									}.bind(tmp)
									
									// Agrega mensajes a los marcadores
									tmp.info=function(message,click,opt){
										
										opt=opt||{}
										
										var custom=click===true;
										
										click=typeof click==\'function\'?click:opt.click||function(){};
									
										var opt=$.extend({content: message},opt);
									
										this.infoBox=custom;
									
										if (custom) {
											this.infoWindow = new InfoBox(opt);
										} else {
											this.infoWindow = new google.maps.InfoWindow(opt);
										}
									

										this.infoWindowListener=google.maps.event.addListener(this, \'click\', function () {
											
											if (activeInfoWindow) {
												activeInfoWindow.close();
											}
											this.infoWindow.open(map, this);
											activeInfoWindow=this.infoWindow;                
											click.bind(this)();
											
											return this;
											
										}.bind(this));
									}.bind(tmp);
									
									tmp.deleteInfo=function(){
										if (this.infoWindow) {
											this.infoWindow.setMap(null);
											delete this.infoWindow;
											
											google.maps.event.removeListener(this.infoWindowListener);
											delete this.infoWindowListener;
										}
										return this;
										
									}.bind(tmp);
									
									tmp.click=function(){
										google.maps.event.trigger(this, \'click\');
									}.bind(tmp);
									
									return tmp;
									
								}
								
								
								/* ************************************************************************** */
								google.maps.event.addDomListener(window, "load", initialize());
							</script>
					
					
						</div>
						
						
					</div>
				</div>
			</div>
		</div>';
		}

		if(isset($seguimiento)&&$seguimiento!=''&&$seguimiento==1){

			$GPS .= '
		   <link rel="stylesheet" href="'.DB_SITE.'/LIBS_js/modal/colorbox.css" />
			<div class="row">    
				
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="box box-yellow box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">'.$nombreEquipo.' con alertas</h3>
							<div class="box-tools pull-right">
								<a target="_blank" href="principal_gps_view.php?seguimiento='.$seguimiento.'&idSistema='.$idSistema.'&dataType=1" class="iframe btn btn-xs btn-warning btn-line">Ver Mas</a>
							</div>
						</div>
						<div class="box-body">
							<div class="value">
								<span><i class="fa fa-truck faa-float animated"></i></span>
								<span>'.$eq_alertas.'</span>
								Equipos
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="box box-red box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">'.$nombreEquipo.' fuera de linea</h3>
							<div class="box-tools pull-right">
								<a target="_blank" href="principal_gps_view.php?seguimiento='.$seguimiento.'&idSistema='.$idSistema.'&dataType=2" class="iframe btn btn-xs btn-danger btn-line">Ver Mas</a>
							</div>
						</div>
						<div class="box-body">
							<div class="value">
								<span><i class="fa fa-truck faa-float animated"></i></span>
								<span>'.$eq_fueralinea.'</span>
								Equipos
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="box box-green box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">'.$nombreEquipo.' fuera de ruta</h3>
							<div class="box-tools pull-right">
								<a target="_blank" href="principal_gps_view.php?seguimiento='.$seguimiento.'&idSistema='.$idSistema.'&dataType=3" class="iframe btn btn-xs btn-success btn-line">Ver Mas</a>
							</div>
						</div>
						<div class="box-body">
							<div class="value">
								<span><i class="fa fa-truck faa-float animated"></i></span>
								<span>'.$eq_fueraruta.'</span>
								Equipos
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="box box-purple box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">'.$nombreEquipo.' detenidos</h3>
							<div class="box-tools pull-right">
								<a target="_blank" href="principal_gps_view.php?seguimiento='.$seguimiento.'&idSistema='.$idSistema.'&dataType=5" class="iframe btn btn-xs btn-primary btn-line">Ver Mas</a>
							</div>
						</div>
						<div class="box-body">
							<div class="value">
								<span><i class="fa fa-truck faa-float animated"></i></span>
								<span>'.$eq_detenidos.'</span>
								Equipos
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="box box-yellow box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">'.$nombreEquipo.' con GPS en 0</h3>
							<div class="box-tools pull-right">
								<a target="_blank" href="principal_gps_view.php?seguimiento='.$seguimiento.'&idSistema='.$idSistema.'&dataType=5" class="iframe btn btn-xs btn-warning btn-line">Ver Mas</a>
							</div>
						</div>
						<div class="box-body">
							<div class="value">
								<span><i class="fa fa-truck faa-float animated"></i></span>
								<span>'.$eq_gps_fuera.'</span>
								Equipos
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="box box-blue box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">'.$nombreEquipo.' OK</h3>
							<div class="box-tools pull-right">
								<a target="_blank" href="principal_gps_view.php?seguimiento='.$seguimiento.'&idSistema='.$idSistema.'&dataType=4" class="iframe btn btn-xs btn-primary btn-line">Ver Mas</a>
							</div>
						</div>
						<div class="box-body">
							<div class="value">
								<span><i class="fa fa-truck faa-float animated"></i></span>
								<span>'.$eq_ok.'</span>
								Equipos
							</div>
						</div>
					</div>
				</div>
				
			</div>  
			<script src="'.DB_SITE.'/LIBS_js/modal/jquery.colorbox.js"></script>

			<script>
				$(document).ready(function(){
					//Examples of how to assign the Colorbox event to elements
					$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
					$(".callbacks").colorbox({
						onOpen:function(){ alert(\'onOpen: colorbox is about to open\'); },
						onLoad:function(){ alert(\'onLoad: colorbox has started to load the targeted content\'); },
						onComplete:function(){ alert(\'onComplete: colorbox has displayed the loaded content\'); },
						onCleanup:function(){ alert(\'onCleanup: colorbox has begun the close process\'); },
						onClosed:function(){ alert(\'onClosed: colorbox has completely closed\'); }
					});

							
					//Example of preserving a JavaScript event for inline calls.
					$("#click").click(function(){ 
						$(\'#click\').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
						return false;
					});
				});
			</script>
			
			
			
			
			';
		}elseif(isset($seguimiento)&&$seguimiento!=''&&$seguimiento==2){

			$GPS .= '
		   <link rel="stylesheet" href="'.DB_SITE.'/LIBS_js/modal/colorbox.css" />
			<div class="row">    
				
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="box box-yellow box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">'.$nombreEquipo.' con alertas</h3>
							<div class="box-tools pull-right">
								<a target="_blank" href="principal_gps_view.php?seguimiento='.$seguimiento.'&idSistema='.$idSistema.'&dataType=1" class="iframe btn btn-xs btn-warning btn-line">Ver Mas</a>
							</div>
						</div>
						<div class="box-body">
							<div class="value">
								<span><i class="fa fa-industry"></i></span>
								<span>'.$eq_alertas.'</span>
								Equipos
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="box box-red box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">'.$nombreEquipo.' fuera de linea</h3>
							<div class="box-tools pull-right">
								<a target="_blank" href="principal_gps_view.php?seguimiento='.$seguimiento.'&idSistema='.$idSistema.'&dataType=2" class="iframe btn btn-xs btn-danger btn-line">Ver Mas</a>
							</div>
						</div>
						<div class="box-body">
							<div class="value">
								<span><i class="fa fa-industry"></i></span>
								<span>'.$eq_fueralinea.'</span>
								Equipos
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="box box-blue box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">'.$nombreEquipo.' OK</h3>
							<div class="box-tools pull-right">
								<a target="_blank" href="principal_gps_view.php?seguimiento='.$seguimiento.'&idSistema='.$idSistema.'&dataType=4" class="iframe btn btn-xs btn-primary btn-line">Ver Mas</a>
							</div>
						</div>
						<div class="box-body">
							<div class="value">
								<span><i class="fa fa-industry"></i></span>
								<span>'.$eq_ok.'</span>
								Equipos
							</div>
						</div>
					</div>
				</div>
				
			</div>  
			<script src="'.DB_SITE.'/LIBS_js/modal/jquery.colorbox.js"></script>

			<script>
				$(document).ready(function(){
					//Examples of how to assign the Colorbox event to elements
					$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
					$(".callbacks").colorbox({
						onOpen:function(){ alert(\'onOpen: colorbox is about to open\'); },
						onLoad:function(){ alert(\'onLoad: colorbox has started to load the targeted content\'); },
						onComplete:function(){ alert(\'onComplete: colorbox has displayed the loaded content\'); },
						onCleanup:function(){ alert(\'onCleanup: colorbox has begun the close process\'); },
						onClosed:function(){ alert(\'onClosed: colorbox has completely closed\'); }
					});

							
					//Example of preserving a JavaScript event for inline calls.
					$("#click").click(function(){ 
						$(\'#click\').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
						return false;
					});
				});
			</script>
			
			
			
			
			';
		}


	}

return $GPS;						
}
/*******************************************************************************************************************/
//Muestra el calendario de OT
function widget_Equipos($nombreEquipo, $seguimiento, $equipo, $enlace, $idSistema, $idTipoUsuario, $idUsuario, $dbConn){

//variables
$HoraSistema    = hora_actual(); 
$FechaSistema   = fecha_actual();
$eq_alertas     = 0; 
$eq_fueralinea  = 0; 
$eq_ok          = 0;

//Variable
$z = "WHERE telemetria_listado.idEstado = 1 ";//solo equipos activos
//solo los equipos que tengan el seguimiento activado
if(isset($seguimiento)&&$seguimiento!=''&&$seguimiento!=0){
	$z .= " AND telemetria_listado.id_Geo = ".$seguimiento;
}
//Filtro el sistema al cual pertenece	
if(isset($idSistema)&&$idSistema!=''&&$idSistema!=0){
	$z .= " AND telemetria_listado.idSistema = ".$idSistema;	
}	
//El equipo a ver
if (isset($equipo)&&$equipo!=''&&$equipo!=0){
	$z .= " AND telemetria_listado.idTelemetria=".$equipo;
}
//Verifico el tipo de usuario que esta ingresando y el id
$join = "";	
if(isset($idTipoUsuario)&&$idTipoUsuario!=1&&isset($idUsuario)&&$idUsuario!=0){
	$join = " INNER JOIN usuarios_equipos_telemetria ON usuarios_equipos_telemetria.idTelemetria = telemetria_listado.idTelemetria ";	
	$z .= " AND usuarios_equipos_telemetria.idUsuario = ".$idUsuario;	
}
	
//Listar los equipos
$arrEquipo = array();
$query = "SELECT LastUpdateFecha,LastUpdateHora,cantSensores,
GeoLatitud, GeoLongitud, NDetenciones,TiempoFueraLinea,NErrores,

SensoresMedErrores_1, SensoresMedErrores_2, SensoresMedErrores_3, SensoresMedErrores_4, SensoresMedErrores_5, 
SensoresMedErrores_6, SensoresMedErrores_7, SensoresMedErrores_8, SensoresMedErrores_9, SensoresMedErrores_10, 
SensoresMedErrores_11, SensoresMedErrores_12, SensoresMedErrores_13, SensoresMedErrores_14, SensoresMedErrores_15, 
SensoresMedErrores_16, SensoresMedErrores_17, SensoresMedErrores_18, SensoresMedErrores_19, SensoresMedErrores_20, 
SensoresMedErrores_21, SensoresMedErrores_22, SensoresMedErrores_23, SensoresMedErrores_24, SensoresMedErrores_25, 
SensoresMedErrores_26, SensoresMedErrores_27, SensoresMedErrores_28, SensoresMedErrores_29, SensoresMedErrores_30, 
SensoresMedErrores_31, SensoresMedErrores_32, SensoresMedErrores_33, SensoresMedErrores_34, SensoresMedErrores_35, 
SensoresMedErrores_36, SensoresMedErrores_37, SensoresMedErrores_38, SensoresMedErrores_39, SensoresMedErrores_40, 
SensoresMedErrores_41, SensoresMedErrores_42, SensoresMedErrores_43, SensoresMedErrores_44, SensoresMedErrores_45, 
SensoresMedErrores_46, SensoresMedErrores_47, SensoresMedErrores_48, SensoresMedErrores_49, SensoresMedErrores_50,
	
SensoresErrorActual_1, SensoresErrorActual_2, SensoresErrorActual_3, SensoresErrorActual_4, SensoresErrorActual_5, 
SensoresErrorActual_6, SensoresErrorActual_7, SensoresErrorActual_8, SensoresErrorActual_9, SensoresErrorActual_10, 
SensoresErrorActual_11, SensoresErrorActual_12, SensoresErrorActual_13, SensoresErrorActual_14, SensoresErrorActual_15, 
SensoresErrorActual_16, SensoresErrorActual_17, SensoresErrorActual_18, SensoresErrorActual_19, SensoresErrorActual_20, 
SensoresErrorActual_21, SensoresErrorActual_22, SensoresErrorActual_23, SensoresErrorActual_24, SensoresErrorActual_25, 
SensoresErrorActual_26, SensoresErrorActual_27, SensoresErrorActual_28, SensoresErrorActual_29, SensoresErrorActual_30, 
SensoresErrorActual_31, SensoresErrorActual_32, SensoresErrorActual_33, SensoresErrorActual_34, SensoresErrorActual_35, 
SensoresErrorActual_36, SensoresErrorActual_37, SensoresErrorActual_38, SensoresErrorActual_39, SensoresErrorActual_40, 
SensoresErrorActual_41, SensoresErrorActual_42, SensoresErrorActual_43, SensoresErrorActual_44, SensoresErrorActual_45, 
SensoresErrorActual_46, SensoresErrorActual_47, SensoresErrorActual_48, SensoresErrorActual_49, SensoresErrorActual_50
	
	
FROM `telemetria_listado`
".$join."
".$z."
ORDER BY telemetria_listado.Nombre ASC  ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//Genero numero aleatorio
	$vardata = genera_password(8,'alfanumerico');
					
	//Guardo el error en una variable temporal
	$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
	$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
	$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrEquipo,$row );
}


foreach ($arrEquipo as $data) {
	
	/**********************************************/
	//Se resetean
	$in_eq_alertas     = 0;
	$in_eq_fueralinea  = 0;
	$in_eq_ok          = 1;
										
	/**********************************************/
	//Fuera de linea
	$diaInicio   = fecha_estandar($data['LastUpdateFecha']);
	$diaTermino  = $FechaSistema;
	$tiempo1     = $data['LastUpdateHora'];
	$tiempo2     = $HoraSistema;
	//calculo diferencia de dias
	$n_dias = dias_transcurridos($diaInicio,$diaTermino);
	//calculo del tiempo transcurrido
	$Tiempo = restahoras($tiempo1, $tiempo2);
	//Calculo del tiempo transcurrido
	if($n_dias!=0){
		if($n_dias>=2){
			$n_dias = $n_dias-1;
			$horas_trans2 = multHoras('24:00:00',$n_dias);
			$Tiempo = sumahoras($Tiempo,$horas_trans2);
		}
		if($n_dias==1&&$tiempo1<$tiempo2){
			$horas_trans2 = multHoras('24:00:00',$n_dias);
			$Tiempo = sumahoras($Tiempo,$horas_trans2);
		}
	}	
	if($Tiempo>$data['TiempoFueraLinea']&&$data['TiempoFueraLinea']!='00:00:00'){	
		$in_eq_fueralinea++;
	}

	/**********************************************/
	//alertas
	$xx = 0;
	for ($i = 1; $i <= $data['cantSensores']; $i++) {
		$xx = $data['SensoresMedErrores_'.$i] - $data['SensoresErrorActual_'.$i];
		if($xx<0){
			$in_eq_alertas++;
		}
	}
	//NErrores
	if(isset($data['NErrores'])&&$data['NErrores']>0){	
		$in_eq_alertas++;
	}
			
	/*******************************************************/
	//rearmo
	if($in_eq_alertas>0){    $in_eq_ok = 0;$in_eq_alertas = 1;    }
	if($in_eq_fueralinea>0){ $in_eq_ok = 0;$in_eq_fueralinea = 1; $in_eq_alertas = 0;}
	
	//Se guardan los valores
	$eq_alertas     = $eq_alertas + $in_eq_alertas; 
	$eq_fueralinea  = $eq_fueralinea + $in_eq_fueralinea; 
	$eq_ok          = $eq_ok + $in_eq_ok; 

}


	$GPS = '';
	$GPS .= '
	<div class="row">    
		
		<h3 class="supertittle text-primary">'.$nombreEquipo.'</h3>
		
		<div class="col-md-4">
			<div class="box box-yellow box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">'.$nombreEquipo.' con alertas</h3>
					<div class="box-tools pull-right">
						<a target="_blank" href="principal_gps_view.php?seguimiento='.$seguimiento.'&idSistema='.$idSistema.'&dataType=1" class="iframe btn btn-xs btn-warning btn-line">Ver Mas</a>
					</div>
				</div>
				<div class="box-body">
					<div class="value">
						<span><i class="fa fa-industry"></i></span>
						<span>'.$eq_alertas.'</span>
						Sensores
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="box box-red box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">'.$nombreEquipo.' fuera de linea</h3>
					<div class="box-tools pull-right">
						<a target="_blank" href="principal_gps_view.php?seguimiento='.$seguimiento.'&idSistema='.$idSistema.'&dataType=2" class="iframe btn btn-xs btn-danger btn-line">Ver Mas</a>
					</div>
				</div>
				<div class="box-body">
					<div class="value">
						<span><i class="fa fa-industry"></i></span>
						<span>'.$eq_fueralinea.'</span>
						Equipos
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="box box-blue box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">'.$nombreEquipo.' OK</h3>
					<div class="box-tools pull-right">
						<a target="_blank" href="principal_gps_view.php?seguimiento='.$seguimiento.'&idSistema='.$idSistema.'&dataType=4" class="iframe btn btn-xs btn-primary btn-line">Ver Mas</a>
					</div>
				</div>
				<div class="box-body">
					<div class="value">
						<span><i class="fa fa-industry"></i></span>
						<span>'.$eq_ok.'</span>
						Equipos
					</div>
				</div>
			</div>
		</div>
		
		
	</div> 
	
	 
	<script src="'.DB_SITE.'/LIBS_js/modal/jquery.colorbox.js"></script>
	<script>
		$(document).ready(function(){
			//Examples of how to assign the Colorbox event to elements
			$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
			$(".callbacks").colorbox({
				onOpen:function(){ alert(\'onOpen: colorbox is about to open\'); },
				onLoad:function(){ alert(\'onLoad: colorbox has started to load the targeted content\'); },
				onComplete:function(){ alert(\'onComplete: colorbox has displayed the loaded content\'); },
				onCleanup:function(){ alert(\'onCleanup: colorbox has begun the close process\'); },
				onClosed:function(){ alert(\'onClosed: colorbox has completely closed\'); }
			});

					
			//Example of preserving a JavaScript event for inline calls.
			$("#click").click(function(){ 
				$(\'#click\').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
				return false;
			});
		});
	</script>

	';

return $GPS;						
}
/*******************************************************************************************************************/
//Muestra el calendario de OT
function widget_Resumen_GPS_equipos($titulo, $seguimiento, $idSistema, $idTipoUsuario, $idUsuario, $dbConn){
	
	//Consulto por los equipos dentro de las zonas
	//Variable
$z = "WHERE telemetria_listado.idEstado = 1 ";//solo equipos activos
//solo los equipos que tengan el seguimiento activado
if(isset($seguimiento)&&$seguimiento!=''&&$seguimiento!=0){
	$z .= " AND telemetria_listado.id_Geo = ".$seguimiento;
}
//Filtro el sistema al cual pertenece	
if(isset($idSistema)&&$idSistema!=''&&$idSistema!=0){
	$z .= " AND telemetria_listado.idSistema = ".$idSistema;	
}
//Verifico el tipo de usuario que esta ingresando y el id
$join = "";	
if(isset($idTipoUsuario)&&$idTipoUsuario!=1&&isset($idUsuario)&&$idUsuario!=0){
	$join = " INNER JOIN usuarios_equipos_telemetria ON usuarios_equipos_telemetria.idTelemetria = telemetria_listado.idTelemetria ";	
	$z .= " AND usuarios_equipos_telemetria.idUsuario = ".$idUsuario;	
}	
//Listar los equipos
$arrEquipo = array();
$query = "SELECT 
telemetria_listado.Nombre,
telemetria_listado.cantSensores,
telemetria_listado.LastUpdateFecha,
telemetria_listado.LastUpdateHora,
telemetria_listado.id_Sensores,
telemetria_listado.TiempoFueraLinea,
telemetria_listado.NErrores,


SensoresNombre_1, SensoresNombre_2, SensoresNombre_3, SensoresNombre_4, SensoresNombre_5, 
SensoresNombre_6, SensoresNombre_7, SensoresNombre_8, SensoresNombre_9, SensoresNombre_10, 
SensoresNombre_11, SensoresNombre_12, SensoresNombre_13, SensoresNombre_14, SensoresNombre_15, 
SensoresNombre_16, SensoresNombre_17, SensoresNombre_18, SensoresNombre_19, SensoresNombre_20, 
SensoresNombre_21, SensoresNombre_22, SensoresNombre_23, SensoresNombre_24, SensoresNombre_25, 
SensoresNombre_26, SensoresNombre_27, SensoresNombre_28, SensoresNombre_29, SensoresNombre_30, 
SensoresNombre_31, SensoresNombre_32, SensoresNombre_33, SensoresNombre_34, SensoresNombre_35, 
SensoresNombre_36, SensoresNombre_37, SensoresNombre_38, SensoresNombre_39, SensoresNombre_40, 
SensoresNombre_41, SensoresNombre_42, SensoresNombre_43, SensoresNombre_44, SensoresNombre_45, 
SensoresNombre_46, SensoresNombre_47, SensoresNombre_48, SensoresNombre_49, SensoresNombre_50,

SensoresUniMed_1, SensoresUniMed_2, SensoresUniMed_3, SensoresUniMed_4, SensoresUniMed_5, 
SensoresUniMed_6, SensoresUniMed_7, SensoresUniMed_8, SensoresUniMed_9, SensoresUniMed_10, 
SensoresUniMed_11, SensoresUniMed_12, SensoresUniMed_13, SensoresUniMed_14, SensoresUniMed_15, 
SensoresUniMed_16, SensoresUniMed_17, SensoresUniMed_18, SensoresUniMed_19, SensoresUniMed_20, 
SensoresUniMed_21, SensoresUniMed_22, SensoresUniMed_23, SensoresUniMed_24, SensoresUniMed_25, 
SensoresUniMed_26, SensoresUniMed_27, SensoresUniMed_28, SensoresUniMed_29, SensoresUniMed_30, 
SensoresUniMed_31, SensoresUniMed_32, SensoresUniMed_33, SensoresUniMed_34, SensoresUniMed_35, 
SensoresUniMed_36, SensoresUniMed_37, SensoresUniMed_38, SensoresUniMed_39, SensoresUniMed_40, 
SensoresUniMed_41, SensoresUniMed_42, SensoresUniMed_43, SensoresUniMed_44, SensoresUniMed_45, 
SensoresUniMed_46, SensoresUniMed_47, SensoresUniMed_48, SensoresUniMed_49, SensoresUniMed_50,
	
SensoresMedActual_1, SensoresMedActual_2, SensoresMedActual_3, SensoresMedActual_4, SensoresMedActual_5, 
SensoresMedActual_6, SensoresMedActual_7, SensoresMedActual_8, SensoresMedActual_9, SensoresMedActual_10, 
SensoresMedActual_11, SensoresMedActual_12, SensoresMedActual_13, SensoresMedActual_14, SensoresMedActual_15, 
SensoresMedActual_16, SensoresMedActual_17, SensoresMedActual_18, SensoresMedActual_19, SensoresMedActual_20, 
SensoresMedActual_21, SensoresMedActual_22, SensoresMedActual_23, SensoresMedActual_24, SensoresMedActual_25, 
SensoresMedActual_26, SensoresMedActual_27, SensoresMedActual_28, SensoresMedActual_29, SensoresMedActual_30, 
SensoresMedActual_31, SensoresMedActual_32, SensoresMedActual_33, SensoresMedActual_34, SensoresMedActual_35, 
SensoresMedActual_36, SensoresMedActual_37, SensoresMedActual_38, SensoresMedActual_39, SensoresMedActual_40, 
SensoresMedActual_41, SensoresMedActual_42, SensoresMedActual_43, SensoresMedActual_44, SensoresMedActual_45, 
SensoresMedActual_46, SensoresMedActual_47, SensoresMedActual_48, SensoresMedActual_49, SensoresMedActual_50,

SensoresMedErrores_1, SensoresMedErrores_2, SensoresMedErrores_3, SensoresMedErrores_4, SensoresMedErrores_5, 
SensoresMedErrores_6, SensoresMedErrores_7, SensoresMedErrores_8, SensoresMedErrores_9, SensoresMedErrores_10, 
SensoresMedErrores_11, SensoresMedErrores_12, SensoresMedErrores_13, SensoresMedErrores_14, SensoresMedErrores_15, 
SensoresMedErrores_16, SensoresMedErrores_17, SensoresMedErrores_18, SensoresMedErrores_19, SensoresMedErrores_20, 
SensoresMedErrores_21, SensoresMedErrores_22, SensoresMedErrores_23, SensoresMedErrores_24, SensoresMedErrores_25, 
SensoresMedErrores_26, SensoresMedErrores_27, SensoresMedErrores_28, SensoresMedErrores_29, SensoresMedErrores_30, 
SensoresMedErrores_31, SensoresMedErrores_32, SensoresMedErrores_33, SensoresMedErrores_34, SensoresMedErrores_35, 
SensoresMedErrores_36, SensoresMedErrores_37, SensoresMedErrores_38, SensoresMedErrores_39, SensoresMedErrores_40, 
SensoresMedErrores_41, SensoresMedErrores_42, SensoresMedErrores_43, SensoresMedErrores_44, SensoresMedErrores_45, 
SensoresMedErrores_46, SensoresMedErrores_47, SensoresMedErrores_48, SensoresMedErrores_49, SensoresMedErrores_50,
	
SensoresErrorActual_1, SensoresErrorActual_2, SensoresErrorActual_3, SensoresErrorActual_4, SensoresErrorActual_5, 
SensoresErrorActual_6, SensoresErrorActual_7, SensoresErrorActual_8, SensoresErrorActual_9, SensoresErrorActual_10, 
SensoresErrorActual_11, SensoresErrorActual_12, SensoresErrorActual_13, SensoresErrorActual_14, SensoresErrorActual_15, 
SensoresErrorActual_16, SensoresErrorActual_17, SensoresErrorActual_18, SensoresErrorActual_19, SensoresErrorActual_20, 
SensoresErrorActual_21, SensoresErrorActual_22, SensoresErrorActual_23, SensoresErrorActual_24, SensoresErrorActual_25, 
SensoresErrorActual_26, SensoresErrorActual_27, SensoresErrorActual_28, SensoresErrorActual_29, SensoresErrorActual_30, 
SensoresErrorActual_31, SensoresErrorActual_32, SensoresErrorActual_33, SensoresErrorActual_34, SensoresErrorActual_35, 
SensoresErrorActual_36, SensoresErrorActual_37, SensoresErrorActual_38, SensoresErrorActual_39, SensoresErrorActual_40, 
SensoresErrorActual_41, SensoresErrorActual_42, SensoresErrorActual_43, SensoresErrorActual_44, SensoresErrorActual_45, 
SensoresErrorActual_46, SensoresErrorActual_47, SensoresErrorActual_48, SensoresErrorActual_49, SensoresErrorActual_50,

SensoresActivo_1, SensoresActivo_2, SensoresActivo_3, SensoresActivo_4, SensoresActivo_5, 
SensoresActivo_6, SensoresActivo_7, SensoresActivo_8, SensoresActivo_9, SensoresActivo_10, 
SensoresActivo_11, SensoresActivo_12, SensoresActivo_13, SensoresActivo_14, SensoresActivo_15, 
SensoresActivo_16, SensoresActivo_17, SensoresActivo_18, SensoresActivo_19, SensoresActivo_20, 
SensoresActivo_21, SensoresActivo_22, SensoresActivo_23, SensoresActivo_24, SensoresActivo_25, 
SensoresActivo_26, SensoresActivo_27, SensoresActivo_28, SensoresActivo_29, SensoresActivo_30, 
SensoresActivo_31, SensoresActivo_32, SensoresActivo_33, SensoresActivo_34, SensoresActivo_35, 
SensoresActivo_36, SensoresActivo_37, SensoresActivo_38, SensoresActivo_39, SensoresActivo_40, 
SensoresActivo_41, SensoresActivo_42, SensoresActivo_43, SensoresActivo_44, SensoresActivo_45, 
SensoresActivo_46, SensoresActivo_47, SensoresActivo_48, SensoresActivo_49, SensoresActivo_50
		
FROM `telemetria_listado`
".$join."
".$z."
ORDER BY telemetria_listado.Nombre ASC  ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//Genero numero aleatorio
	$vardata = genera_password(8,'alfanumerico');
					
	//Guardo el error en una variable temporal
	$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
	$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
	$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrEquipo,$row );
}
	

//Se traen todas las unidades de medida
$arrUnimed = array();
$query = "SELECT idUniMed,Nombre
FROM `telemetria_listado_unidad_medida`
ORDER BY idUniMed ASC";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//Genero numero aleatorio
	$vardata = genera_password(8,'alfanumerico');
					
	//Guardo el error en una variable temporal
	$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
	$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
	$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrUnimed,$row );
}


$Subicon = array();	
$Subicon[1] = 'fa fa-truck';
$Subicon[2] = 'fa fa-industry';



	
	$GPS = '<div class="row">';  	
	
	
		$GPS .= '
		<div class="col-sm-12">
			<div class="box">	
				<header>		
					<div class="icons"><i class="'.$Subicon[$seguimiento].'"></i></div><h5>'.$titulo.'</h5>	
				</header>
				<div class="table-responsive"> ';     
					
						$GPS .= '	
					
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th colspan="2">ZONA</th>
								</tr>
							</thead>
			  
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<tr class="odd">
									<td>';
									
										
									
										foreach($arrEquipo as $equip) {
											
										
										
											//alertas
											$xx = 0;
											$xy = 0;
											$xz = 0;
											$xw = 0;
											//se recorren las mediciones
											for ($i = 1; $i <= $equip['cantSensores']; $i++) {
												//solo sensores activos
												if(isset($equip['SensoresActivo_'.$i])&&$equip['SensoresActivo_'.$i]==1){
													$xx = $equip['SensoresMedErrores_'.$i] - $equip['SensoresErrorActual_'.$i];
													if($xx<0){$xw = 1;}
												}
											}
											//si hay errores
											if(isset($equip['NErrores'])&&$equip['NErrores']>0){
												$xw = 1;
											}
											
											//Fuera de linea
											$diaInicio   = fecha_estandar($equip['LastUpdateFecha']);
											$diaTermino  = fecha_actual();;
											$tiempo1     = $equip['LastUpdateHora'];
											$tiempo2     = hora_actual();;
											//calculo diferencia de dias
											$n_dias = dias_transcurridos($diaInicio,$diaTermino);
											//calculo del tiempo transcurrido
											$Tiempo = restahoras($tiempo1, $tiempo2);
											//Calculo del tiempo transcurrido
											if($n_dias!=0){
												if($n_dias>=2){
													$n_dias = $n_dias-1;
													$horas_trans2 = multHoras('24:00:00',$n_dias);
													$Tiempo = sumahoras($Tiempo,$horas_trans2);
												}
												if($n_dias==1&&$tiempo1<$tiempo2){
													$horas_trans2 = multHoras('24:00:00',$n_dias);
													$Tiempo = sumahoras($Tiempo,$horas_trans2);
												}
											}
											if($Tiempo>$equip['TiempoFueraLinea']&&$equip['TiempoFueraLinea']!='00:00:00'){
												$xz = 1;	
											}
											
											//Condiciono el color
											//if($xz!=0){$danger = 'box-red';}else{$danger = 'box-blue';}
											if($xz!=0){
												$danger = 'box-red';
											}elseif($xw!=0){
												$danger = 'box-yellow';
											}else{
												$danger = 'box-blue';
											}
											
											$GPS .= '
												<div class="col-md-4">
													<div class="box '.$danger.' box-solid">
														<div class="box-header with-border">
															<h3 class="box-title">'.$equip['Nombre'].'</h3>
														</div>
														<div class="box-body">
															<div class="value">';
																$GPS .= 'El '.fecha_estandar($equip['LastUpdateFecha']).' a las '.$equip['LastUpdateHora'].'<br/>';
															
																//Solo se muestran los datos de los sensores en caso de que estos esten activos
																if(isset($equip['id_Sensores'])&&$equip['id_Sensores']==1){
																	for ($i = 1; $i <= $equip['cantSensores']; $i++) { 
																		//solo sensores activos
																		if(isset($equip['SensoresActivo_'.$i])&&$equip['SensoresActivo_'.$i]==1){
																			$unimed = '';
																			//unidad de medida
																			foreach ($arrUnimed as $sen) {
																				if($equip['SensoresUniMed_'.$i]==$sen['idUniMed']){
																					$unimed = ' '.$sen['Nombre'];	
																				}
																			}
																			$GPS .= '<strong>'.$equip['SensoresNombre_'.$i].' :</strong>';
																			if(isset($equip['SensoresMedActual_'.$i])&&$equip['SensoresMedActual_'.$i]!=999){$xdata=Cantidades_decimales_justos($equip['SensoresMedActual_'.$i]).$unimed;}else{$xdata='Sin Datos';}
																			$GPS .= $xdata.'<br/>';
																		}
																	}
																}
																
															$GPS .= '	
															</div>
														</div>
													</div>
												</div>';
												
												
										}
									$GPS .= '
									</td>
								</tr>	
							</tbody>
						</table>
				</div>
			</div>
		</div>
		
		
	</div>';

	return $GPS;	
}
/*******************************************************************************************************************/
//Muestra el calendario de OT
function widget_Resumen_equipo($titulo_cuadro, $seguimiento, $equipo, $enlace, $idSistema, $idTipoUsuario, $idUsuario, $dbConn){
	
//Variables
$HoraSistema    = hora_actual(); 
$FechaSistema   = fecha_actual();


//Variable
$z = "WHERE telemetria_listado.idEstado = 1 ";//solo equipos activos
//solo los equipos que tengan el seguimiento activado
if(isset($seguimiento)&&$seguimiento!=''&&$seguimiento!=0){
	$z .= " AND telemetria_listado.id_Geo = ".$seguimiento;
}
//Filtro el sistema al cual pertenece	
if(isset($idSistema)&&$idSistema!=''&&$idSistema!=0){
	$z .= " AND telemetria_listado.idSistema = ".$idSistema;	
}
if (isset($equipo)&&$equipo!=''&&$equipo!=0){
	$z .= " AND telemetria_listado.idTelemetria=".$equipo;
}
//Verifico el tipo de usuario que esta ingresando y el id
$join = "";	
if(isset($idTipoUsuario)&&$idTipoUsuario!=1&&isset($idUsuario)&&$idUsuario!=0){
	$join = " INNER JOIN usuarios_equipos_telemetria ON usuarios_equipos_telemetria.idTelemetria = telemetria_listado.idTelemetria ";	
	$z .= " AND usuarios_equipos_telemetria.idUsuario = ".$idUsuario;	
}
						
//Listar los equipos
$arrEquipo = array();
$query = "SELECT
telemetria_listado.GeoLatitud, 
telemetria_listado.GeoLongitud,
telemetria_listado.idTelemetria,
telemetria_listado.Nombre,
telemetria_listado.Direccion_img,
telemetria_listado.LastUpdateHora,
telemetria_listado.LastUpdateFecha, 
telemetria_listado.cantSensores,
telemetria_listado.TiempoFueraLinea,
telemetria_listado.NErrores,

SensoresNombre_1, SensoresNombre_2, SensoresNombre_3, SensoresNombre_4, SensoresNombre_5, 
SensoresNombre_6, SensoresNombre_7, SensoresNombre_8, SensoresNombre_9, SensoresNombre_10, 
SensoresNombre_11, SensoresNombre_12, SensoresNombre_13, SensoresNombre_14, SensoresNombre_15, 
SensoresNombre_16, SensoresNombre_17, SensoresNombre_18, SensoresNombre_19, SensoresNombre_20, 
SensoresNombre_21, SensoresNombre_22, SensoresNombre_23, SensoresNombre_24, SensoresNombre_25, 
SensoresNombre_26, SensoresNombre_27, SensoresNombre_28, SensoresNombre_29, SensoresNombre_30, 
SensoresNombre_31, SensoresNombre_32, SensoresNombre_33, SensoresNombre_34, SensoresNombre_35, 
SensoresNombre_36, SensoresNombre_37, SensoresNombre_38, SensoresNombre_39, SensoresNombre_40, 
SensoresNombre_41, SensoresNombre_42, SensoresNombre_43, SensoresNombre_44, SensoresNombre_45, 
SensoresNombre_46, SensoresNombre_47, SensoresNombre_48, SensoresNombre_49, SensoresNombre_50,

SensoresMedActual_1, SensoresMedActual_2, SensoresMedActual_3, SensoresMedActual_4, SensoresMedActual_5, 
SensoresMedActual_6, SensoresMedActual_7, SensoresMedActual_8, SensoresMedActual_9, SensoresMedActual_10, 
SensoresMedActual_11, SensoresMedActual_12, SensoresMedActual_13, SensoresMedActual_14, SensoresMedActual_15, 
SensoresMedActual_16, SensoresMedActual_17, SensoresMedActual_18, SensoresMedActual_19, SensoresMedActual_20, 
SensoresMedActual_21, SensoresMedActual_22, SensoresMedActual_23, SensoresMedActual_24, SensoresMedActual_25, 
SensoresMedActual_26, SensoresMedActual_27, SensoresMedActual_28, SensoresMedActual_29, SensoresMedActual_30, 
SensoresMedActual_31, SensoresMedActual_32, SensoresMedActual_33, SensoresMedActual_34, SensoresMedActual_35, 
SensoresMedActual_36, SensoresMedActual_37, SensoresMedActual_38, SensoresMedActual_39, SensoresMedActual_40, 
SensoresMedActual_41, SensoresMedActual_42, SensoresMedActual_43, SensoresMedActual_44, SensoresMedActual_45, 
SensoresMedActual_46, SensoresMedActual_47, SensoresMedActual_48, SensoresMedActual_49, SensoresMedActual_50,

SensoresGrupo_1, SensoresGrupo_2, SensoresGrupo_3, SensoresGrupo_4, SensoresGrupo_5, 
SensoresGrupo_6, SensoresGrupo_7, SensoresGrupo_8, SensoresGrupo_9, SensoresGrupo_10, 
SensoresGrupo_11, SensoresGrupo_12, SensoresGrupo_13, SensoresGrupo_14, SensoresGrupo_15, 
SensoresGrupo_16, SensoresGrupo_17, SensoresGrupo_18, SensoresGrupo_19, SensoresGrupo_20, 
SensoresGrupo_21, SensoresGrupo_22, SensoresGrupo_23, SensoresGrupo_24, SensoresGrupo_25, 
SensoresGrupo_26, SensoresGrupo_27, SensoresGrupo_28, SensoresGrupo_29, SensoresGrupo_30, 
SensoresGrupo_31, SensoresGrupo_32, SensoresGrupo_33, SensoresGrupo_34, SensoresGrupo_35, 
SensoresGrupo_36, SensoresGrupo_37, SensoresGrupo_38, SensoresGrupo_39, SensoresGrupo_40, 
SensoresGrupo_41, SensoresGrupo_42, SensoresGrupo_43, SensoresGrupo_44, SensoresGrupo_45, 
SensoresGrupo_46, SensoresGrupo_47, SensoresGrupo_48, SensoresGrupo_49, SensoresGrupo_50,

SensoresUniMed_1, SensoresUniMed_2, SensoresUniMed_3, SensoresUniMed_4, SensoresUniMed_5, 
SensoresUniMed_6, SensoresUniMed_7, SensoresUniMed_8, SensoresUniMed_9, SensoresUniMed_10, 
SensoresUniMed_11, SensoresUniMed_12, SensoresUniMed_13, SensoresUniMed_14, SensoresUniMed_15, 
SensoresUniMed_16, SensoresUniMed_17, SensoresUniMed_18, SensoresUniMed_19, SensoresUniMed_20, 
SensoresUniMed_21, SensoresUniMed_22, SensoresUniMed_23, SensoresUniMed_24, SensoresUniMed_25, 
SensoresUniMed_26, SensoresUniMed_27, SensoresUniMed_28, SensoresUniMed_29, SensoresUniMed_30, 
SensoresUniMed_31, SensoresUniMed_32, SensoresUniMed_33, SensoresUniMed_34, SensoresUniMed_35, 
SensoresUniMed_36, SensoresUniMed_37, SensoresUniMed_38, SensoresUniMed_39, SensoresUniMed_40, 
SensoresUniMed_41, SensoresUniMed_42, SensoresUniMed_43, SensoresUniMed_44, SensoresUniMed_45, 
SensoresUniMed_46, SensoresUniMed_47, SensoresUniMed_48, SensoresUniMed_49, SensoresUniMed_50,

SensoresMedErrores_1, SensoresMedErrores_2, SensoresMedErrores_3, SensoresMedErrores_4, SensoresMedErrores_5, 
SensoresMedErrores_6, SensoresMedErrores_7, SensoresMedErrores_8, SensoresMedErrores_9, SensoresMedErrores_10, 
SensoresMedErrores_11, SensoresMedErrores_12, SensoresMedErrores_13, SensoresMedErrores_14, SensoresMedErrores_15, 
SensoresMedErrores_16, SensoresMedErrores_17, SensoresMedErrores_18, SensoresMedErrores_19, SensoresMedErrores_20, 
SensoresMedErrores_21, SensoresMedErrores_22, SensoresMedErrores_23, SensoresMedErrores_24, SensoresMedErrores_25, 
SensoresMedErrores_26, SensoresMedErrores_27, SensoresMedErrores_28, SensoresMedErrores_29, SensoresMedErrores_30, 
SensoresMedErrores_31, SensoresMedErrores_32, SensoresMedErrores_33, SensoresMedErrores_34, SensoresMedErrores_35, 
SensoresMedErrores_36, SensoresMedErrores_37, SensoresMedErrores_38, SensoresMedErrores_39, SensoresMedErrores_40, 
SensoresMedErrores_41, SensoresMedErrores_42, SensoresMedErrores_43, SensoresMedErrores_44, SensoresMedErrores_45, 
SensoresMedErrores_46, SensoresMedErrores_47, SensoresMedErrores_48, SensoresMedErrores_49, SensoresMedErrores_50,
	
SensoresErrorActual_1, SensoresErrorActual_2, SensoresErrorActual_3, SensoresErrorActual_4, SensoresErrorActual_5, 
SensoresErrorActual_6, SensoresErrorActual_7, SensoresErrorActual_8, SensoresErrorActual_9, SensoresErrorActual_10, 
SensoresErrorActual_11, SensoresErrorActual_12, SensoresErrorActual_13, SensoresErrorActual_14, SensoresErrorActual_15, 
SensoresErrorActual_16, SensoresErrorActual_17, SensoresErrorActual_18, SensoresErrorActual_19, SensoresErrorActual_20, 
SensoresErrorActual_21, SensoresErrorActual_22, SensoresErrorActual_23, SensoresErrorActual_24, SensoresErrorActual_25, 
SensoresErrorActual_26, SensoresErrorActual_27, SensoresErrorActual_28, SensoresErrorActual_29, SensoresErrorActual_30, 
SensoresErrorActual_31, SensoresErrorActual_32, SensoresErrorActual_33, SensoresErrorActual_34, SensoresErrorActual_35, 
SensoresErrorActual_36, SensoresErrorActual_37, SensoresErrorActual_38, SensoresErrorActual_39, SensoresErrorActual_40, 
SensoresErrorActual_41, SensoresErrorActual_42, SensoresErrorActual_43, SensoresErrorActual_44, SensoresErrorActual_45, 
SensoresErrorActual_46, SensoresErrorActual_47, SensoresErrorActual_48, SensoresErrorActual_49, SensoresErrorActual_50,

SensoresActivo_1, SensoresActivo_2, SensoresActivo_3, SensoresActivo_4, SensoresActivo_5, 
SensoresActivo_6, SensoresActivo_7, SensoresActivo_8, SensoresActivo_9, SensoresActivo_10, 
SensoresActivo_11, SensoresActivo_12, SensoresActivo_13, SensoresActivo_14, SensoresActivo_15, 
SensoresActivo_16, SensoresActivo_17, SensoresActivo_18, SensoresActivo_19, SensoresActivo_20, 
SensoresActivo_21, SensoresActivo_22, SensoresActivo_23, SensoresActivo_24, SensoresActivo_25, 
SensoresActivo_26, SensoresActivo_27, SensoresActivo_28, SensoresActivo_29, SensoresActivo_30, 
SensoresActivo_31, SensoresActivo_32, SensoresActivo_33, SensoresActivo_34, SensoresActivo_35, 
SensoresActivo_36, SensoresActivo_37, SensoresActivo_38, SensoresActivo_39, SensoresActivo_40, 
SensoresActivo_41, SensoresActivo_42, SensoresActivo_43, SensoresActivo_44, SensoresActivo_45, 
SensoresActivo_46, SensoresActivo_47, SensoresActivo_48, SensoresActivo_49, SensoresActivo_50,
						
core_sistemas.idOpcionesGen_3

FROM `telemetria_listado`
LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = telemetria_listado.idSistema
".$join."
".$z."
ORDER BY telemetria_listado.Nombre ASC  ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//Genero numero aleatorio
	$vardata = genera_password(8,'alfanumerico');
					
	//Guardo el error en una variable temporal
	$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
	$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
	$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrEquipo,$row );
}

//Se traen todas las unidades de medida
$arrUnimed = array();
$query = "SELECT idUniMed,Nombre
FROM `telemetria_listado_unidad_medida`
ORDER BY idUniMed ASC";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//Genero numero aleatorio
	$vardata = genera_password(8,'alfanumerico');
					
	//Guardo el error en una variable temporal
	$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
	$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
	$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrUnimed,$row );
}

//Se traen todos los grupos
$arrGrupos = array();
$query = "SELECT idGrupo,Nombre, nColumnas
FROM `telemetria_listado_grupos`
ORDER BY idGrupo ASC";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//Genero numero aleatorio
	$vardata = genera_password(8,'alfanumerico');
					
	//Guardo el error en una variable temporal
	$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
	$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
	$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrGrupos,$row );
}	
	

$GPS = '';
$GPS .= '<link rel="stylesheet" href="'.DB_SITE.'/LIBS_js/modal/colorbox.css" />';



$GPS .= '
<div class="row">
	<div class="col-sm-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table"></i></div>
				<h5>'.$titulo_cuadro.'</h5>
				<div class="toolbar"></div>
				<ul class="nav nav-tabs pull-right">';
					$xcounter_tel = 1;
					foreach($arrEquipo as $equip) {	
						if($xcounter_tel==1){$xactive_tel = 'active';}else{$xactive_tel = '';}
						if($xcounter_tel==4){$GPS .= '<li class="dropdown"><a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a><ul class="dropdown-menu" role="menu">';} 
						$GPS .= '<li class="'.$xactive_tel.'"><a href="#tel_id_'.$xcounter_tel.'" data-toggle="tab">'.$equip['Nombre'].'</a></li>';
						$xcounter_tel++;
					}
					if($xcounter_tel>3){$GPS .= '</ul></li>';}
				$GPS .= '
				</ul>	
			</header>
			
		

			<div id="div-2" class="tab-content">';
				$xcounter_tel_2 = 1;
				foreach($arrEquipo as $equip) {
					//Se resetean
					$eq_alertas     = 0; 
					$eq_fueralinea  = 0; 
					$eq_fueraruta   = 0;
					$eq_detenidos   = 0;

					if($xcounter_tel_2==1){$xactive_tel = 'active in';}else{$xactive_tel = '';}
					$GPS .= '
					<div class="tab-pane fade '.$xactive_tel.'" id="tel_id_'.$xcounter_tel_2.'">
						<div class="wmd-panel">
							<div class="table-responsive">
							
							
								<div class="col-sm-7">
									<div class="row">
										<div id="consulta">
											<table id="dataTable" class="table table-bordered table-condensed table-hover dataTable">
												<thead>
													<tr role="row">
														<th>Nombre</th>
														<th>Estado</th>
														<th width="160">Acciones</th>
													</tr>
												</thead>
												<tbody role="alert" aria-live="polite" aria-relevant="all">
													<tr class="odd">		
														<td colspan="3">Medicion el '.fecha_estandar($equip['LastUpdateFecha']).' a las '.$equip['LastUpdateHora'].' hrs</td>		
													</tr>';
												
														
														//alertas
														$xx = 0;
														$xy = 0;
														$xz = 0;
														$dataex = '';
														
														$eq_ok = '<a href="#" title="Sin Problemas" class="iframe btn btn-success btn-sm tooltip"><i class="fa fa-check"></i></a>';
														for ($i = 1; $i <= $equip['cantSensores']; $i++) {
															$xx = $equip['SensoresMedErrores_'.$i] - $equip['SensoresErrorActual_'.$i];
															if($xx<0){$xy = 1;$eq_ok = '';}
														}
														$eq_alertas = $eq_alertas + $xy;
														//NErrores
														if(isset($equip['NErrores'])&&$equip['NErrores']>0){
															$eq_alertas++;
														}
														
														/***************************************/
														//Fuera de linea
														$diaInicio   = fecha_estandar($equip['LastUpdateFecha']);
														$diaTermino  = $FechaSistema;
														$tiempo1     = $equip['LastUpdateHora'];
														$tiempo2     = $HoraSistema;
														//calculo diferencia de dias
														$n_dias = dias_transcurridos($diaInicio,$diaTermino);
														//calculo del tiempo transcurrido
														$Tiempo = restahoras($tiempo1, $tiempo2);
														//Calculo del tiempo transcurrido
														if($n_dias!=0){
															if($n_dias>=2){
																$n_dias = $n_dias-1;
																$horas_trans2 = multHoras('24:00:00',$n_dias);
																$Tiempo = sumahoras($Tiempo,$horas_trans2);
															}
															if($n_dias==1&&$tiempo1<$tiempo2){
																$horas_trans2 = multHoras('24:00:00',$n_dias);
																$Tiempo = sumahoras($Tiempo,$horas_trans2);
															}
														}
														if($Tiempo>$equip['TiempoFueraLinea']&&$equip['TiempoFueraLinea']!='00:00:00'){
															$eq_fueralinea = $eq_fueralinea + 1;	
															$eq_ok = '';
														}
														
														
														/***************************************/
														//equipos ok
														if($eq_alertas>0){$eq_ok = '';$xz = 1;$dataex .= '<a href="#" title="Con Alertas" class="btn btn-danger btn-sm tooltip"><i class="fa fa-exclamation-triangle"></i></a>';}
														if($eq_fueralinea>0){$eq_ok = '';$xz = 1;$dataex .= '<a href="#" title="Fuera de Linea" class="btn btn-danger btn-sm tooltip"><i class="fa fa-chain-broken"></i></a>';}
														
														$eq_ok .= $dataex;
														
													if($xz!=0){$danger = 'danger';}else{$danger = '';}	
													$GPS .= '	
													<tr class="odd '.$danger.'">		
														<td>'.$equip['Nombre'].'</td>		
														<td><div class="btn-group" >'.$eq_ok.'</div></td>			
														<td>
															<div class="btn-group" style="width: 70px;" >
																<a href="telemetria_gestion_equipos_view_equipo.php?view='.$equip['idTelemetria'].'" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
																<a href="telemetria_gestion_equipos_view_equipo_uso.php?view='.$equip['idTelemetria'].'" title="Ver Uso" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-wrench"></i></a>
															</div>
														</td>
													</tr>
													<tr class="odd" style="background-color: #CCCCCC;">		
														<td>Grupo</td>		
														<td colspan="2">Mediciones</td>			
													</tr>';
													
													
													$arrGruposTitulo = array();
													$n_sensores = 0;
													$sensor = 0;
													for ($i = 1; $i <= $equip['cantSensores']; $i++) {
														//solo sensores activos
														if(isset($equip['SensoresActivo_'.$i])&&$equip['SensoresActivo_'.$i]==1){
															//Unidad medida
															$unimed = '';
															foreach ($arrUnimed as $sen) { 
																if($equip['SensoresUniMed_'.$i]==$sen['idUniMed']){
																	$unimed = ' '.$sen['Nombre'];
																}	
															}
															//Titulo del cuadro
															$Titulo = '';
															foreach ($arrGrupos as $group) { 
																if($equip['SensoresGrupo_'.$i]==$group['idGrupo']){
																	$Titulo    = $group['Nombre'];
																	$nColumnas = $group['nColumnas'];
																}
															}	
															//Verifico que no sea el mismo sensor
															if(isset($equip['SensoresMedActual_'.$i])&&$equip['SensoresMedActual_'.$i]!=999){$xdata=Cantidades_decimales_justos($equip['SensoresMedActual_'.$i]).$unimed;}else{$xdata='Sin Datos';}
															if($equip['SensoresErrorActual_'.$i] > $equip['SensoresMedErrores_'.$i]){
																$arrGruposTitulo[$Titulo][$i]['Descripcion'] = '<span style="color:red;">'.$equip['SensoresNombre_'.$i].' : '.$xdata.'</span>';
															}else{
																$arrGruposTitulo[$Titulo][$i]['Descripcion'] = $equip['SensoresNombre_'.$i].' : '.$xdata;
															}
																
															//Guardo el valor correspondiente
															$arrGruposTitulo[$Titulo][$i]['valor']     = $equip['SensoresMedActual_'.$i];
															$arrGruposTitulo[$Titulo][$i]['unimed']    = $unimed;
															$arrGruposTitulo[$Titulo][$i]['nColumnas'] = $nColumnas;
														}	
													}
													
													//Ordenamiento por titulo de grupo
													$names = array();
													foreach ($arrGruposTitulo as $titulo=>$items) {
														$names[] = $titulo;
													}
													array_multisort($names, SORT_ASC, $arrGruposTitulo);

													//se recorre el arreglo
													foreach($arrGruposTitulo as $titulo=>$items) { 
														$ndatacol    = 0;
														$columna_a   = '';
														$columna_b   = '';
														$total_col1  = 0;
														$total_col2  = 0;
														$ntotal_col1 = 0;
														$ntotal_col2 = 0;
														$unimed_col1 = '';
														$unimed_col2 = '';
														
														$GPS .= '
														<tr class="odd">		
															<td>'.$titulo.'</td>';
															$y = 1;
															foreach($items as $datos) {
																//si el grupo solo tiene una columna
																if(isset($datos['nColumnas'])&&$datos['nColumnas']==1){
																	//Especifico el numero de columnas
																	$ndatacol = 1;
																	//Se guardan los datos
																	$columna_a .= $datos['Descripcion'].'<br/>';
																	//Verifico que el dato no sea 999
																	if(isset($datos['valor'])&&$datos['valor']!=999){
																		$total_col1 = $total_col1 + $datos['valor'];
																		$ntotal_col1++;
																	}
																	$unimed_col1 = $datos['unimed'];
																	
																//si el grupo tiene 2 columnas
																}elseif(isset($datos['nColumnas'])&&$datos['nColumnas']==2){
																	//Especifico el numero de columnas
																	$ndatacol = 2;
																	//Se guardan los datos
																	if($y==1){
																		$columna_a .= $datos['Descripcion'].'<br/>';
																		//Verifico que el dato no sea 999
																		if(isset($datos['valor'])&&$datos['valor']!=999){
																			$total_col1 = $total_col1 + $datos['valor'];
																			$ntotal_col1++;
																		}
																		$unimed_col1 = $datos['unimed'];
																		$y=2;
																	}else{
																		$columna_b .= $datos['Descripcion'].'<br/>';
																		//Verifico que el dato no sea 999
																		if(isset($datos['valor'])&&$datos['valor']!=999){
																			$total_col2 = $total_col2 + $datos['valor'];
																			$ntotal_col2++;
																		}
																		$unimed_col2 = $datos['unimed'];
																		$y=1;
																	}
																}
																
															} 
															/***********************/
															if($ndatacol==1){
																$GPS .= '
																<td colspan="2">'.$columna_a.'</td>';
															}elseif($ndatacol==2){
																$GPS .= '
																<td>'.$columna_a.'</td>
																<td>'.$columna_b.'</td>';
															}
															
															
																		
														$GPS .= '</tr>';
														
														/*************************************************/
														if($equip['idOpcionesGen_3']==1){
															$GPS .= '
															<tr class="odd">		
																<td>Promedio</td>';
																/***********************/
																if($ndatacol==1){
																	if($ntotal_col1!=0){$GPS .= '<td colspan="2">'.Cantidades_decimales_justos($total_col1/$ntotal_col1).$unimed_col1.'</td>';}else{$GPS .= '<td colspan="2">0'.$unimed_col1.'</td>';}
																}elseif($ndatacol==2){
																	if($ntotal_col1!=0){$GPS .= '<td>'.Cantidades_decimales_justos($total_col1/$ntotal_col1).$unimed_col1.'</td>';}else{$GPS .= '<td>0'.$unimed_col1.'</td>';}
																	if($ntotal_col2!=0){$GPS .= '<td>'.Cantidades_decimales_justos($total_col2/$ntotal_col2).$unimed_col2.'</td>';}else{$GPS .= '<td>0'.$unimed_col2.'</td>';}
																}
																
															$GPS .= '
															</tr>
															<tr class="odd">		
																<td colspan="3"></td>		
															</tr>';
														}
													}
													
													
														
														
													$GPS .= '       
												</tbody>
											</table>
										</div>
									</div>
								</div>
								
								<div class="col-sm-5">
									<div class="row">';
									if(isset($enlace)&&$enlace!=''&&$enlace!=0){
										if ($equip['Direccion_img']=='') {
											$GPS .= '<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="'.DB_SITE.'/Legacy/gestion_modular/img/maquina.jpg">';
										}else{
											$GPS .= '<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="'.$enlace.$equip['Direccion_img'].'">';
										}
									}else{
										if ($equip['Direccion_img']=='') {
											$GPS .= '<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="'.DB_SITE.'/Legacy/gestion_modular/img/maquina.jpg">';
										}else{
											$GPS .= '<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="upload/'.$equip['Direccion_img'].'">';
										}
									}	
										
									$GPS .= '
									</div>
								</div>
		
					
							
							
							</div>
						</div>
					</div>
					';
					$xcounter_tel_2++;
				}
			$GPS .= '	
			</div>	
		</div>
	</div>
</div>

';


$GPS .= '
<script src="'.DB_SITE.'/LIBS_js/modal/jquery.colorbox.js"></script>

<script>
	$(document).ready(function(){
		//Examples of how to assign the Colorbox event to elements
		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
		$(".callbacks").colorbox({
			onOpen:function(){ alert(\'onOpen: colorbox is about to open\'); },
			onLoad:function(){ alert(\'onLoad: colorbox has started to load the targeted content\'); },
			onComplete:function(){ alert(\'onComplete: colorbox has displayed the loaded content\'); },
			onCleanup:function(){ alert(\'onCleanup: colorbox has begun the close process\'); },
			onClosed:function(){ alert(\'onClosed: colorbox has completely closed\'); }
		});

				
		//Example of preserving a JavaScript event for inline calls.
		$("#click").click(function(){ 
			$(\'#click\').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
</script>
	
	';
	
	return $GPS;
}
/*******************************************************************************************************************/
//Muestra el calendario de OT
function widget_GPS_equipos_lista($titulo_cuadro, $seguimiento, $equipo, $enlace, 
								  $idSistema, $idTipoUsuario, $idUsuario, $dbConn){
	
//Variables
$HoraSistema    = hora_actual(); 
$FechaSistema   = fecha_actual();


//Variable
$z = "WHERE telemetria_listado.idEstado = 1 ";//solo equipos activos
//solo los equipos que tengan el seguimiento activado
if(isset($seguimiento)&&$seguimiento!=''&&$seguimiento!=0){
	$z .= " AND telemetria_listado.id_Geo = ".$seguimiento;
}
//Filtro el sistema al cual pertenece	
if(isset($idTipoUsuario)&&$idTipoUsuario!=1){
	if(isset($idSistema)&&$idSistema!=''&&$idSistema!=0){
		$z .= " AND telemetria_listado.idSistema = ".$idSistema;	
	}
}
if (isset($equipo)&&$equipo!=''&&$equipo!=0){
	$z .= " AND telemetria_listado.idTelemetria=".$equipo;
}
//Verifico el tipo de usuario que esta ingresando y el id
$join = "";	
if(isset($idTipoUsuario)&&$idTipoUsuario!=1&&isset($idUsuario)&&$idUsuario!=0){
	$join = " INNER JOIN usuarios_equipos_telemetria ON usuarios_equipos_telemetria.idTelemetria = telemetria_listado.idTelemetria ";	
	$z .= " AND usuarios_equipos_telemetria.idUsuario = ".$idUsuario;	
}
						
//Listar los equipos
$arrEquipo = array();
$query = "SELECT
telemetria_listado.idTelemetria,
telemetria_listado.Nombre,
telemetria_listado.Identificador AS Caja,
telemetria_listado.LastUpdateHora,
telemetria_listado.LastUpdateFecha, 
telemetria_listado.cantSensores,
telemetria_listado.TiempoFueraLinea,
telemetria_listado.NDetenciones,	
telemetria_listado.GeoErrores,		
telemetria_listado.NErrores,

SensoresNombre_1, SensoresNombre_2, SensoresNombre_3, SensoresNombre_4, SensoresNombre_5, 
SensoresNombre_6, SensoresNombre_7, SensoresNombre_8, SensoresNombre_9, SensoresNombre_10, 
SensoresNombre_11, SensoresNombre_12, SensoresNombre_13, SensoresNombre_14, SensoresNombre_15, 
SensoresNombre_16, SensoresNombre_17, SensoresNombre_18, SensoresNombre_19, SensoresNombre_20, 
SensoresNombre_21, SensoresNombre_22, SensoresNombre_23, SensoresNombre_24, SensoresNombre_25, 
SensoresNombre_26, SensoresNombre_27, SensoresNombre_28, SensoresNombre_29, SensoresNombre_30, 
SensoresNombre_31, SensoresNombre_32, SensoresNombre_33, SensoresNombre_34, SensoresNombre_35, 
SensoresNombre_36, SensoresNombre_37, SensoresNombre_38, SensoresNombre_39, SensoresNombre_40, 
SensoresNombre_41, SensoresNombre_42, SensoresNombre_43, SensoresNombre_44, SensoresNombre_45, 
SensoresNombre_46, SensoresNombre_47, SensoresNombre_48, SensoresNombre_49, SensoresNombre_50,

SensoresMedErrores_1, SensoresMedErrores_2, SensoresMedErrores_3, SensoresMedErrores_4, SensoresMedErrores_5, 
SensoresMedErrores_6, SensoresMedErrores_7, SensoresMedErrores_8, SensoresMedErrores_9, SensoresMedErrores_10, 
SensoresMedErrores_11, SensoresMedErrores_12, SensoresMedErrores_13, SensoresMedErrores_14, SensoresMedErrores_15, 
SensoresMedErrores_16, SensoresMedErrores_17, SensoresMedErrores_18, SensoresMedErrores_19, SensoresMedErrores_20, 
SensoresMedErrores_21, SensoresMedErrores_22, SensoresMedErrores_23, SensoresMedErrores_24, SensoresMedErrores_25, 
SensoresMedErrores_26, SensoresMedErrores_27, SensoresMedErrores_28, SensoresMedErrores_29, SensoresMedErrores_30, 
SensoresMedErrores_31, SensoresMedErrores_32, SensoresMedErrores_33, SensoresMedErrores_34, SensoresMedErrores_35, 
SensoresMedErrores_36, SensoresMedErrores_37, SensoresMedErrores_38, SensoresMedErrores_39, SensoresMedErrores_40, 
SensoresMedErrores_41, SensoresMedErrores_42, SensoresMedErrores_43, SensoresMedErrores_44, SensoresMedErrores_45, 
SensoresMedErrores_46, SensoresMedErrores_47, SensoresMedErrores_48, SensoresMedErrores_49, SensoresMedErrores_50,
	
SensoresErrorActual_1, SensoresErrorActual_2, SensoresErrorActual_3, SensoresErrorActual_4, SensoresErrorActual_5, 
SensoresErrorActual_6, SensoresErrorActual_7, SensoresErrorActual_8, SensoresErrorActual_9, SensoresErrorActual_10, 
SensoresErrorActual_11, SensoresErrorActual_12, SensoresErrorActual_13, SensoresErrorActual_14, SensoresErrorActual_15, 
SensoresErrorActual_16, SensoresErrorActual_17, SensoresErrorActual_18, SensoresErrorActual_19, SensoresErrorActual_20, 
SensoresErrorActual_21, SensoresErrorActual_22, SensoresErrorActual_23, SensoresErrorActual_24, SensoresErrorActual_25, 
SensoresErrorActual_26, SensoresErrorActual_27, SensoresErrorActual_28, SensoresErrorActual_29, SensoresErrorActual_30, 
SensoresErrorActual_31, SensoresErrorActual_32, SensoresErrorActual_33, SensoresErrorActual_34, SensoresErrorActual_35, 
SensoresErrorActual_36, SensoresErrorActual_37, SensoresErrorActual_38, SensoresErrorActual_39, SensoresErrorActual_40, 
SensoresErrorActual_41, SensoresErrorActual_42, SensoresErrorActual_43, SensoresErrorActual_44, SensoresErrorActual_45, 
SensoresErrorActual_46, SensoresErrorActual_47, SensoresErrorActual_48, SensoresErrorActual_49, SensoresErrorActual_50



FROM `telemetria_listado`
LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = telemetria_listado.idSistema
".$join."
".$z."
ORDER BY telemetria_listado.Nombre ASC  ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//Genero numero aleatorio
	$vardata = genera_password(8,'alfanumerico');
					
	//Guardo el error en una variable temporal
	$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
	$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
	$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrEquipo,$row );
}



$GPS = '';
$GPS .= '<link rel="stylesheet" href="'.DB_SITE.'/LIBS_js/modal/colorbox.css" />';


	$GPS .= '	
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<header>
					<div class="icons"><i class="fa fa-table"></i></div><h5>'.$titulo_cuadro.'</h5>	
				</header>
				<div class="table-responsive">
					<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
						<thead>
							<tr role="row">
								<th>Nombre</th>
								<th>ID Caja</th>
								<th>Fecha - Hora</th>
								<th>Estado</th>
								<th width="10">Acciones</th>
							</tr>
							<tr role="row">
								<th colspan="5"><input class="form-control" id="InputTableFilter_tel_1" type="text" placeholder="Filtrar.."></th>
							</tr>
						</thead>
						<tbody role="alert" aria-live="polite" aria-relevant="all" id="TableFiltered_tel_1">';
							
							//variables nuevas
							$eq_alertas     = 0; 
							$eq_fueralinea  = 0; 
							$eq_fueraruta   = 0;
							$eq_detenidos   = 0;
							$eq_gps_fuera   = 0;
							$eq_ok          = 0;

							foreach ($arrEquipo as $data) {
								
								/**********************************************/
								//Se resetean
								$in_eq_alertas     = 0;
								$in_eq_fueralinea  = 0;
								$in_eq_fueraruta   = 0;
								$in_eq_detenidos   = 0;
								$in_eq_gps_fuera   = 0;
								$in_eq_ok          = 1;
																	
								/**********************************************/
								//Fuera de linea
								$diaInicio   = fecha_estandar($data['LastUpdateFecha']);
								$diaTermino  = $FechaSistema;
								$tiempo1     = $data['LastUpdateHora'];
								$tiempo2     = $HoraSistema;
								//calculo diferencia de dias
								$n_dias = dias_transcurridos($diaInicio,$diaTermino);
								//calculo del tiempo transcurrido
								$Tiempo = restahoras($tiempo1, $tiempo2);
								//Calculo del tiempo transcurrido
								if($n_dias!=0){
									if($n_dias>=2){
										$n_dias = $n_dias-1;
										$horas_trans2 = multHoras('24:00:00',$n_dias);
										$Tiempo = sumahoras($Tiempo,$horas_trans2);
									}
									if($n_dias==1&&$tiempo1<$tiempo2){
										$horas_trans2 = multHoras('24:00:00',$n_dias);
										$Tiempo = sumahoras($Tiempo,$horas_trans2);
									}
								}	
								if($Tiempo>$data['TiempoFueraLinea']&&$data['TiempoFueraLinea']!='00:00:00'){	
									$in_eq_fueralinea++;
								}
								
								/**********************************************/
								//GPS con problemas
								if($data['GeoErrores']>0){
									$in_eq_gps_fuera++;	
								}
								
								/**********************************************/
								//alertas
								$xx = 0;
								for ($i = 1; $i <= $data['cantSensores']; $i++) {
									$xx = $data['SensoresMedErrores_'.$i] - $data['SensoresErrorActual_'.$i];
									if($xx<0){
										$in_eq_alertas++;
									}
								}

								/**********************************************/
								//Equipos con errores
								if($data['NErrores']>0){
									$in_eq_alertas++;	
								}

								/**********************************************/
								//Equipos detenidos
								if($data['NDetenciones']>0){
									$in_eq_detenidos++;	
								}
								
									
								/*******************************************************/
								//rearmo
								if($in_eq_detenidos>0){  $in_eq_ok = 0;$in_eq_detenidos = 1;}
								if($in_eq_alertas>0){    $in_eq_ok = 0;$in_eq_alertas = 1;    $in_eq_detenidos = 0;}
								if($in_eq_fueraruta>0){  $in_eq_ok = 0;$in_eq_fueraruta = 1;  $in_eq_alertas = 0;   $in_eq_detenidos = 0;}
								if($in_eq_gps_fuera>0){  $in_eq_ok = 0;$in_eq_gps_fuera = 1;  $in_eq_fueraruta = 0; $in_eq_alertas = 0;    $in_eq_detenidos = 0;}
								if($in_eq_fueralinea>0){ $in_eq_ok = 0;$in_eq_fueralinea = 1; $in_eq_gps_fuera = 0; $in_eq_fueraruta = 0;  $in_eq_alertas = 0;  $in_eq_detenidos = 0;}
								
								/*******************************************************/
								//se guardan estados
								$danger = '';
								if($in_eq_detenidos>0){  $danger = 'info';     $dataex = '<a href="#" title="Equipo Detenido" class="btn btn-danger btn-sm tooltip"><i class="fa fa-car"></i></a>';}
								if($in_eq_alertas>0){    $danger = 'warning';  $dataex = '<a href="#" title="Equipo con Alertas" class="btn btn-warning btn-sm tooltip"><i class="fa fa-exclamation-triangle"></i></a>';}
								if($in_eq_fueraruta>0){  $danger = 'success';  $dataex = '<a href="#" title="Equipo fuera de ruta" class="btn btn-danger btn-sm tooltip"><i class="fa fa-location-arrow"></i></a>';}
								if($in_eq_gps_fuera>0){  $danger = 'warning';  $dataex = '<a href="#" title="Equipo con GPS en 0" class="btn btn-danger btn-sm tooltip"><i class="fa fa-map-marker"></i></a>';}
								if($in_eq_fueralinea>0){ $danger = 'danger';   $dataex = '<a href="#" title="Fuera de Linea" class="btn btn-danger btn-sm tooltip"><i class="fa fa-chain-broken"></i></a>';}
															
								/*******************************************************/
								//traspasan los estados
								if($in_eq_ok==1){
									$eq_ok = '<a href="#" title="Sin Problemas" class="iframe btn btn-success btn-sm tooltip"><i class="fa fa-check"></i></a>';
								}else{
									$eq_ok = $dataex;
								}
								
								/*******************************************************/
								//se escriben los datos
								$GPS .= '	
									<tr class="odd '.$danger.'">		
										<td>'.$data['Nombre'].'</td>	
										<td>'.$data['Caja'].'</td>	
										<td>'.fecha_estandar($data['LastUpdateFecha']).' a las '.$data['LastUpdateHora'].' hrs</td>	
										<td><div class="btn-group" >'.$eq_ok.'</div></td>			
										<td>
											<div class="btn-group" style="width: 35px;" >
												<a href="telemetria_gestion_flota_view_equipo_mapa.php?view='.$data['idTelemetria'].'" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
											</div>
										</td>
									</tr>';

							}
							
							/*foreach($arrEquipo as $equip) {	
								//Se resetean
								$eq_alertas     = 0; 
								$eq_fueralinea  = 0; 
								$eq_fueraruta   = 0;
								$eq_detenidos   = 0;
								$xx = 0;
								$xy = 0;
								$xz = 0;
								$xw = 0;
								$dataex = '';
											
								$eq_ok = '<a href="#" title="Sin Problemas" class="iframe btn btn-success btn-sm tooltip"><i class="fa fa-check"></i></a>';
								for ($i = 1; $i <= $equip['cantSensores']; $i++) {
									$xx = $equip['SensoresMedErrores_'.$i] - $equip['SensoresErrorActual_'.$i];
									if($xx<0){$xy = 1;$eq_ok = '';}
								}
								$eq_alertas = $eq_alertas + $xy;
											
								//Fuera de linea
								$diaInicio   = fecha_estandar($equip['LastUpdateFecha']);
								$diaTermino  = $FechaSistema;
								$tiempo1     = $equip['LastUpdateHora'];
								$tiempo2     = $HoraSistema;
								//calculo diferencia de dias
								$n_dias = dias_transcurridos($diaInicio,$diaTermino);
								//calculo del tiempo transcurrido
								$Tiempo = restahoras($tiempo1, $tiempo2);
								//Calculo del tiempo transcurrido
								if($n_dias!=0){
									if($n_dias>=2){
										$n_dias = $n_dias-1;
										$horas_trans2 = multHoras('24:00:00',$n_dias);
										$Tiempo = sumahoras($Tiempo,$horas_trans2);
									}
									if($n_dias==1&&$tiempo1<$tiempo2){
										$horas_trans2 = multHoras('24:00:00',$n_dias);
										$Tiempo = sumahoras($Tiempo,$horas_trans2);
									}
								}
								if($Tiempo>$equip['TiempoFueraLinea']&&$equip['TiempoFueraLinea']!='00:00:00'){
									$eq_fueralinea = $eq_fueralinea + 1;	
									$eq_ok = '';
								}
											
											
											
								//equipos ok
								if($eq_alertas>0){$eq_ok = '';$xw = 1;$dataex .= '<a href="#" title="Con Alertas" class="btn btn-warning btn-sm tooltip"><i class="fa fa-exclamation-triangle"></i></a>';}
								if($eq_fueralinea>0){$eq_ok = '';$xz = 1;$dataex .= '<a href="#" title="Fuera de Linea" class="btn btn-danger btn-sm tooltip"><i class="fa fa-chain-broken"></i></a>';}
											
								$eq_ok .= $dataex;
								
								if($xz!=0){
									$danger = 'danger';
								}elseif($xw!=0){
									$danger = 'warning';
								}else{
									$danger = '';
								}	
								
								
										
								$GPS .= '	
								<tr class="odd '.$danger.'">		
									<td>'.$equip['Nombre'].'</td>	
									<td>'.$equip['Caja'].'</td>	
									<td>'.fecha_estandar($equip['LastUpdateFecha']).' a las '.$equip['LastUpdateHora'].' hrs</td>	
									<td><div class="btn-group" >'.$eq_ok.'</div></td>			
									<td>
										<div class="btn-group" style="width: 70px;" >
											<a href="telemetria_gestion_equipos_view_equipo.php?view='.$equip['idTelemetria'].'" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
											<a href="telemetria_gestion_equipos_view_equipo_uso.php?view='.$equip['idTelemetria'].'" title="Ver Uso" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-wrench"></i></a>
										</div>
									</td>
								</tr>';
							}*/					
							$GPS .= '       
						</tbody>
					</table>
					<script>
						$(document).ready(function(){
						  $("#InputTableFilter_tel_1").on("keyup", function() {
							var value = $(this).val().toLowerCase();
							$("#TableFiltered_tel_1 tr").filter(function() {
							  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
							});
						  });
						});
					</script>
					
					
				</div>	
			</div>	
		</div>
	</div>';



$GPS .= '
<script src="'.DB_SITE.'/LIBS_js/modal/jquery.colorbox.js"></script>

<script>
	$(document).ready(function(){
		//Examples of how to assign the Colorbox event to elements
		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
		$(".callbacks").colorbox({
			onOpen:function(){ alert(\'onOpen: colorbox is about to open\'); },
			onLoad:function(){ alert(\'onLoad: colorbox has started to load the targeted content\'); },
			onComplete:function(){ alert(\'onComplete: colorbox has displayed the loaded content\'); },
			onCleanup:function(){ alert(\'onCleanup: colorbox has begun the close process\'); },
			onClosed:function(){ alert(\'onClosed: colorbox has completely closed\'); }
		});

				
		//Example of preserving a JavaScript event for inline calls.
		$("#click").click(function(){ 
			$(\'#click\').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
</script>
	
	';
	
	return $GPS;
}

/*******************************************************************************************************************/
//Muestra el calendario de OT
function widget_GPS_lista($titulo_cuadro, $seguimiento, $equipo, $enlace, 
						  $idSistema, $idTipoUsuario, $idUsuario, $dbConn){
	
//Variables
$HoraSistema    = hora_actual(); 
$FechaSistema   = fecha_actual();


//Variable
$z = "WHERE telemetria_listado.idEstado = 1 ";//solo equipos activos
//solo los equipos que tengan el seguimiento activado
if(isset($seguimiento)&&$seguimiento!=''&&$seguimiento!=0){
	$z .= " AND telemetria_listado.id_Geo = ".$seguimiento;
}
//Filtro el sistema al cual pertenece	
if(isset($idSistema)&&$idSistema!=''&&$idSistema!=0){
	$z .= " AND telemetria_listado.idSistema = ".$idSistema;	
}
if (isset($equipo)&&$equipo!=''&&$equipo!=0){
	$z .= " AND telemetria_listado.idTelemetria=".$equipo;
}
//Verifico el tipo de usuario que esta ingresando y el id
$join = "";	
if(isset($idTipoUsuario)&&$idTipoUsuario!=1&&isset($idUsuario)&&$idUsuario!=0){
	$join = " INNER JOIN usuarios_equipos_telemetria ON usuarios_equipos_telemetria.idTelemetria = telemetria_listado.idTelemetria ";	
	$z .= " AND usuarios_equipos_telemetria.idUsuario = ".$idUsuario;	
}
						
//Listar los equipos
$arrEquipo = array();
$query = "SELECT
telemetria_listado.idTelemetria,
telemetria_listado.Nombre,
telemetria_listado.Identificador AS Caja,
telemetria_listado.LastUpdateHora,
telemetria_listado.LastUpdateFecha, 
telemetria_listado.TiempoFueraLinea,
telemetria_listado.GeoErrores,
telemetria_listado.NDetenciones,
telemetria_listado.NErrores

FROM `telemetria_listado`
LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = telemetria_listado.idSistema
".$join."
".$z."
ORDER BY telemetria_listado.Nombre ASC  ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//Genero numero aleatorio
	$vardata = genera_password(8,'alfanumerico');
					
	//Guardo el error en una variable temporal
	$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
	$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
	$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrEquipo,$row );
}



$GPS = '';
$GPS .= '<link rel="stylesheet" href="'.DB_SITE.'/LIBS_js/modal/colorbox.css" />';


	$GPS .= '	
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<header>
					<div class="icons"><i class="fa fa-table"></i></div><h5>'.$titulo_cuadro.'</h5>	
				</header>
				<div class="table-responsive">
					<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
						<thead>
							<tr role="row">
								<th>Nombre</th>
								<th>ID Caja</th>
								<th>Fecha - Hora</th>
								<th>Estado</th>
								<th width="10">Acciones</th>
							</tr>
							<tr role="row">
								<th colspan="5"><input class="form-control" id="InputTableFilter_tel_1" type="text" placeholder="Filtrar.."></th>
							</tr>
						</thead>
						<tbody role="alert" aria-live="polite" aria-relevant="all" id="TableFiltered_tel_1">';
							
							//variables nuevas
							$eq_alertas     = 0; 
							$eq_fueralinea  = 0; 
							$eq_fueraruta   = 0;
							$eq_detenidos   = 0;
							$eq_gps_fuera   = 0;
							$eq_ok          = 0;

							foreach ($arrEquipo as $data) {
								
								/**********************************************/
								//Se resetean
								$in_eq_alertas     = 0;
								$in_eq_fueralinea  = 0;
								$in_eq_fueraruta   = 0;
								$in_eq_detenidos   = 0;
								$in_eq_gps_fuera   = 0;
								$in_eq_ok          = 1;
																	
								/**********************************************/
								//Fuera de linea
								$diaInicio   = fecha_estandar($data['LastUpdateFecha']);
								$diaTermino  = $FechaSistema;
								$tiempo1     = $data['LastUpdateHora'];
								$tiempo2     = $HoraSistema;
								//calculo diferencia de dias
								$n_dias = dias_transcurridos($diaInicio,$diaTermino);
								//calculo del tiempo transcurrido
								$Tiempo = restahoras($tiempo1, $tiempo2);
								//Calculo del tiempo transcurrido
								if($n_dias!=0){
									if($n_dias>=2){
										$n_dias = $n_dias-1;
										$horas_trans2 = multHoras('24:00:00',$n_dias);
										$Tiempo = sumahoras($Tiempo,$horas_trans2);
									}
									if($n_dias==1&&$tiempo1<$tiempo2){
										$horas_trans2 = multHoras('24:00:00',$n_dias);
										$Tiempo = sumahoras($Tiempo,$horas_trans2);
									}
								}	
								if($Tiempo>$data['TiempoFueraLinea']&&$data['TiempoFueraLinea']!='00:00:00'){	
									$in_eq_fueralinea++;
								}
								
								/**********************************************/
								//GPS con problemas
								if($data['GeoErrores']>0){
									$in_eq_gps_fuera++;	
								}
								
								/**********************************************/
								//alertas
								$xx = 0;
								for ($i = 1; $i <= $data['cantSensores']; $i++) {
									$xx = $data['SensoresMedErrores_'.$i] - $data['SensoresErrorActual_'.$i];
									if($xx<0){
										$in_eq_alertas++;
									}
								}
								
								/**********************************************/
								//NErrores
								if($data['NErrores']>0){
									$in_eq_alertas++;	
								}

								/**********************************************/
								//Equipos detenidos
								if($data['NDetenciones']>0){
									$in_eq_detenidos++;	
								}
								
											
								/*******************************************************/
								//rearmo
								if($in_eq_detenidos>0){  $in_eq_ok = 0;$in_eq_detenidos = 1;}
								if($in_eq_alertas>0){    $in_eq_ok = 0;$in_eq_alertas = 1;    $in_eq_detenidos = 0;}
								if($in_eq_fueraruta>0){  $in_eq_ok = 0;$in_eq_fueraruta = 1;  $in_eq_alertas = 0;   $in_eq_detenidos = 0;}
								if($in_eq_gps_fuera>0){  $in_eq_ok = 0;$in_eq_gps_fuera = 1;  $in_eq_fueraruta = 0; $in_eq_alertas = 0;    $in_eq_detenidos = 0;}
								if($in_eq_fueralinea>0){ $in_eq_ok = 0;$in_eq_fueralinea = 1; $in_eq_gps_fuera = 0; $in_eq_fueraruta = 0;  $in_eq_alertas = 0;  $in_eq_detenidos = 0;}
								
								/*******************************************************/
								//se guardan estados
								$danger = '';
								if($in_eq_detenidos>0){  $danger = 'info';     $dataex = '<a href="#" title="Equipo Detenido" class="btn btn-danger btn-sm tooltip"><i class="fa fa-car"></i></a>';}
								if($in_eq_alertas>0){    $danger = 'warning';  $dataex = '<a href="#" title="Equipo con Alertas" class="btn btn-warning btn-sm tooltip"><i class="fa fa-exclamation-triangle"></i></a>';}
								if($in_eq_fueraruta>0){  $danger = 'success';  $dataex = '<a href="#" title="Equipo fuera de ruta" class="btn btn-danger btn-sm tooltip"><i class="fa fa-location-arrow"></i></a>';}
								if($in_eq_gps_fuera>0){  $danger = 'warning';  $dataex = '<a href="#" title="Equipo con GPS en 0" class="btn btn-danger btn-sm tooltip"><i class="fa fa-map-marker"></i></a>';}
								if($in_eq_fueralinea>0){ $danger = 'danger';   $dataex = '<a href="#" title="Fuera de Linea" class="btn btn-danger btn-sm tooltip"><i class="fa fa-chain-broken"></i></a>';}
															
								/*******************************************************/
								//traspasan los estados
								if($in_eq_ok==1){
									$eq_ok = '<a href="#" title="Sin Problemas" class="iframe btn btn-success btn-sm tooltip"><i class="fa fa-check"></i></a>';
								}else{
									$eq_ok = $dataex;
								}
								
								/*******************************************************/
								//se escriben los datos
								$GPS .= '	
									<tr class="odd '.$danger.'">		
										<td>'.$data['Nombre'].'</td>	
										<td>'.$data['Caja'].'</td>	
										<td>'.fecha_estandar($data['LastUpdateFecha']).' a las '.$data['LastUpdateHora'].' hrs</td>	
										<td><div class="btn-group" >'.$eq_ok.'</div></td>			
										<td>
											<div class="btn-group" style="width: 35px;" >
												<a href="telemetria_gestion_flota_view_equipo_mapa.php?view='.$data['idTelemetria'].'" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
											</div>
										</td>
									</tr>';

							}
						
												
							$GPS .= '       
						</tbody>
					</table>
					<script>
						$(document).ready(function(){
						  $("#InputTableFilter_tel_1").on("keyup", function() {
							var value = $(this).val().toLowerCase();
							$("#TableFiltered_tel_1 tr").filter(function() {
							  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
							});
						  });
						});
					</script>
					
					
				</div>	
			</div>	
		</div>
	</div>';



$GPS .= '
<script src="'.DB_SITE.'/LIBS_js/modal/jquery.colorbox.js"></script>

<script>
	$(document).ready(function(){
		//Examples of how to assign the Colorbox event to elements
		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
		$(".callbacks").colorbox({
			onOpen:function(){ alert(\'onOpen: colorbox is about to open\'); },
			onLoad:function(){ alert(\'onLoad: colorbox has started to load the targeted content\'); },
			onComplete:function(){ alert(\'onComplete: colorbox has displayed the loaded content\'); },
			onCleanup:function(){ alert(\'onCleanup: colorbox has begun the close process\'); },
			onClosed:function(){ alert(\'onClosed: colorbox has completely closed\'); }
		});

				
		//Example of preserving a JavaScript event for inline calls.
		$("#click").click(function(){ 
			$(\'#click\').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
</script>
	
	';
	
	return $GPS;
}
/*******************************************************************************************************************/
//Muestra el widget del superadministrador
function widget_superadmin($dbConn, $DB_SERVER, $DB_USER, $DB_PASS, $DB_NAME_1, $DB_NAME_2){
	
	//tamaño maximo de las carpetas
	$max_folder = 102400/1024;
	$max_site   = 204800/1024;
	//Verifico el tamaño de los directorios
	$folder_backup = cantidades(MeDir('./backups', 1)/1024000, 2);
	$folder_upload = cantidades(MeDir('./upload', 1)/1024000, 2);
	$folder_root   = cantidades(MeDir('.', 1)/1024000, 2);
	//Se calcula el porcentaje
	$porc_1 = cantidades(($folder_backup / $max_folder)*100, 0);
	$porc_2 = cantidades(($folder_upload / $max_folder)*100, 0);
	$porc_3 = cantidades(($folder_root / $max_site)*100, 0);
	
	//se verifica la cantidad de errores en el sistema
	$handle = fopen("error_log","r");
	static $b = 0;
	while($a = fgets($handle)) {
		$b++;
	}
	$b = $b-1;
	
	

					
						
	$widget = '

    
<div class="row">
    <div class="col-md-12">
        <div class="box superadmin_box">
            <div class="box-header with-border">
				<h3 class="box-title">Informacion del Sistema</h3>	  
            </div>
            

			<div class="box-body" style="padding-top:5px;">
				<div class="row">
					<div class="col-md-8">
						
						<div class="chart">				
							<iframe class="col-sm-12 col-md-12 col-sm-12" frameborder="0" height="400" src="'.DB_SITE.'/EXTERNAL_LIBS/linfo/index.php"></iframe>
						</div>
									 
					</div>
									
					<div class="col-md-4">
						<div class="col-md-12">
							<p class="text-center">
								<strong>Tamaño de Carpetas</strong>
							</p>
							
							<div class="progress-group">
								<span class="progress-text">Root</span>
								<span class="progress-number"><b>'.$folder_root.'</b>/'.$max_site.' MB</span>
								<div class="progress sm">
									<div class="progress-bar progress-bar-green" style="width: '.$porc_3.'%"></div>
								</div>
							</div>

							<div class="progress-group">
								<span class="progress-text">Backups Database</span>
								<span class="progress-number"><b>'.$folder_backup.'</b>/'.$max_folder.' MB</span>
								<div class="progress sm">
									<div class="progress-bar progress-bar-aqua" style="width: '.$porc_1.'%"></div>
								</div>
							</div>
											  			  
							<div class="progress-group">
								<span class="progress-text">Subidas</span>
								<span class="progress-number"><b>'.$folder_upload.'</b>/'.$max_folder.' MB</span>
								<div class="progress sm">
									<div class="progress-bar progress-bar-red" style="width: '.$porc_2.'%"></div>
								</div>
							</div>
											  
							<p class="text-center">
								<strong>Log del sistema</strong>
							</p>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Errores          <span class="pull-right text-red">0</span></a></li>
								<li><a href="#">Advertencias     <span class="pull-right text-yellow">'.$b.'</span></a></li>
								<li><a href="#">Otros            <span class="pull-right text-green">0</span></a></li>
							</ul>
							
							
										  
						</div>
								   
					</div>
				</div>
						  
			</div>
           
          
            
		</div>
	</div>  
</div>
      
      
	';
	
	
	return $widget;						
}
/*******************************************************************************************************************/
//Muestra los documentos relacionados
function widget_Doc_relacionados($idOcompra,
								$idTipoUsuario, $idSistema,
								$dbConn){
	//Variables
	$z1="WHERE bodegas_insumos_facturacion.idFacturacion!=0";  
	$z2="WHERE bodegas_productos_facturacion.idFacturacion!=0";          
	$z3="WHERE bodegas_arriendos_facturacion.idFacturacion!=0";        
	$z4="WHERE bodegas_servicios_facturacion.idFacturacion!=0";        
	//verifico que sea un administrador
	if($idTipoUsuario==1){
		$z0="WHERE ocompra_listado.idSistema>=0";	
		$z1.=" AND bodegas_insumos_facturacion.idSistema>=0";
		$z2.=" AND bodegas_productos_facturacion.idSistema>=0";
		$z3.=" AND bodegas_arriendos_facturacion.idSistema>=0";
		$z4.=" AND bodegas_servicios_facturacion.idSistema>=0";		
	}else{
		$z0="WHERE ocompra_listado.idSistema={$idSistema}";	
		$z1.=" AND bodegas_insumos_facturacion.idSistema={$idSistema}";
		$z2.=" AND bodegas_productos_facturacion.idSistema={$idSistema}";
		$z3.=" AND bodegas_arriendos_facturacion.idSistema={$idSistema}";
		$z4.=" AND bodegas_servicios_facturacion.idSistema={$idSistema}";
	}
	//filtro por ordenes
	$z0.=" AND ocompra_listado.idOcompra={$idOcompra}";
	$z1.=" AND ocompra_listado.idOcompra={$idOcompra}";
	$z2.=" AND ocompra_listado.idOcompra={$idOcompra}";
	$z3.=" AND ocompra_listado.idOcompra={$idOcompra}";
	$z4.=" AND ocompra_listado.idOcompra={$idOcompra}";
	/******************************************************/
	//consulta
	$arrOrdenes = array();
	$query = "SELECT 
	ocompra_listado.idOcompra,
	ocompra_listado.Creacion_fecha,
	proveedor_listado.Nombre AS NombreProveedor
	FROM `ocompra_listado`
	LEFT JOIN `proveedor_listado`     ON proveedor_listado.idProveedor      = ocompra_listado.idProveedor
	".$z0."
	ORDER BY ocompra_listado.idOcompra DESC";
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	//Si ejecuto correctamente la consulta
	if(!$resultado){
		//Genero numero aleatorio
		$vardata = genera_password(8,'alfanumerico');
					
		//Guardo el error en una variable temporal
		$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
		$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
		$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
	}
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrOrdenes,$row );
	}
	/******************************************************/
	// Se trae un listado con todos los usuarios
	$arrInsumos = array();
	$query = "SELECT 
	bodegas_insumos_facturacion.idFacturacion,
	bodegas_insumos_facturacion.Creacion_fecha,
	bodegas_insumos_facturacion.F_Pago,
	bodegas_insumos_facturacion.N_Doc,
	bodegas_insumos_facturacion.ValorTotal,
	core_sistemas.Nombre AS Sistema,
	core_documentos_mercantiles.Nombre_abrev AS Documento,
	proveedor_listado.Nombre AS Proveedor,
	core_estado_facturacion.Nombre AS Estado

	FROM `bodegas_insumos_facturacion`
	LEFT JOIN `core_sistemas`                 ON core_sistemas.idSistema                    = bodegas_insumos_facturacion.idSistema
	LEFT JOIN `core_documentos_mercantiles`   ON core_documentos_mercantiles.idDocumentos   = bodegas_insumos_facturacion.idDocumentos
	LEFT JOIN `proveedor_listado`             ON proveedor_listado.idProveedor              = bodegas_insumos_facturacion.idProveedor
	LEFT JOIN `ocompra_listado`               ON ocompra_listado.idOcompra                  = bodegas_insumos_facturacion.idOcompra
	LEFT JOIN `core_estado_facturacion`       ON core_estado_facturacion.idEstado           = bodegas_insumos_facturacion.idEstado
	".$z1."
	ORDER BY bodegas_insumos_facturacion.F_Pago ASC, proveedor_listado.Nombre ASC, bodegas_insumos_facturacion.N_Doc ASC";
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	//Si ejecuto correctamente la consulta
	if(!$resultado){
		//Genero numero aleatorio
		$vardata = genera_password(8,'alfanumerico');
					
		//Guardo el error en una variable temporal
		$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
		$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
		$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
	}
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrInsumos,$row );
	}
	/******************************************************/
	// Se trae un listado con todos los usuarios
	$arrProductos = array();
	$query = "SELECT 
	bodegas_productos_facturacion.idFacturacion,
	bodegas_productos_facturacion.Creacion_fecha,
	bodegas_productos_facturacion.F_Pago,
	bodegas_productos_facturacion.N_Doc,
	bodegas_productos_facturacion.ValorTotal,
	core_sistemas.Nombre AS Sistema,
	core_documentos_mercantiles.Nombre_abrev AS Documento,
	proveedor_listado.Nombre AS Proveedor,
	core_estado_facturacion.Nombre AS Estado

	FROM `bodegas_productos_facturacion`
	LEFT JOIN `core_sistemas`                ON core_sistemas.idSistema                   = bodegas_productos_facturacion.idSistema
	LEFT JOIN `core_documentos_mercantiles`  ON core_documentos_mercantiles.idDocumentos  = bodegas_productos_facturacion.idDocumentos
	LEFT JOIN `proveedor_listado`            ON proveedor_listado.idProveedor             = bodegas_productos_facturacion.idProveedor
	LEFT JOIN `ocompra_listado`              ON ocompra_listado.idOcompra                 = bodegas_productos_facturacion.idOcompra
	LEFT JOIN `core_estado_facturacion`      ON core_estado_facturacion.idEstado          = bodegas_productos_facturacion.idEstado
	".$z2."
	ORDER BY bodegas_productos_facturacion.F_Pago ASC, proveedor_listado.Nombre ASC, bodegas_productos_facturacion.N_Doc ASC";
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	//Si ejecuto correctamente la consulta
	if(!$resultado){
		//Genero numero aleatorio
		$vardata = genera_password(8,'alfanumerico');
					
		//Guardo el error en una variable temporal
		$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
		$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
		$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
	}
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrProductos,$row );
	}
	/******************************************************/
	// Se trae un listado con todos los usuarios
	$arrArriendos = array();
	$query = "SELECT 
	bodegas_arriendos_facturacion.idFacturacion,
	bodegas_arriendos_facturacion.Creacion_fecha,
	bodegas_arriendos_facturacion.F_Pago,
	bodegas_arriendos_facturacion.N_Doc,
	bodegas_arriendos_facturacion.ValorTotal,
	core_sistemas.Nombre AS Sistema,
	core_documentos_mercantiles.Nombre_abrev AS Documento,
	proveedor_listado.Nombre AS Proveedor,
	core_estado_facturacion.Nombre AS Estado

	FROM `bodegas_arriendos_facturacion`
	LEFT JOIN `core_sistemas`                 ON core_sistemas.idSistema                    = bodegas_arriendos_facturacion.idSistema
	LEFT JOIN `core_documentos_mercantiles`   ON core_documentos_mercantiles.idDocumentos   = bodegas_arriendos_facturacion.idDocumentos
	LEFT JOIN `proveedor_listado`             ON proveedor_listado.idProveedor              = bodegas_arriendos_facturacion.idProveedor
	LEFT JOIN `ocompra_listado`               ON ocompra_listado.idOcompra                  = bodegas_arriendos_facturacion.idOcompra
	LEFT JOIN `core_estado_facturacion`       ON core_estado_facturacion.idEstado           = bodegas_arriendos_facturacion.idEstado
	".$z3."
	ORDER BY bodegas_arriendos_facturacion.F_Pago ASC, proveedor_listado.Nombre ASC, bodegas_arriendos_facturacion.N_Doc ASC";
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	//Si ejecuto correctamente la consulta
	if(!$resultado){
		//Genero numero aleatorio
		$vardata = genera_password(8,'alfanumerico');
					
		//Guardo el error en una variable temporal
		$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
		$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
		$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
	}
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrArriendos,$row );
	}
	/******************************************************/
	// Se trae un listado con todos los usuarios
	$arrServicios = array();
	$query = "SELECT 
	bodegas_servicios_facturacion.idFacturacion,
	bodegas_servicios_facturacion.Creacion_fecha,
	bodegas_servicios_facturacion.F_Pago,
	bodegas_servicios_facturacion.N_Doc,
	bodegas_servicios_facturacion.ValorTotal,
	core_sistemas.Nombre AS Sistema,
	core_documentos_mercantiles.Nombre_abrev AS Documento,
	proveedor_listado.Nombre AS Proveedor,
	core_estado_facturacion.Nombre AS Estado

	FROM `bodegas_servicios_facturacion`
	LEFT JOIN `core_sistemas`                 ON core_sistemas.idSistema                    = bodegas_servicios_facturacion.idSistema
	LEFT JOIN `core_documentos_mercantiles`   ON core_documentos_mercantiles.idDocumentos   = bodegas_servicios_facturacion.idDocumentos
	LEFT JOIN `proveedor_listado`             ON proveedor_listado.idProveedor              = bodegas_servicios_facturacion.idProveedor
	LEFT JOIN `ocompra_listado`               ON ocompra_listado.idOcompra                  = bodegas_servicios_facturacion.idOcompra
	LEFT JOIN `core_estado_facturacion`       ON core_estado_facturacion.idEstado           = bodegas_servicios_facturacion.idEstado
	".$z4."
	ORDER BY bodegas_servicios_facturacion.F_Pago ASC, proveedor_listado.Nombre ASC, bodegas_servicios_facturacion.N_Doc ASC";
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	//Si ejecuto correctamente la consulta
	if(!$resultado){
		//Genero numero aleatorio
		$vardata = genera_password(8,'alfanumerico');
					
		//Guardo el error en una variable temporal
		$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
		$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
		$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
	}
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrServicios,$row );
	}
	
	$html = '';
	/******************************************************/
	$html .= '
	<div class="col-sm-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Documentos Relacionados</h5>
			</header>
			<div class="table-responsive">   
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<thead>
						<tr role="row">
							<th>Tipo</th>
							<th>Proveedor</th>
							<th>Documento</th>
							<th>Fecha Emision</th>
							<th>Fecha Pago</th>
							<th>Estado</th>
							<th width="10">Acciones</th>
						</tr>
					</thead>			  
					<tbody role="alert" aria-live="polite" aria-relevant="all">';
							foreach ($arrOrdenes as $orden) {
								$html .= '
								<tr class="odd">
									<td>OC</td>
									<td>'.$orden['NombreProveedor'].'</td>
									<td>OC '.n_doc($orden['idOcompra'], 5).'</td>
									<td>'.Fecha_estandar($orden['Creacion_fecha']).'</td>
									<td></td>
									<td></td>
									<td>
										<div class="btn-group" style="width: 35px;" >
											<a href="view_ocompra.php?view='.$orden['idOcompra'].'" title="Ver Orden" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
										</div>
									</td>
								</tr>';
							} 
							foreach ($arrInsumos as $tipo) {
								$html .= '
								<tr class="odd">
									<td>Insumos</td>
									<td>'.$tipo['Proveedor'].'</td>
									<td>'.$tipo['Documento'].' '.$tipo['N_Doc'].' <strong>('.valores($tipo['ValorTotal'], 0).'-C/IVA)</strong> </td>
									<td>'.Fecha_estandar($tipo['Creacion_fecha']).'</td>
									<td>'.Fecha_estandar($tipo['F_Pago']).'</td>
									<td>'.$tipo['Estado'].'</td>
									<td>
										<div class="btn-group" style="width: 35px;" >
											<a href="view_mov_insumos.php?view='.$tipo['idFacturacion'].'" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
										</div>
									</td>
								</tr>';
							}
							foreach ($arrProductos as $tipo) {
								$html .= '
								<tr class="odd">
									<td>Materiales</td>
									<td>'.$tipo['Proveedor'].'</td>
									<td>'.$tipo['Documento'].' '.$tipo['N_Doc'].' <strong>('.valores($tipo['ValorTotal'], 0).'-C/IVA)</strong> </td>
									<td>'.Fecha_estandar($tipo['Creacion_fecha']).'</td>
									<td>'.Fecha_estandar($tipo['F_Pago']).'</td>
									<td>'.$tipo['Estado'].'</td>
									<td>
										<div class="btn-group" style="width: 35px;" >
											<a href="view_mov_productos.php?view='.$tipo['idFacturacion'].'" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
										</div>
									</td>
								</tr>';
							}
							foreach ($arrArriendos as $tipo) {
								$html .= '
								<tr class="odd">
									<td>Arriendos</td>
									<td>'.$tipo['Proveedor'].'</td>
									<td>'.$tipo['Documento'].' '.$tipo['N_Doc'].' <strong>('.valores($tipo['ValorTotal'], 0).'-C/IVA)</strong> </td>
									<td>'.Fecha_estandar($tipo['Creacion_fecha']).'</td>
									<td>'.Fecha_estandar($tipo['F_Pago']).'</td>
									<td>'.$tipo['Estado'].'</td>
									<td>
										<div class="btn-group" style="width: 35px;" >
											<a href="view_mov_arriendos.php?view='.$tipo['idFacturacion'].'" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
										</div>
									</td>
								</tr>';
							}
							foreach ($arrServicios as $tipo) {
								$html .= '
								<tr class="odd">
									<td>Servicios</td>
									<td>'.$tipo['Proveedor'].'</td>
									<td>'.$tipo['Documento'].' '.$tipo['N_Doc'].' <strong>('.valores($tipo['ValorTotal'], 0).'-C/IVA)</strong> </td>
									<td>'.Fecha_estandar($tipo['Creacion_fecha']).'</td>
									<td>'.Fecha_estandar($tipo['F_Pago']).'</td>
									<td>'.$tipo['Estado'].'</td>
									<td>
										<div class="btn-group" style="width: 35px;" >
											<a href="view_mov_servicios.php?view='.$tipo['idFacturacion'].'" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
										</div>
									</td>
								</tr>';
							} 
							$html .= '                 
					</tbody>
				</table>
			</div>
		</div>
	</div>
	';
	return $html;	
}



?>
