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
$original = "soporte_software_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){                 $location .= "&Nombre=".$_GET['Nombre'];                 $search .= "&Nombre=".$_GET['Nombre'];}
if(isset($_GET['Descripcion']) && $_GET['Descripcion'] != ''){       $location .= "&Descripcion=".$_GET['Descripcion'];       $search .= "&Descripcion=".$_GET['Descripcion'];}
if(isset($_GET['idLicencia']) && $_GET['idLicencia'] != ''){         $location .= "&idLicencia=".$_GET['idLicencia'];         $search .= "&idLicencia=".$_GET['idLicencia'];}
if(isset($_GET['Peso']) && $_GET['Peso'] != ''){                     $location .= "&Peso=".$_GET['Peso'];                     $search .= "&Peso=".$_GET['Peso'];}
if(isset($_GET['idMedidaPeso']) && $_GET['idMedidaPeso'] != ''){     $location .= "&idMedidaPeso=".$_GET['idMedidaPeso'];     $search .= "&idMedidaPeso=".$_GET['idMedidaPeso'];}
if(isset($_GET['SitioWeb']) && $_GET['SitioWeb'] != ''){             $location .= "&SitioWeb=".$_GET['SitioWeb'];             $search .= "&SitioWeb=".$_GET['SitioWeb'];}
if(isset($_GET['SitioDescarga']) && $_GET['SitioDescarga'] != ''){   $location .= "&SitioDescarga=".$_GET['SitioDescarga'];   $search .= "&SitioDescarga=".$_GET['SitioDescarga'];}
if(isset($_GET['idCategoria']) && $_GET['idCategoria'] != ''){       $location .= "&idCategoria=".$_GET['idCategoria'];       $search .= "&idCategoria=".$_GET['idCategoria'];}
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
	require_once 'A1XRXS_sys/xrxs_form/soporte_software_listado.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/soporte_software_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/soporte_software_listado.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Aplicacion Creada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Aplicacion Modificada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Aplicacion borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT Nombre, Descripcion, idLicencia, Peso, idMedidaPeso, SitioWeb, SitioDescarga,
