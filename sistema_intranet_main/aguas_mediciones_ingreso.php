<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Web.php';
/** Include PHPExcel */
require_once '../LIBS_php/PHPExcel/PHPExcel/IOFactory.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "aguas_mediciones_ingreso.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Ano']) && $_GET['Ano'] != ''){               $location .= "&Ano=".$_GET['Ano'];               $search .= "&Ano=".$_GET['Ano'];}
if(isset($_GET['idMes']) && $_GET['idMes'] != ''){           $location .= "&idMes=".$_GET['idMes'];           $search .= "&idMes=".$_GET['idMes'];}
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){   $location .= "&idUsuario=".$_GET['idUsuario'];   $search .= "&idUsuario=".$_GET['idUsuario'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/aguas_mediciones_datos.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/aguas_mediciones_datos.php';	
}
/********************************************/
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Se agrega ubicacion
	$location .= "&id=".$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/aguas_mediciones_datos.php';
}
//formulario para editar
if ( !empty($_POST['submit_modConsumo']) )  { 
	//Se agrega ubicacion
	$location .= "&id=".$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'updateConsumo';
	require_once 'A1XRXS_sys/xrxs_form/aguas_mediciones_datos.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Medicion Creada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Medicion Modificada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Medicion borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['modBase']) ) {
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);
//consulta
$query = "SELECT Fecha, Observaciones
FROM `aguas_mediciones_datos`
WHERE idDatos = ".$_GET['modBase'];
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
$rowdata = mysqli_fetch_assoc ($resultado);	 ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Modificacion de los datos basicos</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				if(isset($Fecha)) {            $x1  = $Fecha;            }else{$x1  = $rowdata['Fecha'];}
				if(isset($Observaciones)) {    $x2  = $Observaciones;    }else{$x2  = $rowdata['Observaciones'];}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha de Facturacion','Fecha', $x1, 2);
				$Form_Inputs->form_textarea('Observaciones', 'Observaciones', $x2, 1);
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				
				$Form_Inputs->form_input_hidden('idDatos', $_GET['modBase'], 2);
				?> 

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit"> 
					<a href="<?php echo $location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['edit']) ) {
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);
//consulto
$query = "SELECT Consumo
FROM `aguas_mediciones_datos_detalle`
WHERE idDatosDetalle = ".$_GET['edit'];
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
$rowdata = mysqli_fetch_assoc ($resultado);	 ?>


<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Modificacion del Consumo</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Consumo)) {  $x1  = $Consumo;  }else{$x1  = cantidades_decimales_justos($rowdata['Consumo']);}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_number('Consumo', 'Consumo', $x1, 2);
				
				$Form_Inputs->form_input_hidden('idDatosDetalle', $_GET['edit'], 2);
				?> 

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_modConsumo"> 
					<a href="<?php echo $location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['id']) ) { 
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);
// Se traen todos los datos de la subida
$query = "SELECT 
aguas_mediciones_datos.idDatos,
aguas_mediciones_datos.fCreacion,
aguas_mediciones_datos.Fecha,
aguas_mediciones_datos.Nombre AS NombreArchivo,
aguas_mediciones_datos.Observaciones,
usuarios_listado.Nombre AS NombreUsuario,
core_sistemas.Nombre AS Sistema

FROM `aguas_mediciones_datos`
LEFT JOIN `core_sistemas`     ON core_sistemas.idSistema      = aguas_mediciones_datos.idSistema
LEFT JOIN `usuarios_listado`  ON usuarios_listado.idUsuario   = aguas_mediciones_datos.idUsuario
WHERE aguas_mediciones_datos.idDatos = ".$_GET['id'];
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
$rowdata = mysqli_fetch_assoc ($resultado);	

