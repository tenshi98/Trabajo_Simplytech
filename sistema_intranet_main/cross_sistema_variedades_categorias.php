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
$original = "cross_sistema_variedades_categorias.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){   $location .= "&Nombre=".$_GET['Nombre']; $search .= "&Nombre=".$_GET['Nombre'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Especie creada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Especie editada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Especie borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) {
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn); 
// Se traen todos los datos de mi usuario
$query = "SELECT  
Nombre
FROM `sistema_variedades_categorias`
WHERE sistema_variedades_categorias.idCategoria = ".$_GET['id'];
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

// Se trae un listado con todos los usuarios
$arrMatrizCalidad = array();
$query = "SELECT 
sistema_variedades_categorias_matriz_calidad.idMatriz,
cross_quality_calidad_matriz.Nombre AS Matriz,
core_cross_quality_analisis_calidad.Nombre AS Proceso

FROM `sistema_variedades_categorias_matriz_calidad`
LEFT JOIN `cross_quality_calidad_matriz`         ON cross_quality_calidad_matriz.idMatriz         = sistema_variedades_categorias_matriz_calidad.idMatriz
LEFT JOIN `core_cross_quality_analisis_calidad`  ON core_cross_quality_analisis_calidad.idTipo    = sistema_variedades_categorias_matriz_calidad.idProceso

WHERE sistema_variedades_categorias_matriz_calidad.idCategoria = ".$_GET['id']."
AND sistema_variedades_categorias_matriz_calidad.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
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
array_push( $arrMatrizCalidad,$row );
}
// Se trae un listado con todos los usuarios
$arrMatrizProceso = array();
$query = "SELECT 
sistema_variedades_categorias_matriz_proceso.idMatriz,
cross_quality_calidad_matriz.Nombre AS Matriz,
core_cross_quality_analisis_calidad.Nombre AS Proceso

FROM `sistema_variedades_categorias_matriz_proceso`
LEFT JOIN `cross_quality_calidad_matriz`         ON cross_quality_calidad_matriz.idMatriz         = sistema_variedades_categorias_matriz_proceso.idMatriz
LEFT JOIN `core_cross_quality_analisis_calidad`  ON core_cross_quality_analisis_calidad.idTipo    = sistema_variedades_categorias_matriz_proceso.idProceso

WHERE sistema_variedades_categorias_matriz_proceso.idCategoria = ".$_GET['id']."
AND sistema_variedades_categorias_matriz_proceso.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
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
array_push( $arrMatrizProceso,$row );
}

// Se trae un listado con todos los usuarios
$arrTiposEmbalaje = array();
$query = "SELECT 
sistema_variedades_categorias_tipo_emb.idEmbalaje,
sistema_cross_analisis_embalaje.Nombre AS Embalaje,
core_cross_quality_analisis_calidad.Nombre AS Proceso

FROM `sistema_variedades_categorias_tipo_emb`
LEFT JOIN `sistema_cross_analisis_embalaje`      ON sistema_cross_analisis_embalaje.idTipo        = sistema_variedades_categorias_tipo_emb.idTipo
LEFT JOIN `core_cross_quality_analisis_calidad`  ON core_cross_quality_analisis_calidad.idTipo    = sistema_variedades_categorias_tipo_emb.idProceso

