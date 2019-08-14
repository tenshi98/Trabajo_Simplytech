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
$original = "informe_telemetria_detenciones.php";
$location = $original;
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['submit_filter']) ) { 

             
  

//tomo el numero de la pagina si es que este existe
if(isset($_GET["pagina"])){
	$num_pag = $_GET["pagina"];	
} else {
	$num_pag = 1;	
}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){
	$comienzo = 0 ;$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
//Inicia variable
$z="WHERE telemetria_listado_error_detenciones.idDetencion>0";
$z.=" AND telemetria_listado.id_Geo='1'";
$search  = '?idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
$search .='&submit_filter=Filtrar';
$search .='&idOpciones=1'; 
//verifico si existen los parametros de fecha
if(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){
	$z.=" AND telemetria_listado_error_detenciones.Fecha BETWEEN '{$_GET['f_inicio']}' AND '{$_GET['f_termino']}'";
	$search .='&f_inicio='.$_GET['f_inicio'].'&f_termino='.$_GET['f_termino'];
}
//verifico si se selecciono un equipo
if(isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!=''){
	$z.=" AND telemetria_listado_error_detenciones.idTelemetria='{$_GET['idTelemetria']}'";
	$search .='&idTelemetria='.$_GET['idTelemetria'];
}
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$z.=" AND telemetria_listado_error_detenciones.idSistema>=0";	
	$join = "";
}else{
	$z.=" AND telemetria_listado_error_detenciones.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	
	$join = " INNER JOIN usuarios_equipos_telemetria ON usuarios_equipos_telemetria.idTelemetria = telemetria_listado_error_detenciones.idTelemetria ";
	$z.=" AND usuarios_equipos_telemetria.idUsuario={$_SESSION['usuario']['basic_data']['idUsuario']}";	
}
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT telemetria_listado_error_detenciones.idDetencion FROM `telemetria_listado_error_detenciones`  LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = telemetria_listado_error_detenciones.idTelemetria ".$join."  ".$z;
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

// Se trae un listado con todos los usuarios
$arrErrores = array();
$query = "SELECT 
telemetria_listado_error_detenciones.idDetencion,
telemetria_listado_error_detenciones.Fecha, 
telemetria_listado_error_detenciones.Hora, 
telemetria_listado_error_detenciones.Tiempo,
telemetria_listado.Nombre AS NombreEquipo

FROM `telemetria_listado_error_detenciones`
LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = telemetria_listado_error_detenciones.idTelemetria
".$join."  ".$z."
ORDER BY idDetencion DESC
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
array_push( $arrErrores,$row );
}

 ?>	

<div class="col-sm-12">
	<a target="new" href="<?php echo 'informe_telemetria_detenciones_to_excel.php'.$search.'&idTipoUsuario='.$_SESSION['usuario']['basic_data']['idTipoUsuario'].'&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'] ; ?>" class="btn btn-sm btn-metis-2 fright margin_width"><i class="fa fa-file-excel-o"></i> Exportar a Excel</a>
	<a target="new" href="<?php echo 'informe_telemetria_detenciones_to_pdf.php'.$search.'&idTipoUsuario='.$_SESSION['usuario']['basic_data']['idTipoUsuario'].'&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'] ; ?>" class="btn btn-sm btn-metis-3 fright margin_width"><i class="fa fa-file-pdf-o"></i> Exportar a PDF</a>
</div>

<div class="col-sm-12">
	<div class="box">	
		<header>		
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Fuera de Linea</h5>	
			<div class="toolbar">
				<?php 
				echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
			</div>
		</header>
		<div class="table-responsive">    
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Nombre Equipo</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Tiempo Detenido</th>
						<th>Ubicacion</th> 
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ( $arrErrores as $error ) { ?>
						<tr>
							<td><?php echo $error['NombreEquipo']; ?></td>
							<td><?php echo fecha_estandar($error['Fecha']); ?></td>
							<td><?php echo $error['Hora'].' hrs'; ?></td>
							<td><?php echo $error['Tiempo'].' hrs'; ?></td>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<a href="<?php echo 'view_telemetria_detenciones.php?view='.$error['idDetencion']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
								</div>
							</td>
						</tr>
					<?php } ?>				                 
				</tbody>
			</table>
		</div>
		<div class="pagrow">	
			<?php 
			echo paginador_2('paginf',$total_paginas, $original, $search, $num_pag ) ?>
		</div>
	</div>
</div>


<?php require_once '../LIBS_js/modal/modal.php';?>
	


<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
			
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$z = "telemetria_listado.idSistema>=0 AND telemetria_listado.id_Geo='1'";
}else{
	$z = "telemetria_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND usuarios_equipos_telemetria.idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']} AND telemetria_listado.id_Geo='1'";		
}
 ?>			
	<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Filtro de busqueda</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" action="<?php echo $location ?>" id="form1" name="form1" novalidate>
               
				<?php 
				//Se verifican si existen los datos
				if(isset($f_inicio)) {      $x1  = $f_inicio;     }else{$x1  = '';}
				if(isset($f_termino)) {     $x2  = $f_termino;    }else{$x2  = '';}
				if(isset($idTelemetria)) {  $x3  = $idTelemetria; }else{$x3  = '';}

				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_date('Fecha Inicio','f_inicio', $x1, 2);
				$Form_Imputs->form_date('Fecha Termino','f_termino', $x2, 2);
				//Verifico el tipo de usuario que esta ingresando
				if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
					$Form_Imputs->form_select_filter('Equipo','idTelemetria', $x3, 1, 'idTelemetria', 'Nombre', 'telemetria_listado', $z, '', $dbConn);	
				}else{
					$Form_Imputs->form_select_join_filter('Equipo','idTelemetria', $x3, 1, 'idTelemetria', 'Nombre', 'telemetria_listado', 'usuarios_equipos_telemetria', $z, $dbConn);
				}
				?>        
	   
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="submit_filter">	
				</div>
			</form>
			<?php require_once '../LIBS_js/validator/form_validator.php';?> 
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
