<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Web.php';
/** Include PHPExcel */
require_once '../LIBS_php/PHPExcel/PHPExcel/IOFactory.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "aguas_facturacion_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Ano']) && $_GET['Ano'] != ''){               $location .= "&Ano=".$_GET['Ano'];               $search .= "&Ano=".$_GET['Ano'];}
if(isset($_GET['idMes']) && $_GET['idMes'] != ''){           $location .= "&idMes=".$_GET['idMes'];           $search .= "&idMes=".$_GET['idMes'];}
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){   $location .= "&idUsuario=".$_GET['idUsuario'];   $search .= "&idUsuario=".$_GET['idUsuario'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_Facturacion';
	require_once 'A1XRXS_sys/xrxs_form/aguas_facturacion_listado.php';
}
//formulario para editar
if ( !empty($_GET['clear_all']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'clear_all';
	require_once 'A1XRXS_sys/xrxs_form/aguas_facturacion_listado.php';
}
/********************************************/
if ( !empty($_GET['ing_doc']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'ing_Facturacion';
	require_once 'A1XRXS_sys/xrxs_form/aguas_facturacion_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/aguas_facturacion_listado.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Medicion Creada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Medicion Modificada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Medicion borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['view_facturacion']) ) { 
//Obtengo los datos principales
$query = "SELECT 
aguas_facturacion_listado.Fecha,
aguas_facturacion_listado.Observaciones,
aguas_facturacion_listado.fCreacion,
aguas_facturacion_listado.intAnual,
aguas_facturacion_listado.Ano,
aguas_facturacion_listado.idMes,
core_sistemas.Nombre AS RazonSocial,
usuarios_listado.Nombre AS Usuario,
core_sistemas_opciones.Nombre AS OpcionesInteres

FROM `aguas_facturacion_listado`
LEFT JOIN `core_sistemas`            ON core_sistemas.idSistema             = aguas_facturacion_listado.idSistema
LEFT JOIN `usuarios_listado`         ON usuarios_listado.idUsuario          = aguas_facturacion_listado.idUsuario
LEFT JOIN `core_sistemas_opciones`   ON core_sistemas_opciones.idOpciones   = aguas_facturacion_listado.idOpcionesInteres
WHERE aguas_facturacion_listado.idFacturacion = ".$_GET['view_facturacion'];
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

				
//Obtengo los datos de los clientes
$arrFacturacion = array();
$query = "SELECT 
aguas_facturacion_listado_detalle.idCliente, 
aguas_facturacion_listado_detalle.idFacturacionDetalle,
aguas_facturacion_listado_detalle.ClienteIdentificador,
aguas_facturacion_listado_detalle.ClienteNombre,
aguas_facturacion_listado_detalle_estado.Nombre AS Estado,
aguas_clientes_facturable.Nombre AS DocFacturable,
aguas_facturacion_listado_detalle.ClienteEstado

FROM `aguas_facturacion_listado_detalle`
LEFT JOIN `aguas_facturacion_listado_detalle_estado`  ON aguas_facturacion_listado_detalle_estado.idEstado   = aguas_facturacion_listado_detalle.idEstado
LEFT JOIN `aguas_clientes_facturable`                 ON aguas_clientes_facturable.idFacturable              = aguas_facturacion_listado_detalle.SII_idFacturable

WHERE aguas_facturacion_listado_detalle.idFacturacion = ".$_GET['view_facturacion']."
ORDER BY aguas_facturacion_listado_detalle.ClienteIdentificador ASC";
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
array_push( $arrFacturacion,$row );
}	
	
						
?>
	
<div class="col-sm-12">

	<div id="page-wrap">
		<div id="header"> Ver Facturacion de Clientes  </div>
		<div id="customer">
			<table id="meta" class="fleft otdata">
				<tbody>
					<tr>
						<td class="meta-head"><strong>DATOS BASICOS</strong></td>
						<td class="meta-head"></td>
					</tr>
					<tr>
						<td class="meta-head">Creador</td>
						<td><?php echo $rowdata['Usuario']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Interes Anual</td>
						<td><?php echo cantidades($rowdata['intAnual'], 2).'%'; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Calculo de intereses</td>
						<td><?php echo $rowdata['OpcionesInteres']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Sistema</td>
						<td><?php echo $rowdata['RazonSocial']; ?></td>
					</tr>
				</tbody>
			</table>
			<table id="meta" class="otdata2">
				<tbody>
					<tr>
						<td class="meta-head">Fecha Facturacion</td>
						<td><?php echo Fecha_estandar($rowdata['Fecha']);?></td>
					</tr>
					<tr>
						<td class="meta-head">Fecha Creacion</td>
						<td><?php echo Fecha_estandar($rowdata['fCreacion']);?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<table id="items">
			<tbody>
				<tr>
					<th colspan="6">Detalle</th>
				</tr>		  
				
			
				<tr class="item-row linea_punteada" bgcolor="#F0F0F0">
					<td><strong>Identificador</strong></td>
					<td><strong>Cliente</strong></td>
					<td><strong>Estado</strong></td>
					<td><strong>Estado Pago</strong></td>
					<td><strong>Documento</strong></td>
					<td><strong>Acciones</strong></td>
				</tr>	
				<?php foreach ($arrFacturacion as $clientes){ ?>
					<tr class="item-row linea_punteada">
						<td><?php echo $clientes['ClienteIdentificador']; ?></td>
						<td><?php echo $clientes['ClienteNombre']; ?></td>
						<td><?php echo $clientes['Estado']; ?></td>
						<td><?php echo $clientes['ClienteEstado']; ?></td>
						<td><?php echo $clientes['DocFacturable']; ?></td>
	
						<td>
							<div class="btn-group" style="width: 175px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_aguas_cliente.php?view='.simpleEncode($clientes['idCliente'], fecha_actual()); ?>" title="Ver Cliente" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-id-card" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_aguas_facturacion.php?view='.simpleEncode($clientes['idFacturacionDetalle'], fecha_actual()); ?>" title="Ver Facturacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
								<?php
								//verifico si hay alhun archivo asociado
								$ruta = 'boleta_'.$rowdata['Ano'].'_'.$rowdata['idMes'].'_'.$clientes['ClienteIdentificador'];
								if (file_exists('upload/'.$ruta)){ ?>
									<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_doc_preview.php?path='.simpleEncode('upload', fecha_actual()).'&file='.simpleEncode($ruta, fecha_actual()); ?>" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=1){?><a href="1download.php?dir=<?php echo simpleEncode('upload', fecha_actual()).'&file='.simpleEncode($ruta, fecha_actual()); ?>" title="Descargar Archivo" class="btn btn-primary btn-sm tooltip" ><i class="fa fa-download" aria-hidden="true"></i></a><?php } ?>
								<?php } 
								if(isset($clientes['ClienteEstado'])&&$clientes['ClienteEstado']=='Corte en Tramite'){ ?>
									<?php if ($rowlevel['level']>=1){?><a target="_blank" rel="noopener noreferrer" href="<?php echo 'view_aguas_facturacion_carta.php?view='.simpleEncode($clientes['idFacturacionDetalle'], fecha_actual()).'&idCliente='.$clientes['idCliente']; ?>" title="Descargar Carta" class="btn btn-primary btn-sm tooltip"><i class="fa fa-cloud-download" aria-hidden="true"></i></a><?php } ?>
								<?php } ?>
							</div>
						</td>
					</tr> 
				<?php } ?>
				<tr id="hiderow"><td colspan="6"></td></tr>
			

				<tr>
					<td colspan="6" class="blank"> 
						<p>
							<?php echo $rowdata['Observaciones']; ?>
						</p>
					</td>
				</tr>
				<tr>
					<td colspan="6" class="blank"><p>Observaciones</p></td> 
				</tr>
			</tbody>
		</table>
    	<div class="clearfix"></div>
    </div>
</div>
	
	


<?php widget_modal(80, 95); ?>

<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px; margin-top:30px">
<a href="<?php echo $location; ?>"  class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>	
	
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['view']) ) { ?>
	
<div class="col-sm-12" style="margin-bottom:30px">

	<?php 		
	$ubicacion = $location.'&view=true&ing_doc=true';
	$dialogo   = '¿Realmente desea ingresar el documento, una vez realizada no podra realizar cambios?';?>
	<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-primary fright margin_width" ><i class="fa fa-check-square-o" aria-hidden="true"></i> Ingresar Documento</a>			

	<a href="<?php echo $location; ?>"  class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>

	<?php 
	$ubicacion = $location.'&clear_all=true';
	$dialogo   = '¿Realmente deseas eliminar todos los registros?';?>
	<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger fright margin_width dialogBox"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar Todo</a>

	<div class="clearfix"></div>
</div> 
	
<div class="col-sm-12">

	<div id="page-wrap">
		<div id="header"> Facturacion de Clientes  </div>
		<div id="customer">
			<table id="meta" class="fleft otdata">
				<tbody>
					<tr>
						<td class="meta-head"><strong>DATOS BASICOS</strong></td>
						<td class="meta-head"></td>
					</tr>
					<tr>
						<td class="meta-head">Creador</td>
						<td><?php echo $_SESSION['Facturacion_basicos']['Usuario']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Interes Anual</td>
						<td><?php echo $_SESSION['Facturacion_basicos']['intAnual']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Calculo de intereses</td>
						<td><?php if(isset($_SESSION['Facturacion_basicos']['idOpcionesInteres'])&&$_SESSION['Facturacion_basicos']['idOpcionesInteres']==1){echo 'Si';}else{echo 'No';} ?></td>
					</tr>
					<tr>
						<td class="meta-head">Sistema</td>
						<td><?php echo $_SESSION['usuario']['basic_data']['RazonSocial']; ?></td>
					</tr>
				</tbody>
			</table>
			<table id="meta" class="otdata2">
				<tbody>
					<tr>
						<td class="meta-head">Fecha Facturacion</td>
						<td><?php echo Fecha_estandar($_SESSION['Facturacion_basicos']['Fecha']);?></td>
					</tr>
					<tr>
						<td class="meta-head">Fecha Creacion</td>
						<td><?php echo Fecha_estandar($_SESSION['Facturacion_basicos']['fCreacion']);?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<table id="items">
			<tbody>
				<tr>
					<th colspan="6">Detalle</th>
				</tr>		  
				
				<?php if(isset($_SESSION['Facturacion_clientes'])) { ?>
					<tr class="item-row linea_punteada" bgcolor="#F0F0F0">
						<td><strong>Identificador</strong></td>
						<td><strong>Cliente</strong></td>
						<td><strong>Estado</strong></td>
						<td><strong>Direccion</strong></td>
						<td><strong>Ultimo Pago</strong></td>
						<td><strong>Acciones</strong></td>
					</tr>	
					<?php foreach ($_SESSION['Facturacion_clientes'] as $key => $clientes){ ?>
						<tr class="item-row linea_punteada">
							<td><?php echo $clientes['ClienteIdentificador']; ?></td>
							<td><?php echo $clientes['ClienteNombre']; ?></td>
							<td><?php echo $clientes['ClienteEstado']; ?></td>
							<td><?php echo $clientes['ClienteDireccion']; ?></td>
							<td><?php echo Fecha_estandar($clientes['AguasInfUltimoPagoFecha']); ?></td>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<a href="<?php echo 'view_aguas_facturacion_ing.php?view='.simpleEncode($clientes['idCliente'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
								</div>
							</td>
						</tr> 
					<?php } ?>
					<tr id="hiderow"><td colspan="6"></td></tr>
				<?php } ?>

				<tr>
					<td colspan="6" class="blank"> 
						<p>
							<?php 
							if(isset($_SESSION['Facturacion_basicos']['Observaciones'])&&$_SESSION['Facturacion_basicos']['Observaciones']!=''){
								echo $_SESSION['Facturacion_basicos']['Observaciones'];
							}else{
								echo 'Sin Observaciones';
							}?>
						</p>
					</td>
				</tr>
				<tr>
					<td colspan="6" class="blank"><p>Observaciones</p></td> 
				</tr>
			</tbody>
		</table>
    	<div class="clearfix"></div>
    </div>
</div>
	
	


<?php widget_modal(80, 95); ?>

<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px; margin-top:30px">
<a href="<?php echo $location; ?>"  class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
	
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) {
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn); 
$sub_fecha = '10/'.fecha2NMes(fecha_actual()).'/'.fecha2Ano(fecha_actual());
//cuadro para descargar	 
$Alert_Text  = 'Tasa de Interés Corriente y Máxima Convencional vigentes al '.$sub_fecha;
$Alert_Text .= '<a target="_blank" rel="noopener noreferrer" href="http://www.sbif.cl/sbifweb/servlet/InfoFinanciera?indice=4.2.1&FECHA='.$sub_fecha.'" title="Ver Tasas" class="btn btn-primary btn-sm pull-right" ><i class="fa fa-list" aria-hidden="true"></i> Ver Tasas</a>';
alert_post_data(2,1,2, $Alert_Text);		 
?>

		
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Facturacion</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate >
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Fecha)) {               $x1  = $Fecha;               }else{$x1  = '';}
				if(isset($intAnual)) {            $x2  = $intAnual;            }else{$x2  = '';}
				if(isset($idOpcionesInteres)) {   $x3  = $idOpcionesInteres;   }else{$x3  = '';}
				if(isset($Observaciones)) {       $x4  = $Observaciones;       }else{$x4  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha de Facturacion','Fecha', $x1, 2);
				$Form_Inputs->form_input_number('Interes Anual', 'intAnual', $x2, 2);
				$Form_Inputs->form_select('Calculo de Intereses','idOpcionesInteres', $x3, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);
				$Form_Inputs->form_textarea('Observaciones', 'Observaciones', $x4, 1, 160);
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Inputs->form_input_hidden('fCreacion', fecha_actual(), 2);
				
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
		case 'ingreso_asc':          $order_by = 'ORDER BY aguas_facturacion_listado.idFacturacion ASC ';          $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Ingreso Ascendente'; break;
		case 'ingreso_desc':         $order_by = 'ORDER BY aguas_facturacion_listado.idFacturacion DESC ';         $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Ingreso Descendente';break;
		case 'fechacreacion_asc':    $order_by = 'ORDER BY aguas_facturacion_listado.fCreacion ASC ';        $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Creacion Ascendente'; break;
		case 'fechacreacion_desc':   $order_by = 'ORDER BY aguas_facturacion_listado.fCreacion DESC ';       $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Creacion Descendente';break;
		case 'fechaingreso_asc':     $order_by = 'ORDER BY aguas_facturacion_listado.Fecha ASC ';            $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ingreso Ascendente'; break;
		case 'fechaingreso_desc':    $order_by = 'ORDER BY aguas_facturacion_listado.Fecha DESC ';           $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Ingreso Descendente';break;
		case 'creador_asc':          $order_by = 'ORDER BY usuarios_listado.Nombre ASC ';                 $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Creador Ascendente'; break;
		case 'creador_desc':         $order_by = 'ORDER BY usuarios_listado.Nombre DESC ';                $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Creador Descendente';break;
		
		default: $order_by = 'ORDER BY aguas_facturacion_listado.idFacturacion DESC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Ingreso Descendente';
	}
}else{
	$order_by = 'ORDER BY aguas_facturacion_listado.idFacturacion DESC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Ingreso Descendente';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE aguas_facturacion_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Ano']) && $_GET['Ano'] != ''){              $z .= " AND aguas_facturacion_listado.Ano='".$_GET['Ano']."'";}
if(isset($_GET['idMes']) && $_GET['idMes'] != ''){          $z .= " AND aguas_facturacion_listado.idMes='".$_GET['idMes']."'";}
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){  $z .= " AND aguas_facturacion_listado.idUsuario='".$_GET['idUsuario']."'";}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idFacturacion FROM `aguas_facturacion_listado` ".$z;
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
// Se trae un listado con todos los usuarios
$arrTipo = array();
$query = "SELECT 
aguas_facturacion_listado.idFacturacion,
aguas_facturacion_listado.fCreacion,
aguas_facturacion_listado.Fecha,
usuarios_listado.Nombre AS NombreUsuario,
core_sistemas.Nombre AS sistema

