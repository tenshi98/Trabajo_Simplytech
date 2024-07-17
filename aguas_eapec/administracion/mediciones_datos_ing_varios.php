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
/** Include PHPExcel_IOFactory */
require_once 'lib_PHPExcel/PHPExcel/IOFactory.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "mediciones_datos_ing_varios.php";
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
	$form_obligatorios = 'Fecha,Nombre,idSistema,idMarcadores,idTipoMedicion';
	$form_trabajo= 'create_new';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_mediciones_datos.php';
}
//formulario para editar
if ( !empty($_POST['submit_add_client']) )  { 
	//se agregan ubicaciones
	$location .='&view=true';
	//Llamamos al formulario
	$form_obligatorios = 'idCliente,idMarcadores,Consumo';
	$form_trabajo= 'add_cliente';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_mediciones_datos.php';
}
//formulario para editar
if ( !empty($_POST['submit_datos']) )  { 
	//se agregan ubicaciones
	$location .='&view=true';
	//Llamamos al formulario
	$form_obligatorios = 'Fecha,Nombre,idMarcadores,idTipoMedicion';
	$form_trabajo= 'edit_datos';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_mediciones_datos.php';
}
//se borra n los datos temporales
if ( !empty($_GET['clear_all']) )  { 
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'clear_all';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_mediciones_datos.php';
}
//se crea la ot
if ( !empty($_GET['crear_ingreso']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'crear_ingreso';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_mediciones_datos.php';	
}

//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//se agregan ubicaciones
	$location .='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_obligatorios = 'Consumo,idDatosDetalle';
	$form_trabajo= 'edit_consumo';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_mediciones_datos.php';
}
//formulario para editar
if ( !empty($_POST['submit_mod']) )  { 
	//se agregan ubicaciones
	$location .='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_obligatorios = 'idDatos,Fecha,Nombre';
	$form_trabajo= 'edit_datos_basicos';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_mediciones_datos.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_mediciones_datos.php';	
}
//se borra un dato
if ( !empty($_GET['del_cliente']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del_cliente';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_mediciones_datos.php';	
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
if ( ! empty($_GET['moddatos']) ) {
//Se verifica el tipo de usuario
if($arrUsuario['tipo']=='SuperAdmin'){
	$z = 'idSistema>0';
}else{
	$z = 'idSistema='.$arrUsuario['idSistema'];
} ?>

<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificacion de los datos basicos</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post"  name="form1">
			
			<?php 
			//Se verifican si existen los datos
			if(isset($Fecha)) {            $x1  = $Fecha;            }else{$x1  = $_SESSION['basicos']['Fecha'];}
			if(isset($idMarcadores)) {     $x2  = $idMarcadores;     }else{$x2  = $_SESSION['basicos']['idMarcadores'];}
			if(isset($idTipoMedicion)) {   $x3  = $idTipoMedicion;   }else{$x3  = $_SESSION['basicos']['idTipoMedicion'];}
			if(isset($Nombre)) {           $x4  = $Nombre;           }else{$x4  = $_SESSION['basicos']['Nombre'];}
			if(isset($Observaciones)) {    $x5  = $Observaciones;    }else{$x5  = $_SESSION['basicos']['Observaciones'];}
		

			//se dibujan los inputs
			echo form_date('Fecha de Facturacion','Fecha', $x1, 2);
			echo form_select_filter('Medidor','idMarcadores', $x2, 2, 'idMarcadores', 'Nombre', 'marcadores_listado', $z, $dbConn);
			echo form_select('Tipo Medicion','idTipoMedicion', $x3, 2, 'idTipoMedicion', 'Nombre', 'mediciones_datos_tipo_medicion', 0, $dbConn);
			echo form_input('text', 'Nombre', 'Nombre', $x4, 2);
			echo form_textarea('Observaciones', 'Observaciones', $x5, 1);
			
				
				
	 
			?>

			<div class="form-group">
            	<input type="hidden" name="idDatos" value="<?php echo $_GET['modBase']; ?>" >
				<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_datos"> 
				<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['addclient']) ) { 

if($arrUsuario['tipo']=='SuperAdmin'){
	$z  = 'clientes_listado.idSistema>0';
	$z .= ' AND clientes_listado.idMarcadores = '.$_SESSION['basicos']['idMarcadores'];
	$z .= ' AND clientes_listado.idRemarcadores !=0';
}else{
	$z  = 'clientes_listado.idSistema='.$arrUsuario['idSistema'];
	$z .= ' AND clientes_listado.idMarcadores = '.$_SESSION['basicos']['idMarcadores'];
	$z .= ' AND clientes_listado.idRemarcadores !=0';
}?>
 <div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Ingresar cliente</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" name="form1" >
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idCliente)) {        $x3  = $idCliente;        }else{$x3  = '';}
				if(isset($Consumo)) {          $x4  = $Consumo;          }else{$x4  = '';}
				if(isset($nCliente)) {         $x7  = $nCliente;         }else{$x7  = '';}
				if(isset($codMedidor)) {       $x8  = $codMedidor;       }else{$x8  = '';}
				if(isset($codRemarcador)) {    $x9  = $codRemarcador;    }else{$x9  = '';}
				if(isset($idMarcadores)) {     $x10 = $idMarcadores;     }else{$x10 = '';}
				if(isset($idRemarcadores)) {   $x11 = $idRemarcadores;   }else{$x11 = '';}
				if(isset($TipoMIU)) {          $x12 = $TipoMIU;          }else{$x12 = '';}
				if(isset($MIU)) {              $x13 = $MIU;              }else{$x13 = '';}
				if(isset($Contador)) {         $x14 = $Contador;         }else{$x14 = '';}
				
				
				//se dibujan los inputs
				echo form_select_filter_custom('Cliente','idCliente', $x3, 2, 'idCliente', 'Identificador', 'clientes_listado', $z, 'Identificador', $dbConn);
				
				echo '<div class="form-group" id="div_">
					<label class="control-label col-lg-4" id="label_">Nombre Cliente</label>
					<div class="col-lg-8">
						<input type="text" placeholder="Nombre Cliente" class="form-control"  name="nCliente" id="nCliente" disabled value="'.$x7.'">
					</div>
				</div>';
				
				echo '<div class="form-group" id="div_">
					<label class="control-label col-lg-4" id="label_">Cod Medidor</label>
					<div class="col-lg-8">
						<input type="text" placeholder="Cod Medidor" class="form-control"  name="codMedidor" id="codMedidor" disabled value="'.$x8.'">
					</div>
				</div>';
				
				echo '<div class="form-group" id="div_">
					<label class="control-label col-lg-4" id="label_">Cod Remarcador</label>
					<div class="col-lg-8">
						<input type="text" placeholder="Cod Remarcador" class="form-control"  name="codRemarcador" id="codRemarcador" disabled value="'.$x9.'">
					</div>
				</div>';
				
				echo form_input('text', 'Tipo MIU', 'TipoMIU', $x12, 1);
				echo form_input('text', 'MIU', 'MIU', $x13, 1);
				echo form_input('text', 'Contador', 'Contador', $x14, 1);
				
				echo form_input_number('Consumo', 'Consumo', $x4, 2);
				
				
				echo '<input type="hidden" name="idMarcadores"    id="idMarcadores"    value="'.$x10.'">';
				echo '<input type="hidden" name="idRemarcadores"  id="idRemarcadores"  value="'.$x11.'">';

				
				
				//Imprimo las variables
				$arrClientes = array();
				$query = "SELECT 
				clientes_listado.idCliente,
				clientes_listado.Nombre AS NombreCliente,
				clientes_listado.idMarcadores,
				clientes_listado.idRemarcadores,
				marcadores_listado.Nombre AS Medidor,
				marcadores_remarcadores.Nombre AS Remarcador
				
				FROM `clientes_listado`
				LEFT JOIN `marcadores_listado`        ON marcadores_listado.idMarcadores         = clientes_listado.idMarcadores
				LEFT JOIN `marcadores_remarcadores`   ON marcadores_remarcadores.idRemarcadores  = clientes_listado.idRemarcadores
				WHERE ".$z."
				ORDER BY clientes_listado.idCliente";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrClientes,$row );
				}
				
				echo '<script>';
				foreach ($arrClientes as $tipo) {
					echo 'var nombre_cliente_'.$tipo['idCliente'].'= "'.$tipo['NombreCliente'].'";';	
				}
				foreach ($arrClientes as $tipo) {
					echo 'var medidor_cliente_'.$tipo['idCliente'].'= "'.$tipo['Medidor'].'";';	
				}
				foreach ($arrClientes as $tipo) {
					echo 'var remarcador_cliente_'.$tipo['idCliente'].'= "'.$tipo['Remarcador'].'";';	
				}
				foreach ($arrClientes as $tipo) {
					echo 'var id_medidor_cliente_'.$tipo['idCliente'].'= "'.$tipo['idMarcadores'].'";';	
				}
				foreach ($arrClientes as $tipo) {
					echo 'var id_remarcador_cliente_'.$tipo['idCliente'].'= "'.$tipo['idRemarcadores'].'";';	
				}
				
			
				?>
				document.getElementById("idCliente").onchange = function() {myFunction()};

				function myFunction() {
					var Componente = document.getElementById("idCliente").value;
					if (Componente != "") {
						
						nombre_cliente        = eval("nombre_cliente_" + Componente)
						medidor_cliente       = eval("medidor_cliente_" + Componente)
						remarcador_cliente    = eval("remarcador_cliente_" + Componente)
						id_medidor_cliente    = eval("id_medidor_cliente_" + Componente)
						id_remarcador_cliente = eval("id_remarcador_cliente_" + Componente)
						
						//escribo dentro del input
						var elem1 = document.getElementById("nCliente");
						var elem2 = document.getElementById("codMedidor");
						var elem3 = document.getElementById("codRemarcador");
						
						var elem4 = document.getElementById("idMarcadores");
						var elem5 = document.getElementById("idRemarcadores");
						
						elem1.value = nombre_cliente;
						elem2.value = medidor_cliente;
						elem3.value = remarcador_cliente;
						elem4.value = id_medidor_cliente;
						elem5.value = id_remarcador_cliente;
					}
				}
				</script>
				
				<div class="form-group">
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_add_client">
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
				</div>
                      
			</form> 
                    
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['modBase']) ) {
$query = "SELECT Fecha, Nombre, Observaciones
FROM `mediciones_datos`
WHERE idDatos = {$_GET['modBase']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado); ?>

<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificacion de los datos basicos</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post"  name="form1">
			
			<?php 
			//Se verifican si existen los datos
			if(isset($Fecha)) {          $x1  = $Fecha;          }else{$x1  = $rowdata['Fecha'];}
			if(isset($Nombre)) {         $x2  = $Nombre;         }else{$x2  = $rowdata['Nombre'];}
			if(isset($Observaciones)) {  $x3  = $Observaciones;  }else{$x3  = $rowdata['Observaciones'];}
				
			//se dibujan los inputs
			echo form_date('Fecha de Facturacion','Fecha', $x1, 2);
			echo form_input('text', 'Nombre', 'Nombre', $x2, 2);
			echo form_textarea('Observaciones', 'Observaciones', $x3, 1);
	 
			?>

			<div class="form-group">
            	<input type="hidden" name="idDatos" value="<?php echo $_GET['modBase']; ?>" >
				<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_mod"> 
				<a href="<?php echo $location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['edit']) ) {
$query = "SELECT Consumo
FROM `mediciones_datos_detalle`
WHERE idDatosDetalle = {$_GET['edit']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado); ?>

<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificacion del Consumo</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post"  name="form1">
			
			<?php 
			//Se verifican si existen los datos
			if(isset($Consumo)) {  $x1  = $Consumo;   }else{$x1  = $rowdata['Consumo'];}
	

			//se dibujan los inputs
			echo form_input_number('Consumo', 'Consumo', $x1, 2);
				 
			?>

			<div class="form-group">
            	<input type="hidden" name="idDatosDetalle" value="<?php echo $_GET['edit']; ?>" >
				<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_edit"> 
				<a href="<?php echo $location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
		</div>
	</div>
</div>
	
	
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['id']) ) {
// Se traen todos los datos de la subida
$query = "SELECT 
mediciones_datos.fCreacion,
mediciones_datos.Fecha,
mediciones_datos.Nombre AS NombreArchivo,
mediciones_datos.Observaciones,
usuarios_listado.Nombre AS NombreUsuario,
core_sistemas.Nombre AS Sistema,
marcadores_listado.Nombre AS Marcadores,
mediciones_datos.ConsumoMedidor,
mediciones_datos_tipo_medicion.Nombre AS TipoMedicion

FROM `mediciones_datos`
LEFT JOIN `core_sistemas`                   ON core_sistemas.idSistema                          = mediciones_datos.idSistema
LEFT JOIN `usuarios_listado`                ON usuarios_listado.idUsuario                       = mediciones_datos.idUsuario
LEFT JOIN `marcadores_listado`              ON marcadores_listado.idMarcadores                  = mediciones_datos.idMarcadoresUsado
LEFT JOIN `mediciones_datos_tipo_medicion`  ON mediciones_datos_tipo_medicion.idTipoMedicion    = mediciones_datos.idTipoMedicion


WHERE mediciones_datos.idDatos = {$_GET['id']} ";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);
				


// Se trae un listado con todos los datos subidos correctamente
$arrDatosCorrectos = array();
$query = "SELECT 
mediciones_datos_detalle.idDatosDetalle,
clientes_listado.Nombre,
clientes_listado.Direccion,
clientes_listado.Identificador,
clientes_listado.UnidadHabitacional,
mediciones_datos_detalle.Consumo,

marcadores_listado.Nombre AS Marcadores,
marcadores_remarcadores.Nombre AS Remarcadores

FROM `mediciones_datos_detalle` 

LEFT JOIN `clientes_listado`                     ON clientes_listado.idCliente                         = mediciones_datos_detalle.idCliente
LEFT JOIN `marcadores_listado`                   ON marcadores_listado.idMarcadores                    = mediciones_datos_detalle.idMarcadores
LEFT JOIN `marcadores_remarcadores`              ON marcadores_remarcadores.idRemarcadores             = mediciones_datos_detalle.idRemarcadores

WHERE mediciones_datos_detalle.idDatos = {$_GET['id']} ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrDatosCorrectos,$row );
}



