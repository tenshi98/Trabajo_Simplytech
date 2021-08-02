<?php 

if(isset($idSistema)&&$idSistema!=''&&$idSistema!=0){
	
	//Obtengo todos los equipos de telemetria activos
	$z = "telemetria_listado.idEstado = 1 ";//solo equipos activos
	//Filtro de los tab
	$z .= " AND telemetria_listado.idTab = 9"; //CrossEnergy
	//Filtro el sistema al cual pertenece	
	$z .= " AND telemetria_listado.idSistema = ".$idSistema;	
		
	//Listar los equipos
	$arrEquipo = array();
	$arrEquipo = db_select_array (false, 'idTelemetria, cantSensores ', 'telemetria_listado', '', $z, 'telemetria_listado.idTelemetria ASC', $dbConn, 'Cron', basename($_SERVER["REQUEST_URI"], ".php"), 'cron');
	
	//recorro los equipos
	foreach ($arrEquipo as $data) {
		
		/*********************************************************/
		//genero filtros
		$SIS_query = 'Segundos';
		for ($i = 1; $i <= $data['cantSensores']; $i++) {
			$SIS_query .= ',Sensor_'.$i;
		}
		$SIS_where = " (TimeStamp BETWEEN '".$FechaInicio." ".$HoraInicio ."' AND '".$FechaTermino." ".$HoraTermino."')";
		
		//consulto
		$arrPromedio = array();
		$arrPromedio = db_select_array (false, $SIS_query, 'telemetria_listado_tablarelacionada_'.$data['idTelemetria'], '', $SIS_where, 'idAuxiliar ASC', $dbConn, 'Cron', basename($_SERVER["REQUEST_URI"], ".php"), 'cron');
		
		/*********************************************************/
		//Variables
		$Segundos          = 0;
		$SumaSensor = array();
		//recorro
		foreach ($arrEquipo as $equi) {
			//Sumo el tiempo
			$Segundos = $Segundos + $equi['Segundos'];
			//recorro sensores
			for ($i = 1; $i <= $data['cantSensores']; $i++) {
				//verifico si existe variable
				if(isset($SumaSensor[$i])&&$SumaSensor[$i]!=''){
					$SumaSensor[$i] = $SumaSensor[$i] + $equi['Sensor_'.$i];
				}else{
					$SumaSensor[$i] = $equi['Sensor_'.$i];
				}
			}
		}
		/*********************************************************/
		//Guardo los datos
		$Hora = cantidades($Segundos/3600, 0);
		$chain_in = '';
		//cadena
		$a  = "'".$data['idTelemetria']."'" ;
		$a .= ",'".fecha_actual()."'" ;
		$a .= ",'".hora_actual()."'" ;
		$a .= ",'".fecha_actual()." ".hora_actual()."'" ;
		//recorro sensores
		for ($i = 1; $i <= $data['cantSensores']; $i++) {
			//verifico que valor exista
			if($Hora!=0){
				$Valor = $SumaSensor[$i]/$Hora;
				$a .= ",'".$Valor."'" ;
				$chain_in .= ',Sensor_'.$i;
			}
		}
		
		// inserto los datos de registro en la db
		$query  = "INSERT INTO `telemetria_listado_crossenergy_hora` (idTelemetria, FechaSistema, HoraSistema, 
		TimeStamp ".$chain_in.") 
		VALUES (".$a.")";
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
		
	}
	
	
	
	
	
}


?>
