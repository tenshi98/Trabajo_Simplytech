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
	if ( !empty($_POST['idTrabajador']) )   $idTrabajador   = $_POST['idTrabajador'];
	if ( !empty($_POST['idSistema']) )      $idSistema      = $_POST['idSistema'];
	if ( !empty($_POST['Nombre']) )         $Nombre         = $_POST['Nombre'];
	if ( !empty($_POST['ApellidoPat']) )    $ApellidoPat    = $_POST['ApellidoPat'];
	if ( !empty($_POST['ApellidoMat']) )    $ApellidoMat    = $_POST['ApellidoMat'];
	if ( !empty($_POST['idTipo']) )         $idTipo         = $_POST['idTipo'];
	if ( !empty($_POST['Cargo']) )          $Cargo          = $_POST['Cargo'];
	if ( !empty($_POST['Fono']) )           $Fono           = $_POST['Fono'];
	if ( !empty($_POST['Rut']) )            $Rut            = $_POST['Rut'];
	if ( !empty($_POST['idCiudad']) )       $idCiudad       = $_POST['idCiudad'];
	if ( !empty($_POST['idComuna']) )       $idComuna       = $_POST['idComuna'];
	if ( !empty($_POST['Direccion']) )      $Direccion      = $_POST['Direccion'];
	if ( !empty($_POST['Observaciones']) )  $Observaciones  = $_POST['Observaciones'];
	if ( !empty($_POST['idLicitacion']) )   $idLicitacion   = $_POST['idLicitacion'];
	
	
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
			case 'idTrabajador':   if(empty($idTrabajador)){  $error['idTrabajador']   = 'error/No ha ingresado el id';}break;
			case 'idSistema':      if(empty($idSistema)){     $error['idSistema']      = 'error/No ha seleccionado el sistema al cual pertenece';}break;
			case 'Nombre':         if(empty($Nombre)){        $error['Nombre']         = 'error/No ha ingresado el nombre de la persona';}break;
			case 'ApellidoPat':    if(empty($ApellidoPat)){   $error['ApellidoPat']    = 'error/No ha ingresado el apellido paterno de la persona';}break;
			case 'ApellidoMat':    if(empty($ApellidoMat)){   $error['ApellidoMat']    = 'error/No ha ingresado el apellido materno de la persona';}break;
			case 'idTipo':         if(empty($idTipo)){        $error['idTipo']         = 'error/No ha seleccionado el tipo de trabajador';}break;
			case 'Cargo':          if(empty($Cargo)){         $error['Cargo']          = 'error/No ha ingresado el cargo a desempeñar';}break;
			case 'Fono':           if(empty($Fono)){          $error['Fono']           = 'error/No ha ingresado el fono';}break;
			case 'Rut':            if(empty($Rut)){           $error['Rut']            = 'error/No ha ingresado el rut';}break;
			case 'idCiudad':       if(empty($idCiudad)){      $error['idCiudad']       = 'error/No ha seleccionado la ciudad';}break;
			case 'idComuna':       if(empty($idComuna)){      $error['idComuna']       = 'error/No ha seleccionado la comuna';}break;
			case 'Direccion':      if(empty($Direccion)){     $error['Direccion']      = 'error/No ha ingresado la direccion';}break;
			case 'Observaciones':  if(empty($Observaciones)){ $error['Observaciones']  = 'error/No ha ingresado la observacion';}break;
			case 'idLicitacion':   if(empty($idLicitacion)){  $error['idLicitacion']   = 'error/No ha ingresado el proyecto';}break;
		
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	//Verifica si el mail corresponde
	if(isset($Fono)){if(validarnumero($Fono)) {     $error['Fono']   = 'error/Ingrese un numero telefonico valido'; }}
	//if(isset($Rut)){if(RutValidate($Rut)==0){       $error['Rut']    = 'error/El Rut ingresado no es valido'; }}

