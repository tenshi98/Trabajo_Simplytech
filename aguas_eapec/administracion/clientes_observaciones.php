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
$original = "clientes_observaciones.php";
$location = $original;

//Se agregan ubicaciones
if(isset($_GET['pagina']) && $_GET['pagina'] != ''){  $location .='?pagina='.$_GET['pagina']; }
if(isset($_GET['search']) && $_GET['search'] != ''){  $location .= "&search=".$_GET['search'] ; }
//Verifico los permisos del usuario sobre la transaccion
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/permisos.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$location.='&idCliente='.$_GET['idCliente'];
	$form_obligatorios = 'idCliente,idUsuario,Fecha,Observacion';
	$form_trabajo= 'insert';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/clientes_observaciones.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$location.='&idCliente='.$_GET['idCliente'];
	$form_obligatorios = 'idObservacion,Observacion';
	$form_trabajo= 'update';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/clientes_observaciones.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$location.='&idCliente='.$_GET['idCliente'];
	$form_obligatorios = '';
	$form_trabajo= 'del';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/clientes_observaciones.php';	
}
//formulario para busqueda
if ( !empty($_POST['search']) )  { 
	//se agregan ubicaciones
	$location .='?pagina=1';
	//Llamamos al formulario
	$form_obligatorios = 'idCliente';
	$form_trabajo= 'search';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_clientes_pagos.php';
}

