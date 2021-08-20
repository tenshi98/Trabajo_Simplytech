
<ul id="menu" class="">

    <li class="nav-header">Menu</li>
    <li class="nav-divider"></li>

    <li class="">
        <a href="principal.php" <?php if(isset($original)&&$original=='principal.php'){ echo 'class="active"';} ?>>
        	<i class="fa fa-home" aria-hidden="true"></i><span class="link-title"> Principal</span> 
        </a> 
    </li>
    <li class="">
        <a href="principal_datos.php" <?php if(isset($original)&&$original=='principal_datos.php'){echo 'class="active"';} ?>>
        	<i class="fa fa-address-card-o" aria-hidden="true"></i><span class="link-title"> Mis Datos</span> 
        </a> 
    </li>
    
    <?php
    //Si esta activa la opcion de correo Interno
	if($_SESSION['usuario']['basic_data']['CorreoInterno']==1){ ?>
		<li class="">
			<a href="principal_correos.php" <?php if(isset($original)&&$original=='principal_correos.php'){echo 'class="active"';} ?>>
				<i class="fa fa-envelope-o" aria-hidden="true"></i><span class="link-title"> Correo</span> 
			</a> 
		</li>
    <?php } ?>
    
<?php 
//Veo si existe el menu
if(isset($_SESSION['usuario']['menu'])){
	//recorro el menu
	foreach($_SESSION['usuario']['menu'] as $menu=>$menuCat) {
		
		//si la transaccion actual es igual a la categoria
		if(isset($original)&&isset($_SESSION['usuario']['Permisos'][$original]['CategoriaNombre'])&&$menu==$_SESSION['usuario']['Permisos'][$original]['CategoriaNombre']){ 
			$menu_class='class="active"';
		}else{
			$menu_class='';
		}
		
		//se le asigna color al icono
		if(isset($menuCat[0]['CategoriaIconoColor'])&&$menuCat[0]['CategoriaIconoColor']!=''){
			$Bgicolor = 'style="color: '.$menuCat[0]['CategoriaIconoColor'].';"';
		}else{
			$Bgicolor = '';
		}
		
		//Se crea la categoria
		echo '<li class="">';
			echo '<a href="javascript:;" '.$menu_class.'>';
				echo '<i class="'.$menuCat[0]['CategoriaIcono'].'" aria-hidden="true" '.$Bgicolor.'></i>';
				echo '<span class="link-title"> '.TituloMenu($menu).'</span>';
				echo '<i class="fa fa-angle-right fright margin_width" aria-hidden="true"></i>';
			echo '</a>';
			echo '<ul>';
				//se crea la transaccion
				foreach($menuCat as $menuList) {
					echo '<li class=""><a href="'.$menuList['TransaccionURL'].'"><i class="'.$menuList['CategoriaIcono'].'" '.$Bgicolor.'></i> '.TituloMenu($menuList['TransaccionNombre']).'</a> </li>';
				}
				echo '</ul>';  
		echo '</li>';    
	}
}
//Se crea el menu del super usuario
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){?>
    
    <li class="">
		<a href="javascript:;">
			<i class="fa fa-cogs" aria-hidden="true"></i><span class="link-title"> Core - Sistema</span> 
			<i class="fa fa-angle-right fright margin_width" aria-hidden="true"></i> 
		</a>  
		<ul>
			<li><a href="core_sistemas.php?pagina=1">                   <i class="fa fa-cogs" aria-hidden="true"></i> Sistemas</a></li>
			<li><a href="core_usr_admin.php?pagina=1">                  <i class="fa fa-cogs" aria-hidden="true"></i> Listado de Administradores</a></li>
			
		</ul>
	</li>
	
	<li class="">
		<a href="javascript:;">
			<i class="fa fa-cogs" aria-hidden="true"></i><span class="link-title"> Core - Configuracion</span> 
			<i class="fa fa-angle-right fright margin_width" aria-hidden="true"></i> 
		</a>  
		<ul>
			<li><a href="core_email.php">                               <i class="fa fa-cogs" aria-hidden="true"></i> Configuracion Correo Interno</a></li>
			<li><a href="core_comparacion_base.php">                    <i class="fa fa-cogs" aria-hidden="true"></i> Comparacion Base Datos</a></li>
			
		</ul>
	</li>
	
	<li class="">
		<a href="javascript:;">
			<i class="fa fa-cogs" aria-hidden="true"></i><span class="link-title"> Core - Estado</span> 
			<i class="fa fa-angle-right fright margin_width" aria-hidden="true"></i> 
		</a>  
		<ul>
			<li><a href="core_info_sistema.php">                        <i class="fa fa-cogs" aria-hidden="true"></i> Informacion del servidor</a></li>
			<li><a href="core_log_cambios.php?pagina=1">                <i class="fa fa-cogs" aria-hidden="true"></i> Cambios en el Sistema</a></li>
			<li><a href="core_mantenciones.php?pagina=1">               <i class="fa fa-cogs" aria-hidden="true"></i> Mantenciones al sistema</a></li>
			<li><a href="core_info_logs.php">                           <i class="fa fa-cogs" aria-hidden="true"></i> Logs de errores</a></li>
			
		</ul>
	</li>
	
	<li class="">
		<a href="javascript:;">
			<i class="fa fa-cogs" aria-hidden="true"></i><span class="link-title"> Core - Permisos</span> 
			<i class="fa fa-angle-right fright margin_width" aria-hidden="true"></i> 
		</a>  
		<ul>
			<li><a href="core_permisos_categorias.php?pagina=1">        <i class="fa fa-cogs" aria-hidden="true"></i> Permisos - Categorias</a></li>
			<li><a href="core_permisos_listado.php?pagina=1">           <i class="fa fa-cogs" aria-hidden="true"></i> Permisos - Listado</a></li>
			
		</ul>
	</li>
	
	<li class="">
		<a href="javascript:;">
			<i class="fa fa-cogs" aria-hidden="true"></i><span class="link-title"> Core - Pruebas</span> 
			<i class="fa fa-angle-right fright margin_width" aria-hidden="true"></i> 
		</a>  
		<ul>
			<li><a href="core_cambio_usuario.php">                      <i class="fa fa-cogs" aria-hidden="true"></i> Cambio de Usuario</a></li>
			<li><a href="core_testing_code.php">                        <i class="fa fa-cogs" aria-hidden="true"></i> Testeo de codigo</a></li>
			<li><a href="core_test_email.php">                          <i class="fa fa-cogs" aria-hidden="true"></i> Testeo de correos</a></li>
			<li><a href="core_test_social.php">                         <i class="fa fa-cogs" aria-hidden="true"></i> Testeo de Whatsapp</a></li>
			
		</ul>
	</li>
	
	<li class="">
		<a href="javascript:;">
			<i class="fa fa-cogs" aria-hidden="true"></i><span class="link-title"> Core - Seguridad</span> 
			<i class="fa fa-angle-right fright margin_width" aria-hidden="true"></i> 
		</a>  
		<ul>
			<li><a href="core_gestion_tickets_cerrar.php?pagina=1">     <i class="fa fa-cogs" aria-hidden="true"></i> Tickets Abiertos</a></li>
			<li><a href="core_sistema_seguridad_bloqueo.php?pagina=1">  <i class="fa fa-cogs" aria-hidden="true"></i> Seguridad - IP Bloqueadas</a></li>
			<li><a href="core_sistema_seguridad_ip_list.php">           <i class="fa fa-cogs" aria-hidden="true"></i> Seguridad - IP Relacionadas</a></li>
			<li><a href="core_sistema_seguridad_intento_hackeo.php">    <i class="fa fa-cogs" aria-hidden="true"></i> Seguridad - Intento Hackeo</a></li>
			
		</ul>
	</li>
	
	<li class="">
		<a href="javascript:;">
			<i class="fa fa-cogs" aria-hidden="true"></i><span class="link-title"> Core - Recursos</span> 
			<i class="fa fa-angle-right fright margin_width" aria-hidden="true"></i> 
		</a>  
		<ul>
			<li><a href="core_recursos_bgcolor.php">      <i class="fa fa-cogs" aria-hidden="true"></i> Background Color</a></li>
			<li><a href="core_recursos_bgimage.php">      <i class="fa fa-cogs" aria-hidden="true"></i> Background Image</a></li>
			<li><a href="core_recursos_button.php">       <i class="fa fa-cogs" aria-hidden="true"></i> Buttons</a></li>
			<li><a href="core_recursos_fonts.php">        <i class="fa fa-cogs" aria-hidden="true"></i> Iconos</a></li>
			<li><a href="core_recursos_pricing.php">      <i class="fa fa-cogs" aria-hidden="true"></i> Pricing Table</a></li>
			<li><a href="core_recursos_progress.php">     <i class="fa fa-cogs" aria-hidden="true"></i> Progress</a></li>
			<li><a href="core_recursos_typography.php">   <i class="fa fa-cogs" aria-hidden="true"></i> Typography</a></li>
			
			
			
			
			
		</ul>
	</li>
			      

<?php }?>                             
</ul>