WHERE sistema_variedades_categorias_tipo_emb.idCategoria = ".$_GET['id']."
AND sistema_variedades_categorias_tipo_emb.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
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
array_push( $arrTiposEmbalaje,$row );
}
?>
<div class="col-sm-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Especie', $rowdata['Nombre'], 'Resumen');?>
</div>
<div class="clearfix"></div> 

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="<?php echo 'cross_sistema_variedades_categorias.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'cross_sistema_variedades_categorias_matriz_calidad.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Matriz Calidad</a></li>
				<li class=""><a href="<?php echo 'cross_sistema_variedades_categorias_matriz_proceso.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Matriz Proceso</a></li>
				<li class=""><a href="<?php echo 'cross_sistema_variedades_categorias_tipo_embalaje.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Tipo Embalaje</a></li>
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					
					
					<div class="col-sm-4">
						<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/productos.jpg">
					</div>
					<div class="col-sm-8">
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Basicos</h2>
						<p class="text-muted">
							<strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?><br/>
						</p>
						
					</div>		
				
					<div class="col-sm-12">
						<div class="box">
							<header>
								<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Matrices de calidad</h5>
							</header>
							<div class="table-responsive">
								<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
									<thead>
										<tr role="row">
											<th>Matriz</th>
										</tr>
									</thead>				  
									<tbody role="alert" aria-live="polite" aria-relevant="all" id="TableFiltered">
										<?php
										filtrar($arrMatrizCalidad, 'Proceso');  
										foreach($arrMatrizCalidad as $Proceso=>$listproc){ 
											echo '<tr class="odd" ><td style="background-color:#DDD"><strong>'.$Proceso.'</strong></td></tr>';
											foreach ($listproc as $subprocesos) { ?>
											<tr class="odd"> 
												<td><?php echo $subprocesos['Matriz']; ?></td>
											</tr> 
										 <?php } 
										}?>
													   
									</tbody>
								</table>
							</div>	
						</div>
					</div>
					
					<div class="col-sm-12">
						<div class="box">
							<header>
								<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Matrices de Proceso</h5>
							</header>
							<div class="table-responsive">
								<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
									<thead>
										<tr role="row">
											<th>Matriz</th>
										</tr>
									</thead>				  
									<tbody role="alert" aria-live="polite" aria-relevant="all" id="TableFiltered">
										<?php
										filtrar($arrMatrizProceso, 'Proceso');  
										foreach($arrMatrizProceso as $Proceso=>$listproc){ 
											echo '<tr class="odd" ><td style="background-color:#DDD"><strong>'.$Proceso.'</strong></td></tr>';
											foreach ($listproc as $subprocesos) { ?>
											<tr class="odd"> 
												<td><?php echo $subprocesos['Matriz']; ?></td>
											</tr> 
										 <?php } 
										}?>
													   
									</tbody>
								</table>
							</div>	
						</div>
					</div>
					
					<div class="col-sm-12">
						<div class="box">
							<header>
								<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Tipos de Embalaje</h5>
							</header>
							<div class="table-responsive">
								<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
									<thead>
										<tr role="row">
											<th>Embalaje</th>
										</tr>
									</thead>				  
									<tbody role="alert" aria-live="polite" aria-relevant="all" id="TableFiltered">
										<?php
										filtrar($arrTiposEmbalaje, 'Proceso');  
										foreach($arrTiposEmbalaje as $Proceso=>$listproc){ 
											echo '<tr class="odd" ><td style="background-color:#DDD"><strong>'.$Proceso.'</strong></td></tr>';
											foreach ($listproc as $subprocesos) { ?>
											<tr class="odd"> 
												<td><?php echo $subprocesos['Embalaje']; ?></td>
											</tr> 
										 <?php } 
										}?>
													   
									</tbody>
								</table>
							</div>	
						</div>
					</div>

				
				</div>
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
		case 'nombre_asc':    $order_by = 'ORDER BY sistema_variedades_categorias.Nombre ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente'; break;
		case 'nombre_desc':   $order_by = 'ORDER BY sistema_variedades_categorias.Nombre DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		
		default: $order_by = 'ORDER BY sistema_variedades_categorias.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
	}
}else{
	$order_by = 'ORDER BY sistema_variedades_categorias.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE sistema_variedades_categorias.idCategoria!=0";
//verifico que sea un administrador
$z.=" AND core_sistemas_variedades_categorias.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){ $z .= " AND sistema_variedades_categorias.Nombre LIKE '%".$_GET['Nombre']."%'";}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT core_sistemas_variedades_categorias.idCategoria FROM `core_sistemas_variedades_categorias` LEFT JOIN `sistema_variedades_categorias` ON sistema_variedades_categorias.idCategoria = core_sistemas_variedades_categorias.idCategoria ".$z;
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
$arrCategorias = array();
$query = "SELECT 
core_sistemas_variedades_categorias.idCategoria,
sistema_variedades_categorias.Nombre

FROM `core_sistemas_variedades_categorias`
LEFT JOIN `sistema_variedades_categorias` ON sistema_variedades_categorias.idCategoria = core_sistemas_variedades_categorias.idCategoria
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
array_push( $arrCategorias,$row );
}?>

<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>

</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {      $x1  = $Nombre;     }else{$x1  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 1);
				
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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Especies</h5>
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
								<a href="<?php echo $location.'&order_by=nombre_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>			  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrCategorias as $cat) { ?>
					<tr class="odd">
						<td><?php echo $cat['Nombre']; ?></td>
						<td>
							<div class="btn-group" style="width: 70px;" >
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$cat['idCategoria']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.simpleEncode($cat['idCategoria'], fecha_actual());
									$dialogo   = '¿Realmente deseas eliminar la Especie '.$cat['Nombre'].'?';?>
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
<?php } ?>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
