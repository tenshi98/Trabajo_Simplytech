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
$original = "cross_predios_listado.php";
$location = $original;
$new_location = "cross_predios_listado_datos.php";
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
	require_once 'A1XRXS_sys/xrxs_form/cross_predios_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Ruta creada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Ruta editada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Ruta borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// consulto los datos
$query = "SELECT Nombre, idSistema, idPais, idCiudad, idComuna, Direccion
FROM `cross_predios_listado`
WHERE idPredio = ".$_GET['id'];
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
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Predio', $rowdata['Nombre'], 'Editar Datos Basicos');?>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'cross_predios_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class="active"><a href="<?php echo 'cross_predios_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'cross_predios_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
				<li class=""><a href="<?php echo 'cross_predios_listado_configuracion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-wrench" aria-hidden="true"></i> Editar Cuarteles</a></li>
			</ul>	
		</header>
        <div class="table-responsive" >
			<div class="col-sm-8 fcenter" style="padding-top:40px;min-height:500px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>		
			
					<?php  
					//Se verifican si existen los datos
					if(isset($Nombre)) {       $x1  = $Nombre;        }else{$x1  = $rowdata['Nombre'];}
					if(isset($idPais)) {       $x2  = $idPais;        }else{$x2  = $rowdata['idPais'];}
					if(isset($idCiudad)) {     $x3  = $idCiudad;      }else{$x3  = $rowdata['idCiudad'];}
					if(isset($idComuna)) {     $x4  = $idComuna;      }else{$x4  = $rowdata['idComuna'];}
					if(isset($Direccion)) {    $x5  = $Direccion;     }else{$x5  = $rowdata['Direccion'];}
					
					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_input_text('Nombre del Predio', 'Nombre', $x1, 2);
					$Form_Inputs->form_select_country('Pais','idPais', $x2, 1, $dbConn);
					$Form_Inputs->form_select_depend1('Ciudad','idCiudad', $x3, 1, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
											'Comuna','idComuna', $x4, 1, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0, 
											 $dbConn, 'form1');
					$Form_Inputs->form_input_icon('Direccion', 'Direccion', $x5, 1,'fa fa-map'); 
					
					
					$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
					$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
					$Form_Inputs->form_input_hidden('idPredio', $_GET['id'], 2);
					?>
					
					<script>
						
						$(document).ready(function(){ //se ejecuta al cargar la página (OBLIGATORIO)
									
							let idPais  = $("#idPais").val();
							
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
							
							let idPais_sel = $("#idPais").val();
							
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
