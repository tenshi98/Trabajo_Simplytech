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
$original = "informe_cross_checking_06.php";
$location = $original;
//Se agregan ubicaciones
$search ='&submit_filter=Filtrar';
$location .= "?submit_filter=Filtrar";
if(isset($_GET['idSolicitud']) && $_GET['idSolicitud'] != ''){        $location .= "&idSolicitud=".$_GET['idSolicitud'];        $search .= "&idSolicitud=".$_GET['idSolicitud'];}
if(isset($_GET['idPredio']) && $_GET['idPredio'] != ''){              $location .= "&idPredio=".$_GET['idPredio'];              $search .= "&idPredio=".$_GET['idPredio'];}
if(isset($_GET['idZona']) && $_GET['idZona'] != ''){                  $location .= "&idZona=".$_GET['idZona'];                  $search .= "&idZona=".$_GET['idZona'];}
if(isset($_GET['idTemporada']) && $_GET['idTemporada'] != ''){        $location .= "&idTemporada=".$_GET['idTemporada'];        $search .= "&idTemporada=".$_GET['idTemporada'];}
if(isset($_GET['idEstadoFen']) && $_GET['idEstadoFen'] != ''){        $location .= "&idEstadoFen=".$_GET['idEstadoFen'];        $search .= "&idEstadoFen=".$_GET['idEstadoFen'];}
if(isset($_GET['idCategoria']) && $_GET['idCategoria'] != ''){        $location .= "&idCategoria=".$_GET['idCategoria'];        $search .= "&idCategoria=".$_GET['idCategoria'];}
if(isset($_GET['idProducto']) && $_GET['idProducto'] != ''){          $location .= "&idProducto=".$_GET['idProducto'];          $search .= "&idProducto=".$_GET['idProducto'];}
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){            $location .= "&idUsuario=".$_GET['idUsuario'];            $search .= "&idUsuario=".$_GET['idUsuario'];}
if(isset($_GET['idEstado']) && $_GET['idEstado'] != ''){              $location .= "&idEstado=".$_GET['idEstado'];              $search .= "&idEstado=".$_GET['idEstado'];}
if(isset($_GET['f_programacion_desde'])&&$_GET['f_programacion_desde']!=''&&isset($_GET['f_programacion_hasta'])&&$_GET['f_programacion_hasta']!=''){
	$location .="&f_programacion_desde={$_GET['f_programacion_desde']}";
	$location .="&f_programacion_hasta={$_GET['f_programacion_hasta']}";
	$search .="&f_programacion_desde={$_GET['f_programacion_desde']}";
	$search .="&f_programacion_hasta={$_GET['f_programacion_hasta']}";
}
if(isset($_GET['f_ejecucion_desde'])&&$_GET['f_ejecucion_desde']!=''&&isset($_GET['f_ejecucion_hasta'])&&$_GET['f_ejecucion_hasta']!=''){
	$location .="&f_ejecucion_desde={$_GET['f_ejecucion_desde']}";
	$location .="&f_ejecucion_hasta={$_GET['f_ejecucion_hasta']}";
	$search .="&f_ejecucion_desde={$_GET['f_ejecucion_desde']}";
	$search .="&f_ejecucion_hasta={$_GET['f_ejecucion_hasta']}";
}
if(isset($_GET['f_termino_desde'])&&$_GET['f_termino_desde']!=''&&isset($_GET['f_termino_hasta'])&&$_GET['f_termino_hasta']!=''){
	$location .="&f_termino_desde={$_GET['f_termino_desde']}";
	$location .="&f_termino_hasta={$_GET['f_termino_hasta']}";
	$search .="&f_termino_desde={$_GET['f_termino_desde']}";
	$search .="&f_termino_hasta={$_GET['f_termino_hasta']}";
}			     
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
if ( ! empty($_GET['submit_filter']) ) { 
/**********************************************************/
//Variable de busqueda
$z = "WHERE cross_solicitud_aplicacion_listado.idSolicitud!=0";
//Verifico el tipo de usuario que esta ingresando
$z.= " AND cross_solicitud_aplicacion_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idSolicitud']) && $_GET['idSolicitud'] != ''){        $z .= " AND cross_solicitud_aplicacion_listado.idSolicitud=".$_GET['idSolicitud'];}
if(isset($_GET['idPredio']) && $_GET['idPredio'] != ''){              $z .= " AND cross_solicitud_aplicacion_listado.idPredio=".$_GET['idPredio'];}
if(isset($_GET['idZona']) && $_GET['idZona'] != ''){                  $z .= " AND cross_solicitud_aplicacion_listado_cuarteles.idZona=".$_GET['idZona'];}
if(isset($_GET['idTemporada']) && $_GET['idTemporada'] != ''){        $z .= " AND cross_solicitud_aplicacion_listado.idTemporada=".$_GET['idTemporada'];}
if(isset($_GET['idEstadoFen']) && $_GET['idEstadoFen'] != ''){        $z .= " AND cross_solicitud_aplicacion_listado.idEstadoFen=".$_GET['idEstadoFen'];}
if(isset($_GET['idCategoria']) && $_GET['idCategoria'] != ''){        $z .= " AND cross_solicitud_aplicacion_listado.idCategoria=".$_GET['idCategoria'];}
if(isset($_GET['idProducto']) && $_GET['idProducto'] != ''){          $z .= " AND cross_solicitud_aplicacion_listado.idProducto=".$_GET['idProducto'];}
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){            $z .= " AND cross_solicitud_aplicacion_listado.idUsuario=".$_GET['idUsuario'];}
if(isset($_GET['idEstado']) && $_GET['idEstado'] != ''){              $z .= " AND cross_solicitud_aplicacion_listado.idEstado=".$_GET['idEstado'];}
if(isset($_GET['f_programacion_desde'])&&$_GET['f_programacion_desde']!=''&&isset($_GET['f_programacion_hasta'])&&$_GET['f_programacion_hasta']!=''){
	$z.=" AND cross_solicitud_aplicacion_listado.f_programacion BETWEEN '{$_GET['f_programacion_desde']}' AND '{$_GET['f_programacion_hasta']}'";
}
if(isset($_GET['f_ejecucion_desde'])&&$_GET['f_ejecucion_desde']!=''&&isset($_GET['f_ejecucion_hasta'])&&$_GET['f_ejecucion_hasta']!=''){
	$z.=" AND cross_solicitud_aplicacion_listado.f_ejecucion BETWEEN '{$_GET['f_ejecucion_desde']}' AND '{$_GET['f_ejecucion_hasta']}'";
}
if(isset($_GET['f_termino_desde'])&&$_GET['f_termino_desde']!=''&&isset($_GET['f_termino_hasta'])&&$_GET['f_termino_hasta']!=''){
	$z.=" AND cross_solicitud_aplicacion_listado.f_termino BETWEEN '{$_GET['f_termino_desde']}' AND '{$_GET['f_termino_hasta']}'";
}
// Se trae un listado con todos los usuarios
$arrOTS = array();
$query = "SELECT 
sistema_variedades_categorias.Nombre AS EspecieNombre,
variedades_listado.Nombre AS VariedadNombre,
cross_solicitud_aplicacion_listado.idSolicitud,
cross_predios_listado.Nombre AS PredioNombre,
cross_predios_listado_zonas.Nombre AS CuartelNombre,
cross_predios_listado_zonas.Hectareas AS CuartelHectareas,
cross_solicitud_aplicacion_listado.f_termino,
cross_solicitud_aplicacion_listado.f_termino_fin,
cross_predios_listado_zonas.Plantas AS CuartelPlantas,
cross_checking_estado_fenologico.Nombre AS EstadoFenologico,
core_estado_solicitud.Nombre AS EstadoSolicitud,
core_estado_ejecucion.Nombre AS EstadoEjecucion,

