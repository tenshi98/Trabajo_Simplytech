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
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//variable con el nombre de la categoria de la transaccion
$rowlevel['nombre_categoria']='Principal';

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
            <h3><i class="fa fa-dashboard"></i> Principal</h3>
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
/*****************************************************************************************************************/
/*                                           Modulo de transacciones                                             */
/*****************************************************************************************************************/
//permisos a las transacciones
$trans_1 = "admin_clientes.php";
$trans_2 = "usuarios_listado.php";
$trans_3 = "trabajadores_listado.php";
$trans_4 = "bodegas_ingreso.php";
$trans_5 = "bodegas_egreso.php";
$trans_6 = "bodegas_gasto.php";
$trans_7 = "informe_gerencial_1.php";
$trans_8 = "admin_proveedor.php";

//Verifico el tipo de usuario que esta ingresando
if($arrUsuario['tipo']=='SuperAdmin'){
	$z =" WHERE idSistema>=0";	
	$z.=" AND idUsuario>=0";
	$w =" WHERE idSistema>=0";		
}else{
	$z =" WHERE idSistema={$arrUsuario['idSistema']}";
	$z.=" AND idUsuario={$arrUsuario['idUsuario']}";
	$w =" WHERE idSistema={$arrUsuario['idSistema']}";	
}

//consultas anidadas, se utiliza las variables anteriores para consultar cada permiso
$query = "SELECT
core_sistemas.Ciudad,
core_sistemas.Comuna,
core_sistemas.Wheater,

(SELECT COUNT(usuarios_permisos.idAdmpm) FROM usuarios_permisos INNER JOIN  core_permisos ON core_permisos.idAdmpm = usuarios_permisos.idAdmpm WHERE core_permisos.Direccionbase ='".$trans_1."'  AND usuarios_permisos.idUsuario='".$arrUsuario['idUsuario']."') AS tran_1,
(SELECT COUNT(usuarios_permisos.idAdmpm) FROM usuarios_permisos INNER JOIN  core_permisos ON core_permisos.idAdmpm = usuarios_permisos.idAdmpm WHERE core_permisos.Direccionbase ='".$trans_2."'  AND usuarios_permisos.idUsuario='".$arrUsuario['idUsuario']."') AS tran_2,
(SELECT COUNT(usuarios_permisos.idAdmpm) FROM usuarios_permisos INNER JOIN  core_permisos ON core_permisos.idAdmpm = usuarios_permisos.idAdmpm WHERE core_permisos.Direccionbase ='".$trans_3."'  AND usuarios_permisos.idUsuario='".$arrUsuario['idUsuario']."') AS tran_3,
(SELECT COUNT(usuarios_permisos.idAdmpm) FROM usuarios_permisos INNER JOIN  core_permisos ON core_permisos.idAdmpm = usuarios_permisos.idAdmpm WHERE core_permisos.Direccionbase ='".$trans_4."'  AND usuarios_permisos.idUsuario='".$arrUsuario['idUsuario']."') AS tran_4,
(SELECT COUNT(usuarios_permisos.idAdmpm) FROM usuarios_permisos INNER JOIN  core_permisos ON core_permisos.idAdmpm = usuarios_permisos.idAdmpm WHERE core_permisos.Direccionbase ='".$trans_5."'  AND usuarios_permisos.idUsuario='".$arrUsuario['idUsuario']."') AS tran_5,
(SELECT COUNT(usuarios_permisos.idAdmpm) FROM usuarios_permisos INNER JOIN  core_permisos ON core_permisos.idAdmpm = usuarios_permisos.idAdmpm WHERE core_permisos.Direccionbase ='".$trans_6."'  AND usuarios_permisos.idUsuario='".$arrUsuario['idUsuario']."') AS tran_6,
(SELECT COUNT(usuarios_permisos.idAdmpm) FROM usuarios_permisos INNER JOIN  core_permisos ON core_permisos.idAdmpm = usuarios_permisos.idAdmpm WHERE core_permisos.Direccionbase ='".$trans_7."'  AND usuarios_permisos.idUsuario='".$arrUsuario['idUsuario']."') AS tran_7,
(SELECT COUNT(usuarios_permisos.idAdmpm) FROM usuarios_permisos INNER JOIN  core_permisos ON core_permisos.idAdmpm = usuarios_permisos.idAdmpm WHERE core_permisos.Direccionbase ='".$trans_8."'  AND usuarios_permisos.idUsuario='".$arrUsuario['idUsuario']."') AS tran_8,