// Se trae un listado con todos los datos subidos correctamente
$arrDatosCorrectos = array();
$query = "SELECT 
aguas_mediciones_datos_detalle.idDatosDetalle,
aguas_clientes_listado.Nombre,
aguas_clientes_listado.Direccion,
aguas_clientes_listado.Identificador,
aguas_clientes_listado.UnidadHabitacional,
aguas_mediciones_datos_detalle.Consumo,

aguas_marcadores_listado.Nombre AS Marcadores,
aguas_marcadores_remarcadores.Nombre AS Remarcadores

FROM `aguas_mediciones_datos_detalle` 

LEFT JOIN `aguas_clientes_listado`         ON aguas_clientes_listado.idCliente               = aguas_mediciones_datos_detalle.idCliente
LEFT JOIN `aguas_marcadores_listado`       ON aguas_marcadores_listado.idMarcadores          = aguas_mediciones_datos_detalle.idMarcadores
LEFT JOIN `aguas_marcadores_remarcadores`  ON aguas_marcadores_remarcadores.idRemarcadores   = aguas_mediciones_datos_detalle.idRemarcadores

WHERE aguas_mediciones_datos_detalle.idDatos = ".$_GET['id'];
//consulto
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
array_push( $arrDatosCorrectos,$row );
}
?>
 

<div class="col-sm-12">

	<div id="page-wrap">
		<div id="header"> Modificacion Datos Medidores Ingreso N°<?php echo n_doc($rowdata['idDatos'], 7); ?> </div>
		<div id="customer">
			<table id="meta" class="fleft otdata">
				<tbody>
					<tr>
						<td class="meta-head"><strong>DATOS BASICOS</strong></td>
						<td class="meta-head"><a href="<?php echo $location.'&id='.$_GET['id'].'&modBase='.$_GET['id']; ?>" title="Modificar Datos Basicos" class="btn btn-xs btn-primary tooltip fright" style="position: initial;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar</a></td>
					</tr>
					<tr>
						<td class="meta-head">Creador</td>
						<td><?php echo $rowdata['NombreUsuario']?></td>
					</tr>
					<tr>
						<td class="meta-head">Nombre del Archivo</td>
						<td><?php echo $rowdata['NombreArchivo']?></td>
					</tr>
					<tr>
						<td class="meta-head">Sistema</td>
						<td><?php echo $rowdata['Sistema']?></td>
					</tr>
				</tbody>
			</table>
			<table id="meta" class="otdata2">
				<tbody>
					<tr>
						<td class="meta-head">Fecha Creacion</td>
						<td><?php echo Fecha_estandar($rowdata['fCreacion']); ?></td>
					</tr>
					<tr>
						<td class="meta-head">Fecha Facturacion</td>
						<td><?php echo Fecha_estandar($rowdata['Fecha']);?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<table id="items">
			<tbody>
				<tr><th colspan="8">Detalle</th></tr>		  
				
				<?php if($arrDatosCorrectos) { ?>
					<tr class="item-row fact_tittle"><td colspan="8"><strong>Datos Ingresados Correctamente</strong></td></tr>
					<tr class="item-row linea_punteada" bgcolor="#F0F0F0">
						<td class="item-name"><strong>Identificador</strong></td>
						<td class="item-name"><strong>Cliente</strong></td>
						<td class="item-name"><strong>Medidor</strong></td>
						<td class="item-name"><strong>Remarcador</strong></td>
						<td class="item-name"><strong>Direccion</strong></td>
						<td class="item-name"><strong>UH</strong></td>
						<td class="item-name"><strong>Consumo</strong></td>
						<td class="item-name"><strong>Acciones</strong></td>
					</tr>
					<?php foreach ($arrDatosCorrectos as $datos) { ?>
						<tr class="item-row linea_punteada">
							<td class="item-name"><?php echo $datos['Identificador']; ?></td>
							<td class="item-name"><?php echo $datos['Nombre']; ?></td>
							<td class="item-name"><?php echo $datos['Marcadores']; ?></td>
							<td class="item-name"><?php echo $datos['Remarcadores']; ?></td>
							<td class="item-name"><?php echo $datos['Direccion']; ?></td>
							<td class="item-name"><?php echo $datos['UnidadHabitacional']; ?></td>
							<td class="item-name"><?php echo cantidades_decimales_justos($datos['Consumo']); ?></td>
							<td class="item-name">
								<div class="btn-group" style="width: 35px;" >
									<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$_GET['id'].'&edit='.$datos['idDatosDetalle']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
								</div>
							</td>
						</tr> 
					<?php } ?>
					<tr id="hiderow"><td colspan="8"></td></tr>
				<?php } ?>

				<tr>
					<td colspan="8" class="blank"> 
						<p>
							<?php 
							if(isset($rowdata['Observaciones'])&&$rowdata['Observaciones']!=''){
								echo $rowdata['Observaciones'];
							}else{
								echo 'Sin Observaciones';
							}?>
						</p>
					</td>
				</tr>
				<tr>
					<td colspan="8" class="blank"><p>Observaciones</p></td> 
				</tr>
			</tbody>
		</table>
    	<div class="clearfix"></div>
    </div>