cross_predios_listado_zonas.DistanciaPlant AS CuartelDistanciaPlant,
cross_solicitud_aplicacion_listado_cuarteles.idCuarteles AS ID_1,
cross_solicitud_aplicacion_listado_cuarteles.VelTractor,
(SELECT SUM(GeoDistance)                                          FROM `cross_solicitud_aplicacion_listado_tractores` WHERE idCuarteles=ID_1 LIMIT 1 ) AS GeoDistance,
(SELECT AVG(NULLIF(IF(GeoVelocidadProm!=0,GeoVelocidadProm,0),0)) FROM `cross_solicitud_aplicacion_listado_tractores` WHERE idCuarteles=ID_1 LIMIT 1 ) AS VelPromedio,
(SELECT AVG(NULLIF(IF(Sensor_1_Prom!=0,Sensor_1_Prom,0),0))       FROM `cross_solicitud_aplicacion_listado_tractores` WHERE idCuarteles=ID_1 LIMIT 1 ) AS CaudalDerecho,
(SELECT AVG(NULLIF(IF(Sensor_2_Prom!=0,Sensor_2_Prom,0),0))       FROM `cross_solicitud_aplicacion_listado_tractores` WHERE idCuarteles=ID_1 LIMIT 1 ) AS CaudalIzquierdo,
(SELECT SUM(Diferencia)                                           FROM `cross_solicitud_aplicacion_listado_tractores` WHERE idCuarteles=ID_1 LIMIT 1 ) AS LitrosAplicados,
(SELECT AVG(NULLIF(IF(Sensor_4_Prom!=0,Sensor_4_Prom,0),0))       FROM `cross_solicitud_aplicacion_listado_tractores` WHERE idCuarteles=ID_1 LIMIT 1 ) AS PH

