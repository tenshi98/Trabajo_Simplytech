<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Web.php';
//Verifico si es superusuario
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Type.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "core_sistemas.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/core_sistemas.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/core_sistemas.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Sistema creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Sistema editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Sistema borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
// Se traen todos los datos del trabajador
$query = "SELECT
core_sistemas.Nombre,  
core_sistemas.Rut, 
core_ubicacion_ciudad.Nombre AS Ciudad, 
core_ubicacion_comunas.Nombre AS Comuna, 
core_sistemas.Direccion, 
core_sistemas.Contacto_Nombre, 
core_sistemas.Contacto_Fono1, 
core_sistemas.Contacto_Fono2, 
core_sistemas.Contacto_Fax, 
core_sistemas.Contacto_Web, 
core_sistemas.Contacto_Email, 
core_sistemas.email_principal, 
core_sistemas.Contrato_Nombre, 
core_sistemas.Contrato_Numero, 
core_sistemas.Contrato_Fecha, 
core_sistemas.Contrato_Duracion,
core_sistemas.Config_IDGoogle,
core_sistemas.Config_Google_apiKey,
core_theme_colors.Nombre AS Tema,
core_sistemas.Config_CorreoRespaldo,
opc1.Nombre AS OpcionesGen_1,
opc2.Nombre AS OpcionesGen_2,
opc3.Nombre AS OpcionesGen_3,
opc4.Nombre AS OpcionesGen_4,
opc5.Nombre AS OpcionesGen_5,
opc7.Nombre AS OpcionesGen_7,
opc8.Nombre AS OpcionesGen_8,
opc9.Nombre AS OpcionesGen_9,
core_sistemas.idOpcionesGen_6,
bodegas_productos_listado.Nombre AS BodegaProd,
bodegas_insumos_listado.Nombre AS BodegaIns,
core_sistemas.Rubro,
core_sistemas_opciones_telemetria.Nombre AS OpcionTelemetria,
core_config_ram.Nombre AS ConfigRam,
core_config_time.Nombre AS ConfigTime

FROM `core_sistemas`
LEFT JOIN `core_ubicacion_ciudad`              ON core_ubicacion_ciudad.idCiudad                   = core_sistemas.idCiudad
LEFT JOIN `core_ubicacion_comunas`             ON core_ubicacion_comunas.idComuna                  = core_sistemas.idComuna
LEFT JOIN `core_theme_colors`                  ON core_theme_colors.idTheme                        = core_sistemas.Config_idTheme
LEFT JOIN `core_sistemas_opciones`   opc1      ON opc1.idOpciones                                  = core_sistemas.idOpcionesGen_1
LEFT JOIN `core_sistemas_opciones`   opc2      ON opc2.idOpciones                                  = core_sistemas.idOpcionesGen_2
LEFT JOIN `core_sistemas_opciones`   opc3      ON opc3.idOpciones                                  = core_sistemas.idOpcionesGen_3
LEFT JOIN `core_sistemas_opciones`   opc4      ON opc4.idOpciones                                  = core_sistemas.idOpcionesGen_4
LEFT JOIN `core_sistemas_opciones`   opc5      ON opc5.idOpciones                                  = core_sistemas.idOpcionesGen_5
LEFT JOIN `core_interfaces`          opc7      ON opc7.idInterfaz                                  = core_sistemas.idOpcionesGen_7
LEFT JOIN `core_sistemas_opciones`   opc8      ON opc8.idOpciones                                  = core_sistemas.idOpcionesGen_8
LEFT JOIN `core_sistemas_opciones`   opc9      ON opc9.idOpciones                                  = core_sistemas.idOpcionesGen_9
LEFT JOIN `bodegas_productos_listado`          ON bodegas_productos_listado.idBodega               = core_sistemas.OT_idBodegaProd
LEFT JOIN `bodegas_insumos_listado`            ON bodegas_insumos_listado.idBodega                 = core_sistemas.OT_idBodegaIns
LEFT JOIN `core_sistemas_opciones_telemetria`  ON core_sistemas_opciones_telemetria.idOpcionesTel  = core_sistemas.idOpcionesTel
LEFT JOIN `core_config_ram`                    ON core_config_ram.idConfigRam                      = core_sistemas.idConfigRam
LEFT JOIN `core_config_time`                   ON core_config_time.idConfigTime                    = core_sistemas.idConfigTime

WHERE core_sistemas.idSistema = {$_GET['id']}";
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


?>
<div class="col-sm-12">
	<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-cog faa-spin animated " aria-hidden="true"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Sistema</span>
				<span class="info-box-number"><?php echo $rowdata['Nombre']; ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">Resumen</span>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>