(SELECT COUNT(idCliente) FROM clientes_listado ".$w." AND idEstado='1' ) AS Clientes,
(SELECT COUNT(idUsuario) FROM usuarios_listado ".$w." AND idEstado='1' AND tipo!='SuperAdmin' ) AS Usuarios,
(SELECT COUNT(idTrabajador) FROM trabajadores_listado ".$w." AND idEstado='1' ) AS Trabajadores,
(SELECT COUNT(idProveedor) FROM proveedor_listado ".$w." AND idEstado='1' ) AS Proveedores,
(SELECT COUNT(idAyuda) FROM ayuda_listado ".$w." OR idSistema=9999 ) AS CuentaAyuda,
(SELECT COUNT(idProcedimiento) FROM procedimientos_listado ".$w." OR idSistema=9999) AS CuentaProcedimientos,
(SELECT COUNT(idDocumentacion) FROM documentacion_listado ".$w." OR idSistema=9999) AS CuentaDocumentos,
(SELECT COUNT(idAgenda) FROM agenda_telefonica ".$w." AND idUsuario = '{$arrUsuario['idUsuario']}' OR idUsuario=9999) AS CuentaContactos,
(SELECT COUNT(idCalendario) FROM calendario_listado ".$w." AND Mes=".mes_actual().") AS CuentaEventos,
(SELECT COUNT(idNoti) FROM notificaciones_ver ".$z." AND idEstado='1' ) AS Notificacion

FROM usuarios_listado
LEFT JOIN core_sistemas ON core_sistemas.idSistema = usuarios_listado.idSistema
WHERE usuarios_listado.idUsuario='".$arrUsuario['idUsuario']."' "; 
$resultado = mysqli_query ($dbConn, $query);	
$n_permisos = mysqli_fetch_assoc($resultado);



?>



