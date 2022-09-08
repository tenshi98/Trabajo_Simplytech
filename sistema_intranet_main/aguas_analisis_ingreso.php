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
$original = "aguas_analisis_ingreso.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['f_muestra']) && $_GET['f_muestra'] != ''){                    $location .= "&f_muestra=".$_GET['f_muestra'];                    $search .= "&f_muestra=".$_GET['f_muestra'];}
if(isset($_GET['f_recibida']) && $_GET['f_recibida'] != ''){                  $location .= "&f_recibida=".$_GET['f_recibida'];                  $search .= "&f_recibida=".$_GET['f_recibida'];}
if(isset($_GET['idLaboratorio']) && $_GET['idLaboratorio'] != ''){            $location .= "&idLaboratorio=".$_GET['idLaboratorio'];            $search .= "&idLaboratorio=".$_GET['idLaboratorio'];}
if(isset($_GET['codigoMuestra']) && $_GET['codigoMuestra'] != ''){            $location .= "&codigoMuestra=".$_GET['codigoMuestra'];            $search .= "&codigoMuestra=".$_GET['codigoMuestra'];}
if(isset($_GET['CodigoLaboratorio']) && $_GET['CodigoLaboratorio'] != ''){    $location .= "&CodigoLaboratorio=".$_GET['CodigoLaboratorio'];    $search .= "&CodigoLaboratorio=".$_GET['CodigoLaboratorio'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/aguas_analisis_aguas.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/aguas_analisis_aguas.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/aguas_analisis_aguas.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Analisis Creado correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Analisis Modificado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Analisis borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);
// consulto los datos
$query = "SELECT f_muestra,f_recibida,idTipoMuestra,RemuestraFecha,Remuestra_codigo_muestra,idParametros,
idSigno,valorAnalisis,idLaboratorio,codigoMuestra,idOpciones,idSector,UTM_norte,UTM_este,idPuntoMuestreo,
idCliente,idSistema, idEstado, Observaciones, CodigoLaboratorio
FROM `aguas_analisis_aguas`
WHERE idAnalisisAgua = ".$_GET['id'];
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
//Busco los datos de los clientes
$arrTipo = array();
$query = "SELECT 
aguas_clientes_listado.idCliente,
aguas_clientes_listado.idSector,
aguas_clientes_listado.idPuntoMuestreo,
				
aguas_clientes_listado.UTM_norte,
aguas_clientes_listado.UTM_este,
aguas_analisis_sectores.Nombre AS Sector,
				
aguas_analisis_aguas_tipo_punto_muestreo.Nombre AS Punto
				
FROM `aguas_clientes_listado`
LEFT JOIN `aguas_analisis_sectores`                  ON aguas_analisis_sectores.idSector                         = aguas_clientes_listado.idSector
LEFT JOIN `aguas_analisis_aguas_tipo_punto_muestreo` ON aguas_analisis_aguas_tipo_punto_muestreo.idPuntoMuestreo = aguas_clientes_listado.idPuntoMuestreo
WHERE aguas_clientes_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema']."
AND aguas_clientes_listado.idEstado=1
ORDER BY aguas_clientes_listado.idCliente ASC";
//consulto
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
array_push( $arrTipo,$row );
}	 
//Indico el sistema	 
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	