/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert':

			//Se verifica si el dato existe
			if(isset($Nombre)){
				$sql_usuario = mysqli_query("SELECT Nombre FROM trabajadores_listado WHERE Nombre='".$Nombre."' AND ApellidoPat='".$ApellidoPat."' AND ApellidoMat='".$ApellidoMat."' AND idSistema='".$idSistema."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['Nombre'] = 'error/El trabajador que intenta ingresar ya existe en el sistema';}
			
			//Se verifica si el dato existe
			if(isset($Rut)){
				$sql_usuario = mysqli_query("SELECT Rut FROM trabajadores_listado WHERE Rut='".$Rut."' AND idSistema='".$idSistema."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['Rut'] = 'error/El Rut ya existe en el sistema';}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){         $a  = "'".$idSistema."'" ;       }else{$a  = "''";}
				if(isset($Nombre) && $Nombre != ''){               $a .= ",'".$Nombre."'" ;         }else{$a .= ",''";}
				if(isset($ApellidoPat) && $ApellidoPat != ''){     $a .= ",'".$ApellidoPat."'" ;    }else{$a .= ",''";}
				if(isset($ApellidoMat) && $ApellidoMat != ''){     $a .= ",'".$ApellidoMat."'" ;    }else{$a .= ",''";}
				if(isset($idTipo) && $idTipo != ''){               $a .= ",'".$idTipo."'" ;         }else{$a .= ",''";}
				if(isset($Cargo) && $Cargo != ''){                 $a .= ",'".$Cargo."'" ;          }else{$a .= ",''";}
				if(isset($Fono) && $Fono != ''){                   $a .= ",'".$Fono."'" ;           }else{$a .= ",''";}
				if(isset($Rut) && $Rut != ''){                     $a .= ",'".$Rut."'" ;            }else{$a .= ",''";}
				if(isset($idCiudad) && $idCiudad != ''){           $a .= ",'".$idCiudad."'" ;       }else{$a .= ",''";}
				if(isset($idComuna) && $idComuna != ''){           $a .= ",'".$idComuna."'" ;       }else{$a .= ",''";}
				if(isset($Direccion) && $Direccion != ''){         $a .= ",'".$Direccion."'" ;      }else{$a .= ",''";}
				if(isset($Observaciones) && $Observaciones != ''){ $a .= ",'".$Observaciones."'" ;  }else{$a .= ",''";}
				if(isset($idLicitacion) && $idLicitacion != ''){   $a .= ",'".$idLicitacion."'" ;   }else{$a .= ",''";}

				// inserto los datos de registro en la db
				$query  = "INSERT INTO `trabajadores_listado` (idSistema, Nombre, ApellidoPat, ApellidoMat, idTipo, Cargo, Fono, Rut, idCiudad, idComuna, Direccion, Observaciones, idLicitacion) VALUES ({$a} )";
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
				$a = "idTrabajador='".$idTrabajador."'" ;
				if(isset($idSistema) && $idSistema != ''){         $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($Nombre) && $Nombre != ''){               $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($ApellidoPat) && $ApellidoPat != ''){     $a .= ",ApellidoPat='".$ApellidoPat."'" ;}
				if(isset($ApellidoMat) && $ApellidoMat != ''){     $a .= ",ApellidoMat='".$ApellidoMat."'" ;}
				if(isset($idTipo) && $idTipo != ''){               $a .= ",idTipo='".$idTipo."'" ;}
				if(isset($Cargo) && $Cargo != ''){                 $a .= ",Cargo='".$Cargo."'" ;}
				if(isset($Fono) && $Fono != ''){                   $a .= ",Fono='".$Fono."'" ;}
				if(isset($Rut) && $Rut != ''){                     $a .= ",Rut='".$Rut."'" ;}
				if(isset($idCiudad) && $idCiudad != ''){           $a .= ",idCiudad='".$idCiudad."'" ;}
				if(isset($idComuna) && $idComuna != ''){           $a .= ",idComuna='".$idComuna."'" ;}
				if(isset($Direccion) && $Direccion != ''){         $a .= ",Direccion='".$Direccion."'" ;}
				if(isset($Observaciones) && $Observaciones != ''){ $a .= ",Observaciones='".$Observaciones."'" ;}
				if(isset($idLicitacion) && $idLicitacion != ''){   $a .= ",idLicitacion='".$idLicitacion."'" ;}
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `trabajadores_listado` SET ".$a." WHERE idTrabajador = '$idTrabajador'";
				$result = mysqli_query($dbConn, $query);
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
	
		break;	
						
/*******************************************************************************************************************/
		case 'del':	

			//se borran los permisos del usuario
			$query  = "DELETE FROM `trabajadores_listado` WHERE idTrabajador = {$_GET['del']}";
			$result = mysqli_query($dbConn, $query);	
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;	
			
						
/*******************************************************************************************************************/
	}
?>