<div class="row">
    
    <script src="assets/lib/weather/jquery.simpleWeather.js"></script>
	<link rel="stylesheet" href="assets/lib/weather/weather.css">
		
		
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-aqua" id="weather">

        </div>
    </div>
    
    <script>
			$(document).ready(function() {
			  $.simpleWeather({
				location: '<?php if(isset($n_permisos['Comuna'])&&$n_permisos['Comuna']!=''){echo $n_permisos['Comuna'];}else{echo 'Santiago';}; ?>, Chile',
				woeid: '',
				unit: 'c',
				success: function(weather) {
					
					html = '<span class="info-box-icon"><i class="icon-'+weather.code+'"></i></span>';
					html += '<div class="info-box-content">';
					html += '	<span class="info-box-text">El Tiempo</span>';
					html += '	<span class="info-box-number">'+weather.temp+'&deg;'+weather.units.temp+'</span>';
					html += '	<div class="progress">';
					html += '		<div class="progress-bar" style="width: 100%"></div>';
					html += '	</div>';
					html += '	<span class="progress-description">';
					html += '		<a target="_blank" href="<?php echo $n_permisos['Wheater']; ?>">';
					html += '         <?php if(isset($n_permisos['Comuna'])&&$n_permisos['Comuna']!=''){echo $n_permisos['Comuna'];}else{echo 'Santiago';}; ?>, Chile';
					html += '		</a>';
					html += '	</span>';
					html += '</div>';
            
				  $("#weather").html(html);
				},
				error: function(error) {
				  $("#weather").html('<p>'+error+'</p>');
				}
			  });
			});
		</script>
		
    
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
				<span class="info-box-text">Perfil</span>
				<span class="info-box-number"><?php echo $arrUsuario['Nombre'] ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">
					<a class="faa-parent animated-hover" href="principal_datos.php">
						Editar Mis Datos
						<i class="fa fa-arrow-circle-right faa-passing"></i>
					</a>
				</span>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-envelope <?php if($n_permisos['Notificacion']!=0){ echo 'faa-horizontal animated'; } ?>" ></i><br/></span>

            <div class="info-box-content">
				<span class="info-box-text">Notificaciones</span>
				<span class="info-box-number"><?php echo $n_permisos['Notificacion']; ?> sin leer</span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">
					<a class="faa-parent animated-hover" href="principal_notificaciones.php?pagina=1">
						Ver Notificaciones
						<i class="fa fa-arrow-circle-right faa-passing"></i>
					</a>
				</span>
            </div>
        </div>
    </div>
 
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-question"></i></span>

            <div class="info-box-content">
				<span class="info-box-text">Archivos de ayuda</span>
				<span class="info-box-number"><?php echo $n_permisos['CuentaAyuda']; ?> Archivos</span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">
					<a class="faa-parent animated-hover" href="principal_ayuda.php?pagina=1">
						Ver Archivos
						<i class="fa fa-arrow-circle-right faa-passing"></i>
					</a>
				</span>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-purple">
            <span class="info-box-icon"><i class="fa fa-file-word-o"></i></span>

            <div class="info-box-content">
				<span class="info-box-text">Procedimientos</span>
				<span class="info-box-number"><?php echo $n_permisos['CuentaProcedimientos']; ?> Archivos</span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">
					<a class="faa-parent animated-hover" href="principal_procedimientos.php?pagina=1">
						Ver Procedimientos
						<i class="fa fa-arrow-circle-right faa-passing"></i>
					</a>
				</span>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-black">
            <span class="info-box-icon"><i class="fa fa-phone"></i></span>

            <div class="info-box-content">
				<span class="info-box-text">Contactos</span>
				<span class="info-box-number"><?php echo $n_permisos['CuentaContactos']; ?> Contactos</span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">
					<a class="faa-parent animated-hover" href="principal_agenda_telefonica.php?pagina=1">
						Ver Contactos
						<i class="fa fa-arrow-circle-right faa-passing"></i>
					</a>
				</span>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
				<span class="info-box-text">Calendario</span>
				<span class="info-box-number"><?php echo $n_permisos['CuentaEventos']; ?> Este Mes</span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">
					<a class="faa-parent animated-hover" href="principal_calendario.php?pagina=1">
						Ver Eventos
						<i class="fa fa-arrow-circle-right faa-passing"></i>
					</a>
				</span>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-file-word-o"></i></span>

            <div class="info-box-content">
				<span class="info-box-text">Documentos</span>
				<span class="info-box-number"><?php echo $n_permisos['CuentaDocumentos']; ?> Archivos</span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">
					<a class="faa-parent animated-hover" href="principal_documentacion.php?pagina=1">
						Ver Documentos
						<i class="fa fa-arrow-circle-right faa-passing"></i>
					</a>
				</span>
            </div>
        </div>
    </div>
    
    
       
</div>





