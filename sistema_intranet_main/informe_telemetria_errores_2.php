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
$original = "informe_telemetria_errores_2.php";
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
$z="WHERE telemetria_listado_errores.idErrores>0"; 
$z.=" AND telemetria_listado_errores.idTipo!='999'";
$z.=" AND telemetria_listado_errores.Valor!='999'";
$z.=" AND telemetria_listado.id_Geo='2'";
$search  = '?idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
$search .='&submit_filter=Filtrar';
$search .='&idOpciones=2';
//verifico si existen los parametros de fecha
if(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){
	$z.=" AND telemetria_listado_errores.Fecha BETWEEN '{$_GET['f_inicio']}' AND '{$_GET['f_termino']}'";
	$search .='&f_inicio='.$_GET['f_inicio'].'&f_termino='.$_GET['f_termino'];
}
//verifico si se selecciono un equipo
if(isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!=''){
	$z.=" AND telemetria_listado_errores.idTelemetria='{$_GET['idTelemetria']}'";
	$search .='&idTelemetria='.$_GET['idTelemetria'];
}
//verifico el tipo de error
if(isset($_GET['idTipo'])&&$_GET['idTipo']!=''){
	$z.=" AND telemetria_listado_errores.idTipo='{$_GET['idTipo']}'";
	$search .='&idTipo='.$_GET['idTipo'];
}
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$z.=" AND telemetria_listado_errores.idSistema>=0";
	$search .='&idTipoUsuario='.$_SESSION['usuario']['basic_data']['idTipoUsuario'];
	$search .='&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
	$join = "";	
}else{
	$z.=" AND telemetria_listado_errores.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";
	$search .='&idTipoUsuario='.$_SESSION['usuario']['basic_data']['idTipoUsuario'];
	$search .='&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
	$join = " INNER JOIN usuarios_equipos_telemetria ON usuarios_equipos_telemetria.idTelemetria = telemetria_listado_errores.idTelemetria ";	
	$z.=" AND usuarios_equipos_telemetria.idUsuario={$_SESSION['usuario']['basic_data']['idUsuario']}";
}
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT telemetria_listado_errores.idErrores FROM `telemetria_listado_errores`  LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = telemetria_listado_errores.idTelemetria ".$join."  ".$z;
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
telemetria_listado_errores.idErrores,
telemetria_listado_errores.Descripcion, 
telemetria_listado_errores.Fecha, 
telemetria_listado_errores.Hora,
telemetria_listado_errores.Sensor, 
telemetria_listado_errores.Valor,
telemetria_listado_errores.Valor_min,
telemetria_listado_errores.Valor_max,
telemetria_listado.Nombre AS NombreEquipo,
telemetria_listado.id_Geo,
SensoresUniMed_1, SensoresUniMed_2, SensoresUniMed_3, SensoresUniMed_4, SensoresUniMed_5, 
SensoresUniMed_6, SensoresUniMed_7, SensoresUniMed_8, SensoresUniMed_9, SensoresUniMed_10, 
SensoresUniMed_11, SensoresUniMed_12, SensoresUniMed_13, SensoresUniMed_14, SensoresUniMed_15, 
SensoresUniMed_16, SensoresUniMed_17, SensoresUniMed_18, SensoresUniMed_19, SensoresUniMed_20, 
SensoresUniMed_21, SensoresUniMed_22, SensoresUniMed_23, SensoresUniMed_24, SensoresUniMed_25, 
SensoresUniMed_26, SensoresUniMed_27, SensoresUniMed_28, SensoresUniMed_29, SensoresUniMed_30, 
SensoresUniMed_31, SensoresUniMed_32, SensoresUniMed_33, SensoresUniMed_34, SensoresUniMed_35, 
SensoresUniMed_36, SensoresUniMed_37, SensoresUniMed_38, SensoresUniMed_39, SensoresUniMed_40, 
SensoresUniMed_41, SensoresUniMed_42, SensoresUniMed_43, SensoresUniMed_44, SensoresUniMed_45, 
SensoresUniMed_46, SensoresUniMed_47, SensoresUniMed_48, SensoresUniMed_49, SensoresUniMed_50


FROM `telemetria_listado_errores`
LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = telemetria_listado_errores.idTelemetria
".$join."  ".$z."
ORDER BY idErrores DESC
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

 ?>	
<div class="col-sm-12">
	<a target="new" href="<?php echo 'informe_telemetria_errores_2_to_excel.php'.$search ; ?>" class="btn btn-sm btn-metis-2 fright margin_width"><i class="fa fa-file-excel-o"></i> Exportar a Excel</a>
	<a target="new" href="<?php echo 'informe_telemetria_errores_2_to_pdf.php'.$search ; ?>" class="btn btn-sm btn-metis-3 fright margin_width"><i class="fa fa-file-pdf-o"></i> Exportar a PDF</a>
</div>
 

<div class="col-sm-12">
	<div class="box">	
		<header>		
			<div class="icons"><i class="fa fa-table"></i></div><h5>Resultados</h5>	
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
						<th>Descripcion</th>
						<th>Fecha</th>
						<th>Hora</th>
                        <th>Medicion Actual</th>
                        <th>Min</th>
                        <th>Max</th>
                        <th>Ubicacion</th>  
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrErrores as $error) {  
							//Guardo la unidad de medida
							$unimed = '';
							foreach ($arrUnimed as $sen) {
								if($error['SensoresUniMed_'.$error['Sensor']]==$sen['idUniMed']){
									$unimed = ' '.$sen['Nombre'];	
								}
							}
							?>
						<tr>
							<td><?php echo $error['NombreEquipo']; ?></td>
							<td><?php echo $error['Descripcion']; ?></td>
							<td><?php echo fecha_estandar($error['Fecha']); ?></td>
							<td><?php echo $error['Hora']; ?></td>
							<td><?php echo Cantidades_decimales_justos($error['Valor']).$unimed; ?></td>
							<td><?php echo Cantidades_decimales_justos($error['Valor_min']).$unimed; ?></td>
							<td><?php echo Cantidades_decimales_justos($error['Valor_max']).$unimed; ?></td>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<a href="<?php echo 'informe_telemetria_errores_2_view.php?view='.$error['idErrores']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
								</div>
							</td>	
						</tr>
                    <?php }  ?>                    
				</tbody>
			</table>
		</div>
		<div class="pagrow">	
			<?php 
			
			echo paginador_2('paginf',$total_paginas, $original, $search, $num_pag ) ?>
		</div>
	</div>
</div>


<?php widget_modal(80, 95); ?>
	


<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
			
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  {  
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$z = "telemetria_listado.idSistema>=0 AND telemetria_listado.id_Geo='2' AND telemetria_listado.id_Sensores=1";
}else{
	$z = "telemetria_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND usuarios_equipos_telemetria.idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']} AND telemetria_listado.id_Geo='2' AND telemetria_listado.id_Sensores=1";		
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
					
				if(isset($f_inicio)) {      $x1  = $f_inicio;      }else{$x1  = '';}
				if(isset($f_termino)) {     $x2  = $f_termino;     }else{$x2  = '';}
				if(isset($idTelemetria)) {  $x3  = $idTelemetria;  }else{$x3  = '';}
				if(isset($idTipo)) {        $x4  = $idTipo;        }else{$x4  = '';}

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
				$Form_Imputs->form_select('Tipo de error','idTipo', $x4, 1, 'idTipo', 'Nombre', 'telemetria_listado_errores_tipos', 0, '', $dbConn);
				?>        
	   
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="submit_filter">	
				</div>
			</form> 
			<?php widget_validator(); ?>
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
