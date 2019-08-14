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
$original = "informe_cajas_01.php";
$location = $original;
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/********************************************************************/
//Variables para filtro y paginacion
$search ='&submit_filter=Filtrar';
if(isset($_GET['idCajaChica']) && $_GET['idCajaChica'] != ''){                            $location .= "&idCajaChica=".$_GET['idCajaChica'];                            $search .= "&idCajaChica=".$_GET['idCajaChica'];}
if(isset($_GET['idTrabajador']) && $_GET['idTrabajador'] != ''){                          $location .= "&idTrabajador=".$_GET['idTrabajador'];                          $search .= "&idTrabajador=".$_GET['idTrabajador'];}
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha'] != ''){                      $location .= "&Creacion_fecha=".$_GET['Creacion_fecha'];                      $search .= "&Creacion_fecha=".$_GET['Creacion_fecha'];}
if(isset($_GET['idFacturacionRelacionada']) && $_GET['idFacturacionRelacionada'] != ''){  $location .= "&idFacturacionRelacionada=".$_GET['idFacturacionRelacionada'];  $search .= "&idFacturacionRelacionada=".$_GET['idFacturacionRelacionada'];}
if(isset($_GET['idTipo']) && $_GET['idTipo'] != ''){                                      $location .= "&idTipo=".$_GET['idTipo'];                                      $search .= "&idTipo=".$_GET['idTipo'];}
if(isset($_GET['idEstado']) && $_GET['idEstado'] != ''){                                  $location .= "&idEstado=".$_GET['idEstado'];                                  $search .= "&idEstado=".$_GET['idEstado'];}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['submit_filter']) ) { 

             
  

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
$order_by = 'ORDER BY caja_chica_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
/**********************************************************/
//Variable con la ubicacion
$z="WHERE caja_chica_facturacion.idTipo!=0";//Solo egresos
//Verifico el tipo de usuario que esta ingresando
$z.=" AND caja_chica_facturacion.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idCajaChica']) && $_GET['idCajaChica'] != ''){                            $z .= " AND caja_chica_facturacion.idCajaChica=".$_GET['idCajaChica'];}
if(isset($_GET['idTrabajador']) && $_GET['idTrabajador'] != ''){                          $z .= " AND caja_chica_facturacion.idTrabajador=".$_GET['idTrabajador'];}
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha'] != ''){                      $z .= " AND caja_chica_facturacion.Creacion_fecha='".$_GET['Creacion_fecha']."'";}
if(isset($_GET['idFacturacionRelacionada']) && $_GET['idFacturacionRelacionada'] != ''){  $z .= " AND caja_chica_facturacion.idFacturacionRelacionada='".$_GET['idFacturacionRelacionada']."'";}
if(isset($_GET['idTipo']) && $_GET['idTipo'] != ''){                                      $z .= " AND caja_chica_facturacion.idTipo='".$_GET['idTipo']."'";}
if(isset($_GET['idEstado']) && $_GET['idEstado'] != ''){                                  $z .= " AND caja_chica_facturacion.idEstado='".$_GET['idEstado']."'";}
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

//consulta
$arrTipo = array();
$query = "SELECT 
caja_chica_facturacion.idFacturacion AS ID,
caja_chica_facturacion.idFacturacionRelacionada,
caja_chica_facturacion.Creacion_fecha,
caja_chica_listado.Nombre AS Caja,
core_sistemas.Nombre AS Sistema,
caja_chica_facturacion.Valor,
caja_chica_facturacion.idTipo,
trabajadores_listado.Nombre AS TrabajadorNombre,
trabajadores_listado.ApellidoPat AS TrabajadorApellidoPat,
caja_chica_facturacion_tipo.Nombre AS TipoMov,
(SELECT SUM(Valor) FROM `caja_chica_facturacion_existencias` WHERE idFacturacion=ID LIMIT 1 )AS MovSum,
(SELECT SUM(Valor) FROM `caja_chica_facturacion_rendiciones` WHERE idFacturacion=ID LIMIT 1 )AS DevSum
							
FROM `caja_chica_facturacion`
LEFT JOIN `caja_chica_listado`           ON caja_chica_listado.idCajaChica      = caja_chica_facturacion.idCajaChica
LEFT JOIN `core_sistemas`                ON core_sistemas.idSistema             = caja_chica_facturacion.idSistema
LEFT JOIN `trabajadores_listado`         ON trabajadores_listado.idTrabajador   = caja_chica_facturacion.idTrabajador
LEFT JOIN `caja_chica_facturacion_tipo`  ON caja_chica_facturacion_tipo.idTipo  = caja_chica_facturacion.idTipo
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
}


