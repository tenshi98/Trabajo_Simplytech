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
	if ( !empty($_POST['idProducto']) )      $idProducto      = $_POST['idProducto'];
	if ( !empty($_POST['Nombre']) )          $Nombre          = $_POST['Nombre'];
	if ( !empty($_POST['idTipo']) )          $idTipo          = $_POST['idTipo'];
	if ( !empty($_POST['idCategoria']) )     $idCategoria     = $_POST['idCategoria'];
	if ( !empty($_POST['idUml']) )           $idUml           = $_POST['idUml'];
	if ( isset($_POST['StockLimite']) )      $StockLimite     = $_POST['StockLimite'];
	if ( !empty($_POST['Marca']) )           $Marca           = $_POST['Marca'];
	if ( !empty($_POST['idTipoProducto']) )  $idTipoProducto  = $_POST['idTipoProducto'];
	if ( isset($_POST['ValorIngreso']) )     $ValorIngreso    = $_POST['ValorIngreso'];
	if ( isset($_POST['ValorEgreso']) )      $ValorEgreso     = $_POST['ValorEgreso'];
	if ( !empty($_POST['idRubro']) )         $idRubro         = $_POST['idRubro'];
	if ( !empty($_POST['Descripcion']) )     $Descripcion     = $_POST['Descripcion'];
	if ( !empty($_POST['Codigo']) )          $Codigo          = $_POST['Codigo'];
	if ( !empty($_POST['idProveedor']) )     $idProveedor     = $_POST['idProveedor'];
	
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
			case 'idProducto':      if(empty($idProducto)){       $error['idProducto']      = 'error/No ha ingresado el id';}break;
			case 'Nombre':          if(empty($Nombre)){           $error['Nombre']          = 'error/No ha ingresado el nombre del producto';}break;
			case 'idTipo':          if(empty($idTipo)){           $error['idTipo']          = 'error/No ha seleccionado el tipo de producto';}break;
			case 'idCategoria':     if(empty($idCategoria)){      $error['idCategoria']     = 'error/No ha seleccionado la categoria del producto';}break;
			case 'idUml':           if(empty($idUml)){            $error['idUml']           = 'error/No ha seleccionado la unidad de medida del producto';}break;
			case 'StockLimite':     if(empty($StockLimite)){      $error['StockLimite']     = 'error/No ha ingresado el stock minimo del producto';}break;
			case 'Marca':           if(empty($Marca)){            $error['Marca']           = 'error/No ha ingresado la marca del producto';}break;
			case 'idTipoProducto':  if(empty($idTipoProducto)){   $error['idTipoProducto']  = 'error/No ha seleccionado el tipo de producto';}break;
			case 'ValorIngreso':    if(empty($ValorIngreso)){     $error['ValorIngreso']    = 'error/No ha ingresado el valor del producto';}break;
			case 'ValorEgreso':     if(empty($ValorEgreso)){      $error['ValorEgreso']     = 'error/No ha ingresado el valor del producto';}break;
			case 'idRubro':         if(empty($idRubro)){          $error['idRubro']         = 'error/No ha seleccionado el rubro del producto';}break;
			case 'Descripcion':     if(empty($Descripcion)){      $error['Descripcion']     = 'error/No ha ingresado una Descripcion';}break;
			case 'Codigo':          if(empty($Codigo)){           $error['Codigo']          = 'error/No ha ingresado un Codigo';}break;
			case 'idProveedor':     if(empty($idProveedor)){      $error['idProveedor']     = 'error/No ha seleccionado un proveedor';}break;
		
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
				$sql_usuario = mysqli_query("SELECT Nombre FROM productos_listado WHERE Nombre='".$Nombre."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['Nombre'] = 'error/El Nombre ya existe en el sistema';}
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//se verifica si la imagen existe
				if (!empty($_FILES['Direccion_img']['name'])){
					//se verifican errores
					if ($_FILES["Direccion_img"]["error"] > 0){
						$error['Direccion_img']       = 'error/Ha ocurrido un error';
					} else {
						//Se verifican las extensiones de los archivos
						$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
						//Se verifica que el archivo subido no exceda los 100 kb
						$limite_kb = 1000;
						//Sufijo
						$sufijo = 'productos_';
						  
						if (in_array($_FILES['Direccion_img']['type'], $permitidos) && $_FILES['Direccion_img']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['Direccion_img']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$resultado = @move_uploaded_file($_FILES["Direccion_img"]["tmp_name"], $ruta);
								if ($resultado){
										
									//filtros
									if(isset($Nombre) && $Nombre != ''){                   $a  = "'".$Nombre."'" ;           }else{$a  ="''";}
									if(isset($idTipo) && $idTipo != ''){                   $a .= ",'".$idTipo."'" ;          }else{$a .=",''";}
									if(isset($idCategoria) && $idCategoria != ''){         $a .= ",'".$idCategoria."'" ;     }else{$a .=",''";}
									if(isset($idUml) && $idUml != ''){                     $a .= ",'".$idUml."'" ;           }else{$a .=",''";}
									if(isset($StockLimite) && $StockLimite != ''){         $a .= ",'".$StockLimite."'" ;     }else{$a .=",''";}
									if(isset($Marca) && $Marca != ''){                     $a .= ",'".$Marca."'" ;           }else{$a .=",''";}
									if(isset($idTipoProducto) && $idTipoProducto != ''){   $a .= ",'".$idTipoProducto."'" ;  }else{$a .=",''";}
									if(isset($ValorIngreso) && $ValorIngreso != ''){       $a .= ",'".$ValorIngreso."'" ;    }else{$a .=",''";}
									if(isset($ValorEgreso) && $ValorEgreso != ''){         $a .= ",'".$ValorEgreso."'" ;     }else{$a .=",''";}
									if(isset($idRubro) && $idRubro != ''){                 $a .= ",'".$idRubro."'" ;         }else{$a .=",''";}
									$a .= ",'".$sufijo.$_FILES['Direccion_img']['name']."'" ;
									if(isset($Descripcion) && $Descripcion != ''){         $a .= ",'".$Descripcion."'" ;     }else{$a .=",''";}
									if(isset($Codigo) && $Codigo != ''){                   $a .= ",'".$Codigo."'" ;          }else{$a .=",''";}
									if(isset($idProveedor) && $idProveedor != ''){         $a .= ",'".$idProveedor."'" ;     }else{$a .=",''";}
									
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `productos_listado` (Nombre, idTipo, idCategoria, idUml, StockLimite, Marca, 
									idTipoProducto, ValorIngreso, ValorEgreso, idRubro, Direccion_img, Descripcion, Codigo, idProveedor
									) VALUES ({$a} )";
									$result = mysqli_query($dbConn, $query);
										
									header( 'Location: '.$location.'&created=true' );
									die;
			
								} else {
									$error['imgLogo']       = 'error/Ocurrio un error al mover el archivo';
								}
							} else {
								$error['imgLogo']       = 'error/El archivo '.$_FILES['Direccion_img']['name'].' ya existe';
							}
						} else {
							$error['imgLogo']       = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
						}
					}
				}else{
					//filtros
					if(isset($Nombre) && $Nombre != ''){                   $a  = "'".$Nombre."'" ;           }else{$a  ="''";}
					if(isset($idTipo) && $idTipo != ''){                   $a .= ",'".$idTipo."'" ;          }else{$a .=",''";}
					if(isset($idCategoria) && $idCategoria != ''){         $a .= ",'".$idCategoria."'" ;     }else{$a .=",''";}
					if(isset($idUml) && $idUml != ''){                     $a .= ",'".$idUml."'" ;           }else{$a .=",''";}
					if(isset($StockLimite) && $StockLimite != ''){         $a .= ",'".$StockLimite."'" ;     }else{$a .=",''";}
					if(isset($Marca) && $Marca != ''){                     $a .= ",'".$Marca."'" ;           }else{$a .=",''";}
					if(isset($idTipoProducto) && $idTipoProducto != ''){   $a .= ",'".$idTipoProducto."'" ;  }else{$a .=",''";}
					if(isset($ValorIngreso) && $ValorIngreso != ''){       $a .= ",'".$ValorIngreso."'" ;    }else{$a .=",''";}
					if(isset($ValorEgreso) && $ValorEgreso != ''){         $a .= ",'".$ValorEgreso."'" ;     }else{$a .=",''";}
					if(isset($idRubro) && $idRubro != ''){                 $a .= ",'".$idRubro."'" ;         }else{$a .=",''";}
					if(isset($Descripcion) && $Descripcion != ''){         $a .= ",'".$Descripcion."'" ;     }else{$a .=",''";}
					if(isset($Codigo) && $Codigo != ''){                   $a .= ",'".$Codigo."'" ;          }else{$a .=",''";}
					if(isset($idProveedor) && $idProveedor != ''){         $a .= ",'".$idProveedor."'" ;     }else{$a .=",''";}
					
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `productos_listado` (Nombre, idTipo, idCategoria, idUml, StockLimite, Marca, idTipoProducto, 
					ValorIngreso, ValorEgreso, idRubro, Descripcion, Codigo, idProveedor) VALUES ({$a} )";
					$result = mysqli_query($dbConn, $query);
						
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
			}
	
		break;