idCategoria
FROM `soporte_software_listado`
WHERE idSoftware = {$_GET['id']}";
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
$rowdata = mysqli_fetch_assoc ($resultado);	?>
 
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificacion de la Aplicacion</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				//Se verifican si existen los datos
				if(isset($Nombre)) {         $x1  = $Nombre;         }else{$x1  = $rowdata['Nombre'];}
				if(isset($Descripcion)) {    $x2  = $Descripcion;    }else{$x2  = $rowdata['Descripcion'];}
				if(isset($idLicencia)) {     $x3  = $idLicencia;     }else{$x3  = $rowdata['idLicencia'];}
				if(isset($Peso)) {           $x4  = $Peso;           }else{$x4  = $rowdata['Peso'];}
				if(isset($idMedidaPeso)) {   $x5  = $idMedidaPeso;   }else{$x5  = $rowdata['idMedidaPeso'];}
				if(isset($SitioWeb)) {       $x6  = $SitioWeb;       }else{$x6  = $rowdata['SitioWeb'];}
				if(isset($SitioDescarga)) {  $x7  = $SitioDescarga;  }else{$x7  = $rowdata['SitioDescarga'];}
				if(isset($idCategoria)) {    $x8  = $idCategoria;    }else{$x8  = $rowdata['idCategoria'];}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 2);
				$Form_Imputs->form_textarea('Descripcion', 'Descripcion', $x2, 2, 160);
				$Form_Imputs->form_select('Licencia','idLicencia', $x3, 2, 'idLicencia', 'Nombre', 'soporte_software_listado_licencias', 0, '', $dbConn);
				$Form_Imputs->form_input_number('Peso', 'Peso', $x4, 2);
				$Form_Imputs->form_select('Medida Peso','idMedidaPeso', $x5, 2, 'idMedidaPeso', 'Nombre', 'soporte_software_listado_medidas', 0, '', $dbConn);
				$Form_Imputs->form_input_icon( 'Web', 'SitioWeb', $x6, 1,'fa fa-internet-explorer');
				$Form_Imputs->form_input_icon( 'Descargar', 'SitioDescarga', $x7, 2,'fa fa-internet-explorer');
				$Form_Imputs->form_select('Categoria','idCategoria', $x8, 2, 'idCategoria', 'Nombre', 'soporte_software_listado_categorias', 0, '', $dbConn);
				
				
				$Form_Imputs->form_input_hidden('idSoftware', $_GET['id'], 2);
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
 } elseif ( ! empty($_GET['new']) ) { ?>
 <div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Aplicacion</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {         $x1  = $Nombre;         }else{$x1  = '';}
				if(isset($Descripcion)) {    $x2  = $Descripcion;    }else{$x2  = '';}
				if(isset($idLicencia)) {     $x3  = $idLicencia;     }else{$x3  = '';}
				if(isset($Peso)) {           $x4  = $Peso;           }else{$x4  = '';}
				if(isset($idMedidaPeso)) {   $x5  = $idMedidaPeso;   }else{$x5  = '';}
				if(isset($SitioWeb)) {       $x6  = $SitioWeb;       }else{$x6  = '';}
				if(isset($SitioDescarga)) {  $x7  = $SitioDescarga;  }else{$x7  = '';}
				if(isset($idCategoria)) {    $x8  = $idCategoria;    }else{$x8  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 2);
				$Form_Imputs->form_textarea('Descripcion', 'Descripcion', $x2, 2, 160);
				$Form_Imputs->form_select('Licencia','idLicencia', $x3, 2, 'idLicencia', 'Nombre', 'soporte_software_listado_licencias', 0, '', $dbConn);
				$Form_Imputs->form_input_number('Peso', 'Peso', $x4, 2);
				$Form_Imputs->form_select('Medida Peso','idMedidaPeso', $x5, 2, 'idMedidaPeso', 'Nombre', 'soporte_software_listado_medidas', 0, '', $dbConn);
				$Form_Imputs->form_input_icon( 'Web', 'SitioWeb', $x6, 1,'fa fa-internet-explorer');
				$Form_Imputs->form_input_icon( 'Descargar', 'SitioDescarga', $x7, 2,'fa fa-internet-explorer');
				$Form_Imputs->form_select('Categoria','idCategoria', $x8, 2, 'idCategoria', 'Nombre', 'soporte_software_listado_categorias', 0, '', $dbConn);
				
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
		case 'nombre_asc':      $order_by = 'ORDER BY soporte_software_listado.Nombre ASC ';            $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente'; break;
		case 'nombre_desc':     $order_by = 'ORDER BY soporte_software_listado.Nombre DESC ';           $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		case 'licencia_asc':    $order_by = 'ORDER BY soporte_software_listado_licencias.Nombre ASC ';  $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Licencia Ascendente';break;
		case 'licencia_desc':   $order_by = 'ORDER BY soporte_software_listado_licencias.Nombre DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Licencia Descendente';break;
		
		default: $order_by = 'ORDER BY soporte_software_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
	}
}else{
	$order_by = 'ORDER BY soporte_software_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE soporte_software_listado.idSoftware!=0";
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){               $z .= " AND soporte_software_listado.Nombre LIKE '%".$_GET['Nombre']."%'";}
if(isset($_GET['Descripcion']) && $_GET['Descripcion'] != ''){     $z .= " AND soporte_software_listado.Descripcion LIKE '%".$_GET['Descripcion']."%'";}
if(isset($_GET['idLicencia']) && $_GET['idLicencia'] != ''){       $z .= " AND soporte_software_listado.idLicencia=".$_GET['idLicencia'];}
if(isset($_GET['Peso']) && $_GET['Peso'] != ''){                   $z .= " AND soporte_software_listado.Peso LIKE '%".$_GET['Peso']."%'";}
if(isset($_GET['idMedidaPeso']) && $_GET['idMedidaPeso'] != ''){   $z .= " AND soporte_software_listado.idMedidaPeso=".$_GET['idMedidaPeso'];}
if(isset($_GET['SitioWeb']) && $_GET['SitioWeb'] != ''){           $z .= " AND soporte_software_listado.SitioWeb LIKE '%".$_GET['SitioWeb']."%'";}
if(isset($_GET['SitioDescarga']) && $_GET['SitioDescarga'] != ''){ $z .= " AND soporte_software_listado.SitioDescarga LIKE '%".$_GET['SitioDescarga']."%'";}
if(isset($_GET['idCategoria']) && $_GET['idCategoria'] != ''){     $z .= " AND soporte_software_listado.idCategoria=".$_GET['idCategoria'];}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idSoftware FROM `soporte_software_listado` ".$z;
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
$arrImpuestos = array();
$query = "SELECT 
soporte_software_listado.idSoftware,
soporte_software_listado.Nombre, 
soporte_software_listado_licencias.Nombre AS Licencia
FROM `soporte_software_listado`
LEFT JOIN `soporte_software_listado_licencias` ON soporte_software_listado_licencias.idLicencia = soporte_software_listado.idLicencia

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
array_push( $arrImpuestos,$row );
}?>
<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Aplicacion</a><?php } ?>

