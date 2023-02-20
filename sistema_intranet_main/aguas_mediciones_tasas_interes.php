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
$original = "aguas_mediciones_tasas_interes.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Fecha']) && $_GET['Fecha']!=''){            $location .= "&Fecha=".$_GET['Fecha'];                   $search .= "&Fecha=".$_GET['Fecha'];}
if(isset($_GET['TasaCorriente']) && $_GET['TasaCorriente']!=''){   $location .= "&TasaCorriente=".$_GET['TasaCorriente'];   $search .= "&TasaCorriente=".$_GET['TasaCorriente'];}
if(isset($_GET['TasaDia']) && $_GET['TasaDia']!=''){        $location .= "&TasaDia=".$_GET['TasaDia'];               $search .= "&TasaDia=".$_GET['TasaDia'];}
if(isset($_GET['MC']) && $_GET['MC']!=''){                  $location .= "&MC=".$_GET['MC'];                         $search .= "&MC=".$_GET['MC'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if (!empty($_POST['submit'])){
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/aguas_mediciones_tasas_interes.php';
}
//formulario para editar
if (!empty($_POST['submit_edit'])){
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/aguas_mediciones_tasas_interes.php';
}
//se borra un dato
if (!empty($_GET['del'])){
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/aguas_mediciones_tasas_interes.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Tasa de Interes Creada correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Tasa de Interes Modificada correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Tasa de Interes borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['id'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);
// consulto los datos
$query = "SELECT Fecha, TasaCorriente, TasaDia, MC
FROM `aguas_mediciones_tasas_interes`
WHERE idTasasInteres = ".$_GET['id'];
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
 
<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Modificacion de Tasa de Interes</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
			
				<?php
				//Se verifican si existen los datos
				if(isset($Fecha)){$x1  = $Fecha;          }else{$x1  = $rowdata['Fecha'];}
				if(isset($TasaCorriente)){  $x2  = $TasaCorriente;  }else{$x2  = Cantidades_decimales_justos($rowdata['TasaCorriente']);}
				if(isset($TasaDia)){        $x3  = $TasaDia;        }else{$x3  = Cantidades_decimales_justos($rowdata['TasaDia']);}
				if(isset($MC)){             $x4  = $MC;             }else{$x4  = Cantidades_decimales_justos($rowdata['MC']);}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha','Fecha', $x1, 2);
				$Form_Inputs->form_input_number('Tasa Corriente', 'TasaCorriente', $x2, 2);
				$Form_Inputs->form_input_number('Tasa Dia', 'TasaDia', $x3, 2);
				$Form_Inputs->form_input_number('MC', 'MC', $x4, 2);
				
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idTasasInteres', $_GET['id'], 2);
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
 } elseif(!empty($_GET['new'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn);?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Tasa de Interes</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php
				//Se verifican si existen los datos
				if(isset($Fecha)){$x1  = $Fecha;          }else{$x1  = '';}
				if(isset($TasaCorriente)){  $x2  = $TasaCorriente;  }else{$x2  = '';}
				if(isset($TasaDia)){        $x3  = $TasaDia;        }else{$x3  = '';}
				if(isset($MC)){             $x4  = $MC;             }else{$x4  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha','Fecha', $x1, 2);
				$Form_Inputs->form_input_number('Tasa Corriente', 'TasaCorriente', $x2, 2);
				$Form_Inputs->form_input_number('Tasa Dia', 'TasaDia', $x3, 2);
				$Form_Inputs->form_input_number('MC', 'MC', $x4, 2);
				
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				
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
		case 'fecha_asc':           $order_by = 'aguas_mediciones_tasas_interes.Fecha ASC ';           $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente'; break;
		case 'fecha_desc':          $order_by = 'aguas_mediciones_tasas_interes.Fecha DESC ';          $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;
		case 'dia_asc':             $order_by = 'aguas_mediciones_tasas_interes.Dia ASC ';             $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Dia Ascendente'; break;
		case 'dia_desc':            $order_by = 'aguas_mediciones_tasas_interes.Dia DESC ';            $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Dia Descendente';break;
		case 'mes_asc':             $order_by = 'aguas_mediciones_tasas_interes.idMes ASC ';           $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Mes Ascendente'; break;
		case 'mes_desc':            $order_by = 'aguas_mediciones_tasas_interes.idMes DESC ';          $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Mes Descendente';break;
		case 'ano_asc':             $order_by = 'aguas_mediciones_tasas_interes.Ano ASC ';             $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Año Ascendente'; break;
		case 'ano_desc':            $order_by = 'aguas_mediciones_tasas_interes.Ano DESC ';            $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Año Descendente';break;
		case 'tasacorriente_asc':   $order_by = 'aguas_mediciones_tasas_interes.TasaCorriente ASC ';   $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Tasa Corriente Ascendente'; break;
		case 'tasacorriente_desc':  $order_by = 'aguas_mediciones_tasas_interes.TasaCorriente DESC ';  $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Tasa Corriente Descendente';break;
		case 'tasadia_asc':         $order_by = 'aguas_mediciones_tasas_interes.TasaDia ASC ';         $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Tasa Dia Ascendente'; break;
		case 'tasadia_desc':        $order_by = 'aguas_mediciones_tasas_interes.TasaDia DESC ';        $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Tasa Dia Descendente';break;
		case 'mc_asc':              $order_by = 'aguas_mediciones_tasas_interes.MC ASC ';              $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> MC Ascendente'; break;
		case 'mc_desc':             $order_by = 'aguas_mediciones_tasas_interes.MC DESC ';             $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> MC Descendente';break;
		
		default: $order_by = 'aguas_mediciones_tasas_interes.Fecha ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente';
	}
}else{
	$order_by = 'aguas_mediciones_tasas_interes.Fecha ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente';
}
/**********************************************************/
//Variable de busqueda
$SIS_where = "aguas_mediciones_tasas_interes.idTasasInteres!=0";
$SIS_where.= " AND aguas_mediciones_tasas_interes.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];//Verifico el tipo de usuario que esta ingresando	
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Fecha']) && $_GET['Fecha']!=''){            $SIS_where .= " AND aguas_mediciones_tasas_interes.Fecha='".$_GET['Fecha']."'";}
if(isset($_GET['TasaCorriente']) && $_GET['TasaCorriente']!=''){   $SIS_where .= " AND aguas_mediciones_tasas_interes.TasaCorriente='".$_GET['TasaCorriente']."'";}
if(isset($_GET['TasaDia']) && $_GET['TasaDia']!=''){        $SIS_where .= " AND aguas_mediciones_tasas_interes.TasaDia='".$_GET['TasaDia']."'";}
if(isset($_GET['MC']) && $_GET['MC']!=''){                  $SIS_where .= " AND aguas_mediciones_tasas_interes.MC='".$_GET['MC']."'";}

/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$cuenta_registros = db_select_nrows (false, 'idTasasInteres', 'aguas_mediciones_tasas_interes', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);
// Se trae un listado con todos los elementos
$SIS_query = '
aguas_mediciones_tasas_interes.idTasasInteres,
aguas_mediciones_tasas_interes.Dia, 
aguas_mediciones_tasas_interes.Ano,
aguas_mediciones_tasas_interes.Fecha, 
aguas_mediciones_tasas_interes.TasaCorriente,
aguas_mediciones_tasas_interes.TasaDia,
aguas_mediciones_tasas_interes.MC,
core_sistemas.Nombre AS sistema,
core_tiempo_meses.Nombre AS Mes';
$SIS_join  = '
LEFT JOIN `core_sistemas`       ON core_sistemas.idSistema    = aguas_mediciones_tasas_interes.idSistema
LEFT JOIN `core_tiempo_meses`   ON core_tiempo_meses.idMes    = aguas_mediciones_tasas_interes.idMes';
$SIS_order = $order_by.' LIMIT '.$comienzo.', '.$cant_reg;
$arrUML = array();
$arrUML = db_select_array (false, $SIS_query, 'aguas_mediciones_tasas_interes', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrUML');

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseForm" aria-expanded="false" aria-controls="collapseForm" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default pull-right margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Tasa de Interes</a><?php } ?>
	
</div>
<div class="clearfix"></div>
<div class="collapse col-xs-12 col-sm-12 col-md-12 col-lg-12" id="collapseForm">
	<div class="well">
		<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php
				//Se verifican si existen los datos
				if(isset($Fecha)){$x1  = $Fecha;          }else{$x1  = '';}
				if(isset($TasaCorriente)){  $x2  = $TasaCorriente;  }else{$x2  = '';}
				if(isset($TasaDia)){        $x3  = $TasaDia;        }else{$x3  = '';}
				if(isset($MC)){             $x4  = $MC;             }else{$x4  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha','Fecha', $x1, 1);
				$Form_Inputs->form_input_number('Tasa Corriente', 'TasaCorriente', $x2, 1);
				$Form_Inputs->form_input_number('Tasa Dia', 'TasaDia', $x3, 1);
				$Form_Inputs->form_input_number('MC', 'MC', $x4, 1);
				
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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Tasa de Interes</h5>
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
							<div class="pull-left">Fecha</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fecha_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=fecha_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Dia</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=dia_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=dia_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Mes</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=mes_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=mes_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Año</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=ano_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=ano_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Tasa Corriente</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=tasacorriente_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=tasacorriente_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Tasa Dia</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=tasadia_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=tasadia_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">MC</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=mc_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=mc_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>		  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrUML as $uml) { ?>
					<tr class="odd">
						<td><?php echo $uml['Fecha']; ?></td>
						<td><?php echo $uml['Dia']; ?></td>
						<td><?php echo $uml['Mes']; ?></td>
						<td><?php echo $uml['Ano']; ?></td>
						<td><?php echo Cantidades_decimales_justos($uml['TasaCorriente']); ?></td>
						<td><?php echo Cantidades_decimales_justos($uml['TasaDia']); ?></td>
						<td><?php echo Cantidades_decimales_justos($uml['MC']); ?></td>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $uml['sistema']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 70px;" >
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$uml['idTasasInteres']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.simpleEncode($uml['idTasasInteres'], fecha_actual());
									$dialogo   = '¿Realmente deseas eliminar la Tasa de Interes?';?>
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
