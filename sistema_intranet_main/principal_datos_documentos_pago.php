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
$original = "principal_datos.php";
$location = $original;
$new_location = "principal_datos_documentos_pago.php";
$location .= '?d=d';
$new_location .= '?d=d';

/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_GET['doc_add']) )  { 
	//nuevas ubicaciones
	$location = $new_location;
	$location.='&id='.$_SESSION['usuario']['basic_data']['idUsuario'];
	//Llamamos al formulario
	$form_trabajo= 'doc_add';
	require_once 'A1XRXS_sys/xrxs_form/usuarios_listado.php';
}
//se borra un dato
if ( !empty($_GET['doc_del']) )     {
	//nuevas ubicaciones
	$location = $new_location;
	$location.='&id='.$_SESSION['usuario']['basic_data']['idUsuario'];
	//Llamamos al formulario
	$form_trabajo= 'doc_del';
	require_once 'A1XRXS_sys/xrxs_form/usuarios_listado.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Permiso asignado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
//Listo los documentos de pago
$arrDocumentos = array();
$query = "SELECT 
sistema_documentos_pago.idDocPago,
sistema_documentos_pago.Nombre,
(SELECT COUNT(idDocPagoPermiso) FROM usuarios_documentos_pago WHERE idDocPago = sistema_documentos_pago.idDocPago AND idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']} LIMIT 1) AS contar,
(SELECT idDocPagoPermiso FROM usuarios_documentos_pago WHERE idDocPago = sistema_documentos_pago.idDocPago AND idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']} LIMIT 1) AS idpermiso
FROM `sistema_documentos_pago`
";
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
array_push( $arrDocumentos,$row );
}

/*************************************************/
//permisos a las transacciones
$trans[1] = "pago_masivo_cliente.php";           //Pagos clientes
$trans[2] = "pago_masivo_proveedor.php";         //Pagos Proveedores
$trans[3] = "pago_masivo_cliente_reversa.php";   //Reversa Pagos clientes
$trans[4] = "pago_masivo_proveedor_reversa.php"; //Reversa Pagos Proveedores

//Genero los permisos
for ($i = 1; $i <= 4; $i++) {
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
//verifico permisos
$Count_pagos = $prm_x[1] + $prm_x[2] + $prm_x[3] + $prm_x[4];

?>

<div class="col-sm-12">
	<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-cog faa-spin animated " aria-hidden="true"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Perfil</span>
				<span class="info-box-number"><?php echo $_SESSION['usuario']['basic_data']['Nombre']; ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">Editar Documentos de Pago</span>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'principal_datos.php';?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'principal_datos_datos.php';?>" >Datos Personales</a></li>
				<li class=""><a href="<?php echo 'principal_datos_imagen.php';?>" >Cambiar Imagen</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'principal_datos_password.php';?>" >Cambiar Contraseña</a></li>
						<?php if($Count_pagos!=0){ ?>
							<li class="active"><a href="<?php echo 'principal_datos_documentos_pago.php'?>" >Documentos Pago</a></li>
						<?php } ?>
					</ul>
                </li>          
			</ul>	
		</header>
        <div class="table-responsive">
			
			
			
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Nombre</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
								  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrDocumentos as $permiso) { ?>
						<tr class="odd">
							<td><?php echo '<strong>Documento: </strong>'.$permiso['Nombre']; ?></td>
							<td>
								<div class="btn-group" style="width: 100px;" id="toggle_event_editing">	
									<?php if ( $permiso['contar']=='1' ) {?>    
										<a title="Quitar Permiso" class="btn btn-sm btn-default unlocked_inactive tooltip" href="<?php echo $new_location.'&id='.$_SESSION['usuario']['basic_data']['idUsuario'].'&doc_del='.$permiso['idpermiso']; ?>">OFF</a>
										<a title="Dar Permiso" class="btn btn-sm btn-info locked_active tooltip" href="#">ON</a>
									<?php } else {?>
										<a title="Quitar Permiso" class="btn btn-sm btn-info locked_active tooltip" href="#">OFF</a>
										<a title="Dar Permiso" class="btn btn-sm btn-default unlocked_inactive tooltip" href="<?php echo $new_location.'&id='.$_SESSION['usuario']['basic_data']['idUsuario'].'&doc_add='.$permiso['idDocPago']; ?>">ON</a>
									<?php }?>    
								</div> 
							</td>
						</tr>
					<?php } ?>  
					                 
				</tbody>
			</table>
			
			
			
			
			
			
		</div>	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>


<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
