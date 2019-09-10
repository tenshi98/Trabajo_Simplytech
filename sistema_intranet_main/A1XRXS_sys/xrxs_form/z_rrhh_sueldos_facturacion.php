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
	if ( !empty($_POST['idFacturacion']) )    $idFacturacion      = $_POST['idFacturacion'];
	if ( !empty($_POST['idSistema']) )        $idSistema          = $_POST['idSistema'];
	if ( !empty($_POST['idUsuario']) )        $idUsuario          = $_POST['idUsuario'];
	if ( !empty($_POST['fecha_auto']) )       $fecha_auto         = $_POST['fecha_auto'];
	if ( !empty($_POST['Creacion_fecha']) )   $Creacion_fecha     = $_POST['Creacion_fecha'];
	if ( !empty($_POST['Fecha_desde']) )      $Fecha_desde        = $_POST['Fecha_desde'];
	if ( !empty($_POST['Fecha_hasta']) )      $Fecha_hasta        = $_POST['Fecha_hasta'];
	if ( !empty($_POST['Observaciones']) )    $Observaciones      = $_POST['Observaciones'];
	if ( !empty($_POST['UF']) )               $UF                 = $_POST['UF'];
	if ( !empty($_POST['UTM']) )              $UTM                = $_POST['UTM'];
	if ( !empty($_POST['IMM']) )              $IMM                = $_POST['IMM'];
	if ( !empty($_POST['TopeImpAFP']) )       $TopeImpAFP         = $_POST['TopeImpAFP'];
	if ( !empty($_POST['TopeImpIPS']) )       $TopeImpIPS         = $_POST['TopeImpIPS'];
	if ( !empty($_POST['TopeSegCesantia']) )  $TopeSegCesantia    = $_POST['TopeSegCesantia'];
	if ( !empty($_POST['TopeAPVMensual']) )   $TopeAPVMensual     = $_POST['TopeAPVMensual'];
	if ( !empty($_POST['TopeDepConv']) )      $TopeDepConv        = $_POST['TopeDepConv'];
				
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
			case 'idFacturacion':    if(empty($idFacturacion)){      $error['idFacturacion']     = 'error/No ha ingresado el id';}break;
			case 'idSistema':        if(empty($idSistema)){          $error['idSistema']         = 'error/No ha ingresado el numero de documento';}break;
			case 'idUsuario':        if(empty($idUsuario)){          $error['idUsuario']         = 'error/No ha seleccionado el usuario';}break;
			case 'fecha_auto':       if(empty($fecha_auto)){         $error['fecha_auto']        = 'error/No ha ingresado la fecha automatica';}break;
			case 'Creacion_fecha':   if(empty($Creacion_fecha)){     $error['Creacion_fecha']    = 'error/No ha ingresado la fecha de creacion';}break;
			case 'Fecha_desde':      if(empty($Fecha_desde)){        $error['Fecha_desde']       = 'error/No ha ingresado la fecha desde';}break;
			case 'Fecha_hasta':      if(empty($Fecha_hasta)){        $error['Fecha_hasta']       = 'error/No ha ingresado la fecha hasta';}break;
			case 'Observaciones':    if(empty($Observaciones)){      $error['Observaciones']     = 'error/No ha ingresado la observacion';}break;
			case 'UF':               if(empty($UF)){                 $error['UF']                = 'error/No ha ingresado la UF';}break;
			case 'UTM':              if(empty($UTM)){                $error['UTM']               = 'error/No ha ingresado la UTM';}break;
			case 'IMM':              if(empty($IMM)){                $error['IMM']               = 'error/No ha ingresado el sueldo minimo';}break;
			case 'TopeImpAFP':       if(empty($TopeImpAFP)){         $error['TopeImpAFP']        = 'error/No ha ingresado el tope imponible de la afp';}break;
			case 'TopeImpIPS':       if(empty($TopeImpIPS)){         $error['TopeImpIPS']        = 'error/No ha ingresado el tope imponible del ips';}break;
			case 'TopeSegCesantia':  if(empty($TopeSegCesantia)){    $error['TopeSegCesantia']   = 'error/No ha ingresado el tope del seguro de cesantia';}break;
			case 'TopeAPVMensual':   if(empty($TopeAPVMensual)){     $error['TopeAPVMensual']    = 'error/No ha ingresado el tope del apv mensual';}break;
			case 'TopeDepConv':      if(empty($TopeDepConv)){        $error['TopeDepConv']       = 'error/No ha ingresado el tope del deposito convenido';}break;
			
				
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Fecha_desde)&&isset($Fecha_hasta)&&$Fecha_desde>$Fecha_hasta){ $error['Fono']    = 'error/La fecha Periodo Inicio debe ser inferior a la fecha de Periodo Termino'; }

