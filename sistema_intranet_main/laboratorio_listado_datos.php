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
$original = "laboratorio_listado.php";
$location = $original;
$new_location = "laboratorio_listado_datos.php";
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
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/laboratorio_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Laboratorio creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Laboratorio editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Laboratorio borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// Se traen todos los datos de mi usuario
$query = "SELECT idTipo, Nombre , Rut, fNacimiento, idPais, idCiudad, idComuna, Direccion, idSistema, Giro
FROM `laboratorio_listado`
WHERE idLaboratorio = {$_GET['id']}";
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
$rowdata = mysqli_fetch_assoc ($resultado);?>

<div class="col-sm-12">
	<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-cog faa-spin animated " aria-hidden="true"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Laboratorio</span>
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
				<li class=""><a href="<?php echo 'laboratorio_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class="active"><a href="<?php echo 'laboratorio_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'laboratorio_listado_datos_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Contacto</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'laboratorio_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
						<li class=""><a href="<?php echo 'laboratorio_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Observaciones</a></li>
					</ul>
                </li>           
			</ul>	
		</header>
        <div class="table-responsive"> 
			<div class="col-sm-8 fcenter" style="padding-top:40px;min-height:500px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>		
			
					<?php 
					//Se verifican si existen los datos
					if(isset($idTipo)) {           $x1  = $idTipo;            }else{$x1  = $rowdata['idTipo'];}
					if(isset($Nombre)) {           $x2  = $Nombre;            }else{$x2  = $rowdata['Nombre'];}
					if(isset($Rut)) {              $x3  = $Rut;               }else{$x3  = $rowdata['Rut'];}
					if(isset($fNacimiento)) {      $x4  = $fNacimiento;       }else{$x4  = $rowdata['fNacimiento'];}
					if(isset($idPais)) {           $x5  = $idPais;            }else{$x5  = $rowdata['idPais'];}
					if(isset($idCiudad)) {         $x6  = $idCiudad;          }else{$x6  = $rowdata['idCiudad'];}
					if(isset($idComuna)) {         $x7  = $idComuna;          }else{$x7  = $rowdata['idComuna'];}
					if(isset($Direccion)) {        $x8  = $Direccion;         }else{$x8  = $rowdata['Direccion'];}
					if(isset($Giro)) {             $x9  = $Giro;              }else{$x9  = $rowdata['Giro'];}
					

					//se dibujan los inputs
					$Form_Imputs = new Form_Inputs();
					$Form_Imputs->form_select('Tipo de Laboratorio','idTipo', $x1, 2, 'idTipo', 'Nombre', 'laboratorio_tipos', 0, '', $dbConn);
					$Form_Imputs->form_input_text( 'Nombres', 'Nombre', $x2, 2);
					$Form_Imputs->form_input_rut('Rut', 'Rut', $x3, 1);
					$Form_Imputs->form_date('F Ingreso','fNacimiento', $x4, 1);
					$Form_Imputs->form_select_country('Pais','idPais', $x5, 1, $dbConn);
					$Form_Imputs->form_select_depend1('Ciudad','idCiudad', $x6, 1, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
											'Comuna','idComuna', $x7, 1, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0, 
											 $dbConn, 'form1');
					$Form_Imputs->form_input_icon( 'Direccion', 'Direccion', $x8, 1,'fa fa-map'); 
					$Form_Imputs->form_input_icon( 'Giro de la empresa', 'Giro', $x9, 1,'fa fa-industry');
					
					$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
					$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
					$Form_Imputs->form_input_hidden('idLaboratorio', $_GET['id'], 2);
					?>
					
					<script>
						
						var idPais;
						var idPais_sel;
						
						$(document).ready(function(){ //se ejecuta al cargar la página (OBLIGATORIO)
									
							idSubconfiguracion= $("#idSubconfiguracion").val();
							idPais= $("#idPais").val();
							
							//Si el pais es distinto de chile
							if(idPais!=1){
								document.getElementById("idCiudad").disabled = true;
								document.getElementById("idComuna").disabled = true;
								document.getElementById('idCiudad').selectedIndex = 0;
								document.getElementById('idComuna').selectedIndex = 0;
							}else{
								document.getElementById("idCiudad").disabled = false;
								document.getElementById("idComuna").disabled = false;
							}		
						}); 
						
						$("#idPais").on("change", function(){
							
							idPais_sel= $("#idPais").val();
							
							//Si el pais es distinto de chile
							if(idPais_sel!=1){
								document.getElementById("idCiudad").disabled = true;
								document.getElementById("idComuna").disabled = true;
								document.getElementById('idCiudad').selectedIndex = 0;
								document.getElementById('idComuna').selectedIndex = 0;
							}else{
								document.getElementById("idCiudad").disabled = false;
								document.getElementById("idComuna").disabled = false;
							}
						});
						
					</script>
				  
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
