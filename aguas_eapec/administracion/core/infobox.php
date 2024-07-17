<?php
//Verifico el tipo de usuario que esta ingresando
if($arrUsuario['tipo']=='SuperAdmin'){
	$z =" WHERE idSistema>=0";	
	$z.=" AND idUsuario>=0";	
}else{
	$z =" WHERE idSistema={$arrUsuario['idSistema']}";
	$z.=" AND idUsuario={$arrUsuario['idUsuario']}";	
}

//consultas anidadas, se utiliza las variables anteriores para consultar cada permiso
$query = "SELECT
(SELECT COUNT(idNoti) FROM notificaciones_ver ".$z." AND idEstado='1' ) AS Notificacion

FROM usuarios_listado
WHERE usuarios_listado.idUsuario='".$arrUsuario['idUsuario']."' "; 
$resultado = mysqli_query ($dbConn, $query);	
$n_permisos = mysqli_fetch_assoc($resultado);



?>


<div class="topnav">
              
    <div class="btn-group grouphidden">
        <a id="toggleFullScreen" data-placement="bottom" title="Pantalla Completa" data-toggle="tooltip" class="btn btn-default btn-sm info-tooltip_bottom" >
            <i class="glyphicon glyphicon-fullscreen"></i>
        </a> 
        <a onClick="setVsual()" data-placement="bottom" title="Ocultar Menu" data-toggle="tooltip" class="btn btn-default btn-sm info-tooltip_bottom" >
            <i class="fa fa-bars "></i>
        </a>
    </div>
              
    <div class="btn-group">
        <a href="principal_notificaciones.php?pagina=1" data-placement="bottom" title="Notificaciones" data-toggle="tooltip" class="btn btn-default btn-sm info-tooltip_bottom">
            <i class="fa fa-envelope <?php if($n_permisos['Notificacion']!=0){ echo 'faa-horizontal animated'; } ?>"></i>
            <?php if(isset($n_permisos['Notificacion'])&&$n_permisos['Notificacion']!=0){echo '<span class="label label-danger">'.$n_permisos['Notificacion'].'</span>';}?>
        </a> 
        
        <a href="principal_ayuda.php" data-placement="bottom" title="Ayuda" data-toggle="tooltip" class="btn btn-default btn-sm info-tooltip_bottom">
            <i class="fa fa-question"></i>
        </a>
        
        <a href="principal_procedimientos.php" data-placement="bottom" title="Procedimientos" data-toggle="tooltip" class="btn btn-default btn-sm info-tooltip_bottom">
            <i class="fa fa-file-word-o"></i>
        </a>
        
        <a href="principal_agenda_telefonica.php?pagina=1" data-placement="bottom" title="Agenda" data-toggle="tooltip" class="btn btn-default btn-sm info-tooltip_bottom">
            <i class="fa fa-phone"></i>
        </a>
        
        <a href="principal_calendario.php?pagina=1" data-placement="bottom" title="Calendario" data-toggle="modal" class="btn btn-default btn-sm info-tooltip_bottom" >
            <i class="fa fa-calendar"></i>
        </a> 
    </div>
    
 

 
    
    <div class="btn-group">
		<?php 
		$ubicacion = 'index.php?salir=true';
		$dialogo   = '¿Realmente desea cerrar su sesion?';?>
		<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" data-toggle="tooltip" title="Cerrar sesion" data-placement="bottom" class="btn btn-metis-1 btn-sm info-tooltip_bottom">
            <i class="fa fa-power-off"></i>
        </a> 
    </div>
    
</div>






<?php
//se resetea la interfaz
if(isset($_SESSION['menu'])&&$_SESSION['menu']!=''){
	$iii = $_SESSION['menu'];	
}else{
	$iii = 1; 
}?> 

<script type='text/javascript'>
    var sesionbase = <?php echo $iii; ?>;
    var a=$("body");
    var b=$("#navbar_nav");
    //Muestra y oculta la barra lateral
    function setVsual() {
		sesionbase = sesionbase + 1;
		
		switch(sesionbase){
			case 2:
				a.removeClass("sidebar-left-hidden");
				a.addClass("sidebar-left-mini");
				$("#navbar_nav").addClass("navvisibility");
				break;
			case 3:
				a.removeClass("sidebar-left-mini");
				a.addClass("sidebar-left-hidden");
				$("#navbar_nav").removeClass("navvisibility");
				break;
			case 4:
				sesionbase = 1;
				a.removeClass("sidebar-left-hidden");
				a.removeClass("sidebar-left-mini");
				$("#navbar_nav").addClass("navvisibility");
				break;
		}

        xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "1setSession.php?variable=" + sesionbase , true);
        xmlhttp.send();
    }
</script>

