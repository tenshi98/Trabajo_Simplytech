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
$original = "seguridad_accesos_nominas_cerrar.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idCliente']) && $_GET['idCliente'] != ''){             $location .= "&idCliente=".$_GET['idCliente'];             $search .= "&idCliente=".$_GET['idCliente'];}
if(isset($_GET['N_Doc']) && $_GET['N_Doc'] != ''){                     $location .= "&N_Doc=".$_GET['N_Doc'];                     $search .= "&N_Doc=".$_GET['N_Doc'];}
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha'] != ''){   $location .= "&Creacion_fecha=".$_GET['Creacion_fecha'];   $search .= "&Creacion_fecha=".$_GET['Creacion_fecha'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if ( !empty($_POST['submit_modBase']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'Edit_mod_nomina';
	require_once 'A1XRXS_sys/xrxs_form/z_seguridad_accesos_nominas.php';
}
/**********************************************/
//formulario para crear
if ( !empty($_POST['submit_edit_persona']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'Edit_edit_persona_nomina';
	require_once 'A1XRXS_sys/xrxs_form/z_seguridad_accesos_nominas.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Boleta de Honorarios Realizada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Boleta de Honorarios Modificada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Boleta de Honorarios borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['editPersona']) ) {  
// consulto los datos
$query = "SELECT Fecha, HoraEntrada, HoraSalida, idEstado, Nombre
FROM `seguridad_accesos_nominas_listado`
WHERE idNomina = ".$_GET['editPersona'];
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

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Editar Asistencia de <?php echo $row_data['Nombre']; ?></h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($Fecha)) {         $x1  = $Fecha;          }else{$x1  = $row_data['Fecha'];}
				if(isset($HoraEntrada)) {   $x2  = $HoraEntrada;    }elseif($row_data['HoraEntrada']!='00:00:00'){$x2  = $row_data['HoraEntrada'];  }else{$x2  = '';}
				if(isset($HoraSalida)) {    $x3  = $HoraSalida;     }elseif($row_data['HoraEntrada']!='00:00:00'){$x3  = $row_data['HoraSalida'];   }else{$x3  = '';}
				if(isset($idEstado)) {      $x4  = $idEstado;       }else{$x4  = $row_data['idEstado'];}
				  
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha','Fecha', $x1, 2);
				$Form_Inputs->form_time('Hora Inicio','HoraEntrada', $x2, 2, 2);
				$Form_Inputs->form_time('Hora Termino','HoraTerminoProgramada', $x3, 2, 2);
				$Form_Inputs->form_select('Estado','idEstado', $x4, 2, 'idEstado', 'Nombre', 'core_estado_nomina_asistencia', 0, '', $dbConn);
				
				$Form_Inputs->form_input_hidden('idNomina', $_GET['editPersona'], 2);
				
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit_persona"> 
					<a href="<?php echo $location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>                
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['modBase']) ) { 
// consulto los datos
$query = "SELECT idEstado
FROM `seguridad_accesos_nominas`
WHERE idAcceso = ".$_GET['id'];
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

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Modificar datos basicos del Ingreso</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idEstado)) { $x1  = $idEstado;  }else{$x1  = $row_data['idEstado'];}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select('Estado','idEstado', $x1, 1, 'idEstado', 'Nombre', 'core_estado_caja', 0, '', $dbConn);
				
				$Form_Inputs->form_input_hidden('idAcceso', $_GET['id'], 2);
				?> 

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_modBase"> 
					<a href="<?php echo $location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['id']) ) { 
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn); 
// consulto los datos
$query = "SELECT 
seguridad_accesos_nominas.FechaProgramada,
seguridad_accesos_nominas.HoraInicioProgramada,
seguridad_accesos_nominas.HoraTerminoProgramada,
core_sistemas.Nombre AS Sistema,
usuarios_listado.Nombre AS Usuario,
ubicacion_listado.Nombre AS Ubicacion,
ubicacion_listado_level_1.Nombre AS UbicacionLVL_1,
ubicacion_listado_level_2.Nombre AS UbicacionLVL_2,
ubicacion_listado_level_3.Nombre AS UbicacionLVL_3,
ubicacion_listado_level_4.Nombre AS UbicacionLVL_4,
ubicacion_listado_level_5.Nombre AS UbicacionLVL_5,
seguridad_accesos_nominas.PersonaReunion,
core_estado_caja.Nombre AS Estado