/*******************************************************************************************************************/		
		case 'update':	
		
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				
				//se verifica si la imagen existe
				if (!empty($_FILES['Direccion_img']['name'])){
					//se verifican errores
					if ($_FILES["Direccion_img"]["error"] > 0){
						$error['Direccion_img']       = 'error/Ha ocurrido un error';
					} else {
						//Se verifican las extensiones de los archivos
						$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
						//Se verifica que el archivo subido no exceda los 100 kb
						$limite_kb = 1000;
						//Sufijo
						$sufijo = 'productos_';
						  
						if (in_array($_FILES['Direccion_img']['type'], $permitidos) && $_FILES['Direccion_img']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['Direccion_img']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$resultado = @move_uploaded_file($_FILES["Direccion_img"]["tmp_name"], $ruta);
								if ($resultado){
										
									//Filtros
									$a = "idProducto='".$idProducto."'" ;
									if(isset($Nombre) && $Nombre != ''){                   $a .= ",Nombre='".$Nombre."'" ;}
									if(isset($idTipo) && $idTipo != ''){                   $a .= ",idTipo='".$idTipo."'" ;}
									if(isset($idCategoria) && $idCategoria != ''){         $a .= ",idCategoria='".$idCategoria."'" ;}
									if(isset($idUml) && $idUml != ''){                     $a .= ",idUml='".$idUml."'" ;}
									if(isset($StockLimite) && $StockLimite != ''){         $a .= ",StockLimite='".$StockLimite."'" ;}
									if(isset($Marca) && $Marca != ''){                     $a .= ",Marca='".$Marca."'" ;}
									if(isset($idTipoProducto) && $idTipoProducto != ''){   $a .= ",idTipoProducto='".$idTipoProducto."'" ;}
									if(isset($ValorIngreso) && $ValorIngreso != ''){       $a .= ",ValorIngreso='".$ValorIngreso."'" ;}
									if(isset($ValorEgreso) && $ValorEgreso != ''){         $a .= ",ValorEgreso='".$ValorEgreso."'" ;}
									if(isset($idRubro) && $idRubro != ''){                 $a .= ",idRubro='".$idRubro."'" ;}
									$a .= ",Direccion_img='".$sufijo.$_FILES['Direccion_img']['name']."'" ;
									if(isset($Descripcion) && $Descripcion != ''){         $a .= ",Descripcion='".$Descripcion."'" ;}
									if(isset($Codigo) && $Codigo != ''){                   $a .= ",Codigo='".$Codigo."'" ;}
									if(isset($idProveedor) && $idProveedor != ''){         $a .= ",idProveedor='".$idProveedor."'" ;}
									
									// inserto los datos de registro en la db
									$query  = "UPDATE `productos_listado` SET ".$a." WHERE idProducto = '$idProducto'";
									$result = mysqli_query($dbConn, $query);
									
									header( 'Location: '.$location.'&edited=true' );
									die;
									
			
								} else {
									$error['imgLogo']       = 'error/Ocurrio un error al mover el archivo';
								}
							} else {
								$error['imgLogo']       = 'error/El archivo '.$_FILES['Direccion_img']['name'].' ya existe';
							}
						} else {
							$error['imgLogo']       = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
						}
					}
				}else{
					//Filtros
					$a = "idProducto='".$idProducto."'" ;
					if(isset($Nombre) && $Nombre != ''){                   $a .= ",Nombre='".$Nombre."'" ;}
					if(isset($idTipo) && $idTipo != ''){                   $a .= ",idTipo='".$idTipo."'" ;}
					if(isset($idCategoria) && $idCategoria != ''){         $a .= ",idCategoria='".$idCategoria."'" ;}
					if(isset($idUml) && $idUml != ''){                     $a .= ",idUml='".$idUml."'" ;}
					if(isset($StockLimite) && $StockLimite != ''){         $a .= ",StockLimite='".$StockLimite."'" ;}
					if(isset($Marca) && $Marca != ''){                     $a .= ",Marca='".$Marca."'" ;}
					if(isset($idTipoProducto) && $idTipoProducto != ''){   $a .= ",idTipoProducto='".$idTipoProducto."'" ;}
					if(isset($ValorIngreso) && $ValorIngreso != ''){       $a .= ",ValorIngreso='".$ValorIngreso."'" ;}
					if(isset($ValorEgreso) && $ValorEgreso != ''){         $a .= ",ValorEgreso='".$ValorEgreso."'" ;}
					if(isset($idRubro) && $idRubro != ''){                 $a .= ",idRubro='".$idRubro."'" ;}
					if(isset($Descripcion) && $Descripcion != ''){         $a .= ",Descripcion='".$Descripcion."'" ;}
					if(isset($Codigo) && $Codigo != ''){                   $a .= ",Codigo='".$Codigo."'" ;}
					if(isset($idProveedor) && $idProveedor != ''){         $a .= ",idProveedor='".$idProveedor."'" ;}
									
			
					// inserto los datos de registro en la db
					$query  = "UPDATE `productos_listado` SET ".$a." WHERE idProducto = '$idProducto'";
					$result = mysqli_query($dbConn, $query);
					
					header( 'Location: '.$location.'&edited=true' );
					die;
				}

			}

		break;	