FROM `cross_solicitud_aplicacion_listado`

LEFT JOIN `cross_predios_listado`                          ON cross_predios_listado.idPredio                             = cross_solicitud_aplicacion_listado.idPredio
LEFT JOIN `usuarios_listado`                               ON usuarios_listado.idUsuario                                 = cross_solicitud_aplicacion_listado.idUsuario
LEFT JOIN `core_estado_solicitud`                          ON core_estado_solicitud.idEstado                             = cross_solicitud_aplicacion_listado.idEstado
LEFT JOIN `cross_checking_estado_fenologico`               ON cross_checking_estado_fenologico.idEstadoFen               = cross_solicitud_aplicacion_listado.idEstadoFen
LEFT JOIN `sistema_variedades_categorias`                  ON sistema_variedades_categorias.idCategoria                  = cross_solicitud_aplicacion_listado.idCategoria
LEFT JOIN `variedades_listado`                             ON variedades_listado.idProducto                              = cross_solicitud_aplicacion_listado.idProducto
LEFT JOIN `trabajadores_listado`     dosificador           ON dosificador.idTrabajador                                   = cross_solicitud_aplicacion_listado.idDosificador
LEFT JOIN `cross_solicitud_aplicacion_listado_cuarteles`   ON cross_solicitud_aplicacion_listado_cuarteles.idSolicitud   = cross_solicitud_aplicacion_listado.idSolicitud
LEFT JOIN `cross_predios_listado_zonas`                    ON cross_predios_listado_zonas.idZona                         = cross_solicitud_aplicacion_listado_cuarteles.idZona
LEFT JOIN `core_estado_ejecucion`                          ON core_estado_ejecucion.idEjecucion                          = cross_solicitud_aplicacion_listado_cuarteles.idEjecucion

".$z;
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
array_push( $arrOTS,$row );
}
?>

<div class="col-sm-12">
	<a target="new" href="<?php echo 'informe_cross_checking_06_to_excel.php?bla=bla'.$search.'&idTipoUsuario='.$_SESSION['usuario']['basic_data']['idTipoUsuario'].'&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'] ; ?>" class="btn btn-sm btn-metis-2 fright margin_width"><i class="fa fa-file-excel-o"></i> Exportar a Excel</a>
