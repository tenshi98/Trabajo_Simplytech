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
$original = "trabajadores_horas_extras_mensuales.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idTrabajador']) && $_GET['idTrabajador'] != ''){     $location .= "&idTrabajador=".$_GET['idTrabajador'];     $search .= "&idTrabajador=".$_GET['idTrabajador'];}
if(isset($_GET['N_Doc']) && $_GET['N_Doc'] != ''){                   $location .= "&N_Doc=".$_GET['N_Doc'];                   $search .= "&N_Doc=".$_GET['N_Doc'];}
if(isset($_GET['Observaciones']) && $_GET['Observaciones'] != ''){   $location .= "&Observaciones=".$_GET['Observaciones'];   $search .= "&Observaciones=".$_GET['Observaciones'];}
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
	require_once 'A1XRXS_sys/xrxs_form/z_trabajadores_horas_extras_mensuales.php';
}
//formulario para editar
if ( !empty($_POST['submit_modBase']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'modBase_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_trabajadores_horas_extras_mensuales.php';
}
//formulario para editar
if ( !empty($_GET['clear_all']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'clear_all_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_trabajadores_horas_extras_mensuales.php';
}
/**********************************************/
//formulario para crear
if ( !empty($_POST['submit_horas']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_horas_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_trabajadores_horas_extras_mensuales.php';
}
//formulario para crear
if ( !empty($_POST['submit_edit_horas']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'edit_horas_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_trabajadores_horas_extras_mensuales.php';
}
//se borra un dato
if ( !empty($_GET['del_horas']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_horas_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_trabajadores_horas_extras_mensuales.php';	
}
/**********************************************/
//se borra un dato
if ( !empty($_GET['add_obs']) )     {
	//Llamamos al formulario
	$form_trabajo= 'add_obs_ing_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_trabajadores_horas_extras_mensuales.php';	
}
//se borra un dato
if ( !empty($_GET['del_obs']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_obs_ing_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_trabajadores_horas_extras_mensuales.php';	
}
/**********************************************/
//formulario para crear
if ( !empty($_POST['submit_file']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_file_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_trabajadores_horas_extras_mensuales.php';
}
//se borra un dato
if ( !empty($_GET['del_file']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_file_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_trabajadores_horas_extras_mensuales.php';	
}
/**********************************************/
if ( !empty($_GET['ing_bodega']) )     {
	//Llamamos al formulario
	$form_trabajo= 'ing_bodega';
	require_once 'A1XRXS_sys/xrxs_form/z_trabajadores_horas_extras_mensuales.php';	
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
 } elseif ( ! empty($_GET['addHora']) ) {  
//Verifico el tipo de usuario que esta ingresando
$w = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";	 
?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Agregar Horas Extras</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($idTrabajador)) {      $x1   = $idTrabajador;      }else{$x1   = '';}
				if(isset($horas_dia)) {         $x2   = $horas_dia;         }else{$x2   = '';}
				if(isset($porcentaje_dia)) {    $x3   = $porcentaje_dia;    }else{$x3   = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_filter('Trabajador','idTrabajador', $x1, 2, 'idTrabajador', 'Rut,Nombre,ApellidoPat,ApellidoMat', 'trabajadores_listado', $w, '', $dbConn);
				$Form_Imputs->form_input_number('N° Horas ', 'horas_dia', $x2, 1);
				$Form_Imputs->form_select('Porcentaje Horas','porcentaje_dia', $x3, 1, 'idPorcentaje', 'Porcentaje', 'core_horas_extras_porcentajes', 0, '', $dbConn);
				
				$Form_Imputs->form_input_hidden('idMes', $_SESSION['horas_extras_mens_ing_basicos']['idMes'], 2);
				$Form_Imputs->form_input_hidden('Ano', $_SESSION['horas_extras_mens_ing_basicos']['Ano'], 2);
				
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_horas"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>                
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['modBase']) ) { ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificar datos basicos del Ingreso</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Creacion_fecha)) {  $x1  = $Creacion_fecha;     }else{$x1  = $_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha'];}
				if(isset($Ano)) {             $x2  = $Ano;                }else{$x2  = $_SESSION['horas_extras_mens_ing_basicos']['Ano'];}
				if(isset($idMes)) {           $x3  = $idMes;              }else{$x3  = $_SESSION['horas_extras_mens_ing_basicos']['idMes'];}
				if(isset($Observaciones)) {   $x4  = $Observaciones;      }else{$x4  = $_SESSION['horas_extras_mens_ing_basicos']['Observaciones'];}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_date('Fecha Facturacion','Creacion_fecha', $x1, 2);
				$Form_Imputs->form_select_n_auto('Año','Ano', $x2, 2, 2016, ano_actual());
				$Form_Imputs->form_select_filter('Mes','idMes', $x3, 2, 'idMes', 'Nombre', 'core_tiempo_meses', 0, 'ORDER BY idMes ASC', $dbConn);
				$Form_Imputs->form_textarea('Observaciones','Observaciones', $x4, 1, 160);
				
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);

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
	$ubicacion = $location.'&view=true&ing_bodega=true';
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
		<div id="header"> Ingreso Horas Extras</div>

		
		<div id="customer">
			
			<table id="meta" class="fleft otdata">
				<tbody>
					<tr>
						<td class="meta-head"><strong>DATOS BASICOS</strong></td>
						<td class="meta-head"><a href="<?php echo $location.'&modBase=true' ?>" title="Modificar Datos Basicos" class="btn btn-xs btn-primary tooltip fright" style="position: initial;"><i class="fa fa-pencil-square-o"></i> Modificar</a></td>
					</tr>
					<tr>
						<td class="meta-head">Periodo</td>
						<td><?php echo $_SESSION['horas_extras_mens_ing_basicos']['Ano'].' - '.numero_a_mes($_SESSION['horas_extras_mens_ing_basicos']['idMes']); ?></td>
					</tr>
				</tbody>
			</table>
			<table id="meta" class="otdata2">
				<tbody>
					<tr>
						<td class="meta-head">Fecha Facturacion</td>
						<td colspan="2"><?php echo Fecha_estandar($_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha'])?></td>
					</tr>
				</tbody>
			</table>

				
		</div>
		<table id="items">
			<tbody>
				
				<?php
				//cuento la cantidad de columnas a utilizar
				$data_column = 2;
				$arrColumnas = array();
				//verifico si existen horas
				if (isset($_SESSION['horas_extras_mens_ing_horas'])){
					//recorro las horas
					foreach ($_SESSION['horas_extras_mens_ing_horas'] as $key => $producto){
						foreach ($producto as $prod) {
							if(isset($prod['porcentaje_dia'])){
								$data_column++;
								$arrColumnas[$prod['porcentaje_dia']]['idPorcentaje']  = $prod['porcentaje_dia'];
								$arrColumnas[$prod['porcentaje_dia']]['Nombre']        = $prod['porcentaje_nombre'];
							}
							
						}
					}
				}
				//Ordenar las columnas de los porcentajes
				ksort($arrColumnas);
				
				echo '
				<tr>
					<th colspan="'.$data_column.'">Detalle</th>
					<th width="160">Acciones</th>
				</tr>';

				/***************************************************/
				echo '<tr class="item-row fact_tittle">';
				echo '<td>Trabajador</td>';
				//Muestro las columnas con los porcentajes validos
				foreach ($arrColumnas as $porcentaje) {
					echo '<td style="text-align: center;">'.$porcentaje['Nombre'].'%</td>';
				}
				echo '<td style="text-align: center;" width="10">Total Horas</td>';
				echo '<td><a href="'.$location.'&addHora=true" title="Agregar Horas Extras" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Horas Extras</a></td>';
				echo '</tr>';
					
				/***************************************************/
				//
				$total_general_horas = 0;
				if (isset($_SESSION['horas_extras_mens_ing_horas'])){
					//recorro las horas
					foreach ($_SESSION['horas_extras_mens_ing_horas'] as $key => $producto){
						//Variables
						$total_horas = 0;
						
						//Codigo
						echo '<tr class="item-row">';
						echo '<td>'.$producto['TrabajadorRut'].' - '.$producto['TrabajadorNombre'].'</td>';
							
						foreach ($arrColumnas as $porcentaje) {
							if(isset($producto[$porcentaje['idPorcentaje']]['porcentaje_dia'])&&$producto[$porcentaje['idPorcentaje']]['porcentaje_dia']){
								echo '<td style="text-align: center;">'.$producto[$porcentaje['idPorcentaje']]['horas_dia'].'</td>';
								$total_horas           = $total_horas + $producto[$porcentaje['idPorcentaje']]['horas_dia'];
								$total_general_horas   = $total_general_horas + $producto[$porcentaje['idPorcentaje']]['horas_dia'];
							}else{
								echo '<td></td>';
							}
						}
						echo '<td style="text-align: center;">'.$total_horas.'</td>';
						echo '<td>
								<div class="btn-group" style="width: 35px;" >';
								//se verifica que el usuario no sea uno mismo
								$ubicacion = $location.'&del_horas=true&idTrabajador='.$producto['idTrabajador'];
								$dialogo   = '¿Realmente deseas las horas extras del trabajador '.$producto['TrabajadorNombre'].'?';
								echo '<a onClick="dialogBox(\''.$ubicacion.'\', \''.$dialogo.'\')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>
								
								</div>
							</td>';
						echo '</tr>';
					}	
				}?>
				
				
			
				

				
		
				<tr class="invoice-total" bgcolor="#f1f1f1">
					<td colspan="<?php echo ($data_column-1); ?>" align="right"><strong>Total Horas extras</strong></td> 
					<td align="right"><?php echo $total_general_horas; ?></td>
					<td align="right"></td>
				</tr>
					
				<tr id="hiderow"><td colspan="<?php echo ($data_column+1); ?>"><a name="Ancla_obs"></a></td></tr>
				
					
				
				
				
				<tr>
					<?php if(isset($_SESSION['horas_extras_mens_ing_basicos']['Observaciones'])&&$_SESSION['horas_extras_mens_ing_basicos']['Observaciones']!=''){ ?>
					
						<td colspan="<?php echo $data_column; ?>" class="blank word_break"> 
							<?php echo $_SESSION['horas_extras_mens_ing_basicos']['Observaciones'];?>
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
						<td colspan="<?php echo $data_column; ?>" class="blank"> 
							<?php 
							$non = '';
							if(isset($_SESSION['horas_extras_mens_ing_temporal'])&&$_SESSION['horas_extras_mens_ing_temporal']!=''){
								$non = $_SESSION['horas_extras_mens_ing_temporal'];
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
				<tr>
					<td colspan="<?php echo $data_column+1; ?>" class="blank"><p>Observaciones</p></td> 
				</tr>
				
				
							
							
				
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
			if (isset($_SESSION['horas_extras_mens_ing_archivos'])){
				//recorro el lsiatdo entregado por la base de datos
				$numeral = 1;
				foreach ($_SESSION['horas_extras_mens_ing_archivos'] as $key => $producto){?>
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
 } elseif ( ! empty($_GET['new']) ) { ?>
 <div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Ingresar Horas Extras</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Creacion_fecha)) {  $x1  = $Creacion_fecha;     }else{$x1  = '';}
				if(isset($Ano)) {             $x2  = $Ano;                }else{$x2  = '';}
				if(isset($idMes)) {           $x3  = $idMes;              }else{$x3  = '';}
				if(isset($Observaciones)) {   $x4  = $Observaciones;      }else{$x4  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_date('Fecha Facturacion','Creacion_fecha', $x1, 2);
				$Form_Imputs->form_select_n_auto('Año','Ano', $x2, 2, 2016, ano_actual());
				$Form_Imputs->form_select_filter('Mes','idMes', $x3, 2, 'idMes', 'Nombre', 'core_tiempo_meses', 0, 'ORDER BY idMes ASC', $dbConn);
				$Form_Imputs->form_textarea('Observaciones','Observaciones', $x4, 1, 160);
				
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Imputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
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
		case 'periodo_asc':  $order_by = 'ORDER BY trabajadores_horas_extras_mensuales_facturacion.Ano ASC, trabajadores_horas_extras_mensuales_facturacion.idMes ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Periodo Ascendente'; break;
		case 'periodo_desc': $order_by = 'ORDER BY trabajadores_horas_extras_mensuales_facturacion.Ano DESC, trabajadores_horas_extras_mensuales_facturacion.idMes DESC ';  $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Periodo Descendente';break;
		case 'fechas_asc':   $order_by = 'ORDER BY trabajadores_horas_extras_mensuales_facturacion.Creacion_fecha ASC ';                                                    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Facturacion Ascendente';break;
		case 'fechas_desc':  $order_by = 'ORDER BY trabajadores_horas_extras_mensuales_facturacion.Creacion_fecha DESC ';                                                   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Facturacion Descendente';break;
	
		default: $order_by = 'ORDER BY trabajadores_horas_extras_mensuales_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Facturacion Descendente';
	}
}else{
	$order_by = 'ORDER BY trabajadores_horas_extras_mensuales_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Facturacion Descendente';
}
/**********************************************************/
//Variable con la ubicacion
$z="WHERE trabajadores_horas_extras_mensuales_facturacion.idFacturacion!=0";//Solo ingresos
//Verifico el tipo de usuario que esta ingresando
$z.=" AND trabajadores_horas_extras_mensuales_facturacion.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";
$w = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";	
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha'] != ''){  $z .= " AND trabajadores_horas_extras_mensuales_facturacion.Creacion_fecha='".$_GET['Creacion_fecha']."'";}
if(isset($_GET['Creacion_mes']) && $_GET['Creacion_mes'] != ''){      $z .= " AND trabajadores_horas_extras_mensuales_facturacion.Creacion_mes=".$_GET['Creacion_mes'];}
if(isset($_GET['Creacion_ano']) && $_GET['Creacion_ano'] != ''){      $z .= " AND trabajadores_horas_extras_mensuales_facturacion.Creacion_ano=".$_GET['Creacion_ano'];}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idFacturacion FROM `trabajadores_horas_extras_mensuales_facturacion` ".$z;
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
trabajadores_horas_extras_mensuales_facturacion.idFacturacion,
trabajadores_horas_extras_mensuales_facturacion.Creacion_fecha,
trabajadores_horas_extras_mensuales_facturacion.Ano,
trabajadores_horas_extras_mensuales_facturacion.idMes,
core_sistemas.Nombre AS Sistema

FROM `trabajadores_horas_extras_mensuales_facturacion`
LEFT JOIN `core_sistemas`           ON core_sistemas.idSistema             = trabajadores_horas_extras_mensuales_facturacion.idSistema

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
	
	<?php if ($rowlevel['level']>=3){ ?>
		<?php if (isset($_SESSION['horas_extras_mens_ing_basicos']['idUsuario'])&&$_SESSION['horas_extras_mens_ing_basicos']['idUsuario']!=''){?>
			
			<?php 
			$ubicacion = $location.'&clear_all=true';
			$dialogo   = '¿Realmente deseas eliminar todos los registros?';?>
			<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar</a>
			
			<a href="<?php echo $location; ?>&view=true" class="btn btn-default fright margin_width" ><i class="fa fa-arrow-right" aria-hidden="true"></i> Continuar Ingreso Horas</a>
		<?php }else{ ?>
			<a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Ingreso Horas</a>
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
				if(isset($Creacion_fecha)) {     $x1  = $Creacion_fecha;   }else{$x1  = '';}
				if(isset($Creacion_mes)) {       $x2  = $Creacion_mes;     }else{$x2  = '';}
				if(isset($Creacion_ano)) {       $x3  = $Creacion_ano;     }else{$x3  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_date('Fecha Facturacion','Creacion_fecha', $x1, 1);
				$Form_Imputs->form_select_filter('Mes','Creacion_mes', $x2, 1, 'idMes', 'Nombre', 'core_tiempo_meses', 0, 'ORDER BY idMes ASC', $dbConn);
				$Form_Imputs->form_select_n_auto('Año','Creacion_ano', $x3, 1, 2016, ano_actual());
						
			
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
			<div class="icons"><i class="fa fa-table"></i></div><h5>Ingreso Horas Extras</h5>
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
							<div class="pull-left">Fecha Facturacion</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fechas_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=fechas_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Periodo</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=periodo_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=periodo_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
								  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrTipo as $tipo) { ?>
						<tr class="odd">
							<td><?php echo Fecha_estandar($tipo['Creacion_fecha']) ; ?></td>
							<td><?php echo $tipo['Ano'].' - '.numero_a_mes($tipo['idMes']); ?></td>
							<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $tipo['Sistema']; ?></td><?php } ?>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_horas_mens_extras.php?view='.$tipo['idFacturacion']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a><?php } ?>
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
