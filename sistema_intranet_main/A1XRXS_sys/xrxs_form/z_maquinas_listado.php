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

	//Formulario para maquinas
	if ( !empty($_POST['idMaquina']) )            $idMaquina             = $_POST['idMaquina'];
	if ( !empty($_POST['idSistema']) )            $idSistema             = $_POST['idSistema'];
	if ( !empty($_POST['idEstado']) )             $idEstado              = $_POST['idEstado'];
	if ( !empty($_POST['Codigo']) )               $Codigo                = $_POST['Codigo'];
	if ( !empty($_POST['Nombre']) )               $Nombre                = $_POST['Nombre'];
	if ( !empty($_POST['Modelo']) )               $Modelo                = $_POST['Modelo'];
	if ( !empty($_POST['Serie']) )                $Serie                 = $_POST['Serie'];
	if ( !empty($_POST['Fabricante']) )           $Fabricante            = $_POST['Fabricante'];
	if ( !empty($_POST['fincorporacion']) )       $fincorporacion        = $_POST['fincorporacion'];
	if ( !empty($_POST['Descripcion']) )          $Descripcion           = $_POST['Descripcion'];
	if ( !empty($_POST['idConfig_1']) )           $idConfig_1            = $_POST['idConfig_1'];
	if ( !empty($_POST['idConfig_2']) )           $idConfig_2            = $_POST['idConfig_2'];
	if ( !empty($_POST['idConfig_3']) )           $idConfig_3            = $_POST['idConfig_3'];
	if ( !empty($_POST['idUbicacion']) )          $idUbicacion           = $_POST['idUbicacion'];
	if ( !empty($_POST['idUbicacion_lvl_1']) )    $idUbicacion_lvl_1     = $_POST['idUbicacion_lvl_1'];
	if ( !empty($_POST['idUbicacion_lvl_2']) )    $idUbicacion_lvl_2     = $_POST['idUbicacion_lvl_2'];
	if ( !empty($_POST['idUbicacion_lvl_3']) )    $idUbicacion_lvl_3     = $_POST['idUbicacion_lvl_3'];
	if ( !empty($_POST['idUbicacion_lvl_4']) )    $idUbicacion_lvl_4     = $_POST['idUbicacion_lvl_4'];
	if ( !empty($_POST['idUbicacion_lvl_5']) )    $idUbicacion_lvl_5     = $_POST['idUbicacion_lvl_5'];
	if ( !empty($_POST['idCliente']) )            $idCliente             = $_POST['idCliente'];
	if ( !empty($_POST['FakeidCliente']) )        $FakeidCliente         = $_POST['FakeidCliente'];
	
	//formulario para componentes
	if ( !empty($_POST['idUtilizable']) )         $idUtilizable          = $_POST['idUtilizable'];
	if ( isset($_POST['Marca']) )                 $Marca                 = $_POST['Marca'];
	if ( isset($_POST['AnoFab']) )                $AnoFab                = $_POST['AnoFab'];
	if ( isset($_POST['idSubTipo']) )             $idSubTipo             = $_POST['idSubTipo'];
	if ( isset($_POST['Grasa_inicial']) )         $Grasa_inicial         = $_POST['Grasa_inicial'];
	if ( isset($_POST['Grasa_relubricacion']) )   $Grasa_relubricacion   = $_POST['Grasa_relubricacion'];
	if ( isset($_POST['Aceite']) )                $Aceite                = $_POST['Aceite'];
	if ( isset($_POST['Cantidad']) )              $Cantidad              = $_POST['Cantidad'];
	if ( !empty($_POST['idUml']) )                $idUml                 = $_POST['idUml'];
	if ( !empty($_POST['Frecuencia']) )           $Frecuencia            = $_POST['Frecuencia'];
	if ( !empty($_POST['idFrecuencia']) )         $idFrecuencia          = $_POST['idFrecuencia'];
	if ( !empty($_POST['idProducto']) )           $idProducto            = $_POST['idProducto'];
	if ( !empty($_POST['Saf']) )                  $Saf                   = $_POST['Saf'];
	if ( !empty($_POST['Numero']) )               $Numero                = $_POST['Numero'];
	if ( !empty($_POST['lvl']) )                  $lvl                   = $_POST['lvl'];
	if ( !empty($_POST['idLicitacion']) )         $idLicitacion          = $_POST['idLicitacion'];
	if ( !empty($_POST['addTrabajo']) )           $addTrabajo            = $_POST['addTrabajo'];
	
	//formulario para matriz analisis
	if ( !empty($_POST['cantPuntos']) )           $cantPuntos            = $_POST['cantPuntos'];
	if ( !empty($_POST['mod']) )                  $mod                   = $_POST['mod'];
	if ( !empty($_POST['idMatriz']) )             $idMatriz              = $_POST['idMatriz'];
	if ( !empty($_POST['PuntoNombre']) )          $PuntoNombre           = $_POST['PuntoNombre'];
	if ( !empty($_POST['PuntoidTipo']) )          $PuntoidTipo           = $_POST['PuntoidTipo'];
	if ( !empty($_POST['PuntoMedAceptable']) )    $PuntoMedAceptable     = $_POST['PuntoMedAceptable'];
	if ( !empty($_POST['PuntoMedAlerta']) )       $PuntoMedAlerta        = $_POST['PuntoMedAlerta'];
	if ( !empty($_POST['PuntoMedCondenatorio']) ) $PuntoMedCondenatorio  = $_POST['PuntoMedCondenatorio'];
	if ( !empty($_POST['PuntoUniMed']) )          $PuntoUniMed           = $_POST['PuntoUniMed'];
	if ( !empty($_POST['PuntoidGrupo']) )         $PuntoidGrupo          = $_POST['PuntoidGrupo'];
	
	//formulariopara el itemizado
	//Traspaso de valores input a variables
	$idLevel = array();
	if ( !empty($_POST['idLevel_1']) )      $idLevel[1]      = $_POST['idLevel_1'];
	if ( !empty($_POST['idLevel_2']) )      $idLevel[2]      = $_POST['idLevel_2'];
	if ( !empty($_POST['idLevel_3']) )      $idLevel[3]      = $_POST['idLevel_3'];
	if ( !empty($_POST['idLevel_4']) )      $idLevel[4]      = $_POST['idLevel_4'];
	if ( !empty($_POST['idLevel_5']) )      $idLevel[5]      = $_POST['idLevel_5'];
	if ( !empty($_POST['idLevel_6']) )      $idLevel[6]      = $_POST['idLevel_6'];
	if ( !empty($_POST['idLevel_7']) )      $idLevel[7]      = $_POST['idLevel_7'];
	if ( !empty($_POST['idLevel_8']) )      $idLevel[8]      = $_POST['idLevel_8'];
	if ( !empty($_POST['idLevel_9']) )      $idLevel[9]      = $_POST['idLevel_9'];
	if ( !empty($_POST['idLevel_10']) )     $idLevel[10]     = $_POST['idLevel_10'];
	if ( !empty($_POST['idLevel_11']) )     $idLevel[11]     = $_POST['idLevel_11'];
	if ( !empty($_POST['idLevel_12']) )     $idLevel[12]     = $_POST['idLevel_12'];
	if ( !empty($_POST['idLevel_13']) )     $idLevel[13]     = $_POST['idLevel_13'];
	if ( !empty($_POST['idLevel_14']) )     $idLevel[14]     = $_POST['idLevel_14'];
	if ( !empty($_POST['idLevel_15']) )     $idLevel[15]     = $_POST['idLevel_15'];
	if ( !empty($_POST['idLevel_16']) )     $idLevel[16]     = $_POST['idLevel_16'];
	if ( !empty($_POST['idLevel_17']) )     $idLevel[17]     = $_POST['idLevel_17'];
	if ( !empty($_POST['idLevel_18']) )     $idLevel[18]     = $_POST['idLevel_18'];
	if ( !empty($_POST['idLevel_19']) )     $idLevel[19]     = $_POST['idLevel_19'];
	if ( !empty($_POST['idLevel_20']) )     $idLevel[20]     = $_POST['idLevel_20'];
	if ( !empty($_POST['idLevel_21']) )     $idLevel[21]     = $_POST['idLevel_21'];
	if ( !empty($_POST['idLevel_22']) )     $idLevel[22]     = $_POST['idLevel_22'];
	if ( !empty($_POST['idLevel_23']) )     $idLevel[23]     = $_POST['idLevel_23'];
	if ( !empty($_POST['idLevel_24']) )     $idLevel[24]     = $_POST['idLevel_24'];
	if ( !empty($_POST['idLevel_25']) )     $idLevel[25]     = $_POST['idLevel_25'];

	
	
	

	
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
			case 'idMaquina':           if(empty($idMaquina)){            $error['idMaquina']             = 'error/No ha seleccionado la licitacion';}break;
			case 'idSistema':           if(empty($idSistema)){            $error['idSistema']             = 'error/No ha seleccionado el sistema';}break;
			case 'idEstado':            if(empty($idEstado)){             $error['idEstado']              = 'error/No ha seleccionado el estado';}break;
			case 'Codigo':              if(empty($Codigo)){               $error['Codigo']                = 'error/No ha ingresado el codigo';}break;
			case 'Nombre':              if(empty($Nombre)){               $error['Nombre']                = 'error/No ha ingresado el nombre';}break;
			case 'Modelo':              if(empty($Modelo)){               $error['Modelo']                = 'error/No ha ingresado la Fecha de inicio';}break;
			case 'Serie':               if(empty($Serie)){                $error['Serie']                 = 'error/No ha ingresado la Fecha de termino';}break;
			case 'Fabricante':          if(empty($Fabricante)){           $error['Fabricante']            = 'error/No ha ingresado el Fabricante';}break;
			case 'fincorporacion':      if(empty($fincorporacion)){       $error['fincorporacion']        = 'error/No ha seleccionado la bodega de productos';}break;
			case 'Descripcion':         if(empty($Descripcion)){          $error['Descripcion']           = 'error/No ha ingresado la descripcion';}break;
			case 'idConfig_1':          if(empty($idConfig_1)){           $error['idConfig_1']            = 'error/No ha seleccionado la opcion 1';}break;
			case 'idConfig_2':          if(empty($idConfig_2)){           $error['idConfig_2']            = 'error/No ha seleccionado la opcion 2';}break;
			case 'idConfig_3':          if(empty($idConfig_3)){           $error['idConfig_3']            = 'error/No ha seleccionado la opcion 2';}break;
			case 'idUbicacion':         if(empty($idUbicacion)){          $error['idUbicacion']           = 'error/No ha seleccionado la ubicacion';}break;
			case 'idUbicacion_lvl_1':   if(empty($idUbicacion_lvl_1)){    $error['idUbicacion_lvl_1']     = 'error/No ha seleccionado el nivel 1';}break;
			case 'idUbicacion_lvl_2':   if(empty($idUbicacion_lvl_2)){    $error['idUbicacion_lvl_2']     = 'error/No ha seleccionado el nivel 2';}break;
			case 'idUbicacion_lvl_3':   if(empty($idUbicacion_lvl_3)){    $error['idUbicacion_lvl_3']     = 'error/No ha seleccionado el nivel 3';}break;
			case 'idUbicacion_lvl_4':   if(empty($idUbicacion_lvl_4)){    $error['idUbicacion_lvl_4']     = 'error/No ha seleccionado el nivel 4';}break;
			case 'idUbicacion_lvl_5':   if(empty($idUbicacion_lvl_5)){    $error['idUbicacion_lvl_5']     = 'error/No ha seleccionado el nivel 5';}break;
			case 'idCliente':           if(empty($idCliente)){            $error['idCliente']             = 'error/No ha seleccionado el cliente';}break;
			
			case 'idUtilizable':        if(empty($idUtilizable)){         $error['idUtilizable']          = 'error/No ha seleccionado si es utilizable';}break;
			case 'Marca':               if(!isset($Marca)){                $error['Marca']                 = 'error/No ha ingresado la marca';}break;
			case 'AnoFab':              if(!isset($AnoFab)){               $error['AnoFab']                = 'error/No ha ingresado el año de fabricacion';}break;
			case 'idSubTipo':           if(!isset($idSubTipo)){            $error['idSubTipo']             = 'error/No ha seleccionado el tipo';}break;
			case 'Grasa_inicial':       if(!isset($Grasa_inicial)){        $error['Grasa_inicial']         = 'error/No ha ingresado la grasa inicial';}break;
			case 'Grasa_relubricacion': if(!isset($Grasa_relubricacion)){  $error['Grasa_relubricacion']   = 'error/No ha ingresado la grasa de relubricacion';}break;
			case 'Aceite':              if(!isset($Aceite)){               $error['Aceite']                = 'error/No ha ingresado el aceite';}break;
			case 'Cantidad':            if(!isset($Cantidad)){             $error['Cantidad']              = 'error/No ha ingresado la cantidad';}break;
			case 'idUml':               if(empty($idUml)){                $error['idUml']                 = 'error/No ha seleccionado la unidad de medida';}break;
			case 'Frecuencia':          if(empty($Frecuencia)){           $error['Frecuencia']            = 'error/No ha ingresado la frecuencia';}break;
			case 'idFrecuencia':        if(empty($idFrecuencia)){         $error['idFrecuencia']          = 'error/No ha seleccionado la frecuencia';}break;
			case 'idProducto':          if(empty($idProducto)){           $error['idProducto']            = 'error/No ha seleccionado el producto';}break;
			case 'Saf':                 if(empty($Saf)){                  $error['Saf']                   = 'error/No ha ingresado el numero Saf';}break;
			case 'Numero':              if(empty($Numero)){               $error['Numero']                = 'error/No ha ingresado el numero';}break;
			case 'lvl':                 if(empty($lvl)){                  $error['lvl']                   = 'error/No ha ingresado el nivel';}break;
			case 'idLicitacion':        if(empty($idLicitacion)){         $error['idLicitacion']          = 'error/No ha seleccionado la licitacion';}break;
			case 'addTrabajo':          if(empty($addTrabajo)){           $error['addTrabajo']            = 'error/No ha seleccionado el trabajo';}break;
			
			case 'cantPuntos':          if(empty($cantPuntos)){           $error['cantPuntos']            = 'error/No ha ingresado la cantidad de puntos';}break;
			case 'mod':                 if(empty($mod)){                  $error['mod']                   = 'error/No ha ingresado el mod';}break;
			case 'idMatriz':            if(empty($idMatriz)){             $error['idMatriz']              = 'error/No ha ingresado el nombre del punto';}break;
			case 'PuntoNombre':         if(empty($PuntoNombre)){          $error['PuntoNombre']           = 'error/No ha ingresado el nombre del punto';}break;
			case 'PuntoidTipo':         if(empty($PuntoidTipo)){          $error['PuntoidTipo']           = 'error/No ha seleccionado el tipo de punto';}break;
			case 'PuntoMedAceptable':   if(empty($PuntoMedAceptable)){    $error['PuntoMedAceptable']     = 'error/No ha ingresado el valor aceptable';}break;
			case 'PuntoMedAlerta':      if(empty($PuntoMedAlerta)){       $error['PuntoMedAlerta']        = 'error/No ha ingresado el valor de alerta';}break;
			case 'PuntoMedCondenatorio':if(empty($PuntoMedCondenatorio)){ $error['PuntoMedCondenatorio']  = 'error/No ha ingresado el valor condenatorio';}break;
			case 'PuntoUniMed':         if(empty($PuntoUniMed)){          $error['PuntoUniMed']           = 'error/No ha seleccionado la unidad de medida';}break;
		
	
			case 'idLevel_1':           if(empty($idLevel[1])){           $error['idLevel_1']             = 'error/No ha ingresado el idLevel_1';}break;
			case 'idLevel_2':           if(empty($idLevel[2])){           $error['idLevel_2']             = 'error/No ha ingresado el idLevel_2';}break;
			case 'idLevel_3':           if(empty($idLevel[3])){           $error['idLevel_3']             = 'error/No ha ingresado el idLevel_3';}break;
			case 'idLevel_4':           if(empty($idLevel[4])){           $error['idLevel_4']             = 'error/No ha ingresado el idLevel_4';}break;
			case 'idLevel_5':           if(empty($idLevel[5])){           $error['idLevel_5']             = 'error/No ha ingresado el idLevel_5';}break;
			case 'idLevel_6':           if(empty($idLevel[6])){           $error['idLevel_6']             = 'error/No ha ingresado el idLevel_6';}break;
			case 'idLevel_7':           if(empty($idLevel[7])){           $error['idLevel_7']             = 'error/No ha ingresado el idLevel_7';}break;
			case 'idLevel_8':           if(empty($idLevel[8])){           $error['idLevel_8']             = 'error/No ha ingresado el idLevel_8';}break;
			case 'idLevel_9':           if(empty($idLevel[9])){           $error['idLevel_9']             = 'error/No ha ingresado el idLevel_9';}break;
			case 'idLevel_10':          if(empty($idLevel[10])){          $error['idLevel_10']            = 'error/No ha ingresado el idLevel_10';}break;
			case 'idLevel_11':          if(empty($idLevel[11])){          $error['idLevel_11']            = 'error/No ha ingresado el idLevel_11';}break;
			case 'idLevel_12':          if(empty($idLevel[12])){          $error['idLevel_12']            = 'error/No ha ingresado el idLevel_12';}break;
			case 'idLevel_13':          if(empty($idLevel[13])){          $error['idLevel_13']            = 'error/No ha ingresado el idLevel_13';}break;
			case 'idLevel_14':          if(empty($idLevel[14])){          $error['idLevel_14']            = 'error/No ha ingresado el idLevel_14';}break;
			case 'idLevel_15':          if(empty($idLevel[15])){          $error['idLevel_15']            = 'error/No ha ingresado el idLevel_15';}break;
			case 'idLevel_16':          if(empty($idLevel[16])){          $error['idLevel_16']            = 'error/No ha ingresado el idLevel_16';}break;
			case 'idLevel_17':          if(empty($idLevel[17])){          $error['idLevel_17']            = 'error/No ha ingresado el idLevel_17';}break;
			case 'idLevel_18':          if(empty($idLevel[18])){          $error['idLevel_18']            = 'error/No ha ingresado el idLevel_18';}break;
			case 'idLevel_19':          if(empty($idLevel[19])){          $error['idLevel_19']            = 'error/No ha ingresado el idLevel_19';}break;
			case 'idLevel_20':          if(empty($idLevel[20])){          $error['idLevel_20']            = 'error/No ha ingresado el idLevel_20';}break;
			case 'idLevel_21':          if(empty($idLevel[21])){          $error['idLevel_21']            = 'error/No ha ingresado el idLevel_21';}break;
			case 'idLevel_22':          if(empty($idLevel[22])){          $error['idLevel_22']            = 'error/No ha ingresado el idLevel_22';}break;
			case 'idLevel_23':          if(empty($idLevel[23])){          $error['idLevel_23']            = 'error/No ha ingresado el idLevel_23';}break;
			case 'idLevel_24':          if(empty($idLevel[24])){          $error['idLevel_24']            = 'error/No ha ingresado el idLevel_24';}break;
			case 'idLevel_25':          if(empty($idLevel[25])){          $error['idLevel_25']            = 'error/No ha ingresado el idLevel_25';}break;
	

		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Codigo)&&contar_palabras_censuradas($Codigo)!=0){             $error['Codigo']      = 'error/Edita Codigo, contiene palabras no permitidas'; }	
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){             $error['Nombre']      = 'error/Edita Nombre, contiene palabras no permitidas'; }	
	if(isset($Modelo)&&contar_palabras_censuradas($Modelo)!=0){             $error['Modelo']      = 'error/Edita Modelo, contiene palabras no permitidas'; }	
	if(isset($Serie)&&contar_palabras_censuradas($Serie)!=0){               $error['Serie']       = 'error/Edita Serie, contiene palabras no permitidas'; }	
	if(isset($Fabricante)&&contar_palabras_censuradas($Fabricante)!=0){     $error['Fabricante']  = 'error/Edita Fabricante, contiene palabras no permitidas'; }	
	if(isset($Descripcion)&&contar_palabras_censuradas($Descripcion)!=0){   $error['Descripcion'] = 'error/Edita Descripcion, contiene palabras no permitidas'; }	
	if(isset($Marca)&&contar_palabras_censuradas($Marca)!=0){               $error['Marca']       = 'error/Edita Marca, contiene palabras no permitidas'; }	
	if(isset($Frecuencia)&&contar_palabras_censuradas($Frecuencia)!=0){     $error['Frecuencia']  = 'error/Edita Frecuencia, contiene palabras no permitidas'; }	
	if(isset($Saf)&&contar_palabras_censuradas($Saf)!=0){                   $error['Saf']         = 'error/Edita Saf, contiene palabras no permitidas'; }	
	if(isset($Numero)&&contar_palabras_censuradas($Numero)!=0){             $error['Numero']      = 'error/Edita Numero, contiene palabras no permitidas'; }	
	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'createBasicData':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'maquinas_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre de la maquina ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){                   $a  = "'".$idSistema."'" ;               }else{$a ="''";}
				if(isset($idEstado) && $idEstado != ''){                     $a .= ",'".$idEstado."'" ;               }else{$a .=",''";}
				if(isset($Codigo) && $Codigo != ''){                         $a .= ",'".$Codigo."'" ;                 }else{$a .=",''";}
				if(isset($Nombre) && $Nombre != ''){                         $a .= ",'".$Nombre."'" ;                 }else{$a .=",''";}
				if(isset($Modelo) && $Modelo != ''){                         $a .= ",'".$Modelo."'" ;                 }else{$a .=",''";}
				if(isset($Serie) && $Serie != ''){                           $a .= ",'".$Serie."'" ;                  }else{$a .=",''";}
				if(isset($Fabricante) && $Fabricante != ''){                 $a .= ",'".$Fabricante."'" ;             }else{$a .=",''";}
				if(isset($fincorporacion) && $fincorporacion != ''){         $a .= ",'".$fincorporacion."'" ;         }else{$a .=",''";}
				if(isset($Descripcion) && $Descripcion != ''){               $a .= ",'".$Descripcion."'" ;            }else{$a .=",''";}
				if(isset($idConfig_1) && $idConfig_1 != ''){                 $a .= ",'".$idConfig_1."'" ;             }else{$a .=",''";}
				if(isset($idConfig_2) && $idConfig_2 != ''){                 $a .= ",'".$idConfig_2."'" ;             }else{$a .=",''";}
				if(isset($idConfig_3) && $idConfig_3 != ''){                 $a .= ",'".$idConfig_3."'" ;             }else{$a .=",''";}
				if(isset($idUbicacion) && $idUbicacion != ''){               $a .= ",'".$idUbicacion."'" ;            }else{$a .=",''";}
				if(isset($idUbicacion_lvl_1) && $idUbicacion_lvl_1 != ''){   $a .= ",'".$idUbicacion_lvl_1."'" ;      }else{$a .=",''";}
				if(isset($idUbicacion_lvl_2) && $idUbicacion_lvl_2 != ''){   $a .= ",'".$idUbicacion_lvl_2."'" ;      }else{$a .=",''";}
				if(isset($idUbicacion_lvl_3) && $idUbicacion_lvl_3 != ''){   $a .= ",'".$idUbicacion_lvl_3."'" ;      }else{$a .=",''";}
				if(isset($idUbicacion_lvl_4) && $idUbicacion_lvl_4 != ''){   $a .= ",'".$idUbicacion_lvl_4."'" ;      }else{$a .=",''";}
				if(isset($idUbicacion_lvl_5) && $idUbicacion_lvl_5 != ''){   $a .= ",'".$idUbicacion_lvl_5."'" ;      }else{$a .=",''";}
				if(isset($idCliente) && $idCliente != ''){                   $a .= ",'".$idCliente."'" ;              }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `maquinas_listado` (idSistema, idEstado, Codigo, Nombre, Modelo, Serie, Fabricante,
				fincorporacion, Descripcion, idConfig_1, idConfig_2, idConfig_3, idUbicacion, idUbicacion_lvl_1, idUbicacion_lvl_2,
				idUbicacion_lvl_3, idUbicacion_lvl_4, idUbicacion_lvl_5, idCliente) 
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
		case 'updateBasicData':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)&&isset($idMaquina)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'maquinas_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."' AND idMaquina!='".$idMaquina."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre de la licitacion ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				
				/***********************************************************************/
				//Filtros
				$a = "idMaquina='".$idMaquina."'" ;
				if(isset($idSistema) && $idSistema != ''){                  $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($Codigo) && $Codigo != ''){                        $a .= ",Codigo='".$Codigo."'" ;}
				if(isset($Nombre) && $Nombre != ''){                        $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Modelo) && $Modelo != ''){                        $a .= ",Modelo='".$Modelo."'" ;}
				if(isset($Serie) && $Serie != ''){                          $a .= ",Serie='".$Serie."'" ;}
				if(isset($Fabricante) && $Fabricante != ''){                $a .= ",Fabricante='".$Fabricante."'" ;}
				if(isset($idEstado) && $idEstado != ''){                    $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($fincorporacion) && $fincorporacion != ''){        $a .= ",fincorporacion='".$fincorporacion."'" ;}
				if(isset($Descripcion) && $Descripcion != ''){              $a .= ",Descripcion='".$Descripcion."'" ;}
				if(isset($idConfig_1) && $idConfig_1 != ''){                $a .= ",idConfig_1='".$idConfig_1."'" ;}
				if(isset($idConfig_2) && $idConfig_2 != ''){                $a .= ",idConfig_2='".$idConfig_2."'" ;}
				if(isset($idConfig_3) && $idConfig_3 != ''){                $a .= ",idConfig_3='".$idConfig_3."'" ;}
				if(isset($idUbicacion) && $idUbicacion != ''){              $a .= ",idUbicacion='".$idUbicacion."'" ;}
				if(isset($idUbicacion_lvl_1) && $idUbicacion_lvl_1 != ''){  $a .= ",idUbicacion_lvl_1='".$idUbicacion_lvl_1."'" ;}
				if(isset($idUbicacion_lvl_2) && $idUbicacion_lvl_2 != ''){  $a .= ",idUbicacion_lvl_2='".$idUbicacion_lvl_2."'" ;}
				if(isset($idUbicacion_lvl_3) && $idUbicacion_lvl_3 != ''){  $a .= ",idUbicacion_lvl_3='".$idUbicacion_lvl_3."'" ;}
				if(isset($idUbicacion_lvl_4) && $idUbicacion_lvl_4 != ''){  $a .= ",idUbicacion_lvl_4='".$idUbicacion_lvl_4."'" ;}
				if(isset($idUbicacion_lvl_5) && $idUbicacion_lvl_5 != ''){  $a .= ",idUbicacion_lvl_5='".$idUbicacion_lvl_5."'" ;}
				if(isset($idCliente) && $idCliente != ''){                  $a .= ",idCliente='".$idCliente."'" ;}
				
				//Verifico si el cliente no es el mismo que el anterior
				if(isset($FakeidCliente)&&isset($idCliente)&&$FakeidCliente!=0&&$idCliente!=0&&$FakeidCliente!=$idCliente){
					//reseteo la ubicacion
					$a .= ",idUbicacion_lvl_1=''" ;
					$a .= ",idUbicacion_lvl_2=''" ;
					$a .= ",idUbicacion_lvl_3=''" ;
					$a .= ",idUbicacion_lvl_4=''" ;
					$a .= ",idUbicacion_lvl_5=''" ;
				}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `maquinas_listado` SET ".$a." WHERE idMaquina = '$idMaquina'";
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
		case 'delBasicData':	
			
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
				//maximo de registros
				$nmax = 25;
				
				// Se obtiene el nombre del logo
				$rowdata = db_select_data (false, 'Direccion_img, FichaTecnica, HDS', 'maquinas_listado', '', 'idMaquina = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				//se borran los datos
				$resultado = db_delete_data (false, 'maquinas_listado', 'idMaquina = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
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
				
				//se borran los datos relacionados
				for ($i = 1; $i <= $nmax; $i++) {
					$resultado = db_delete_data (false, 'maquinas_listado_level_'.$i, 'idMaquina = "'.$_GET['del'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
					
				//redirijo			
				header( 'Location: '.$location.'&deleted=true' );
				die;
			}else{
				//se valida hackeo
				require_once '0_hacking_1.php';
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
				$sufijo = 'maquinas_img_'.$idMaquina.'_';
				  
				if (in_array($_FILES['Direccion_img']['type'], $permitidos) && $_FILES['Direccion_img']['size'] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['Direccion_img']['name'];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (!file_exists($ruta)){
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

								
							//Filtro para idSistema		
							$a = "Direccion_img='".$sufijo.$_FILES['Direccion_img']['name']."'" ;

							// inserto los datos de registro en la db
							$query  = "UPDATE `maquinas_listado` SET ".$a." WHERE idMaquina = '$idMaquina'";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if($resultado){
								
								header( 'Location: '.$location.'&img_id='.$idMaquina );
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
				$sufijo = 'maquinas_file_'.$idMaquina.'_';
				  
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
							$query  = "UPDATE `maquinas_listado` SET ".$a." WHERE idMaquina = '$idMaquina'";
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
				$sufijo = 'maquinas_hds_'.$idMaquina.'_';
				  
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
							$query  = "UPDATE `maquinas_listado` SET ".$a." WHERE idMaquina = '$idMaquina'";
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
			$rowdata = db_select_data (false, 'Direccion_img', 'maquinas_listado', '', 'idMaquina = "'.$_GET['del_img'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

			//se borra el dato de la base de datos
			$query  = "UPDATE `maquinas_listado` SET Direccion_img='' WHERE idMaquina = '".$_GET['del_img']."'";
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
			$rowdata = db_select_data (false, 'FichaTecnica', 'maquinas_listado', '', 'idMaquina = "'.$_GET['del_file'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

			//se borra el dato de la base de datos
			$query  = "UPDATE `maquinas_listado` SET FichaTecnica='' WHERE idMaquina = '".$_GET['del_file']."'";
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
			$rowdata = db_select_data (false, 'HDS', 'maquinas_listado', '', 'idMaquina = "'.$_GET['del_hds'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

			//se borra el dato de la base de datos
			$query  = "UPDATE `maquinas_listado` SET HDS='' WHERE idMaquina = '".$_GET['del_hds']."'";
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
		case 'insert_item':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Verifico otros datos
			/*******************************************************************/
			//variables
			/*$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($lvl)&&isset($Nombre)&&isset($idMaquina)&&isset($idSistema)&&isset($Codigo)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'maquinas_listado_level_', '', "Nombre='".$Nombre."' AND idMaquina='".$idMaquina."' AND idSistema='".$idSistema."' AND Codigo='".$Codigo."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El dato ya existe';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el Nombre	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){                       $a = "'".$idSistema."'" ;               }else{$a ="''";}
				if(isset($idMaquina) && $idMaquina != ''){                       $a .= ",'".$idMaquina."'" ;             }else{$a .=",''";}
				if(isset($idUtilizable) && $idUtilizable != ''){                 $a .= ",'".$idUtilizable."'" ;          }else{$a .=",''";}
				if(isset($Codigo) && $Codigo != ''){                             $a .= ",'".$Codigo."'" ;                }else{$a .=",''";}
				if(isset($Nombre) && $Nombre != ''){                             $a .= ",'".$Nombre."'" ;                }else{$a .=",''";}
				if(isset($Marca) && $Marca != ''){                               $a .= ",'".$Marca."'" ;                 }else{$a .=",''";}
				if(isset($Modelo) && $Modelo != ''){                             $a .= ",'".$Modelo."'" ;                }else{$a .=",''";}
				if(isset($AnoFab) && $AnoFab != ''){                             $a .= ",'".$AnoFab."'" ;                }else{$a .=",''";}
				if(isset($Serie) && $Serie != ''){                               $a .= ",'".$Serie."'" ;                 }else{$a .=",''";}
				if(isset($Direccion_img) && $Direccion_img != ''){               $a .= ",'".$Direccion_img."'" ;         }else{$a .=",''";}
				if(isset($idSubTipo) && $idSubTipo != ''){                       $a .= ",'".$idSubTipo."'" ;             }else{$a .=",''";}
				if(isset($Grasa_inicial) && $Grasa_inicial != ''){               $a .= ",'".$Grasa_inicial."'" ;         }else{$a .=",''";}
				if(isset($Grasa_relubricacion) && $Grasa_relubricacion != ''){   $a .= ",'".$Grasa_relubricacion."'" ;   }else{$a .=",''";}
				if(isset($Aceite) && $Aceite != ''){                             $a .= ",'".$Aceite."'" ;                }else{$a .=",''";}
				if(isset($Cantidad) && $Cantidad != ''){                         $a .= ",'".$Cantidad."'" ;              }else{$a .=",''";}
				if(isset($idUml) && $idUml != ''){                               $a .= ",'".$idUml."'" ;                 }else{$a .=",''";}
				if(isset($Frecuencia) && $Frecuencia != ''){                     $a .= ",'".$Frecuencia."'" ;            }else{$a .=",''";}
				if(isset($idFrecuencia) && $idFrecuencia != ''){                 $a .= ",'".$idFrecuencia."'" ;          }else{$a .=",''";}
				if(isset($idProducto) && $idProducto != ''){                     $a .= ",'".$idProducto."'" ;            }else{$a .=",''";}
				if(isset($Saf) && $Saf != ''){                                   $a .= ",'".$Saf."'" ;                   }else{$a .=",''";}
				if(isset($Numero) && $Numero != ''){                             $a .= ",'".$Numero."'" ;                }else{$a .=",''";}
				
				
				
				$xbla = '';
				for ($i = 2; $i <= $lvl; $i++) {
					//Ubico correctamente el puntero
					$point = $i - 1;
					//Valor a insertar
					if(isset($idLevel[$point]) && $idLevel[$point] != ''){   $a .= ",'".$idLevel[$point]."'" ;   }else{$a .=",''";}
					//donde insertar
					$xbla .= ',idLevel_'.$point;
				}
			
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `maquinas_listado_level_".$lvl."` (idSistema,idMaquina, idUtilizable,
				Codigo, Nombre, Marca, Modelo, AnoFab, Serie, Direccion_img, idSubTipo, Grasa_inicial,
				Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia,idProducto,Saf , Numero 
				".$xbla." ) 
				VALUES (".$a.")";
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
		case 'update_item':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el Nombre	
			if ( empty($error) ) {
				//Filtros
				$a = "idLevel_".$lvl."='".$idLevel[$lvl]."'" ;
				if(isset($idSistema) && $idSistema != ''){                      $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idMaquina) && $idMaquina != ''){                      $a .= ",idMaquina='".$idMaquina."'" ;}
				if(isset($idUtilizable) && $idUtilizable != ''){                $a .= ",idUtilizable='".$idUtilizable."'" ;}
				if(isset($Codigo) && $Codigo != ''){                            $a .= ",Codigo='".$Codigo."'" ;}
				if(isset($Nombre) && $Nombre != ''){                            $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Marca) && $Marca != ''){                              $a .= ",Marca='".$Marca."'" ;}
				if(isset($Modelo) && $Modelo != ''){                            $a .= ",Modelo='".$Modelo."'" ;}
				if(isset($AnoFab) && $AnoFab != ''){                            $a .= ",AnoFab='".$AnoFab."'" ;}
				if(isset($Serie) && $Serie != ''){                              $a .= ",Serie='".$Serie."'" ;}
				if(isset($Direccion_img) && $Direccion_img != ''){              $a .= ",Direccion_img='".$Direccion_img."'" ;}
				if(isset($idSubTipo) && $idSubTipo != ''){                      $a .= ",idSubTipo='".$idSubTipo."'" ;}
				if(isset($Grasa_inicial) && $Grasa_inicial != ''){              $a .= ",Grasa_inicial='".$Grasa_inicial."'" ;}
				if(isset($Grasa_relubricacion) && $Grasa_relubricacion != ''){  $a .= ",Grasa_relubricacion='".$Grasa_relubricacion."'" ;}
				if(isset($Aceite) && $Aceite != ''){                            $a .= ",Aceite='".$Aceite."'" ;}
				if(isset($Cantidad) && $Cantidad != ''){                        $a .= ",Cantidad='".$Cantidad."'" ;}
				if(isset($idUml) && $idUml != ''){                              $a .= ",idUml='".$idUml."'" ;}
				if(isset($Frecuencia) && $Frecuencia != ''){                    $a .= ",Frecuencia='".$Frecuencia."'" ;}
				if(isset($idFrecuencia) && $idFrecuencia != ''){                $a .= ",idFrecuencia='".$idFrecuencia."'" ;}
				if(isset($idProducto) && $idProducto != ''){                    $a .= ",idProducto='".$idProducto."'" ;}
				if(isset($Saf) && $Saf != ''){                                  $a .= ",Saf='".$Saf."'" ;}
				if(isset($Numero) && $Numero != ''){                            $a .= ",Numero='".$Numero."'" ;}
				if(isset($idUml) && $idUml != ''){                              $a .= ",idUml='".$idUml."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `maquinas_listado_level_".$lvl."` SET ".$a." WHERE idLevel_".$lvl." = '".$idLevel[$lvl]."'";
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
		case 'del_item':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variable
			$errorn = 0;
			
			//verifico si se envia un entero
			if((!validarNumero($_GET['del_idLevel']) OR !validaEntero($_GET['del_idLevel']))&&$_GET['del_idLevel']!=''){
				$indice = simpleDecode($_GET['del_idLevel'], fecha_actual());
			}else{
				$indice = $_GET['del_idLevel'];
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
				for ($i = $_GET['lvl']; $i <= $_GET['nmax']; $i++) {
					
					// Se obtiene el nombre del logo
					$rowdata = db_select_data (false, 'Direccion_img', 'maquinas_listado_level_'.$i, '', 'idLevel_'.$_GET['lvl'].' = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

					//se borran los datos
					$resultado = db_delete_data (false, 'maquinas_listado_level_'.$i, 'idLevel_'.$_GET['lvl'].' = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					
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
				}
					
				//redirijo			
				header( 'Location: '.$location.'&deleted=true' );
				die;
			}else{
				//se valida hackeo
				require_once '0_hacking_1.php';
			}
			

		break;							
/*******************************************************************************************************************/
		case 'estado':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$idMaquina  = $_GET['id'];
			$idEstado   = simpleDecode($_GET['estado'], fecha_actual());
			$query  = "UPDATE maquinas_listado SET idEstado = '".$idEstado."'	
			WHERE idMaquina = '".$idMaquina."'";
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
		case 'add_trabajo':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ( empty($error) ) {
				
				if(isset($idLevel[1])&&$idLevel[1]!=''){   $xx = $idLevel[1];  $level=1; }
				if(isset($idLevel[2])&&$idLevel[2]!=''){   $xx = $idLevel[2];  $level=2; }
				if(isset($idLevel[3])&&$idLevel[3]!=''){   $xx = $idLevel[3];  $level=3; }
				if(isset($idLevel[4])&&$idLevel[4]!=''){   $xx = $idLevel[4];  $level=4; }
				if(isset($idLevel[5])&&$idLevel[5]!=''){   $xx = $idLevel[5];  $level=5; }
				if(isset($idLevel[6])&&$idLevel[6]!=''){   $xx = $idLevel[6];  $level=6; }
				if(isset($idLevel[7])&&$idLevel[7]!=''){   $xx = $idLevel[7];  $level=7; }
				if(isset($idLevel[8])&&$idLevel[8]!=''){   $xx = $idLevel[8];  $level=8; }
				if(isset($idLevel[9])&&$idLevel[9]!=''){   $xx = $idLevel[9];  $level=9; }
				if(isset($idLevel[10])&&$idLevel[10]!=''){ $xx = $idLevel[10]; $level=10; }
				if(isset($idLevel[11])&&$idLevel[11]!=''){ $xx = $idLevel[11]; $level=11; }
				if(isset($idLevel[12])&&$idLevel[12]!=''){ $xx = $idLevel[12]; $level=12; }
				if(isset($idLevel[13])&&$idLevel[13]!=''){ $xx = $idLevel[13]; $level=13; }
				if(isset($idLevel[14])&&$idLevel[14]!=''){ $xx = $idLevel[14]; $level=14; }
				if(isset($idLevel[15])&&$idLevel[15]!=''){ $xx = $idLevel[15]; $level=15; }
				if(isset($idLevel[16])&&$idLevel[16]!=''){ $xx = $idLevel[16]; $level=16; }
				if(isset($idLevel[17])&&$idLevel[17]!=''){ $xx = $idLevel[17]; $level=17; }
				if(isset($idLevel[18])&&$idLevel[18]!=''){ $xx = $idLevel[18]; $level=18; }
				if(isset($idLevel[19])&&$idLevel[19]!=''){ $xx = $idLevel[19]; $level=19; }
				if(isset($idLevel[20])&&$idLevel[20]!=''){ $xx = $idLevel[20]; $level=20; }
				if(isset($idLevel[21])&&$idLevel[21]!=''){ $xx = $idLevel[21]; $level=21; }
				if(isset($idLevel[22])&&$idLevel[22]!=''){ $xx = $idLevel[22]; $level=22; }
				if(isset($idLevel[23])&&$idLevel[23]!=''){ $xx = $idLevel[23]; $level=23; }
				if(isset($idLevel[24])&&$idLevel[24]!=''){ $xx = $idLevel[24]; $level=24; }
				if(isset($idLevel[25])&&$idLevel[25]!=''){ $xx = $idLevel[25]; $level=25; }
				
				
				//Filtros
				$a = "idLevel_".$lvl."='".$addTrabajo."'" ;
				if(isset($idLicitacion) && $idLicitacion != ''){   $a .= ",idLicitacion='".$idLicitacion."'" ;}
				if(isset($level) && $level != ''){                 $a .= ",tabla='".$level."'" ;}
				if(isset($xx) && $xx != ''){                       $a .= ",table_value='".$xx."'" ;}
				

				// inserto los datos de registro en la db
				$query  = "UPDATE `maquinas_listado_level_".$lvl."` SET ".$a." WHERE idLevel_".$lvl." = '".$addTrabajo."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&view=true' );
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
		case 'insert_matriz':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idMaquina)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'maquinas_listado_matriz', '', "Nombre='".$Nombre."' AND idMaquina='".$idMaquina."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/La matriz ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idMaquina) && $idMaquina != ''){       $a  = "'".$idMaquina."'" ;      }else{$a ="''";}
				if(isset($Nombre) && $Nombre != ''){             $a .= ",'".$Nombre."'" ;        }else{$a .=",''";}
				if(isset($cantPuntos) && $cantPuntos != ''){     $a .= ",'".$cantPuntos."'" ;    }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){         $a .= ",'".$idEstado."'" ;      }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `maquinas_listado_matriz` (idMaquina, Nombre, cantPuntos, idEstado) 
				VALUES (".$a.")";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
						
					header( 'Location: '.$location.'&idMatriz='.$ultimo_id.'&created=true' );
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
		case 'update_matriz':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ( empty($error) ) {
		
				//Filtros
				$a = "idMatriz='".$idMatriz."'" ;
				if(isset($Nombre) && $Nombre != ''){                              $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($cantPuntos) && $cantPuntos != ''){                      $a .= ",cantPuntos='".$cantPuntos."'" ;}
				if(isset($PuntoNombre) && $PuntoNombre != ''){                    $a .= ",PuntoNombre_".$mod."='".$PuntoNombre."'" ;}
				if(isset($PuntoidTipo) && $PuntoidTipo != ''){                    $a .= ",PuntoidTipo_".$mod."='".$PuntoidTipo."'" ;}
				if(isset($PuntoMedAceptable) && $PuntoMedAceptable != ''){        $a .= ",PuntoMedAceptable_".$mod."='".$PuntoMedAceptable."'" ;}
				if(isset($PuntoMedAlerta) && $PuntoMedAlerta != ''){              $a .= ",PuntoMedAlerta_".$mod."='".$PuntoMedAlerta."'" ;}
				if(isset($PuntoMedCondenatorio) && $PuntoMedCondenatorio != ''){  $a .= ",PuntoMedCondenatorio_".$mod."='".$PuntoMedCondenatorio."'" ;}
				if(isset($PuntoUniMed) && $PuntoUniMed != ''){                    $a .= ",PuntoUniMed_".$mod."='".$PuntoUniMed."'" ;}
				if(isset($PuntoidGrupo) && $PuntoidGrupo != ''){                  $a .= ",PuntoidGrupo_".$mod."='".$PuntoidGrupo."'" ;}
				if(isset($idEstado) && $idEstado != ''){                          $a .= ",idEstado".$mod."='".$idEstado."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `maquinas_listado_matriz` SET ".$a." WHERE idMatriz = '$idMatriz'";
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
			}

		break;	
/*******************************************************************************************************************/
		case 'del_matriz':	
			
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
				//se borran los datos
				$resultado = db_delete_data (false, 'maquinas_listado_matriz', 'idMatriz = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
		case 'clone_Maquina':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//obtengo los datos de la maquina previamente seleccionada
			$rowdata = db_select_data (false, 'idSistema', 'maquinas_listado', '', 'idMaquina ='.$idMaquina, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($rowdata['idSistema'])){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'maquinas_listado', '', "Nombre='".$Nombre."' AND idSistema='".$rowdata['idSistema']."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre de la maquina ya existe en el sistema';}
			/*******************************************************************/
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/*******************************************************************/
				// Se traen todos los datos de la maquina
				$rowdata = db_select_data (false, 'idSistema, Codigo, Modelo, Serie, Fabricante, fincorporacion, Descripcion, idConfig_1, idConfig_2, idConfig_3, idCliente', 'maquinas_listado', '', 'idMaquina ='.$idMaquina, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
				//Se crea la maquina
				$a  = "'".$rowdata['idSistema']."'" ; 
				$a .= ",'2'" ;                        //inactivo hasta editar       
				$a .= ",'".$rowdata['Codigo']."'" ; 
				$a .= ",'".$Nombre."'" ;          
				$a .= ",'".$rowdata['Modelo']."'" ;          
				$a .= ",'".$rowdata['Serie']."'" ;          
				$a .= ",'".$rowdata['Fabricante']."'" ;           
				$a .= ",'".$rowdata['fincorporacion']."'" ; 
				$a .= ",'".$rowdata['Descripcion']."'" ;
				$a .= ",'".$rowdata['idConfig_1']."'" ;
				$a .= ",'".$rowdata['idConfig_2']."'" ;
				$a .= ",'".$rowdata['idConfig_3']."'" ;
				$a .= ",'".$rowdata['idCliente']."'" ;
        
					
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `maquinas_listado` (idSistema, idEstado, Codigo, Nombre, Modelo, 
				Serie, Fabricante, fincorporacion, Descripcion, idConfig_1, idConfig_2, idConfig_3, idCliente) 
				VALUES (".$a.")";
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
				$maquina_id = mysqli_insert_id($dbConn);
				/*******************************************************************/
				$arrLVL_1 = array();
				$arrLVL_1 = db_select_array (false, 'idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_1', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_2 = array();
				$arrLVL_2 = db_select_array (false, 'idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_2', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_3 = array();
				$arrLVL_3 = db_select_array (false, 'idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_3', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_4 = array();
				$arrLVL_4 = db_select_array (false, 'idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_4', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_5 = array();
				$arrLVL_5 = db_select_array (false, 'idLevel_5, idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_5', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_6 = array();
				$arrLVL_6 = db_select_array (false, 'idLevel_6, idLevel_5, idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_6', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_7 = array();
				$arrLVL_7 = db_select_array (false, 'idLevel_7, idLevel_6, idLevel_5, idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_7', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_8 = array();
				$arrLVL_8 = db_select_array (false, 'idLevel_8, idLevel_7, idLevel_6, idLevel_5, idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_8', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_9 = array();
				$arrLVL_9 = db_select_array (false, 'idLevel_9, idLevel_8, idLevel_7, idLevel_6, idLevel_5, idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_9', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_10 = array();
				$arrLVL_10 = db_select_array (false, 'idLevel_10, idLevel_9, idLevel_8, idLevel_7, idLevel_6, idLevel_5, idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_10', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_11 = array();
				$arrLVL_11 = db_select_array (false, 'idLevel_11, idLevel_10, idLevel_9, idLevel_8, idLevel_7, idLevel_6, idLevel_5, idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_11', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_12 = array();
				$arrLVL_12 = db_select_array (false, 'idLevel_12, idLevel_11, idLevel_10, idLevel_9, idLevel_8, idLevel_7, idLevel_6, idLevel_5, idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_12', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_13 = array();
				$arrLVL_13 = db_select_array (false, 'idLevel_13, idLevel_12, idLevel_11, idLevel_10, idLevel_9, idLevel_8, idLevel_7, idLevel_6, idLevel_5, idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_13', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_14 = array();
				$arrLVL_14 = db_select_array (false, 'idLevel_14, idLevel_13, idLevel_12, idLevel_11, idLevel_10, idLevel_9, idLevel_8, idLevel_7, idLevel_6, idLevel_5, idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_14', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_15 = array();
				$arrLVL_15 = db_select_array (false, 'idLevel_15, idLevel_14, idLevel_13, idLevel_12, idLevel_11, idLevel_10, idLevel_9, idLevel_8, idLevel_7, idLevel_6, idLevel_5, idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_15', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				/*$arrLVL_16 = array();
				$arrLVL_16 = db_select_array (false, 'idLevel_16, idLevel_15, idLevel_14, idLevel_13, idLevel_12, idLevel_11, idLevel_10, idLevel_9, idLevel_8, idLevel_7, idLevel_6, idLevel_5, idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_16', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_17 = array();
				$arrLVL_17 = db_select_array (false, 'idLevel_17, idLevel_16, idLevel_15, idLevel_14, idLevel_13, idLevel_12, idLevel_11, idLevel_10, idLevel_9, idLevel_8, idLevel_7, idLevel_6, idLevel_5, idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_17', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_18 = array();
				$arrLVL_18 = db_select_array (false, 'idLevel_18, idLevel_17, idLevel_16, idLevel_15, idLevel_14, idLevel_13, idLevel_12, idLevel_11, idLevel_10, idLevel_9, idLevel_8, idLevel_7, idLevel_6, idLevel_5, idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_18', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_19 = array();
				$arrLVL_19 = db_select_array (false, 'idLevel_19, idLevel_18, idLevel_17, idLevel_16, idLevel_15, idLevel_14, idLevel_13, idLevel_12, idLevel_11, idLevel_10, idLevel_9, idLevel_8, idLevel_7, idLevel_6, idLevel_5, idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_19', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_20 = array();
				$arrLVL_20 = db_select_array (false, 'idLevel_20,idLevel_19, idLevel_18, idLevel_17, idLevel_16, idLevel_15, idLevel_14, idLevel_13, idLevel_12, idLevel_11, idLevel_10, idLevel_9, idLevel_8, idLevel_7, idLevel_6, idLevel_5, idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_20', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_21 = array();
				$arrLVL_21 = db_select_array (false, 'idLevel_21, idLevel_20,idLevel_19, idLevel_18, idLevel_17, idLevel_16, idLevel_15, idLevel_14, idLevel_13, idLevel_12, idLevel_11, idLevel_10, idLevel_9, idLevel_8, idLevel_7, idLevel_6, idLevel_5, idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_21', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_22 = array();
				$arrLVL_22 = db_select_array (false, 'idLevel_22, idLevel_21, idLevel_20,idLevel_19, idLevel_18, idLevel_17, idLevel_16, idLevel_15, idLevel_14, idLevel_13, idLevel_12, idLevel_11, idLevel_10, idLevel_9, idLevel_8, idLevel_7, idLevel_6, idLevel_5, idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_22', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_23 = array();
				$arrLVL_23 = db_select_array (false, 'idLevel_23, idLevel_22, idLevel_21, idLevel_20,idLevel_19, idLevel_18, idLevel_17, idLevel_16, idLevel_15, idLevel_14, idLevel_13, idLevel_12, idLevel_11, idLevel_10, idLevel_9, idLevel_8, idLevel_7, idLevel_6, idLevel_5, idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_23', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_24 = array();
				$arrLVL_24 = db_select_array (false, 'idLevel_24, idLevel_23, idLevel_22, idLevel_21, idLevel_20,idLevel_19, idLevel_18, idLevel_17, idLevel_16, idLevel_15, idLevel_14, idLevel_13, idLevel_12, idLevel_11, idLevel_10, idLevel_9, idLevel_8, idLevel_7, idLevel_6, idLevel_5, idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_24', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrLVL_25 = array();
				$arrLVL_25 = db_select_array (false, 'idLevel_25, idLevel_24, idLevel_23, idLevel_22, idLevel_21, idLevel_20,idLevel_19, idLevel_18, idLevel_17, idLevel_16, idLevel_15, idLevel_14, idLevel_13, idLevel_12, idLevel_11, idLevel_10, idLevel_9, idLevel_8, idLevel_7, idLevel_6, idLevel_5, idLevel_4, idLevel_3, idLevel_2, idLevel_1, idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero', 'maquinas_listado_level_25', '', 'idMaquina = '.$idMaquina, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				/*******************************************************************/
				
				
				foreach ($arrLVL_1 as $lvl_1) {
					
					//Se crea la maquina
					$a  = "'".$lvl_1['idSistema']."'" ;          
					$a .= ",'".$maquina_id."'" ; 
					$a .= ",'".$lvl_1['idUtilizable']."'" ;
					$a .= ",'".$lvl_1['Codigo']."'" ;
					$a .= ",'".$lvl_1['Nombre']."'" ;
					$a .= ",'".$lvl_1['Marca']."'" ;
					$a .= ",'".$lvl_1['Modelo']."'" ;
					$a .= ",'".$lvl_1['AnoFab']."'" ;
					$a .= ",'".$lvl_1['Serie']."'" ; 
					$a .= ",'".$lvl_1['idLicitacion']."'" ; 
					$a .= ",'".$lvl_1['tabla']."'" ; 
					$a .= ",'".$lvl_1['table_value']."'" ; 
					$a .= ",'".$lvl_1['Direccion_img']."'" ; 
					$a .= ",'".$lvl_1['idSubTipo']."'" ; 
					$a .= ",'".$lvl_1['Grasa_inicial']."'" ; 
					$a .= ",'".$lvl_1['Grasa_relubricacion']."'" ; 
					$a .= ",'".$lvl_1['Aceite']."'" ; 
					$a .= ",'".$lvl_1['Cantidad']."'" ; 
					$a .= ",'".$lvl_1['idUml']."'" ; 
					$a .= ",'".$lvl_1['Frecuencia']."'" ; 
					$a .= ",'".$lvl_1['idFrecuencia']."'" ; 
					$a .= ",'".$lvl_1['idProducto']."'" ; 
					$a .= ",'".$lvl_1['Saf']."'" ; 
					$a .= ",'".$lvl_1['Numero']."'" ; 
     
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `maquinas_listado_level_1` (idSistema, idMaquina, idUtilizable, 
					Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
					Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
					idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
					VALUES (".$a.")";
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
					$id_lvl_1 = mysqli_insert_id($dbConn);
					
					//Nivel 2
					foreach ($arrLVL_2 as $lvl_2) {
						//Se verifica que sea el mismo sensor
						if($lvl_1['idLevel_1']==$lvl_2['idLevel_1']){
							
							//Se crea la maquina
							$a  = "'".$id_lvl_1."'" ;          
							$a .= ",'".$lvl_2['idSistema']."'" ; 
							$a .= ",'".$maquina_id."'" ; 
							$a .= ",'".$lvl_2['idUtilizable']."'" ;
							$a .= ",'".$lvl_2['Codigo']."'" ;
							$a .= ",'".$lvl_2['Nombre']."'" ;
							$a .= ",'".$lvl_2['Marca']."'" ;
							$a .= ",'".$lvl_2['Modelo']."'" ;
							$a .= ",'".$lvl_2['AnoFab']."'" ;
							$a .= ",'".$lvl_2['Serie']."'" ; 
							$a .= ",'".$lvl_2['idLicitacion']."'" ; 
							$a .= ",'".$lvl_2['tabla']."'" ; 
							$a .= ",'".$lvl_2['table_value']."'" ; 
							$a .= ",'".$lvl_2['Direccion_img']."'" ; 
							$a .= ",'".$lvl_2['idSubTipo']."'" ; 
							$a .= ",'".$lvl_2['Grasa_inicial']."'" ; 
							$a .= ",'".$lvl_2['Grasa_relubricacion']."'" ; 
							$a .= ",'".$lvl_2['Aceite']."'" ; 
							$a .= ",'".$lvl_2['Cantidad']."'" ; 
							$a .= ",'".$lvl_2['idUml']."'" ; 
							$a .= ",'".$lvl_2['Frecuencia']."'" ; 
							$a .= ",'".$lvl_2['idFrecuencia']."'" ; 
							$a .= ",'".$lvl_2['idProducto']."'" ; 
							$a .= ",'".$lvl_2['Saf']."'" ; 
							$a .= ",'".$lvl_2['Numero']."'" ; 
			 
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `maquinas_listado_level_2` (idLevel_1, idSistema, idMaquina, idUtilizable, 
							Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
							Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
							idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
							VALUES (".$a.")";
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
							$id_lvl_2 = mysqli_insert_id($dbConn);
					
							//Nivel 3
							foreach ($arrLVL_3 as $lvl_3) {
								//Se verifica que sea el mismo sensor
								if($lvl_2['idLevel_2']==$lvl_3['idLevel_2']){
									
									//Se crea la maquina
									$a  = "'".$id_lvl_2."'" ;          
									$a .= ",'".$id_lvl_1."'" ; 
									$a .= ",'".$lvl_3['idSistema']."'" ; 
									$a .= ",'".$maquina_id."'" ; 
									$a .= ",'".$lvl_3['idUtilizable']."'" ;
									$a .= ",'".$lvl_3['Codigo']."'" ;
									$a .= ",'".$lvl_3['Nombre']."'" ;
									$a .= ",'".$lvl_3['Marca']."'" ;
									$a .= ",'".$lvl_3['Modelo']."'" ;
									$a .= ",'".$lvl_3['AnoFab']."'" ;
									$a .= ",'".$lvl_3['Serie']."'" ; 
									$a .= ",'".$lvl_3['idLicitacion']."'" ; 
									$a .= ",'".$lvl_3['tabla']."'" ; 
									$a .= ",'".$lvl_3['table_value']."'" ; 
									$a .= ",'".$lvl_3['Direccion_img']."'" ; 
									$a .= ",'".$lvl_3['idSubTipo']."'" ; 
									$a .= ",'".$lvl_3['Grasa_inicial']."'" ; 
									$a .= ",'".$lvl_3['Grasa_relubricacion']."'" ; 
									$a .= ",'".$lvl_3['Aceite']."'" ; 
									$a .= ",'".$lvl_3['Cantidad']."'" ; 
									$a .= ",'".$lvl_3['idUml']."'" ; 
									$a .= ",'".$lvl_3['Frecuencia']."'" ; 
									$a .= ",'".$lvl_3['idFrecuencia']."'" ; 
									$a .= ",'".$lvl_3['idProducto']."'" ; 
									$a .= ",'".$lvl_3['Saf']."'" ; 
									$a .= ",'".$lvl_3['Numero']."'" ; 
					 
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `maquinas_listado_level_3` (idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
									Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
									Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
									idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
									VALUES (".$a.")";
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
									$id_lvl_3 = mysqli_insert_id($dbConn);
							
									//Nivel 4
									foreach ($arrLVL_4 as $lvl_4) {
										//Se verifica que sea el mismo sensor
										if($lvl_3['idLevel_3']==$lvl_4['idLevel_3']){
											
											//Se crea la maquina
											$a  = "'".$id_lvl_3."'" ;          
											$a .= ",'".$id_lvl_2."'" ; 
											$a .= ",'".$id_lvl_1."'" ; 
											$a .= ",'".$lvl_4['idSistema']."'" ; 
											$a .= ",'".$maquina_id."'" ; 
											$a .= ",'".$lvl_4['idUtilizable']."'" ;
											$a .= ",'".$lvl_4['Codigo']."'" ;
											$a .= ",'".$lvl_4['Nombre']."'" ;
											$a .= ",'".$lvl_4['Marca']."'" ;
											$a .= ",'".$lvl_4['Modelo']."'" ;
											$a .= ",'".$lvl_4['AnoFab']."'" ;
											$a .= ",'".$lvl_4['Serie']."'" ; 
											$a .= ",'".$lvl_4['idLicitacion']."'" ; 
											$a .= ",'".$lvl_4['tabla']."'" ; 
											$a .= ",'".$lvl_4['table_value']."'" ; 
											$a .= ",'".$lvl_4['Direccion_img']."'" ; 
											$a .= ",'".$lvl_4['idSubTipo']."'" ; 
											$a .= ",'".$lvl_4['Grasa_inicial']."'" ; 
											$a .= ",'".$lvl_4['Grasa_relubricacion']."'" ; 
											$a .= ",'".$lvl_4['Aceite']."'" ; 
											$a .= ",'".$lvl_4['Cantidad']."'" ; 
											$a .= ",'".$lvl_4['idUml']."'" ; 
											$a .= ",'".$lvl_4['Frecuencia']."'" ; 
											$a .= ",'".$lvl_4['idFrecuencia']."'" ; 
											$a .= ",'".$lvl_4['idProducto']."'" ; 
											$a .= ",'".$lvl_4['Saf']."'" ; 
											$a .= ",'".$lvl_4['Numero']."'" ; 
							 
											// inserto los datos de registro en la db
											$query  = "INSERT INTO `maquinas_listado_level_4` (idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
											Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
											Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
											idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
											VALUES (".$a.")";
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
											$id_lvl_4 = mysqli_insert_id($dbConn);
											
											//Nivel 5
											foreach ($arrLVL_5 as $lvl_5) {
												//Se verifica que sea el mismo sensor
												if($lvl_4['idLevel_4']==$lvl_5['idLevel_4']){
													
													//Se crea la maquina
													$a  = "'".$id_lvl_4."'" ;          
													$a .= ",'".$id_lvl_3."'" ; 
													$a .= ",'".$id_lvl_2."'" ; 
													$a .= ",'".$id_lvl_1."'" ;  
													$a .= ",'".$lvl_5['idSistema']."'" ; 
													$a .= ",'".$maquina_id."'" ; 
													$a .= ",'".$lvl_5['idUtilizable']."'" ;
													$a .= ",'".$lvl_5['Codigo']."'" ;
													$a .= ",'".$lvl_5['Nombre']."'" ;
													$a .= ",'".$lvl_5['Marca']."'" ;
													$a .= ",'".$lvl_5['Modelo']."'" ;
													$a .= ",'".$lvl_5['AnoFab']."'" ;
													$a .= ",'".$lvl_5['Serie']."'" ; 
													$a .= ",'".$lvl_5['idLicitacion']."'" ; 
													$a .= ",'".$lvl_5['tabla']."'" ; 
													$a .= ",'".$lvl_5['table_value']."'" ; 
													$a .= ",'".$lvl_5['Direccion_img']."'" ; 
													$a .= ",'".$lvl_5['idSubTipo']."'" ; 
													$a .= ",'".$lvl_5['Grasa_inicial']."'" ; 
													$a .= ",'".$lvl_5['Grasa_relubricacion']."'" ; 
													$a .= ",'".$lvl_5['Aceite']."'" ; 
													$a .= ",'".$lvl_5['Cantidad']."'" ; 
													$a .= ",'".$lvl_5['idUml']."'" ; 
													$a .= ",'".$lvl_5['Frecuencia']."'" ; 
													$a .= ",'".$lvl_5['idFrecuencia']."'" ; 
													$a .= ",'".$lvl_5['idProducto']."'" ; 
													$a .= ",'".$lvl_5['Saf']."'" ; 
													$a .= ",'".$lvl_5['Numero']."'" ; 
									 
													// inserto los datos de registro en la db
													$query  = "INSERT INTO `maquinas_listado_level_5` (idLevel_4,idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
													Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
													Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
													idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
													VALUES (".$a.")";
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
													$id_lvl_5 = mysqli_insert_id($dbConn);
													
													//Nivel 6
													foreach ($arrLVL_6 as $lvl_6) {
														//Se verifica que sea el mismo sensor
														if($lvl_5['idLevel_5']==$lvl_6['idLevel_5']){
															
															//Se crea la maquina
															$a  = "'".$id_lvl_5."'" ;          
															$a .= ",'".$id_lvl_4."'" ; 
															$a .= ",'".$id_lvl_3."'" ; 
															$a .= ",'".$id_lvl_2."'" ; 
															$a .= ",'".$id_lvl_1."'" ;  
															$a .= ",'".$lvl_6['idSistema']."'" ; 
															$a .= ",'".$maquina_id."'" ; 
															$a .= ",'".$lvl_6['idUtilizable']."'" ;
															$a .= ",'".$lvl_6['Codigo']."'" ;
															$a .= ",'".$lvl_6['Nombre']."'" ;
															$a .= ",'".$lvl_6['Marca']."'" ;
															$a .= ",'".$lvl_6['Modelo']."'" ;
															$a .= ",'".$lvl_6['AnoFab']."'" ;
															$a .= ",'".$lvl_6['Serie']."'" ; 
															$a .= ",'".$lvl_6['idLicitacion']."'" ; 
															$a .= ",'".$lvl_6['tabla']."'" ; 
															$a .= ",'".$lvl_6['table_value']."'" ; 
															$a .= ",'".$lvl_6['Direccion_img']."'" ; 
															$a .= ",'".$lvl_6['idSubTipo']."'" ; 
															$a .= ",'".$lvl_6['Grasa_inicial']."'" ; 
															$a .= ",'".$lvl_6['Grasa_relubricacion']."'" ; 
															$a .= ",'".$lvl_6['Aceite']."'" ; 
															$a .= ",'".$lvl_6['Cantidad']."'" ; 
															$a .= ",'".$lvl_6['idUml']."'" ; 
															$a .= ",'".$lvl_6['Frecuencia']."'" ; 
															$a .= ",'".$lvl_6['idFrecuencia']."'" ; 
															$a .= ",'".$lvl_6['idProducto']."'" ; 
															$a .= ",'".$lvl_6['Saf']."'" ; 
															$a .= ",'".$lvl_6['Numero']."'" ; 
											 
															// inserto los datos de registro en la db
															$query  = "INSERT INTO `maquinas_listado_level_6` (idLevel_5,idLevel_4,idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
															Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
															Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
															idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
															VALUES (".$a.")";
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
															$id_lvl_6 = mysqli_insert_id($dbConn);
															
															//Nivel 7
															foreach ($arrLVL_7 as $lvl_7) {
																//Se verifica que sea el mismo sensor
																if($lvl_6['idLevel_6']==$lvl_7['idLevel_6']){
																	
																	//Se crea la maquina
																	$a  = "'".$id_lvl_6."'" ;          
																	$a .= ",'".$id_lvl_5."'" ; 
																	$a .= ",'".$id_lvl_4."'" ; 
																	$a .= ",'".$id_lvl_3."'" ; 
																	$a .= ",'".$id_lvl_2."'" ; 
																	$a .= ",'".$id_lvl_1."'" ; 
																	$a .= ",'".$lvl_7['idSistema']."'" ; 
																	$a .= ",'".$maquina_id."'" ; 
																	$a .= ",'".$lvl_7['idUtilizable']."'" ;
																	$a .= ",'".$lvl_7['Codigo']."'" ;
																	$a .= ",'".$lvl_7['Nombre']."'" ;
																	$a .= ",'".$lvl_7['Marca']."'" ;
																	$a .= ",'".$lvl_7['Modelo']."'" ;
																	$a .= ",'".$lvl_7['AnoFab']."'" ;
																	$a .= ",'".$lvl_7['Serie']."'" ; 
																	$a .= ",'".$lvl_7['idLicitacion']."'" ; 
																	$a .= ",'".$lvl_7['tabla']."'" ; 
																	$a .= ",'".$lvl_7['table_value']."'" ; 
																	$a .= ",'".$lvl_7['Direccion_img']."'" ; 
																	$a .= ",'".$lvl_7['idSubTipo']."'" ; 
																	$a .= ",'".$lvl_7['Grasa_inicial']."'" ; 
																	$a .= ",'".$lvl_7['Grasa_relubricacion']."'" ; 
																	$a .= ",'".$lvl_7['Aceite']."'" ; 
																	$a .= ",'".$lvl_7['Cantidad']."'" ; 
																	$a .= ",'".$lvl_7['idUml']."'" ; 
																	$a .= ",'".$lvl_7['Frecuencia']."'" ; 
																	$a .= ",'".$lvl_7['idFrecuencia']."'" ; 
																	$a .= ",'".$lvl_7['idProducto']."'" ; 
																	$a .= ",'".$lvl_7['Saf']."'" ; 
																	$a .= ",'".$lvl_7['Numero']."'" ; 
													 
																	// inserto los datos de registro en la db
																	$query  = "INSERT INTO `maquinas_listado_level_7` (idLevel_6,
																	idLevel_5,idLevel_4,idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
																	Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																	Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																	idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
																	VALUES (".$a.")";
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
																	$id_lvl_7 = mysqli_insert_id($dbConn);
																	
																	//Nivel 8
																	foreach ($arrLVL_8 as $lvl_8) {
																		//Se verifica que sea el mismo sensor
																		if($lvl_7['idLevel_7']==$lvl_8['idLevel_7']){
																			
																			//Se crea la maquina
																			$a  = "'".$id_lvl_7."'" ;          
																			$a .= ",'".$id_lvl_6."'" ; 
																			$a .= ",'".$id_lvl_5."'" ; 
																			$a .= ",'".$id_lvl_4."'" ; 
																			$a .= ",'".$id_lvl_3."'" ; 
																			$a .= ",'".$id_lvl_2."'" ; 
																			$a .= ",'".$id_lvl_1."'" ; 
																			$a .= ",'".$lvl_8['idSistema']."'" ; 
																			$a .= ",'".$maquina_id."'" ; 
																			$a .= ",'".$lvl_8['idUtilizable']."'" ;
																			$a .= ",'".$lvl_8['Codigo']."'" ;
																			$a .= ",'".$lvl_8['Nombre']."'" ;
																			$a .= ",'".$lvl_8['Marca']."'" ;
																			$a .= ",'".$lvl_8['Modelo']."'" ;
																			$a .= ",'".$lvl_8['AnoFab']."'" ;
																			$a .= ",'".$lvl_8['Serie']."'" ; 
																			$a .= ",'".$lvl_8['idLicitacion']."'" ; 
																			$a .= ",'".$lvl_8['tabla']."'" ; 
																			$a .= ",'".$lvl_8['table_value']."'" ; 
																			$a .= ",'".$lvl_8['Direccion_img']."'" ; 
																			$a .= ",'".$lvl_8['idSubTipo']."'" ; 
																			$a .= ",'".$lvl_8['Grasa_inicial']."'" ; 
																			$a .= ",'".$lvl_8['Grasa_relubricacion']."'" ; 
																			$a .= ",'".$lvl_8['Aceite']."'" ; 
																			$a .= ",'".$lvl_8['Cantidad']."'" ; 
																			$a .= ",'".$lvl_8['idUml']."'" ; 
																			$a .= ",'".$lvl_8['Frecuencia']."'" ; 
																			$a .= ",'".$lvl_8['idFrecuencia']."'" ; 
																			$a .= ",'".$lvl_8['idProducto']."'" ; 
																			$a .= ",'".$lvl_8['Saf']."'" ; 
																			$a .= ",'".$lvl_8['Numero']."'" ; 
															 
																			// inserto los datos de registro en la db
																			$query  = "INSERT INTO `maquinas_listado_level_8` (idLevel_7,idLevel_6,
																			idLevel_5,idLevel_4,idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
																			Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																			Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																			idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
																			VALUES (".$a.")";
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
																			$id_lvl_8 = mysqli_insert_id($dbConn);
																			
																			//Nivel 9
																			foreach ($arrLVL_9 as $lvl_9) {
																				//Se verifica que sea el mismo sensor
																				if($lvl_8['idLevel_8']==$lvl_9['idLevel_8']){
																					
																					//Se crea la maquina
																					$a  = "'".$id_lvl_8."'" ;          
																					$a .= ",'".$id_lvl_7."'" ; 
																					$a .= ",'".$id_lvl_6."'" ; 
																					$a .= ",'".$id_lvl_5."'" ; 
																					$a .= ",'".$id_lvl_4."'" ; 
																					$a .= ",'".$id_lvl_3."'" ; 
																					$a .= ",'".$id_lvl_2."'" ; 
																					$a .= ",'".$id_lvl_1."'" ;
																					$a .= ",'".$lvl_9['idSistema']."'" ; 
																					$a .= ",'".$maquina_id."'" ; 
																					$a .= ",'".$lvl_9['idUtilizable']."'" ;
																					$a .= ",'".$lvl_9['Codigo']."'" ;
																					$a .= ",'".$lvl_9['Nombre']."'" ;
																					$a .= ",'".$lvl_9['Marca']."'" ;
																					$a .= ",'".$lvl_9['Modelo']."'" ;
																					$a .= ",'".$lvl_9['AnoFab']."'" ;
																					$a .= ",'".$lvl_9['Serie']."'" ; 
																					$a .= ",'".$lvl_9['idLicitacion']."'" ; 
																					$a .= ",'".$lvl_9['tabla']."'" ; 
																					$a .= ",'".$lvl_9['table_value']."'" ; 
																					$a .= ",'".$lvl_9['Direccion_img']."'" ; 
																					$a .= ",'".$lvl_9['idSubTipo']."'" ; 
																					$a .= ",'".$lvl_9['Grasa_inicial']."'" ; 
																					$a .= ",'".$lvl_9['Grasa_relubricacion']."'" ; 
																					$a .= ",'".$lvl_9['Aceite']."'" ; 
																					$a .= ",'".$lvl_9['Cantidad']."'" ; 
																					$a .= ",'".$lvl_9['idUml']."'" ; 
																					$a .= ",'".$lvl_9['Frecuencia']."'" ; 
																					$a .= ",'".$lvl_9['idFrecuencia']."'" ; 
																					$a .= ",'".$lvl_9['idProducto']."'" ; 
																					$a .= ",'".$lvl_9['Saf']."'" ; 
																					$a .= ",'".$lvl_9['Numero']."'" ; 
																	 
																					// inserto los datos de registro en la db
																					$query  = "INSERT INTO `maquinas_listado_level_9` (idLevel_8,idLevel_7,idLevel_6,
																					idLevel_5,idLevel_4,idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
																					Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																					Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																					idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
																					VALUES (".$a.")";
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
																					$id_lvl_9 = mysqli_insert_id($dbConn);
																					
																					//Nivel 10
																					foreach ($arrLVL_10 as $lvl_10) {
																						//Se verifica que sea el mismo sensor
																						if($lvl_9['idLevel_9']==$lvl_10['idLevel_9']){
																							
																							//Se crea la maquina
																							$a  = "'".$id_lvl_9."'" ;          
																							$a .= ",'".$id_lvl_8."'" ; 
																							$a .= ",'".$id_lvl_7."'" ; 
																							$a .= ",'".$id_lvl_6."'" ; 
																							$a .= ",'".$id_lvl_5."'" ; 
																							$a .= ",'".$id_lvl_4."'" ; 
																							$a .= ",'".$id_lvl_3."'" ; 
																							$a .= ",'".$id_lvl_2."'" ; 
																							$a .= ",'".$id_lvl_1."'" ;
																							$a .= ",'".$lvl_10['idSistema']."'" ; 
																							$a .= ",'".$maquina_id."'" ; 
																							$a .= ",'".$lvl_10['idUtilizable']."'" ;
																							$a .= ",'".$lvl_10['Codigo']."'" ;
																							$a .= ",'".$lvl_10['Nombre']."'" ;
																							$a .= ",'".$lvl_10['Marca']."'" ;
																							$a .= ",'".$lvl_10['Modelo']."'" ;
																							$a .= ",'".$lvl_10['AnoFab']."'" ;
																							$a .= ",'".$lvl_10['Serie']."'" ; 
																							$a .= ",'".$lvl_10['idLicitacion']."'" ; 
																							$a .= ",'".$lvl_10['tabla']."'" ; 
																							$a .= ",'".$lvl_10['table_value']."'" ; 
																							$a .= ",'".$lvl_10['Direccion_img']."'" ; 
																							$a .= ",'".$lvl_10['idSubTipo']."'" ; 
																							$a .= ",'".$lvl_10['Grasa_inicial']."'" ; 
																							$a .= ",'".$lvl_10['Grasa_relubricacion']."'" ; 
																							$a .= ",'".$lvl_10['Aceite']."'" ; 
																							$a .= ",'".$lvl_10['Cantidad']."'" ; 
																							$a .= ",'".$lvl_10['idUml']."'" ; 
																							$a .= ",'".$lvl_10['Frecuencia']."'" ; 
																							$a .= ",'".$lvl_10['idFrecuencia']."'" ; 
																							$a .= ",'".$lvl_10['idProducto']."'" ; 
																							$a .= ",'".$lvl_10['Saf']."'" ; 
																							$a .= ",'".$lvl_10['Numero']."'" ; 
																			 
																							// inserto los datos de registro en la db
																							$query  = "INSERT INTO `maquinas_listado_level_10` (idLevel_9,idLevel_8,idLevel_7,idLevel_6,
																							idLevel_5,idLevel_4,idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
																							Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																							Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																							idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
																							VALUES (".$a.")";
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
																							$id_lvl_10 = mysqli_insert_id($dbConn);
																							
																							//Nivel 11
																							foreach ($arrLVL_11 as $lvl_11) {
																								//Se verifica que sea el mismo sensor
																								if($lvl_10['idLevel_10']==$lvl_11['idLevel_10']){
																									
																									//Se crea la maquina
																									$a  = "'".$id_lvl_10."'" ;          
																									$a .= ",'".$id_lvl_9."'" ; 
																									$a .= ",'".$id_lvl_8."'" ; 
																									$a .= ",'".$id_lvl_7."'" ; 
																									$a .= ",'".$id_lvl_6."'" ; 
																									$a .= ",'".$id_lvl_5."'" ; 
																									$a .= ",'".$id_lvl_4."'" ; 
																									$a .= ",'".$id_lvl_3."'" ; 
																									$a .= ",'".$id_lvl_2."'" ; 
																									$a .= ",'".$id_lvl_1."'" ; 
																									$a .= ",'".$lvl_11['idSistema']."'" ; 
																									$a .= ",'".$maquina_id."'" ; 
																									$a .= ",'".$lvl_11['idUtilizable']."'" ;
																									$a .= ",'".$lvl_11['Codigo']."'" ;
																									$a .= ",'".$lvl_11['Nombre']."'" ;
																									$a .= ",'".$lvl_11['Marca']."'" ;
																									$a .= ",'".$lvl_11['Modelo']."'" ;
																									$a .= ",'".$lvl_11['AnoFab']."'" ;
																									$a .= ",'".$lvl_11['Serie']."'" ; 
																									$a .= ",'".$lvl_11['idLicitacion']."'" ; 
																									$a .= ",'".$lvl_11['tabla']."'" ; 
																									$a .= ",'".$lvl_11['table_value']."'" ; 
																									$a .= ",'".$lvl_11['Direccion_img']."'" ; 
																									$a .= ",'".$lvl_11['idSubTipo']."'" ; 
																									$a .= ",'".$lvl_11['Grasa_inicial']."'" ; 
																									$a .= ",'".$lvl_11['Grasa_relubricacion']."'" ; 
																									$a .= ",'".$lvl_11['Aceite']."'" ; 
																									$a .= ",'".$lvl_11['Cantidad']."'" ; 
																									$a .= ",'".$lvl_11['idUml']."'" ; 
																									$a .= ",'".$lvl_11['Frecuencia']."'" ; 
																									$a .= ",'".$lvl_11['idFrecuencia']."'" ; 
																									$a .= ",'".$lvl_11['idProducto']."'" ; 
																									$a .= ",'".$lvl_11['Saf']."'" ; 
																									$a .= ",'".$lvl_11['Numero']."'" ; 
																					 
																									// inserto los datos de registro en la db
																									$query  = "INSERT INTO `maquinas_listado_level_11` (idLevel_10,idLevel_9,idLevel_8,idLevel_7,idLevel_6,
																									idLevel_5,idLevel_4,idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
																									Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																									Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																									idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
																									VALUES (".$a.")";
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
																									$id_lvl_11 = mysqli_insert_id($dbConn);
																									
																									//Nivel 12
																									foreach ($arrLVL_12 as $lvl_12) {
																										//Se verifica que sea el mismo sensor
																										if($lvl_11['idLevel_11']==$lvl_12['idLevel_11']){
																											
																											//Se crea la maquina
																											$a  = "'".$id_lvl_11."'" ;          
																											$a .= ",'".$id_lvl_10."'" ; 
																											$a .= ",'".$id_lvl_9."'" ; 
																											$a .= ",'".$id_lvl_8."'" ; 
																											$a .= ",'".$id_lvl_7."'" ; 
																											$a .= ",'".$id_lvl_6."'" ; 
																											$a .= ",'".$id_lvl_5."'" ; 
																											$a .= ",'".$id_lvl_4."'" ; 
																											$a .= ",'".$id_lvl_3."'" ; 
																											$a .= ",'".$id_lvl_2."'" ; 
																											$a .= ",'".$id_lvl_1."'" ; 
																											$a .= ",'".$lvl_12['idSistema']."'" ; 
																											$a .= ",'".$maquina_id."'" ; 
																											$a .= ",'".$lvl_12['idUtilizable']."'" ;
																											$a .= ",'".$lvl_12['Codigo']."'" ;
																											$a .= ",'".$lvl_12['Nombre']."'" ;
																											$a .= ",'".$lvl_12['Marca']."'" ;
																											$a .= ",'".$lvl_12['Modelo']."'" ;
																											$a .= ",'".$lvl_12['AnoFab']."'" ;
																											$a .= ",'".$lvl_12['Serie']."'" ; 
																											$a .= ",'".$lvl_12['idLicitacion']."'" ; 
																											$a .= ",'".$lvl_12['tabla']."'" ; 
																											$a .= ",'".$lvl_12['table_value']."'" ; 
																											$a .= ",'".$lvl_12['Direccion_img']."'" ; 
																											$a .= ",'".$lvl_12['idSubTipo']."'" ; 
																											$a .= ",'".$lvl_12['Grasa_inicial']."'" ; 
																											$a .= ",'".$lvl_12['Grasa_relubricacion']."'" ; 
																											$a .= ",'".$lvl_12['Aceite']."'" ; 
																											$a .= ",'".$lvl_12['Cantidad']."'" ; 
																											$a .= ",'".$lvl_12['idUml']."'" ; 
																											$a .= ",'".$lvl_12['Frecuencia']."'" ; 
																											$a .= ",'".$lvl_12['idFrecuencia']."'" ; 
																											$a .= ",'".$lvl_12['idProducto']."'" ; 
																											$a .= ",'".$lvl_12['Saf']."'" ; 
																											$a .= ",'".$lvl_12['Numero']."'" ; 
																							 
																											// inserto los datos de registro en la db
																											$query  = "INSERT INTO `maquinas_listado_level_12` (idLevel_11,idLevel_10,idLevel_9,idLevel_8,idLevel_7,idLevel_6,
																											idLevel_5,idLevel_4,idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
																											Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																											Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																											idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
																											VALUES (".$a.")";
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
																											$id_lvl_12 = mysqli_insert_id($dbConn);
																											
																											//Nivel 13
																											foreach ($arrLVL_13 as $lvl_13) {
																												//Se verifica que sea el mismo sensor
																												if($lvl_12['idLevel_12']==$lvl_13['idLevel_12']){
																													
																													//Se crea la maquina
																													$a  = "'".$id_lvl_12."'" ;          
																													$a .= ",'".$id_lvl_11."'" ; 
																													$a .= ",'".$id_lvl_10."'" ; 
																													$a .= ",'".$id_lvl_9."'" ; 
																													$a .= ",'".$id_lvl_8."'" ; 
																													$a .= ",'".$id_lvl_7."'" ; 
																													$a .= ",'".$id_lvl_6."'" ; 
																													$a .= ",'".$id_lvl_5."'" ; 
																													$a .= ",'".$id_lvl_4."'" ; 
																													$a .= ",'".$id_lvl_3."'" ; 
																													$a .= ",'".$id_lvl_2."'" ; 
																													$a .= ",'".$id_lvl_1."'" ; 
																													$a .= ",'".$lvl_13['idSistema']."'" ; 
																													$a .= ",'".$maquina_id."'" ; 
																													$a .= ",'".$lvl_13['idUtilizable']."'" ;
																													$a .= ",'".$lvl_13['Codigo']."'" ;
																													$a .= ",'".$lvl_13['Nombre']."'" ;
																													$a .= ",'".$lvl_13['Marca']."'" ;
																													$a .= ",'".$lvl_13['Modelo']."'" ;
																													$a .= ",'".$lvl_13['AnoFab']."'" ;
																													$a .= ",'".$lvl_13['Serie']."'" ; 
																													$a .= ",'".$lvl_13['idLicitacion']."'" ; 
																													$a .= ",'".$lvl_13['tabla']."'" ; 
																													$a .= ",'".$lvl_13['table_value']."'" ; 
																													$a .= ",'".$lvl_13['Direccion_img']."'" ; 
																													$a .= ",'".$lvl_13['idSubTipo']."'" ; 
																													$a .= ",'".$lvl_13['Grasa_inicial']."'" ; 
																													$a .= ",'".$lvl_13['Grasa_relubricacion']."'" ; 
																													$a .= ",'".$lvl_13['Aceite']."'" ; 
																													$a .= ",'".$lvl_13['Cantidad']."'" ; 
																													$a .= ",'".$lvl_13['idUml']."'" ; 
																													$a .= ",'".$lvl_13['Frecuencia']."'" ; 
																													$a .= ",'".$lvl_13['idFrecuencia']."'" ; 
																													$a .= ",'".$lvl_13['idProducto']."'" ; 
																													$a .= ",'".$lvl_13['Saf']."'" ; 
																													$a .= ",'".$lvl_13['Numero']."'" ; 
																									 
																													// inserto los datos de registro en la db
																													$query  = "INSERT INTO `maquinas_listado_level_13` (idLevel_12,idLevel_11,idLevel_10,idLevel_9,idLevel_8,idLevel_7,idLevel_6,
																													idLevel_5,idLevel_4,idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
																													Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																													Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																													idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
																													VALUES (".$a.")";
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
																													$id_lvl_13 = mysqli_insert_id($dbConn);
																													
																													//Nivel 14
																													foreach ($arrLVL_14 as $lvl_14) {
																														//Se verifica que sea el mismo sensor
																														if($lvl_13['idLevel_13']==$lvl_14['idLevel_13']){
																															
																															//Se crea la maquina
																															$a  = "'".$id_lvl_13."'" ;          
																															$a .= ",'".$id_lvl_12."'" ; 
																															$a .= ",'".$id_lvl_11."'" ; 
																															$a .= ",'".$id_lvl_10."'" ; 
																															$a .= ",'".$id_lvl_9."'" ; 
																															$a .= ",'".$id_lvl_8."'" ; 
																															$a .= ",'".$id_lvl_7."'" ; 
																															$a .= ",'".$id_lvl_6."'" ; 
																															$a .= ",'".$id_lvl_5."'" ; 
																															$a .= ",'".$id_lvl_4."'" ; 
																															$a .= ",'".$id_lvl_3."'" ; 
																															$a .= ",'".$id_lvl_2."'" ; 
																															$a .= ",'".$id_lvl_1."'" ; 
																															$a .= ",'".$lvl_14['idSistema']."'" ; 
																															$a .= ",'".$maquina_id."'" ; 
																															$a .= ",'".$lvl_14['idUtilizable']."'" ;
																															$a .= ",'".$lvl_14['Codigo']."'" ;
																															$a .= ",'".$lvl_14['Nombre']."'" ;
																															$a .= ",'".$lvl_14['Marca']."'" ;
																															$a .= ",'".$lvl_14['Modelo']."'" ;
																															$a .= ",'".$lvl_14['AnoFab']."'" ;
																															$a .= ",'".$lvl_14['Serie']."'" ; 
																															$a .= ",'".$lvl_14['idLicitacion']."'" ; 
																															$a .= ",'".$lvl_14['tabla']."'" ; 
																															$a .= ",'".$lvl_14['table_value']."'" ; 
																															$a .= ",'".$lvl_14['Direccion_img']."'" ; 
																															$a .= ",'".$lvl_14['idSubTipo']."'" ; 
																															$a .= ",'".$lvl_14['Grasa_inicial']."'" ; 
																															$a .= ",'".$lvl_14['Grasa_relubricacion']."'" ; 
																															$a .= ",'".$lvl_14['Aceite']."'" ; 
																															$a .= ",'".$lvl_14['Cantidad']."'" ; 
																															$a .= ",'".$lvl_14['idUml']."'" ; 
																															$a .= ",'".$lvl_14['Frecuencia']."'" ; 
																															$a .= ",'".$lvl_14['idFrecuencia']."'" ; 
																															$a .= ",'".$lvl_14['idProducto']."'" ; 
																															$a .= ",'".$lvl_14['Saf']."'" ; 
																															$a .= ",'".$lvl_14['Numero']."'" ; 
																											 
																															// inserto los datos de registro en la db
																															$query  = "INSERT INTO `maquinas_listado_level_14` (idLevel_13,idLevel_12,idLevel_11,idLevel_10,idLevel_9,idLevel_8,idLevel_7,idLevel_6,
																															idLevel_5,idLevel_4,idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
																															Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																															Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																															idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
																															VALUES (".$a.")";
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
																															$id_lvl_14 = mysqli_insert_id($dbConn);
																															
																															//Nivel 15
																															foreach ($arrLVL_15 as $lvl_15) {
																																//Se verifica que sea el mismo sensor
																																if($lvl_14['idLevel_14']==$lvl_15['idLevel_14']){
																																	
																																	//Se crea la maquina
																																	$a  = "'".$id_lvl_14."'" ;          
																																	$a .= ",'".$id_lvl_13."'" ; 
																																	$a .= ",'".$id_lvl_12."'" ; 
																																	$a .= ",'".$id_lvl_11."'" ; 
																																	$a .= ",'".$id_lvl_10."'" ; 
																																	$a .= ",'".$id_lvl_9."'" ; 
																																	$a .= ",'".$id_lvl_8."'" ; 
																																	$a .= ",'".$id_lvl_7."'" ; 
																																	$a .= ",'".$id_lvl_6."'" ; 
																																	$a .= ",'".$id_lvl_5."'" ; 
																																	$a .= ",'".$id_lvl_4."'" ; 
																																	$a .= ",'".$id_lvl_3."'" ; 
																																	$a .= ",'".$id_lvl_2."'" ; 
																																	$a .= ",'".$id_lvl_1."'" ;
																																	$a .= ",'".$lvl_15['idSistema']."'" ; 
																																	$a .= ",'".$maquina_id."'" ; 
																																	$a .= ",'".$lvl_15['idUtilizable']."'" ;
																																	$a .= ",'".$lvl_15['Codigo']."'" ;
																																	$a .= ",'".$lvl_15['Nombre']."'" ;
																																	$a .= ",'".$lvl_15['Marca']."'" ;
																																	$a .= ",'".$lvl_15['Modelo']."'" ;
																																	$a .= ",'".$lvl_15['AnoFab']."'" ;
																																	$a .= ",'".$lvl_15['Serie']."'" ; 
																																	$a .= ",'".$lvl_15['idLicitacion']."'" ; 
																																	$a .= ",'".$lvl_15['tabla']."'" ; 
																																	$a .= ",'".$lvl_15['table_value']."'" ; 
																																	$a .= ",'".$lvl_15['Direccion_img']."'" ; 
																																	$a .= ",'".$lvl_15['idSubTipo']."'" ; 
																																	$a .= ",'".$lvl_15['Grasa_inicial']."'" ; 
																																	$a .= ",'".$lvl_15['Grasa_relubricacion']."'" ; 
																																	$a .= ",'".$lvl_15['Aceite']."'" ; 
																																	$a .= ",'".$lvl_15['Cantidad']."'" ; 
																																	$a .= ",'".$lvl_15['idUml']."'" ; 
																																	$a .= ",'".$lvl_15['Frecuencia']."'" ; 
																																	$a .= ",'".$lvl_15['idFrecuencia']."'" ; 
																																	$a .= ",'".$lvl_15['idProducto']."'" ; 
																																	$a .= ",'".$lvl_15['Saf']."'" ; 
																																	$a .= ",'".$lvl_15['Numero']."'" ; 
																													 
																																	// inserto los datos de registro en la db
																																	$query  = "INSERT INTO `maquinas_listado_level_15` (idLevel_14,
																																	idLevel_13,idLevel_12,idLevel_11,idLevel_10,idLevel_9,idLevel_8,idLevel_7,idLevel_6,
																																	idLevel_5,idLevel_4,idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
																																	Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																	Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																	idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
																																	VALUES (".$a.")";
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
																																	$id_lvl_15 = mysqli_insert_id($dbConn);
																																	
																																	//Nivel 16
																																	/*foreach ($arrLVL_16 as $lvl_16) {
																																		//Se verifica que sea el mismo sensor
																																		if($lvl_15['idLevel_15']==$lvl_16['idLevel_15']){
																																			
																																			//Se crea la maquina
																																			$a  = "'".$id_lvl_15."'" ;          
																																			$a .= ",'".$id_lvl_14."'" ; 
																																			$a .= ",'".$id_lvl_13."'" ; 
																																			$a .= ",'".$id_lvl_12."'" ; 
																																			$a .= ",'".$id_lvl_11."'" ; 
																																			$a .= ",'".$id_lvl_10."'" ; 
																																			$a .= ",'".$id_lvl_9."'" ; 
																																			$a .= ",'".$id_lvl_8."'" ; 
																																			$a .= ",'".$id_lvl_7."'" ; 
																																			$a .= ",'".$id_lvl_6."'" ; 
																																			$a .= ",'".$id_lvl_5."'" ; 
																																			$a .= ",'".$id_lvl_4."'" ; 
																																			$a .= ",'".$id_lvl_3."'" ; 
																																			$a .= ",'".$id_lvl_2."'" ; 
																																			$a .= ",'".$id_lvl_1."'" ;
																																			$a .= ",'".$lvl_16['idSistema']."'" ; 
																																			$a .= ",'".$maquina_id."'" ; 
																																			$a .= ",'".$lvl_16['idUtilizable']."'" ;
																																			$a .= ",'".$lvl_16['Codigo']."'" ;
																																			$a .= ",'".$lvl_16['Nombre']."'" ;
																																			$a .= ",'".$lvl_16['Marca']."'" ;
																																			$a .= ",'".$lvl_16['Modelo']."'" ;
																																			$a .= ",'".$lvl_16['AnoFab']."'" ;
																																			$a .= ",'".$lvl_16['Serie']."'" ; 
																																			$a .= ",'".$lvl_16['idLicitacion']."'" ; 
																																			$a .= ",'".$lvl_16['tabla']."'" ; 
																																			$a .= ",'".$lvl_16['table_value']."'" ; 
																																			$a .= ",'".$lvl_16['Direccion_img']."'" ; 
																																			$a .= ",'".$lvl_16['idSubTipo']."'" ; 
																																			$a .= ",'".$lvl_16['Grasa_inicial']."'" ; 
																																			$a .= ",'".$lvl_16['Grasa_relubricacion']."'" ; 
																																			$a .= ",'".$lvl_16['Aceite']."'" ; 
																																			$a .= ",'".$lvl_16['Cantidad']."'" ; 
																																			$a .= ",'".$lvl_16['idUml']."'" ; 
																																			$a .= ",'".$lvl_16['Frecuencia']."'" ; 
																																			$a .= ",'".$lvl_16['idFrecuencia']."'" ; 
																																			$a .= ",'".$lvl_16['idProducto']."'" ; 
																																			$a .= ",'".$lvl_16['Saf']."'" ; 
																																			$a .= ",'".$lvl_16['Numero']."'" ; 
																															 
																																			// inserto los datos de registro en la db
																																			$query  = "INSERT INTO `maquinas_listado_level_16` (idLevel_15,idLevel_14,
																																			idLevel_13,idLevel_12,idLevel_11,idLevel_10,idLevel_9,idLevel_8,idLevel_7,idLevel_6,
																																			idLevel_5,idLevel_4,idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
																																			Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																			Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																			idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
																																			VALUES (".$a.")";
																																			$result = mysqli_query($dbConn, $query);
																																			$id_lvl_16 = mysqli_insert_id($dbConn);
																																			
																																			//Nivel 17
																																			foreach ($arrLVL_17 as $lvl_17) {
																																				//Se verifica que sea el mismo sensor
																																				if($lvl_16['idLevel_16']==$lvl_17['idLevel_16']){
																																					
																																					//Se crea la maquina
																																					$a  = "'".$id_lvl_16."'" ;          
																																					$a .= ",'".$id_lvl_15."'" ; 
																																					$a .= ",'".$id_lvl_14."'" ; 
																																					$a .= ",'".$id_lvl_13."'" ; 
																																					$a .= ",'".$id_lvl_12."'" ; 
																																					$a .= ",'".$id_lvl_11."'" ; 
																																					$a .= ",'".$id_lvl_10."'" ; 
																																					$a .= ",'".$id_lvl_9."'" ; 
																																					$a .= ",'".$id_lvl_8."'" ; 
																																					$a .= ",'".$id_lvl_7."'" ; 
																																					$a .= ",'".$id_lvl_6."'" ; 
																																					$a .= ",'".$id_lvl_5."'" ; 
																																					$a .= ",'".$id_lvl_4."'" ; 
																																					$a .= ",'".$id_lvl_3."'" ; 
																																					$a .= ",'".$id_lvl_2."'" ; 
																																					$a .= ",'".$id_lvl_1."'" ; 
																																					$a .= ",'".$lvl_17['idSistema']."'" ; 
																																					$a .= ",'".$maquina_id."'" ; 
																																					$a .= ",'".$lvl_17['idUtilizable']."'" ;
																																					$a .= ",'".$lvl_17['Codigo']."'" ;
																																					$a .= ",'".$lvl_17['Nombre']."'" ;
																																					$a .= ",'".$lvl_17['Marca']."'" ;
																																					$a .= ",'".$lvl_17['Modelo']."'" ;
																																					$a .= ",'".$lvl_17['AnoFab']."'" ;
																																					$a .= ",'".$lvl_17['Serie']."'" ; 
																																					$a .= ",'".$lvl_17['idLicitacion']."'" ; 
																																					$a .= ",'".$lvl_17['tabla']."'" ; 
																																					$a .= ",'".$lvl_17['table_value']."'" ; 
																																					$a .= ",'".$lvl_17['Direccion_img']."'" ; 
																																					$a .= ",'".$lvl_17['idSubTipo']."'" ; 
																																					$a .= ",'".$lvl_17['Grasa_inicial']."'" ; 
																																					$a .= ",'".$lvl_17['Grasa_relubricacion']."'" ; 
																																					$a .= ",'".$lvl_17['Aceite']."'" ; 
																																					$a .= ",'".$lvl_17['Cantidad']."'" ; 
																																					$a .= ",'".$lvl_17['idUml']."'" ; 
																																					$a .= ",'".$lvl_17['Frecuencia']."'" ; 
																																					$a .= ",'".$lvl_17['idFrecuencia']."'" ; 
																																					$a .= ",'".$lvl_17['idProducto']."'" ; 
																																					$a .= ",'".$lvl_17['Saf']."'" ; 
																																					$a .= ",'".$lvl_17['Numero']."'" ; 
																																	 
																																					// inserto los datos de registro en la db
																																					$query  = "INSERT INTO `maquinas_listado_level_17` (idLevel_16,idLevel_15,idLevel_14,
																																					idLevel_13,idLevel_12,idLevel_11,idLevel_10,idLevel_9,idLevel_8,idLevel_7,idLevel_6,
																																					idLevel_5,idLevel_4,idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
																																					Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																					Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																					idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
																																					VALUES (".$a.")";
																																					$result = mysqli_query($dbConn, $query);
																																					$id_lvl_17 = mysqli_insert_id($dbConn);
																																					
																																					//Nivel 18
																																					foreach ($arrLVL_18 as $lvl_18) {
																																						//Se verifica que sea el mismo sensor
																																						if($lvl_17['idLevel_17']==$lvl_18['idLevel_17']){
																																							
																																							//Se crea la maquina
																																							$a  = "'".$id_lvl_17."'" ;          
																																							$a .= ",'".$id_lvl_16."'" ; 
																																							$a .= ",'".$id_lvl_15."'" ; 
																																							$a .= ",'".$id_lvl_14."'" ; 
																																							$a .= ",'".$id_lvl_13."'" ; 
																																							$a .= ",'".$id_lvl_12."'" ; 
																																							$a .= ",'".$id_lvl_11."'" ; 
																																							$a .= ",'".$id_lvl_10."'" ; 
																																							$a .= ",'".$id_lvl_9."'" ; 
																																							$a .= ",'".$id_lvl_8."'" ; 
																																							$a .= ",'".$id_lvl_7."'" ; 
																																							$a .= ",'".$id_lvl_6."'" ; 
																																							$a .= ",'".$id_lvl_5."'" ; 
																																							$a .= ",'".$id_lvl_4."'" ; 
																																							$a .= ",'".$id_lvl_3."'" ; 
																																							$a .= ",'".$id_lvl_2."'" ; 
																																							$a .= ",'".$id_lvl_1."'" ;
																																							$a .= ",'".$lvl_18['idSistema']."'" ; 
																																							$a .= ",'".$maquina_id."'" ; 
																																							$a .= ",'".$lvl_18['idUtilizable']."'" ;
																																							$a .= ",'".$lvl_18['Codigo']."'" ;
																																							$a .= ",'".$lvl_18['Nombre']."'" ;
																																							$a .= ",'".$lvl_18['Marca']."'" ;
																																							$a .= ",'".$lvl_18['Modelo']."'" ;
																																							$a .= ",'".$lvl_18['AnoFab']."'" ;
																																							$a .= ",'".$lvl_18['Serie']."'" ; 
																																							$a .= ",'".$lvl_18['idLicitacion']."'" ; 
																																							$a .= ",'".$lvl_18['tabla']."'" ; 
																																							$a .= ",'".$lvl_18['table_value']."'" ; 
																																							$a .= ",'".$lvl_18['Direccion_img']."'" ; 
																																							$a .= ",'".$lvl_18['idSubTipo']."'" ; 
																																							$a .= ",'".$lvl_18['Grasa_inicial']."'" ; 
																																							$a .= ",'".$lvl_18['Grasa_relubricacion']."'" ; 
																																							$a .= ",'".$lvl_18['Aceite']."'" ; 
																																							$a .= ",'".$lvl_18['Cantidad']."'" ; 
																																							$a .= ",'".$lvl_18['idUml']."'" ; 
																																							$a .= ",'".$lvl_18['Frecuencia']."'" ; 
																																							$a .= ",'".$lvl_18['idFrecuencia']."'" ; 
																																							$a .= ",'".$lvl_18['idProducto']."'" ; 
																																							$a .= ",'".$lvl_18['Saf']."'" ; 
																																							$a .= ",'".$lvl_18['Numero']."'" ; 
																																			 
																																							// inserto los datos de registro en la db
																																							$query  = "INSERT INTO `maquinas_listado_level_18` (idLevel_17,idLevel_16,idLevel_15,idLevel_14,
																																							idLevel_13,idLevel_12,idLevel_11,idLevel_10,idLevel_9,idLevel_8,idLevel_7,idLevel_6,
																																							idLevel_5,idLevel_4,idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
																																							Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																							Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																							idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
																																							VALUES (".$a.")";
																																							$result = mysqli_query($dbConn, $query);
																																							$id_lvl_18 = mysqli_insert_id($dbConn);
																																							
																																							//Nivel 19
																																							foreach ($arrLVL_19 as $lvl_19) {
																																								//Se verifica que sea el mismo sensor
																																								if($lvl_18['idLevel_18']==$lvl_19['idLevel_18']){
																																									
																																									//Se crea la maquina
																																									$a  = "'".$id_lvl_18."'" ;          
																																									$a .= ",'".$id_lvl_17."'" ; 
																																									$a .= ",'".$id_lvl_16."'" ; 
																																									$a .= ",'".$id_lvl_15."'" ; 
																																									$a .= ",'".$id_lvl_14."'" ; 
																																									$a .= ",'".$id_lvl_13."'" ; 
																																									$a .= ",'".$id_lvl_12."'" ; 
																																									$a .= ",'".$id_lvl_11."'" ; 
																																									$a .= ",'".$id_lvl_10."'" ; 
																																									$a .= ",'".$id_lvl_9."'" ; 
																																									$a .= ",'".$id_lvl_8."'" ; 
																																									$a .= ",'".$id_lvl_7."'" ; 
																																									$a .= ",'".$id_lvl_6."'" ; 
																																									$a .= ",'".$id_lvl_5."'" ; 
																																									$a .= ",'".$id_lvl_4."'" ; 
																																									$a .= ",'".$id_lvl_3."'" ; 
																																									$a .= ",'".$id_lvl_2."'" ; 
																																									$a .= ",'".$id_lvl_1."'" ;
																																									$a .= ",'".$lvl_19['idSistema']."'" ; 
																																									$a .= ",'".$maquina_id."'" ; 
																																									$a .= ",'".$lvl_19['idUtilizable']."'" ;
																																									$a .= ",'".$lvl_19['Codigo']."'" ;
																																									$a .= ",'".$lvl_19['Nombre']."'" ;
																																									$a .= ",'".$lvl_19['Marca']."'" ;
																																									$a .= ",'".$lvl_19['Modelo']."'" ;
																																									$a .= ",'".$lvl_19['AnoFab']."'" ;
																																									$a .= ",'".$lvl_19['Serie']."'" ; 
																																									$a .= ",'".$lvl_19['idLicitacion']."'" ; 
																																									$a .= ",'".$lvl_19['tabla']."'" ; 
																																									$a .= ",'".$lvl_19['table_value']."'" ; 
																																									$a .= ",'".$lvl_19['Direccion_img']."'" ; 
																																									$a .= ",'".$lvl_19['idSubTipo']."'" ; 
																																									$a .= ",'".$lvl_19['Grasa_inicial']."'" ; 
																																									$a .= ",'".$lvl_19['Grasa_relubricacion']."'" ; 
																																									$a .= ",'".$lvl_19['Aceite']."'" ; 
																																									$a .= ",'".$lvl_19['Cantidad']."'" ; 
																																									$a .= ",'".$lvl_19['idUml']."'" ; 
																																									$a .= ",'".$lvl_19['Frecuencia']."'" ; 
																																									$a .= ",'".$lvl_19['idFrecuencia']."'" ; 
																																									$a .= ",'".$lvl_19['idProducto']."'" ; 
																																									$a .= ",'".$lvl_19['Saf']."'" ; 
																																									$a .= ",'".$lvl_19['Numero']."'" ; 
																																					 
																																									// inserto los datos de registro en la db
																																									$query  = "INSERT INTO `maquinas_listado_level_19` (idLevel_18,idLevel_17,idLevel_16,idLevel_15,idLevel_14,
																																									idLevel_13,idLevel_12,idLevel_11,idLevel_10,idLevel_9,idLevel_8,idLevel_7,idLevel_6,
																																									idLevel_5,idLevel_4,idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
																																									Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																									Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																									idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
																																									VALUES (".$a.")";
																																									$result = mysqli_query($dbConn, $query);
																																									$id_lvl_19 = mysqli_insert_id($dbConn);
																																									
																																									//Nivel 20
																																									foreach ($arrLVL_20 as $lvl_20) {
																																										//Se verifica que sea el mismo sensor
																																										if($lvl_19['idLevel_19']==$lvl_20['idLevel_19']){
																																											
																																											//Se crea la maquina
																																											$a  = "'".$id_lvl_19."'" ;          
																																											$a .= ",'".$id_lvl_18."'" ; 
																																											$a .= ",'".$id_lvl_17."'" ; 
																																											$a .= ",'".$id_lvl_16."'" ; 
																																											$a .= ",'".$id_lvl_15."'" ; 
																																											$a .= ",'".$id_lvl_14."'" ; 
																																											$a .= ",'".$id_lvl_13."'" ; 
																																											$a .= ",'".$id_lvl_12."'" ; 
																																											$a .= ",'".$id_lvl_11."'" ; 
																																											$a .= ",'".$id_lvl_10."'" ; 
																																											$a .= ",'".$id_lvl_9."'" ; 
																																											$a .= ",'".$id_lvl_8."'" ; 
																																											$a .= ",'".$id_lvl_7."'" ; 
																																											$a .= ",'".$id_lvl_6."'" ; 
																																											$a .= ",'".$id_lvl_5."'" ; 
																																											$a .= ",'".$id_lvl_4."'" ; 
																																											$a .= ",'".$id_lvl_3."'" ; 
																																											$a .= ",'".$id_lvl_2."'" ; 
																																											$a .= ",'".$id_lvl_1."'" ;
																																											$a .= ",'".$lvl_20['idSistema']."'" ; 
																																											$a .= ",'".$maquina_id."'" ; 
																																											$a .= ",'".$lvl_20['idUtilizable']."'" ;
																																											$a .= ",'".$lvl_20['Codigo']."'" ;
																																											$a .= ",'".$lvl_20['Nombre']."'" ;
																																											$a .= ",'".$lvl_20['Marca']."'" ;
																																											$a .= ",'".$lvl_20['Modelo']."'" ;
																																											$a .= ",'".$lvl_20['AnoFab']."'" ;
																																											$a .= ",'".$lvl_20['Serie']."'" ; 
																																											$a .= ",'".$lvl_20['idLicitacion']."'" ; 
																																											$a .= ",'".$lvl_20['tabla']."'" ; 
																																											$a .= ",'".$lvl_20['table_value']."'" ; 
																																											$a .= ",'".$lvl_20['Direccion_img']."'" ; 
																																											$a .= ",'".$lvl_20['idSubTipo']."'" ; 
																																											$a .= ",'".$lvl_20['Grasa_inicial']."'" ; 
																																											$a .= ",'".$lvl_20['Grasa_relubricacion']."'" ; 
																																											$a .= ",'".$lvl_20['Aceite']."'" ; 
																																											$a .= ",'".$lvl_20['Cantidad']."'" ; 
																																											$a .= ",'".$lvl_20['idUml']."'" ; 
																																											$a .= ",'".$lvl_20['Frecuencia']."'" ; 
																																											$a .= ",'".$lvl_20['idFrecuencia']."'" ; 
																																											$a .= ",'".$lvl_20['idProducto']."'" ; 
																																											$a .= ",'".$lvl_20['Saf']."'" ; 
																																											$a .= ",'".$lvl_20['Numero']."'" ; 
																																							 
																																											// inserto los datos de registro en la db
																																											$query  = "INSERT INTO `maquinas_listado_level_20` (idLevel_19,idLevel_18,idLevel_17,idLevel_16,idLevel_15,idLevel_14,
																																											idLevel_13,idLevel_12,idLevel_11,idLevel_10,idLevel_9,idLevel_8,idLevel_7,idLevel_6,
																																											idLevel_5,idLevel_4,idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
																																											Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																											Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																											idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
																																											VALUES (".$a.")";
																																											$result = mysqli_query($dbConn, $query);
																																											$id_lvl_20 = mysqli_insert_id($dbConn);
																																											
																																											//Nivel 21
																																											foreach ($arrLVL_21 as $lvl_21) {
																																												//Se verifica que sea el mismo sensor
																																												if($lvl_20['idLevel_20']==$lvl_21['idLevel_20']){
																																													
																																													//Se crea la maquina
																																													$a  = "'".$id_lvl_20."'" ;          
																																													$a .= ",'".$id_lvl_19."'" ; 
																																													$a .= ",'".$id_lvl_18."'" ; 
																																													$a .= ",'".$id_lvl_17."'" ; 
																																													$a .= ",'".$id_lvl_16."'" ; 
																																													$a .= ",'".$id_lvl_15."'" ; 
																																													$a .= ",'".$id_lvl_14."'" ; 
																																													$a .= ",'".$id_lvl_13."'" ; 
																																													$a .= ",'".$id_lvl_12."'" ; 
																																													$a .= ",'".$id_lvl_11."'" ; 
																																													$a .= ",'".$id_lvl_10."'" ; 
																																													$a .= ",'".$id_lvl_9."'" ; 
																																													$a .= ",'".$id_lvl_8."'" ; 
																																													$a .= ",'".$id_lvl_7."'" ; 
																																													$a .= ",'".$id_lvl_6."'" ; 
																																													$a .= ",'".$id_lvl_5."'" ; 
																																													$a .= ",'".$id_lvl_4."'" ; 
																																													$a .= ",'".$id_lvl_3."'" ; 
																																													$a .= ",'".$id_lvl_2."'" ; 
																																													$a .= ",'".$id_lvl_1."'" ;
																																													$a .= ",'".$lvl_21['idSistema']."'" ; 
																																													$a .= ",'".$maquina_id."'" ; 
																																													$a .= ",'".$lvl_21['idUtilizable']."'" ;
																																													$a .= ",'".$lvl_21['Codigo']."'" ;
																																													$a .= ",'".$lvl_21['Nombre']."'" ;
																																													$a .= ",'".$lvl_21['Marca']."'" ;
																																													$a .= ",'".$lvl_21['Modelo']."'" ;
																																													$a .= ",'".$lvl_21['AnoFab']."'" ;
																																													$a .= ",'".$lvl_21['Serie']."'" ; 
																																													$a .= ",'".$lvl_21['idLicitacion']."'" ; 
																																													$a .= ",'".$lvl_21['tabla']."'" ; 
																																													$a .= ",'".$lvl_21['table_value']."'" ; 
																																													$a .= ",'".$lvl_21['Direccion_img']."'" ; 
																																													$a .= ",'".$lvl_21['idSubTipo']."'" ; 
																																													$a .= ",'".$lvl_21['Grasa_inicial']."'" ; 
																																													$a .= ",'".$lvl_21['Grasa_relubricacion']."'" ; 
																																													$a .= ",'".$lvl_21['Aceite']."'" ; 
																																													$a .= ",'".$lvl_21['Cantidad']."'" ; 
																																													$a .= ",'".$lvl_21['idUml']."'" ; 
																																													$a .= ",'".$lvl_21['Frecuencia']."'" ; 
																																													$a .= ",'".$lvl_21['idFrecuencia']."'" ; 
																																													$a .= ",'".$lvl_21['idProducto']."'" ; 
																																													$a .= ",'".$lvl_21['Saf']."'" ; 
																																													$a .= ",'".$lvl_21['Numero']."'" ; 
																																									 
																																													// inserto los datos de registro en la db
																																													$query  = "INSERT INTO `maquinas_listado_level_21` (idLevel_20,idLevel_19,idLevel_18,idLevel_17,idLevel_16,idLevel_15,idLevel_14,
																																													idLevel_13,idLevel_12,idLevel_11,idLevel_10,idLevel_9,idLevel_8,idLevel_7,idLevel_6,
																																													idLevel_5,idLevel_4,idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
																																													Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																													Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																													idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
																																													VALUES (".$a.")";
																																													$result = mysqli_query($dbConn, $query);
																																													$id_lvl_21 = mysqli_insert_id($dbConn);
																																													
																																													//Nivel 22
																																													foreach ($arrLVL_22 as $lvl_22) {
																																														//Se verifica que sea el mismo sensor
																																														if($lvl_21['idLevel_21']==$lvl_22['idLevel_21']){
																																															
																																															//Se crea la maquina
																																															$a  = "'".$id_lvl_21."'" ;          
																																															$a .= ",'".$id_lvl_20."'" ; 
																																															$a .= ",'".$id_lvl_19."'" ; 
																																															$a .= ",'".$id_lvl_18."'" ; 
																																															$a .= ",'".$id_lvl_17."'" ; 
																																															$a .= ",'".$id_lvl_16."'" ; 
																																															$a .= ",'".$id_lvl_15."'" ; 
																																															$a .= ",'".$id_lvl_14."'" ; 
																																															$a .= ",'".$id_lvl_13."'" ; 
																																															$a .= ",'".$id_lvl_12."'" ; 
																																															$a .= ",'".$id_lvl_11."'" ; 
																																															$a .= ",'".$id_lvl_10."'" ; 
																																															$a .= ",'".$id_lvl_9."'" ; 
																																															$a .= ",'".$id_lvl_8."'" ; 
																																															$a .= ",'".$id_lvl_7."'" ; 
																																															$a .= ",'".$id_lvl_6."'" ; 
																																															$a .= ",'".$id_lvl_5."'" ; 
																																															$a .= ",'".$id_lvl_4."'" ; 
																																															$a .= ",'".$id_lvl_3."'" ; 
																																															$a .= ",'".$id_lvl_2."'" ; 
																																															$a .= ",'".$id_lvl_1."'" ; 
																																															$a .= ",'".$lvl_22['idSistema']."'" ; 
																																															$a .= ",'".$maquina_id."'" ; 
																																															$a .= ",'".$lvl_22['idUtilizable']."'" ;
																																															$a .= ",'".$lvl_22['Codigo']."'" ;
																																															$a .= ",'".$lvl_22['Nombre']."'" ;
																																															$a .= ",'".$lvl_22['Marca']."'" ;
																																															$a .= ",'".$lvl_22['Modelo']."'" ;
																																															$a .= ",'".$lvl_22['AnoFab']."'" ;
																																															$a .= ",'".$lvl_22['Serie']."'" ; 
																																															$a .= ",'".$lvl_22['idLicitacion']."'" ; 
																																															$a .= ",'".$lvl_22['tabla']."'" ; 
																																															$a .= ",'".$lvl_22['table_value']."'" ; 
																																															$a .= ",'".$lvl_22['Direccion_img']."'" ; 
																																															$a .= ",'".$lvl_22['idSubTipo']."'" ; 
																																															$a .= ",'".$lvl_22['Grasa_inicial']."'" ; 
																																															$a .= ",'".$lvl_22['Grasa_relubricacion']."'" ; 
																																															$a .= ",'".$lvl_22['Aceite']."'" ; 
																																															$a .= ",'".$lvl_22['Cantidad']."'" ; 
																																															$a .= ",'".$lvl_22['idUml']."'" ; 
																																															$a .= ",'".$lvl_22['Frecuencia']."'" ; 
																																															$a .= ",'".$lvl_22['idFrecuencia']."'" ; 
																																															$a .= ",'".$lvl_22['idProducto']."'" ; 
																																															$a .= ",'".$lvl_22['Saf']."'" ; 
																																															$a .= ",'".$lvl_22['Numero']."'" ; 
																																											 
																																															// inserto los datos de registro en la db
																																															$query  = "INSERT INTO `maquinas_listado_level_22` (idLevel_21,idLevel_20,idLevel_19,idLevel_18,idLevel_17,idLevel_16,idLevel_15,idLevel_14,
																																															idLevel_13,idLevel_12,idLevel_11,idLevel_10,idLevel_9,idLevel_8,idLevel_7,idLevel_6,
																																															idLevel_5,idLevel_4,idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
																																															Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																															Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																															idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
																																															VALUES (".$a.")";
																																															$result = mysqli_query($dbConn, $query);
																																															$id_lvl_22 = mysqli_insert_id($dbConn);
																																															
																																															//Nivel 23
																																															foreach ($arrLVL_23 as $lvl_23) {
																																																//Se verifica que sea el mismo sensor
																																																if($lvl_22['idLevel_22']==$lvl_23['idLevel_22']){
																																																	
																																																	//Se crea la maquina
																																																	$a  = "'".$id_lvl_22."'" ;          
																																																	$a .= ",'".$id_lvl_21."'" ; 
																																																	$a .= ",'".$id_lvl_20."'" ; 
																																																	$a .= ",'".$id_lvl_19."'" ; 
																																																	$a .= ",'".$id_lvl_18."'" ; 
																																																	$a .= ",'".$id_lvl_17."'" ; 
																																																	$a .= ",'".$id_lvl_16."'" ; 
																																																	$a .= ",'".$id_lvl_15."'" ; 
																																																	$a .= ",'".$id_lvl_14."'" ; 
																																																	$a .= ",'".$id_lvl_13."'" ; 
																																																	$a .= ",'".$id_lvl_12."'" ; 
																																																	$a .= ",'".$id_lvl_11."'" ; 
																																																	$a .= ",'".$id_lvl_10."'" ; 
																																																	$a .= ",'".$id_lvl_9."'" ; 
																																																	$a .= ",'".$id_lvl_8."'" ; 
																																																	$a .= ",'".$id_lvl_7."'" ; 
																																																	$a .= ",'".$id_lvl_6."'" ; 
																																																	$a .= ",'".$id_lvl_5."'" ; 
																																																	$a .= ",'".$id_lvl_4."'" ; 
																																																	$a .= ",'".$id_lvl_3."'" ; 
																																																	$a .= ",'".$id_lvl_2."'" ; 
																																																	$a .= ",'".$id_lvl_1."'" ; 
																																																	$a .= ",'".$lvl_23['idSistema']."'" ; 
																																																	$a .= ",'".$maquina_id."'" ; 
																																																	$a .= ",'".$lvl_23['idUtilizable']."'" ;
																																																	$a .= ",'".$lvl_23['Codigo']."'" ;
																																																	$a .= ",'".$lvl_23['Nombre']."'" ;
																																																	$a .= ",'".$lvl_23['Marca']."'" ;
																																																	$a .= ",'".$lvl_23['Modelo']."'" ;
																																																	$a .= ",'".$lvl_23['AnoFab']."'" ;
																																																	$a .= ",'".$lvl_23['Serie']."'" ; 
																																																	$a .= ",'".$lvl_23['idLicitacion']."'" ; 
																																																	$a .= ",'".$lvl_23['tabla']."'" ; 
																																																	$a .= ",'".$lvl_23['table_value']."'" ; 
																																																	$a .= ",'".$lvl_23['Direccion_img']."'" ; 
																																																	$a .= ",'".$lvl_23['idSubTipo']."'" ; 
																																																	$a .= ",'".$lvl_23['Grasa_inicial']."'" ; 
																																																	$a .= ",'".$lvl_23['Grasa_relubricacion']."'" ; 
																																																	$a .= ",'".$lvl_23['Aceite']."'" ; 
																																																	$a .= ",'".$lvl_23['Cantidad']."'" ; 
																																																	$a .= ",'".$lvl_23['idUml']."'" ; 
																																																	$a .= ",'".$lvl_23['Frecuencia']."'" ; 
																																																	$a .= ",'".$lvl_23['idFrecuencia']."'" ; 
																																																	$a .= ",'".$lvl_23['idProducto']."'" ; 
																																																	$a .= ",'".$lvl_23['Saf']."'" ; 
																																																	$a .= ",'".$lvl_23['Numero']."'" ; 
																																													 
																																																	// inserto los datos de registro en la db
																																																	$query  = "INSERT INTO `maquinas_listado_level_23` (idLevel_22,
																																																	idLevel_21,idLevel_20,idLevel_19,idLevel_18,idLevel_17,idLevel_16,idLevel_15,idLevel_14,
																																																	idLevel_13,idLevel_12,idLevel_11,idLevel_10,idLevel_9,idLevel_8,idLevel_7,idLevel_6,
																																																	idLevel_5,idLevel_4,idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
																																																	Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																																	Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																																	idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
																																																	VALUES (".$a.")";
																																																	$result = mysqli_query($dbConn, $query);
																																																	$id_lvl_23 = mysqli_insert_id($dbConn);
																																																	
																																																	//Nivel 24
																																																	foreach ($arrLVL_24 as $lvl_24) {
																																																		//Se verifica que sea el mismo sensor
																																																		if($lvl_23['idLevel_23']==$lvl_24['idLevel_23']){
																																																			
																																																			//Se crea la maquina
																																																			$a  = "'".$id_lvl_23."'" ;          
																																																			$a .= ",'".$id_lvl_22."'" ; 
																																																			$a .= ",'".$id_lvl_21."'" ; 
																																																			$a .= ",'".$id_lvl_20."'" ; 
																																																			$a .= ",'".$id_lvl_19."'" ; 
																																																			$a .= ",'".$id_lvl_18."'" ; 
																																																			$a .= ",'".$id_lvl_17."'" ; 
																																																			$a .= ",'".$id_lvl_16."'" ; 
																																																			$a .= ",'".$id_lvl_15."'" ; 
																																																			$a .= ",'".$id_lvl_14."'" ; 
																																																			$a .= ",'".$id_lvl_13."'" ; 
																																																			$a .= ",'".$id_lvl_12."'" ; 
																																																			$a .= ",'".$id_lvl_11."'" ; 
																																																			$a .= ",'".$id_lvl_10."'" ; 
																																																			$a .= ",'".$id_lvl_9."'" ; 
																																																			$a .= ",'".$id_lvl_8."'" ; 
																																																			$a .= ",'".$id_lvl_7."'" ; 
																																																			$a .= ",'".$id_lvl_6."'" ; 
																																																			$a .= ",'".$id_lvl_5."'" ; 
																																																			$a .= ",'".$id_lvl_4."'" ; 
																																																			$a .= ",'".$id_lvl_3."'" ; 
																																																			$a .= ",'".$id_lvl_2."'" ; 
																																																			$a .= ",'".$id_lvl_1."'" ; 
																																																			$a .= ",'".$lvl_24['idSistema']."'" ; 
																																																			$a .= ",'".$maquina_id."'" ; 
																																																			$a .= ",'".$lvl_24['idUtilizable']."'" ;
																																																			$a .= ",'".$lvl_24['Codigo']."'" ;
																																																			$a .= ",'".$lvl_24['Nombre']."'" ;
																																																			$a .= ",'".$lvl_24['Marca']."'" ;
																																																			$a .= ",'".$lvl_24['Modelo']."'" ;
																																																			$a .= ",'".$lvl_24['AnoFab']."'" ;
																																																			$a .= ",'".$lvl_24['Serie']."'" ; 
																																																			$a .= ",'".$lvl_24['idLicitacion']."'" ; 
																																																			$a .= ",'".$lvl_24['tabla']."'" ; 
																																																			$a .= ",'".$lvl_24['table_value']."'" ; 
																																																			$a .= ",'".$lvl_24['Direccion_img']."'" ; 
																																																			$a .= ",'".$lvl_24['idSubTipo']."'" ; 
																																																			$a .= ",'".$lvl_24['Grasa_inicial']."'" ; 
																																																			$a .= ",'".$lvl_24['Grasa_relubricacion']."'" ; 
																																																			$a .= ",'".$lvl_24['Aceite']."'" ; 
																																																			$a .= ",'".$lvl_24['Cantidad']."'" ; 
																																																			$a .= ",'".$lvl_24['idUml']."'" ; 
																																																			$a .= ",'".$lvl_24['Frecuencia']."'" ; 
																																																			$a .= ",'".$lvl_24['idFrecuencia']."'" ; 
																																																			$a .= ",'".$lvl_24['idProducto']."'" ; 
																																																			$a .= ",'".$lvl_24['Saf']."'" ; 
																																																			$a .= ",'".$lvl_24['Numero']."'" ; 
																																															 
																																																			// inserto los datos de registro en la db
																																																			$query  = "INSERT INTO `maquinas_listado_level_24` (idLevel_23,idLevel_22,
																																																			idLevel_21,idLevel_20,idLevel_19,idLevel_18,idLevel_17,idLevel_16,idLevel_15,idLevel_14,
																																																			idLevel_13,idLevel_12,idLevel_11,idLevel_10,idLevel_9,idLevel_8,idLevel_7,idLevel_6,
																																																			idLevel_5,idLevel_4,idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
																																																			Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																																			Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																																			idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
																																																			VALUES (".$a.")";
																																																			$result = mysqli_query($dbConn, $query);
																																																			$id_lvl_24 = mysqli_insert_id($dbConn);
																																																			
																																																			//Nivel 25
																																																			foreach ($arrLVL_25 as $lvl_25) {
																																																				//Se verifica que sea el mismo sensor
																																																				if($lvl_24['idLevel_24']==$lvl_25['idLevel_24']){
																																																					
																																																					//Se crea la maquina
																																																					$a  = "'".$id_lvl_24."'" ;          
																																																					$a .= ",'".$id_lvl_23."'" ; 
																																																					$a .= ",'".$id_lvl_22."'" ; 
																																																					$a .= ",'".$id_lvl_21."'" ; 
																																																					$a .= ",'".$id_lvl_20."'" ; 
																																																					$a .= ",'".$id_lvl_19."'" ; 
																																																					$a .= ",'".$id_lvl_18."'" ; 
																																																					$a .= ",'".$id_lvl_17."'" ; 
																																																					$a .= ",'".$id_lvl_16."'" ; 
																																																					$a .= ",'".$id_lvl_15."'" ; 
																																																					$a .= ",'".$id_lvl_14."'" ; 
																																																					$a .= ",'".$id_lvl_13."'" ; 
																																																					$a .= ",'".$id_lvl_12."'" ; 
																																																					$a .= ",'".$id_lvl_11."'" ; 
																																																					$a .= ",'".$id_lvl_10."'" ; 
																																																					$a .= ",'".$id_lvl_9."'" ; 
																																																					$a .= ",'".$id_lvl_8."'" ; 
																																																					$a .= ",'".$id_lvl_7."'" ; 
																																																					$a .= ",'".$id_lvl_6."'" ; 
																																																					$a .= ",'".$id_lvl_5."'" ; 
																																																					$a .= ",'".$id_lvl_4."'" ; 
																																																					$a .= ",'".$id_lvl_3."'" ; 
																																																					$a .= ",'".$id_lvl_2."'" ; 
																																																					$a .= ",'".$id_lvl_1."'" ; 
																																																					$a .= ",'".$lvl_25['idSistema']."'" ; 
																																																					$a .= ",'".$maquina_id."'" ; 
																																																					$a .= ",'".$lvl_25['idUtilizable']."'" ;
																																																					$a .= ",'".$lvl_25['Codigo']."'" ;
																																																					$a .= ",'".$lvl_25['Nombre']."'" ;
																																																					$a .= ",'".$lvl_25['Marca']."'" ;
																																																					$a .= ",'".$lvl_25['Modelo']."'" ;
																																																					$a .= ",'".$lvl_25['AnoFab']."'" ;
																																																					$a .= ",'".$lvl_25['Serie']."'" ; 
																																																					$a .= ",'".$lvl_25['idLicitacion']."'" ; 
																																																					$a .= ",'".$lvl_25['tabla']."'" ; 
																																																					$a .= ",'".$lvl_25['table_value']."'" ; 
																																																					$a .= ",'".$lvl_25['Direccion_img']."'" ; 
																																																					$a .= ",'".$lvl_25['idSubTipo']."'" ; 
																																																					$a .= ",'".$lvl_25['Grasa_inicial']."'" ; 
																																																					$a .= ",'".$lvl_25['Grasa_relubricacion']."'" ; 
																																																					$a .= ",'".$lvl_25['Aceite']."'" ; 
																																																					$a .= ",'".$lvl_25['Cantidad']."'" ; 
																																																					$a .= ",'".$lvl_25['idUml']."'" ; 
																																																					$a .= ",'".$lvl_25['Frecuencia']."'" ; 
																																																					$a .= ",'".$lvl_25['idFrecuencia']."'" ; 
																																																					$a .= ",'".$lvl_25['idProducto']."'" ; 
																																																					$a .= ",'".$lvl_25['Saf']."'" ; 
																																																					$a .= ",'".$lvl_25['Numero']."'" ; 
																																																	 
																																																					// inserto los datos de registro en la db
																																																					$query  = "INSERT INTO `maquinas_listado_level_25` (idLevel_24,idLevel_23,idLevel_22,
																																																					idLevel_21,idLevel_20,idLevel_19,idLevel_18,idLevel_17,idLevel_16,idLevel_15,idLevel_14,
																																																					idLevel_13,idLevel_12,idLevel_11,idLevel_10,idLevel_9,idLevel_8,idLevel_7,idLevel_6,
																																																					idLevel_5,idLevel_4,idLevel_3,idLevel_2, idLevel_1, idSistema, idMaquina, idUtilizable, 
																																																					Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																																					Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																																					idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero) 
																																																					VALUES (".$a.")";
																																																					$result = mysqli_query($dbConn, $query);
																																																					
																																																					
																																																					
																																																				}
																																																			}
																																																			
																																																		}
																																																	}
																																																	
																																																}
																																															}
																																															
																																														}
																																													}
																																													
																																												}
																																											}
																																											
																																										}
																																									}
																																									
																																								}
																																							}
																																							
																																						}
																																					}
																																					
																																				}
																																			}
																																			
																																		}
																																	}
																																	*/
																																}
																															}
																														}
																													}
																												}
																											}
																										}
																									}
																								}
																							}
																						}
																					}
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
				header( 'Location: '.$location.'&clone=true' );
				die;
			}
		
		break;			
/*******************************************************************************************************************/		
		case 'clone_component':	
		
		
		$idLevel  = $_GET['clone_compo'];
		$lvl      = $_GET['lvl'];
		
		if(isset($_GET['lv_1'])&&$_GET['lv_1']!=''){   $lv_1     = $_GET['lv_1'];  }else{$lv_1 = 0;}
		if(isset($_GET['lv_2'])&&$_GET['lv_2']!=''){   $lv_2     = $_GET['lv_2'];  }else{$lv_2 = 0;}
		if(isset($_GET['lv_3'])&&$_GET['lv_3']!=''){   $lv_3     = $_GET['lv_3'];  }else{$lv_3 = 0;}
		if(isset($_GET['lv_4'])&&$_GET['lv_4']!=''){   $lv_4     = $_GET['lv_4'];  }else{$lv_4 = 0;}
		if(isset($_GET['lv_5'])&&$_GET['lv_5']!=''){   $lv_5     = $_GET['lv_5'];  }else{$lv_5 = 0;}
		if(isset($_GET['lv_6'])&&$_GET['lv_6']!=''){   $lv_6     = $_GET['lv_6'];  }else{$lv_6 = 0;}
		if(isset($_GET['lv_7'])&&$_GET['lv_7']!=''){   $lv_7     = $_GET['lv_7'];  }else{$lv_7 = 0;}
		if(isset($_GET['lv_8'])&&$_GET['lv_8']!=''){   $lv_8     = $_GET['lv_8'];  }else{$lv_8 = 0;}
		if(isset($_GET['lv_9'])&&$_GET['lv_9']!=''){   $lv_9     = $_GET['lv_9'];  }else{$lv_9 = 0;}
		if(isset($_GET['lv_10'])&&$_GET['lv_10']!=''){ $lv_10    = $_GET['lv_10']; }else{$lv_10 = 0;}
		if(isset($_GET['lv_11'])&&$_GET['lv_11']!=''){ $lv_11    = $_GET['lv_11']; }else{$lv_11 = 0;}
		if(isset($_GET['lv_12'])&&$_GET['lv_12']!=''){ $lv_12    = $_GET['lv_12']; }else{$lv_12 = 0;}
		if(isset($_GET['lv_13'])&&$_GET['lv_13']!=''){ $lv_13    = $_GET['lv_13']; }else{$lv_13 = 0;}
		if(isset($_GET['lv_14'])&&$_GET['lv_14']!=''){ $lv_14    = $_GET['lv_14']; }else{$lv_14 = 0;}
		if(isset($_GET['lv_15'])&&$_GET['lv_15']!=''){ $lv_15    = $_GET['lv_15']; }else{$lv_15 = 0;}
		if(isset($_GET['lv_16'])&&$_GET['lv_16']!=''){ $lv_16    = $_GET['lv_16']; }else{$lv_16 = 0;}
		if(isset($_GET['lv_17'])&&$_GET['lv_17']!=''){ $lv_17    = $_GET['lv_17']; }else{$lv_17 = 0;}
		if(isset($_GET['lv_18'])&&$_GET['lv_18']!=''){ $lv_18    = $_GET['lv_18']; }else{$lv_18 = 0;}
		if(isset($_GET['lv_19'])&&$_GET['lv_19']!=''){ $lv_19    = $_GET['lv_19']; }else{$lv_19 = 0;}
		if(isset($_GET['lv_20'])&&$_GET['lv_20']!=''){ $lv_20    = $_GET['lv_20']; }else{$lv_20 = 0;}
		if(isset($_GET['lv_21'])&&$_GET['lv_21']!=''){ $lv_21    = $_GET['lv_21']; }else{$lv_21 = 0;}
		if(isset($_GET['lv_22'])&&$_GET['lv_22']!=''){ $lv_22    = $_GET['lv_22']; }else{$lv_22 = 0;}
		if(isset($_GET['lv_23'])&&$_GET['lv_23']!=''){ $lv_23    = $_GET['lv_23']; }else{$lv_23 = 0;}
		if(isset($_GET['lv_24'])&&$_GET['lv_24']!=''){ $lv_24    = $_GET['lv_24']; }else{$lv_24 = 0;}
		if(isset($_GET['lv_25'])&&$_GET['lv_25']!=''){ $lv_25    = $_GET['lv_25']; }else{$lv_25 = 0;}
		
		
		
		
		/*******************************************************************/
		//Creo todas las consultas hasta el final del arbol
		for ($i = $lvl; $i <= 15; $i++) {
			//creo cadena con los idLevel
			$cadena = '';
			for ($x = $i; $x >= 1; $x--) {
				$cadena .= ',idLevel_'.$x;
			}
			$arrLVL[$i] = array();
			$arrLVL[$i] = db_select_array (false, 'idSistema, idUtilizable, Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero, idMaquina '.$cadena, 'maquinas_listado_level_'.$i, '', 'idLevel_'.$lvl.' = '.$idLevel, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			
		}
		
		
		/*******************************************************************/
		//Variables
		$id_lvl = array();
		//Arreglos
		$dis_1  = $lvl;
		$dis_2  = $lvl + 1;
		$dis_3  = $lvl + 2;
		$dis_4  = $lvl + 3;
		$dis_5  = $lvl + 4;
		$dis_6  = $lvl + 5;
		$dis_7  = $lvl + 6;
		$dis_8  = $lvl + 7;
		$dis_9  = $lvl + 8;
		$dis_10 = $lvl + 9;
		$dis_11 = $lvl + 10;
		$dis_12 = $lvl + 11;
		$dis_13 = $lvl + 12;
		$dis_14 = $lvl + 13;
		$dis_15 = $lvl + 14;
		$dis_16 = $lvl + 15;
		$dis_17 = $lvl + 16;
		$dis_18 = $lvl + 17;
		$dis_19 = $lvl + 18;
		$dis_20 = $lvl + 19;
		$dis_21 = $lvl + 20;
		$dis_22 = $lvl + 21;
		$dis_23 = $lvl + 22;
		$dis_24 = $lvl + 23;
		$dis_25 = $lvl + 24;
		
		//Consultas
		/********************************************/
		if(isset($arrLVL[$dis_1])){
			foreach ($arrLVL[$dis_1] as $arreglo_1) {
				
				//Se crea la maquina
				$a  = "'".$arreglo_1['idSistema']."'" ;          
				$a .= ",'".$arreglo_1['idMaquina']."'" ;        
				$a .= ",'".$arreglo_1['idUtilizable']."'" ;
				$a .= ",'".$arreglo_1['Codigo']."'" ;
				$a .= ",'".$arreglo_1['Nombre']." (Nuevo)'" ;
				$a .= ",'".$arreglo_1['Marca']."'" ;
				$a .= ",'".$arreglo_1['Modelo']."'" ;
				$a .= ",'".$arreglo_1['AnoFab']."'" ;
				$a .= ",'".$arreglo_1['Serie']."'" ; 
				$a .= ",'".$arreglo_1['idLicitacion']."'" ; 
				$a .= ",'".$arreglo_1['tabla']."'" ; 
				$a .= ",'".$arreglo_1['table_value']."'" ; 
				$a .= ",'".$arreglo_1['Direccion_img']."'" ; 
				$a .= ",'".$arreglo_1['idSubTipo']."'" ; 
				$a .= ",'".$arreglo_1['Grasa_inicial']."'" ; 
				$a .= ",'".$arreglo_1['Grasa_relubricacion']."'" ; 
				$a .= ",'".$arreglo_1['Aceite']."'" ; 
				$a .= ",'".$arreglo_1['Cantidad']."'" ; 
				$a .= ",'".$arreglo_1['idUml']."'" ; 
				$a .= ",'".$arreglo_1['Frecuencia']."'" ; 
				$a .= ",'".$arreglo_1['idFrecuencia']."'" ; 
				$a .= ",'".$arreglo_1['idProducto']."'" ; 
				$a .= ",'".$arreglo_1['Saf']."'" ; 
				$a .= ",'".$arreglo_1['Numero']."'" ; 
				
				
			
				$cadena = '';
				$x = 1;
				if($lv_1!=0&&$lvl>1){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_2!=0&&$lvl>2){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_3!=0&&$lvl>3){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_4!=0&&$lvl>4){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_5!=0&&$lvl>5){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_6!=0&&$lvl>6){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_7!=0&&$lvl>7){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_8!=0&&$lvl>8){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_9!=0&&$lvl>9){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_10!=0&&$lvl>10){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_11!=0&&$lvl>11){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_12!=0&&$lvl>12){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_13!=0&&$lvl>13){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_14!=0&&$lvl>14){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_15!=0&&$lvl>15){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_16!=0&&$lvl>16){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_17!=0&&$lvl>17){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_18!=0&&$lvl>18){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_19!=0&&$lvl>19){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_20!=0&&$lvl>20){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_21!=0&&$lvl>21){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_22!=0&&$lvl>22){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_23!=0&&$lvl>23){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_24!=0&&$lvl>24){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				if($lv_25!=0&&$lvl>25){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_1['idLevel_'.$x]."'" ;$x++;}
				
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `maquinas_listado_level_".$dis_1."` (idSistema, idMaquina, idUtilizable, 
				Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
				Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
				idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
				VALUES (".$a.")";
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
				$id_lvl[$dis_1] = mysqli_insert_id($dbConn);
				
				//echo $query.'<br/><br/>';
		
	
				
				/////////////////////////////////////////////////
				if(isset($arrLVL[$dis_2])){
					foreach ($arrLVL[$dis_2] as $arreglo_2) {
						//Se verifica que sea el mismo sensor
						if($arreglo_1['idLevel_'.$dis_1]==$arreglo_2['idLevel_'.$dis_1]){
						
							//Se crea la maquina
							$a  = "'".$arreglo_2['idSistema']."'" ;          
							$a .= ",'".$arreglo_2['idMaquina']."'" ;        
							$a .= ",'".$arreglo_2['idUtilizable']."'" ;
							$a .= ",'".$arreglo_2['Codigo']."'" ;
							$a .= ",'".$arreglo_2['Nombre']."'" ;
							$a .= ",'".$arreglo_2['Marca']."'" ;
							$a .= ",'".$arreglo_2['Modelo']."'" ;
							$a .= ",'".$arreglo_2['AnoFab']."'" ;
							$a .= ",'".$arreglo_2['Serie']."'" ; 
							$a .= ",'".$arreglo_2['idLicitacion']."'" ; 
							$a .= ",'".$arreglo_2['tabla']."'" ; 
							$a .= ",'".$arreglo_2['table_value']."'" ; 
							$a .= ",'".$arreglo_2['Direccion_img']."'" ; 
							$a .= ",'".$arreglo_2['idSubTipo']."'" ; 
							$a .= ",'".$arreglo_2['Grasa_inicial']."'" ; 
							$a .= ",'".$arreglo_2['Grasa_relubricacion']."'" ; 
							$a .= ",'".$arreglo_2['Aceite']."'" ; 
							$a .= ",'".$arreglo_2['Cantidad']."'" ; 
							$a .= ",'".$arreglo_2['idUml']."'" ; 
							$a .= ",'".$arreglo_2['Frecuencia']."'" ; 
							$a .= ",'".$arreglo_2['idFrecuencia']."'" ; 
							$a .= ",'".$arreglo_2['idProducto']."'" ; 
							$a .= ",'".$arreglo_2['Saf']."'" ; 
							$a .= ",'".$arreglo_2['Numero']."'" ; 
							
							$cadena = '';
							$x = 1;
							if($lv_1!=0&&$lvl>1){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_2!=0&&$lvl>2){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_3!=0&&$lvl>3){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_4!=0&&$lvl>4){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_5!=0&&$lvl>5){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_6!=0&&$lvl>6){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_7!=0&&$lvl>7){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_8!=0&&$lvl>8){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_9!=0&&$lvl>9){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_10!=0&&$lvl>10){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_11!=0&&$lvl>11){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_12!=0&&$lvl>12){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_13!=0&&$lvl>13){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_14!=0&&$lvl>14){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_15!=0&&$lvl>15){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_16!=0&&$lvl>16){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_17!=0&&$lvl>17){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_18!=0&&$lvl>18){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_19!=0&&$lvl>19){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_20!=0&&$lvl>20){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_21!=0&&$lvl>21){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_22!=0&&$lvl>22){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_23!=0&&$lvl>23){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_24!=0&&$lvl>24){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							if($lv_25!=0&&$lvl>25){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_2['idLevel_'.$x]."'" ;$x++;}
							
							$x = 1;
							if(isset($id_lvl[$dis_1])&&$id_lvl[$dis_1]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_1]."'" ;$x++;}
							if(isset($id_lvl[$dis_2])&&$id_lvl[$dis_2]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_2]."'" ;$x++;}
							if(isset($id_lvl[$dis_3])&&$id_lvl[$dis_3]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_3]."'" ;$x++;}
							if(isset($id_lvl[$dis_4])&&$id_lvl[$dis_4]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_4]."'" ;$x++;}
							if(isset($id_lvl[$dis_5])&&$id_lvl[$dis_5]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_5]."'" ;$x++;}
							if(isset($id_lvl[$dis_6])&&$id_lvl[$dis_6]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_6]."'" ;$x++;}
							if(isset($id_lvl[$dis_7])&&$id_lvl[$dis_7]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_7]."'" ;$x++;}
							if(isset($id_lvl[$dis_8])&&$id_lvl[$dis_8]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_8]."'" ;$x++;}
							if(isset($id_lvl[$dis_9])&&$id_lvl[$dis_9]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_9]."'" ;$x++;}
							if(isset($id_lvl[$dis_10])&&$id_lvl[$dis_10]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_10]."'" ;$x++;}
							if(isset($id_lvl[$dis_11])&&$id_lvl[$dis_11]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_11]."'" ;$x++;}
							if(isset($id_lvl[$dis_12])&&$id_lvl[$dis_12]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_12]."'" ;$x++;}
							if(isset($id_lvl[$dis_13])&&$id_lvl[$dis_13]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_13]."'" ;$x++;}
							if(isset($id_lvl[$dis_14])&&$id_lvl[$dis_14]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_14]."'" ;$x++;}
							if(isset($id_lvl[$dis_15])&&$id_lvl[$dis_15]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_15]."'" ;$x++;}
							if(isset($id_lvl[$dis_16])&&$id_lvl[$dis_16]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_16]."'" ;$x++;}
							if(isset($id_lvl[$dis_17])&&$id_lvl[$dis_17]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_17]."'" ;$x++;}
							if(isset($id_lvl[$dis_18])&&$id_lvl[$dis_18]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_18]."'" ;$x++;}
							if(isset($id_lvl[$dis_19])&&$id_lvl[$dis_19]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_19]."'" ;$x++;}
							if(isset($id_lvl[$dis_20])&&$id_lvl[$dis_20]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_20]."'" ;$x++;}
							if(isset($id_lvl[$dis_21])&&$id_lvl[$dis_21]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_21]."'" ;$x++;}
							if(isset($id_lvl[$dis_22])&&$id_lvl[$dis_22]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_22]."'" ;$x++;}
							if(isset($id_lvl[$dis_23])&&$id_lvl[$dis_23]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_23]."'" ;$x++;}
							if(isset($id_lvl[$dis_24])&&$id_lvl[$dis_24]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_24]."'" ;$x++;}
							if(isset($id_lvl[$dis_25])&&$id_lvl[$dis_25]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_25]."'" ;$x++;}
							
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `maquinas_listado_level_".$dis_2."` (idSistema, idMaquina, idUtilizable, 
							Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
							Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
							idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
							VALUES (".$a.")";
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
							$id_lvl[$dis_2] = mysqli_insert_id($dbConn);
							
							//echo $query.'<br/><br/>';
					
							
							/////////////////////////////////////////////////
							if(isset($arrLVL[$dis_3])){
								foreach ($arrLVL[$dis_3] as $arreglo_3) {
									//Se verifica que sea el mismo sensor
									if($arreglo_2['idLevel_'.$dis_2]==$arreglo_3['idLevel_'.$dis_2]){
									
										//Se crea la maquina
										$a  = "'".$arreglo_3['idSistema']."'" ;          
										$a .= ",'".$arreglo_3['idMaquina']."'" ;        
										$a .= ",'".$arreglo_3['idUtilizable']."'" ;
										$a .= ",'".$arreglo_3['Codigo']."'" ;
										$a .= ",'".$arreglo_3['Nombre']."'" ;
										$a .= ",'".$arreglo_3['Marca']."'" ;
										$a .= ",'".$arreglo_3['Modelo']."'" ;
										$a .= ",'".$arreglo_3['AnoFab']."'" ;
										$a .= ",'".$arreglo_3['Serie']."'" ; 
										$a .= ",'".$arreglo_3['idLicitacion']."'" ; 
										$a .= ",'".$arreglo_3['tabla']."'" ; 
										$a .= ",'".$arreglo_3['table_value']."'" ; 
										$a .= ",'".$arreglo_3['Direccion_img']."'" ; 
										$a .= ",'".$arreglo_3['idSubTipo']."'" ; 
										$a .= ",'".$arreglo_3['Grasa_inicial']."'" ; 
										$a .= ",'".$arreglo_3['Grasa_relubricacion']."'" ; 
										$a .= ",'".$arreglo_3['Aceite']."'" ; 
										$a .= ",'".$arreglo_3['Cantidad']."'" ; 
										$a .= ",'".$arreglo_3['idUml']."'" ; 
										$a .= ",'".$arreglo_3['Frecuencia']."'" ; 
										$a .= ",'".$arreglo_3['idFrecuencia']."'" ; 
										$a .= ",'".$arreglo_3['idProducto']."'" ; 
										$a .= ",'".$arreglo_3['Saf']."'" ; 
										$a .= ",'".$arreglo_3['Numero']."'" ; 
										
										$cadena = '';
										$x = 1;
										if($lv_1!=0&&$lvl>1){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_2!=0&&$lvl>2){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_3!=0&&$lvl>3){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_4!=0&&$lvl>4){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_5!=0&&$lvl>5){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_6!=0&&$lvl>6){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_7!=0&&$lvl>7){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_8!=0&&$lvl>8){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_9!=0&&$lvl>9){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_10!=0&&$lvl>10){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_11!=0&&$lvl>11){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_12!=0&&$lvl>12){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_13!=0&&$lvl>13){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_14!=0&&$lvl>14){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_15!=0&&$lvl>15){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_16!=0&&$lvl>16){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_17!=0&&$lvl>17){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_18!=0&&$lvl>18){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_19!=0&&$lvl>19){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_20!=0&&$lvl>20){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_21!=0&&$lvl>21){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_22!=0&&$lvl>22){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_23!=0&&$lvl>23){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_24!=0&&$lvl>24){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										if($lv_25!=0&&$lvl>25){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_3['idLevel_'.$x]."'" ;$x++;}
										
										$x = 1;
										if(isset($id_lvl[$dis_1])&&$id_lvl[$dis_1]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_1]."'" ;$x++;}
										if(isset($id_lvl[$dis_2])&&$id_lvl[$dis_2]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_2]."'" ;$x++;}
										if(isset($id_lvl[$dis_3])&&$id_lvl[$dis_3]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_3]."'" ;$x++;}
										if(isset($id_lvl[$dis_4])&&$id_lvl[$dis_4]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_4]."'" ;$x++;}
										if(isset($id_lvl[$dis_5])&&$id_lvl[$dis_5]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_5]."'" ;$x++;}
										if(isset($id_lvl[$dis_6])&&$id_lvl[$dis_6]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_6]."'" ;$x++;}
										if(isset($id_lvl[$dis_7])&&$id_lvl[$dis_7]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_7]."'" ;$x++;}
										if(isset($id_lvl[$dis_8])&&$id_lvl[$dis_8]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_8]."'" ;$x++;}
										if(isset($id_lvl[$dis_9])&&$id_lvl[$dis_9]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_9]."'" ;$x++;}
										if(isset($id_lvl[$dis_10])&&$id_lvl[$dis_10]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_10]."'" ;$x++;}
										if(isset($id_lvl[$dis_11])&&$id_lvl[$dis_11]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_11]."'" ;$x++;}
										if(isset($id_lvl[$dis_12])&&$id_lvl[$dis_12]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_12]."'" ;$x++;}
										if(isset($id_lvl[$dis_13])&&$id_lvl[$dis_13]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_13]."'" ;$x++;}
										if(isset($id_lvl[$dis_14])&&$id_lvl[$dis_14]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_14]."'" ;$x++;}
										if(isset($id_lvl[$dis_15])&&$id_lvl[$dis_15]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_15]."'" ;$x++;}
										if(isset($id_lvl[$dis_16])&&$id_lvl[$dis_16]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_16]."'" ;$x++;}
										if(isset($id_lvl[$dis_17])&&$id_lvl[$dis_17]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_17]."'" ;$x++;}
										if(isset($id_lvl[$dis_18])&&$id_lvl[$dis_18]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_18]."'" ;$x++;}
										if(isset($id_lvl[$dis_19])&&$id_lvl[$dis_19]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_19]."'" ;$x++;}
										if(isset($id_lvl[$dis_20])&&$id_lvl[$dis_20]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_20]."'" ;$x++;}
										if(isset($id_lvl[$dis_21])&&$id_lvl[$dis_21]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_21]."'" ;$x++;}
										if(isset($id_lvl[$dis_22])&&$id_lvl[$dis_22]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_22]."'" ;$x++;}
										if(isset($id_lvl[$dis_23])&&$id_lvl[$dis_23]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_23]."'" ;$x++;}
										if(isset($id_lvl[$dis_24])&&$id_lvl[$dis_24]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_24]."'" ;$x++;}
										if(isset($id_lvl[$dis_25])&&$id_lvl[$dis_25]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_25]."'" ;$x++;}
										
										
										
										// inserto los datos de registro en la db
										$query  = "INSERT INTO `maquinas_listado_level_".$dis_3."` (idSistema, idMaquina, idUtilizable, 
										Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
										Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
										idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
										VALUES (".$a.")";
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
										$id_lvl[$dis_3] = mysqli_insert_id($dbConn);
										
										//echo $query.'<br/><br/>';
		
										
										/////////////////////////////////////////////////
										if(isset($arrLVL[$dis_4])){
											foreach ($arrLVL[$dis_4] as $arreglo_4) {
												//Se verifica que sea el mismo sensor
												if($arreglo_3['idLevel_'.$dis_3]==$arreglo_4['idLevel_'.$dis_3]){
												
													//Se crea la maquina
													$a  = "'".$arreglo_4['idSistema']."'" ;          
													$a .= ",'".$arreglo_4['idMaquina']."'" ;        
													$a .= ",'".$arreglo_4['idUtilizable']."'" ;
													$a .= ",'".$arreglo_4['Codigo']."'" ;
													$a .= ",'".$arreglo_4['Nombre']."'" ;
													$a .= ",'".$arreglo_4['Marca']."'" ;
													$a .= ",'".$arreglo_4['Modelo']."'" ;
													$a .= ",'".$arreglo_4['AnoFab']."'" ;
													$a .= ",'".$arreglo_4['Serie']."'" ; 
													$a .= ",'".$arreglo_4['idLicitacion']."'" ; 
													$a .= ",'".$arreglo_4['tabla']."'" ; 
													$a .= ",'".$arreglo_4['table_value']."'" ; 
													$a .= ",'".$arreglo_4['Direccion_img']."'" ; 
													$a .= ",'".$arreglo_4['idSubTipo']."'" ; 
													$a .= ",'".$arreglo_4['Grasa_inicial']."'" ; 
													$a .= ",'".$arreglo_4['Grasa_relubricacion']."'" ; 
													$a .= ",'".$arreglo_4['Aceite']."'" ; 
													$a .= ",'".$arreglo_4['Cantidad']."'" ; 
													$a .= ",'".$arreglo_4['idUml']."'" ; 
													$a .= ",'".$arreglo_4['Frecuencia']."'" ; 
													$a .= ",'".$arreglo_4['idFrecuencia']."'" ; 
													$a .= ",'".$arreglo_4['idProducto']."'" ; 
													$a .= ",'".$arreglo_4['Saf']."'" ; 
													$a .= ",'".$arreglo_4['Numero']."'" ; 
													
													$cadena = '';
													$x = 1;
													if($lv_1!=0&&$lvl>1){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_2!=0&&$lvl>2){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_3!=0&&$lvl>3){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_4!=0&&$lvl>4){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_5!=0&&$lvl>5){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_6!=0&&$lvl>6){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_7!=0&&$lvl>7){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_8!=0&&$lvl>8){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_9!=0&&$lvl>9){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_10!=0&&$lvl>10){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_11!=0&&$lvl>11){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_12!=0&&$lvl>12){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_13!=0&&$lvl>13){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_14!=0&&$lvl>14){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_15!=0&&$lvl>15){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_16!=0&&$lvl>16){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_17!=0&&$lvl>17){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_18!=0&&$lvl>18){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_19!=0&&$lvl>19){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_20!=0&&$lvl>20){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_21!=0&&$lvl>21){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_22!=0&&$lvl>22){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_23!=0&&$lvl>23){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_24!=0&&$lvl>24){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													if($lv_25!=0&&$lvl>25){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_4['idLevel_'.$x]."'" ;$x++;}
													
													$x = 1;
													if(isset($id_lvl[$dis_1])&&$id_lvl[$dis_1]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_1]."'" ;$x++;}
													if(isset($id_lvl[$dis_2])&&$id_lvl[$dis_2]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_2]."'" ;$x++;}
													if(isset($id_lvl[$dis_3])&&$id_lvl[$dis_3]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_3]."'" ;$x++;}
													if(isset($id_lvl[$dis_4])&&$id_lvl[$dis_4]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_4]."'" ;$x++;}
													if(isset($id_lvl[$dis_5])&&$id_lvl[$dis_5]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_5]."'" ;$x++;}
													if(isset($id_lvl[$dis_6])&&$id_lvl[$dis_6]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_6]."'" ;$x++;}
													if(isset($id_lvl[$dis_7])&&$id_lvl[$dis_7]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_7]."'" ;$x++;}
													if(isset($id_lvl[$dis_8])&&$id_lvl[$dis_8]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_8]."'" ;$x++;}
													if(isset($id_lvl[$dis_9])&&$id_lvl[$dis_9]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_9]."'" ;$x++;}
													if(isset($id_lvl[$dis_10])&&$id_lvl[$dis_10]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_10]."'" ;$x++;}
													if(isset($id_lvl[$dis_11])&&$id_lvl[$dis_11]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_11]."'" ;$x++;}
													if(isset($id_lvl[$dis_12])&&$id_lvl[$dis_12]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_12]."'" ;$x++;}
													if(isset($id_lvl[$dis_13])&&$id_lvl[$dis_13]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_13]."'" ;$x++;}
													if(isset($id_lvl[$dis_14])&&$id_lvl[$dis_14]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_14]."'" ;$x++;}
													if(isset($id_lvl[$dis_15])&&$id_lvl[$dis_15]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_15]."'" ;$x++;}
													if(isset($id_lvl[$dis_16])&&$id_lvl[$dis_16]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_16]."'" ;$x++;}
													if(isset($id_lvl[$dis_17])&&$id_lvl[$dis_17]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_17]."'" ;$x++;}
													if(isset($id_lvl[$dis_18])&&$id_lvl[$dis_18]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_18]."'" ;$x++;}
													if(isset($id_lvl[$dis_19])&&$id_lvl[$dis_19]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_19]."'" ;$x++;}
													if(isset($id_lvl[$dis_20])&&$id_lvl[$dis_20]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_20]."'" ;$x++;}
													if(isset($id_lvl[$dis_21])&&$id_lvl[$dis_21]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_21]."'" ;$x++;}
													if(isset($id_lvl[$dis_22])&&$id_lvl[$dis_22]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_22]."'" ;$x++;}
													if(isset($id_lvl[$dis_23])&&$id_lvl[$dis_23]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_23]."'" ;$x++;}
													if(isset($id_lvl[$dis_24])&&$id_lvl[$dis_24]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_24]."'" ;$x++;}
													if(isset($id_lvl[$dis_25])&&$id_lvl[$dis_25]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_25]."'" ;$x++;}
													
													
													// inserto los datos de registro en la db
													$query  = "INSERT INTO `maquinas_listado_level_".$dis_4."` (idSistema, idMaquina, idUtilizable, 
													Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
													Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
													idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
													VALUES (".$a.")";
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
													$id_lvl[$dis_4] = mysqli_insert_id($dbConn);
													
													/////////////////////////////////////////////////
													if(isset($arrLVL[$dis_5])){
														foreach ($arrLVL[$dis_5] as $arreglo_5) {
															//Se verifica que sea el mismo sensor
															if($arreglo_4['idLevel_'.$dis_4]==$arreglo_5['idLevel_'.$dis_4]){
															
																//Se crea la maquina
																$a  = "'".$arreglo_5['idSistema']."'" ;          
																$a .= ",'".$arreglo_5['idMaquina']."'" ;        
																$a .= ",'".$arreglo_5['idUtilizable']."'" ;
																$a .= ",'".$arreglo_5['Codigo']."'" ;
																$a .= ",'".$arreglo_5['Nombre']."'" ;
																$a .= ",'".$arreglo_5['Marca']."'" ;
																$a .= ",'".$arreglo_5['Modelo']."'" ;
																$a .= ",'".$arreglo_5['AnoFab']."'" ;
																$a .= ",'".$arreglo_5['Serie']."'" ; 
																$a .= ",'".$arreglo_5['idLicitacion']."'" ; 
																$a .= ",'".$arreglo_5['tabla']."'" ; 
																$a .= ",'".$arreglo_5['table_value']."'" ; 
																$a .= ",'".$arreglo_5['Direccion_img']."'" ; 
																$a .= ",'".$arreglo_5['idSubTipo']."'" ; 
																$a .= ",'".$arreglo_5['Grasa_inicial']."'" ; 
																$a .= ",'".$arreglo_5['Grasa_relubricacion']."'" ; 
																$a .= ",'".$arreglo_5['Aceite']."'" ; 
																$a .= ",'".$arreglo_5['Cantidad']."'" ; 
																$a .= ",'".$arreglo_5['idUml']."'" ; 
																$a .= ",'".$arreglo_5['Frecuencia']."'" ; 
																$a .= ",'".$arreglo_5['idFrecuencia']."'" ; 
																$a .= ",'".$arreglo_5['idProducto']."'" ; 
																$a .= ",'".$arreglo_5['Saf']."'" ; 
																$a .= ",'".$arreglo_5['Numero']."'" ; 
																
																$cadena = '';
																$x = 1;
																if($lv_1!=0&&$lvl>1){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_2!=0&&$lvl>2){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_3!=0&&$lvl>3){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_4!=0&&$lvl>4){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_5!=0&&$lvl>5){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_6!=0&&$lvl>6){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_7!=0&&$lvl>7){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_8!=0&&$lvl>8){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_9!=0&&$lvl>9){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_10!=0&&$lvl>10){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_11!=0&&$lvl>11){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_12!=0&&$lvl>12){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_13!=0&&$lvl>13){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_14!=0&&$lvl>14){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_15!=0&&$lvl>15){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_16!=0&&$lvl>16){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_17!=0&&$lvl>17){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_18!=0&&$lvl>18){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_19!=0&&$lvl>19){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_20!=0&&$lvl>20){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_21!=0&&$lvl>21){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_22!=0&&$lvl>22){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_23!=0&&$lvl>23){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_24!=0&&$lvl>24){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																if($lv_25!=0&&$lvl>25){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_5['idLevel_'.$x]."'" ;$x++;}
																
																$x = 1;
																if(isset($id_lvl[$dis_1])&&$id_lvl[$dis_1]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_1]."'" ;$x++;}
																if(isset($id_lvl[$dis_2])&&$id_lvl[$dis_2]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_2]."'" ;$x++;}
																if(isset($id_lvl[$dis_3])&&$id_lvl[$dis_3]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_3]."'" ;$x++;}
																if(isset($id_lvl[$dis_4])&&$id_lvl[$dis_4]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_4]."'" ;$x++;}
																if(isset($id_lvl[$dis_5])&&$id_lvl[$dis_5]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_5]."'" ;$x++;}
																if(isset($id_lvl[$dis_6])&&$id_lvl[$dis_6]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_6]."'" ;$x++;}
																if(isset($id_lvl[$dis_7])&&$id_lvl[$dis_7]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_7]."'" ;$x++;}
																if(isset($id_lvl[$dis_8])&&$id_lvl[$dis_8]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_8]."'" ;$x++;}
																if(isset($id_lvl[$dis_9])&&$id_lvl[$dis_9]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_9]."'" ;$x++;}
																if(isset($id_lvl[$dis_10])&&$id_lvl[$dis_10]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_10]."'" ;$x++;}
																if(isset($id_lvl[$dis_11])&&$id_lvl[$dis_11]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_11]."'" ;$x++;}
																if(isset($id_lvl[$dis_12])&&$id_lvl[$dis_12]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_12]."'" ;$x++;}
																if(isset($id_lvl[$dis_13])&&$id_lvl[$dis_13]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_13]."'" ;$x++;}
																if(isset($id_lvl[$dis_14])&&$id_lvl[$dis_14]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_14]."'" ;$x++;}
																if(isset($id_lvl[$dis_15])&&$id_lvl[$dis_15]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_15]."'" ;$x++;}
																if(isset($id_lvl[$dis_16])&&$id_lvl[$dis_16]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_16]."'" ;$x++;}
																if(isset($id_lvl[$dis_17])&&$id_lvl[$dis_17]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_17]."'" ;$x++;}
																if(isset($id_lvl[$dis_18])&&$id_lvl[$dis_18]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_18]."'" ;$x++;}
																if(isset($id_lvl[$dis_19])&&$id_lvl[$dis_19]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_19]."'" ;$x++;}
																if(isset($id_lvl[$dis_20])&&$id_lvl[$dis_20]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_20]."'" ;$x++;}
																if(isset($id_lvl[$dis_21])&&$id_lvl[$dis_21]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_21]."'" ;$x++;}
																if(isset($id_lvl[$dis_22])&&$id_lvl[$dis_22]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_22]."'" ;$x++;}
																if(isset($id_lvl[$dis_23])&&$id_lvl[$dis_23]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_23]."'" ;$x++;}
																if(isset($id_lvl[$dis_24])&&$id_lvl[$dis_24]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_24]."'" ;$x++;}
																if(isset($id_lvl[$dis_25])&&$id_lvl[$dis_25]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_25]."'" ;$x++;}
																
																
																// inserto los datos de registro en la db
																$query  = "INSERT INTO `maquinas_listado_level_".$dis_5."` (idSistema, idMaquina, idUtilizable, 
																Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
																VALUES (".$a.")";
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
																$id_lvl[$dis_5] = mysqli_insert_id($dbConn);
																
																/////////////////////////////////////////////////
																if(isset($arrLVL[$dis_6])){
																	foreach ($arrLVL[$dis_6] as $arreglo_6) {
																		//Se verifica que sea el mismo sensor
																		if($arreglo_5['idLevel_'.$dis_5]==$arreglo_6['idLevel_'.$dis_5]){
																		
																			//Se crea la maquina
																			$a  = "'".$arreglo_6['idSistema']."'" ;          
																			$a .= ",'".$arreglo_6['idMaquina']."'" ;        
																			$a .= ",'".$arreglo_6['idUtilizable']."'" ;
																			$a .= ",'".$arreglo_6['Codigo']."'" ;
																			$a .= ",'".$arreglo_6['Nombre']."'" ;
																			$a .= ",'".$arreglo_6['Marca']."'" ;
																			$a .= ",'".$arreglo_6['Modelo']."'" ;
																			$a .= ",'".$arreglo_6['AnoFab']."'" ;
																			$a .= ",'".$arreglo_6['Serie']."'" ; 
																			$a .= ",'".$arreglo_6['idLicitacion']."'" ; 
																			$a .= ",'".$arreglo_6['tabla']."'" ; 
																			$a .= ",'".$arreglo_6['table_value']."'" ; 
																			$a .= ",'".$arreglo_6['Direccion_img']."'" ; 
																			$a .= ",'".$arreglo_6['idSubTipo']."'" ; 
																			$a .= ",'".$arreglo_6['Grasa_inicial']."'" ; 
																			$a .= ",'".$arreglo_6['Grasa_relubricacion']."'" ; 
																			$a .= ",'".$arreglo_6['Aceite']."'" ; 
																			$a .= ",'".$arreglo_6['Cantidad']."'" ; 
																			$a .= ",'".$arreglo_6['idUml']."'" ; 
																			$a .= ",'".$arreglo_6['Frecuencia']."'" ; 
																			$a .= ",'".$arreglo_6['idFrecuencia']."'" ; 
																			$a .= ",'".$arreglo_6['idProducto']."'" ; 
																			$a .= ",'".$arreglo_6['Saf']."'" ; 
																			$a .= ",'".$arreglo_6['Numero']."'" ; 
																			
																			$cadena = '';
																			$x = 1;
																			if($lv_1!=0&&$lvl>1){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_2!=0&&$lvl>2){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_3!=0&&$lvl>3){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_4!=0&&$lvl>4){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_5!=0&&$lvl>5){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_6!=0&&$lvl>6){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_7!=0&&$lvl>7){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_8!=0&&$lvl>8){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_9!=0&&$lvl>9){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_10!=0&&$lvl>10){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_11!=0&&$lvl>11){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_12!=0&&$lvl>12){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_13!=0&&$lvl>13){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_14!=0&&$lvl>14){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_15!=0&&$lvl>15){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_16!=0&&$lvl>16){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_17!=0&&$lvl>17){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_18!=0&&$lvl>18){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_19!=0&&$lvl>19){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_20!=0&&$lvl>20){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_21!=0&&$lvl>21){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_22!=0&&$lvl>22){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_23!=0&&$lvl>23){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_24!=0&&$lvl>24){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			if($lv_25!=0&&$lvl>25){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_6['idLevel_'.$x]."'" ;$x++;}
																			
																			$x = 1;
																			if(isset($id_lvl[$dis_1])&&$id_lvl[$dis_1]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_1]."'" ;$x++;}
																			if(isset($id_lvl[$dis_2])&&$id_lvl[$dis_2]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_2]."'" ;$x++;}
																			if(isset($id_lvl[$dis_3])&&$id_lvl[$dis_3]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_3]."'" ;$x++;}
																			if(isset($id_lvl[$dis_4])&&$id_lvl[$dis_4]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_4]."'" ;$x++;}
																			if(isset($id_lvl[$dis_5])&&$id_lvl[$dis_5]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_5]."'" ;$x++;}
																			if(isset($id_lvl[$dis_6])&&$id_lvl[$dis_6]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_6]."'" ;$x++;}
																			if(isset($id_lvl[$dis_7])&&$id_lvl[$dis_7]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_7]."'" ;$x++;}
																			if(isset($id_lvl[$dis_8])&&$id_lvl[$dis_8]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_8]."'" ;$x++;}
																			if(isset($id_lvl[$dis_9])&&$id_lvl[$dis_9]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_9]."'" ;$x++;}
																			if(isset($id_lvl[$dis_10])&&$id_lvl[$dis_10]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_10]."'" ;$x++;}
																			if(isset($id_lvl[$dis_11])&&$id_lvl[$dis_11]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_11]."'" ;$x++;}
																			if(isset($id_lvl[$dis_12])&&$id_lvl[$dis_12]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_12]."'" ;$x++;}
																			if(isset($id_lvl[$dis_13])&&$id_lvl[$dis_13]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_13]."'" ;$x++;}
																			if(isset($id_lvl[$dis_14])&&$id_lvl[$dis_14]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_14]."'" ;$x++;}
																			if(isset($id_lvl[$dis_15])&&$id_lvl[$dis_15]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_15]."'" ;$x++;}
																			if(isset($id_lvl[$dis_16])&&$id_lvl[$dis_16]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_16]."'" ;$x++;}
																			if(isset($id_lvl[$dis_17])&&$id_lvl[$dis_17]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_17]."'" ;$x++;}
																			if(isset($id_lvl[$dis_18])&&$id_lvl[$dis_18]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_18]."'" ;$x++;}
																			if(isset($id_lvl[$dis_19])&&$id_lvl[$dis_19]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_19]."'" ;$x++;}
																			if(isset($id_lvl[$dis_20])&&$id_lvl[$dis_20]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_20]."'" ;$x++;}
																			if(isset($id_lvl[$dis_21])&&$id_lvl[$dis_21]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_21]."'" ;$x++;}
																			if(isset($id_lvl[$dis_22])&&$id_lvl[$dis_22]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_22]."'" ;$x++;}
																			if(isset($id_lvl[$dis_23])&&$id_lvl[$dis_23]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_23]."'" ;$x++;}
																			if(isset($id_lvl[$dis_24])&&$id_lvl[$dis_24]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_24]."'" ;$x++;}
																			if(isset($id_lvl[$dis_25])&&$id_lvl[$dis_25]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_25]."'" ;$x++;}
																			
																			
																			// inserto los datos de registro en la db
																			$query  = "INSERT INTO `maquinas_listado_level_".$dis_6."` (idSistema, idMaquina, idUtilizable, 
																			Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																			Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																			idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
																			VALUES (".$a.")";
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
																			$id_lvl[$dis_6] = mysqli_insert_id($dbConn);
																			
																			/////////////////////////////////////////////////
																			if(isset($arrLVL[$dis_7])){
																				foreach ($arrLVL[$dis_7] as $arreglo_7) {
																					//Se verifica que sea el mismo sensor
																					if($arreglo_6['idLevel_'.$dis_6]==$arreglo_7['idLevel_'.$dis_6]){
																					
																						//Se crea la maquina
																						$a  = "'".$arreglo_7['idSistema']."'" ;          
																						$a .= ",'".$arreglo_7['idMaquina']."'" ;        
																						$a .= ",'".$arreglo_7['idUtilizable']."'" ;
																						$a .= ",'".$arreglo_7['Codigo']."'" ;
																						$a .= ",'".$arreglo_7['Nombre']."'" ;
																						$a .= ",'".$arreglo_7['Marca']."'" ;
																						$a .= ",'".$arreglo_7['Modelo']."'" ;
																						$a .= ",'".$arreglo_7['AnoFab']."'" ;
																						$a .= ",'".$arreglo_7['Serie']."'" ; 
																						$a .= ",'".$arreglo_7['idLicitacion']."'" ; 
																						$a .= ",'".$arreglo_7['tabla']."'" ; 
																						$a .= ",'".$arreglo_7['table_value']."'" ; 
																						$a .= ",'".$arreglo_7['Direccion_img']."'" ; 
																						$a .= ",'".$arreglo_7['idSubTipo']."'" ; 
																						$a .= ",'".$arreglo_7['Grasa_inicial']."'" ; 
																						$a .= ",'".$arreglo_7['Grasa_relubricacion']."'" ; 
																						$a .= ",'".$arreglo_7['Aceite']."'" ; 
																						$a .= ",'".$arreglo_7['Cantidad']."'" ; 
																						$a .= ",'".$arreglo_7['idUml']."'" ; 
																						$a .= ",'".$arreglo_7['Frecuencia']."'" ; 
																						$a .= ",'".$arreglo_7['idFrecuencia']."'" ; 
																						$a .= ",'".$arreglo_7['idProducto']."'" ; 
																						$a .= ",'".$arreglo_7['Saf']."'" ; 
																						$a .= ",'".$arreglo_7['Numero']."'" ; 
																						
																						$cadena = '';
																						$x = 1;
																						if($lv_1!=0&&$lvl>1){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_2!=0&&$lvl>2){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_3!=0&&$lvl>3){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_4!=0&&$lvl>4){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_5!=0&&$lvl>5){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_6!=0&&$lvl>6){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_7!=0&&$lvl>7){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_8!=0&&$lvl>8){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_9!=0&&$lvl>9){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_10!=0&&$lvl>10){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_11!=0&&$lvl>11){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_12!=0&&$lvl>12){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_13!=0&&$lvl>13){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_14!=0&&$lvl>14){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_15!=0&&$lvl>15){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_16!=0&&$lvl>16){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_17!=0&&$lvl>17){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_18!=0&&$lvl>18){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_19!=0&&$lvl>19){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_20!=0&&$lvl>20){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_21!=0&&$lvl>21){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_22!=0&&$lvl>22){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_23!=0&&$lvl>23){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_24!=0&&$lvl>24){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						if($lv_25!=0&&$lvl>25){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_7['idLevel_'.$x]."'" ;$x++;}
																						
																						$x = 1;
																						if(isset($id_lvl[$dis_1])&&$id_lvl[$dis_1]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_1]."'" ;$x++;}
																						if(isset($id_lvl[$dis_2])&&$id_lvl[$dis_2]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_2]."'" ;$x++;}
																						if(isset($id_lvl[$dis_3])&&$id_lvl[$dis_3]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_3]."'" ;$x++;}
																						if(isset($id_lvl[$dis_4])&&$id_lvl[$dis_4]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_4]."'" ;$x++;}
																						if(isset($id_lvl[$dis_5])&&$id_lvl[$dis_5]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_5]."'" ;$x++;}
																						if(isset($id_lvl[$dis_6])&&$id_lvl[$dis_6]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_6]."'" ;$x++;}
																						if(isset($id_lvl[$dis_7])&&$id_lvl[$dis_7]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_7]."'" ;$x++;}
																						if(isset($id_lvl[$dis_8])&&$id_lvl[$dis_8]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_8]."'" ;$x++;}
																						if(isset($id_lvl[$dis_9])&&$id_lvl[$dis_9]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_9]."'" ;$x++;}
																						if(isset($id_lvl[$dis_10])&&$id_lvl[$dis_10]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_10]."'" ;$x++;}
																						if(isset($id_lvl[$dis_11])&&$id_lvl[$dis_11]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_11]."'" ;$x++;}
																						if(isset($id_lvl[$dis_12])&&$id_lvl[$dis_12]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_12]."'" ;$x++;}
																						if(isset($id_lvl[$dis_13])&&$id_lvl[$dis_13]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_13]."'" ;$x++;}
																						if(isset($id_lvl[$dis_14])&&$id_lvl[$dis_14]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_14]."'" ;$x++;}
																						if(isset($id_lvl[$dis_15])&&$id_lvl[$dis_15]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_15]."'" ;$x++;}
																						if(isset($id_lvl[$dis_16])&&$id_lvl[$dis_16]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_16]."'" ;$x++;}
																						if(isset($id_lvl[$dis_17])&&$id_lvl[$dis_17]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_17]."'" ;$x++;}
																						if(isset($id_lvl[$dis_18])&&$id_lvl[$dis_18]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_18]."'" ;$x++;}
																						if(isset($id_lvl[$dis_19])&&$id_lvl[$dis_19]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_19]."'" ;$x++;}
																						if(isset($id_lvl[$dis_20])&&$id_lvl[$dis_20]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_20]."'" ;$x++;}
																						if(isset($id_lvl[$dis_21])&&$id_lvl[$dis_21]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_21]."'" ;$x++;}
																						if(isset($id_lvl[$dis_22])&&$id_lvl[$dis_22]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_22]."'" ;$x++;}
																						if(isset($id_lvl[$dis_23])&&$id_lvl[$dis_23]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_23]."'" ;$x++;}
																						if(isset($id_lvl[$dis_24])&&$id_lvl[$dis_24]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_24]."'" ;$x++;}
																						if(isset($id_lvl[$dis_25])&&$id_lvl[$dis_25]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_25]."'" ;$x++;}
																						
																						
																						// inserto los datos de registro en la db
																						$query  = "INSERT INTO `maquinas_listado_level_".$dis_7."` (idSistema, idMaquina, idUtilizable, 
																						Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																						Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																						idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
																						VALUES (".$a.")";
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
																						$id_lvl[$dis_7] = mysqli_insert_id($dbConn);
																						
																						/////////////////////////////////////////////////
																						if(isset($arrLVL[$dis_8])){
																							foreach ($arrLVL[$dis_8] as $arreglo_8) {
																								//Se verifica que sea el mismo sensor
																								if($arreglo_7['idLevel_'.$dis_7]==$arreglo_8['idLevel_'.$dis_7]){
																								
																									//Se crea la maquina
																									$a  = "'".$arreglo_8['idSistema']."'" ;          
																									$a .= ",'".$arreglo_8['idMaquina']."'" ;        
																									$a .= ",'".$arreglo_8['idUtilizable']."'" ;
																									$a .= ",'".$arreglo_8['Codigo']."'" ;
																									$a .= ",'".$arreglo_8['Nombre']."'" ;
																									$a .= ",'".$arreglo_8['Marca']."'" ;
																									$a .= ",'".$arreglo_8['Modelo']."'" ;
																									$a .= ",'".$arreglo_8['AnoFab']."'" ;
																									$a .= ",'".$arreglo_8['Serie']."'" ; 
																									$a .= ",'".$arreglo_8['idLicitacion']."'" ; 
																									$a .= ",'".$arreglo_8['tabla']."'" ; 
																									$a .= ",'".$arreglo_8['table_value']."'" ; 
																									$a .= ",'".$arreglo_8['Direccion_img']."'" ; 
																									$a .= ",'".$arreglo_8['idSubTipo']."'" ; 
																									$a .= ",'".$arreglo_8['Grasa_inicial']."'" ; 
																									$a .= ",'".$arreglo_8['Grasa_relubricacion']."'" ; 
																									$a .= ",'".$arreglo_8['Aceite']."'" ; 
																									$a .= ",'".$arreglo_8['Cantidad']."'" ; 
																									$a .= ",'".$arreglo_8['idUml']."'" ; 
																									$a .= ",'".$arreglo_8['Frecuencia']."'" ; 
																									$a .= ",'".$arreglo_8['idFrecuencia']."'" ; 
																									$a .= ",'".$arreglo_8['idProducto']."'" ; 
																									$a .= ",'".$arreglo_8['Saf']."'" ; 
																									$a .= ",'".$arreglo_8['Numero']."'" ; 
																									
																									$cadena = '';
																									$x = 1;
																									if($lv_1!=0&&$lvl>1){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_2!=0&&$lvl>2){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_3!=0&&$lvl>3){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_4!=0&&$lvl>4){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_5!=0&&$lvl>5){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_6!=0&&$lvl>6){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_7!=0&&$lvl>7){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_8!=0&&$lvl>8){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_9!=0&&$lvl>9){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_10!=0&&$lvl>10){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_11!=0&&$lvl>11){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_12!=0&&$lvl>12){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_13!=0&&$lvl>13){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_14!=0&&$lvl>14){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_15!=0&&$lvl>15){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_16!=0&&$lvl>16){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_17!=0&&$lvl>17){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_18!=0&&$lvl>18){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_19!=0&&$lvl>19){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_20!=0&&$lvl>20){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_21!=0&&$lvl>21){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_22!=0&&$lvl>22){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_23!=0&&$lvl>23){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_24!=0&&$lvl>24){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									if($lv_25!=0&&$lvl>25){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_8['idLevel_'.$x]."'" ;$x++;}
																									
																									$x = 1;
																									if(isset($id_lvl[$dis_1])&&$id_lvl[$dis_1]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_1]."'" ;$x++;}
																									if(isset($id_lvl[$dis_2])&&$id_lvl[$dis_2]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_2]."'" ;$x++;}
																									if(isset($id_lvl[$dis_3])&&$id_lvl[$dis_3]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_3]."'" ;$x++;}
																									if(isset($id_lvl[$dis_4])&&$id_lvl[$dis_4]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_4]."'" ;$x++;}
																									if(isset($id_lvl[$dis_5])&&$id_lvl[$dis_5]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_5]."'" ;$x++;}
																									if(isset($id_lvl[$dis_6])&&$id_lvl[$dis_6]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_6]."'" ;$x++;}
																									if(isset($id_lvl[$dis_7])&&$id_lvl[$dis_7]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_7]."'" ;$x++;}
																									if(isset($id_lvl[$dis_8])&&$id_lvl[$dis_8]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_8]."'" ;$x++;}
																									if(isset($id_lvl[$dis_9])&&$id_lvl[$dis_9]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_9]."'" ;$x++;}
																									if(isset($id_lvl[$dis_10])&&$id_lvl[$dis_10]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_10]."'" ;$x++;}
																									if(isset($id_lvl[$dis_11])&&$id_lvl[$dis_11]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_11]."'" ;$x++;}
																									if(isset($id_lvl[$dis_12])&&$id_lvl[$dis_12]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_12]."'" ;$x++;}
																									if(isset($id_lvl[$dis_13])&&$id_lvl[$dis_13]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_13]."'" ;$x++;}
																									if(isset($id_lvl[$dis_14])&&$id_lvl[$dis_14]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_14]."'" ;$x++;}
																									if(isset($id_lvl[$dis_15])&&$id_lvl[$dis_15]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_15]."'" ;$x++;}
																									if(isset($id_lvl[$dis_16])&&$id_lvl[$dis_16]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_16]."'" ;$x++;}
																									if(isset($id_lvl[$dis_17])&&$id_lvl[$dis_17]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_17]."'" ;$x++;}
																									if(isset($id_lvl[$dis_18])&&$id_lvl[$dis_18]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_18]."'" ;$x++;}
																									if(isset($id_lvl[$dis_19])&&$id_lvl[$dis_19]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_19]."'" ;$x++;}
																									if(isset($id_lvl[$dis_20])&&$id_lvl[$dis_20]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_20]."'" ;$x++;}
																									if(isset($id_lvl[$dis_21])&&$id_lvl[$dis_21]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_21]."'" ;$x++;}
																									if(isset($id_lvl[$dis_22])&&$id_lvl[$dis_22]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_22]."'" ;$x++;}
																									if(isset($id_lvl[$dis_23])&&$id_lvl[$dis_23]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_23]."'" ;$x++;}
																									if(isset($id_lvl[$dis_24])&&$id_lvl[$dis_24]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_24]."'" ;$x++;}
																									if(isset($id_lvl[$dis_25])&&$id_lvl[$dis_25]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_25]."'" ;$x++;}
																									
																									
																									// inserto los datos de registro en la db
																									$query  = "INSERT INTO `maquinas_listado_level_".$dis_8."` (idSistema, idMaquina, idUtilizable, 
																									Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																									Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																									idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
																									VALUES (".$a.")";
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
																									$id_lvl[$dis_8] = mysqli_insert_id($dbConn);
																									
																									/////////////////////////////////////////////////
																									if(isset($arrLVL[$dis_9])){
																										foreach ($arrLVL[$dis_9] as $arreglo_9) {
																											//Se verifica que sea el mismo sensor
																											if($arreglo_8['idLevel_'.$dis_8]==$arreglo_9['idLevel_'.$dis_8]){
																											
																												//Se crea la maquina
																												$a  = "'".$arreglo_9['idSistema']."'" ;          
																												$a .= ",'".$arreglo_9['idMaquina']."'" ;        
																												$a .= ",'".$arreglo_9['idUtilizable']."'" ;
																												$a .= ",'".$arreglo_9['Codigo']."'" ;
																												$a .= ",'".$arreglo_9['Nombre']."'" ;
																												$a .= ",'".$arreglo_9['Marca']."'" ;
																												$a .= ",'".$arreglo_9['Modelo']."'" ;
																												$a .= ",'".$arreglo_9['AnoFab']."'" ;
																												$a .= ",'".$arreglo_9['Serie']."'" ; 
																												$a .= ",'".$arreglo_9['idLicitacion']."'" ; 
																												$a .= ",'".$arreglo_9['tabla']."'" ; 
																												$a .= ",'".$arreglo_9['table_value']."'" ; 
																												$a .= ",'".$arreglo_9['Direccion_img']."'" ; 
																												$a .= ",'".$arreglo_9['idSubTipo']."'" ; 
																												$a .= ",'".$arreglo_9['Grasa_inicial']."'" ; 
																												$a .= ",'".$arreglo_9['Grasa_relubricacion']."'" ; 
																												$a .= ",'".$arreglo_9['Aceite']."'" ; 
																												$a .= ",'".$arreglo_9['Cantidad']."'" ; 
																												$a .= ",'".$arreglo_9['idUml']."'" ; 
																												$a .= ",'".$arreglo_9['Frecuencia']."'" ; 
																												$a .= ",'".$arreglo_9['idFrecuencia']."'" ; 
																												$a .= ",'".$arreglo_9['idProducto']."'" ; 
																												$a .= ",'".$arreglo_9['Saf']."'" ; 
																												$a .= ",'".$arreglo_9['Numero']."'" ; 
																												
																												$cadena = '';
																												$x = 1;
																												if($lv_1!=0&&$lvl>1){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_2!=0&&$lvl>2){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_3!=0&&$lvl>3){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_4!=0&&$lvl>4){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_5!=0&&$lvl>5){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_6!=0&&$lvl>6){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_7!=0&&$lvl>7){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_8!=0&&$lvl>8){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_9!=0&&$lvl>9){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_10!=0&&$lvl>10){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_11!=0&&$lvl>11){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_12!=0&&$lvl>12){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_13!=0&&$lvl>13){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_14!=0&&$lvl>14){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_15!=0&&$lvl>15){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_16!=0&&$lvl>16){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_17!=0&&$lvl>17){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_18!=0&&$lvl>18){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_19!=0&&$lvl>19){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_20!=0&&$lvl>20){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_21!=0&&$lvl>21){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_22!=0&&$lvl>22){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_23!=0&&$lvl>23){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_24!=0&&$lvl>24){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												if($lv_25!=0&&$lvl>25){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_9['idLevel_'.$x]."'" ;$x++;}
																												
																												$x = 1;
																												if(isset($id_lvl[$dis_1])&&$id_lvl[$dis_1]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_1]."'" ;$x++;}
																												if(isset($id_lvl[$dis_2])&&$id_lvl[$dis_2]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_2]."'" ;$x++;}
																												if(isset($id_lvl[$dis_3])&&$id_lvl[$dis_3]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_3]."'" ;$x++;}
																												if(isset($id_lvl[$dis_4])&&$id_lvl[$dis_4]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_4]."'" ;$x++;}
																												if(isset($id_lvl[$dis_5])&&$id_lvl[$dis_5]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_5]."'" ;$x++;}
																												if(isset($id_lvl[$dis_6])&&$id_lvl[$dis_6]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_6]."'" ;$x++;}
																												if(isset($id_lvl[$dis_7])&&$id_lvl[$dis_7]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_7]."'" ;$x++;}
																												if(isset($id_lvl[$dis_8])&&$id_lvl[$dis_8]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_8]."'" ;$x++;}
																												if(isset($id_lvl[$dis_9])&&$id_lvl[$dis_9]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_9]."'" ;$x++;}
																												if(isset($id_lvl[$dis_10])&&$id_lvl[$dis_10]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_10]."'" ;$x++;}
																												if(isset($id_lvl[$dis_11])&&$id_lvl[$dis_11]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_11]."'" ;$x++;}
																												if(isset($id_lvl[$dis_12])&&$id_lvl[$dis_12]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_12]."'" ;$x++;}
																												if(isset($id_lvl[$dis_13])&&$id_lvl[$dis_13]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_13]."'" ;$x++;}
																												if(isset($id_lvl[$dis_14])&&$id_lvl[$dis_14]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_14]."'" ;$x++;}
																												if(isset($id_lvl[$dis_15])&&$id_lvl[$dis_15]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_15]."'" ;$x++;}
																												if(isset($id_lvl[$dis_16])&&$id_lvl[$dis_16]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_16]."'" ;$x++;}
																												if(isset($id_lvl[$dis_17])&&$id_lvl[$dis_17]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_17]."'" ;$x++;}
																												if(isset($id_lvl[$dis_18])&&$id_lvl[$dis_18]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_18]."'" ;$x++;}
																												if(isset($id_lvl[$dis_19])&&$id_lvl[$dis_19]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_19]."'" ;$x++;}
																												if(isset($id_lvl[$dis_20])&&$id_lvl[$dis_20]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_20]."'" ;$x++;}
																												if(isset($id_lvl[$dis_21])&&$id_lvl[$dis_21]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_21]."'" ;$x++;}
																												if(isset($id_lvl[$dis_22])&&$id_lvl[$dis_22]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_22]."'" ;$x++;}
																												if(isset($id_lvl[$dis_23])&&$id_lvl[$dis_23]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_23]."'" ;$x++;}
																												if(isset($id_lvl[$dis_24])&&$id_lvl[$dis_24]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_24]."'" ;$x++;}
																												if(isset($id_lvl[$dis_25])&&$id_lvl[$dis_25]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_25]."'" ;$x++;}
																												
																												
																												// inserto los datos de registro en la db
																												$query  = "INSERT INTO `maquinas_listado_level_".$dis_9."` (idSistema, idMaquina, idUtilizable, 
																												Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																												Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																												idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
																												VALUES (".$a.")";
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
																												$id_lvl[$dis_9] = mysqli_insert_id($dbConn);
																												
																												/////////////////////////////////////////////////
																												if(isset($arrLVL[$dis_10])){
																													foreach ($arrLVL[$dis_10] as $arreglo_10) {
																														//Se verifica que sea el mismo sensor
																														if($arreglo_9['idLevel_'.$dis_9]==$arreglo_10['idLevel_'.$dis_9]){
																														
																															//Se crea la maquina
																															$a  = "'".$arreglo_10['idSistema']."'" ;          
																															$a .= ",'".$arreglo_10['idMaquina']."'" ;        
																															$a .= ",'".$arreglo_10['idUtilizable']."'" ;
																															$a .= ",'".$arreglo_10['Codigo']."'" ;
																															$a .= ",'".$arreglo_10['Nombre']."'" ;
																															$a .= ",'".$arreglo_10['Marca']."'" ;
																															$a .= ",'".$arreglo_10['Modelo']."'" ;
																															$a .= ",'".$arreglo_10['AnoFab']."'" ;
																															$a .= ",'".$arreglo_10['Serie']."'" ; 
																															$a .= ",'".$arreglo_10['idLicitacion']."'" ; 
																															$a .= ",'".$arreglo_10['tabla']."'" ; 
																															$a .= ",'".$arreglo_10['table_value']."'" ; 
																															$a .= ",'".$arreglo_10['Direccion_img']."'" ; 
																															$a .= ",'".$arreglo_10['idSubTipo']."'" ; 
																															$a .= ",'".$arreglo_10['Grasa_inicial']."'" ; 
																															$a .= ",'".$arreglo_10['Grasa_relubricacion']."'" ; 
																															$a .= ",'".$arreglo_10['Aceite']."'" ; 
																															$a .= ",'".$arreglo_10['Cantidad']."'" ; 
																															$a .= ",'".$arreglo_10['idUml']."'" ; 
																															$a .= ",'".$arreglo_10['Frecuencia']."'" ; 
																															$a .= ",'".$arreglo_10['idFrecuencia']."'" ; 
																															$a .= ",'".$arreglo_10['idProducto']."'" ; 
																															$a .= ",'".$arreglo_10['Saf']."'" ; 
																															$a .= ",'".$arreglo_10['Numero']."'" ; 
																															
																															$cadena = '';
																															$x = 1;
																															if($lv_1!=0&&$lvl>1){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_2!=0&&$lvl>2){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_3!=0&&$lvl>3){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_4!=0&&$lvl>4){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_5!=0&&$lvl>5){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_6!=0&&$lvl>6){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_7!=0&&$lvl>7){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_8!=0&&$lvl>8){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_9!=0&&$lvl>9){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_10!=0&&$lvl>10){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_11!=0&&$lvl>11){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_12!=0&&$lvl>12){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_13!=0&&$lvl>13){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_14!=0&&$lvl>14){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_15!=0&&$lvl>15){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_16!=0&&$lvl>16){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_17!=0&&$lvl>17){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_18!=0&&$lvl>18){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_19!=0&&$lvl>19){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_20!=0&&$lvl>20){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_21!=0&&$lvl>21){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_22!=0&&$lvl>22){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_23!=0&&$lvl>23){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_24!=0&&$lvl>24){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															if($lv_25!=0&&$lvl>25){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_10['idLevel_'.$x]."'" ;$x++;}
																															
																															$x = 1;
																															if(isset($id_lvl[$dis_1])&&$id_lvl[$dis_1]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_1]."'" ;$x++;}
																															if(isset($id_lvl[$dis_2])&&$id_lvl[$dis_2]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_2]."'" ;$x++;}
																															if(isset($id_lvl[$dis_3])&&$id_lvl[$dis_3]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_3]."'" ;$x++;}
																															if(isset($id_lvl[$dis_4])&&$id_lvl[$dis_4]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_4]."'" ;$x++;}
																															if(isset($id_lvl[$dis_5])&&$id_lvl[$dis_5]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_5]."'" ;$x++;}
																															if(isset($id_lvl[$dis_6])&&$id_lvl[$dis_6]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_6]."'" ;$x++;}
																															if(isset($id_lvl[$dis_7])&&$id_lvl[$dis_7]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_7]."'" ;$x++;}
																															if(isset($id_lvl[$dis_8])&&$id_lvl[$dis_8]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_8]."'" ;$x++;}
																															if(isset($id_lvl[$dis_9])&&$id_lvl[$dis_9]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_9]."'" ;$x++;}
																															if(isset($id_lvl[$dis_10])&&$id_lvl[$dis_10]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_10]."'" ;$x++;}
																															if(isset($id_lvl[$dis_11])&&$id_lvl[$dis_11]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_11]."'" ;$x++;}
																															if(isset($id_lvl[$dis_12])&&$id_lvl[$dis_12]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_12]."'" ;$x++;}
																															if(isset($id_lvl[$dis_13])&&$id_lvl[$dis_13]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_13]."'" ;$x++;}
																															if(isset($id_lvl[$dis_14])&&$id_lvl[$dis_14]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_14]."'" ;$x++;}
																															if(isset($id_lvl[$dis_15])&&$id_lvl[$dis_15]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_15]."'" ;$x++;}
																															if(isset($id_lvl[$dis_16])&&$id_lvl[$dis_16]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_16]."'" ;$x++;}
																															if(isset($id_lvl[$dis_17])&&$id_lvl[$dis_17]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_17]."'" ;$x++;}
																															if(isset($id_lvl[$dis_18])&&$id_lvl[$dis_18]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_18]."'" ;$x++;}
																															if(isset($id_lvl[$dis_19])&&$id_lvl[$dis_19]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_19]."'" ;$x++;}
																															if(isset($id_lvl[$dis_20])&&$id_lvl[$dis_20]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_20]."'" ;$x++;}
																															if(isset($id_lvl[$dis_21])&&$id_lvl[$dis_21]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_21]."'" ;$x++;}
																															if(isset($id_lvl[$dis_22])&&$id_lvl[$dis_22]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_22]."'" ;$x++;}
																															if(isset($id_lvl[$dis_23])&&$id_lvl[$dis_23]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_23]."'" ;$x++;}
																															if(isset($id_lvl[$dis_24])&&$id_lvl[$dis_24]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_24]."'" ;$x++;}
																															if(isset($id_lvl[$dis_25])&&$id_lvl[$dis_25]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_25]."'" ;$x++;}
																															
																															
																															// inserto los datos de registro en la db
																															$query  = "INSERT INTO `maquinas_listado_level_".$dis_10."` (idSistema, idMaquina, idUtilizable, 
																															Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																															Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																															idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
																															VALUES (".$a.")";
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
																															$id_lvl[$dis_10] = mysqli_insert_id($dbConn);
																															
																															/////////////////////////////////////////////////
																															if(isset($arrLVL[$dis_11])){
																																foreach ($arrLVL[$dis_11] as $arreglo_11) {
																																	//Se verifica que sea el mismo sensor
																																	if($arreglo_10['idLevel_'.$dis_10]==$arreglo_11['idLevel_'.$dis_10]){
																																	
																																		//Se crea la maquina
																																		$a  = "'".$arreglo_11['idSistema']."'" ;          
																																		$a .= ",'".$arreglo_11['idMaquina']."'" ;        
																																		$a .= ",'".$arreglo_11['idUtilizable']."'" ;
																																		$a .= ",'".$arreglo_11['Codigo']."'" ;
																																		$a .= ",'".$arreglo_11['Nombre']."'" ;
																																		$a .= ",'".$arreglo_11['Marca']."'" ;
																																		$a .= ",'".$arreglo_11['Modelo']."'" ;
																																		$a .= ",'".$arreglo_11['AnoFab']."'" ;
																																		$a .= ",'".$arreglo_11['Serie']."'" ; 
																																		$a .= ",'".$arreglo_11['idLicitacion']."'" ; 
																																		$a .= ",'".$arreglo_11['tabla']."'" ; 
																																		$a .= ",'".$arreglo_11['table_value']."'" ; 
																																		$a .= ",'".$arreglo_11['Direccion_img']."'" ; 
																																		$a .= ",'".$arreglo_11['idSubTipo']."'" ; 
																																		$a .= ",'".$arreglo_11['Grasa_inicial']."'" ; 
																																		$a .= ",'".$arreglo_11['Grasa_relubricacion']."'" ; 
																																		$a .= ",'".$arreglo_11['Aceite']."'" ; 
																																		$a .= ",'".$arreglo_11['Cantidad']."'" ; 
																																		$a .= ",'".$arreglo_11['idUml']."'" ; 
																																		$a .= ",'".$arreglo_11['Frecuencia']."'" ; 
																																		$a .= ",'".$arreglo_11['idFrecuencia']."'" ; 
																																		$a .= ",'".$arreglo_11['idProducto']."'" ; 
																																		$a .= ",'".$arreglo_11['Saf']."'" ; 
																																		$a .= ",'".$arreglo_11['Numero']."'" ; 
																																		
																																		$cadena = '';
																																		$x = 1;
																																		if($lv_1!=0&&$lvl>1){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_2!=0&&$lvl>2){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_3!=0&&$lvl>3){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_4!=0&&$lvl>4){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_5!=0&&$lvl>5){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_6!=0&&$lvl>6){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_7!=0&&$lvl>7){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_8!=0&&$lvl>8){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_9!=0&&$lvl>9){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_10!=0&&$lvl>10){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_11!=0&&$lvl>11){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_12!=0&&$lvl>12){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_13!=0&&$lvl>13){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_14!=0&&$lvl>14){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_15!=0&&$lvl>15){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_16!=0&&$lvl>16){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_17!=0&&$lvl>17){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_18!=0&&$lvl>18){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_19!=0&&$lvl>19){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_20!=0&&$lvl>20){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_21!=0&&$lvl>21){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_22!=0&&$lvl>22){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_23!=0&&$lvl>23){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_24!=0&&$lvl>24){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		if($lv_25!=0&&$lvl>25){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_11['idLevel_'.$x]."'" ;$x++;}
																																		
																																		$x = 1;
																																		if(isset($id_lvl[$dis_1])&&$id_lvl[$dis_1]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_1]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_2])&&$id_lvl[$dis_2]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_2]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_3])&&$id_lvl[$dis_3]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_3]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_4])&&$id_lvl[$dis_4]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_4]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_5])&&$id_lvl[$dis_5]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_5]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_6])&&$id_lvl[$dis_6]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_6]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_7])&&$id_lvl[$dis_7]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_7]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_8])&&$id_lvl[$dis_8]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_8]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_9])&&$id_lvl[$dis_9]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_9]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_10])&&$id_lvl[$dis_10]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_10]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_11])&&$id_lvl[$dis_11]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_11]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_12])&&$id_lvl[$dis_12]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_12]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_13])&&$id_lvl[$dis_13]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_13]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_14])&&$id_lvl[$dis_14]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_14]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_15])&&$id_lvl[$dis_15]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_15]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_16])&&$id_lvl[$dis_16]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_16]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_17])&&$id_lvl[$dis_17]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_17]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_18])&&$id_lvl[$dis_18]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_18]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_19])&&$id_lvl[$dis_19]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_19]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_20])&&$id_lvl[$dis_20]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_20]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_21])&&$id_lvl[$dis_21]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_21]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_22])&&$id_lvl[$dis_22]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_22]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_23])&&$id_lvl[$dis_23]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_23]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_24])&&$id_lvl[$dis_24]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_24]."'" ;$x++;}
																																		if(isset($id_lvl[$dis_25])&&$id_lvl[$dis_25]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_25]."'" ;$x++;}
																																		
																																		
																																		// inserto los datos de registro en la db
																																		$query  = "INSERT INTO `maquinas_listado_level_".$dis_11."` (idSistema, idMaquina, idUtilizable, 
																																		Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																		Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																		idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
																																		VALUES (".$a.")";
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
																																		$id_lvl[$dis_11] = mysqli_insert_id($dbConn);
																																		
																																		/////////////////////////////////////////////////
																																		if(isset($arrLVL[$dis_12])){
																																			foreach ($arrLVL[$dis_12] as $arreglo_12) {
																																				//Se verifica que sea el mismo sensor
																																				if($arreglo_11['idLevel_'.$dis_11]==$arreglo_12['idLevel_'.$dis_11]){
																																				
																																					//Se crea la maquina
																																					$a  = "'".$arreglo_12['idSistema']."'" ;          
																																					$a .= ",'".$arreglo_12['idMaquina']."'" ;        
																																					$a .= ",'".$arreglo_12['idUtilizable']."'" ;
																																					$a .= ",'".$arreglo_12['Codigo']."'" ;
																																					$a .= ",'".$arreglo_12['Nombre']."'" ;
																																					$a .= ",'".$arreglo_12['Marca']."'" ;
																																					$a .= ",'".$arreglo_12['Modelo']."'" ;
																																					$a .= ",'".$arreglo_12['AnoFab']."'" ;
																																					$a .= ",'".$arreglo_12['Serie']."'" ; 
																																					$a .= ",'".$arreglo_12['idLicitacion']."'" ; 
																																					$a .= ",'".$arreglo_12['tabla']."'" ; 
																																					$a .= ",'".$arreglo_12['table_value']."'" ; 
																																					$a .= ",'".$arreglo_12['Direccion_img']."'" ; 
																																					$a .= ",'".$arreglo_12['idSubTipo']."'" ; 
																																					$a .= ",'".$arreglo_12['Grasa_inicial']."'" ; 
																																					$a .= ",'".$arreglo_12['Grasa_relubricacion']."'" ; 
																																					$a .= ",'".$arreglo_12['Aceite']."'" ; 
																																					$a .= ",'".$arreglo_12['Cantidad']."'" ; 
																																					$a .= ",'".$arreglo_12['idUml']."'" ; 
																																					$a .= ",'".$arreglo_12['Frecuencia']."'" ; 
																																					$a .= ",'".$arreglo_12['idFrecuencia']."'" ; 
																																					$a .= ",'".$arreglo_12['idProducto']."'" ; 
																																					$a .= ",'".$arreglo_12['Saf']."'" ; 
																																					$a .= ",'".$arreglo_12['Numero']."'" ; 
																																					
																																					$cadena = '';
																																					$x = 1;
																																					if($lv_1!=0&&$lvl>1){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_2!=0&&$lvl>2){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_3!=0&&$lvl>3){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_4!=0&&$lvl>4){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_5!=0&&$lvl>5){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_6!=0&&$lvl>6){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_7!=0&&$lvl>7){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_8!=0&&$lvl>8){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_9!=0&&$lvl>9){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_10!=0&&$lvl>10){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_11!=0&&$lvl>11){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_12!=0&&$lvl>12){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_13!=0&&$lvl>13){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_14!=0&&$lvl>14){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_15!=0&&$lvl>15){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_16!=0&&$lvl>16){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_17!=0&&$lvl>17){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_18!=0&&$lvl>18){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_19!=0&&$lvl>19){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_20!=0&&$lvl>20){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_21!=0&&$lvl>21){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_22!=0&&$lvl>22){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_23!=0&&$lvl>23){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_24!=0&&$lvl>24){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					if($lv_25!=0&&$lvl>25){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_12['idLevel_'.$x]."'" ;$x++;}
																																					
																																					$x = 1;
																																					if(isset($id_lvl[$dis_1])&&$id_lvl[$dis_1]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_1]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_2])&&$id_lvl[$dis_2]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_2]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_3])&&$id_lvl[$dis_3]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_3]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_4])&&$id_lvl[$dis_4]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_4]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_5])&&$id_lvl[$dis_5]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_5]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_6])&&$id_lvl[$dis_6]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_6]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_7])&&$id_lvl[$dis_7]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_7]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_8])&&$id_lvl[$dis_8]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_8]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_9])&&$id_lvl[$dis_9]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_9]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_10])&&$id_lvl[$dis_10]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_10]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_11])&&$id_lvl[$dis_11]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_11]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_12])&&$id_lvl[$dis_12]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_12]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_13])&&$id_lvl[$dis_13]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_13]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_14])&&$id_lvl[$dis_14]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_14]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_15])&&$id_lvl[$dis_15]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_15]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_16])&&$id_lvl[$dis_16]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_16]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_17])&&$id_lvl[$dis_17]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_17]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_18])&&$id_lvl[$dis_18]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_18]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_19])&&$id_lvl[$dis_19]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_19]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_20])&&$id_lvl[$dis_20]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_20]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_21])&&$id_lvl[$dis_21]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_21]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_22])&&$id_lvl[$dis_22]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_22]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_23])&&$id_lvl[$dis_23]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_23]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_24])&&$id_lvl[$dis_24]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_24]."'" ;$x++;}
																																					if(isset($id_lvl[$dis_25])&&$id_lvl[$dis_25]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_25]."'" ;$x++;}
																																					
																																					
																																					// inserto los datos de registro en la db
																																					$query  = "INSERT INTO `maquinas_listado_level_".$dis_12."` (idSistema, idMaquina, idUtilizable, 
																																					Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																					Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																					idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
																																					VALUES (".$a.")";
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
																																					$id_lvl[$dis_12] = mysqli_insert_id($dbConn);
																																					
																																					/////////////////////////////////////////////////
																																					if(isset($arrLVL[$dis_13])){
																																						foreach ($arrLVL[$dis_13] as $arreglo_13) {
																																							//Se verifica que sea el mismo sensor
																																							if($arreglo_12['idLevel_'.$dis_12]==$arreglo_13['idLevel_'.$dis_12]){
																																							
																																								//Se crea la maquina
																																								$a  = "'".$arreglo_13['idSistema']."'" ;          
																																								$a .= ",'".$arreglo_13['idMaquina']."'" ;        
																																								$a .= ",'".$arreglo_13['idUtilizable']."'" ;
																																								$a .= ",'".$arreglo_13['Codigo']."'" ;
																																								$a .= ",'".$arreglo_13['Nombre']."'" ;
																																								$a .= ",'".$arreglo_13['Marca']."'" ;
																																								$a .= ",'".$arreglo_13['Modelo']."'" ;
																																								$a .= ",'".$arreglo_13['AnoFab']."'" ;
																																								$a .= ",'".$arreglo_13['Serie']."'" ; 
																																								$a .= ",'".$arreglo_13['idLicitacion']."'" ; 
																																								$a .= ",'".$arreglo_13['tabla']."'" ; 
																																								$a .= ",'".$arreglo_13['table_value']."'" ; 
																																								$a .= ",'".$arreglo_13['Direccion_img']."'" ; 
																																								$a .= ",'".$arreglo_13['idSubTipo']."'" ; 
																																								$a .= ",'".$arreglo_13['Grasa_inicial']."'" ; 
																																								$a .= ",'".$arreglo_13['Grasa_relubricacion']."'" ; 
																																								$a .= ",'".$arreglo_13['Aceite']."'" ; 
																																								$a .= ",'".$arreglo_13['Cantidad']."'" ; 
																																								$a .= ",'".$arreglo_13['idUml']."'" ; 
																																								$a .= ",'".$arreglo_13['Frecuencia']."'" ; 
																																								$a .= ",'".$arreglo_13['idFrecuencia']."'" ; 
																																								$a .= ",'".$arreglo_13['idProducto']."'" ; 
																																								$a .= ",'".$arreglo_13['Saf']."'" ; 
																																								$a .= ",'".$arreglo_13['Numero']."'" ;
																																								
																																								$cadena = '';
																																								$x = 1;
																																								if($lv_1!=0&&$lvl>1){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_2!=0&&$lvl>2){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_3!=0&&$lvl>3){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_4!=0&&$lvl>4){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_5!=0&&$lvl>5){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_6!=0&&$lvl>6){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_7!=0&&$lvl>7){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_8!=0&&$lvl>8){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_9!=0&&$lvl>9){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_10!=0&&$lvl>10){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_11!=0&&$lvl>11){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_12!=0&&$lvl>12){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_13!=0&&$lvl>13){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_14!=0&&$lvl>14){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_15!=0&&$lvl>15){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_16!=0&&$lvl>16){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_17!=0&&$lvl>17){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_18!=0&&$lvl>18){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_19!=0&&$lvl>19){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_20!=0&&$lvl>20){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_21!=0&&$lvl>21){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_22!=0&&$lvl>22){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_23!=0&&$lvl>23){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_24!=0&&$lvl>24){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								if($lv_25!=0&&$lvl>25){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_13['idLevel_'.$x]."'" ;$x++;}
																																								
																																								$x = 1;
																																								if(isset($id_lvl[$dis_1])&&$id_lvl[$dis_1]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_1]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_2])&&$id_lvl[$dis_2]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_2]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_3])&&$id_lvl[$dis_3]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_3]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_4])&&$id_lvl[$dis_4]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_4]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_5])&&$id_lvl[$dis_5]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_5]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_6])&&$id_lvl[$dis_6]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_6]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_7])&&$id_lvl[$dis_7]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_7]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_8])&&$id_lvl[$dis_8]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_8]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_9])&&$id_lvl[$dis_9]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_9]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_10])&&$id_lvl[$dis_10]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_10]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_11])&&$id_lvl[$dis_11]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_11]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_12])&&$id_lvl[$dis_12]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_12]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_13])&&$id_lvl[$dis_13]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_13]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_14])&&$id_lvl[$dis_14]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_14]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_15])&&$id_lvl[$dis_15]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_15]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_16])&&$id_lvl[$dis_16]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_16]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_17])&&$id_lvl[$dis_17]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_17]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_18])&&$id_lvl[$dis_18]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_18]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_19])&&$id_lvl[$dis_19]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_19]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_20])&&$id_lvl[$dis_20]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_20]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_21])&&$id_lvl[$dis_21]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_21]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_22])&&$id_lvl[$dis_22]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_22]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_23])&&$id_lvl[$dis_23]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_23]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_24])&&$id_lvl[$dis_24]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_24]."'" ;$x++;}
																																								if(isset($id_lvl[$dis_25])&&$id_lvl[$dis_25]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_25]."'" ;$x++;}
																																								
																																								
																																								// inserto los datos de registro en la db
																																								$query  = "INSERT INTO `maquinas_listado_level_".$dis_13."` (idSistema, idMaquina, idUtilizable, 
																																								Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																								Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																								idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
																																								VALUES (".$a.")";
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
																																								$id_lvl[$dis_13] = mysqli_insert_id($dbConn);
																																								
																																								/////////////////////////////////////////////////
																																								if(isset($arrLVL[$dis_14])){
																																									foreach ($arrLVL[$dis_14] as $arreglo_14) {
																																										//Se verifica que sea el mismo sensor
																																										if($arreglo_13['idLevel_'.$dis_13]==$arreglo_14['idLevel_'.$dis_13]){
																																										
																																											//Se crea la maquina
																																											$a  = "'".$arreglo_14['idSistema']."'" ;          
																																											$a .= ",'".$arreglo_14['idMaquina']."'" ;        
																																											$a .= ",'".$arreglo_14['idUtilizable']."'" ;
																																											$a .= ",'".$arreglo_14['Codigo']."'" ;
																																											$a .= ",'".$arreglo_14['Nombre']."'" ;
																																											$a .= ",'".$arreglo_14['Marca']."'" ;
																																											$a .= ",'".$arreglo_14['Modelo']."'" ;
																																											$a .= ",'".$arreglo_14['AnoFab']."'" ;
																																											$a .= ",'".$arreglo_14['Serie']."'" ; 
																																											$a .= ",'".$arreglo_14['idLicitacion']."'" ; 
																																											$a .= ",'".$arreglo_14['tabla']."'" ; 
																																											$a .= ",'".$arreglo_14['table_value']."'" ; 
																																											$a .= ",'".$arreglo_14['Direccion_img']."'" ; 
																																											$a .= ",'".$arreglo_14['idSubTipo']."'" ; 
																																											$a .= ",'".$arreglo_14['Grasa_inicial']."'" ; 
																																											$a .= ",'".$arreglo_14['Grasa_relubricacion']."'" ; 
																																											$a .= ",'".$arreglo_14['Aceite']."'" ; 
																																											$a .= ",'".$arreglo_14['Cantidad']."'" ; 
																																											$a .= ",'".$arreglo_14['idUml']."'" ; 
																																											$a .= ",'".$arreglo_14['Frecuencia']."'" ; 
																																											$a .= ",'".$arreglo_14['idFrecuencia']."'" ; 
																																											$a .= ",'".$arreglo_14['idProducto']."'" ; 
																																											$a .= ",'".$arreglo_14['Saf']."'" ; 
																																											$a .= ",'".$arreglo_14['Numero']."'" ; 
																																											
																																											$cadena = '';
																																											$x = 1;
																																											if($lv_1!=0&&$lvl>1){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_2!=0&&$lvl>2){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_3!=0&&$lvl>3){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_4!=0&&$lvl>4){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_5!=0&&$lvl>5){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_6!=0&&$lvl>6){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_7!=0&&$lvl>7){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_8!=0&&$lvl>8){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_9!=0&&$lvl>9){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_10!=0&&$lvl>10){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_11!=0&&$lvl>11){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_12!=0&&$lvl>12){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_13!=0&&$lvl>13){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_14!=0&&$lvl>14){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_15!=0&&$lvl>15){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_16!=0&&$lvl>16){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_17!=0&&$lvl>17){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_18!=0&&$lvl>18){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_19!=0&&$lvl>19){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_20!=0&&$lvl>20){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_21!=0&&$lvl>21){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_22!=0&&$lvl>22){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_23!=0&&$lvl>23){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_24!=0&&$lvl>24){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											if($lv_25!=0&&$lvl>25){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_14['idLevel_'.$x]."'" ;$x++;}
																																											
																																											$x = 1;
																																											if(isset($id_lvl[$dis_1])&&$id_lvl[$dis_1]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_1]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_2])&&$id_lvl[$dis_2]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_2]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_3])&&$id_lvl[$dis_3]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_3]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_4])&&$id_lvl[$dis_4]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_4]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_5])&&$id_lvl[$dis_5]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_5]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_6])&&$id_lvl[$dis_6]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_6]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_7])&&$id_lvl[$dis_7]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_7]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_8])&&$id_lvl[$dis_8]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_8]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_9])&&$id_lvl[$dis_9]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_9]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_10])&&$id_lvl[$dis_10]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_10]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_11])&&$id_lvl[$dis_11]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_11]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_12])&&$id_lvl[$dis_12]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_12]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_13])&&$id_lvl[$dis_13]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_13]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_14])&&$id_lvl[$dis_14]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_14]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_15])&&$id_lvl[$dis_15]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_15]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_16])&&$id_lvl[$dis_16]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_16]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_17])&&$id_lvl[$dis_17]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_17]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_18])&&$id_lvl[$dis_18]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_18]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_19])&&$id_lvl[$dis_19]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_19]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_20])&&$id_lvl[$dis_20]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_20]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_21])&&$id_lvl[$dis_21]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_21]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_22])&&$id_lvl[$dis_22]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_22]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_23])&&$id_lvl[$dis_23]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_23]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_24])&&$id_lvl[$dis_24]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_24]."'" ;$x++;}
																																											if(isset($id_lvl[$dis_25])&&$id_lvl[$dis_25]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_25]."'" ;$x++;}
																																											
																																											
																																											// inserto los datos de registro en la db
																																											$query  = "INSERT INTO `maquinas_listado_level_".$dis_14."` (idSistema, idMaquina, idUtilizable, 
																																											Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																											Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																											idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
																																											VALUES (".$a.")";
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
																																											$id_lvl[$dis_14] = mysqli_insert_id($dbConn);
																																											
																																											/////////////////////////////////////////////////
																																											if(isset($arrLVL[$dis_15])){
																																												foreach ($arrLVL[$dis_15] as $arreglo_15) {
																																													//Se verifica que sea el mismo sensor
																																													if($arreglo_14['idLevel_'.$dis_14]==$arreglo_15['idLevel_'.$dis_14]){
																																													
																																														//Se crea la maquina
																																														$a  = "'".$arreglo_15['idSistema']."'" ;          
																																														$a .= ",'".$arreglo_15['idMaquina']."'" ;        
																																														$a .= ",'".$arreglo_15['idUtilizable']."'" ;
																																														$a .= ",'".$arreglo_15['Codigo']."'" ;
																																														$a .= ",'".$arreglo_15['Nombre']."'" ;
																																														$a .= ",'".$arreglo_15['Marca']."'" ;
																																														$a .= ",'".$arreglo_15['Modelo']."'" ;
																																														$a .= ",'".$arreglo_15['AnoFab']."'" ;
																																														$a .= ",'".$arreglo_15['Serie']."'" ; 
																																														$a .= ",'".$arreglo_15['idLicitacion']."'" ; 
																																														$a .= ",'".$arreglo_15['tabla']."'" ; 
																																														$a .= ",'".$arreglo_15['table_value']."'" ; 
																																														$a .= ",'".$arreglo_15['Direccion_img']."'" ; 
																																														$a .= ",'".$arreglo_15['idSubTipo']."'" ; 
																																														$a .= ",'".$arreglo_15['Grasa_inicial']."'" ; 
																																														$a .= ",'".$arreglo_15['Grasa_relubricacion']."'" ; 
																																														$a .= ",'".$arreglo_15['Aceite']."'" ; 
																																														$a .= ",'".$arreglo_15['Cantidad']."'" ; 
																																														$a .= ",'".$arreglo_15['idUml']."'" ; 
																																														$a .= ",'".$arreglo_15['Frecuencia']."'" ; 
																																														$a .= ",'".$arreglo_15['idFrecuencia']."'" ; 
																																														$a .= ",'".$arreglo_15['idProducto']."'" ; 
																																														$a .= ",'".$arreglo_15['Saf']."'" ; 
																																														$a .= ",'".$arreglo_15['Numero']."'" ; 
																																														
																																														$cadena = '';
																																														$x = 1;
																																														if($lv_1!=0&&$lvl>1){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_2!=0&&$lvl>2){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_3!=0&&$lvl>3){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_4!=0&&$lvl>4){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_5!=0&&$lvl>5){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_6!=0&&$lvl>6){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_7!=0&&$lvl>7){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_8!=0&&$lvl>8){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_9!=0&&$lvl>9){    $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_10!=0&&$lvl>10){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_11!=0&&$lvl>11){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_12!=0&&$lvl>12){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_13!=0&&$lvl>13){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_14!=0&&$lvl>14){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_15!=0&&$lvl>15){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_16!=0&&$lvl>16){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_17!=0&&$lvl>17){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_18!=0&&$lvl>18){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_19!=0&&$lvl>19){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_20!=0&&$lvl>20){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_21!=0&&$lvl>21){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_22!=0&&$lvl>22){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_23!=0&&$lvl>23){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_24!=0&&$lvl>24){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														if($lv_25!=0&&$lvl>25){  $cadena .= ',idLevel_'.$x;$a .= ",'".$arreglo_15['idLevel_'.$x]."'" ;$x++;}
																																														
																																														$x = 1;
																																														if(isset($id_lvl[$dis_1])&&$id_lvl[$dis_1]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_1]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_2])&&$id_lvl[$dis_2]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_2]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_3])&&$id_lvl[$dis_3]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_3]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_4])&&$id_lvl[$dis_4]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_4]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_5])&&$id_lvl[$dis_5]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_5]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_6])&&$id_lvl[$dis_6]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_6]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_7])&&$id_lvl[$dis_7]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_7]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_8])&&$id_lvl[$dis_8]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_8]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_9])&&$id_lvl[$dis_9]!=''){    $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_9]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_10])&&$id_lvl[$dis_10]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_10]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_11])&&$id_lvl[$dis_11]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_11]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_12])&&$id_lvl[$dis_12]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_12]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_13])&&$id_lvl[$dis_13]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_13]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_14])&&$id_lvl[$dis_14]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_14]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_15])&&$id_lvl[$dis_15]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_15]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_16])&&$id_lvl[$dis_16]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_16]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_17])&&$id_lvl[$dis_17]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_17]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_18])&&$id_lvl[$dis_18]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_18]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_19])&&$id_lvl[$dis_19]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_19]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_20])&&$id_lvl[$dis_20]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_20]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_21])&&$id_lvl[$dis_21]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_21]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_22])&&$id_lvl[$dis_22]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_22]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_23])&&$id_lvl[$dis_23]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_23]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_24])&&$id_lvl[$dis_24]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_24]."'" ;$x++;}
																																														if(isset($id_lvl[$dis_25])&&$id_lvl[$dis_25]!=''){  $cadena .= ',idLevel_'.$x;$a .= ",'".$id_lvl[$dis_25]."'" ;$x++;}
																																														
																																														
																																														// inserto los datos de registro en la db
																																														$query  = "INSERT INTO `maquinas_listado_level_".$dis_15."` (idSistema, idMaquina, idUtilizable, 
																																														Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																														Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																														idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
																																														VALUES (".$a.")";
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
																																														$id_lvl[$dis_15] = mysqli_insert_id($dbConn);
																																														
																																														/////////////////////////////////////////////////
																																														/*if(isset($arrLVL[$dis_16])){
																																															foreach ($arrLVL[$dis_16] as $arreglo_16) {
																																																//Se verifica que sea el mismo sensor
																																																if($arreglo_15['idLevel_'.$dis_15]==$arreglo_16['idLevel_'.$dis_15]){
																																																
																																																	//Se crea la maquina
																																																	$a  = "'".$arreglo_16['idSistema']."'" ;          
																																																	$a .= ",'".$arreglo_16['idMaquina']."'" ;        
																																																	$a .= ",'".$arreglo_16['idUtilizable']."'" ;
																																																	$a .= ",'".$arreglo_16['Codigo']."'" ;
																																																	$a .= ",'".$arreglo_16['Nombre']."'" ;
																																																	$a .= ",'".$arreglo_16['Marca']."'" ;
																																																	$a .= ",'".$arreglo_16['Modelo']."'" ;
																																																	$a .= ",'".$arreglo_16['AnoFab']."'" ;
																																																	$a .= ",'".$arreglo_16['Serie']."'" ; 
																																																	$a .= ",'".$arreglo_16['idLicitacion']."'" ; 
																																																	$a .= ",'".$arreglo_16['tabla']."'" ; 
																																																	$a .= ",'".$arreglo_16['table_value']."'" ; 
																																																	$a .= ",'".$arreglo_16['Direccion_img']."'" ; 
																																																	$a .= ",'".$arreglo_16['idSubTipo']."'" ; 
																																																	$a .= ",'".$arreglo_16['Grasa_inicial']."'" ; 
																																																	$a .= ",'".$arreglo_16['Grasa_relubricacion']."'" ; 
																																																	$a .= ",'".$arreglo_16['Aceite']."'" ; 
																																																	$a .= ",'".$arreglo_16['Cantidad']."'" ; 
																																																	$a .= ",'".$arreglo_16['idUml']."'" ; 
																																																	$a .= ",'".$arreglo_16['Frecuencia']."'" ; 
																																																	$a .= ",'".$arreglo_16['idFrecuencia']."'" ; 
																																																	$a .= ",'".$arreglo_16['idProducto']."'" ; 
																																																	$a .= ",'".$arreglo_16['Saf']."'" ; 
																																																	$a .= ",'".$arreglo_16['Numero']."'" ; 
																																																	
																																																	//creo cadena con los idLevel
																																																	$cadena = '';
																																																	for ($x = $dis_1; $x > 1; $x--) {
																																																		$cadena .= ',idLevel_'.$x;
																																																		$a .= ",'".$arreglo_16['idLevel_'.$x]."'" ;
																																																	}
																																																	//creo cadena con los idLevel
																																																	for ($x = $dis_15; $x > $lvl; $x--) {
																																																		$cadena .= ',idLevel_'.$x;
																																																		$a .= ",'".$id_lvl[$x]."'" ;
																																																	}
																																																	
																																																	// inserto los datos de registro en la db
																																																	$query  = "INSERT INTO `maquinas_listado_level_".$dis_16."` (idSistema, idMaquina, idUtilizable, 
																																																	Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																																	Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																																	idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
																																																	VALUES (".$a.")";
																																																	$result = mysqli_query($dbConn, $query);
																																																	$id_lvl[$dis_16] = mysqli_insert_id($dbConn);
																																																	
																																																	/////////////////////////////////////////////////
																																																	/*if(isset($arrLVL[$dis_17])){
																																																		foreach ($arrLVL[$dis_17] as $arreglo_17) {
																																																			//Se verifica que sea el mismo sensor
																																																			if($arreglo_16['idLevel_'.$dis_16]==$arreglo_17['idLevel_'.$dis_16]){
																																																			
																																																				//Se crea la maquina
																																																				$a  = "'".$arreglo_17['idSistema']."'" ;          
																																																				$a .= ",'".$arreglo_17['idMaquina']."'" ;        
																																																				$a .= ",'".$arreglo_17['idUtilizable']."'" ;
																																																				$a .= ",'".$arreglo_17['Codigo']."'" ;
																																																				$a .= ",'".$arreglo_17['Nombre']."'" ;
																																																				$a .= ",'".$arreglo_17['Marca']."'" ;
																																																				$a .= ",'".$arreglo_17['Modelo']."'" ;
																																																				$a .= ",'".$arreglo_17['AnoFab']."'" ;
																																																				$a .= ",'".$arreglo_17['Serie']."'" ; 
																																																				$a .= ",'".$arreglo_17['idLicitacion']."'" ; 
																																																				$a .= ",'".$arreglo_17['tabla']."'" ; 
																																																				$a .= ",'".$arreglo_17['table_value']."'" ; 
																																																				$a .= ",'".$arreglo_17['Direccion_img']."'" ; 
																																																				$a .= ",'".$arreglo_17['idSubTipo']."'" ; 
																																																				$a .= ",'".$arreglo_17['Grasa_inicial']."'" ; 
																																																				$a .= ",'".$arreglo_17['Grasa_relubricacion']."'" ; 
																																																				$a .= ",'".$arreglo_17['Aceite']."'" ; 
																																																				$a .= ",'".$arreglo_17['Cantidad']."'" ; 
																																																				$a .= ",'".$arreglo_17['idUml']."'" ; 
																																																				$a .= ",'".$arreglo_17['Frecuencia']."'" ; 
																																																				$a .= ",'".$arreglo_17['idFrecuencia']."'" ; 
																																																				$a .= ",'".$arreglo_17['idProducto']."'" ; 
																																																				$a .= ",'".$arreglo_17['Saf']."'" ; 
																																																				$a .= ",'".$arreglo_17['Numero']."'" ; 
																																																				
																																																				//creo cadena con los idLevel
																																																				$cadena = '';
																																																				for ($x = $dis_1; $x > 1; $x--) {
																																																					$cadena .= ',idLevel_'.$x;
																																																					$a .= ",'".$arreglo_17['idLevel_'.$x]."'" ;
																																																				}
																																																				//creo cadena con los idLevel
																																																				for ($x = $dis_16; $x > $lvl; $x--) {
																																																					$cadena .= ',idLevel_'.$x;
																																																					$a .= ",'".$id_lvl[$x]."'" ;
																																																				}
																																																				
																																																				// inserto los datos de registro en la db
																																																				$query  = "INSERT INTO `maquinas_listado_level_".$dis_17."` (idSistema, idMaquina, idUtilizable, 
																																																				Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																																				Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																																				idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
																																																				VALUES (".$a.")";
																																																				$result = mysqli_query($dbConn, $query);
																																																				$id_lvl[$dis_17] = mysqli_insert_id($dbConn);
																																																				
																																																				/////////////////////////////////////////////////
																																																				/*if(isset($arrLVL[$dis_18])){
																																																					foreach ($arrLVL[$dis_18] as $arreglo_18) {
																																																						//Se verifica que sea el mismo sensor
																																																						if($arreglo_17['idLevel_'.$dis_17]==$arreglo_18['idLevel_'.$dis_17]){
																																																						
																																																							//Se crea la maquina
																																																							$a  = "'".$arreglo_18['idSistema']."'" ;          
																																																							$a .= ",'".$arreglo_18['idMaquina']."'" ;        
																																																							$a .= ",'".$arreglo_18['idUtilizable']."'" ;
																																																							$a .= ",'".$arreglo_18['Codigo']."'" ;
																																																							$a .= ",'".$arreglo_18['Nombre']."'" ;
																																																							$a .= ",'".$arreglo_18['Marca']."'" ;
																																																							$a .= ",'".$arreglo_18['Modelo']."'" ;
																																																							$a .= ",'".$arreglo_18['AnoFab']."'" ;
																																																							$a .= ",'".$arreglo_18['Serie']."'" ; 
																																																							$a .= ",'".$arreglo_18['idLicitacion']."'" ; 
																																																							$a .= ",'".$arreglo_18['tabla']."'" ; 
																																																							$a .= ",'".$arreglo_18['table_value']."'" ; 
																																																							$a .= ",'".$arreglo_18['Direccion_img']."'" ; 
																																																							$a .= ",'".$arreglo_18['idSubTipo']."'" ; 
																																																							$a .= ",'".$arreglo_18['Grasa_inicial']."'" ; 
																																																							$a .= ",'".$arreglo_18['Grasa_relubricacion']."'" ; 
																																																							$a .= ",'".$arreglo_18['Aceite']."'" ; 
																																																							$a .= ",'".$arreglo_18['Cantidad']."'" ; 
																																																							$a .= ",'".$arreglo_18['idUml']."'" ; 
																																																							$a .= ",'".$arreglo_18['Frecuencia']."'" ; 
																																																							$a .= ",'".$arreglo_18['idFrecuencia']."'" ; 
																																																							$a .= ",'".$arreglo_18['idProducto']."'" ; 
																																																							$a .= ",'".$arreglo_18['Saf']."'" ; 
																																																							$a .= ",'".$arreglo_18['Numero']."'" ; 
																																																							
																																																							//creo cadena con los idLevel
																																																							$cadena = '';
																																																							for ($x = $dis_1; $x > 1; $x--) {
																																																								$cadena .= ',idLevel_'.$x;
																																																								$a .= ",'".$arreglo_18['idLevel_'.$x]."'" ;
																																																							}
																																																							//creo cadena con los idLevel
																																																							for ($x = $dis_17; $x > $lvl; $x--) {
																																																								$cadena .= ',idLevel_'.$x;
																																																								$a .= ",'".$id_lvl[$x]."'" ;
																																																							}
																																																							
																																																							// inserto los datos de registro en la db
																																																							$query  = "INSERT INTO `maquinas_listado_level_".$dis_18."` (idSistema, idMaquina, idUtilizable, 
																																																							Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																																							Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																																							idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
																																																							VALUES (".$a.")";
																																																							$result = mysqli_query($dbConn, $query);
																																																							$id_lvl[$dis_18] = mysqli_insert_id($dbConn);
																																																							
																																																							/////////////////////////////////////////////////
																																																							/*if(isset($arrLVL[$dis_19])){
																																																								foreach ($arrLVL[$dis_19] as $arreglo_19) {
																																																									//Se verifica que sea el mismo sensor
																																																									if($arreglo_18['idLevel_'.$dis_18]==$arreglo_19['idLevel_'.$dis_18]){
																																																									
																																																										//Se crea la maquina
																																																										$a  = "'".$arreglo_19['idSistema']."'" ;          
																																																										$a .= ",'".$arreglo_19['idMaquina']."'" ;        
																																																										$a .= ",'".$arreglo_19['idUtilizable']."'" ;
																																																										$a .= ",'".$arreglo_19['Codigo']."'" ;
																																																										$a .= ",'".$arreglo_19['Nombre']."'" ;
																																																										$a .= ",'".$arreglo_19['Marca']."'" ;
																																																										$a .= ",'".$arreglo_19['Modelo']."'" ;
																																																										$a .= ",'".$arreglo_19['AnoFab']."'" ;
																																																										$a .= ",'".$arreglo_19['Serie']."'" ; 
																																																										$a .= ",'".$arreglo_19['idLicitacion']."'" ; 
																																																										$a .= ",'".$arreglo_19['tabla']."'" ; 
																																																										$a .= ",'".$arreglo_19['table_value']."'" ; 
																																																										$a .= ",'".$arreglo_19['Direccion_img']."'" ; 
																																																										$a .= ",'".$arreglo_19['idSubTipo']."'" ; 
																																																										$a .= ",'".$arreglo_19['Grasa_inicial']."'" ; 
																																																										$a .= ",'".$arreglo_19['Grasa_relubricacion']."'" ; 
																																																										$a .= ",'".$arreglo_19['Aceite']."'" ; 
																																																										$a .= ",'".$arreglo_19['Cantidad']."'" ; 
																																																										$a .= ",'".$arreglo_19['idUml']."'" ; 
																																																										$a .= ",'".$arreglo_19['Frecuencia']."'" ; 
																																																										$a .= ",'".$arreglo_19['idFrecuencia']."'" ; 
																																																										$a .= ",'".$arreglo_19['idProducto']."'" ; 
																																																										$a .= ",'".$arreglo_19['Saf']."'" ; 
																																																										$a .= ",'".$arreglo_19['Numero']."'" ; 
																																																										
																																																										//creo cadena con los idLevel
																																																										$cadena = '';
																																																										for ($x = $dis_1; $x > 1; $x--) {
																																																											$cadena .= ',idLevel_'.$x;
																																																											$a .= ",'".$arreglo_19['idLevel_'.$x]."'" ;
																																																										}
																																																										//creo cadena con los idLevel
																																																										for ($x = $dis_18; $x > $lvl; $x--) {
																																																											$cadena .= ',idLevel_'.$x;
																																																											$a .= ",'".$id_lvl[$x]."'" ;
																																																										}
																																																										
																																																										// inserto los datos de registro en la db
																																																										$query  = "INSERT INTO `maquinas_listado_level_".$dis_19."` (idSistema, idMaquina, idUtilizable, 
																																																										Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																																										Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																																										idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
																																																										VALUES (".$a.")";
																																																										$result = mysqli_query($dbConn, $query);
																																																										$id_lvl[$dis_19] = mysqli_insert_id($dbConn);
																																																										
																																																										/////////////////////////////////////////////////
																																																										/*if(isset($arrLVL[$dis_20])){
																																																											foreach ($arrLVL[$dis_20] as $arreglo_20) {
																																																												//Se verifica que sea el mismo sensor
																																																												if($arreglo_19['idLevel_'.$dis_19]==$arreglo_20['idLevel_'.$dis_19]){
																																																												
																																																													//Se crea la maquina
																																																													$a  = "'".$arreglo_20['idSistema']."'" ;          
																																																													$a .= ",'".$arreglo_20['idMaquina']."'" ;        
																																																													$a .= ",'".$arreglo_20['idUtilizable']."'" ;
																																																													$a .= ",'".$arreglo_20['Codigo']."'" ;
																																																													$a .= ",'".$arreglo_20['Nombre']."'" ;
																																																													$a .= ",'".$arreglo_20['Marca']."'" ;
																																																													$a .= ",'".$arreglo_20['Modelo']."'" ;
																																																													$a .= ",'".$arreglo_20['AnoFab']."'" ;
																																																													$a .= ",'".$arreglo_20['Serie']."'" ; 
																																																													$a .= ",'".$arreglo_20['idLicitacion']."'" ; 
																																																													$a .= ",'".$arreglo_20['tabla']."'" ; 
																																																													$a .= ",'".$arreglo_20['table_value']."'" ; 
																																																													$a .= ",'".$arreglo_20['Direccion_img']."'" ; 
																																																													$a .= ",'".$arreglo_20['idSubTipo']."'" ; 
																																																													$a .= ",'".$arreglo_20['Grasa_inicial']."'" ; 
																																																													$a .= ",'".$arreglo_20['Grasa_relubricacion']."'" ; 
																																																													$a .= ",'".$arreglo_20['Aceite']."'" ; 
																																																													$a .= ",'".$arreglo_20['Cantidad']."'" ; 
																																																													$a .= ",'".$arreglo_20['idUml']."'" ; 
																																																													$a .= ",'".$arreglo_20['Frecuencia']."'" ; 
																																																													$a .= ",'".$arreglo_20['idFrecuencia']."'" ; 
																																																													$a .= ",'".$arreglo_20['idProducto']."'" ; 
																																																													$a .= ",'".$arreglo_20['Saf']."'" ; 
																																																													$a .= ",'".$arreglo_20['Numero']."'" ; 
																																																													
																																																													//creo cadena con los idLevel
																																																													$cadena = '';
																																																													for ($x = $dis_1; $x > 1; $x--) {
																																																														$cadena .= ',idLevel_'.$x;
																																																														$a .= ",'".$arreglo_20['idLevel_'.$x]."'" ;
																																																													}
																																																													//creo cadena con los idLevel
																																																													for ($x = $dis_19; $x > $lvl; $x--) {
																																																														$cadena .= ',idLevel_'.$x;
																																																														$a .= ",'".$id_lvl[$x]."'" ;
																																																													}
																																																													
																																																													// inserto los datos de registro en la db
																																																													$query  = "INSERT INTO `maquinas_listado_level_".$dis_20."` (idSistema, idMaquina, idUtilizable, 
																																																													Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																																													Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																																													idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
																																																													VALUES (".$a.")";
																																																													$result = mysqli_query($dbConn, $query);
																																																													$id_lvl[$dis_20] = mysqli_insert_id($dbConn);
																																																													
																																																													/////////////////////////////////////////////////
																																																													/*if(isset($arrLVL[$dis_21])){
																																																														foreach ($arrLVL[$dis_21] as $arreglo_21) {
																																																															//Se verifica que sea el mismo sensor
																																																															if($arreglo_20['idLevel_'.$dis_20]==$arreglo_21['idLevel_'.$dis_20]){
																																																															
																																																																//Se crea la maquina
																																																																$a  = "'".$arreglo_21['idSistema']."'" ;          
																																																																$a .= ",'".$arreglo_21['idMaquina']."'" ;        
																																																																$a .= ",'".$arreglo_21['idUtilizable']."'" ;
																																																																$a .= ",'".$arreglo_21['Codigo']."'" ;
																																																																$a .= ",'".$arreglo_21['Nombre']."'" ;
																																																																$a .= ",'".$arreglo_21['Marca']."'" ;
																																																																$a .= ",'".$arreglo_21['Modelo']."'" ;
																																																																$a .= ",'".$arreglo_21['AnoFab']."'" ;
																																																																$a .= ",'".$arreglo_21['Serie']."'" ; 
																																																																$a .= ",'".$arreglo_21['idLicitacion']."'" ; 
																																																																$a .= ",'".$arreglo_21['tabla']."'" ; 
																																																																$a .= ",'".$arreglo_21['table_value']."'" ; 
																																																																$a .= ",'".$arreglo_21['Direccion_img']."'" ; 
																																																																$a .= ",'".$arreglo_21['idSubTipo']."'" ; 
																																																																$a .= ",'".$arreglo_21['Grasa_inicial']."'" ; 
																																																																$a .= ",'".$arreglo_21['Grasa_relubricacion']."'" ; 
																																																																$a .= ",'".$arreglo_21['Aceite']."'" ; 
																																																																$a .= ",'".$arreglo_21['Cantidad']."'" ; 
																																																																$a .= ",'".$arreglo_21['idUml']."'" ; 
																																																																$a .= ",'".$arreglo_21['Frecuencia']."'" ; 
																																																																$a .= ",'".$arreglo_21['idFrecuencia']."'" ; 
																																																																$a .= ",'".$arreglo_21['idProducto']."'" ; 
																																																																$a .= ",'".$arreglo_21['Saf']."'" ; 
																																																																$a .= ",'".$arreglo_21['Numero']."'" ; 
																																																																
																																																																//creo cadena con los idLevel
																																																																$cadena = '';
																																																																for ($x = $dis_1; $x > 1; $x--) {
																																																																	$cadena .= ',idLevel_'.$x;
																																																																	$a .= ",'".$arreglo_21['idLevel_'.$x]."'" ;
																																																																}
																																																																//creo cadena con los idLevel
																																																																for ($x = $dis_20; $x > $lvl; $x--) {
																																																																	$cadena .= ',idLevel_'.$x;
																																																																	$a .= ",'".$id_lvl[$x]."'" ;
																																																																}
																																																																
																																																																// inserto los datos de registro en la db
																																																																$query  = "INSERT INTO `maquinas_listado_level_".$dis_21."` (idSistema, idMaquina, idUtilizable, 
																																																																Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																																																Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																																																idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
																																																																VALUES (".$a.")";
																																																																$result = mysqli_query($dbConn, $query);
																																																																$id_lvl[$dis_21] = mysqli_insert_id($dbConn);
																																																																
																																																																/////////////////////////////////////////////////
																																																																/*if(isset($arrLVL[$dis_22])){
																																																																	foreach ($arrLVL[$dis_22] as $arreglo_22) {
																																																																		//Se verifica que sea el mismo sensor
																																																																		if($arreglo_21['idLevel_'.$dis_20]==$arreglo_22['idLevel_'.$dis_21]){
																																																																		
																																																																			//Se crea la maquina
																																																																			$a  = "'".$arreglo_22['idSistema']."'" ;          
																																																																			$a .= ",'".$arreglo_22['idMaquina']."'" ;        
																																																																			$a .= ",'".$arreglo_22['idUtilizable']."'" ;
																																																																			$a .= ",'".$arreglo_22['Codigo']."'" ;
																																																																			$a .= ",'".$arreglo_22['Nombre']."'" ;
																																																																			$a .= ",'".$arreglo_22['Marca']."'" ;
																																																																			$a .= ",'".$arreglo_22['Modelo']."'" ;
																																																																			$a .= ",'".$arreglo_22['AnoFab']."'" ;
																																																																			$a .= ",'".$arreglo_22['Serie']."'" ; 
																																																																			$a .= ",'".$arreglo_22['idLicitacion']."'" ; 
																																																																			$a .= ",'".$arreglo_22['tabla']."'" ; 
																																																																			$a .= ",'".$arreglo_22['table_value']."'" ; 
																																																																			$a .= ",'".$arreglo_22['Direccion_img']."'" ; 
																																																																			$a .= ",'".$arreglo_22['idSubTipo']."'" ; 
																																																																			$a .= ",'".$arreglo_22['Grasa_inicial']."'" ; 
																																																																			$a .= ",'".$arreglo_22['Grasa_relubricacion']."'" ; 
																																																																			$a .= ",'".$arreglo_22['Aceite']."'" ; 
																																																																			$a .= ",'".$arreglo_22['Cantidad']."'" ; 
																																																																			$a .= ",'".$arreglo_22['idUml']."'" ; 
																																																																			$a .= ",'".$arreglo_22['Frecuencia']."'" ; 
																																																																			$a .= ",'".$arreglo_22['idFrecuencia']."'" ; 
																																																																			$a .= ",'".$arreglo_22['idProducto']."'" ; 
																																																																			$a .= ",'".$arreglo_22['Saf']."'" ; 
																																																																			$a .= ",'".$arreglo_22['Numero']."'" ; 
																																																																			
																																																																			//creo cadena con los idLevel
																																																																			$cadena = '';
																																																																			for ($x = $dis_1; $x > 1; $x--) {
																																																																				$cadena .= ',idLevel_'.$x;
																																																																				$a .= ",'".$arreglo_22['idLevel_'.$x]."'" ;
																																																																			}
																																																																			//creo cadena con los idLevel
																																																																			for ($x = $dis_21; $x > $lvl; $x--) {
																																																																				$cadena .= ',idLevel_'.$x;
																																																																				$a .= ",'".$id_lvl[$x]."'" ;
																																																																			}
																																																																			
																																																																			// inserto los datos de registro en la db
																																																																			$query  = "INSERT INTO `maquinas_listado_level_".$dis_22."` (idSistema, idMaquina, idUtilizable, 
																																																																			Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																																																			Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																																																			idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
																																																																			VALUES (".$a.")";
																																																																			$result = mysqli_query($dbConn, $query);
																																																																			$id_lvl[$dis_22] = mysqli_insert_id($dbConn);
																																																																			
																																																																			/////////////////////////////////////////////////
																																																																			/*if(isset($arrLVL[$dis_23])){
																																																																				foreach ($arrLVL[$dis_23] as $arreglo_23) {
																																																																					//Se verifica que sea el mismo sensor
																																																																					if($arreglo_22['idLevel_'.$dis_22]==$arreglo_23['idLevel_'.$dis_22]){
																																																																					
																																																																						//Se crea la maquina
																																																																						$a  = "'".$arreglo_23['idSistema']."'" ;          
																																																																						$a .= ",'".$arreglo_23['idMaquina']."'" ;        
																																																																						$a .= ",'".$arreglo_23['idUtilizable']."'" ;
																																																																						$a .= ",'".$arreglo_23['Codigo']."'" ;
																																																																						$a .= ",'".$arreglo_23['Nombre']."'" ;
																																																																						$a .= ",'".$arreglo_23['Marca']."'" ;
																																																																						$a .= ",'".$arreglo_23['Modelo']."'" ;
																																																																						$a .= ",'".$arreglo_23['AnoFab']."'" ;
																																																																						$a .= ",'".$arreglo_23['Serie']."'" ; 
																																																																						$a .= ",'".$arreglo_23['idLicitacion']."'" ; 
																																																																						$a .= ",'".$arreglo_23['tabla']."'" ; 
																																																																						$a .= ",'".$arreglo_23['table_value']."'" ; 
																																																																						$a .= ",'".$arreglo_23['Direccion_img']."'" ; 
																																																																						$a .= ",'".$arreglo_23['idSubTipo']."'" ; 
																																																																						$a .= ",'".$arreglo_23['Grasa_inicial']."'" ; 
																																																																						$a .= ",'".$arreglo_23['Grasa_relubricacion']."'" ; 
																																																																						$a .= ",'".$arreglo_23['Aceite']."'" ; 
																																																																						$a .= ",'".$arreglo_23['Cantidad']."'" ; 
																																																																						$a .= ",'".$arreglo_23['idUml']."'" ; 
																																																																						$a .= ",'".$arreglo_23['Frecuencia']."'" ; 
																																																																						$a .= ",'".$arreglo_23['idFrecuencia']."'" ; 
																																																																						$a .= ",'".$arreglo_23['idProducto']."'" ; 
																																																																						$a .= ",'".$arreglo_23['Saf']."'" ; 
																																																																						$a .= ",'".$arreglo_23['Numero']."'" ; 
																																																																						
																																																																						//creo cadena con los idLevel
																																																																						$cadena = '';
																																																																						for ($x = $dis_1; $x > 1; $x--) {
																																																																							$cadena .= ',idLevel_'.$x;
																																																																							$a .= ",'".$arreglo_23['idLevel_'.$x]."'" ;
																																																																						}
																																																																						//creo cadena con los idLevel
																																																																						for ($x = $dis_22; $x > $lvl; $x--) {
																																																																							$cadena .= ',idLevel_'.$x;
																																																																							$a .= ",'".$id_lvl[$x]."'" ;
																																																																						}
																																																																						
																																																																						// inserto los datos de registro en la db
																																																																						$query  = "INSERT INTO `maquinas_listado_level_".$dis_23."` (idSistema, idMaquina, idUtilizable, 
																																																																						Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																																																						Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																																																						idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
																																																																						VALUES (".$a.")";
																																																																						$result = mysqli_query($dbConn, $query);
																																																																						$id_lvl[$dis_23] = mysqli_insert_id($dbConn);
																																																																						
																																																																						/////////////////////////////////////////////////
																																																																						/*if(isset($arrLVL[$dis_24])){
																																																																							foreach ($arrLVL[$dis_24] as $arreglo_24) {
																																																																								//Se verifica que sea el mismo sensor
																																																																								if($arreglo_23['idLevel_'.$dis_23]==$arreglo_24['idLevel_'.$dis_23]){
																																																																								
																																																																									//Se crea la maquina
																																																																									$a  = "'".$arreglo_24['idSistema']."'" ;          
																																																																									$a .= ",'".$arreglo_24['idMaquina']."'" ;        
																																																																									$a .= ",'".$arreglo_24['idUtilizable']."'" ;
																																																																									$a .= ",'".$arreglo_24['Codigo']."'" ;
																																																																									$a .= ",'".$arreglo_24['Nombre']."'" ;
																																																																									$a .= ",'".$arreglo_24['Marca']."'" ;
																																																																									$a .= ",'".$arreglo_24['Modelo']."'" ;
																																																																									$a .= ",'".$arreglo_24['AnoFab']."'" ;
																																																																									$a .= ",'".$arreglo_24['Serie']."'" ; 
																																																																									$a .= ",'".$arreglo_24['idLicitacion']."'" ; 
																																																																									$a .= ",'".$arreglo_24['tabla']."'" ; 
																																																																									$a .= ",'".$arreglo_24['table_value']."'" ; 
																																																																									$a .= ",'".$arreglo_24['Direccion_img']."'" ; 
																																																																									$a .= ",'".$arreglo_24['idSubTipo']."'" ; 
																																																																									$a .= ",'".$arreglo_24['Grasa_inicial']."'" ; 
																																																																									$a .= ",'".$arreglo_24['Grasa_relubricacion']."'" ; 
																																																																									$a .= ",'".$arreglo_24['Aceite']."'" ; 
																																																																									$a .= ",'".$arreglo_24['Cantidad']."'" ; 
																																																																									$a .= ",'".$arreglo_24['idUml']."'" ; 
																																																																									$a .= ",'".$arreglo_24['Frecuencia']."'" ; 
																																																																									$a .= ",'".$arreglo_24['idFrecuencia']."'" ; 
																																																																									$a .= ",'".$arreglo_24['idProducto']."'" ; 
																																																																									$a .= ",'".$arreglo_24['Saf']."'" ; 
																																																																									$a .= ",'".$arreglo_24['Numero']."'" ; 
																																																																									
																																																																									//creo cadena con los idLevel
																																																																									$cadena = '';
																																																																									for ($x = $dis_1; $x > 1; $x--) {
																																																																										$cadena .= ',idLevel_'.$x;
																																																																										$a .= ",'".$arreglo_24['idLevel_'.$x]."'" ;
																																																																									}
																																																																									//creo cadena con los idLevel
																																																																									for ($x = $dis_23; $x > $lvl; $x--) {
																																																																										$cadena .= ',idLevel_'.$x;
																																																																										$a .= ",'".$id_lvl[$x]."'" ;
																																																																									}
																																																																									
																																																																									// inserto los datos de registro en la db
																																																																									$query  = "INSERT INTO `maquinas_listado_level_".$dis_24."` (idSistema, idMaquina, idUtilizable, 
																																																																									Codigo, Nombre, Marca, Modelo, AnoFab, Serie, idLicitacion, tabla, table_value, 
																																																																									Direccion_img, idSubTipo, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, 
																																																																									idUml, Frecuencia, idFrecuencia, idProducto, Saf, Numero ".$cadena.") 
																																																																									VALUES (".$a.")";
																																																																									$result = mysqli_query($dbConn, $query);
																																																																									$id_lvl[$dis_24] = mysqli_insert_id($dbConn);
																																																																									
																																																																									
																																																																								}		
																																																																							}
																																																																						}
																																																																						
																																																																					}		
																																																																				}
																																																																			}
																																																																			
																																																																		}		
																																																																	}
																																																																}
																																																																
																																																															}		
																																																														}
																																																													}
																																																													
																																																												}		
																																																											}
																																																										}
																																																										
																																																									}		
																																																								}
																																																							}
																																																							
																																																						}		
																																																					}
																																																				}
																																																				
																																																			}		
																																																		}
																																																	}
																																																	
																																																}		
																																															}
																																														}*/
																																														
																																													}		
																																												}
																																											}
																																											
																																										}		
																																									}
																																								}
																																								
																																							}		
																																						}
																																					}
																																					
																																				}		
																																			}
																																		}
																																		
																																	}		
																																}
																															}
																															
																														}		
																													}
																												}
																												
																											}		
																										}
																									}
																									
																								}		
																							}
																						}
																						
																					}		
																				}
																			}
																			
																		}		
																	}
																}
																
															}		
														}
													}
													
												}		
											}
										}
										
									}		
								}
							}
									
						}
					}
				}		
			}
		}		
		
		header( 'Location: '.$location.'&clone_comp=true' );
		die;
		
		break;	
		