FROM `seguridad_accesos_nominas`
LEFT JOIN `usuarios_listado`            ON usuarios_listado.idUsuario            = seguridad_accesos_nominas.idUsuario
LEFT JOIN `core_sistemas`               ON core_sistemas.idSistema               = seguridad_accesos_nominas.idSistema
LEFT JOIN `ubicacion_listado`           ON ubicacion_listado.idUbicacion         = seguridad_accesos_nominas.idUbicacion
LEFT JOIN `ubicacion_listado_level_1`   ON ubicacion_listado_level_1.idLevel_1   = seguridad_accesos_nominas.idUbicacion_lvl_1
LEFT JOIN `ubicacion_listado_level_2`   ON ubicacion_listado_level_2.idLevel_2   = seguridad_accesos_nominas.idUbicacion_lvl_2
LEFT JOIN `ubicacion_listado_level_3`   ON ubicacion_listado_level_3.idLevel_3   = seguridad_accesos_nominas.idUbicacion_lvl_3
LEFT JOIN `ubicacion_listado_level_4`   ON ubicacion_listado_level_4.idLevel_4   = seguridad_accesos_nominas.idUbicacion_lvl_4
LEFT JOIN `ubicacion_listado_level_5`   ON ubicacion_listado_level_5.idLevel_5   = seguridad_accesos_nominas.idUbicacion_lvl_5
LEFT JOIN `core_estado_caja`            ON core_estado_caja.idEstado             = seguridad_accesos_nominas.idEstado

WHERE seguridad_accesos_nominas.idAcceso = ".$_GET['id'];
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


/*****************************************/		
// Se trae un listado con todos los otros
$arrPersonas = array();
$query = "SELECT 
seguridad_accesos_nominas_listado.idNomina,
seguridad_accesos_nominas_listado.Fecha, 
seguridad_accesos_nominas_listado.HoraEntrada, 
seguridad_accesos_nominas_listado.HoraSalida, 
seguridad_accesos_nominas_listado.Nombre, 
seguridad_accesos_nominas_listado.Rut, 
seguridad_accesos_nominas_listado.NDocCedula,
core_estado_nomina_asistencia.Nombre AS Estado

FROM `seguridad_accesos_nominas_listado` 
LEFT JOIN `core_estado_nomina_asistencia`   ON core_estado_nomina_asistencia.idEstado  = seguridad_accesos_nominas_listado.idEstado
WHERE seguridad_accesos_nominas_listado.idAcceso = ".$_GET['id'];
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
array_push( $arrPersonas,$row );
}

/*****************************************/		
// Se trae un listado con todos los archivos adjuntos
$arrArchivo = array();
$query = "SELECT idFile, Nombre
FROM `seguridad_accesos_nominas_archivos` 
WHERE idAcceso = ".$_GET['id'];
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
array_push( $arrArchivo,$row );
}	 
	 
?>

 


