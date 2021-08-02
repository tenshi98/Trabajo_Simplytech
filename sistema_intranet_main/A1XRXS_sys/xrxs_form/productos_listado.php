<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
require_once '0_validate_user_1.php';	
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if ( !empty($_POST['idProducto']) )          $idProducto             = $_POST['idProducto'];
	if ( !empty($_POST['idTipo']) )              $idTipo                 = $_POST['idTipo'];
	if ( !empty($_POST['idCategoria']) )         $idCategoria            = $_POST['idCategoria'];
	if ( !empty($_POST['idUml']) )               $idUml                  = $_POST['idUml'];
	if ( !empty($_POST['idTipoProducto']) )      $idTipoProducto         = $_POST['idTipoProducto'];
	if ( !empty($_POST['idTipoReceta']) )        $idTipoReceta           = $_POST['idTipoReceta'];
	if ( !empty($_POST['Nombre']) )              $Nombre                 = $_POST['Nombre'];
	if ( isset($_POST['Marca']) )                $Marca                  = $_POST['Marca'];
	if ( isset($_POST['StockLimite']) )          $StockLimite            = $_POST['StockLimite'];
	if ( isset($_POST['ValorIngreso']) )         $ValorIngreso           = $_POST['ValorIngreso'];
	if ( isset($_POST['ValorEgreso']) )          $ValorEgreso            = $_POST['ValorEgreso'];
	if ( !empty($_POST['Descripcion']) )         $Descripcion            = $_POST['Descripcion'];
	if ( !empty($_POST['Codigo']) )              $Codigo                 = $_POST['Codigo'];
	if ( !empty($_POST['idProveedor']) )         $idProveedor            = $_POST['idProveedor'];
	if ( !empty($_POST['idCliente']) )           $idCliente              = $_POST['idCliente'];
	if ( !empty($_POST['Direccion_img']) )       $Direccion_img          = $_POST['Direccion_img'];
	if ( !empty($_POST['FichaTecnica']) )        $FichaTecnica           = $_POST['FichaTecnica'];
	if ( !empty($_POST['HDS']) )                 $HDS                    = $_POST['HDS'];
	if ( !empty($_POST['idEstado']) )            $idEstado               = $_POST['idEstado'];
	if ( !empty($_POST['idSubTipo']) )           $idSubTipo              = $_POST['idSubTipo'];
	if ( !empty($_POST['idProveedorFijo']) )     $idProveedorFijo        = $_POST['idProveedorFijo'];
	if ( !empty($_POST['idTipoImagen']) )        $idTipoImagen           = $_POST['idTipoImagen'];
	if ( !empty($_POST['idOpciones_1']) )        $idOpciones_1           = $_POST['idOpciones_1'];
	if ( !empty($_POST['idOpciones_2']) )        $idOpciones_2           = $_POST['idOpciones_2'];
	if ( !empty($_POST['idOpciones_3']) )        $idOpciones_3           = $_POST['idOpciones_3'];
	if ( !empty($_POST['idOpciones_4']) )        $idOpciones_4           = $_POST['idOpciones_4'];
	if ( !empty($_POST['idOpciones_5']) )        $idOpciones_5           = $_POST['idOpciones_5'];
	if ( !empty($_POST['idOpciones_6']) )        $idOpciones_6           = $_POST['idOpciones_6'];
	if ( !empty($_POST['idOpciones_7']) )        $idOpciones_7           = $_POST['idOpciones_7'];
	if ( !empty($_POST['idOpciones_8']) )        $idOpciones_8           = $_POST['idOpciones_8'];
	if ( !empty($_POST['idOpciones_9']) )        $idOpciones_9           = $_POST['idOpciones_9'];
	if ( !empty($_POST['idCalidad']) )           $idCalidad              = $_POST['idCalidad'];
	if ( !empty($_POST['IngredienteActivo']) )   $IngredienteActivo      = $_POST['IngredienteActivo'];
	if ( !empty($_POST['Carencia']) )            $Carencia               = $_POST['Carencia'];
	if ( !empty($_POST['DosisRecomendada']) )    $DosisRecomendada       = $_POST['DosisRecomendada'];
	if ( !empty($_POST['EfectoResidual']) )      $EfectoResidual         = $_POST['EfectoResidual'];
	if ( !empty($_POST['EfectoRetroactivo']) )   $EfectoRetroactivo      = $_POST['EfectoRetroactivo'];
	if ( !empty($_POST['CarenciaExportador']) )  $CarenciaExportador     = $_POST['CarenciaExportador'];
	
	if ( !empty($_POST['medida']) )              $medida                 = $_POST['medida'];
	if ( !empty($_POST['Number']) )              $Number                 = $_POST['Number'];
	if ( !empty($_POST['idReceta']) )            $idReceta               = $_POST['idReceta'];
	if ( !empty($_POST['idProductoRel']) )       $idProductoRel          = $_POST['idProductoRel'];
	if ( !empty($_POST['Cantidad']) )            $Cantidad               = $_POST['Cantidad'];
	

