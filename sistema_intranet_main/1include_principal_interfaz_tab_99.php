<?php
/**************************************************************************/
if($idTipoUsuario==1 OR $idTipoUsuario==2) { 
//Se ve el acceso al log de modificaciones
$arrLog = array();
$query = "SELECT Fecha, Descripcion
FROM `core_log_cambios`
ORDER BY Fecha DESC, idLog DESC
LIMIT 20 ";
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
array_push( $arrLog,$row );
}	
	
	
	echo '
	<div class="tab-pane fade" id="Menu_tab_99">
						
		<div class="col-sm-12">
			<div class="box">
				<header>
					<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Log de Cambios</h5>
				</header>
				<div class="table-responsive">
					<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">			  
						<tbody role="alert" aria-live="polite" aria-relevant="all">';
							foreach ($arrLog as $log) {
								echo '
								<tr class="odd">
									<td>'.fecha_estandar($log['Fecha']).' '.$log['Descripcion'].'</td>
								</tr>';
							} 
						echo '                   
						</tbody>
					</table>
				</div>
 
			</div>
		</div>
	</div>';
}

?>