<div class="col-sm-12">

	<div id="page-wrap">
		<div id="header"> Nomina de Control de Accesos</div>

		
		<div id="customer">
			
			<table id="meta" class="fleft otdata">
				<tbody>
					<tr>
						<td class="meta-head"><strong>DATOS BASICOS</strong></td>
						<td class="meta-head"><a href="<?php echo $location.'&id='.$_GET['id'].'&modBase=true' ?>" title="Modificar Datos Basicos" class="btn btn-xs btn-primary tooltip fright" style="position: initial;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar</a></td>
					</tr>
					<tr>
						<td class="meta-head">Usuario</td>
						<td><?php echo $row_data['Usuario']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Sistema</td>
						<td><?php echo $row_data['Sistema']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Ubicacion</td>
						<td>
							<?php 
								echo $row_data['Ubicacion'];
								if(isset($row_data['UbicacionLVL_1'])&&$row_data['UbicacionLVL_1']!=''){echo ' - '.$row_data['UbicacionLVL_1'];}
								if(isset($row_data['UbicacionLVL_2'])&&$row_data['UbicacionLVL_2']!=''){echo ' - '.$row_data['UbicacionLVL_2'];}
								if(isset($row_data['UbicacionLVL_3'])&&$row_data['UbicacionLVL_3']!=''){echo ' - '.$row_data['UbicacionLVL_3'];}
								if(isset($row_data['UbicacionLVL_4'])&&$row_data['UbicacionLVL_4']!=''){echo ' - '.$row_data['UbicacionLVL_4'];}
								if(isset($row_data['UbicacionLVL_5'])&&$row_data['UbicacionLVL_5']!=''){echo ' - '.$row_data['UbicacionLVL_5'];}
								
							?>
						</td>
					</tr>
					<tr>
						<td class="meta-head">Persona Reunion</td>
						<td><?php echo $row_data['PersonaReunion']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Estado</td>
						<td><?php echo $row_data['Estado']; ?></td>
					</tr>
				</tbody>
			</table>
			<table id="meta" class="otdata2">
				<tbody>
					<tr>
						<td class="meta-head">Fecha Programada</td>
						<td colspan="2"><?php echo Fecha_estandar($row_data['FechaProgramada'])?></td>
					</tr>
					<tr>
						<td class="meta-head">Hora Inicio</td>
						<td colspan="2"><?php echo $row_data['HoraInicioProgramada'];?></td>
					</tr>
					<tr>
						<td class="meta-head">Hora Termino</td>
						<td colspan="2"><?php echo $row_data['HoraTerminoProgramada'];?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<table id="items">
			<tbody>
				
				<tr>
					<th colspan="5">Detalle</th>
					<th width="160">Acciones</th>
				</tr>		  
				
				<tr class="item-row fact_tittle">
					<td colspan="5">Personas a Ingresar</td>
					<td></td>
				</tr>
				<?php
				//listado de servicios
				if ($arrPersonas) {
					//recorro el lsiatdo entregado por la base de datos
					foreach ($arrPersonas as $persona) { ?>
						<tr class="item-row linea_punteada">
							<td class="item-name" colspan="3"><?php echo $persona['Nombre'];?></td>
							<td class="item-name" align="right"><?php echo $persona['Rut'];?></td>
							<td class="item-name" align="right"><?php echo 'N Doc '.$persona['NDocCedula'];?></td>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<a href="<?php echo $location.'&id='.$_GET['id'].'&editPersona='.$persona['idNomina']; ?>" title="Editar Persona" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
								</div>
							</td>
						</tr> 
					 <?php 	
					}
				}
				?>
			</tbody>
		</table>
    </div>
    
    <table id="items" style="margin-bottom: 20px;">
        <tbody>
            
			<tr class="invoice-total" bgcolor="#f1f1f1">
                <td colspan="5">Archivos Adjuntos</td>
                <td width="160"></td>
            </tr>		  
            
			<?php 
			if ($arrArchivo){
				//recorro el lsiatdo entregado por la base de datos
				$numeral = 1;
				foreach ($arrArchivo as $producto){ ?>
					<tr class="item-row">
						<td colspan="5"><?php echo $numeral.' - '.$producto['Nombre']; ?></td>
						<td>
							<div class="btn-group" style="width: 35px;" >
								<a href="<?php echo 'view_doc_preview.php?path='.simpleEncode('upload', fecha_actual()).'&file='.simpleEncode($producto['Nombre'], fecha_actual()); ?>" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a>
							</div>
						</td>
					</tr>
					 
				 <?php 
				$numeral++;	
				}
			}?>

		</tbody>
    </table>


</div>

