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
$original = "clientes_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idTipo']) && $_GET['idTipo'] != ''){            $location .= "&idTipo=".$_GET['idTipo'];              $search .= "&idTipo=".$_GET['idTipo'];}
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){            $location .= "&Nombre=".$_GET['Nombre'];              $search .= "&Nombre=".$_GET['Nombre'];}
if(isset($_GET['Rut']) && $_GET['Rut'] != ''){                  $location .= "&Rut=".$_GET['Rut'];                    $search .= "&Rut=".$_GET['Rut'];}
if(isset($_GET['fNacimiento']) && $_GET['fNacimiento'] != ''){  $location .= "&fNacimiento=".$_GET['fNacimiento'];    $search .= "&fNacimiento=".$_GET['fNacimiento'];}
if(isset($_GET['idCiudad']) && $_GET['idCiudad'] != ''){        $location .= "&idCiudad=".$_GET['idCiudad'];          $search .= "&idCiudad=".$_GET['idCiudad'];}
if(isset($_GET['idComuna']) && $_GET['idComuna'] != ''){        $location .= "&idComuna=".$_GET['idComuna'];          $search .= "&idComuna=".$_GET['idComuna'];}
if(isset($_GET['Direccion']) && $_GET['Direccion'] != ''){      $location .= "&Direccion=".$_GET['Direccion'];        $search .= "&Direccion=".$_GET['Direccion'];}
if(isset($_GET['Giro']) && $_GET['Giro'] != ''){                $location .= "&Giro=".$_GET['Giro'];                  $search .= "&Giro=".$_GET['Giro'];}
if(isset($_GET['idTab_1']) && $_GET['idTab_1'] != ''){          $location .= "&idTab_1=".$_GET['idTab_1'];            $search .= "&idTab_1=".$_GET['idTab_1'];}
if(isset($_GET['idTab_2']) && $_GET['idTab_2'] != ''){          $location .= "&idTab_2=".$_GET['idTab_2'];            $search .= "&idTab_2=".$_GET['idTab_2'];}
if(isset($_GET['idTab_3']) && $_GET['idTab_3'] != ''){          $location .= "&idTab_3=".$_GET['idTab_3'];            $search .= "&idTab_3=".$_GET['idTab_3'];}
if(isset($_GET['idTab_4']) && $_GET['idTab_4'] != ''){          $location .= "&idTab_4=".$_GET['idTab_4'];            $search .= "&idTab_4=".$_GET['idTab_4'];}
if(isset($_GET['idTab_5']) && $_GET['idTab_5'] != ''){          $location .= "&idTab_5=".$_GET['idTab_5'];            $search .= "&idTab_5=".$_GET['idTab_5'];}
if(isset($_GET['idTab_6']) && $_GET['idTab_6'] != ''){          $location .= "&idTab_6=".$_GET['idTab_6'];            $search .= "&idTab_6=".$_GET['idTab_6'];}
if(isset($_GET['idTab_7']) && $_GET['idTab_7'] != ''){          $location .= "&idTab_7=".$_GET['idTab_7'];            $search .= "&idTab_7=".$_GET['idTab_7'];}
if(isset($_GET['idTab_8']) && $_GET['idTab_8'] != ''){          $location .= "&idTab_8=".$_GET['idTab_8'];            $search .= "&idTab_8=".$_GET['idTab_8'];}
if(isset($_GET['idTab_9']) && $_GET['idTab_9'] != ''){          $location .= "&idTab_9=".$_GET['idTab_9'];            $search .= "&idTab_9=".$_GET['idTab_9'];}
if(isset($_GET['idTab_10']) && $_GET['idTab_10'] != ''){        $location .= "&idTab_10=".$_GET['idTab_10'];          $search .= "&idTab_10=".$_GET['idTab_10'];}
if(isset($_GET['idTab_11']) && $_GET['idTab_11'] != ''){        $location .= "&idTab_11=".$_GET['idTab_11'];          $search .= "&idTab_11=".$_GET['idTab_11'];}
if(isset($_GET['idTab_12']) && $_GET['idTab_12'] != ''){        $location .= "&idTab_12=".$_GET['idTab_12'];          $search .= "&idTab_12=".$_GET['idTab_12'];}
if(isset($_GET['idTab_13']) && $_GET['idTab_13'] != ''){        $location .= "&idTab_13=".$_GET['idTab_13'];          $search .= "&idTab_13=".$_GET['idTab_13'];}
if(isset($_GET['idTab_14']) && $_GET['idTab_14'] != ''){        $location .= "&idTab_14=".$_GET['idTab_14'];          $search .= "&idTab_14=".$_GET['idTab_14'];}
if(isset($_GET['idTab_15']) && $_GET['idTab_15'] != ''){        $location .= "&idTab_15=".$_GET['idTab_15'];          $search .= "&idTab_15=".$_GET['idTab_15'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/clientes_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/clientes_listado.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Cliente creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Cliente editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Cliente borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);
// consulto los datos
$query = "SELECT  
clientes_listado.email, 
clientes_listado.Nombre, 
clientes_listado.Rut, 
clientes_listado.RazonSocial, 
clientes_listado.fNacimiento, 
clientes_listado.Direccion, 
clientes_listado.Fono1, 
clientes_listado.Fono2, 
clientes_listado.Fax,
clientes_listado.PersonaContacto,
clientes_listado.PersonaContacto_Fono,
clientes_listado.PersonaContacto_email,
clientes_listado.PersonaContacto_Cargo,
clientes_listado.Web,
clientes_listado.Giro,
clientes_listado.idTipo,
core_ubicacion_ciudad.Nombre AS nombre_region,
core_ubicacion_comunas.Nombre AS nombre_comuna,
core_estados.Nombre AS estado,
core_sistemas.Nombre AS sistema,
clientes_tipos.Nombre AS tipoCliente,
core_rubros.Nombre AS Rubro, 
clientes_listado.Contrato_Nombre, 
clientes_listado.Contrato_Numero, 
core_cross_cliente.Nombre AS Contrato_Periodo,
clientes_listado.Contrato_Fecha_Ini, 
clientes_listado.Contrato_Fecha_Term, 
clientes_listado.Contrato_N_Meses,
clientes_listado.Contrato_Representante_Legal,
clientes_listado.Contrato_Representante_Rut,
clientes_listado.Contrato_Representante_Fono,
clientes_listado.Contrato_Valor_Mensual, 
clientes_listado.Contrato_Valor_Anual,
clientes_listado.Contrato_UF_Instalacion ,
clientes_listado.Contrato_UF_Mensual,
clientes_listado.Contrato_Obs,
clientes_listado.idTab_1,
clientes_listado.idTab_2,
clientes_listado.idTab_3,
clientes_listado.idTab_4,
clientes_listado.idTab_5,
clientes_listado.idTab_6,
clientes_listado.idTab_7,
clientes_listado.idTab_8,
clientes_listado.idTab_9,
clientes_listado.idTab_10,
clientes_listado.idTab_11,
clientes_listado.idTab_12,
clientes_listado.idTab_13,
clientes_listado.idTab_14,
clientes_listado.idTab_15

FROM `clientes_listado`
LEFT JOIN `core_estados`              ON core_estados.idEstado                    = clientes_listado.idEstado
LEFT JOIN `core_ubicacion_ciudad`     ON core_ubicacion_ciudad.idCiudad           = clientes_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`    ON core_ubicacion_comunas.idComuna          = clientes_listado.idComuna
LEFT JOIN `core_sistemas`             ON core_sistemas.idSistema                  = clientes_listado.idSistema
LEFT JOIN `clientes_tipos`            ON clientes_tipos.idTipo                    = clientes_listado.idTipo
LEFT JOIN `core_rubros`               ON core_rubros.idRubro                      = clientes_listado.idRubro
LEFT JOIN `core_cross_cliente`        ON core_cross_cliente.idPeriodo             = clientes_listado.Contrato_idPeriodo

WHERE clientes_listado.idCliente = ".$_GET['id'];
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

/*******************************************/
//Listado con los tabs
$arrTabs = array();
$arrTabs = db_select_array (false, 'idTab, Nombre', 'core_telemetria_tabs', '', '', 'idTab ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrTabs');

//recorro
$arrTabsSorter = array();
foreach ($arrTabs as $tab) {
	$arrTabsSorter[$tab['idTab']] = $tab['Nombre'];
}

?>
<div class="col-sm-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Cliente', $rowdata['Nombre'], 'Resumen');?>
</div>
<div class="clearfix"></div> 

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="<?php echo 'clientes_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'clientes_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'clientes_listado_datos_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-address-book-o" aria-hidden="true"></i> Datos Contacto</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'clientes_listado_datos_persona_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-volume-control-phone" aria-hidden="true"></i> Persona Contacto</a></li>
						<?php if(isset($rowdata['idTipo'])&&$rowdata['idTipo']==1){?>
							<li class=""><a href="<?php echo 'clientes_listado_datos_comerciales.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-usd" aria-hidden="true"></i> Datos Comerciales</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'clientes_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						<li class=""><a href="<?php echo 'clientes_listado_contrato.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-briefcase" aria-hidden="true"></i> Contrato</a></li>
						<li class=""><a href="<?php echo 'clientes_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-tasks" aria-hidden="true"></i> Observaciones</a></li>
						<li class=""><a href="<?php echo 'clientes_listado_archivos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivos</a></li>
						<li class=""><a href="<?php echo 'clientes_listado_password.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-key" aria-hidden="true"></i> Password</a></li>
					</ul>
                </li>           
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="col-sm-6">
					<div class="row" style="border-right: 1px solid #333;">
						<div class="col-sm-12">
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Basicos</h2>
							<p class="text-muted word_break">
								<strong>Tipo de Cliente : </strong><?php echo $rowdata['tipoCliente']; ?><br/>
								<?php 
								//Si el cliente es una empresa
								if(isset($rowdata['idTipo'])&&$rowdata['idTipo']==1){?>
									<strong>Nombre Fantasia: </strong><?php echo $rowdata['Nombre']; ?><br/>
								<?php 
								//si es una persona
								}else{ ?>
									<strong>Nombre: </strong><?php echo $rowdata['Nombre']; ?><br/>
									<strong>Rut : </strong><?php echo $rowdata['Rut']; ?><br/>
								<?php } ?>
								<strong>Fecha de Ingreso Sistema : </strong><?php echo Fecha_completa($rowdata['fNacimiento']); ?><br/>
								<strong>Region : </strong><?php echo $rowdata['nombre_region']; ?><br/>
								<strong>Comuna : </strong><?php echo $rowdata['nombre_comuna']; ?><br/>
								<strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?><br/>
								<strong>Sistema Relacionado : </strong><?php echo $rowdata['sistema']; ?><br/>
								<strong>Estado : </strong><?php echo $rowdata['estado']; ?>
							</p>
								
							<?php 
							//Si el cliente es una empresa
							if(isset($rowdata['idTipo'])&&$rowdata['idTipo']==1){?>
								<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Comerciales</h2>
								<p class="text-muted word_break">
									<strong>Rut : </strong><?php echo $rowdata['Rut']; ?><br/>
									<strong>Razon Social : </strong><?php echo $rowdata['RazonSocial']; ?><br/>
									<strong>Giro de la empresa: </strong><?php echo $rowdata['Giro']; ?><br/>
									<strong>Rubro : </strong><?php echo $rowdata['Rubro']; ?><br/>
								</p>
							<?php } ?>
										
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de Contacto</h2>
							<p class="text-muted word_break">
								<strong>Telefono Fijo : </strong><?php echo $rowdata['Fono1']; ?><br/>
								<strong>Telefono Movil : </strong><?php echo $rowdata['Fono2']; ?><br/>
								<strong>Fax : </strong><?php echo $rowdata['Fax']; ?><br/>
								<strong>Email : </strong><a href="mailto:<?php echo $rowdata['email']; ?>"><?php echo $rowdata['email']; ?></a><br/>
								<strong>Web : </strong><a target="_blank" rel="noopener noreferrer" href="https://<?php echo $rowdata['Web']; ?>"><?php echo $rowdata['Web']; ?></a>
							</p>
									
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Persona de Contacto</h2>
							<p class="text-muted word_break">
								<strong>Persona de Contacto : </strong><?php echo $rowdata['PersonaContacto']; ?><br/>
								<strong>Cargo Persona de Contacto : </strong><?php echo $rowdata['PersonaContacto_Cargo']; ?><br/>
								<strong>Telefono : </strong><?php echo $rowdata['PersonaContacto_Fono']; ?><br/>
								<strong>Email : </strong><a href="mailto:<?php echo $rowdata['PersonaContacto_email']; ?>"><?php echo $rowdata['PersonaContacto_email']; ?></a><br/>
							</p>
							
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Contrato</h2>
							<p class="text-muted word_break">
								<strong>Nombre : </strong><?php echo $rowdata['Contrato_Nombre']; ?><br/>
								<strong>Numero o Codigo : </strong><?php echo $rowdata['Contrato_Numero']; ?><br/>
								<strong>Periodo : </strong><?php echo $rowdata['Contrato_Periodo']; ?><br/>
								<strong>Fecha inicio : </strong><?php echo fecha_estandar($rowdata['Contrato_Fecha_Ini']); ?><br/>
								<strong>Fecha termino : </strong><?php echo fecha_estandar($rowdata['Contrato_Fecha_Term']); ?><br/>
								<strong>Duracion N° Meses : </strong><?php echo Cantidades_decimales_justos($rowdata['Contrato_N_Meses']); ?><br/>
								<strong>Representante Legal Nombre : </strong><?php echo $rowdata['Contrato_Representante_Legal']; ?><br/>
								<strong>Representante Legal Rut : </strong><?php echo $rowdata['Contrato_Representante_Rut']; ?><br/>
								<strong>Representante Legal Fono : </strong><?php echo $rowdata['Contrato_Representante_Fono']; ?><br/>
								<strong>Valor Mensual : </strong><?php echo valores($rowdata['Contrato_Valor_Mensual'], 0); ?><br/>
								<strong>Valor Anual : </strong><?php echo valores($rowdata['Contrato_Valor_Anual'], 0); ?><br/>
								<strong>Valor UF instalacion : </strong><?php echo Cantidades_decimales_justos($rowdata['Contrato_UF_Instalacion']); ?><br/>
								<strong>Valor UF mensual : </strong><?php echo Cantidades_decimales_justos($rowdata['Contrato_UF_Mensual']); ?><br/>
								<strong>Observaciones : </strong><br/>
								<div class="text-muted well well-sm no-shadow">
									<?php if(isset($rowdata['Contrato_Obs'])&&$rowdata['Contrato_Obs']!=''){echo $rowdata['Contrato_Obs'];}else{echo 'Sin Observaciones';} ?>
									<div class="clearfix"></div>
								</div>
							</p>
							
							<?php if(isset($_SESSION['usuario']['basic_data']['idInterfaz'])&&$_SESSION['usuario']['basic_data']['idInterfaz']==7){?>
								<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Unidades de Negocio</h2>
								<p class="text-muted word_break">
									<?php 
										if(isset($rowdata['idTab_1'])&&$rowdata['idTab_1']==2&&isset($arrTabsSorter[1])){    echo ' - '.$arrTabsSorter[1].' <a target="new" href="view_cliente_contrato.php?view='.simpleEncode($_GET['id'], fecha_actual()).'&idTab='.simpleEncode( 1, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';}
										if(isset($rowdata['idTab_2'])&&$rowdata['idTab_2']==2&&isset($arrTabsSorter[2])){    echo ' - '.$arrTabsSorter[2].' <a target="new" href="view_cliente_contrato.php?view='.simpleEncode($_GET['id'], fecha_actual()).'&idTab='.simpleEncode( 2, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';}
										if(isset($rowdata['idTab_3'])&&$rowdata['idTab_3']==2&&isset($arrTabsSorter[3])){    echo ' - '.$arrTabsSorter[3].' <a target="new" href="view_cliente_contrato.php?view='.simpleEncode($_GET['id'], fecha_actual()).'&idTab='.simpleEncode( 3, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';}
										if(isset($rowdata['idTab_4'])&&$rowdata['idTab_4']==2&&isset($arrTabsSorter[4])){    echo ' - '.$arrTabsSorter[4].' <a target="new" href="view_cliente_contrato.php?view='.simpleEncode($_GET['id'], fecha_actual()).'&idTab='.simpleEncode( 4, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';}
										if(isset($rowdata['idTab_5'])&&$rowdata['idTab_5']==2&&isset($arrTabsSorter[5])){    echo ' - '.$arrTabsSorter[5].' <a target="new" href="view_cliente_contrato.php?view='.simpleEncode($_GET['id'], fecha_actual()).'&idTab='.simpleEncode( 5, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';}
										if(isset($rowdata['idTab_6'])&&$rowdata['idTab_6']==2&&isset($arrTabsSorter[6])){    echo ' - '.$arrTabsSorter[6].' <a target="new" href="view_cliente_contrato.php?view='.simpleEncode($_GET['id'], fecha_actual()).'&idTab='.simpleEncode( 6, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';}
										if(isset($rowdata['idTab_7'])&&$rowdata['idTab_7']==2&&isset($arrTabsSorter[7])){    echo ' - '.$arrTabsSorter[7].' <a target="new" href="view_cliente_contrato.php?view='.simpleEncode($_GET['id'], fecha_actual()).'&idTab='.simpleEncode( 7, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';}
										if(isset($rowdata['idTab_8'])&&$rowdata['idTab_8']==2&&isset($arrTabsSorter[8])){    echo ' - '.$arrTabsSorter[8].' <a target="new" href="view_cliente_contrato.php?view='.simpleEncode($_GET['id'], fecha_actual()).'&idTab='.simpleEncode( 8, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';} 
										if(isset($rowdata['idTab_9'])&&$rowdata['idTab_9']==2&&isset($arrTabsSorter[9])){    echo ' - '.$arrTabsSorter[9].' <a target="new" href="view_cliente_contrato.php?view='.simpleEncode($_GET['id'], fecha_actual()).'&idTab='.simpleEncode( 9, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';} 
										if(isset($rowdata['idTab_10'])&&$rowdata['idTab_10']==2&&isset($arrTabsSorter[10])){ echo ' - '.$arrTabsSorter[10].' <a target="new" href="view_cliente_contrato.php?view='.simpleEncode($_GET['id'], fecha_actual()).'&idTab='.simpleEncode( 10, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';} 
										if(isset($rowdata['idTab_11'])&&$rowdata['idTab_11']==2&&isset($arrTabsSorter[11])){ echo ' - '.$arrTabsSorter[11].' <a target="new" href="view_cliente_contrato.php?view='.simpleEncode($_GET['id'], fecha_actual()).'&idTab='.simpleEncode( 11, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';} 
										if(isset($rowdata['idTab_12'])&&$rowdata['idTab_12']==2&&isset($arrTabsSorter[12])){ echo ' - '.$arrTabsSorter[12].' <a target="new" href="view_cliente_contrato.php?view='.simpleEncode($_GET['id'], fecha_actual()).'&idTab='.simpleEncode( 12, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';} 
										if(isset($rowdata['idTab_13'])&&$rowdata['idTab_13']==2&&isset($arrTabsSorter[13])){ echo ' - '.$arrTabsSorter[13].' <a target="new" href="view_cliente_contrato.php?view='.simpleEncode($_GET['id'], fecha_actual()).'&idTab='.simpleEncode( 13, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';} 
										if(isset($rowdata['idTab_14'])&&$rowdata['idTab_14']==2&&isset($arrTabsSorter[14])){ echo ' - '.$arrTabsSorter[14].' <a target="new" href="view_cliente_contrato.php?view='.simpleEncode($_GET['id'], fecha_actual()).'&idTab='.simpleEncode( 14, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';} 
										if(isset($rowdata['idTab_15'])&&$rowdata['idTab_15']==2&&isset($arrTabsSorter[15])){ echo ' - '.$arrTabsSorter[15].' <a target="new" href="view_cliente_contrato.php?view='.simpleEncode($_GET['id'], fecha_actual()).'&idTab='.simpleEncode( 15, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';} 
									?>
								</p>			
							<?php } ?>
							
							
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row">
						<?php 
							//se arma la direccion
							$direccion = "";
							if(isset($rowdata["Direccion"])&&$rowdata["Direccion"]!=''){           $direccion .= $rowdata["Direccion"];}
							if(isset($rowdata["nombre_comuna"])&&$rowdata["nombre_comuna"]!=''){   $direccion .= ', '.$rowdata["nombre_comuna"];}
							if(isset($rowdata["nombre_region"])&&$rowdata["nombre_region"]!=''){   $direccion .= ', '.$rowdata["nombre_region"];}
							//se despliega mensaje en caso de no existir direccion
							if($direccion!=''){
								echo mapa_from_direccion($direccion, 0, $_SESSION['usuario']['basic_data']['Config_IDGoogle'], 18, 1); 
							}else{
								$Alert_Text = 'No tiene una direccion definida';
								alert_post_data(4,2,2, $Alert_Text);
							}
						?>
					</div>
				</div>
				<div class="clearfix"></div>

			</div>
        </div>	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-sm-12" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) {
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn);  ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>		
			<h5>Crear Cliente</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($idTipo)) {           $x1  = $idTipo;            }else{$x1  = '';}
				if(isset($Nombre)) {           $x2  = $Nombre;            }else{$x2  = '';}
				if(isset($Rut)) {              $x3  = $Rut;               }else{$x3  = '';}
				if(isset($fNacimiento)) {      $x4  = $fNacimiento;       }else{$x4  = '';}
				if(isset($idCiudad)) {         $x5  = $idCiudad;          }else{$x5  = '';}
				if(isset($idComuna)) {         $x6  = $idComuna;          }else{$x6  = '';}
				if(isset($Direccion)) {        $x7  = $Direccion;         }else{$x7  = '';}
				if(isset($Giro)) {             $x8  = $Giro;              }else{$x8  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_tittle(3, 'Datos Basicos');
				$Form_Inputs->form_select('Tipo de Cliente','idTipo', $x1, 2, 'idTipo', 'Nombre', 'clientes_tipos', 0, '', $dbConn);
				$Form_Inputs->form_input_text('Nombres', 'Nombre', $x2, 2);
				$Form_Inputs->form_input_rut('Rut', 'Rut', $x3, 2);
				$Form_Inputs->form_date('F Ingreso Sistema','fNacimiento', $x4, 1);
				$Form_Inputs->form_select_depend1('Ciudad','idCiudad', $x5, 1, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
										'Comuna','idComuna', $x6, 1, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0, 
										 $dbConn, 'form1');
				$Form_Inputs->form_input_icon('Direccion', 'Direccion', $x7, 1,'fa fa-map');	 
				$Form_Inputs->form_input_icon('Giro de la empresa', 'Giro', $x8, 1,'fa fa-industry');
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idEstado', 1, 2);
				$Form_Inputs->form_input_hidden('password', 1234, 2);
				$Form_Inputs->form_input_hidden('new_folder', 1, 2);
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
if(isset($_GET["pagina"])){$num_pag = $_GET["pagina"];	
} else {$num_pag = 1;	
}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){
	$comienzo = 0 ;$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'rut_asc':       $order_by = 'ORDER BY clientes_listado.Rut ASC ';       $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Rut Ascendente'; break;
		case 'rut_desc':      $order_by = 'ORDER BY clientes_listado.Rut DESC ';      $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Rut Descendente';break;
		case 'nombre_asc':    $order_by = 'ORDER BY clientes_listado.Nombre ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';break;
		case 'nombre_desc':   $order_by = 'ORDER BY clientes_listado.Nombre DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		case 'estado_asc':    $order_by = 'ORDER BY clientes_listado.idEstado ASC ';  $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Estado Ascendente';break;
		case 'estado_desc':   $order_by = 'ORDER BY clientes_listado.idEstado DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Estado Descendente';break;
		case 'tab_asc':       $order_by = 'ORDER BY clientes_listado.idTab_1 ASC ';   $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Unidad de Negocio Ascendente';break;
		case 'tab_desc':      $order_by = 'ORDER BY clientes_listado.idTab_1 DESC ';  $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Unidad de Negocio Descendente';break;
		
		default: $order_by = 'ORDER BY clientes_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
	}
}else{
	$order_by = 'ORDER BY clientes_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE clientes_listado.idCliente!=0";
//verifico que sea un administrador
$z.=" AND clientes_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	

/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idTipo']) && $_GET['idTipo'] != ''){             $z .= " AND clientes_listado.idTipo=".$_GET['idTipo'];}
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){             $z .= " AND clientes_listado.Nombre LIKE '%".$_GET['Nombre']."%'";}
if(isset($_GET['Rut']) && $_GET['Rut'] != ''){                   $z .= " AND clientes_listado.Rut LIKE '%".$_GET['Rut']."%'";}
if(isset($_GET['fNacimiento']) && $_GET['fNacimiento'] != ''){   $z .= " AND clientes_listado.fNacimiento='".$_GET['fNacimiento']."'";}
if(isset($_GET['idCiudad']) && $_GET['idCiudad'] != ''){         $z .= " AND clientes_listado.idCiudad=".$_GET['idCiudad'];}
if(isset($_GET['idComuna']) && $_GET['idComuna'] != ''){         $z .= " AND clientes_listado.idComuna=".$_GET['idComuna'];}
if(isset($_GET['Direccion']) && $_GET['Direccion'] != ''){       $z .= " AND clientes_listado.Direccion LIKE '%".$_GET['Direccion']."%'";}
if(isset($_GET['Giro']) && $_GET['Giro'] != ''){                 $z .= " AND clientes_listado.Giro LIKE '%".$_GET['Giro']."%'";}
if(isset($_GET['idTab_1']) && $_GET['idTab_1'] != ''){           $z .= " AND clientes_listado.idTab_1='".$_GET['idTab_1']."'";}
if(isset($_GET['idTab_2']) && $_GET['idTab_2'] != ''){           $z .= " AND clientes_listado.idTab_2='".$_GET['idTab_2']."'";}
if(isset($_GET['idTab_3']) && $_GET['idTab_3'] != ''){           $z .= " AND clientes_listado.idTab_3='".$_GET['idTab_3']."'";}
if(isset($_GET['idTab_4']) && $_GET['idTab_4'] != ''){           $z .= " AND clientes_listado.idTab_4='".$_GET['idTab_4']."'";}
if(isset($_GET['idTab_5']) && $_GET['idTab_5'] != ''){           $z .= " AND clientes_listado.idTab_5='".$_GET['idTab_5']."'";}
if(isset($_GET['idTab_6']) && $_GET['idTab_6'] != ''){           $z .= " AND clientes_listado.idTab_6='".$_GET['idTab_6']."'";}
if(isset($_GET['idTab_7']) && $_GET['idTab_7'] != ''){           $z .= " AND clientes_listado.idTab_7='".$_GET['idTab_7']."'";}
if(isset($_GET['idTab_8']) && $_GET['idTab_8'] != ''){           $z .= " AND clientes_listado.idTab_8='".$_GET['idTab_8']."'";}
if(isset($_GET['idTab_9']) && $_GET['idTab_9'] != ''){           $z .= " AND clientes_listado.idTab_9='".$_GET['idTab_9']."'";}
if(isset($_GET['idTab_10']) && $_GET['idTab_10'] != ''){         $z .= " AND clientes_listado.idTab_10='".$_GET['idTab_10']."'";}
if(isset($_GET['idTab_11']) && $_GET['idTab_11'] != ''){         $z .= " AND clientes_listado.idTab_11='".$_GET['idTab_11']."'";}
if(isset($_GET['idTab_12']) && $_GET['idTab_12'] != ''){         $z .= " AND clientes_listado.idTab_12='".$_GET['idTab_12']."'";}
if(isset($_GET['idTab_13']) && $_GET['idTab_13'] != ''){         $z .= " AND clientes_listado.idTab_13='".$_GET['idTab_13']."'";}
if(isset($_GET['idTab_14']) && $_GET['idTab_14'] != ''){         $z .= " AND clientes_listado.idTab_14='".$_GET['idTab_14']."'";}
if(isset($_GET['idTab_15']) && $_GET['idTab_15'] != ''){         $z .= " AND clientes_listado.idTab_15='".$_GET['idTab_15']."'";}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT clientes_listado.idCliente FROM `clientes_listado` ".$z;
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
// Se trae un listado con todos los elementos
$arrClientes = array();
$query = "SELECT 
clientes_listado.idCliente,
clientes_listado.Rut,
clientes_listado.Nombre,
core_estados.Nombre AS estado,
core_sistemas.Nombre AS sistema,
clientes_listado.idEstado,
clientes_listado.idTab_1,
clientes_listado.idTab_2,
clientes_listado.idTab_3,
clientes_listado.idTab_4,
clientes_listado.idTab_5,
clientes_listado.idTab_6,
clientes_listado.idTab_7,
clientes_listado.idTab_8,
clientes_listado.idTab_9,
clientes_listado.idTab_10,
clientes_listado.idTab_11,
clientes_listado.idTab_12,
clientes_listado.idTab_13,
clientes_listado.idTab_14,
clientes_listado.idTab_15

FROM `clientes_listado`
LEFT JOIN `core_estados`   ON core_estados.idEstado       = clientes_listado.idEstado
LEFT JOIN `core_sistemas`  ON core_sistemas.idSistema     = clientes_listado.idSistema
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
array_push( $arrClientes,$row );
}

/*******************************************/
//Listado con los tabs
$arrTabs = array();
$arrTabs = db_select_array (false, 'idTab, Nombre', 'core_telemetria_tabs', '', '', 'idTab ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrTabs');

//recorro
$arrTabsSorter = array();
foreach ($arrTabs as $tab) {
	$arrTabsSorter[$tab['idTab']] = $tab['Nombre'];
}
?>
<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Cliente</a><?php }?>

</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($idTipo)) {           $x1   = $idTipo;            }else{$x1   = '';}
				if(isset($Nombre)) {           $x2   = $Nombre;            }else{$x2   = '';}
				if(isset($Rut)) {              $x3   = $Rut;               }else{$x3   = '';}
				if(isset($fNacimiento)) {      $x4   = $fNacimiento;       }else{$x4   = '';}
				if(isset($idCiudad)) {         $x5   = $idCiudad;          }else{$x5   = '';}
				if(isset($idComuna)) {         $x6   = $idComuna;          }else{$x6   = '';}
				if(isset($Direccion)) {        $x7   = $Direccion;         }else{$x7   = '';}
				if(isset($Giro)) {             $x9   = $Giro;              }else{$x9   = '';}
				if(isset($idTab_1)) {          $x10  = $idTab_1;           }else{$x10  = '';}
				if(isset($idTab_2)) {          $x10 .= ','.$idTab_2;       }else{$x10 .= ',';}
				if(isset($idTab_3)) {          $x10 .= ','.$idTab_3;       }else{$x10 .= ',';}
				if(isset($idTab_4)) {          $x10 .= ','.$idTab_4;       }else{$x10 .= ',';}
				if(isset($idTab_5)) {          $x10 .= ','.$idTab_5;       }else{$x10 .= ',';}
				if(isset($idTab_6)) {          $x10 .= ','.$idTab_6;       }else{$x10 .= ',';}
				if(isset($idTab_7)) {          $x10 .= ','.$idTab_7;       }else{$x10 .= ',';}
				if(isset($idTab_8)) {          $x10 .= ','.$idTab_8;       }else{$x10 .= ',';}
				if(isset($idTab_9)) {          $x10 .= ','.$idTab_9;       }else{$x10 .= ',';}
				if(isset($idTab_10)) {         $x10 .= ','.$idTab_10;      }else{$x10 .= ',';}
				if(isset($idTab_11)) {         $x10 .= ','.$idTab_11;      }else{$x10 .= ',';}
				if(isset($idTab_12)) {         $x10 .= ','.$idTab_12;      }else{$x10 .= ',';}
				if(isset($idTab_13)) {         $x10 .= ','.$idTab_13;      }else{$x10 .= ',';}
				if(isset($idTab_14)) {         $x10 .= ','.$idTab_14;      }else{$x10 .= ',';}
				if(isset($idTab_15)) {         $x10 .= ','.$idTab_15;      }else{$x10 .= ',';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select('Tipo de Cliente','idTipo', $x1, 1, 'idTipo', 'Nombre', 'clientes_tipos', 0, '', $dbConn);
				$Form_Inputs->form_input_text('Nombres', 'Nombre', $x2, 1);
				$Form_Inputs->form_input_rut('Rut', 'Rut', $x3, 1);
				$Form_Inputs->form_date('F Ingreso Sistema','fNacimiento', $x4, 1);
				$Form_Inputs->form_select_depend1('Ciudad','idCiudad', $x5, 1, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
										'Comuna','idComuna', $x6, 1, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0, 
										 $dbConn, 'form1');
				$Form_Inputs->form_input_icon('Direccion', 'Direccion', $x7, 1,'fa fa-map');	 
				$Form_Inputs->form_input_icon('Giro de la empresa', 'Giro', $x9, 1,'fa fa-industry');
				//Solo para plataforma Intranet
				if(isset($_SESSION['usuario']['basic_data']['idInterfaz'])&&$_SESSION['usuario']['basic_data']['idInterfaz']==7){
					$Form_Inputs->form_checkbox_active('Unidad de Negocio','idTab', $x10, 1, 'idTab', 'Nombre', 'core_telemetria_tabs', 0, $dbConn);
				}
				
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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Clientes</h5>	
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
							<div class="pull-left">Rut</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=rut_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=rut_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Nombre del Cliente</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=nombre_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th width="120">
							<div class="pull-left">Estado</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=estado_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=estado_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<?php if(isset($_SESSION['usuario']['basic_data']['idInterfaz'])&&$_SESSION['usuario']['basic_data']['idInterfaz']==7){ ?>
							<th>
								<div class="pull-left">Unidad de Negocio</div>
								<div class="btn-group pull-right" style="width: 50px;" >
									<a href="<?php echo $location.'&order_by=tab_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
									<a href="<?php echo $location.'&order_by=tab_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
								</div>
							</th>
						<?php } ?>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrClientes as $cliente) { ?>
					<tr class="odd">		
						<td><?php echo $cliente['Rut']; ?></td>		
						<td><?php echo $cliente['Nombre']; ?></td>		
						<td><label class="label <?php if(isset($cliente['idEstado'])&&$cliente['idEstado']==1){echo 'label-success';}else{echo 'label-danger';}?>"><?php echo $cliente['estado']; ?></label></td>		
						<?php if(isset($_SESSION['usuario']['basic_data']['idInterfaz'])&&$_SESSION['usuario']['basic_data']['idInterfaz']==7){ ?>		
							<td>
								<?php 
									if(isset($cliente['idTab_1'])&&$cliente['idTab_1']==2&&isset($arrTabsSorter[1])){    echo ' - '.$arrTabsSorter[1].'<br/>';}
									if(isset($cliente['idTab_2'])&&$cliente['idTab_2']==2&&isset($arrTabsSorter[2])){    echo ' - '.$arrTabsSorter[2].'<br/>';}
									if(isset($cliente['idTab_3'])&&$cliente['idTab_3']==2&&isset($arrTabsSorter[3])){    echo ' - '.$arrTabsSorter[3].'<br/>';}
									if(isset($cliente['idTab_4'])&&$cliente['idTab_4']==2&&isset($arrTabsSorter[4])){    echo ' - '.$arrTabsSorter[4].'<br/>';}
									if(isset($cliente['idTab_5'])&&$cliente['idTab_5']==2&&isset($arrTabsSorter[5])){    echo ' - '.$arrTabsSorter[5].'<br/>';}
									if(isset($cliente['idTab_6'])&&$cliente['idTab_6']==2&&isset($arrTabsSorter[6])){    echo ' - '.$arrTabsSorter[6].'<br/>';}
									if(isset($cliente['idTab_7'])&&$cliente['idTab_7']==2&&isset($arrTabsSorter[7])){    echo ' - '.$arrTabsSorter[7].'<br/>';}
									if(isset($cliente['idTab_8'])&&$cliente['idTab_8']==2&&isset($arrTabsSorter[8])){    echo ' - '.$arrTabsSorter[8].'<br/>';} 
									if(isset($cliente['idTab_9'])&&$cliente['idTab_9']==2&&isset($arrTabsSorter[9])){    echo ' - '.$arrTabsSorter[9].'<br/>';} 
									if(isset($cliente['idTab_10'])&&$cliente['idTab_10']==2&&isset($arrTabsSorter[10])){ echo ' - '.$arrTabsSorter[10].'<br/>';} 
									if(isset($cliente['idTab_11'])&&$cliente['idTab_11']==2&&isset($arrTabsSorter[11])){ echo ' - '.$arrTabsSorter[11].'<br/>';} 
									if(isset($cliente['idTab_12'])&&$cliente['idTab_12']==2&&isset($arrTabsSorter[12])){ echo ' - '.$arrTabsSorter[12].'<br/>';} 
									if(isset($cliente['idTab_13'])&&$cliente['idTab_13']==2&&isset($arrTabsSorter[13])){ echo ' - '.$arrTabsSorter[13].'<br/>';} 
									if(isset($cliente['idTab_14'])&&$cliente['idTab_14']==2&&isset($arrTabsSorter[14])){ echo ' - '.$arrTabsSorter[14].'<br/>';} 
									if(isset($cliente['idTab_15'])&&$cliente['idTab_15']==2&&isset($arrTabsSorter[15])){ echo ' - '.$arrTabsSorter[15].'<br/>';} 
								?>
							</td>		
						<?php } ?>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $cliente['sistema']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_cliente.php?view='.simpleEncode($cliente['idCliente'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$cliente['idCliente']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.simpleEncode($cliente['idCliente'], fecha_actual());
									$dialogo   = '¿Realmente deseas eliminar al cliente '.$cliente['Nombre'].'?';?>
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