/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {

/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                        INGRESOS                                                 */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/	
	
		case 'new_ingreso':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			$ndata_3 = 0;
			$ndata_4 = 0;
			$ndata_5 = 0;
			//Consulto los nombres y los sueldos de los trabajadores
			$arrTrabajador = array();
			$query = "SELECT idTipoContratoTrab, idTipoContrato, horas_pactadas, idAFP, idSalud
			FROM `trabajadores_listado`
			WHERE idEstado = 1";
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
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrTrabajador,$row );
			}
			//verificacion de errores
			foreach ($arrTrabajador as $trab) {
				if(isset($trab['idTipoContratoTrab'])&&$trab['idTipoContratoTrab']==0){  $ndata_1++;}
				if(isset($trab['idTipoContrato'])&&$trab['idTipoContrato']==0){          $ndata_2++;}
				if(isset($trab['horas_pactadas'])&&$trab['horas_pactadas']==0){          $ndata_3++;}
				if(isset($trab['idAFP'])&&$trab['idAFP']==0){                            $ndata_4++;}
				if(isset($trab['idSalud'])&&$trab['idSalud']==0){                        $ndata_5++;}
			}
			
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/Uno o mas trabajadores no tiene configurado el tipo de contrato';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/Uno o mas trabajadores no tiene configurado el tipo de contrato';}
			if($ndata_3 > 0) {$error['ndata_3'] = 'error/Uno o mas trabajadores no tiene configurado las horas pactadas';}
			if($ndata_4 > 0) {$error['ndata_4'] = 'error/Uno o mas trabajadores no tiene configurado la AFP';}
			if($ndata_5 > 0) {$error['ndata_5'] = 'error/Uno o mas trabajadores no tiene configurado la Salud';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['fact_sueldos_basicos']);
				unset($_SESSION['fact_sueldos_sueldos']);
				unset($_SESSION['fact_sueldos_temporal']);
				
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['fact_sueldos_archivos'])){
					foreach ($_SESSION['fact_sueldos_archivos'] as $key => $producto){
						try {
							if(!is_writable('upload/'.$producto['Nombre'])){
								//throw new Exception('File not writable');
							}else{
								unlink('upload/'.$producto['Nombre']);
							}
						}catch(Exception $e) { 
							//guardar el dato en un archivo log
						}
					}
				}
				unset($_SESSION['fact_sueldos_archivos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['fact_sueldos_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['fact_sueldos_basicos']['Fecha_desde']      = $Fecha_desde;
				$_SESSION['fact_sueldos_basicos']['Fecha_hasta']      = $Fecha_hasta;
				$_SESSION['fact_sueldos_basicos']['idSistema']        = $idSistema;
				$_SESSION['fact_sueldos_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['fact_sueldos_basicos']['fecha_auto']       = $fecha_auto;
				$_SESSION['fact_sueldos_basicos']['Observaciones']    = $Observaciones;
				$_SESSION['fact_sueldos_basicos']['UF']               = $UF;
				$_SESSION['fact_sueldos_basicos']['UTM']              = $UTM;
				$_SESSION['fact_sueldos_basicos']['IMM']              = $IMM;
				$_SESSION['fact_sueldos_basicos']['TopeImpAFP']       = $TopeImpAFP;
				$_SESSION['fact_sueldos_basicos']['TopeImpIPS']       = $TopeImpIPS;
				$_SESSION['fact_sueldos_basicos']['TopeSegCesantia']  = $TopeSegCesantia;
				$_SESSION['fact_sueldos_basicos']['TopeAPVMensual']   = $TopeAPVMensual;
				$_SESSION['fact_sueldos_basicos']['TopeDepConv']      = $TopeDepConv;
				

				//Consulto los nombres y los sueldos de los trabajadores
				$arrTrabajador = array();
				$query = "SELECT 
				trabajadores_listado.idTrabajador,
				trabajadores_listado.idTipoContratoTrab,
				trabajadores_listado.idTipoTrabajador,
				trabajadores_listado.idTipoContrato,
				trabajadores_listado.SueldoLiquido,
				trabajadores_listado.SueldoDia,
				trabajadores_listado.SueldoHora,
				trabajadores_listado.Gratificacion,
				trabajadores_listado.horas_pactadas,
				trabajadores_listado.email,

				trabajadores_listado.Nombre, 
				trabajadores_listado.ApellidoPat, 
				trabajadores_listado.ApellidoMat,
				trabajadores_listado.Rut,
				trabajadores_listado.F_Inicio_Contrato,
				trabajadores_listado.Cargo,

				sistema_afp.idAFP AS AFP_idAFP,
				sistema_afp.Nombre AS AFP_Nombre,
				sistema_afp.PorcentajeDependiente AS AFP_PorcentajeDep,
				sistema_afp.PorcentajeIndependiente AS AFP_PorcentajeIndep,
				sistema_afp.IPS AS AFP_IPS,

				sistema_salud.idSalud AS Salud_idAFP,
				sistema_salud.Nombre AS Salud_Nombre,
				sistema_salud.Porcentaje AS Salud_Porcentaje,

				core_sistemas.Nombre AS SistemaNombre,
				core_sistemas.Rut AS SistemaRut,

				(SELECT COUNT(idCarga) AS Cantidad FROM `trabajadores_listado_cargas` WHERE idEstado = 1 AND idTrabajador = trabajadores_listado.idTrabajador) AS N_cargas,

				trabajadores_listado_tipos.Nombre AS TipoTrabajador

				FROM `trabajadores_listado`
				LEFT JOIN `trabajadores_listado_tipos`    ON trabajadores_listado_tipos.idTipo   = trabajadores_listado.idTipo
				LEFT JOIN `sistema_afp`                   ON sistema_afp.idAFP                   = trabajadores_listado.idAFP
				LEFT JOIN `sistema_salud`                 ON sistema_salud.idSalud               = trabajadores_listado.idSalud
				LEFT JOIN `core_sistemas`                 ON core_sistemas.idSistema             = trabajadores_listado.idSistema

				WHERE trabajadores_listado.idEstado = 1
				ORDER BY trabajadores_listado.ApellidoPat ASC, 
				trabajadores_listado.ApellidoMat ASC,
				trabajadores_listado.Nombre ASC";
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrTrabajador,$row );
				}
				/************************************/
				//Inasistencias
				$arrInasistenciaDias = array();
				$query = "SELECT idTrabajador, COUNT(idTrabajador)AS Cuenta
				FROM `trabajadores_inasistencias_dias`
				WHERE idUso=1 AND Creacion_fecha BETWEEN '".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."' AND '".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'
				GROUP BY idTrabajador
				ORDER BY idTrabajador ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrInasistenciaDias,$row );
				}
				//Dias de inasistencia
				foreach ($arrInasistenciaDias as $inasis) {
					$_SESSION['fact_sueldos_sueldos'][$inasis['idTrabajador']]['diasInasistencia'] = $inasis['Cuenta'];
				}
				/************************************/
				//Licencias
				$arrLicencias = array();
				$query = "SELECT idTrabajador, SUM(N_Dias)AS Cuenta
				FROM `trabajadores_licencias`
				WHERE idUso=1 AND Fecha_inicio BETWEEN '".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."' AND '".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'
				GROUP BY idTrabajador
				ORDER BY idTrabajador ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrLicencias,$row );
				}
				//Licencias
				foreach ($arrLicencias as $lic) {
					$_SESSION['fact_sueldos_sueldos'][$lic['idTrabajador']]['diasLicencias'] = $lic['Cuenta'];
				}
				/************************************/
				//Bonos Fijos
				$arrBonoFijo = array();
				$query = "SELECT 
				trabajadores_listado_bonos_fijos.idBonoFijo,
				trabajadores_listado_bonos_fijos.idTrabajador,
				trabajadores_listado_bonos_fijos.Monto,
				sistema_bonos_fijos.Nombre,
				sistema_bonos_fijos.idTipo

				FROM `trabajadores_listado_bonos_fijos`
				LEFT JOIN `sistema_bonos_fijos` ON sistema_bonos_fijos.idBonoFijo = trabajadores_listado_bonos_fijos.idBonoFijo
				ORDER BY trabajadores_listado_bonos_fijos.idTrabajador ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrBonoFijo,$row );
				}
				//Bonos Fijos
				foreach ($arrBonoFijo as $bono) {
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoFijo'][$bono['idBonoFijo']]['idBonoFijo']  = $bono['idBonoFijo'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoFijo'][$bono['idBonoFijo']]['BonoNombre']  = $bono['Nombre'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoFijo'][$bono['idBonoFijo']]['BonoMonto']   = $bono['Monto'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoFijo'][$bono['idBonoFijo']]['BonoTipo']    = $bono['idTipo'];
				}
				/************************************/
				//Bonos por turnos
				$arrBonoTurno = array();
				$query = "SELECT 
				trabajadores_horas_extras_facturacion_turnos.idServicios,
				trabajadores_horas_extras_facturacion_turnos.idTrabajador,
				trabajadores_horas_extras_facturacion_turnos.idTurnos,
				core_horas_extras_turnos.Nombre,
				core_horas_extras_turnos.Valor

				FROM `trabajadores_horas_extras_facturacion_turnos`
				LEFT JOIN `core_horas_extras_turnos` ON core_horas_extras_turnos.idTurnos = trabajadores_horas_extras_facturacion_turnos.idTurnos
				WHERE trabajadores_horas_extras_facturacion_turnos.idUso=1 AND trabajadores_horas_extras_facturacion_turnos.Creacion_fecha BETWEEN '".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."' AND '".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'
				ORDER BY trabajadores_horas_extras_facturacion_turnos.idTrabajador ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrBonoTurno,$row );
				}
				//Bonos por turnos
				foreach ($arrBonoTurno as $bono) {
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoTurno'][$bono['idTurnos']]['idServicios']  = $bono['idServicios'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoTurno'][$bono['idTurnos']]['idTurnos']     = $bono['idTurnos'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoTurno'][$bono['idTurnos']]['BonoNombre']   = $bono['Nombre'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoTurno'][$bono['idTurnos']]['BonoMonto']    = $bono['Valor'];
				}
				/************************************/
				//Bonos Temporales
				$arrBonoTemporal = array();
				$query = "SELECT 
				trabajadores_bonos_temporales.idBonoTemporal,
				trabajadores_bonos_temporales.idTrabajador,
				trabajadores_bonos_temporales.Monto,
				sistema_bonos_temporales.Nombre,
				sistema_bonos_temporales.idTipo

				FROM `trabajadores_bonos_temporales`
				LEFT JOIN `sistema_bonos_temporales` ON sistema_bonos_temporales.idBonoTemporal = trabajadores_bonos_temporales.idBonoTemporal
				WHERE trabajadores_bonos_temporales.idUso=1 AND trabajadores_bonos_temporales.Creacion_fecha BETWEEN '".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."' AND '".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'
				ORDER BY trabajadores_bonos_temporales.idTrabajador ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrBonoTemporal,$row );
				}
				//Bonos Temporales
				foreach ($arrBonoTemporal as $bono) {
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoTemporal'][$bono['idBonoTemporal']]['idBonoTemporal']  = $bono['idBonoTemporal'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoTemporal'][$bono['idBonoTemporal']]['BonoNombre']      = $bono['Nombre'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoTemporal'][$bono['idBonoTemporal']]['BonoMonto']       = $bono['Monto'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoTemporal'][$bono['idBonoTemporal']]['BonoTipo']        = $bono['idTipo'];
				}
				/************************************/
				//Horas Extras
				$arrHorasExtras = array();
				$query = "SELECT 
				trabajadores_horas_extras_mensuales_facturacion_horas.idTrabajador,
				trabajadores_horas_extras_mensuales_facturacion_horas.idPorcentaje,
				core_horas_extras_porcentajes.Porcentaje,
				trabajadores_listado.idTipoContratoTrab,
				trabajadores_listado.horas_pactadas,
				trabajadores_listado.SueldoLiquido,
				trabajadores_listado.SueldoDia,
				trabajadores_listado.SueldoHora,
				SUM(trabajadores_horas_extras_mensuales_facturacion_horas.N_Horas) AS Horas

				FROM `trabajadores_horas_extras_mensuales_facturacion_horas`
				LEFT JOIN `core_horas_extras_porcentajes`   ON core_horas_extras_porcentajes.idPorcentaje  = trabajadores_horas_extras_mensuales_facturacion_horas.idPorcentaje
				LEFT JOIN `trabajadores_listado`            ON trabajadores_listado.idTrabajador           = trabajadores_horas_extras_mensuales_facturacion_horas.idTrabajador

				WHERE trabajadores_horas_extras_mensuales_facturacion_horas.idUso=1 AND trabajadores_horas_extras_mensuales_facturacion_horas.Creacion_fecha BETWEEN '".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."' AND '".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'
				GROUP BY trabajadores_horas_extras_mensuales_facturacion_horas.idTrabajador, trabajadores_horas_extras_mensuales_facturacion_horas.idPorcentaje
				ORDER BY trabajadores_horas_extras_mensuales_facturacion_horas.idTrabajador ASC, trabajadores_horas_extras_mensuales_facturacion_horas.idPorcentaje ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrHorasExtras,$row );
				}
				//Horas Extras
				foreach ($arrHorasExtras as $bono) {
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['idPorcentaje']   = $bono['idPorcentaje'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['Porcentaje']     = $bono['Porcentaje'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['N_Horas']        = $bono['Horas'];

					switch ($bono['idTipoContratoTrab']) {
						//Trabajador con sueldo mensual
						case 1:
							$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['ValorHora'] = $bono['SueldoLiquido']*((7/30)/$bono['horas_pactadas']*((100+$bono['Porcentaje'])/100));
							$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['TotalHora'] = ($bono['SueldoLiquido']*((7/30)/$bono['horas_pactadas']*((100+$bono['Porcentaje'])/100)))*$bono['Horas'];
						break;
						//Trabajador con sueldo semanal
						case 2:
							$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['ValorHora'] = $bono['SueldoLiquido']*((7/7)/$bono['horas_pactadas']*((100+$bono['Porcentaje'])/100));
							$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['TotalHora'] = ($bono['SueldoLiquido']*((7/7)/$bono['horas_pactadas']*((100+$bono['Porcentaje'])/100)))*$bono['Horas'];
						break;
						//Trabajador con sueldo diario (jornada semanal de 5 días)
						case 3:
							$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['ValorHora'] =  $bono['SueldoDia']*((0.5)/$bono['horas_pactadas']*((100+$bono['Porcentaje'])/100));
							$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['TotalHora'] = ($bono['SueldoDia']*((0.5)/$bono['horas_pactadas']*((100+$bono['Porcentaje'])/100)))*$bono['Horas'];
						break;
						//Trabajador con sueldo diario (jornada semanal de 6 días)
						case 4:
							$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['ValorHora'] = $bono['SueldoDia']*((0.6)/$bono['horas_pactadas']*((100+$bono['Porcentaje'])/100));
							$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['TotalHora'] = ($bono['SueldoDia']*((0.6)/$bono['horas_pactadas']*((100+$bono['Porcentaje'])/100)))*$bono['Horas'];
						break;
						//Trabajador con sueldo por hora
						case 5:
							$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['ValorHora'] = $trab['SueldoHora'];
							$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['TotalHora'] = $trab['SueldoHora']*$bono['Horas'];
						break;
						

						
					}

				}
				/************************************/
				//Valor de las cargas familiares
				$arrTablaCargas = array();
				$query = "SELECT idTablaCarga, Tramo, Valor_Desde, Valor_Hasta, Valor_Pago
				FROM `sistema_rrhh_tabla_carga_familiar`
				ORDER BY idTablaCarga ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrTablaCargas,$row );
				}
				/************************************/
				//Valor de las cargas familiares
				$arrSeguro = array();
				$query = "SELECT idTipoContrato,Porc_Empleador,Porc_Trabajador
				FROM `sistema_rrhh_tabla_seguro_cesantia`
				ORDER BY idTablaSeguro ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrSeguro,$row );
				}
				/************************************/
				//Valor de las cargas familiares
				$arrImpuestoRenta = array();
				$query = "SELECT UTM_Desde, UTM_Hasta, Tasa, Rebaja
				FROM `sistema_rrhh_tabla_iusc`
				ORDER BY idTablaImpuesto ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrImpuestoRenta,$row );
				}
				/************************************/
				//Bonos Fijos
				$arrDescuentoFijo = array();
				$query = "SELECT 
				trabajadores_listado_descuentos_fijos.idDescuentoFijo,
				trabajadores_listado_descuentos_fijos.idTrabajador,
				trabajadores_listado_descuentos_fijos.Monto,
				sistema_descuentos_fijos.Nombre,
				trabajadores_listado_descuentos_fijos.idAFP,
				sistema_afp.Nombre AS AFP

				FROM `trabajadores_listado_descuentos_fijos`
				LEFT JOIN `sistema_descuentos_fijos` ON sistema_descuentos_fijos.idDescuentoFijo = trabajadores_listado_descuentos_fijos.idDescuentoFijo
				LEFT JOIN `sistema_afp`              ON sistema_afp.idAFP                        = trabajadores_listado_descuentos_fijos.idAFP
				ORDER BY trabajadores_listado_descuentos_fijos.idTrabajador ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrDescuentoFijo,$row );
				}
				//Bonos Fijos
				foreach ($arrDescuentoFijo as $desc) {
					//Verifico si alguno de los descuentos es superior
					//APV
					if($desc['idDescuentoFijo']==1){
						//Si el monto establecido es inferior al tope
						if($desc['Monto']<=$_SESSION['fact_sueldos_basicos']['TopeAPVMensual']){
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['idDescuentoFijo']  = $desc['idDescuentoFijo'];
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoNombre']  = $desc['Nombre'].' ('.$desc['AFP'].')';
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoMonto']   = $desc['Monto'];
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoIDAFP']   = $desc['idAFP'];
						//si es superior al tope se asigna el tope
						}elseif($desc['Monto']>$_SESSION['fact_sueldos_basicos']['TopeAPVMensual']){
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['idDescuentoFijo']  = $desc['idDescuentoFijo'];
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoNombre']  = $desc['Nombre'].' ('.$desc['AFP'].')';
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoMonto']   = $_SESSION['fact_sueldos_basicos']['TopeAPVMensual'];
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoIDAFP']   = $desc['idAFP'];
						}
					//Deposito Convenido	
					}elseif($desc['idDescuentoFijo']==2){
						//Si el monto establecido es inferior al tope
						if($desc['Monto']<=$_SESSION['fact_sueldos_basicos']['TopeDepConv']){
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['idDescuentoFijo']  = $desc['idDescuentoFijo'];
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoNombre']  = $desc['Nombre'].' ('.$desc['AFP'].')';
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoMonto']   = $desc['Monto'];
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoIDAFP']   = $desc['idAFP'];
						//si es superior al tope se asigna el tope
						}elseif($desc['Monto']>$_SESSION['fact_sueldos_basicos']['TopeDepConv']){
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['idDescuentoFijo']  = $desc['idDescuentoFijo'];
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoNombre']  = $desc['Nombre'].' ('.$desc['AFP'].')';
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoMonto']   = $_SESSION['fact_sueldos_basicos']['TopeDepConv'];
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoIDAFP']   = $desc['idAFP'];
						}
					}

				}
				/************************************/
				//Anticipos
				$arrAnticipos = array();
				$query = "SELECT idAnticipos, Creacion_fecha, idTrabajador, Monto
				FROM `trabajadores_descuentos_anticipos`
				WHERE idUso=1 AND Creacion_fecha BETWEEN '".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."' AND '".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'
				ORDER BY idTrabajador ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrAnticipos,$row );
				}
				//Anticipos
				foreach ($arrAnticipos as $anticipo) {
					$_SESSION['fact_sueldos_sueldos'][$anticipo['idTrabajador']]['Anticipo'][$anticipo['idAnticipos']]['Creacion_fecha']  = $anticipo['Creacion_fecha'];
					$_SESSION['fact_sueldos_sueldos'][$anticipo['idTrabajador']]['Anticipo'][$anticipo['idAnticipos']]['Monto']           = $anticipo['Monto'];
				}
				/************************************/
				//Descuento Cuota
				$arrDescuentoCuota = array();
				$query = "SELECT 
				trabajadores_descuentos_cuotas_listado.idCuotas, 
				trabajadores_descuentos_cuotas_listado.idTrabajador, 
				trabajadores_descuentos_cuotas_listado.Fecha, 
				trabajadores_descuentos_cuotas_listado.nCuota, 
				trabajadores_descuentos_cuotas_listado.TotalCuotas, 
				trabajadores_descuentos_cuotas_listado.monto_cuotas,
				trabajadores_descuentos_cuotas_tipos.Nombre AS Tipo

				FROM `trabajadores_descuentos_cuotas_listado`
				LEFT JOIN `trabajadores_descuentos_cuotas`        ON trabajadores_descuentos_cuotas.idFacturacion  = trabajadores_descuentos_cuotas_listado.idFacturacion
				LEFT JOIN `trabajadores_descuentos_cuotas_tipos`  ON trabajadores_descuentos_cuotas_tipos.idTipo   = trabajadores_descuentos_cuotas.idTipo
				WHERE trabajadores_descuentos_cuotas_listado.idUso=1 AND trabajadores_descuentos_cuotas_listado.Fecha BETWEEN '".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."' AND '".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'
				ORDER BY trabajadores_descuentos_cuotas_listado.idTrabajador ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrDescuentoCuota,$row );
				}
				//Descuento Cuota
				foreach ($arrDescuentoCuota as $cuota) {
					$_SESSION['fact_sueldos_sueldos'][$cuota['idTrabajador']]['Cuotas'][$cuota['idCuotas']]['Fecha']         = $cuota['Fecha'];
					$_SESSION['fact_sueldos_sueldos'][$cuota['idTrabajador']]['Cuotas'][$cuota['idCuotas']]['nCuota']        = $cuota['nCuota'];
					$_SESSION['fact_sueldos_sueldos'][$cuota['idTrabajador']]['Cuotas'][$cuota['idCuotas']]['TotalCuotas']   = $cuota['TotalCuotas'];
					$_SESSION['fact_sueldos_sueldos'][$cuota['idTrabajador']]['Cuotas'][$cuota['idCuotas']]['monto_cuotas']  = $cuota['monto_cuotas'];
					$_SESSION['fact_sueldos_sueldos'][$cuota['idTrabajador']]['Cuotas'][$cuota['idCuotas']]['Tipo']          = $cuota['Tipo'];
				}




				/************************************/
				//Recorro y guardo los datos
				foreach ($arrTrabajador as $trab) {
					/***********************************************************/
					/*                     Guardables                          */
					/***********************************************************/
					//Trabajador
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['idTrabajador'] = $trab['idTrabajador'];
					//Tipo Contrato
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['idTipoContratoTrab']   = $trab['idTipoContratoTrab'];
					//Horas por semana pactado
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['horas_pactadas']   = $trab['horas_pactadas'];
					//Gratificacion
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Gratificacion']   = $trab['Gratificacion'];
					
					switch ($trab['idTipoContratoTrab']) {
						//Trabajador con sueldo mensual - 
						case 1:
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TipoContratoTrab'] = 'Sueldo Mensual';
						break;
						//Trabajador con sueldo semanal
						case 2:
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TipoContratoTrab'] = 'Sueldo Semanal';
						break;
						//Trabajador con sueldo diario (jornada semanal de 5 días)
						case 3:
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TipoContratoTrab'] = 'Sueldo Diario (jornada semanal de 5 días)';
						break;
						//Trabajador con sueldo diario (jornada semanal de 6 días)
						case 4:
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TipoContratoTrab'] = 'Sueldo Diario (jornada semanal de 6 días)';
						break;
						//Trabajador con sueldo por hora
						case 5:
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TipoContratoTrab'] = 'Sueldo por hora';
						break;
					}
					
					

					/************************************************************************************************/
					/*                                            Haberes                                           */
					/************************************************************************************************/
					//Sueldo y dias pactados
					switch ($trab['idTipoContratoTrab']) {
						//Trabajador con sueldo mensual
						case 1:
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoPactado']  = $trab['SueldoLiquido'];
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasPactados']   = 30;
						break;
						//Trabajador con sueldo semanal
						case 2:
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoPactado']  = $trab['SueldoLiquido'];
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasPactados']   = 7;
						break;
						//Trabajador con sueldo diario (jornada semanal de 5 días)
						case 3:
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoPactado']  = $trab['SueldoDia'];
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasPactados']   = 5;
						break;
						//Trabajador con sueldo diario (jornada semanal de 6 días)
						case 4:
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoPactado']  = $trab['SueldoDia'];
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasPactados']   = 6;
						break;
						//Trabajador con sueldo por hora
						case 5:
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoPactado']  = $trab['SueldoHora'];
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasPactados']   = 1;
						break;
					}
					//Dias trabajados
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasTrabajados'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasPactados'];
					if(isset($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['diasInasistencia'])){$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasTrabajados'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasTrabajados'] - $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['diasInasistencia'];}
					if(isset($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['diasLicencias'])){$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasTrabajados'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasTrabajados'] - $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['diasLicencias'];}
					//Calculo del base a pagar
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoPagado'] = ($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasTrabajados']/$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasPactados'])*$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoPactado'];
					//Calculo Total Bonos Fijos(100 tipos bonos estimados en el sistema)
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoFijoAfecto']   = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoFijoNoAfecto'] = 0;
					for ($x = 0; $x <= 100; $x++) {
						//verifico si existe y si esta afecto a descuentos
						if(isset($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoFijo'][$x]['BonoTipo'])&&$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoFijo'][$x]['BonoTipo']==1){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoFijoAfecto'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoFijoAfecto'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoFijo'][$x]['BonoMonto'];
						//verifico si existe y si esta no afecto a descuentos
						}elseif(isset($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoFijo'][$x]['BonoTipo'])&&$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoFijo'][$x]['BonoTipo']==2){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoFijoNoAfecto'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoFijoNoAfecto'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoFijo'][$x]['BonoMonto'];
						}
					}
					//Calculo Total Bonos por turno (6 maximo)
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTurno']   = 0;
					for ($x = 0; $x <= 6; $x++) {
						//verifico si existe y si esta afecto a descuentos
						if(isset($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoTurno'][$x]['BonoMonto'])&&$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoTurno'][$x]['BonoMonto']!=0){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTurno'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTurno'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoTurno'][$x]['BonoMonto'];
						}
					}  
					//Calculo Total Bonos Temporales(100  bonos estimados en el sistema)
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTemporalAfecto']   = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTemporalNoAfecto'] = 0;
					for ($x = 0; $x <= 100; $x++) {
						//verifico si existe y si esta afecto a descuentos
						if(isset($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoTemporal'][$x]['BonoTipo'])&&$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoTemporal'][$x]['BonoTipo']==1){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTemporalAfecto'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTemporalAfecto'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoTemporal'][$x]['BonoMonto'];
						//verifico si existe y si esta no afecto a descuentos
						}elseif(isset($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoTemporal'][$x]['BonoTipo'])&&$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoTemporal'][$x]['BonoTipo']==2){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTemporalNoAfecto'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTemporalNoAfecto'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoTemporal'][$x]['BonoMonto'];
						}
					}
					//Calculo Total Bonos Temporales(100  bonos estimados en el sistema)
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalHorasExtras']   = 0;
					for ($x = 0; $x <= 31; $x++) {
						if(isset($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['HorasExtras'][$x]['N_Horas'])&&$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['HorasExtras'][$x]['N_Horas']!=0){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalHorasExtras']   = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalHorasExtras'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['HorasExtras'][$x]['TotalHora'];	
						}
					}
					//Calculo de las cargas familiares
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Cargas_n']              = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Cargas_valor']          = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Cargas_idTramo']        = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Cargas_tramo']          = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalCargasFamiliares'] = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Cargas_n']              = $trab['N_cargas'];
					//Recorro la tabla para establecer el valor de la carga familiar
					foreach ($arrTablaCargas as $tabla) {
						if($tabla['Valor_Desde']<=$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoPactado']&&$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoPactado']<=$tabla['Valor_Hasta']){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Cargas_idTramo']        = $tabla['idTablaCarga'];
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Cargas_valor']          = $tabla['Valor_Pago'];
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Cargas_tramo']          = $tabla['Tramo'];
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalCargasFamiliares'] = $tabla['Valor_Pago']*$trab['N_cargas'];
						}
					}
					
					//Calculo del Sueldo imponible
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoPagado'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Gratificacion'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoFijoAfecto'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTurno'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTemporalAfecto'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalHorasExtras'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalCargasFamiliares'];
					
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoNoImponible'] = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoNoImponible'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoNoImponible'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoFijoNoAfecto'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoNoImponible'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoNoImponible'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTemporalNoAfecto'];
					
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalHaberes'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoNoImponible'];
					/************************************************************************************************/
					/*                                            Deberes                                           */
					/************************************************************************************************/
					//Se verifica el tipo de sistema previsional en el que esta
					//Si esta en AFP
					if($trab['AFP_IPS']==0){
						//Verifico si es un trabajador dependiente
						if($trab['idTipoTrabajador']==1){
							$AFPPorcentaje = $trab['AFP_PorcentajeDep'];
						//Verifico si es un trabajador independiente
						}elseif($trab['idTipoTrabajador']==2){
							$AFPPorcentaje = $trab['AFP_PorcentajeIndep'];
						}
						
						//Se establece el sueldo imponible Maximo
						if($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible']<=$_SESSION['fact_sueldos_basicos']['TopeImpAFP']){
							$Sueldo_Imp = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'];
						}else{
							$Sueldo_Imp = $_SESSION['fact_sueldos_basicos']['TopeImpAFP'];
						}
						
						
					//Si esta en el IPS	
					}elseif($trab['AFP_IPS']==1){
						//Verifico si es un trabajador dependiente
						if($trab['idTipoTrabajador']==1){
							$AFPPorcentaje = $trab['AFP_PorcentajeDep'];
						//Verifico si es un trabajador independiente
						}elseif($trab['idTipoTrabajador']==2){
							$AFPPorcentaje = $trab['AFP_PorcentajeIndep'];
						}
						
						//Se establece el sueldo imponible Maximo
						if($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible']<=$_SESSION['fact_sueldos_basicos']['TopeImpIPS']){
							$Sueldo_Imp = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'];
						}else{
							$Sueldo_Imp = $_SESSION['fact_sueldos_basicos']['TopeImpIPS'];
						}
						
					}

					//Se guardan las imposiciones
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['AFP_idAFP']      = $trab['AFP_idAFP'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['AFP_Nombre']     = $trab['AFP_Nombre'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['AFP_Porcentaje'] = $AFPPorcentaje;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['AFP_Total']      = ($Sueldo_Imp/100)*$AFPPorcentaje;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['AFP_SIS']        = ($Sueldo_Imp/100)*1.53;;
					
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Salud_idAFP']      = $trab['Salud_idAFP'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Salud_Nombre']     = $trab['Salud_Nombre'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Salud_Porcentaje'] = $trab['Salud_Porcentaje'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Salud_Total']      = ($Sueldo_Imp/100)*$trab['Salud_Porcentaje'];
					
					//Se suman todos los descuentos
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Salud_Total'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['AFP_Total'];
					
					//Calculo Total Bonos Fijos(100 tipos bonos estimados en el sistema)
					for ($x = 0; $x <= 100; $x++) {
						//verifico si existe
						if(isset($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DescuentoFijo'][$x]['DescuentoMonto'])){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DescuentoFijo'][$x]['DescuentoMonto'];
						}
					}
					

					//Recorro la tabla para establecer el valor del seguro de cesantia
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SegCesantia_Empleador']  = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SegCesantia_Trabajador'] = 0;
					foreach ($arrSeguro as $seguro) {
						//Si el seguro es el mismo
						if($trab['idTipoContrato']==$seguro['idTipoContrato']){
							if($Sueldo_Imp<$_SESSION['fact_sueldos_basicos']['TopeSegCesantia']){
								$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SegCesantia_Empleador']  =($Sueldo_Imp/100)*$seguro['Porc_Empleador'];
								$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SegCesantia_Trabajador'] =($Sueldo_Imp/100)*$seguro['Porc_Trabajador'];
							}else{
								$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SegCesantia_Empleador']  =($_SESSION['fact_sueldos_basicos']['TopeSegCesantia']/100)*$seguro['Porc_Empleador'];
								$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SegCesantia_Trabajador'] =($_SESSION['fact_sueldos_basicos']['TopeSegCesantia']/100)*$seguro['Porc_Trabajador'];
							}
						}	
					}
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SegCesantia_Trabajador'];
					
					//Calculo del impuesto a la renta
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['ImpuestoRenta'] = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['RentaAfecta'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] - $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'];
					foreach ($arrImpuestoRenta as $imp_renta) {
						//Verifico si el sueldo afecto esta dentro de los limites
						if(($imp_renta['UTM_Desde'] * $_SESSION['fact_sueldos_basicos']['UTM'])<=$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['RentaAfecta']&&$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['RentaAfecta']<=($imp_renta['UTM_Hasta'] * $_SESSION['fact_sueldos_basicos']['UTM'])){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['ImpuestoRenta'] = ($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['RentaAfecta'] * $imp_renta['Tasa'])-($_SESSION['fact_sueldos_basicos']['UTM'] * $imp_renta['Rebaja']);
						}
						
					}
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['ImpuestoRenta'];
						
					//Calculo de los otros descuentos
					if(!empty($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Anticipo'])){
						foreach ($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Anticipo'] as $key => $producto){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] + $producto['Monto'];
						}
					}
					if(!empty($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Cuotas'])){
						foreach ($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Cuotas'] as $key => $producto){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] + $producto['monto_cuotas'];
						}
					}
					
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalAPagar'] = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalAPagar'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalHaberes'] - $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'];
					
					
					/***********************************************************/
					/*                    No Guardables                        */
					/***********************************************************/
					//Datos del trabajador
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TrabajadorNombre']    = $trab['ApellidoPat'].' '.$trab['ApellidoMat'].' '.$trab['Nombre'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TrabajadorRut']       = $trab['Rut'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TrabajadorEmail']     = $trab['email'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TrabajadorContrato']  = $trab['F_Inicio_Contrato'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TrabajadorCargo']     = $trab['Cargo'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SistemaNombre']       = $trab['SistemaNombre'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SistemaRut']          = $trab['SistemaRut'];
					


				}				
				
				
				
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
			
	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['fact_sueldos_basicos']);
			unset($_SESSION['fact_sueldos_sueldos']);
			unset($_SESSION['fact_sueldos_temporal']);
				
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['fact_sueldos_archivos'])){
				foreach ($_SESSION['fact_sueldos_archivos'] as $key => $producto){
					try {
						if(!is_writable('upload/'.$producto['Nombre'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$producto['Nombre']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
			}
			unset($_SESSION['fact_sueldos_archivos']);

			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'modBase_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			$ndata_3 = 0;
			$ndata_4 = 0;
			$ndata_5 = 0;
			//Consulto los nombres y los sueldos de los trabajadores
			$arrTrabajador = array();
			$query = "SELECT idTipoContratoTrab, idTipoContrato, horas_pactadas, idAFP, idSalud
			FROM `trabajadores_listado`
			WHERE idEstado = 1";
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
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrTrabajador,$row );
			}
			//verificacion de errores
			foreach ($arrTrabajador as $trab) {
				if(isset($trab['idTipoContratoTrab'])&&$trab['idTipoContratoTrab']==0){  $ndata_1++;}
				if(isset($trab['idTipoContrato'])&&$trab['idTipoContrato']==0){          $ndata_2++;}
				if(isset($trab['horas_pactadas'])&&$trab['horas_pactadas']==0){          $ndata_3++;}
				if(isset($trab['idAFP'])&&$trab['idAFP']==0){                            $ndata_4++;}
				if(isset($trab['idSalud'])&&$trab['idSalud']==0){                        $ndata_5++;}
			}
			
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/Uno o mas trabajadores no tiene configurado el tipo de contrato';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/Uno o mas trabajadores no tiene configurado el tipo de contrato';}
			if($ndata_3 > 0) {$error['ndata_3'] = 'error/Uno o mas trabajadores no tiene configurado las horas pactadas';}
			if($ndata_4 > 0) {$error['ndata_4'] = 'error/Uno o mas trabajadores no tiene configurado la AFP';}
			if($ndata_5 > 0) {$error['ndata_5'] = 'error/Uno o mas trabajadores no tiene configurado la Salud';}
			/*******************************************************************/
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['fact_sueldos_temporal']);
				//Elimino los datos por seguridad
				unset($_SESSION['fact_sueldos_sueldos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['fact_sueldos_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['fact_sueldos_basicos']['Fecha_desde']      = $Fecha_desde;
				$_SESSION['fact_sueldos_basicos']['Fecha_hasta']      = $Fecha_hasta;
				$_SESSION['fact_sueldos_basicos']['idSistema']        = $idSistema;
				$_SESSION['fact_sueldos_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['fact_sueldos_basicos']['fecha_auto']       = $fecha_auto;
				$_SESSION['fact_sueldos_basicos']['Observaciones']    = $Observaciones;
				$_SESSION['fact_sueldos_basicos']['UF']               = $UF;
				$_SESSION['fact_sueldos_basicos']['UTM']              = $UTM;
				$_SESSION['fact_sueldos_basicos']['IMM']              = $IMM;
				$_SESSION['fact_sueldos_basicos']['TopeImpAFP']       = $TopeImpAFP;
				$_SESSION['fact_sueldos_basicos']['TopeImpIPS']       = $TopeImpIPS;
				$_SESSION['fact_sueldos_basicos']['TopeSegCesantia']  = $TopeSegCesantia;
				$_SESSION['fact_sueldos_basicos']['TopeAPVMensual']   = $TopeAPVMensual;
				$_SESSION['fact_sueldos_basicos']['TopeDepConv']      = $TopeDepConv;
				
				//Consulto los nombres y los sueldos de los trabajadores
				// Se trae un listado con todos los usuarios
				$arrTrabajador = array();
				$query = "SELECT 
				trabajadores_listado.idTrabajador,
				trabajadores_listado.idTipoContratoTrab,
				trabajadores_listado.idTipoTrabajador,
				trabajadores_listado.idTipoContrato,
				trabajadores_listado.SueldoLiquido,
				trabajadores_listado.SueldoDia,
				trabajadores_listado.SueldoHora,
				trabajadores_listado.Gratificacion,
				trabajadores_listado.horas_pactadas,
				trabajadores_listado.email,

				trabajadores_listado.Nombre, 
				trabajadores_listado.ApellidoPat, 
				trabajadores_listado.ApellidoMat,
				trabajadores_listado.Rut,
				trabajadores_listado.F_Inicio_Contrato,
				trabajadores_listado.Cargo,

				sistema_afp.idAFP AS AFP_idAFP,
				sistema_afp.Nombre AS AFP_Nombre,
				sistema_afp.PorcentajeDependiente AS AFP_PorcentajeDep,
				sistema_afp.PorcentajeIndependiente AS AFP_PorcentajeIndep,
				sistema_afp.IPS AS AFP_IPS,

				sistema_salud.idSalud AS Salud_idAFP,
				sistema_salud.Nombre AS Salud_Nombre,
				sistema_salud.Porcentaje AS Salud_Porcentaje,

				core_sistemas.Nombre AS SistemaNombre,
				core_sistemas.Rut AS SistemaRut,

				(SELECT COUNT(idCarga) AS Cantidad FROM `trabajadores_listado_cargas` WHERE idEstado = 1 AND idTrabajador = trabajadores_listado.idTrabajador) AS N_cargas,

				trabajadores_listado_tipos.Nombre AS TipoTrabajador

				FROM `trabajadores_listado`
				LEFT JOIN `trabajadores_listado_tipos`    ON trabajadores_listado_tipos.idTipo   = trabajadores_listado.idTipo
				LEFT JOIN `sistema_afp`                   ON sistema_afp.idAFP                   = trabajadores_listado.idAFP
				LEFT JOIN `sistema_salud`                 ON sistema_salud.idSalud               = trabajadores_listado.idSalud
				LEFT JOIN `core_sistemas`                 ON core_sistemas.idSistema               = trabajadores_listado.idSistema

				WHERE trabajadores_listado.idEstado = 1
				ORDER BY trabajadores_listado.ApellidoPat ASC, 
				trabajadores_listado.ApellidoMat ASC,
				trabajadores_listado.Nombre ASC";
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrTrabajador,$row );
				}
				/************************************/
				//Inasistencias
				$arrInasistenciaDias = array();
				$query = "SELECT idTrabajador, COUNT(idTrabajador)AS Cuenta
				FROM `trabajadores_inasistencias_dias`
				WHERE idUso=1 AND Creacion_fecha BETWEEN '".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."' AND '".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'
				GROUP BY idTrabajador
				ORDER BY idTrabajador ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrInasistenciaDias,$row );
				}
				//Dias de inasistencia
				foreach ($arrInasistenciaDias as $inasis) {
					$_SESSION['fact_sueldos_sueldos'][$inasis['idTrabajador']]['diasInasistencia'] = $inasis['Cuenta'];
				}
				/************************************/
				//Licencias
				$arrLicencias = array();
				$query = "SELECT idTrabajador, SUM(N_Dias)AS Cuenta
				FROM `trabajadores_licencias`
				WHERE idUso=1 AND Fecha_inicio BETWEEN '".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."' AND '".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'
				GROUP BY idTrabajador
				ORDER BY idTrabajador ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrLicencias,$row );
				}
				//Licencias
				foreach ($arrLicencias as $lic) {
					$_SESSION['fact_sueldos_sueldos'][$lic['idTrabajador']]['diasLicencias'] = $lic['Cuenta'];
				}
				/************************************/
				//Bonos Fijos
				$arrBonoFijo = array();
				$query = "SELECT 
				trabajadores_listado_bonos_fijos.idBonoFijo,
				trabajadores_listado_bonos_fijos.idTrabajador,
				trabajadores_listado_bonos_fijos.Monto,
				sistema_bonos_fijos.Nombre,
				sistema_bonos_fijos.idTipo

				FROM `trabajadores_listado_bonos_fijos`
				LEFT JOIN `sistema_bonos_fijos` ON sistema_bonos_fijos.idBonoFijo = trabajadores_listado_bonos_fijos.idBonoFijo
				ORDER BY trabajadores_listado_bonos_fijos.idTrabajador ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrBonoFijo,$row );
				}
				//Bonos Fijos
				foreach ($arrBonoFijo as $bono) {
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoFijo'][$bono['idBonoFijo']]['idBonoFijo']  = $bono['idBonoFijo'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoFijo'][$bono['idBonoFijo']]['BonoNombre']  = $bono['Nombre'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoFijo'][$bono['idBonoFijo']]['BonoMonto']   = $bono['Monto'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoFijo'][$bono['idBonoFijo']]['BonoTipo']    = $bono['idTipo'];
				}
				/************************************/
				//Bonos por turnos
				$arrBonoTurno = array();
				$query = "SELECT 
				trabajadores_horas_extras_facturacion_turnos.idServicios,
				trabajadores_horas_extras_facturacion_turnos.idTrabajador,
				trabajadores_horas_extras_facturacion_turnos.idTurnos,
				core_horas_extras_turnos.Nombre,
				core_horas_extras_turnos.Valor

				FROM `trabajadores_horas_extras_facturacion_turnos`
				LEFT JOIN `core_horas_extras_turnos` ON core_horas_extras_turnos.idTurnos = trabajadores_horas_extras_facturacion_turnos.idTurnos
				WHERE trabajadores_horas_extras_facturacion_turnos.idUso=1 AND trabajadores_horas_extras_facturacion_turnos.Creacion_fecha BETWEEN '".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."' AND '".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'
				ORDER BY trabajadores_horas_extras_facturacion_turnos.idTrabajador ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrBonoTurno,$row );
				}
				//Bonos por turnos
				foreach ($arrBonoTurno as $bono) {
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoTurno'][$bono['idTurnos']]['idServicios']  = $bono['idServicios'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoTurno'][$bono['idTurnos']]['idTurnos']     = $bono['idTurnos'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoTurno'][$bono['idTurnos']]['BonoNombre']   = $bono['Nombre'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoTurno'][$bono['idTurnos']]['BonoMonto']    = $bono['Valor'];
				}
				/************************************/
				//Bonos Temporales
				$arrBonoTemporal = array();
				$query = "SELECT 
				trabajadores_bonos_temporales.idBonoTemporal,
				trabajadores_bonos_temporales.idTrabajador,
				trabajadores_bonos_temporales.Monto,
				sistema_bonos_temporales.Nombre,
				sistema_bonos_temporales.idTipo

				FROM `trabajadores_bonos_temporales`
				LEFT JOIN `sistema_bonos_temporales` ON sistema_bonos_temporales.idBonoTemporal = trabajadores_bonos_temporales.idBonoTemporal
				WHERE trabajadores_bonos_temporales.idUso=1 AND trabajadores_bonos_temporales.Creacion_fecha BETWEEN '".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."' AND '".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'
				ORDER BY trabajadores_bonos_temporales.idTrabajador ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrBonoTemporal,$row );
				}
				//Bonos Temporales
				foreach ($arrBonoTemporal as $bono) {
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoTemporal'][$bono['idBonoTemporal']]['idBonoTemporal']  = $bono['idBonoTemporal'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoTemporal'][$bono['idBonoTemporal']]['BonoNombre']      = $bono['Nombre'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoTemporal'][$bono['idBonoTemporal']]['BonoMonto']       = $bono['Monto'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['BonoTemporal'][$bono['idBonoTemporal']]['BonoTipo']        = $bono['idTipo'];
				}
				/************************************/
				//Horas Extras
				$arrHorasExtras = array();
				$query = "SELECT 
				trabajadores_horas_extras_mensuales_facturacion_horas.idTrabajador,
				trabajadores_horas_extras_mensuales_facturacion_horas.idPorcentaje,
				core_horas_extras_porcentajes.Porcentaje,
				trabajadores_listado.idTipoContratoTrab,
				trabajadores_listado.horas_pactadas,
				trabajadores_listado.SueldoLiquido,
				trabajadores_listado.SueldoDia,
				trabajadores_listado.SueldoHora,
				SUM(trabajadores_horas_extras_mensuales_facturacion_horas.N_Horas) AS Horas

				FROM `trabajadores_horas_extras_mensuales_facturacion_horas`
				LEFT JOIN `core_horas_extras_porcentajes`   ON core_horas_extras_porcentajes.idPorcentaje  = trabajadores_horas_extras_mensuales_facturacion_horas.idPorcentaje
				LEFT JOIN `trabajadores_listado`            ON trabajadores_listado.idTrabajador           = trabajadores_horas_extras_mensuales_facturacion_horas.idTrabajador

				WHERE trabajadores_horas_extras_mensuales_facturacion_horas.idUso=1 AND trabajadores_horas_extras_mensuales_facturacion_horas.Creacion_fecha BETWEEN '".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."' AND '".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'
				GROUP BY trabajadores_horas_extras_mensuales_facturacion_horas.idTrabajador, trabajadores_horas_extras_mensuales_facturacion_horas.idPorcentaje
				ORDER BY trabajadores_horas_extras_mensuales_facturacion_horas.idTrabajador ASC, trabajadores_horas_extras_mensuales_facturacion_horas.idPorcentaje ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrHorasExtras,$row );
				}
				//Horas Extras
				foreach ($arrHorasExtras as $bono) {
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['idPorcentaje']   = $bono['idPorcentaje'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['Porcentaje']     = $bono['Porcentaje'];
					$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['N_Horas']        = $bono['Horas'];

					switch ($bono['idTipoContratoTrab']) {
						//Trabajador con sueldo mensual
						case 1:
							$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['ValorHora'] = $bono['SueldoLiquido']*((7/30)/$bono['horas_pactadas']*((100+$bono['Porcentaje'])/100));
							$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['TotalHora'] = ($bono['SueldoLiquido']*((7/30)/$bono['horas_pactadas']*((100+$bono['Porcentaje'])/100)))*$bono['Horas'];
						break;
						//Trabajador con sueldo semanal
						case 2:
							$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['ValorHora'] = $bono['SueldoLiquido']*((7/7)/$bono['horas_pactadas']*((100+$bono['Porcentaje'])/100));
							$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['TotalHora'] = ($bono['SueldoLiquido']*((7/7)/$bono['horas_pactadas']*((100+$bono['Porcentaje'])/100)))*$bono['Horas'];
						break;
						//Trabajador con sueldo diario (jornada semanal de 5 días)
						case 3:
							$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['ValorHora'] =  $bono['SueldoDia']*((0.5)/$bono['horas_pactadas']*((100+$bono['Porcentaje'])/100));
							$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['TotalHora'] = ($bono['SueldoDia']*((0.5)/$bono['horas_pactadas']*((100+$bono['Porcentaje'])/100)))*$bono['Horas'];
						break;
						//Trabajador con sueldo diario (jornada semanal de 6 días)
						case 4:
							$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['ValorHora'] = $bono['SueldoDia']*((0.6)/$bono['horas_pactadas']*((100+$bono['Porcentaje'])/100));
							$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['TotalHora'] = ($bono['SueldoDia']*((0.6)/$bono['horas_pactadas']*((100+$bono['Porcentaje'])/100)))*$bono['Horas'];
						break;
						//Trabajador con sueldo por hora
						case 5:
							$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['ValorHora'] = $trab['SueldoHora'];
							$_SESSION['fact_sueldos_sueldos'][$bono['idTrabajador']]['HorasExtras'][$bono['idPorcentaje']]['TotalHora'] = $trab['SueldoHora']*$bono['Horas'];
						break;
						

						
					}

				}
				/************************************/
				//Valor de las cargas familiares
				$arrTablaCargas = array();
				$query = "SELECT idTablaCarga, Tramo, Valor_Desde, Valor_Hasta, Valor_Pago
				FROM `sistema_rrhh_tabla_carga_familiar`
				ORDER BY idTablaCarga ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrTablaCargas,$row );
				}
				/************************************/
				//Valor de las cargas familiares
				$arrSeguro = array();
				$query = "SELECT idTipoContrato,Porc_Empleador,Porc_Trabajador
				FROM `sistema_rrhh_tabla_seguro_cesantia`
				ORDER BY idTablaSeguro ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrSeguro,$row );
				}
				/************************************/
				//Valor de las cargas familiares
				$arrImpuestoRenta = array();
				$query = "SELECT UTM_Desde, UTM_Hasta, Tasa, Rebaja
				FROM `sistema_rrhh_tabla_iusc`
				ORDER BY idTablaImpuesto ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrImpuestoRenta,$row );
				}
				/************************************/
				//Bonos Fijos
				$arrDescuentoFijo = array();
				$query = "SELECT 
				trabajadores_listado_descuentos_fijos.idDescuentoFijo,
				trabajadores_listado_descuentos_fijos.idTrabajador,
				trabajadores_listado_descuentos_fijos.Monto,
				sistema_descuentos_fijos.Nombre,
				trabajadores_listado_descuentos_fijos.idAFP,
				sistema_afp.Nombre AS AFP

				FROM `trabajadores_listado_descuentos_fijos`
				LEFT JOIN `sistema_descuentos_fijos` ON sistema_descuentos_fijos.idDescuentoFijo = trabajadores_listado_descuentos_fijos.idDescuentoFijo
				LEFT JOIN `sistema_afp`              ON sistema_afp.idAFP                        = trabajadores_listado_descuentos_fijos.idAFP
				ORDER BY trabajadores_listado_descuentos_fijos.idTrabajador ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrDescuentoFijo,$row );
				}
				//Bonos Fijos
				foreach ($arrDescuentoFijo as $desc) {
					//Verifico si alguno de los descuentos es superior
					//APV
					if($desc['idDescuentoFijo']==1){
						//Si el monto establecido es inferior al tope
						if($desc['Monto']<=$_SESSION['fact_sueldos_basicos']['TopeAPVMensual']){
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['idDescuentoFijo']  = $desc['idDescuentoFijo'];
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoNombre']  = $desc['Nombre'].' ('.$desc['AFP'].')';
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoMonto']   = $desc['Monto'];
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoIDAFP']   = $desc['idAFP'];
						//si es superior al tope se asigna el tope
						}elseif($desc['Monto']>$_SESSION['fact_sueldos_basicos']['TopeAPVMensual']){
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['idDescuentoFijo']  = $desc['idDescuentoFijo'];
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoNombre']  = $desc['Nombre'].' ('.$desc['AFP'].')';
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoMonto']   = $_SESSION['fact_sueldos_basicos']['TopeAPVMensual'];
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoIDAFP']   = $desc['idAFP'];
						}
					//Deposito Convenido	
					}elseif($desc['idDescuentoFijo']==2){
						//Si el monto establecido es inferior al tope
						if($desc['Monto']<=$_SESSION['fact_sueldos_basicos']['TopeDepConv']){
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['idDescuentoFijo']  = $desc['idDescuentoFijo'];
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoNombre']  = $desc['Nombre'].' ('.$desc['AFP'].')';
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoMonto']   = $desc['Monto'];
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoIDAFP']   = $desc['idAFP'];
						//si es superior al tope se asigna el tope
						}elseif($desc['Monto']>$_SESSION['fact_sueldos_basicos']['TopeDepConv']){
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['idDescuentoFijo']  = $desc['idDescuentoFijo'];
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoNombre']  = $desc['Nombre'].' ('.$desc['AFP'].')';
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoMonto']   = $_SESSION['fact_sueldos_basicos']['TopeDepConv'];
							$_SESSION['fact_sueldos_sueldos'][$desc['idTrabajador']]['DescuentoFijo'][$desc['idDescuentoFijo']]['DescuentoIDAFP']   = $desc['idAFP'];
						}
					}

				}
				/************************************/
				//Anticipos
				$arrAnticipos = array();
				$query = "SELECT idAnticipos, Creacion_fecha, idTrabajador, Monto
				FROM `trabajadores_descuentos_anticipos`
				WHERE idUso=1 AND Creacion_fecha BETWEEN '".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."' AND '".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'
				ORDER BY idTrabajador ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrAnticipos,$row );
				}
				//Anticipos
				foreach ($arrAnticipos as $anticipo) {
					$_SESSION['fact_sueldos_sueldos'][$anticipo['idTrabajador']]['Anticipo'][$anticipo['idAnticipos']]['Creacion_fecha']  = $anticipo['Creacion_fecha'];
					$_SESSION['fact_sueldos_sueldos'][$anticipo['idTrabajador']]['Anticipo'][$anticipo['idAnticipos']]['Monto']           = $anticipo['Monto'];
				}
				/************************************/
				//Descuento Cuota
				$arrDescuentoCuota = array();
				$query = "SELECT 
				trabajadores_descuentos_cuotas_listado.idCuotas, 
				trabajadores_descuentos_cuotas_listado.idTrabajador, 
				trabajadores_descuentos_cuotas_listado.Fecha, 
				trabajadores_descuentos_cuotas_listado.nCuota, 
				trabajadores_descuentos_cuotas_listado.TotalCuotas, 
				trabajadores_descuentos_cuotas_listado.monto_cuotas,
				trabajadores_descuentos_cuotas_tipos.Nombre AS Tipo

				FROM `trabajadores_descuentos_cuotas_listado`
				LEFT JOIN `trabajadores_descuentos_cuotas`        ON trabajadores_descuentos_cuotas.idFacturacion  = trabajadores_descuentos_cuotas_listado.idFacturacion
				LEFT JOIN `trabajadores_descuentos_cuotas_tipos`  ON trabajadores_descuentos_cuotas_tipos.idTipo   = trabajadores_descuentos_cuotas.idTipo
				WHERE trabajadores_descuentos_cuotas_listado.idUso=1 AND trabajadores_descuentos_cuotas_listado.Fecha BETWEEN '".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."' AND '".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'
				ORDER BY trabajadores_descuentos_cuotas_listado.idTrabajador ASC" ;
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrDescuentoCuota,$row );
				}
				//Descuento Cuota
				foreach ($arrDescuentoCuota as $cuota) {
					$_SESSION['fact_sueldos_sueldos'][$cuota['idTrabajador']]['Cuotas'][$cuota['idCuotas']]['Fecha']         = $cuota['Fecha'];
					$_SESSION['fact_sueldos_sueldos'][$cuota['idTrabajador']]['Cuotas'][$cuota['idCuotas']]['nCuota']        = $cuota['nCuota'];
					$_SESSION['fact_sueldos_sueldos'][$cuota['idTrabajador']]['Cuotas'][$cuota['idCuotas']]['TotalCuotas']   = $cuota['TotalCuotas'];
					$_SESSION['fact_sueldos_sueldos'][$cuota['idTrabajador']]['Cuotas'][$cuota['idCuotas']]['monto_cuotas']  = $cuota['monto_cuotas'];
					$_SESSION['fact_sueldos_sueldos'][$cuota['idTrabajador']]['Cuotas'][$cuota['idCuotas']]['Tipo']          = $cuota['Tipo'];
				}




				/************************************/
				//Recorro y guardo los datos
				foreach ($arrTrabajador as $trab) {
					/***********************************************************/
					/*                     Guardables                          */
					/***********************************************************/
					//Trabajador
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['idTrabajador'] = $trab['idTrabajador'];
					//Tipo Contrato
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['idTipoContratoTrab']   = $trab['idTipoContratoTrab'];
					//Horas por semana pactado
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['horas_pactadas']   = $trab['horas_pactadas'];
					//Gratificacion
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Gratificacion']   = $trab['Gratificacion'];
					
					switch ($trab['idTipoContratoTrab']) {
						//Trabajador con sueldo mensual - 
						case 1:
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TipoContratoTrab'] = 'Sueldo Mensual';
						break;
						//Trabajador con sueldo semanal
						case 2:
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TipoContratoTrab'] = 'Sueldo Semanal';
						break;
						//Trabajador con sueldo diario (jornada semanal de 5 días)
						case 3:
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TipoContratoTrab'] = 'Sueldo Diario (jornada semanal de 5 días)';
						break;
						//Trabajador con sueldo diario (jornada semanal de 6 días)
						case 4:
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TipoContratoTrab'] = 'Sueldo Diario (jornada semanal de 6 días)';
						break;
						//Trabajador con sueldo por hora
						case 5:
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TipoContratoTrab'] = 'Sueldo por hora';
						break;
					}
					
					

					/************************************************************************************************/
					/*                                            Haberes                                           */
					/************************************************************************************************/
					//Sueldo y dias pactados
					switch ($trab['idTipoContratoTrab']) {
						//Trabajador con sueldo mensual
						case 1:
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoPactado']  = $trab['SueldoLiquido'];
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasPactados']   = 30;
						break;
						//Trabajador con sueldo semanal
						case 2:
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoPactado']  = $trab['SueldoLiquido'];
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasPactados']   = 7;
						break;
						//Trabajador con sueldo diario (jornada semanal de 5 días)
						case 3:
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoPactado']  = $trab['SueldoDia'];
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasPactados']   = 5;
						break;
						//Trabajador con sueldo diario (jornada semanal de 6 días)
						case 4:
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoPactado']  = $trab['SueldoDia'];
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasPactados']   = 6;
						break;
						//Trabajador con sueldo por hora
						case 5:
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoPactado']  = $trab['SueldoHora'];
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasPactados']   = 1;
						break;
					}
					//Dias trabajados
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasTrabajados'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasPactados'];
					if(isset($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['diasInasistencia'])){$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasTrabajados'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasTrabajados'] - $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['diasInasistencia'];}
					if(isset($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['diasLicencias'])){$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasTrabajados'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasTrabajados'] - $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['diasLicencias'];}
					//Calculo del base a pagar
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoPagado'] = ($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasTrabajados']/$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DiasPactados'])*$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoPactado'];
					//Calculo Total Bonos Fijos(100 tipos bonos estimados en el sistema)
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoFijoAfecto']   = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoFijoNoAfecto'] = 0;
					for ($x = 0; $x <= 100; $x++) {
						//verifico si existe y si esta afecto a descuentos
						if(isset($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoFijo'][$x]['BonoTipo'])&&$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoFijo'][$x]['BonoTipo']==1){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoFijoAfecto'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoFijoAfecto'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoFijo'][$x]['BonoMonto'];
						//verifico si existe y si esta no afecto a descuentos
						}elseif(isset($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoFijo'][$x]['BonoTipo'])&&$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoFijo'][$x]['BonoTipo']==2){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoFijoNoAfecto'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoFijoNoAfecto'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoFijo'][$x]['BonoMonto'];
						}
					}
					//Calculo Total Bonos por turno (6 maximo)
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTurno']   = 0;
					for ($x = 0; $x <= 6; $x++) {
						//verifico si existe y si esta afecto a descuentos
						if(isset($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoTurno'][$x]['BonoMonto'])&&$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoTurno'][$x]['BonoMonto']!=0){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTurno'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTurno'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoTurno'][$x]['BonoMonto'];
						}
					}  
					//Calculo Total Bonos Temporales(100  bonos estimados en el sistema)
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTemporalAfecto']   = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTemporalNoAfecto'] = 0;
					for ($x = 0; $x <= 100; $x++) {
						//verifico si existe y si esta afecto a descuentos
						if(isset($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoTemporal'][$x]['BonoTipo'])&&$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoTemporal'][$x]['BonoTipo']==1){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTemporalAfecto'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTemporalAfecto'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoTemporal'][$x]['BonoMonto'];
						//verifico si existe y si esta no afecto a descuentos
						}elseif(isset($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoTemporal'][$x]['BonoTipo'])&&$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoTemporal'][$x]['BonoTipo']==2){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTemporalNoAfecto'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTemporalNoAfecto'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['BonoTemporal'][$x]['BonoMonto'];
						}
					}
					//Calculo Total Bonos Temporales(100  bonos estimados en el sistema)
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalHorasExtras']   = 0;
					for ($x = 0; $x <= 31; $x++) {
						if(isset($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['HorasExtras'][$x]['N_Horas'])&&$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['HorasExtras'][$x]['N_Horas']!=0){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalHorasExtras']   = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalHorasExtras'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['HorasExtras'][$x]['TotalHora'];	
						}
					}
					//Calculo de las cargas familiares
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Cargas_n']              = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Cargas_valor']          = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Cargas_idTramo']        = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Cargas_tramo']          = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalCargasFamiliares'] = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Cargas_n']              = $trab['N_cargas'];
					//Recorro la tabla para establecer el valor de la carga familiar
					foreach ($arrTablaCargas as $tabla) {
						if($tabla['Valor_Desde']<=$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoPactado']&&$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoPactado']<=$tabla['Valor_Hasta']){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Cargas_idTramo']        = $tabla['idTablaCarga'];
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Cargas_valor']          = $tabla['Valor_Pago'];
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Cargas_tramo']          = $tabla['Tramo'];
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalCargasFamiliares'] = $tabla['Valor_Pago']*$trab['N_cargas'];
						}
					}
					
					//Calculo del Sueldo imponible
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoPagado'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Gratificacion'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoFijoAfecto'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTurno'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTemporalAfecto'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalHorasExtras'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalCargasFamiliares'];
					
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoNoImponible'] = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoNoImponible'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoNoImponible'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoFijoNoAfecto'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoNoImponible'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoNoImponible'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalBonoTemporalNoAfecto'];
					
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalHaberes'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoNoImponible'];
					/************************************************************************************************/
					/*                                            Deberes                                           */
					/************************************************************************************************/
					//Se verifica el tipo de sistema previsional en el que esta
					//Si esta en AFP
					if($trab['AFP_IPS']==0){
						//Verifico si es un trabajador dependiente
						if($trab['idTipoTrabajador']==1){
							$AFPPorcentaje = $trab['AFP_PorcentajeDep'];
						//Verifico si es un trabajador independiente
						}elseif($trab['idTipoTrabajador']==2){
							$AFPPorcentaje = $trab['AFP_PorcentajeIndep'];
						}
						
						//Se establece el sueldo imponible Maximo
						if($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible']<=$_SESSION['fact_sueldos_basicos']['TopeImpAFP']){
							$Sueldo_Imp = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'];
						}else{
							$Sueldo_Imp = $_SESSION['fact_sueldos_basicos']['TopeImpAFP'];
						}
						
						
					//Si esta en el IPS	
					}elseif($trab['AFP_IPS']==1){
						//Verifico si es un trabajador dependiente
						if($trab['idTipoTrabajador']==1){
							$AFPPorcentaje = $trab['AFP_PorcentajeDep'];
						//Verifico si es un trabajador independiente
						}elseif($trab['idTipoTrabajador']==2){
							$AFPPorcentaje = $trab['AFP_PorcentajeIndep'];
						}
						
						//Se establece el sueldo imponible Maximo
						if($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible']<=$_SESSION['fact_sueldos_basicos']['TopeImpIPS']){
							$Sueldo_Imp = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'];
						}else{
							$Sueldo_Imp = $_SESSION['fact_sueldos_basicos']['TopeImpIPS'];
						}
						
					}

					//Se guardan las imposiciones
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['AFP_idAFP']      = $trab['AFP_idAFP'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['AFP_Nombre']     = $trab['AFP_Nombre'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['AFP_Porcentaje'] = $AFPPorcentaje;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['AFP_Total']      = ($Sueldo_Imp/100)*$AFPPorcentaje;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['AFP_SIS']        = ($Sueldo_Imp/100)*1.53;;
					
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Salud_idAFP']      = $trab['Salud_idAFP'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Salud_Nombre']     = $trab['Salud_Nombre'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Salud_Porcentaje'] = $trab['Salud_Porcentaje'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Salud_Total']      = ($Sueldo_Imp/100)*$trab['Salud_Porcentaje'];
					
					//Se suman todos los descuentos
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Salud_Total'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['AFP_Total'];
					
					//Calculo Total Bonos Fijos(100 tipos bonos estimados en el sistema)
					for ($x = 0; $x <= 100; $x++) {
						//verifico si existe
						if(isset($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DescuentoFijo'][$x]['DescuentoMonto'])){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['DescuentoFijo'][$x]['DescuentoMonto'];
						}
					}
					

					//Recorro la tabla para establecer el valor del seguro de cesantia
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SegCesantia_Empleador']  = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SegCesantia_Trabajador'] = 0;
					foreach ($arrSeguro as $seguro) {
						//Si el seguro es el mismo
						if($trab['idTipoContrato']==$seguro['idTipoContrato']){
							if($Sueldo_Imp<$_SESSION['fact_sueldos_basicos']['TopeSegCesantia']){
								$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SegCesantia_Empleador']  =($Sueldo_Imp/100)*$seguro['Porc_Empleador'];
								$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SegCesantia_Trabajador'] =($Sueldo_Imp/100)*$seguro['Porc_Trabajador'];
							}else{
								$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SegCesantia_Empleador']  =($_SESSION['fact_sueldos_basicos']['TopeSegCesantia']/100)*$seguro['Porc_Empleador'];
								$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SegCesantia_Trabajador'] =($_SESSION['fact_sueldos_basicos']['TopeSegCesantia']/100)*$seguro['Porc_Trabajador'];
							}
						}	
					}
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SegCesantia_Trabajador'];
					
					//Calculo del impuesto a la renta
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['ImpuestoRenta'] = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['RentaAfecta'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SueldoImponible'] - $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'];
					foreach ($arrImpuestoRenta as $imp_renta) {
						//Verifico si el sueldo afecto esta dentro de los limites
						if(($imp_renta['UTM_Desde'] * $_SESSION['fact_sueldos_basicos']['UTM'])<=$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['RentaAfecta']&&$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['RentaAfecta']<=($imp_renta['UTM_Hasta'] * $_SESSION['fact_sueldos_basicos']['UTM'])){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['ImpuestoRenta'] = ($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['RentaAfecta'] * $imp_renta['Tasa'])-($_SESSION['fact_sueldos_basicos']['UTM'] * $imp_renta['Rebaja']);
						}
						
					}
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] + $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['ImpuestoRenta'];
						
					//Calculo de los otros descuentos
					if(!empty($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Anticipo'])){
						foreach ($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Anticipo'] as $key => $producto){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] + $producto['Monto'];
						}
					}
					if(!empty($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Cuotas'])){
						foreach ($_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['Cuotas'] as $key => $producto){
							$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'] + $producto['monto_cuotas'];
						}
					}
					
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalAPagar'] = 0;
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalAPagar'] = $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalHaberes'] - $_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TotalDescuentos'];
					
					
					/***********************************************************/
					/*                    No Guardables                        */
					/***********************************************************/
					//Datos del trabajador
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TrabajadorNombre']    = $trab['ApellidoPat'].' '.$trab['ApellidoMat'].' '.$trab['Nombre'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TrabajadorRut']       = $trab['Rut'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TrabajadorEmail']     = $trab['email'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TrabajadorContrato']  = $trab['F_Inicio_Contrato'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['TrabajadorCargo']     = $trab['Cargo'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SistemaNombre']       = $trab['SistemaNombre'];
					$_SESSION['fact_sueldos_sueldos'][$trab['idTrabajador']]['SistemaRut']          = $trab['SistemaRut'];
					


				}
				
				header( 'Location: '.$location.'&view=true' );
				die;
			}
			
	
		break;	

