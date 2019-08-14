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
	if ( !empty($_POST['idProducto']) )       $idProducto       = $_POST['idProducto'];
	if ( !empty($_POST['idCategoria']) )      $idCategoria      = $_POST['idCategoria'];
	if ( !empty($_POST['idUml']) )            $idUml            = $_POST['idUml'];
	if ( !empty($_POST['Nombre']) )           $Nombre           = $_POST['Nombre'];
	if ( !empty($_POST['Marca']) )            $Marca            = $_POST['Marca'];
	if ( isset($_POST['StockLimite']) )       $StockLimite      = $_POST['StockLimite'];
	if ( isset($_POST['ValorIngreso']) )      $ValorIngreso     = $_POST['ValorIngreso'];
	if ( isset($_POST['ValorEgreso']) )       $ValorEgreso      = $_POST['ValorEgreso'];
	if ( !empty($_POST['Descripcion']) )      $Descripcion      = $_POST['Descripcion'];
	if ( !empty($_POST['Codigo']) )           $Codigo           = $_POST['Codigo'];
	if ( !empty($_POST['idProveedor']) )      $idProveedor      = $_POST['idProveedor'];
	if ( !empty($_POST['Direccion_img']) )    $Direccion_img    = $_POST['Direccion_img'];
	if ( !empty($_POST['FichaTecnica']) )     $FichaTecnica     = $_POST['FichaTecnica'];
	if ( !empty($_POST['HDS']) )              $HDS              = $_POST['HDS'];
	if ( !empty($_POST['idEstado']) )         $idEstado         = $_POST['idEstado'];
	if ( !empty($_POST['idProveedorFijo']) )  $idProveedorFijo  = $_POST['idProveedorFijo'];
	if ( !empty($_POST['idTipoImagen']) )     $idTipoImagen     = $_POST['idTipoImagen'];
	

/*******************************************************************************************************************/
/*                                      Verificacion de los datos obligatorios                                     */
/*******************************************************************************************************************/

	//limpio y separo los datos de la cadena de comprobacion
	$form_obligatorios = str_replace(' ', '', $_SESSION['form_require']);
	$piezas = explode(",", $form_obligatorios);
	//recorro los elementos
	foreach ($piezas as $valor) {
		//veo si existe el dato solicitado y genero el error
		switch ($valor) {
			case 'idProducto':      if(empty($idProducto)){       $error['idProducto']      = 'error/No ha ingresado el id';}break;
			case 'idCategoria':     if(empty($idCategoria)){      $error['idCategoria']     = 'error/No ha seleccionado la categoria del producto';}break;
			case 'idUml':           if(empty($idUml)){            $error['idUml']           = 'error/No ha seleccionado la unidad de medida del producto';}break;
			case 'Nombre':          if(empty($Nombre)){           $error['Nombre']          = 'error/No ha ingresado el nombre del producto';}break;
			case 'Marca':           if(empty($Marca)){            $error['Marca']           = 'error/No ha ingresado la marca del producto';}break;
			case 'StockLimite':     if(empty($StockLimite)){      $error['StockLimite']     = 'error/No ha ingresado el stock minimo del producto';}break;
			case 'ValorIngreso':    if(empty($ValorIngreso)){     $error['ValorIngreso']    = 'error/No ha ingresado el valor del producto';}break;
			case 'ValorEgreso':     if(empty($ValorEgreso)){      $error['ValorEgreso']     = 'error/No ha ingresado el valor del producto';}break;
			case 'Descripcion':     if(empty($Descripcion)){      $error['Descripcion']     = 'error/No ha ingresado una Descripcion';}break;
			case 'Codigo':          if(empty($Codigo)){           $error['Codigo']          = 'error/No ha ingresado un Codigo';}break;
			case 'idProveedor':     if(empty($idProveedor)){      $error['idProveedor']     = 'error/No ha seleccionado un proveedor';}break;
			case 'Direccion_img':   if(empty($Direccion_img)){    $error['Direccion_img']   = 'error/No ha adjuntado una imagen';}break;
			case 'FichaTecnica':    if(empty($FichaTecnica)){     $error['FichaTecnica']    = 'error/No ha adjuntado una ficha tecnica';}break;
			case 'HDS':             if(empty($HDS)){              $error['HDS']             = 'error/No ha adjuntado un archivo de seguridad';}break;
			case 'idEstado':        if(empty($idEstado)){         $error['idEstado']        = 'error/No ha ingresado el estado del producto';}break;
			case 'idProveedorFijo': if(empty($idProveedorFijo)){  $error['idProveedorFijo'] = 'error/No ha Seleccionado el proveedor';}break;
			case 'idTipoImagen':    if(empty($idTipoImagen)){     $error['idTipoImagen']    = 'error/No ha seleccionado el tipo de imagen';}break;
			
		}
	}

