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
$original = "telemetria_carga_bam.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idTelemetria']) && $_GET['idTelemetria'] != ''){          $location .= "&idTelemetria=".$_GET['idTelemetria'];           $search .= "&idTelemetria=".$_GET['idTelemetria'];}
if(isset($_GET['FechaCarga']) && $_GET['FechaCarga'] != ''){              $location .= "&FechaCarga=".$_GET['FechaCarga'];               $search .= "&FechaCarga=".$_GET['FechaCarga'];}
if(isset($_GET['FechaVencimiento']) && $_GET['FechaVencimiento'] != ''){  $location .= "&FechaVencimiento=".$_GET['FechaVencimiento'];   $search .= "&FechaVencimiento=".$_GET['FechaVencimiento'];}
if(isset($_GET['idDocPago']) && $_GET['idDocPago'] != ''){                $location .= "&idDocPago=".$_GET['idDocPago'];                 $search .= "&idDocPago=".$_GET['idDocPago'];}
if(isset($_GET['N_DocPago']) && $_GET['N_DocPago'] != ''){                $location .= "&N_DocPago=".$_GET['N_DocPago'];                 $search .= "&N_DocPago=".$_GET['N_DocPago'];}
if(isset($_GET['Monto']) && $_GET['Monto'] != ''){                        $location .= "&Monto=".$_GET['Monto'];                         $search .= "&Monto=".$_GET['Monto'];}
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
	require_once 'A1XRXS_sys/xrxs_form/telemetria_carga_bam.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/telemetria_carga_bam.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/telemetria_carga_bam.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Carga Creada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Carga Modificada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Carga borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) {
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);
//filtro
$z = "telemetria_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND telemetria_listado.idEstado=1";	 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$z .= " AND usuarios_equipos_telemetria.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];		
}
// consulto los datos
$query = "SELECT idTelemetria, FechaCarga, FechaVencimiento, idDocPago, N_DocPago, Monto
FROM `telemetria_carga_bam`
WHERE idCarga = ".$_GET['id'];
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
$rowdata = mysqli_fetch_assoc ($resultado); ?>
 
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Modificacion de la Carga</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($idTelemetria)) {     $x1  = $idTelemetria;      }else{$x1  = $rowdata['idTelemetria'];}
				if(isset($FechaCarga)) {       $x2  = $FechaCarga;        }else{$x2  = $rowdata['FechaCarga'];}
				if(isset($FechaVencimiento)) { $x3  = $FechaVencimiento;  }else{$x3  = $rowdata['FechaVencimiento'];}
				if(isset($idDocPago)) {        $x4  = $idDocPago;         }else{$x4  = $rowdata['idDocPago'];}
				if(isset($N_DocPago)) {        $x5  = $N_DocPago;         }else{$x5  = $rowdata['N_DocPago'];}
				if(isset($Monto)) {            $x6  = $Monto;             }else{$x6  = $rowdata['Monto'];}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				//Verifico el tipo de usuario que esta ingresando
				if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
					$Form_Inputs->form_select_filter('Equipo','idTelemetria', $x1, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', $z, '', $dbConn);	
				}else{
					$Form_Inputs->form_select_join_filter('Equipo','idTelemetria', $x1, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', 'usuarios_equipos_telemetria', $z, $dbConn);
				}
				$Form_Inputs->form_date('Fecha Carga','FechaCarga', $x2, 2);
				$Form_Inputs->form_date('Fecha Vencimiento','FechaVencimiento', $x3, 2);
				$Form_Inputs->form_select('Documento de Pago','idDocPago', $x4, 2, 'idDocPago', 'Nombre', 'sistema_documentos_pago', 0, '', $dbConn);
				$Form_Inputs->form_input_number('N° Documento de Pago', 'N_DocPago', $x5, 1);
				$Form_Inputs->form_values('Monto', 'Monto', $x6, 2);
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idCarga', $_GET['id'], 2);
				?>
			
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { 
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn);
//se crea filtro
$z = "telemetria_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND telemetria_listado.idEstado=1";	 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$z .= " AND usuarios_equipos_telemetria.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];		
}
?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Carga Bam</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idTelemetria)) {     $x1  = $idTelemetria;      }else{$x1  = '';}
				if(isset($FechaCarga)) {       $x2  = $FechaCarga;        }else{$x2  = '';}
				if(isset($FechaVencimiento)) { $x3  = $FechaVencimiento;  }else{$x3  = '';}
				if(isset($idDocPago)) {        $x4  = $idDocPago;         }else{$x4  = '';}
				if(isset($N_DocPago)) {        $x5  = $N_DocPago;         }else{$x5  = '';}
				if(isset($Monto)) {            $x6  = $Monto;             }else{$x6  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				//Verifico el tipo de usuario que esta ingresando
				if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
					$Form_Inputs->form_select_filter('Equipo','idTelemetria', $x1, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', $z, '', $dbConn);	
				}else{
					$Form_Inputs->form_select_join_filter('Equipo','idTelemetria', $x1, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', 'usuarios_equipos_telemetria', $z, $dbConn);
				}
				$Form_Inputs->form_date('Fecha Carga','FechaCarga', $x2, 2);
				$Form_Inputs->form_date('Fecha Vencimiento','FechaVencimiento', $x3, 2);
				$Form_Inputs->form_select('Documento de Pago','idDocPago', $x4, 2, 'idDocPago', 'Nombre', 'sistema_documentos_pago', 0, '', $dbConn);
				$Form_Inputs->form_input_number('N° Documento de Pago', 'N_DocPago', $x5, 1);
				$Form_Inputs->form_values('Monto', 'Monto', $x6, 2);
				
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				
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
		case 'equipo_asc':      $order_by = 'ORDER BY telemetria_listado.Nombre ASC ';               $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Equipo Ascendente'; break;
		case 'equipo_desc':     $order_by = 'ORDER BY telemetria_listado.Nombre DESC ';              $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Equipo Descendente';break;
		case 'usuario_asc':     $order_by = 'ORDER BY usuarios_listado.Nombre ASC ';                 $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Usuario Ascendente';break;
		case 'usuario_desc':    $order_by = 'ORDER BY usuarios_listado.Nombre DESC ';                $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Usuario Descendente';break;
		case 'fechacarga_asc':  $order_by = 'ORDER BY telemetria_carga_bam.FechaCarga ASC ';         $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Carga Ascendente'; break;
		case 'fechacarga_desc': $order_by = 'ORDER BY telemetria_carga_bam.FechaCarga DESC ';        $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Carga Descendente';break;
		case 'fechavenc_asc':   $order_by = 'ORDER BY telemetria_carga_bam.FechaVencimiento ASC ';   $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Vencimiento Ascendente';break;
		case 'fechavenc_desc':  $order_by = 'ORDER BY telemetria_carga_bam.FechaVencimiento DESC ';  $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Vencimiento Descendente';break;
		case 'monto_asc':       $order_by = 'ORDER BY telemetria_carga_bam.Monto ASC ';              $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Monto Ascendente';break;
		case 'monto_desc':      $order_by = 'ORDER BY telemetria_carga_bam.Monto DESC ';             $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Monto Descendente';break;
		
		default: $order_by = 'ORDER BY telemetria_carga_bam.FechaVencimiento DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Vencimiento Descendente';
	}
}else{
	$order_by = 'ORDER BY telemetria_carga_bam.FechaVencimiento DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Vencimiento Descendente';
}
/**********************************************************/
//Verifico el tipo de usuario que esta ingresando
$w = "telemetria_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND telemetria_listado.idEstado=1";
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$w .= " AND usuarios_equipos_telemetria.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];		
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE telemetria_carga_bam.idCarga!=0";
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idTelemetria']) && $_GET['idTelemetria'] != ''){          $z .= " AND telemetria_carga_bam.idTelemetria=".$_GET['idTelemetria'];}
if(isset($_GET['FechaCarga']) && $_GET['FechaCarga'] != ''){              $z .= " AND telemetria_carga_bam.FechaCarga='".$_GET['FechaCarga']."'";}
if(isset($_GET['FechaVencimiento']) && $_GET['FechaVencimiento'] != ''){  $z .= " AND telemetria_carga_bam.FechaVencimiento='".$_GET['FechaVencimiento']."'";}
if(isset($_GET['idDocPago']) && $_GET['idDocPago'] != ''){                $z .= " AND telemetria_carga_bam.idDocPago=".$_GET['idDocPago'];}
if(isset($_GET['N_DocPago']) && $_GET['N_DocPago'] != ''){                $z .= " AND telemetria_carga_bam.N_DocPago LIKE '%".$_GET['N_DocPago']."%'";}
if(isset($_GET['Monto']) && $_GET['Monto'] != ''){                        $z .= " AND telemetria_carga_bam.Monto LIKE '%".$_GET['Monto']."%'";}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idCarga FROM `telemetria_carga_bam` ".$z;
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
$arrCarga = array();
$query = "SELECT 
telemetria_carga_bam.idCarga,
telemetria_listado.Nombre AS EquipoTel,
usuarios_listado.Nombre AS Usuario,
telemetria_carga_bam.FechaCarga,
telemetria_carga_bam.FechaVencimiento,
telemetria_carga_bam.Monto

