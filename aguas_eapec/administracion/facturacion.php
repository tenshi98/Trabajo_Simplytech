<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                                          Seguridad                                                             */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/AntiXSS.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/Bootup.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/UTF8.php';
$security = new AntiXSS();
$_POST = $security->xss_clean($_POST);
$_GET  = $security->xss_clean($_GET);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/config.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/conexion.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/esUsuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/web_carga_usuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/sesion_usuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/functions.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/componentes.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "facturacion.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/permisos.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/

//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'Fecha,intAnual,idSistema,idOpcionesInteres';
	$form_trabajo= 'create_new';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_facturacion_listado.php';
}
//se borran los datos temporales
if ( !empty($_GET['clear_all']) )  { 
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'clear_all';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_facturacion_listado.php';
}
/********************************************/
if ( !empty($_GET['ing_doc']) )  { 
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'ing_Facturacion';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_facturacion_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_facturacion_listado.php';	
}
?>
<?php require_once 'core/header.php';?>
    <div id="wrap">
      <div id="top">
        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container-fluid">
            <header class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
              </button>
              <a href="principal.php" class="navbar-brand">
                <?php require_once 'core/logo_empresa.php';?>
              </a> 
            </header>
            <?php require_once 'core/infobox.php';?>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
              <?php require_once 'core/menu_top.php';?>
            </div>
          </div>
        </nav>
        <header class="head">
          <div class="main-bar">
            <h3><?php echo '<i class="'.$rowlevel['IconoCategoria'].'"></i> '.$rowlevel['nombre_categoria'].' - '.$rowlevel['nombre_transaccion']; ?></h3>
          </div>
        </header>
      </div>
      <div id="left">
       <?php require_once 'core/userbox.php';?> 
       <?php require_once 'core/menu.php';?> 
      </div>
      <div id="content">
        <div class="outer">
            <div class="inner">
			<!-- InstanceBeginEditable name="Bodytext" -->
