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
$original = "aguas_clientes_observaciones_masivas.php";
$location = $original;
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if ( !empty($_POST['submit']) )  { 
	//se agregan ubicaciones
	$form_trabajo= 'send_masivo';
	require_once 'A1XRXS_sys/xrxs_form/aguas_clientes_observaciones_masivas.php';
}
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
$z = "WHERE aguas_clientes_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idCliente']) && $_GET['idCliente'] != ''){          $z .= " AND aguas_clientes_listado.idCliente=".$_GET['idCliente'];}
if(isset($_GET['idTipo']) && $_GET['idTipo'] != ''){                $z .= " AND aguas_clientes_listado.idTipo=".$_GET['idTipo'];}
if(isset($_GET['idFacturable']) && $_GET['idFacturable'] != ''){    $z .= " AND aguas_clientes_listado.idFacturable=".$_GET['idFacturable'];}
if(isset($_GET['idSector']) && $_GET['idSector'] != ''){            $z .= " AND aguas_clientes_listado.idSector=".$_GET['idSector'];}
/**********************************************************/
// Se trae un listado con todos los usuarios
$arrUsers = array();
$query = "SELECT 
aguas_clientes_listado.idCliente,
aguas_clientes_listado.Identificador,
aguas_clientes_listado.Nombre,
aguas_clientes_listado.idEstado,
core_estados.Nombre AS estado,
core_sistemas.Nombre AS sistema,
aguas_clientes_facturable.Nombre AS DocFacturable,
aguas_clientes_tipos.Nombre AS Tipo

FROM `aguas_clientes_listado`
LEFT JOIN `core_estados`               ON core_estados.idEstado                    = aguas_clientes_listado.idEstado
LEFT JOIN `core_sistemas`              ON core_sistemas.idSistema                  = aguas_clientes_listado.idSistema
LEFT JOIN `aguas_clientes_facturable`  ON aguas_clientes_facturable.idFacturable   = aguas_clientes_listado.idFacturable
LEFT JOIN `aguas_clientes_tipos`       ON aguas_clientes_tipos.idTipo              = aguas_clientes_listado.idTipo
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
array_push( $arrUsers,$row );
}

//Conteo
$num = 0;
foreach ($arrUsers as $usuarios) {
	$num++;
}
//cuadro para descargar	 
$Alert_Text  = 'Se ingresara la observacion a <strong>'.$num.'</strong> clientes con el filtro actual';
alert_post_data(2,1,2, $Alert_Text);
?>
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Envio Observacion Masiva</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" enctype="multipart/form-data" id="form1" name="form1" novalidate >
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Observacion)) {   $x1  = $Observacion;   }else{$x1  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_textarea('Observaciones', 'Observacion', $x1, 2, 160);
				$Form_Inputs->form_multiple_upload('Seleccionar Formulario','Formulario', 1, '"jpg", "png", "gif", "jpeg", "bmp", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "pdf", "txt", "rtf", "gz", "gzip", "7Z", "zip", "rar"');
				$Form_Inputs->form_multiple_upload('Seleccionar Foto','Foto', 1, '"jpg", "png", "gif", "jpeg"');
				
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Inputs->form_input_hidden('Fecha', fecha_actual(), 2);
				$Form_Inputs->form_input_hidden('NClientes', $num, 2);
				
				if(isset($_GET['idCliente']) && $_GET['idCliente'] != ''){         $Form_Inputs->form_input_hidden('idCliente', $_GET['idCliente'], 2);}        
				if(isset($_GET['idTipo']) && $_GET['idTipo'] != ''){               $Form_Inputs->form_input_hidden('idTipo', $_GET['idTipo'], 2);}                
				if(isset($_GET['idFacturable']) && $_GET['idFacturable'] != ''){   $Form_Inputs->form_input_hidden('idFacturable', $_GET['idFacturable'], 2);}    
				if(isset($_GET['idSector']) && $_GET['idSector'] != ''){           $Form_Inputs->form_input_hidden('idSector', $_GET['idSector'], 2);}    
				
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

<div class="col-sm-12">
	<div class="box">	
		<header>		
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Clientes</h5>	
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Identificador</th>
						<th>Nombre</th>
						<th>Tipo</th>
						<th>Forma Facturacion</th>
						<th width="120">Estado</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrUsers as $usuarios) { ?>
					<tr class="odd">		
						<td><?php echo $usuarios['Identificador']; ?></td>		
						<td><?php echo $usuarios['Nombre']; ?></td>		
						<td><?php echo $usuarios['Tipo']; ?></td>		
						<td><?php echo $usuarios['DocFacturable']; ?></td>		
						<td><label class="label <?php if(isset($usuarios['idEstado'])&&$usuarios['idEstado']==1){echo 'label-success';}else{echo 'label-danger';}?>"><?php echo $usuarios['estado']; ?></label></td>		
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $usuarios['sistema']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 35px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_aguas_cliente.php?view='.simpleEncode($usuarios['idCliente'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
							</div>
						</td>	
					</tr>
					<?php } ?>                    
				</tbody>
			</table>
		</div>  
	</div>
</div>
	
<?php widget_modal(80, 95); ?>



<div class="clearfix"></div>
<div class="col-sm-12" style="margin-bottom:30px">
<a href="<?php echo $location; ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
//Indico el sistema	 
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema'].' AND aguas_clientes_listado.idEstado=1';		 
?>
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($idCliente)) {      $x1  = $idCliente;      }else{$x1  = '';}
				if(isset($idTipo)) {         $x2  = $idTipo;         }else{$x2  = '';}
				if(isset($idFacturable)) {   $x3  = $idFacturable;   }else{$x3  = '';}
				if(isset($idSector)) {       $x4  = $idSector;       }else{$x4  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Cliente','idCliente', $x1, 1, 'idCliente', 'Identificador,Nombre', 'aguas_clientes_listado', $z, 'ORDER BY Identificador ASC', $dbConn);
				$Form_Inputs->form_select('Tipo de Cliente','idTipo', $x2, 1, 'idTipo', 'Nombre', 'aguas_clientes_tipos', 0, '', $dbConn);
				$Form_Inputs->form_select('Forma Facturacion','idFacturable', $x3, 1, 'idFacturable', 'Nombre', 'aguas_clientes_facturable', 0, '', $dbConn);
				$Form_Inputs->form_select('Sector','idSector', $x4, 1, 'idSector', 'Nombre', 'aguas_analisis_sectores', 0, '', $dbConn);
				
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
