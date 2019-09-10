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
$original = "caja_chica_rendida.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idCajaChica']) && $_GET['idCajaChica'] != ''){          $location .= "&idCajaChica=".$_GET['idCajaChica'];          $search .= "&idCajaChica=".$_GET['idCajaChica'];}
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha'] != ''){    $location .= "&Creacion_fecha=".$_GET['Creacion_fecha'];    $search .= "&Creacion_fecha=".$_GET['Creacion_fecha'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_rendida';
	require_once 'A1XRXS_sys/xrxs_form/z_caja_chica.php';
}
//formulario para editar
if ( !empty($_POST['submit_modBase']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'modBase_rendida';
	require_once 'A1XRXS_sys/xrxs_form/z_caja_chica.php';
}
//formulario para editar
if ( !empty($_GET['clear_all']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'clear_all_rendida';
	require_once 'A1XRXS_sys/xrxs_form/z_caja_chica.php';
}
/**********************************************/
//formulario para crear
if ( !empty($_POST['submit_monto']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_monto_rendida';
	require_once 'A1XRXS_sys/xrxs_form/z_caja_chica.php';
}
//formulario para crear
if ( !empty($_POST['submit_edit_monto']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'edit_monto_rendida';
	require_once 'A1XRXS_sys/xrxs_form/z_caja_chica.php';
}
//se borra un dato
if ( !empty($_GET['del_monto']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_monto_rendida';
	require_once 'A1XRXS_sys/xrxs_form/z_caja_chica.php';	
}
/**********************************************/
//formulario para crear
if ( !empty($_POST['submit_item']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_item_rendida';
	require_once 'A1XRXS_sys/xrxs_form/z_caja_chica.php';
}
//formulario para crear
if ( !empty($_POST['submit_edit_item']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'edit_item_rendida';
	require_once 'A1XRXS_sys/xrxs_form/z_caja_chica.php';
}
//se borra un dato
if ( !empty($_GET['del_item']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_item_rendida';
	require_once 'A1XRXS_sys/xrxs_form/z_caja_chica.php';	
}
/**********************************************/
//se borra un dato
if ( !empty($_GET['add_obs']) )     {
	//Llamamos al formulario
	$form_trabajo= 'add_obs_rendida';
	require_once 'A1XRXS_sys/xrxs_form/z_caja_chica.php';	
}
//se borra un dato
if ( !empty($_GET['del_obs']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_obs_rendida';
	require_once 'A1XRXS_sys/xrxs_form/z_caja_chica.php';	
}
/**********************************************/
//formulario para crear
if ( !empty($_POST['submit_file']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_file_rendida';
	require_once 'A1XRXS_sys/xrxs_form/z_caja_chica.php';
}
//se borra un dato
if ( !empty($_GET['del_file']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_file_rendida';
	require_once 'A1XRXS_sys/xrxs_form/z_caja_chica.php';	
}
/**********************************************/
if ( !empty($_GET['rendida_Caja']) )     {
	//Llamamos al formulario
	$form_trabajo= 'rendida_Caja';
	require_once 'A1XRXS_sys/xrxs_form/z_caja_chica.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Rendicion Realizada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Rendicion Modificada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Rendicion borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['addFile']) ) { ?>
 
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Subir Archivo</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate enctype="multipart/form-data">
			
				<?php           
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_multiple_upload('Seleccionar archivo','exFile', 1, '"jpg", "png", "gif", "jpeg", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "pdf"');
					
				?> 

				<div class="form-group">
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_file"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>              
		</div>
	</div>
</div>	
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['editRendicion']) ) { ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Editar Rendicion</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Item)) {   $x1  = $Item;  }else{$x1  = $_SESSION['caja_rendida_items'][$_GET['editRendicion']]['Item'];}
				if(isset($Valor)) {  $x2  = $Valor; }else{$x2  = $_SESSION['caja_rendida_items'][$_GET['editRendicion']]['Valor'];}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text('Item','Item', $x1, 2);
				$Form_Imputs->form_input_number('Valor Total Neto', 'Valor', $x2, 2);
				
				$Form_Imputs->form_input_hidden('oldItemID', $_GET['editRendicion'], 2);
				?>
				
			  
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit_item"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['addRendicion']) ) { ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Agregar Rendicion</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Item)) {   $x1  = $Item;   }else{$x1  = '';}
				if(isset($Valor)) {  $x2  = $Valor;  }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text('Item','Item', $x1, 2);
				$Form_Imputs->form_input_number('Monto', 'Valor', $x2, 2);
				
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_item"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['editMonto']) ) { ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Editar Forma Egreso Dinero</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idDocPago)) {  $x1  = $idDocPago;  }else{$x1  = $_SESSION['caja_rendida_documentos'][$_GET['editMonto']]['idDocPago'];}
				if(isset($N_Doc)) {      $x2  = $N_Doc;      }else{$x2  = $_SESSION['caja_rendida_documentos'][$_GET['editMonto']]['N_Doc'];}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_filter('Documento','idDocPago', $x1, 2, 'idDocPago', 'Nombre', 'sistema_documentos_pago', 0, '', $dbConn);
				$Form_Imputs->form_input_number('Numero de Documento', 'N_Doc', $x2, 1);
				
				$Form_Imputs->form_input_hidden('oldItemID', $_GET['editMonto'], 2);
				?>
				
			  
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit_monto"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['addMonto']) ) { ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Forma Egreso Dinero</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idDocPago)) {   $x1  = $idDocPago;  }else{$x1  = '';}
				if(isset($N_Doc)) {       $x2  = $N_Doc;      }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_filter('Documento','idDocPago', $x1, 2, 'idDocPago', 'Nombre', 'sistema_documentos_pago', 0, '', $dbConn);
				$Form_Imputs->form_input_number('Numero de Documento', 'N_Doc', $x2, 1);
				
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_monto"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['modBase']) ) { 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$z = "caja_chica_listado.idSistema>=0";
	$w = "caja_chica_facturacion.idTipo=2 AND caja_chica_facturacion.idEstado=1";
	$x = "idSistema>=0 AND idEstado=1";
}else{
	$z = "caja_chica_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND usuarios_cajas_chicas.idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']}";
	$w = "caja_chica_facturacion.idTipo=2 AND caja_chica_facturacion.idEstado=1";	
	$x = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";	
}
?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificar datos basicos de la Rendicion</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idCajaChica)) {      $x1  = $idCajaChica;     }else{$x1  = $_SESSION['caja_rendida_basicos']['idCajaChica'];}
				if(isset($Creacion_fecha)) {   $x2  = $Creacion_fecha;  }else{$x2  = $_SESSION['caja_rendida_basicos']['Creacion_fecha'];}
				if(isset($idTrabajador)) {     $x3  = $idTrabajador;    }else{$x3  = $_SESSION['caja_rendida_basicos']['idTrabajador'];}
				if(isset($idSolicitado)) {     $x4  = $idSolicitado;    }else{$x4  = $_SESSION['caja_rendida_basicos']['idSolicitado'];}
				if(isset($idRevisado)) {       $x5  = $idRevisado;      }else{$x5  = $_SESSION['caja_rendida_basicos']['idRevisado'];}
				if(isset($idAprobado)) {       $x6  = $idAprobado;      }else{$x6  = $_SESSION['caja_rendida_basicos']['idAprobado'];}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_join_filter('Caja origen','idCajaChica', $x1, 2, 'idCajaChica', 'Nombre', 'caja_chica_listado', 'usuarios_cajas_chicas', $z, $dbConn);
				$Form_Imputs->form_date('Fecha Rendicion','Creacion_fecha', $x2, 2);
				$Form_Imputs->form_select_filter('Trabajador Asignado','idTrabajador', $x3, 2, 'idTrabajador', 'Rut,Nombre,ApellidoPat,ApellidoMat', 'trabajadores_listado', $x, '', $dbConn);
				$Form_Imputs->form_select_filter('Solicitado Por','idSolicitado', $x4, 2, 'idTrabajador', 'Rut,Nombre,ApellidoPat,ApellidoMat', 'trabajadores_listado', $x, '', $dbConn);
				$Form_Imputs->form_select_filter('Revisado Por','idRevisado', $x5, 2, 'idTrabajador', 'Rut,Nombre,ApellidoPat,ApellidoMat', 'trabajadores_listado', $x, '', $dbConn);
				$Form_Imputs->form_select_filter('Aprobado Por','idAprobado', $x6, 2, 'idTrabajador', 'Rut,Nombre,ApellidoPat,ApellidoMat', 'trabajadores_listado', $x, '', $dbConn);
				
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Imputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Imputs->form_input_hidden('idTipo', 1, 2);			
				$Form_Imputs->form_input_hidden('idEstado', 2, 2);	
				$Form_Imputs->form_input_hidden('fecha_auto', fecha_actual(), 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_modBase"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['view']) ) { 
$Form_Imputs = new Inputs();
?>


<div class="col-sm-12 fcenter" style="margin-bottom:30px">

	<?php 		
	$ubicacion = $location.'&view=true&rendida_Caja=true';
	$dialogo   = '¿Realmente desea ingresar el documento, una vez realizada no podra realizar cambios?';?>
	<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-primary fright margin_width" ><i class="fa fa-check-square-o" aria-hidden="true"></i> Ingresar Documento</a>			

	<a href="<?php echo $location; ?>"  class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>

	<?php 
	$ubicacion = $location.'&clear_all=true';
	$dialogo   = '¿Realmente deseas eliminar todos los registros?';?>
	<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger fright margin_width dialogBox"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar Todo</a>

	<div class="clearfix"></div>
</div> 

<div class="col-sm-12 fcenter">

	<div id="page-wrap">
		<div id="header"> <?php echo $_SESSION['caja_rendida_basicos']['TipoDocumento']; ?></div>
	   

		
		<div id="customer">
			
			<table id="meta" class="fleft otdata">
				<tbody>
					<tr>
						<td class="meta-head"><strong>DATOS BASICOS</strong></td>
						<td class="meta-head"><a href="<?php echo $location.'&modBase=true' ?>" title="Modificar Datos Basicos" class="btn btn-xs btn-primary tooltip fright" style="position: initial;"><i class="fa fa-pencil-square-o"></i> Modificar</a></td>
					</tr>
					<tr>
						<td class="meta-head">Caja Chica</td>
						<td><?php echo $_SESSION['caja_rendida_basicos']['Caja']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Trabajador</td>
						<td><?php echo $_SESSION['caja_rendida_basicos']['Trab_Nombre']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Rut</td>
						<td><?php echo $_SESSION['caja_rendida_basicos']['Trab_Rut']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Cargo</td>
						<td><?php echo $_SESSION['caja_rendida_basicos']['Trab_Cargo']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Fono</td>
						<td><?php echo $_SESSION['caja_rendida_basicos']['Trab_Fono']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Solicitado Por</td>
						<td><?php echo $_SESSION['caja_rendida_basicos']['Soli_Nombre']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Revisado Por</td>
						<td><?php echo $_SESSION['caja_rendida_basicos']['Rev_Nombre']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Aprobado Por</td>
						<td><?php echo $_SESSION['caja_rendida_basicos']['Apro_Nombre']; ?></td>
					</tr>
					
					
					
					
					
				</tbody>
			</table>
			<table id="meta" class="otdata2">
				<tbody>
					<tr>
						<td class="meta-head">Fecha Creacion</td>
						<td colspan="2"><?php echo Fecha_estandar($_SESSION['caja_rendida_basicos']['Creacion_fecha'])?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<table id="items">
			<tbody>
				
				<tr>
					<th colspan="5">Detalle</th>
					<th width="160">Acciones</th>
				</tr>		  
				
				<tr class="item-row fact_tittle">
					<td colspan="5">Rendiciones</td>
					<td>
						<a href="<?php echo $location.'&addRendicion=true' ?>" title="Agregar Rendicion" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Rendicion</a>
					</td>
				</tr>
				<?php 
				$vtotal = 0;
				if (isset($_SESSION['caja_rendida_items'])){
					//recorro el lsiatdo entregado por la base de datos
					foreach ($_SESSION['caja_rendida_items'] as $key => $producto){ ?>
						<tr class="item-row linea_punteada">
							<td class="item-name" colspan="4"><?php echo $producto['Item'];?></td>
							<td class="item-name" align="right">
								<?php 
								$vtotal = $vtotal + $producto['Valor'];
								echo 'Total '.Valores(Cantidades_decimales_justos($producto['Valor']), 0);?>
							</td>
							<td>
								<div class="btn-group" style="width: 70px;" >
									<a href="<?php echo $location.'&editRendicion='.$producto['bvar']; ?>" title="Editar Rendicion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
									<?php 
									$ubicacion = $location.'&del_item='.$producto['bvar'];
									$dialogo   = '¿Realmente deseas eliminar el Rendicion '.str_replace('"','',$producto['Item']).'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Rendicion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>								
								</div>
							</td>
						</tr> 
					<?php 
					}
				}
				echo '<tr id="hiderow"><td colspan="6"></td></tr>';?>
				
				
				<tr class="item-row fact_tittle">
					<td colspan="5">Forma Egreso Dinero</td>
					<td>
						<?php
						$n = 0;
						if (isset($_SESSION['caja_rendida_documentos'])){
							foreach ($_SESSION['caja_rendida_documentos'] as $key => $producto){
								$n++;
							}
						}
						//solo si no hay formas de egreso
						if($n==0){ ?>
							<a href="<?php echo $location.'&addMonto=true' ?>" title="Agregar Forma Egreso" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Forma Egreso</a>
						<?php } ?>
					</td>
				</tr>
				<?php 
				if (isset($_SESSION['caja_rendida_documentos'])){
					foreach ($_SESSION['caja_rendida_documentos'] as $key => $producto){ ?>
						<tr class="item-row linea_punteada">
							<td class="item-name" colspan="5">
								<?php 
								echo $producto['DocPago'];
								if(isset($producto['N_Doc'])&&$producto['N_Doc']!=''){
									echo ' N°'.$producto['N_Doc'];
								}
								?>
							</td>
							<td>
								<div class="btn-group" style="width: 70px;" >
									<a href="<?php echo $location.'&editMonto='.$producto['bvar']; ?>" title="Editar Devolucion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
									<?php 
									$ubicacion = $location.'&del_monto='.$producto['bvar'];
									$dialogo   = '¿Realmente deseas eliminar la devolucion de dinero '.str_replace('"','',$producto['DocPago']).'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Devolucion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>								
								</div>
							</td>
						</tr> 
					  <?php
					}
				}
				echo '<tr id="hiderow"><td colspan="6"><a name="Ancla_obs"></a></td></tr>';?>
				

				
				<tr class="invoice-total" bgcolor="#f1f1f1">
					<td colspan="4" align="right"> <strong>Total</strong></td>    
					<td align="right"><?php echo Valores($vtotal, 0);$_SESSION['caja_rendida_basicos']['Valor'] = $vtotal;?></td>
					<td></td>
				</tr>
					
					
				
				<tr>
					<?php if(isset($_SESSION['caja_rendida_basicos']['Observaciones'])&&$_SESSION['caja_rendida_basicos']['Observaciones']!=''){ ?>
					
						<td colspan="5" class="blank word_break"> 
							<?php echo $_SESSION['caja_rendida_basicos']['Observaciones'];?>
						</td>
						<td class="blank">
							<div class="btn-group" style="width: 35px;" >
								<?php 
								$ubicacion = $location.'&view=true&del_obs=true';
								$dialogo   = '¿Realmente deseas eliminar la observacion?';?>
								<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>							
							</div>
						</td>
					
					<?php }else{?>
						<td colspan="5" class="blank"> 
							<?php 
							$non = '';
							if(isset($_SESSION['caja_rendida_temporal'])&&$_SESSION['caja_rendida_temporal']!=''){
								$non = $_SESSION['caja_rendida_temporal'];
							}	
								
							$Form_Imputs->input_textarea_obs('Observaciones','Observaciones', 1,'width:100%; height: 200px;', $non);?>
						</td>
						<td class="blank">
							<div class="btn-group" style="width: 35px;" >
								<?php $ubicacion=$location.'&view=true&add_obs=true';?>			
								<a onclick="add_obs('<?php echo $ubicacion ?>')" title="Agregar Observacion" class="btn btn-primary btn-sm tooltip"><i class="fa fa-check-square-o"></i></a>
							</div>
						</td>
						
					<?php }?>	
					
					
				</tr>
				<tr><td colspan="6" class="blank"><p>Observaciones</p></td></tr>
				
						
							
				
			</tbody>
		</table>
    </div>

	<table id="items" style="margin-bottom: 20px;">
        <tbody>
            
			<tr class="invoice-total" bgcolor="#f1f1f1">
                <td colspan="5">Archivos Adjuntos</td>
                <td width="160"><a href="<?php echo $location.'&addFile=true' ?>" title="Agregar Archivo" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Archivos</a></td>
            </tr>		  
            
			<?php 
			if (isset($_SESSION['caja_rendida_archivos'])){
				//recorro el lsiatdo entregado por la base de datos
				$numeral = 1;
				foreach ($_SESSION['caja_rendida_archivos'] as $key => $producto){?>
					<tr class="item-row">
						<td colspan="5"><?php echo $numeral.' - '.$producto['Nombre']; ?></td>
						<td>
							<div class="btn-group" style="width: 70px;" >
								<a href="<?php echo 'view_doc_preview.php?path=upload&file='.$producto['Nombre']; ?>" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye"></i></a>
								<?php 
								$ubicacion = $location.'&del_file='.$producto['idFile'];
								$dialogo   = '¿Realmente deseas eliminar  '.str_replace('"','',$producto['Nombre']).'?';?>
								<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Archivo" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>								
							</div>
						</td>
					</tr>
					 
				 <?php 
				$numeral++;	
				}
			}?>

		</tbody>
    </table>

</div>

<?php widget_modal(80, 95); ?>
<div class="clearfix"></div>


<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$z = "caja_chica_listado.idSistema>=0";
	$w = "caja_chica_facturacion.idTipo=2 AND caja_chica_facturacion.idEstado=1";
	$x = "idSistema>=0 AND idEstado=1";
}else{
	$z = "caja_chica_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND usuarios_cajas_chicas.idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']}";	
	$w = "caja_chica_facturacion.idTipo=2 AND caja_chica_facturacion.idEstado=1";	
	$x = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";	
} ?>
 <div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Ingresar Nueva Caja Rendida</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idCajaChica)) {                $x1  = $idCajaChica;              }else{$x1  = '';}
				if(isset($Creacion_fecha)) {             $x2  = $Creacion_fecha;           }else{$x2  = '';}
				if(isset($idTrabajador)) {               $x3  = $idTrabajador;             }else{$x3  = '';}
				if(isset($Observaciones)) {              $x4  = $Observaciones;            }else{$x4  = '';}
				if(isset($idSolicitado)) {               $x5  = $idSolicitado;             }else{$x5  = '';}
				if(isset($idRevisado)) {                 $x6  = $idRevisado;               }else{$x6  = '';}
				if(isset($idAprobado)) {                 $x7  = $idAprobado;               }else{$x7  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_join_filter('Caja origen','idCajaChica', $x1, 2, 'idCajaChica', 'Nombre', 'caja_chica_listado', 'usuarios_cajas_chicas', $z, $dbConn);
				$Form_Imputs->form_date('Fecha Rendicion','Creacion_fecha', $x2, 2);
				$Form_Imputs->form_select_filter('Trabajador Asignado','idTrabajador', $x3, 2, 'idTrabajador', 'Rut,Nombre,ApellidoPat,ApellidoMat', 'trabajadores_listado', $x, '', $dbConn);
				$Form_Imputs->form_textarea('Observaciones','Observaciones', $x4, 1, 160);
				$Form_Imputs->form_select_filter('Solicitado Por','idSolicitado', $x5, 2, 'idTrabajador', 'Rut,Nombre,ApellidoPat,ApellidoMat', 'trabajadores_listado', $x, '', $dbConn);
				$Form_Imputs->form_select_filter('Revisado Por','idRevisado', $x6, 2, 'idTrabajador', 'Rut,Nombre,ApellidoPat,ApellidoMat', 'trabajadores_listado', $x, '', $dbConn);
				$Form_Imputs->form_select_filter('Aprobado Por','idAprobado', $x7, 2, 'idTrabajador', 'Rut,Nombre,ApellidoPat,ApellidoMat', 'trabajadores_listado', $x, '', $dbConn);
				
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Imputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Imputs->form_input_hidden('idTipo', 3, 2);
				$Form_Imputs->form_input_hidden('idEstado', 2, 2);	
				$Form_Imputs->form_input_hidden('fecha_auto', fecha_actual(), 2);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf046; Crear Documento" name="submit">
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
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'fecha_asc':    $order_by = 'ORDER BY caja_chica_facturacion.Creacion_fecha ASC ';  $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente';break;
		case 'fecha_desc':   $order_by = 'ORDER BY caja_chica_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;
		case 'caja_asc':     $order_by = 'ORDER BY caja_chica_listado.Nombre ASC ';              $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Caja Ascendente'; break;
		case 'caja_desc':    $order_by = 'ORDER BY caja_chica_listado.Nombre DESC ';             $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Caja Descendente';break;
		case 'monto_asc':    $order_by = 'ORDER BY caja_chica_facturacion.Valor ASC ';           $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Monto Ascendente';break;
		case 'monto_desc':   $order_by = 'ORDER BY caja_chica_facturacion.Valor DESC ';          $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Monto Descendente';break;
		
		default: $order_by = 'ORDER BY caja_chica_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
	}
}else{
	$order_by = 'ORDER BY caja_chica_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
}
/**********************************************************/
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$y="caja_chica_listado.idSistema>=0";
}else{
	$y="caja_chica_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND usuarios_cajas_chicas.idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']}";		
}
/**********************************************************/
//Variable con la ubicacion
$z="WHERE caja_chica_facturacion.idTipo=3";//Solo rendiciones
//Verifico el tipo de usuario que esta ingresando
$z.=" AND caja_chica_facturacion.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	

/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idCajaChica']) && $_GET['idCajaChica'] != ''){        $z .= " AND caja_chica_facturacion.idCajaChica=".$_GET['idCajaChica'];}
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha'] != ''){  $z .= " AND caja_chica_facturacion.Creacion_fecha='".$_GET['Creacion_fecha']."'";}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idFacturacion FROM `caja_chica_facturacion` ".$z;
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
caja_chica_facturacion.idFacturacion,
caja_chica_facturacion.idFacturacionRelacionada,
caja_chica_facturacion.Creacion_fecha,
caja_chica_listado.Nombre AS Caja,
core_sistemas.Nombre AS Sistema,
caja_chica_facturacion.Valor

FROM `caja_chica_facturacion`
LEFT JOIN `caja_chica_listado`   ON caja_chica_listado.idCajaChica   = caja_chica_facturacion.idCajaChica
LEFT JOIN `core_sistemas`        ON core_sistemas.idSistema          = caja_chica_facturacion.idSistema
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
}?>


<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){
	if (isset($_SESSION['caja_rendida_basicos']['idCajaChica'])&&$_SESSION['caja_rendida_basicos']['idCajaChica']!=''){?>
		
		<?php 
		$ubicacion = $location.'&clear_all=true';
		$dialogo   = '¿Realmente deseas eliminar todos los registros?';?>
		<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar</a>
		
		<a href="<?php echo $location; ?>&view=true" class="btn btn-default fright margin_width" ><i class="fa fa-arrow-right" aria-hidden="true"></i> Continuar Ingreso</a>
	<?php }else{?>
		<a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Ingresar Nueva Caja Rendida</a>
	<?php }
	 }?>
