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
$original = "trabajadores_listado.php";
$location = $original;
$new_location = "trabajadores_listado_laboral.php";
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
	//se agregan ubicaciones
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/trabajadores_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Trabajador creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Trabajador editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Trabajador borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// Se traen todos los datos del trabajador
$query = "SELECT Nombre,ApellidoPat,ApellidoMat,idTipo,Cargo,F_Inicio_Contrato,
F_Termino_Contrato,idAFP,idSalud,Observaciones,idTipoContrato,
SueldoLiquido,SueldoDia,SueldoHora, idContratista
FROM `trabajadores_listado`
WHERE idTrabajador = {$_GET['id']}";
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

$w="idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";
?>

<div class="col-sm-12">
	<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-cog faa-spin animated " aria-hidden="true"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Trabajador</span>
				<span class="info-box-number"><?php echo $rowdata['Nombre'].' '.$rowdata['ApellidoPat'].' '.$rowdata['ApellidoMat']; ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">Editar Datos Laborales</span>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'trabajadores_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'trabajadores_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'trabajadores_listado_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Contacto</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class="active"><a href="<?php echo 'trabajadores_listado_laboral.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Informacion Laboral</a></li>
						<li class=""><a href="<?php echo 'trabajadores_listado_cargas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Cargas Familiares</a></li>
						<li class=""><a href="<?php echo 'trabajadores_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
						
						<li class=""><a href="<?php echo 'trabajadores_listado_contrato.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - Contrato</a></li>
						<li class=""><a href="<?php echo 'trabajadores_listado_licencia.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - Licencia Conducir</a></li>
						<li class=""><a href="<?php echo 'trabajadores_listado_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - Foto</a></li>
						<li class=""><a href="<?php echo 'trabajadores_listado_curriculum.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - Curriculum</a></li>
						<li class=""><a href="<?php echo 'trabajadores_listado_antecedentes.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - Antecedentes</a></li>
						<li class=""><a href="<?php echo 'trabajadores_listado_carnet.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - Carnet</a></li>
						
					</ul>
                </li>           
			</ul>
		</header>
        <div class="table-responsive">
			<div class="col-sm-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>		
			
					<?php 
					//Se verifican si existen los datos
					if(isset($idContratista)) {       $x1  = $idContratista;        }else{$x1  = $rowdata['idContratista'];}
					if(isset($idTipo)) {              $x2  = $idTipo;               }else{$x2  = $rowdata['idTipo'];}
					if(isset($Cargo)) {               $x3  = $Cargo;                }else{$x3  = $rowdata['Cargo'];}
					if(isset($idTipoContrato)) {      $x4  = $idTipoContrato;       }else{$x4  = $rowdata['idTipoContrato'];}
					if(isset($F_Inicio_Contrato)) {   $x5  = $F_Inicio_Contrato;    }else{$x5  = $rowdata['F_Inicio_Contrato'];}
					if(isset($F_Termino_Contrato)) {  $x6  = $F_Termino_Contrato;   }else{$x6  = $rowdata['F_Termino_Contrato'];}
					if(isset($idAFP)) {               $x7  = $idAFP;                }else{$x7  = $rowdata['idAFP'];}
					if(isset($idSalud)) {             $x8  = $idSalud;              }else{$x8  = $rowdata['idSalud'];}
					if(isset($SueldoLiquido)) {       $x9  = $SueldoLiquido;        }else{$x9  = $rowdata['SueldoLiquido'];}
					if(isset($SueldoDia)) {           $x10 = $SueldoDia;            }else{$x10 = $rowdata['SueldoDia'];}
					if(isset($SueldoHora)) {          $x11 = $SueldoHora;           }else{$x11 = $rowdata['SueldoHora'];}
					if(isset($Observaciones)) {       $x12 = $Observaciones;        }else{$x12 = $rowdata['Observaciones'];}
					
					//se dibujan los inputs
					$Form_Imputs = new Form_Inputs();
					$Form_Imputs->form_select_filter('Empresa Contratista','idContratista', $x1, 1, 'idContratista', 'Nombre', 'contratista_listado', $w, '', $dbConn);
					$Form_Imputs->form_select('Tipo Trabajador','idTipo', $x2, 2, 'idTipo', 'Nombre', 'trabajadores_listado_tipos', 0, '', $dbConn);
					$Form_Imputs->form_input_text( 'Cargo', 'Cargo', $x3, 1);
					$Form_Imputs->form_select('Tipo de Contrato','idTipoContrato', $x4, 1, 'idTipoContrato', 'Nombre', 'core_tipos_contrato', 0, '', $dbConn);
					$Form_Imputs->form_date('F Inicio Contrato','F_Inicio_Contrato', $x5, 1);
					$Form_Imputs->form_date('F Termino Contrato','F_Termino_Contrato', $x6, 1);
					$Form_Imputs->form_select('AFP','idAFP', $x7, 1, 'idAFP', 'Nombre', 'sistema_afp', 'idEstado=1', '', $dbConn);
					$Form_Imputs->form_select('Salud','idSalud', $x8, 1, 'idSalud', 'Nombre', 'sistema_salud', 'idEstado=1', '', $dbConn);
					$Form_Imputs->form_values('Sueldo Liquido a Pago','SueldoLiquido', $x9, 1);
					$Form_Imputs->form_values('Sueldo Liquido a Pago por dia','SueldoDia', $x10, 1);
					$Form_Imputs->form_values('Sueldo Liquido a Pago por hora','SueldoHora', $x11, 1);
					$Form_Imputs->form_ckeditor('Observaciones','Observaciones', $x12, 1, 2);
					
					$Form_Imputs->form_input_hidden('idTrabajador', $_GET['id'], 2);
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
