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
$original = "boleta_honorario_ingreso.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idTrabajador']) && $_GET['idTrabajador'] != ''){       $location .= "&idTrabajador=".$_GET['idTrabajador'];       $search .= "&idTrabajador=".$_GET['idTrabajador'];}
if(isset($_GET['N_Doc']) && $_GET['N_Doc'] != ''){                     $location .= "&N_Doc=".$_GET['N_Doc'];                     $search .= "&N_Doc=".$_GET['N_Doc'];}
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha'] != ''){   $location .= "&Creacion_fecha=".$_GET['Creacion_fecha'];   $search .= "&Creacion_fecha=".$_GET['Creacion_fecha'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_ingreso';
	require_once 'A1XRXS_sys/xrxs_form/z_boleta_honorario.php';
}
//formulario para editar
if ( !empty($_POST['submit_modBase']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'modBase_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_boleta_honorario.php';
}
//formulario para editar
if ( !empty($_GET['clear_all']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'clear_all_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_boleta_honorario.php';
}
/**********************************************/
//formulario para crear
if ( !empty($_POST['submit_servicios']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_servicio_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_boleta_honorario.php';
}
//formulario para crear
if ( !empty($_POST['submit_edit_servicios']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'edit_servicio_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_boleta_honorario.php';
}
//se borra un dato
if ( !empty($_GET['del_servicios']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_servicio_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_boleta_honorario.php';	
}
/**********************************************/
//formulario para crear
if ( !empty($_POST['submit_file']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_file_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_boleta_honorario.php';
}
//se borra un dato
if ( !empty($_GET['del_file']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_file_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_boleta_honorario.php';	
}
/**********************************************/
if ( !empty($_GET['ing_bodega']) )     {
	//Llamamos al formulario
	$form_trabajo= 'ing_bodega';
	require_once 'A1XRXS_sys/xrxs_form/z_boleta_honorario.php';	
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_boleta';
	require_once 'A1XRXS_sys/xrxs_form/z_boleta_honorario.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Boleta de Honorarios Realizada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Boleta de Honorarios Modificada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Boleta de Honorarios borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['addFile']) ) { ?>
 
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Subir Archivo</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate enctype="multipart/form-data">
			
				<?php           
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_multiple_upload('Seleccionar archivo','exFile', 1, '"jpg", "png", "gif", "jpeg", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "pdf"');
					
				?> 

				<div class="form-group">
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_file"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>              
		</div>
	</div>
</div>	

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['editOtros']) ) {  ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Editar Servicios</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {  $x1  = $Nombre;  }else{$x1  = $_SESSION['boleta_ing_servicios'][$_GET['editOtros']]['Nombre'];}
				if(isset($vTotal)) {  $x2  = $vTotal;  }else{$x2  = Cantidades_decimales_justos($_SESSION['boleta_ing_servicios'][$_GET['editOtros']]['vTotal']);}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_textarea('Descripcion','Nombre', $x1, 2, 160);
				//Si existe la OC valor no se modifica
				if(isset($_SESSION['boleta_ing_servicios'][$_GET['editOtros']]['idExistencia'])&&$_SESSION['boleta_ing_servicios'][$_GET['editOtros']]['idExistencia']!=''){
					$Form_Inputs->form_input_disabled('Valor Total Neto','vTotal_fake', $x2, 1);
				}else{
					$Form_Inputs->form_input_number('Valor Total Neto', 'vTotal', $x2, 2);
				}
				
				$Form_Inputs->form_input_hidden('oldidProducto', $_SESSION['boleta_ing_servicios'][$_GET['editOtros']]['idServicio'], 2);
				
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit_servicios"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>                
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['addServicio']) ) {  ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Agregar Servicios</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {  $x1  = $Nombre;  }else{$x1  = '';}
				if(isset($vTotal)) {  $x2  = $vTotal;  }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_textarea('Descripcion','Nombre', $x1, 2, 160);
				$Form_Inputs->form_input_number('Valor Total Neto', 'vTotal', $x2, 2);
				

				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_servicios"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>                
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['modBase']) ) { 
//Verifico el tipo de usuario que esta ingresando
$w="idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";
?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Modificar datos basicos del Ingreso</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idTrabajador)) {       $x1  = $idTrabajador;     }else{$x1  = $_SESSION['boleta_ing_basicos']['idTrabajador'];}
				if(isset($N_Doc)) {              $x2  = $N_Doc;            }else{$x2  = $_SESSION['boleta_ing_basicos']['N_Doc'];}
				if(isset($Creacion_fecha)) {     $x3  = $Creacion_fecha;   }else{$x3  = $_SESSION['boleta_ing_basicos']['Creacion_fecha'];}
				if(isset($Observaciones)) {      $x4  = $Observaciones;    }else{$x4  = $_SESSION['boleta_ing_basicos']['Observaciones'];}
				if(isset($idOcompra)) {          $x5  = $idOcompra;        }else{$x5  = $_SESSION['boleta_ing_basicos']['idOcompra'];}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Trabajador','idTrabajador', $x1, 2, 'idTrabajador', 'Rut,Nombre,ApellidoPat,ApellidoMat', 'trabajadores_listado', $w, '', $dbConn);
				$Form_Inputs->form_input_number('Numero de Documento', 'N_Doc', $x2, 2);
				$Form_Inputs->form_date('Fecha Documento','Creacion_fecha', $x3, 2);
				$Form_Inputs->form_textarea('Observaciones','Observaciones', $x4, 1, 160);
				$Form_Inputs->form_input_number('Numero Orden Compra', 'idOcompra', $x5, 1);

				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Inputs->form_input_hidden('idTipo', 1, 2);
				$Form_Inputs->form_input_hidden('fecha_auto', fecha_actual(), 2);
				$Form_Inputs->form_input_hidden('idEstado', 1, 2);
				?> 

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_modBase"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['view']) ) { 
$Form_Inputs = new Inputs();
?>

 
<div class="col-sm-12" style="margin-bottom:30px">

	<?php 		
	$ubicacion = $location.'&view=true&ing_bodega=true';
	$dialogo   = '¿Realmente desea ingresar el documento, una vez realizada no podra realizar cambios?<br/>Revise si los <strong>montos</strong> y <strong>cantidades</strong> coinciden con el documento ingresado.';?>
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
		<div id="header"> <?php echo $_SESSION['boleta_ing_basicos']['TipoDocumento']; ?></div>

		
		<div id="customer">
			
			<table id="meta" class="fleft otdata">
				<tbody>
					<tr>
						<td class="meta-head"><strong>DATOS BASICOS</strong></td>
						<td class="meta-head"><a href="<?php echo $location.'&modBase=true' ?>" title="Modificar Datos Basicos" class="btn btn-xs btn-primary tooltip fright" style="position: initial;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar</a></td>
					</tr>
					<tr>
						<td class="meta-head">Trabajador</td>
						<td><?php echo $_SESSION['boleta_ing_basicos']['Trabajador']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Centro de Costo</td>
						<td><?php echo $_SESSION['boleta_ing_basicos']['CentroCosto']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Boleta N°</td>
						<td><?php echo n_doc($_SESSION['boleta_ing_basicos']['N_Doc'], 5) ?></td>
					</tr>
					<?php if(isset($_SESSION['boleta_ing_basicos']['idOcompra'])&&$_SESSION['boleta_ing_basicos']['idOcompra']!=''){ ?>
						<tr>
							<td class="meta-head">Orden Compra N°</td>
							<td><?php echo n_doc($_SESSION['boleta_ing_basicos']['idOcompra'], 5) ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<table id="meta" class="otdata2">
				<tbody>
					<tr>
						<td class="meta-head">Fecha Creacion</td>
						<td colspan="2"><?php echo Fecha_estandar($_SESSION['boleta_ing_basicos']['Creacion_fecha'])?></td>
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
					<td colspan="5">Servicios a Ingresar</td>
					<td><a href="<?php echo $location.'&addServicio=true' ?>" title="Agregar Servicio" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Servicio</a></td>
				</tr>
				<?php
				//Variables
				$vtotal_neto = 0;
				
				//listado de servicios
				if (isset($_SESSION['boleta_ing_servicios'])){
					//recorro el lsiatdo entregado por la base de datos
					foreach ($_SESSION['boleta_ing_servicios'] as $key => $producto){
						$vtotal_neto = $vtotal_neto + $producto['vTotal'];?>
						<tr class="item-row linea_punteada">
							<td class="item-name" colspan="4"><?php echo $producto['Nombre'];?></td>
							<td class="item-name" align="right">
								<?php echo valores($producto['vTotal'], 0);?>
							</td>
							<td>
								<div class="btn-group" style="width: 70px;" >
									<a href="<?php echo $location.'&editOtros='.$producto['idServicio']; ?>" title="Editar Servicio" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
									<?php 
									$ubicacion = $location.'&del_servicios='.$producto['idServicio'];
									$dialogo   = '¿Realmente deseas eliminar  '.$producto['Nombre'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Servicio" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>								
								</div>
							</td>
						</tr> 
					 <?php 	
					}
				}
				echo '<tr id="hiderow"><td colspan="6"><a name="Ancla_obs"></a></td></tr>';?>
				
				
		
				<?php
				//Calculo totales
				$_SESSION['boleta_ing_basicos']['valor_neto']   = $vtotal_neto;
				$_SESSION['boleta_ing_basicos']['valor_imp']    = $vtotal_neto * ($_SESSION['boleta_ing_basicos']['Porc_Impuesto']/100);
				$_SESSION['boleta_ing_basicos']['valor_total']  = $vtotal_neto - ($vtotal_neto * ($_SESSION['boleta_ing_basicos']['Porc_Impuesto']/100));
				?>
					<tr class="invoice-total" bgcolor="#f1f1f1">
						<td colspan="4" align="right"><strong>Total Honorarios</strong></td> 
						<td align="right"><?php echo Valores($_SESSION['boleta_ing_basicos']['valor_neto'], 0);?></td>
						<td></td>
					</tr>
					<tr class="invoice-total" bgcolor="#f1f1f1">
						<td colspan="4" align="right"><strong><?php echo $_SESSION['boleta_ing_basicos']['Porc_Impuesto'].'%'; ?> Impuesto Retenido</strong></td> 
						<td align="right"><?php echo Valores($_SESSION['boleta_ing_basicos']['valor_imp'], 0);?></td>
						<td></td>
					</tr>
					<tr class="invoice-total" bgcolor="#f1f1f1">
						<td colspan="4" align="right"> <strong>Total</strong></td>    
						<td align="right"><?php echo Valores($_SESSION['boleta_ing_basicos']['valor_total'], 0);?></td>
						<td></td>
					</tr>
							
				
			</tbody>
		</table>
    </div>
    
    <div class="row">
		<div class="col-xs-12">
			<p class="lead"><a name="Ancla_obs"></a>Observaciones:</p>
			<p class="text-muted well well-sm no-shadow" ><?php echo $_SESSION['boleta_ing_basicos']['Observaciones'];?></p>
		</div>
	</div>
    
    <table id="items" style="margin-bottom: 20px;">
        <tbody>
            
			<tr class="invoice-total" bgcolor="#f1f1f1">
                <td colspan="5">Archivos Adjuntos</td>
                <td width="160"><a href="<?php echo $location.'&addFile=true' ?>" title="Agregar Archivo" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Archivos</a></td>
            </tr>		  
            
			<?php 
			if (isset($_SESSION['boleta_ing_archivos'])){
				//recorro el lsiatdo entregado por la base de datos
				$numeral = 1;
				foreach ($_SESSION['boleta_ing_archivos'] as $key => $producto){?>
					<tr class="item-row">
						<td colspan="5"><?php echo $numeral.' - '.$producto['Nombre']; ?></td>
						<td>
							<div class="btn-group" style="width: 70px;" >
								<a href="<?php echo 'view_doc_preview.php?path='.simpleEncode('upload', fecha_actual()).'&file='.simpleEncode($producto['Nombre'], fecha_actual()); ?>" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a>
								<?php 
								$ubicacion = $location.'&del_file='.$producto['idFile'];
								$dialogo   = '¿Realmente deseas eliminar  '.str_replace('"','',$producto['Nombre']).'?';?>
								<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Archivo" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>								
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
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn);
//se crea filtro
//Verifico el tipo de usuario que esta ingresando
$w = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";
?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Ingresar Boleta Honorarios</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idTrabajador)) {       $x1  = $idTrabajador;     }else{$x1  = '';}
				if(isset($N_Doc)) {              $x2  = $N_Doc;            }else{$x2  = '';}
				if(isset($Creacion_fecha)) {     $x3  = $Creacion_fecha;   }else{$x3  = '';}
				if(isset($Observaciones)) {      $x4  = $Observaciones;    }else{$x4  = '';}
				if(isset($idOcompra)) {          $x5  = $idOcompra;        }else{$x5  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Trabajador','idTrabajador', $x1, 2, 'idTrabajador', 'Rut,Nombre,ApellidoPat,ApellidoMat', 'trabajadores_listado', $w, '', $dbConn);
				$Form_Inputs->form_input_number('Numero de Documento', 'N_Doc', $x2, 2);
				$Form_Inputs->form_date('Fecha Documento','Creacion_fecha', $x3, 2);
				$Form_Inputs->form_textarea('Observaciones','Observaciones', $x4, 1, 160);
				$Form_Inputs->form_input_number('Numero Orden Compra', 'idOcompra', $x5, 1);
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Inputs->form_input_hidden('idTipo', 1, 2);
				$Form_Inputs->form_input_hidden('fecha_auto', fecha_actual(), 2);
				$Form_Inputs->form_input_hidden('idEstado', 1, 2);
						
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf046; Crear Documento" name="submit">
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
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
		case 'Trabajador_asc':  $order_by = 'ORDER BY trabajadores_listado.Nombre ASC ';                       $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Trabajador Ascendente'; break;
		case 'Trabajador_desc': $order_by = 'ORDER BY trabajadores_listado.Nombre DESC ';                      $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Trabajador Descendente';break;
		case 'fecha_asc':       $order_by = 'ORDER BY boleta_honorarios_facturacion.Creacion_fecha ASC ';      $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente';break;
		case 'fecha_desc':      $order_by = 'ORDER BY boleta_honorarios_facturacion.Creacion_fecha DESC ';     $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;
		case 'doc_asc':         $order_by = 'ORDER BY boleta_honorarios_facturacion.N_Doc ASC ';               $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Tipo Documento Ascendente';break;
		case 'doc_desc':        $order_by = 'ORDER BY boleta_honorarios_facturacion.N_Doc DESC ';              $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Tipo Documento Descendente';break;
		case 'valor_asc':       $order_by = 'ORDER BY boleta_honorarios_facturacion.ValorTotal ASC ';          $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Valor Ascendente';break;
		case 'valor_desc':      $order_by = 'ORDER BY boleta_honorarios_facturacion.ValorTotal DESC ';         $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Valor Descendente';break;
		
		default: $order_by = 'ORDER BY boleta_honorarios_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
	}
}else{
	$order_by = 'ORDER BY boleta_honorarios_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
}
/**********************************************************/
//Variable con la ubicacion
$z="WHERE boleta_honorarios_facturacion.idTipo=1";//Solo ingresos
//Verifico el tipo de usuario que esta ingresando
$z.=" AND boleta_honorarios_facturacion.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
$w = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";	

/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idTrabajador']) && $_GET['idTrabajador'] != ''){      $z .= " AND boleta_honorarios_facturacion.idTrabajador=".$_GET['idTrabajador'];}
if(isset($_GET['N_Doc']) && $_GET['N_Doc'] != ''){                    $z .= " AND boleta_honorarios_facturacion.N_Doc LIKE '%".$_GET['N_Doc']."%'";}
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha'] != ''){  $z .= " AND boleta_honorarios_facturacion.Creacion_fecha='".$_GET['Creacion_fecha']."'";}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idFacturacion FROM `boleta_honorarios_facturacion` 
LEFT JOIN `core_sistemas`           ON core_sistemas.idSistema             = boleta_honorarios_facturacion.idSistema
LEFT JOIN `trabajadores_listado`    ON trabajadores_listado.idTrabajador   = boleta_honorarios_facturacion.idTrabajador
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
$cuenta_registros = mysqli_num_rows($resultado);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los elementos
$arrTipo = array();
$query = "SELECT 
boleta_honorarios_facturacion.idFacturacion,
boleta_honorarios_facturacion.Creacion_fecha,
boleta_honorarios_facturacion.N_Doc,
boleta_honorarios_facturacion.ValorTotal,
core_sistemas.Nombre AS Sistema,
trabajadores_listado.Nombre AS TrabajadorNombre,
trabajadores_listado.ApellidoPat AS TrabajadorApellidoPat,
trabajadores_listado.ApellidoMat AS TrabajadorApellidoMat

FROM `boleta_honorarios_facturacion`
LEFT JOIN `core_sistemas`           ON core_sistemas.idSistema             = boleta_honorarios_facturacion.idSistema
LEFT JOIN `trabajadores_listado`    ON trabajadores_listado.idTrabajador   = boleta_honorarios_facturacion.idTrabajador
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
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){ ?>
		<?php if (isset($_SESSION['boleta_ing_basicos']['idTrabajador'])&&$_SESSION['boleta_ing_basicos']['idTrabajador']!=''){?>
			
			<?php 
			$ubicacion = $location.'&clear_all=true';
			$dialogo   = '¿Realmente deseas eliminar todos los registros?';?>
			<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar</a>
			
			<a href="<?php echo $location; ?>&view=true" class="btn btn-default fright margin_width" ><i class="fa fa-arrow-right" aria-hidden="true"></i> Continuar Boletas de Honorarios</a>
		<?php }else{ ?>
			<a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Ingresar Boletas de Honorarios</a>
		<?php } ?>
	<?php } ?>
</div>  
<div class="clearfix"></div>                    
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($idTrabajador)) {       $x1  = $idTrabajador;     }else{$x1  = '';}
				if(isset($N_Doc)) {              $x2  = $N_Doc;            }else{$x2  = '';}
				if(isset($Creacion_fecha)) {     $x3  = $Creacion_fecha;   }else{$x3  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Trabajador','idTrabajador', $x1, 1, 'idTrabajador', 'Rut,Nombre,ApellidoPat,ApellidoMat', 'trabajadores_listado', $w, '', $dbConn);
				$Form_Inputs->form_input_number('Numero de Documento', 'N_Doc', $x2, 1);
				$Form_Inputs->form_date('Fecha Documento','Creacion_fecha', $x3, 1);
				
				
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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Boletas de Honorarios</h5>
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
							<div class="pull-left">Trabajador</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=Trabajador_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=Trabajador_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Documento</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=doc_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=doc_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Fecha</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fecha_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=fecha_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Valor</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=valor_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=valor_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
								  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrTipo as $tipo) { ?>
					<tr class="odd">
						<td><?php echo $tipo['TrabajadorNombre'].' '.$tipo['TrabajadorApellidoPat'].' '.$tipo['TrabajadorApellidoMat']; ?></td>
						<td><?php echo 'Boleta N° '.$tipo['N_Doc']; ?></td>
						<td><?php echo Fecha_estandar($tipo['Creacion_fecha']); ?></td>
						<td align="right"><?php echo valores($tipo['ValorTotal'], 0); ?></td>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $tipo['Sistema']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 70px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_boleta_honorarios.php?view='.simpleEncode($tipo['idFacturacion'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.simpleEncode($tipo['idFacturacion'], fecha_actual());
									$dialogo   = '¿Realmente deseas eliminar la boleta de honorarios N° '.$tipo['N_Doc'].'?';?>
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