<?php 
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Datos Creados correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Datos Modificados correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Datos borrados correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['view_details']) ) {
switch ($_SESSION['Facturacion_clientes'][$_GET['view_details']]['SII_idFacturable']) {
	//Boleta Electronica
	case 1:
		include 'view_aguas_facturacion_ing_1.php';
	break;
	//Factura Electronica
	case 2:
		include 'view_aguas_facturacion_ing_2.php';
	break;
	//No Facturable
	case 3:
		//include 'view_aguas_facturacion_ing_3.php';
	break;	
	//Boleta Manual
	case 4:
		include 'view_aguas_facturacion_ing_4.php';
	break;	
	//Factura Manual
	case 5:
		include 'view_aguas_facturacion_ing_5.php';
	break;		
}

?>

<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px; margin-top:30px">
<a href="<?php echo $location.'&view=true'; ?>"  class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div>	

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['view']) ) { ?>

<div class="col-sm-12 fcenter" style="margin-bottom:30px">

	<?php 		
	$ubicacion = $location.'&view=true&ing_doc=true';
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
		<div id="header"> Facturacion de Clientes  </div>
		<div id="customer">
			<table id="meta" class="fleft otdata">
				<tbody>
					<tr>
						<td class="meta-head"><strong>DATOS BASICOS</strong></td>
						<td class="meta-head"></td>
					</tr>
					<tr>
						<td class="meta-head">Creador</td>
						<td><?php echo $_SESSION['Facturacion_basicos']['Usuario']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Interes Anual</td>
						<td><?php echo $_SESSION['Facturacion_basicos']['intAnual']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Calculo de intereses</td>
						<td><?php if(isset($_SESSION['Facturacion_basicos']['idOpcionesInteres'])&&$_SESSION['Facturacion_basicos']['idOpcionesInteres']==1){echo 'Si';}else{echo 'No';} ?></td>
					</tr>
					<tr>
						<td class="meta-head">Sistema</td>
						<td><?php echo $_SESSION['Facturacion_basicos']['SistemaNombre']; ?></td>
					</tr>
				</tbody>
			</table>
			<table id="meta" class="otdata2">
				<tbody>
					<tr>
						<td class="meta-head">Fecha Facturacion</td>
						<td><?php echo Fecha_estandar($_SESSION['Facturacion_basicos']['Fecha']);?></td>
					</tr>
					<tr>
						<td class="meta-head">Fecha Creacion</td>
						<td><?php echo Fecha_estandar($_SESSION['Facturacion_basicos']['fCreacion']);?></td>
					</tr>
				</tbody>
			</table>
		</div>
		
		<table id="items">
			<tbody>
				<tr>
					<th colspan="6">Detalle</th>
				</tr>		  
				
				<?php if(isset($_SESSION['Facturacion_clientes'])) { ?>
					<tr class="item-row linea_punteada" bgcolor="#F0F0F0">
						<td><strong>Identificador</strong></td>
						<td><strong>Cliente</strong></td>
						<td><strong>Estado</strong></td>
						<td><strong>Direccion</strong></td>
						<td><strong>Ultimo Pago</strong></td>
						<td><strong>Acciones</strong></td>
					</tr>	
					<?php foreach ($_SESSION['Facturacion_clientes'] as $key => $clientes){ ?>
						<tr class="item-row linea_punteada">
							<td><?php echo $clientes['ClienteIdentificador']; ?></td>
							<td><?php echo $clientes['ClienteNombre']; ?></td>
							<td><?php echo $clientes['ClienteEstado']; ?></td>
							<td><?php echo $clientes['ClienteDireccion']; ?></td>
							<td><?php echo Fecha_estandar($clientes['AguasInfUltimoPagoFecha']); ?></td>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<a href="<?php echo $location.'&view=true&view_details='.$clientes['idCliente']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="iframe btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a>
								</div>
							</td>
						</tr> 
					<?php } ?>
					<tr id="hiderow"><td colspan="6"></td></tr>
				<?php } ?>

				<tr>
					<td colspan="6" class="blank"> 
						<p>
							<?php 
							if(isset($_SESSION['Facturacion_basicos']['Observaciones'])&&$_SESSION['Facturacion_basicos']['Observaciones']!=''){
								echo $_SESSION['Facturacion_basicos']['Observaciones'];
							}else{
								echo 'Sin Observaciones';
							}?>
						</p>
					</td>
				</tr>
				<tr>
					<td colspan="6" class="blank"><p>Observaciones</p></td> 
				</tr>
			</tbody>
		</table>
    	<div class="clearfix"></div>
    </div>
</div>
	

<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px; margin-top:30px">
<a href="<?php echo $location; ?>"  class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['new']) ) { 
if($arrUsuario['tipo']=='SuperAdmin'){
	$z = 'idSistema>0';
}else{
	$z = 'idSistema='.$arrUsuario['idSistema'];
}?>
 <div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Nueva Facturacion</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" name="form1" >
				<div class="alert alert-danger" role="alert" style="white-space: initial;">La <strong>Fecha de Facturacion</strong> son los 10 de cada mes, cualquier otra fecha puesta hara que la plataforma calcule mal los atrasos, los intereses y los saldos anteriores, tener en cuenta de que si aun asi se pone otra fecha estara <strong>deliberadamente ingresando mal los datos.</strong></div>
				<?php 
				//Se verifican si existen los datos
				if(isset($Fecha)) {              $x1  = $Fecha;               }else{$x1  = '';}
				if(isset($intAnual)) {           $x2  = $intAnual;            }else{$x2  = '';}
				if(isset($idOpcionesInteres)) {  $x3  = $idOpcionesInteres;   }else{$x3  = '';}
				if(isset($Observaciones)) {      $x4  = $Observaciones;       }else{$x4  = '';}
				if(isset($idSistema)) {          $x5  = $idSistema;           }else{$x5  = '';}

				//se dibujan los inputs
				echo form_date('Fecha de Facturacion','Fecha', $x1, 2);
				echo form_input_number('Interes Anual', 'intAnual', $x2, 2);
				echo form_select('Calculo de Intereses','idOpcionesInteres', $x3, 2, 'idOpciones', 'Nombre', 'core_datos_opciones', 0, $dbConn);
				echo form_textarea('Observaciones', 'Observaciones', $x4, 1);
				
				if($arrUsuario['tipo']=='SuperAdmin'){
					echo form_select('Sistema','idSistema', $x5, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
				}else{
					echo '<input type="hidden" name="idSistema"   value="'.$arrUsuario['idSistema'].'">';
				}

				echo '<input type="hidden" name="idUsuario"        value="'.$arrUsuario['idUsuario'].'">';
				echo '<input type="hidden" name="fCreacion"        value="'.fecha_actual().'">';
				
				
				
				?>
				
				<div class="form-group">
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit">
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
				</div>
                      
			</form> 
            
                    
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
//Verifico el tipo de usuario que esta ingresando
if($arrUsuario['tipo']=='SuperAdmin'){
	$z="WHERE facturacion_listado.idSistema>=0";	
}else{
	$z="WHERE facturacion_listado.idSistema={$arrUsuario['idSistema']}";	
}
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idFacturacion FROM `facturacion_listado` ".$z."";
$registros = mysqli_query ($dbConn, $query);
$cuenta_registros = mysqli_num_rows($registros);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrDatos = array();
$query = "SELECT 
facturacion_listado.idFacturacion,
facturacion_listado.fCreacion,
facturacion_listado.Fecha,
usuarios_listado.Nombre AS NombreUsuario,
core_sistemas.Nombre AS Sistema

FROM `facturacion_listado`
LEFT JOIN `core_sistemas`     ON core_sistemas.idSistema      = facturacion_listado.idSistema
LEFT JOIN `usuarios_listado`  ON usuarios_listado.idUsuario   = facturacion_listado.idUsuario

".$z."
ORDER BY facturacion_listado.Fecha DESC
LIMIT $comienzo, $cant_reg ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrDatos,$row );
}