</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {         $x1  = $Nombre;         }else{$x1  = '';}
				if(isset($Descripcion)) {    $x2  = $Descripcion;    }else{$x2  = '';}
				if(isset($idLicencia)) {     $x3  = $idLicencia;     }else{$x3  = '';}
				if(isset($Peso)) {           $x4  = $Peso;           }else{$x4  = '';}
				if(isset($idMedidaPeso)) {   $x5  = $idMedidaPeso;   }else{$x5  = '';}
				if(isset($SitioWeb)) {       $x6  = $SitioWeb;       }else{$x6  = '';}
				if(isset($SitioDescarga)) {  $x7  = $SitioDescarga;  }else{$x7  = '';}
				if(isset($idCategoria)) {    $x8  = $idCategoria;    }else{$x8  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 1);
				$Form_Imputs->form_textarea('Descripcion', 'Descripcion', $x2, 1, 160);
				$Form_Imputs->form_select('Licencia','idLicencia', $x3, 1, 'idLicencia', 'Nombre', 'soporte_software_listado_licencias', 0, '', $dbConn);
				$Form_Imputs->form_input_number('Peso', 'Peso', $x4, 1);
				$Form_Imputs->form_select('Medida Peso','idMedidaPeso', $x5, 1, 'idMedidaPeso', 'Nombre', 'soporte_software_listado_medidas', 0, '', $dbConn);
				$Form_Imputs->form_input_icon( 'Web', 'SitioWeb', $x6, 1,'fa fa-internet-explorer');
				$Form_Imputs->form_input_icon( 'Descargar', 'SitioDescarga', $x7, 1,'fa fa-internet-explorer');
				$Form_Imputs->form_select('Categoria','idCategoria', $x8, 1, 'idCategoria', 'Nombre', 'soporte_software_listado_categorias', 0, '', $dbConn);
				
				
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
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Aplicaciones</h5>
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
							<div class="pull-left">Nombre</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=nombre_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="120">
							<div class="pull-left">Licencia</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=licencia_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=licencia_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
								  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrImpuestos as $imp) { ?>
					<tr class="odd">
						<td><?php echo $imp['Nombre']; ?></td>
						<td><?php echo $imp['Licencia']; ?></td>
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_software.php?view='.$imp['idSoftware']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$imp['idSoftware']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$imp['idSoftware'];
									$dialogo   = '¿Realmente deseas eliminar la Aplicacion '.$imp['Nombre'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>
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
