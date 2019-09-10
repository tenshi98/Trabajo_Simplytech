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
$original = "informe_usuarios_accesos_01.php";
$location = $original;
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/********************************************************************/
//Variables para filtro y paginacion
$search ='&submit_filter=Filtrar';
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){          $location .= "&idUsuario=".$_GET['idUsuario'];          $search .= "&idUsuario=".$_GET['idUsuario'];}
if(isset($_GET['Rango_Inicio']) && $_GET['Rango_Inicio'] != ''){    $location .= "&Rango_Inicio=".$_GET['Rango_Inicio'];    $search .= "&Rango_Inicio=".$_GET['Rango_Inicio'];}
if(isset($_GET['Rango_Termino']) && $_GET['Rango_Termino'] != ''){  $location .= "&Rango_Termino=".$_GET['Rango_Termino'];  $search .= "&Rango_Termino=".$_GET['Rango_Termino'];}
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
$z = "WHERE usuarios_accesos.idAcceso>0";
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){            $z .= " AND usuarios_accesos.idUsuario=".$_GET['idUsuario'];}
if(isset($_GET['Rango_Inicio']) && $_GET['Rango_Inicio'] != ''&&isset($_GET['Rango_Termino']) && $_GET['Rango_Termino'] != ''){  
	$z .= " AND usuarios_accesos.Fecha BETWEEN '{$_GET['Rango_Inicio']}' AND '{$_GET['Rango_Termino']}'" ;
}
/**********************************************************/
//consulta
$arrAccesos = array();
$query = "SELECT 
usuarios_accesos.Fecha,
usuarios_accesos.Hora,
usuarios_accesos.IP_Client,
usuarios_accesos.Agent_Transp,
usuarios_listado.Nombre AS Usuario
FROM `usuarios_accesos`
LEFT JOIN `usuarios_listado`   ON usuarios_listado.idUsuario   = usuarios_accesos.idUsuario 
".$z."
ORDER BY usuarios_accesos.Fecha DESC";
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
array_push( $arrAccesos,$row );
}


?>
<div class="col-sm-12">
	<a target="new" href="<?php echo 'informe_usuarios_accesos_01_to_excel.php?bla=true'.$search.'&idTipoUsuario='.$_SESSION['usuario']['basic_data']['idTipoUsuario'].'&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'] ; ?>" class="btn btn-sm btn-metis-2 fright margin_width"><i class="fa fa-file-excel-o"></i> Exportar a Excel</a>
</div>
                       
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Accesos</h5>
		</header>
		<div class="table-responsive">   
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Usuario</th>
						<th width="120">Fecha</th>
						<th width="120">Hora</th>
						<th width="120">IP Cliente</th>
						<th>Agent Transp</th>
					</tr>
				</thead>
				
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrAccesos as $sol) { ?>
						<tr class="odd">
							<td><?php echo $sol['Usuario']; ?></td>
							<td><?php echo Fecha_estandar($sol['Fecha']); ?></td>
							<td><?php echo $sol['Hora']; ?></td>
							<td><?php echo $sol['IP_Client']; ?></td>
							<td><?php echo $sol['Agent_Transp']; ?></td>
						</tr>
					<?php } ?>                    
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location; ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
//Verifico el tipo de usuario que esta ingresando
$w="idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";
$usrfil = 'usuarios_sistemas.idSistema='.$_SESSION['usuario']['basic_data']['idSistema'].' AND usuarios_listado.idEstado=1 AND usuarios_listado.idTipoUsuario!=1';	
?>
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($idUsuario)) {      $x1  = $idUsuario;     }else{$x1  = '';}
				if(isset($Rango_Inicio)) {   $x2  = $Rango_Inicio;  }else{$x2  = '';}
				if(isset($Rango_Termino)) {  $x3  = $Rango_Termino; }else{$x3  = '';}

				//se dibujan los inputs	
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_filter('Usuario','idUsuario', $x1, 1, 'idUsuario', 'Nombre', 'usuarios_listado', 0, '', $dbConn);
				$Form_Imputs->form_date('Rango de Inicio','Rango_Inicio', $x2, 1);
				$Form_Imputs->form_date('Rango de Termino','Rango_Termino', $x3, 1);

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
