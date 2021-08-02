<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Web.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "comunicaciones_calendario_listado.php";
$location = $original;
//Se agregan ubicaciones
if(isset($_GET['Mes']) && $_GET['Mes'] != ''){  $location .= "?Mes=".$_GET['Mes']; } else { $location .= "?Mes=".mes_actual(); }
if(isset($_GET['Ano']) && $_GET['Ano'] != ''){  $location .= "&Ano=".$_GET['Ano']; } else { $location .= "&Ano=".ano_actual(); }




//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/principal_calendario_listado.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Se agregan ubicaciones
	$location .= "&view=".$_GET['id']; 
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/principal_calendario_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/principal_calendario_listado.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Evento Creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Evento Modificado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Evento borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);
// Se traen todos los datos de mi usuario
$query = "SELECT Fecha, Titulo, Cuerpo, idSistema, idUsuario
FROM `principal_calendario_listado`
WHERE idCalendario = ".$_GET['id'];
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
$rowdata = mysqli_fetch_assoc ($resultado);	?>
 
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Modificacion del Evento</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($Fecha)) {      $x1  = $Fecha;      }else{$x1  = $rowdata['Fecha'];}
				if(isset($Titulo)) {     $x2  = $Titulo;     }else{$x2  = $rowdata['Titulo'];}
				if(isset($Cuerpo)) {     $x3  = $Cuerpo;     }else{$x3  = $rowdata['Cuerpo'];}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha del Evento','Fecha', $x1, 2);
				$Form_Inputs->form_input_text('Titulo', 'Titulo', $x2, 2);
				$Form_Inputs->form_ckeditor('Detalle','Cuerpo', $x3, 2, 2);
				
				
				if($rowdata['idUsuario']==9999){
					$Form_Inputs->form_input_hidden('idUsuario', 9999, 2);
				}
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idCalendario', $_GET['id'], 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit"> 
					<a href="<?php echo $location.'&view='.$_GET['id']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['view']) ) { 
$query = "SELECT 
principal_calendario_listado.Fecha, 
principal_calendario_listado.Titulo, 
principal_calendario_listado.Cuerpo,
usuarios_listado.Nombre AS Autor,
principal_calendario_listado.idUsuario

FROM `principal_calendario_listado`
LEFT JOIN `usuarios_listado` ON usuarios_listado.idUsuario = principal_calendario_listado.idUsuario
WHERE principal_calendario_listado.idCalendario = '".$_GET['view']."'";
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
$row_data = mysqli_fetch_assoc ($resultado);
 ?>
 
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Evento</h5>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					
					<div class="col-sm-4" style="margin-bottom:5px;">
						<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE_REPO ?>/LIB_assets/img/calendario.jpg">
					</div>
					<div class="col-sm-8">
						<h2 class="text-primary">Datos del Evento</h2>
						<p class="text-muted">
							<strong>Autor: </strong><?php if($row_data['idUsuario']!=9999){echo $row_data['Autor'];}else{echo 'Sistema';}?><br/>
							<strong>Titulo: </strong><?php echo $row_data['Titulo'];?><br/>
							<strong>Fecha: </strong><?php echo fecha_estandar($row_data['Fecha']);?>
						</p>
						
						<h2 class="text-primary">Mensaje</h2>
						<p class="text-muted" style="white-space: normal;"><?php echo $row_data['Cuerpo'];?></p>
					
					
						<div class="form-group" >
							<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$_GET["view"]; ?>" class="btn btn-default fright margin_width" >Editar Evento</a><?php }?>
							<?php if ($rowlevel['level']>=4){
								$ubicacion = $location.'&del='.simpleEncode($_GET['view'], fecha_actual());
								$dialogo   = '¿Realmente deseas eliminar el registro?';?>
								<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger fright margin_width" ><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar Evento</a>
							<?php } ?>
						</div>
					
					</div>	
					<div class="clearfix" style="margin-bottom:5px;"></div>
			
				</div>
			</div>
        </div>	
	</div>
</div> 
 
 


<div class="clearfix"></div>
<div class="col-sm-12" style="margin-bottom:30px">
<a href="<?php echo $location; ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div> 
	  
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) {
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn);  ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Evento</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Fecha)) {      $x1  = $Fecha;      }else{$x1  = '';}
				if(isset($Titulo)) {     $x2  = $Titulo;     }else{$x2  = '';}
				if(isset($Cuerpo)) {     $x3  = $Cuerpo;     }else{$x3  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha del Evento','Fecha', $x1, 2);
				$Form_Inputs->form_input_text('Titulo', 'Titulo', $x2, 2);
				$Form_Inputs->form_ckeditor('Detalle','Cuerpo', $x3, 2, 2);
				
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Inputs->form_input_hidden('idUsuario', 9999, 2);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf046; Crear Documento" name="submit">
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>

 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
//Se definen las variables
if(isset($_GET["Mes"])){   $Mes = $_GET["Mes"];   } else { $Mes  = mes_actual(); }
if(isset($_GET["Ano"])){   $Ano = $_GET["Ano"];   } else { $Ano  = ano_actual(); }
$diaActual = dia_actual();

//calculo de los dias del mes, cuando inicia y cuando termina
$diaSemana      = date("w",mktime(0,0,0,$Mes,1,$Ano))+7; 
$ultimoDiaMes   = date("d",(mktime(0,0,0,$Mes+1,1,$Ano)-1));

//arreglo con los meses
$meses=array(1=>"Enero", 
				"Febrero", 
				"Marzo", 
				"Abril", 
				"Mayo", 
				"Junio", 
				"Julio",
				"Agosto", 
				"Septiembre", 
				"Octubre", 
				"Noviembre", 
				"Diciembre"
			);

//verifico el tipo de usuario
$z=" AND idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	

//Traigo los eventos guardados en la base de datos
$arrEventos = array();
$query = "SELECT idCalendario, Titulo, Dia, idUsuario
FROM `principal_calendario_listado`
WHERE Ano='".$Ano."' AND Mes='".$Mes."' ".$z."
ORDER BY Fecha ASC  ";
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
array_push( $arrEventos,$row );
}

