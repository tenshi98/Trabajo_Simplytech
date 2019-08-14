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
$original = "licitacion_listado.php";
$location = $original;
$new_location = "licitacion_listado_datos.php";
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
	require_once 'A1XRXS_sys/xrxs_form/z_licitacion_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Contrato creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Contrato editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Contrato borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
//verifico que sea un administrador
$w = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";
$z = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	
// Se traen todos los datos de mi usuario
$query = "SELECT Codigo, Nombre, FechaInicio, FechaTermino, Presupuesto, idBodegaProd, idBodegaIns,
idSistema, idAprobado, idCliente
FROM `licitacion_listado`
WHERE idLicitacion = {$_GET['id']}";
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
				<span class="info-box-text">Contrato</span>
				<span class="info-box-number"><?php echo $rowdata['Nombre']; ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">Editar Datos Basicos</span>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'licitacion_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class="active"><a href="<?php echo 'licitacion_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'licitacion_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'licitacion_listado_itemizado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Itemizado</a></li>
					</ul>
                </li>           
			</ul>	
		</header>
        <div class="table-responsive">
			<div class="col-sm-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>		
			
					<?php 
					//Se verifican si existen los datos
					if(isset($idCliente)) {             $x0  = $idCliente;           }else{$x0  = $rowdata['idCliente'];}
					if(isset($Codigo)) {                $x1  = $Codigo;              }else{$x1  = $rowdata['Codigo'];}
					if(isset($Nombre)) {                $x2  = $Nombre;              }else{$x2  = $rowdata['Nombre'];}
					if(isset($FechaInicio)) {           $x3  = $FechaInicio;         }else{$x3  = $rowdata['FechaInicio'];}
					if(isset($FechaTermino)) {          $x4  = $FechaTermino;        }else{$x4  = $rowdata['FechaTermino'];}
					if(isset($Presupuesto)) {           $x5  = $Presupuesto;         }else{$x5  = $rowdata['Presupuesto'];}
					if(isset($idBodegaProd)) {          $x6  = $idBodegaProd;        }else{$x6  = $rowdata['idBodegaProd'];}
					if(isset($idBodegaIns)) {           $x7  = $idBodegaIns;         }else{$x7  = $rowdata['idBodegaIns'];}
					if(isset($idAprobado)) {            $x8  = $idAprobado;          }else{$x8  = $rowdata['idAprobado'];}
					
					//se dibujan los inputs
					$Form_Imputs = new Form_Inputs();
					$Form_Imputs->form_select_filter('Cliente','idCliente', $x0, 2, 'idCliente', 'Nombre', 'clientes_listado', $w, '', $dbConn);
					$Form_Imputs->form_input_text( 'Codigo', 'Codigo', $x1, 1); 
					$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x2, 2); 
					$Form_Imputs->form_date('Fecha de Inicio Contrato','FechaInicio', $x3, 1); 
					$Form_Imputs->form_date('Fecha de Termino Contrato','FechaTermino', $x4, 1); 
					$Form_Imputs->form_values('Presupuesto', 'Presupuesto', $x5, 1);
					$Form_Imputs->form_select('Bodega Productos','idBodegaProd', $x6, 2, 'idBodega', 'Nombre', 'bodegas_productos_listado', $z, '', $dbConn);
					$Form_Imputs->form_select('Bodega Insumos','idBodegaIns', $x7, 2, 'idBodega', 'Nombre', 'bodegas_insumos_listado', $z, '', $dbConn);
					$Form_Imputs->form_select('Estado Aprobacion','idAprobado', $x8, 2, 'idEstado', 'Nombre', 'core_estado_aprobacion', 0, '', $dbConn);
					
					$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
					$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
					$Form_Imputs->form_input_hidden('idLicitacion', $_GET['id'], 2);
						 
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
