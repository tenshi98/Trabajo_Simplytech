<?php
/**********************************************************************************************************************************/
/*                                                   Se define la Sesion                                                          */
/**********************************************************************************************************************************/
$timeout = 604800;                               //Se setea la expiracion a una semana
ini_set( "session.gc_maxlifetime", $timeout );   //Establecer la vida útil máxima de la sesión
ini_set( "session.cookie_lifetime", $timeout );  //Establecer la duración de las cookies de la sesión
session_start();                                 //Iniciar una nueva sesión
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
$original = "aguas_datos_valores.php";
$location = $original;
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
	require_once 'A1XRXS_sys/xrxs_form/aguas_datos_valores.php';
}
//formulario para editar
if (!empty($_POST['submit_edit'])){
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/aguas_datos_valores.php';
}
//se borra un dato
if (!empty($_GET['del'])){
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/aguas_datos_valores.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Valor Creado correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Valor Modificado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Valor Borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['id'])){
	//valido los permisos
	validaPermisoUser($rowlevel['level'], 2, $dbConn);
	// consulto los datos
	$SIS_query = 'valorCargoFijo, valorAgua, valorRecoleccion, valorVisitaCorte, valorCorte1, valorCorte2, valorReposicion1, valorReposicion2,
	NdiasPago, Fac_nEmergencia, Fac_nConsultas';
	$SIS_join  = '';
	$SIS_where = 'idDato ='.$_GET['id'];
	$rowData = db_select_data (false, $SIS_query, 'aguas_datos_valores', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowData');

	?>

	<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Modificación Valores</h5>
			</header>
			<div class="body">
				<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($valorCargoFijo)){      $x1  = $valorCargoFijo;      }else{$x1  = $rowData['valorCargoFijo'];}
					if(isset($valorAgua)){           $x2  = $valorAgua;           }else{$x2  = $rowData['valorAgua'];}
					if(isset($valorRecoleccion)){    $x3  = $valorRecoleccion;    }else{$x3  = $rowData['valorRecoleccion'];}
					if(isset($valorVisitaCorte)){    $x4  = $valorVisitaCorte;    }else{$x4  = $rowData['valorVisitaCorte'];}
					if(isset($valorCorte1)){         $x5  = $valorCorte1;         }else{$x5  = $rowData['valorCorte1'];}
					if(isset($valorCorte2)){         $x6  = $valorCorte2;         }else{$x6  = $rowData['valorCorte2'];}
					if(isset($valorReposicion1)){    $x7  = $valorReposicion1;    }else{$x7  = $rowData['valorReposicion1'];}
					if(isset($valorReposicion2)){    $x8  = $valorReposicion2;    }else{$x8  = $rowData['valorReposicion2'];}
					if(isset($NdiasPago)){           $x9  = $NdiasPago;           }else{$x9  = $rowData['NdiasPago'];}
					if(isset($Fac_nEmergencia)){     $x10 = $Fac_nEmergencia;     }else{$x10 = $rowData['Fac_nEmergencia'];}
					if(isset($Fac_nConsultas)){      $x11 = $Fac_nConsultas;      }else{$x11 = $rowData['Fac_nConsultas'];}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_input_number('valor Cargo Fijo', 'valorCargoFijo', $x1, 2);
					$Form_Inputs->form_input_number('valor Agua', 'valorAgua', $x2, 2);
					$Form_Inputs->form_input_number('valor Recoleccion', 'valorRecoleccion', $x3, 2);
					$Form_Inputs->form_input_number('valor Visita Corte', 'valorVisitaCorte', $x4, 2);
					$Form_Inputs->form_input_number('valor Corte 1 instancia', 'valorCorte1', $x5, 2);
					$Form_Inputs->form_input_number('valor Corte 2 instancia', 'valorCorte2', $x6, 2);
					$Form_Inputs->form_input_number('valor Reposicion 1 instancia', 'valorReposicion1', $x7, 2);
					$Form_Inputs->form_input_number('valor Reposicion 2 instancia', 'valorReposicion2', $x8, 2);
					$Form_Inputs->form_select_n_auto('Dias para Vencimiento','NdiasPago', $x9, 2, 1, 31);
					$Form_Inputs->form_post_data(4,1,1, 'Al ingresar el numero telefónico omitir el +56 e ingresar el resto del número' );
					$Form_Inputs->form_input_phone('Fono Emergencias 24 hrs', 'Fac_nEmergencia', $x10, 2);
					$Form_Inputs->form_input_phone('Fono Consultas', 'Fac_nConsultas', $x11, 2);

					$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
					$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
					$Form_Inputs->form_input_hidden('idDato', $_GET['id'], 2);
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
}elseif(!empty($_GET['new'])){
	//valido los permisos
	validaPermisoUser($rowlevel['level'], 3, $dbConn); ?>

	<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Crear Valores</h5>
			</header>
			<div class="body">
				<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($valorCargoFijo)){      $x1  = $valorCargoFijo;      }else{$x1  = '';}
					if(isset($valorAgua)){           $x2  = $valorAgua;           }else{$x2  = '';}
					if(isset($valorRecoleccion)){    $x3  = $valorRecoleccion;    }else{$x3  = '';}
					if(isset($valorVisitaCorte)){    $x4  = $valorVisitaCorte;    }else{$x4  = '';}
					if(isset($valorCorte1)){         $x5  = $valorCorte1;         }else{$x5  = '';}
					if(isset($valorCorte2)){         $x6  = $valorCorte2;         }else{$x6  = '';}
					if(isset($valorReposicion1)){    $x7  = $valorReposicion1;    }else{$x7  = '';}
					if(isset($valorReposicion2)){    $x8  = $valorReposicion2;    }else{$x8  = '';}
					if(isset($NdiasPago)){           $x9  = $NdiasPago;           }else{$x9  = '';}
					if(isset($Fac_nEmergencia)){     $x10 = $Fac_nEmergencia;     }else{$x10 = '';}
					if(isset($Fac_nConsultas)){      $x11 = $Fac_nConsultas;      }else{$x11 = '';}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_input_number('valor Cargo Fijo', 'valorCargoFijo', $x1, 2);
					$Form_Inputs->form_input_number('valor Agua', 'valorAgua', $x2, 2);
					$Form_Inputs->form_input_number('valor Recoleccion', 'valorRecoleccion', $x3, 2);
					$Form_Inputs->form_input_number('valor Visita Corte', 'valorVisitaCorte', $x4, 2);
					$Form_Inputs->form_input_number('valor Corte 1 instancia', 'valorCorte1', $x5, 2);
					$Form_Inputs->form_input_number('valor Corte 2 instancia', 'valorCorte2', $x6, 2);
					$Form_Inputs->form_input_number('valor Reposicion 1 instancia', 'valorReposicion1', $x7, 2);
					$Form_Inputs->form_input_number('valor Reposicion 2 instancia', 'valorReposicion2', $x8, 2);
					$Form_Inputs->form_select_n_auto('Dias para Vencimiento','NdiasPago', $x9, 2, 1, 31);
					$Form_Inputs->form_post_data(4,1,1, 'Al ingresar el numero telefónico omitir el +56 e ingresar el resto del número' );
					$Form_Inputs->form_input_phone('Fono Emergencias 24 hrs', 'Fac_nEmergencia', $x10, 2);
					$Form_Inputs->form_input_phone('Fono Consultas', 'Fac_nConsultas', $x11, 2);

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
}else{
	/*******************************************************/
	// consulto los datos
	$SIS_query = '
	aguas_datos_valores.idDato,
	aguas_datos_valores.valorVisitaCorte,
	aguas_datos_valores.valorCorte1,
	aguas_datos_valores.valorCorte2,
	aguas_datos_valores.valorReposicion1,
	aguas_datos_valores.valorReposicion2,
	core_sistemas.Nombre AS sistema';
	$SIS_join  = 'LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = aguas_datos_valores.idSistema';
	$SIS_where = 'aguas_datos_valores.idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
	$SIS_order = 0;
	$arrUML = array();
	$arrUML = db_select_array (false, $SIS_query, 'aguas_datos_valores', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrUML');

	/*************************/
	//cuento los registros
	$counter = 0;
	foreach ($arrUML as $uml) {
		$counter++;
	}

	?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar">
		<?php if ($rowlevel['level']>=3&&$counter==0){ ?><a href="<?php echo $location; ?>?new=true" class="btn btn-default pull-right margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Valores Facturacion</a><?php } ?>
	</div>
	<div class="clearfix"></div>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Valores de Facturacion</h5>
			</header>
			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<thead>
						<tr role="row">
							<th>valor Visita Corte</th>
							<th>valor Corte 1</th>
							<th>valor Corte 2</th>
							<th>valor Reposicion 1</th>
							<th>valor Reposicion 2</th>
							<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
							<th width="10">Acciones</th>
						</tr>
					</thead>
					<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrUML as $uml) { ?>
						<tr class="odd">
							<td align="right"><?php echo valores($uml['valorVisitaCorte'], 0); ?></td>
							<td align="right"><?php echo valores($uml['valorCorte1'], 0); ?></td>
							<td align="right"><?php echo valores($uml['valorCorte2'], 0); ?></td>
							<td align="right"><?php echo valores($uml['valorReposicion1'], 0); ?></td>
							<td align="right"><?php echo valores($uml['valorReposicion2'], 0); ?></td>
							<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $uml['sistema']; ?></td><?php } ?>
							<td>
								<div class="btn-group" style="width: 70px;" >
									<?php if ($rowlevel['level']>=2){ ?><a href="<?php echo $location.'?id='.$uml['idDato']; ?>" title="Editar Información" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=4){
										$ubicacion = $location.'?del='.simpleEncode($uml['idDato'], fecha_actual());
										$dialogo   = '¿Realmente deseas eliminar el dato?'; ?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Información" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
									<?php } ?>
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
