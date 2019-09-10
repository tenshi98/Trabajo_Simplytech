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
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "core_permisos_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/**********************************************************************************************************************************/
/*                                               Ejecucion de los formularios                                                     */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/core_permisos_listado.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/core_permisos_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/core_permisos_listado.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Permiso creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Permiso editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Permiso borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT id_pmcat, Direccionweb, Direccionbase, Nombre, visualizacion, Version, 
Descripcion, Level_Limit, Habilita, Principal
FROM `core_permisos_listado`
WHERE idAdmpm = {$_GET['id']}";
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
mysqli_free_result($resultado);
?>
 
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificacion de Permiso</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($id_pmcat)) {         $x1  = $id_pmcat;       }else{$x1  = $rowdata['id_pmcat'];}
				if(isset($Nombre)) {           $x2  = $Nombre;         }else{$x2  = $rowdata['Nombre'];}
				if(isset($Direccionbase)) {    $x3  = $Direccionbase;  }else{$x3  = $rowdata['Direccionbase'];}
				if(isset($Direccionweb)) {     $x4  = $Direccionweb;   }else{$x4  = $rowdata['Direccionweb'];}
				if(isset($visualizacion)) {    $x5  = $visualizacion;  }else{$x5  = $rowdata['visualizacion'];}
				if(isset($Version)) {          $x6  = $Version;        }else{$x6  = $rowdata['Version'];}
				if(isset($Descripcion)) {      $x7  = $Descripcion;    }else{$x7  = $rowdata['Descripcion'];}
				if(isset($Habilita)) {         $x8  = $Habilita;       }else{$x8  = $rowdata['Habilita'];}
				if(isset($Principal)) {        $x9  = $Principal;      }else{$x9  = $rowdata['Principal'];}
				if(isset($Level_Limit)) {      $x10 = $Level_Limit;    }else{$x10 = $rowdata['Level_Limit'];}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select('Categorias','id_pmcat', $x1, 2, 'id_pmcat', 'Nombre', 'core_permisos_categorias', 0, '', $dbConn);
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x2, 2);
				$Form_Imputs->form_input_icon( 'Direccion base', 'Direccionbase', $x3, 2,'fa fa-internet-explorer');
				$Form_Imputs->form_input_icon( 'Direccion web', 'Direccionweb', $x4, 2,'fa fa-internet-explorer');
				$Form_Imputs->form_visualizacion('Visualizacion','visualizacion', $x5, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
				$Form_Imputs->form_input_number('Version del Archivo', 'Version', $x6, 2);
				$Form_Imputs->form_textarea('Descripcion','Descripcion', $x7, 2, 160);
				$Form_Imputs->form_textarea('Habilitacion de tabs Usuario','Habilita', $x8, 1, 160);
				$Form_Imputs->form_textarea('Habilitacion de tabs Principal','Principal', $x9, 1, 160);
				$Form_Imputs->form_select_n_auto('Limite Nivel','Level_Limit', $x10, 2, 1, 4);
				
				$Form_Imputs->form_input_hidden('idAdmpm', $_GET['id'], 2);
				$Form_Imputs->form_input_hidden('fake_id_pmcat', $rowdata['id_pmcat'], 2);
				$Form_Imputs->form_input_hidden('fake_Nombre', $rowdata['Nombre'], 2);
				
				
				?>
		 
	  
				

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>




<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) {  ?>
 <div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Permiso</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($id_pmcat)) {         $x1  = $id_pmcat;       }else{$x1  = '';}
				if(isset($Nombre)) {           $x2  = $Nombre;         }else{$x2  = '';}
				if(isset($Direccionbase)) {    $x3  = $Direccionbase;  }else{$x3  = '';}
				if(isset($Direccionweb)) {     $x4  = $Direccionweb;   }else{$x4  = '';}
				if(isset($visualizacion)) {    $x5  = $visualizacion;  }else{$x5  = '';}
				if(isset($Version)) {          $x6  = $Version;        }else{$x6  = '';}
				if(isset($Descripcion)) {      $x7  = $Descripcion;    }else{$x7  = '';}
				if(isset($Habilita)) {         $x8  = $Habilita;       }else{$x8  = '';}
				if(isset($Principal)) {        $x9  = $Principal;      }else{$x9  = '';}
				if(isset($Level_Limit)) {      $x10 = $Level_Limit;    }else{$x10 = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select('Categorias','id_pmcat', $x1, 2, 'id_pmcat', 'Nombre', 'core_permisos_categorias', 0, '', $dbConn);
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x2, 2);
				$Form_Imputs->form_input_icon( 'Direccion base', 'Direccionbase', $x3, 2,'fa fa-internet-explorer');
				$Form_Imputs->form_input_icon( 'Direccion web', 'Direccionweb', $x4, 2,'fa fa-internet-explorer');
				$Form_Imputs->form_visualizacion('Visualizacion','visualizacion', $x5, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
				$Form_Imputs->form_input_number('Version del Archivo', 'Version', $x6, 2);
				$Form_Imputs->form_textarea('Descripcion','Descripcion', $x7, 2, 160);
				$Form_Imputs->form_textarea('Habilitacion de tabs','Habilita', $x8, 1, 160);
				$Form_Imputs->form_textarea('Habilitacion de tabs Principal','Principal', $x9, 1, 160);
				$Form_Imputs->form_select_n_auto('Limite Nivel','Level_Limit', $x10, 2, 1, 4);
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
//Creo la variable con la ubicacion
$z="";
// Se trae un listado con todos los usuarios
$arrPermisos = array();
$query = "SELECT 
core_permisos_listado.idAdmpm,
core_permisos_listado.Direccionweb,
core_permisos_listado.Nombre,
core_permisos_listado.Version,
core_permisos_listado.visualizacion,
core_permisos_listado.Level_Limit,
core_sistemas.Nombre AS ver,
core_permisos_categorias.Nombre AS Nombre_cat
FROM `core_permisos_listado`
INNER JOIN `core_permisos_categorias`    ON core_permisos_categorias.id_pmcat     = core_permisos_listado.id_pmcat
LEFT JOIN `core_sistemas`                ON core_sistemas.idSistema               = core_permisos_listado.visualizacion
".$z."
ORDER BY Nombre_cat ASC, core_permisos_listado.Nombre ASC ";
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
array_push( $arrPermisos,$row );
}?>
<div class="col-sm-12">
	<a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Permiso</a>
