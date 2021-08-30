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
$original = "sistema_rrhh_tabla_seguro_cesantia.php";
$location = $original;
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/z_sistema_rrhh_tabla_seguro_cesantia.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Tabla Seguro de cesantia Creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Tabla Seguro de cesantia Modificado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Tabla Seguro de cesantia borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);
// consulto los datos
$query = "SELECT idTipoContrato,Porc_Empleador,Porc_Trabajador
FROM `sistema_rrhh_tabla_seguro_cesantia`
WHERE idTablaSeguro = ".$_GET['id'];
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
			<h5>Modificacion del seguro de cesantia</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($idTipoContrato)) {   $x1  = $idTipoContrato;     }else{$x1  = $rowdata['idTipoContrato'];}
				if(isset($Porc_Empleador)) {   $x2  = $Porc_Empleador;     }else{$x2  = $rowdata['Porc_Empleador'];}
				if(isset($Porc_Trabajador)) {  $x3  = $Porc_Trabajador;    }else{$x3  = $rowdata['Porc_Trabajador'];}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select('Tipo de Sueldo','idTipoContrato', $x1, 2, 'idTipoContrato', 'Nombre', 'core_tipos_contrato', 0, '', $dbConn);
				$Form_Inputs->form_input_number('% Empleador', 'Porc_Empleador', $x2, 2);
				$Form_Inputs->form_input_number('% Trabajador', 'Porc_Trabajador', $x3, 2);
					
				$Form_Inputs->form_input_hidden('idTablaSeguro', $_GET['id'], 2);
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
 } else  { 
/**********************************************************/
$arrAmonestacion = array();
$query = "SELECT 
core_tipos_contrato.Nombre AS TipoContrato,
sistema_rrhh_tabla_seguro_cesantia.idTablaSeguro,
sistema_rrhh_tabla_seguro_cesantia.idTipoContrato, 
sistema_rrhh_tabla_seguro_cesantia.Porc_Empleador, 
sistema_rrhh_tabla_seguro_cesantia.Porc_Trabajador
FROM `sistema_rrhh_tabla_seguro_cesantia`
LEFT JOIN `core_tipos_contrato` ON core_tipos_contrato.idTipoContrato = sistema_rrhh_tabla_seguro_cesantia.idTipoContrato
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
array_push( $arrAmonestacion,$row );
}?>
                   
                                 
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Seguro Cesantia</h5>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Tipo Contrato</th>
						<th>Empleador</th>
						<th>Trabajador</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>				  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrAmonestacion as $amon) { ?>
					<tr class="odd">
						<td><?php echo $amon['TipoContrato']; ?></td>
						<td><?php echo Cantidades($amon['Porc_Empleador'], 1); ?></td>
						<td><?php echo Cantidades($amon['Porc_Trabajador'], 1); ?></td>
						<td>
							<div class="btn-group" style="width: 35px;" >
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'?id='.$amon['idTablaSeguro']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
							</div>
						</td>
					</tr>
				<?php } ?>                    
				</tbody>
			</table>
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