FROM `aguas_facturacion_listado`
LEFT JOIN `core_sistemas`     ON core_sistemas.idSistema      = aguas_facturacion_listado.idSistema
LEFT JOIN `usuarios_listado`  ON usuarios_listado.idUsuario   = aguas_facturacion_listado.idUsuario
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
array_push( $arrTipo,$row );
}
//Verifico el tipo de usuario que esta ingresando
$usrfil = 'usuarios_listado.idEstado=1 AND usuarios_listado.idTipoUsuario!=1';	
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$usrfil .= " AND usuarios_sistemas.idSistema = ".$_SESSION['usuario']['basic_data']['idSistema'];
}?>

<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Facturacion</a><?php } ?>
	
</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				//Se verifican si existen los datos
				if(isset($Ano)) {       $x1  = $Ano;       }else{$x1  = '';}
				if(isset($idMes)) {     $x2  = $idMes;     }else{$x2  = '';}
				if(isset($idUsuario)) { $x3  = $idUsuario; }else{$x3  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_n_auto('Año','Ano', $x1, 1, 2016, ano_actual());
				$Form_Inputs->form_select_filter('Mes','idMes', $x2, 1, 'idMes', 'Nombre', 'core_tiempo_meses', 0, 'ORDER BY idMes ASC', $dbConn);
				$Form_Inputs->form_select_join_filter('Usuario','idUsuario', $x3, 1, 'idUsuario', 'Nombre', 'usuarios_listado', 'usuarios_sistemas', $usrfil, $dbConn);
				
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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Facturaciones</h5>
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
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>		  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrTipo as $tipo) { ?>
					<tr class="odd">
						<td><?php echo n_doc($tipo['idFacturacion'], 7); ?></td>
						<td><?php echo fecha_estandar($tipo['fCreacion']); ?></td>
						<td><?php echo fecha_estandar($tipo['Fecha']); ?></td>
						<td><?php echo $tipo['NombreUsuario']; ?></td>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $tipo['sistema']; ?></td><?php } ?>			
						<td>
							<div class="btn-group" style="width: 70px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo $location.'&view_facturacion='.$tipo['idFacturacion']; ?>" title="Ver Informacion" class="btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.simpleEncode($tipo['idFacturacion'], fecha_actual());
									$dialogo   = '¿Realmente deseas eliminar la facturacion '.n_doc($tipo['idFacturacion'], 7).'?';?>
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
<?php widget_modal(80, 95); ?>
<?php } ?>           
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