?>
 
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Modificacion del Analisis</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($f_muestra)) {                 $x1  = $f_muestra;                  }else{$x1  = $rowdata['f_muestra'];}
				if(isset($f_recibida)) {                $x2  = $f_recibida;                 }else{$x2  = $rowdata['f_recibida'];}
				if(isset($idLaboratorio)) {             $x3  = $idLaboratorio;              }else{$x3  = $rowdata['idLaboratorio'];}
				if(isset($codigoMuestra)) {             $x4  = $codigoMuestra;              }else{$x4  = $rowdata['codigoMuestra'];}
				if(isset($CodigoLaboratorio)) {         $x5  = $CodigoLaboratorio;          }else{$x5  = $rowdata['CodigoLaboratorio'];}
				if(isset($idTipoMuestra)) {             $x6  = $idTipoMuestra;              }else{$x6  = $rowdata['idTipoMuestra'];}
				if(isset($RemuestraFecha)) {            $x7  = $RemuestraFecha;             }else{$x7  = $rowdata['RemuestraFecha'];}
				if(isset($Remuestra_codigo_muestra)) {  $x8  = $Remuestra_codigo_muestra;   }else{$x8  = $rowdata['Remuestra_codigo_muestra'];}
				if(isset($idParametros)) {              $x9  = $idParametros;               }else{$x9  = $rowdata['idParametros'];}
				if(isset($idSigno)) {                   $x10 = $idSigno;                    }else{$x10 = $rowdata['idSigno'];}
				if(isset($valorAnalisis)) {             $x11 = $valorAnalisis;              }else{$x11 = $rowdata['valorAnalisis'];}
				if(isset($idOpciones)) {                $x12 = $idOpciones;                 }else{$x12 = $rowdata['idOpciones'];}
				if(isset($idSector)) {                  $x13 = $idSector;                   }else{$x13 = $rowdata['idSector'];}
				if(isset($UTM_norte)) {                 $x14 = $UTM_norte;                  }else{$x14 = $rowdata['UTM_norte'];}
				if(isset($UTM_este)) {                  $x15 = $UTM_este;                   }else{$x15 = $rowdata['UTM_este'];}
				if(isset($idPuntoMuestreo)) {           $x16 = $idPuntoMuestreo;            }else{$x16 = $rowdata['idPuntoMuestreo'];}
				if(isset($idCliente)) {                 $x17 = $idCliente;                  }else{$x17 = $rowdata['idCliente'];}
				if(isset($idEstado)) {                  $x18 = $idEstado;                   }else{$x18 = $rowdata['idEstado'];}
				if(isset($Observaciones)) {             $x19 = $Observaciones;              }else{$x19 = $rowdata['Observaciones'];}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_tittle(3, 'Datos Basicos');
				$Form_Inputs->form_date('Fecha de la muestra','f_muestra', $x1, 2);
				$Form_Inputs->form_date('Fecha Recibida','f_recibida', $x2, 2);
				$Form_Inputs->form_select_filter('Laboratorio','idLaboratorio', $x3, 2, 'idLaboratorio', 'Nombre', 'aguas_analisis_laboratorios', $z, '', $dbConn);
				$Form_Inputs->form_input_number('Codigo Muestra', 'codigoMuestra', $x4, 2);
				$Form_Inputs->form_input_number('Codigo Laboratorio', 'CodigoLaboratorio', $x5, 1);
				$Form_Inputs->form_select('Tipo de Muestra','idTipoMuestra', $x6, 2, 'idTipoMuestra', 'Nombre', 'aguas_analisis_aguas_tipo_muestra', 0, '', $dbConn);
				$Form_Inputs->form_date('Fecha Remuestra','RemuestraFecha', $x7, 1);
				$Form_Inputs->form_input_number('Codigo Remuestra', 'Remuestra_codigo_muestra', $x8, 1);
				$Form_Inputs->form_select_filter('Parametro analizado','idParametros', $x9, 2, 'idParametros', 'Nombre', 'aguas_analisis_parametros', $z, '', $dbConn);
				$Form_Inputs->form_select('Signo','idSigno', $x10, 2, 'idSigno', 'Nombre', 'aguas_analisis_aguas_signo', 0, '', $dbConn);
				$Form_Inputs->form_input_number('Valor', 'valorAnalisis', $x11, 2);
						
				$Form_Inputs->form_tittle(3, 'Datos del Cliente');
				$Form_Inputs->form_select('Relacionar a cliente','idOpciones', $x12, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);
				
				//En caso de no ser relacionado
				$Form_Inputs->form_select('Sector','idSector', $x13, 1, 'idSector', 'Nombre', 'aguas_analisis_sectores', $z, '', $dbConn);
				$Form_Inputs->form_input_number('UTM norte', 'UTM_norte', $x14, 1);
				$Form_Inputs->form_input_number('UTM este', 'UTM_este', $x15, 1);
				$Form_Inputs->form_select('Tipo de Medicion','idPuntoMuestreo', $x16, 1, 'idPuntoMuestreo', 'Nombre', 'aguas_analisis_aguas_tipo_punto_muestreo', 0, '', $dbConn);
				
				//en caso de ser relacionado
				$Form_Inputs->form_select_filter('Cliente','idCliente', $x17, 2, 'idCliente', 'Identificador,Nombre', 'aguas_clientes_listado', $z.' AND aguas_clientes_listado.idEstado=1', 'ORDER BY Identificador ASC', $dbConn);
				$Form_Inputs->form_input_disabled('Sector','idSector_fake1', '');
				$Form_Inputs->form_input_disabled('UTM norte','UTM_norte_fake1', '');
				$Form_Inputs->form_input_disabled('UTM este','UTM_este_fake1', '');
				$Form_Inputs->form_input_disabled('Tipo de Medicion','idPuntoMuestreo_fake1', '');
				$Form_Inputs->form_input_hidden('idSector_fake2', '', 2);
				$Form_Inputs->form_input_hidden('UTM_norte_fake2', '', 2);
				$Form_Inputs->form_input_hidden('UTM_este_fake2', '', 2);
				$Form_Inputs->form_input_hidden('idPuntoMuestreo_fake2', '', 2);
				
					
				$Form_Inputs->form_tittle(3, 'Datos del Analisis');
				$Form_Inputs->form_select('Estado','idEstado', $x18, 2, 'idEstado', 'Nombre', 'aguas_analisis_aguas_estado', 0, '', $dbConn);
				$Form_Inputs->form_textarea('Observaciones', 'Observaciones', $x19, 1);
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('codigoProceso', 1, 2);
				$Form_Inputs->form_input_hidden('codigoArchivo', 1, 2);
				$Form_Inputs->form_input_hidden('codigoServicio', 13694, 2);
				$Form_Inputs->form_input_hidden('idAnalisisAgua', $_GET['id'], 2);
					
				echo '<script>';
				foreach ($arrTipo as $tipo) {
					echo '
					let id_idSector_'.$tipo['idCliente'].'= "'.$tipo['idSector'].'";
					let id_idPuntoMuestreo_'.$tipo['idCliente'].'= "'.$tipo['idPuntoMuestreo'].'";
					let UTM_norte_'.$tipo['idCliente'].'= "'.$tipo['UTM_norte'].'";
					let UTM_este_'.$tipo['idCliente'].'= "'.$tipo['UTM_este'].'";
					let Sector_'.$tipo['idCliente'].'= "'.$tipo['Sector'].'";
					let Punto_'.$tipo['idCliente'].'= "'.$tipo['Punto'].'";
					';	
				}
				echo '</script>';	

				?>
				
				<script>
					//oculto todos los div
					document.getElementById('div_RemuestraFecha').style.display = 'none';
					document.getElementById('div_Remuestra_codigo_muestra').style.display = 'none';
					document.getElementById('div_idSector').style.display = 'none';
					document.getElementById('div_UTM_norte').style.display = 'none';
					document.getElementById('div_UTM_este').style.display = 'none';
					document.getElementById('div_idPuntoMuestreo').style.display = 'none';
					document.getElementById('div_idCliente').style.display = 'none';
					document.getElementById('div_idSector_fake1').style.display = 'none';
					document.getElementById('div_UTM_norte_fake1').style.display = 'none';
					document.getElementById('div_UTM_este_fake1').style.display = 'none';
					document.getElementById('div_idPuntoMuestreo_fake1').style.display = 'none';
					
					//declaro variables
					
					
					var elem_8 = document.getElementById("idPuntoMuestreo_fake2");
					
					//inicio documentos
					$(document).ready(function(){ //se ejecuta al cargar la página (OBLIGATORIO)
						
						/***********************************************************************************/
						tipo_val_1= $("#idTipoMuestra").val();
						tipo_val_2= $("#idOpciones").val();
						tipo_val_3= $("#idCliente").val();
						
						
		
						if(tipo_val_1 == 1){ 
							document.getElementById('div_RemuestraFecha').style.display = 'none';
							document.getElementById('div_Remuestra_codigo_muestra').style.display = 'none';	
						//si es remuestra
						} else if(tipo_val_1 == 2){ 
							document.getElementById('div_RemuestraFecha').style.display = '';
							document.getElementById('div_Remuestra_codigo_muestra').style.display = '';
						} else { 
							document.getElementById('div_RemuestraFecha').style.display = 'none';
							document.getElementById('div_Remuestra_codigo_muestra').style.display = 'none';
						}
						
						if(tipo_val_2 == 1){ 
							document.getElementById('div_idSector').style.display = 'none';
							document.getElementById('div_UTM_norte').style.display = 'none';
							document.getElementById('div_UTM_este').style.display = 'none';
							document.getElementById('div_idPuntoMuestreo').style.display = 'none';
							document.getElementById('div_idCliente').style.display = '';
							document.getElementById('div_idSector_fake1').style.display = '';
							document.getElementById('div_UTM_norte_fake1').style.display = '';
							document.getElementById('div_UTM_este_fake1').style.display = '';
							document.getElementById('div_idPuntoMuestreo_fake1').style.display = '';	
						//si es no
						} else if(tipo_val_2 == 2){ 
							document.getElementById('div_idSector').style.display = '';
							document.getElementById('div_UTM_norte').style.display = '';
							document.getElementById('div_UTM_este').style.display = '';
							document.getElementById('div_idPuntoMuestreo').style.display = '';
							document.getElementById('div_idCliente').style.display = 'none';
							document.getElementById('div_idSector_fake1').style.display = 'none';
							document.getElementById('div_UTM_norte_fake1').style.display = 'none';
							document.getElementById('div_UTM_este_fake1').style.display = 'none';
							document.getElementById('div_idPuntoMuestreo_fake1').style.display = 'none';
						} else { 
							document.getElementById('div_idSector').style.display = 'none';
							document.getElementById('div_UTM_norte').style.display = 'none';
							document.getElementById('div_UTM_este').style.display = 'none';
							document.getElementById('div_idPuntoMuestreo').style.display = 'none';
							document.getElementById('div_idCliente').style.display = 'none';
							document.getElementById('div_idSector_fake1').style.display = 'none';
							document.getElementById('div_UTM_norte_fake1').style.display = 'none';
							document.getElementById('div_UTM_este_fake1').style.display = 'none';
							document.getElementById('div_idPuntoMuestreo_fake1').style.display = 'none';
						}
						
						//actualizo
						document.getElementById("idSector_fake1").value         = eval("Sector_" + tipo_val_3);
						document.getElementById("UTM_norte_fake1").value        = eval("UTM_norte_" + tipo_val_3);
						document.getElementById("UTM_este_fake1").value         = eval("UTM_este_" + tipo_val_3);
						document.getElementById("idPuntoMuestreo_fake1").value  = eval("Punto_" + tipo_val_3);
						document.getElementById("idSector_fake2").value         = eval("id_idSector_" + tipo_val_3);
						document.getElementById("UTM_norte_fake2").value        = eval("UTM_norte_" + tipo_val_3);
						document.getElementById("UTM_este_fake2").value         = eval("UTM_este_" + tipo_val_3);
						document.getElementById("idPuntoMuestreo_fake2").value  = eval("id_idPuntoMuestreo_" + tipo_val_3);
						
	
					
						/***********************************************************************************/
						//busco cambios en el Cliente seleccionado
						$("#idCliente").on("change", function(){ 
							//verifico si la seleccion tiene datos y procedo a escribir
							let idCliente = $(this).val(); 
							if (idCliente != "") {
								document.getElementById("idSector_fake1").value         = eval("Sector_" + idCliente);
								document.getElementById("UTM_norte_fake1").value        = eval("UTM_norte_" + idCliente);
								document.getElementById("UTM_este_fake1").value         = eval("UTM_este_" + idCliente);
								document.getElementById("idPuntoMuestreo_fake1").value  = eval("Punto_" + idCliente);
								document.getElementById("idSector_fake2").value         = eval("id_idSector_" + idCliente);
								document.getElementById("UTM_norte_fake2").value        = eval("UTM_norte_" + idCliente);
								document.getElementById("UTM_este_fake2").value         = eval("UTM_este_" + idCliente);
								document.getElementById("idPuntoMuestreo_fake2").value  = eval("id_idPuntoMuestreo_" + idCliente);
							}
		
						});
						
						
						//busco cambios en el tipo de muestra
						$("#idTipoMuestra").on("change", function(){ 
							let idTipoMuestra = $(this).val(); 
							//si es muestra
							if(idTipoMuestra == 1){ 
								document.getElementById('div_RemuestraFecha').style.display = 'none';
								document.getElementById('div_Remuestra_codigo_muestra').style.display = 'none';	
							//si es remuestra
							} else if(idTipoMuestra == 2){ 
								document.getElementById('div_RemuestraFecha').style.display = '';
								document.getElementById('div_Remuestra_codigo_muestra').style.display = '';
							} else { 
								document.getElementById('div_RemuestraFecha').style.display = 'none';
								document.getElementById('div_Remuestra_codigo_muestra').style.display = 'none';
							}
						});
						
						//busco cambios en el uso del cliente
						$("#idOpciones").on("change", function(){ 
							let idOpciones = $(this).val(); 
							//si es si
							if(idOpciones == 1){ 
								document.getElementById('div_idSector').style.display = 'none';
								document.getElementById('div_UTM_norte').style.display = 'none';
								document.getElementById('div_UTM_este').style.display = 'none';
								document.getElementById('div_idPuntoMuestreo').style.display = 'none';
								document.getElementById('div_idCliente').style.display = '';
								document.getElementById('div_idSector_fake1').style.display = '';
								document.getElementById('div_UTM_norte_fake1').style.display = '';
								document.getElementById('div_UTM_este_fake1').style.display = '';
								document.getElementById('div_idPuntoMuestreo_fake1').style.display = '';	
							//si es no
							} else if(idOpciones == 2){ 
								document.getElementById('div_idSector').style.display = '';
								document.getElementById('div_UTM_norte').style.display = '';
								document.getElementById('div_UTM_este').style.display = '';
								document.getElementById('div_idPuntoMuestreo').style.display = '';
								document.getElementById('div_idCliente').style.display = 'none';
								document.getElementById('div_idSector_fake1').style.display = 'none';
								document.getElementById('div_UTM_norte_fake1').style.display = 'none';
								document.getElementById('div_UTM_este_fake1').style.display = 'none';
								document.getElementById('div_idPuntoMuestreo_fake1').style.display = 'none';
							} else { 
								document.getElementById('div_idSector').style.display = 'none';
								document.getElementById('div_UTM_norte').style.display = 'none';
								document.getElementById('div_UTM_este').style.display = 'none';
								document.getElementById('div_idPuntoMuestreo').style.display = 'none';
								document.getElementById('div_idCliente').style.display = 'none';
								document.getElementById('div_idSector_fake1').style.display = 'none';
								document.getElementById('div_UTM_norte_fake1').style.display = 'none';
								document.getElementById('div_UTM_este_fake1').style.display = 'none';
								document.getElementById('div_idPuntoMuestreo_fake1').style.display = 'none';
							}
						});
					   
					}); 
				
				</script>

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) {
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn); 
//Busco los datos de los clientes
$arrTipo = array();
$query = "SELECT 
aguas_clientes_listado.idCliente,
aguas_clientes_listado.idSector,
aguas_clientes_listado.idPuntoMuestreo,
				
