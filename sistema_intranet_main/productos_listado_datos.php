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
$original = "productos_listado.php";
$location = $original;
$new_location = "productos_listado_datos.php";
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
	require_once 'A1XRXS_sys/xrxs_form/productos_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// Se traen todos los datos del producto
$query = "SELECT Nombre,idTipo,idCategoria,Marca,idUml,idTipoProducto, Codigo,idTipoReceta,idOpciones_1
idOpciones_2,IngredienteActivo, Carencia, DosisRecomendada, EfectoResidual, EfectoRetroactivo,
CarenciaExportador 
FROM `productos_listado`
WHERE idProducto = ".$_GET['id'];
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
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Productos', $rowdata['Nombre'], 'Editar Datos Basicos');?>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'productos_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class="active"><a href="<?php echo 'productos_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'productos_listado_datos_descripcion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-tasks" aria-hidden="true"></i> Descripcion</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'productos_listado_datos_opciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-wrench" aria-hidden="true"></i> Opciones</a></li>
						<li class=""><a href="<?php echo 'productos_listado_datos_comerciales.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-usd" aria-hidden="true"></i> Datos Comerciales</a></li>
						<?php if(isset($rowdata['idTipoProducto'])&&$rowdata['idTipoProducto']==2&&$rowdata['idTipoReceta']==1){ ?>
							<li class=""><a href="<?php echo 'productos_listado_datos_receta_01.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-align-left" aria-hidden="true"></i> Receta</a></li>
						<?php }elseif(isset($rowdata['idTipoProducto'])&&$rowdata['idTipoProducto']==2&&$rowdata['idTipoReceta']==2){ ?>
							<li class=""><a href="<?php echo 'productos_listado_datos_receta_02.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-align-left" aria-hidden="true"></i> Receta</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'productos_listado_datos_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						<li class=""><a href="<?php echo 'productos_listado_datos_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-file-image-o" aria-hidden="true"></i> Imagen</a></li>
						<li class=""><a href="<?php echo 'productos_listado_datos_ficha.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Ficha</a></li>
						<li class=""><a href="<?php echo 'productos_listado_datos_hds.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-calendar-check-o" aria-hidden="true"></i> HDS</a></li>
						<?php if(isset($rowdata['idOpciones_1'])&&$rowdata['idOpciones_1']==1){ ?>
							<li class=""><a href="<?php echo 'productos_listado_datos_ot.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-wrench" aria-hidden="true"></i> Sistema Mantenlubric</a></li>
						<?php } ?>
						<?php if(isset($rowdata['idOpciones_2'])&&$rowdata['idOpciones_2']==1){ ?>
							<li class=""><a href="<?php echo 'productos_listado_datos_cross.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-wrench" aria-hidden="true"></i> Sistema CROSS</a></li>
						<?php } ?>
						
					</ul>
                </li>           
			</ul>	
		</header>
        <div class="table-responsive">
			<div class="col-sm-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post"  id="form1" name="form1" novalidate>		
					
					<?php 
					//Se verifican si existen los datos
					if(isset($Nombre)) {              $x1  = $Nombre;                }else{$x1  = $rowdata['Nombre'];}
					if(isset($idTipo)) {              $x2  = $idTipo;                }else{$x2  = $rowdata['idTipo'];}
					if(isset($idCategoria)) {         $x3  = $idCategoria;           }else{$x3  = $rowdata['idCategoria'];}
					if(isset($Marca)) {               $x4  = $Marca;                 }else{$x4  = $rowdata['Marca'];}
					if(isset($idUml)) {               $x5  = $idUml;                 }else{$x5  = $rowdata['idUml'];}
					if(isset($idTipoProducto)) {      $x6  = $idTipoProducto;        }else{$x6  = $rowdata['idTipoProducto'];}
					if(isset($idTipoReceta)) {        $x7  = $idTipoReceta;          }else{$x7  = $rowdata['idTipoReceta'];}
					if(isset($Codigo)) {              $x8  = $Codigo;                }else{$x8  = $rowdata['Codigo'];}
					if(isset($IngredienteActivo)) {   $x9  = $IngredienteActivo;     }else{$x9  = $rowdata['IngredienteActivo'];}
					if(isset($Carencia)) {            $x10 = $Carencia;              }else{$x10 = $rowdata['Carencia'];}
					if(isset($DosisRecomendada)) {    $x11 = $DosisRecomendada;      }else{$x11 = Cantidades_decimales_justos($rowdata['DosisRecomendada']);}
					if(isset($EfectoResidual)) {      $x12 = $EfectoResidual;        }else{$x12 = Cantidades_decimales_justos($rowdata['EfectoResidual']);}
					if(isset($EfectoRetroactivo)) {   $x13 = $EfectoRetroactivo;     }else{$x13 = Cantidades_decimales_justos($rowdata['EfectoRetroactivo']);}
					if(isset($CarenciaExportador)) {  $x14 = $CarenciaExportador;    }else{$x14 = Cantidades_decimales_justos($rowdata['CarenciaExportador']);}
					
					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 2);
					$Form_Inputs->form_select_filter('Tipo de Producto','idTipo', $x2, 2, 'idTipo', 'Nombre', 'sistema_productos_tipo', 0, '', $dbConn);
					$Form_Inputs->form_select_filter('Categoria','idCategoria', $x3, 2, 'idCategoria', 'Nombre', 'sistema_productos_categorias', 0, '', $dbConn);
					$Form_Inputs->form_input_text('Marca', 'Marca', $x4, 1);
					$Form_Inputs->form_select_filter('Unidad de Medida','idUml', $x5, 2, 'idUml', 'Nombre', 'sistema_productos_uml', 0, '', $dbConn);
					$Form_Inputs->form_select('Tipo Producto','idTipoProducto', $x6, 2, 'idTipoProducto', 'Nombre', 'core_tipo_producto', 0, '', $dbConn);
					$Form_Inputs->form_select('Tipo de Receta','idTipoReceta', $x7, 1, 'idTipoReceta', 'Nombre', 'core_tipo_receta', 0, '', $dbConn);
					$Form_Inputs->form_input_text('Codigo', 'Codigo', $x8, 1);
					$Form_Inputs->form_textarea('Ingredientes Activos','IngredienteActivo', $x9, 1);
					//$Form_Inputs->form_ckeditor('Ingredientes Activos','IngredienteActivo', $x9, 1, 2);
					$Form_Inputs->form_input_number_spinner('Dosis Recomendada','DosisRecomendada', $x11, 0, 99999, '0.01', 2, 1);
					$Form_Inputs->form_input_number_spinner('Carencia Etiqueta','CarenciaExportador', $x14, 0, 500, 1, 0, 1);
					$Form_Inputs->form_input_text('Carencia ASOEX', 'Carencia', $x10, 1);
					$Form_Inputs->form_input_number_spinner('Carencia TESCO','EfectoResidual', $x12, 0, 500, 1, 0, 1);
					$Form_Inputs->form_input_number_spinner('Tiempo Re-Ingreso','EfectoRetroactivo', $x13, 0, 500, 1, 0, 1);
					
					
					$Form_Inputs->form_input_hidden('idProducto', $_GET['id'], 2);
					?>
					
					<script>
						document.getElementById('div_idTipoReceta').style.display = 'none';
						
						$(document).ready(function(){ //se ejecuta al cargar la página (OBLIGATORIO)
							
							let tipo_val= $("#idTipoProducto").val();
						
							//Seleccion Unica
							if(tipo_val == 1){ 
								document.getElementById('div_idTipoReceta').style.display = 'none';
							
							//Seleccion Multiple		
							} else if(tipo_val == 2){ 
								document.getElementById('div_idTipoReceta').style.display = '';
	
							} else { 
								document.getElementById('div_idTipoReceta').style.display = 'none';
									
							}
						
						
							$("#idTipoProducto").on("change", function(){ //se ejecuta al cambiar valor del select
								let modelSelected= $("#idTipoProducto").val();//Asignamos el valor seleccionado
								
								
								//Materia prima
								if(modelSelected == 1){ 
									document.getElementById('div_idTipoReceta').style.display = 'none';
									
									//lo vacio
									document.getElementById('idTipoReceta').length = 1
									document.getElementById('idTipoReceta').options[0].value = "0"
									document.getElementById('idTipoReceta').options[0].text = "Seleccione una Opcion"
								
								//Producto Terminado	
								} else if(modelSelected == 2){ 
									document.getElementById('div_idTipoReceta').style.display = '';
									
									//lo vacio
									document.getElementById('idTipoReceta').length = 3
									document.getElementById('idTipoReceta').options[0].value = "0"
									document.getElementById('idTipoReceta').options[0].text = "Seleccione una Opcion"
									document.getElementById('idTipoReceta').options[1].value = "1"
									document.getElementById('idTipoReceta').options[1].text = "Por Porcentaje total"
									document.getElementById('idTipoReceta').options[2].value = "2"
									document.getElementById('idTipoReceta').options[2].text = "Libre"
									
								} else { 
									document.getElementById('div_idTipoReceta').style.display = 'none';
									
								}
							
							}); 
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
