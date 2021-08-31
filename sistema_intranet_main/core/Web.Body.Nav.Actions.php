<?php
//Variables
$SIS_where = ' idEstado=1';
$SIS_where.= ' AND idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
$SIS_where.= ' AND idUsuario='.$_SESSION['usuario']['basic_data']['idUsuario'];

//Busco cuantos mensajes hay
$nNoti = db_select_nrows (false, 'idNoti', 'principal_notificaciones_ver', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'nNoti');
?>


<div class="topnav">
              
    <div class="btn-group grouphidden">
        <a id="toggleFullScreen" title="Pantalla Completa" class="btn btn-default btn-sm tooltip" >
            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
        </a> 
        <a onClick="setVsual()" title="Ocultar Menu" class="btn btn-default btn-sm tooltip" >
            <i class="fa fa-bars" aria-hidden="true"></i>
        </a>
    </div>
              
    <div class="btn-group">
        <a href="principal_notificaciones.php?pagina=1" title="Notificaciones" class="btn btn-default btn-sm tooltip">
            <i class="fa fa-commenting-o <?php if($nNoti!=0){ echo 'faa-horizontal animated'; } ?>" aria-hidden="true"></i>
            <?php if(isset($nNoti)&&$nNoti!=0){echo '<span class="label label-danger">'.$nNoti.'</span>';}?>
        </a> 
        
        <a href="principal_ayuda.php" title="Ayuda" class="btn btn-default btn-sm tooltip">
            <i class="fa fa-question" aria-hidden="true"></i>
        </a>
        
        <a href="principal_procedimientos.php" title="Procedimientos" class="btn btn-default btn-sm tooltip">
            <i class="fa fa-file-word-o" aria-hidden="true"></i>
        </a>
        
        <a href="principal_agenda_telefonica.php?pagina=1" title="Agenda" class="btn btn-default btn-sm tooltip">
            <i class="fa fa-phone" aria-hidden="true"></i>
        </a>
        
        <a href="principal_calendario.php?pagina=1" title="Calendario" data-toggle="modal" class="btn btn-default btn-sm tooltip" >
            <i class="fa fa-calendar" aria-hidden="true"></i>
        </a> 
    </div>
    
 

 
    
    <div class="btn-group">
		<?php if((isset($_SESSION['usuario']['basic_data']['COunt'])&&$_SESSION['usuario']['basic_data']['COunt']>1) OR $_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?>
			<a href="index_select.php?bla=true" title="Cambio Sistema" data-toggle="modal" class="btn btn-primary btn-sm tooltip" >
				<i class="fa fa-exchange" aria-hidden="true"></i>
			</a> 
		<?php } ?>
		<?php 
		$ubicacion = $original.'?salir=true';
		$dialogo   = '¿Realmente desea cerrar su sesion?';?>
		<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Cerrar sesion" class="btn btn-metis-1 btn-sm tooltip">
            <i class="fa fa-power-off" aria-hidden="true"></i>
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
    let sesionbase = <?php echo $iii; ?>;
    let a          = $("body");
    let b          = $("#navbar_nav");
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

