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
F_Termino_Contrato,idAFP,idSalud,Observaciones,idTipoContrato, SueldoLiquido,
SueldoDia,SueldoHora, idContratista,idCentroCosto,idLevel_1,idLevel_2,idLevel_3,
idLevel_4,idLevel_5

FROM `trabajadores_listado`
WHERE idTrabajador = ".$_GET['id'];
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

$w = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";
?>

<div class="col-sm-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Trabajador', $rowdata['Nombre'].' '.$rowdata['ApellidoPat'].' '.$rowdata['ApellidoMat'], 'Editar Datos Laborales');?>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'trabajadores_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'trabajadores_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'trabajadores_listado_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-address-book-o" aria-hidden="true"></i> Datos Contacto</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class="active"><a href="<?php echo 'trabajadores_listado_laboral.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-university" aria-hidden="true"></i> Informacion Laboral</a></li>
						<li class=""><a href="<?php echo 'trabajadores_listado_cargas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-user-plus" aria-hidden="true"></i> Cargas Familiares</a></li>
						<li class=""><a href="<?php echo 'trabajadores_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						
						<li class=""><a href="<?php echo 'trabajadores_listado_contrato.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Contrato</a></li>
						<li class=""><a href="<?php echo 'trabajadores_listado_licencia.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Licencia Conducir</a></li>
						<li class=""><a href="<?php echo 'trabajadores_listado_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Foto</a></li>
						<li class=""><a href="<?php echo 'trabajadores_listado_curriculum.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Curriculum</a></li>
						<li class=""><a href="<?php echo 'trabajadores_listado_antecedentes.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Antecedentes</a></li>
						<li class=""><a href="<?php echo 'trabajadores_listado_carnet.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Carnet</a></li>
						<li class=""><a href="<?php echo 'trabajadores_listado_rhtm.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Permiso Trabajo Menor Edad</a></li>
						
					</ul>
                </li>           
			</ul>
		</header>
        <div class="table-responsive">
			<div class="col-sm-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>		
			
					<?php 
					//Se verifican si existen los datos
					if(isset($idTipo)) {              $x1  = $idTipo;               }else{$x1  = $rowdata['idTipo'];}
					if(isset($Cargo)) {               $x2  = $Cargo;                }else{$x2  = $rowdata['Cargo'];}
					if(isset($idContratista)) {       $x3  = $idContratista;        }else{$x3  = $rowdata['idContratista'];}
					if(isset($idTipoContrato)) {      $x4  = $idTipoContrato;       }else{$x4  = $rowdata['idTipoContrato'];}
					if(isset($F_Inicio_Contrato)) {   $x5  = $F_Inicio_Contrato;    }else{$x5  = $rowdata['F_Inicio_Contrato'];}
					if(isset($F_Termino_Contrato)) {  $x6  = $F_Termino_Contrato;   }else{$x6  = $rowdata['F_Termino_Contrato'];}
					if(isset($idAFP)) {               $x7  = $idAFP;                }else{$x7  = $rowdata['idAFP'];}
					if(isset($idSalud)) {             $x8  = $idSalud;              }else{$x8  = $rowdata['idSalud'];}
					if(isset($SueldoLiquido)) {       $x9  = $SueldoLiquido;        }else{$x9  = $rowdata['SueldoLiquido'];}
					if(isset($SueldoDia)) {           $x10 = $SueldoDia;            }else{$x10 = $rowdata['SueldoDia'];}
					if(isset($SueldoHora)) {          $x11 = $SueldoHora;           }else{$x11 = $rowdata['SueldoHora'];}
					if(isset($Observaciones)) {       $x12 = $Observaciones;        }else{$x12 = $rowdata['Observaciones'];}
					if(isset($idCentroCosto)) {       $x13 = $idCentroCosto;        }else{$x13 = $rowdata['idCentroCosto'];}
					if(isset($idLevel_1)) {           $x14 = $idLevel_1;            }else{$x14 = $rowdata['idLevel_1'];}
					if(isset($idLevel_2)) {           $x15 = $idLevel_2;            }else{$x15 = $rowdata['idLevel_2'];}
					if(isset($idLevel_3)) {           $x16 = $idLevel_3;            }else{$x16 = $rowdata['idLevel_3'];}
					if(isset($idLevel_4)) {           $x17 = $idLevel_4;            }else{$x17 = $rowdata['idLevel_4'];}
					if(isset($idLevel_5)) {           $x18 = $idLevel_5;            }else{$x18 = $rowdata['idLevel_5'];}
					
					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_tittle(3, 'Datos Trabajador');
					$Form_Inputs->form_select('Tipo Trabajador','idTipo', $x1, 2, 'idTipo', 'Nombre', 'trabajadores_listado_tipos', 0, '', $dbConn);
					$Form_Inputs->form_input_text('Cargo', 'Cargo', $x2, 1);
					
					$Form_Inputs->form_tittle(3, 'Datos Contrato');
					$Form_Inputs->form_select_filter('Empresa Contratista','idContratista', $x3, 1, 'idContratista', 'Nombre', 'contratista_listado', $w, '', $dbConn);
					$Form_Inputs->form_select('Tipo de Contrato','idTipoContrato', $x4, 1, 'idTipoContrato', 'Nombre', 'core_tipos_contrato', 0, '', $dbConn);
					$Form_Inputs->form_date('F Inicio Contrato','F_Inicio_Contrato', $x5, 1);
					$Form_Inputs->form_date('F Termino Contrato','F_Termino_Contrato', $x6, 1);
					
					$Form_Inputs->form_tittle(3, 'Datos Remuneraciones');
					$Form_Inputs->form_select('AFP','idAFP', $x7, 1, 'idAFP', 'Nombre', 'sistema_afp', 'idEstado=1', '', $dbConn);
					$Form_Inputs->form_select('Salud','idSalud', $x8, 1, 'idSalud', 'Nombre', 'sistema_salud', 'idEstado=1', '', $dbConn);
					$Form_Inputs->form_values('Sueldo Liquido a Pago','SueldoLiquido', $x9, 1);
					$Form_Inputs->form_values('Sueldo Liquido a Pago por dia','SueldoDia', $x10, 1);
					$Form_Inputs->form_values('Sueldo Liquido a Pago por hora','SueldoHora', $x11, 1);
					
					$Form_Inputs->form_tittle(3, 'Centro de Costo Asignado');
					$Form_Inputs->form_select_depend5('Centro de Costo', 'idCentroCosto',  $x13,  2,  'idCentroCosto',  'Nombre',  'centrocosto_listado',  $w,   0,
													  'Nivel 1', 'idLevel_1',  $x14,  1,  'idLevel_1',  'Nombre',  'centrocosto_listado_level_1',  0,   0, 
													  'Nivel 2', 'idLevel_2',  $x15,  1,  'idLevel_2',  'Nombre',  'centrocosto_listado_level_2',  0,   0,
													  'Nivel 3', 'idLevel_3',  $x16,  1,  'idLevel_3',  'Nombre',  'centrocosto_listado_level_3',  0,   0,
													  'Nivel 4', 'idLevel_4',  $x17,  1,  'idLevel_4',  'Nombre',  'centrocosto_listado_level_4',  0,   0,
													  'Nivel 5', 'idLevel_5',  $x18,  1,  'idLevel_5',  'Nombre',  'centrocosto_listado_level_5',  0,   0,
													  $dbConn, 'form1');
					
					$Form_Inputs->form_ckeditor('Observaciones','Observaciones', $x12, 1, 2);
					
					$Form_Inputs->form_input_hidden('idTrabajador', $_GET['id'], 2);
					?>

					<div class="form-group">		
						<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit"> 		
					</div>
				</form>
				<?php widget_validator(); ?>
			</div>
		</div>	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-sm-12" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
