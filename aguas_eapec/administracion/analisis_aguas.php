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
$original = "analisis_aguas.php";
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
	$form_obligatorios = 'f_muestra,f_recibida,idTipoMuestra,idParametros,idSigno,valor,idLaboratorio,idSistema';
	$form_trabajo= 'insert';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/analisis_aguas.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idAnalisisAgua,f_muestra,f_recibida,idTipoMuestra,idParametros,idSigno,valor,idLaboratorio,idSistema';
	$form_trabajo= 'update';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/analisis_aguas.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/analisis_aguas.php';	
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Analisis Creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Analisis Modificado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Analisis borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT f_muestra,f_recibida,idTipoMuestra,RemuestraFecha,Remuestra_codigo_muestra,idParametros,
idSigno,valorAnalisis,idLaboratorio,codigoMuestra,idOpciones,idSector,UTM_norte,UTM_este,idPuntoMuestreo,
idCliente,idSistema, idEstado, Observaciones, CodigoLaboratorio
FROM `analisis_aguas`
WHERE idAnalisisAgua = {$_GET['id']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);	
//Se verifica el sistema
if($arrUsuario['tipo']=='SuperAdmin'){
	$z = "idSistema>=0";	
}else{
	$z = "idSistema={$arrUsuario['idSistema']}";	
}
?>
 