<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="<?php echo 'core_sistemas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'core_sistemas_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'core_sistemas_datos_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Contacto</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'core_sistemas_datos_contrato.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Contrato</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_datos_configuracion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Configuracion</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_datos_opciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >APIS</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_datos_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_datos_facturacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Facturacion</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_datos_ot.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >OT</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_datos_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Logo</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_datos_oc.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Aprobador OC</a></li>
						
					</ul>
                </li>           
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
						<thead>
							<tr role="row">
								<th width="50%" class="word_break">Datos</th>
								<th width="50%">Mapa</th>
							</tr>
						</thead>					  
						<tbody role="alert" aria-live="polite" aria-relevant="all">
							<tr class="odd">
								<td class="word_break">
									
									<h2 class="text-primary">Datos Basicos</h2>
									<p class="text-muted">
										<strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?><br/>
										<strong>Rut : </strong><?php echo $rowdata['Rut']; ?><br/>
										<strong>Ciudad : </strong><?php echo $rowdata['Ciudad']; ?><br/>
										<strong>Comuna : </strong><?php echo $rowdata['Comuna']; ?><br/>
										<strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?><br/>
										<strong>Rubro : </strong><?php echo $rowdata['Rubro']; ?>
									</p>
									
									
									<h2 class="text-primary">Datos de contacto</h2>
									<p class="text-muted">
										<strong>Nombre Contacto : </strong><?php echo $rowdata['Contacto_Nombre']; ?><br/>
										<strong>Fono 1: </strong><?php echo $rowdata['Contacto_Fono1']; ?><br/>
										<strong>Fono 2: </strong><?php echo $rowdata['Contacto_Fono2']; ?><br/>
										<strong>Fax : </strong><?php echo $rowdata['Contacto_Fax']; ?><br/>
										<strong>Web : </strong><?php echo $rowdata['Contacto_Web']; ?><br/>
										<strong>Email : </strong><?php echo $rowdata['Contacto_Email']; ?>
									</p>

									<h2 class="text-primary">Contrato</h2>
									<p class="text-muted">
										<strong>Nombre Contrato : </strong><?php echo $rowdata['Contrato_Nombre']; ?><br/>
										<strong>Numero de Contrato : </strong><?php echo $rowdata['Contrato_Numero']; ?><br/>
										<strong>Fecha inicio Contrato : </strong><?php echo $rowdata['Contrato_Fecha']; ?><br/>
										<strong>Duracion Contrato(Meses) : </strong><?php echo $rowdata['Contrato_Duracion']; ?>
									</p>
								
									<h2 class="text-primary">Configuracion</h2>
									<p class="text-muted">
										<strong>Tema : </strong><?php echo $rowdata['Tema']; ?><br/>
										<strong>Correo de Respaldo : </strong><?php echo $rowdata['Config_CorreoRespaldo']; ?><br/>
										<strong>Correo de Sistema : </strong><?php echo $rowdata['email_principal']; ?><br/>
										<strong>Tipo Resumen Telemetria : </strong><?php echo $rowdata['OpcionTelemetria']; ?><br/>
										<strong>Memoria Ram Maxima : </strong><?php if(isset($rowdata['ConfigRam'])&&$rowdata['ConfigRam']!=0){echo $rowdata['ConfigRam'].' MB';}else{ echo '4096 MB';} ?><br/>
										<strong>Tiempo Maximo de espera : </strong><?php if(isset($rowdata['ConfigTime'])&&$rowdata['ConfigTime']!=0){echo $rowdata['ConfigTime'].' Minutos';}else{ echo '40 Minutos';} ?><br/>
										<strong>Widget Comunes : </strong><?php echo $rowdata['OpcionesGen_1']; ?><br/>
										<strong>Widget de acceso directo : </strong><?php echo $rowdata['OpcionesGen_2']; ?><br/>
										<strong>Valores promedios de las mediciones : </strong><?php echo $rowdata['OpcionesGen_3']; ?><br/>
										<strong>Refresh Pagina Principal : </strong><?php echo $rowdata['OpcionesGen_4'].'('.$rowdata['idOpcionesGen_6'].' segundos)'; ?><br/>
										<strong>PDF Complejo : </strong><?php echo $rowdata['OpcionesGen_5']; ?><br/>
										<strong>Interfaz : </strong><?php echo $rowdata['OpcionesGen_7']; ?><br/>
										<strong>Uso Correo Interno : </strong><?php echo $rowdata['OpcionesGen_8']; ?><br/>
										<strong>Mostrar Repositorio : </strong><?php echo $rowdata['OpcionesGen_9']; ?><br/>
									</p>
									
									<h2 class="text-primary">APIS</h2>
									<p class="text-muted">
										<strong>ID Google (Mapas) : </strong><?php echo $rowdata['Config_IDGoogle']; ?><br/>
										<strong>ApiKey (Android) : </strong><?php echo $rowdata['Config_Google_apiKey']; ?><br/>
									</p>
									
									<h2 class="text-primary">Bodegas OT</h2>
									<p class="text-muted">
										<strong>Bodega Productos : </strong><?php echo $rowdata['BodegaProd']; ?><br/>
										<strong>Bodega Insumos : </strong><?php echo $rowdata['BodegaIns']; ?><br/>
									</p>
									
	
								</td>
								<td>
									<?php 
									$direccion = "";
									if(isset($rowdata["Direccion"])&&$rowdata["Direccion"]!=''){  $direccion .= $rowdata["Direccion"];}
									if(isset($rowdata["Comuna"])&&$rowdata["Comuna"]!=''){        $direccion .= ', '.$rowdata["Comuna"];}
									if(isset($rowdata["Ciudad"])&&$rowdata["Ciudad"]!=''){        $direccion .= ', '.$rowdata["Ciudad"];}
									echo mapa2($direccion, 0, $_SESSION['usuario']['basic_data']['Config_IDGoogle']);
									?>
								</td>
							</tr>                  
						</tbody>
					</table>
				</div>
			</div>
        </div>	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
} elseif ( ! empty($_GET['new']) ) { ?>
 <div class="col-sm-9 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Sistema</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>

				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {           $x1  = $Nombre;           }else{$x1  = '';}
				if(isset($Rut)) {              $x2  = $Rut;              }else{$x2  = '';}
				if(isset($idCiudad)) {         $x3  = $idCiudad;         }else{$x3  = '';}
				if(isset($idComuna)) {         $x4  = $idComuna;         }else{$x4  = '';}
				if(isset($Direccion)) {        $x5  = $Direccion;        }else{$x5  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				echo '<h3>Datos Basicos</h3>';
				$Form_Imputs->form_input_text( 'Nombres', 'Nombre', $x1, 2);
				$Form_Imputs->form_input_rut('Rut', 'Rut', $x2, 2);
				$Form_Imputs->form_select_depend1('Ciudad','idCiudad', $x3, 2, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
										 'Comuna','idComuna', $x4, 2, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0, 
										 $dbConn, 'form1');	
				$Form_Imputs->form_input_icon( 'Direccion', 'Direccion', $x5, 2,'fa fa-map');            
				
				$Form_Imputs->form_input_hidden('Config_idTheme', 1, 2);
				$Form_Imputs->form_input_hidden('idOpcionesGen_1', 1, 2);
				$Form_Imputs->form_input_hidden('idOpcionesGen_2', 1, 2);
				$Form_Imputs->form_input_hidden('idOpcionesGen_3', 2, 2);
				$Form_Imputs->form_input_hidden('idOpcionesGen_4', 2, 2);
				$Form_Imputs->form_input_hidden('idOpcionesGen_5', 1, 2);
				$Form_Imputs->form_input_hidden('idOpcionesGen_6', 0, 1);
				$Form_Imputs->form_input_hidden('idOpcionesGen_7', 3, 2);
				$Form_Imputs->form_input_hidden('idOpcionesGen_8', 2, 2);
				$Form_Imputs->form_input_hidden('idOpcionesGen_9', 2, 2);
				$Form_Imputs->form_input_hidden('idOpcionesTel', 4, 2);
				$Form_Imputs->form_input_hidden('idConfigRam', 9, 2);
				$Form_Imputs->form_input_hidden('idConfigTime', 13, 2);
				$Form_Imputs->form_input_hidden('idEstado', 1, 2);
				
				?>
	 
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit">
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
} else  { 
//Se inicializa el paginador de resultados
//tomo el numero de la pagina si es que este existe
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
//Creo la variable con la ubicacion
$z = "WHERE core_sistemas.idSistema!=0 ";
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT core_sistemas.idSistema FROM `core_sistemas` LEFT JOIN `core_estados`  ON core_estados.idEstado  = core_sistemas.idEstado ".$z;
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
// Se trae u listado con todos los tipos de sistema
$arrTipoCliente = array();
$query = "SELECT 
core_sistemas.idSistema,
core_sistemas.Nombre,
core_sistemas.Rut,
core_sistemas.idEstado,
core_estados.Nombre AS estado

FROM `core_sistemas`
LEFT JOIN `core_estados`  ON core_estados.idEstado  = core_sistemas.idEstado
".$z."
ORDER BY core_sistemas.Nombre ASC
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
array_push( $arrTipoCliente,$row );
}
//paginacion
$search='';
?>

<div class="col-sm-12">
	<a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Sistema</a>
</div>
<div class="clearfix"></div>                       
                                 
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Sistemas</h5>
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
						<th>Nombre</th>
						<th>Rut</th>
						<th>Estado</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
								 
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrTipoCliente as $tipo) { ?>
					<tr class="odd">
						<td><?php echo $tipo['Nombre']; ?></td>
						<td><?php echo $tipo['Rut']; ?></td>
						<td><label class="label <?php if(isset($tipo['idEstado'])&&$tipo['idEstado']==1){echo 'label-success';}else{echo 'label-danger';}?>"><?php echo $tipo['estado']; ?></label></td>		
						<td>
							<div class="btn-group" style="width: 105px;" >
								<a href="<?php echo 'view_sistema.php?view='.$tipo['idSistema']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
								<a href="<?php echo $location.'&id='.$tipo['idSistema']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
								<?php 
								$ubicacion = $location.'&del='.$tipo['idSistema'];
								$dialogo   = '¿Realmente deseas eliminar el sistema '.$tipo['Nombre'].'?';?>
								<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>							
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
	
<?php widget_modal(80, 95); ?>
<?php } ?>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
