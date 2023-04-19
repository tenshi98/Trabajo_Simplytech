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
//Cargamos la ubicacion original
$original = "orden_trabajo_terminar.php";
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
//Listado de errores no manejables
if (isset($_GET['created'])){    $error['created']    = 'sucess/Orden de Trabajo Creada correctamente';}
if (isset($_GET['edited'])){     $error['edited']     = 'sucess/Orden de Trabajo Modificada correctamente';}
if (isset($_GET['deleted'])){    $error['deleted']    = 'sucess/Orden de Trabajo Borrada correctamente';}
if (isset($_GET['terminated'])){ $error['terminated'] = 'sucess/Orden de Trabajo terminada correctamente';}
if (isset($_GET['addins'])){     $error['addins']     = 'sucess/Insumo agregado correctamente';}
if (isset($_GET['delins'])){     $error['delins']     = 'sucess/Insumo Borrado correctamente';}
if (isset($_GET['editins'])){    $error['editins']    = 'sucess/Insumo Modificado correctamente';}
if (isset($_GET['addprod'])){    $error['addprod']    = 'sucess/Producto agregado correctamente';}
if (isset($_GET['delprod'])){    $error['delprod']    = 'sucess/Producto Borrado correctamente';}
if (isset($_GET['editprod'])){   $error['editprod']   = 'sucess/Producto Modificado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['addInsumo'])){ ?>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} elseif(!empty($_GET['submit_filter'])){

//Verifico el tipo de usuario que esta ingresando
$z="WHERE orden_trabajo_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
$z .= " AND orden_trabajo_listado.idEstado = 1";
//Verifico si la variable de busqueda existe
//if (isset($_GET['idCliente']) && $_GET['idCliente']!=''){$z .= " AND orden_trabajo_listado.idCliente=".$_GET['idCliente'];}
if (isset($_GET['idMaquina']) && $_GET['idMaquina']!=''){$z .= " AND orden_trabajo_listado.idMaquina = '".$_GET['idMaquina']."'";}
if (isset($_GET['idPrioridad']) && $_GET['idPrioridad']!=''){   $z .= " AND orden_trabajo_listado.idPrioridad = '".$_GET['idPrioridad']."'";}
if (isset($_GET['idTipo']) && $_GET['idTipo']!=''){      $z .= " AND orden_trabajo_listado.idTipo = '".$_GET['idTipo']."'";}
if(isset($_GET['f_programacion_inicio'])&&$_GET['f_programacion_inicio']!=''&&isset($_GET['f_programacion_termino'])&&$_GET['f_programacion_termino']!=''){
	$z.=" AND orden_trabajo_listado.f_programacion BETWEEN '".$_GET['f_programacion_inicio']."' AND '".$_GET['f_programacion_termino']."'";
}

// Se trae un listado con todos los elementos
$arrOTS = array();
$query = "SELECT 
orden_trabajo_listado.idOT,
orden_trabajo_listado.f_programacion,
orden_trabajo_listado.Observaciones,
maquinas_listado.Nombre AS NombreMaquina,
core_ot_prioridad.Nombre AS NombrePrioridad,
core_ot_tipos.Nombre AS NombreTipo,
clientes_listado.Nombre AS NombreCliente

FROM `orden_trabajo_listado`
LEFT JOIN `maquinas_listado`     ON maquinas_listado.idMaquina      = orden_trabajo_listado.idMaquina
LEFT JOIN `core_ot_prioridad`    ON core_ot_prioridad.idPrioridad   = orden_trabajo_listado.idPrioridad
LEFT JOIN `core_ot_tipos`        ON core_ot_tipos.idTipo            = orden_trabajo_listado.idTipo
LEFT JOIN `clientes_listado`     ON clientes_listado.idCliente      = orden_trabajo_listado.idCliente
".$z."
ORDER BY orden_trabajo_listado.idOT DESC ";
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
while ( $row = mysqli_fetch_assoc ($resultado)){
array_push( $arrOTS,$row );
}

?>
                   
                                 
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Ordenes de Trabajo</h5>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>#</th>
						<th>F Prog</th>
						<th>Maquina</th>
						<th>Prioridad</th>
						<th>Tipo Trabajo</th>
						<th>Observaciones</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrOTS as $ot) { ?>
					<tr class="odd">
						<td><?php echo $ot['idOT']; ?></td>
						<td><?php echo Fecha_estandar($ot['f_programacion']); ?></td>
						<td><?php if(isset($ot['NombreCliente'])&&$ot['NombreCliente']!=''){echo $ot['NombreCliente'].' - '.$ot['NombreMaquina'];}else{echo $ot['NombreMaquina'];} ?></td>
						<td><?php echo $ot['NombrePrioridad']; ?></td>
						<td><?php echo $ot['NombreTipo']; ?></td>
						<td><?php echo $ot['Observaciones']; ?></td>
						<td>
							<div class="btn-group" style="width: 70px;" >
								<?php if ($rowlevel['level']>=1){ ?><a href="<?php echo 'view_orden_trabajo.php?view='.simpleEncode($ot['idOT'], fecha_actual()); ?>" title="Ver Orden de Trabajo" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){ ?><a target="_blank" rel="noopener noreferrer" href="<?php echo 'orden_trabajo_editar.php?view='.$ot['idOT'].'&ter=true'; ?>" title="Editar Orden de Trabajo" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
							</div>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else {
//Verifico el tipo de usuario que esta ingresando
$w = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idConfig_1=1 AND idEstado=1";
$y = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1"; ?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idCliente)){                $x0  = $idCliente;               }else{$x0  = '';}
				if(isset($idMaquina)){                $x1  = $idMaquina;               }else{$x1  = '';}
				if(isset($idPrioridad)){              $x2  = $idPrioridad;             }else{$x2  = '';}
				if(isset($idTipo)){                   $x3  = $idTipo;                  }else{$x3  = '';}
				if(isset($f_programacion_inicio)){    $x4  = $f_programacion_inicio;   }else{$x4  = '';}
				if(isset($f_programacion_termino)){   $x5  = $f_programacion_termino;  }else{$x5  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				if($_SESSION['usuario']['basic_data']['idSistema']==11){
					$Form_Inputs->form_select_depend1('Cliente','idCliente', $x0, 1, 'idCliente', 'Nombre', 'clientes_listado', $y, 0,
											 'Maquina','idMaquina', $x1, 1, 'idMaquina', 'Nombre', 'maquinas_listado', $w, 0, 
										      $dbConn, 'form1');
				}else{
					$Form_Inputs->form_select_filter('Maquina','idMaquina', $x1, 1, 'idMaquina', 'Nombre', 'maquinas_listado', $w, '', $dbConn);
				}
				$Form_Inputs->form_select('Prioridad','idPrioridad', $x2, 1, 'idPrioridad', 'Nombre', 'core_ot_prioridad', 0, '', $dbConn);
				$Form_Inputs->form_select('Tipo','idTipo', $x3, 1, 'idTipo', 'Nombre', 'core_ot_tipos', 0, '', $dbConn);
				$Form_Inputs->form_date('Fecha Programacion Desde','f_programacion_inicio', $x4, 1);
				$Form_Inputs->form_date('Fecha Programacion Hasta','f_programacion_termino', $x5, 1);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf002; Filtrar" name="submit_filter">
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
