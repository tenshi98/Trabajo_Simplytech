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
$original = "clientes_otros_cargos.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
if(isset($_GET['search']) && $_GET['search'] != ''){                       $location .= "&search=".$_GET['search'] ; 	}
//Verifico los permisos del usuario sobre la transaccion
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/permisos.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idCliente,idTipo,Fecha,Observacion,idSistema';
	$form_trabajo= 'insert';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/clientes_otros_cargos.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'update';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/clientes_otros_cargos.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/clientes_otros_cargos.php';	
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Cargo creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Cargo editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Cargo borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
//filtro	 
if($arrUsuario['tipo']=='SuperAdmin'){
	$z = 'clientes_listado.idSistema>0';
}else{
	$z = 'clientes_listado.idSistema='.$arrUsuario['idSistema'];
}

// Se traen todos los datos
$query = "SELECT idCliente,FechaEjecucion,Fecha,ValorCargo,Observacion,idSistema
FROM `clientes_otros_cargos`
WHERE idOtrosCargos = {$_GET['id']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);	 
?>
 <div class="col-lg-6 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Modificar Cargo</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" name="form1" enctype="multipart/form-data">
				
				<?php 
				//Se verifican si existen los datos
				if(isset($idCliente)) {        $x1  = $idCliente;         }else{$x1  = $rowdata['idCliente'];}
				if(isset($FechaEjecucion)) {   $x2  = $FechaEjecucion;    }else{$x2  = $rowdata['FechaEjecucion'];}
				if(isset($Fecha)) {            $x3  = $Fecha;             }else{$x3  = $rowdata['Fecha'];}
				if(isset($ValorCargo)) {       $x4  = $ValorCargo;        }else{$x4  = $rowdata['ValorCargo'];}
				if(isset($Observacion)) {      $x5  = $Observacion;       }else{$x5  = $rowdata['Observacion'];}
				if(isset($idSistema)) {        $x6  = $idSistema;         }else{$x6  = $rowdata['idSistema'];}

				//se dibujan los inputs
				echo form_select_filter_custom('Cliente','idCliente', $x1, 2, 'idCliente', 'Identificador', 'clientes_listado', $z, 'Identificador', $dbConn);
				echo form_date('Fecha Ejecucion','FechaEjecucion', $x2, 2);
				echo form_date('Fecha','Fecha', $x3, 2);
				echo form_values('Valor','ValorCargo', $x4, 2);
				echo form_textarea('Observacion', 'Observacion', $x5, 2);
				
				//se verifica el tipo de usuario
				if($arrUsuario['tipo']=='SuperAdmin'){
					echo form_select('Sistema','idSistema', $x6, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
				}else{
					echo '<input type="hidden" name="idSistema"   value="'.$arrUsuario['idSistema'].'">';
				}
				?>
								
				<div class="form-group">
					<input type="hidden" name="idOtrosCargos" value="<?php echo $_GET['id']; ?>" >		
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_edit">	
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>		
				</div>
			</form> 
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { 
//filtro	 
if($arrUsuario['tipo']=='SuperAdmin'){
	$z = 'clientes_listado.idSistema>0';
}else{
	$z = 'clientes_listado.idSistema='.$arrUsuario['idSistema'];
}	 
?>
 <div class="col-lg-6 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Crear Nuevo Cargo</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" name="form1" enctype="multipart/form-data">
				
				<?php 
				//Se verifican si existen los datos
				if(isset($idCliente)) {        $x1  = $idCliente;         }else{$x1  = '';}
				if(isset($FechaEjecucion)) {   $x2  = $FechaEjecucion;    }else{$x2  = '';}
				if(isset($Fecha)) {            $x3  = $Fecha;             }else{$x3  = '';}
				if(isset($ValorCargo)) {       $x4  = $ValorCargo;        }else{$x4  = '';}
				if(isset($Observacion)) {      $x5  = $Observacion;       }else{$x5  = '';}
				if(isset($idSistema)) {        $x6  = $idSistema;         }else{$x6  = '';}

				//se dibujan los inputs
				echo form_select_filter_custom('Cliente','idCliente', $x1, 2, 'idCliente', 'Identificador', 'clientes_listado', $z, 'Identificador', $dbConn);
				echo form_date('Fecha Ejecucion','FechaEjecucion', $x2, 2);
				echo form_date('Fecha Facturacion','Fecha', $x3, 2);
				echo form_values('Valor','ValorCargo', $x4, 2);
				echo form_textarea('Observacion', 'Observacion', $x5, 2);
				
				//se verifica el tipo de usuario
				if($arrUsuario['tipo']=='SuperAdmin'){
					echo form_select('Sistema','idSistema', $x6, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
				}else{
					echo '<input type="hidden" name="idSistema"   value="'.$arrUsuario['idSistema'].'">';
				}
				echo '<input type="hidden" name="idUsuario"   value="'.$arrUsuario['idUsuario'].'">';
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
if(isset($_GET["pagina"])){$num_pag = $_GET["pagina"];	
} else {$num_pag = 1;	
}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){
	$comienzo = 0 ;$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
//verifico que sea un administrador
if($arrUsuario['tipo']=='SuperAdmin'){
	$z="WHERE clientes_otros_cargos.idSistema>=0";	
}else{
	$z="WHERE clientes_otros_cargos.idSistema={$arrUsuario['idSistema']}";	
}
//Verifico si la variable de busqueda existe
if(isset($_GET['search']) && $_GET['search'] != ''){ 
	 $z .= " AND clientes_listado.Rut LIKE '%{$_GET['search']}%'";
}
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT clientes_otros_cargos.idOtrosCargos FROM `clientes_otros_cargos` LEFT JOIN `clientes_listado`   ON clientes_listado.idCliente   = clientes_otros_cargos.idCliente  ".$z." ";
$registros = mysqli_query ($dbConn, $query);
$cuenta_registros = mysqli_num_rows($registros);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrUsers = array();
$query = "SELECT 
clientes_otros_cargos.idOtrosCargos,
clientes_otros_cargos.Fecha,
clientes_listado.Identificador,
usuarios_listado.Nombre AS UsuarioNombre,
core_sistemas.Nombre AS sistema

FROM `clientes_otros_cargos`
LEFT JOIN `clientes_listado`         ON clientes_listado.idCliente       = clientes_otros_cargos.idCliente
LEFT JOIN `usuarios_listado`         ON usuarios_listado.idUsuario       = clientes_otros_cargos.idUsuario
LEFT JOIN `core_sistemas`            ON core_sistemas.idSistema          = clientes_otros_cargos.idSistema
".$z."
ORDER BY clientes_otros_cargos.Fecha DESC
LIMIT $comienzo, $cant_reg ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrUsers,$row );
}

?>
<div class="form-group">
<form class="form-horizontal" action="<?php echo $location ?>"  name="form1">
<label class="control-label col-lg-4">Buscar Cliente</label>
    <div class="col-lg-5">	
		<div class="input-group bootstrap-timepicker fmrnew">
        	<input type="hidden" name="pagina" value="<?php echo $_GET['pagina']; ?>" >		
			<input class="form-control timepicker-default" type="text" name="search" value="<?php if (isset($_GET['search'])) { echo $_GET['search'];}?>" placeholder="Rut">
            <button type="submit" class="t_search_button"><i class="fa fa-search"></i></button>
            <a href="<?php echo $location; ?>&fullsearch=true" class="t_search_button_full" ><i class="fa fa-search-plus"></i></a>
            <button class="t_search_button2" onclick="document.form1.search.value = '';"><i class="fa fa-trash-o"></i></button>
		</div>
    </div>
</form>
<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" >Crear Nuevo Cargo</a><?php }?>
</div>
<div class="clearfix"></div>                     
                                 
<div class="col-lg-12">
	<div class="box">	
		<header>		
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Cargos</h5>	
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
						<th>Fecha</th>
						<th>Identificador</th>
						<th>Creador</th>
						<th>Sistema</th>
						<th width="120">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrUsers as $usuarios) { ?>
					<tr class="odd">		
						<td><?php echo $usuarios['Fecha']; ?></td>
						<td><?php echo $usuarios['Identificador']; ?></td>			
						<td><?php echo $usuarios['UsuarioNombre']; ?></td>		
						<td><?php echo $usuarios['sistema']; ?></td>	
						<td>
							<div class="btn-group widthtd120" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_clientes_otros_cargos.php?view='.$usuarios['idOtrosCargos']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$usuarios['idOtrosCargos']; ?>" data-placement="bottom" title="Editar Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$usuarios['idOtrosCargos'];
									$dialogo   = '¿Realmente el evento del cliente '.$usuarios['Identificador'].'?';?>
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