// Se trae un listado con todos los datos subidos correctamente
$arrDatosErroneos = array();
$query = "SELECT ID_Cliente, ID_Nombre, ID_Direccion,Consumo, ID_FLectura, ID_TipoMIU, ID_MIU, ID_Contador
FROM `mediciones_datos_erroneos` 
WHERE idDatos = {$_GET['id']} ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrDatosErroneos,$row );
}


?>

<style>
#address {
    height: auto !important;
}
.otdata td {
    text-align: left !important;
}
.otdata{
	width: 65% !important;
}
.otdata2{
	width: 30% !important;
}

</style> 




<div class="col-lg-11 fcenter table-responsive">

<div id="page-wrap">
    <div id="header"> Modificacion Datos </div>
   

    <div id="customer">


        <table id="meta" class="fleft otdata">
            <tbody>
				<tr>
                    <td class="meta-head"><strong>DATOS BASICOS</strong></td>
                    <td class="meta-head"><a href="<?php echo $location.'&id='.$_GET['id'].'&modBase='.$_GET['id'] ?>" class="btn btn-xs btn-primary fright">Modificar</a></td>
                </tr>
				<tr>
                    <td class="meta-head">Fecha Creacion</td>
                    <td><?php echo Fecha_estandar($rowdata['fCreacion']); ?></td>
                </tr>
				<tr>
                    <td class="meta-head">Creador</td>
                    <td><?php echo $rowdata['NombreUsuario']?></td>
                </tr>
				<tr>
                    <td class="meta-head">Nombre del Archivo</td>
                    <td><?php echo $rowdata['NombreArchivo']?></td>
                </tr>
				<tr>
                    <td class="meta-head">Sistema</td>
                    <td><?php echo $rowdata['Sistema']?></td>
                </tr>
                <tr>
                    <td class="meta-head">Medidor</td>
                    <td><?php echo $rowdata['Marcadores']?></td>
                </tr>
                <tr>
                    <td class="meta-head">Medicion del periodo</td>
                    <td><?php echo Cantidades_decimales_justos($rowdata['ConsumoMedidor']).' Metros Cubicos'; ?></td>
                </tr>
                <tr>
                    <td class="meta-head">Distribucion de diferencia</td>
                    <td><?php echo $rowdata['TipoMedicion']?></td>
                </tr>
                
                
                
            </tbody>
        </table>
        <table id="meta" class="otdata2">
            <tbody>
                <tr>
					<td class="meta-head">Fecha Facturacion</td>
					<td><?php echo Fecha_estandar($rowdata['Fecha']);?></td>
				</tr>
            </tbody>
        </table>
    </div>
    <table id="items">
        <tbody>
            
			<tr><th colspan="10">Detalle</th></tr>		  
            
            <?php if($arrDatosCorrectos) { ?>
				<tr class="item-row fact_tittle"><td colspan="10"><strong>Datos Ingresados Correctamente</strong></td></tr>
				<tr class="item-row linea_punteada" bgcolor="#F0F0F0">
					<td class="item-name"><strong>Identificador</strong></td>
					<td class="item-name" colspan="3"><strong>Cliente</strong></td>
					<td class="item-name"><strong>Medidor</strong></td>
					<td class="item-name"><strong>Remarcador</strong></td>
					<td class="item-name"><strong>Direccion</strong></td>
					<td class="item-name"><strong>UH</strong></td>
					<td class="item-name"><strong>Consumo</strong></td>
					<td class="item-name"><strong>Acciones</strong></td>
				</tr>
				<?php foreach ($arrDatosCorrectos as $datos) { ?>
					<tr class="item-row linea_punteada">
						<td class="item-name"><?php echo $datos['Identificador']; ?></td>
						<td class="item-name" colspan="3"><?php echo $datos['Nombre']; ?></td>
						<td class="item-name"><?php echo $datos['Marcadores']; ?></td>
						<td class="item-name"><?php echo $datos['Remarcadores']; ?></td>
						<td class="item-name"><?php echo $datos['Direccion']; ?></td>
						<td class="item-name"><?php echo $datos['UnidadHabitacional']; ?></td>
						<td class="item-name"><?php echo cantidades($datos['Consumo'], 3); ?></td>
						<td class="item-name">
							<div class="btn-group widthtd120" >
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$_GET['id'].'&edit='.$datos['idDatosDetalle']; ?>" data-placement="bottom" title="Editar Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
							</div>
						</td>
					</tr> 
				<?php } ?>
				<tr id="hiderow"><td colspan="10"></td></tr>
			<?php } ?>
			
			<?php if($arrDatosErroneos) { ?>
				<tr class="item-row fact_tittle"><td colspan="10"><strong>Datos Erroneos</td></tr>
				<tr class="item-row linea_punteada" bgcolor="#F0F0F0">
					<td class="item-name" colspan="1"><strong>N. Cliente</strong></td>
					<td class="item-name" colspan="2"><strong>Cliente</strong></td>
					<td class="item-name" colspan="2"><strong>Direccion</strong></td>
					<td class="item-name" colspan="1"><strong>Medicion</strong></td>
					<td class="item-name" colspan="1"><strong>Fecha lectura</strong></td>
					<td class="item-name" colspan="1"><strong>Tipo MIU</strong></td>
					<td class="item-name" colspan="1"><strong>MIU</strong></td>
					<td class="item-name" colspan="1"><strong>Contador</strong></td>	
				</tr>
				<?php foreach ($arrDatosErroneos as $datos) { ?>
					<tr class="item-row linea_punteada">
						<td class="item-name" colspan="1"><?php echo $datos['ID_Cliente']; ?></td>
						<td class="item-name" colspan="2"><?php echo $datos['ID_Nombre']; ?></td>
						<td class="item-name" colspan="2"><?php echo $datos['ID_Direccion']; ?></td>
						<td class="item-name" colspan="1"><?php echo $datos['Consumo']; ?></td>
						<td class="item-name" colspan="1"><?php echo $datos['ID_FLectura']; ?></td>
						<td class="item-name" colspan="1"><?php echo $datos['ID_TipoMIU']; ?></td>
						<td class="item-name" colspan="1"><?php echo $datos['ID_MIU']; ?></td>
						<td class="item-name" colspan="1"><?php echo $datos['ID_Contador']; ?></td>
					</tr> 
				<?php } ?>
				<tr id="hiderow"><td colspan="10"></td></tr>
			<?php } ?>



			
            <tr>
                <td colspan="10" class="blank"> 
					<p>
						<?php 
						if(isset($rowdata['Observaciones'])&&$rowdata['Observaciones']!=''){
							echo $rowdata['Observaciones'];
						}else{
							echo 'Sin Observaciones';
						}?>
					</p>
                </td>
            </tr>
            <tr>
                <td colspan="10" class="blank"><p>Observaciones</p></td> 
            </tr>
        </tbody>
    </table>
    	<div class="clearfix"></div>
    	
    </div>


