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
$original = "maquinas_listado.php";
$location = $original;
$new_location = "maquinas_listado_ubicacion.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$location.='&id='.$_GET['id'];
	$form_trabajo= 'updateBasicData';
	require_once 'A1XRXS_sys/xrxs_form/z_maquinas_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// Se traen todos los datos de mi usuario
$query = "SELECT Nombre, idConfig_1, idConfig_2, idConfig_3, idUbicacion, idUbicacion_lvl_1, idUbicacion_lvl_2, 
idUbicacion_lvl_3, idUbicacion_lvl_4, idUbicacion_lvl_5
FROM `maquinas_listado`
WHERE idMaquina = {$_GET['id']}";
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
			<span class="info-box-icon"><i class="fa fa-cog faa-spin animated " aria-hidden="true"></i></span>

			<div class="info-box-content">
				<span class="info-box-text"><?php echo $x_column_maquina_plur; ?></span>
				<span class="info-box-number"><?php echo $rowdata['Nombre']; ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">Editar <?php echo $x_column_ubicacion; ?></span>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'maquinas_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'maquinas_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'maquinas_listado_config.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Configuracion</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<?php if(isset($rowdata['idConfig_3'])&&$rowdata['idConfig_3']==1){ ?>
							<li class=""><a href="<?php echo 'maquinas_listado_datos_clientes.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Clientes</a></li>
							<li class="active"><a href="<?php echo 'maquinas_listado_ubicacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><?php echo $x_column_ubicacion; ?></a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'maquinas_listado_datos_ficha.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Ficha Tecnica</a></li>
						<li class=""><a href="<?php echo 'maquinas_listado_datos_hds.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >HDS</a></li>
						<li class=""><a href="<?php echo 'maquinas_listado_datos_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Imagen</a></li>
						<li class=""><a href="<?php echo 'maquinas_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
						<li class=""><a href="<?php echo 'maquinas_listado_datos_descripcion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Descripcion</a></li>
						<?php if(isset($rowdata['idConfig_1'])&&$rowdata['idConfig_1']==1){ ?>
							<li class=""><a href="<?php echo 'maquinas_listado_componentes.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Componentes</a></li>
						<?php } ?>
						<?php if(isset($rowdata['idConfig_2'])&&$rowdata['idConfig_2']==1){ ?>
							<li class=""><a href="<?php echo 'maquinas_listado_matriz_analisis.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Matriz Analisis</a></li>
						<?php } ?>
						
					</ul>
                </li>           
			</ul>	
		</header>
        <div class="table-responsive">
			<div class="col-sm-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>		
			
					<?php 
					//Se verifican si existen los datos
					if(isset($idUbicacion)) {   $x1  = $idUbicacion;   }else{$x1  = $rowdata['idUbicacion'];}
					if(isset($idLevel_1)) {     $x2  = $idLevel_1;     }else{$x2  = $rowdata['idUbicacion_lvl_1'];}
					if(isset($idLevel_2)) {     $x3  = $idLevel_2;     }else{$x3  = $rowdata['idUbicacion_lvl_2'];}
					if(isset($idLevel_3)) {     $x4  = $idLevel_3;     }else{$x4  = $rowdata['idUbicacion_lvl_3'];}
					if(isset($idLevel_4)) {     $x5  = $idLevel_4;     }else{$x5  = $rowdata['idUbicacion_lvl_4'];}
					if(isset($idLevel_5)) {     $x6  = $idLevel_5;     }else{$x6  = $rowdata['idUbicacion_lvl_5'];}
					
					//se dibujan los inputs
					$Form_Imputs = new Form_Inputs();
					$Form_Imputs->form_select_depend5($x_column_ubicacion, 'idUbicacion',  $x1,  2,  'idUbicacion',  'Nombre',  'ubicacion_listado',  'idEstado=1',   0,
							                 $x_column_ubicacion_lvl_1, 'idUbicacion_lvl_1',  $x2,  2,  'idLevel_1',  'Nombre',  'ubicacion_listado_level_1',  0,   0, 
							                 $x_column_ubicacion_lvl_2, 'idUbicacion_lvl_2',  $x3,  1,  'idLevel_2',  'Nombre',  'ubicacion_listado_level_2',  0,   0,
							                 $x_column_ubicacion_lvl_3, 'idUbicacion_lvl_3',  $x4,  1,  'idLevel_3',  'Nombre',  'ubicacion_listado_level_3',  0,   0,
							                 $x_column_ubicacion_lvl_4, 'idUbicacion_lvl_4',  $x5,  1,  'idLevel_4',  'Nombre',  'ubicacion_listado_level_4',  0,   0,
							                 $x_column_ubicacion_lvl_5, 'idUbicacion_lvl_5',  $x6,  1,  'idLevel_5',  'Nombre',  'ubicacion_listado_level_5',  0,   0,
							                 $dbConn, 'form1'); 
					
					
					
					$Form_Imputs->form_input_hidden('idMaquina', $_GET['id'], 2);
						 
					?> 

					<div class="form-group">		
						<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit"> 		
					</div>
				</form>
				<?php require_once '../LIBS_js/validator/form_validator.php';?>
			</div>
		</div>	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
	<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
	<div class="clearfix"></div>
</div>


<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