/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)){
				$ndata_1 = db_select_nrows ('Nombre', 'insumos_listado', '', "Nombre='".$Nombre."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idCategoria) && $idCategoria != ''){         $a  = "'".$idCategoria."'" ;      }else{$a  ="''";}
				if(isset($idUml) && $idUml != ''){                     $a .= ",'".$idUml."'" ;           }else{$a .=",''";}
				if(isset($Nombre) && $Nombre != ''){                   $a .= ",'".$Nombre."'" ;          }else{$a .=",''";}
				if(isset($Marca) && $Marca != ''){                     $a .= ",'".$Marca."'" ;           }else{$a .=",''";}
				if(isset($StockLimite) && $StockLimite != ''){         $a .= ",'".$StockLimite."'" ;     }else{$a .=",''";}
				if(isset($ValorIngreso) && $ValorIngreso != ''){       $a .= ",'".$ValorIngreso."'" ;    }else{$a .=",''";}
				if(isset($ValorEgreso) && $ValorEgreso != ''){         $a .= ",'".$ValorEgreso."'" ;     }else{$a .=",''";}
				if(isset($Descripcion) && $Descripcion != ''){         $a .= ",'".$Descripcion."'" ;     }else{$a .=",''";}
				if(isset($Codigo) && $Codigo != ''){                   $a .= ",'".$Codigo."'" ;          }else{$a .=",''";}
				if(isset($idProveedor) && $idProveedor != ''){         $a .= ",'".$idProveedor."'" ;     }else{$a .=",''";}
				if(isset($Direccion_img) && $Direccion_img != ''){     $a .= ",'".$Direccion_img."'" ;   }else{$a .=",''";}
				if(isset($FichaTecnica) && $FichaTecnica != ''){       $a .= ",'".$FichaTecnica."'" ;    }else{$a .=",''";}
				if(isset($HDS) && $HDS != ''){                         $a .= ",'".$HDS."'" ;             }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){               $a .= ",'".$idEstado."'" ;        }else{$a .=",''";}
				if(isset($idProveedorFijo) && $idProveedorFijo != ''){ $a .= ",'".$idProveedorFijo."'" ; }else{$a .=",''";}
				if(isset($idTipoImagen) && $idTipoImagen != ''){       $a .= ",'".$idTipoImagen."'" ;    }else{$a .=",''";}
						
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `insumos_listado` (idCategoria,idUml,Nombre,
				Marca,StockLimite,ValorIngreso,ValorEgreso,Descripcion,Codigo,idProveedor,Direccion_img,
				FichaTecnica,HDS, idEstado, idProveedorFijo, idTipoImagen ) 
				VALUES ({$a} )";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
								
					header( 'Location: '.$location.'&id='.$ultimo_id.'&created=true' );
					die;
					
				//si da error, guardar en el log de errores una copia
				}else{
					//Genero numero aleatorio
					$vardata = genera_password(8,'alfanumerico');
					
					//Guardo el error en una variable temporal
					$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
					$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
					$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
				}
				
			}
	
		break;
