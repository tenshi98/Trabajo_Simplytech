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
	if ( !empty($_POST['idReceta']) )       $idReceta        = $_POST['idReceta'];
	if ( !empty($_POST['idProducto']) )     $idProducto      = $_POST['idProducto'];
	if ( !empty($_POST['idProductoRel']) )  $idProductoRel   = $_POST['idProductoRel'];
	if ( !empty($_POST['Cantidad']) )       $Cantidad        = $_POST['Cantidad'];
	
	
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
			case 'idReceta':      if(empty($idReceta)){       $error['idReceta']       = 'error/No ha ingresado el id';}break;
			case 'idProducto':    if(empty($idProducto)){     $error['idProducto']     = 'error/No ha seleccionado el producto';}break;
			case 'idProductoRel': if(empty($idProductoRel)){  $error['idProductoRel']  = 'error/No ha seleccionado el producto relacionado';}break;
			case 'Cantidad':      if(empty($Cantidad)){       $error['Cantidad']       = 'error/No ha ingresado la cantidad';}break;
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	//Verifica si el mail corresponde	
	if(isset($Cantidad)){if (validarnumero($Cantidad)) {     $error['Cantidad']   = 'error/Ingrese una cantidad'; }}	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert':
			//Verifico si el producto ya ha sido ingresado en la receta para evitar duplicidad
			if(isset($idProducto)&&isset($idProductoRel)&&isset($Cantidad)){
				
				$query = "SELECT idReceta
				FROM `productos_recetas`
				WHERE idProducto = {$idProducto} AND idProductoRel = {$idProductoRel}";
				$resultado = mysqli_query ($dbConn, $query);
				$rows = mysqli_num_rows ($resultado);
				
				if($rows>0){
					$error['Cantidad']  = 'error/El producto seleccionado ya a sido ingresado en la receta';
				}
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idProducto) && $idProducto != ''){         $a = "'".$idProducto."'" ;          }else{$a ="''";}
				if(isset($idProductoRel) && $idProductoRel != ''){   $a .= ",'".$idProductoRel."'" ;   }else{$a .= ",''";}
				if(isset($Cantidad) && $Cantidad != ''){             $a .= ",'".$Cantidad."'" ;        }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `productos_recetas` (idProducto, idProductoRel, Cantidad) VALUES ({$a} )";
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
				$a = "idReceta='".$idReceta."'" ;
				if(isset($idProducto) && $idProducto != ''){         $a .= ",idProducto='".$idProducto."'" ;}
				if(isset($idProductoRel) && $idProductoRel != ''){   $a .= ",idProductoRel='".$idProductoRel."'" ;}
				if(isset($Cantidad) && $Cantidad != ''){             $a .= ",Cantidad='".$Cantidad."'" ;}
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `productos_recetas` SET ".$a." WHERE idReceta = '$idReceta'";
				$result = mysqli_query($dbConn, $query);
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
		break;	
					
/*******************************************************************************************************************/
		case 'del':	

			//se borra un dato
			$query  = "DELETE FROM `productos_recetas` WHERE idReceta = {$_GET['del']}";
			$result = mysqli_query($dbConn, $query);	
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;							
						
/*******************************************************************************************************************/
	}
?>
