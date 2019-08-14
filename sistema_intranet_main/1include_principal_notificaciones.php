<?php 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
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
//Variable con la ubicacion
$z="WHERE principal_notificaciones_ver.idNoti>=0";
$w="WHERE principal_notificaciones_ver.idNoti>=0";
if (isset($_GET['filtersender'])){
	if($_GET['filtersender']=='admin'){
		$z.=" AND principal_notificaciones_ver.idNotificaciones = 0";
	}else{
		$z.=" AND principal_notificaciones_listado.idUsuario = {$_GET['filtersender']}";
	}		
}

//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$z.=" AND principal_notificaciones_ver.idSistema>=0";	
	$z.=" AND principal_notificaciones_ver.idUsuario>=0";	
	$w.=" AND principal_notificaciones_ver.idSistema>=0";	
	$w.=" AND principal_notificaciones_ver.idUsuario>=0";
}else{
	$z.=" AND principal_notificaciones_ver.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";
	$z.=" AND principal_notificaciones_ver.idUsuario={$_SESSION['usuario']['basic_data']['idUsuario']}";
	$w.=" AND principal_notificaciones_ver.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";
	$w.=" AND principal_notificaciones_ver.idUsuario={$_SESSION['usuario']['basic_data']['idUsuario']}";		
}
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT principal_notificaciones_ver.idNoti FROM `principal_notificaciones_ver` 
LEFT JOIN `principal_notificaciones_listado`  ON principal_notificaciones_listado.idNotificaciones   = principal_notificaciones_ver.idNotificaciones
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
// Se trae un listado con todos los usuarios
$arrTipo = array();
$query = "SELECT 
principal_notificaciones_ver.idNoti,
principal_notificaciones_ver.Fecha,
principal_notificaciones_ver.Notificacion,
principal_notificaciones_ver.idEstado,
core_estado_notificaciones.Nombre AS Estado
FROM `principal_notificaciones_ver`
LEFT JOIN `core_estado_notificaciones`        ON core_estado_notificaciones.idEstado                 = principal_notificaciones_ver.idEstado
LEFT JOIN `principal_notificaciones_listado`  ON principal_notificaciones_listado.idNotificaciones   = principal_notificaciones_ver.idNotificaciones
".$z."
ORDER BY principal_notificaciones_ver.idEstado ASC, principal_notificaciones_ver.Fecha DESC, principal_notificaciones_ver.idNoti ASC
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

//obtengo los usuarios que enviaron la notificacion
$arrCategorias = array();
$query = "SELECT
principal_notificaciones_listado.idUsuario AS idusuario,
usuarios_listado.Nombre AS usuario,
count(principal_notificaciones_ver.idNotificaciones)AS cuenta
FROM `principal_notificaciones_ver`
LEFT JOIN `principal_notificaciones_listado`  ON principal_notificaciones_listado.idNotificaciones   = principal_notificaciones_ver.idNotificaciones
LEFT JOIN `usuarios_listado`                  ON usuarios_listado.idUsuario                          = principal_notificaciones_listado.idUsuario
".$w."
GROUP BY usuarios_listado.Nombre";
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
}
//Variable de busqueda
$search = "";




?>
  

<div class="row inbox">
  						
	<div class="col-sm-8">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Notificaciones</h5>
				<div class="toolbar">
					<a href="<?php echo $location.'&all='.$_SESSION['usuario']['basic_data']['idUsuario']; ?>" class="btn btn-xs btn-primary">Marcar Todos Leidos</a>
				</div>
				<div class="toolbar">
					<?php 
					//Paginador
					echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
				</div>
			</header>
			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<thead>
						<tr role="row">
							<th>Fecha</th>
							<th>Notificacion</th>
							<th>Estado</th>
							<th width="10">Acciones</th>
						</tr>
					</thead>			  
					<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrTipo as $tipo) { ?>
						<tr class="odd">
							<td><?php echo $tipo['Fecha']; ?></td>
							<td class="tdpaddinright"><?php echo $tipo['Notificacion']; ?></td>
							<td><?php echo $tipo['Estado']; ?></td>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<?php if ($tipo['idEstado']==1){?><a href="<?php echo $location.'&id='.$tipo['idNoti']; ?>" title="Marcar como leido" class="btn btn-primary btn-sm tooltip"><i class="fa fa-check-square-o"></i></a><?php } ?>
								</div>
							</td>
						</tr>
					<?php } ?>                    
					</tbody>
				</table>
			</div>
			
			<div class="pagrow">	
				<?php 
				//Paginador
				echo paginador_2('paginf',$total_paginas, $original, $search, $num_pag ) ?>
			</div> 
			
		</div>
	</div>  
	<?php require_once '../LIBS_js/modal/modal.php';?>
	
	<div class="col-sm-4 mail-left-box">
  		<div class="list-group inbox-options">
				<?php 
				$todos = 0;
				foreach ($arrCategorias as $cat) {
					$todos = $todos + $cat['cuenta'];
				} ?>
					
				<div class="list-group-item">Filtro</div>	
				<a href="<?php echo $original.'?pagina=1'; ?>" class="list-group-item">
					<i class="fa fa-inbox"></i> 
					Mostrar Todos
					<span class="badge  bg-primary"><?php echo $todos; ?></span> 
				</a>
					
			<?php foreach ($arrCategorias as $cat) { ?>
				<?php if($cat['usuario']!=''){ ?>
					<a href="<?php echo $original.'?pagina=1&filtersender='.$cat['idusuario']; ?>" class="list-group-item">
						<i class="fa fa-inbox"></i> 
						<?php echo $cat['usuario']; ?>
						<span class="badge  bg-primary"><?php echo $cat['cuenta']; ?></span> 
					</a>
				<?php }else{ ?>
					<a href="<?php echo $original.'?pagina=1&filtersender=admin'; ?>" class="list-group-item">
						<i class="fa fa-inbox"></i> 
						Administrador
						<span class="badge  bg-primary"><?php echo $cat['cuenta']; ?></span> 
					</a>
				<?php } ?>	
			<?php } ?>
					
					
  		</div>
	</div> 
							
</div>
