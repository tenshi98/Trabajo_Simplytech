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
$rowlevel['nombre_categoria'] = '';
$original = "core_sistemas.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
if(isset($_GET['search']) && $_GET['search'] != ''){   $location .= "&search=".$_GET['search'] ; 	}
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'Nombre,idRubro,Rut,Ciudad,Comuna,Direccion,idTheme';
	$form_trabajo= 'insert';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/core_sistemas.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/core_sistemas.php';	
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
			  <h3><i class="fa fa-dashboard"></i> Sistemas</h3>
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Sistema creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Sistema editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Sistema borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
// Se traen todos los datos del trabajador
$query = "SELECT
core_sistemas.Nombre, 
core_sistemas_rubro.Nombre AS Rubro, 
core_sistemas.Rut, 
core_sistemas.Ciudad, 
core_sistemas.Comuna, 
core_sistemas.Direccion, 
core_sistemas.Contacto, 
core_sistemas.Fono, 
core_sistemas.Fax, 
core_sistemas.Web, 
core_sistemas.email_principal, 
core_sistemas.NombreContrato, 
core_sistemas.NContrato, 
core_sistemas.FContrato, 
core_sistemas.DContrato,
core_theme_colors.Nombre AS Tema,
core_sistemas.valorCargoFijo,
core_sistemas.valorAgua,
core_sistemas.valorRecoleccion,
core_sistemas.valorVisitaCorte,
core_sistemas.valorCorte1,
core_sistemas.valorCorte2,
core_sistemas.valorReposicion1,
core_sistemas.valorReposicion2,
core_sistemas.NdiasPago,
core_sistemas.Fac_nEmergencia,
core_sistemas.Fac_nConsultas

FROM `core_sistemas`
LEFT JOIN `core_sistemas_rubro`   ON core_sistemas_rubro.idRubro   = core_sistemas.idRubro
LEFT JOIN `core_theme_colors`     ON core_theme_colors.idTheme     = core_sistemas.idTheme



WHERE core_sistemas.idSistema = {$_GET['id']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);


?>
<div class="col-lg-12">
	<h5 class="fleft"><?php echo '<strong>Sistema : </strong>'.$rowdata['Nombre']; ?></h5>
</div>
<div class="clearfix"></div>  