/*******************************************************************************************************************/	
	
		case 'del_trab':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['fact_sueldos_sueldos'][$_GET['del_trab']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;
		
		break;	
/*******************************************************************************************************************/		
		case 'add_obs':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$Observaciones      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observaciones)){  $error['Observaciones']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['fact_sueldos_basicos']['Observaciones'] = $Observaciones;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
			
		break;		
/*******************************************************************************************************************/		
		case 'del_obs':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['fact_sueldos_temporal'] = $_SESSION['fact_sueldos_basicos']['Observaciones'];
			$_SESSION['fact_sueldos_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_file':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se inicializa variable
			$idInterno = 0;
			
			//verificar la cantidad de trabajos
			if(isset($_SESSION['fact_sueldos_archivos'])){
				foreach ($_SESSION['fact_sueldos_archivos'] as $key => $trabajos){
					if($idInterno<$trabajos['idFile']){$idInterno = $trabajos['idFile'];}
				}
			}
			
			if ( empty($error) ) {
				
				
				//Se verifica 
				if(isset($_FILES["exFile"])){
					if ($_FILES["exFile"]["error"] > 0){ 
						$error['exFile']     = 'error/Ha ocurrido un error'; 
					} else {
						//Se verifican las extensiones de los archivos
						$permitidos = array("application/msword",
											"application/vnd.ms-word",
											"application/vnd.openxmlformats-officedocument.wordprocessingml.document", 
									
											"application/msexcel",
											"application/vnd.ms-excel",
											"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
											
											"application/mspowerpoint",
											"application/vnd.ms-powerpoint",
											"application/vnd.openxmlformats-officedocument.presentationml.presentation",
											
											"application/pdf",
											"application/octet-stream",
											"application/x-real",
											"application/vnd.adobe.xfdf",
											"application/vnd.fdf",
											"binary/octet-stream",
											
											"image/jpg", 
											"image/jpeg", 
											"image/gif", 
											"image/png"

											);
						//Se verifica que el archivo subido no exceda los 100 kb
						$limite_kb = 10000;
						//Sufijo
						$sufijo = 'sueldo_fact_'.fecha_actual().'_';
					  
						if (in_array($_FILES['exFile']['type'], $permitidos) && $_FILES['exFile']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['exFile']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$move_result = @move_uploaded_file($_FILES["exFile"]["tmp_name"], $ruta);
								if ($move_result){
									
									//se guarda en el indice siguiente
									$idInterno = $idInterno+1;
									//Se guarda el trabajo asignado
									$_SESSION['fact_sueldos_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['fact_sueldos_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
									header( 'Location: '.$location.'&view=true' );
									die;
			
								} else {
									$error['exFile']     = 'error/Ocurrio un error al mover el archivo'; 
								}
							} else {
								$error['exFile']     = 'error/El archivo '.$_FILES['exFile']['name'].' ya existe'; 
							}
						} else {
							$error['exFile']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}				
				}	
				
			}

		break;	
		
/*******************************************************************************************************************/
		case 'del_file':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			try {
				if(!is_writable('upload/'.$_SESSION['fact_sueldos_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['fact_sueldos_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['fact_sueldos_archivos'][$_GET['del_file']]);
				}
			}catch(Exception $e) { 
					//guardar el dato en un archivo log
			}
			
			//Redirijo			
			header( 'Location: '.$location.'&view=true' );
			die;


		break;
/*******************************************************************************************************************/		
		case 'ing_sueldo':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			/*********************************************************************/
			//variables
			$n_data1 = 0;
			$n_data2 = 0;
			
			//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['fact_sueldos_basicos'])){
				if(!isset($_SESSION['fact_sueldos_basicos']['idSistema']) or $_SESSION['fact_sueldos_basicos']['idSistema']=='' ){               $error['idSistema']         = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['fact_sueldos_basicos']['idUsuario']) or $_SESSION['fact_sueldos_basicos']['idUsuario']=='' ){               $error['idUsuario']         = 'error/No ha seleccionado el usuario';}
				if(!isset($_SESSION['fact_sueldos_basicos']['fecha_auto']) or $_SESSION['fact_sueldos_basicos']['fecha_auto']=='' ){             $error['fecha_auto']        = 'error/No ha ingresado la fecha auto';}
				if(!isset($_SESSION['fact_sueldos_basicos']['Creacion_fecha']) or $_SESSION['fact_sueldos_basicos']['Creacion_fecha']=='' ){     $error['Creacion_fecha']    = 'error/No ha ingresado la fecha de creacion';}
				if(!isset($_SESSION['fact_sueldos_basicos']['Fecha_desde']) or $_SESSION['fact_sueldos_basicos']['Fecha_desde']=='' ){           $error['Fecha_desde']       = 'error/No ha ingresado la fecha de inicio de facturacion';}
				if(!isset($_SESSION['fact_sueldos_basicos']['Fecha_hasta']) or $_SESSION['fact_sueldos_basicos']['Fecha_hasta']=='' ){           $error['Fecha_hasta']       = 'error/No ha ingresado la fecha de termino de facturacion';}
				if(!isset($_SESSION['fact_sueldos_basicos']['Observaciones']) or $_SESSION['fact_sueldos_basicos']['Observaciones']=='' ){       $error['Observaciones']     = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['fact_sueldos_basicos']['UF']) or $_SESSION['fact_sueldos_basicos']['UF']=='' ){                             $error['UF']                = 'error/No ha ingresado la UF';}
				if(!isset($_SESSION['fact_sueldos_basicos']['UTM']) or $_SESSION['fact_sueldos_basicos']['UTM']=='' ){                           $error['UTM']               = 'error/No ha ingresado la UTM';}
				if(!isset($_SESSION['fact_sueldos_basicos']['IMM']) or $_SESSION['fact_sueldos_basicos']['IMM']=='' ){                           $error['IMM']               = 'error/No ha ingresado la IMM';}
				if(!isset($_SESSION['fact_sueldos_basicos']['TopeImpAFP']) or $_SESSION['fact_sueldos_basicos']['TopeImpAFP']=='' ){             $error['TopeImpAFP']        = 'error/No ha ingresado el Tope AFP';}
				if(!isset($_SESSION['fact_sueldos_basicos']['TopeImpIPS']) or $_SESSION['fact_sueldos_basicos']['TopeImpIPS']=='' ){             $error['TopeImpIPS']        = 'error/No ha ingresado el Tope IPS';}
				if(!isset($_SESSION['fact_sueldos_basicos']['TopeSegCesantia']) or $_SESSION['fact_sueldos_basicos']['TopeSegCesantia']=='' ){   $error['TopeSegCesantia']   = 'error/No ha ingresado el Tope Seguro Cesantia';}
				if(!isset($_SESSION['fact_sueldos_basicos']['TopeAPVMensual']) or $_SESSION['fact_sueldos_basicos']['TopeAPVMensual']=='' ){     $error['TopeAPVMensual']    = 'error/No ha ingresado el Tope APV Mensual';}
				if(!isset($_SESSION['fact_sueldos_basicos']['TopeDepConv']) or $_SESSION['fact_sueldos_basicos']['TopeDepConv']=='' ){           $error['TopeDepConv']       = 'error/No ha ingresado el Tope Deposito Convenido';}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al ingreso de bodega';
			}
			
			if(!isset($_SESSION['fact_sueldos_sueldos']) ){     
				$error['impuesto']  = 'error/No se han seleccionado trabajadores';
			}
			//Se verifican que existan trabajadores
			$n_data = 0;
			if (isset($_SESSION['fact_sueldos_sueldos'])){
				foreach ($_SESSION['fact_sueldos_sueldos'] as $key => $producto){
					$n_data++;
				}
			}
			if(isset($n_data)&&$n_data==0){
				$error['trabajos'] = 'error/No se han seleccionado trabajadores';
			}	
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se guardan los datos basicos
				if(isset($_SESSION['fact_sueldos_basicos']['idSistema']) && $_SESSION['fact_sueldos_basicos']['idSistema'] != ''){             $a  = "'".$_SESSION['fact_sueldos_basicos']['idSistema']."'" ;   }else{$a  = "''";}
				if(isset($_SESSION['fact_sueldos_basicos']['idUsuario']) && $_SESSION['fact_sueldos_basicos']['idUsuario'] != ''){             $a .= ",'".$_SESSION['fact_sueldos_basicos']['idUsuario']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['fact_sueldos_basicos']['fecha_auto']) && $_SESSION['fact_sueldos_basicos']['fecha_auto'] != ''){           $a .= ",'".$_SESSION['fact_sueldos_basicos']['fecha_auto']."'" ; }else{$a .= ",''";}
				if(isset($_SESSION['fact_sueldos_basicos']['Creacion_fecha']) && $_SESSION['fact_sueldos_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['fact_sueldos_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['fact_sueldos_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['fact_sueldos_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['fact_sueldos_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['fact_sueldos_basicos']['Fecha_desde']) && $_SESSION['fact_sueldos_basicos']['Fecha_desde'] != ''){         $a .= ",'".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['fact_sueldos_basicos']['Fecha_hasta']) && $_SESSION['fact_sueldos_basicos']['Fecha_hasta'] != ''){         $a .= ",'".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['fact_sueldos_basicos']['Observaciones']) && $_SESSION['fact_sueldos_basicos']['Observaciones'] != ''){     $a .= ",'".$_SESSION['fact_sueldos_basicos']['Observaciones']."'" ;    }else{$a .= ",''";}
				if(isset($_SESSION['fact_sueldos_basicos']['UF']) && $_SESSION['fact_sueldos_basicos']['UF'] != ''){                           $a .= ",'".$_SESSION['fact_sueldos_basicos']['UF']."'" ;               }else{$a .= ",''";}
				if(isset($_SESSION['fact_sueldos_basicos']['UTM']) && $_SESSION['fact_sueldos_basicos']['UTM'] != ''){                         $a .= ",'".$_SESSION['fact_sueldos_basicos']['UTM']."'" ;              }else{$a .= ",''";}
				if(isset($_SESSION['fact_sueldos_basicos']['IMM']) && $_SESSION['fact_sueldos_basicos']['IMM'] != ''){                         $a .= ",'".$_SESSION['fact_sueldos_basicos']['IMM']."'" ;              }else{$a .= ",''";}
				if(isset($_SESSION['fact_sueldos_basicos']['TopeImpAFP']) && $_SESSION['fact_sueldos_basicos']['TopeImpAFP'] != ''){           $a .= ",'".$_SESSION['fact_sueldos_basicos']['TopeImpAFP']."'" ;       }else{$a .= ",''";}
				if(isset($_SESSION['fact_sueldos_basicos']['TopeImpIPS']) && $_SESSION['fact_sueldos_basicos']['TopeImpIPS'] != ''){           $a .= ",'".$_SESSION['fact_sueldos_basicos']['TopeImpIPS']."'" ;       }else{$a .= ",''";}
				if(isset($_SESSION['fact_sueldos_basicos']['TopeSegCesantia']) && $_SESSION['fact_sueldos_basicos']['TopeSegCesantia'] != ''){ $a .= ",'".$_SESSION['fact_sueldos_basicos']['TopeSegCesantia']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['fact_sueldos_basicos']['TopeAPVMensual']) && $_SESSION['fact_sueldos_basicos']['TopeAPVMensual'] != ''){   $a .= ",'".$_SESSION['fact_sueldos_basicos']['TopeAPVMensual']."'" ;   }else{$a .= ",''";}
				if(isset($_SESSION['fact_sueldos_basicos']['TopeDepConv']) && $_SESSION['fact_sueldos_basicos']['TopeDepConv'] != ''){         $a .= ",'".$_SESSION['fact_sueldos_basicos']['TopeDepConv']."'" ;      }else{$a .= ",''";}
					
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `rrhh_sueldos_facturacion` (idSistema, idUsuario, fecha_auto, Creacion_fecha,
				Creacion_Semana, Creacion_mes, Creacion_ano, Fecha_desde, Fecha_hasta, Observaciones, UF, UTM, IMM,
				TopeImpAFP, TopeImpIPS, TopeSegCesantia, TopeAPVMensual, TopeDepConv) 
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
					
				}else{
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
		
					/*********************************************************************/		
					//Se guardan los datos de los productos	
					if(isset($_SESSION['fact_sueldos_sueldos'])){		
						foreach ($_SESSION['fact_sueldos_sueldos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                     $a  = "'".$ultimo_id."'" ;                                       }else{$a  = "''";}
							if(isset($_SESSION['fact_sueldos_basicos']['idSistema']) && $_SESSION['fact_sueldos_basicos']['idSistema'] != ''){             $a .= ",'".$_SESSION['fact_sueldos_basicos']['idSistema']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['fact_sueldos_basicos']['idUsuario']) && $_SESSION['fact_sueldos_basicos']['idUsuario'] != ''){             $a .= ",'".$_SESSION['fact_sueldos_basicos']['idUsuario']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['fact_sueldos_basicos']['fecha_auto']) && $_SESSION['fact_sueldos_basicos']['fecha_auto'] != ''){           $a .= ",'".$_SESSION['fact_sueldos_basicos']['fecha_auto']."'" ; }else{$a .= ",''";}
							if(isset($_SESSION['fact_sueldos_basicos']['Creacion_fecha']) && $_SESSION['fact_sueldos_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['fact_sueldos_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NSemana($_SESSION['fact_sueldos_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2NMes($_SESSION['fact_sueldos_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['fact_sueldos_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['fact_sueldos_basicos']['Fecha_desde']) && $_SESSION['fact_sueldos_basicos']['Fecha_desde'] != ''){         $a .= ",'".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['fact_sueldos_basicos']['Fecha_hasta']) && $_SESSION['fact_sueldos_basicos']['Fecha_hasta'] != ''){         $a .= ",'".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['fact_sueldos_basicos']['Observaciones']) && $_SESSION['fact_sueldos_basicos']['Observaciones'] != ''){     $a .= ",'".$_SESSION['fact_sueldos_basicos']['Observaciones']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['fact_sueldos_basicos']['UF']) && $_SESSION['fact_sueldos_basicos']['UF'] != ''){                           $a .= ",'".$_SESSION['fact_sueldos_basicos']['UF']."'" ;               }else{$a .= ",''";}
							if(isset($_SESSION['fact_sueldos_basicos']['UTM']) && $_SESSION['fact_sueldos_basicos']['UTM'] != ''){                         $a .= ",'".$_SESSION['fact_sueldos_basicos']['UTM']."'" ;              }else{$a .= ",''";}
							if(isset($_SESSION['fact_sueldos_basicos']['IMM']) && $_SESSION['fact_sueldos_basicos']['IMM'] != ''){                         $a .= ",'".$_SESSION['fact_sueldos_basicos']['IMM']."'" ;              }else{$a .= ",''";}
							if(isset($_SESSION['fact_sueldos_basicos']['TopeImpAFP']) && $_SESSION['fact_sueldos_basicos']['TopeImpAFP'] != ''){           $a .= ",'".$_SESSION['fact_sueldos_basicos']['TopeImpAFP']."'" ;       }else{$a .= ",''";}
							if(isset($_SESSION['fact_sueldos_basicos']['TopeImpIPS']) && $_SESSION['fact_sueldos_basicos']['TopeImpIPS'] != ''){           $a .= ",'".$_SESSION['fact_sueldos_basicos']['TopeImpIPS']."'" ;       }else{$a .= ",''";}
							if(isset($_SESSION['fact_sueldos_basicos']['TopeSegCesantia']) && $_SESSION['fact_sueldos_basicos']['TopeSegCesantia'] != ''){ $a .= ",'".$_SESSION['fact_sueldos_basicos']['TopeSegCesantia']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['fact_sueldos_basicos']['TopeAPVMensual']) && $_SESSION['fact_sueldos_basicos']['TopeAPVMensual'] != ''){   $a .= ",'".$_SESSION['fact_sueldos_basicos']['TopeAPVMensual']."'" ;   }else{$a .= ",''";}
							if(isset($_SESSION['fact_sueldos_basicos']['TopeDepConv']) && $_SESSION['fact_sueldos_basicos']['TopeDepConv'] != ''){         $a .= ",'".$_SESSION['fact_sueldos_basicos']['TopeDepConv']."'" ;      }else{$a .= ",''";}
							
							if(isset($producto['idTrabajador']) && $producto['idTrabajador'] != ''){                            $a .= ",'".$producto['idTrabajador']."'" ;                 }else{$a .= ",''";}
							if(isset($producto['idTipoContratoTrab']) && $producto['idTipoContratoTrab'] != ''){                $a .= ",'".$producto['idTipoContratoTrab']."'" ;           }else{$a .= ",''";}
							if(isset($producto['TipoContratoTrab']) && $producto['TipoContratoTrab'] != ''){                    $a .= ",'".$producto['TipoContratoTrab']."'" ;             }else{$a .= ",''";}
							if(isset($producto['horas_pactadas']) && $producto['horas_pactadas'] != ''){                        $a .= ",'".$producto['horas_pactadas']."'" ;               }else{$a .= ",''";}
							if(isset($producto['Gratificacion']) && $producto['Gratificacion'] != ''){                          $a .= ",'".$producto['Gratificacion']."'" ;                }else{$a .= ",''";}
							if(isset($producto['TrabajadorNombre']) && $producto['TrabajadorNombre'] != ''){                    $a .= ",'".$producto['TrabajadorNombre']."'" ;             }else{$a .= ",''";}
							if(isset($producto['TrabajadorRut']) && $producto['TrabajadorRut'] != ''){                          $a .= ",'".$producto['TrabajadorRut']."'" ;                }else{$a .= ",''";}
							if(isset($producto['TrabajadorEmail']) && $producto['TrabajadorEmail'] != ''){                      $a .= ",'".$producto['TrabajadorEmail']."'" ;              }else{$a .= ",''";}
							if(isset($producto['TrabajadorContrato']) && $producto['TrabajadorContrato'] != ''){                $a .= ",'".$producto['TrabajadorContrato']."'" ;           }else{$a .= ",''";}
							if(isset($producto['TrabajadorCargo']) && $producto['TrabajadorCargo'] != ''){                      $a .= ",'".$producto['TrabajadorCargo']."'" ;              }else{$a .= ",''";}
							if(isset($producto['SistemaNombre']) && $producto['SistemaNombre'] != ''){                          $a .= ",'".$producto['SistemaNombre']."'" ;                }else{$a .= ",''";}
							if(isset($producto['SistemaRut']) && $producto['SistemaRut'] != ''){                                $a .= ",'".$producto['SistemaRut']."'" ;                   }else{$a .= ",''";}
							if(isset($producto['SueldoPactado']) && $producto['SueldoPactado'] != ''){                          $a .= ",'".$producto['SueldoPactado']."'" ;                }else{$a .= ",''";}
							if(isset($producto['DiasPactados']) && $producto['DiasPactados'] != ''){                            $a .= ",'".$producto['DiasPactados']."'" ;                 }else{$a .= ",''";}
							if(isset($producto['DiasTrabajados']) && $producto['DiasTrabajados'] != ''){                        $a .= ",'".$producto['DiasTrabajados']."'" ;               }else{$a .= ",''";}
							if(isset($producto['diasInasistencia']) && $producto['diasInasistencia'] != ''){                    $a .= ",'".$producto['diasInasistencia']."'" ;             }else{$a .= ",''";}
							if(isset($producto['diasLicencias']) && $producto['diasLicencias'] != ''){                          $a .= ",'".$producto['diasLicencias']."'" ;                }else{$a .= ",''";}
							if(isset($producto['SueldoPagado']) && $producto['SueldoPagado'] != ''){                            $a .= ",'".$producto['SueldoPagado']."'" ;                 }else{$a .= ",''";}
							if(isset($producto['TotalBonoFijoAfecto']) && $producto['TotalBonoFijoAfecto'] != ''){              $a .= ",'".$producto['TotalBonoFijoAfecto']."'" ;          }else{$a .= ",''";}
							if(isset($producto['TotalBonoFijoNoAfecto']) && $producto['TotalBonoFijoNoAfecto'] != ''){          $a .= ",'".$producto['TotalBonoFijoNoAfecto']."'" ;        }else{$a .= ",''";}
							if(isset($producto['TotalBonoTurno']) && $producto['TotalBonoTurno'] != ''){                        $a .= ",'".$producto['TotalBonoTurno']."'" ;               }else{$a .= ",''";}
							if(isset($producto['TotalBonoTemporalAfecto']) && $producto['TotalBonoTemporalAfecto'] != ''){      $a .= ",'".$producto['TotalBonoTemporalAfecto']."'" ;      }else{$a .= ",''";}
							if(isset($producto['TotalBonoTemporalNoAfecto']) && $producto['TotalBonoTemporalNoAfecto'] != ''){  $a .= ",'".$producto['TotalBonoTemporalNoAfecto']."'" ;    }else{$a .= ",''";}
							if(isset($producto['TotalHorasExtras']) && $producto['TotalHorasExtras'] != ''){                    $a .= ",'".$producto['TotalHorasExtras']."'" ;             }else{$a .= ",''";}
							if(isset($producto['Cargas_n']) && $producto['Cargas_n'] != ''){                                    $a .= ",'".$producto['Cargas_n']."'" ;                     }else{$a .= ",''";}
							if(isset($producto['Cargas_valor']) && $producto['Cargas_valor'] != ''){                            $a .= ",'".$producto['Cargas_valor']."'" ;                 }else{$a .= ",''";}
							if(isset($producto['Cargas_idTramo']) && $producto['Cargas_idTramo'] != ''){                        $a .= ",'".$producto['Cargas_idTramo']."'" ;               }else{$a .= ",''";}
							if(isset($producto['Cargas_tramo']) && $producto['Cargas_tramo'] != ''){                            $a .= ",'".$producto['Cargas_tramo']."'" ;                 }else{$a .= ",''";}
							if(isset($producto['TotalCargasFamiliares']) && $producto['TotalCargasFamiliares'] != ''){          $a .= ",'".$producto['TotalCargasFamiliares']."'" ;        }else{$a .= ",''";}
							if(isset($producto['SueldoImponible']) && $producto['SueldoImponible'] != ''){                      $a .= ",'".$producto['SueldoImponible']."'" ;              }else{$a .= ",''";}
							if(isset($producto['SueldoNoImponible']) && $producto['SueldoNoImponible'] != ''){                  $a .= ",'".$producto['SueldoNoImponible']."'" ;            }else{$a .= ",''";}
							if(isset($producto['TotalHaberes']) && $producto['TotalHaberes'] != ''){                            $a .= ",'".$producto['TotalHaberes']."'" ;                 }else{$a .= ",''";}
							if(isset($producto['AFP_idAFP']) && $producto['AFP_idAFP'] != ''){                                  $a .= ",'".$producto['AFP_idAFP']."'" ;                    }else{$a .= ",''";}
							if(isset($producto['AFP_Nombre']) && $producto['AFP_Nombre'] != ''){                                $a .= ",'".$producto['AFP_Nombre']."'" ;                   }else{$a .= ",''";}
							if(isset($producto['AFP_Porcentaje']) && $producto['AFP_Porcentaje'] != ''){                        $a .= ",'".$producto['AFP_Porcentaje']."'" ;               }else{$a .= ",''";}
							if(isset($producto['AFP_Total']) && $producto['AFP_Total'] != ''){                                  $a .= ",'".$producto['AFP_Total']."'" ;                    }else{$a .= ",''";}
							if(isset($producto['AFP_SIS']) && $producto['AFP_SIS'] != ''){                                      $a .= ",'".$producto['AFP_SIS']."'" ;                      }else{$a .= ",''";}
							if(isset($producto['Salud_idAFP']) && $producto['Salud_idAFP'] != ''){                              $a .= ",'".$producto['Salud_idAFP']."'" ;                  }else{$a .= ",''";}
							if(isset($producto['Salud_Nombre']) && $producto['Salud_Nombre'] != ''){                            $a .= ",'".$producto['Salud_Nombre']."'" ;                 }else{$a .= ",''";}
							if(isset($producto['Salud_Porcentaje']) && $producto['Salud_Porcentaje'] != ''){                    $a .= ",'".$producto['Salud_Porcentaje']."'" ;             }else{$a .= ",''";}
							if(isset($producto['Salud_Total']) && $producto['Salud_Total'] != ''){                              $a .= ",'".$producto['Salud_Total']."'" ;                  }else{$a .= ",''";}
							if(isset($producto['TotalDescuentos']) && $producto['TotalDescuentos'] != ''){                      $a .= ",'".$producto['TotalDescuentos']."'" ;              }else{$a .= ",''";}
							if(isset($producto['SegCesantia_Empleador']) && $producto['SegCesantia_Empleador'] != ''){          $a .= ",'".$producto['SegCesantia_Empleador']."'" ;        }else{$a .= ",''";}
							if(isset($producto['SegCesantia_Trabajador']) && $producto['SegCesantia_Trabajador'] != ''){        $a .= ",'".$producto['SegCesantia_Trabajador']."'" ;       }else{$a .= ",''";}
							if(isset($producto['ImpuestoRenta']) && $producto['ImpuestoRenta'] != ''){                          $a .= ",'".$producto['ImpuestoRenta']."'" ;                }else{$a .= ",''";}
							if(isset($producto['RentaAfecta']) && $producto['RentaAfecta'] != ''){                              $a .= ",'".$producto['RentaAfecta']."'" ;                  }else{$a .= ",''";}
							if(isset($producto['TotalAPagar']) && $producto['TotalAPagar'] != ''){                              $a .= ",'".$producto['TotalAPagar']."'" ;                  }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `rrhh_sueldos_facturacion_trabajadores` (idFacturacion, idSistema, idUsuario, fecha_auto, Creacion_fecha,
							Creacion_Semana, Creacion_mes, Creacion_ano, Fecha_desde, Fecha_hasta, Observaciones, UF, UTM, IMM,
							TopeImpAFP, TopeImpIPS, TopeSegCesantia, TopeAPVMensual, TopeDepConv,idTrabajador,idTipoContratoTrab,TipoContratoTrab,
							horas_pactadas,Gratificacion,TrabajadorNombre,TrabajadorRut,TrabajadorEmail,TrabajadorContrato,
							TrabajadorCargo,SistemaNombre,SistemaRut,SueldoPactado,DiasPactados,DiasTrabajados,diasInasistencia,
							diasLicencias,SueldoPagado,TotalBonoFijoAfecto,TotalBonoFijoNoAfecto,TotalBonoTurno,
							TotalBonoTemporalAfecto,TotalBonoTemporalNoAfecto,TotalHorasExtras,Cargas_n,Cargas_valor,
							Cargas_idTramo,Cargas_tramo,TotalCargasFamiliares,SueldoImponible,SueldoNoImponible,
							TotalHaberes,AFP_idAFP,AFP_Nombre,AFP_Porcentaje,AFP_Total,AFP_SIS,Salud_idAFP,
							Salud_Nombre,Salud_Porcentaje,Salud_Total ,TotalDescuentos,SegCesantia_Empleador,
							SegCesantia_Trabajador,ImpuestoRenta,RentaAfecta,TotalAPagar) 
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
							//recibo el último id generado por mi sesion
							$ultimo_idmain = mysqli_insert_id($dbConn);
						
							/*****************************************************************************/
							//Bonos Fijos
							for ($x = 0; $x <= 100; $x++) {
								//verifico si existe
								if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoFijo'][$x]['BonoTipo'])){
									//filtros
									if(isset($ultimo_idmain) && $ultimo_idmain != ''){                                                                                                                                                            $a  = "'".$ultimo_idmain."'" ;                                                                                 }else{$a  = "''";}
									if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoFijo'][$x]['idBonoFijo']) && $_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoFijo'][$x]['idBonoFijo'] != ''){    $a .= ",'".$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoFijo'][$x]['idBonoFijo']."'" ;    }else{$a .= ",''";}
									if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoFijo'][$x]['BonoNombre']) && $_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoFijo'][$x]['BonoNombre'] != ''){    $a .= ",'".$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoFijo'][$x]['BonoNombre']."'" ;    }else{$a .= ",''";}
									if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoFijo'][$x]['BonoMonto']) && $_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoFijo'][$x]['BonoMonto'] != ''){      $a .= ",'".$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoFijo'][$x]['BonoMonto']."'" ;     }else{$a .= ",''";}
									if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoFijo'][$x]['BonoTipo']) && $_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoFijo'][$x]['BonoTipo'] != ''){        $a .= ",'".$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoFijo'][$x]['BonoTipo']."'" ;      }else{$a .= ",''";}
									
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `rrhh_sueldos_facturacion_trabajadores_bonofijo` (idFactTrab, idBonoFijo, BonoNombre, BonoMonto, BonoTipo) 
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
							
							/*****************************************************************************/
							//Bonos por turno
							for ($x = 0; $x <= 6; $x++) {
								//verifico si existe
								if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTurno'][$x]['BonoMonto'])&&$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTurno'][$x]['BonoMonto']!=0){
									//filtros
									if(isset($ultimo_idmain) && $ultimo_idmain != ''){                                                                                                                                                              $a  = "'".$ultimo_idmain."'" ;                                                                                  }else{$a  = "''";}
									if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTurno'][$x]['idTurnos']) && $_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTurno'][$x]['idTurnos'] != ''){        $a .= ",'".$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTurno'][$x]['idTurnos']."'" ;      }else{$a .= ",''";}
									if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTurno'][$x]['BonoNombre']) && $_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTurno'][$x]['BonoNombre'] != ''){    $a .= ",'".$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTurno'][$x]['BonoNombre']."'" ;    }else{$a .= ",''";}
									if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTurno'][$x]['BonoMonto']) && $_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTurno'][$x]['BonoMonto'] != ''){      $a .= ",'".$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTurno'][$x]['BonoMonto']."'" ;     }else{$a .= ",''";}
									
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `rrhh_sueldos_facturacion_trabajadores_bonoturno` (idFactTrab, idTurnos, BonoNombre, BonoMonto) 
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
							
							/*****************************************************************************/
							//Bonos Temporales
							for ($x = 0; $x <= 100; $x++) {
								//verifico si existe
								if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTemporal'][$x]['BonoTipo'])){
									//filtros
									if(isset($ultimo_idmain) && $ultimo_idmain != ''){                                                                                                                                                                            $a  = "'".$ultimo_idmain."'" ;                                                                                       }else{$a  = "''";}
									if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTemporal'][$x]['idBonoTemporal']) && $_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTemporal'][$x]['idBonoTemporal'] != ''){    $a .= ",'".$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTemporal'][$x]['idBonoTemporal']."'" ;  }else{$a .= ",''";}
									if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTemporal'][$x]['BonoNombre']) && $_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTemporal'][$x]['BonoNombre'] != ''){            $a .= ",'".$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTemporal'][$x]['BonoNombre']."'" ;      }else{$a .= ",''";}
									if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTemporal'][$x]['BonoMonto']) && $_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTemporal'][$x]['BonoMonto'] != ''){              $a .= ",'".$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTemporal'][$x]['BonoMonto']."'" ;       }else{$a .= ",''";}
									if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTemporal'][$x]['BonoTipo']) && $_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTemporal'][$x]['BonoTipo'] != ''){                $a .= ",'".$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['BonoTemporal'][$x]['BonoTipo']."'" ;        }else{$a .= ",''";}
									
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `rrhh_sueldos_facturacion_trabajadores_bonotemporal` (idFactTrab, idBonoTemporal, BonoNombre, BonoMonto, BonoTipo) 
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
							
							/*****************************************************************************/
							//Horas extras
							for ($x = 0; $x <= 31; $x++) {
								//verifico si existe
								if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['HorasExtras'][$x]['N_Horas'])&&$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['HorasExtras'][$x]['N_Horas']!=0){
									//filtros
									if(isset($ultimo_idmain) && $ultimo_idmain != ''){                                                                                                                                                                     $a  = "'".$ultimo_idmain."'" ;                                                                                    }else{$a  = "''";}
									if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['HorasExtras'][$x]['idPorcentaje']) && $_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['HorasExtras'][$x]['idPorcentaje'] != ''){   $a .= ",'".$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['HorasExtras'][$x]['idPorcentaje']."'" ;  }else{$a .= ",''";}
									if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['HorasExtras'][$x]['Porcentaje']) && $_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['HorasExtras'][$x]['Porcentaje'] != ''){       $a .= ",'".$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['HorasExtras'][$x]['Porcentaje']."'" ;    }else{$a .= ",''";}
									if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['HorasExtras'][$x]['N_Horas']) && $_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['HorasExtras'][$x]['N_Horas'] != ''){             $a .= ",'".$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['HorasExtras'][$x]['N_Horas']."'" ;       }else{$a .= ",''";}
									if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['HorasExtras'][$x]['ValorHora']) && $_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['HorasExtras'][$x]['ValorHora'] != ''){         $a .= ",'".$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['HorasExtras'][$x]['ValorHora']."'" ;     }else{$a .= ",''";}
									if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['HorasExtras'][$x]['TotalHora']) && $_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['HorasExtras'][$x]['TotalHora'] != ''){         $a .= ",'".$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['HorasExtras'][$x]['TotalHora']."'" ;     }else{$a .= ",''";}
									
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `rrhh_sueldos_facturacion_trabajadores_horasextras` (idFactTrab, idPorcentaje, Porcentaje, N_Horas, ValorHora, TotalHora) 
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
							
							/*****************************************************************************/
							//Descuentos previsionales
							for ($x = 0; $x <= 100; $x++) {
								//verifico si existe
								if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['DescuentoFijo'][$x]['DescuentoMonto'])&&$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['DescuentoFijo'][$x]['DescuentoMonto']!=''){
									//filtros
									if(isset($ultimo_idmain) && $ultimo_idmain != ''){                                                                                                                                                                              $a  = "'".$ultimo_idmain."'" ;                                                                                         }else{$a  = "''";}
									if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['DescuentoFijo'][$x]['idDescuentoFijo']) && $_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['DescuentoFijo'][$x]['idDescuentoFijo'] != ''){  $a .= ",'".$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['DescuentoFijo'][$x]['idDescuentoFijo']."'" ;  }else{$a .= ",''";}
									if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['DescuentoFijo'][$x]['DescuentoNombre']) && $_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['DescuentoFijo'][$x]['DescuentoNombre'] != ''){  $a .= ",'".$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['DescuentoFijo'][$x]['DescuentoNombre']."'" ;  }else{$a .= ",''";}
									if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['DescuentoFijo'][$x]['DescuentoMonto']) && $_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['DescuentoFijo'][$x]['DescuentoMonto'] != ''){    $a .= ",'".$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['DescuentoFijo'][$x]['DescuentoMonto']."'" ;   }else{$a .= ",''";}
									if(isset($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['DescuentoFijo'][$x]['DescuentoIDAFP']) && $_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['DescuentoFijo'][$x]['DescuentoIDAFP'] != ''){    $a .= ",'".$_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['DescuentoFijo'][$x]['DescuentoIDAFP']."'" ;   }else{$a .= ",''";}
									
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `rrhh_sueldos_facturacion_trabajadores_descuentofijo` (idFactTrab, idDescuentoFijo, DescuentoNombre, DescuentoMonto, DescuentoIDAFP) 
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
							
							
							/*****************************************************************************/
							//anticipos
							if(!empty($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['Anticipo'])){
								foreach ($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['Anticipo'] as $key => $anticipo){
									//filtros
									if(isset($ultimo_idmain) && $ultimo_idmain != ''){                                                                                                                                                                              $a  = "'".$ultimo_idmain."'" ;                                                                                         }else{$a  = "''";}
									if(isset($anticipo['Creacion_fecha']) && $anticipo['Creacion_fecha'] != ''){    $a .= ",'".$anticipo['Creacion_fecha']."'" ;   }else{$a .= ",''";}
									if(isset($anticipo['Monto']) && $anticipo['Monto'] != ''){                      $a .= ",'".$anticipo['Monto']."'" ;            }else{$a .= ",''";}
									
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `rrhh_sueldos_facturacion_trabajadores_anticipos` (idFactTrab, Creacion_fecha, Monto) 
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
							
							/*****************************************************************************/
							//Cuotas
							if(!empty($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['Cuotas'])){
								foreach ($_SESSION['fact_sueldos_sueldos'][$producto['idTrabajador']]['Cuotas'] as $key => $cuotas){
									//filtros
									if(isset($ultimo_idmain) && $ultimo_idmain != ''){                                                                                                                                                                              $a  = "'".$ultimo_idmain."'" ;                                                                                         }else{$a  = "''";}
									if(isset($cuotas['Fecha']) && $cuotas['Fecha'] != ''){                $a .= ",'".$cuotas['Fecha']."'" ;         }else{$a .= ",''";}
									if(isset($cuotas['nCuota']) && $cuotas['nCuota'] != ''){              $a .= ",'".$cuotas['nCuota']."'" ;        }else{$a .= ",''";}
									if(isset($cuotas['TotalCuotas']) && $cuotas['TotalCuotas'] != ''){    $a .= ",'".$cuotas['TotalCuotas']."'" ;   }else{$a .= ",''";}
									if(isset($cuotas['monto_cuotas']) && $cuotas['monto_cuotas'] != ''){  $a .= ",'".$cuotas['monto_cuotas']."'" ;  }else{$a .= ",''";}
									if(isset($cuotas['Tipo']) && $cuotas['Tipo'] != ''){                  $a .= ",'".$cuotas['Tipo']."'" ;          }else{$a .= ",''";}
									
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `rrhh_sueldos_facturacion_trabajadores_descuentos` (idFactTrab, Fecha, nCuota, TotalCuotas, monto_cuotas, Tipo) 
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
							
							/*********************************************************************************/
							/*                      SE ACTUALIZAN LOS DATOS UTILIZADOS                       */
							/*********************************************************************************/
							//filtro
							$a = "idUso='2'" ;
							$a .= ",idFactRRHH='".$ultimo_id."'" ;
											
							/****************************************************/
							//Inasistencias
							// inserto los datos de registro en la db
							$query  = "UPDATE `trabajadores_inasistencias_dias` SET ".$a." 
							WHERE idTrabajador = '".$producto['idTrabajador']."'
							AND  idUso=1 AND Creacion_fecha BETWEEN '".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."' AND '".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'
							";
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
							/****************************************************/
							//Licencias
							// inserto los datos de registro en la db
							$query  = "UPDATE `trabajadores_licencias` SET ".$a." 
							WHERE idTrabajador = '".$producto['idTrabajador']."'
							AND idUso=1 AND Fecha_inicio BETWEEN '".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."' AND '".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'
							";
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
							/****************************************************/
							//Bonos por turno
							// inserto los datos de registro en la db
							$query  = "UPDATE `trabajadores_horas_extras_facturacion_turnos` SET ".$a." 
							WHERE idTrabajador = '".$producto['idTrabajador']."'
							AND idUso=1 AND Creacion_fecha BETWEEN '".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."' AND '".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'
							";
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
							/****************************************************/
							//Bonos temporales
							// inserto los datos de registro en la db
							$query  = "UPDATE `trabajadores_bonos_temporales` SET ".$a." 
							WHERE idTrabajador = '".$producto['idTrabajador']."'
							AND idUso=1 AND Creacion_fecha BETWEEN '".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."' AND '".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'
							";
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
							/****************************************************/
							//Horas extras
							// inserto los datos de registro en la db
							$query  = "UPDATE `trabajadores_horas_extras_mensuales_facturacion_horas` SET ".$a." 
							WHERE idTrabajador = '".$producto['idTrabajador']."'
							AND idUso=1 AND Creacion_fecha BETWEEN '".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."' AND '".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'
							";
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
							/****************************************************/
							//Anticipos
							// inserto los datos de registro en la db
							$query  = "UPDATE `trabajadores_descuentos_anticipos` SET ".$a." 
							WHERE idTrabajador = '".$producto['idTrabajador']."'
							AND idUso=1 AND Creacion_fecha BETWEEN '".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."' AND '".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'
							";
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
							/****************************************************/
							//Descuento Cuota
							// inserto los datos de registro en la db
							$query  = "UPDATE `trabajadores_descuentos_cuotas_listado` SET ".$a." 
							WHERE idTrabajador = '".$producto['idTrabajador']."'
							AND idUso=1 AND Fecha BETWEEN '".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."' AND '".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'
							";
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
							
							
					
					/*********************************************************************/		
					//Archivos
					if(isset($_SESSION['insumos_ing_archivos'])){
						foreach ($_SESSION['insumos_ing_archivos'] as $key => $archivo){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                     $a  = "'".$ultimo_id."'" ;                                       }else{$a  = "''";}
							if(isset($_SESSION['fact_sueldos_basicos']['idSistema']) && $_SESSION['fact_sueldos_basicos']['idSistema'] != ''){             $a .= ",'".$_SESSION['fact_sueldos_basicos']['idSistema']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['fact_sueldos_basicos']['idUsuario']) && $_SESSION['fact_sueldos_basicos']['idUsuario'] != ''){             $a .= ",'".$_SESSION['fact_sueldos_basicos']['idUsuario']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['fact_sueldos_basicos']['fecha_auto']) && $_SESSION['fact_sueldos_basicos']['fecha_auto'] != ''){           $a .= ",'".$_SESSION['fact_sueldos_basicos']['fecha_auto']."'" ; }else{$a .= ",''";}
							if(isset($_SESSION['fact_sueldos_basicos']['Creacion_fecha']) && $_SESSION['fact_sueldos_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['fact_sueldos_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NSemana($_SESSION['fact_sueldos_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2NMes($_SESSION['fact_sueldos_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['fact_sueldos_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['fact_sueldos_basicos']['Fecha_desde']) && $_SESSION['fact_sueldos_basicos']['Fecha_desde'] != ''){         $a .= ",'".$_SESSION['fact_sueldos_basicos']['Fecha_desde']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['fact_sueldos_basicos']['Fecha_hasta']) && $_SESSION['fact_sueldos_basicos']['Fecha_hasta'] != ''){         $a .= ",'".$_SESSION['fact_sueldos_basicos']['Fecha_hasta']."'" ;      }else{$a .= ",''";}
							if(isset($archivo['Nombre']) && $archivo['Nombre'] != ''){                                                                     $a .= ",'".$archivo['Nombre']."'" ;                                    }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `rrhh_sueldos_facturacion_archivos` (idFacturacion, idSistema, idUsuario, fecha_auto,
							Creacion_fecha, Creacion_Semana, Creacion_mes, Creacion_ano, Fecha_desde, Fecha_hasta, Nombre) 
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
					
									
					
					
					/*********************************************************************/
					//Borro todas las sesiones una vez grabados los datos
					//Borro todas las sesiones
					unset($_SESSION['fact_sueldos_basicos']);
					unset($_SESSION['fact_sueldos_sueldos']);
					unset($_SESSION['fact_sueldos_temporal']);
					unset($_SESSION['fact_sueldos_archivos']);
					
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
				
				
				
				
				
			}	
	

		break;	
/*******************************************************************************************************************/
	}
?>