/*******************************************************************************************************************/		
		case 'update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idProducto)){
				$ndata_1 = db_select_nrows ('Nombre', 'insumos_listado', '', "Nombre='".$Nombre."' AND idProducto!='".$idProducto."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				$a = "idProducto='".$idProducto."'" ;
				if(isset($idCategoria) && $idCategoria != ''){         $a .= ",idCategoria='".$idCategoria."'" ;}
				if(isset($idUml) && $idUml != ''){                     $a .= ",idUml='".$idUml."'" ;}
				if(isset($Nombre) && $Nombre != ''){                   $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Marca) && $Marca != ''){                     $a .= ",Marca='".$Marca."'" ;}
				if(isset($StockLimite) && $StockLimite != ''){         $a .= ",StockLimite='".$StockLimite."'" ;}
				if(isset($ValorIngreso) && $ValorIngreso != ''){       $a .= ",ValorIngreso='".$ValorIngreso."'" ;}
				if(isset($ValorEgreso) && $ValorEgreso != ''){         $a .= ",ValorEgreso='".$ValorEgreso."'" ;}
				if(isset($Descripcion) && $Descripcion != ''){         $a .= ",Descripcion='".$Descripcion."'" ;}
				if(isset($Codigo) && $Codigo != ''){                   $a .= ",Codigo='".$Codigo."'" ;}
				if(isset($idProveedor) && $idProveedor != ''){         $a .= ",idProveedor='".$idProveedor."'" ;}
				if(isset($Direccion_img) && $Direccion_img != ''){     $a .= ",Direccion_img='".$Direccion_img."'" ;}
				if(isset($FichaTecnica) && $FichaTecnica != ''){       $a .= ",FichaTecnica='".$FichaTecnica."'" ;}
				if(isset($HDS) && $HDS != ''){                         $a .= ",HDS='".$HDS."'" ;}
				if(isset($idEstado) && $idEstado != ''){               $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idProveedorFijo) && $idProveedorFijo != ''){ $a .= ",idProveedorFijo='".$idProveedorFijo."'" ;}
				if(isset($idTipoImagen) && $idTipoImagen != ''){       $a .= ",idTipoImagen='".$idTipoImagen."'" ;}
											
					
				// inserto los datos de registro en la db
				$query  = "UPDATE `insumos_listado` SET ".$a." WHERE idProducto = '$idProducto'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&edited=true' );
					die;
					
				//si da error, guardar en el log de errores una copia
				}else{
					//Genero numero aleatorio
					$vardata = genera_password(8,'alfanumerico');
					
					//Guardo el error en una variable temporal
					$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
					$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
					$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
				}

			}

		break;	
