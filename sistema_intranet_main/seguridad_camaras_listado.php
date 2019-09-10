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
$original = "seguridad_camaras_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){        $location .= "&Nombre=".$_GET['Nombre'];        $search .= "&Nombre=".$_GET['Nombre'];}
if(isset($_GET['idEstado']) && $_GET['idEstado'] != ''){    $location .= "&idEstado=".$_GET['idEstado'];    $search .= "&idEstado=".$_GET['idEstado'];}
if(isset($_GET['idPais']) && $_GET['idPais'] != ''){        $location .= "&idPais=".$_GET['idPais'];        $search .= "&idPais=".$_GET['idPais'];}
if(isset($_GET['idCiudad']) && $_GET['idCiudad'] != ''){    $location .= "&idCiudad=".$_GET['idCiudad'];    $search .= "&idCiudad=".$_GET['idCiudad'];}
if(isset($_GET['idComuna']) && $_GET['idComuna'] != ''){    $location .= "&idComuna=".$_GET['idComuna'];    $search .= "&idComuna=".$_GET['idComuna'];}
if(isset($_GET['Direccion']) && $_GET['Direccion'] != ''){  $location .= "&Direccion=".$_GET['Direccion'];  $search .= "&Direccion=".$_GET['Direccion'];}
if(isset($_GET['N_Camaras']) && $_GET['N_Camaras'] != ''){  $location .= "&N_Camaras=".$_GET['N_Camaras'];  $search .= "&N_Camaras=".$_GET['N_Camaras'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'grupo_insert';
	require_once 'A1XRXS_sys/xrxs_form/z_seguridad_camaras_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'grupo_del';
	require_once 'A1XRXS_sys/xrxs_form/z_seguridad_camaras_listado.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Grupo Camaras creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Grupo Camaras editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Grupo Camaras borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT 
seguridad_camaras_listado.idCamara,
seguridad_camaras_listado.Nombre,
seguridad_camaras_listado.idSubconfiguracion,
seguridad_camaras_listado.Direccion,
seguridad_camaras_listado.N_Camaras,
seguridad_camaras_listado.Config_usuario,
seguridad_camaras_listado.Config_Password,
seguridad_camaras_listado.Config_IP,
seguridad_camaras_listado.Config_Puerto,

core_sistemas.Nombre AS sistema,
core_estados.Nombre AS estado,
core_paises.Nombre AS Pais,
core_ubicacion_ciudad.Nombre AS Ciudad,
core_ubicacion_comunas.Nombre AS Comuna,
core_sistemas_opciones.Nombre AS Subconfiguracion,
core_tipos_camara.Nombre AS TipoCamara

FROM `seguridad_camaras_listado`
LEFT JOIN `core_sistemas`              ON core_sistemas.idSistema             = seguridad_camaras_listado.idSistema
LEFT JOIN `core_estados`               ON core_estados.idEstado               = seguridad_camaras_listado.idEstado
LEFT JOIN `core_paises`                ON core_paises.idPais                  = seguridad_camaras_listado.idPais
LEFT JOIN `core_ubicacion_ciudad`      ON core_ubicacion_ciudad.idCiudad      = seguridad_camaras_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`     ON core_ubicacion_comunas.idComuna     = seguridad_camaras_listado.idComuna
LEFT JOIN `core_sistemas_opciones`     ON core_sistemas_opciones.idOpciones   = seguridad_camaras_listado.idSubconfiguracion
LEFT JOIN `core_tipos_camara`          ON core_tipos_camara.idTipoCamara      = seguridad_camaras_listado.idTipoCamara

WHERE seguridad_camaras_listado.idCamara = {$_GET['id']}";
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
$rowdata = mysqli_fetch_assoc ($resultado);



?>
<div class="col-sm-12">
	<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-video-camera" aria-hidden="true"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Grupo Camaras</span>
				<span class="info-box-number"><?php echo $rowdata['Nombre']; ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">Resumen</span>
			</div>
		</div>
	</div>
</div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="<?php echo 'seguridad_camaras_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'seguridad_camaras_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'seguridad_camaras_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
				<li class=""><a href="<?php echo 'seguridad_camaras_listado_config.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Editar Camaras</a></li>
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
										<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Basicos</h2>
										<p class="text-muted">
											<strong>Nombre del Grupo : </strong><?php echo $rowdata['Nombre']; ?><br/>
											<strong>Numero de Camaras: </strong><?php echo $rowdata['N_Camaras']; ?><br/>
											<strong>Pais : </strong><?php echo $rowdata['Pais']; ?><br/>
											<strong>Region : </strong><?php echo $rowdata['Ciudad']; ?><br/>
											<strong>Comuna : </strong><?php echo $rowdata['Comuna']; ?><br/>
											<strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?><br/>
											<strong>Sistema Relacionado : </strong><?php echo $rowdata['sistema']; ?><br/>
											<strong>Estado : </strong><?php echo $rowdata['estado']; ?><br/>
											<strong>Subconfiguracion : </strong><?php echo $rowdata['Subconfiguracion']; ?>
										</p>
										
										<?php if(isset($rowdata['idSubconfiguracion'])&&$rowdata['idSubconfiguracion']==2){ ?>
											<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de Subconfiguracion</h2>
											<p class="text-muted">
												<strong>Tipo de Camara : </strong><?php echo $rowdata['TipoCamara']; ?><br/>
												<strong>Usuario : </strong><?php echo $rowdata['Config_usuario']; ?><br/>
												<strong>Password: </strong><?php echo $rowdata['Config_Password']; ?><br/>
												<strong>IP : </strong><?php echo $rowdata['Config_IP']; ?><br/>
												<strong>Puerto : </strong><?php echo $rowdata['Config_Puerto']; ?><br/>
											</p>
										<?php } ?>
										
									</td>
									<td>
									<?php 
									$direccion = "";
									if(isset($rowdata["Direccion"])&&$rowdata["Direccion"]!=''){  $direccion .= $rowdata["Direccion"];}
									if(isset($rowdata["Ciudad"])&&$rowdata["Ciudad"]!=''){        $direccion .= ', '.$rowdata["Ciudad"];}
									if(isset($rowdata["Comuna"])&&$rowdata["Comuna"]!=''){        $direccion .= ', '.$rowdata["Comuna"];}
									echo mapa2($direccion, 0, $_SESSION['usuario']['basic_data']['Config_IDGoogle']) ?>
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
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { ?>
 <div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Crear Grupo Camaras</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {          $x1  = $Nombre;           }else{$x1  = '';}
				if(isset($N_Camaras)) {       $x2  = $N_Camaras;        }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre del Grupo Camaras', 'Nombre', $x1, 2);
				$Form_Imputs->form_input_number_spinner('N° Camaras','N_Camaras', $x2, 0, 500, 1, 0, 2);
				
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Imputs->form_input_hidden('idEstado', 1, 2);
				$Form_Imputs->form_input_hidden('idSubconfiguracion', 1, 2);
					
				?>
			
				<div class="form-group">	
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit">	
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
				</div>
			</form>
			<?php widget_validator(); ?> 
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
/**********************************************************/
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
	$comienzo = 0 ;$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'nombre_asc':    $order_by = 'ORDER BY seguridad_camaras_listado.Nombre ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente'; break;
		case 'nombre_desc':   $order_by = 'ORDER BY seguridad_camaras_listado.Nombre DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		case 'estado_asc':    $order_by = 'ORDER BY core_estados.Nombre ASC ';                 $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Estado Ascendente';break;
		case 'estado_desc':   $order_by = 'ORDER BY core_estados.Nombre DESC ';                $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Estado Descendente';break;
		case 'ncamaras_asc':  $order_by = 'ORDER BY core_estados.N_Camaras ASC ';              $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> N° Camaras Ascendente';break;
		case 'ncamaras_desc': $order_by = 'ORDER BY core_estados.N_Camaras DESC ';             $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> N° Camaras Descendente';break;
		case 'subconf_asc':   $order_by = 'ORDER BY core_sistemas_opciones.Nombre ASC ';       $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Subconfiguracion Ascendente';break;
		case 'subconf_desc':  $order_by = 'ORDER BY core_sistemas_opciones.Nombre DESC ';      $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Subconfiguracion Descendente';break;
		
		default: $order_by = 'ORDER BY seguridad_camaras_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
	}
}else{
	$order_by = 'ORDER BY seguridad_camaras_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
}
/**********************************************************/
//Variable de busqueda
$z="WHERE seguridad_camaras_listado.idCamara!=0";
//Verifico el tipo de usuario que esta ingresando
$z.=" AND seguridad_camaras_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){                          $z .= " AND seguridad_camaras_listado.Nombre LIKE '%".$_GET['Nombre']."%'";}
if(isset($_GET['idEstado']) && $_GET['idEstado'] != ''){                      $z .= " AND seguridad_camaras_listado.idEstado=".$_GET['idPais'];}
if(isset($_GET['idPais']) && $_GET['idPais'] != ''){                          $z .= " AND seguridad_camaras_listado.idPais=".$_GET['idPais'];}
if(isset($_GET['idCiudad']) && $_GET['idCiudad'] != ''){                      $z .= " AND seguridad_camaras_listado.idCiudad=".$_GET['idCiudad'];}
if(isset($_GET['idComuna']) && $_GET['idComuna'] != ''){                      $z .= " AND seguridad_camaras_listado.idComuna=".$_GET['idComuna'];}
if(isset($_GET['Direccion']) && $_GET['Direccion'] != ''){                    $z .= " AND seguridad_camaras_listado.Direccion LIKE '%".$_GET['Direccion']."%'";}
if(isset($_GET['N_Camaras']) && $_GET['N_Camaras'] != ''){                    $z .= " AND seguridad_camaras_listado.N_Camaras=".$_GET['N_Camaras'];}
if(isset($_GET['idSubconfiguracion']) && $_GET['idSubconfiguracion'] != ''){  $z .= " AND seguridad_camaras_listado.idSubconfiguracion=".$_GET['idSubconfiguracion'];}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idCamara FROM `seguridad_camaras_listado` ".$z;
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
// Se trae un listado con todos los usuarios
$arrCamaras = array();
$query = "SELECT 
seguridad_camaras_listado.idCamara,
seguridad_camaras_listado.Nombre,
seguridad_camaras_listado.N_Camaras,
core_sistemas.Nombre AS sistema,
core_estados.Nombre AS estado,
seguridad_camaras_listado.idEstado,
core_sistemas_opciones.Nombre AS Subconfiguracion

FROM `seguridad_camaras_listado`
LEFT JOIN `core_sistemas`           ON core_sistemas.idSistema            = seguridad_camaras_listado.idSistema
LEFT JOIN `core_estados`            ON core_estados.idEstado              = seguridad_camaras_listado.idEstado
LEFT JOIN `core_sistemas_opciones`  ON core_sistemas_opciones.idOpciones  = seguridad_camaras_listado.idSubconfiguracion
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
array_push( $arrCamaras,$row );
}
?>

<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Grupo Camaras</a><?php } ?>
	
</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter" style="min-height:500px;">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {              $x1  = $Nombre;              }else{$x1  = '';}
				if(isset($N_Camaras)) {           $x2  = $N_Camaras;           }else{$x2  = '';}
				if(isset($idEstado)) {            $x3  = $idEstado;            }else{$x3  = '';}
				if(isset($idSubconfiguracion)) {  $x4  = $idSubconfiguracion;  }else{$x4  = '';}
				if(isset($idPais)) {              $x5  = $idPais;              }else{$x5  = '';}
				if(isset($idCiudad)) {            $x6  = $idCiudad;            }else{$x6  = '';}
				if(isset($idComuna)) {            $x7  = $idComuna;            }else{$x7  = '';}
				if(isset($Direccion)) {           $x8  = $Direccion;           }else{$x8  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre del Grupo Camaras', 'Nombre', $x1, 1);
				$Form_Imputs->form_input_number_spinner('N° Camaras','N_Camaras', $x2, 0, 500, 1, 0, 1);
				$Form_Imputs->form_select('Estado','idEstado', $x3, 1, 'idEstado', 'Nombre', 'core_estados', 0, '', $dbConn);
				$Form_Imputs->form_select('Subconfiguracion','idSubconfiguracion', $x4, 1, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);
				$Form_Imputs->form_select_country('Pais','idPais', $x5, 1, $dbConn);
				$Form_Imputs->form_select_depend1('Ciudad','idCiudad', $x6, 1, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
										'Comuna','idComuna', $x7, 1, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0, 
										 $dbConn, 'form1');
				$Form_Imputs->form_input_icon( 'Direccion', 'Direccion', $x8, 1,'fa fa-map'); 
				
				
				$Form_Imputs->form_input_hidden('pagina', $_GET['pagina'], 1);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="filtro_form">
					<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>
        </div>
	</div>
</div>
<div class="clearfix"></div> 
                      



                                
<div class="col-sm-12">
	<div class="box">	
		<header>		
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Grupo Camaras</h5>
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
						<th>
							<div class="pull-left">Nombre</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=nombre_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">N° Camaras</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=ncamaras_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=ncamaras_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Subconfiguracion</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=subconf_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=subconf_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Estado</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=estado_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=estado_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrCamaras as $usuarios) { ?>
					<tr class="odd">		
						<td><?php echo $usuarios['Nombre']; ?></td>	
						<td><?php echo $usuarios['N_Camaras']; ?></td>	
						<td><?php echo $usuarios['Subconfiguracion']; ?></td>	
						<td><label class="label <?php if(isset($usuarios['idEstado'])&&$usuarios['idEstado']==1){echo 'label-success';}else{echo 'label-danger';}?>"><?php echo $usuarios['estado']; ?></label></td>		
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $usuarios['sistema']; ?></td><?php } ?>			
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_camaras_listado.php?view='.$usuarios['idCamara']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$usuarios['idCamara']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									//se verifica que el usuario no sea uno mismo
									$ubicacion = $location.'&del='.$usuarios['idCamara'];
									$dialogo   = '¿Realmente deseas eliminar el Predio '.$usuarios['Nombre'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>
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
			//se llama al paginador
			echo paginador_2('paginf',$total_paginas, $original, $search, $num_pag ) ?>
		</div>
	</div>
</div>


<?php widget_modal(80, 95); ?>
	
<?php } ?>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