//se borra un dato
if ( !empty($_GET['del_formulario']) )     {
	//Llamamos al formulario
	$location.='&idCliente='.$_GET['idCliente'];
	$form_obligatorios = '';
	$form_trabajo= 'del_formulario';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/clientes_observaciones.php';	
}
//se borra un dato
if ( !empty($_GET['del_foto']) )     {
	//Llamamos al formulario
	$location.='&idCliente='.$_GET['idCliente'];
	$form_obligatorios = '';
	$form_trabajo= 'del_foto';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/clientes_observaciones.php';	
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Observacion creada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Observacion editada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Observacion borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['edit']) ) { 
//Obtengo los datos de una observacion
$query = "SELECT Observacion, Formulario, Foto
FROM `clientes_observaciones`
WHERE idObservacion = {$_GET['edit']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado); 
 ?>

<div class="col-lg-6 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Editar Observacion</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" name="form1" enctype="multipart/form-data" >

				<?php 
				//Se verifican si existen los datos
				if(isset($Observacion)) {     $x1  = $Observacion;    }else{$x1  = $rowdata['Observacion'];}

				//se dibujan los inputs
				echo form_textarea('Observaciones', 'Observacion', $x1, 2);
				
				/***********************************************/
				//Formularios
				if(isset($rowdata['Formulario'])&&$rowdata['Formulario']!=''){?>
			
					<div class="col-lg-10 fcenter">
						<h3>Nombre Archivo</h3>
						<p><?php echo $rowdata['Formulario']; ?></p>
					</div>
					<a target="new" href="upload/<?php echo $rowdata['Formulario']; ?>" class="btn btn-primary fright margin_width" data-original-title="" title="">Descargar Archivo</a>
					<a href="<?php echo $location.'&idCliente='.$_GET['idCliente'].'&del_formulario='.$_GET['edit']; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Borrar Archivo</a>
					<div class="clearfix" style="margin-bottom:10px;"></div>
				
				<?php }else{          
					//se dibujan los inputs
					echo form_input_file('Formulario','Formulario');
				}
				
				/***********************************************/
				//Formularios
				if(isset($rowdata['Foto'])&&$rowdata['Foto']!=''){?>
			
					<div class="col-lg-10 fcenter">
						<h3>Nombre Archivo</h3>
						<p><?php echo $rowdata['Foto']; ?></p>
					</div>
					<a target="new" href="upload/<?php echo $rowdata['Foto']; ?>" class="btn btn-primary fright margin_width" data-original-title="" title="">Descargar Archivo</a>
					<a href="<?php echo $location.'&idCliente='.$_GET['idCliente'].'&del_foto='.$_GET['edit']; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Borrar Archivo</a>
					<div class="clearfix" style="margin-bottom:10px;"></div>
				
				<?php }else{          
					//se dibujan los inputs
					echo form_input_file('Foto','Foto');
				}
				
				?> 
			
				
				
				<div class="form-group">
					<input type="hidden" name="idObservacion" value="<?php echo $_GET['edit'] ?>">			
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_edit">
					<a href="<?php echo $location.'&idCliente='.$_GET['idCliente']; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>		
				</div>
			</form> 
		</div>
	</div>
</div>
 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['new']) ) { ?>

<div class="col-lg-6 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Crear Nueva Observacion</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" name="form1" enctype="multipart/form-data" >
   
				<?php 
				//Se verifican si existen los datos
				if(isset($Observacion)) {     $x1  = $Observacion;    }else{$x1  = '';}

				//se dibujan los inputs
				echo form_textarea('Observaciones', 'Observacion', $x1, 2);
				echo form_input_file('Formulario','Formulario');
				echo form_input_file('Foto','Foto');
				?>

				<div class="form-group">
					<input type="hidden" name="idCliente" value="<?php echo $_GET['idCliente'] ?>">
					<input type="hidden" name="idUsuario" value="<?php echo $arrUsuario['idUsuario'] ?>">
					<input type="hidden" name="Fecha" value="<?php echo fecha_actual() ?>">			
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit">	
					<a href="<?php echo $location.'&idCliente='.$_GET['idCliente']; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>		
				</div>
			</form> 
		</div>
	</div>
</div>


<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['view']) ) { 
//Obtengo los datos de una observacion
$query = "SELECT 
clientes_listado.Nombre AS nombre_cliente,
usuarios_listado.Nombre AS nombre_usuario,
clientes_observaciones.Fecha,
clientes_observaciones.Observacion,
clientes_observaciones.Formulario,
clientes_observaciones.Foto
FROM `clientes_observaciones`
LEFT JOIN `clientes_listado`   ON clientes_listado.idCliente     = clientes_observaciones.idCliente
LEFT JOIN `usuarios_listado`   ON usuarios_listado.idUsuario     = clientes_observaciones.idUsuario
WHERE clientes_observaciones.idObservacion = {$_GET['view']}
ORDER BY clientes_observaciones.idObservacion ASC ";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);

?>
<div class="col-lg-12">
	<div class="box">	
		<header>		
			<h5>Ver Datos de la Observacion</h5>		
			<div class="toolbar"></div>	
		</header>
        <div class="body">
            <h2 class="text-primary">Datos Basicos</h2>
            <p class="text-muted"><strong>Cliente : </strong><?php echo $rowdata['nombre_cliente']; ?></p>
            <p class="text-muted"><strong>Usuario : </strong><?php echo $rowdata['nombre_usuario']; ?></p>
            <p class="text-muted"><strong>Fecha : </strong><?php echo Fecha_completa_alt($rowdata['Fecha']); ?></p>
                      
            <h2 class="text-primary">Observacion</h2>
            <p class="text-muted word_break " ><strong>Observacion : </strong><?php echo $rowdata['Observacion']; ?></p>
            
            <?php if (isset($rowdata['Formulario'])&&$rowdata['Formulario']!='') { ?>
				<h2 class="text-primary">Formulario</h2>
				<a href="download.php?dir=upload&file=<?php echo $rowdata['Formulario']; ?>" class="btn btn-danger margin_width" data-original-title="" title=""><i class="fa fa-cloud-download" aria-hidden="true"></i>  Descargar</a>
				<br/>
				<div style="margin-bottom:25px;"></div>
			<?php }?>
			
			<?php if (isset($rowdata['Foto'])&&$rowdata['Foto']!='') { ?>
				<h2 class="text-primary">Foto</h2>
				<a href="download.php?dir=upload&file=<?php echo $rowdata['Foto']; ?>" class="btn btn-danger margin_width" data-original-title="" title=""><i class="fa fa-cloud-download" aria-hidden="true"></i>  Descargar</a>
				<br/>
				<div style="margin-bottom:25px;"></div>
			<?php }?>			
						
        	
        </div>
	</div>
</div>
<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location.'&idCliente='.$_GET['idCliente']; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div>
 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['idCliente']) ) { 
// tomo los datos del usuario
$query = "SELECT Nombre
FROM `clientes_listado`
WHERE idCliente = {$_GET['idCliente']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);

// Se trae un listado con todas las observaciones el cliente
$arrObservaciones = array();
$query = "SELECT 
clientes_observaciones.idObservacion,
clientes_listado.Nombre AS nombre_cliente,
usuarios_listado.Nombre AS nombre_usuario,
clientes_observaciones.Fecha,
clientes_observaciones.Observacion
FROM `clientes_observaciones`
LEFT JOIN `clientes_listado`   ON clientes_listado.idCliente     = clientes_observaciones.idCliente
LEFT JOIN `usuarios_listado`   ON usuarios_listado.idUsuario     = clientes_observaciones.idUsuario
WHERE clientes_observaciones.idCliente = {$_GET['idCliente']}
ORDER BY clientes_observaciones.idObservacion ASC ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrObservaciones,$row );
}