/*******************************************************************************************************************/
/*                                      Verificacion de los datos obligatorios                                     */
/*******************************************************************************************************************/

	//limpio y separo los datos de la cadena de comprobacion
	$form_obligatorios = str_replace(' ', '', $_SESSION['form_require']);
	$INT_piezas = explode(",", $form_obligatorios);
	//recorro los elementos
	foreach ($INT_piezas as $INT_valor) {
		//veo si existe el dato solicitado y genero el error
		switch ($INT_valor) {
			case 'idProducto':           if(empty($idProducto)){          $error['idProducto']         = 'error/No ha ingresado el id';}break;
			case 'idTipo':               if(empty($idTipo)){              $error['idTipo']             = 'error/No ha seleccionado el tipo de producto';}break;
			case 'idCategoria':          if(empty($idCategoria)){         $error['idCategoria']        = 'error/No ha seleccionado la categoria del producto';}break;
			case 'idUml':                if(empty($idUml)){               $error['idUml']              = 'error/No ha seleccionado la unidad de medida del producto';}break;
			case 'idTipoProducto':       if(empty($idTipoProducto)){      $error['idTipoProducto']     = 'error/No ha seleccionado el tipo de producto';}break;
			case 'idTipoReceta':         if(empty($idTipoReceta)){        $error['idTipoReceta']       = 'error/No ha seleccionado el tipo de producto';}break;
			case 'Nombre':               if(empty($Nombre)){              $error['Nombre']             = 'error/No ha ingresado el nombre del producto';}break;
			case 'Marca':                if(!isset($Marca)){              $error['Marca']              = 'error/No ha ingresado la marca del producto';}break;
			case 'StockLimite':          if(!isset($StockLimite)){        $error['StockLimite']        = 'error/No ha ingresado el stock minimo del producto';}break;
			case 'ValorIngreso':         if(!isset($ValorIngreso)){       $error['ValorIngreso']       = 'error/No ha ingresado el valor del producto';}break;
			case 'ValorEgreso':          if(!isset($ValorEgreso)){        $error['ValorEgreso']        = 'error/No ha ingresado el valor del producto';}break;
			case 'Descripcion':          if(empty($Descripcion)){         $error['Descripcion']        = 'error/No ha ingresado una Descripcion';}break;
			case 'Codigo':               if(empty($Codigo)){              $error['Codigo']             = 'error/No ha ingresado un Codigo';}break;
			case 'idProveedor':          if(empty($idProveedor)){         $error['idProveedor']        = 'error/No ha seleccionado un proveedor';}break;
			case 'idCliente':            if(empty($idCliente)){           $error['idCliente']          = 'error/No ha seleccionado un cliente';}break;
			case 'Direccion_img':        if(empty($Direccion_img)){       $error['Direccion_img']      = 'error/No ha adjuntado una imagen';}break;
			case 'FichaTecnica':         if(empty($FichaTecnica)){        $error['FichaTecnica']       = 'error/No ha adjuntado una ficha tecnica';}break;
			case 'HDS':                  if(empty($HDS)){                 $error['HDS']                = 'error/No ha adjuntado un archivo de seguridad';}break;
			case 'idEstado':             if(empty($idEstado)){            $error['idEstado']           = 'error/No ha ingresado el estado del producto';}break;
			case 'idSubTipo':            if(empty($idSubTipo)){           $error['idSubTipo']          = 'error/No ha ingresado el subtipo';}break;
			case 'idProveedorFijo':      if(empty($idProveedorFijo)){     $error['idProveedorFijo']    = 'error/No ha seleccionado el proveedor';}break;
			case 'idTipoImagen':         if(empty($idTipoImagen)){        $error['idTipoImagen']       = 'error/No ha seleccionado el tipo de imagen';}break;
			case 'idOpciones_1':         if(empty($idOpciones_1)){        $error['idOpciones_1']       = 'error/No ha seleccionado una opcion';}break;
			case 'idOpciones_2':         if(empty($idOpciones_2)){        $error['idOpciones_2']       = 'error/No ha seleccionado una opcion';}break;
			case 'idOpciones_3':         if(empty($idOpciones_3)){        $error['idOpciones_3']       = 'error/No ha seleccionado una opcion';}break;
			case 'idOpciones_4':         if(empty($idOpciones_4)){        $error['idOpciones_4']       = 'error/No ha seleccionado una opcion';}break;
			case 'idOpciones_5':         if(empty($idOpciones_5)){        $error['idOpciones_5']       = 'error/No ha seleccionado una opcion';}break;
			case 'idOpciones_6':         if(empty($idOpciones_6)){        $error['idOpciones_6']       = 'error/No ha seleccionado una opcion';}break;
			case 'idOpciones_7':         if(empty($idOpciones_7)){        $error['idOpciones_7']       = 'error/No ha seleccionado una opcion';}break;
			case 'idOpciones_8':         if(empty($idOpciones_8)){        $error['idOpciones_8']       = 'error/No ha seleccionado una opcion';}break;
			case 'idOpciones_9':         if(empty($idOpciones_9)){        $error['idOpciones_9']       = 'error/No ha seleccionado una opcion';}break;
			case 'idCalidad':            if(empty($idCalidad)){           $error['idCalidad']          = 'error/No ha seleccionado el tipo de planilla de calidad';}break;
			case 'IngredienteActivo':    if(empty($IngredienteActivo)){   $error['IngredienteActivo']  = 'error/No ha seleccionado el tipo de planilla de calidad';}break;
			case 'Carencia':             if(empty($Carencia)){            $error['Carencia']           = 'error/No ha ingresado la Carencia ASOEX';}break;
			case 'DosisRecomendada':     if(empty($DosisRecomendada)){    $error['DosisRecomendada']   = 'error/No ha ingresado la Dosis Recomendada';}break;
			case 'EfectoResidual':       if(empty($EfectoResidual)){      $error['EfectoResidual']     = 'error/No ha ingresado la Carencia TESCO';}break;
			case 'EfectoRetroactivo':    if(empty($EfectoRetroactivo)){   $error['EfectoRetroactivo']  = 'error/No ha ingresado el Tiempo Re-Ingreso';}break;
			case 'CarenciaExportador':   if(empty($CarenciaExportador)){  $error['CarenciaExportador'] = 'error/No ha ingresado la Carencia Etiqueta';}break;
			
			
			case 'medida':               if(empty($medida)){              $error['medida']             = 'error/No ha ingresado la medida';}break;
			case 'Number':               if(empty($Number)){              $error['Number']             = 'error/No ha ingresado el numero';}break;
			case 'idReceta':             if(empty($idReceta)){            $error['idReceta']           = 'error/No ha seleccionado la receta';}break;
			case 'idProductoRel':        if(empty($idProductoRel)){       $error['idProductoRel']      = 'error/No ha seleccionado el producto relacionado';}break;
			case 'Cantidad':             if(empty($Cantidad)){            $error['Cantidad']           = 'error/No ha ingresado el estado del producto';}break;
			
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){                          $error['Nombre']              = 'error/Edita Nombre, contiene palabras no permitidas'; }	
	if(isset($Marca)&&contar_palabras_censuradas($Marca)!=0){                            $error['Marca']               = 'error/Edita la Marca, contiene palabras no permitidas'; }	
	if(isset($Descripcion)&&contar_palabras_censuradas($Descripcion)!=0){                $error['Descripcion']         = 'error/Edita la Descripcion, contiene palabras no permitidas'; }	
	if(isset($Codigo)&&contar_palabras_censuradas($Codigo)!=0){                          $error['Codigo']              = 'error/Edita Codigo, contiene palabras no permitidas'; }	
	if(isset($IngredienteActivo)&&contar_palabras_censuradas($IngredienteActivo)!=0){    $error['IngredienteActivo']   = 'error/Edita Ingrediente Activo, contiene palabras no permitidas'; }	
	if(isset($Carencia)&&contar_palabras_censuradas($Carencia)!=0){                      $error['Carencia']            = 'error/Edita la Carencia, contiene palabras no permitidas'; }	
	if(isset($DosisRecomendada)&&contar_palabras_censuradas($DosisRecomendada)!=0){      $error['DosisRecomendada']    = 'error/Edita la Dosis Recomendada, contiene palabras no permitidas'; }	
	if(isset($EfectoResidual)&&contar_palabras_censuradas($EfectoResidual)!=0){          $error['EfectoResidual']      = 'error/Edita Efecto Residual, contiene palabras no permitidas'; }	
	if(isset($EfectoRetroactivo)&&contar_palabras_censuradas($EfectoRetroactivo)!=0){    $error['EfectoRetroactivo']   = 'error/Edita Efecto Retroactivo, contiene palabras no permitidas'; }	
	if(isset($CarenciaExportador)&&contar_palabras_censuradas($CarenciaExportador)!=0){  $error['CarenciaExportador']  = 'error/Edita Carencia Exportador, contiene palabras no permitidas'; }	
	
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
				$ndata_1 = db_select_nrows (false, 'Nombre', 'productos_listado', '', "Nombre='".$Nombre."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idTipo) && $idTipo != ''){                         $a  = "'".$idTipo."'" ;                }else{$a  ="''";}
				if(isset($idCategoria) && $idCategoria != ''){               $a .= ",'".$idCategoria."'" ;          }else{$a .=",''";}
				if(isset($idUml) && $idUml != ''){                           $a .= ",'".$idUml."'" ;                }else{$a .=",''";}
				if(isset($idTipoProducto) && $idTipoProducto != ''){         $a .= ",'".$idTipoProducto."'" ;       }else{$a .=",''";}
				if(isset($idTipoReceta) && $idTipoReceta != ''){             $a .= ",'".$idTipoReceta."'" ;         }else{$a .=",''";}
				if(isset($Nombre) && $Nombre != ''){                         $a .= ",'".$Nombre."'" ;               }else{$a .=",''";}
				if(isset($Marca) && $Marca != ''){                           $a .= ",'".$Marca."'" ;                }else{$a .=",''";}
				if(isset($StockLimite) && $StockLimite != ''){               $a .= ",'".$StockLimite."'" ;          }else{$a .=",''";}
				if(isset($ValorIngreso) && $ValorIngreso != ''){             $a .= ",'".$ValorIngreso."'" ;         }else{$a .=",''";}
				if(isset($ValorEgreso) && $ValorEgreso != ''){               $a .= ",'".$ValorEgreso."'" ;          }else{$a .=",''";}
				if(isset($Descripcion) && $Descripcion != ''){               $a .= ",'".$Descripcion."'" ;          }else{$a .=",''";}
				if(isset($Codigo) && $Codigo != ''){                         $a .= ",'".$Codigo."'" ;               }else{$a .=",''";}
				if(isset($idProveedor) && $idProveedor != ''){               $a .= ",'".$idProveedor."'" ;          }else{$a .=",''";}
				if(isset($idCliente) && $idCliente != ''){                   $a .= ",'".$idCliente."'" ;            }else{$a .=",''";}
				if(isset($Direccion_img) && $Direccion_img != ''){           $a .= ",'".$Direccion_img."'" ;        }else{$a .=",''";}
				if(isset($FichaTecnica) && $FichaTecnica != ''){             $a .= ",'".$FichaTecnica."'" ;         }else{$a .=",''";}
				if(isset($HDS) && $HDS != ''){                               $a .= ",'".$HDS."'" ;                  }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){                     $a .= ",'".$idEstado."'" ;             }else{$a .=",''";}
				if(isset($idSubTipo) && $idSubTipo != ''){                   $a .= ",'".$idSubTipo."'" ;            }else{$a .=",''";}
				if(isset($idProveedorFijo) && $idProveedorFijo != ''){       $a .= ",'".$idProveedorFijo."'" ;      }else{$a .=",''";}
				if(isset($idTipoImagen) && $idTipoImagen != ''){             $a .= ",'".$idTipoImagen."'" ;         }else{$a .=",''";}
				if(isset($idCalidad) && $idCalidad != ''){                   $a .= ",'".$idCalidad."'" ;            }else{$a .=",''";}
				if(isset($idOpciones_1) && $idOpciones_1 != ''){             $a .= ",'".$idOpciones_1."'" ;         }else{$a .=",''";}
				if(isset($idOpciones_2) && $idOpciones_2 != ''){             $a .= ",'".$idOpciones_2."'" ;         }else{$a .=",''";}
				if(isset($idOpciones_3) && $idOpciones_3 != ''){             $a .= ",'".$idOpciones_3."'" ;         }else{$a .=",''";}
				if(isset($idOpciones_4) && $idOpciones_4 != ''){             $a .= ",'".$idOpciones_4."'" ;         }else{$a .=",''";}
				if(isset($idOpciones_5) && $idOpciones_5 != ''){             $a .= ",'".$idOpciones_5."'" ;         }else{$a .=",''";}
				if(isset($idOpciones_6) && $idOpciones_6 != ''){             $a .= ",'".$idOpciones_6."'" ;         }else{$a .=",''";}
				if(isset($idOpciones_7) && $idOpciones_7 != ''){             $a .= ",'".$idOpciones_7."'" ;         }else{$a .=",''";}
				if(isset($idOpciones_8) && $idOpciones_8 != ''){             $a .= ",'".$idOpciones_8."'" ;         }else{$a .=",''";}
				if(isset($idOpciones_9) && $idOpciones_9 != ''){             $a .= ",'".$idOpciones_9."'" ;         }else{$a .=",''";}
				if(isset($IngredienteActivo) && $IngredienteActivo != ''){   $a .= ",'".$IngredienteActivo."'" ;    }else{$a .=",''";}
				if(isset($Carencia) && $Carencia != ''){                     $a .= ",'".$Carencia."'" ;             }else{$a .=",''";}
				if(isset($DosisRecomendada) && $DosisRecomendada != ''){     $a .= ",'".$DosisRecomendada."'" ;     }else{$a .=",''";}
				if(isset($EfectoResidual) && $EfectoResidual != ''){         $a .= ",'".$EfectoResidual."'" ;       }else{$a .=",''";}
				if(isset($EfectoRetroactivo) && $EfectoRetroactivo != ''){   $a .= ",'".$EfectoRetroactivo."'" ;    }else{$a .=",''";}
				if(isset($CarenciaExportador) && $CarenciaExportador != ''){ $a .= ",'".$CarenciaExportador."'" ;   }else{$a .=",''";}
						
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `productos_listado` (idTipo,idCategoria,idUml,idTipoProducto,idTipoReceta,Nombre,
				Marca,StockLimite,ValorIngreso,ValorEgreso,Descripcion,Codigo,idProveedor,idCliente, Direccion_img,
				FichaTecnica,HDS, idEstado, idSubTipo, idProveedorFijo, idTipoImagen, idCalidad,
				idOpciones_1, idOpciones_2, idOpciones_3, idOpciones_4, idOpciones_5, idOpciones_6, idOpciones_7, 
				idOpciones_8, idOpciones_9, IngredienteActivo, Carencia, DosisRecomendada, EfectoResidual,
				EfectoRetroactivo, CarenciaExportador ) 
				VALUES (".$a.")";
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
				$ndata_1 = db_select_nrows (false, 'Nombre', 'productos_listado', '', "Nombre='".$Nombre."' AND idProducto!='".$idProducto."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				$a = "idProducto='".$idProducto."'" ;
				if(isset($idTipo) && $idTipo != ''){                          $a .= ",idTipo='".$idTipo."'" ;}
				if(isset($idCategoria) && $idCategoria != ''){                $a .= ",idCategoria='".$idCategoria."'" ;}
				if(isset($idUml) && $idUml != ''){                            $a .= ",idUml='".$idUml."'" ;}
				if(isset($idTipoProducto) && $idTipoProducto != ''){          $a .= ",idTipoProducto='".$idTipoProducto."'" ;}
				if(isset($idTipoReceta) && $idTipoReceta != ''){              $a .= ",idTipoReceta='".$idTipoReceta."'" ;}
				if(isset($Nombre) && $Nombre != ''){                          $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Marca)){                                            $a .= ",Marca='".$Marca."'" ;}
				if(isset($StockLimite) && $StockLimite != ''){                $a .= ",StockLimite='".$StockLimite."'" ;}
				if(isset($ValorIngreso) && $ValorIngreso != ''){              $a .= ",ValorIngreso='".$ValorIngreso."'" ;}
				if(isset($ValorEgreso) && $ValorEgreso != ''){                $a .= ",ValorEgreso='".$ValorEgreso."'" ;}
				if(isset($Descripcion) && $Descripcion != ''){                $a .= ",Descripcion='".$Descripcion."'" ;}
				if(isset($Codigo) && $Codigo != ''){                          $a .= ",Codigo='".$Codigo."'" ;}
				if(isset($idProveedor) && $idProveedor != ''){                $a .= ",idProveedor='".$idProveedor."'" ;}
				if(isset($idCliente) && $idCliente != ''){                    $a .= ",idCliente='".$idCliente."'" ;}
				if(isset($Direccion_img) && $Direccion_img != ''){            $a .= ",Direccion_img='".$Direccion_img."'" ;}
				if(isset($FichaTecnica) && $FichaTecnica != ''){              $a .= ",FichaTecnica='".$FichaTecnica."'" ;}
				if(isset($HDS) && $HDS != ''){                                $a .= ",HDS='".$HDS."'" ;}
				if(isset($idEstado) && $idEstado != ''){                      $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idSubTipo) && $idSubTipo != ''){                    $a .= ",idSubTipo='".$idSubTipo."'" ;}
				if(isset($idProveedorFijo) && $idProveedorFijo != ''){        $a .= ",idProveedorFijo='".$idProveedorFijo."'" ;}
				if(isset($idTipoImagen) && $idTipoImagen != ''){              $a .= ",idTipoImagen='".$idTipoImagen."'" ;}
				if(isset($idCalidad) && $idCalidad != ''){                    $a .= ",idCalidad='".$idCalidad."'" ;}
				if(isset($idOpciones_1) && $idOpciones_1 != ''){              $a .= ",idOpciones_1='".$idOpciones_1."'" ;}
				if(isset($idOpciones_2) && $idOpciones_2 != ''){              $a .= ",idOpciones_2='".$idOpciones_2."'" ;}
				if(isset($idOpciones_3) && $idOpciones_3 != ''){              $a .= ",idOpciones_3='".$idOpciones_3."'" ;}
				if(isset($idOpciones_4) && $idOpciones_4 != ''){              $a .= ",idOpciones_4='".$idOpciones_4."'" ;}
				if(isset($idOpciones_5) && $idOpciones_5 != ''){              $a .= ",idOpciones_5='".$idOpciones_5."'" ;}
				if(isset($idOpciones_6) && $idOpciones_6 != ''){              $a .= ",idOpciones_6='".$idOpciones_6."'" ;}
				if(isset($idOpciones_7) && $idOpciones_7 != ''){              $a .= ",idOpciones_7='".$idOpciones_7."'" ;}
				if(isset($idOpciones_8) && $idOpciones_8 != ''){              $a .= ",idOpciones_8='".$idOpciones_8."'" ;}
				if(isset($idOpciones_9) && $idOpciones_9 != ''){              $a .= ",idOpciones_9='".$idOpciones_9."'" ;}
				if(isset($IngredienteActivo) && $IngredienteActivo != ''){    $a .= ",IngredienteActivo='".$IngredienteActivo."'" ;}
				if(isset($Carencia) && $Carencia != ''){                      $a .= ",Carencia='".$Carencia."'" ;}
				if(isset($DosisRecomendada) && $DosisRecomendada != ''){      $a .= ",DosisRecomendada='".$DosisRecomendada."'" ;}
				if(isset($EfectoResidual) && $EfectoResidual != ''){          $a .= ",EfectoResidual='".$EfectoResidual."'" ;}
				if(isset($EfectoRetroactivo) && $EfectoRetroactivo != ''){    $a .= ",EfectoRetroactivo='".$EfectoRetroactivo."'" ;}
				if(isset($CarenciaExportador) && $CarenciaExportador != ''){  $a .= ",CarenciaExportador='".$CarenciaExportador."'" ;}
											
					
				// inserto los datos de registro en la db
				$query  = "UPDATE `productos_listado` SET ".$a." WHERE idProducto = '$idProducto'";
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
				$error['Direccion_img'] = 'error/'.uploadPHPError($_FILES["Direccion_img"]["error"]);
			} else {
				//Se verifican las extensiones de los archivos
				$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
				//Se verifica que el archivo subido no exceda los 100 kb
				$limite_kb = 1000;
				//Sufijo
				$sufijo = 'prod_img_'.$idProducto.'_';
				  
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
							$query  = "UPDATE `productos_listado` SET ".$a." WHERE idProducto = '$idProducto'";
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
				$error['FichaTecnica'] = 'error/'.uploadPHPError($_FILES["FichaTecnica"]["error"]);
			} else {
				//Se verifican las extensiones de los archivos
				$permitidos = array("application/pdf", "application/octet-stream", "application/x-real", "application/vnd.adobe.xfdf", "application/vnd.fdf", "binary/octet-stream");
				//Se verifica que el archivo subido no exceda los 100 kb
				$limite_kb = 10000;
				//Sufijo
				$sufijo = 'prod_file_'.$idProducto.'_';
				  
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
							$query  = "UPDATE `productos_listado` SET ".$a." WHERE idProducto = '$idProducto'";
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
				$error['HDS'] = 'error/'.uploadPHPError($_FILES["HDS"]["error"]);
			} else {
				//Se verifican las extensiones de los archivos
				$permitidos = array("application/pdf", "application/octet-stream", "application/x-real", "application/vnd.adobe.xfdf", "application/vnd.fdf", "binary/octet-stream");
				//Se verifica que el archivo subido no exceda los 100 kb
				$limite_kb = 10000;
				//Sufijo
				$sufijo = 'prod_hds_'.$idProducto.'_';
				  
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
							$query  = "UPDATE `productos_listado` SET ".$a." WHERE idProducto = '$idProducto'";
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
			$rowdata = db_select_data (false, 'Direccion_img', 'productos_listado', '', 'idProducto = "'.$_GET['del_img'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
			//se borra el dato de la base de datos
			$query  = "UPDATE `productos_listado` SET Direccion_img='', idTipoImagen=0 WHERE idProducto = '".$_GET['del_img']."'";
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
			$rowdata = db_select_data (false, 'FichaTecnica', 'productos_listado', '', 'idProducto = "'.$_GET['del_file'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			
			//se borra el dato de la base de datos
			$query  = "UPDATE `productos_listado` SET FichaTecnica='' WHERE idProducto = '".$_GET['del_file']."'";
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
			$rowdata = db_select_data (false, 'HDS', 'productos_listado', '', 'idProducto = "'.$_GET['del_hds'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			
			//se borra el dato de la base de datos
			$query  = "UPDATE `productos_listado` SET HDS='' WHERE idProducto = '".$_GET['del_hds']."'";
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
			
			//Variable
			$errorn = 0;
			
			//verifico si se envia un entero
			if((!validarNumero($_GET['del']) OR !validaEntero($_GET['del']))&&$_GET['del']!=''){
				$indice = simpleDecode($_GET['del'], fecha_actual());
			}else{
				$indice = $_GET['del'];
				//guardo el log
				php_error_log($_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo, '', 'Indice no codificado', '' );
				
			}
			
			//se verifica si es un numero lo que se recibe
			if (!validarNumero($indice)&&$indice!=''){ 
				$error['validarNumero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opcion DEL  no es un numero';
				$errorn++;
			}
			//Verifica si el numero recibido es un entero
			if (!validaEntero($indice)&&$indice!=''){ 
				$error['validaEntero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opcion DEL  no es un numero entero';
				$errorn++;
			}
			
			if($errorn==0){
				// Se obtiene el nombre del logo
				$rowdata = db_select_data (false, 'Direccion_img, FichaTecnica, HDS', 'productos_listado', '', 'idProducto = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
				//se borran los datos
				$resultado = db_delete_data (false, 'productos_listado', 'idProducto = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
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
					
					//redirijo
					header( 'Location: '.$location.'&deleted=true' );
					die;
					
				}
			}else{
				//se valida hackeo
				require_once '0_hacking_1.php';
			}
			
			

		break;							
/*******************************************************************************************************************/		
		case 'new_receta_1':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['receta']);
				unset($_SESSION['receta_productos']);
				
				//Guardo los datos
				$_SESSION['receta']['medida']      = $medida;
				$_SESSION['receta']['idProducto']  = $idProducto;
				
					
				//Redirijo			
				header( 'Location: '.$location.'&new2=true' );
				die;
			}
		break;	
		
		
/*******************************************************************************************************************/		
		case 'new_prod_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['receta_productos'][$idProducto])&&$_SESSION['receta_productos'][$idProducto]>0){
				$error['productos'] = 'error/El producto que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['receta_productos'][$idProducto]['idProducto']   = $idProducto;
				$_SESSION['receta_productos'][$idProducto]['Number']       = $Number;
				
				header( 'Location: '.$location.'&new2=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['receta_productos'][$idProducto]['idProducto']   = $idProducto;
				$_SESSION['receta_productos'][$idProducto]['Number']       = $Number;
				
				header( 'Location: '.$location.'&new2=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['receta_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&new2=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'finalizar':		
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$idProducto = $_SESSION['receta']['idProducto'];
				//recorro los datos
				foreach ($_SESSION['receta_productos'] as $key => $producto){
				
					//filtros
					if(isset($idProducto) && $idProducto != ''){                          $a  = "'".$idProducto."'" ;               }else{$a  ="''";}
					if(isset($producto['idProducto']) && $producto['idProducto'] != ''){  $a .= ",'".$producto['idProducto']."'" ;  }else{$a .= ",''";}
					if(isset($producto['Number']) && $producto['Number'] != ''){          
						$a .= ",'".($producto['Number']/$_SESSION['receta']['medida'])."'" ;      
					}else{
						$a .= ",''";
					}
					
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `productos_recetas` (idProducto, idProductoRel, Cantidad)VALUES (".$a.")";
					//Consulta
					$resultado = mysqli_query ($dbConn, $query);
					//Si ejecuto correctamente la consulta
					if(!$resultado){
						//Genero numero aleatorio
						$vardata = genera_password(8,'alfanumerico');
						
						//Guardo el error en una variable temporal
						$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
						$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
						$_SESSION['ErrorListing'][$vardata]['query']        = $query;
						
					}
					
				}
				
				//Borro todas las sesiones
				unset($_SESSION['receta']);
				unset($_SESSION['receta_productos']);
				
				header( 'Location: '.$location.'&created=true' );
				die;
				
			}
		
		break;	
		

/*******************************************************************************************************************/
		case 'del_receta':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variable
			$errorn = 0;
			
			//verifico si se envia un entero
			if((!validarNumero($_GET['del_receta']) OR !validaEntero($_GET['del_receta']))&&$_GET['del_receta']!=''){
				$indice = simpleDecode($_GET['del_receta'], fecha_actual());
			}else{
				$indice = $_GET['del_receta'];
				//guardo el log
				php_error_log($_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo, '', 'Indice no codificado', '' );
				
			}
			
			//se verifica si es un numero lo que se recibe
			if (!validarNumero($indice)&&$indice!=''){ 
				$error['validarNumero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opcion DEL  no es un numero';
				$errorn++;
			}
			//Verifica si el numero recibido es un entero
			if (!validaEntero($indice)&&$indice!=''){ 
				$error['validaEntero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opcion DEL  no es un numero entero';
				$errorn++;
			}
			
			if($errorn==0){
				//se borran los datos
				$resultado = db_delete_data (false, 'productos_recetas', 'idReceta = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					//redirijo
					header( 'Location: '.$location.'&deleted=true' );
					die;
					
				}
			}else{
				//se valida hackeo
				require_once '0_hacking_1.php';
			}
			
			
		
			
		break;	
/*******************************************************************************************************************/
		case 'estado':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$idProducto  = $_GET['id'];
			$idEstado    = simpleDecode($_GET['estado'], fecha_actual());
			$query  = "UPDATE productos_listado SET idEstado = '".$idEstado."'	
			WHERE idProducto = '".$idProducto."'";
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
		case 'insert_receta':		
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idProducto) && $idProducto != ''){        $a  = "'".$idProducto."'" ;      }else{$a  ="''";}
				if(isset($idProductoRel) && $idProductoRel != ''){  $a .= ",'".$idProductoRel."'" ;  }else{$a .= ",''";}
				if(isset($Cantidad) && $Cantidad != ''){            $a .= ",'".($Cantidad)."'" ;     }else{$a .= ",''";}
					
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `productos_recetas` (idProducto, idProductoRel, Cantidad)VALUES (".$a.")";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&created=true' );
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
		case 'update_receta':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				$a = "idReceta='".$idReceta."'" ;
				if(isset($idProductoRel) && $idProductoRel != ''){   $a .= ",idProductoRel='".$idProductoRel."'" ;}
				if(isset($Cantidad) && $Cantidad != ''){             $a .= ",Cantidad='".$Cantidad."'" ;}
											
					
				// inserto los datos de registro en la db
				$query  = "UPDATE `productos_recetas` SET ".$a." WHERE idReceta = '$idReceta'";
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
		case 'update_prod_ing':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			//Se verifica que el total de la receta sea inferior a 1
			if(isset($idProducto)&&isset($idProductoRel)){
				$rowData = db_select_data (false, 'SUM(Cantidad) AS Total', 'productos_recetas', '', "idProducto='".$idProducto."' AND idProductoRel!='".$idProductoRel."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Sumo la cantidad de la receta mas la nueva cantidad
				$ndata_1 = $rowData['Total'] + $Number;
			}
			//Se verifica que el producto no este repetido
			if(isset($idProducto)&&isset($idProductoRel)){
				$ndata_2 = db_select_nrows (false, 'idProducto', 'productos_recetas', '', "idProducto='".$idProducto."' AND idProductoRel='".$idProductoRel."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 1) {$error['ndata_1'] = 'error/El total de la receta no puede ser igual o superior a 1 ('.$ndata_1.' actual)';}
			//if($ndata_2 > 0) {$error['ndata_1'] = 'error/El producto ya existe en la receta';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				$a = "idReceta='".$idReceta."'" ;
				if(isset($idProductoRel) && $idProductoRel != ''){   $a .= ",idProductoRel='".$idProductoRel."'" ;}
				if(isset($Number) && $Number != ''){                 $a .= ",Cantidad='".$Number."'" ;}
											
					
				// inserto los datos de registro en la db
				$query  = "UPDATE `productos_recetas` SET ".$a." WHERE idReceta = '$idReceta'";
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
		case 'update_prod_ing_new':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			//Se verifica que el total de la receta sea inferior a 1
			if(isset($idProducto)&&isset($idProductoRel)){
				$rowData = db_select_data (false, 'SUM(Cantidad) AS Total', 'productos_recetas', '', "idProducto='".$idProducto."' AND idProductoRel!='".$idProductoRel."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Sumo la cantidad de la receta mas la nueva cantidad
				$ndata_1 = $rowData['Total'] + $Number;
			}
			//Se verifica que el producto no este repetido
			if(isset($idProducto)&&isset($idProductoRel)){
				$ndata_2 = db_select_nrows (false, 'idProducto', 'productos_recetas', '', "idProducto='".$idProducto."' AND idProductoRel='".$idProductoRel."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 1) {$error['ndata_1'] = 'error/El total de la receta no puede ser igual o superior a 1 ('.$ndata_1.' actual)';}
			if($ndata_2 > 0) {$error['ndata_1'] = 'error/El producto ya existe en la receta';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				if(isset($idProducto) && $idProducto != ''){        $a  = "'".$idProducto."'" ;      }else{$a  ="''";}
				if(isset($idProductoRel) && $idProductoRel != ''){  $a .= ",'".$idProductoRel."'" ;  }else{$a .= ",''";}
				if(isset($Number) && $Number != ''){                $a .= ",'".$Number."'" ;         }else{$a .= ",''";}
					
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `productos_recetas` (idProducto, idProductoRel, Cantidad)VALUES (".$a.")";
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
	}
?>