</div>
<div class="clearfix"></div>                       
                                 
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Permisos</h5>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Nombre</th>
						<th>Version</th>
						<th>Nivel</th>
						<th>Direccion Web</th>
						<th>Visualizacion</th>
						<th width="10">Acciones</th>
					</tr>
					<?php echo widget_sherlock(1, 6);?>
					
				
				</thead>				  
				<tbody role="alert" aria-live="polite" aria-relevant="all" id="TableFiltered">
					<?php
					filtrar($arrPermisos, 'Nombre_cat');  
					foreach($arrPermisos as $categoria=>$permisos){ 
						echo '<tr class="odd" ><td colspan="6"  style="background-color:#DDD"><strong>'.$categoria.'</strong></td></tr>';
						foreach ($permisos as $subcategorias) { ?>
						<tr class="odd"> 
							<td><?php echo $subcategorias['Nombre']; ?></td>
							<td><?php echo $subcategorias['Version']; ?></td>
							<td><?php echo $subcategorias['Level_Limit']; ?></td>
							<td><?php echo $subcategorias['Direccionweb']; ?></td>
							<td>
								<?php
								if($subcategorias['visualizacion']==9999){
								   echo 'Solo Superadministradores';
								}elseif($subcategorias['visualizacion']==9998){
								   echo 'Todos';
								}else{
								   echo $subcategorias['ver'];
								} ?>
							</td>
							<td>
								<div class="btn-group" style="width: 70px;" >
									<a href="<?php echo $location.'&id='.$subcategorias['idAdmpm']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
									<?php 
										$ubicacion = $location.'&del='.$subcategorias['idAdmpm'];
										$dialogo   = '¿Realmente deseas eliminar el permiso '.$subcategorias['Nombre'].'?';?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>								
								</div>
							</td>   
						</tr> 
					 <?php } 
					}?>
								   
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
