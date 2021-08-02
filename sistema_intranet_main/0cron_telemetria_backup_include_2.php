<?php
/**********************************************************************************************************************************/
/*                                              Alertas de telemetria 999                                                         */
/**********************************************************************************************************************************/
/**************************************************/
//Obtengo los punteros para el respaldo
$query = "SELECT idErrores FROM ".$tabla_2."  
ORDER BY idErrores DESC LIMIT 1 OFFSET ".$N_Reg_Errores999;
//Consulta
$resultado = mysqli_query ($dbConn, $query);
$rowPuntero = mysqli_fetch_assoc ($resultado);
	
/**************************************************/
//hago una seleccion de datos
$arrSeleccion = array();
$query = "SELECT idErrores,idSistema,idTelemetria,idTipo,Fecha,
Hora,Sensor,Descripcion,Valor,Valor_min,Valor_max,GeoLatitud,
GeoLongitud,TimeStamp,idPersonalizado,idLeido
FROM `".$tabla_2."`
WHERE idErrores BETWEEN 1 AND ".$rowPuntero['idErrores'];
//Consulta
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrSeleccion,$row );
}

/**************************************************/
//verifico si tabla de respaldo existe, si no existe se crea
$query = "SELECT idErrores FROM ".$tabla_2_backup." ORDER BY idErrores DESC LIMIT 1";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
if($resultado !== FALSE){
	//tabla existe, no se hace nada
}else{
		
	try {
		// elimino la tabla si es que existe
		//$query  = "DROP TABLE IF EXISTS `".$tabla_2_backup."`";
		//$result = mysqli_query($dbConn, $query);
		
		// se crea la nueva tabla
		$query  = "CREATE TABLE `".$tabla_2_backup."` (
			  `idErrores` int(11) unsigned NOT NULL AUTO_INCREMENT,
			  `idSistema` int(11) unsigned NOT NULL,
			  `idTelemetria` int(11) unsigned NOT NULL,
			  `idTipo` int(11) unsigned NOT NULL,
			  `Fecha` date NOT NULL,
			  `Hora` time NOT NULL,
			  `Sensor` int(2) unsigned NOT NULL,
			  `Descripcion` text NOT NULL,
			  `Valor` decimal(11,6) NOT NULL,
			  `Valor_min` decimal(11,6) NOT NULL,
			  `Valor_max` decimal(11,6) NOT NULL,
			  `GeoLatitud` double NOT NULL,
			  `GeoLongitud` double NOT NULL,
			  `TimeStamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
			  `idPersonalizado` int(10) unsigned NOT NULL,
			  `idLeido` int(10) unsigned NOT NULL,
			  PRIMARY KEY (`idErrores`)
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
	if(isset($tel['idErrores']) && $tel['idErrores'] != ''){               $a  = "'".$tel['idErrores']."'" ;         }else{$a  ="''";}
	if(isset($tel['idSistema']) && $tel['idSistema'] != ''){               $a .= ",'".$tel['idSistema']."'" ;        }else{$a .=",''";}
	if(isset($tel['idTelemetria']) && $tel['idTelemetria'] != ''){         $a .= ",'".$tel['idTelemetria']."'" ;     }else{$a .=",''";}
	if(isset($tel['idTipo']) && $tel['idTipo'] != ''){                     $a .= ",'".$tel['idTipo']."'" ;           }else{$a .=",''";}
	if(isset($tel['Fecha']) && $tel['Fecha'] != ''){                       $a .= ",'".$tel['Fecha']."'" ;            }else{$a .=",''";}
	if(isset($tel['Hora']) && $tel['Hora'] != ''){                         $a .= ",'".$tel['Hora']."'" ;             }else{$a .=",''";}
	if(isset($tel['Sensor']) && $tel['Sensor'] != ''){                     $a .= ",'".$tel['Sensor']."'" ;           }else{$a .=",''";}
	if(isset($tel['Descripcion']) && $tel['Descripcion'] != ''){           $a .= ",'".$tel['Descripcion']."'" ;      }else{$a .=",''";}
	if(isset($tel['Valor']) && $tel['Valor'] != ''){                       $a .= ",'".$tel['Valor']."'" ;            }else{$a .=",''";}
	if(isset($tel['Valor_min']) && $tel['Valor_min'] != ''){               $a .= ",'".$tel['Valor_min']."'" ;        }else{$a .=",''";}
	if(isset($tel['Valor_max']) && $tel['Valor_max'] != ''){               $a .= ",'".$tel['Valor_max']."'" ;        }else{$a .=",''";}
	if(isset($tel['GeoLatitud']) && $tel['GeoLatitud'] != ''){             $a .= ",'".$tel['GeoLatitud']."'" ;       }else{$a .=",''";}
	if(isset($tel['GeoLongitud']) && $tel['GeoLongitud'] != ''){           $a .= ",'".$tel['GeoLongitud']."'" ;      }else{$a .=",''";}
	if(isset($tel['TimeStamp']) && $tel['TimeStamp'] != ''){               $a .= ",'".$tel['TimeStamp']."'" ;        }else{$a .=",''";}
	if(isset($tel['idPersonalizado']) && $tel['idPersonalizado'] != ''){   $a .= ",'".$tel['idPersonalizado']."'" ;  }else{$a .=",''";}
	if(isset($tel['idLeido']) && $tel['idLeido'] != ''){                   $a .= ",'".$tel['idLeido']."'" ;          }else{$a .=",''";}
		
	// inserto los datos de registro en la db
	$query  = "INSERT INTO `".$tabla_2_backup."` (idErrores,
	idSistema,idTelemetria,idTipo,Fecha, Hora,Sensor,Descripcion,Valor,
	Valor_min,Valor_max,GeoLatitud, GeoLongitud,TimeStamp,idPersonalizado,idLeido) 
	VALUES (".$a.")";
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
		
}
	
/**************************************************/
//elimino los datos
$query  = "DELETE FROM `".$tabla_2."` WHERE idErrores BETWEEN 1 AND ".$rowPuntero['idErrores'];
//Consulta
$resultado = mysqli_query ($dbConn, $query);


?>