<div class="row">
<?php
/*****************************************************************************************************************/
/*                                         Administracion de clientes                                            */
/*****************************************************************************************************************/
if($n_permisos['tran_1']=='1' or $arrUsuario['tipo']=='SuperAdmin') {?>

    <div class="col-lg-3 col-xs-6"> 
        <div class="small-box btn-primary">
            <div class="innerbox">
				<h3><?php echo $n_permisos['Clientes']; ?></h3>
				<p>Clientes</p>
            </div>
            <div class="icon">
				<i class="fa fa-user"></i>
            </div>
            <a href="<?php echo $trans_1.'?pagina=1'; ?>" class="small-box-footer faa-parent animated-hover">
				Administrar <i class="fa fa-arrow-circle-right faa-passing"></i>
            </a>
        </div>
    </div>
<?php }
/*****************************************************************************************************************/
/*                                         Administracion de Usuarios                                            */
/*****************************************************************************************************************/
if($n_permisos['tran_2']=='1' or $arrUsuario['tipo']=='SuperAdmin') {?>    
    <div class="col-lg-3 col-xs-6"> 
        <div class="small-box bg-green">
            <div class="innerbox">
				<h3><?php echo $n_permisos['Usuarios']; ?></h3>
				<p>Usuarios</p>
            </div>
            <div class="icon">
				<i class="fa fa-users"></i>
            </div>
            <a href="<?php echo $trans_2.'?pagina=1'; ?>" class="small-box-footer faa-parent animated-hover">
				Administrar <i class="fa fa-arrow-circle-right faa-passing"></i>
            </a>
        </div>
    </div>
<?php }
/*****************************************************************************************************************/
/*                                      Administracion de Trabajadores                                           */
/*****************************************************************************************************************/
if($n_permisos['tran_3']=='1' or $arrUsuario['tipo']=='SuperAdmin') {?>    
    <div class="col-lg-3 col-xs-6"> 
        <div class="small-box bg-yellow">
            <div class="innerbox">
				<h3><?php echo $n_permisos['Trabajadores']; ?></h3>
				<p>Trabajadores</p>
            </div>
            <div class="icon">
				<i class="fa fa-male"></i>
            </div>
            <a href="<?php echo $trans_3.'?pagina=1'; ?>" class="small-box-footer faa-parent animated-hover">
				Administrar <i class="fa fa-arrow-circle-right faa-passing"></i>
            </a>
        </div>
    </div>
<?php } 
/*****************************************************************************************************************/
/*                                        Administracion de Proveedores                                          */
/*****************************************************************************************************************/
if($n_permisos['tran_8']=='1' or $arrUsuario['tipo']=='SuperAdmin') {?>    
    
    <div class="col-lg-3 col-xs-6"> 
        <div class="small-box bg-red">
            <div class="innerbox">
				<h3><?php echo $n_permisos['Proveedores']; ?></h3>
				<p>Proveedores</p>
            </div>
            <div class="icon">
				<i class="fa fa-truck"></i>
            </div>
            <a href="<?php echo $trans_8.'?pagina=1'; ?>" class="small-box-footer faa-parent animated-hover">
				Administrar <i class="fa fa-arrow-circle-right faa-passing"></i>
            </a>
        </div>
    </div>
<?php }?>        
</div>
      
      
      
      
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
	google.charts.load('current', {'packages':['bar']});
