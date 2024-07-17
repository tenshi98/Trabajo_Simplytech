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
$original = "admin_proveedor.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
if(isset($_GET['search']) && $_GET['search'] != ''){                       $location .= "&search=".$_GET['search'] ; 	}
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){                       $location .= "&Nombre=".$_GET['Nombre'] ; }
if(isset($_GET['idEstado']) && $_GET['idEstado'] != ''){                   $location .= "&idEstado=".$_GET['idEstado'] ; }
if(isset($_GET['idCiudad']) && $_GET['idCiudad'] != ''){                   $location .= "&idCiudad=".$_GET['idCiudad'] ; }
if(isset($_GET['idComuna']) && $_GET['idComuna'] != ''){                   $location .= "&idComuna=".$_GET['idComuna'] ; }
if(isset($_GET['rango_a']) && $_GET['rango_a'] != ''&&isset($_GET['rango_b']) && $_GET['rango_b'] != ''){ 
	$location .= "&rango_a={$_GET['rango_a']}&rango_b={$_GET['rango_b']}" ; 
}
//Verifico los permisos del usuario sobre la transaccion
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/permisos.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idTipo,Nombre,Rut,Direccion,idSistema,email';
	$form_trabajo= 'insert';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/proveedor_listado.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idProveedor,idTipo,Nombre,Rut,Direccion,idSistema,email';
	$form_trabajo= 'update';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/proveedor_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/proveedor_listado.php';	
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Proveedor creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Proveedor editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Proveedor borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT idTipo, Nombre , Rut, fNacimiento, idPais, idCiudad, idComuna, Direccion, idSistema, PersonaContacto, Fono1,
Fono2, Fax, email, Web, Giro
FROM `proveedor_listado`
WHERE idProveedor = {$_GET['id']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);	?>
 