<?php widget_modal(80, 95); ?>
<div class="clearfix"></div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
} else  { 
/**********************************************************/
//paginador de resultados
if(isset($_GET["pagina"])){
	$num_pag = $_GET["pagina"];	
} else {
	$num_pag = 1;	
}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){
	$comienzo = 0 ;
	$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'usuario_asc':           $order_by = 'ORDER BY usuarios_listado.Nombre ASC ';                                $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Usuario Ascendente'; break;
		case 'usuario_desc':          $order_by = 'ORDER BY usuarios_listado.Nombre DESC ';                               $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Usuario Descendente';break;
		case 'fecha_asc':             $order_by = 'ORDER BY seguridad_accesos_nominas.FechaProgramada ASC ';              $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Programada Ascendente'; break;
		case 'fecha_desc':            $order_by = 'ORDER BY seguridad_accesos_nominas.FechaProgramada DESC ';             $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Programada Descendente';break;
		case 'hora_entrada_asc':      $order_by = 'ORDER BY seguridad_accesos_nominas.HoraInicioProgramada ASC ';         $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Hora Inicio Programada Ascendente'; break;
		case 'hora_entrada_desc':     $order_by = 'ORDER BY seguridad_accesos_nominas.HoraInicioProgramada DESC ';        $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Hora Inicio Programada Descendente';break;
		case 'hora_salida_asc':       $order_by = 'ORDER BY seguridad_accesos_nominas.HoraTerminoProgramada ASC ';        $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Hora Termino Programada Ascendente'; break;
		case 'hora_salida_desc':      $order_by = 'ORDER BY seguridad_accesos_nominas.HoraTerminoProgramada DESC ';       $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Hora Termino Programada Descendente';break;
		case 'destino_asc':           $order_by = 'ORDER BY ubicacion_listado.Nombre ASC ';                               $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Destino Ascendente'; break;
		case 'destino_desc':          $order_by = 'ORDER BY ubicacion_listado.Nombre DESC ';                              $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Destino Descendente';break;
		case 'persona_asc':           $order_by = 'ORDER BY seguridad_accesos_nominas.PersonaReunion ASC ';               $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Persona de Reunion Ascendente'; break;
		case 'persona_desc':          $order_by = 'ORDER BY seguridad_accesos_nominas.PersonaReunion DESC ';              $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Persona de Reunion Descendente';break;
		case 'estado_asc':            $order_by = 'ORDER BY core_estado_caja.Nombre ASC ';                                $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Estado Ascendente'; break;
		case 'estado_desc':           $order_by = 'ORDER BY core_estado_caja.Nombre DESC ';                               $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Estado Descendente';break;
		
		default: $order_by = 'ORDER BY seguridad_accesos_nominas.FechaProgramada DESC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> FechaProgramada Descendente';
	}
}else{
	$order_by = 'ORDER BY seguridad_accesos_nominas.FechaProgramada DESC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> FechaProgramada Descendente';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE seguridad_accesos_nominas.idAcceso!=0";
//Verifico el tipo de usuario que esta ingresando
$z.=" AND seguridad_accesos_nominas.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	
//Verifico el tipo de usuario que esta ingresando
$usrfil = 'usuarios_listado.idEstado=1 AND usuarios_listado.idTipoUsuario!=1';	
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$usrfil .= " AND usuarios_sistemas.idSistema = ".$_SESSION['usuario']['basic_data']['idSistema'];
}
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != '')  {     
	$z .= " AND seguridad_accesos_nominas.idUsuario = '".$_GET['idUsuario']."'" ;
}
if(isset($_GET['h_inicio']) && $_GET['h_inicio'] != ''&&isset($_GET['h_termino']) && $_GET['h_termino'] != ''){ 
	$z .= " AND seguridad_accesos_nominas.HoraInicioProgramada BETWEEN '".$_GET['h_inicio']."' AND '".$_GET['h_termino']."'" ;
}
if(isset($_GET['h_salida_inicio']) && $_GET['h_salida_inicio'] != ''&&isset($_GET['h_salida_termino']) && $_GET['h_salida_termino'] != ''){ 
	$z .= " AND seguridad_accesos_nominas.HoraTerminoProgramada BETWEEN '".$_GET['h_salida_inicio']."' AND '".$_GET['h_salida_termino']."'" ;
}
if(isset($_GET['f_inicio']) && $_GET['f_inicio'] != ''&&isset($_GET['f_termino']) && $_GET['f_termino'] != ''){ 
	$z .= " AND seguridad_accesos_nominas.FechaProgramada BETWEEN '".$_GET['F_inicio']."' AND '".$_GET['F_termino']."'" ;
}
if(isset($_GET['idUbicacion']) && $_GET['idUbicacion'] != ''){               $z .= " AND seguridad_accesos_nominas.idUbicacion='".$_GET['idUbicacion']."'";}
if(isset($_GET['idUbicacion_lvl_1']) && $_GET['idUbicacion_lvl_1'] != ''){   $z .= " AND seguridad_accesos_nominas.idUbicacion_lvl_1='".$_GET['idUbicacion_lvl_1']."'";}
if(isset($_GET['idUbicacion_lvl_2']) && $_GET['idUbicacion_lvl_2'] != ''){   $z .= " AND seguridad_accesos_nominas.idUbicacion_lvl_2='".$_GET['idUbicacion_lvl_2']."'";}
if(isset($_GET['idUbicacion_lvl_3']) && $_GET['idUbicacion_lvl_3'] != ''){   $z .= " AND seguridad_accesos_nominas.idUbicacion_lvl_3='".$_GET['idUbicacion_lvl_3']."'";}
if(isset($_GET['idUbicacion_lvl_4']) && $_GET['idUbicacion_lvl_4'] != ''){   $z .= " AND seguridad_accesos_nominas.idUbicacion_lvl_4='".$_GET['idUbicacion_lvl_4']."'";}
if(isset($_GET['idUbicacion_lvl_5']) && $_GET['idUbicacion_lvl_5'] != ''){   $z .= " AND seguridad_accesos_nominas.idUbicacion_lvl_5='".$_GET['idUbicacion_lvl_5']."'";}
if(isset($_GET['PersonaReunion']) && $_GET['PersonaReunion'] != ''){         $z .= " AND seguridad_accesos_nominas.PersonaReunion LIKE '%".$_GET['PersonaReunion']."%'";}
if(isset($_GET['idEstado']) && $_GET['idEstado'] != ''){                     $z .= " AND seguridad_accesos_nominas.idEstado='".$_GET['idEstado']."'";}

