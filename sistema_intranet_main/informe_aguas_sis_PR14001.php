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
$original = "informe_aguas_sis_PR14001.php";
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
if(!empty($_GET['submit_filter'])){
	/*******************************************************/
	//Verifico el tipo de usuario que esta ingresando
	$n = "&idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
	//Filtros
	if (isset($_GET['idSector']) && $_GET['idSector']!=''){         	    $n .="&idSector=".$_GET['idSector'];}
	if (isset($_GET['idPuntoMuestreo']) && $_GET['idPuntoMuestreo']!=''){  	$n .="&idPuntoMuestreo=".$_GET['idPuntoMuestreo'];}
	if (isset($_GET['idTipoMuestra']) && $_GET['idTipoMuestra']!=''){      	$n .="&idTipoMuestra=".$_GET['idTipoMuestra'];}
	if (isset($_GET['idParametros']) && $_GET['idParametros']!=''){	        $n .="&idParametros=".$_GET['idParametros'];}
	if (isset($_GET['idSigno']) && $_GET['idSigno']!=''){           	    $n .="&idSigno=".$_GET['idSigno'];}
	if (isset($_GET['idLaboratorio']) && $_GET['idLaboratorio']!=''){      	$n .="&idLaboratorio=".$_GET['idLaboratorio'];}
	if(isset($_GET['f_muestra_inicio'], $_GET['f_muestra_termino']) && $_GET['f_muestra_inicio'] != '' && $_GET['f_muestra_termino']!=''){
		$n .="&f_muestra_inicio=".$_GET['f_muestra_inicio']."&f_muestra_termino=".$_GET['f_muestra_termino'];
	}
	if(isset($_GET['f_recibida_inicio'], $_GET['f_recibida_termino']) && $_GET['f_recibida_inicio'] != '' && $_GET['f_recibida_termino']!=''){
		$n .="&f_recibida_inicio=".$_GET['f_recibida_inicio']."&f_recibida_termino=".$_GET['f_recibida_termino'];
	}
	/*******************************************************/
	// consulto los datos
	$SIS_query = '
	aguas_analisis_aguas.codigoProceso,
	aguas_analisis_aguas.codigoArchivo,
	core_sistemas.Rut AS rut,
	aguas_analisis_aguas.f_recibida AS periodo,
	aguas_analisis_aguas.codigoServicio AS codigo_servicio,
	aguas_analisis_aguas.idSector AS codigo_sector,
	aguas_analisis_aguas.codigoMuestra AS codigo_muestra,
	aguas_analisis_aguas_tipo_punto_muestreo.Codigo AS tipo_punto_muestreo,
	aguas_analisis_aguas.UTM_norte,
	aguas_analisis_aguas.UTM_este,
	aguas_analisis_aguas_tipo_muestra.Codigo AS tipo_muestra,
	aguas_analisis_aguas.RemuestraFecha AS periodo_remuestreo,
	aguas_analisis_aguas.f_muestra AS fecha_muestra,
	aguas_analisis_parametros.Codigo AS codigo_parametro,
	aguas_analisis_aguas_signo.Codigo AS signo,
	aguas_analisis_aguas.valorAnalisis AS valor,
	aguas_analisis_laboratorios.Rut AS rutLaboratorio,
	aguas_analisis_laboratorios.Codigo AS idLaboratorio,
	aguas_clientes_listado.Identificador';
	$SIS_join  = '
	LEFT JOIN `core_sistemas`                               ON core_sistemas.idSistema                                       = aguas_analisis_aguas.idSistema
	LEFT JOIN `aguas_analisis_aguas_tipo_punto_muestreo`    ON aguas_analisis_aguas_tipo_punto_muestreo.idPuntoMuestreo      = aguas_analisis_aguas.idPuntoMuestreo
	LEFT JOIN `aguas_analisis_aguas_tipo_muestra`           ON aguas_analisis_aguas_tipo_muestra.idTipoMuestra               = aguas_analisis_aguas.idTipoMuestra
	LEFT JOIN `aguas_analisis_parametros`                   ON aguas_analisis_parametros.idParametros                        = aguas_analisis_aguas.idParametros
	LEFT JOIN `aguas_analisis_aguas_signo`                  ON aguas_analisis_aguas_signo.idSigno                            = aguas_analisis_aguas.idSigno
	LEFT JOIN `aguas_analisis_laboratorios`                 ON aguas_analisis_laboratorios.idLaboratorio                     = aguas_analisis_aguas.idLaboratorio
	LEFT JOIN `aguas_clientes_listado`                      ON aguas_clientes_listado.idCliente                              = aguas_analisis_aguas.idCliente';
	$SIS_where = 'aguas_analisis_aguas.idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
	if (isset($_GET['idSector']) && $_GET['idSector']!=''){         	    $SIS_where .=" AND aguas_analisis_aguas.idSector='".$_GET['idSector']."'";}
	if (isset($_GET['idPuntoMuestreo']) && $_GET['idPuntoMuestreo']!=''){  	$SIS_where .=" AND aguas_analisis_aguas.idPuntoMuestreo='".$_GET['idPuntoMuestreo']."'";}
	if (isset($_GET['idTipoMuestra']) && $_GET['idTipoMuestra']!=''){      	$SIS_where .=" AND aguas_analisis_aguas.idTipoMuestra='".$_GET['idTipoMuestra']."'";}
	if (isset($_GET['idParametros']) && $_GET['idParametros']!=''){	        $SIS_where .=" AND aguas_analisis_aguas.idParametros='".$_GET['idParametros']."'";}
	if (isset($_GET['idSigno']) && $_GET['idSigno']!=''){           	    $SIS_where .=" AND aguas_analisis_aguas.idSigno='".$_GET['idSigno']."'";}
	if (isset($_GET['idLaboratorio']) && $_GET['idLaboratorio']!=''){      	$SIS_where .=" AND aguas_analisis_aguas.idLaboratorio='".$_GET['idLaboratorio']."'";}
	if(isset($_GET['f_muestra_inicio'], $_GET['f_muestra_termino']) && $_GET['f_muestra_inicio'] != '' && $_GET['f_muestra_termino']!=''){
		$SIS_where .= " AND aguas_analisis_aguas.f_muestra BETWEEN '".$_GET['f_muestra_inicio']."' AND '".$_GET['f_muestra_termino']."'";
	}
	if(isset($_GET['f_recibida_inicio'], $_GET['f_recibida_termino']) && $_GET['f_recibida_inicio'] != '' && $_GET['f_recibida_termino']!=''){
		$SIS_where .= " AND aguas_analisis_aguas.f_recibida BETWEEN '".$_GET['f_recibida_inicio']."' AND '".$_GET['f_recibida_termino']."'";
	}
	$SIS_order = 'aguas_analisis_aguas.f_recibida ASC';
	$arrProductos = array();
	$arrProductos = db_select_array (false, $SIS_query, 'aguas_analisis_aguas', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrProductos');

	?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
		<a target="new" href="<?php echo 'informe_aguas_sis_PR14001_to_excel.php?bla=bla'.$n ; ?>" class="btn btn-sm btn-metis-2 pull-right margin_width"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar a Excel</a>
		<a target="new" href="<?php echo 'informe_aguas_sis_PR14001_to_xml.php?bla=bla'.$n ; ?>" class="btn btn-sm btn-warning pull-right margin_width"><i class="fa fa-file-code-o" aria-hidden="true"></i> Exportar a XML</a>
	</div>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
				<h5>Informe de analisis</h5>
			</header>
			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<thead>
						<tr role="row">
							<th>Identificador</th>
							<th>codigoProceso</th>
							<th>codigoArchivo</th>
							<th>rut</th>
							<th>periodo</th>
							<th>codigo_servicio</th>
							<th>codigo_sector</th>
							<th>codigo_muestra</th>
							<th>tipo_punto_muestreo</th>
							<th>UTM_norte</th>
							<th>UTM_este</th>
							<th>tipo_muestra</th>
							<th>periodo_remuestreo</th>
							<th>fecha_muestra</th>
							<th>codigo_parametro</th>
							<th>signo</th>
							<th>valor</th>
							<th>rutLaboratorio</th>
							<th>idLaboratorio</th>
						</tr>
					</thead>

					<tbody role="alert" aria-live="polite" aria-relevant="all">
						<?php foreach ($arrProductos as $productos) { ?>

							<tr class="odd">
								<td><?php echo $productos['Identificador']; ?></td>
								<td><?php echo $productos['codigoProceso']; ?></td>
								<td><?php echo $productos['codigoArchivo']; ?></td>
								<td><?php echo cortarRut($productos['rut']); ?></td>
								<td><?php echo fecha2Ano($productos['periodo']).fecha2NdiaMesCon0($productos['periodo']); ?></td>
								<td><?php echo $productos['codigo_servicio']; ?></td>
								<td><?php echo $productos['codigo_sector']; ?></td>
								<td><?php echo $productos['codigo_muestra']; ?></td>
								<td><?php echo $productos['tipo_punto_muestreo']; ?></td>
								<td><?php echo $productos['UTM_norte']; ?></td>
								<td><?php echo $productos['UTM_este']; ?></td>
								<td><?php echo $productos['tipo_muestra']; ?></td>
								<td><?php if($productos['periodo_remuestreo']!='0000-00-00'){echo fecha2Ano($productos['periodo_remuestreo']).fecha2NdiaMesCon0($productos['periodo_remuestreo']);} ?></td>
								<td><?php echo Fecha_estandar($productos['fecha_muestra']); ?></td>
								<td><?php echo $productos['codigo_parametro']; ?></td>
								<td><?php echo $productos['signo']; ?></td>
								<td><?php echo Cantidades_decimales_justos($productos['valor']); ?></td>
								<td><?php echo $productos['rutLaboratorio']; ?></td>
								<td><?php echo $productos['idLaboratorio']; ?></td>

							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
		<a href="<?php echo $location; ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else{
	//
	$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];

	?>

	<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Filtro de Busqueda</h5>
			</header>
			<div class="body">
				<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" autocomplete="off" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($f_muestra_inicio)){       $x1  = $f_muestra_inicio;     }else{$x1  = '';}
					if(isset($f_muestra_termino)){      $x2  = $f_muestra_termino;    }else{$x2  = '';}
					if(isset($f_recibida_inicio)){      $x3  = $f_recibida_inicio;    }else{$x3  = '';}
					if(isset($f_recibida_termino)){     $x4  = $f_recibida_termino;   }else{$x4  = '';}
					if(isset($idSector)){               $x5  = $idSector;             }else{$x5  = '';}
					if(isset($idPuntoMuestreo)){        $x6  = $idPuntoMuestreo;      }else{$x6  = '';}
					if(isset($idTipoMuestra)){          $x7  = $idTipoMuestra;        }else{$x7  = '';}
					if(isset($idParametros)){           $x8  = $idParametros;         }else{$x8  = '';}
					if(isset($idSigno)){                $x9  = $idSigno;              }else{$x9  = '';}
					if(isset($idLaboratorio)){          $x10 = $idLaboratorio;        }else{$x10 = '';}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_date('Fecha de la muestra Inicio','f_muestra_inicio', $x1, 1);
					$Form_Inputs->form_date('Fecha de la muestra Termino','f_muestra_termino', $x2, 1);
					$Form_Inputs->form_date('Fecha Recibida Inicio','f_recibida_inicio', $x3, 1);
					$Form_Inputs->form_date('Fecha Recibida Termino','f_recibida_termino', $x4, 1);
					$Form_Inputs->form_select_filter('Sector','idSector', $x5, 1, 'idSector', 'Nombre', 'aguas_analisis_sectores', $z, 0, $dbConn);
					$Form_Inputs->form_select_filter('Punto de Muestra','idPuntoMuestreo', $x6, 1, 'idPuntoMuestreo', 'Nombre', 'aguas_analisis_aguas_tipo_punto_muestreo', 0, 0, $dbConn);
					$Form_Inputs->form_select_filter('Tipo de Muestra','idTipoMuestra', $x7, 1, 'idTipoMuestra', 'Nombre', 'aguas_analisis_aguas_tipo_muestra', 0, 0, $dbConn);
					$Form_Inputs->form_select_filter('Parametro','idParametros', $x8, 1, 'idParametros', 'Nombre', 'aguas_analisis_parametros', $z, 0, $dbConn);
					$Form_Inputs->form_select_filter('Signo','idSigno', $x9, 1, 'idSigno', 'Nombre', 'aguas_analisis_aguas_signo', 0, 0, $dbConn);
					$Form_Inputs->form_select_filter('Laboratorio','idLaboratorio', $x10, 1, 'idLaboratorio', 'Nombre', 'aguas_analisis_laboratorios', $z, 0, $dbConn);

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