</div>
	
	



<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px; margin-top:30px">
<a href="<?php echo $location; ?>"  class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['view']) ) {
if($arrUsuario['tipo']=='SuperAdmin'){
	$z = 'clientes_listado.idSistema>0';
}else{
	$z = 'clientes_listado.idSistema='.$arrUsuario['idSistema'];
}

// Se traen todos los datos
$query = "SELECT  Nombre
FROM `usuarios_listado`
WHERE idUsuario = {$_SESSION['basicos']['idUsuario']} ";
$resultado = mysqli_query ($dbConn, $query);
$rowCreador = mysqli_fetch_assoc ($resultado);
				
// Se traen todos los datos
$query = "SELECT  Nombre
FROM `core_sistemas`
WHERE idSistema = {$_SESSION['basicos']['idSistema']} ";
$resultado = mysqli_query ($dbConn, $query);
$rowSistema = mysqli_fetch_assoc ($resultado);

// Se traen todos los datos
$query = "SELECT  Nombre
FROM `marcadores_listado`
WHERE idMarcadores = {$_SESSION['basicos']['idMarcadores']} ";
$resultado = mysqli_query ($dbConn, $query);
$rowMarcadores = mysqli_fetch_assoc ($resultado);

// Se traen todos los datos
$query = "SELECT  Nombre
FROM `mediciones_datos_tipo_medicion`
WHERE idTipoMedicion = {$_SESSION['basicos']['idTipoMedicion']} ";
$resultado = mysqli_query ($dbConn, $query);
$rowTipoMedicion = mysqli_fetch_assoc ($resultado);

// Se trae un listado con todos los trabajadores
$arrClientes = array();
$query = "SELECT 
clientes_listado.idCliente,
clientes_listado.Nombre AS NombreCliente,
clientes_listado.idMarcadores,
clientes_listado.idRemarcadores,
clientes_listado.Identificador,		
clientes_listado.Direccion,
clientes_listado.UnidadHabitacional,

marcadores_listado.Nombre AS Medidor,
marcadores_remarcadores.Nombre AS Remarcador
				
FROM `clientes_listado`
LEFT JOIN `marcadores_listado`        ON marcadores_listado.idMarcadores         = clientes_listado.idMarcadores
LEFT JOIN `marcadores_remarcadores`   ON marcadores_remarcadores.idRemarcadores  = clientes_listado.idRemarcadores
WHERE ".$z."
ORDER BY clientes_listado.idCliente";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrClientes,$row );
}