/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idAcceso FROM `seguridad_accesos_nominas` ".$z;
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
$cuenta_registros = mysqli_num_rows($resultado);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los elementos
$arrTipo = array();
$query = "SELECT 
seguridad_accesos_nominas.idAcceso,
seguridad_accesos_nominas.FechaProgramada,
seguridad_accesos_nominas.HoraInicioProgramada,
seguridad_accesos_nominas.HoraTerminoProgramada,
core_sistemas.Nombre AS Sistema,
usuarios_listado.Nombre AS Usuario,
ubicacion_listado.Nombre AS Ubicacion,
ubicacion_listado_level_1.Nombre AS UbicacionLVL_1,
ubicacion_listado_level_2.Nombre AS UbicacionLVL_2,
ubicacion_listado_level_3.Nombre AS UbicacionLVL_3,
ubicacion_listado_level_4.Nombre AS UbicacionLVL_4,
ubicacion_listado_level_5.Nombre AS UbicacionLVL_5,
seguridad_accesos_nominas.PersonaReunion,
core_estado_caja.Nombre AS Estado,
seguridad_accesos_nominas.idEstado

FROM `seguridad_accesos_nominas`
LEFT JOIN `usuarios_listado`            ON usuarios_listado.idUsuario            = seguridad_accesos_nominas.idUsuario
LEFT JOIN `core_sistemas`               ON core_sistemas.idSistema               = seguridad_accesos_nominas.idSistema
LEFT JOIN `ubicacion_listado`           ON ubicacion_listado.idUbicacion         = seguridad_accesos_nominas.idUbicacion
LEFT JOIN `ubicacion_listado_level_1`   ON ubicacion_listado_level_1.idLevel_1   = seguridad_accesos_nominas.idUbicacion_lvl_1
LEFT JOIN `ubicacion_listado_level_2`   ON ubicacion_listado_level_2.idLevel_2   = seguridad_accesos_nominas.idUbicacion_lvl_2
LEFT JOIN `ubicacion_listado_level_3`   ON ubicacion_listado_level_3.idLevel_3   = seguridad_accesos_nominas.idUbicacion_lvl_3
LEFT JOIN `ubicacion_listado_level_4`   ON ubicacion_listado_level_4.idLevel_4   = seguridad_accesos_nominas.idUbicacion_lvl_4
LEFT JOIN `ubicacion_listado_level_5`   ON ubicacion_listado_level_5.idLevel_5   = seguridad_accesos_nominas.idUbicacion_lvl_5
LEFT JOIN `core_estado_caja`            ON core_estado_caja.idEstado             = seguridad_accesos_nominas.idEstado