?>

<div class="form-group">
<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" >Crear Nueva Facturacion</a><?php } ?>
</div>
<div class="clearfix"></div>                       
                                 
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Facturaciones</h5>
			<div class="toolbar">
				<?php 
				if (isset($_GET['search'])) {  $search ='&search='.$_GET['search']; } else { $search='';}
				echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
			</div>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Fecha Creacion</th>
						<th>Fecha Facturacion</th>
						<th>Creador</th>
						<th>Sistema</th>
						<th width="120">Acciones</th>
					</tr>
				</thead>	
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrDatos as $cont) { ?>
					<tr class="odd">
						<td><?php echo Fecha_estandar($cont['fCreacion']); ?></td>
						<td><?php echo Fecha_estandar($cont['Fecha']); ?></td>
						<td><?php echo $cont['NombreUsuario']; ?></td>
						<td><?php echo $cont['Sistema']; ?></td>
						<td>
							<div class="btn-group widthtd120" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_facturar.php?view='.$cont['idFacturacion']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$cont['idFacturacion'];
									$dialogo   = '¿Realmente deseas eliminar la facturacion?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" data-placement="bottom" title="Borrar Informacion" data-toggle="tooltip" class="btn btn-metis-1 btn-sm info-tooltip"><i class="fa fa-trash-o"></i></a>
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
			if (isset($_GET['search'])) {  $search ='&search='.$_GET['search']; } else { $search='';}
			echo paginador_2('paginf',$total_paginas, $original, $search, $num_pag ) ?>
		</div> 
	</div>
</div>
<?php } ?>           
			<!-- InstanceEndEditable -->   
            </div>
        </div>
      </div> 
    </div>
    <?php require_once 'core/footer.php';?>
    <?php require_once 'assets/lib/avgrund/avgrund.php';?>
  </body>
</html>
