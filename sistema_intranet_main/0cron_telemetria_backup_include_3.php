<?php
/**********************************************************************************************************************************/
/*                                                 Tablas relacionadas                                                            */
/**********************************************************************************************************************************/
// Se trae un listado con todos los equipos que tengan configurado la opcion de backup
$arrTelemetria = array();
$query = "SELECT  idTelemetria, NregBackup
FROM `telemetria_listado`
WHERE idBackup=1";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrTelemetria,$row );
}

//Recorro equipos
foreach ($arrTelemetria as $tel) {
	/**************************************************/
	//Obtengo los punteros para el respaldo
	$query = "SELECT idTabla FROM telemetria_listado_tablarelacionada_".$tel['idTelemetria']."  
	ORDER BY idTabla DESC LIMIT 1 OFFSET ".$tel['NregBackup'];
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	$rowPuntero = mysqli_fetch_assoc ($resultado);
	
	/**************************************************/
	//hago una seleccion de datos
	$arrSeleccion = array();
	$query = "SELECT idTabla,idTelemetria,idContrato,idSolicitud,idZona,idGeocerca,
	Fecha,Hora,FechaSistema,HoraSistema,TimeStamp,GeoLatitud,GeoLongitud,GeoVelocidad,
	GeoDireccion,GeoMovimiento,Segundos,Diferencia,Sensor_1,Sensor_2,Sensor_3,
	Sensor_4,Sensor_5,Sensor_6,Sensor_7,Sensor_8,Sensor_9,Sensor_10,Sensor_11,
	Sensor_12,Sensor_13,Sensor_14,Sensor_15,Sensor_16,Sensor_17,Sensor_18,Sensor_19,
	Sensor_20,Sensor_21,Sensor_22,Sensor_23,Sensor_24,Sensor_25,Sensor_26,Sensor_27,
	Sensor_28,Sensor_29,Sensor_30,Sensor_31,Sensor_32,Sensor_33,Sensor_34,Sensor_35,
	Sensor_36,Sensor_37,Sensor_38,Sensor_39,Sensor_40,Sensor_41,Sensor_42,Sensor_43,
	Sensor_44,Sensor_45,Sensor_46,Sensor_47,Sensor_48,Sensor_49,Sensor_50,Sensor_51,
	Sensor_52,Sensor_53,Sensor_54,Sensor_55,Sensor_56,Sensor_57,Sensor_58,Sensor_59,
	Sensor_60,Sensor_61,Sensor_62,Sensor_63,Sensor_64,Sensor_65,Sensor_66,Sensor_67,
	Sensor_68,Sensor_69,Sensor_70,Sensor_71,Sensor_72
	FROM `telemetria_listado_tablarelacionada_".$tel['idTelemetria']."`
	WHERE idTabla BETWEEN 1 AND ".$rowPuntero['idTabla'];
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrSeleccion,$row );
	}

	/**************************************************/
	//verifico si tabla de respaldo existe, si no existe se crea
	$query = "SELECT idTabla FROM backup_telemetria_listado_tablarelacionada_".$tel['idTelemetria']."  
	ORDER BY idTabla DESC LIMIT 1";
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	if($resultado !== FALSE){
		//tabla existe, no se hace nada
	}else{
		
		try {
			// elimino la tabla si es que existe
			//$query  = "DROP TABLE IF EXISTS `backup_telemetria_listado_tablarelacionada_".$tel['idTelemetria']."`";
			//$result = mysqli_query($dbConn, $query);
			
			//tabla no existe, se crea nueba tabla
			$N_Maximo_Sensores = 72;
			//Variable para columnas
			$tr_column = '';
			//Recorro la configuracion de los sensores
			for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
				$tr_column .= '`Sensor_'.$i.'` decimal(20,6) NOT NULL,';
			}
			// se crea la nueva tabla
			$query  = "CREATE TABLE `backup_telemetria_listado_tablarelacionada_".$tel['idTelemetria']."` (
			`idTabla` int(11) unsigned NOT NULL AUTO_INCREMENT,
			`idTelemetria` int(11) unsigned NOT NULL,
			`idContrato` int(11) unsigned NOT NULL,
			`idSolicitud` int(11) unsigned NOT NULL,
			`idZona` int(11) unsigned NOT NULL,
			`idGeocerca` int(11) unsigned NOT NULL,
			`Fecha` date NOT NULL,
			`Hora` time NOT NULL,
			`FechaSistema` date NOT NULL,
			`HoraSistema` time NOT NULL,
			`TimeStamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ,
			`GeoLatitud` double NOT NULL,
			`GeoLongitud` double NOT NULL,
			`GeoVelocidad` decimal(20,6) NOT NULL,
			`GeoDireccion` decimal(20,6) NOT NULL,
			`GeoMovimiento` decimal(20,6) NOT NULL,
			`Segundos` int(11) unsigned NOT NULL,
			`Diferencia` decimal(20,6) NOT NULL,
			".$tr_column."
			PRIMARY KEY (`idTabla`)
			) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COMMENT='Respaldo Tabla';";
			$result = mysqli_query($dbConn, $query);
		} catch (Exception $e) {
			error_log($e->getMessage(), 0);
		}
	}

	
	/**************************************************/
	//inserto los datos en su tabla de respaldo
	foreach ($arrSeleccion as $tel) {
		//filtros
		if(isset($tel['idTabla']) && $tel['idTabla'] != ''){               $a  = "'".$tel['idTabla']."'" ;         }else{$a  ="''";}
		if(isset($tel['idTelemetria']) && $tel['idTelemetria'] != ''){     $a .= ",'".$tel['idTelemetria']."'" ;   }else{$a .=",''";}
		if(isset($tel['idContrato']) && $tel['idContrato'] != ''){         $a .= ",'".$tel['idContrato']."'" ;     }else{$a .=",''";}
		if(isset($tel['idSolicitud']) && $tel['idSolicitud'] != ''){       $a .= ",'".$tel['idSolicitud']."'" ;    }else{$a .=",''";}
		if(isset($tel['idZona']) && $tel['idZona'] != ''){                 $a .= ",'".$tel['idZona']."'" ;         }else{$a .=",''";}
		if(isset($tel['idGeocerca']) && $tel['idGeocerca'] != ''){         $a .= ",'".$tel['idGeocerca']."'" ;     }else{$a .=",''";}
		if(isset($tel['Fecha']) && $tel['Fecha'] != ''){                   $a .= ",'".$tel['Fecha']."'" ;          }else{$a .=",''";}
		if(isset($tel['Hora']) && $tel['Hora'] != ''){                     $a .= ",'".$tel['Hora']."'" ;           }else{$a .=",''";}
		if(isset($tel['FechaSistema']) && $tel['FechaSistema'] != ''){     $a .= ",'".$tel['FechaSistema']."'" ;   }else{$a .=",''";}
		if(isset($tel['HoraSistema']) && $tel['HoraSistema'] != ''){       $a .= ",'".$tel['HoraSistema']."'" ;    }else{$a .=",''";}
		if(isset($tel['TimeStamp']) && $tel['TimeStamp'] != ''){           $a .= ",'".$tel['TimeStamp']."'" ;      }else{$a .=",''";}
		if(isset($tel['GeoLatitud']) && $tel['GeoLatitud'] != ''){         $a .= ",'".$tel['GeoLatitud']."'" ;     }else{$a .=",''";}
		if(isset($tel['GeoLongitud']) && $tel['GeoLongitud'] != ''){       $a .= ",'".$tel['GeoLongitud']."'" ;    }else{$a .=",''";}
		if(isset($tel['GeoVelocidad']) && $tel['GeoVelocidad'] != ''){     $a .= ",'".$tel['GeoVelocidad']."'" ;   }else{$a .=",''";}
		if(isset($tel['GeoDireccion']) && $tel['GeoDireccion'] != ''){     $a .= ",'".$tel['GeoDireccion']."'" ;   }else{$a .=",''";}
		if(isset($tel['GeoMovimiento']) && $tel['GeoMovimiento'] != ''){   $a .= ",'".$tel['GeoMovimiento']."'" ;  }else{$a .=",''";}
		if(isset($tel['Segundos']) && $tel['Segundos'] != ''){             $a .= ",'".$tel['Segundos']."'" ;       }else{$a .=",''";}
		if(isset($tel['Diferencia']) && $tel['Diferencia'] != ''){         $a .= ",'".$tel['Diferencia']."'" ;     }else{$a .=",''";}
		if(isset($tel['Sensor_1']) && $tel['Sensor_1'] != ''){             $a .= ",'".$tel['Sensor_1']."'" ;       }else{$a .=",''";}
		if(isset($tel['Sensor_2']) && $tel['Sensor_2'] != ''){             $a .= ",'".$tel['Sensor_2']."'" ;       }else{$a .=",''";}
		if(isset($tel['Sensor_3']) && $tel['Sensor_3'] != ''){             $a .= ",'".$tel['Sensor_3']."'" ;       }else{$a .=",''";}
		if(isset($tel['Sensor_4']) && $tel['Sensor_4'] != ''){             $a .= ",'".$tel['Sensor_4']."'" ;       }else{$a .=",''";}
		if(isset($tel['Sensor_5']) && $tel['Sensor_5'] != ''){             $a .= ",'".$tel['Sensor_5']."'" ;       }else{$a .=",''";}
		if(isset($tel['Sensor_6']) && $tel['Sensor_6'] != ''){             $a .= ",'".$tel['Sensor_6']."'" ;       }else{$a .=",''";}
		if(isset($tel['Sensor_7']) && $tel['Sensor_7'] != ''){             $a .= ",'".$tel['Sensor_7']."'" ;       }else{$a .=",''";}
		if(isset($tel['Sensor_8']) && $tel['Sensor_8'] != ''){             $a .= ",'".$tel['Sensor_8']."'" ;       }else{$a .=",''";}
		if(isset($tel['Sensor_9']) && $tel['Sensor_9'] != ''){             $a .= ",'".$tel['Sensor_9']."'" ;       }else{$a .=",''";}
		if(isset($tel['Sensor_10']) && $tel['Sensor_10'] != ''){           $a .= ",'".$tel['Sensor_10']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_11']) && $tel['Sensor_11'] != ''){           $a .= ",'".$tel['Sensor_11']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_12']) && $tel['Sensor_12'] != ''){           $a .= ",'".$tel['Sensor_12']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_13']) && $tel['Sensor_13'] != ''){           $a .= ",'".$tel['Sensor_13']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_14']) && $tel['Sensor_14'] != ''){           $a .= ",'".$tel['Sensor_14']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_15']) && $tel['Sensor_15'] != ''){           $a .= ",'".$tel['Sensor_15']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_16']) && $tel['Sensor_16'] != ''){           $a .= ",'".$tel['Sensor_16']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_17']) && $tel['Sensor_17'] != ''){           $a .= ",'".$tel['Sensor_17']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_18']) && $tel['Sensor_18'] != ''){           $a .= ",'".$tel['Sensor_18']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_19']) && $tel['Sensor_19'] != ''){           $a .= ",'".$tel['Sensor_19']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_20']) && $tel['Sensor_20'] != ''){           $a .= ",'".$tel['Sensor_20']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_21']) && $tel['Sensor_21'] != ''){           $a .= ",'".$tel['Sensor_21']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_22']) && $tel['Sensor_22'] != ''){           $a .= ",'".$tel['Sensor_22']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_23']) && $tel['Sensor_23'] != ''){           $a .= ",'".$tel['Sensor_23']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_24']) && $tel['Sensor_24'] != ''){           $a .= ",'".$tel['Sensor_24']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_25']) && $tel['Sensor_25'] != ''){           $a .= ",'".$tel['Sensor_25']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_26']) && $tel['Sensor_26'] != ''){           $a .= ",'".$tel['Sensor_26']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_27']) && $tel['Sensor_27'] != ''){           $a .= ",'".$tel['Sensor_27']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_28']) && $tel['Sensor_28'] != ''){           $a .= ",'".$tel['Sensor_28']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_29']) && $tel['Sensor_29'] != ''){           $a .= ",'".$tel['Sensor_29']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_30']) && $tel['Sensor_30'] != ''){           $a .= ",'".$tel['Sensor_30']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_31']) && $tel['Sensor_31'] != ''){           $a .= ",'".$tel['Sensor_31']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_32']) && $tel['Sensor_32'] != ''){           $a .= ",'".$tel['Sensor_32']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_33']) && $tel['Sensor_33'] != ''){           $a .= ",'".$tel['Sensor_33']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_34']) && $tel['Sensor_34'] != ''){           $a .= ",'".$tel['Sensor_34']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_35']) && $tel['Sensor_35'] != ''){           $a .= ",'".$tel['Sensor_35']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_36']) && $tel['Sensor_36'] != ''){           $a .= ",'".$tel['Sensor_36']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_37']) && $tel['Sensor_37'] != ''){           $a .= ",'".$tel['Sensor_37']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_38']) && $tel['Sensor_38'] != ''){           $a .= ",'".$tel['Sensor_38']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_39']) && $tel['Sensor_39'] != ''){           $a .= ",'".$tel['Sensor_39']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_40']) && $tel['Sensor_40'] != ''){           $a .= ",'".$tel['Sensor_40']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_41']) && $tel['Sensor_41'] != ''){           $a .= ",'".$tel['Sensor_41']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_42']) && $tel['Sensor_42'] != ''){           $a .= ",'".$tel['Sensor_42']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_43']) && $tel['Sensor_43'] != ''){           $a .= ",'".$tel['Sensor_43']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_44']) && $tel['Sensor_44'] != ''){           $a .= ",'".$tel['Sensor_44']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_45']) && $tel['Sensor_45'] != ''){           $a .= ",'".$tel['Sensor_45']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_46']) && $tel['Sensor_46'] != ''){           $a .= ",'".$tel['Sensor_46']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_47']) && $tel['Sensor_47'] != ''){           $a .= ",'".$tel['Sensor_47']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_48']) && $tel['Sensor_48'] != ''){           $a .= ",'".$tel['Sensor_48']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_49']) && $tel['Sensor_49'] != ''){           $a .= ",'".$tel['Sensor_49']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_50']) && $tel['Sensor_50'] != ''){           $a .= ",'".$tel['Sensor_50']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_51']) && $tel['Sensor_51'] != ''){           $a .= ",'".$tel['Sensor_51']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_52']) && $tel['Sensor_52'] != ''){           $a .= ",'".$tel['Sensor_52']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_53']) && $tel['Sensor_53'] != ''){           $a .= ",'".$tel['Sensor_53']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_54']) && $tel['Sensor_54'] != ''){           $a .= ",'".$tel['Sensor_54']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_55']) && $tel['Sensor_55'] != ''){           $a .= ",'".$tel['Sensor_55']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_56']) && $tel['Sensor_56'] != ''){           $a .= ",'".$tel['Sensor_56']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_57']) && $tel['Sensor_57'] != ''){           $a .= ",'".$tel['Sensor_57']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_58']) && $tel['Sensor_58'] != ''){           $a .= ",'".$tel['Sensor_58']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_59']) && $tel['Sensor_59'] != ''){           $a .= ",'".$tel['Sensor_59']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_60']) && $tel['Sensor_60'] != ''){           $a .= ",'".$tel['Sensor_60']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_61']) && $tel['Sensor_61'] != ''){           $a .= ",'".$tel['Sensor_61']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_62']) && $tel['Sensor_62'] != ''){           $a .= ",'".$tel['Sensor_62']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_63']) && $tel['Sensor_63'] != ''){           $a .= ",'".$tel['Sensor_63']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_64']) && $tel['Sensor_64'] != ''){           $a .= ",'".$tel['Sensor_64']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_65']) && $tel['Sensor_65'] != ''){           $a .= ",'".$tel['Sensor_65']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_66']) && $tel['Sensor_66'] != ''){           $a .= ",'".$tel['Sensor_66']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_67']) && $tel['Sensor_67'] != ''){           $a .= ",'".$tel['Sensor_67']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_68']) && $tel['Sensor_68'] != ''){           $a .= ",'".$tel['Sensor_68']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_69']) && $tel['Sensor_69'] != ''){           $a .= ",'".$tel['Sensor_69']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_70']) && $tel['Sensor_70'] != ''){           $a .= ",'".$tel['Sensor_70']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_71']) && $tel['Sensor_71'] != ''){           $a .= ",'".$tel['Sensor_71']."'" ;      }else{$a .=",''";}
		if(isset($tel['Sensor_72']) && $tel['Sensor_72'] != ''){           $a .= ",'".$tel['Sensor_72']."'" ;      }else{$a .=",''";}
		
		// inserto los datos de registro en la db
		$query  = "INSERT INTO `backup_telemetria_listado_tablarelacionada_".$tel['idTelemetria']."` (
		idTabla,idTelemetria,idContrato, idSolicitud,idZona,idGeocerca,Fecha,Hora,FechaSistema,
		HoraSistema,TimeStamp, GeoLatitud,GeoLongitud,GeoVelocidad,GeoDireccion,GeoMovimiento,
		Segundos, Diferencia,Sensor_1,Sensor_2,Sensor_3,Sensor_4,Sensor_5,Sensor_6,Sensor_7,Sensor_8,
		Sensor_9,Sensor_10,Sensor_11,Sensor_12,Sensor_13,Sensor_14,Sensor_15,Sensor_16,Sensor_17,
		Sensor_18,Sensor_19,Sensor_20,Sensor_21,Sensor_22,Sensor_23,Sensor_24,Sensor_25,Sensor_26,
		Sensor_27,Sensor_28,Sensor_29,Sensor_30,Sensor_31,Sensor_32,Sensor_33,Sensor_34,Sensor_35,
		Sensor_36,Sensor_37,Sensor_38,Sensor_39,Sensor_40,Sensor_41,Sensor_42,Sensor_43,
		Sensor_44,Sensor_45,Sensor_46,Sensor_47,Sensor_48,Sensor_49,Sensor_50,Sensor_51,
		Sensor_52,Sensor_53,Sensor_54,Sensor_55,Sensor_56,Sensor_57,Sensor_58,Sensor_59,
		Sensor_60,Sensor_61,Sensor_62,Sensor_63,Sensor_64,Sensor_65,Sensor_66,Sensor_67,
		Sensor_68,Sensor_69,Sensor_70,Sensor_71,Sensor_72) 
		VALUES (".$a.")";
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
		
	}
	
	/**************************************************/
	//elimino los datos
	$query  = "DELETE FROM `telemetria_listado_tablarelacionada_".$tel['idTelemetria']."` WHERE idTabla BETWEEN 1 AND ".$rowPuntero['idTabla'];
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	
				
}	


?>