?>
<div class="col-lg-12">
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location.'&idCliente='.$_GET['idCliente'].'&new=true'; ?>" class="btn btn-default fright margin_width" >Crear Nueva Observacion</a><?php }?>
</div>
<div class="clearfix"></div>   

<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Observaciones Cliente <?php echo $rowdata['Nombre']; ?></h5>
		</header>
        <div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Autor</th>
						<th>Fecha</th>
						<th>Observacion</th>
						<th width="120">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrObservaciones as $observaciones) { ?>
					<tr class="odd">		
						<td><?php echo $observaciones['nombre_usuario']; ?></td>
						<td><?php echo $observaciones['Fecha']; ?></td>		
						<td><?php echo cortar($observaciones['Observacion'], 70); ?></td>		
						<td>
							<div class="btn-group widthtd120" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo $location.'&idCliente='.$_GET['idCliente'].'&view='.$observaciones['idObservacion']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&idCliente='.$_GET['idCliente'].'&edit='.$observaciones['idObservacion']; ?>" data-placement="bottom" title="Editar Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&idCliente='.$_GET['idCliente'].'&del='.$observaciones['idObservacion'];
									$dialogo   = '¿Realmente deseas eliminar la observacion del usuario '.$observaciones['nombre_usuario'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" data-placement="bottom" title="Borrar Informacion" data-toggle="tooltip" class="btn btn-metis-1 btn-sm info-tooltip"><i class="fa fa-trash-o"></i></a>
								<?php } ?>								
							</div>
						</td>	
					</tr>
				<?php } ?>                   
				</tbody>
			</table>
		</div> 	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $original ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
} else{ 
//filtro sistema
if($arrUsuario['tipo']=='SuperAdmin'){
	$z = 'clientes_listado.idSistema>0';
}else{
	$z = 'clientes_listado.idSistema='.$arrUsuario['idSistema'];
}?>
	
<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Seleccionar cliente</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" name="form1" >
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idCliente)) {        $x1  = $idCliente;        }else{$x1  = '';}
				if(isset($nCliente)) {         $x2  = $nCliente;         }else{$x2  = '';}
				
				
				//se dibujan los inputs
				
				echo form_select_filter_custom('Cliente','idCliente', $x1, 2, 'idCliente', 'Identificador', 'clientes_listado', $z, 'Identificador', $dbConn);
				
				echo '<div class="form-group" id="div_">
					<label class="control-label col-lg-4" id="label_">Nombre Cliente</label>
					<div class="col-lg-8">
						<input type="text" placeholder="Nombre Cliente" class="form-control"  name="nCliente" id="nCliente" disabled value="'.$x2.'">
					</div>
				</div>';
				
				//Imprimo las variables
				$arrClientes = array();
				$query = "SELECT idCliente,Nombre AS NombreCliente
				FROM `clientes_listado`
				WHERE ".$z."
				ORDER BY idCliente";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrClientes,$row );
				}
				
				echo '<script>';
				foreach ($arrClientes as $tipo) {
					echo 'var nombre_cliente_'.$tipo['idCliente'].'= "'.$tipo['NombreCliente'].'";';	
				}
				
				
			
				?>
				document.getElementById("idCliente").onchange = function() {myFunction()};

				function myFunction() {
					var Componente = document.getElementById("idCliente").value;
					if (Componente != "") {
						nombre_cliente  = eval("nombre_cliente_" + Componente)
						var elem1       = document.getElementById("nCliente");
						elem1.value     = nombre_cliente;
					}
				}
				</script>
				
				<div class="form-group">
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Buscar" name="search">
				</div>
                      
			</form> 
                    
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