?>
<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>	
	</ul>

</div>
<div class="clearfix"></div> 
                     
                                 
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Cotizaciones</h5>
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
						<th>Movimiento</th>
						<th>Fecha</th>
						<th>Trabajador</th>
						<th>Doc Relacionado</th>
						<th>Ingreso</th>
						<th>Egreso</th>
						<th>Rendicion</th>
						<th>Monto</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>

				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrTipo as $tipo) { ?>
						<tr class="odd">
							<td><?php echo $tipo['TipoMov']; ?></td>
							<td><?php echo Fecha_estandar($tipo['Creacion_fecha']); ?></td>
							<td><?php echo $tipo['TrabajadorNombre'].' '.$tipo['TrabajadorApellidoPat']; ?></td>
							<td><?php echo n_doc($tipo['idFacturacionRelacionada'], 8); ?></td>
							<?php
							//Reviso el tipo de movimiento
							switch ($tipo['idTipo']) {
								//Ingreso Caja Chica
								case 1:
									echo '<td>'.Valores($tipo['MovSum'], 0).'</td>';
									echo '<td></td>';
									echo '<td></td>';
									break;
								//Egreso Caja Chica
								case 2:
									echo '<td></td>';
									echo '<td>'.Valores($tipo['MovSum'], 0).'</td>';
									echo '<td></td>';
									break;
								//Rendicion Caja Chica
								case 3:
									echo '<td>'.Valores($tipo['MovSum'], 0).'</td>';
									echo '<td></td>';
									echo '<td>'.Valores($tipo['DevSum'], 0).'</td>';
									break;
							}
							
							?>
							<td><strong><?php echo Valores($tipo['Valor'], 0); ?></strong></td>
							<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $tipo['Sistema']; ?></td><?php } ?>
							<td>
								<div class="btn-group" style="width: 70px;" >
									<a href="<?php echo 'view_mov_caja_chica.php?view='.$tipo['ID'].'&return=true'; ?>" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
									<?php
									//solo si es rendicion
									if(isset($tipo['idTipo'])&&$tipo['idTipo']==3){
										echo '<a href="view_mov_caja_chica.php?view='.$tipo['idFacturacionRelacionada'].'&return=true" title="Ver Documento Relacionado" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>';	
									}
									?>
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
<?php require_once '../LIBS_js/modal/modal.php';?>


<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location; ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$z="caja_chica_listado.idSistema>=0";
	$w="idSistema>=0";
}else{
	$z="caja_chica_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND usuarios_cajas_chicas.idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']}";		
	$w="idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";		
}
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
				if(isset($idCajaChica)) {                $x1  = $idCajaChica;               }else{$x1  = '';}
				if(isset($idTrabajador)) {               $x2  = $idTrabajador;              }else{$x2  = '';}
				if(isset($Creacion_fecha)) {             $x3  = $Creacion_fecha;            }else{$x3  = '';}
				if(isset($idFacturacionRelacionada)) {   $x4  = $idFacturacionRelacionada;  }else{$x4  = '';}
				if(isset($idTipo)) {                     $x5  = $idTipo;                    }else{$x5  = '';}
				if(isset($idEstado)) {                   $x6  = $idEstado;                  }else{$x6  = '';}
				
				//se dibujan los inputs	
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_join_filter('Caja','idCajaChica', $x1, 2, 'idCajaChica', 'Nombre', 'caja_chica_listado', 'usuarios_cajas_chicas', $z, $dbConn);
				$Form_Imputs->form_select_filter('Trabajador Asignado','idTrabajador', $x2, 1, 'idTrabajador', 'Rut,Nombre,ApellidoPat,ApellidoMat', 'trabajadores_listado', $w, '', $dbConn);
				$Form_Imputs->form_date('Fecha de Creacion','Creacion_fecha', $x3, 1);
				$Form_Imputs->form_input_number('N° Doc Relacionado', 'idFacturacionRelacionada', $x4, 1);
				$Form_Imputs->form_select('Tipo Movimiento','idTipo', $x5, 1, 'idTipo', 'Nombre', 'caja_chica_facturacion_tipo', 0, '', $dbConn);
				$Form_Imputs->form_select('Estado','idEstado', $x6, 1, 'idEstado', 'Nombre', 'core_estado_caja', 0, '', $dbConn);
				
				?>        
	   
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="submit_filter"> 
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>        
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