?>

<div class="col-sm-12">
<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location.'&new=true'; ?>" class="btn btn-default fright margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Evento</a><?php }?>
</div>




<div class="col-sm-12">
	<div class="box">
		<header>
			<h5>Agenda General</h5>
		</header>
				
		<div id="calendar_content" class="body">
			<div id="calendar" class="fc fc-ltr">

				<table class="fc-header" style="width:100%">
					<tbody>
						<tr>
							<?php
							if(isset($_GET["Ano"])){
								$Ano_a  = $_GET["Ano"];
								$Ano_b  = $_GET["Ano"];	
							} else {
								$Ano_a  = date("Y");
								$Ano_b  = date("Y");
							}
							if (($Mes-1)==0)  {$mes_atras=12;   $Ano_a=$Ano_a-1;}else{$mes_atras=$Mes-1; }
							if (($Mes+1)==13) {$mes_adelante=1; $Ano_b=$Ano_b+1;}else{$mes_adelante=$Mes+1; }
							?>
							<td class="fc-header-left"><a href="<?php echo $original.'?Mes='.$mes_atras.'&Ano='.$Ano_a ?>" class="btn btn-default">‹</a></td>
							<td class="fc-header-center"><span class="fc-header-title"><h2><?php echo $meses[$Mes]." ".$Ano?></h2></span></td>
							<td class="fc-header-right"><a href="<?php echo $original.'?Mes='.$mes_adelante.'&Ano='.$Ano_b ?>" class="btn btn-default">›</a></td>
						</tr>
					</tbody>
				</table>

				<div class="fc-content" style="position: relative;margin-left: -10px;margin-right: -10px;">
					<div class="fc-view fc-view-Mes fc-grid" style="position:relative" unselectable="on">

						<table class="fc-border-separate correct_border" style="width:100%" cellspacing="0"> 
							<thead>
								<tr class="fc-first fc-last"> 
									<th class="fc-day-header fc-sun fc-widget-header" width="14%">Lunes</th>
									<th class="fc-day-header fc-sun fc-widget-header" width="14%">Martes</th>
									<th class="fc-day-header fc-sun fc-widget-header" width="14%">Miercoles</th>
									<th class="fc-day-header fc-sun fc-widget-header" width="14%">Jueves</th>
									<th class="fc-day-header fc-sun fc-widget-header" width="14%">Viernes</th>
									<th class="fc-day-header fc-sun fc-widget-header" width="14%">Sabado</th>
									<th class="fc-day-header fc-sun fc-widget-header" width="14%">Domingo</th>
								</tr>
							</thead>
							<tbody>
								<tr class="fc-week"> 
									<?php
									$last_cell = $diaSemana + $ultimoDiaMes;
									// hacemos un bucle hasta 42, que es el máximo de valores que puede
									// haber... 6 columnas de 7 dias
									for($i=1;$i<=42;$i++){
										// determinamos en que dia empieza
										if($i==$diaSemana){
											$Dia=1;
										}
										// celca vacia
										if($i<$diaSemana || $i>=$last_cell){
											echo "<td class='fc-Dia fc-wed fc-widget-content fc-other-Mes fc-future fc-state-none'> </td>";
										// mostramos el dia
										}else{ ?>  
											<td class="fc-Dia fc-sun fc-widget-content fc-past fc-first <?php if($Dia==$diaActual){ echo 'fc-state-highlight'; }?>">
												<div class="calendar_min">
													<div class="fc-Dia-number"><?php echo $Dia; ?></div>
													<div class="fc-Dia-content">
														<?php foreach ($arrEventos as $evento) { 
															if ($evento['Dia']==$Dia) {
																if ($rowlevel['level']>=1){ $ver = $location.'&view='.$evento['idCalendario'];}else{$ver = '';}
																if ($evento['idUsuario']==9999){
																	echo '<a class="event_calendar evcal_color2" href="'.$ver.'">'.cortar('Administrador : '.$evento['Titulo'], 20).'</a>';
																}else{
																	echo '<a class="event_calendar evcal_color1" href="'.$ver.'">'.cortar('Usuario : '.$evento['Titulo'], 20).'</a>';
																}
															} 
														} ?>    
													</div>
												</div>
											</td>
											<?php  
											$Dia++;
										}
										// cuando llega al final de la semana, iniciamos una columna nueva
										if($i%7==0){
											echo "</tr><tr class='fc-week'>\n";
										}
									}
									?>
								</tr>
							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php } ?>           
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