</script>	
<?php
/*****************************************************************************************************************/
/*                                         Stock Bodega de Materiales                                            */
/*****************************************************************************************************************/
if($n_permisos['tran_7']=='1' or $arrUsuario['tipo']=='SuperAdmin') {
	// se trae un listado con todos los productos con bajo stock
	if($arrUsuario['tipo']=='SuperAdmin'){
		$z = " AND productos_listado.idRubro>=0";	
	}else{
		$z = " AND productos_listado.idRubro={$arrUsuario['idRubro']} OR productos_listado.idRubro=1";	
	}
	//se consulta
	$arrProductos = array();
	$query = "SELECT
	productos_listado.StockLimite,
	productos_listado.Nombre AS NombreProd,
	productos_uml.Nombre AS UnidadMedida,
	(SELECT SUM(Cantidad_ing) FROM bodegas_facturacion_existencias WHERE idProducto = productos_listado.idProducto AND idSistema = {$arrUsuario['idSistema']} ) AS stock_entrada,
	(SELECT SUM(Cantidad_eg)  FROM bodegas_facturacion_existencias WHERE idProducto = productos_listado.idProducto AND idSistema = {$arrUsuario['idSistema']} ) AS stock_salida
	FROM `productos_listado`
	LEFT JOIN `productos_uml` ON productos_uml.idUml = productos_listado.idUml
	WHERE productos_listado.StockLimite >0 ".$z." 
	ORDER BY productos_listado.StockLimite DESC, productos_listado.Nombre ASC
	LIMIT 10";
	$resultado = mysqli_query ($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrProductos,$row );
	}
	
	// Se trae un listado con los valores de las existencias actuales
	$año_pasado = ano_actual()-1;
	if($arrUsuario['tipo']=='SuperAdmin'){
		$z = "WHERE idSistema>=0";
		$z.= " AND Creacion_ano >= ".$año_pasado;
	}else{
		$z = "WHERE idSistema='{$arrUsuario['idSistema']}'";
		$z.= " AND Creacion_ano >= ".$año_pasado;
	}
	//se consulta
	$arrExistencias = array();
	$query = "SELECT Creacion_ano,Creacion_mes,Cantidad_ing,Cantidad_eg,idTipo,SUM(ValorTotal) AS Valor
	FROM `bodegas_facturacion_existencias`
	".$z."
	GROUP BY Creacion_ano,Creacion_mes,idTipo
	ORDER BY Creacion_ano ASC, Creacion_mes ASC";
	$resultado = mysqli_query ($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrExistencias,$row );
	}
	
	
	// Se trae un listado con todos los usuarios
	if($arrUsuario['tipo']=='SuperAdmin'){
		$z = " AND bodegas_facturacion_existencias.idSistema>=0";
	}else{
		$z = " AND bodegas_facturacion_existencias.idSistema={$arrUsuario['idSistema']}";
	}
	//se consulta
	$arrMovimientos = array();
	$query = "SELECT 
	bodegas_facturacion_existencias.Creacion_fecha,
	bodegas_facturacion_existencias.Cantidad_ing,
	bodegas_facturacion_existencias.Cantidad_eg,
	bodegas_facturacion_existencias.idFacturacion,
	bodegas_facturacion_tipo.Nombre AS TipoMovimiento,
	productos_listado.Nombre AS NombreProducto,
	productos_uml.Nombre AS UnidadMedida,
	bodegas_listado.Nombre AS NombreBodega

	FROM `bodegas_facturacion_existencias`
	LEFT JOIN `bodegas_facturacion_tipo`    ON bodegas_facturacion_tipo.idTipo   = bodegas_facturacion_existencias.idTipo
	LEFT JOIN `productos_listado`           ON productos_listado.idProducto      = bodegas_facturacion_existencias.idProducto
	LEFT JOIN `productos_uml`               ON productos_uml.idUml               = productos_listado.idUml
	LEFT JOIN `bodegas_listado`             ON bodegas_listado.idBodega          = bodegas_facturacion_existencias.idBodega

	WHERE bodegas_facturacion_existencias.Creacion_ano=".ano_actual()."
	".$z."
	ORDER BY bodegas_facturacion_existencias.Creacion_fecha DESC 
	LIMIT 10";
	$resultado = mysqli_query ($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrMovimientos,$row );
	} 
	
	
	
	
	
	?>

