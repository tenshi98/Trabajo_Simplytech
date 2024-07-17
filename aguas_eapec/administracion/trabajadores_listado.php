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
$original = "trabajadores_listado.php";
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
	$form_obligatorios = 'Nombre,ApellidoPat,idTipo,idSistema';
	$form_trabajo= 'insert';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/trabajadores_listado.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idTrabajador,Nombre,ApellidoPat,idTipo,idSistema';
	$form_trabajo= 'update';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/trabajadores_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/trabajadores_listado.php';	
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Trabajador Creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Trabajador Modificado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Trabajador borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
// Se traen todos los datos del trabajador
$query = "SELECT Nombre,ApellidoPat,ApellidoMat,idSistema,idTipo, Cargo, Fono, Rut, idCiudad, idComuna, Direccion, Observaciones
FROM `trabajadores_listado`
WHERE idTrabajador = {$_GET['id']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);	?>
<div class="col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificacion del Trabajador</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post"  name="form1">
			
			<?php 
			//Se verifican si existen los datos
			if(isset($Nombre)) {           $x1  = $Nombre;          }else{$x1  = $rowdata['Nombre'];}
			if(isset($ApellidoPat)) {      $x2  = $ApellidoPat;     }else{$x2  = $rowdata['ApellidoPat'];}
			if(isset($ApellidoMat)) {      $x3  = $ApellidoMat;     }else{$x3  = $rowdata['ApellidoMat'];}
			if(isset($idTipo)) {           $x4  = $idTipo;          }else{$x4  = $rowdata['idTipo'];}
			if(isset($idSistema)) {        $x5  = $idSistema;       }else{$x5  = $rowdata['idSistema'];}
			if(isset($Cargo)) {            $x6  = $Cargo;           }else{$x6  = $rowdata['Cargo'];}
			if(isset($Fono)) {             $x7  = $Fono;            }else{$x7  = $rowdata['Fono'];}
			if(isset($Rut)) {              $x8  = $Rut;             }else{$x8  = $rowdata['Rut'];}
			if(isset($idCiudad)) {         $x9  = $idCiudad;        }else{$x9  = $rowdata['idCiudad'];}
			if(isset($idComuna)) {         $x10 = $idComuna;        }else{$x10 = $rowdata['idComuna'];}
			if(isset($Direccion)) {        $x11 = $Direccion;       }else{$x11 = $rowdata['Direccion'];}
			if(isset($Observaciones)) {    $x12 = $Observaciones;   }else{$x12 = $rowdata['Observaciones'];}

			//se dibujan los inputs
			echo form_input('text', 'Nombre', 'Nombre', $x1, 2);
			echo form_input('text', 'Apellido Paterno', 'ApellidoPat', $x2, 2);
			echo form_input('text', 'Apellido Materno', 'ApellidoMat', $x3, 2);
			echo form_select('Tipo Trabajador','idTipo', $x4, 2, 'idTipo', 'Nombre', 'trabajadores_listado_tipos', 0, $dbConn);
			if($arrUsuario['tipo']=='SuperAdmin'){
			echo form_select('Sistema','idSistema', $x5, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
			}else{
			echo '<input type="hidden" name="idSistema"   value="'.$arrUsuario['idSistema'].'">';
			}
			echo form_input('text', 'Cargo', 'Cargo', $x6, 1);
			echo form_input_phone('Fono', 'Fono', $x7, 1);
			echo form_input_icon('text', 'Rut', 'Rut', $x8, 1,'fa fa-exclamation-triangle');
			echo form_select_depend1('Ciudad','idCiudad', $x9, 1, 'idCiudad', 'Nombre', 'mnt_ubicacion_ciudad', 0,
									'Comuna','idComuna', $x10, 1, 'idComuna', 'idCiudad', 'Nombre', 'mnt_ubicacion_comunas', 0, 
									 $dbConn, 'form1');
			echo form_input_icon('text', 'Direccion', 'Direccion', $x11, 1,'fa fa-map');
			echo form_ckeditor('Observaciones','Observaciones', $x12, 1, 1);	 
			?>

			<div class="form-group">
            	<input type="hidden" name="idTrabajador" value="<?php echo $_GET['id']; ?>" >
				<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_edit"> 
				<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { ?>
 <div class="col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Nuevo Trabajador</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post"  name="form1">
        	
			<?php 
			//Se verifican si existen los datos
			if(isset($Nombre)) {           $x1  = $Nombre;          }else{$x1  = '';}
			if(isset($ApellidoPat)) {      $x2  = $ApellidoPat;     }else{$x2  = '';}
			if(isset($ApellidoMat)) {      $x3  = $ApellidoMat;     }else{$x3  = '';}
			if(isset($idTipo)) {           $x4  = $idTipo;          }else{$x4  = '';}
			if(isset($idSistema)) {        $x5  = $idSistema;       }else{$x5  = '';}
			if(isset($Cargo)) {            $x6  = $Cargo;           }else{$x6  = '';}
			if(isset($Fono)) {             $x7  = $Fono;            }else{$x7  = '';}
			if(isset($Rut)) {              $x8  = $Rut;             }else{$x8  = '';}
			if(isset($idCiudad)) {         $x9  = $idCiudad;        }else{$x9  = '';}
			if(isset($idComuna)) {         $x10 = $RuidComunat;     }else{$x10 = '';}
			if(isset($Direccion)) {        $x11 = $Direccion;       }else{$x11 = '';}
			if(isset($Observaciones)) {    $x12 = $Observaciones;   }else{$x12 = '';}

			//se dibujan los inputs
			echo form_input('text', 'Nombre', 'Nombre', $x1, 2);
			echo form_input('text', 'Apellido Paterno', 'ApellidoPat', $x2, 2);
			echo form_input('text', 'Apellido Materno', 'ApellidoMat', $x3, 2);
			echo form_select('Tipo Trabajador','idTipo', $x4, 2, 'idTipo', 'Nombre', 'trabajadores_listado_tipos', 0, $dbConn);
			if($arrUsuario['tipo']=='SuperAdmin'){
			echo form_select('Sistema','idSistema', $x5, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
			}else{
			echo '<input type="hidden" name="idSistema"   value="'.$arrUsuario['idSistema'].'">';
			}
			echo form_input('text', 'Cargo', 'Cargo', $x6, 1);
			echo form_input_phone('Fono', 'Fono', $x7, 1);
			echo form_input_icon('text', 'Rut', 'Rut', $x8, 1,'fa fa-exclamation-triangle');
			echo form_select_depend1('Ciudad','idCiudad', $x9, 1, 'idCiudad', 'Nombre', 'mnt_ubicacion_ciudad', 0,
									'Comuna','idComuna', $x10, 1, 'idComuna', 'idCiudad', 'Nombre', 'mnt_ubicacion_comunas', 0, 
									 $dbConn, 'form1');
			echo form_input_icon('text', 'Direccion', 'Direccion', $x11, 1,'fa fa-map');
			echo form_ckeditor('Observaciones','Observaciones', $x12, 1, 1);			 
			?>
			
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
$z="WHERE trabajadores_listado.idTrabajador!=0";
//Verifico si la variable de busqueda existe
if (isset($_GET['search'])){
	$z.=" AND trabajadores_listado.Nombre LIKE '%{$_GET['search']}%'";	
}
//Verifico el tipo de usuario que esta ingresando
if($arrUsuario['tipo']=='SuperAdmin'){
	$z.=" AND trabajadores_listado.idSistema>=0";	
}else{
	$z.=" AND trabajadores_listado.idSistema={$arrUsuario['idSistema']}";	
}

//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idTrabajador FROM `trabajadores_listado` ".$z."";
$registros = mysqli_query ($dbConn, $query);
$cuenta_registros = mysqli_num_rows($registros);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrTrabajador = array();
$query = "SELECT 
trabajadores_listado.idTrabajador,
trabajadores_listado.Nombre, 
trabajadores_listado.ApellidoPat, 
trabajadores_listado.ApellidoMat,
trabajadores_listado_tipos.Nombre AS Tipo,
core_sistemas.Nombre AS RazonSocial
FROM `trabajadores_listado`
LEFT JOIN `trabajadores_listado_tipos`    ON trabajadores_listado_tipos.idTipo   = trabajadores_listado.idTipo
LEFT JOIN `core_sistemas`    ON core_sistemas.idSistema   = trabajadores_listado.idSistema
".$z."
ORDER BY Nombre ASC
LIMIT $comienzo, $cant_reg ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrTrabajador,$row );
}?>

<div class="form-group">
<form class="form-horizontal" action="<?php echo $location ?>"  name="form1">
<label class="control-label col-lg-4">Buscar Trabajador</label>
    <div class="col-lg-5">
		<div class="input-group bootstrap-timepicker fmrnew">
        	<input type="hidden" name="pagina" value="<?php echo $_GET['pagina']; ?>" >
			<input class="form-control timepicker-default" type="text" name="search" value="<?php if (isset($_GET['search'])) { echo $_GET['search'];}?>" placeholder="Nombre">
            <button type="submit" class="t_search_button"><i class="fa fa-search"></i></button>
            <button class="t_search_button2" onClick="document.form1.search.value = '';"><i class="fa fa-trash-o"></i></button>
		</div>
    </div>
</form>
<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" >Crear Nuevo Trabajador</a><?php } ?>
</div>
<div class="clearfix"></div>                       
                                 
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Trabajadores</h5>
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
						<th>Nombre</th>
						<th>Tipo</th>
						<th>Sistema</th>
						<th width="120">Acciones</th>
					</tr>
				</thead>			  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrTrabajador as $trab) { ?>
					<tr class="odd">
						<td><?php echo $trab['Nombre'].' '.$trab['ApellidoPat'].' '.$trab['ApellidoMat']; ?></td>
						<td><?php echo $trab['Tipo']; ?></td>
						<td><?php echo $trab['RazonSocial']; ?></td>
						<td>
							<div class="btn-group widthtd120" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_trabajador.php?view='.$trab['idTrabajador']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$trab['idTrabajador']; ?>" data-placement="bottom" title="Editar Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$trab['idTrabajador'];
									$dialogo   = '¿Realmente deseas eliminar el trabajador '.$trab['Nombre'].' '.$trab['ApellidoPat'].' '.$trab['ApellidoMat'].'?';?>
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