<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificacion datos del Proveedor</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" name="form1">
        	
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
			if(isset($idSistema)) {        $x9  = $idSistema;         }else{$x9  = $rowdata['idSistema'];}
			if(isset($Giro)) {             $x10 = $Giro;              }else{$x10 = $rowdata['Giro'];}
			if(isset($PersonaContacto)) {  $x11 = $PersonaContacto;   }else{$x11 = $rowdata['PersonaContacto'];}
			if(isset($Fono1)) {            $x12 = $Fono1;             }else{$x12 = $rowdata['Fono1'];}
			if(isset($Fono2)) {            $x13 = $Fono2;             }else{$x13 = $rowdata['Fono2'];}
			if(isset($Fax)) {              $x14 = $Fax;               }else{$x14 = $rowdata['Fax'];}
			if(isset($email)) {            $x15 = $email;             }else{$x15 = $rowdata['email'];}
			if(isset($Web)) {              $x16 = $Web;               }else{$x16 = $rowdata['Web'];}
			

			//se dibujan los inputs
			echo '<h3>Datos Basicos</h3>';
			echo form_select('Tipo de Proveedor','idTipo', $x1, 2, 'idTipo', 'Nombre', 'proveedor_tipos', 0, $dbConn);
			echo form_input('text', 'Nombres', 'Nombre', $x2, 2);
			echo form_input_icon('text', 'Rut', 'Rut', $x3, 2,'fa fa-exclamation-triangle');
			echo form_date('F Ingreso','fNacimiento', $x4, 1);
			echo form_select('Pais','idPais', $x5, 2, 'idPais', 'Nombre', 'proveedor_paises', 0, $dbConn);
			echo form_select_depend1('Ciudad','idCiudad', $x6, 1, 'idCiudad', 'Nombre', 'mnt_ubicacion_ciudad', 0,
									'Comuna','idComuna', $x7, 1, 'idComuna', 'idCiudad', 'Nombre', 'mnt_ubicacion_comunas', 0, 
									 $dbConn, 'form1');
			echo form_input_icon('text', 'Direccion', 'Direccion', $x8, 2,'fa fa-map'); 
			if($arrUsuario['tipo']=='SuperAdmin'){
			echo form_select('Sistema','idSistema', $x9, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
			}else{
			echo '<input type="hidden" name="idSistema"   value="'.$arrUsuario['idSistema'].'">';
			}
			echo form_input('text', 'Giro de la empresa', 'Giro', $x10, 1);
			
			echo '<h3>Datos de contacto</h3>';
			echo form_input_icon('text', 'Persona de Contacto', 'PersonaContacto', $x11, 1,'fa fa-user-secret');
			echo form_input_phone('Telefono Fijo', 'Fono1', $x12, 1);
			echo form_input_phone('Telefono Movil', 'Fono2', $x13, 1);
			echo form_input_fax('Fax', 'Fax', $x14, 1);
			echo form_input_icon('text', 'Email', 'email', $x15, 2,'fa fa-envelope-o');
			echo form_input_icon('text', 'Web', 'Web', $x16, 1,'fa fa-internet-explorer');
			
			?>
			
			<script>
				$('#idPais').change(function() {
					if($(this).val()!=1){
						document.getElementById("idCiudad").disabled = true;
						document.getElementById("idComuna").disabled = true;
						document.getElementById('idCiudad').value = "";
						document.getElementById('idComuna').value = "";
					}else{
						document.getElementById("idCiudad").disabled = false;
						document.getElementById("idComuna").disabled = false;
					}
				});
			</script>
          
			<div class="form-group">
            	<input type="hidden" name="idProveedor" value="<?php echo $_GET['id']; ?>" >
				<input type="submit" class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_edit"> 
				<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { ?>
<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Nuevo Proveedor</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" name="form1">
			
			<?php 
			//Se verifican si existen los datos
			if(isset($idTipo)) {           $x1  = $idTipo;            }else{$x1  = '';}
			if(isset($Nombre)) {           $x2  = $Nombre;            }else{$x2  = '';}
			if(isset($Rut)) {              $x3  = $Rut;               }else{$x3  = '';}
            if(isset($fNacimiento)) {      $x4  = $fNacimiento;       }else{$x4  = '';}
			if(isset($idPais)) {           $x5  = $idPais;            }else{$x5  = '';}
			if(isset($idCiudad)) {         $x6  = $idCiudad;          }else{$x6  = '';}
			if(isset($idComuna)) {         $x7  = $idComuna;          }else{$x7  = '';}
			if(isset($Direccion)) {        $x8  = $Direccion;         }else{$x8  = '';}
			if(isset($idSistema)) {        $x9  = $idSistema;         }else{$x9  = '';}
			if(isset($Giro)) {             $x10 = $Giro;              }else{$x10 = '';}
			if(isset($PersonaContacto)) {  $x11 = $PersonaContacto;   }else{$x11 = '';}
			if(isset($Fono1)) {            $x12 = $Fono1;             }else{$x12 = '';}
			if(isset($Fono2)) {            $x13 = $Fono2;             }else{$x13 = '';}
			if(isset($Fax)) {              $x14 = $Fax;               }else{$x14 = '';}
			if(isset($email)) {            $x15 = $email;             }else{$x15 = '';}
			if(isset($Web)) {              $x16 = $Web;               }else{$x16 = '';}
			

			//se dibujan los inputs
			echo '<h3>Datos Basicos</h3>';
			echo form_select('Tipo de Proveedor','idTipo', $x1, 2, 'idTipo', 'Nombre', 'proveedor_tipos', 0, $dbConn);
			echo form_input('text', 'Nombres', 'Nombre', $x2, 2);
			echo form_input_icon('text', 'Rut', 'Rut', $x3, 2,'fa fa-exclamation-triangle');
			echo form_date('F Ingreso','fNacimiento', $x4, 1);
			echo form_select('Pais','idPais', $x5, 2, 'idPais', 'Nombre', 'proveedor_paises', 0, $dbConn);
			echo form_select_depend1('Ciudad','idCiudad', $x6, 1, 'idCiudad', 'Nombre', 'mnt_ubicacion_ciudad', 0,
									'Comuna','idComuna', $x7, 1, 'idComuna', 'idCiudad', 'Nombre', 'mnt_ubicacion_comunas', 0, 
									 $dbConn, 'form1');
			echo form_input_icon('text', 'Direccion', 'Direccion', $x8, 2,'fa fa-map'); 
			if($arrUsuario['tipo']=='SuperAdmin'){
			echo form_select('Sistema','idSistema', $x9, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
			}else{
			echo '<input type="hidden" name="idSistema"   value="'.$arrUsuario['idSistema'].'">';
			}
			echo form_input('text', 'Giro de la empresa', 'Giro', $x10, 1);
			
			echo '<h3>Datos de contacto</h3>';
			echo form_input_icon('text', 'Persona de Contacto', 'PersonaContacto', $x11, 1,'fa fa-user-secret');
			echo form_input_phone('Telefono Fijo', 'Fono1', $x12, 1);
			echo form_input_phone('Telefono Movil', 'Fono2', $x13, 1);
			echo form_input_fax('Fax', 'Fax', $x14, 1);
			echo form_input_icon('text', 'Email', 'email', $x15, 2,'fa fa-envelope-o');
			echo form_input_icon('text', 'Web', 'Web', $x16, 1,'fa fa-internet-explorer');
			

			echo '<input type="hidden" name="idEstado"   value="1" >';	 
			?>   
			
			<script>
				$('#idPais').change(function() {
					if($(this).val()!=1){
						document.getElementById("idCiudad").disabled = true;
						document.getElementById("idComuna").disabled = true;
						document.getElementById('idCiudad').value = "";
						document.getElementById('idComuna').value = "";
					}else{
						document.getElementById("idCiudad").disabled = false;
						document.getElementById("idComuna").disabled = false;
					}
				});
			</script>     
   
			<div class="form-group">
				<input type="submit" class="btn btn-primary fright margin_width" value="Guardar" name="submit"> 
				<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
		</div>
	</div>
</div>   

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['fullsearch']) ) { ?>
<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Filtro para Busqueda Avanzada</h5>
		</header>
		<div id="div-1" class="body">
		<form name="form1" class="form-horizontal" action="<?php echo $location; ?>" >
			
            <?php 
			//Se verifican si existen los datos
			if(isset($Nombre)) {                 $x1  = $Nombre;                 }else{$x1  = '';}
			if(isset($rango_a)) {                $x2  = $rango_a;                }else{$x2  = '';}
            if(isset($rango_b)) {                $x3  = $rango_b;                }else{$x3  = '';}
			if(isset($idEstado)) {               $x5  = $idEstado;               }else{$x5  = '';}
			if(isset($idCiudad)) {               $x6  = $idCiudad;               }else{$x6  = '';}
			if(isset($idComuna)) {               $x7  = $idComuna;               }else{$x7  = '';}
			
			//se dibujan los inputs
			echo form_input('text', 'Nombres', 'Nombre', $x1, 1);
			echo form_date('F Ingreso inicio','rango_a', $x2, 1);
			echo form_date('F Ingreso termino','rango_b', $x3, 1);
			echo form_select('Estado Proveedor','idEstado', $x5, 1, 'idEstado', 'Nombre', 'proveedor_estado', 0, $dbConn);
			echo form_select_depend1('Ciudad','idCiudad', $x6, 1, 'idCiudad', 'Nombre', 'mnt_ubicacion_ciudad', 0,
									'Comuna','idComuna', $x7, 1, 'idComuna', 'idCiudad', 'Nombre', 'mnt_ubicacion_comunas', 0, 
									 $dbConn, 'form1');
			?>        
   
			<div class="form-group">
            	<input type="hidden" name="pagina" value="1" >
				<input type="submit" class="btn btn-primary fright margin_width" value="Buscar" >
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
if(isset($_GET["pagina"])){$num_pag = $_GET["pagina"];	
} else {$num_pag = 1;	
}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){
	$comienzo = 0 ;$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
//verifico que sea un administrador
if($arrUsuario['tipo']=='SuperAdmin'){
	$z="WHERE proveedor_listado.idSistema>=0";	
}else{
	$z="WHERE proveedor_listado.idSistema={$arrUsuario['idSistema']}";	
}
//Verifico si la variable de busqueda existe
if(isset($_GET['search']) && $_GET['search'] != ''){                         $z .= " AND proveedor_listado.Rut LIKE '%{$_GET['search']}%'";}
if(isset($_GET['Nombre']) && $_GET['Nombre'] != '')  {                       $z .= " AND proveedor_listado.Nombre LIKE '%{$_GET['Nombre']}%' " ;}
if(isset($_GET['idEstado']) && $_GET['idEstado'] != '')  {                   $z .= " AND proveedor_listado.idEstado = '".$_GET['idEstado']."'" ;}
if(isset($_GET['idCiudad']) && $_GET['idCiudad'] != '')  {                   $z .= " AND proveedor_listado.idCiudad = '".$_GET['idCiudad']."'" ;}
if(isset($_GET['idComuna']) && $_GET['idComuna'] != '')  {                   $z .= " AND proveedor_listado.idComuna = '".$_GET['idComuna']."'" ;}
if(isset($_GET['rango_a']) && $_GET['rango_a'] != ''&&isset($_GET['rango_b']) && $_GET['rango_b'] != ''){ 
	$z .= " AND proveedor_listado.fNacimiento BETWEEN '{$_GET['rango_a']}' AND '{$_GET['rango_b']}'" ;
}

//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT proveedor_listado.idProveedor FROM `proveedor_listado` ".$z."";
$registros = mysqli_query ($dbConn, $query);
$cuenta_registros = mysqli_num_rows($registros);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrUsers = array();
$query = "SELECT 
proveedor_listado.idProveedor,
proveedor_listado.Rut,
proveedor_listado.Nombre,
proveedor_estado.Nombre AS estado,
core_sistemas.Nombre AS sistema
FROM `proveedor_listado`
LEFT JOIN `proveedor_estado`  ON proveedor_estado.idEstado      = proveedor_listado.idEstado
LEFT JOIN `core_sistemas`     ON core_sistemas.idSistema        = proveedor_listado.idSistema
".$z."
ORDER BY proveedor_listado.Nombre ASC
LIMIT $comienzo, $cant_reg ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrUsers,$row );
}