<div class="row">    
    <div class="col-lg-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table"></i></div><h5>Bodega Materiales</h5>        
			   
				<div class="toolbar">
					<a target="new" href="<?php echo $trans_7.'?pagina=1' ?>" class="btn btn-xs btn-primary">Ver Mas</a>
				</div>
						  
			</header>  
			
			<div id="div-1" class="body">
                <div class="box-body">
					<div class="row">
						<div class="col-md-8">
							<div class="chart">
								
								<?php 
								$mes = array();
								foreach ($arrExistencias as $existencias) { 
									if(!isset($mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['ingreso'])){ $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['ingreso'] = 0;}
									if(!isset($mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['egreso'])){ $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['egreso'] = 0;}
									if(!isset($mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['gasto'])){ $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['gasto'] = 0;}
									switch ($existencias['idTipo']) {
										//Ingresos
										case 1:
											$mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['ingreso'] = $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['ingreso'] + $existencias['Valor'];
											break;
										//Egreso
										case 2:
											$mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['egreso'] = $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['egreso'] + $existencias['Valor'];
											break;
										//gasto
										case 3:
											$mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['gasto'] = $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['gasto'] + $existencias['Valor'];
											break;
										
									}
									
								}
								
								$xmes = mes_actual();
								$xaño = ano_actual();
								$grafico = array();
								for ($xcontador = 12; $xcontador > 0; $xcontador--) {
									
									if($xmes>0){
										if(isset($mes[$xaño][$xmes]['ingreso'])){   $ndata1 = $mes[$xaño][$xmes]['ingreso'];   }else{$ndata1 = 0;};
										if(isset($mes[$xaño][$xmes]['egreso'])){    $ndata2 = $mes[$xaño][$xmes]['egreso'];    }else{$ndata2 = 0;};
										if(isset($mes[$xaño][$xmes]['gasto'])){     $ndata3 = $mes[$xaño][$xmes]['gasto'];     }else{$ndata3 = 0;};
										$grafico[$xcontador]['mes'] = $xmes;
										$grafico[$xcontador]['año'] = $xaño;
										$grafico[$xcontador]['ingreso'] = $ndata1;
										$grafico[$xcontador]['egreso'] = $ndata2;
										$grafico[$xcontador]['gasto'] = $ndata3;
										
									}else{
										$xmes = 12;
										$xaño = $xaño-1;
										if(isset($mes[$xaño][$xmes]['ingreso'])){   $ndata1 = $mes[$xaño][$xmes]['ingreso'];   }else{$ndata1 = 0;};
										if(isset($mes[$xaño][$xmes]['egreso'])){    $ndata2 = $mes[$xaño][$xmes]['egreso'];    }else{$ndata2 = 0;};
										if(isset($mes[$xaño][$xmes]['gasto'])){     $ndata3 = $mes[$xaño][$xmes]['gasto'];     }else{$ndata3 = 0;};
										$grafico[$xcontador]['mes'] = $xmes;
										$grafico[$xcontador]['año'] = $xaño;
										$grafico[$xcontador]['ingreso'] = $ndata1;
										$grafico[$xcontador]['egreso'] = $ndata2;
										$grafico[$xcontador]['gasto'] = $ndata3;
									}
									$xmes = $xmes-1;
									
								}
								?>
									
								
								
								<script type="text/javascript">
								  google.charts.setOnLoadCallback(drawChart);
								  function drawChart() {
									var data = google.visualization.arrayToDataTable([
									
									  ['Meses', 'Ingresos', 'Egresos', 'Gastos'],
									  <?php
									  echo "['".numero_a_mes($grafico[1]['mes'])."', ".$grafico[1]['ingreso'].", ".$grafico[1]['egreso'].", ".$grafico[1]['gasto']." ],";
									  echo "['".numero_a_mes($grafico[2]['mes'])."', ".$grafico[2]['ingreso'].", ".$grafico[2]['egreso'].", ".$grafico[2]['gasto']." ],";
									  echo "['".numero_a_mes($grafico[3]['mes'])."', ".$grafico[3]['ingreso'].", ".$grafico[3]['egreso'].", ".$grafico[3]['gasto']." ],";
									  echo "['".numero_a_mes($grafico[4]['mes'])."', ".$grafico[4]['ingreso'].", ".$grafico[4]['egreso'].", ".$grafico[4]['gasto']." ],";
									  echo "['".numero_a_mes($grafico[5]['mes'])."', ".$grafico[5]['ingreso'].", ".$grafico[5]['egreso'].", ".$grafico[5]['gasto']." ],";
									  echo "['".numero_a_mes($grafico[6]['mes'])."', ".$grafico[6]['ingreso'].", ".$grafico[6]['egreso'].", ".$grafico[6]['gasto']." ],";
									  echo "['".numero_a_mes($grafico[7]['mes'])."', ".$grafico[7]['ingreso'].", ".$grafico[7]['egreso'].", ".$grafico[7]['gasto']." ],";
									  echo "['".numero_a_mes($grafico[8]['mes'])."', ".$grafico[8]['ingreso'].", ".$grafico[8]['egreso'].", ".$grafico[8]['gasto']." ],";
									  echo "['".numero_a_mes($grafico[9]['mes'])."', ".$grafico[9]['ingreso'].", ".$grafico[9]['egreso'].", ".$grafico[9]['gasto']." ],";
									  echo "['".numero_a_mes($grafico[10]['mes'])."', ".$grafico[10]['ingreso'].", ".$grafico[10]['egreso'].", ".$grafico[10]['gasto']." ],";
									  echo "['".numero_a_mes($grafico[11]['mes'])."', ".$grafico[11]['ingreso'].", ".$grafico[11]['egreso'].", ".$grafico[11]['gasto']." ],";
									  echo "['".numero_a_mes($grafico[12]['mes'])."', ".$grafico[12]['ingreso'].", ".$grafico[12]['egreso'].", ".$grafico[12]['gasto']." ]";
										?>
		
									
									]);

									var options = {
									  chart: {
										title: 'Balance',
										subtitle: 'Movimientos ultimos 12 Meses',
										
									  },
									  vAxis: {format: 'none'},
									  legend: { position: 'none' },
									  colors: ['#605ca8', '#00a65a', '#f39c12'],
									 
									};

									var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

									chart.draw(data, options);
								  }
								</script>
								
								<div id="columnchart_material" style="width: 100%; height: 500px;"></div>

							</div>
						</div>
						<div class="col-md-4">

							<div class="info-box bg-purple">
								<span class="info-box-icon"><i class="fa fa-tags"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Total Ingresos del mes</span>
									<span class="info-box-number">
										<?php if(isset($grafico[12]['ingreso'])&&$grafico[12]['ingreso']!=''){
											echo Valores($grafico[12]['ingreso'], 0);
										}else{
											echo Valores(0, 0);
										}?>
									</span>
									<div class="progress">
										<div class="progress-bar" style="width: 100%"></div>
									</div>
									<?php if($n_permisos['tran_4']=='1' or $arrUsuario['tipo']=='SuperAdmin') {?>
										<span class="progress-description">
											<a href="<?php echo $trans_4; ?>?pagina=1" class="faa-parent animated-hover">
												Ver Ingresos <i class="fa fa-arrow-circle-right faa-passing"></i>
											</a>
										</span>
									<?php } ?>
								</div>
							</div>
							
							<div class="info-box bg-green">
								<span class="info-box-icon"><i class="fa fa-tags"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Total Egresos del mes</span>
									<span class="info-box-number">
										<?php if(isset($grafico[12]['egreso'])&&$grafico[12]['egreso']!=''){
											echo Valores($grafico[12]['egreso'], 0);
										}else{
											echo Valores(0, 0);
										}?>
									</span>
									<div class="progress">
										<div class="progress-bar" style="width: 100%"></div>
									</div>
									<?php if($n_permisos['tran_5']=='1' or $arrUsuario['tipo']=='SuperAdmin') {?>
										<span class="progress-description">
											<a href="<?php echo $trans_5; ?>?pagina=1" class="faa-parent animated-hover">
												Ver Egresos <i class="fa fa-arrow-circle-right faa-passing"></i>
											</a>
										</span>
									<?php } ?>
								</div>
							</div>
							
							<div class="info-box bg-yellow">
								<span class="info-box-icon"><i class="fa fa-tags"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Total Gastos del mes</span>
									<span class="info-box-number">
										<?php if(isset($grafico[12]['gasto'])&&$grafico[12]['gasto']!=''){
											echo Valores($grafico[12]['gasto'], 0);
										}else{
											echo Valores(0, 0);
										}?>
									</span>
									<div class="progress">
										<div class="progress-bar" style="width: 100%"></div>
									</div>
									<?php if($n_permisos['tran_6']=='1' or $arrUsuario['tipo']=='SuperAdmin') {?>
										<span class="progress-description">
											<a href="<?php echo $trans_6; ?>?pagina=1" class="faa-parent animated-hover">
												Ver Gastos <i class="fa fa-arrow-circle-right faa-passing"></i>
											</a>
										</span>
									<?php } ?>
								</div>
							</div>
							
		
							
							
							
              
						</div>
					</div>
                </div>
                <div class="box-footer"></div>
            </div>
		</div>
	</div>        
