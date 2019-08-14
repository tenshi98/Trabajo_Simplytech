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
	
	//Variables
	$Medidas  = array();
	for ($i = 1; $i <= 50; $i++) {
		if ( !empty($_POST['Medida_'.$i]) ) $Medidas[$i] = $_POST['Medida_'.$i];
	}
	
	//Traspaso de valores input a variables
	if ( !empty($_POST['idAnalisis']) )       $idAnalisis       = $_POST['idAnalisis'];
	if ( !empty($_POST['idMaquina']) )        $idMaquina        = $_POST['idMaquina'];
	if ( !empty($_POST['idMatriz']) )         $idMatriz         = $_POST['idMatriz'];
	if ( !empty($_POST['idSistema']) )        $idSistema        = $_POST['idSistema'];
	if ( !empty($_POST['idEstado']) )         $idEstado         = $_POST['idEstado'];
	if ( !empty($_POST['idOT']) )             $idOT             = $_POST['idOT'];
	if ( !empty($_POST['f_muestreo']) )       $f_muestreo       = $_POST['f_muestreo'];
	if ( !empty($_POST['f_recibida']) )       $f_recibida       = $_POST['f_recibida'];
	if ( !empty($_POST['f_reporte']) )        $f_reporte        = $_POST['f_reporte'];
	if ( !empty($_POST['n_muestra']) )        $n_muestra        = $_POST['n_muestra'];

	if ( !empty($_POST['obs_Diagnostico']) )  $obs_Diagnostico  = $_POST['obs_Diagnostico'];
	if ( !empty($_POST['obs_Accion']) )       $obs_Accion       = $_POST['obs_Accion'];
	if ( !empty($_POST['idTipo']) )           $idTipo           = $_POST['idTipo'];
	if ( !empty($_POST['idLaboratorio']) )    $idLaboratorio    = $_POST['idLaboratorio'];
	
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
			case 'idAnalisis':        if(empty($idAnalisis)){         $error['idAnalisis']          = 'error/No ha ingresado el id';}break;
			case 'idMaquina':         if(empty($idMaquina)){          $error['idMaquina']           = 'error/No ha seleccionado la maquina';}break;
			case 'idMatriz':          if(empty($idMatriz)){           $error['idMatriz']            = 'error/No ha seleccionado la matriz';}break;
			case 'idSistema':         if(empty($idSistema)){          $error['idSistema']           = 'error/No ha seleccionado el idSistema';}break;
			case 'idEstado':          if(empty($idEstado)){           $error['idEstado']            = 'error/No ha seleccionado el idEstado';}break;
			case 'idOT':              if(empty($idOT)){               $error['idOT']                = 'error/No ha seleccionado la OT';}break;
			case 'f_muestreo':        if(empty($f_muestreo)){         $error['f_muestreo']          = 'error/No ha ingresado la fecha de muestros';}break;
			case 'f_recibida':        if(empty($f_recibida)){         $error['f_recibida']          = 'error/No ha ingresado la fecha de recepcion';}break;
			case 'f_reporte':         if(empty($f_reporte)){          $error['f_reporte']           = 'error/No ha ingresado la fecha del reporte';}break;
			case 'n_muestra':         if(empty($n_muestra)){          $error['n_muestra']           = 'error/No ha ingresado el numero de muestra';}break;
			case 'obs_Diagnostico':   if(empty($obs_Diagnostico)){    $error['obs_Diagnostico']     = 'error/No ha ingresado la observacion de diagnostico';}break;
			case 'obs_Accion':        if(empty($obs_Accion)){         $error['obs_Accion']          = 'error/No ha ingresado la observacion de accion';}break;
			case 'idTipo':            if(empty($idTipo)){             $error['idTipo']              = 'error/No ha seleccionado el tipo de analisis';}break;
			case 'idLaboratorio':     if(empty($idLaboratorio)){      $error['idLaboratorio']       = 'error/No ha seleccionado el laboratorio';}break;
			
			/*for ($i = 1; $i <= 50; $i++) {
				case 'Medida_'.$i: if(empty($Medidas[$i])){  $error['Medida_'.$i] = 'error/No ha ingresado la medida '.$i;}break;
			}*/
			
			
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
			if(isset($idMaquina)&&isset($idMatriz)&&isset($n_muestra)){
				$ndata_1 = db_select_nrows ('idAnalisis', 'analisis_listado', '', "idMaquina='".$idMaquina."' AND idMatriz='".$idMatriz."' AND n_muestra='".$n_muestra."'", $dbConn);
			}
			
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_2'] = 'error/El analisis que esta tratando de ingresar ya existe';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				

				/*******************************************************************/
				//filtros
				if(isset($idMaquina) && $idMaquina != ''){                $a  = "'".$idMaquina."'" ;            }else{$a  ="''";}
				if(isset($idMatriz) && $idMatriz != ''){                  $a .= ",'".$idMatriz."'" ;            }else{$a .= ",''";}
				if(isset($idSistema) && $idSistema != ''){                $a .= ",'".$idSistema."'" ;           }else{$a .= ",''";}
				if(isset($idEstado) && $idEstado != ''){                  $a .= ",'".$idEstado."'" ;            }else{$a .= ",''";}
				if(isset($idOT) && $idOT != ''){                          $a .= ",'".$idOT."'" ;                }else{$a .= ",''";}
				if(isset($f_muestreo) && $f_muestreo != ''){              $a .= ",'".$f_muestreo."'" ;          }else{$a .= ",''";}
				if(isset($f_recibida) && $f_recibida != ''){              $a .= ",'".$f_recibida."'" ;          }else{$a .= ",''";}
				if(isset($f_reporte) && $f_reporte != ''){                $a .= ",'".$f_reporte."'" ;           }else{$a .= ",''";}
				if(isset($n_muestra) && $n_muestra != ''){                $a .= ",'".$n_muestra."'" ;           }else{$a .= ",''";}
				if(isset($obs_Diagnostico) && $obs_Diagnostico != ''){    $a .= ",'".$obs_Diagnostico."'" ;     }else{$a .= ",'Sin Observaciones'";}
				if(isset($obs_Accion) && $obs_Accion != ''){              $a .= ",'".$obs_Accion."'" ;          }else{$a .= ",'Sin Observaciones'";}
				if(isset($idTipo) && $idTipo != ''){                      $a .= ",'".$idTipo."'" ;              }else{$a .= ",''";}
				if(isset($idLaboratorio) && $idLaboratorio != ''){        $a .= ",'".$idLaboratorio."'" ;       }else{$a .= ",''";}
				
				$zz='';
				for ($i = 1; $i <= 50; $i++) {
					if(isset($Medidas[$i]) && $Medidas[$i] != ''){   $a .= ",'".$Medidas[$i]."'" ;   }else{$a .= ",''";}
					$zz.=',Medida_'.$i;
				}
			
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `analisis_listado` (idMaquina,idMatriz,idSistema,idEstado,idOT, f_muestreo,
				f_recibida,f_reporte,n_muestra,obs_Diagnostico,obs_Accion, idTipo, idLaboratorio
				".$zz."
				) 
				VALUES ({$a} )";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
					
					/*******************************************************************/
					if(isset($ultimo_id) && $ultimo_id != ''){
						//bucle
						$qry = '';
						for ($i = 1; $i <= 50; $i++) {
							$qry .= ',PuntoNombre_'.$i;
							$qry .= ',PuntoMedAceptable_'.$i;
							$qry .= ',PuntoMedAlerta_'.$i;
							$qry .= ',PuntoMedCondenatorio_'.$i;
							
						}

						/**************************************/
						// Se traen todos los datos de la maquina
						$query = "SELECT 
						idMaquina, cantPuntos
						".$qry."
						FROM `maquinas_listado_matriz`
						WHERE idMatriz = {$idMatriz}";
						$resultado = mysqli_query($dbConn, $query);
						$rowdata = mysqli_fetch_assoc ($resultado);
						
						/**************************************/
						//se realiza la verificacion
						for ($i = 1; $i <= 50; $i++) {
							
							/***************************************************************/
							//verifico cual es mayor para proceder a la verificacion
							if($rowdata['PuntoMedAceptable_'.$i]>$rowdata['PuntoMedCondenatorio_'.$i]){
								//alerta amarilla
								if(isset($Medidas[$i])&&$Medidas[$i]!=''&&$Medidas[$i]>$rowdata['PuntoMedAlerta_'.$i]&&$Medidas[$i]<=$rowdata['PuntoMedAceptable_'.$i]){
									//variables alerta amarilla
									$alert_lvl = 1; //amarilla

									//guardo el dato
									$a  = "'".$ultimo_id."'" ;
									$a .= ",'".$alert_lvl."'" ;
									$a .= ",'".$i."'" ;
									$a .= ",'".$rowdata['PuntoNombre_'.$i]."'" ;
									if(isset($f_reporte) && $f_reporte!= ''){  
										$a .= ",'".$f_reporte."'" ;  
										$a .= ",'".fecha2NdiaMes($f_reporte)."'" ;
										$a .= ",'".fecha2NSemana($f_reporte)."'" ;
										$a .= ",'".fecha2NMes($f_reporte)."'" ;
										$a .= ",'".fecha2Ano($f_reporte)."'" ;
									}else{
										$a .= ",''";
										$a .= ",''";
										$a .= ",''";
										$a .= ",''";
										$a .= ",''";
									}
									$a .= ",'".$Medidas[$i]."'" ;
									$a .= ",'".$rowdata['PuntoMedAceptable_'.$i]."'" ;
									$a .= ",'".$rowdata['PuntoMedAlerta_'.$i]."'" ;
									$a .= ",'".$rowdata['PuntoMedCondenatorio_'.$i]."'" ;
									
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `analisis_listado_alertas` (idAnalisis,nivel,idPunto,Nombrepunto,
									Creacion_fecha, Creacion_dia, Creacion_Semana, Creacion_mes, Creacion_ano,valor,
									medAceptable,medAlerta, medCondenatorio ) 
									VALUES ({$a} )";
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
								//alerta naranja
								if(isset($Medidas[$i])&&$Medidas[$i]!=''&&$Medidas[$i]>$rowdata['PuntoMedCondenatorio_'.$i]&&$Medidas[$i]<=$rowdata['PuntoMedAlerta_'.$i]){
									//variables alerta naranja
									$alert_lvl = 2; //naranja

									//guardo el dato
									$a  = "'".$ultimo_id."'" ;
									$a .= ",'".$alert_lvl."'" ;
									$a .= ",'".$i."'" ;
									$a .= ",'".$rowdata['PuntoNombre_'.$i]."'" ;
									if(isset($f_reporte) && $f_reporte!= ''){  
										$a .= ",'".$f_reporte."'" ;  
										$a .= ",'".fecha2NdiaMes($f_reporte)."'" ;
										$a .= ",'".fecha2NSemana($f_reporte)."'" ;
										$a .= ",'".fecha2NMes($f_reporte)."'" ;
										$a .= ",'".fecha2Ano($f_reporte)."'" ;
									}else{
										$a .= ",''";
										$a .= ",''";
										$a .= ",''";
										$a .= ",''";
										$a .= ",''";
									}
									$a .= ",'".$Medidas[$i]."'" ;
									$a .= ",'".$rowdata['PuntoMedAceptable_'.$i]."'" ;
									$a .= ",'".$rowdata['PuntoMedAlerta_'.$i]."'" ;
									$a .= ",'".$rowdata['PuntoMedCondenatorio_'.$i]."'" ;
									
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `analisis_listado_alertas` (idAnalisis,nivel,idPunto,Nombrepunto,
									Creacion_fecha, Creacion_dia, Creacion_Semana, Creacion_mes, Creacion_ano,valor,
									medAceptable,medAlerta, medCondenatorio ) 
									VALUES ({$a} )";
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
								//alerta roja
								if(isset($Medidas[$i])&&$Medidas[$i]!=''&&$Medidas[$i]<=$rowdata['PuntoMedCondenatorio_'.$i]){
									//variables alerta roja
									$alert_lvl = 3; //roja

									//guardo el dato
									$a  = "'".$ultimo_id."'" ;
									$a .= ",'".$alert_lvl."'" ;
									$a .= ",'".$i."'" ;
									$a .= ",'".$rowdata['PuntoNombre_'.$i]."'" ;
									if(isset($f_reporte) && $f_reporte!= ''){  
										$a .= ",'".$f_reporte."'" ;  
										$a .= ",'".fecha2NdiaMes($f_reporte)."'" ;
										$a .= ",'".fecha2NSemana($f_reporte)."'" ;
										$a .= ",'".fecha2NMes($f_reporte)."'" ;
										$a .= ",'".fecha2Ano($f_reporte)."'" ;
									}else{
										$a .= ",''";
										$a .= ",''";
										$a .= ",''";
										$a .= ",''";
										$a .= ",''";
									}
									$a .= ",'".$Medidas[$i]."'" ;
									$a .= ",'".$rowdata['PuntoMedAceptable_'.$i]."'" ;
									$a .= ",'".$rowdata['PuntoMedAlerta_'.$i]."'" ;
									$a .= ",'".$rowdata['PuntoMedCondenatorio_'.$i]."'" ;
									
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `analisis_listado_alertas` (idAnalisis,nivel,idPunto,Nombrepunto,
									Creacion_fecha, Creacion_dia, Creacion_Semana, Creacion_mes, Creacion_ano,valor,
									medAceptable,medAlerta, medCondenatorio ) 
									VALUES ({$a} )";
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
							
								
							/***************************************************************/
							}elseif($rowdata['PuntoMedAceptable_'.$i]<$rowdata['PuntoMedCondenatorio_'.$i]){
								
								//alerta amarilla
								if(isset($Medidas[$i])&&$Medidas[$i]!=''&&$Medidas[$i]<$rowdata['PuntoMedAlerta_'.$i]&&$Medidas[$i]>=$rowdata['PuntoMedAceptable_'.$i]){
									//variables alerta amarilla
									$alert_lvl = 1; //amarilla

									//guardo el dato
									$a  = "'".$ultimo_id."'" ;
									$a .= ",'".$alert_lvl."'" ;
									$a .= ",'".$i."'" ;
									$a .= ",'".$rowdata['PuntoNombre_'.$i]."'" ;
									if(isset($f_reporte) && $f_reporte!= ''){  
										$a .= ",'".$f_reporte."'" ;  
										$a .= ",'".fecha2NdiaMes($f_reporte)."'" ;
										$a .= ",'".fecha2NSemana($f_reporte)."'" ;
										$a .= ",'".fecha2NMes($f_reporte)."'" ;
										$a .= ",'".fecha2Ano($f_reporte)."'" ;
									}else{
										$a .= ",''";
										$a .= ",''";
										$a .= ",''";
										$a .= ",''";
										$a .= ",''";
									}
									$a .= ",'".$Medidas[$i]."'" ;
									$a .= ",'".$rowdata['PuntoMedAceptable_'.$i]."'" ;
									$a .= ",'".$rowdata['PuntoMedAlerta_'.$i]."'" ;
									$a .= ",'".$rowdata['PuntoMedCondenatorio_'.$i]."'" ;
									
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `analisis_listado_alertas` (idAnalisis,nivel,idPunto,Nombrepunto,
									Creacion_fecha, Creacion_dia, Creacion_Semana, Creacion_mes, Creacion_ano,valor,
									medAceptable,medAlerta, medCondenatorio ) 
									VALUES ({$a} )";
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
								//alerta naranja
								if(isset($Medidas[$i])&&$Medidas[$i]!=''&&$Medidas[$i]<$rowdata['PuntoMedCondenatorio_'.$i]&&$Medidas[$i]>=$rowdata['PuntoMedAlerta_'.$i]){
									//variables alerta naranja
									$alert_lvl = 2; //naranja

									//guardo el dato
									$a  = "'".$ultimo_id."'" ;
									$a .= ",'".$alert_lvl."'" ;
									$a .= ",'".$i."'" ;
									$a .= ",'".$rowdata['PuntoNombre_'.$i]."'" ;
									if(isset($f_reporte) && $f_reporte!= ''){  
										$a .= ",'".$f_reporte."'" ;  
										$a .= ",'".fecha2NdiaMes($f_reporte)."'" ;
										$a .= ",'".fecha2NSemana($f_reporte)."'" ;
										$a .= ",'".fecha2NMes($f_reporte)."'" ;
										$a .= ",'".fecha2Ano($f_reporte)."'" ;
									}else{
										$a .= ",''";
										$a .= ",''";
										$a .= ",''";
										$a .= ",''";
										$a .= ",''";
									}
									$a .= ",'".$Medidas[$i]."'" ;
									$a .= ",'".$rowdata['PuntoMedAceptable_'.$i]."'" ;
									$a .= ",'".$rowdata['PuntoMedAlerta_'.$i]."'" ;
									$a .= ",'".$rowdata['PuntoMedCondenatorio_'.$i]."'" ;
									
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `analisis_listado_alertas` (idAnalisis,nivel,idPunto,Nombrepunto,
									Creacion_fecha, Creacion_dia, Creacion_Semana, Creacion_mes, Creacion_ano,valor,
									medAceptable,medAlerta, medCondenatorio ) 
									VALUES ({$a} )";
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
								//alerta roja
								if(isset($Medidas[$i])&&$Medidas[$i]!=''&&$Medidas[$i]>=$rowdata['PuntoMedCondenatorio_'.$i]){
									//variables alerta roja
									$alert_lvl = 3; //roja

									//guardo el dato
									$a  = "'".$ultimo_id."'" ;
									$a .= ",'".$alert_lvl."'" ;
									$a .= ",'".$i."'" ;
									$a .= ",'".$rowdata['PuntoNombre_'.$i]."'" ;
									if(isset($f_reporte) && $f_reporte!= ''){  
										$a .= ",'".$f_reporte."'" ;  
										$a .= ",'".fecha2NdiaMes($f_reporte)."'" ;
										$a .= ",'".fecha2NSemana($f_reporte)."'" ;
										$a .= ",'".fecha2NMes($f_reporte)."'" ;
										$a .= ",'".fecha2Ano($f_reporte)."'" ;
									}else{
										$a .= ",''";
										$a .= ",''";
										$a .= ",''";
										$a .= ",''";
										$a .= ",''";
									}
									$a .= ",'".$Medidas[$i]."'" ;
									$a .= ",'".$rowdata['PuntoMedAceptable_'.$i]."'" ;
									$a .= ",'".$rowdata['PuntoMedAlerta_'.$i]."'" ;
									$a .= ",'".$rowdata['PuntoMedCondenatorio_'.$i]."'" ;
									
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `analisis_listado_alertas` (idAnalisis,nivel,idPunto,Nombrepunto,
									Creacion_fecha, Creacion_dia, Creacion_Semana, Creacion_mes, Creacion_ano,valor,
									medAceptable,medAlerta, medCondenatorio ) 
									VALUES ({$a} )";
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
								
							}
						}
					}
				
						
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
		case 'update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idAnalisis='".$idAnalisis."'" ;
				if(isset($idMaquina) && $idMaquina != ''){               $a .= ",idMaquina='".$idMaquina."'" ;}
				if(isset($idMatriz) && $idMatriz != ''){                 $a .= ",idMatriz='".$idMatriz."'" ;}
				if(isset($idSistema) && $idSistema != ''){               $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idEstado) && $idEstado != ''){                 $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idOT) && $idOT != ''){                         $a .= ",idOT='".$idOT."'" ;}
				if(isset($f_muestreo) && $f_muestreo != ''){             $a .= ",f_muestreo='".$f_muestreo."'" ;}
				if(isset($f_recibida) && $f_recibida != ''){             $a .= ",f_recibida='".$f_recibida."'" ;}
				if(isset($f_reporte) && $f_reporte != ''){               $a .= ",f_reporte='".$f_reporte."'" ;}
				if(isset($n_muestra) && $n_muestra != ''){               $a .= ",n_muestra='".$n_muestra."'" ;}
				if(isset($obs_Diagnostico) && $obs_Diagnostico != ''){   $a .= ",obs_Diagnostico='".$obs_Diagnostico."'" ;}
				if(isset($obs_Accion) && $obs_Accion != ''){             $a .= ",obs_Accion='".$obs_Accion."'" ;}
				if(isset($idTipo) && $idTipo != ''){                     $a .= ",idTipo='".$idTipo."'" ;}
				if(isset($idLaboratorio) && $idLaboratorio != ''){       $a .= ",idLaboratorio='".$idLaboratorio."'" ;}
				
				for ($i = 1; $i <= 50; $i++) {
					if(isset($Medidas[$i]) && $Medidas[$i] != ''){    $a .= ",Medida_".$i."='".$Medidas[$i]."'" ;}
				}
				
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `analisis_listado` SET ".$a." WHERE idAnalisis = '$idAnalisis'";
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
		case 'del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se borra el dato de la base de datos
			$query  = "DELETE FROM `analisis_listado` WHERE idAnalisis = {$_GET['del']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
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
	}
?>