?>

<style>
#address {
    height: auto !important;
}
.otdata td {
    text-align: left !important;
}
.otdata{
	width: 65% !important;
}
.otdata2{
	width: 30% !important;
}

</style> 




<div class="col-lg-11 fcenter table-responsive">

<div id="page-wrap">
    <div id="header"> Ingreso Datos </div>
   

    <div id="customer">


        <table id="meta" class="fleft otdata">
            <tbody>
				<tr>
                    <td class="meta-head"><strong>DATOS BASICOS</strong></td>
                    <td class="meta-head"><a href="<?php echo $location.'&view=true&moddatos=true' ?>" class="btn btn-xs btn-primary fright">Modificar</a></td>
                </tr>
				<tr>
                    <td class="meta-head">Fecha Creacion</td>
                    <td><?php echo Fecha_estandar($_SESSION['basicos']['fCreacion']); ?></td>
                </tr>
				<tr>
                    <td class="meta-head">Creador</td>
                    <td><?php echo $rowCreador['Nombre']?></td>
                </tr>
				<tr>
                    <td class="meta-head">Nombre del Archivo</td>
                    <td><?php echo $_SESSION['basicos']['Nombre']?></td>
                </tr>
				<tr>
                    <td class="meta-head">Sistema</td>
                    <td><?php echo $rowSistema['Nombre']?></td>
                </tr>
                <tr>
                    <td class="meta-head">Medidor</td>
                    <td><?php echo $rowMarcadores['Nombre']?></td>
                </tr>
                <tr>
                    <td class="meta-head">Medicion del periodo</td>
                    <td><?php echo Cantidades_decimales_justos($_SESSION['basicos']['Consumo']).' Metros Cubicos'; ?></td>
                </tr>
                 <tr>
                    <td class="meta-head">Distribucion de diferencia</td>
                    <td><?php echo $rowTipoMedicion['Nombre']?></td>
                </tr>
            </tbody>
        </table>
        <table id="meta" class="otdata2">
            <tbody>
                <tr>
					<td class="meta-head">Fecha Facturacion</td>
					<td><?php echo Fecha_estandar($_SESSION['basicos']['Fecha']);?></td>
				</tr>
            </tbody>
        </table>
    </div>
    <table id="items">
        <tbody>
            
			<tr>
				<th colspan="9">Detalle</th>
				<th colspan="1"><a href="<?php echo $location.'&view=true&addclient=true' ?>" class="btn btn-xs btn-primary fright">Agregar</a></th>
			</tr>		  
            
            <?php if (isset($_SESSION['clientes'])){ ?>
				<tr class="item-row linea_punteada" bgcolor="#F0F0F0">
					<td class="item-name"><strong>Identificador</strong></td>
					<td class="item-name" colspan="3"><strong>Cliente</strong></td>
					<td class="item-name"><strong>Medidor</strong></td>
					<td class="item-name"><strong>Remarcador</strong></td>
					<td class="item-name"><strong>Direccion</strong></td>
					<td class="item-name"><strong>UH</strong></td>
					<td class="item-name"><strong>Consumo</strong></td>
					<td class="item-name"><strong>Acciones</strong></td>
				</tr>
				
	

				<?php 
				//recorro el lsiatdo entregado por la base de datos
				foreach ($arrClientes as $cliente) { 
					foreach ($_SESSION['clientes'] as $key => $clientes){
						if($cliente['idCliente']==$clientes['idCliente']){?>
							<tr class="item-row linea_punteada">
								<td class="item-name"><?php echo $cliente['Identificador']; ?></td>
								<td class="item-name" colspan="3"><?php echo $cliente['NombreCliente']; ?></td>
								<td class="item-name"><?php echo $cliente['Medidor']; ?></td>
								<td class="item-name"><?php echo $cliente['Remarcador']; ?></td>
								<td class="item-name"><?php echo $cliente['Direccion']; ?></td>
								<td class="item-name"><?php echo $cliente['UnidadHabitacional']; ?></td>
								<td class="item-name"><?php echo cantidades($clientes['Consumo'], 3); ?></td>
								<td class="item-name">
									<div class="btn-group widthtd120" >
										<?php 
										$ubicacion = $location.'&view=true&del_cliente='.$clientes['idCliente'];
										$dialogo   = '¿Realmente deseas eliminar al cliente '.$cliente['NombreCliente'].'?';?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" data-placement="bottom" title="Borrar Cliente" data-toggle="tooltip" class="btn btn-metis-1 btn-sm info-tooltip"><i class="fa fa-trash-o"></i></a>							
									</div>
								</td>
							</tr> 
				  <?php }
					}
				}?>
			
			
			
				
				<tr id="hiderow"><td colspan="10"></td></tr>
			<?php } ?>
			
			


			
            <tr>
                <td colspan="10" class="blank"> 
					<p>
						<?php 
						if(isset($_SESSION['basicos']['Observaciones'])&&$_SESSION['basicos']['Observaciones']!=''){
							echo $_SESSION['basicos']['Observaciones'];
						}else{
							echo 'Sin Observaciones';
						}?>
					</p>
                </td>
            </tr>
            <tr>
                <td colspan="10" class="blank"><p>Observaciones</p></td> 
            </tr>
        </tbody>
    </table>
    	<div class="clearfix"></div>
    	
    </div>