</div>             
            
         
	<div class="row">
		
		<div class="col-lg-6">
			<div class="box">	
				<header>		
					<div class="icons"><i class="fa fa-table"></i></div><h5>Ultimos movimientos</h5>	
				</header>
				<div class="table-responsive">    
					<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
						<thead>
							<tr role="row">
								<th>Movimiento</th>
								<th>Fecha</th>
								<th>Producto</th>
								<th>Bodega</th>
								<th>Cantidad</th>
							</tr>
						</thead>
		  
						<tbody role="alert" aria-live="polite" aria-relevant="all">
						<?php foreach ($arrMovimientos as $mov) { ?>
							
							<tr class="odd">
								<td><?php echo $mov['TipoMovimiento']; ?></td>
								<td><?php echo Fecha_estandar($mov['Creacion_fecha']); ?></td>
								<td><?php echo $mov['NombreProducto']; ?></td>
								<td><?php echo $mov['NombreBodega']; ?></td>
								<td><?php 
								if(isset($mov['Cantidad_ing'])&&$mov['Cantidad_ing']!=0){
									echo 'Ingreso '.Cantidades_decimales_justos($mov['Cantidad_ing']).' '.$mov['UnidadMedida'];
								}else{
									echo 'Egreso '.Cantidades_decimales_justos($mov['Cantidad_eg']).' '.$mov['UnidadMedida'];
								}
								?>
								</td>
								
					
							</tr>
						<?php } ?>                     
						</tbody>
					</table>
				</div>
			
			</div>
		</div>


		<div class="col-lg-6">
			<div class="box">
				<header>
					<div class="icons"><i class="fa fa-table"></i></div><h5>Productos con bajo Stock</h5>        			  
				</header> 
				<div class="table-responsive">                 
					<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
						<thead>
							<tr role="row">
								<th>Producto</th>
								<th>Stock Min</th>
								<th>Stock Act</th>
							</tr>
						</thead>               
						<tbody role="alert" aria-live="polite" aria-relevant="all">
						<?php foreach ($arrProductos as $productos) { ?>
						<?php $stock_actual = $productos['stock_entrada'] - $productos['stock_salida']; ?>
						<?php if ($productos['StockLimite']>$stock_actual){?>
							<tr class="odd">
								<td><?php echo $productos['NombreProd']; ?></td>
								<td><?php echo Cantidades_decimales_justos($productos['StockLimite']).' '.$productos['UnidadMedida']; ?></td>
								<td><?php echo Cantidades_decimales_justos($stock_actual).' '.$productos['UnidadMedida']; ?></td>
							</tr>
						<?php } 
						} ?>                    
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


<?php }?>          
            
            
            
            
            
    
    
    
    
 
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
            
            
            
            
            
            
            
            
            
            
            
            
            
            
			<!-- InstanceEndEditable -->   
            </div>
        </div>
      </div> 
    </div>
    <?php require_once 'core/footer.php';?>
    <?php require_once 'assets/lib/avgrund/avgrund.php';?>
  </body>
</html>