/*******************************************************************************************************************/
		case 'submit_img':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ($_FILES["Direccion_img"]["error"] > 0){
				$error['Direccion_img']       = 'error/Ha ocurrido un error';
			} else {
				//Se verifican las extensiones de los archivos
				$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
				//Se verifica que el archivo subido no exceda los 100 kb
				$limite_kb = 1000;
				//Sufijo
				$sufijo = 'ins_img_'.$idProducto.'_';
				  
				if (in_array($_FILES['Direccion_img']['type'], $permitidos) && $_FILES['Direccion_img']['size'] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['Direccion_img']['name'];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (!file_exists($ruta)){
						//se verifica como tipo de iamgen
						if(isset($idTipoImagen)&&$idTipoImagen!=1){
							//Muevo el archivo
							$move_result = @move_uploaded_file($_FILES["Direccion_img"]["tmp_name"], "upload/xxxsxx_".$_FILES['Direccion_img']['name']);
							if ($move_result){
								//Se cargan las imagenes base
								switch ($idTipoImagen) {
									
									//Tambor Amarillo
									case 2:
										$img_base = imagecreatefrompng('../LIB_assets/img/Tambor_Amarillo.png');
										$max_width = 100;
										$max_height = 50;
									break;
									//Tambor Azul	
									case 3:
										$img_base = imagecreatefrompng('../LIB_assets/img/Tambor_Azul.png');
										$max_width = 100;
										$max_height = 50;
									break;
									//Tambor Rojo
									case 4:
										$img_base = imagecreatefrompng('../LIB_assets/img/Tambor_Rojo.png');
										$max_width = 100;
										$max_height = 50;
									break;
									//Tambor Verde
									case 5:
										$img_base = imagecreatefrompng('../LIB_assets/img/Tambor_Verde.png');
										$max_width = 100;
										$max_height = 50;
									break;
									//Tambor Rustico
									case 6:
										$img_base = imagecreatefrompng('../LIB_assets/img/Tambor_Rustico.png');
										$max_width = 100;
										$max_height = 50;
									break;
									//Tambor Morado
									case 7:
										$img_base = imagecreatefrompng('../LIB_assets/img/Tambor_Morado.png');
										$max_width = 100;
										$max_height = 50;
									break;
									//Tambor Blanco
									case 8:
										$img_base = imagecreatefrompng('../LIB_assets/img/Tambor_Blanco.png');
										$max_width = 100;
										$max_height = 50;
									break;
									//Tambor Gris
									case 9:
										$img_base = imagecreatefrompng('../LIB_assets/img/Tambor_Gris.png');
										$max_width = 100;
										$max_height = 50;
									break;
									//Tambor Negro
									case 10:
										$img_base = imagecreatefrompng('../LIB_assets/img/Tambor_Negro.png');
										$max_width = 100;
										$max_height = 50;
									break;
									//Cubo Carton 1x1x1
									case 11:
										$img_base = imagecreatefrompng('../LIB_assets/img/caja_carton.png');
										$max_width = 150;
										$max_height = 100;
									break;							
									//Cubo Carton 2x1x1
									case 12:
										$img_base = imagecreatefrompng('../LIB_assets/img/caja_carton.png');
										$max_width = 150;
										$max_height = 100;
									break;
									//Cubo Carton 1x2x1
									case 13:
										$img_base = imagecreatefrompng('../LIB_assets/img/caja_carton.png');
										$max_width = 150;
										$max_height = 100;
									break;
									//Cubo Carton 2x2x1
									case 14:
										$img_base = imagecreatefrompng('../LIB_assets/img/caja_carton.png');
										$max_width = 150;
										$max_height = 100;
									break;
									//Cubo Madera 1x1x1
									case 15:
										$img_base = imagecreatefrompng('../LIB_assets/img/caja_madera.png');
										$max_width = 150;
										$max_height = 100;
									break;						
									//Cubo Madera 2x1x1
									case 16:
										$img_base = imagecreatefrompng('../LIB_assets/img/caja_madera.png');
										$max_width = 150;
										$max_height = 100;
									break;
									//Cubo Madera 1x2x1
									case 17:
										$img_base = imagecreatefrompng('../LIB_assets/img/caja_madera.png');
										$max_width = 150;
										$max_height = 100;
									break;
									//Cubo Madera 2x2x1
									case 18:
										$img_base = imagecreatefrompng('../LIB_assets/img/caja_madera.png');
										$max_width = 150;
										$max_height = 100;
									break;							
									
								}
								imageAlphaBlending($img_base, false);
								imageSaveAlpha($img_base, true);

								//se carga el logo
								switch ($_FILES['Direccion_img']['type']) {
									case 'image/jpg':
										$img_logo = imagecreatefromjpeg('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
										break;
									case 'image/jpeg':
										$img_logo = imagecreatefromjpeg('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
										break;
									case 'image/gif':
										$img_logo = imagecreatefromgif('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
										break;
									case 'image/png':
										$img_logo = imagecreatefrompng('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
										break;
								}
								//Obtengo los tamaños de las imagenes
								$img_base_width   = imageSX($img_base);
								$img_base_height  = imageSY($img_base);
								$img_logo_width   = imageSX($img_logo);
								$img_logo_height  = imageSY($img_logo);
								
								//se reescala la imagen en caso de ser necesario
								if ($img_logo_width > $img_logo_height) {
									if($img_logo_width < $max_width){
										$newwidth = $img_logo_width;
									}else{
										$newwidth = $max_width;	
									}
									$divisor = $img_logo_width / $newwidth;
									$newheight = floor( $img_logo_height / $divisor);
								}else {
									if($img_logo_height < $max_height){
										$newheight = $img_logo_height;
									}else{
										$newheight =  $max_height;
									} 
									$divisor = $img_logo_height / $newheight;
									$newwidth = floor( $img_logo_width / $divisor );
								}

								$img_logo = imagescale($img_logo, $newwidth, $newheight);
								
								//se posiciona la imagen
								switch ($idTipoImagen) {
									
									//Tambor
									case 2:
									case 3:
									case 4:
									case 5:
									case 6:
									case 7:
									case 8:
									case 9:
									case 10:
										$dest_x = ( $img_base_width / 2 ) - ( $img_logo_width / 2 );
										$dest_y = 73;						
									break;

									//Cubo Carton 1x1x1
									case 11:
										$dest_x = ( $img_base_width / 2 ) - ( $img_logo_width / 2 );
										$dest_y = ( $img_base_height / 2 ) - ( $img_logo_height / 2 );
									break;
																	
									//Cubo Carton 2x1x1
									case 12:
										$dest_x = ( $img_base_width / 2 ) - ( $img_logo_width / 2 );
										$dest_y = ( $img_base_height / 2 ) - ( $img_logo_height / 2 );
									break;
									
									//Cubo Carton 1x2x1
									case 13:
										$dest_x = ( $img_base_width / 2 ) - ( $img_logo_width / 2 );
										$dest_y = ( $img_base_height / 2 ) - ( $img_logo_height / 2 );
									break;
									
									//Cubo Carton 2x2x1
									case 14:
										$dest_x = ( $img_base_width / 2 ) - ( $img_logo_width / 2 );
										$dest_y = ( $img_base_height / 2 ) - ( $img_logo_height / 2 );
									break;
									
									//Cubo Madera 1x1x1
									case 15:
										$dest_x = ( $img_base_width / 2 ) - ( $img_logo_width / 2 );
										$dest_y = ( $img_base_height / 2 ) - ( $img_logo_height / 2 );
									break;
																	
									//Cubo Madera 2x1x1
									case 16:
										$dest_x = ( $img_base_width / 2 ) - ( $img_logo_width / 2 );
										$dest_y = ( $img_base_height / 2 ) - ( $img_logo_height / 2 );
									break;
									
									//Cubo Madera 1x2x1
									case 17:
										$dest_x = ( $img_base_width / 2 ) - ( $img_logo_width / 2 );
										$dest_y = ( $img_base_height / 2 ) - ( $img_logo_height / 2 );
									break;
									
									//Cubo Madera 2x2x1
									case 18:
										$dest_x = ( $img_base_width / 2 ) - ( $img_logo_width / 2 );
										$dest_y = ( $img_base_height / 2 ) - ( $img_logo_height / 2 );
									break;							
									
								}

								//se crea la imagen 
								imagecopymerge($img_base, $img_logo, $dest_x, $dest_y, 0, 0, $max_width, $max_height, 100);
								//se combina la imagen
								imagepng($img_base, $ruta);
								//se elimina la imagen logo
								try {
									if(!is_writable('upload/xxxsxx_'.$_FILES['Direccion_img']['name'])){
										//throw new Exception('File not writable');
									}else{
										unlink('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
									}
								}catch(Exception $e) { 
									//guardar el dato en un archivo log
								}
								
								//se eliminan las imagenes de la memoria
								imagedestroy($img_base);
								imagedestroy($img_logo);
							}
							
							
						}else{
							//Se mueve el archivo a la carpeta previamente configurada
							//$move_result = @move_uploaded_file($_FILES["Direccion_img"]["tmp_name"], $ruta);
							//Muevo el archivo
							$move_result = @move_uploaded_file($_FILES["Direccion_img"]["tmp_name"], "upload/xxxsxx_".$_FILES['Direccion_img']['name']);
							if ($move_result){
								//se selecciona la imagen
								switch ($_FILES['Direccion_img']['type']) {
									case 'image/jpg':
										$imgBase = imagecreatefromjpeg('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
										break;
									case 'image/jpeg':
										$imgBase = imagecreatefromjpeg('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
										break;
									case 'image/gif':
										$imgBase = imagecreatefromgif('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
										break;
									case 'image/png':
										$imgBase = imagecreatefrompng('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
										break;
								}
								
								//se reescala la imagen en caso de ser necesario
								$imgBase_width = imagesx( $imgBase );
								$imgBase_height = imagesy( $imgBase );
								
								//Se establece el tamaño maximo
								$max_width  = 640;
								$max_height = 640;

								if ($imgBase_width > $imgBase_height) {
									if($imgBase_width < $max_width){
										$newwidth = $imgBase_width;
									}else{
										$newwidth = $max_width;	
									}
									$divisor = $imgBase_width / $newwidth;
									$newheight = floor( $imgBase_height / $divisor);
								}else {
									if($imgBase_height < $max_height){
										$newheight = $imgBase_height;
									}else{
										$newheight =  $max_height;
									} 
									$divisor = $imgBase_height / $newheight;
									$newwidth = floor( $imgBase_width / $divisor );
								}

								$imgBase = imagescale($imgBase, $newwidth, $newheight);

								//se establece la calidad del archivo
								$quality = 75;
								
								//se crea la imagen
								imagejpeg($imgBase, $ruta, $quality);
								
								//se elimina la imagen base
								try {
									if(!is_writable('upload/xxxsxx_'.$_FILES['Direccion_img']['name'])){
										//throw new Exception('File not writable');
									}else{
										unlink('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
									}
								}catch(Exception $e) { 
									//guardar el dato en un archivo log
								}
								//se eliminan las imagenes de la memoria
								imagedestroy($imgBase);
							}
							
						}
						
						$result=1;

						if ($result==1){
								
							//Filtro para idSistema		
							$a = "Direccion_img='".$sufijo.$_FILES['Direccion_img']['name']."'" ;
							if(isset($idTipoImagen) && $idTipoImagen != ''){       $a .= ",idTipoImagen='".$idTipoImagen."'" ;}
							
							// inserto los datos de registro en la db
							$query  = "UPDATE `insumos_listado` SET ".$a." WHERE idProducto = '$idProducto'";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if($resultado){
								
								header( 'Location: '.$location.'&img_id='.$idProducto );
								die;
								
							//si da error, guardar en el log de errores una copia
							}else{
								//Genero numero aleatorio
								$vardata = genera_password(8,'alfanumerico');
								
								//Guardo el error en una variable temporal
								$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
								$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
								$_SESSION['ErrorListing'][$vardata]['query']        = $query;
								
							}
								
						} else {
							$error['Direccion_img']       = 'error/Ocurrio un error al mover el archivo';
						}
					} else {
						$error['Direccion_img']       = 'error/El archivo '.$_FILES['Direccion_img']['name'].' ya existe';
					}
				} else {
					$error['Direccion_img']       = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
				}
			}

		break;
/*******************************************************************************************************************/
		case 'submit_file':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ($_FILES["FichaTecnica"]["error"] > 0){
				$error['FichaTecnica']       = 'error/Ha ocurrido un error';
			} else {
				//Se verifican las extensiones de los archivos
				$permitidos = array("application/pdf", "application/octet-stream", "application/x-real", "application/vnd.adobe.xfdf", "application/vnd.fdf", "binary/octet-stream");
				//Se verifica que el archivo subido no exceda los 100 kb
				$limite_kb = 10000;
				//Sufijo
				$sufijo = 'ins_file_'.$idProducto.'_';
				  
				if (in_array($_FILES['FichaTecnica']['type'], $permitidos) && $_FILES['FichaTecnica']['size'] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['FichaTecnica']['name'];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (!file_exists($ruta)){
						//Se mueve el archivo a la carpeta previamente configurada
						$move_result = @move_uploaded_file($_FILES["FichaTecnica"]["tmp_name"], $ruta);
						if ($move_result){
								
							//Filtro para idSistema		
							$a = "FichaTecnica='".$sufijo.$_FILES['FichaTecnica']['name']."'" ;

							// inserto los datos de registro en la db
							$query  = "UPDATE `insumos_listado` SET ".$a." WHERE idProducto = '$idProducto'";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if($resultado){
								
								header( 'Location: '.$location );
								die;
								
							//si da error, guardar en el log de errores una copia
							}else{
								//Genero numero aleatorio
								$vardata = genera_password(8,'alfanumerico');
								
								//Guardo el error en una variable temporal
								$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
								$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
								$_SESSION['ErrorListing'][$vardata]['query']        = $query;
								
							}
									
						} else {
							$error['FichaTecnica']       = 'error/Ocurrio un error al mover el archivo';
						}
					} else {
						$error['FichaTecnica']       = 'error/El archivo '.$_FILES['FichaTecnica']['name'].' ya existe';
					}
				} else {
					$error['FichaTecnica']       = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
				}
			}

		break;
/*******************************************************************************************************************/
		case 'submit_hds':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ($_FILES["HDS"]["error"] > 0){
				$error['HDS']       = 'error/Ha ocurrido un error';
			} else {
				//Se verifican las extensiones de los archivos
				$permitidos = array("application/pdf", "application/octet-stream", "application/x-real", "application/vnd.adobe.xfdf", "application/vnd.fdf", "binary/octet-stream");
				//Se verifica que el archivo subido no exceda los 100 kb
				$limite_kb = 10000;
				//Sufijo
				$sufijo = 'ins_hds_'.$idProducto.'_';
				  
				if (in_array($_FILES['HDS']['type'], $permitidos) && $_FILES['HDS']['size'] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['HDS']['name'];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (!file_exists($ruta)){
						//Se mueve el archivo a la carpeta previamente configurada
						$move_result = @move_uploaded_file($_FILES["HDS"]["tmp_name"], $ruta);
						if ($move_result){
								
							//Filtro para idSistema		
							$a = "HDS='".$sufijo.$_FILES['HDS']['name']."'" ;

							// inserto los datos de registro en la db
							$query  = "UPDATE `insumos_listado` SET ".$a." WHERE idProducto = '$idProducto'";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if($resultado){
								
								header( 'Location: '.$location );
								die;
								
							//si da error, guardar en el log de errores una copia
							}else{
								//Genero numero aleatorio
								$vardata = genera_password(8,'alfanumerico');
								
								//Guardo el error en una variable temporal
								$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
								$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
								$_SESSION['ErrorListing'][$vardata]['query']        = $query;
								
							}
								
						} else {
							$error['HDS']       = 'error/Ocurrio un error al mover el archivo';
						}
					} else {
						$error['HDS']       = 'error/El archivo '.$_FILES['HDS']['name'].' ya existe';
					}
				} else {
					$error['HDS']       = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
				}
			}

		break;
/*******************************************************************************************************************/
		case 'del_img':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el nombre del logo
			$query = "SELECT Direccion_img
			FROM `insumos_listado`
			WHERE idProducto = {$_GET['del_img']}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//se borra el dato de la base de datos
			$query  = "UPDATE `insumos_listado` SET Direccion_img='', idTipoImagen=0 WHERE idProducto = '{$_GET['del_img']}'";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				//se elimina el archivo
				if(isset($rowdata['Direccion_img'])&&$rowdata['Direccion_img']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['Direccion_img'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['Direccion_img']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
				
				//Redirijo			
				header( 'Location: '.$location.'&id='.$_GET['del_img'] );
				die;
				
			//si da error, guardar en el log de errores una copia
			}else{
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
				
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
				
			}
			

		break;	
/*******************************************************************************************************************/
		case 'del_file':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el nombre del logo
			$query = "SELECT FichaTecnica
			FROM `insumos_listado`
			WHERE idProducto = {$_GET['del_file']}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//se borra el dato de la base de datos
			$query  = "UPDATE `insumos_listado` SET FichaTecnica='' WHERE idProducto = '{$_GET['del_file']}'";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				//se elimina el archivo
				if(isset($rowdata['FichaTecnica'])&&$rowdata['FichaTecnica']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['FichaTecnica'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['FichaTecnica']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
				
				//Redirijo			
				header( 'Location: '.$location.'&id='.$_GET['del_file'] );
				die;
				
			//si da error, guardar en el log de errores una copia
			}else{
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
				
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
				
			}
				

		break;	
/*******************************************************************************************************************/
		case 'del_hds':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el nombre del logo
			$query = "SELECT HDS
			FROM `insumos_listado`
			WHERE idProducto = {$_GET['del_hds']}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//se borra el dato de la base de datos
			$query  = "UPDATE `insumos_listado` SET HDS='' WHERE idProducto = '{$_GET['del_hds']}'";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				//se elimina el archivo
				if(isset($rowdata['HDS'])&&$rowdata['HDS']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['HDS'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['HDS']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
				
				//Redirijo			
				header( 'Location: '.$location.'&id='.$_GET['del_hds'] );
				die;
				
			//si da error, guardar en el log de errores una copia
			}else{
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
				
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
				
			}
					

		break;							
/*******************************************************************************************************************/
		case 'del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el nombre del logo
			$query = "SELECT Direccion_img, FichaTecnica, HDS
			FROM `insumos_listado`
			WHERE idProducto = {$_GET['del']}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//se borra el dato de la base de datos
			$query  = "DELETE FROM `insumos_listado` WHERE idProducto = {$_GET['del']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				//Se elimina la imagen
				if(isset($rowdata['Direccion_img'])&&$rowdata['Direccion_img']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['Direccion_img'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['Direccion_img']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
				//Se elimina el archivo adjunto
				if(isset($rowdata['FichaTecnica'])&&$rowdata['FichaTecnica']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['FichaTecnica'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['FichaTecnica']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
				
				//Se elimina el archivo adjunto
				if(isset($rowdata['HDS'])&&$rowdata['HDS']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['HDS'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['HDS']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
				
				//Redirijo			
				header( 'Location: '.$location.'&deleted=true' );
				die;
				
			//si da error, guardar en el log de errores una copia
			}else{
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
				
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
				
			}
			

		break;							
/*******************************************************************************************************************/
		case 'estado':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$idProducto  = $_GET['id'];
			$estado      = $_GET['estado'];
			$query  = "UPDATE insumos_listado SET idEstado = '$estado'	
			WHERE idProducto    = '$idProducto'";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				header( 'Location: '.$location.'&edited=true' );
				die;
				
			//si da error, guardar en el log de errores una copia
			}else{
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
				
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
				
			}
			


		break;			
/*******************************************************************************************************************/
	}
?>
