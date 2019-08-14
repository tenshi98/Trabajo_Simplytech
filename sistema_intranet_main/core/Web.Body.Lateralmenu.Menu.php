
<ul id="menu" class="">

    <li class="nav-header">Menu</li>
    <li class="nav-divider"></li>

    <li class="">
        <a href="principal.php" <?php if(isset($original)&&$original=='principal.php'){ echo 'class="active"';} ?>>
        	<i class="fa fa-dashboard"></i><span class="link-title"> Principal</span> 
        </a> 
    </li>
    <li class="">
        <a href="principal_datos.php" <?php if(isset($original)&&$original=='principal_datos.php'){echo 'class="active"';} ?>>
        	<i class="fa fa-address-card-o"></i><span class="link-title"> Mis Datos</span> 
        </a> 
    </li>
    
    <?php
    //Si esta activa la opcion de correo Interno
	if($_SESSION['usuario']['basic_data']['CorreoInterno']==1){ ?>
		<li class="">
			<a href="principal_correos.php" <?php if(isset($original)&&$original=='principal_correos.php'){echo 'class="active"';} ?>>
				<i class="fa fa-envelope-o"></i><span class="link-title"> Correo</span> 
			</a> 
		</li>
    <?php } ?>
    
<?php 
//arreglo con la categoria
if(isset($_SESSION['usuario']['menu'])){
	foreach($_SESSION['usuario']['menu'] as $menu=>$productos) {
		if(isset($original)&&isset($_SESSION['usuario']['Permisos'][$original]['CategoriaNombre'])&&$menu==$_SESSION['usuario']['Permisos'][$original]['CategoriaNombre']){ $menu_class='class="active"';}else{$menu_class='';}
		
		echo '<li class="">
			    <a href="javascript:;" '.$menu_class.'>
					<i class="'.$productos[0]['CategoriaIcono'].'"></i>
					<span class="link-title"> '.TituloMenu($menu).'</span>
					<span class="fa fa-angle-right fright margin_width"></span>
				 </a>
				 <ul>';
				
				// arreglo con las transacciones
				foreach($productos as $producto) {
					echo '<li class=""><a href="'.$producto['TransaccionURL'].'"><i class="'.$producto['CategoriaIcono'].'"></i> '.TituloMenu($producto['TransaccionNombre']).'</a> </li>';
				}
				echo '</ul>';  
		echo '</li>';    
	}
}?>  
    
<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){?>
          
	<li class="">
		<a href="javascript:;">
			<i class="fa fa-cogs"></i><span class="link-title"> Core</span> 
			<span class="fa fa-angle-right fright margin_width"></span> 
		</a>  
		<ul>
			<li><a href="core_sistemas.php?pagina=1">               <i class="fa fa-cogs"></i> Sistemas</a></li>
			<li><a href="core_permisos_categorias.php?pagina=1">    <i class="fa fa-cogs"></i> Permisos - Categorias</a></li>
			<li><a href="core_permisos_listado.php?pagina=1">       <i class="fa fa-cogs"></i> Permisos - Listado</a></li>
			<li><a href="core_usr_admin.php?pagina=1">              <i class="fa fa-cogs"></i> Listado de Administradores</a></li>
			<li><a href="core_info_sistema.php">                    <i class="fa fa-cogs"></i> Informacion del servidor</a></li>
			<li><a href="core_log_cambios.php?pagina=1">            <i class="fa fa-cogs"></i> Cambios en el Sistema</a></li>
			<li><a href="core_mantenciones.php?pagina=1">           <i class="fa fa-cogs"></i> Mantenciones al sistema</a></li>
			<li><a href="core_email.php">                           <i class="fa fa-cogs"></i> Configuracion Correo Interno</a></li>
			<li><a href="core_comparacion_base.php">                <i class="fa fa-cogs"></i> Comparacion Base Datos</a></li>
			<li><a href="core_cambio_usuario.php">                  <i class="fa fa-cogs"></i> Cambio de Usuario</a></li>
			<li><a href="core_testing_code.php">                    <i class="fa fa-cogs"></i> Testeo de codigo</a></li>
			
			
		</ul>
	</li>
<?php }?>                             
</ul>

