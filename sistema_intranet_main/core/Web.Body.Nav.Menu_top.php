<?php
//modificacion de la interfaz
if(isset($_SESSION['menu'])&&$_SESSION['menu']!=''){
	
	if($_SESSION['menu']!=3){
		$classnav = 'navvisibility';
	}else{
		$classnav = '';
	}
}else{
	$classnav = 'navvisibility'; 
}

//Creacion del menu
echo '<ul class="nav navbar-nav '.$classnav.'" id="navbar_nav" >
		<li><a href="principal.php">Principal</a></li>
		<li><a href="principal_datos.php">Mis Datos</a></li>';
	
	//Si esta activa la opcion de correo Interno
	if($_SESSION['usuario']['basic_data']['CorreoInterno']==1){
		echo '<li><a href="principal_correos.php">Correo</a></li>';
	}

	//Se recorren los permisos
	if(isset($_SESSION['usuario']['menu'])){
		foreach($_SESSION['usuario']['menu'] as $menu=>$productos) {
			echo '<li class="dropdown">';
			echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.TituloMenu($menu).'<b class="caret"></b></a>';
			echo '<ul class="dropdown-menu">';
					
			// recorremos los productos
			foreach($productos as $producto) {
				// imprimimos producto y precio
				echo '<li><a href="'.$producto['TransaccionURL'].'">'.TituloMenu($producto['TransaccionNombre']).'</a></li>';
			}
		echo '</ul>';  
		echo '</li>';    
		}
	}
	//Se crea el menu del super usuario
	if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
		echo '<li class="dropdown ">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Core<b class="caret"></b></a> 
			<ul class="dropdown-menu">
				<li><a href="core_sistemas.php?pagina=1">             <i class="fa fa-cogs"></i>Sistemas</a></li>
				<li><a href="core_permisos_categorias.php?pagina=1">  <i class="fa fa-cogs"></i>Permisos - Categorias</a></li>
				<li><a href="core_permisos_listado.php?pagina=1">     <i class="fa fa-cogs"></i>Permisos - Listado</a></li>
				<li><a href="core_usr_admin.php?pagina=1">            <i class="fa fa-cogs"></i>Listado de Administradores</a></li>
				<li><a href="core_info_sistema.php">                  <i class="fa fa-cogs"></i>Informacion del servidor</a></li>
				<li><a href="core_log_cambios.php?pagina=1">          <i class="fa fa-cogs"></i>Cambios en el Sistema</a></li>
				<li><a href="core_mantenciones.php?pagina=1">         <i class="fa fa-cogs"></i>Mantenciones al sistema</a></li>
				<li><a href="core_email.php">                         <i class="fa fa-cogs"></i>Configuracion Correo Interno</a></li>
				<li><a href="core_comparacion_base.php">              <i class="fa fa-cogs"></i>Comparacion Base Datos</a></li>
				<li><a href="core_cambio_usuario.php">                <i class="fa fa-cogs"></i>Cambio de Usuario</a></li>
				<li><a href="core_testing_code.php">                  <i class="fa fa-cogs"></i>Testeo de codigo</a></li>
			</ul>
		</li>'; 
	}                          
	echo '</ul>'; 
              
?>