<div class="col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="<?php echo 'core_sistemas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'core_sistemas_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'core_sistemas_datos_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Contacto</a></li>
				<li class=""><a href="<?php echo 'core_sistemas_datos_contrato.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Contrato</a></li>
				<li class=""><a href="<?php echo 'core_sistemas_datos_configuracion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Configuracion</a></li>
				<li class=""><a href="<?php echo 'core_sistemas_datos_facturacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Facturacion</a></li>
				<li class=""><a href="<?php echo 'core_sistemas_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Logo</a></li>
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
						<thead>
							<tr role="row">
								<th width="50%" class="word_break">Datos</th>
								<th width="50%">Mapa</th>
							</tr>
						</thead>					  
						<tbody role="alert" aria-live="polite" aria-relevant="all">
							<tr class="odd">
								<td class="word_break">
									
									<h2 class="text-primary">Datos Basicos</h2>
									<p class="text-muted"><strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?></p>
									<p class="text-muted"><strong>Rubro : </strong><?php echo $rowdata['Rubro']; ?></p>
									<p class="text-muted"><strong>Rut : </strong><?php echo $rowdata['Rut']; ?></p>
									<p class="text-muted"><strong>Ciudad : </strong><?php echo $rowdata['Ciudad']; ?></p>
									<p class="text-muted"><strong>Comuna : </strong><?php echo $rowdata['Comuna']; ?></p>
									<p class="text-muted"><strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?></p>
									
									
									<h2 class="text-primary">Datos de contacto</h2>
									<p class="text-muted"><strong>Nombre Contacto : </strong><?php echo $rowdata['Contacto']; ?></p>
									<p class="text-muted"><strong>Fono : </strong><?php echo $rowdata['Fono']; ?></p>
									<p class="text-muted"><strong>Fax : </strong><?php echo $rowdata['Fax']; ?></p>
									<p class="text-muted"><strong>Web : </strong><?php echo $rowdata['Web']; ?></p>
									<p class="text-muted"><strong>Email : </strong><?php echo $rowdata['email_principal']; ?></p>
									
									<h2 class="text-primary">Contrato</h2>
									<p class="text-muted"><strong>Nombre Contrato : </strong><?php echo $rowdata['NombreContrato']; ?></p>
									<p class="text-muted"><strong>Numero de Contrato : </strong><?php echo $rowdata['NContrato']; ?></p>
									<p class="text-muted"><strong>Fecha inicio Contrato : </strong><?php echo $rowdata['FContrato']; ?></p>
									<p class="text-muted"><strong>Duracion Contrato(Meses) : </strong><?php echo $rowdata['DContrato']; ?></p>
								
									<h2 class="text-primary">Configuracion</h2>
									<p class="text-muted"><strong>Tema : </strong><?php echo $rowdata['Tema']; ?></p>
									
									<h2 class="text-primary">Datos de Facturacion</h2>
									<p class="text-muted"><strong>Cargo Fijo : </strong><?php echo Valores($rowdata['valorCargoFijo'], 0); ?></p>
									<p class="text-muted"><strong>Metro Cubico Agua : </strong><?php echo Valores($rowdata['valorAgua'], 2); ?></p>
									<p class="text-muted"><strong>Metro Cubico Recoleccion : </strong><?php echo Valores($rowdata['valorRecoleccion'], 2); ?></p>
									<p class="text-muted"><strong>Visita Corte : </strong><?php echo Valores($rowdata['valorVisitaCorte'], 0); ?></p>
									<p class="text-muted"><strong>Corte 1° Instancia : </strong><?php echo Valores($rowdata['valorCorte1'], 0); ?></p>
									<p class="text-muted"><strong>Corte 2° Instancia : </strong><?php echo Valores($rowdata['valorCorte2'], 0); ?></p>
									<p class="text-muted"><strong>Reposicion 1° Instancia : </strong><?php echo Valores($rowdata['valorReposicion1'], 0); ?></p>
									<p class="text-muted"><strong>Reposicion 2° Instancia : </strong><?php echo Valores($rowdata['valorReposicion2'], 0); ?></p>
									<p class="text-muted"><strong>N° Dias para Vencimiento : </strong><?php echo $rowdata['NdiasPago']; ?> dias</p>
									<p class="text-muted"><strong>Fono Emergencias 24 hrs : </strong><?php echo $rowdata['Fac_nEmergencia']; ?></p>
									<p class="text-muted"><strong>Fono Consultas : </strong><?php echo $rowdata['Fac_nConsultas']; ?></p>
									
									
									

								</td>
								<td>
									<?php 
									$direccion = "";
									if(isset($rowdata["Direccion"])&&$rowdata["Direccion"]!=''){  $direccion .= $rowdata["Direccion"];}
									if(isset($rowdata["Comuna"])&&$rowdata["Comuna"]!=''){        $direccion .= ', '.$rowdata["Comuna"];}
									if(isset($rowdata["Ciudad"])&&$rowdata["Ciudad"]!=''){        $direccion .= ', '.$rowdata["Ciudad"];}
									echo mapa2($direccion) ?>
								</td>
							</tr>                  
						</tbody>
					</table>
				</div>
			</div>
        </div>	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
} elseif ( ! empty($_GET['new']) ) { 
//verifico el tipo de usuario
if($arrUsuario['tipo']=='SuperAdmin'){
	$z="idSistema>=0";	
}else{
	$z="idSistema={$arrUsuario['idSistema']}";	
}	 
?>
 <div class="col-lg-9 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Nueva Empresa</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" name="form1">

				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {           $x1  = $Nombre;           }else{$x1  = '';}
				if(isset($idRubro)) {          $x2  = $idRubro;          }else{$x2  = '';}
				if(isset($Rut)) {              $x3  = $Rut;              }else{$x3  = '';}
				if(isset($Ciudad)) {           $x4  = $Ciudad;           }else{$x4  = '';}
				if(isset($Comuna)) {           $x5  = $Comuna;           }else{$x5  = '';}
				if(isset($Direccion)) {        $x6  = $Direccion;        }else{$x6  = '';}
				
	
				//se dibujan los inputs
				echo '<h3>Datos Basicos</h3>';
				echo form_input('text', 'Nombres', 'Nombre', $x1, 2);
				echo form_select('Rubro','idRubro', $x2, 2, 'idRubro', 'Nombre', 'core_sistemas_rubro', 0, $dbConn);
				echo form_input_icon('text', 'Rut', 'Rut', $x3, 2,'fa fa-exclamation-triangle');
				echo form_input_icon('text', 'Ciudad', 'Ciudad', $x4, 2,'fa fa-map');	
				echo form_input_icon('text', 'Comuna', 'Comuna', $x5, 2,'fa fa-map');	
				echo form_input_icon('text', 'Direccion', 'Direccion', $x6, 2,'fa fa-map');            
				
				echo '<input type="hidden" name="idTheme"  value="1">';
		
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
//Creo la variable con la ubicacion
	$z="WHERE core_sistemas.idSistema!=0 ";
//Verifico si la variable de busqueda existe
if (isset($_GET['search'])){
	$z .=" AND core_sistemas.Nombre LIKE '%{$_GET['search']}%' ";	
}
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT core_sistemas.idSistema FROM `core_sistemas` ".$z."";
$registros = mysqli_query ($dbConn, $query);
$cuenta_registros = mysqli_num_rows($registros);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae u listado con todos los tipos de sistema
$arrTipoCliente = array();
$query = "SELECT 
core_sistemas.idSistema,
core_sistemas.Nombre,
core_sistemas.Rut,
core_sistemas_rubro.Nombre AS Rubro
FROM `core_sistemas`
LEFT JOIN `core_sistemas_rubro` ON core_sistemas_rubro.idRubro = core_sistemas.idRubro
".$z."
ORDER BY core_sistemas.Nombre ASC
LIMIT $comienzo, $cant_reg ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrTipoCliente,$row );
}?>
<div class="form-group">
<form class="form-horizontal" action="<?php echo $location ?>"  name="form1">
<label class="control-label col-lg-4">Buscar Empresas</label>
    <div class="col-lg-5">
		<div class="input-group bootstrap-timepicker fmrnew">
        	<input type="hidden" name="pagina" value="<?php echo $_GET['pagina']; ?>" >
			<input class="form-control timepicker-default" type="text" name="search" value="<?php if (isset($_GET['search'])) { echo $_GET['search'];}?>" placeholder="Nombre">
            <button type="submit" class="t_search_button"><i class="fa fa-search"></i></button>
            <button class="t_search_button2" onClick="document.form1.search.value = '';"><i class="fa fa-trash-o"></i></button>
		</div>
    </div>
</form>
<a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" >Crear Nueva Empresa</a>
</div>
<div class="clearfix"></div>                       
                                 
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Empresas</h5>
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
						<th>Nombre Empresa</th>
						<th>Rut</th>
						<th>Rubro</th>
						<th width="160">Acciones</th>
					</tr>
				</thead>
								 
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrTipoCliente as $tipo) { ?>
					<tr class="odd">
						<td><?php echo $tipo['Nombre']; ?></td>
						<td><?php echo $tipo['Rut']; ?></td>
						<td><?php echo $tipo['Rubro']; ?></td>
						<td>
							<div class="btn-group widthtd160" >
								<a href="<?php echo 'view_sistema.php?view='.$tipo['idSistema']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a>
								<a href="<?php echo $location.'&id='.$tipo['idSistema']; ?>" data-placement="bottom" title="Editar Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a>
								<?php 
								$ubicacion = $location.'&del='.$tipo['idSistema'];
								$dialogo   = '¿Realmente deseas eliminar el sistema de '.$tipo['Nombre'].'?';?>
								<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" data-placement="bottom" title="Borrar Informacion" data-toggle="tooltip" class="btn btn-metis-1 btn-sm info-tooltip"><i class="fa fa-trash-o"></i></a>							
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
