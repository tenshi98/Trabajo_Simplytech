<?php
echo '
	<div class="row">
		<div class="col-sm-12">
			<div class="cover profile">';
			
				//portada animada
				include '1include_principal_interfaz_1_portada.php';
			
				//menu
				include '1include_principal_interfaz_1_menu.php';
			
			
			echo '
			
				
			</div>
			
			<div class="tab-content profile_content">';
				//contenido en tabs
				include '1include_principal_interfaz_tab_1.php';
				include '1include_principal_interfaz_tab_2.php';
				include '1include_principal_interfaz_tab_3.php';
				include '1include_principal_interfaz_tab_4.php';
				include '1include_principal_interfaz_tab_5.php';
				include '1include_principal_interfaz_tab_6.php';
				include '1include_principal_interfaz_tab_7.php';
				
				
				include '1include_principal_interfaz_tab_99.php';

				echo '
				<div class="clearfix"></div>				 
			</div> 
			
		</div>
	</div>';

	widget_modal(80, 95);


?>