/*******************************************************************************************************************/
		case 'del_img':	

			// Se obtiene el nombre del logo
			$query = "SELECT Direccion_img
			FROM `productos_listado`
			WHERE idProducto = {$_GET['del_img']}";
			$resultado = mysqli_query ($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);

			//Obtengo el nombre fisico del archivo
			$archivo = $rowdata['Direccion_img'];
			//variables
			$a = "Direccion_img=''" ;

			if(unlink('upload/'.$archivo)&&isset($rowdata['Direccion_img'])&&$rowdata['Direccion_img']!=''){	
					
				// actualizo los datos de registro en la db
				$query  = "UPDATE `productos_listado` SET ".$a." WHERE idProducto = '{$_GET['del_img']}'";
				$result = mysqli_query($dbConn, $query);
				//Redirijo			
				header( 'Location: '.$location.'&id='.$_GET['del_img'] );
				die;

			}else{

				// actualizo los datos de registro en la db
				$query  = "UPDATE `productos_listado` SET ".$a." WHERE idProducto = '{$_GET['del_img']}'";
				$result = mysqli_query($dbConn, $query);
				//Redirijo				
				header( 'Location: '.$location.'&id='.$_GET['del_img'] );
				die;

			}

		break;								
/*******************************************************************************************************************/
		case 'del':	

			// Se obtiene el nombre del logo
			$query = "SELECT Direccion_img
			FROM `productos_listado`
			WHERE idProducto = {$_GET['del']}";
			$resultado = mysqli_query ($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);

			//Obtengo el nombre fisico del archivo
			$archivo = $rowdata['Direccion_img'];

			if(unlink('upload/'.$archivo)&&isset($rowdata['Direccion_img'])&&$rowdata['Direccion_img']!=''){	
					
				//se borran los permisos del usuario
				$query  = "DELETE FROM `productos_listado` WHERE idProducto = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);	
							
				header( 'Location: '.$location.'&deleted=true' );
				die;

			}else{

				//se borran los permisos del usuario
				$query  = "DELETE FROM `productos_listado` WHERE idProducto = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);	
							
				header( 'Location: '.$location.'&deleted=true' );
				die;

			}	

		break;							
					
/*******************************************************************************************************************/
	}
?>