aguas_clientes_listado.UTM_norte,
aguas_clientes_listado.UTM_este,
aguas_analisis_sectores.Nombre AS Sector,
				
aguas_analisis_aguas_tipo_punto_muestreo.Nombre AS Punto
				
FROM `aguas_clientes_listado`
LEFT JOIN `aguas_analisis_sectores`                  ON aguas_analisis_sectores.idSector                         = aguas_clientes_listado.idSector
LEFT JOIN `aguas_analisis_aguas_tipo_punto_muestreo` ON aguas_analisis_aguas_tipo_punto_muestreo.idPuntoMuestreo = aguas_clientes_listado.idPuntoMuestreo
WHERE aguas_clientes_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema']."
AND aguas_clientes_listado.idEstado=1
ORDER BY aguas_clientes_listado.idCliente ASC";
//consulto
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
array_push( $arrTipo,$row );
}	 
//Indico el sistema	 
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	 
?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Analisis</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($f_muestra)) {                 $x1  = $f_muestra;                  }else{$x1  = '';}
				if(isset($f_recibida)) {                $x2  = $f_recibida;                 }else{$x2  = '';}
				if(isset($idLaboratorio)) {             $x3  = $idLaboratorio;              }else{$x3  = '';}
				if(isset($codigoMuestra)) {             $x4  = $codigoMuestra;              }else{$x4  = '';}
				if(isset($CodigoLaboratorio)) {         $x5  = $CodigoLaboratorio;          }else{$x5  = '';}
				if(isset($idTipoMuestra)) {             $x6  = $idTipoMuestra;              }else{$x6  = '';}
				if(isset($RemuestraFecha)) {            $x7  = $RemuestraFecha;             }else{$x7  = '';}
				if(isset($Remuestra_codigo_muestra)) {  $x8  = $Remuestra_codigo_muestra;   }else{$x8  = '';}
				if(isset($idParametros)) {              $x9  = $idParametros;               }else{$x9  = '';}
				if(isset($idSigno)) {                   $x10 = $idSigno;                    }else{$x10 = '';}
				if(isset($valorAnalisis)) {             $x11 = $valorAnalisis;              }else{$x11 = '';}
				if(isset($idOpciones)) {                $x12 = $idOpciones;                 }else{$x12 = '';}
				if(isset($idSector)) {                  $x13 = $idSector;                   }else{$x13 = '';}
				if(isset($UTM_norte)) {                 $x14 = $UTM_norte;                  }else{$x14 = '';}
				if(isset($UTM_este)) {                  $x15 = $UTM_este;                   }else{$x15 = '';}
				if(isset($idPuntoMuestreo)) {           $x16 = $idPuntoMuestreo;            }else{$x16 = '';}
				if(isset($idCliente)) {                 $x17 = $idCliente;                  }else{$x17 = '';}
				if(isset($idEstado)) {                  $x18 = $idEstado;                   }else{$x18 = '';}
				if(isset($Observaciones)) {             $x19 = $Observaciones;              }else{$x19 = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_tittle(3, 'Datos Basicos');
				$Form_Inputs->form_date('Fecha de la muestra','f_muestra', $x1, 2);
				$Form_Inputs->form_date('Fecha Recibida','f_recibida', $x2, 2);
				$Form_Inputs->form_select_filter('Laboratorio','idLaboratorio', $x3, 2, 'idLaboratorio', 'Nombre', 'aguas_analisis_laboratorios', $z, '', $dbConn);
				$Form_Inputs->form_input_number('Codigo Muestra', 'codigoMuestra', $x4, 2);
				$Form_Inputs->form_input_number('Codigo Laboratorio', 'CodigoLaboratorio', $x5, 1);
				$Form_Inputs->form_select('Tipo de Muestra','idTipoMuestra', $x6, 2, 'idTipoMuestra', 'Nombre', 'aguas_analisis_aguas_tipo_muestra', 0, '', $dbConn);
				$Form_Inputs->form_date('Fecha Remuestra','RemuestraFecha', $x7, 1);
				$Form_Inputs->form_input_number('Codigo Remuestra', 'Remuestra_codigo_muestra', $x8, 1);
				$Form_Inputs->form_select_filter('Parametro analizado','idParametros', $x9, 2, 'idParametros', 'Nombre', 'aguas_analisis_parametros', $z, '', $dbConn);
				$Form_Inputs->form_select('Signo','idSigno', $x10, 2, 'idSigno', 'Nombre', 'aguas_analisis_aguas_signo', 0, '', $dbConn);
				$Form_Inputs->form_input_number('Valor', 'valorAnalisis', $x11, 2);
						
				$Form_Inputs->form_tittle(3, 'Datos del Cliente');
				$Form_Inputs->form_select('Relacionar a cliente','idOpciones', $x12, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);
				
				//En caso de no ser relacionado
				$Form_Inputs->form_select('Sector','idSector', $x13, 1, 'idSector', 'Nombre', 'aguas_analisis_sectores', $z, '', $dbConn);
				$Form_Inputs->form_input_number('UTM norte', 'UTM_norte', $x14, 1);
				$Form_Inputs->form_input_number('UTM este', 'UTM_este', $x15, 1);
				$Form_Inputs->form_select('Tipo de Medicion','idPuntoMuestreo', $x16, 1, 'idPuntoMuestreo', 'Nombre', 'aguas_analisis_aguas_tipo_punto_muestreo', 0, '', $dbConn);
				
				//en caso de ser relacionado
				$Form_Inputs->form_select_filter('Cliente','idCliente', $x17, 2, 'idCliente', 'Identificador,Nombre', 'aguas_clientes_listado', $z.' AND aguas_clientes_listado.idEstado=1', 'ORDER BY Identificador ASC', $dbConn);
				$Form_Inputs->form_input_disabled('Sector','idSector_fake1', '');
				$Form_Inputs->form_input_disabled('UTM norte','UTM_norte_fake1', '');
				$Form_Inputs->form_input_disabled('UTM este','UTM_este_fake1', '');
				$Form_Inputs->form_input_disabled('Tipo de Medicion','idPuntoMuestreo_fake1', '');
				$Form_Inputs->form_input_hidden('idSector_fake2', '', 2);
				$Form_Inputs->form_input_hidden('UTM_norte_fake2', '', 2);
				$Form_Inputs->form_input_hidden('UTM_este_fake2', '', 2);
				$Form_Inputs->form_input_hidden('idPuntoMuestreo_fake2', '', 2);
				
					
				$Form_Inputs->form_tittle(3, 'Datos del Analisis');
				$Form_Inputs->form_select('Estado','idEstado', $x18, 2, 'idEstado', 'Nombre', 'aguas_analisis_aguas_estado', 0, '', $dbConn);
				$Form_Inputs->form_textarea('Observaciones', 'Observaciones', $x19, 1);
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('codigoProceso', 1, 2);
				$Form_Inputs->form_input_hidden('codigoArchivo', 1, 2);
				$Form_Inputs->form_input_hidden('codigoServicio', 13694, 2);
					
				echo '<script>';
				foreach ($arrTipo as $tipo) {
					echo '
					var id_idSector_'.$tipo['idCliente'].'= "'.$tipo['idSector'].'";
					var id_idPuntoMuestreo_'.$tipo['idCliente'].'= "'.$tipo['idPuntoMuestreo'].'";
					var UTM_norte_'.$tipo['idCliente'].'= "'.$tipo['UTM_norte'].'";
					var UTM_este_'.$tipo['idCliente'].'= "'.$tipo['UTM_este'].'";
					var Sector_'.$tipo['idCliente'].'= "'.$tipo['Sector'].'";
					var Punto_'.$tipo['idCliente'].'= "'.$tipo['Punto'].'";
					';	
				}
				echo '</script>';	

				?>
				
				<script>
					//oculto todos los div
					document.getElementById('div_RemuestraFecha').style.display = 'none';
					document.getElementById('div_Remuestra_codigo_muestra').style.display = 'none';
					document.getElementById('div_idSector').style.display = 'none';
					document.getElementById('div_UTM_norte').style.display = 'none';
					document.getElementById('div_UTM_este').style.display = 'none';
					document.getElementById('div_idPuntoMuestreo').style.display = 'none';
					document.getElementById('div_idCliente').style.display = 'none';
					document.getElementById('div_idSector_fake1').style.display = 'none';
					document.getElementById('div_UTM_norte_fake1').style.display = 'none';
					document.getElementById('div_UTM_este_fake1').style.display = 'none';
					document.getElementById('div_idPuntoMuestreo_fake1').style.display = 'none';
					
					//inicio documentos
					$(document).ready(function(){ //se ejecuta al cargar la página (OBLIGATORIO)
						
						//busco cambios en el Cliente seleccionado
						$("#idCliente").on("change", function(){ 
							//verifico si la seleccion tiene datos y procedo a escribir
							let idCliente = $(this).val(); 
							if (idCliente != "") {
								document.getElementById("idSector_fake1").value         = eval("Sector_" + idCliente);
								document.getElementById("UTM_norte_fake1").value        = eval("UTM_norte_" + idCliente);
								document.getElementById("UTM_este_fake1").value         = eval("UTM_este_" + idCliente);
								document.getElementById("idPuntoMuestreo_fake1").value  = eval("Punto_" + idCliente);
								document.getElementById("idSector_fake2").value         = eval("id_idSector_" + idCliente);
								document.getElementById("UTM_norte_fake2").value        = eval("UTM_norte_" + idCliente);
								document.getElementById("UTM_este_fake2").value         = eval("UTM_este_" + idCliente);
								document.getElementById("idPuntoMuestreo_fake2").value  = eval("id_idPuntoMuestreo_" + idCliente);
							}
		
						});
						
						
						//busco cambios en el tipo de muestra
						$("#idTipoMuestra").on("change", function(){ 
							let idTipoMuestra = $(this).val(); 
							//si es muestra
							if(idTipoMuestra == 1){ 
								document.getElementById('div_RemuestraFecha').style.display = 'none';
								document.getElementById('div_Remuestra_codigo_muestra').style.display = 'none';	
							//si es remuestra
							} else if(idTipoMuestra == 2){ 
								document.getElementById('div_RemuestraFecha').style.display = '';
								document.getElementById('div_Remuestra_codigo_muestra').style.display = '';
							} else { 
								document.getElementById('div_RemuestraFecha').style.display = 'none';
								document.getElementById('div_Remuestra_codigo_muestra').style.display = 'none';
							}
						});
						
						//busco cambios en el uso del cliente
						$("#idOpciones").on("change", function(){ 
							let idOpciones = $(this).val(); 
							//si es si
							if(idOpciones == 1){ 
								document.getElementById('div_idSector').style.display = 'none';
								document.getElementById('div_UTM_norte').style.display = 'none';
								document.getElementById('div_UTM_este').style.display = 'none';
								document.getElementById('div_idPuntoMuestreo').style.display = 'none';
								document.getElementById('div_idCliente').style.display = '';
								document.getElementById('div_idSector_fake1').style.display = '';
								document.getElementById('div_UTM_norte_fake1').style.display = '';
								document.getElementById('div_UTM_este_fake1').style.display = '';
								document.getElementById('div_idPuntoMuestreo_fake1').style.display = '';	
							//si es no
							} else if(idOpciones == 2){ 
								document.getElementById('div_idSector').style.display = '';
								document.getElementById('div_UTM_norte').style.display = '';
								document.getElementById('div_UTM_este').style.display = '';
								document.getElementById('div_idPuntoMuestreo').style.display = '';
								document.getElementById('div_idCliente').style.display = 'none';
								document.getElementById('div_idSector_fake1').style.display = 'none';
								document.getElementById('div_UTM_norte_fake1').style.display = 'none';
								document.getElementById('div_UTM_este_fake1').style.display = 'none';
								document.getElementById('div_idPuntoMuestreo_fake1').style.display = 'none';
							} else { 
								document.getElementById('div_idSector').style.display = 'none';
								document.getElementById('div_UTM_norte').style.display = 'none';
								document.getElementById('div_UTM_este').style.display = 'none';
								document.getElementById('div_idPuntoMuestreo').style.display = 'none';
								document.getElementById('div_idCliente').style.display = 'none';
								document.getElementById('div_idSector_fake1').style.display = 'none';
								document.getElementById('div_UTM_norte_fake1').style.display = 'none';
								document.getElementById('div_UTM_este_fake1').style.display = 'none';
								document.getElementById('div_idPuntoMuestreo_fake1').style.display = 'none';
							}
						});
					   
					}); 
				
				</script>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit">
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
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
	$comienzo = 0 ;
	$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'fecha_asc':        $order_by = 'aguas_analisis_aguas.f_muestra ASC ';            $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Muestra Ascendente'; break;
		case 'fecha_desc':       $order_by = 'aguas_analisis_aguas.f_muestra DESC ';           $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Muestra Descendente';break;
		case 'periodo_asc':      $order_by = 'aguas_analisis_aguas.f_muestra ASC ';            $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Periodo Ascendente'; break;
		case 'periodo_desc':     $order_by = 'aguas_analisis_aguas.f_muestra DESC ';           $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Periodo Descendente';break;
		case 'codigo_asc':       $order_by = 'aguas_analisis_aguas.CodigoLaboratorio ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Codigo Muestra Lab Ascendente'; break;
		case 'codigo_desc':      $order_by = 'aguas_analisis_aguas.CodigoLaboratorio DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Codigo Muestra Lab Descendente';break;
		case 'parametro_asc':    $order_by = 'aguas_analisis_parametros.Nombre ASC ';          $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Parametro Revision Ascendente'; break;
		case 'parametro_desc':   $order_by = 'aguas_analisis_parametros.Nombre DESC ';         $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Parametro Revision Descendente';break;
		case 'valor_asc':        $order_by = 'aguas_analisis_aguas.valorAnalisis ASC ';        $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Valor Ascendente'; break;
		case 'valor_desc':       $order_by = 'aguas_analisis_aguas.valorAnalisis DESC ';       $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Valor Descendente';break;
		case 'cliente_asc':      $order_by = 'aguas_clientes_listado.Nombre ASC ';             $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Cliente Ascendente'; break;
		case 'cliente_desc':     $order_by = 'aguas_clientes_listado.Nombre DESC ';            $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Cliente Descendente';break;

		default: $order_by = 'aguas_analisis_aguas.idAnalisisAgua DESC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Analisis Agua Descendente';
	}
}else{
	$order_by = 'aguas_analisis_aguas.idAnalisisAgua DESC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Analisis Agua Descendente';
}
/**********************************************************/
//Variable de busqueda
$SIS_where = "aguas_analisis_aguas.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['f_muestra']) && $_GET['f_muestra'] != ''){                    $SIS_where .= " AND aguas_analisis_aguas.f_muestra='".$_GET['f_muestra']."'";}
if(isset($_GET['f_recibida']) && $_GET['f_recibida'] != ''){                  $SIS_where .= " AND aguas_analisis_aguas.f_recibida='".$_GET['f_recibida']."'";}
if(isset($_GET['idLaboratorio']) && $_GET['idLaboratorio'] != ''){            $SIS_where .= " AND aguas_analisis_aguas.idLaboratorio='".$_GET['idLaboratorio']."'";}
if(isset($_GET['codigoMuestra']) && $_GET['codigoMuestra'] != ''){            $SIS_where .= " AND aguas_analisis_aguas.codigoMuestra='".$_GET['codigoMuestra']."'";}
if(isset($_GET['CodigoLaboratorio']) && $_GET['CodigoLaboratorio'] != ''){    $SIS_where .= " AND aguas_analisis_aguas.CodigoLaboratorio='".$_GET['CodigoLaboratorio']."'";}