</div>
	
	
<div class="clearfix"></div>
<div class="col-lg-12 fcenter" >

	<?php 
	$ubicacion = $location.'&view=true&crear_ingreso=true';
	$dialogo   = '¿Desea crear este ingreso de datos?';?>
	<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-primary fright margin_width" data-original-title="" title="">Crear Ingreso</a>
									
									
	<a href="<?php echo $location; ?>"  class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>

	<?php 
	$ubicacion = $location.'&clear_all=true';
	$dialogo   = '¿Realmente deseas eliminar todos los datos del documento en curso?';?>
	<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger fright margin_width" data-original-title="" title="">Borrar Todo</a>

	<div class="clearfix"></div>
</div>


<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['new']) ) { 
//Se verifica el tipo de usuario
if($arrUsuario['tipo']=='SuperAdmin'){
	$z = 'idSistema>0';
}else{
	$z = 'idSistema='.$arrUsuario['idSistema'];
}?>
 <div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Nuevo Ingreso</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" name="form1" >
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Fecha)) {            $x1  = $Fecha;            }else{$x1  = '';}
				if(isset($idMarcadores)) {     $x2  = $idMarcadores;     }else{$x2  = '';}
				if(isset($idTipoMedicion)) {   $x3  = $idTipoMedicion;   }else{$x3  = '';}
				if(isset($Nombre)) {           $x4  = $Nombre;           }else{$x4  = '';}
				if(isset($Observaciones)) {    $x5  = $Observaciones;    }else{$x5  = '';}
				if(isset($idSistema)) {        $x6  = $idSistema;        }else{$x6  = '';}

				//se dibujan los inputs
				echo form_date('Fecha de Facturacion','Fecha', $x1, 2);
				echo form_select_filter('Medidor','idMarcadores', $x2, 2, 'idMarcadores', 'Nombre', 'marcadores_listado', $z, $dbConn);
				echo form_select('Tipo Medicion','idTipoMedicion', $x3, 2, 'idTipoMedicion', 'Nombre', 'mediciones_datos_tipo_medicion', 0, $dbConn);
				echo form_input('text', 'Nombre', 'Nombre', $x4, 2);
				echo form_textarea('Observaciones', 'Observaciones', $x5, 1);
				if($arrUsuario['tipo']=='SuperAdmin'){
					echo form_select('Sistema','idSistema', $x6, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
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
	$z="WHERE mediciones_datos.idSistema>=0";	
}else{
	$z="WHERE mediciones_datos.idSistema={$arrUsuario['idSistema']}";	
}
//se filtran para mostrar solo los ingresos de los remarcadores
$z.=" AND mediciones_datos.idTipo=2";
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idDatos FROM `mediciones_datos` ".$z."";
$registros = mysqli_query ($dbConn, $query);
$cuenta_registros = mysqli_num_rows($registros);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrDatos = array();
$query = "SELECT 
mediciones_datos.idDatos,
mediciones_datos.fCreacion,
mediciones_datos.Fecha,
mediciones_datos.Nombre AS NombreArchivo,
usuarios_listado.Nombre AS NombreUsuario,
core_sistemas.Nombre AS Sistema

FROM `mediciones_datos`
LEFT JOIN `core_sistemas`     ON core_sistemas.idSistema      = mediciones_datos.idSistema
LEFT JOIN `usuarios_listado`  ON usuarios_listado.idUsuario   = mediciones_datos.idUsuario

".$z."
ORDER BY mediciones_datos.Fecha DESC
LIMIT $comienzo, $cant_reg ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrDatos,$row );
}

?>

<div class="form-group">
<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" >Crear Nuevo Ingreso</a><?php } ?>
</div>
<div class="clearfix"></div>                       
                                 
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Ingreso de Datos</h5>
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
						<th>Fecha Ingreso</th>
						<th>Creador</th>
						<th>Nombre</th>
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
						<td><?php echo $cont['NombreArchivo']; ?></td>
						<td><?php echo $cont['Sistema']; ?></td>
						<td>
							<div class="btn-group widthtd120" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_datos_ingreso.php?view='.$cont['idDatos']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$cont['idDatos']; ?>" data-placement="bottom" title="Editar Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$cont['idDatos'];
									$dialogo   = '¿Realmente deseas eliminar el ingreso '.$cont['NombreArchivo'].'?';?>
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