</div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Datos</h5>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#datos" data-toggle="tab">Datos</a></li>
	
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="datos">
				<div class="wmd-panel">
					<div class="table-responsive">
					
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th>Predio</th>
									<th>Especie</th>
									<th>Variedad</th>
									<th># Solicitud</th>
									<th>Cuartel</th>
									<th>Hectáreas</th>
									<th>Plantas cuartel</th>
									<th>Estado Fenologico</th>
									<th>Estado Solicitud</th>
									<th>Estado Ejecucion</th>
									<th>Fecha Programacion Inicio</th>
									<th>Fin Aplicación</th>
									<th>Plantas aplicadas</th>
									<th>Veloc. Recomendada</th>
									<th>Veloc. Promedio</th>
									<th>Caudal Izquierdo</th>
									<th>Caudal derecho</th>
									<th>lts. Aplicados</th>
									<th>Lts. Hectarias</th>
									<th>PH</th>	
								</tr>
							</thead>
											  
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php
									foreach ($arrOTS as $temp) {
										//se verifica plantas faltantes
										if(isset($temp['GeoDistance'])&&$temp['GeoDistance']!=0){
											$aplicadas = (($temp['GeoDistance']*1000)/$temp['CuartelDistanciaPlant']);
											if($aplicadas<0){
												$aplicadas = 0;
											}
										}else{
											$aplicadas = 0;
										}
										//calculo de los litros por hectarea
										if(isset($temp['CuartelHectareas'])&&$temp['CuartelHectareas']!=''&&$temp['CuartelHectareas']!=0){
											$litrosxhectarea = $temp['LitrosAplicados'] / $temp['CuartelHectareas'];
										}else{
											$litrosxhectarea = 0;
										}
										
									?>	
									<tr class="odd">
										<td><?php echo $temp['PredioNombre']; ?></td>
										<td><?php echo $temp['EspecieNombre']; ?></td>
										<td><?php echo $temp['VariedadNombre']; ?></td>
										<td><?php echo $temp['idSolicitud']; ?></td>
										<td><?php echo $temp['CuartelNombre']; ?></td>
										<td><?php echo $temp['CuartelHectareas']; ?></td>
										<td><?php echo $temp['CuartelPlantas']; ?></td>
										<td><?php echo $temp['EstadoFenologico']; ?></td>
										<td><?php echo $temp['EstadoSolicitud']; ?></td>
										<td><?php echo $temp['EstadoEjecucion']; ?></td>
										<td><?php echo $temp['f_termino']; ?></td>
										<td><?php echo $temp['f_termino_fin']; ?></td>
										<td><?php echo $aplicadas; ?></td>
										<td><?php echo $temp['VelTractor']; ?></td>
										<td><?php echo $temp['VelPromedio']; ?></td>
										<td><?php echo $temp['CaudalDerecho']; ?></td>
										<td><?php echo $temp['CaudalIzquierdo']; ?></td>
										<td><?php echo $temp['LitrosAplicados']; ?></td>
										<td><?php echo $litrosxhectarea; ?></td>
										<td><?php echo $temp['PH']; ?></td>
									</tr> 	
								<?php } ?>                
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
		
			<div class="tab-pane fade" id="tabla">
				<div class="wmd-panel">
					<div class="table-responsive" style="height: 800px;">
						<?php echo widget_excel('wdr-component', $tabla, ''); ?>
					</div>
				</div>
			</div>

        </div>	
	</div>
</div>