<div class="col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificacion del Analisis</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" name="form1">

				<?php 
				//Se verifican si existen los datos
				if(isset($f_muestra)) {                  $x1  = $f_muestra;                 }else{$x1  = $rowdata['f_muestra'];}
				if(isset($f_recibida)) {                 $x2  = $f_recibida;                }else{$x2  = $rowdata['f_recibida'];}
				if(isset($idTipoMuestra)) {              $x3  = $idTipoMuestra;             }else{$x3  = $rowdata['idTipoMuestra'];}
				if(isset($RemuestraFecha)) {             $x4  = $RemuestraFecha;            }else{$x4  = $rowdata['RemuestraFecha'];}
				if(isset($Remuestra_codigo_muestra)) {   $x5  = $Remuestra_codigo_muestra;  }else{$x5  = $rowdata['Remuestra_codigo_muestra'];}
				if(isset($idParametros)) {               $x6  = $idParametros;              }else{$x6  = $rowdata['idParametros'];}
				if(isset($idSigno)) {                    $x7  = $idSigno;                   }else{$x7  = $rowdata['idSigno'];}
				if(isset($valorAnalisis)) {              $x8  = $valorAnalisis;             }else{$x8  = $rowdata['valorAnalisis'];}
				if(isset($idLaboratorio)) {              $x9  = $idLaboratorio;             }else{$x9  = $rowdata['idLaboratorio'];}
				if(isset($codigoMuestra)) {              $x10 = $codigoMuestra;             }else{$x10 = $rowdata['codigoMuestra'];}
				if(isset($idOpciones)) {                 $x11 = $idOpciones;                }else{$x11 = $rowdata['idOpciones'];}
				if(isset($idSector)) {                   $x12 = $idSector;                  }else{$x12 = $rowdata['idSector'];}
				if(isset($UTM_norte)) {                  $x13 = $UTM_norte;                 }else{$x13 = $rowdata['UTM_norte'];}
				if(isset($UTM_este)) {                   $x14 = $UTM_este;                  }else{$x14 = $rowdata['UTM_este'];}
				if(isset($idPuntoMuestreo)) {            $x15 = $idPuntoMuestreo;           }else{$x15 = $rowdata['idPuntoMuestreo'];}
				if(isset($idCliente)) {                  $x16 = $idCliente;                 }else{$x16 = $rowdata['idCliente'];}
				if(isset($idEstado)) {                   $x17 = $idEstado;                  }else{$x17 = $rowdata['idEstado'];}
				if(isset($Observaciones)) {              $x18 = $Observaciones;             }else{$x18 = $rowdata['Observaciones'];}
				if(isset($idSistema)) {                  $x19 = $idSistema;                 }else{$x19 = $rowdata['idSistema'];}
				if(isset($CodigoLaboratorio)) {          $x20 = $CodigoLaboratorio;         }else{$x20 = $rowdata['CodigoLaboratorio'];}
				
				//se dibujan los inputs
				echo '<h3>Datos Basicos</h3>';
				echo form_date('Fecha de la muestra','f_muestra', $x1, 2);
				echo form_date('Fecha Recibida','f_recibida', $x2, 2);
				echo form_select_filter('Laboratorio','idLaboratorio', $x9, 2, 'idLaboratorio', 'Nombre', 'analisis_laboratorios', $z, $dbConn);
				echo form_input_number('Codigo Muestra', 'codigoMuestra', $x10, 2);
				echo form_input_number('Codigo Laboratorio', 'CodigoLaboratorio', $x20, 1);
				echo form_select('Tipo de Muestra','idTipoMuestra', $x3, 2, 'idTipoMuestra', 'Nombre', 'analisis_aguas_tipo_muestra', 0, $dbConn);
				echo form_date('Fecha Remuestra','RemuestraFecha', $x4, 1);
				echo form_input_number('Codigo Remuestra', 'Remuestra_codigo_muestra', $x5, 1);
				echo form_select_filter('Parametro analizado','idParametros', $x6, 2, 'idParametros', 'Nombre', 'analisis_parametros', $z, $dbConn);
				echo form_select('Signo','idSigno', $x7, 2, 'idSigno', 'Nombre', 'analisis_aguas_signo', 0, $dbConn);
				echo form_input_number('Valor', 'valorAnalisis', $x8, 2);
				
				echo '<h3>Datos del Cliente</h3>';
				echo form_select('Relacionar a cliente','idOpciones', $x11, 2, 'idOpciones', 'Nombre', 'core_datos_opciones', 0, $dbConn);
				
				//En caso de no ser relacionado
				echo form_select('Sector','idSector', $x12, 1, 'idSector', 'Nombre', 'analisis_sectores', $z, $dbConn);
				echo form_input_number('UTM norte', 'UTM_norte', $x13, 1);
				echo form_input_number('UTM este', 'UTM_este', $x14, 1);
				echo form_select('Tipo de Medicion','idPuntoMuestreo', $x15, 1, 'idPuntoMuestreo', 'Nombre', 'analisis_aguas_tipo_punto_muestreo', 0, $dbConn);
				
				//en caso de ser relacionado
				echo form_select_custom('Cliente','idCliente', $x16, 1, 'idCliente', 'Identificador,Nombre', 'clientes_listado', $z, 'ORDER BY Identificador ASC',$dbConn);
				echo form_input_disabled('text','Sector','idSector_fake1', $x12, 1);
				echo form_input_disabled('text','UTM norte','UTM_norte_fake1', $x13, 1);
				echo form_input_disabled('text','UTM este','UTM_este_fake1', $x14, 1);
				echo form_input_disabled('text','Tipo de Medicion','idPuntoMuestreo_fake1', $x15, 1);
				echo '<input type="hidden" id="idSector_fake2"         name="idSector_fake2"         value="'.$x12.'">';
				echo '<input type="hidden" id="UTM_norte_fake2"        name="UTM_norte_fake2"        value="'.$x13.'">';
				echo '<input type="hidden" id="UTM_este_fake2"         name="UTM_este_fake2"         value="'.$x14.'">';
				echo '<input type="hidden" id="idPuntoMuestreo_fake2"  name="idPuntoMuestreo_fake2"  value="'.$x15.'">';
				
				echo '<h3>Datos del Analisis</h3>';
				echo form_select('Estado','idEstado', $x17, 2, 'idEstado', 'Nombre', 'analisis_aguas_estado', 0, $dbConn);
				echo form_textarea('Observaciones','Observaciones', $x18, 1);
				
				/*************************************************************************/
				if($arrUsuario['tipo']=='SuperAdmin'){
				echo form_select('Sistema','idSistema', $x19, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
				}else{
				echo '<input type="hidden" name="idSistema"   value="'.$arrUsuario['idSistema'].'">';
				}
				
				echo '<input type="hidden" name="codigoProceso"    value="1">';
				echo '<input type="hidden" name="codigoArchivo"    value="1">';
				echo '<input type="hidden" name="codigoServicio"   value="13694">';
				
				//Busco los datos de los clientes
				$arrTipo = array();
				$query = "SELECT 
				clientes_listado.idCliente,
				clientes_listado.idSector,
				clientes_listado.idPuntoMuestreo,
				
				clientes_listado.UTM_norte,
				clientes_listado.UTM_este,
				analisis_sectores.Nombre AS Sector,
				
				analisis_aguas_tipo_punto_muestreo.Nombre AS Punto
				
				FROM `clientes_listado`
				LEFT JOIN `analisis_sectores`                  ON analisis_sectores.idSector                         = clientes_listado.idSector
				LEFT JOIN `analisis_aguas_tipo_punto_muestreo` ON analisis_aguas_tipo_punto_muestreo.idPuntoMuestreo = clientes_listado.idPuntoMuestreo
				WHERE clientes_listado.".$z."
				ORDER BY clientes_listado.idCliente ASC";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrTipo,$row );
				}
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
					
					//declaro variables
					var idTipoMuestra;
					var idOpciones;
					var idCliente;
					var elem_1 = document.getElementById("idSector_fake1");
					var elem_2 = document.getElementById("UTM_norte_fake1");
					var elem_3 = document.getElementById("UTM_este_fake1");
					var elem_4 = document.getElementById("idPuntoMuestreo_fake1");
					var elem_5 = document.getElementById("idSector_fake2");
					var elem_6 = document.getElementById("UTM_norte_fake2");
					var elem_7 = document.getElementById("UTM_este_fake2");
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
	
					
						/***********************************************************************************/
						//busco cambios en el Cliente seleccionado
						$("#idCliente").on("change", function(){ 
							//verifico si la seleccion tiene datos y procedo a escribir
							idCliente = $(this).val(); 
							if (idCliente != "") {
								elem_1.value = eval("Sector_" + idCliente);
								elem_2.value = eval("UTM_norte_" + idCliente);
								elem_3.value = eval("UTM_este_" + idCliente);
								elem_4.value = eval("Punto_" + idCliente);
								elem_5.value = eval("id_idSector_" + idCliente);
								elem_6.value = eval("UTM_norte_" + idCliente);
								elem_7.value = eval("UTM_este_" + idCliente);
								elem_8.value = eval("id_idPuntoMuestreo_" + idCliente);
							}
		
						});
						
						
						//busco cambios en el tipo de muestra
						$("#idTipoMuestra").on("change", function(){ 
							idTipoMuestra = $(this).val(); 
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
							idOpciones = $(this).val(); 
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
					<input type="hidden" name="idAnalisisAgua" value="<?php echo $_GET['id']; ?>" >
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_edit"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
				</div>
                      
			</form> 
                    
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) {
//Se verifica el sistema
if($arrUsuario['tipo']=='SuperAdmin'){
	$z = "idSistema>=0";	
}else{
	$z = "idSistema={$arrUsuario['idSistema']}";	
}
 ?>
 <div class="col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Nuevo Analisis</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" name="form1">
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($f_muestra)) {                  $x1  = $f_muestra;                 }else{$x1  = '';}
				if(isset($f_recibida)) {                 $x2  = $f_recibida;                }else{$x2  = '';}
				if(isset($idTipoMuestra)) {              $x3  = $idTipoMuestra;             }else{$x3  = '';}
				if(isset($RemuestraFecha)) {             $x4  = $RemuestraFecha;            }else{$x4  = '';}
				if(isset($Remuestra_codigo_muestra)) {   $x5  = $Remuestra_codigo_muestra;  }else{$x5  = '';}
				if(isset($idParametros)) {               $x6  = $idParametros;              }else{$x6  = '';}
				if(isset($idSigno)) {                    $x7  = $idSigno;                   }else{$x7  = '';}
				if(isset($valorAnalisis)) {              $x8  = $valorAnalisis;             }else{$x8  = '';}
				if(isset($idLaboratorio)) {              $x9  = $idLaboratorio;             }else{$x9  = '';}
				if(isset($codigoMuestra)) {              $x10 = $codigoMuestra;             }else{$x10 = '';}
				if(isset($idOpciones)) {                 $x11 = $idOpciones;                }else{$x11 = '';}
				if(isset($idSector)) {                   $x12 = $idSector;                  }else{$x12 = '';}
				if(isset($UTM_norte)) {                  $x13 = $UTM_norte;                 }else{$x13 = '';}
				if(isset($UTM_este)) {                   $x14 = $UTM_este;                  }else{$x14 = '';}
				if(isset($idPuntoMuestreo)) {            $x15 = $idPuntoMuestreo;           }else{$x15 = '';}
				if(isset($idCliente)) {                  $x16 = $idCliente;                 }else{$x16 = '';}
				if(isset($idEstado)) {                   $x17 = $idEstado;                  }else{$x17 = '';}
				if(isset($Observaciones)) {              $x18 = $Observaciones;             }else{$x18 = '';}
				if(isset($idSistema)) {                  $x19 = $idSistema;                 }else{$x19 = '';}
				if(isset($CodigoLaboratorio)) {          $x20 = $CodigoLaboratorio;         }else{$x20 = '';}
				
				//se dibujan los inputs
				echo '<h3>Datos Basicos</h3>';
				echo form_date('Fecha de la muestra','f_muestra', $x1, 2);
				echo form_date('Fecha Recibida','f_recibida', $x2, 2);
				echo form_select_filter('Laboratorio','idLaboratorio', $x9, 2, 'idLaboratorio', 'Nombre', 'analisis_laboratorios', $z, $dbConn);
				echo form_input_number('Codigo Muestra', 'codigoMuestra', $x10, 2);
				echo form_input_number('Codigo Laboratorio', 'CodigoLaboratorio', $x20, 1);
				echo form_select('Tipo de Muestra','idTipoMuestra', $x3, 2, 'idTipoMuestra', 'Nombre', 'analisis_aguas_tipo_muestra', 0, $dbConn);
				echo form_date('Fecha Remuestra','RemuestraFecha', $x4, 1);
				echo form_input_number('Codigo Remuestra', 'Remuestra_codigo_muestra', $x5, 1);
				echo form_select_filter('Parametro analizado','idParametros', $x6, 2, 'idParametros', 'Nombre', 'analisis_parametros', $z, $dbConn);
				echo form_select('Signo','idSigno', $x7, 2, 'idSigno', 'Nombre', 'analisis_aguas_signo', 0, $dbConn);
				echo form_input_number('Valor', 'valorAnalisis', $x8, 2);
				
				echo '<h3>Datos del Cliente</h3>';
				echo form_select('Relacionar a cliente','idOpciones', $x11, 2, 'idOpciones', 'Nombre', 'core_datos_opciones', 0, $dbConn);
				
				//En caso de no ser relacionado
				echo form_select('Sector','idSector', $x12, 1, 'idSector', 'Nombre', 'analisis_sectores', $z, $dbConn);
				echo form_input_number('UTM norte', 'UTM_norte', $x13, 1);
				echo form_input_number('UTM este', 'UTM_este', $x14, 1);
				echo form_select('Tipo de Medicion','idPuntoMuestreo', $x15, 1, 'idPuntoMuestreo', 'Nombre', 'analisis_aguas_tipo_punto_muestreo', 0, $dbConn);
				
				//en caso de ser relacionado
				echo form_select_custom('Cliente','idCliente', $x16, 2, 'idCliente', 'Identificador,Nombre', 'clientes_listado', $z, 'ORDER BY Identificador ASC',$dbConn);
				echo form_input_disabled('text','Sector','idSector_fake1', 0, 1);
				echo form_input_disabled('text','UTM norte','UTM_norte_fake1', 0, 1);
				echo form_input_disabled('text','UTM este','UTM_este_fake1', 0, 1);
				echo form_input_disabled('text','Tipo de Medicion','idPuntoMuestreo_fake1', 0, 1);
				echo '<input type="hidden" id="idSector_fake2"         name="idSector_fake2"         value="">';
				echo '<input type="hidden" id="UTM_norte_fake2"        name="UTM_norte_fake2"        value="">';
				echo '<input type="hidden" id="UTM_este_fake2"         name="UTM_este_fake2"         value="">';
				echo '<input type="hidden" id="idPuntoMuestreo_fake2"  name="idPuntoMuestreo_fake2"  value="">';
				
				echo '<h3>Datos del Analisis</h3>';
				echo form_select('Estado','idEstado', $x17, 2, 'idEstado', 'Nombre', 'analisis_aguas_estado', 0, $dbConn);
				echo form_textarea('Observaciones','Observaciones', $x18, 1);
				
				/*************************************************************************/
				if($arrUsuario['tipo']=='SuperAdmin'){
				echo form_select('Sistema','idSistema', $x19, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
				}else{
				echo '<input type="hidden" name="idSistema"   value="'.$arrUsuario['idSistema'].'">';
				}
				
				echo '<input type="hidden" name="codigoProceso"    value="1">';
				echo '<input type="hidden" name="codigoArchivo"    value="1">';
				echo '<input type="hidden" name="codigoServicio"   value="13694">';
				
				//Busco los datos de los clientes
				$arrTipo = array();
				$query = "SELECT 
				clientes_listado.idCliente,
				clientes_listado.idSector,
				clientes_listado.idPuntoMuestreo,
				
				clientes_listado.UTM_norte,
				clientes_listado.UTM_este,
				analisis_sectores.Nombre AS Sector,
				
				analisis_aguas_tipo_punto_muestreo.Nombre AS Punto
				
				FROM `clientes_listado`
				LEFT JOIN `analisis_sectores`                  ON analisis_sectores.idSector                         = clientes_listado.idSector
				LEFT JOIN `analisis_aguas_tipo_punto_muestreo` ON analisis_aguas_tipo_punto_muestreo.idPuntoMuestreo = clientes_listado.idPuntoMuestreo
				WHERE clientes_listado.".$z."
				ORDER BY clientes_listado.idCliente ASC";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrTipo,$row );
				}
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
					
					//declaro variables
					var idTipoMuestra;
					var idOpciones;
					var idCliente;
					var elem_1 = document.getElementById("idSector_fake1");
					var elem_2 = document.getElementById("UTM_norte_fake1");
					var elem_3 = document.getElementById("UTM_este_fake1");
					var elem_4 = document.getElementById("idPuntoMuestreo_fake1");
					var elem_5 = document.getElementById("idSector_fake2");
					var elem_6 = document.getElementById("UTM_norte_fake2");
					var elem_7 = document.getElementById("UTM_este_fake2");
					var elem_8 = document.getElementById("idPuntoMuestreo_fake2");
							
							
					//inicio documentos
					$(document).ready(function(){ //se ejecuta al cargar la página (OBLIGATORIO)
						
						//busco cambios en el Cliente seleccionado
						$("#idCliente").on("change", function(){ 
							//verifico si la seleccion tiene datos y procedo a escribir
							idCliente = $(this).val(); 
							if (idCliente != "") {
								elem_1.value = eval("Sector_" + idCliente);
								elem_2.value = eval("UTM_norte_" + idCliente);
								elem_3.value = eval("UTM_este_" + idCliente);
								elem_4.value = eval("Punto_" + idCliente);
								elem_5.value = eval("id_idSector_" + idCliente);
								elem_6.value = eval("UTM_norte_" + idCliente);
								elem_7.value = eval("UTM_este_" + idCliente);
								elem_8.value = eval("id_idPuntoMuestreo_" + idCliente);
							}
		
						});
						
						
						//busco cambios en el tipo de muestra
						$("#idTipoMuestra").on("change", function(){ 
							idTipoMuestra = $(this).val(); 
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
							idOpciones = $(this).val(); 
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
//Variable con la ubicacion
$z="WHERE analisis_aguas.idAnalisisAgua!=0";
//Verifico si la variable de busqueda existe
if (isset($_GET['search'])){
	$z.=" AND analisis_aguas.codigoMuestra LIKE '%{$_GET['search']}%'";	
}
//Verifico el tipo de usuario que esta ingresando
if($arrUsuario['tipo']=='SuperAdmin'){
	$z.=" AND analisis_aguas.idSistema>=0";	
}else{
	$z.=" AND analisis_aguas.idSistema={$arrUsuario['idSistema']}";	
}
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idAnalisisAgua FROM `analisis_aguas` ".$z."";
$registros = mysqli_query ($dbConn, $query);
$cuenta_registros = mysqli_num_rows($registros);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrTipo = array();
$query = "SELECT 
analisis_aguas.idAnalisisAgua,
analisis_aguas.f_muestra,
analisis_aguas.valorAnalisis,
analisis_aguas.CodigoLaboratorio,
analisis_parametros.Nombre AS Parametro,
clientes_listado.Nombre AS Cliente

FROM `analisis_aguas`
LEFT JOIN `analisis_parametros`   ON analisis_parametros.idParametros   = analisis_aguas.idParametros
LEFT JOIN `clientes_listado`      ON clientes_listado.idCliente         = analisis_aguas.idCliente
".$z."
ORDER BY analisis_aguas.idAnalisisAgua DESC
LIMIT $comienzo, $cant_reg ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrTipo,$row );
}?>

<div class="form-group">
<form class="form-horizontal" action="<?php echo $location ?>"  name="form1">
<label class="control-label col-lg-4">Buscar Analisis</label>
    <div class="col-lg-5">
		<div class="input-group bootstrap-timepicker fmrnew">
        	<input type="hidden" name="pagina" value="<?php echo $_GET['pagina']; ?>" >
			<input class="form-control timepicker-default" type="text" name="search" value="<?php if (isset($_GET['search'])) { echo $_GET['search'];}?>" placeholder="Codigo Muestra">
            <button type="submit" class="t_search_button"><i class="fa fa-search"></i></button>
            <button class="t_search_button2" onClick="document.form1.search.value = '';"><i class="fa fa-trash-o"></i></button>
		</div>
    </div>
</form>
<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" >Crear Nuevo Analisis</a><?php } ?>
</div>
<div class="clearfix"></div>                       
                                 
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Analisis</h5>
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
						<th>Fecha Muestra</th>
						<th>Periodo</th>
						<th>Codigo Muestra Lab</th>
						<th>Parametro Revision</th>
						<th>Valor</th>
						<th>Cliente</th>
						<th width="120">Acciones</th>
					</tr>
				</thead>				  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrTipo as $tipo) { ?>
					<tr class="odd">
						<td><?php echo $tipo['f_muestra']; ?></td>
						<td><?php echo Fecha_año($tipo['f_muestra']).Fecha_mes_n($tipo['f_muestra']); ?></td>
						<td><?php echo $tipo['CodigoLaboratorio']; ?></td>
						<td><?php echo $tipo['Parametro']; ?></td>
						<td align="right"><?php echo Cantidades_decimales_justos($tipo['valorAnalisis']); ?></td>
						<td><?php echo $tipo['Cliente']; ?></td>
						<td>
							<div class="btn-group widthtd120" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_analisis.php?view='.$tipo['idAnalisisAgua']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$tipo['idAnalisisAgua']; ?>" data-placement="bottom" title="Editar Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$tipo['idAnalisisAgua'];
									$dialogo   = '¿Realmente deseas eliminar el analisis de la fecha '.$tipo['f_muestra'].'?';?>
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


<?php
/*
$arrTipo = array();
$query = "SELECT
analisis_aguas.idAnalisisAgua,
analisis_aguas.idCliente,
clientes_listado.UTM_este,
clientes_listado.UTM_norte,
clientes_listado.idSector
FROM
analisis_aguas
LEFT JOIN clientes_listado on clientes_listado.idCliente = analisis_aguas.idCliente
WHERE
analisis_aguas.idCliente != '' AND analisis_aguas.UTM_este = ''";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrTipo,$row );
}

foreach ($arrTipo as $tipo) {
	$a = "idAnalisisAgua='".$tipo['idAnalisisAgua']."'" ;
	$a .= ",UTM_este='".$tipo['UTM_este']."'" ;
	$a .= ",UTM_norte='".$tipo['UTM_norte']."'" ;
	$a .= ",idSector='".$tipo['idSector']."'" ;
	
	// inserto los datos de registro en la db
	$query  = "UPDATE `analisis_aguas` SET ".$a." WHERE idAnalisisAgua = '".$tipo['idAnalisisAgua']."'";
	$result = mysqli_query($dbConn, $query);
}*/

?>
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