/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$cuenta_registros = db_select_nrows (false, 'idAnalisisAgua', 'aguas_analisis_aguas', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los elementos
$SIS_query = '
aguas_analisis_aguas.idAnalisisAgua,
aguas_analisis_aguas.f_muestra,
aguas_analisis_aguas.valorAnalisis,
aguas_analisis_aguas.CodigoLaboratorio,
aguas_analisis_parametros.Nombre AS Parametro,
aguas_clientes_listado.Nombre AS Cliente,
core_sistemas.Nombre AS sistema';
$SIS_join  = '
LEFT JOIN `aguas_analisis_parametros`   ON aguas_analisis_parametros.idParametros   = aguas_analisis_aguas.idParametros
LEFT JOIN `aguas_clientes_listado`      ON aguas_clientes_listado.idCliente         = aguas_analisis_aguas.idCliente
LEFT JOIN `core_sistemas`               ON core_sistemas.idSistema                  = aguas_analisis_aguas.idSistema';
$SIS_order = $order_by.' LIMIT '.$comienzo.', '.$cant_reg;
$arrTipo = array();
$arrTipo = db_select_array (false, $SIS_query, 'aguas_analisis_aguas', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrTipo');

$z = "aguas_analisis_aguas.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
?>

<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Analisis</a><?php } ?>
	
</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($f_muestra)) {            $x1  = $f_muestra;            }else{$x1  = '';}
				if(isset($f_recibida)) {           $x2  = $f_recibida;           }else{$x2  = '';}
				if(isset($idLaboratorio)) {        $x3  = $idLaboratorio;        }else{$x3  = '';}
				if(isset($codigoMuestra)) {        $x4  = $codigoMuestra;        }else{$x4  = '';}
				if(isset($CodigoLaboratorio)) {    $x5  = $CodigoLaboratorio;    }else{$x5  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha de la muestra','f_muestra', $x1, 1);
				$Form_Inputs->form_date('Fecha Recibida','f_recibida', $x2, 1);
				$Form_Inputs->form_select_filter('Laboratorio','idLaboratorio', $x3, 1, 'idLaboratorio', 'Nombre', 'aguas_analisis_laboratorios', $z, '', $dbConn);
				$Form_Inputs->form_input_number('Codigo Muestra', 'codigoMuestra', $x4, 1);
				$Form_Inputs->form_input_number('Codigo Laboratorio', 'CodigoLaboratorio', $x5, 1);
				
				$Form_Inputs->form_input_hidden('pagina', $_GET['pagina'], 1);
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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Analisis</h5>
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
							<div class="pull-left">Fecha Muestra</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fecha_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=fecha_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Periodo</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=periodo_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=periodo_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Codigo Muestra Lab</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=codigo_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=codigo_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Parametro Revision</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=parametro_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=parametro_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Valor</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=valor_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=valor_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Cliente</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=cliente_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=cliente_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>		  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrTipo as $tipo) { ?>
					<tr class="odd">
						<td><?php echo fecha_estandar($tipo['f_muestra']); ?></td>
						<td><?php echo fecha2Ano($tipo['f_muestra']).fecha2NMes($tipo['f_muestra']); ?></td>
						<td><?php echo $tipo['CodigoLaboratorio']; ?></td>
						<td><?php echo $tipo['Parametro']; ?></td>
						<td align="right"><?php echo Cantidades_decimales_justos($tipo['valorAnalisis']); ?></td>
						<td><?php echo $tipo['Cliente']; ?></td>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $tipo['sistema']; ?></td><?php } ?>			
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_aguas_analisis.php?view='.simpleEncode($tipo['idAnalisisAgua'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$tipo['idAnalisisAgua']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.simpleEncode($tipo['idAnalisisAgua'], fecha_actual());
									$dialogo   = '¿Realmente deseas eliminar el analisis de la fecha '.fecha_estandar($tipo['f_muestra']).'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