FROM `telemetria_carga_bam`
LEFT JOIN `telemetria_listado`   ON telemetria_listado.idTelemetria  = telemetria_carga_bam.idTelemetria
LEFT JOIN `usuarios_listado`     ON usuarios_listado.idUsuario       = telemetria_carga_bam.idUsuario
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
array_push( $arrCarga,$row );
}?>
<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>	
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Carga</a><?php } ?>

</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($idTelemetria)) {     $x1  = $idTelemetria;      }else{$x1  = '';}
				if(isset($FechaCarga)) {       $x2  = $FechaCarga;        }else{$x2  = '';}
				if(isset($FechaVencimiento)) { $x3  = $FechaVencimiento;  }else{$x3  = '';}
				if(isset($idDocPago)) {        $x4  = $idDocPago;         }else{$x4  = '';}
				if(isset($N_DocPago)) {        $x5  = $N_DocPago;         }else{$x5  = '';}
				if(isset($Monto)) {            $x6  = $Monto;             }else{$x6  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				//Verifico el tipo de usuario que esta ingresando
				if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
					$Form_Inputs->form_select_filter('Equipo','idTelemetria', $x1, 1, 'idTelemetria', 'Nombre', 'telemetria_listado', $w, '', $dbConn);	
				}else{
					$Form_Inputs->form_select_join_filter('Equipo','idTelemetria', $x1, 1, 'idTelemetria', 'Nombre', 'telemetria_listado', 'usuarios_equipos_telemetria', $w, $dbConn);
				}
				$Form_Inputs->form_date('Fecha Carga','FechaCarga', $x2, 1);
				$Form_Inputs->form_date('Fecha Vencimiento','FechaVencimiento', $x3, 1);
				$Form_Inputs->form_select('Documento de Pago','idDocPago', $x4, 1, 'idDocPago', 'Nombre', 'sistema_documentos_pago', 0, '', $dbConn);
				$Form_Inputs->form_input_number('N° Documento de Pago', 'N_DocPago', $x5, 1);
				$Form_Inputs->form_values('Monto', 'Monto', $x6, 1);
				
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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Cargas</h5>
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
							<div class="pull-left">Equipo</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=equipo_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=equipo_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Usuario Carga</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=usuario_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=usuario_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Fecha Carga</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fechacarga_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=fechacarga_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Fecha Vencimiento</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fechavenc_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=fechavenc_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Monto</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=monto_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=monto_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>				  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrCarga as $carga) { ?>

					<tr class="odd">
						<td><?php echo $carga['EquipoTel']; ?></td>
						<td><?php echo $carga['Usuario']; ?></td>
						<td><?php echo fecha_estandar($carga['FechaCarga']); ?></td>
						<td><?php echo fecha_estandar($carga['FechaVencimiento']); ?></td>
						<td align="right"><?php echo valores($carga['Monto'], 0); ?></td>
						<td>
							<div class="btn-group" style="width: 70px;" >
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$carga['idCarga']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.simpleEncode($carga['idCarga'], fecha_actual());
									$dialogo   = '¿Realmente deseas eliminar la carga BAM con fecha '.$carga['FechaCarga'].'?';?>
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
<?php } ?>          
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
