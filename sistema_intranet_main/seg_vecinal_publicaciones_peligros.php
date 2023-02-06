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
$original = "seg_vecinal_publicaciones_peligros.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idCliente']) && $_GET['idCliente']!=''){    $location .= "&idCliente=".$_GET['idCliente'];    $search .= "&idCliente=".$_GET['idCliente'];}
if(isset($_GET['idTipo']) && $_GET['idTipo']!=''){   $location .= "&idTipo=".$_GET['idTipo'];          $search .= "&idTipo=".$_GET['idTipo'];}
if(isset($_GET['idCiudad']) && $_GET['idCiudad']!=''){      $location .= "&idCiudad=".$_GET['idCiudad'];      $search .= "&idCiudad=".$_GET['idCiudad'];}
if(isset($_GET['idComuna']) && $_GET['idComuna']!=''){      $location .= "&idComuna=".$_GET['idComuna'];      $search .= "&idComuna=".$_GET['idComuna'];}
if(isset($_GET['Direccion']) && $_GET['Direccion']!=''){    $location .= "&Direccion=".$_GET['Direccion'];    $search .= "&Direccion=".$_GET['Direccion'];}
if(isset($_GET['Fecha']) && $_GET['Fecha']!=''){     $location .= "&Fecha=".$_GET['Fecha'];            $search .= "&Fecha=".$_GET['Fecha'];}
if(isset($_GET['Hora']) && $_GET['Hora']!=''){       $location .= "&Hora=".$_GET['Hora'];              $search .= "&Hora=".$_GET['Hora'];}
if(isset($_GET['idEstado']) && $_GET['idEstado']!=''){      $location .= "&idEstado=".$_GET['idEstado'];      $search .= "&idEstado=".$_GET['idEstado'];}
if(isset($_GET['idValidado']) && $_GET['idValidado']!=''){  $location .= "&idValidado=".$_GET['idValidado'];  $search .= "&idValidado=".$_GET['idValidado'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if (!empty($_POST['submit_edit'])){
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/seg_vecinal_peligros_listado.php';
}
//se borra un dato
if (!empty($_GET['del'])){
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/seg_vecinal_peligros_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Zona de Peligro Modificado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Zona de Peligro borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['id'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);
// consulto los datos
$query = "SELECT idCliente, idTipo, idCiudad, idComuna, Direccion, Fecha, 
Hora, Descripcion, idEstado, idValidado
FROM `seg_vecinal_peligros_listado`
WHERE idPeligro = ".$_GET['id'];
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
//Verifico el tipo de usuario que esta ingresando
$z = 'idSistema='.$_SESSION['usuario']['basic_data']['idSistema'].' AND idEstado=1';	?>
 
<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Modificacion Categoria</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($idCliente)){   $x1  = $idCliente;   }else{$x1  = $rowdata['idCliente'];}
				if(isset($idTipo)){      $x2  = $idTipo;      }else{$x2  = $rowdata['idTipo'];}
				if(isset($idCiudad)){    $x3  = $idCiudad;    }else{$x3  = $rowdata['idCiudad'];}
				if(isset($idComuna)){    $x4  = $idComuna;    }else{$x4  = $rowdata['idComuna'];}
				if(isset($Direccion)){   $x5  = $Direccion;   }else{$x5  = $rowdata['Direccion'];}
				if(isset($Fecha)){       $x6  = $Fecha;       }else{$x6  = $rowdata['Fecha'];}
				if(isset($Hora)){        $x7  = $Hora;        }else{$x7  = $rowdata['Hora'];}
				if(isset($Descripcion)){ $x8  = $Descripcion; }else{$x8  = $rowdata['Descripcion'];}
				if(isset($idEstado)){    $x9  = $idEstado;    }else{$x9  = $rowdata['idEstado'];}
				if(isset($idValidado)){  $x10 = $idValidado;  }else{$x10 = $rowdata['idValidado'];}
					
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Vecino','idCliente', $x1, 2, 'idCliente', 'Nombre', 'seg_vecinal_clientes_listado', $z, '', $dbConn);
				$Form_Inputs->form_select('Tipo de Peligro','idTipo', $x2, 2, 'idTipo', 'Nombre', 'seg_vecinal_peligros_tipos', 0, '',$dbConn);
				$Form_Inputs->form_select_depend1('Region','idCiudad', $x3, 2, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
												  'Comuna','idComuna', $x4, 2, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0,
												  $dbConn, 'form1');
				$Form_Inputs->form_input_icon('Direccion', 'Direccion', $x5, 2,'fa fa-map');
				$Form_Inputs->form_date('Fecha','Fecha', $x6, 1);
				$Form_Inputs->form_time('Hora','Hora', $x7, 1, 1);
				$Form_Inputs->form_textarea('Descripcion', 'Descripcion', $x8, 2);
				$Form_Inputs->form_select('Estado','idEstado', $x9, 2, 'idEstado', 'Nombre', 'core_estados', 0, '',$dbConn);
				$Form_Inputs->form_select('Validado','idValidado', $x10, 2, 'idValidado', 'Nombre', 'core_seguridad_validacion', 0, '',$dbConn);
				
				$Form_Inputs->form_input_hidden('idPeligro', $_GET['id'], 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">
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
//Variable de busqueda
$SIS_where = "seg_vecinal_peligros_listado.idPeligro!=0";
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idCliente']) && $_GET['idCliente']!=''){      $SIS_where .= " AND seg_vecinal_peligros_listado.idCliente='".$_GET['idCliente']."'";}
if(isset($_GET['idTipo']) && $_GET['idTipo']!=''){     $SIS_where .= " AND seg_vecinal_peligros_listado.idTipo='".$_GET['idTipo']."'";}
if(isset($_GET['idCiudad']) && $_GET['idCiudad']!=''){ $SIS_where .= " AND seg_vecinal_peligros_listado.idCiudad='".$_GET['idCiudad']."'";}
if(isset($_GET['idComuna']) && $_GET['idComuna']!=''){ $SIS_where .= " AND seg_vecinal_peligros_listado.idComuna='".$_GET['idComuna']."'";}
if(isset($_GET['Direccion']) && $_GET['Direccion']!=''){      $SIS_where .= " AND seg_vecinal_peligros_listado.Direccion='".$_GET['Direccion']."'";}
if(isset($_GET['Fecha']) && $_GET['Fecha']!=''){       $SIS_where .= " AND seg_vecinal_peligros_listado.Fecha='".$_GET['Fecha']."'";}
if(isset($_GET['Hora']) && $_GET['Hora']!=''){         $SIS_where .= " AND seg_vecinal_peligros_listado.Hora='".$_GET['Hora']."'";}
if(isset($_GET['idEstado']) && $_GET['idEstado']!=''){ $SIS_where .= " AND seg_vecinal_peligros_listado.idEstado='".$_GET['idEstado']."'";}
if(isset($_GET['idValidado']) && $_GET['idValidado']!=''){    $SIS_where .= " AND seg_vecinal_peligros_listado.idValidado='".$_GET['idValidado']."'";}
				
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$cuenta_registros = db_select_nrows (false, 'idPeligro', 'seg_vecinal_peligros_listado', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);
// Se trae un listado con todos los elementos
$SIS_query = '
seg_vecinal_peligros_listado.idPeligro,
seg_vecinal_peligros_listado.Direccion,
seg_vecinal_peligros_listado.Fecha,
seg_vecinal_peligros_listado.Hora,

seg_vecinal_peligros_tipos.Nombre AS Tipo,
core_ubicacion_ciudad.Nombre AS Ciudad,
core_ubicacion_comunas.Nombre AS Comuna,
seg_vecinal_peligros_listado.idEstado,
core_estados.Nombre AS Estado,
seg_vecinal_clientes_listado.Nombre AS Vecino,
seg_vecinal_peligros_listado.idValidado,
core_seguridad_validacion.Nombre AS Validacion';
$SIS_join  = '
LEFT JOIN `seg_vecinal_peligros_tipos`    ON seg_vecinal_peligros_tipos.idTipo       = seg_vecinal_peligros_listado.idTipo
LEFT JOIN `core_ubicacion_ciudad`         ON core_ubicacion_ciudad.idCiudad          = seg_vecinal_peligros_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`        ON core_ubicacion_comunas.idComuna         = seg_vecinal_peligros_listado.idComuna
LEFT JOIN `core_estados`                  ON core_estados.idEstado                   = seg_vecinal_peligros_listado.idEstado
LEFT JOIN `seg_vecinal_clientes_listado`  ON seg_vecinal_clientes_listado.idCliente  = seg_vecinal_peligros_listado.idCliente
LEFT JOIN `core_seguridad_validacion`     ON core_seguridad_validacion.idValidado    = seg_vecinal_peligros_listado.idValidado';
$SIS_order = 'seg_vecinal_peligros_listado.idEstado ASC, seg_vecinal_peligros_listado.Fecha DESC, seg_vecinal_peligros_listado.Hora DESC LIMIT '.$comienzo.', '.$cant_reg;
$arrPeligros = array();
$arrPeligros = db_select_array (false, $SIS_query, 'seg_vecinal_peligros_listado', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrPeligros');

/******************************************************************************/
//Verifico el tipo de usuario que esta ingresando
$z = 'idSistema='.$_SESSION['usuario']['basic_data']['idSistema'].' AND idEstado=1';


?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseForm" aria-expanded="false" aria-controls="collapseForm" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default">Fecha Ascendente</li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>
	</ul>
	
</div>
<div class="clearfix"></div>
<div class="collapse col-xs-12 col-sm-12 col-md-12 col-lg-12" id="collapseForm">
	<div class="well">
		<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($idCliente)){   $x1 = $idCliente;   }else{$x1  = '';}
				if(isset($idTipo)){      $x2 = $idTipo;      }else{$x2  = '';}
				if(isset($idCiudad)){    $x3 = $idCiudad;    }else{$x3  = '';}
				if(isset($idComuna)){    $x4 = $idComuna;    }else{$x4  = '';}
				if(isset($Direccion)){   $x5 = $Direccion;   }else{$x5  = '';}
				if(isset($Fecha)){       $x6 = $Fecha;       }else{$x6  = '';}
				if(isset($Hora)){        $x7 = $Hora;        }else{$x7  = '';}
				if(isset($idEstado)){    $x8 = $idEstado;    }else{$x8  = '';}
				if(isset($idValidado)){  $x9 = $idValidado;  }else{$x9  = '';}
						
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Vecino','idCliente', $x1, 1, 'idCliente', 'Nombre', 'seg_vecinal_clientes_listado', $z, '', $dbConn);
				$Form_Inputs->form_select('Tipo de Peligro','idTipo', $x2, 1, 'idTipo', 'Nombre', 'seg_vecinal_peligros_tipos', 0, '',$dbConn);
				$Form_Inputs->form_select_depend1('Region','idCiudad', $x3, 1, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
												  'Comuna','idComuna', $x4, 1, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0,
												  $dbConn, 'form1');
				$Form_Inputs->form_input_icon('Direccion', 'Direccion', $x5, 1,'fa fa-map');
				$Form_Inputs->form_date('Fecha','Fecha', $x6, 1);
				$Form_Inputs->form_time('Hora','Hora', $x7, 1, 1);
				$Form_Inputs->form_select('Estado','idEstado', $x8, 1, 'idEstado', 'Nombre', 'core_estados', 0, '',$dbConn);
				$Form_Inputs->form_select('Validado','idValidado', $x9, 1, 'idValidado', 'Nombre', 'core_seguridad_validacion', 0, '',$dbConn);
						
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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Zonas de Peligros</h5>
			<div class="toolbar">
				<?php 
				//paginacion
				echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
			</div>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Vecino</th>
						<th>Tipo</th>
						<th>Ubicacion</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Estado</th>
						<th>Validado</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrPeligros as $eve) { ?>
						<tr class="odd">
							<td><?php echo $eve['Vecino']; ?></td>
							<td><?php echo $eve['Tipo']; ?></td>
							<td><?php echo $eve['Direccion'].', '.$eve['Comuna'].', '.$eve['Ciudad']; ?></td>
							<td><?php echo fecha_estandar($eve['Fecha']); ?></td>
							<td><?php echo $eve['Hora']; ?></td>
							<td><label class="label <?php if(isset($eve['idEstado'])&&$eve['idEstado']==1){echo 'label-success';}else{echo 'label-danger';}?>"><?php echo $eve['Estado']; ?></label></td>
							<td><label class="label <?php if(isset($eve['idValidado'])&&$eve['idValidado']==2){echo 'label-success';}else{echo 'label-danger';}?>"><?php echo $eve['Validacion']; ?></label></td>
							<td>
								<div class="btn-group" style="width: 105px;" >
									<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_seg_vecinal_peligro.php?view='.simpleEncode($eve['idPeligro'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$eve['idPeligro']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=4){
										$ubicacion = $location.'&del='.simpleEncode($eve['idPeligro'], fecha_actual());
										$dialogo   = '¿Realmente deseas eliminar la zona de peligro '.$eve['Tipo'].'?';?>
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
			//paginacion
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