</div>
	
	



<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px; margin-top:30px">
<a href="<?php echo $location; ?>"  class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { 
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn); 
//cuadro para descargar	 
$Alert_Text  = 'Descargar Plantilla';
$Alert_Text .= '<a href="1download.php?dir='.simpleEncode('templates', fecha_actual()).'&file='.simpleEncode('carga_medidores_plantilla.xlsx', fecha_actual()).'" title="Descargar Plantilla" class="btn btn-primary btn-sm pull-right" ><i class="fa fa-download" aria-hidden="true"></i> Descargar</a>';
alert_post_data(2,1,2, $Alert_Text);	 
?>

		
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Medicion</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" enctype="multipart/form-data" id="form1" name="form1" novalidate >
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Fecha)) {            $x1  = $Fecha;            }else{$x1  = '';}
				if(isset($Observaciones)) {    $x2  = $Observaciones;    }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha de Facturacion','Fecha', $x1, 2);
				$Form_Inputs->form_textarea('Observaciones', 'Observaciones', $x2, 1);
				$Form_Inputs->form_multiple_upload('Seleccionar archivo','File_Med', 1, '"csv", "xls", "xlsx"');
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				
				?>
				
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit">
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>

 
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
		case 'ingreso_asc':          $order_by = 'ORDER BY aguas_mediciones_datos.idDatos ASC ';          $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Ingreso Ascendente'; break;
		case 'ingreso_desc':         $order_by = 'ORDER BY aguas_mediciones_datos.idDatos DESC ';         $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Ingreso Descendente';break;
		case 'fechacreacion_asc':    $order_by = 'ORDER BY aguas_mediciones_datos.fCreacion ASC ';        $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Creacion Ascendente'; break;
		case 'fechacreacion_desc':   $order_by = 'ORDER BY aguas_mediciones_datos.fCreacion DESC ';       $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Creacion Descendente';break;
		case 'fechaingreso_asc':     $order_by = 'ORDER BY aguas_mediciones_datos.Fecha ASC ';            $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ingreso Ascendente'; break;
		case 'fechaingreso_desc':    $order_by = 'ORDER BY aguas_mediciones_datos.Fecha DESC ';           $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Ingreso Descendente';break;
		case 'creador_asc':          $order_by = 'ORDER BY usuarios_listado.Nombre ASC ';                 $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Creador Ascendente'; break;
		case 'creador_desc':         $order_by = 'ORDER BY usuarios_listado.Nombre DESC ';                $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Creador Descendente';break;
		case 'nombre_asc':           $order_by = 'ORDER BY aguas_mediciones_datos.Nombre ASC ';           $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente'; break;
		case 'nombre_desc':          $order_by = 'ORDER BY aguas_mediciones_datos.Nombre DESC ';          $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		
		default: $order_by = 'ORDER BY aguas_mediciones_datos.idDatos DESC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Ingreso Descendente';
	}
}else{
	$order_by = 'ORDER BY aguas_mediciones_datos.idDatos DESC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Ingreso Descendente';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE aguas_mediciones_datos.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	
//se filtran para mostrar solo los ingresos de los medidores
$z.= " AND aguas_mediciones_datos.idTipo=1";
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Ano']) && $_GET['Ano'] != ''){              $z .= " AND aguas_mediciones_datos.Ano='".$_GET['Ano']."'";}
if(isset($_GET['idMes']) && $_GET['idMes'] != ''){          $z .= " AND aguas_mediciones_datos.idMes='".$_GET['idMes']."'";}
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){  $z .= " AND aguas_mediciones_datos.idUsuario='".$_GET['idUsuario']."'";}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idDatos FROM `aguas_mediciones_datos` ".$z;
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
aguas_mediciones_datos.idDatos,
aguas_mediciones_datos.fCreacion,
aguas_mediciones_datos.Fecha,
aguas_mediciones_datos.Nombre AS NombreArchivo,
usuarios_listado.Nombre AS NombreUsuario,
core_sistemas.Nombre AS sistema

