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
$original = "aguas_mediciones_remarcadores_ingreso.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Ano']) && $_GET['Ano']!=''){        $location .= "&Ano=".$_GET['Ano'];               $search .= "&Ano=".$_GET['Ano'];}
if(isset($_GET['idMes']) && $_GET['idMes']!=''){    $location .= "&idMes=".$_GET['idMes'];           $search .= "&idMes=".$_GET['idMes'];}
if(isset($_GET['idUsuario']) && $_GET['idUsuario']!=''){   $location .= "&idUsuario=".$_GET['idUsuario'];   $search .= "&idUsuario=".$_GET['idUsuario'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if (!empty($_POST['submit'])){
	//Llamamos al formulario
	$form_trabajo= 'new_rem';
	require_once 'A1XRXS_sys/xrxs_form/aguas_mediciones_remarcadores_datos.php';
}
//formulario para editar
if (!empty($_POST['submit_modBase'])){
	//Llamamos al formulario
	$form_trabajo= 'modBase';
	require_once 'A1XRXS_sys/xrxs_form/aguas_mediciones_remarcadores_datos.php';
}
//formulario para editar
if (!empty($_GET['clear_all'])){
	//Llamamos al formulario
	$form_trabajo= 'clear_all';
	require_once 'A1XRXS_sys/xrxs_form/aguas_mediciones_remarcadores_datos.php';
}
/********************************************/
if (!empty($_POST['submit_add_client'])){
	//Llamamos al formulario
	$form_trabajo= 'add_client';
	require_once 'A1XRXS_sys/xrxs_form/aguas_mediciones_remarcadores_datos.php';
}
//se borra un dato
if (!empty($_GET['del_cliente'])){
	//Llamamos al formulario
	$form_trabajo= 'del_cliente';
	require_once 'A1XRXS_sys/xrxs_form/aguas_mediciones_remarcadores_datos.php';
}
/********************************************/
if (!empty($_GET['ing_doc'])){
	//Llamamos al formulario
	$form_trabajo= 'ing_rem';
	require_once 'A1XRXS_sys/xrxs_form/aguas_mediciones_remarcadores_datos.php';
}
//se borra un dato
if (!empty($_GET['del'])){
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/aguas_mediciones_remarcadores_datos.php';
}
/********************************************/
//formulario para editar
if (!empty($_POST['submit_edit'])){
	//Se agrega ubicacion
	$location .= "&id=".$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/aguas_mediciones_remarcadores_datos.php';
}
//formulario para editar
if (!empty($_POST['submit_modConsumo'])){
	//Se agrega ubicacion
	$location .= "&id=".$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'updateConsumo';
	require_once 'A1XRXS_sys/xrxs_form/aguas_mediciones_remarcadores_datos.php';
}



/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Medicion Creada correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Medicion Modificada correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Medicion Borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['modMed'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);

//consulta
$SIS_query = 'Consumo';
$SIS_join  = '';
$SIS_where = 'idDatosDetalle ='.$_GET['modMed'];
$rowdata = db_select_data (false, $SIS_query, 'aguas_mediciones_datos_detalle', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Modificacion del Consumo</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($Consumo)){  $x1  = $Consumo;  }else{$x1  = cantidades_decimales_justos($rowdata['Consumo']);}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_number('Consumo', 'Consumo', $x1, 2);

				$Form_Inputs->form_input_hidden('idDatosDetalle', $_GET['modMed'], 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_modConsumo">
					<a href="<?php echo $location.'&id='.$_GET['id']; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['modData'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);

//consulta
$SIS_query = 'Fecha, Observaciones';
$SIS_join  = '';
$SIS_where = 'idDatos ='.$_GET['modData'];
$rowdata = db_select_data (false, $SIS_query, 'aguas_mediciones_datos', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Modificacion de los datos basicos</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				if(isset($Fecha)){  $x1  = $Fecha;            }else{$x1  = $rowdata['Fecha'];}
				if(isset($Observaciones)){    $x2  = $Observaciones;    }else{$x2  = $rowdata['Observaciones'];}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha de Facturacion','Fecha', $x1, 2);
				$Form_Inputs->form_textarea('Observaciones', 'Observaciones', $x2, 1);

				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);

				$Form_Inputs->form_input_hidden('idDatos', $_GET['modData'], 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">
					<a href="<?php echo $location.'&id='.$_GET['id']; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['id'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);

// Se traen todos los datos de la subida
$SIS_query = '
aguas_mediciones_datos.idDatos,
aguas_mediciones_datos.fCreacion,
aguas_mediciones_datos.Fecha,
aguas_mediciones_datos.Nombre AS NombreArchivo,
aguas_mediciones_datos.Observaciones,
usuarios_listado.Nombre AS NombreUsuario,
core_sistemas.Nombre AS Sistema,
aguas_mediciones_datos.idTipo,
aguas_mediciones_datos.ConsumoMedidor,
aguas_mediciones_datos_tipo_medicion.Nombre AS MedidorTipoMed,
aguas_marcadores_listado.Nombre AS MarcadorNombre,
aguas_mediciones_datos.idMarcadoresUsado AS ID,
(SELECT Identificador FROM `aguas_clientes_listado` WHERE idMarcadores = ID AND idFacturable = 3 LIMIT 1)AS ClienteIdentificador,
(SELECT Nombre FROM `aguas_clientes_listado` WHERE idMarcadores = ID AND idFacturable = 3 LIMIT 1)AS ClienteNombre';
$SIS_join  = '
LEFT JOIN `core_sistemas`                          ON core_sistemas.idSistema                               = aguas_mediciones_datos.idSistema
LEFT JOIN `usuarios_listado`                       ON usuarios_listado.idUsuario                            = aguas_mediciones_datos.idUsuario
LEFT JOIN `aguas_mediciones_datos_tipo_medicion`   ON aguas_mediciones_datos_tipo_medicion.idTipoMedicion   = aguas_mediciones_datos.idTipoMedicion
LEFT JOIN `aguas_marcadores_listado`               ON aguas_marcadores_listado.idMarcadores                 = aguas_mediciones_datos.idMarcadoresUsado';
$SIS_where = 'aguas_mediciones_datos.idDatos ='.$_GET['id'];
$rowdata = db_select_data (false, $SIS_query, 'aguas_mediciones_datos', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

// Se trae un listado con todos los datos subidos correctamente
$SIS_query = '
aguas_mediciones_datos_detalle.idDatosDetalle,
aguas_clientes_listado.Nombre,
aguas_clientes_listado.Direccion,
aguas_clientes_listado.Identificador,
aguas_clientes_listado.UnidadHabitacional,
aguas_mediciones_datos_detalle.Consumo,
aguas_marcadores_listado.Nombre AS Marcadores,
aguas_marcadores_remarcadores.Nombre AS Remarcadores';
$SIS_join  = '
LEFT JOIN `aguas_clientes_listado`         ON aguas_clientes_listado.idCliente               = aguas_mediciones_datos_detalle.idCliente
LEFT JOIN `aguas_marcadores_listado`       ON aguas_marcadores_listado.idMarcadores          = aguas_mediciones_datos_detalle.idMarcadores
LEFT JOIN `aguas_marcadores_remarcadores`  ON aguas_marcadores_remarcadores.idRemarcadores   = aguas_mediciones_datos_detalle.idRemarcadores';
$SIS_where = 'aguas_mediciones_datos_detalle.idDatos ='.$_GET['id'];
$SIS_order = 'aguas_clientes_listado.Nombre ASC';
$arrDatosCorrectos = array();
$arrDatosCorrectos = db_select_array (false, $SIS_query, 'aguas_mediciones_datos_detalle', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrDatosCorrectos');

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

	<div id="page-wrap">
		<div id="header"> Modificacion Datos Remarcadores Ingreso N°<?php echo n_doc($rowdata['idDatos'], 7); ?></div>
		<div id="customer">
			<table id="meta" class="pull-left otdata">
				<tbody>
					<tr>
						<td class="meta-head"><strong>DATOS BASICOS</strong></td>
						<td class="meta-head"><a href="<?php echo $location.'&id='.$_GET['id'].'&modData='.$_GET['id'] ?>" title="Modificar Datos Basicos" class="btn btn-xs btn-primary tooltip pull-right" style="position: initial;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar</a></td>
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

					<?php if(isset($rowdata['idTipo'])&&$rowdata['idTipo']==2){ ?>

						<tr>
							<td class="meta-head">Cliente</td>
							<td><?php echo $rowdata['ClienteIdentificador'].' '.$rowdata['ClienteNombre']; ?></td>
						</tr>
						<tr>
							<td class="meta-head">Medidor Cliente</td>
							<td><?php echo $rowdata['MarcadorNombre']; ?></td>
						</tr>
						<tr>
							<td class="meta-head">Medicion del periodo</td>
							<td><?php echo cantidades_decimales_justos($rowdata['ConsumoMedidor']).' Metros Cubicos'; ?></td>
						</tr>
						<tr>
							<td class="meta-head">Distribucion de diferencia</td>
							<td><?php echo $rowdata['MedidorTipoMed']; ?></td>
						</tr>

					<?php } ?>
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
						<td><?php echo Fecha_estandar($rowdata['Fecha']); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<table id="items">
			<tbody>
				<tr>
					<th colspan="6">Detalle</th>
					<th colspan="1"></th>
				</tr>

				<?php if($arrDatosCorrectos!=false && !empty($arrDatosCorrectos) && $arrDatosCorrectos!='') { ?>
					<tr class="item-row linea_punteada" bgcolor="#F0F0F0">
						<td><strong>Identificador</strong></td>
						<td><strong>Cliente</strong></td>
						<td width="15px"><strong>Medidor</strong></td>
						<td width="15px"><strong>Remarcador</strong></td>
						<td><strong>Dirección</strong></td>
						<td width="15px"><strong>Consumo</strong></td>
						<td><strong>Acciones</strong></td>
					</tr>
					<?php foreach ($arrDatosCorrectos as $datos) { ?>
						<tr class="item-row linea_punteada">
							<td><?php echo $datos['Identificador']; ?></td>
							<td><?php echo $datos['Nombre']; ?></td>
							<td><?php echo $datos['Marcadores']; ?></td>
							<td><?php echo $datos['Remarcadores']; ?></td>
							<td><?php echo $datos['Direccion']; ?></td>
							<td><?php echo cantidades_decimales_justos($datos['Consumo']); ?></td>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<?php if ($rowlevel['level']>=2){ ?><a href="<?php echo $location.'&id='.$_GET['id'].'&modMed='.$datos['idDatosDetalle']; ?>" title="Editar Información" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
								</div>
							</td>
						</tr>
					<?php } ?>
					<tr id="hiderow"><td colspan="7"></td></tr>
				<?php } ?>

				<tr>
					<td colspan="7" class="blank">
						<p>
							<?php 
							if(isset($rowdata['Observaciones'])&&$rowdata['Observaciones']!=''){
								echo $rowdata['Observaciones'];
							}else{
								echo 'Sin Observaciones';
							} ?>
						</p>
					</td>
				</tr>
				<tr>
					<td colspan="7" class="blank"><p>Observaciones</p></td> 
				</tr>
			</tbody>
		</table>
    	<div class="clearfix"></div>
    </div>
</div>

<div class="clearfix"></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px; margin-top:30px">
<a href="<?php echo $location; ?>"  class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['addclient'])){
//Filtro
$SIS_where  = 'WHERE aguas_clientes_listado.idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
$SIS_where .= ' AND aguas_clientes_listado.idMarcadores = '.$_SESSION['rem_basicos']['idMarcadores'];
$SIS_where .= ' AND aguas_clientes_listado.idRemarcadores !=0';	

// Se trae un listado con todos los elementos
$SIS_query = '
aguas_clientes_listado.idCliente,
aguas_clientes_listado.Nombre AS ClienteNombre,
aguas_clientes_listado.Identificador AS ClienteIdentificador,
aguas_clientes_listado.idMarcadores,
aguas_clientes_listado.idRemarcadores,
aguas_marcadores_listado.Nombre AS Medidor,
aguas_marcadores_remarcadores.Nombre AS Remarcador';
$SIS_join  = '
LEFT JOIN `aguas_marcadores_listado`        ON aguas_marcadores_listado.idMarcadores         = aguas_clientes_listado.idMarcadores
LEFT JOIN `aguas_marcadores_remarcadores`   ON aguas_marcadores_remarcadores.idRemarcadores  = aguas_clientes_listado.idRemarcadores';
$SIS_order = 'aguas_clientes_listado.idCliente ASC';
$arrClientes = array();
$arrClientes = db_select_array (false, $SIS_query, 'aguas_clientes_listado', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrClientes');

//se dibujan los inputs
$Form_Inputs = new Inputs();

?>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="box dark">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Ingreso Consumos</h5>
			</header>
			<div class="body">

				<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

					<div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 nopadding">
							<?php $Form_Inputs->form_tittle(6, 'Nombre Cliente'); ?>
						</div>
						<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nopadding">
							<?php $Form_Inputs->form_tittle(6, 'Cod Medidor'); ?>
						</div>
						<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nopadding">
							<?php $Form_Inputs->form_tittle(6, 'Cod Remarcador'); ?>
						</div>
						<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nopadding">
							<?php $Form_Inputs->form_tittle(6, 'Consumo'); ?>
						</div>
						<div class="clearfix"></div>
					</div>
					<?php
					$NClientes = 0;
					foreach ($arrClientes as $cli) {
						$NClientes++;
						?>
						<div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 nopadding">
								<div class="form-group">
									<?php $Form_Inputs->input_disabled('text', 'Cliente', 'Cliente_'.$NClientes, $cli['ClienteIdentificador'].' '.$cli['ClienteNombre'], 1); ?>
								</div>
							</div>
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nopadding">
								<div class="form-group">
									<?php $Form_Inputs->input_disabled('text', 'Medidor', 'Medidor_'.$NClientes, $cli['Medidor'], 1); ?>
								</div>
							</div>
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nopadding">
								<div class="form-group">
									<?php $Form_Inputs->input_disabled('text', 'Remarcador', 'Remarcador_'.$NClientes, $cli['Remarcador'], 1); ?>
								</div>
							</div>
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nopadding">
								<div class="form-group">
									<?php $Form_Inputs->input_number('Consumo','Consumo_'.$NClientes, 0, 2); ?>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<?php
						$Form_Inputs->input_hidden('idMarcadores_'.$NClientes, $cli['idMarcadores'], 2);
						$Form_Inputs->input_hidden('idRemarcadores_'.$NClientes, $cli['idRemarcadores'], 2);
						$Form_Inputs->input_hidden('idCliente_'.$NClientes, $cli['idCliente'], 2);
						$Form_Inputs->input_hidden('Cliente_'.$NClientes, $cli['ClienteIdentificador'].' '.$cli['ClienteNombre'], 2);
						$Form_Inputs->input_hidden('Marcadores_'.$NClientes, $cli['Medidor'], 2);
						$Form_Inputs->input_hidden('Remarcadores_'.$NClientes, $cli['Remarcador'], 2);

					}
					$Form_Inputs->input_hidden('NClientes', $NClientes, 2);
					$Form_Inputs->input_hidden('Fecha', $_SESSION['rem_basicos']['Fecha'], 2);
					$Form_Inputs->input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
					
					?>

					<div class="form-group" style="margin-top:10px;">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar" name="submit_add_client">
						<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
					</div>

				</form>
				<?php widget_validator(); ?>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px; margin-top:30px">
<a href="<?php echo $location.'&view=true'; ?>"  class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} elseif(!empty($_GET['modBase'])){ 
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1 AND idFacturable=3";

?>

		
<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Medicion</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate >

				<?php
				//Se verifican si existen los datos
				if(isset($Fecha)){  $x1  = $Fecha;            }else{$x1  = $_SESSION['rem_basicos']['Fecha'];}
				if(isset($idCliente)){        $x2  = $idCliente;        }else{$x2  = $_SESSION['rem_basicos']['idCliente'];}
				if(isset($idTipoMedicion)){   $x3  = $idTipoMedicion;   }else{$x3  = $_SESSION['rem_basicos']['idTipoMedicion'];}
				if(isset($Observaciones)){    $x4  = $Observaciones;    }else{$x4  = $_SESSION['rem_basicos']['Observaciones'];}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha de Facturacion','Fecha', $x1, 2);
				$Form_Inputs->form_select_filter('Cliente','idCliente', $x2, 2, 'idCliente', 'identificador,Nombre', 'aguas_clientes_listado', $z, 'ORDER BY Identificador ASC', $dbConn);
				$Form_Inputs->form_select('Tipo Medicion','idTipoMedicion', $x3, 2, 'idTipoMedicion', 'Nombre', 'aguas_mediciones_datos_tipo_medicion', 0, '', $dbConn);
				$Form_Inputs->form_textarea('Observaciones', 'Observaciones', $x4, 1);

				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_modBase">
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['view'])){ ?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
	<div class="btn-group pull-right" role="group" aria-label="...">

		<?php
		$ubicacion = $location.'&clear_all=true';
		$dialogo   = '¿Realmente deseas eliminar todos los registros?'; ?>
		<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger dialogBox"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar Todo</a>

		<a href="<?php echo $location; ?>"  class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>

		<?php
		$ubicacion = $location.'&view=true&ing_doc=true';
		$dialogo   = '¿Realmente desea ingresar el documento, una vez realizada no podra realizar cambios?'; ?>
		<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-primary" ><i class="fa fa-check-square-o" aria-hidden="true"></i> Ingresar Documento</a>

	</div>
	<div class="clearfix"></div>
</div> 
	
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

	<div id="page-wrap">
		<div id="header"> Ingreso Datos Remarcadores  </div>
		<div id="customer">
			<table id="meta" class="pull-left otdata">
				<tbody>
					<tr>
						<td class="meta-head"><strong>DATOS BASICOS</strong></td>
						<td class="meta-head"><a href="<?php echo $location.'&view=true&modBase=true' ?>" title="Modificar Datos Basicos" class="btn btn-xs btn-primary tooltip pull-right" style="position: initial;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar</a></td>
					</tr>
					<tr>
						<td class="meta-head">Creador</td>
						<td><?php echo $_SESSION['rem_basicos']['Usuario']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Nombre del Archivo</td>
						<td><?php echo $_SESSION['rem_basicos']['Nombre']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Sistema</td>
						<td><?php echo $_SESSION['usuario']['basic_data']['RazonSocial']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Cliente</td>
						<td><?php echo $_SESSION['rem_basicos']['ClienteIdentificador'].' '.$_SESSION['rem_basicos']['ClienteNombre']; ?></td>
					<tr>
						<td class="meta-head">Medidor Cliente</td>
						<td><?php echo $_SESSION['rem_basicos']['ClienteMarcador']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Medicion del periodo</td>
						<td><?php echo Cantidades_decimales_justos($_SESSION['rem_basicos']['Consumo']).' Metros Cubicos'; ?></td>
					</tr>
					 <tr>
						<td class="meta-head">Distribucion de diferencia</td>
						<td><?php echo $_SESSION['rem_basicos']['TipoMedicion']; ?></td>
					</tr>
				</tbody>
			</table>
			<table id="meta" class="otdata2">
				<tbody>
					<tr>
						<td class="meta-head">Fecha Facturacion</td>
						<td><?php echo Fecha_estandar($_SESSION['rem_basicos']['Fecha']); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<table id="items">
			<tbody>
				<tr>
					<th colspan="4">Detalle</th>
					<th colspan="1"><a href="<?php echo $location.'&view=true&addclient=true' ?>" title="Agregar Clientes" class="btn btn-xs btn-primary tooltip pull-right" style="position: initial;"><i class="fa fa-user-plus" aria-hidden="true"></i> Agregar Clientes</a></th>
				</tr>

				<?php if(isset($_SESSION['rem_clientes'])){ ?>
					<tr class="item-row linea_punteada" bgcolor="#F0F0F0">
						<td><strong>Nombre Cliente</strong></td>
						<td><strong>Cod Medidor</strong></td>
						<td><strong>Cod Remarcador</strong></td>
						<td><strong>Consumo</strong></td>
						<td><strong>Acciones</strong></td>
					</tr>
					<?php foreach ($_SESSION['rem_clientes'] as $key => $clientes){ ?>
						<tr class="item-row linea_punteada">
							<td><?php echo $clientes['Cliente']; ?></td>
							<td><?php echo $clientes['Marcadores']; ?></td>
							<td><?php echo $clientes['Remarcadores']; ?></td>
							<td><?php echo cantidades_decimales_justos($clientes['Consumo']); ?></td>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<?php
									$ubicacion = $location.'&view=true&del_cliente='.$clientes['idPoint'];
									$dialogo   = '¿Realmente deseas eliminar la medicion de '.$clientes['Cliente'].'?'; ?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Información" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
								</div>
							</td>
						</tr>
					<?php } ?>
					<tr id="hiderow"><td colspan="5"></td></tr>
				<?php } ?>

				<tr>
					<td colspan="5" class="blank">
						<p>
							<?php 
							if(isset($_SESSION['rem_basicos']['Observaciones'])&&$_SESSION['rem_basicos']['Observaciones']!=''){
								echo $_SESSION['rem_basicos']['Observaciones'];
							}else{
								echo 'Sin Observaciones';
							} ?>
						</p>
					</td>
				</tr>
				<tr>
					<td colspan="5" class="blank"><p>Observaciones</p></td> 
				</tr>
			</tbody>
		</table>
    	<div class="clearfix"></div>
    </div>
</div>

<div class="clearfix"></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px; margin-top:30px">
<a href="<?php echo $location; ?>"  class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} elseif(!empty($_GET['new'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn);
//se crea filtro 
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1 AND idFacturable=3";

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Medicion</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate >

				<?php
				//Se verifican si existen los datos
				if(isset($Fecha)){  $x1  = $Fecha;            }else{$x1  = '';}
				if(isset($idCliente)){        $x2  = $idCliente;        }else{$x2  = '';}
				if(isset($idTipoMedicion)){   $x3  = $idTipoMedicion;   }else{$x3  = '';}
				if(isset($Observaciones)){    $x4  = $Observaciones;    }else{$x4  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha de Facturacion','Fecha', $x1, 2);
				$Form_Inputs->form_select_filter('Cliente','idCliente', $x2, 2, 'idCliente', 'identificador,Nombre', 'aguas_clientes_listado', $z, 'ORDER BY Identificador ASC', $dbConn);
				$Form_Inputs->form_select('Tipo Medicion','idTipoMedicion', $x3, 2, 'idTipoMedicion', 'Nombre', 'aguas_mediciones_datos_tipo_medicion', 0, '', $dbConn);
				$Form_Inputs->form_textarea('Observaciones', 'Observaciones', $x4, 1);

				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);

				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit">
					<a href="<?php echo $location; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else {
/**********************************************************/
//paginador de resultados
if(isset($_GET['pagina'])){$num_pag = $_GET['pagina'];} else {$num_pag = 1;}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){$comienzo = 0;$num_pag = 1;} else {$comienzo = ( $num_pag - 1 ) * $cant_reg ;}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'ingreso_asc':          $order_by = 'aguas_mediciones_datos.idDatos ASC ';          $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Ingreso Ascendente'; break;
		case 'ingreso_desc':         $order_by = 'aguas_mediciones_datos.idDatos DESC ';         $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Ingreso Descendente';break;
		case 'fechacreacion_asc':    $order_by = 'aguas_mediciones_datos.fCreacion ASC ';        $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Creacion Ascendente'; break;
		case 'fechacreacion_desc':   $order_by = 'aguas_mediciones_datos.fCreacion DESC ';       $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Creacion Descendente';break;
		case 'fechaingreso_asc':     $order_by = 'aguas_mediciones_datos.Fecha ASC ';            $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ingreso Ascendente'; break;
		case 'fechaingreso_desc':    $order_by = 'aguas_mediciones_datos.Fecha DESC ';           $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Ingreso Descendente';break;
		case 'creador_asc':          $order_by = 'usuarios_listado.Nombre ASC ';                 $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Creador Ascendente'; break;
		case 'creador_desc':         $order_by = 'usuarios_listado.Nombre DESC ';                $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Creador Descendente';break;
		case 'nombre_asc':           $order_by = 'aguas_mediciones_datos.Nombre ASC ';           $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente'; break;
		case 'nombre_desc':          $order_by = 'aguas_mediciones_datos.Nombre DESC ';          $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;

		default: $order_by = 'aguas_mediciones_datos.idDatos DESC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Ingreso Descendente';
	}
}else{
	$order_by = 'aguas_mediciones_datos.idDatos DESC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Ingreso Descendente';
}
/**********************************************************/
//Variable de busqueda
$SIS_where = "aguas_mediciones_datos.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
//se filtran para mostrar solo los ingresos de los medidores
$SIS_where.= " AND aguas_mediciones_datos.idTipo=2";
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Ano']) && $_GET['Ano']!=''){       $SIS_where .= " AND aguas_mediciones_datos.Ano='".$_GET['Ano']."'";}
if(isset($_GET['idMes']) && $_GET['idMes']!=''){   $SIS_where .= " AND aguas_mediciones_datos.idMes='".$_GET['idMes']."'";}
if(isset($_GET['idUsuario']) && $_GET['idUsuario']!=''){  $SIS_where .= " AND aguas_mediciones_datos.idUsuario='".$_GET['idUsuario']."'";}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$cuenta_registros = db_select_nrows (false, 'idDatos', 'aguas_mediciones_datos', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);
// Se trae un listado con todos los elementos
$SIS_query = '
aguas_mediciones_datos.idDatos,
aguas_mediciones_datos.fCreacion,
aguas_mediciones_datos.Fecha,
aguas_mediciones_datos.Nombre AS NombreArchivo,
usuarios_listado.Nombre AS NombreUsuario,
core_sistemas.Nombre AS sistema';
$SIS_join  = '
LEFT JOIN `core_sistemas`     ON core_sistemas.idSistema      = aguas_mediciones_datos.idSistema
LEFT JOIN `usuarios_listado`  ON usuarios_listado.idUsuario   = aguas_mediciones_datos.idUsuario';
$SIS_order = $order_by.' LIMIT '.$comienzo.', '.$cant_reg;
$arrTipo = array();
$arrTipo = db_select_array (false, $SIS_query, 'aguas_mediciones_datos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrTipo');

//Verifico el tipo de usuario que esta ingresando
$usrfil = 'usuarios_listado.idEstado=1 AND usuarios_listado.idTipoUsuario!=1';
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$usrfil .= " AND usuarios_sistemas.idSistema = ".$_SESSION['usuario']['basic_data']['idSistema'];
}

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseForm" aria-expanded="false" aria-controls="collapseForm" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>
	</ul>

	<?php if ($rowlevel['level']>=3){ ?><a href="<?php echo $location; ?>&new=true" class="btn btn-default pull-right margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Medicion</a><?php } ?>

</div>
<div class="clearfix"></div>
<div class="collapse col-xs-12 col-sm-12 col-md-12 col-lg-12" id="collapseForm">
	<div class="well">
		<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" autocomplete="off" novalidate>
				<?php
				//Se verifican si existen los datos
				//Se verifican si existen los datos
				if(isset($Ano)){       $x1  = $Ano;       }else{$x1  = '';}
				if(isset($idMes)){     $x2  = $idMes;     }else{$x2  = '';}
				if(isset($idUsuario)){ $x3  = $idUsuario; }else{$x3  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_n_auto('Año','Ano', $x1, 1, 2016, ano_actual());
				$Form_Inputs->form_select_filter('Mes','idMes', $x2, 1, 'idMes', 'Nombre', 'core_tiempo_meses', 0, 'idMes ASC', $dbConn);
				$Form_Inputs->form_select_join_filter('Usuario','idUsuario', $x3, 1, 'idUsuario', 'Nombre', 'usuarios_listado', 'usuarios_sistemas',$usrfil, $dbConn);

				$Form_Inputs->form_input_hidden('pagina', 1, 1);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf002; Filtrar" name="filtro_form">
					<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
				</div>

			</form>
            <?php widget_validator(); ?>
        </div>
	</div>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Mediciones</h5>
			<div class="toolbar">
				<?php
				//Se llama al paginador
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
									<?php if ($rowlevel['level']>=1){ ?><a href="<?php echo 'view_aguas_mediciones_datos.php?view='.simpleEncode($tipo['idDatos'], fecha_actual()); ?>" title="Ver Información" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=2){ ?><a href="<?php echo $location.'&id='.$tipo['idDatos']; ?>" title="Editar Información" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=4){
										$ubicacion = $location.'&del='.simpleEncode($tipo['idDatos'], fecha_actual());
										$dialogo   = '¿Realmente deseas eliminar la medicion '.n_doc($tipo['idDatos'], 7).'?'; ?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Información" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