".$z."
".$order_by."
LIMIT $comienzo, $cant_reg ";
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
array_push( $arrTipo,$row );
}?>

<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($idUsuario)) {           $x1  = $idUsuario;           }else{$x1  = '';}
				if(isset($f_inicio)) {            $x2  = $f_inicio;            }else{$x2  = '';}
				if(isset($f_termino)) {           $x3  = $f_termino;           }else{$x3  = '';}
				if(isset($h_inicio)) {            $x4  = $h_inicio;            }else{$x4  = '';}
				if(isset($h_termino)) {           $x5  = $h_termino;           }else{$x5  = '';}
				if(isset($h_salida_inicio)) {     $x6  = $h_salida_inicio;     }else{$x6  = '';}
				if(isset($h_salida_termino)) {    $x7  = $h_salida_termino;    }else{$x7  = '';}
				if(isset($idUbicacion)) {         $x8  = $idUbicacion;         }else{$x8  = '';}
				if(isset($idUbicacion_lvl_1)) {   $x9  = $idUbicacion_lvl_1;   }else{$x9  = '';}
				if(isset($idUbicacion_lvl_2)) {   $x10 = $idUbicacion_lvl_2;   }else{$x10 = '';}
				if(isset($idUbicacion_lvl_3)) {   $x11 = $idUbicacion_lvl_3;   }else{$x11 = '';}
				if(isset($idUbicacion_lvl_4)) {   $x12 = $idUbicacion_lvl_4;   }else{$x12 = '';}
				if(isset($idUbicacion_lvl_5)) {   $x13 = $idUbicacion_lvl_5;   }else{$x13 = '';}
				if(isset($PersonaReunion)) {      $x14 = $PersonaReunion;      }else{$x14 = '';}
				if(isset($idEstado)) {            $x15 = $idEstado;            }else{$x15 = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_join_filter('Usuario','idUsuario', $x1, 1, 'idUsuario', 'Nombre', 'usuarios_listado', 'usuarios_sistemas', $usrfil, $dbConn);
				$Form_Inputs->form_date('FechaProgramada Inicio','f_inicio', $x2, 1);
				$Form_Inputs->form_date('FechaProgramada Termino','f_termino', $x3, 1);
				$Form_Inputs->form_time('HoraInicioProgramada Entrada Inicio','h_inicio', $x4, 1, 1);
				$Form_Inputs->form_time('HoraInicioProgramada Entrada Termino','h_termino', $x5, 1, 1);
				$Form_Inputs->form_time('HoraInicioProgramada Salida Inicio','h_salida_inicio', $x6, 1, 1);
				$Form_Inputs->form_time('HoraInicioProgramada Salida Termino','h_salida_termino', $x7, 1, 1);
				$Form_Inputs->form_select_depend5('Destino', 'idUbicacion',  $x8,  1,  'idUbicacion',  'Nombre',  'ubicacion_listado',  'idEstado=1 AND idSistema='.$_SESSION['usuario']['basic_data']['idSistema'],   0,
												  'Nivel 1', 'idUbicacion_lvl_1',  $x9,  1,  'idLevel_1',  'Nombre',  'ubicacion_listado_level_1',  0,   0, 
												  'Nivel 2', 'idUbicacion_lvl_2',  $x10,  1,  'idLevel_2',  'Nombre',  'ubicacion_listado_level_2',  0,   0,
												  'Nivel 3', 'idUbicacion_lvl_3',  $x11,  1,  'idLevel_3',  'Nombre',  'ubicacion_listado_level_3',  0,   0,
												  'Nivel 4', 'idUbicacion_lvl_4',  $x12,  1,  'idLevel_4',  'Nombre',  'ubicacion_listado_level_4',  0,   0,
												  'Nivel 5', 'idUbicacion_lvl_5',  $x13,  1,  'idLevel_5',  'Nombre',  'ubicacion_listado_level_5',  0,   0,
												  $dbConn, 'form1');
				$Form_Inputs->form_input_text('Persona Reunion', 'PersonaReunion', $x14, 1);
				$Form_Inputs->form_select('Estado','idEstado', $x15, 1, 'idEstado', 'Nombre', 'core_estado_caja', 0, '', $dbConn);
					
				$Form_Inputs->form_input_hidden('pagina', $_GET['pagina'], 1);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="filtro_form">
					<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>
        </div>
	</div>
</div>
<div class="clearfix"></div> 
                    
                                 
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Nominas Visitas</h5>
			<div class="toolbar">
				<?php 
				//se llama al paginador
				echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
			</div>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>
							<div class="pull-left">Fecha Programada</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fecha_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=fecha_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Hora Inicio</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=hora_entrada_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=hora_entrada_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Hora Termino</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=hora_salida_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=hora_salida_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Destino</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=destino_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=destino_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Persona Reunion</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=persona_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=persona_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Estado</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=estado_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=estado_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>				  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrTipo as $tipo) { ?>
						<tr class="odd">
							<td><?php echo fecha_estandar($tipo['FechaProgramada']); ?></td>
							<td><?php echo $tipo['HoraInicioProgramada']; ?></td>
							<td><?php echo $tipo['HoraTerminoProgramada']; ?></td>
							<td>
								<?php echo $tipo['Ubicacion']; 
								if(isset($tipo['UbicacionLVL_1'])&&$tipo['UbicacionLVL_1']!=''){echo ' - '.$tipo['UbicacionLVL_1'];}
								if(isset($tipo['UbicacionLVL_2'])&&$tipo['UbicacionLVL_2']!=''){echo ' - '.$tipo['UbicacionLVL_2'];}
								if(isset($tipo['UbicacionLVL_3'])&&$tipo['UbicacionLVL_3']!=''){echo ' - '.$tipo['UbicacionLVL_3'];}
								if(isset($tipo['UbicacionLVL_4'])&&$tipo['UbicacionLVL_4']!=''){echo ' - '.$tipo['UbicacionLVL_4'];}
								if(isset($tipo['UbicacionLVL_5'])&&$tipo['UbicacionLVL_5']!=''){echo ' - '.$tipo['UbicacionLVL_5'];}
								?>
							</td>
							<td><?php echo $tipo['PersonaReunion']; ?></td>
							<td><label class="label <?php if(isset($tipo['idEstado'])&&$tipo['idEstado']==1){echo 'label-success';}else{echo 'label-danger';}?>"><?php echo $tipo['Estado']; ?></label></td>		
							<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $tipo['Sistema']; ?></td><?php } ?>
							<td>
								<div class="btn-group" style="width: 70px;" >
									<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_seguridad_accesos_nominas.php?view='.simpleEncode($tipo['idAcceso'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$tipo['idAcceso']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>							
								</div>
							</td>
						</tr>
					<?php } ?>                    
				</tbody>
			</table>
		</div>
		<div class="pagrow">	
			<?php 
			//se llama al paginador
			echo paginador_2('paginf',$total_paginas, $original, $search, $num_pag ) ?>
		</div>
	</div>
</div>
<?php widget_modal(80, 95); ?>
<?php } ?>          
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
