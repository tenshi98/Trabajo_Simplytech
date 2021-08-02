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
$original = "admin_trabajadores_listado.php";
$location = $original;
$new_location = "admin_trabajadores_listado_laboral.php";
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
F_Termino_Contrato,Observaciones,idTipoContrato,idTipoTrabajador,
SueldoLiquido,SueldoDia,SueldoHora,idTipoContratoTrab,horas_pactadas,Gratificacion, 
idContratista,idCentroCosto,idLevel_1,idLevel_2,idLevel_3,idLevel_4,idLevel_5,
idTipoTrabajo, PorcentajeTrabajoPesado
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
				<li class=""><a href="<?php echo 'admin_trabajadores_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'admin_trabajadores_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'admin_trabajadores_listado_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-address-book-o" aria-hidden="true"></i> Datos Contacto</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class="active"><a href="<?php echo 'admin_trabajadores_listado_laboral.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-university" aria-hidden="true"></i> Informacion Laboral</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_previsional.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-usd" aria-hidden="true"></i> Descuentos Previsionales</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_descuentos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-usd" aria-hidden="true"></i> Otros Descuentos Previsionales</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_bonos_fijos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-usd" aria-hidden="true"></i> Bonos Fijos Asignados</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_cargas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-user-plus" aria-hidden="true"></i> Cargas Familiares</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_contrato.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Contrato</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_anexos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Anexos Contrato</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_licencia.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Licencia Conducir</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Foto</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_curriculum.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Curriculum</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_antecedentes.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Antecedentes</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_carnet.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Carnet</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_rhtm.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Permiso Trabajo Menor Edad</a></li>
						
					</ul>
                </li>           
			</ul>
		</header>
        <div class="table-responsive">
			<div class="col-sm-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>		
			
					<?php 
					//Se verifican si existen los datos
					if(isset($idTipo)) {                   $x1  = $idTipo;                    }else{$x1  = $rowdata['idTipo'];}
					if(isset($Cargo)) {                    $x2  = $Cargo;                     }else{$x2  = $rowdata['Cargo'];}
					
					if(isset($idContratista)) {            $x3  = $idContratista;             }else{$x3  = $rowdata['idContratista'];}
					if(isset($idTipoTrabajador)) {         $x4  = $idTipoTrabajador;          }else{$x4  = $rowdata['idTipoTrabajador'];}
					if(isset($idTipoContrato)) {           $x5  = $idTipoContrato;            }else{$x5  = $rowdata['idTipoContrato'];}
					if(isset($idTipoContratoTrab)) {       $x6  = $idTipoContratoTrab;        }else{$x6  = $rowdata['idTipoContratoTrab'];}
					if(isset($horas_pactadas)) {           $x7  = $horas_pactadas;            }else{$x7  = $rowdata['horas_pactadas'];}
					if(isset($F_Inicio_Contrato)) {        $x8  = $F_Inicio_Contrato;         }else{$x8  = $rowdata['F_Inicio_Contrato'];}
					if(isset($F_Termino_Contrato)) {       $x9  = $F_Termino_Contrato;        }else{$x9  = $rowdata['F_Termino_Contrato'];}
					if(isset($idTipoTrabajo)) {            $x10 = $idTipoTrabajo;             }else{$x10 = $rowdata['idTipoTrabajo'];}
					if(isset($PorcentajeTrabajoPesado)) {  $x11 = $PorcentajeTrabajoPesado;   }else{$x11 = $rowdata['PorcentajeTrabajoPesado'];}
					
					
					if(isset($SueldoLiquido)) {            $x12 = $SueldoLiquido;             }else{$x12 = $rowdata['SueldoLiquido'];}
					if(isset($SueldoDia)) {                $x13 = $SueldoDia;                 }else{$x13 = $rowdata['SueldoDia'];}
					if(isset($SueldoHora)) {               $x14 = $SueldoHora;                }else{$x14 = $rowdata['SueldoHora'];}
					if(isset($Gratificacion)) {            $x15 = $Gratificacion;             }else{$x15 = $rowdata['Gratificacion'];}
					
					if(isset($idCentroCosto)) {            $x16 = $idCentroCosto;             }else{$x16 = $rowdata['idCentroCosto'];}
					if(isset($idLevel_1)) {                $x17 = $idLevel_1;                 }else{$x17 = $rowdata['idLevel_1'];}
					if(isset($idLevel_2)) {                $x18 = $idLevel_2;                 }else{$x18 = $rowdata['idLevel_2'];}
					if(isset($idLevel_3)) {                $x10 = $idLevel_3;                 }else{$x19 = $rowdata['idLevel_3'];}
					if(isset($idLevel_4)) {                $x20 = $idLevel_4;                 }else{$x20 = $rowdata['idLevel_4'];}
					if(isset($idLevel_5)) {                $x21 = $idLevel_5;                 }else{$x21 = $rowdata['idLevel_5'];}
					
					if(isset($Observaciones)) {            $x22 = $Observaciones;             }else{$x22 = $rowdata['Observaciones'];}
					
					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_tittle(3, 'Datos Trabajador');
					$Form_Inputs->form_select('Tipo Trabajador','idTipo', $x1, 2, 'idTipo', 'Nombre', 'trabajadores_listado_tipos', 0, '', $dbConn);
					$Form_Inputs->form_input_text('Cargo', 'Cargo', $x2, 1);
					
					$Form_Inputs->form_tittle(3, 'Datos Contrato');
					$Form_Inputs->form_select_filter('Empresa Contratista','idContratista', $x3, 1, 'idContratista', 'Nombre', 'contratista_listado', $w, '', $dbConn);
					$Form_Inputs->form_select('Tipo de Trabajador','idTipoTrabajador', $x4, 1, 'idTipoTrabajador', 'Nombre', 'core_tipos_trabajadores', 0, '', $dbConn);
					$Form_Inputs->form_select('Tipo de Contrato','idTipoContrato', $x5, 1, 'idTipoContrato', 'Nombre', 'core_tipos_contrato', 0, '', $dbConn);
					$Form_Inputs->form_select('Tipo de Sueldo','idTipoContratoTrab', $x6, 1, 'idTipoContratoTrab', 'Nombre', 'core_tipos_contrato_trabajador', 0, '', $dbConn);
					$Form_Inputs->form_select_n_auto('Horas Pactadas','horas_pactadas', $x7, 1, 1, 45);	
					$Form_Inputs->form_date('F Inicio Contrato','F_Inicio_Contrato', $x8, 1);
					$Form_Inputs->form_date('F Termino Contrato','F_Termino_Contrato', $x9, 1);
					$Form_Inputs->form_select('Tipo de Trabajo','idTipoTrabajo', $x10, 1, 'idTipoTrabajo', 'Nombre', 'core_tipos_trabajo', 0, '', $dbConn);
					$Form_Inputs->form_input_number_spinner('Porcentaje Trabajo Pesado','PorcentajeTrabajoPesado', $x11, 0, 10, '0.1', 1, 2);
				
					$Form_Inputs->form_tittle(3, 'Remuneraciones');
					$Form_Inputs->form_values('Sueldo Liquido a Pago','SueldoLiquido', $x12, 1);
					$Form_Inputs->form_values('Sueldo Liquido a Pago por dia','SueldoDia', $x13, 1);
					$Form_Inputs->form_values('Sueldo Liquido a Pago por hora','SueldoHora', $x14, 1);
					$Form_Inputs->form_values('Gratificacion','Gratificacion', $x15, 1);
					
					$Form_Inputs->form_tittle(3, 'Centro de Costo Asignado');
					$Form_Inputs->form_select_depend5('Centro de Costo', 'idCentroCosto',  $x16,  2,  'idCentroCosto',  'Nombre',  'centrocosto_listado',  $w,   0,
													  'Nivel 1', 'idLevel_1',  $x17,  1,  'idLevel_1',  'Nombre',  'centrocosto_listado_level_1',  0,   0, 
													  'Nivel 2', 'idLevel_2',  $x18,  1,  'idLevel_2',  'Nombre',  'centrocosto_listado_level_2',  0,   0,
													  'Nivel 3', 'idLevel_3',  $x19,  1,  'idLevel_3',  'Nombre',  'centrocosto_listado_level_3',  0,   0,
													  'Nivel 4', 'idLevel_4',  $x20,  1,  'idLevel_4',  'Nombre',  'centrocosto_listado_level_4',  0,   0,
													  'Nivel 5', 'idLevel_5',  $x21,  1,  'idLevel_5',  'Nombre',  'centrocosto_listado_level_5',  0,   0,
													  $dbConn, 'form1');
					
					$Form_Inputs->form_ckeditor('Observaciones','Observaciones', $x22, 1, 2);
					
					$Form_Inputs->form_input_hidden('idTrabajador', $_GET['id'], 2);
					?>
					<script>
						//oculto los div
						document.getElementById('div_SueldoLiquido').style.display = 'none';
						document.getElementById('div_SueldoDia').style.display = 'none';
						document.getElementById('div_SueldoHora').style.display = 'none';
						document.getElementById('div_PorcentajeTrabajoPesado').style.display = 'none';
						
						var idTipoContratoTrab;
						var idTipoContratoTrab_sel;
						var idTipoTrabajo;
						var idTipoTrabajo_sel;
						
						$(document).ready(function(){ //se ejecuta al cargar la página (OBLIGATORIO)
									
							idTipoContratoTrab = $("#idTipoContratoTrab").val();
							idTipoTrabajo      = $("#idTipoTrabajo").val();
							
							/*************************************/
							//Trabajador con sueldo mensual
							if(idTipoContratoTrab == 1){ 
								document.getElementById('div_SueldoLiquido').style.display = 'block';
								document.getElementById('div_SueldoDia').style.display = 'none';
								document.getElementById('div_SueldoHora').style.display = 'none';			
								
							//Trabajador con sueldo semanal
							}else if(idTipoContratoTrab == 2){ 
								document.getElementById('div_SueldoLiquido').style.display = 'block';
								document.getElementById('div_SueldoDia').style.display = 'none';
								document.getElementById('div_SueldoHora').style.display = 'none';
								
							//Trabajador con sueldo diario (jornada semanal de 5 días)
							}else if(idTipoContratoTrab == 3){ 
								document.getElementById('div_SueldoLiquido').style.display = 'none';
								document.getElementById('div_SueldoDia').style.display = 'block';
								document.getElementById('div_SueldoHora').style.display = 'none';
							
							//Trabajador con sueldo diario (jornada semanal de 6 días)
							}else if(idTipoContratoTrab == 4){ 
								document.getElementById('div_SueldoLiquido').style.display = 'none';
								document.getElementById('div_SueldoDia').style.display = 'block';
								document.getElementById('div_SueldoHora').style.display = 'none';
							
							//Trabajador con sueldo por hora
							}else if(idTipoContratoTrab == 5){ 
								document.getElementById('div_SueldoLiquido').style.display = 'none';
								document.getElementById('div_SueldoDia').style.display = 'none';
								document.getElementById('div_SueldoHora').style.display = 'block';
							
							//si no en ninguno
							}else{ 
								document.getElementById('div_SueldoLiquido').style.display = 'none';
								document.getElementById('div_SueldoDia').style.display = 'none';
								document.getElementById('div_SueldoHora').style.display = 'none';
							
							}
							/*************************************/
							//Trabajo normal
							if(idTipoTrabajo == 1){ 
								document.getElementById('div_PorcentajeTrabajoPesado').style.display = 'none';
								
							//Trabajo pesado
							}else if(idTipoTrabajo == 2){ 
								document.getElementById('div_PorcentajeTrabajoPesado').style.display = 'block';			
								
							//si no en ninguno
							}else{ 
								document.getElementById('div_PorcentajeTrabajoPesado').style.display = 'none';
							
							}
							
									
						}); 
								
						$("#idTipoContratoTrab").on("change", function(){ //se ejecuta al cambiar valor del select
							idTipoContratoTrab_sel = $(this).val(); //Asignamos el valor seleccionado
							
							//Trabajador con sueldo mensual
							if(idTipoContratoTrab_sel == 1){ 
								document.getElementById('div_SueldoLiquido').style.display = 'block';
								document.getElementById('div_SueldoDia').style.display = 'none';
								document.getElementById('div_SueldoHora').style.display = 'none';
								//Reseteo los valores a 0
								//document.getElementById('SueldoLiquido').value = "0";				
								document.getElementById('SueldoDia').value = "0";				
								document.getElementById('SueldoHora').value = "0";				
								
							//Trabajador con sueldo semanal
							}else if(idTipoContratoTrab_sel == 2){ 
								document.getElementById('div_SueldoLiquido').style.display = 'block';
								document.getElementById('div_SueldoDia').style.display = 'none';
								document.getElementById('div_SueldoHora').style.display = 'none';
								//Reseteo los valores a 0
								//document.getElementById('SueldoLiquido').value = "0";				
								document.getElementById('SueldoDia').value = "0";				
								document.getElementById('SueldoHora').value = "0";
								
							//Trabajador con sueldo diario (jornada semanal de 5 días)
							}else if(idTipoContratoTrab_sel == 3){ 
								document.getElementById('div_SueldoLiquido').style.display = 'none';
								document.getElementById('div_SueldoDia').style.display = 'block';
								document.getElementById('div_SueldoHora').style.display = 'none';
								//Reseteo los valores a 0
								document.getElementById('SueldoLiquido').value = "0";				
								//document.getElementById('SueldoDia').value = "0";				
								document.getElementById('SueldoHora').value = "0";
							
							//Trabajador con sueldo diario (jornada semanal de 6 días)
							}else if(idTipoContratoTrab_sel == 4){ 
								document.getElementById('div_SueldoLiquido').style.display = 'none';
								document.getElementById('div_SueldoDia').style.display = 'block';
								document.getElementById('div_SueldoHora').style.display = 'none';
								//Reseteo los valores a 0
								document.getElementById('SueldoLiquido').value = "0";				
								//document.getElementById('SueldoDia').value = "0";				
								document.getElementById('SueldoHora').value = "0";
							
							//Trabajador con sueldo por hora
							}else if(idTipoContratoTrab_sel == 5){ 
								document.getElementById('div_SueldoLiquido').style.display = 'none';
								document.getElementById('div_SueldoDia').style.display = 'none';
								document.getElementById('div_SueldoHora').style.display = 'block';
								//Reseteo los valores a 0
								document.getElementById('SueldoLiquido').value = "0";				
								document.getElementById('SueldoDia').value = "0";				
								//document.getElementById('SueldoHora').value = "0";
							
							//si no en ninguno
							}else{ 
								document.getElementById('div_SueldoLiquido').style.display = 'none';
								document.getElementById('div_SueldoDia').style.display = 'none';
								document.getElementById('div_SueldoHora').style.display = 'none';
								//Reseteo los valores a 0
								document.getElementById('SueldoLiquido').value = "0";				
								document.getElementById('SueldoDia').value = "0";				
								document.getElementById('SueldoHora').value = "0";
							
							}
						});
						
						$("#idTipoTrabajo").on("change", function(){ //se ejecuta al cambiar valor del select
							idTipoTrabajo_sel = $(this).val(); //Asignamos el valor seleccionado
							
							//Trabajo normal
							if(idTipoTrabajo_sel == 1){ 
								document.getElementById('div_PorcentajeTrabajoPesado').style.display = 'none';
								//Reseteo los valores a 0
								document.getElementById('PorcentajeTrabajoPesado').value = "0";				
								
							//Trabajo pesado
							}else if(idTipoTrabajo_sel == 2){ 
								document.getElementById('div_PorcentajeTrabajoPesado').style.display = 'block';
								
							//si no en ninguno
							}else{ 
								document.getElementById('div_PorcentajeTrabajoPesado').style.display = 'none';
								//Reseteo los valores a 0
								document.getElementById('PorcentajeTrabajoPesado').value = "0";				
								
							}
						});
					</script> 

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