<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $original; ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
$usrfil = 'usuarios_sistemas.idSistema='.$_SESSION['usuario']['basic_data']['idSistema'].' AND usuarios_listado.idEstado=1 AND usuarios_listado.idTipoUsuario!=1';	
$y = "idEstado=1";
$x = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";	
 
 ?>
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($idSolicitud)) {            $x1  = $idSolicitud;            }else{$x1  = '';}
				if(isset($idPredio)) {               $x2  = $idPredio;               }else{$x2  = '';}
				if(isset($idZona)) {                 $x3  = $idZona;                 }else{$x3  = '';}
				if(isset($idTemporada)) {            $x4  = $idTemporada;            }else{$x4  = '';}
				if(isset($idEstadoFen)) {            $x5  = $idEstadoFen;            }else{$x5  = '';}
				if(isset($idCategoria)) {            $x6  = $idCategoria;            }else{$x6  = '';}
				if(isset($idProducto)) {             $x7  = $idProducto;             }else{$x7  = '';}
				if(isset($f_programacion_desde)) {   $x8  = $f_programacion_desde;   }else{$x8  = '';}
				if(isset($f_programacion_hasta)) {   $x9  = $f_programacion_hasta;   }else{$x9  = '';}
				if(isset($f_ejecucion_desde)) {      $x10 = $f_ejecucion_desde;      }else{$x10 = '';}
				if(isset($f_ejecucion_hasta)) {      $x11 = $f_ejecucion_hasta;      }else{$x11 = '';}
				if(isset($f_termino_desde)) {        $x12 = $f_termino_desde;        }else{$x12 = '';}
				if(isset($f_termino_hasta)) {        $x13 = $f_termino_hasta;        }else{$x13 = '';}
				if(isset($idUsuario)) {              $x14 = $idUsuario;              }else{$x14 = '';}
				if(isset($idEstado)) {               $x15 = $idEstado;               }else{$x15 = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_number('N° Solicitud','idSolicitud', $x1, 1);
				$Form_Imputs->form_select_depend1('Predio','idPredio', $x2, 1, 'idPredio', 'Nombre', 'cross_predios_listado', $x, 0,
										 'Cuarteles','idZona', $x3, 1, 'idZona', 'Nombre', 'cross_predios_listado_zonas', 'idEstado=1', 0, 
										 $dbConn, 'form1');
				$Form_Imputs->form_select_filter('Temporada','idTemporada', $x4, 1, 'idTemporada', 'Codigo,Nombre', 'cross_checking_temporada', $y, '', $dbConn);
				$Form_Imputs->form_select_filter('Estado Fenológico','idEstadoFen', $x5, 1, 'idEstadoFen', 'Codigo,Nombre', 'cross_checking_estado_fenologico', $y, '', $dbConn);
				$Form_Imputs->form_select_depend1('Especie','idCategoria', $x6, 1, 'idCategoria', 'Nombre', 'sistema_variedades_categorias', 0, 0,
										 'Variedad','idProducto', $x7, 1, 'idProducto', 'Nombre', 'variedades_listado', 'idEstado=1', 0, 
										 $dbConn, 'form1');
				$Form_Imputs->form_date('Fecha Programada Desde','f_programacion_desde', $x8, 1);
				$Form_Imputs->form_date('Fecha Programada Hasta','f_programacion_hasta', $x9, 1);
				$Form_Imputs->form_date('Fecha Ejecutada Desde','f_ejecucion_desde', $x10, 1);
				$Form_Imputs->form_date('Fecha Ejecutada Hasta','f_ejecucion_hasta', $x11, 1);
				$Form_Imputs->form_date('Fecha Terminada Desde','f_termino_desde', $x12, 1);
				$Form_Imputs->form_date('Fecha Terminada Hasta','f_termino_hasta', $x13, 1);
				$Form_Imputs->form_select_join_filter('Usuario Creador','idUsuario', $x14, 1, 'idUsuario', 'Nombre', 'usuarios_listado', 'usuarios_sistemas', $usrfil, $dbConn);
				$Form_Imputs->form_select('Estado','idEstado', $x15, 1, 'idEstado', 'Nombre', 'core_estado_solicitud', 0, '', $dbConn);
						
				?> 

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="submit_filter"> 
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
