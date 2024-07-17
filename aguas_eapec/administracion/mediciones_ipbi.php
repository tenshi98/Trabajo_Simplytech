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
$original = "mediciones_ipbi.php";
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
	$form_obligatorios = 'Ano,idMes,Valor,idSistema';
	$form_trabajo= 'insert';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/mediciones_ipbi.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idIPBI,Ano,idMes,Valor,idSistema';
	$form_trabajo= 'update';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/mediciones_ipbi.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/mediciones_ipbi.php';	
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/IPBI Creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/IPBI Modificado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/IPBI borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT Ano, idMes, Valor, idSistema
FROM `mediciones_ipbi`
WHERE idIPBI = {$_GET['id']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);	?>
 
<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificacion del IPBI</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" name="form1">
			
			<?php 
			//Se verifican si existen los datos
			if(isset($Ano)) {          $x1  = $Ano;         }else{$x1  = $rowdata['Ano'];}
			if(isset($idMes)) {        $x2  = $idMes;       }else{$x2  = $rowdata['idMes'];}
			if(isset($Valor)) {        $x3  = $Valor;       }else{$x3  = $rowdata['Valor'];}
			if(isset($idSistema)) {    $x4  = $idSistema;   }else{$x4  = $rowdata['idSistema'];}

			//se dibujan los inputs
			echo form_select_n_auto('Año','Ano', $x1, 2, 2016, 2025);
			echo form_select('Mes','idMes', $x2, 2, 'idMes', 'Nombre', 'mnt_meses', 0, $dbConn);
			echo form_input_number('Valor','Valor', $x3, 2);
			if($arrUsuario['tipo']=='SuperAdmin'){
				echo form_select('Sistema','idSistema', $x4, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
			}else{
				echo '<input type="hidden" name="idSistema"   value="'.$arrUsuario['idSistema'].'">';
			}
			?>

			<div class="form-group">
            	<input type="hidden" name="idIPBI" value="<?php echo $_GET['id']; ?>" >
				<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_edit"> 
				<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { ?>
 <div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Nuevo IPBI</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" name="form1">
        	
			<?php 
			//Se verifican si existen los datos
			if(isset($Ano)) {          $x1  = $Ano;         }else{$x1  = '';}
			if(isset($idMes)) {        $x2  = $idMes;       }else{$x2  = '';}
			if(isset($Valor)) {        $x3  = $Valor;       }else{$x3  = '';}
			if(isset($idSistema)) {    $x4  = $idSistema;   }else{$x4  = '';}

			//se dibujan los inputs
			echo form_select_n_auto('Año','Ano', $x1, 2, 2016, 2025);
			echo form_select('Mes','idMes', $x2, 2, 'idMes', 'Nombre', 'mnt_meses', 0, $dbConn);
			echo form_input_number('Valor','Valor', $x3, 2);
			if($arrUsuario['tipo']=='SuperAdmin'){
				echo form_select('Sistema','idSistema', $x4, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
			}else{
				echo '<input type="hidden" name="idSistema"   value="'.$arrUsuario['idSistema'].'">';
			}
		
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
	$z="WHERE mediciones_ipbi.idSistema>=0";	
}else{
	$z="WHERE mediciones_ipbi.idSistema={$arrUsuario['idSistema']}";	
}
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idIPBI FROM `mediciones_ipbi` ".$z."";
$registros = mysqli_query ($dbConn, $query);
$cuenta_registros = mysqli_num_rows($registros);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrContactos = array();
$query = "SELECT 
mediciones_ipbi.idIPBI,
mediciones_ipbi.Ano,
mediciones_ipbi.Valor,
core_sistemas.Nombre AS Sistema,
mnt_meses.Nombre AS Mes
FROM `mediciones_ipbi`
LEFT JOIN `core_sistemas`   ON core_sistemas.idSistema  = mediciones_ipbi.idSistema
LEFT JOIN `mnt_meses`       ON mnt_meses.idMes          = mediciones_ipbi.idMes
".$z."
ORDER BY mediciones_ipbi.Ano DESC, mediciones_ipbi.idMes DESC
LIMIT $comienzo, $cant_reg ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrContactos,$row );
}?>

<div class="form-group">
<form class="form-horizontal" action="<?php echo $location ?>"  name="form1">

</form>
<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" >Crear Nuevo IPBI</a><?php } ?>
</div>
<div class="clearfix"></div>                       
                                 
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de IPBI</h5>
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
						<th>Año</th>
						<th>Mes</th>
						<th>Valor</th>
						<th>Sistema</th>
						<th width="120">Acciones</th>
					</tr>
				</thead>			  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrContactos as $cont) { ?>
					<tr class="odd">
						<td><?php echo $cont['Ano']; ?></td>
						<td><?php echo $cont['Mes']; ?></td>
						<td><?php echo $cont['Valor']; ?></td>
						<td><?php echo $cont['Sistema']; ?></td>
						<td>
							<div class="btn-group widthtd120" >
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$cont['idIPBI']; ?>" data-placement="bottom" title="Editar Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$cont['idIPBI'];
									$dialogo   = '¿Realmente deseas eliminar el IPBI del mes de '.$cont['Mes'].'?';?>
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