FROM `aguas_mediciones_datos`
LEFT JOIN `core_sistemas`     ON core_sistemas.idSistema      = aguas_mediciones_datos.idSistema
LEFT JOIN `usuarios_listado`  ON usuarios_listado.idUsuario   = aguas_mediciones_datos.idUsuario
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
}
//Verifico el tipo de usuario que esta ingresando
$usrfil = 'usuarios_listado.idEstado=1 AND usuarios_listado.idTipoUsuario!=1';	
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$usrfil .= " AND usuarios_sistemas.idSistema = ".$_SESSION['usuario']['basic_data']['idSistema'];
}?>

<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Medicion</a><?php } ?>
	
</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				//Se verifican si existen los datos
				if(isset($Ano)) {       $x1  = $Ano;       }else{$x1  = '';}
				if(isset($idMes)) {     $x2  = $idMes;     }else{$x2  = '';}
				if(isset($idUsuario)) { $x3  = $idUsuario; }else{$x3  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_n_auto('Año','Ano', $x1, 1, 2016, ano_actual());
				$Form_Inputs->form_select_filter('Mes','idMes', $x2, 1, 'idMes', 'Nombre', 'core_tiempo_meses', 0, 'idMes ASC', $dbConn);
				$Form_Inputs->form_select_join_filter('Usuario','idUsuario', $x3, 1, 'idUsuario', 'Nombre', 'usuarios_listado', 'usuarios_sistemas', $usrfil, $dbConn);
				
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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Mediciones</h5>
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
							<div class="pull-left">Ingreso</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=ingreso_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=ingreso_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Fecha Creacion</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fechacreacion_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=fechacreacion_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Fecha Ingreso</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fechaingreso_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=fechaingreso_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Creador</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=creador_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=creador_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Nombre</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=nombre_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>		  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrTipo as $tipo) { ?>
					<tr class="odd">
						<td><?php echo n_doc($tipo['idDatos'], 7); ?></td>
						<td><?php echo fecha_estandar($tipo['fCreacion']); ?></td>
						<td><?php echo fecha_estandar($tipo['Fecha']); ?></td>
						<td><?php echo $tipo['NombreUsuario']; ?></td>
						<td><?php echo $tipo['NombreArchivo']; ?></td>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $tipo['sistema']; ?></td><?php } ?>			
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_aguas_mediciones_datos.php?view='.simpleEncode($tipo['idDatos'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$tipo['idDatos']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.simpleEncode($tipo['idDatos'], fecha_actual());
									$dialogo   = '¿Realmente deseas eliminar la medicion '.n_doc($tipo['idDatos'], 7).'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
								<?php } ?>								
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
