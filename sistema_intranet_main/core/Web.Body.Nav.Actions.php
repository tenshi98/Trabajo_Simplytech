<?php
//Variables
$z = " WHERE idNoti!=0 AND idEstado='1' ";
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$z.= ' AND idSistema>=0';	
	$z.= ' AND idUsuario>=0';	
}else{
	$z.= ' AND idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
	$z.= ' AND idUsuario='.$_SESSION['usuario']['basic_data']['idUsuario'];	
}
//consultas anidadas, se utiliza las variables anteriores para consultar cada permiso
$query = "SELECT COUNT(idNoti) AS Notificacion FROM principal_notificaciones_ver ".$z; 
$resultado = mysqli_query($dbConn, $query);	
$notificaciones = mysqli_fetch_assoc($resultado);


?>


<div class="topnav">
              
    <div class="btn-group grouphidden">
        <a id="toggleFullScreen" title="Pantalla Completa" class="btn btn-default btn-sm tooltip" >
            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
        </a> 
        <a onClick="setVsual()" title="Ocultar Menu" class="btn btn-default btn-sm tooltip" >
            <i class="fa fa-bars "></i>
        </a>
    </div>
              
    <div class="btn-group">
        <a href="principal_notificaciones.php?pagina=1" title="Notificaciones" class="btn btn-default btn-sm tooltip">
            <i class="fa fa-commenting-o <?php if($notificaciones['Notificacion']!=0){ echo 'faa-horizontal animated'; } ?>"></i>
            <?php if(isset($notificaciones['Notificacion'])&&$notificaciones['Notificacion']!=0){echo '<span class="label label-danger">'.$notificaciones['Notificacion'].'</span>';}?>
        </a> 
        
        <a href="principal_ayuda.php" title="Ayuda" class="btn btn-default btn-sm tooltip">
            <i class="fa fa-question"></i>
        </a>
        
        <a href="principal_procedimientos.php" title="Procedimientos" class="btn btn-default btn-sm tooltip">
            <i class="fa fa-file-word-o"></i>
        </a>
        
        <a href="principal_agenda_telefonica.php?pagina=1" title="Agenda" class="btn btn-default btn-sm tooltip">
            <i class="fa fa-phone"></i>
        </a>
        
        <a href="principal_calendario.php?pagina=1" title="Calendario" data-toggle="modal" class="btn btn-default btn-sm tooltip" >
            <i class="fa fa-calendar"></i>
        </a> 
    </div>
    
 

 
    
    <div class="btn-group">
		<?php if((isset($_SESSION['usuario']['basic_data']['COunt'])&&$_SESSION['usuario']['basic_data']['COunt']>1) OR $_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?>
			<a href="index_select.php?bla=true" title="Cambio Sistema" data-toggle="modal" class="btn btn-primary btn-sm tooltip" >
				<i class="fa fa-exchange"></i>
			</a> 
		<?php } ?>
		<?php 
		$ubicacion = $original.'?salir=true';
		$dialogo   = '¿Realmente desea cerrar su sesion?';?>
		<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Cerrar sesion" class="btn btn-metis-1 btn-sm tooltip">
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

