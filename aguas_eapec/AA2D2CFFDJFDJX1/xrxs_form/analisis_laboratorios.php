<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if ( !empty($_POST['idLaboratorio']) )    $idLaboratorio     = $_POST['idLaboratorio'];
	if ( !empty($_POST['idSistema']) )        $idSistema         = $_POST['idSistema'];
	if ( !empty($_POST['Codigo']) )           $Codigo            = $_POST['Codigo'];
	if ( !empty($_POST['Rut']) )              $Rut               = $_POST['Rut'];
	if ( !empty($_POST['Nombre']) )           $Nombre            = $_POST['Nombre'];
	
	
/*******************************************************************************************************************/
/*                                      Verificacion de los datos obligatorios                                     */
/*******************************************************************************************************************/

	//limpio y separo los datos de la cadena de comprobacion
	$form_obligatorios = str_replace(' ', '', $form_obligatorios);
	$piezas = explode(",", $form_obligatorios);
	//recorro los elementos
	foreach ($piezas as $valor) {
		//veo si existe el dato solicitado y genero el error
		switch ($valor) {
			case 'idLaboratorio':   if(empty($idLaboratorio)){    $error['idLaboratorio']    = 'error/No ha ingresado el id';}break;
			case 'idSistema':       if(empty($idSistema)){        $error['idSistema']        = 'error/No ha seleccionado el sistema';}break;
			case 'Codigo':          if(empty($Codigo)){           $error['Codigo']           = 'error/No ha ingresado el codigo';}break;
			case 'Rut':             if(empty($Rut)){              $error['Rut']              = 'error/No ha ingresado el rut';}break;
			case 'Nombre':          if(empty($Nombre)){           $error['Nombre']           = 'error/No ha ingresado el nombre';}break;
			
	
		}
	}
	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert':
			//Verifico otros datos
			
			//Se verifica si el dato existe
			if(isset($Nombre)){
				$sql_usuario = mysqli_query("SELECT Nombre FROM analisis_laboratorios WHERE Nombre='".$Nombre."' AND idSistema='".$idSistema."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['idTipoBoton'] = 'error/El nombre del laboratorio ya existe en el sistema';}
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){   $a = "'".$idSistema."'" ;   }else{$a ="''";}
				if(isset($Codigo) && $Codigo != ''){         $a .= ",'".$Codigo."'" ;    }else{$a .= ",''";}
				if(isset($Rut) && $Rut != ''){               $a .= ",'".$Rut."'" ;       }else{$a .= ",''";}
				if(isset($Nombre) && $Nombre != ''){         $a .= ",'".$Nombre."'" ;    }else{$a .= ",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `analisis_laboratorios` (idSistema, Codigo, Rut, Nombre) VALUES ({$a} )";
				$result = mysqli_query($dbConn, $query);
					
				header( 'Location: '.$location.'&created=true' );
				die;
				
			}
	
		break;
/*******************************************************************************************************************/		
		case 'update':	
		
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idLaboratorio='".$idLaboratorio."'" ;
				if(isset($idSistema) && $idSistema != ''){    $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($Codigo) && $Codigo != ''){          $a .= ",Codigo='".$Codigo."'" ;}
				if(isset($Rut) && $Rut != ''){                $a .= ",Rut='".$Rut."'" ;}
				if(isset($Nombre) && $Nombre != ''){          $a .= ",Nombre='".$Nombre."'" ;}
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `analisis_laboratorios` SET ".$a." WHERE idLaboratorio = '$idLaboratorio'";
				$result = mysqli_query($dbConn, $query);
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
		break;	
					
/*******************************************************************************************************************/
		case 'del':	

			//se borran los permisos del usuario
			$query  = "DELETE FROM `analisis_laboratorios` WHERE idLaboratorio = {$_GET['del']}";
			$result = mysqli_query($dbConn, $query);	
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;							
						
/*******************************************************************************************************************/
	}
?>
