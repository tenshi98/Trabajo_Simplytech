<?php 
	echo '
	<header>
		<ul class="nav nav-tabs pull-left">
			<li class="active"><a href="#Menu_tab_1" data-toggle="tab"><i class="fa fa-fw fa-bars"></i> Resumen</a></li>';
			
			//Contador de tab
			$count_tab = 1;
			
			//Telemetria
			$temp = $prm_x[7] + $prm_x[8] + $prm_x[9];
			if($temp!=0){
				echo '<li><a href="#Menu_tab_2" data-toggle="tab"><i class="fa fa-fw fa-bullseye"></i> Telemetria</a></li>';
				$count_tab++;
			}
			
			//Bodegas					
			$temp = $prm_x[1] + $prm_x[2] + $prm_x[3] + $prm_x[4] + $prm_x[5];
			if($temp!=0){
				echo '<li><a href="#Menu_tab_3" data-toggle="tab"><i class="fa fa-fw fa-cubes"></i> Bodegas</a></li>';
				$count_tab++;
			}
			
			//Lubricacion
			$temp = $prm_x[6] + $prm_x[10] + $prm_x[11];					
			if($temp!=0) {
				echo '<li><a href="#Menu_tab_4" data-toggle="tab"><i class="fa fa-fw fa-cubes"></i> '.$x_column_lubricacion.'</a></li>';
				$count_tab++;
			}
			
			//Repositorio
			if($n_permisos['idOpcionesGen_9']=='1' or $idTipoUsuario==1) { 
				echo '<li><a href="#Menu_tab_5" data-toggle="tab"><i class="fa fa-database" aria-hidden="true"></i> Repositorio</a></li>';
				$count_tab++;
			}
			
			/**************************************************/	
			if($count_tab==5){echo '<li class="dropdown"><a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a><ul class="dropdown-menu" role="menu">';}
			//Cross Shipping
			$temp = $prm_x[32] + $prm_x[33] + $prm_x[34] + $prm_x[35] + $prm_x[36] + $prm_x[37];					
			if($temp!=0) { 
				echo '<li><a href="#Menu_tab_6" data-toggle="tab"><i class="fa fa-truck" aria-hidden="true"></i> Cross Shipping</a></li>';
				$count_tab++;
			}
			
			/**************************************************/	
			if($count_tab==5){echo '<li class="dropdown"><a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a><ul class="dropdown-menu" role="menu">';}
			//Cross Checking
			$temp = $prm_x[38] + $prm_x[39] + $prm_x[40] + $prm_x[41];						
			if($temp!=0) { 
				echo '<li><a href="#Menu_tab_7" data-toggle="tab"><i class="fa fa-map-marker" aria-hidden="true"></i> Cross Checking</a></li>';
				$count_tab++;
			}
							
			/**************************************************/	
			if($count_tab==5){echo '<li class="dropdown"><a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a><ul class="dropdown-menu" role="menu">';}
			//Log de cambios					
			if($idTipoUsuario==1 OR $idTipoUsuario==2) { 
				echo '<li><a href="#Menu_tab_99" data-toggle="tab"><i class="fa fa-refresh"></i> Actualizaciones</a></li>';
				$count_tab++;
			}
			
			if($count_tab>=5){echo '</ul></li>';}
			

			
		echo '	
		</ul>
				
					
	</header>';



?>