</div> 
<div class="clearfix"></div>                      
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($idCajaChica)) {      $x1  = $idCajaChica;    }else{$x1  = '';}
				if(isset($Creacion_fecha)) {   $x2  = $Creacion_fecha; }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_join_filter('Caja Chica','idCajaChica', $x1, 1, 'idCajaChica', 'Nombre', 'caja_chica_listado', 'usuarios_cajas_chicas', $y, $dbConn);
				$Form_Imputs->form_date('Fecha Rendicion','Creacion_fecha', $x2, 1);
				
				$Form_Imputs->form_input_hidden('pagina', $_GET['pagina'], 1);
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
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Cajas Rendidas</h5>
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
							<div class="pull-left">Fecha</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fecha_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=fecha_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Caja</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=caja_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=caja_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Monto</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=monto_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=monto_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Doc Relacionado</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=facrel_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=facrel_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
								  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrTipo as $tipo) { ?>
					<tr class="odd">
						<td><?php echo Fecha_estandar($tipo['Creacion_fecha']); ?></td>
						<td><?php echo $tipo['Caja']; ?></td>
						<td><?php echo Valores($tipo['Valor'], 0); ?></td>
						<td><?php echo n_doc($tipo['idFacturacionRelacionada'], 8); ?></td>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $tipo['Sistema']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 35px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_mov_caja_chica.php?view='.$tipo['idFacturacion']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a><?php } ?>
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