?>
<div class="form-group">
<form class="form-horizontal" action="<?php echo $location ?>"  name="form1">
<label class="control-label col-lg-4">Buscar Proveedor</label>
    <div class="col-lg-5">	
		<div class="input-group bootstrap-timepicker fmrnew">
        	<input type="hidden" name="pagina" value="<?php echo $_GET['pagina']; ?>" >		
			<input class="form-control timepicker-default" type="text" name="search" value="<?php if (isset($_GET['search'])) { echo $_GET['search'];}?>" placeholder="Rut">
            <button type="submit" class="t_search_button"><i class="fa fa-search"></i></button>
            <a href="<?php echo $location; ?>&fullsearch=true" class="t_search_button_full" ><i class="fa fa-search-plus"></i></a>
            <button class="t_search_button2" onclick="document.form1.search.value = '';"><i class="fa fa-trash-o"></i></button>
           </div>
    </div>
</form>
<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" >Crear Nuevo Proveedor</a><?php }?>
</div>
<div class="clearfix"></div>                     
                                 
<div class="col-lg-12">
	<div class="box">	
		<header>		
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Proveedores</h5>	
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
						<th>Rut</th>
						<th>Nombre del Proveedor</th>
						<th>Sistema</th>
						<th>Estado</th>
						<th width="120">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrUsers as $usuarios) { ?>
					<tr class="odd">		
						<td><?php echo $usuarios['Rut']; ?></td>		
						<td><?php echo $usuarios['Nombre']; ?></td>		
						<td><?php echo $usuarios['sistema']; ?></td>
						<td><?php echo $usuarios['estado']; ?></td>		
						<td>
							<div class="btn-group widthtd120" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_proveedor.php?view='.$usuarios['idProveedor']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$usuarios['idProveedor']; ?>" data-placement="bottom" title="Editar Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$usuarios['idProveedor'];
									$dialogo   = '¿Realmente deseas eliminar al proveedor '.$usuarios['Nombre'].'?';?>
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