/*******************************************************************************************************************/
		case 'clone_Matriz':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'maquinas_listado_matriz', '', "Nombre='".$Nombre."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre de la matriz ya existe en el sistema';}
			/*******************************************************************/
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//bucle
				$qry = '';
				for ($i = 1; $i <= 50; $i++) {
					$qry .= ',PuntoNombre_'.$i;
					$qry .= ',PuntoMedAceptable_'.$i;
					$qry .= ',PuntoMedAlerta_'.$i;
					$qry .= ',PuntoMedCondenatorio_'.$i;
					$qry .= ',PuntoUltimaMed_'.$i;
					$qry .= ',PuntoUniMed_'.$i;
					$qry .= ',PuntoidTipo_'.$i;
					$qry .= ',PuntoidGrupo_'.$i;
					
				}

				/*******************************************************************/
				// Se traen todos los datos de la maquina
				$rowdata = db_select_data (false, 'idMaquina, cantPuntos, idEstado'.$qry , 'maquinas_listado_matriz', '', 'idMatriz ='.$idMatriz, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
				/*******************************************************************/
				//filtros
				if(isset($rowdata['idMaquina']) && $rowdata['idMaquina'] != ''){     $a  = "'".$rowdata['idMaquina']."'" ;     }else{$a  ="''";}
				if(isset($rowdata['cantPuntos']) && $rowdata['cantPuntos'] != ''){   $a .= ",'".$rowdata['cantPuntos']."'" ;   }else{$a .= ",''";}
				if(isset($rowdata['idEstado']) && $rowdata['idEstado'] != ''){       $a .= ",'".$rowdata['idEstado']."'" ;     }else{$a .= ",''";}
				if(isset($Nombre) && $Nombre != ''){                                 $a .= ",'".$Nombre."'" ;                  }else{$a .= ",''";}
				

				for ($i = 1; $i <= 50; $i++) {
					if(isset($rowdata['PuntoNombre_'.$i]) && $rowdata['PuntoNombre_'.$i] != ''){                    $a .= ",'".$rowdata['PuntoNombre_'.$i]."'" ;           }else{$a .= ",''";}
					if(isset($rowdata['PuntoMedAceptable_'.$i]) && $rowdata['PuntoMedAceptable_'.$i] != ''){        $a .= ",'".$rowdata['PuntoMedAceptable_'.$i]."'" ;     }else{$a .= ",''";}
					if(isset($rowdata['PuntoMedAlerta_'.$i]) && $rowdata['PuntoMedAlerta_'.$i] != ''){              $a .= ",'".$rowdata['PuntoMedAlerta_'.$i]."'" ;        }else{$a .= ",''";}
					if(isset($rowdata['PuntoMedCondenatorio_'.$i]) && $rowdata['PuntoMedCondenatorio_'.$i] != ''){  $a .= ",'".$rowdata['PuntoMedCondenatorio_'.$i]."'" ;  }else{$a .= ",''";}
					if(isset($rowdata['PuntoUltimaMed_'.$i]) && $rowdata['PuntoUltimaMed_'.$i] != ''){              $a .= ",'".$rowdata['PuntoUltimaMed_'.$i]."'" ;        }else{$a .= ",''";}
					if(isset($rowdata['PuntoUniMed_'.$i]) && $rowdata['PuntoUniMed_'.$i] != ''){                    $a .= ",'".$rowdata['PuntoUniMed_'.$i]."'" ;           }else{$a .= ",''";}
					if(isset($rowdata['PuntoidTipo_'.$i]) && $rowdata['PuntoidTipo_'.$i] != ''){                    $a .= ",'".$rowdata['PuntoidTipo_'.$i]."'" ;           }else{$a .= ",''";}
					if(isset($rowdata['PuntoidGrupo_'.$i]) && $rowdata['PuntoidGrupo_'.$i] != ''){                  $a .= ",'".$rowdata['PuntoidGrupo_'.$i]."'" ;          }else{$a .= ",''";}
					
				}
					
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `maquinas_listado_matriz` (idMaquina,cantPuntos,idEstado, Nombre
				".$qry.") 
				VALUES (".$a.")";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&clone=true' );
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
		case 'createBasicDataMaquina':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'maquinas_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre de la maquina ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){                   $a  = "'".$idSistema."'" ;               }else{$a ="''";}
				if(isset($idEstado) && $idEstado != ''){                     $a .= ",'".$idEstado."'" ;               }else{$a .=",''";}
				if(isset($Codigo) && $Codigo != ''){                         $a .= ",'".$Codigo."'" ;                 }else{$a .=",''";}
				if(isset($Nombre) && $Nombre != ''){                         $a .= ",'".$Nombre."'" ;                 }else{$a .=",''";}
				if(isset($Modelo) && $Modelo != ''){                         $a .= ",'".$Modelo."'" ;                 }else{$a .=",''";}
				if(isset($Serie) && $Serie != ''){                           $a .= ",'".$Serie."'" ;                  }else{$a .=",''";}
				if(isset($Fabricante) && $Fabricante != ''){                 $a .= ",'".$Fabricante."'" ;             }else{$a .=",''";}
				if(isset($fincorporacion) && $fincorporacion != ''){         $a .= ",'".$fincorporacion."'" ;         }else{$a .=",''";}
				if(isset($Descripcion) && $Descripcion != ''){               $a .= ",'".$Descripcion."'" ;            }else{$a .=",''";}
				if(isset($idConfig_1) && $idConfig_1 != ''){                 $a .= ",'".$idConfig_1."'" ;             }else{$a .=",''";}
				if(isset($idConfig_2) && $idConfig_2 != ''){                 $a .= ",'".$idConfig_2."'" ;             }else{$a .=",''";}
				if(isset($idConfig_3) && $idConfig_3 != ''){                 $a .= ",'".$idConfig_3."'" ;             }else{$a .=",''";}
				if(isset($idUbicacion) && $idUbicacion != ''){               $a .= ",'".$idUbicacion."'" ;            }else{$a .=",''";}
				if(isset($idUbicacion_lvl_1) && $idUbicacion_lvl_1 != ''){   $a .= ",'".$idUbicacion_lvl_1."'" ;      }else{$a .=",''";}
				if(isset($idUbicacion_lvl_2) && $idUbicacion_lvl_2 != ''){   $a .= ",'".$idUbicacion_lvl_2."'" ;      }else{$a .=",''";}
				if(isset($idUbicacion_lvl_3) && $idUbicacion_lvl_3 != ''){   $a .= ",'".$idUbicacion_lvl_3."'" ;      }else{$a .=",''";}
				if(isset($idUbicacion_lvl_4) && $idUbicacion_lvl_4 != ''){   $a .= ",'".$idUbicacion_lvl_4."'" ;      }else{$a .=",''";}
				if(isset($idUbicacion_lvl_5) && $idUbicacion_lvl_5 != ''){   $a .= ",'".$idUbicacion_lvl_5."'" ;      }else{$a .=",''";}
				if(isset($idCliente) && $idCliente != ''){                   $a .= ",'".$idCliente."'" ;              }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `maquinas_listado` (idSistema, idEstado, Codigo, Nombre, Modelo, Serie, Fabricante,
				fincorporacion, Descripcion, idConfig_1, idConfig_2, idConfig_3, idUbicacion, idUbicacion_lvl_1, idUbicacion_lvl_2,
				idUbicacion_lvl_3, idUbicacion_lvl_4, idUbicacion_lvl_5, idCliente) 
				VALUES (".$a.")";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
						
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
		case 'estadoMaquina':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$idMaquina  = $_GET['status'];
			$idEstado   = simpleDecode($_GET['estado'], fecha_actual());
			
			$query  = "UPDATE maquinas_listado SET idEstado = '".$idEstado."'	
			WHERE idMaquina    = '".$idMaquina."'";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				

				
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
		case 'submit_img_comp':	
			
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
				$sufijo = 'mq_subc_img_'.$lvl.'_'.$idLevel[$lvl].'_';
				  
				if (in_array($_FILES['Direccion_img']['type'], $permitidos) && $_FILES['Direccion_img']['size'] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['Direccion_img']['name'];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (!file_exists($ruta)){
						//Se mueve el archivo a la carpeta previamente configurada
						$move_result = @move_uploaded_file($_FILES["Direccion_img"]["tmp_name"], $ruta);
						if ($move_result){
								
							//Filtros
							$a = "Direccion_img='".$sufijo.$_FILES['Direccion_img']['name']."'" ;
							
							// inserto los datos de registro en la db
							$query  = "UPDATE `maquinas_listado_level_".$lvl."` SET ".$a." WHERE idLevel_".$lvl." = '".$idLevel[$lvl]."'";
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
		case 'del_img_comp':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el nombre del logo
			$rowdata = db_select_data (false, 'Direccion_img', 'maquinas_listado_level_'.$_GET['lvl'], '', 'idLevel_'.$_GET['lvl'].' = "'.$_GET['del_img'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

			// inserto los datos de registro en la db
			$query  = "UPDATE `maquinas_listado_level_".$_GET['lvl']."` SET Direccion_img='' WHERE idLevel_".$_GET['lvl']." = ".$_GET['del_img'];
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
			
			//redirijo			
			header( 'Location: '.$location.'&deleted=true' );
			die;
			

		break;		
/*******************************************************************************************************************/
	}
?>
