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
	if ( !empty($_POST['idTelemetria']) )                 $idTelemetria                  = $_POST['idTelemetria'];
	if ( !empty($_POST['idSistema']) )                    $idSistema                     = $_POST['idSistema'];
	if ( !empty($_POST['idEstado']) )                     $idEstado                      = $_POST['idEstado'];
	if ( !empty($_POST['Identificador']) )                $Identificador                 = $_POST['Identificador'];
	if ( !empty($_POST['Nombre']) )                       $Nombre                        = $_POST['Nombre'];
	if ( !empty($_POST['idCiudad']) )                     $idCiudad                      = $_POST['idCiudad'];
	if ( !empty($_POST['idComuna']) )                     $idComuna                      = $_POST['idComuna'];
	if ( !empty($_POST['Direccion']) )                    $Direccion                     = $_POST['Direccion'];
	if ( !empty($_POST['GeoLatitud']) )                   $GeoLatitud                    = $_POST['GeoLatitud'];
	if ( !empty($_POST['GeoLongitud']) )                  $GeoLongitud                   = $_POST['GeoLongitud'];
	if ( !empty($_POST['GeoVelocidad']) )                 $GeoVelocidad                  = $_POST['GeoVelocidad'];
	if ( !empty($_POST['GeoDireccion']) )                 $GeoDireccion                  = $_POST['GeoDireccion'];
	if ( !empty($_POST['GeoMovimiento']) )                $GeoMovimiento                 = $_POST['GeoMovimiento'];
	if ( !empty($_POST['GeoTiempoDetencion']) )           $GeoTiempoDetencion            = $_POST['GeoTiempoDetencion'];
	if ( !empty($_POST['LastUpdateFecha']) )              $LastUpdateFecha               = $_POST['LastUpdateFecha'];
	if ( !empty($_POST['LastUpdateHora']) )               $LastUpdateHora                = $_POST['LastUpdateHora'];
	if ( !empty($_POST['id_Geo']) )                       $id_Geo                        = $_POST['id_Geo'];
	if ( !empty($_POST['id_Sensores']) )                  $id_Sensores                   = $_POST['id_Sensores'];
	if ( !empty($_POST['cantSensores']) )                 $cantSensores                  = $_POST['cantSensores'];
	if ( !empty($_POST['idDispositivo']) )                $idDispositivo                 = $_POST['idDispositivo'];
	if ( isset($_POST['idShield']) )                      $idShield                      = $_POST['idShield'];
	if ( !empty($_POST['Sim_Num_Tel']) )                  $Sim_Num_Tel                   = $_POST['Sim_Num_Tel'];
	if ( !empty($_POST['Sim_Num_Serie']) )                $Sim_Num_Serie                 = $_POST['Sim_Num_Serie'];
	if ( !empty($_POST['Sim_modelo']) )                   $Sim_modelo                    = $_POST['Sim_modelo'];
	if ( !empty($_POST['Sim_marca']) )                    $Sim_marca                     = $_POST['Sim_marca'];
	if ( !empty($_POST['Sim_Compania']) )                 $Sim_Compania                  = $_POST['Sim_Compania'];
	if ( !empty($_POST['tabla_relacionada']) )            $tabla_relacionada             = $_POST['tabla_relacionada'];
	if ( !empty($_POST['idEstadoEncendido']) )            $idEstadoEncendido             = $_POST['idEstadoEncendido'];
	if ( !empty($_POST['LimiteVelocidad']) )              $LimiteVelocidad               = $_POST['LimiteVelocidad'];
	if ( !empty($_POST['idAlarmaGeneral']) )              $idAlarmaGeneral               = $_POST['idAlarmaGeneral'];
	if ( isset($_POST['IdentificadorEmpresa']) )          $IdentificadorEmpresa          = $_POST['IdentificadorEmpresa'];
	if ( !empty($_POST['NDetenciones']) )                 $NDetenciones                  = $_POST['NDetenciones'];
	if ( !empty($_POST['TiempoFueraLinea']) )             $TiempoFueraLinea              = $_POST['TiempoFueraLinea'];
	if ( !empty($_POST['TiempoDetencion']) )              $TiempoDetencion               = $_POST['TiempoDetencion'];
	if ( !empty($_POST['idZona']) )                       $idZona                        = $_POST['idZona'];
	if ( !empty($_POST['IP_Client']) )                    $IP_Client                     = $_POST['SensorActivacionID'];
	if ( !empty($_POST['SensorActivacionID']) )           $SensorActivacionID            = $_POST['SensorActivacionID'];
	if ( isset($_POST['SensorActivacionValor']) )         $SensorActivacionValor         = $_POST['SensorActivacionValor'];
	if ( !empty($_POST['Jornada_inicio']) )               $Jornada_inicio                = $_POST['Jornada_inicio'];
	if ( !empty($_POST['Jornada_termino']) )              $Jornada_termino               = $_POST['Jornada_termino'];
	if ( !empty($_POST['Colacion_inicio']) )              $Colacion_inicio               = $_POST['Colacion_inicio'];
	if ( !empty($_POST['Colacion_termino']) )             $Colacion_termino              = $_POST['Colacion_termino'];
	if ( !empty($_POST['Microparada']) )                  $Microparada                   = $_POST['Microparada'];
	if ( !empty($_POST['idUsoContrato']) )                $idUsoContrato                 = $_POST['idUsoContrato'];
	if ( !empty($_POST['idContrato']) )                   $idContrato                    = $_POST['idContrato'];
	if ( !empty($_POST['Codigo']) )                       $Codigo                        = $_POST['Codigo'];
	if ( !empty($_POST['F_Inicio']) )                     $F_Inicio                      = $_POST['F_Inicio'];
	if ( !empty($_POST['F_Termino']) )                    $F_Termino                     = $_POST['F_Termino'];
	if ( !empty($_POST['idUsoPredio']) )                  $idUsoPredio                   = $_POST['idUsoPredio'];
	if ( !empty($_POST['idMantencion']) )                 $idMantencion                  = $_POST['idMantencion'];
	if ( !empty($_POST['idUsuarioMan']) )                 $idUsuarioMan                  = $_POST['idUsuarioMan'];
	if ( !empty($_POST['idMatriz']) )                     $idMatriz                      = $_POST['idMatriz'];
	if ( !empty($_POST['FechaMantencionIni']) )           $FechaMantencionIni            = $_POST['FechaMantencionIni'];
	if ( !empty($_POST['FechaMantencionTer']) )           $FechaMantencionTer            = $_POST['FechaMantencionTer'];
	if ( !empty($_POST['HoraMantencionIni']) )            $HoraMantencionIni             = $_POST['HoraMantencionIni'];
	if ( !empty($_POST['HoraMantencionTer']) )            $HoraMantencionTer             = $_POST['HoraMantencionTer'];
	if ( !empty($_POST['Hor_idActivo_dia1']) )            $Hor_idActivo_dia1             = $_POST['Hor_idActivo_dia1'];
	if ( !empty($_POST['Hor_idActivo_dia2']) )            $Hor_idActivo_dia2             = $_POST['Hor_idActivo_dia2'];
	if ( !empty($_POST['Hor_idActivo_dia3']) )            $Hor_idActivo_dia3             = $_POST['Hor_idActivo_dia3'];
	if ( !empty($_POST['Hor_idActivo_dia4']) )            $Hor_idActivo_dia4             = $_POST['Hor_idActivo_dia4'];
	if ( !empty($_POST['Hor_idActivo_dia5']) )            $Hor_idActivo_dia5             = $_POST['Hor_idActivo_dia5'];
	if ( !empty($_POST['Hor_idActivo_dia6']) )            $Hor_idActivo_dia6             = $_POST['Hor_idActivo_dia6'];
	if ( !empty($_POST['Hor_idActivo_dia7']) )            $Hor_idActivo_dia7             = $_POST['Hor_idActivo_dia7'];
	if ( !empty($_POST['Hor_Inicio_dia1']) )              $Hor_Inicio_dia1               = $_POST['Hor_Inicio_dia1'];
	if ( !empty($_POST['Hor_Inicio_dia2']) )              $Hor_Inicio_dia2               = $_POST['Hor_Inicio_dia2'];
	if ( !empty($_POST['Hor_Inicio_dia3']) )              $Hor_Inicio_dia3               = $_POST['Hor_Inicio_dia3'];
	if ( !empty($_POST['Hor_Inicio_dia4']) )              $Hor_Inicio_dia4               = $_POST['Hor_Inicio_dia4'];
	if ( !empty($_POST['Hor_Inicio_dia5']) )              $Hor_Inicio_dia5               = $_POST['Hor_Inicio_dia5'];
	if ( !empty($_POST['Hor_Inicio_dia6']) )              $Hor_Inicio_dia6               = $_POST['Hor_Inicio_dia6'];
	if ( !empty($_POST['Hor_Inicio_dia7']) )              $Hor_Inicio_dia7               = $_POST['Hor_Inicio_dia7'];
	if ( !empty($_POST['Hor_Termino_dia1']) )             $Hor_Termino_dia1              = $_POST['Hor_Termino_dia1'];
	if ( !empty($_POST['Hor_Termino_dia2']) )             $Hor_Termino_dia2              = $_POST['Hor_Termino_dia2'];
	if ( !empty($_POST['Hor_Termino_dia3']) )             $Hor_Termino_dia3              = $_POST['Hor_Termino_dia3'];
	if ( !empty($_POST['Hor_Termino_dia4']) )             $Hor_Termino_dia4              = $_POST['Hor_Termino_dia4'];
	if ( !empty($_POST['Hor_Termino_dia5']) )             $Hor_Termino_dia5              = $_POST['Hor_Termino_dia5'];
	if ( !empty($_POST['Hor_Termino_dia6']) )             $Hor_Termino_dia6              = $_POST['Hor_Termino_dia6'];
	if ( !empty($_POST['Hor_Termino_dia7']) )             $Hor_Termino_dia7              = $_POST['Hor_Termino_dia7'];
	if ( !empty($_POST['Observacion']) )                  $Observacion                   = $_POST['Observacion'];
	if ( !empty($_POST['SensoresFechaUso_Fake']) )        $SensoresFechaUso_Fake         = $_POST['SensoresFechaUso_Fake'];
	if ( !empty($_POST['Capacidad']) )                    $Capacidad                     = $_POST['Capacidad'];
	
	
	
	if ( !empty($_POST['SensoresNombre_1']) )        $SensoresNombre_1        = $_POST['SensoresNombre_1'];
	if ( !empty($_POST['SensoresNombre_2']) )        $SensoresNombre_2        = $_POST['SensoresNombre_2'];
	if ( !empty($_POST['SensoresNombre_3']) )        $SensoresNombre_3        = $_POST['SensoresNombre_3'];
	if ( !empty($_POST['SensoresNombre_4']) )        $SensoresNombre_4        = $_POST['SensoresNombre_4'];
	if ( !empty($_POST['SensoresNombre_5']) )        $SensoresNombre_5        = $_POST['SensoresNombre_5'];
	if ( !empty($_POST['SensoresNombre_6']) )        $SensoresNombre_6        = $_POST['SensoresNombre_6'];
	if ( !empty($_POST['SensoresNombre_7']) )        $SensoresNombre_7        = $_POST['SensoresNombre_7'];
	if ( !empty($_POST['SensoresNombre_8']) )        $SensoresNombre_8        = $_POST['SensoresNombre_8'];
	if ( !empty($_POST['SensoresNombre_9']) )        $SensoresNombre_9        = $_POST['SensoresNombre_9'];
	if ( !empty($_POST['SensoresNombre_10']) )        $SensoresNombre_10        = $_POST['SensoresNombre_10'];
	if ( !empty($_POST['SensoresNombre_11']) )        $SensoresNombre_11        = $_POST['SensoresNombre_11'];
	if ( !empty($_POST['SensoresNombre_12']) )        $SensoresNombre_12        = $_POST['SensoresNombre_12'];
	if ( !empty($_POST['SensoresNombre_13']) )        $SensoresNombre_13        = $_POST['SensoresNombre_13'];
	if ( !empty($_POST['SensoresNombre_14']) )        $SensoresNombre_14        = $_POST['SensoresNombre_14'];
	if ( !empty($_POST['SensoresNombre_15']) )        $SensoresNombre_15        = $_POST['SensoresNombre_15'];
	if ( !empty($_POST['SensoresNombre_16']) )        $SensoresNombre_16        = $_POST['SensoresNombre_16'];
	if ( !empty($_POST['SensoresNombre_17']) )        $SensoresNombre_17        = $_POST['SensoresNombre_17'];
	if ( !empty($_POST['SensoresNombre_18']) )        $SensoresNombre_18        = $_POST['SensoresNombre_18'];
	if ( !empty($_POST['SensoresNombre_19']) )        $SensoresNombre_19        = $_POST['SensoresNombre_19'];
	if ( !empty($_POST['SensoresNombre_20']) )        $SensoresNombre_20        = $_POST['SensoresNombre_20'];
	if ( !empty($_POST['SensoresNombre_21']) )        $SensoresNombre_21        = $_POST['SensoresNombre_21'];
	if ( !empty($_POST['SensoresNombre_22']) )        $SensoresNombre_22        = $_POST['SensoresNombre_22'];
	if ( !empty($_POST['SensoresNombre_23']) )        $SensoresNombre_23        = $_POST['SensoresNombre_23'];
	if ( !empty($_POST['SensoresNombre_24']) )        $SensoresNombre_24        = $_POST['SensoresNombre_24'];
	if ( !empty($_POST['SensoresNombre_25']) )        $SensoresNombre_25        = $_POST['SensoresNombre_25'];
	if ( !empty($_POST['SensoresNombre_26']) )        $SensoresNombre_26        = $_POST['SensoresNombre_26'];
	if ( !empty($_POST['SensoresNombre_27']) )        $SensoresNombre_27        = $_POST['SensoresNombre_27'];
	if ( !empty($_POST['SensoresNombre_28']) )        $SensoresNombre_28        = $_POST['SensoresNombre_28'];
	if ( !empty($_POST['SensoresNombre_29']) )        $SensoresNombre_29        = $_POST['SensoresNombre_29'];
	if ( !empty($_POST['SensoresNombre_30']) )        $SensoresNombre_30        = $_POST['SensoresNombre_30'];
	if ( !empty($_POST['SensoresNombre_31']) )        $SensoresNombre_31        = $_POST['SensoresNombre_31'];
	if ( !empty($_POST['SensoresNombre_32']) )        $SensoresNombre_32        = $_POST['SensoresNombre_32'];
	if ( !empty($_POST['SensoresNombre_33']) )        $SensoresNombre_33        = $_POST['SensoresNombre_33'];
	if ( !empty($_POST['SensoresNombre_34']) )        $SensoresNombre_34        = $_POST['SensoresNombre_34'];
	if ( !empty($_POST['SensoresNombre_35']) )        $SensoresNombre_35        = $_POST['SensoresNombre_35'];
	if ( !empty($_POST['SensoresNombre_36']) )        $SensoresNombre_36        = $_POST['SensoresNombre_36'];
	if ( !empty($_POST['SensoresNombre_37']) )        $SensoresNombre_37        = $_POST['SensoresNombre_37'];
	if ( !empty($_POST['SensoresNombre_38']) )        $SensoresNombre_38        = $_POST['SensoresNombre_38'];
	if ( !empty($_POST['SensoresNombre_39']) )        $SensoresNombre_39        = $_POST['SensoresNombre_39'];
	if ( !empty($_POST['SensoresNombre_40']) )        $SensoresNombre_40        = $_POST['SensoresNombre_40'];
	if ( !empty($_POST['SensoresNombre_41']) )        $SensoresNombre_41        = $_POST['SensoresNombre_41'];
	if ( !empty($_POST['SensoresNombre_42']) )        $SensoresNombre_42        = $_POST['SensoresNombre_42'];
	if ( !empty($_POST['SensoresNombre_43']) )        $SensoresNombre_43        = $_POST['SensoresNombre_43'];
	if ( !empty($_POST['SensoresNombre_44']) )        $SensoresNombre_44        = $_POST['SensoresNombre_44'];
	if ( !empty($_POST['SensoresNombre_45']) )        $SensoresNombre_45        = $_POST['SensoresNombre_45'];
	if ( !empty($_POST['SensoresNombre_46']) )        $SensoresNombre_46        = $_POST['SensoresNombre_46'];
	if ( !empty($_POST['SensoresNombre_47']) )        $SensoresNombre_47        = $_POST['SensoresNombre_47'];
	if ( !empty($_POST['SensoresNombre_48']) )        $SensoresNombre_48        = $_POST['SensoresNombre_48'];
	if ( !empty($_POST['SensoresNombre_49']) )        $SensoresNombre_49        = $_POST['SensoresNombre_49'];
	if ( !empty($_POST['SensoresNombre_50']) )        $SensoresNombre_50        = $_POST['SensoresNombre_50'];
	if ( !empty($_POST['SensoresTipo_1']) )        $SensoresTipo_1        = $_POST['SensoresTipo_1'];
	if ( !empty($_POST['SensoresTipo_2']) )        $SensoresTipo_2        = $_POST['SensoresTipo_2'];
	if ( !empty($_POST['SensoresTipo_3']) )        $SensoresTipo_3        = $_POST['SensoresTipo_3'];
	if ( !empty($_POST['SensoresTipo_4']) )        $SensoresTipo_4        = $_POST['SensoresTipo_4'];
	if ( !empty($_POST['SensoresTipo_5']) )        $SensoresTipo_5        = $_POST['SensoresTipo_5'];
	if ( !empty($_POST['SensoresTipo_6']) )        $SensoresTipo_6        = $_POST['SensoresTipo_6'];
	if ( !empty($_POST['SensoresTipo_7']) )        $SensoresTipo_7        = $_POST['SensoresTipo_7'];
	if ( !empty($_POST['SensoresTipo_8']) )        $SensoresTipo_8        = $_POST['SensoresTipo_8'];
	if ( !empty($_POST['SensoresTipo_9']) )        $SensoresTipo_9        = $_POST['SensoresTipo_9'];
	if ( !empty($_POST['SensoresTipo_10']) )        $SensoresTipo_10        = $_POST['SensoresTipo_10'];
	if ( !empty($_POST['SensoresTipo_11']) )        $SensoresTipo_11        = $_POST['SensoresTipo_11'];
	if ( !empty($_POST['SensoresTipo_12']) )        $SensoresTipo_12        = $_POST['SensoresTipo_12'];
	if ( !empty($_POST['SensoresTipo_13']) )        $SensoresTipo_13        = $_POST['SensoresTipo_13'];
	if ( !empty($_POST['SensoresTipo_14']) )        $SensoresTipo_14        = $_POST['SensoresTipo_14'];
	if ( !empty($_POST['SensoresTipo_15']) )        $SensoresTipo_15        = $_POST['SensoresTipo_15'];
	if ( !empty($_POST['SensoresTipo_16']) )        $SensoresTipo_16        = $_POST['SensoresTipo_16'];
	if ( !empty($_POST['SensoresTipo_17']) )        $SensoresTipo_17        = $_POST['SensoresTipo_17'];
	if ( !empty($_POST['SensoresTipo_18']) )        $SensoresTipo_18        = $_POST['SensoresTipo_18'];
	if ( !empty($_POST['SensoresTipo_19']) )        $SensoresTipo_19        = $_POST['SensoresTipo_19'];
	if ( !empty($_POST['SensoresTipo_20']) )        $SensoresTipo_20        = $_POST['SensoresTipo_20'];
	if ( !empty($_POST['SensoresTipo_21']) )        $SensoresTipo_21        = $_POST['SensoresTipo_21'];
	if ( !empty($_POST['SensoresTipo_22']) )        $SensoresTipo_22        = $_POST['SensoresTipo_22'];
	if ( !empty($_POST['SensoresTipo_23']) )        $SensoresTipo_23        = $_POST['SensoresTipo_23'];
	if ( !empty($_POST['SensoresTipo_24']) )        $SensoresTipo_24        = $_POST['SensoresTipo_24'];
	if ( !empty($_POST['SensoresTipo_25']) )        $SensoresTipo_25        = $_POST['SensoresTipo_25'];
	if ( !empty($_POST['SensoresTipo_26']) )        $SensoresTipo_26        = $_POST['SensoresTipo_26'];
	if ( !empty($_POST['SensoresTipo_27']) )        $SensoresTipo_27        = $_POST['SensoresTipo_27'];
	if ( !empty($_POST['SensoresTipo_28']) )        $SensoresTipo_28        = $_POST['SensoresTipo_28'];
	if ( !empty($_POST['SensoresTipo_29']) )        $SensoresTipo_29        = $_POST['SensoresTipo_29'];
	if ( !empty($_POST['SensoresTipo_30']) )        $SensoresTipo_30        = $_POST['SensoresTipo_30'];
	if ( !empty($_POST['SensoresTipo_31']) )        $SensoresTipo_31        = $_POST['SensoresTipo_31'];
	if ( !empty($_POST['SensoresTipo_32']) )        $SensoresTipo_32        = $_POST['SensoresTipo_32'];
	if ( !empty($_POST['SensoresTipo_33']) )        $SensoresTipo_33        = $_POST['SensoresTipo_33'];
	if ( !empty($_POST['SensoresTipo_34']) )        $SensoresTipo_34        = $_POST['SensoresTipo_34'];
	if ( !empty($_POST['SensoresTipo_35']) )        $SensoresTipo_35        = $_POST['SensoresTipo_35'];
	if ( !empty($_POST['SensoresTipo_36']) )        $SensoresTipo_36        = $_POST['SensoresTipo_36'];
	if ( !empty($_POST['SensoresTipo_37']) )        $SensoresTipo_37        = $_POST['SensoresTipo_37'];
	if ( !empty($_POST['SensoresTipo_38']) )        $SensoresTipo_38        = $_POST['SensoresTipo_38'];
	if ( !empty($_POST['SensoresTipo_39']) )        $SensoresTipo_39        = $_POST['SensoresTipo_39'];
	if ( !empty($_POST['SensoresTipo_40']) )        $SensoresTipo_40        = $_POST['SensoresTipo_40'];
	if ( !empty($_POST['SensoresTipo_41']) )        $SensoresTipo_41        = $_POST['SensoresTipo_41'];
	if ( !empty($_POST['SensoresTipo_42']) )        $SensoresTipo_42        = $_POST['SensoresTipo_42'];
	if ( !empty($_POST['SensoresTipo_43']) )        $SensoresTipo_43        = $_POST['SensoresTipo_43'];
	if ( !empty($_POST['SensoresTipo_44']) )        $SensoresTipo_44        = $_POST['SensoresTipo_44'];
	if ( !empty($_POST['SensoresTipo_45']) )        $SensoresTipo_45        = $_POST['SensoresTipo_45'];
	if ( !empty($_POST['SensoresTipo_46']) )        $SensoresTipo_46        = $_POST['SensoresTipo_46'];
	if ( !empty($_POST['SensoresTipo_47']) )        $SensoresTipo_47        = $_POST['SensoresTipo_47'];
	if ( !empty($_POST['SensoresTipo_48']) )        $SensoresTipo_48        = $_POST['SensoresTipo_48'];
	if ( !empty($_POST['SensoresTipo_49']) )        $SensoresTipo_49        = $_POST['SensoresTipo_49'];
	if ( !empty($_POST['SensoresTipo_50']) )        $SensoresTipo_50        = $_POST['SensoresTipo_50'];
	if ( isset($_POST['SensoresMedMin_1']) )        $SensoresMedMin_1        = $_POST['SensoresMedMin_1'];
	if ( isset($_POST['SensoresMedMin_2']) )        $SensoresMedMin_2        = $_POST['SensoresMedMin_2'];
	if ( isset($_POST['SensoresMedMin_3']) )        $SensoresMedMin_3        = $_POST['SensoresMedMin_3'];
	if ( isset($_POST['SensoresMedMin_4']) )        $SensoresMedMin_4        = $_POST['SensoresMedMin_4'];
	if ( isset($_POST['SensoresMedMin_5']) )        $SensoresMedMin_5        = $_POST['SensoresMedMin_5'];
	if ( isset($_POST['SensoresMedMin_6']) )        $SensoresMedMin_6        = $_POST['SensoresMedMin_6'];
	if ( isset($_POST['SensoresMedMin_7']) )        $SensoresMedMin_7        = $_POST['SensoresMedMin_7'];
	if ( isset($_POST['SensoresMedMin_8']) )        $SensoresMedMin_8        = $_POST['SensoresMedMin_8'];
	if ( isset($_POST['SensoresMedMin_9']) )        $SensoresMedMin_9        = $_POST['SensoresMedMin_9'];
	if ( isset($_POST['SensoresMedMin_10']) )        $SensoresMedMin_10        = $_POST['SensoresMedMin_10'];
	if ( isset($_POST['SensoresMedMin_11']) )        $SensoresMedMin_11        = $_POST['SensoresMedMin_11'];
	if ( isset($_POST['SensoresMedMin_12']) )        $SensoresMedMin_12        = $_POST['SensoresMedMin_12'];
	if ( isset($_POST['SensoresMedMin_13']) )        $SensoresMedMin_13        = $_POST['SensoresMedMin_13'];
	if ( isset($_POST['SensoresMedMin_14']) )        $SensoresMedMin_14        = $_POST['SensoresMedMin_14'];
	if ( isset($_POST['SensoresMedMin_15']) )        $SensoresMedMin_15        = $_POST['SensoresMedMin_15'];
	if ( isset($_POST['SensoresMedMin_16']) )        $SensoresMedMin_16        = $_POST['SensoresMedMin_16'];
	if ( isset($_POST['SensoresMedMin_17']) )        $SensoresMedMin_17        = $_POST['SensoresMedMin_17'];
	if ( isset($_POST['SensoresMedMin_18']) )        $SensoresMedMin_18        = $_POST['SensoresMedMin_18'];
	if ( isset($_POST['SensoresMedMin_19']) )        $SensoresMedMin_19        = $_POST['SensoresMedMin_19'];
	if ( isset($_POST['SensoresMedMin_20']) )        $SensoresMedMin_20        = $_POST['SensoresMedMin_20'];
	if ( isset($_POST['SensoresMedMin_21']) )        $SensoresMedMin_21        = $_POST['SensoresMedMin_21'];
	if ( isset($_POST['SensoresMedMin_22']) )        $SensoresMedMin_22        = $_POST['SensoresMedMin_22'];
	if ( isset($_POST['SensoresMedMin_23']) )        $SensoresMedMin_23        = $_POST['SensoresMedMin_23'];
	if ( isset($_POST['SensoresMedMin_24']) )        $SensoresMedMin_24        = $_POST['SensoresMedMin_24'];
	if ( isset($_POST['SensoresMedMin_25']) )        $SensoresMedMin_25        = $_POST['SensoresMedMin_25'];
	if ( isset($_POST['SensoresMedMin_26']) )        $SensoresMedMin_26        = $_POST['SensoresMedMin_26'];
	if ( isset($_POST['SensoresMedMin_27']) )        $SensoresMedMin_27        = $_POST['SensoresMedMin_27'];
	if ( isset($_POST['SensoresMedMin_28']) )        $SensoresMedMin_28        = $_POST['SensoresMedMin_28'];
	if ( isset($_POST['SensoresMedMin_29']) )        $SensoresMedMin_29        = $_POST['SensoresMedMin_29'];
	if ( isset($_POST['SensoresMedMin_30']) )        $SensoresMedMin_30        = $_POST['SensoresMedMin_30'];
	if ( isset($_POST['SensoresMedMin_31']) )        $SensoresMedMin_31        = $_POST['SensoresMedMin_31'];
	if ( isset($_POST['SensoresMedMin_32']) )        $SensoresMedMin_32        = $_POST['SensoresMedMin_32'];
	if ( isset($_POST['SensoresMedMin_33']) )        $SensoresMedMin_33        = $_POST['SensoresMedMin_33'];
	if ( isset($_POST['SensoresMedMin_34']) )        $SensoresMedMin_34        = $_POST['SensoresMedMin_34'];
	if ( isset($_POST['SensoresMedMin_35']) )        $SensoresMedMin_35        = $_POST['SensoresMedMin_35'];
	if ( isset($_POST['SensoresMedMin_36']) )        $SensoresMedMin_36        = $_POST['SensoresMedMin_36'];
	if ( isset($_POST['SensoresMedMin_37']) )        $SensoresMedMin_37        = $_POST['SensoresMedMin_37'];
	if ( isset($_POST['SensoresMedMin_38']) )        $SensoresMedMin_38        = $_POST['SensoresMedMin_38'];
	if ( isset($_POST['SensoresMedMin_39']) )        $SensoresMedMin_39        = $_POST['SensoresMedMin_39'];
	if ( isset($_POST['SensoresMedMin_40']) )        $SensoresMedMin_40        = $_POST['SensoresMedMin_40'];
	if ( isset($_POST['SensoresMedMin_41']) )        $SensoresMedMin_41        = $_POST['SensoresMedMin_41'];
	if ( isset($_POST['SensoresMedMin_42']) )        $SensoresMedMin_42        = $_POST['SensoresMedMin_42'];
	if ( isset($_POST['SensoresMedMin_43']) )        $SensoresMedMin_43        = $_POST['SensoresMedMin_43'];
	if ( isset($_POST['SensoresMedMin_44']) )        $SensoresMedMin_44        = $_POST['SensoresMedMin_44'];
	if ( isset($_POST['SensoresMedMin_45']) )        $SensoresMedMin_45        = $_POST['SensoresMedMin_45'];
	if ( isset($_POST['SensoresMedMin_46']) )        $SensoresMedMin_46        = $_POST['SensoresMedMin_46'];
	if ( isset($_POST['SensoresMedMin_47']) )        $SensoresMedMin_47        = $_POST['SensoresMedMin_47'];
	if ( isset($_POST['SensoresMedMin_48']) )        $SensoresMedMin_48        = $_POST['SensoresMedMin_48'];
	if ( isset($_POST['SensoresMedMin_49']) )        $SensoresMedMin_49        = $_POST['SensoresMedMin_49'];
	if ( isset($_POST['SensoresMedMin_50']) )        $SensoresMedMin_50        = $_POST['SensoresMedMin_50'];
	if ( isset($_POST['SensoresMedMax_1']) )        $SensoresMedMax_1        = $_POST['SensoresMedMax_1'];
	if ( isset($_POST['SensoresMedMax_2']) )        $SensoresMedMax_2        = $_POST['SensoresMedMax_2'];
	if ( isset($_POST['SensoresMedMax_3']) )        $SensoresMedMax_3        = $_POST['SensoresMedMax_3'];
	if ( isset($_POST['SensoresMedMax_4']) )        $SensoresMedMax_4        = $_POST['SensoresMedMax_4'];
	if ( isset($_POST['SensoresMedMax_5']) )        $SensoresMedMax_5        = $_POST['SensoresMedMax_5'];
	if ( isset($_POST['SensoresMedMax_6']) )        $SensoresMedMax_6        = $_POST['SensoresMedMax_6'];
	if ( isset($_POST['SensoresMedMax_7']) )        $SensoresMedMax_7        = $_POST['SensoresMedMax_7'];
	if ( isset($_POST['SensoresMedMax_8']) )        $SensoresMedMax_8        = $_POST['SensoresMedMax_8'];
	if ( isset($_POST['SensoresMedMax_9']) )        $SensoresMedMax_9        = $_POST['SensoresMedMax_9'];
	if ( isset($_POST['SensoresMedMax_10']) )        $SensoresMedMax_10        = $_POST['SensoresMedMax_10'];
	if ( isset($_POST['SensoresMedMax_11']) )        $SensoresMedMax_11        = $_POST['SensoresMedMax_11'];
	if ( isset($_POST['SensoresMedMax_12']) )        $SensoresMedMax_12        = $_POST['SensoresMedMax_12'];
	if ( isset($_POST['SensoresMedMax_13']) )        $SensoresMedMax_13        = $_POST['SensoresMedMax_13'];
	if ( isset($_POST['SensoresMedMax_14']) )        $SensoresMedMax_14        = $_POST['SensoresMedMax_14'];
	if ( isset($_POST['SensoresMedMax_15']) )        $SensoresMedMax_15        = $_POST['SensoresMedMax_15'];
	if ( isset($_POST['SensoresMedMax_16']) )        $SensoresMedMax_16        = $_POST['SensoresMedMax_16'];
	if ( isset($_POST['SensoresMedMax_17']) )        $SensoresMedMax_17        = $_POST['SensoresMedMax_17'];
	if ( isset($_POST['SensoresMedMax_18']) )        $SensoresMedMax_18        = $_POST['SensoresMedMax_18'];
	if ( isset($_POST['SensoresMedMax_19']) )        $SensoresMedMax_19        = $_POST['SensoresMedMax_19'];
	if ( isset($_POST['SensoresMedMax_20']) )        $SensoresMedMax_20        = $_POST['SensoresMedMax_20'];
	if ( isset($_POST['SensoresMedMax_21']) )        $SensoresMedMax_21        = $_POST['SensoresMedMax_21'];
	if ( isset($_POST['SensoresMedMax_22']) )        $SensoresMedMax_22        = $_POST['SensoresMedMax_22'];
	if ( isset($_POST['SensoresMedMax_23']) )        $SensoresMedMax_23        = $_POST['SensoresMedMax_23'];
	if ( isset($_POST['SensoresMedMax_24']) )        $SensoresMedMax_24        = $_POST['SensoresMedMax_24'];
	if ( isset($_POST['SensoresMedMax_25']) )        $SensoresMedMax_25        = $_POST['SensoresMedMax_25'];
	if ( isset($_POST['SensoresMedMax_26']) )        $SensoresMedMax_26        = $_POST['SensoresMedMax_26'];
	if ( isset($_POST['SensoresMedMax_27']) )        $SensoresMedMax_27        = $_POST['SensoresMedMax_27'];
	if ( isset($_POST['SensoresMedMax_28']) )        $SensoresMedMax_28        = $_POST['SensoresMedMax_28'];
	if ( isset($_POST['SensoresMedMax_29']) )        $SensoresMedMax_29        = $_POST['SensoresMedMax_29'];
	if ( isset($_POST['SensoresMedMax_30']) )        $SensoresMedMax_30        = $_POST['SensoresMedMax_30'];
	if ( isset($_POST['SensoresMedMax_31']) )        $SensoresMedMax_31        = $_POST['SensoresMedMax_31'];
	if ( isset($_POST['SensoresMedMax_32']) )        $SensoresMedMax_32        = $_POST['SensoresMedMax_32'];
	if ( isset($_POST['SensoresMedMax_33']) )        $SensoresMedMax_33        = $_POST['SensoresMedMax_33'];
	if ( isset($_POST['SensoresMedMax_34']) )            $SensoresMedMax_34        = $_POST['SensoresMedMax_34'];
	if ( isset($_POST['SensoresMedMax_35']) )            $SensoresMedMax_35        = $_POST['SensoresMedMax_35'];
	if ( isset($_POST['SensoresMedMax_36']) )            $SensoresMedMax_36        = $_POST['SensoresMedMax_36'];
	if ( isset($_POST['SensoresMedMax_37']) )            $SensoresMedMax_37        = $_POST['SensoresMedMax_37'];
	if ( isset($_POST['SensoresMedMax_38']) )            $SensoresMedMax_38        = $_POST['SensoresMedMax_38'];
	if ( isset($_POST['SensoresMedMax_39']) )            $SensoresMedMax_39        = $_POST['SensoresMedMax_39'];
	if ( isset($_POST['SensoresMedMax_40']) )            $SensoresMedMax_40        = $_POST['SensoresMedMax_40'];
	if ( isset($_POST['SensoresMedMax_41']) )            $SensoresMedMax_41        = $_POST['SensoresMedMax_41'];
	if ( isset($_POST['SensoresMedMax_42']) )            $SensoresMedMax_42        = $_POST['SensoresMedMax_42'];
	if ( isset($_POST['SensoresMedMax_43']) )            $SensoresMedMax_43        = $_POST['SensoresMedMax_43'];
	if ( isset($_POST['SensoresMedMax_44']) )            $SensoresMedMax_44        = $_POST['SensoresMedMax_44'];
	if ( isset($_POST['SensoresMedMax_45']) )            $SensoresMedMax_45        = $_POST['SensoresMedMax_45'];
	if ( isset($_POST['SensoresMedMax_46']) )            $SensoresMedMax_46        = $_POST['SensoresMedMax_46'];
	if ( isset($_POST['SensoresMedMax_47']) )            $SensoresMedMax_47        = $_POST['SensoresMedMax_47'];
	if ( isset($_POST['SensoresMedMax_48']) )            $SensoresMedMax_48        = $_POST['SensoresMedMax_48'];
	if ( isset($_POST['SensoresMedMax_49']) )            $SensoresMedMax_49        = $_POST['SensoresMedMax_49'];
	if ( isset($_POST['SensoresMedMax_50']) )            $SensoresMedMax_50        = $_POST['SensoresMedMax_50'];
	if ( isset($_POST['SensoresMedErrores_1']) )         $SensoresMedErrores_1        = $_POST['SensoresMedErrores_1'];
	if ( isset($_POST['SensoresMedErrores_2']) )         $SensoresMedErrores_2        = $_POST['SensoresMedErrores_2'];
	if ( isset($_POST['SensoresMedErrores_3']) )         $SensoresMedErrores_3        = $_POST['SensoresMedErrores_3'];
	if ( isset($_POST['SensoresMedErrores_4']) )         $SensoresMedErrores_4        = $_POST['SensoresMedErrores_4'];
	if ( isset($_POST['SensoresMedErrores_5']) )         $SensoresMedErrores_5        = $_POST['SensoresMedErrores_5'];
	if ( isset($_POST['SensoresMedErrores_6']) )         $SensoresMedErrores_6        = $_POST['SensoresMedErrores_6'];
	if ( isset($_POST['SensoresMedErrores_7']) )         $SensoresMedErrores_7        = $_POST['SensoresMedErrores_7'];
	if ( isset($_POST['SensoresMedErrores_8']) )         $SensoresMedErrores_8        = $_POST['SensoresMedErrores_8'];
	if ( isset($_POST['SensoresMedErrores_9']) )         $SensoresMedErrores_9        = $_POST['SensoresMedErrores_9'];
	if ( isset($_POST['SensoresMedErrores_10']) )        $SensoresMedErrores_10        = $_POST['SensoresMedErrores_10'];
	if ( isset($_POST['SensoresMedErrores_11']) )        $SensoresMedErrores_11        = $_POST['SensoresMedErrores_11'];
	if ( isset($_POST['SensoresMedErrores_12']) )        $SensoresMedErrores_12        = $_POST['SensoresMedErrores_12'];
	if ( isset($_POST['SensoresMedErrores_13']) )        $SensoresMedErrores_13        = $_POST['SensoresMedErrores_13'];
	if ( isset($_POST['SensoresMedErrores_14']) )        $SensoresMedErrores_14        = $_POST['SensoresMedErrores_14'];
	if ( isset($_POST['SensoresMedErrores_15']) )        $SensoresMedErrores_15        = $_POST['SensoresMedErrores_15'];
	if ( isset($_POST['SensoresMedErrores_16']) )        $SensoresMedErrores_16        = $_POST['SensoresMedErrores_16'];
	if ( isset($_POST['SensoresMedErrores_17']) )        $SensoresMedErrores_17        = $_POST['SensoresMedErrores_17'];
	if ( isset($_POST['SensoresMedErrores_18']) )        $SensoresMedErrores_18        = $_POST['SensoresMedErrores_18'];
	if ( isset($_POST['SensoresMedErrores_19']) )        $SensoresMedErrores_19        = $_POST['SensoresMedErrores_19'];
	if ( isset($_POST['SensoresMedErrores_20']) )        $SensoresMedErrores_20        = $_POST['SensoresMedErrores_20'];
	if ( isset($_POST['SensoresMedErrores_21']) )        $SensoresMedErrores_21        = $_POST['SensoresMedErrores_21'];
	if ( isset($_POST['SensoresMedErrores_22']) )        $SensoresMedErrores_22        = $_POST['SensoresMedErrores_22'];
	if ( isset($_POST['SensoresMedErrores_23']) )        $SensoresMedErrores_23        = $_POST['SensoresMedErrores_23'];
	if ( isset($_POST['SensoresMedErrores_24']) )        $SensoresMedErrores_24        = $_POST['SensoresMedErrores_24'];
	if ( isset($_POST['SensoresMedErrores_25']) )        $SensoresMedErrores_25        = $_POST['SensoresMedErrores_25'];
	if ( isset($_POST['SensoresMedErrores_26']) )        $SensoresMedErrores_26        = $_POST['SensoresMedErrores_26'];
	if ( isset($_POST['SensoresMedErrores_27']) )        $SensoresMedErrores_27        = $_POST['SensoresMedErrores_27'];
	if ( isset($_POST['SensoresMedErrores_28']) )        $SensoresMedErrores_28        = $_POST['SensoresMedErrores_28'];
	if ( isset($_POST['SensoresMedErrores_29']) )        $SensoresMedErrores_29        = $_POST['SensoresMedErrores_29'];
	if ( isset($_POST['SensoresMedErrores_30']) )        $SensoresMedErrores_30        = $_POST['SensoresMedErrores_30'];
	if ( isset($_POST['SensoresMedErrores_31']) )        $SensoresMedErrores_31        = $_POST['SensoresMedErrores_31'];
	if ( isset($_POST['SensoresMedErrores_32']) )        $SensoresMedErrores_32        = $_POST['SensoresMedErrores_32'];
	if ( isset($_POST['SensoresMedErrores_33']) )        $SensoresMedErrores_33        = $_POST['SensoresMedErrores_33'];
	if ( isset($_POST['SensoresMedErrores_34']) )        $SensoresMedErrores_34        = $_POST['SensoresMedErrores_34'];
	if ( isset($_POST['SensoresMedErrores_35']) )        $SensoresMedErrores_35        = $_POST['SensoresMedErrores_35'];
	if ( isset($_POST['SensoresMedErrores_36']) )        $SensoresMedErrores_36        = $_POST['SensoresMedErrores_36'];
	if ( isset($_POST['SensoresMedErrores_37']) )        $SensoresMedErrores_37        = $_POST['SensoresMedErrores_37'];
	if ( isset($_POST['SensoresMedErrores_38']) )        $SensoresMedErrores_38        = $_POST['SensoresMedErrores_38'];
	if ( isset($_POST['SensoresMedErrores_39']) )        $SensoresMedErrores_39        = $_POST['SensoresMedErrores_39'];
	if ( isset($_POST['SensoresMedErrores_40']) )        $SensoresMedErrores_40        = $_POST['SensoresMedErrores_40'];
	if ( isset($_POST['SensoresMedErrores_41']) )        $SensoresMedErrores_41        = $_POST['SensoresMedErrores_41'];
	if ( isset($_POST['SensoresMedErrores_42']) )        $SensoresMedErrores_42        = $_POST['SensoresMedErrores_42'];
	if ( isset($_POST['SensoresMedErrores_43']) )        $SensoresMedErrores_43        = $_POST['SensoresMedErrores_43'];
	if ( isset($_POST['SensoresMedErrores_44']) )        $SensoresMedErrores_44        = $_POST['SensoresMedErrores_44'];
	if ( isset($_POST['SensoresMedErrores_45']) )        $SensoresMedErrores_45        = $_POST['SensoresMedErrores_45'];
	if ( isset($_POST['SensoresMedErrores_46']) )        $SensoresMedErrores_46        = $_POST['SensoresMedErrores_46'];
	if ( isset($_POST['SensoresMedErrores_47']) )        $SensoresMedErrores_47        = $_POST['SensoresMedErrores_47'];
	if ( isset($_POST['SensoresMedErrores_48']) )        $SensoresMedErrores_48        = $_POST['SensoresMedErrores_48'];
	if ( isset($_POST['SensoresMedErrores_49']) )        $SensoresMedErrores_49        = $_POST['SensoresMedErrores_49'];
	if ( isset($_POST['SensoresMedErrores_50']) )        $SensoresMedErrores_50        = $_POST['SensoresMedErrores_50'];
	if ( isset($_POST['SensoresMedErrores_2_1']) )         $SensoresMedErrores_2_1        = $_POST['SensoresMedErrores_2_1'];
	if ( isset($_POST['SensoresMedErrores_2_2']) )         $SensoresMedErrores_2_2        = $_POST['SensoresMedErrores_2_2'];
	if ( isset($_POST['SensoresMedErrores_2_3']) )         $SensoresMedErrores_2_3        = $_POST['SensoresMedErrores_2_3'];
	if ( isset($_POST['SensoresMedErrores_2_4']) )         $SensoresMedErrores_2_4        = $_POST['SensoresMedErrores_2_4'];
	if ( isset($_POST['SensoresMedErrores_2_5']) )         $SensoresMedErrores_2_5        = $_POST['SensoresMedErrores_2_5'];
	if ( isset($_POST['SensoresMedErrores_2_6']) )         $SensoresMedErrores_2_6        = $_POST['SensoresMedErrores_2_6'];
	if ( isset($_POST['SensoresMedErrores_2_7']) )         $SensoresMedErrores_2_7        = $_POST['SensoresMedErrores_2_7'];
	if ( isset($_POST['SensoresMedErrores_2_8']) )         $SensoresMedErrores_2_8        = $_POST['SensoresMedErrores_2_8'];
	if ( isset($_POST['SensoresMedErrores_2_9']) )         $SensoresMedErrores_2_9        = $_POST['SensoresMedErrores_2_9'];
	if ( isset($_POST['SensoresMedErrores_2_10']) )        $SensoresMedErrores_2_10        = $_POST['SensoresMedErrores_2_10'];
	if ( isset($_POST['SensoresMedErrores_2_11']) )        $SensoresMedErrores_2_11        = $_POST['SensoresMedErrores_2_11'];
	if ( isset($_POST['SensoresMedErrores_2_12']) )        $SensoresMedErrores_2_12        = $_POST['SensoresMedErrores_2_12'];
	if ( isset($_POST['SensoresMedErrores_2_13']) )        $SensoresMedErrores_2_13        = $_POST['SensoresMedErrores_2_13'];
	if ( isset($_POST['SensoresMedErrores_2_14']) )        $SensoresMedErrores_2_14        = $_POST['SensoresMedErrores_2_14'];
	if ( isset($_POST['SensoresMedErrores_2_15']) )        $SensoresMedErrores_2_15        = $_POST['SensoresMedErrores_2_15'];
	if ( isset($_POST['SensoresMedErrores_2_16']) )        $SensoresMedErrores_2_16        = $_POST['SensoresMedErrores_2_16'];
	if ( isset($_POST['SensoresMedErrores_2_17']) )        $SensoresMedErrores_2_17        = $_POST['SensoresMedErrores_2_17'];
	if ( isset($_POST['SensoresMedErrores_2_18']) )        $SensoresMedErrores_2_18        = $_POST['SensoresMedErrores_2_18'];
	if ( isset($_POST['SensoresMedErrores_2_19']) )        $SensoresMedErrores_2_19        = $_POST['SensoresMedErrores_2_19'];
	if ( isset($_POST['SensoresMedErrores_2_20']) )        $SensoresMedErrores_2_20        = $_POST['SensoresMedErrores_2_20'];
	if ( isset($_POST['SensoresMedErrores_2_21']) )        $SensoresMedErrores_2_21        = $_POST['SensoresMedErrores_2_21'];
	if ( isset($_POST['SensoresMedErrores_2_22']) )        $SensoresMedErrores_2_22        = $_POST['SensoresMedErrores_2_22'];
	if ( isset($_POST['SensoresMedErrores_2_23']) )        $SensoresMedErrores_2_23        = $_POST['SensoresMedErrores_2_23'];
	if ( isset($_POST['SensoresMedErrores_2_24']) )        $SensoresMedErrores_2_24        = $_POST['SensoresMedErrores_2_24'];
	if ( isset($_POST['SensoresMedErrores_2_25']) )        $SensoresMedErrores_2_25        = $_POST['SensoresMedErrores_2_25'];
	if ( isset($_POST['SensoresMedErrores_2_26']) )        $SensoresMedErrores_2_26        = $_POST['SensoresMedErrores_2_26'];
	if ( isset($_POST['SensoresMedErrores_2_27']) )        $SensoresMedErrores_2_27        = $_POST['SensoresMedErrores_2_27'];
	if ( isset($_POST['SensoresMedErrores_2_28']) )        $SensoresMedErrores_2_28        = $_POST['SensoresMedErrores_2_28'];
	if ( isset($_POST['SensoresMedErrores_2_29']) )        $SensoresMedErrores_2_29        = $_POST['SensoresMedErrores_2_29'];
	if ( isset($_POST['SensoresMedErrores_2_30']) )        $SensoresMedErrores_2_30        = $_POST['SensoresMedErrores_2_30'];
	if ( isset($_POST['SensoresMedErrores_2_31']) )        $SensoresMedErrores_2_31        = $_POST['SensoresMedErrores_2_31'];
	if ( isset($_POST['SensoresMedErrores_2_32']) )        $SensoresMedErrores_2_32        = $_POST['SensoresMedErrores_2_32'];
	if ( isset($_POST['SensoresMedErrores_2_33']) )        $SensoresMedErrores_2_33        = $_POST['SensoresMedErrores_2_33'];
	if ( isset($_POST['SensoresMedErrores_2_34']) )        $SensoresMedErrores_2_34        = $_POST['SensoresMedErrores_2_34'];
	if ( isset($_POST['SensoresMedErrores_2_35']) )        $SensoresMedErrores_2_35        = $_POST['SensoresMedErrores_2_35'];
	if ( isset($_POST['SensoresMedErrores_2_36']) )        $SensoresMedErrores_2_36        = $_POST['SensoresMedErrores_2_36'];
	if ( isset($_POST['SensoresMedErrores_2_37']) )        $SensoresMedErrores_2_37        = $_POST['SensoresMedErrores_2_37'];
	if ( isset($_POST['SensoresMedErrores_2_38']) )        $SensoresMedErrores_2_38        = $_POST['SensoresMedErrores_2_38'];
	if ( isset($_POST['SensoresMedErrores_2_39']) )        $SensoresMedErrores_2_39        = $_POST['SensoresMedErrores_2_39'];
	if ( isset($_POST['SensoresMedErrores_2_40']) )        $SensoresMedErrores_2_40        = $_POST['SensoresMedErrores_2_40'];
	if ( isset($_POST['SensoresMedErrores_2_41']) )        $SensoresMedErrores_2_41        = $_POST['SensoresMedErrores_2_41'];
	if ( isset($_POST['SensoresMedErrores_2_42']) )        $SensoresMedErrores_2_42        = $_POST['SensoresMedErrores_2_42'];
	if ( isset($_POST['SensoresMedErrores_2_43']) )        $SensoresMedErrores_2_43        = $_POST['SensoresMedErrores_2_43'];
	if ( isset($_POST['SensoresMedErrores_2_44']) )        $SensoresMedErrores_2_44        = $_POST['SensoresMedErrores_2_44'];
	if ( isset($_POST['SensoresMedErrores_2_45']) )        $SensoresMedErrores_2_45        = $_POST['SensoresMedErrores_2_45'];
	if ( isset($_POST['SensoresMedErrores_2_46']) )        $SensoresMedErrores_2_46        = $_POST['SensoresMedErrores_2_46'];
	if ( isset($_POST['SensoresMedErrores_2_47']) )        $SensoresMedErrores_2_47        = $_POST['SensoresMedErrores_2_47'];
	if ( isset($_POST['SensoresMedErrores_2_48']) )        $SensoresMedErrores_2_48        = $_POST['SensoresMedErrores_2_48'];
	if ( isset($_POST['SensoresMedErrores_2_49']) )        $SensoresMedErrores_2_49        = $_POST['SensoresMedErrores_2_49'];
	if ( isset($_POST['SensoresMedErrores_2_50']) )        $SensoresMedErrores_2_50        = $_POST['SensoresMedErrores_2_50'];
	if ( isset($_POST['SensoresMedErrores_3_1']) )         $SensoresMedErrores_3_1        = $_POST['SensoresMedErrores_3_1'];
	if ( isset($_POST['SensoresMedErrores_3_2']) )         $SensoresMedErrores_3_2        = $_POST['SensoresMedErrores_3_2'];
	if ( isset($_POST['SensoresMedErrores_3_3']) )         $SensoresMedErrores_3_3        = $_POST['SensoresMedErrores_3_3'];
	if ( isset($_POST['SensoresMedErrores_3_4']) )         $SensoresMedErrores_3_4        = $_POST['SensoresMedErrores_3_4'];
	if ( isset($_POST['SensoresMedErrores_3_5']) )         $SensoresMedErrores_3_5        = $_POST['SensoresMedErrores_3_5'];
	if ( isset($_POST['SensoresMedErrores_3_6']) )         $SensoresMedErrores_3_6        = $_POST['SensoresMedErrores_3_6'];
	if ( isset($_POST['SensoresMedErrores_3_7']) )         $SensoresMedErrores_3_7        = $_POST['SensoresMedErrores_3_7'];
	if ( isset($_POST['SensoresMedErrores_3_8']) )         $SensoresMedErrores_3_8        = $_POST['SensoresMedErrores_3_8'];
	if ( isset($_POST['SensoresMedErrores_3_9']) )         $SensoresMedErrores_3_9        = $_POST['SensoresMedErrores_3_9'];
	if ( isset($_POST['SensoresMedErrores_3_10']) )        $SensoresMedErrores_3_10        = $_POST['SensoresMedErrores_3_10'];
	if ( isset($_POST['SensoresMedErrores_3_11']) )        $SensoresMedErrores_3_11        = $_POST['SensoresMedErrores_3_11'];
	if ( isset($_POST['SensoresMedErrores_3_12']) )        $SensoresMedErrores_3_12        = $_POST['SensoresMedErrores_3_12'];
	if ( isset($_POST['SensoresMedErrores_3_13']) )        $SensoresMedErrores_3_13        = $_POST['SensoresMedErrores_3_13'];
	if ( isset($_POST['SensoresMedErrores_3_14']) )        $SensoresMedErrores_3_14        = $_POST['SensoresMedErrores_3_14'];
	if ( isset($_POST['SensoresMedErrores_3_15']) )        $SensoresMedErrores_3_15        = $_POST['SensoresMedErrores_3_15'];
	if ( isset($_POST['SensoresMedErrores_3_16']) )        $SensoresMedErrores_3_16        = $_POST['SensoresMedErrores_3_16'];
	if ( isset($_POST['SensoresMedErrores_3_17']) )        $SensoresMedErrores_3_17        = $_POST['SensoresMedErrores_3_17'];
	if ( isset($_POST['SensoresMedErrores_3_18']) )        $SensoresMedErrores_3_18        = $_POST['SensoresMedErrores_3_18'];
	if ( isset($_POST['SensoresMedErrores_3_19']) )        $SensoresMedErrores_3_19        = $_POST['SensoresMedErrores_3_19'];
	if ( isset($_POST['SensoresMedErrores_3_20']) )        $SensoresMedErrores_3_20        = $_POST['SensoresMedErrores_3_20'];
	if ( isset($_POST['SensoresMedErrores_3_21']) )        $SensoresMedErrores_3_21        = $_POST['SensoresMedErrores_3_21'];
	if ( isset($_POST['SensoresMedErrores_3_22']) )        $SensoresMedErrores_3_22        = $_POST['SensoresMedErrores_3_22'];
	if ( isset($_POST['SensoresMedErrores_3_23']) )        $SensoresMedErrores_3_23        = $_POST['SensoresMedErrores_3_23'];
	if ( isset($_POST['SensoresMedErrores_3_24']) )        $SensoresMedErrores_3_24        = $_POST['SensoresMedErrores_3_24'];
	if ( isset($_POST['SensoresMedErrores_3_25']) )        $SensoresMedErrores_3_25        = $_POST['SensoresMedErrores_3_25'];
	if ( isset($_POST['SensoresMedErrores_3_26']) )        $SensoresMedErrores_3_26        = $_POST['SensoresMedErrores_3_26'];
	if ( isset($_POST['SensoresMedErrores_3_27']) )        $SensoresMedErrores_3_27        = $_POST['SensoresMedErrores_3_27'];
	if ( isset($_POST['SensoresMedErrores_3_28']) )        $SensoresMedErrores_3_28        = $_POST['SensoresMedErrores_3_28'];
	if ( isset($_POST['SensoresMedErrores_3_29']) )        $SensoresMedErrores_3_29        = $_POST['SensoresMedErrores_3_29'];
	if ( isset($_POST['SensoresMedErrores_3_30']) )        $SensoresMedErrores_3_30        = $_POST['SensoresMedErrores_3_30'];
	if ( isset($_POST['SensoresMedErrores_3_31']) )        $SensoresMedErrores_3_31        = $_POST['SensoresMedErrores_3_31'];
	if ( isset($_POST['SensoresMedErrores_3_32']) )        $SensoresMedErrores_3_32        = $_POST['SensoresMedErrores_3_32'];
	if ( isset($_POST['SensoresMedErrores_3_33']) )        $SensoresMedErrores_3_33        = $_POST['SensoresMedErrores_3_33'];
	if ( isset($_POST['SensoresMedErrores_3_34']) )        $SensoresMedErrores_3_34        = $_POST['SensoresMedErrores_3_34'];
	if ( isset($_POST['SensoresMedErrores_3_35']) )        $SensoresMedErrores_3_35        = $_POST['SensoresMedErrores_3_35'];
	if ( isset($_POST['SensoresMedErrores_3_36']) )        $SensoresMedErrores_3_36        = $_POST['SensoresMedErrores_3_36'];
	if ( isset($_POST['SensoresMedErrores_3_37']) )        $SensoresMedErrores_3_37        = $_POST['SensoresMedErrores_3_37'];
	if ( isset($_POST['SensoresMedErrores_3_38']) )        $SensoresMedErrores_3_38        = $_POST['SensoresMedErrores_3_38'];
	if ( isset($_POST['SensoresMedErrores_3_39']) )        $SensoresMedErrores_3_39        = $_POST['SensoresMedErrores_3_39'];
	if ( isset($_POST['SensoresMedErrores_3_40']) )        $SensoresMedErrores_3_40        = $_POST['SensoresMedErrores_3_40'];
	if ( isset($_POST['SensoresMedErrores_3_41']) )        $SensoresMedErrores_3_41        = $_POST['SensoresMedErrores_3_41'];
	if ( isset($_POST['SensoresMedErrores_3_42']) )        $SensoresMedErrores_3_42        = $_POST['SensoresMedErrores_3_42'];
	if ( isset($_POST['SensoresMedErrores_3_43']) )        $SensoresMedErrores_3_43        = $_POST['SensoresMedErrores_3_43'];
	if ( isset($_POST['SensoresMedErrores_3_44']) )        $SensoresMedErrores_3_44        = $_POST['SensoresMedErrores_3_44'];
	if ( isset($_POST['SensoresMedErrores_3_45']) )        $SensoresMedErrores_3_45        = $_POST['SensoresMedErrores_3_45'];
	if ( isset($_POST['SensoresMedErrores_3_46']) )        $SensoresMedErrores_3_46        = $_POST['SensoresMedErrores_3_46'];
	if ( isset($_POST['SensoresMedErrores_3_47']) )        $SensoresMedErrores_3_47        = $_POST['SensoresMedErrores_3_47'];
	if ( isset($_POST['SensoresMedErrores_3_48']) )        $SensoresMedErrores_3_48        = $_POST['SensoresMedErrores_3_48'];
	if ( isset($_POST['SensoresMedErrores_3_49']) )        $SensoresMedErrores_3_49        = $_POST['SensoresMedErrores_3_49'];
	if ( isset($_POST['SensoresMedErrores_3_50']) )        $SensoresMedErrores_3_50        = $_POST['SensoresMedErrores_3_50'];
	
	
	if ( !empty($_POST['SensoresMedAlerta_1']) )          $SensoresMedAlerta_1        = $_POST['SensoresMedAlerta_1'];
	if ( !empty($_POST['SensoresMedAlerta_2']) )          $SensoresMedAlerta_2        = $_POST['SensoresMedAlerta_2'];
	if ( !empty($_POST['SensoresMedAlerta_3']) )          $SensoresMedAlerta_3        = $_POST['SensoresMedAlerta_3'];
	if ( !empty($_POST['SensoresMedAlerta_4']) )          $SensoresMedAlerta_4        = $_POST['SensoresMedAlerta_4'];
	if ( !empty($_POST['SensoresMedAlerta_5']) )          $SensoresMedAlerta_5        = $_POST['SensoresMedAlerta_5'];
	if ( !empty($_POST['SensoresMedAlerta_6']) )          $SensoresMedAlerta_6        = $_POST['SensoresMedAlerta_6'];
	if ( !empty($_POST['SensoresMedAlerta_7']) )          $SensoresMedAlerta_7        = $_POST['SensoresMedAlerta_7'];
	if ( !empty($_POST['SensoresMedAlerta_8']) )          $SensoresMedAlerta_8        = $_POST['SensoresMedAlerta_8'];
	if ( !empty($_POST['SensoresMedAlerta_9']) )          $SensoresMedAlerta_9        = $_POST['SensoresMedAlerta_9'];
	if ( !empty($_POST['SensoresMedAlerta_10']) )         $SensoresMedAlerta_10        = $_POST['SensoresMedAlerta_10'];
	if ( !empty($_POST['SensoresMedAlerta_11']) )         $SensoresMedAlerta_11        = $_POST['SensoresMedAlerta_11'];
	if ( !empty($_POST['SensoresMedAlerta_12']) )         $SensoresMedAlerta_12        = $_POST['SensoresMedAlerta_12'];
	if ( !empty($_POST['SensoresMedAlerta_13']) )         $SensoresMedAlerta_13        = $_POST['SensoresMedAlerta_13'];
	if ( !empty($_POST['SensoresMedAlerta_14']) )         $SensoresMedAlerta_14        = $_POST['SensoresMedAlerta_14'];
	if ( !empty($_POST['SensoresMedAlerta_15']) )         $SensoresMedAlerta_15        = $_POST['SensoresMedAlerta_15'];
	if ( !empty($_POST['SensoresMedAlerta_16']) )         $SensoresMedAlerta_16        = $_POST['SensoresMedAlerta_16'];
	if ( !empty($_POST['SensoresMedAlerta_17']) )         $SensoresMedAlerta_17        = $_POST['SensoresMedAlerta_17'];
	if ( !empty($_POST['SensoresMedAlerta_18']) )         $SensoresMedAlerta_18        = $_POST['SensoresMedAlerta_18'];
	if ( !empty($_POST['SensoresMedAlerta_19']) )         $SensoresMedAlerta_19        = $_POST['SensoresMedAlerta_19'];
	if ( !empty($_POST['SensoresMedAlerta_20']) )         $SensoresMedAlerta_20        = $_POST['SensoresMedAlerta_20'];
	if ( !empty($_POST['SensoresMedAlerta_21']) )         $SensoresMedAlerta_21        = $_POST['SensoresMedAlerta_21'];
	if ( !empty($_POST['SensoresMedAlerta_22']) )         $SensoresMedAlerta_22        = $_POST['SensoresMedAlerta_22'];
	if ( !empty($_POST['SensoresMedAlerta_23']) )         $SensoresMedAlerta_23        = $_POST['SensoresMedAlerta_23'];
	if ( !empty($_POST['SensoresMedAlerta_24']) )         $SensoresMedAlerta_24        = $_POST['SensoresMedAlerta_24'];
	if ( !empty($_POST['SensoresMedAlerta_25']) )         $SensoresMedAlerta_25        = $_POST['SensoresMedAlerta_25'];
	if ( !empty($_POST['SensoresMedAlerta_26']) )         $SensoresMedAlerta_26        = $_POST['SensoresMedAlerta_26'];
	if ( !empty($_POST['SensoresMedAlerta_27']) )         $SensoresMedAlerta_27        = $_POST['SensoresMedAlerta_27'];
	if ( !empty($_POST['SensoresMedAlerta_28']) )         $SensoresMedAlerta_28        = $_POST['SensoresMedAlerta_28'];
	if ( !empty($_POST['SensoresMedAlerta_29']) )         $SensoresMedAlerta_29        = $_POST['SensoresMedAlerta_29'];
	if ( !empty($_POST['SensoresMedAlerta_30']) )         $SensoresMedAlerta_30        = $_POST['SensoresMedAlerta_30'];
	if ( !empty($_POST['SensoresMedAlerta_31']) )         $SensoresMedAlerta_31        = $_POST['SensoresMedAlerta_31'];
	if ( !empty($_POST['SensoresMedAlerta_32']) )         $SensoresMedAlerta_32        = $_POST['SensoresMedAlerta_32'];
	if ( !empty($_POST['SensoresMedAlerta_33']) )         $SensoresMedAlerta_33        = $_POST['SensoresMedAlerta_33'];
	if ( !empty($_POST['SensoresMedAlerta_34']) )         $SensoresMedAlerta_34        = $_POST['SensoresMedAlerta_34'];
	if ( !empty($_POST['SensoresMedAlerta_35']) )         $SensoresMedAlerta_35        = $_POST['SensoresMedAlerta_35'];
	if ( !empty($_POST['SensoresMedAlerta_36']) )         $SensoresMedAlerta_36        = $_POST['SensoresMedAlerta_36'];
	if ( !empty($_POST['SensoresMedAlerta_37']) )         $SensoresMedAlerta_37        = $_POST['SensoresMedAlerta_37'];
	if ( !empty($_POST['SensoresMedAlerta_38']) )         $SensoresMedAlerta_38        = $_POST['SensoresMedAlerta_38'];
	if ( !empty($_POST['SensoresMedAlerta_39']) )         $SensoresMedAlerta_39        = $_POST['SensoresMedAlerta_39'];
	if ( !empty($_POST['SensoresMedAlerta_40']) )         $SensoresMedAlerta_40        = $_POST['SensoresMedAlerta_40'];
	if ( !empty($_POST['SensoresMedAlerta_41']) )         $SensoresMedAlerta_41        = $_POST['SensoresMedAlerta_41'];
	if ( !empty($_POST['SensoresMedAlerta_42']) )         $SensoresMedAlerta_42        = $_POST['SensoresMedAlerta_42'];
	if ( !empty($_POST['SensoresMedAlerta_43']) )         $SensoresMedAlerta_43        = $_POST['SensoresMedAlerta_43'];
	if ( !empty($_POST['SensoresMedAlerta_44']) )         $SensoresMedAlerta_44        = $_POST['SensoresMedAlerta_44'];
	if ( !empty($_POST['SensoresMedAlerta_45']) )         $SensoresMedAlerta_45        = $_POST['SensoresMedAlerta_45'];
	if ( !empty($_POST['SensoresMedAlerta_46']) )         $SensoresMedAlerta_46        = $_POST['SensoresMedAlerta_46'];
	if ( !empty($_POST['SensoresMedAlerta_47']) )         $SensoresMedAlerta_47        = $_POST['SensoresMedAlerta_47'];
	if ( !empty($_POST['SensoresMedAlerta_48']) )         $SensoresMedAlerta_48        = $_POST['SensoresMedAlerta_48'];
	if ( !empty($_POST['SensoresMedAlerta_49']) )         $SensoresMedAlerta_49        = $_POST['SensoresMedAlerta_49'];
	if ( !empty($_POST['SensoresMedAlerta_50']) )         $SensoresMedAlerta_50        = $_POST['SensoresMedAlerta_50'];
	if ( !empty($_POST['SensoresGrupo_1']) )          $SensoresGrupo_1        = $_POST['SensoresGrupo_1'];
	if ( !empty($_POST['SensoresGrupo_2']) )          $SensoresGrupo_2        = $_POST['SensoresGrupo_2'];
	if ( !empty($_POST['SensoresGrupo_3']) )          $SensoresGrupo_3        = $_POST['SensoresGrupo_3'];
	if ( !empty($_POST['SensoresGrupo_4']) )          $SensoresGrupo_4        = $_POST['SensoresGrupo_4'];
	if ( !empty($_POST['SensoresGrupo_5']) )          $SensoresGrupo_5        = $_POST['SensoresGrupo_5'];
	if ( !empty($_POST['SensoresGrupo_6']) )          $SensoresGrupo_6        = $_POST['SensoresGrupo_6'];
	if ( !empty($_POST['SensoresGrupo_7']) )          $SensoresGrupo_7        = $_POST['SensoresGrupo_7'];
	if ( !empty($_POST['SensoresGrupo_8']) )          $SensoresGrupo_8        = $_POST['SensoresGrupo_8'];
	if ( !empty($_POST['SensoresGrupo_9']) )          $SensoresGrupo_9        = $_POST['SensoresGrupo_9'];
	if ( !empty($_POST['SensoresGrupo_10']) )         $SensoresGrupo_10        = $_POST['SensoresGrupo_10'];
	if ( !empty($_POST['SensoresGrupo_11']) )         $SensoresGrupo_11        = $_POST['SensoresGrupo_11'];
	if ( !empty($_POST['SensoresGrupo_12']) )         $SensoresGrupo_12        = $_POST['SensoresGrupo_12'];
	if ( !empty($_POST['SensoresGrupo_13']) )         $SensoresGrupo_13        = $_POST['SensoresGrupo_13'];
	if ( !empty($_POST['SensoresGrupo_14']) )         $SensoresGrupo_14        = $_POST['SensoresGrupo_14'];
	if ( !empty($_POST['SensoresGrupo_15']) )         $SensoresGrupo_15        = $_POST['SensoresGrupo_15'];
	if ( !empty($_POST['SensoresGrupo_16']) )         $SensoresGrupo_16        = $_POST['SensoresGrupo_16'];
	if ( !empty($_POST['SensoresGrupo_17']) )         $SensoresGrupo_17        = $_POST['SensoresGrupo_17'];
	if ( !empty($_POST['SensoresGrupo_18']) )         $SensoresGrupo_18        = $_POST['SensoresGrupo_18'];
	if ( !empty($_POST['SensoresGrupo_19']) )         $SensoresGrupo_19        = $_POST['SensoresGrupo_19'];
	if ( !empty($_POST['SensoresGrupo_20']) )         $SensoresGrupo_20        = $_POST['SensoresGrupo_20'];
	if ( !empty($_POST['SensoresGrupo_21']) )         $SensoresGrupo_21        = $_POST['SensoresGrupo_21'];
	if ( !empty($_POST['SensoresGrupo_22']) )         $SensoresGrupo_22        = $_POST['SensoresGrupo_22'];
	if ( !empty($_POST['SensoresGrupo_23']) )         $SensoresGrupo_23        = $_POST['SensoresGrupo_23'];
	if ( !empty($_POST['SensoresGrupo_24']) )         $SensoresGrupo_24        = $_POST['SensoresGrupo_24'];
	if ( !empty($_POST['SensoresGrupo_25']) )         $SensoresGrupo_25        = $_POST['SensoresGrupo_25'];
	if ( !empty($_POST['SensoresGrupo_26']) )         $SensoresGrupo_26        = $_POST['SensoresGrupo_26'];
	if ( !empty($_POST['SensoresGrupo_27']) )         $SensoresGrupo_27        = $_POST['SensoresGrupo_27'];
	if ( !empty($_POST['SensoresGrupo_28']) )         $SensoresGrupo_28        = $_POST['SensoresGrupo_28'];
	if ( !empty($_POST['SensoresGrupo_29']) )         $SensoresGrupo_29        = $_POST['SensoresGrupo_29'];
	if ( !empty($_POST['SensoresGrupo_30']) )         $SensoresGrupo_30        = $_POST['SensoresGrupo_30'];
	if ( !empty($_POST['SensoresGrupo_31']) )         $SensoresGrupo_31        = $_POST['SensoresGrupo_31'];
	if ( !empty($_POST['SensoresGrupo_32']) )         $SensoresGrupo_32        = $_POST['SensoresGrupo_32'];
	if ( !empty($_POST['SensoresGrupo_33']) )         $SensoresGrupo_33        = $_POST['SensoresGrupo_33'];
	if ( !empty($_POST['SensoresGrupo_34']) )         $SensoresGrupo_34        = $_POST['SensoresGrupo_34'];
	if ( !empty($_POST['SensoresGrupo_35']) )         $SensoresGrupo_35        = $_POST['SensoresGrupo_35'];
	if ( !empty($_POST['SensoresGrupo_36']) )         $SensoresGrupo_36        = $_POST['SensoresGrupo_36'];
	if ( !empty($_POST['SensoresGrupo_37']) )         $SensoresGrupo_37        = $_POST['SensoresGrupo_37'];
	if ( !empty($_POST['SensoresGrupo_38']) )         $SensoresGrupo_38        = $_POST['SensoresGrupo_38'];
	if ( !empty($_POST['SensoresGrupo_39']) )         $SensoresGrupo_39        = $_POST['SensoresGrupo_39'];
	if ( !empty($_POST['SensoresGrupo_40']) )         $SensoresGrupo_40        = $_POST['SensoresGrupo_40'];
	if ( !empty($_POST['SensoresGrupo_41']) )         $SensoresGrupo_41        = $_POST['SensoresGrupo_41'];
	if ( !empty($_POST['SensoresGrupo_42']) )         $SensoresGrupo_42        = $_POST['SensoresGrupo_42'];
	if ( !empty($_POST['SensoresGrupo_43']) )         $SensoresGrupo_43        = $_POST['SensoresGrupo_43'];
	if ( !empty($_POST['SensoresGrupo_44']) )         $SensoresGrupo_44        = $_POST['SensoresGrupo_44'];
	if ( !empty($_POST['SensoresGrupo_45']) )         $SensoresGrupo_45        = $_POST['SensoresGrupo_45'];
	if ( !empty($_POST['SensoresGrupo_46']) )         $SensoresGrupo_46        = $_POST['SensoresGrupo_46'];
	if ( !empty($_POST['SensoresGrupo_47']) )         $SensoresGrupo_47        = $_POST['SensoresGrupo_47'];
	if ( !empty($_POST['SensoresGrupo_48']) )         $SensoresGrupo_48        = $_POST['SensoresGrupo_48'];
	if ( !empty($_POST['SensoresGrupo_49']) )         $SensoresGrupo_49        = $_POST['SensoresGrupo_49'];
	if ( !empty($_POST['SensoresGrupo_50']) )         $SensoresGrupo_50        = $_POST['SensoresGrupo_50'];
	if ( !empty($_POST['SensoresUniMed_1']) )          $SensoresUniMed_1        = $_POST['SensoresUniMed_1'];
	if ( !empty($_POST['SensoresUniMed_2']) )          $SensoresUniMed_2        = $_POST['SensoresUniMed_2'];
	if ( !empty($_POST['SensoresUniMed_3']) )          $SensoresUniMed_3        = $_POST['SensoresUniMed_3'];
	if ( !empty($_POST['SensoresUniMed_4']) )          $SensoresUniMed_4        = $_POST['SensoresUniMed_4'];
	if ( !empty($_POST['SensoresUniMed_5']) )          $SensoresUniMed_5        = $_POST['SensoresUniMed_5'];
	if ( !empty($_POST['SensoresUniMed_6']) )          $SensoresUniMed_6        = $_POST['SensoresUniMed_6'];
	if ( !empty($_POST['SensoresUniMed_7']) )          $SensoresUniMed_7        = $_POST['SensoresUniMed_7'];
	if ( !empty($_POST['SensoresUniMed_8']) )          $SensoresUniMed_8        = $_POST['SensoresUniMed_8'];
	if ( !empty($_POST['SensoresUniMed_9']) )          $SensoresUniMed_9        = $_POST['SensoresUniMed_9'];
	if ( !empty($_POST['SensoresUniMed_10']) )         $SensoresUniMed_10        = $_POST['SensoresUniMed_10'];
	if ( !empty($_POST['SensoresUniMed_11']) )         $SensoresUniMed_11        = $_POST['SensoresUniMed_11'];
	if ( !empty($_POST['SensoresUniMed_12']) )         $SensoresUniMed_12        = $_POST['SensoresUniMed_12'];
	if ( !empty($_POST['SensoresUniMed_13']) )         $SensoresUniMed_13        = $_POST['SensoresUniMed_13'];
	if ( !empty($_POST['SensoresUniMed_14']) )         $SensoresUniMed_14        = $_POST['SensoresUniMed_14'];
	if ( !empty($_POST['SensoresUniMed_15']) )         $SensoresUniMed_15        = $_POST['SensoresUniMed_15'];
	if ( !empty($_POST['SensoresUniMed_16']) )         $SensoresUniMed_16        = $_POST['SensoresUniMed_16'];
	if ( !empty($_POST['SensoresUniMed_17']) )         $SensoresUniMed_17        = $_POST['SensoresUniMed_17'];
	if ( !empty($_POST['SensoresUniMed_18']) )         $SensoresUniMed_18        = $_POST['SensoresUniMed_18'];
	if ( !empty($_POST['SensoresUniMed_19']) )         $SensoresUniMed_19        = $_POST['SensoresUniMed_19'];
	if ( !empty($_POST['SensoresUniMed_20']) )         $SensoresUniMed_20        = $_POST['SensoresUniMed_20'];
	if ( !empty($_POST['SensoresUniMed_21']) )         $SensoresUniMed_21        = $_POST['SensoresUniMed_21'];
	if ( !empty($_POST['SensoresUniMed_22']) )         $SensoresUniMed_22        = $_POST['SensoresUniMed_22'];
	if ( !empty($_POST['SensoresUniMed_23']) )         $SensoresUniMed_23        = $_POST['SensoresUniMed_23'];
	if ( !empty($_POST['SensoresUniMed_24']) )         $SensoresUniMed_24        = $_POST['SensoresUniMed_24'];
	if ( !empty($_POST['SensoresUniMed_25']) )         $SensoresUniMed_25        = $_POST['SensoresUniMed_25'];
	if ( !empty($_POST['SensoresUniMed_26']) )         $SensoresUniMed_26        = $_POST['SensoresUniMed_26'];
	if ( !empty($_POST['SensoresUniMed_27']) )         $SensoresUniMed_27        = $_POST['SensoresUniMed_27'];
	if ( !empty($_POST['SensoresUniMed_28']) )         $SensoresUniMed_28        = $_POST['SensoresUniMed_28'];
	if ( !empty($_POST['SensoresUniMed_29']) )         $SensoresUniMed_29        = $_POST['SensoresUniMed_29'];
	if ( !empty($_POST['SensoresUniMed_30']) )         $SensoresUniMed_30        = $_POST['SensoresUniMed_30'];
	if ( !empty($_POST['SensoresUniMed_31']) )         $SensoresUniMed_31        = $_POST['SensoresUniMed_31'];
	if ( !empty($_POST['SensoresUniMed_32']) )         $SensoresUniMed_32        = $_POST['SensoresUniMed_32'];
	if ( !empty($_POST['SensoresUniMed_33']) )         $SensoresUniMed_33        = $_POST['SensoresUniMed_33'];
	if ( !empty($_POST['SensoresUniMed_34']) )         $SensoresUniMed_34        = $_POST['SensoresUniMed_34'];
	if ( !empty($_POST['SensoresUniMed_35']) )         $SensoresUniMed_35        = $_POST['SensoresUniMed_35'];
	if ( !empty($_POST['SensoresUniMed_36']) )         $SensoresUniMed_36        = $_POST['SensoresUniMed_36'];
	if ( !empty($_POST['SensoresUniMed_37']) )         $SensoresUniMed_37        = $_POST['SensoresUniMed_37'];
	if ( !empty($_POST['SensoresUniMed_38']) )         $SensoresUniMed_38        = $_POST['SensoresUniMed_38'];
	if ( !empty($_POST['SensoresUniMed_39']) )         $SensoresUniMed_39        = $_POST['SensoresUniMed_39'];
	if ( !empty($_POST['SensoresUniMed_40']) )         $SensoresUniMed_40        = $_POST['SensoresUniMed_40'];
	if ( !empty($_POST['SensoresUniMed_41']) )         $SensoresUniMed_41        = $_POST['SensoresUniMed_41'];
	if ( !empty($_POST['SensoresUniMed_42']) )         $SensoresUniMed_42        = $_POST['SensoresUniMed_42'];
	if ( !empty($_POST['SensoresUniMed_43']) )         $SensoresUniMed_43        = $_POST['SensoresUniMed_43'];
	if ( !empty($_POST['SensoresUniMed_44']) )         $SensoresUniMed_44        = $_POST['SensoresUniMed_44'];
	if ( !empty($_POST['SensoresUniMed_45']) )         $SensoresUniMed_45        = $_POST['SensoresUniMed_45'];
	if ( !empty($_POST['SensoresUniMed_46']) )         $SensoresUniMed_46        = $_POST['SensoresUniMed_46'];
	if ( !empty($_POST['SensoresUniMed_47']) )         $SensoresUniMed_47        = $_POST['SensoresUniMed_47'];
	if ( !empty($_POST['SensoresUniMed_48']) )         $SensoresUniMed_48        = $_POST['SensoresUniMed_48'];
	if ( !empty($_POST['SensoresUniMed_49']) )         $SensoresUniMed_49        = $_POST['SensoresUniMed_49'];
	if ( !empty($_POST['SensoresUniMed_50']) )         $SensoresUniMed_50        = $_POST['SensoresUniMed_50'];
	if ( !empty($_POST['SensoresActivo_1']) )          $SensoresActivo_1        = $_POST['SensoresActivo_1'];
	if ( !empty($_POST['SensoresActivo_2']) )          $SensoresActivo_2        = $_POST['SensoresActivo_2'];
	if ( !empty($_POST['SensoresActivo_3']) )          $SensoresActivo_3        = $_POST['SensoresActivo_3'];
	if ( !empty($_POST['SensoresActivo_4']) )          $SensoresActivo_4        = $_POST['SensoresActivo_4'];
	if ( !empty($_POST['SensoresActivo_5']) )          $SensoresActivo_5        = $_POST['SensoresActivo_5'];
	if ( !empty($_POST['SensoresActivo_6']) )          $SensoresActivo_6        = $_POST['SensoresActivo_6'];
	if ( !empty($_POST['SensoresActivo_7']) )          $SensoresActivo_7        = $_POST['SensoresActivo_7'];
	if ( !empty($_POST['SensoresActivo_8']) )          $SensoresActivo_8        = $_POST['SensoresActivo_8'];
	if ( !empty($_POST['SensoresActivo_9']) )          $SensoresActivo_9        = $_POST['SensoresActivo_9'];
	if ( !empty($_POST['SensoresActivo_10']) )         $SensoresActivo_10        = $_POST['SensoresActivo_10'];
	if ( !empty($_POST['SensoresActivo_11']) )         $SensoresActivo_11        = $_POST['SensoresActivo_11'];
	if ( !empty($_POST['SensoresActivo_12']) )         $SensoresActivo_12        = $_POST['SensoresActivo_12'];
	if ( !empty($_POST['SensoresActivo_13']) )         $SensoresActivo_13        = $_POST['SensoresActivo_13'];
	if ( !empty($_POST['SensoresActivo_14']) )         $SensoresActivo_14        = $_POST['SensoresActivo_14'];
	if ( !empty($_POST['SensoresActivo_15']) )         $SensoresActivo_15        = $_POST['SensoresActivo_15'];
	if ( !empty($_POST['SensoresActivo_16']) )         $SensoresActivo_16        = $_POST['SensoresActivo_16'];
	if ( !empty($_POST['SensoresActivo_17']) )         $SensoresActivo_17        = $_POST['SensoresActivo_17'];
	if ( !empty($_POST['SensoresActivo_18']) )         $SensoresActivo_18        = $_POST['SensoresActivo_18'];
	if ( !empty($_POST['SensoresActivo_19']) )         $SensoresActivo_19        = $_POST['SensoresActivo_19'];
	if ( !empty($_POST['SensoresActivo_20']) )         $SensoresActivo_20        = $_POST['SensoresActivo_20'];
	if ( !empty($_POST['SensoresActivo_21']) )         $SensoresActivo_21        = $_POST['SensoresActivo_21'];
	if ( !empty($_POST['SensoresActivo_22']) )         $SensoresActivo_22        = $_POST['SensoresActivo_22'];
	if ( !empty($_POST['SensoresActivo_23']) )         $SensoresActivo_23        = $_POST['SensoresActivo_23'];
	if ( !empty($_POST['SensoresActivo_24']) )         $SensoresActivo_24        = $_POST['SensoresActivo_24'];
	if ( !empty($_POST['SensoresActivo_25']) )         $SensoresActivo_25        = $_POST['SensoresActivo_25'];
	if ( !empty($_POST['SensoresActivo_26']) )         $SensoresActivo_26        = $_POST['SensoresActivo_26'];
	if ( !empty($_POST['SensoresActivo_27']) )         $SensoresActivo_27        = $_POST['SensoresActivo_27'];
	if ( !empty($_POST['SensoresActivo_28']) )         $SensoresActivo_28        = $_POST['SensoresActivo_28'];
	if ( !empty($_POST['SensoresActivo_29']) )         $SensoresActivo_29        = $_POST['SensoresActivo_29'];
	if ( !empty($_POST['SensoresActivo_30']) )         $SensoresActivo_30        = $_POST['SensoresActivo_30'];
	if ( !empty($_POST['SensoresActivo_31']) )         $SensoresActivo_31        = $_POST['SensoresActivo_31'];
	if ( !empty($_POST['SensoresActivo_32']) )         $SensoresActivo_32        = $_POST['SensoresActivo_32'];
	if ( !empty($_POST['SensoresActivo_33']) )         $SensoresActivo_33        = $_POST['SensoresActivo_33'];
	if ( !empty($_POST['SensoresActivo_34']) )         $SensoresActivo_34        = $_POST['SensoresActivo_34'];
	if ( !empty($_POST['SensoresActivo_35']) )         $SensoresActivo_35        = $_POST['SensoresActivo_35'];
	if ( !empty($_POST['SensoresActivo_36']) )         $SensoresActivo_36        = $_POST['SensoresActivo_36'];
	if ( !empty($_POST['SensoresActivo_37']) )         $SensoresActivo_37        = $_POST['SensoresActivo_37'];
	if ( !empty($_POST['SensoresActivo_38']) )         $SensoresActivo_38        = $_POST['SensoresActivo_38'];
	if ( !empty($_POST['SensoresActivo_39']) )         $SensoresActivo_39        = $_POST['SensoresActivo_39'];
	if ( !empty($_POST['SensoresActivo_40']) )         $SensoresActivo_40        = $_POST['SensoresActivo_40'];
	if ( !empty($_POST['SensoresActivo_41']) )         $SensoresActivo_41        = $_POST['SensoresActivo_41'];
	if ( !empty($_POST['SensoresActivo_42']) )         $SensoresActivo_42        = $_POST['SensoresActivo_42'];
	if ( !empty($_POST['SensoresActivo_43']) )         $SensoresActivo_43        = $_POST['SensoresActivo_43'];
	if ( !empty($_POST['SensoresActivo_44']) )         $SensoresActivo_44        = $_POST['SensoresActivo_44'];
	if ( !empty($_POST['SensoresActivo_45']) )         $SensoresActivo_45        = $_POST['SensoresActivo_45'];
	if ( !empty($_POST['SensoresActivo_46']) )         $SensoresActivo_46        = $_POST['SensoresActivo_46'];
	if ( !empty($_POST['SensoresActivo_47']) )         $SensoresActivo_47        = $_POST['SensoresActivo_47'];
	if ( !empty($_POST['SensoresActivo_48']) )         $SensoresActivo_48        = $_POST['SensoresActivo_48'];
	if ( !empty($_POST['SensoresActivo_49']) )         $SensoresActivo_49        = $_POST['SensoresActivo_49'];
	if ( !empty($_POST['SensoresActivo_50']) )         $SensoresActivo_50        = $_POST['SensoresActivo_50'];
	if ( !empty($_POST['SensoresUso_1']) )        $SensoresUso_1        = $_POST['SensoresUso_1'];
	if ( !empty($_POST['SensoresUso_2']) )        $SensoresUso_2        = $_POST['SensoresUso_2'];
	if ( !empty($_POST['SensoresUso_3']) )        $SensoresUso_3        = $_POST['SensoresUso_3'];
	if ( !empty($_POST['SensoresUso_4']) )        $SensoresUso_4        = $_POST['SensoresUso_4'];
	if ( !empty($_POST['SensoresUso_5']) )        $SensoresUso_5        = $_POST['SensoresUso_5'];
	if ( !empty($_POST['SensoresUso_6']) )        $SensoresUso_6        = $_POST['SensoresUso_6'];
	if ( !empty($_POST['SensoresUso_7']) )        $SensoresUso_7        = $_POST['SensoresUso_7'];
	if ( !empty($_POST['SensoresUso_8']) )        $SensoresUso_8        = $_POST['SensoresUso_8'];
	if ( !empty($_POST['SensoresUso_9']) )        $SensoresUso_9        = $_POST['SensoresUso_9'];
	if ( !empty($_POST['SensoresUso_10']) )        $SensoresUso_10        = $_POST['SensoresUso_10'];
	if ( !empty($_POST['SensoresUso_11']) )        $SensoresUso_11        = $_POST['SensoresUso_11'];
	if ( !empty($_POST['SensoresUso_12']) )        $SensoresUso_12        = $_POST['SensoresUso_12'];
	if ( !empty($_POST['SensoresUso_13']) )        $SensoresUso_13        = $_POST['SensoresUso_13'];
	if ( !empty($_POST['SensoresUso_14']) )        $SensoresUso_14        = $_POST['SensoresUso_14'];
	if ( !empty($_POST['SensoresUso_15']) )        $SensoresUso_15        = $_POST['SensoresUso_15'];
	if ( !empty($_POST['SensoresUso_16']) )        $SensoresUso_16        = $_POST['SensoresUso_16'];
	if ( !empty($_POST['SensoresUso_17']) )        $SensoresUso_17        = $_POST['SensoresUso_17'];
	if ( !empty($_POST['SensoresUso_18']) )        $SensoresUso_18        = $_POST['SensoresUso_18'];
	if ( !empty($_POST['SensoresUso_19']) )        $SensoresUso_19        = $_POST['SensoresUso_19'];
	if ( !empty($_POST['SensoresUso_20']) )        $SensoresUso_20        = $_POST['SensoresUso_20'];
	if ( !empty($_POST['SensoresUso_21']) )        $SensoresUso_21        = $_POST['SensoresUso_21'];
	if ( !empty($_POST['SensoresUso_22']) )        $SensoresUso_22        = $_POST['SensoresUso_22'];
	if ( !empty($_POST['SensoresUso_23']) )        $SensoresUso_23        = $_POST['SensoresUso_23'];
	if ( !empty($_POST['SensoresUso_24']) )        $SensoresUso_24        = $_POST['SensoresUso_24'];
	if ( !empty($_POST['SensoresUso_25']) )        $SensoresUso_25        = $_POST['SensoresUso_25'];
	if ( !empty($_POST['SensoresUso_26']) )        $SensoresUso_26        = $_POST['SensoresUso_26'];
	if ( !empty($_POST['SensoresUso_27']) )        $SensoresUso_27        = $_POST['SensoresUso_27'];
	if ( !empty($_POST['SensoresUso_28']) )        $SensoresUso_28        = $_POST['SensoresUso_28'];
	if ( !empty($_POST['SensoresUso_29']) )        $SensoresUso_29        = $_POST['SensoresUso_29'];
	if ( !empty($_POST['SensoresUso_30']) )        $SensoresUso_30        = $_POST['SensoresUso_30'];
	if ( !empty($_POST['SensoresUso_31']) )        $SensoresUso_31        = $_POST['SensoresUso_31'];
	if ( !empty($_POST['SensoresUso_32']) )        $SensoresUso_32        = $_POST['SensoresUso_32'];
	if ( !empty($_POST['SensoresUso_33']) )        $SensoresUso_33        = $_POST['SensoresUso_33'];
	if ( !empty($_POST['SensoresUso_34']) )        $SensoresUso_34        = $_POST['SensoresUso_34'];
	if ( !empty($_POST['SensoresUso_35']) )        $SensoresUso_35        = $_POST['SensoresUso_35'];
	if ( !empty($_POST['SensoresUso_36']) )        $SensoresUso_36        = $_POST['SensoresUso_36'];
	if ( !empty($_POST['SensoresUso_37']) )        $SensoresUso_37        = $_POST['SensoresUso_37'];
	if ( !empty($_POST['SensoresUso_38']) )        $SensoresUso_38        = $_POST['SensoresUso_38'];
	if ( !empty($_POST['SensoresUso_39']) )        $SensoresUso_39        = $_POST['SensoresUso_39'];
	if ( !empty($_POST['SensoresUso_40']) )        $SensoresUso_40        = $_POST['SensoresUso_40'];
	if ( !empty($_POST['SensoresUso_41']) )        $SensoresUso_41        = $_POST['SensoresUso_41'];
	if ( !empty($_POST['SensoresUso_42']) )        $SensoresUso_42        = $_POST['SensoresUso_42'];
	if ( !empty($_POST['SensoresUso_43']) )        $SensoresUso_43        = $_POST['SensoresUso_43'];
	if ( !empty($_POST['SensoresUso_44']) )        $SensoresUso_44        = $_POST['SensoresUso_44'];
	if ( !empty($_POST['SensoresUso_45']) )        $SensoresUso_45        = $_POST['SensoresUso_45'];
	if ( !empty($_POST['SensoresUso_46']) )        $SensoresUso_46        = $_POST['SensoresUso_46'];
	if ( !empty($_POST['SensoresUso_47']) )        $SensoresUso_47        = $_POST['SensoresUso_47'];
	if ( !empty($_POST['SensoresUso_48']) )        $SensoresUso_48        = $_POST['SensoresUso_48'];
	if ( !empty($_POST['SensoresUso_49']) )        $SensoresUso_49        = $_POST['SensoresUso_49'];
	if ( !empty($_POST['SensoresUso_50']) )        $SensoresUso_50        = $_POST['SensoresUso_50'];
	if ( !empty($_POST['SensoresFechaUso_1']) )        $SensoresFechaUso_1        = $_POST['SensoresFechaUso_1'];
	if ( !empty($_POST['SensoresFechaUso_2']) )        $SensoresFechaUso_2        = $_POST['SensoresFechaUso_2'];
	if ( !empty($_POST['SensoresFechaUso_3']) )        $SensoresFechaUso_3        = $_POST['SensoresFechaUso_3'];
	if ( !empty($_POST['SensoresFechaUso_4']) )        $SensoresFechaUso_4        = $_POST['SensoresFechaUso_4'];
	if ( !empty($_POST['SensoresFechaUso_5']) )        $SensoresFechaUso_5        = $_POST['SensoresFechaUso_5'];
	if ( !empty($_POST['SensoresFechaUso_6']) )        $SensoresFechaUso_6        = $_POST['SensoresFechaUso_6'];
	if ( !empty($_POST['SensoresFechaUso_7']) )        $SensoresFechaUso_7        = $_POST['SensoresFechaUso_7'];
	if ( !empty($_POST['SensoresFechaUso_8']) )        $SensoresFechaUso_8        = $_POST['SensoresFechaUso_8'];
	if ( !empty($_POST['SensoresFechaUso_9']) )        $SensoresFechaUso_9        = $_POST['SensoresFechaUso_9'];
	if ( !empty($_POST['SensoresFechaUso_10']) )        $SensoresFechaUso_10        = $_POST['SensoresFechaUso_10'];
	if ( !empty($_POST['SensoresFechaUso_11']) )        $SensoresFechaUso_11        = $_POST['SensoresFechaUso_11'];
	if ( !empty($_POST['SensoresFechaUso_12']) )        $SensoresFechaUso_12        = $_POST['SensoresFechaUso_12'];
	if ( !empty($_POST['SensoresFechaUso_13']) )        $SensoresFechaUso_13        = $_POST['SensoresFechaUso_13'];
	if ( !empty($_POST['SensoresFechaUso_14']) )        $SensoresFechaUso_14        = $_POST['SensoresFechaUso_14'];
	if ( !empty($_POST['SensoresFechaUso_15']) )        $SensoresFechaUso_15        = $_POST['SensoresFechaUso_15'];
	if ( !empty($_POST['SensoresFechaUso_16']) )        $SensoresFechaUso_16        = $_POST['SensoresFechaUso_16'];
	if ( !empty($_POST['SensoresFechaUso_17']) )        $SensoresFechaUso_17        = $_POST['SensoresFechaUso_17'];
	if ( !empty($_POST['SensoresFechaUso_18']) )        $SensoresFechaUso_18        = $_POST['SensoresFechaUso_18'];
	if ( !empty($_POST['SensoresFechaUso_19']) )        $SensoresFechaUso_19        = $_POST['SensoresFechaUso_19'];
	if ( !empty($_POST['SensoresFechaUso_20']) )        $SensoresFechaUso_20        = $_POST['SensoresFechaUso_20'];
	if ( !empty($_POST['SensoresFechaUso_21']) )        $SensoresFechaUso_21        = $_POST['SensoresFechaUso_21'];
	if ( !empty($_POST['SensoresFechaUso_22']) )        $SensoresFechaUso_22        = $_POST['SensoresFechaUso_22'];
	if ( !empty($_POST['SensoresFechaUso_23']) )        $SensoresFechaUso_23        = $_POST['SensoresFechaUso_23'];
	if ( !empty($_POST['SensoresFechaUso_24']) )        $SensoresFechaUso_24        = $_POST['SensoresFechaUso_24'];
	if ( !empty($_POST['SensoresFechaUso_25']) )        $SensoresFechaUso_25        = $_POST['SensoresFechaUso_25'];
	if ( !empty($_POST['SensoresFechaUso_26']) )        $SensoresFechaUso_26        = $_POST['SensoresFechaUso_26'];
	if ( !empty($_POST['SensoresFechaUso_27']) )        $SensoresFechaUso_27        = $_POST['SensoresFechaUso_27'];
	if ( !empty($_POST['SensoresFechaUso_28']) )        $SensoresFechaUso_28        = $_POST['SensoresFechaUso_28'];
	if ( !empty($_POST['SensoresFechaUso_29']) )        $SensoresFechaUso_29        = $_POST['SensoresFechaUso_29'];
	if ( !empty($_POST['SensoresFechaUso_30']) )        $SensoresFechaUso_30        = $_POST['SensoresFechaUso_30'];
	if ( !empty($_POST['SensoresFechaUso_31']) )        $SensoresFechaUso_31        = $_POST['SensoresFechaUso_31'];
	if ( !empty($_POST['SensoresFechaUso_32']) )        $SensoresFechaUso_32        = $_POST['SensoresFechaUso_32'];
	if ( !empty($_POST['SensoresFechaUso_33']) )        $SensoresFechaUso_33        = $_POST['SensoresFechaUso_33'];
	if ( !empty($_POST['SensoresFechaUso_34']) )        $SensoresFechaUso_34        = $_POST['SensoresFechaUso_34'];
	if ( !empty($_POST['SensoresFechaUso_35']) )        $SensoresFechaUso_35        = $_POST['SensoresFechaUso_35'];
	if ( !empty($_POST['SensoresFechaUso_36']) )        $SensoresFechaUso_36        = $_POST['SensoresFechaUso_36'];
	if ( !empty($_POST['SensoresFechaUso_37']) )        $SensoresFechaUso_37        = $_POST['SensoresFechaUso_37'];
	if ( !empty($_POST['SensoresFechaUso_38']) )        $SensoresFechaUso_38        = $_POST['SensoresFechaUso_38'];
	if ( !empty($_POST['SensoresFechaUso_39']) )        $SensoresFechaUso_39        = $_POST['SensoresFechaUso_39'];
	if ( !empty($_POST['SensoresFechaUso_40']) )        $SensoresFechaUso_40        = $_POST['SensoresFechaUso_40'];
	if ( !empty($_POST['SensoresFechaUso_41']) )        $SensoresFechaUso_41        = $_POST['SensoresFechaUso_41'];
	if ( !empty($_POST['SensoresFechaUso_42']) )        $SensoresFechaUso_42        = $_POST['SensoresFechaUso_42'];
	if ( !empty($_POST['SensoresFechaUso_43']) )        $SensoresFechaUso_43        = $_POST['SensoresFechaUso_43'];
	if ( !empty($_POST['SensoresFechaUso_44']) )        $SensoresFechaUso_44        = $_POST['SensoresFechaUso_44'];
	if ( !empty($_POST['SensoresFechaUso_45']) )        $SensoresFechaUso_45        = $_POST['SensoresFechaUso_45'];
	if ( !empty($_POST['SensoresFechaUso_46']) )        $SensoresFechaUso_46        = $_POST['SensoresFechaUso_46'];
	if ( !empty($_POST['SensoresFechaUso_47']) )        $SensoresFechaUso_47        = $_POST['SensoresFechaUso_47'];
	if ( !empty($_POST['SensoresFechaUso_48']) )        $SensoresFechaUso_48        = $_POST['SensoresFechaUso_48'];
	if ( !empty($_POST['SensoresFechaUso_49']) )        $SensoresFechaUso_49        = $_POST['SensoresFechaUso_49'];
	if ( !empty($_POST['SensoresFechaUso_50']) )        $SensoresFechaUso_50        = $_POST['SensoresFechaUso_50'];
	if ( !empty($_POST['SensoresAccionC_1']) )        $SensoresAccionC_1        = $_POST['SensoresAccionC_1'];
	if ( !empty($_POST['SensoresAccionC_2']) )        $SensoresAccionC_2        = $_POST['SensoresAccionC_2'];
	if ( !empty($_POST['SensoresAccionC_3']) )        $SensoresAccionC_3        = $_POST['SensoresAccionC_3'];
	if ( !empty($_POST['SensoresAccionC_4']) )        $SensoresAccionC_4        = $_POST['SensoresAccionC_4'];
	if ( !empty($_POST['SensoresAccionC_5']) )        $SensoresAccionC_5        = $_POST['SensoresAccionC_5'];
	if ( !empty($_POST['SensoresAccionC_6']) )        $SensoresAccionC_6        = $_POST['SensoresAccionC_6'];
	if ( !empty($_POST['SensoresAccionC_7']) )        $SensoresAccionC_7        = $_POST['SensoresAccionC_7'];
	if ( !empty($_POST['SensoresAccionC_8']) )        $SensoresAccionC_8        = $_POST['SensoresAccionC_8'];
	if ( !empty($_POST['SensoresAccionC_9']) )        $SensoresAccionC_9        = $_POST['SensoresAccionC_9'];
	if ( !empty($_POST['SensoresAccionC_10']) )        $SensoresAccionC_10        = $_POST['SensoresAccionC_10'];
	if ( !empty($_POST['SensoresAccionC_11']) )        $SensoresAccionC_11        = $_POST['SensoresAccionC_11'];
	if ( !empty($_POST['SensoresAccionC_12']) )        $SensoresAccionC_12        = $_POST['SensoresAccionC_12'];
	if ( !empty($_POST['SensoresAccionC_13']) )        $SensoresAccionC_13        = $_POST['SensoresAccionC_13'];
	if ( !empty($_POST['SensoresAccionC_14']) )        $SensoresAccionC_14        = $_POST['SensoresAccionC_14'];
	if ( !empty($_POST['SensoresAccionC_15']) )        $SensoresAccionC_15        = $_POST['SensoresAccionC_15'];
	if ( !empty($_POST['SensoresAccionC_16']) )        $SensoresAccionC_16        = $_POST['SensoresAccionC_16'];
	if ( !empty($_POST['SensoresAccionC_17']) )        $SensoresAccionC_17        = $_POST['SensoresAccionC_17'];
	if ( !empty($_POST['SensoresAccionC_18']) )        $SensoresAccionC_18        = $_POST['SensoresAccionC_18'];
	if ( !empty($_POST['SensoresAccionC_19']) )        $SensoresAccionC_19        = $_POST['SensoresAccionC_19'];
	if ( !empty($_POST['SensoresAccionC_20']) )        $SensoresAccionC_20        = $_POST['SensoresAccionC_20'];
	if ( !empty($_POST['SensoresAccionC_21']) )        $SensoresAccionC_21        = $_POST['SensoresAccionC_21'];
	if ( !empty($_POST['SensoresAccionC_22']) )        $SensoresAccionC_22        = $_POST['SensoresAccionC_22'];
	if ( !empty($_POST['SensoresAccionC_23']) )        $SensoresAccionC_23        = $_POST['SensoresAccionC_23'];
	if ( !empty($_POST['SensoresAccionC_24']) )        $SensoresAccionC_24        = $_POST['SensoresAccionC_24'];
	if ( !empty($_POST['SensoresAccionC_25']) )        $SensoresAccionC_25        = $_POST['SensoresAccionC_25'];
	if ( !empty($_POST['SensoresAccionC_26']) )        $SensoresAccionC_26        = $_POST['SensoresAccionC_26'];
	if ( !empty($_POST['SensoresAccionC_27']) )        $SensoresAccionC_27        = $_POST['SensoresAccionC_27'];
	if ( !empty($_POST['SensoresAccionC_28']) )        $SensoresAccionC_28        = $_POST['SensoresAccionC_28'];
	if ( !empty($_POST['SensoresAccionC_29']) )        $SensoresAccionC_29        = $_POST['SensoresAccionC_29'];
	if ( !empty($_POST['SensoresAccionC_30']) )        $SensoresAccionC_30        = $_POST['SensoresAccionC_30'];
	if ( !empty($_POST['SensoresAccionC_31']) )        $SensoresAccionC_31        = $_POST['SensoresAccionC_31'];
	if ( !empty($_POST['SensoresAccionC_32']) )        $SensoresAccionC_32        = $_POST['SensoresAccionC_32'];
	if ( !empty($_POST['SensoresAccionC_33']) )        $SensoresAccionC_33        = $_POST['SensoresAccionC_33'];
	if ( !empty($_POST['SensoresAccionC_34']) )        $SensoresAccionC_34        = $_POST['SensoresAccionC_34'];
	if ( !empty($_POST['SensoresAccionC_35']) )        $SensoresAccionC_35        = $_POST['SensoresAccionC_35'];
	if ( !empty($_POST['SensoresAccionC_36']) )        $SensoresAccionC_36        = $_POST['SensoresAccionC_36'];
	if ( !empty($_POST['SensoresAccionC_37']) )        $SensoresAccionC_37        = $_POST['SensoresAccionC_37'];
	if ( !empty($_POST['SensoresAccionC_38']) )        $SensoresAccionC_38        = $_POST['SensoresAccionC_38'];
	if ( !empty($_POST['SensoresAccionC_39']) )        $SensoresAccionC_39        = $_POST['SensoresAccionC_39'];
	if ( !empty($_POST['SensoresAccionC_40']) )        $SensoresAccionC_40        = $_POST['SensoresAccionC_40'];
	if ( !empty($_POST['SensoresAccionC_41']) )        $SensoresAccionC_41        = $_POST['SensoresAccionC_41'];
	if ( !empty($_POST['SensoresAccionC_42']) )        $SensoresAccionC_42        = $_POST['SensoresAccionC_42'];
	if ( !empty($_POST['SensoresAccionC_43']) )        $SensoresAccionC_43        = $_POST['SensoresAccionC_43'];
	if ( !empty($_POST['SensoresAccionC_44']) )        $SensoresAccionC_44        = $_POST['SensoresAccionC_44'];
	if ( !empty($_POST['SensoresAccionC_45']) )        $SensoresAccionC_45        = $_POST['SensoresAccionC_45'];
	if ( !empty($_POST['SensoresAccionC_46']) )        $SensoresAccionC_46        = $_POST['SensoresAccionC_46'];
	if ( !empty($_POST['SensoresAccionC_47']) )        $SensoresAccionC_47        = $_POST['SensoresAccionC_47'];
	if ( !empty($_POST['SensoresAccionC_48']) )        $SensoresAccionC_48        = $_POST['SensoresAccionC_48'];
	if ( !empty($_POST['SensoresAccionC_49']) )        $SensoresAccionC_49        = $_POST['SensoresAccionC_49'];
	if ( !empty($_POST['SensoresAccionC_50']) )        $SensoresAccionC_50        = $_POST['SensoresAccionC_50'];
	if ( !empty($_POST['SensoresAccionT_1']) )        $SensoresAccionT_1        = $_POST['SensoresAccionT_1'];
	if ( !empty($_POST['SensoresAccionT_2']) )        $SensoresAccionT_2        = $_POST['SensoresAccionT_2'];
	if ( !empty($_POST['SensoresAccionT_3']) )        $SensoresAccionT_3        = $_POST['SensoresAccionT_3'];
	if ( !empty($_POST['SensoresAccionT_4']) )        $SensoresAccionT_4        = $_POST['SensoresAccionT_4'];
	if ( !empty($_POST['SensoresAccionT_5']) )        $SensoresAccionT_5        = $_POST['SensoresAccionT_5'];
	if ( !empty($_POST['SensoresAccionT_6']) )        $SensoresAccionT_6        = $_POST['SensoresAccionT_6'];
	if ( !empty($_POST['SensoresAccionT_7']) )        $SensoresAccionT_7        = $_POST['SensoresAccionT_7'];
	if ( !empty($_POST['SensoresAccionT_8']) )        $SensoresAccionT_8        = $_POST['SensoresAccionT_8'];
	if ( !empty($_POST['SensoresAccionT_9']) )        $SensoresAccionT_9        = $_POST['SensoresAccionT_9'];
	if ( !empty($_POST['SensoresAccionT_10']) )        $SensoresAccionT_10        = $_POST['SensoresAccionT_10'];
	if ( !empty($_POST['SensoresAccionT_11']) )        $SensoresAccionT_11        = $_POST['SensoresAccionT_11'];
	if ( !empty($_POST['SensoresAccionT_12']) )        $SensoresAccionT_12        = $_POST['SensoresAccionT_12'];
	if ( !empty($_POST['SensoresAccionT_13']) )        $SensoresAccionT_13        = $_POST['SensoresAccionT_13'];
	if ( !empty($_POST['SensoresAccionT_14']) )        $SensoresAccionT_14        = $_POST['SensoresAccionT_14'];
	if ( !empty($_POST['SensoresAccionT_15']) )        $SensoresAccionT_15        = $_POST['SensoresAccionT_15'];
	if ( !empty($_POST['SensoresAccionT_16']) )        $SensoresAccionT_16        = $_POST['SensoresAccionT_16'];
	if ( !empty($_POST['SensoresAccionT_17']) )        $SensoresAccionT_17        = $_POST['SensoresAccionT_17'];
	if ( !empty($_POST['SensoresAccionT_18']) )        $SensoresAccionT_18        = $_POST['SensoresAccionT_18'];
	if ( !empty($_POST['SensoresAccionT_19']) )        $SensoresAccionT_19        = $_POST['SensoresAccionT_19'];
	if ( !empty($_POST['SensoresAccionT_20']) )        $SensoresAccionT_20        = $_POST['SensoresAccionT_20'];
	if ( !empty($_POST['SensoresAccionT_21']) )        $SensoresAccionT_21        = $_POST['SensoresAccionT_21'];
	if ( !empty($_POST['SensoresAccionT_22']) )        $SensoresAccionT_22        = $_POST['SensoresAccionT_22'];
	if ( !empty($_POST['SensoresAccionT_23']) )        $SensoresAccionT_23        = $_POST['SensoresAccionT_23'];
	if ( !empty($_POST['SensoresAccionT_24']) )        $SensoresAccionT_24        = $_POST['SensoresAccionT_24'];
	if ( !empty($_POST['SensoresAccionT_25']) )        $SensoresAccionT_25        = $_POST['SensoresAccionT_25'];
	if ( !empty($_POST['SensoresAccionT_26']) )        $SensoresAccionT_26        = $_POST['SensoresAccionT_26'];
	if ( !empty($_POST['SensoresAccionT_27']) )        $SensoresAccionT_27        = $_POST['SensoresAccionT_27'];
	if ( !empty($_POST['SensoresAccionT_28']) )        $SensoresAccionT_28        = $_POST['SensoresAccionT_28'];
	if ( !empty($_POST['SensoresAccionT_29']) )        $SensoresAccionT_29        = $_POST['SensoresAccionT_29'];
	if ( !empty($_POST['SensoresAccionT_30']) )        $SensoresAccionT_30        = $_POST['SensoresAccionT_30'];
	if ( !empty($_POST['SensoresAccionT_31']) )        $SensoresAccionT_31        = $_POST['SensoresAccionT_31'];
	if ( !empty($_POST['SensoresAccionT_32']) )        $SensoresAccionT_32        = $_POST['SensoresAccionT_32'];
	if ( !empty($_POST['SensoresAccionT_33']) )        $SensoresAccionT_33        = $_POST['SensoresAccionT_33'];
	if ( !empty($_POST['SensoresAccionT_34']) )        $SensoresAccionT_34        = $_POST['SensoresAccionT_34'];
	if ( !empty($_POST['SensoresAccionT_35']) )        $SensoresAccionT_35        = $_POST['SensoresAccionT_35'];
	if ( !empty($_POST['SensoresAccionT_36']) )        $SensoresAccionT_36        = $_POST['SensoresAccionT_36'];
	if ( !empty($_POST['SensoresAccionT_37']) )        $SensoresAccionT_37        = $_POST['SensoresAccionT_37'];
	if ( !empty($_POST['SensoresAccionT_38']) )        $SensoresAccionT_38        = $_POST['SensoresAccionT_38'];
	if ( !empty($_POST['SensoresAccionT_39']) )        $SensoresAccionT_39        = $_POST['SensoresAccionT_39'];
	if ( !empty($_POST['SensoresAccionT_40']) )        $SensoresAccionT_40        = $_POST['SensoresAccionT_40'];
	if ( !empty($_POST['SensoresAccionT_41']) )        $SensoresAccionT_41        = $_POST['SensoresAccionT_41'];
	if ( !empty($_POST['SensoresAccionT_42']) )        $SensoresAccionT_42        = $_POST['SensoresAccionT_42'];
	if ( !empty($_POST['SensoresAccionT_43']) )        $SensoresAccionT_43        = $_POST['SensoresAccionT_43'];
	if ( !empty($_POST['SensoresAccionT_44']) )        $SensoresAccionT_44        = $_POST['SensoresAccionT_44'];
	if ( !empty($_POST['SensoresAccionT_45']) )        $SensoresAccionT_45        = $_POST['SensoresAccionT_45'];
	if ( !empty($_POST['SensoresAccionT_46']) )        $SensoresAccionT_46        = $_POST['SensoresAccionT_46'];
	if ( !empty($_POST['SensoresAccionT_47']) )        $SensoresAccionT_47        = $_POST['SensoresAccionT_47'];
	if ( !empty($_POST['SensoresAccionT_48']) )        $SensoresAccionT_48        = $_POST['SensoresAccionT_48'];
	if ( !empty($_POST['SensoresAccionT_49']) )        $SensoresAccionT_49        = $_POST['SensoresAccionT_49'];
	if ( !empty($_POST['SensoresAccionT_50']) )        $SensoresAccionT_50        = $_POST['SensoresAccionT_50'];
	if ( !empty($_POST['SensoresAccionAlerta_1']) )        $SensoresAccionAlerta_1        = $_POST['SensoresAccionAlerta_1'];
	if ( !empty($_POST['SensoresAccionAlerta_2']) )        $SensoresAccionAlerta_2        = $_POST['SensoresAccionAlerta_2'];
	if ( !empty($_POST['SensoresAccionAlerta_3']) )        $SensoresAccionAlerta_3        = $_POST['SensoresAccionAlerta_3'];
	if ( !empty($_POST['SensoresAccionAlerta_4']) )        $SensoresAccionAlerta_4        = $_POST['SensoresAccionAlerta_4'];
	if ( !empty($_POST['SensoresAccionAlerta_5']) )        $SensoresAccionAlerta_5        = $_POST['SensoresAccionAlerta_5'];
	if ( !empty($_POST['SensoresAccionAlerta_6']) )        $SensoresAccionAlerta_6        = $_POST['SensoresAccionAlerta_6'];
	if ( !empty($_POST['SensoresAccionAlerta_7']) )        $SensoresAccionAlerta_7        = $_POST['SensoresAccionAlerta_7'];
	if ( !empty($_POST['SensoresAccionAlerta_8']) )        $SensoresAccionAlerta_8        = $_POST['SensoresAccionAlerta_8'];
	if ( !empty($_POST['SensoresAccionAlerta_9']) )        $SensoresAccionAlerta_9        = $_POST['SensoresAccionAlerta_9'];
	if ( !empty($_POST['SensoresAccionAlerta_10']) )        $SensoresAccionAlerta_10        = $_POST['SensoresAccionAlerta_10'];
	if ( !empty($_POST['SensoresAccionAlerta_11']) )        $SensoresAccionAlerta_11        = $_POST['SensoresAccionAlerta_11'];
	if ( !empty($_POST['SensoresAccionAlerta_12']) )        $SensoresAccionAlerta_12        = $_POST['SensoresAccionAlerta_12'];
	if ( !empty($_POST['SensoresAccionAlerta_13']) )        $SensoresAccionAlerta_13        = $_POST['SensoresAccionAlerta_13'];
	if ( !empty($_POST['SensoresAccionAlerta_14']) )        $SensoresAccionAlerta_14        = $_POST['SensoresAccionAlerta_14'];
	if ( !empty($_POST['SensoresAccionAlerta_15']) )        $SensoresAccionAlerta_15        = $_POST['SensoresAccionAlerta_15'];
	if ( !empty($_POST['SensoresAccionAlerta_16']) )        $SensoresAccionAlerta_16        = $_POST['SensoresAccionAlerta_16'];
	if ( !empty($_POST['SensoresAccionAlerta_17']) )        $SensoresAccionAlerta_17        = $_POST['SensoresAccionAlerta_17'];
	if ( !empty($_POST['SensoresAccionAlerta_18']) )        $SensoresAccionAlerta_18        = $_POST['SensoresAccionAlerta_18'];
	if ( !empty($_POST['SensoresAccionAlerta_19']) )        $SensoresAccionAlerta_19        = $_POST['SensoresAccionAlerta_19'];
	if ( !empty($_POST['SensoresAccionAlerta_20']) )        $SensoresAccionAlerta_20        = $_POST['SensoresAccionAlerta_20'];
	if ( !empty($_POST['SensoresAccionAlerta_21']) )        $SensoresAccionAlerta_21        = $_POST['SensoresAccionAlerta_21'];
	if ( !empty($_POST['SensoresAccionAlerta_22']) )        $SensoresAccionAlerta_22        = $_POST['SensoresAccionAlerta_22'];
	if ( !empty($_POST['SensoresAccionAlerta_23']) )        $SensoresAccionAlerta_23        = $_POST['SensoresAccionAlerta_23'];
	if ( !empty($_POST['SensoresAccionAlerta_24']) )        $SensoresAccionAlerta_24        = $_POST['SensoresAccionAlerta_24'];
	if ( !empty($_POST['SensoresAccionAlerta_25']) )        $SensoresAccionAlerta_25        = $_POST['SensoresAccionAlerta_25'];
	if ( !empty($_POST['SensoresAccionAlerta_26']) )        $SensoresAccionAlerta_26        = $_POST['SensoresAccionAlerta_26'];
	if ( !empty($_POST['SensoresAccionAlerta_27']) )        $SensoresAccionAlerta_27        = $_POST['SensoresAccionAlerta_27'];
	if ( !empty($_POST['SensoresAccionAlerta_28']) )        $SensoresAccionAlerta_28        = $_POST['SensoresAccionAlerta_28'];
	if ( !empty($_POST['SensoresAccionAlerta_29']) )        $SensoresAccionAlerta_29        = $_POST['SensoresAccionAlerta_29'];
	if ( !empty($_POST['SensoresAccionAlerta_30']) )        $SensoresAccionAlerta_30        = $_POST['SensoresAccionAlerta_30'];
	if ( !empty($_POST['SensoresAccionAlerta_31']) )        $SensoresAccionAlerta_31        = $_POST['SensoresAccionAlerta_31'];
	if ( !empty($_POST['SensoresAccionAlerta_32']) )        $SensoresAccionAlerta_32        = $_POST['SensoresAccionAlerta_32'];
	if ( !empty($_POST['SensoresAccionAlerta_33']) )        $SensoresAccionAlerta_33        = $_POST['SensoresAccionAlerta_33'];
	if ( !empty($_POST['SensoresAccionAlerta_34']) )        $SensoresAccionAlerta_34        = $_POST['SensoresAccionAlerta_34'];
	if ( !empty($_POST['SensoresAccionAlerta_35']) )        $SensoresAccionAlerta_35        = $_POST['SensoresAccionAlerta_35'];
	if ( !empty($_POST['SensoresAccionAlerta_36']) )        $SensoresAccionAlerta_36        = $_POST['SensoresAccionAlerta_36'];
	if ( !empty($_POST['SensoresAccionAlerta_37']) )        $SensoresAccionAlerta_37        = $_POST['SensoresAccionAlerta_37'];
	if ( !empty($_POST['SensoresAccionAlerta_38']) )        $SensoresAccionAlerta_38        = $_POST['SensoresAccionAlerta_38'];
	if ( !empty($_POST['SensoresAccionAlerta_39']) )        $SensoresAccionAlerta_39        = $_POST['SensoresAccionAlerta_39'];
	if ( !empty($_POST['SensoresAccionAlerta_40']) )        $SensoresAccionAlerta_40        = $_POST['SensoresAccionAlerta_40'];
	if ( !empty($_POST['SensoresAccionAlerta_41']) )        $SensoresAccionAlerta_41        = $_POST['SensoresAccionAlerta_41'];
	if ( !empty($_POST['SensoresAccionAlerta_42']) )        $SensoresAccionAlerta_42        = $_POST['SensoresAccionAlerta_42'];
	if ( !empty($_POST['SensoresAccionAlerta_43']) )        $SensoresAccionAlerta_43        = $_POST['SensoresAccionAlerta_43'];
	if ( !empty($_POST['SensoresAccionAlerta_44']) )        $SensoresAccionAlerta_44        = $_POST['SensoresAccionAlerta_44'];
	if ( !empty($_POST['SensoresAccionAlerta_45']) )        $SensoresAccionAlerta_45        = $_POST['SensoresAccionAlerta_45'];
	if ( !empty($_POST['SensoresAccionAlerta_46']) )        $SensoresAccionAlerta_46        = $_POST['SensoresAccionAlerta_46'];
	if ( !empty($_POST['SensoresAccionAlerta_47']) )        $SensoresAccionAlerta_47        = $_POST['SensoresAccionAlerta_47'];
	if ( !empty($_POST['SensoresAccionAlerta_48']) )        $SensoresAccionAlerta_48        = $_POST['SensoresAccionAlerta_48'];
	if ( !empty($_POST['SensoresAccionAlerta_49']) )        $SensoresAccionAlerta_49        = $_POST['SensoresAccionAlerta_49'];
	if ( !empty($_POST['SensoresAccionAlerta_50']) )        $SensoresAccionAlerta_50        = $_POST['SensoresAccionAlerta_50'];
	if ( !empty($_POST['SensoresRevision_1']) )        $SensoresRevision_1        = $_POST['SensoresRevision_1'];
	if ( !empty($_POST['SensoresRevision_2']) )        $SensoresRevision_2        = $_POST['SensoresRevision_2'];
	if ( !empty($_POST['SensoresRevision_3']) )        $SensoresRevision_3        = $_POST['SensoresRevision_3'];
	if ( !empty($_POST['SensoresRevision_4']) )        $SensoresRevision_4        = $_POST['SensoresRevision_4'];
	if ( !empty($_POST['SensoresRevision_5']) )        $SensoresRevision_5        = $_POST['SensoresRevision_5'];
	if ( !empty($_POST['SensoresRevision_6']) )        $SensoresRevision_6        = $_POST['SensoresRevision_6'];
	if ( !empty($_POST['SensoresRevision_7']) )        $SensoresRevision_7        = $_POST['SensoresRevision_7'];
	if ( !empty($_POST['SensoresRevision_8']) )        $SensoresRevision_8        = $_POST['SensoresRevision_8'];
	if ( !empty($_POST['SensoresRevision_9']) )        $SensoresRevision_9        = $_POST['SensoresRevision_9'];
	if ( !empty($_POST['SensoresRevision_10']) )        $SensoresRevision_10        = $_POST['SensoresRevision_10'];
	if ( !empty($_POST['SensoresRevision_11']) )        $SensoresRevision_11        = $_POST['SensoresRevision_11'];
	if ( !empty($_POST['SensoresRevision_12']) )        $SensoresRevision_12        = $_POST['SensoresRevision_12'];
	if ( !empty($_POST['SensoresRevision_13']) )        $SensoresRevision_13        = $_POST['SensoresRevision_13'];
	if ( !empty($_POST['SensoresRevision_14']) )        $SensoresRevision_14        = $_POST['SensoresRevision_14'];
	if ( !empty($_POST['SensoresRevision_15']) )        $SensoresRevision_15        = $_POST['SensoresRevision_15'];
	if ( !empty($_POST['SensoresRevision_16']) )        $SensoresRevision_16        = $_POST['SensoresRevision_16'];
	if ( !empty($_POST['SensoresRevision_17']) )        $SensoresRevision_17        = $_POST['SensoresRevision_17'];
	if ( !empty($_POST['SensoresRevision_18']) )        $SensoresRevision_18        = $_POST['SensoresRevision_18'];
	if ( !empty($_POST['SensoresRevision_19']) )        $SensoresRevision_19        = $_POST['SensoresRevision_19'];
	if ( !empty($_POST['SensoresRevision_20']) )        $SensoresRevision_20        = $_POST['SensoresRevision_20'];
	if ( !empty($_POST['SensoresRevision_21']) )        $SensoresRevision_21        = $_POST['SensoresRevision_21'];
	if ( !empty($_POST['SensoresRevision_22']) )        $SensoresRevision_22        = $_POST['SensoresRevision_22'];
	if ( !empty($_POST['SensoresRevision_23']) )        $SensoresRevision_23        = $_POST['SensoresRevision_23'];
	if ( !empty($_POST['SensoresRevision_24']) )        $SensoresRevision_24        = $_POST['SensoresRevision_24'];
	if ( !empty($_POST['SensoresRevision_25']) )        $SensoresRevision_25        = $_POST['SensoresRevision_25'];
	if ( !empty($_POST['SensoresRevision_26']) )        $SensoresRevision_26        = $_POST['SensoresRevision_26'];
	if ( !empty($_POST['SensoresRevision_27']) )        $SensoresRevision_27        = $_POST['SensoresRevision_27'];
	if ( !empty($_POST['SensoresRevision_28']) )        $SensoresRevision_28        = $_POST['SensoresRevision_28'];
	if ( !empty($_POST['SensoresRevision_29']) )        $SensoresRevision_29        = $_POST['SensoresRevision_29'];
	if ( !empty($_POST['SensoresRevision_30']) )        $SensoresRevision_30        = $_POST['SensoresRevision_30'];
	if ( !empty($_POST['SensoresRevision_31']) )        $SensoresRevision_31        = $_POST['SensoresRevision_31'];
	if ( !empty($_POST['SensoresRevision_32']) )        $SensoresRevision_32        = $_POST['SensoresRevision_32'];
	if ( !empty($_POST['SensoresRevision_33']) )        $SensoresRevision_33        = $_POST['SensoresRevision_33'];
	if ( !empty($_POST['SensoresRevision_34']) )        $SensoresRevision_34        = $_POST['SensoresRevision_34'];
	if ( !empty($_POST['SensoresRevision_35']) )        $SensoresRevision_35        = $_POST['SensoresRevision_35'];
	if ( !empty($_POST['SensoresRevision_36']) )        $SensoresRevision_36        = $_POST['SensoresRevision_36'];
	if ( !empty($_POST['SensoresRevision_37']) )        $SensoresRevision_37        = $_POST['SensoresRevision_37'];
	if ( !empty($_POST['SensoresRevision_38']) )        $SensoresRevision_38        = $_POST['SensoresRevision_38'];
	if ( !empty($_POST['SensoresRevision_39']) )        $SensoresRevision_39        = $_POST['SensoresRevision_39'];
	if ( !empty($_POST['SensoresRevision_40']) )        $SensoresRevision_40        = $_POST['SensoresRevision_40'];
	if ( !empty($_POST['SensoresRevision_41']) )        $SensoresRevision_41        = $_POST['SensoresRevision_41'];
	if ( !empty($_POST['SensoresRevision_42']) )        $SensoresRevision_42        = $_POST['SensoresRevision_42'];
	if ( !empty($_POST['SensoresRevision_43']) )        $SensoresRevision_43        = $_POST['SensoresRevision_43'];
	if ( !empty($_POST['SensoresRevision_44']) )        $SensoresRevision_44        = $_POST['SensoresRevision_44'];
	if ( !empty($_POST['SensoresRevision_45']) )        $SensoresRevision_45        = $_POST['SensoresRevision_45'];
	if ( !empty($_POST['SensoresRevision_46']) )        $SensoresRevision_46        = $_POST['SensoresRevision_46'];
	if ( !empty($_POST['SensoresRevision_47']) )        $SensoresRevision_47        = $_POST['SensoresRevision_47'];
	if ( !empty($_POST['SensoresRevision_48']) )        $SensoresRevision_48        = $_POST['SensoresRevision_48'];
	if ( !empty($_POST['SensoresRevision_49']) )        $SensoresRevision_49        = $_POST['SensoresRevision_49'];
	if ( !empty($_POST['SensoresRevision_50']) )        $SensoresRevision_50        = $_POST['SensoresRevision_50'];
	if ( !empty($_POST['SensoresRevisionGrupo_1']) )        $SensoresRevisionGrupo_1        = $_POST['SensoresRevisionGrupo_1'];
	if ( !empty($_POST['SensoresRevisionGrupo_2']) )        $SensoresRevisionGrupo_2        = $_POST['SensoresRevisionGrupo_2'];
	if ( !empty($_POST['SensoresRevisionGrupo_3']) )        $SensoresRevisionGrupo_3        = $_POST['SensoresRevisionGrupo_3'];
	if ( !empty($_POST['SensoresRevisionGrupo_4']) )        $SensoresRevisionGrupo_4        = $_POST['SensoresRevisionGrupo_4'];
	if ( !empty($_POST['SensoresRevisionGrupo_5']) )        $SensoresRevisionGrupo_5        = $_POST['SensoresRevisionGrupo_5'];
	if ( !empty($_POST['SensoresRevisionGrupo_6']) )        $SensoresRevisionGrupo_6        = $_POST['SensoresRevisionGrupo_6'];
	if ( !empty($_POST['SensoresRevisionGrupo_7']) )        $SensoresRevisionGrupo_7        = $_POST['SensoresRevisionGrupo_7'];
	if ( !empty($_POST['SensoresRevisionGrupo_8']) )        $SensoresRevisionGrupo_8        = $_POST['SensoresRevisionGrupo_8'];
	if ( !empty($_POST['SensoresRevisionGrupo_9']) )        $SensoresRevisionGrupo_9        = $_POST['SensoresRevisionGrupo_9'];
	if ( !empty($_POST['SensoresRevisionGrupo_10']) )        $SensoresRevisionGrupo_10        = $_POST['SensoresRevisionGrupo_10'];
	if ( !empty($_POST['SensoresRevisionGrupo_11']) )        $SensoresRevisionGrupo_11        = $_POST['SensoresRevisionGrupo_11'];
	if ( !empty($_POST['SensoresRevisionGrupo_12']) )        $SensoresRevisionGrupo_12        = $_POST['SensoresRevisionGrupo_12'];
	if ( !empty($_POST['SensoresRevisionGrupo_13']) )        $SensoresRevisionGrupo_13        = $_POST['SensoresRevisionGrupo_13'];
	if ( !empty($_POST['SensoresRevisionGrupo_14']) )        $SensoresRevisionGrupo_14        = $_POST['SensoresRevisionGrupo_14'];
	if ( !empty($_POST['SensoresRevisionGrupo_15']) )        $SensoresRevisionGrupo_15        = $_POST['SensoresRevisionGrupo_15'];
	if ( !empty($_POST['SensoresRevisionGrupo_16']) )        $SensoresRevisionGrupo_16        = $_POST['SensoresRevisionGrupo_16'];
	if ( !empty($_POST['SensoresRevisionGrupo_17']) )        $SensoresRevisionGrupo_17        = $_POST['SensoresRevisionGrupo_17'];
	if ( !empty($_POST['SensoresRevisionGrupo_18']) )        $SensoresRevisionGrupo_18        = $_POST['SensoresRevisionGrupo_18'];
	if ( !empty($_POST['SensoresRevisionGrupo_19']) )        $SensoresRevisionGrupo_19        = $_POST['SensoresRevisionGrupo_19'];
	if ( !empty($_POST['SensoresRevisionGrupo_20']) )        $SensoresRevisionGrupo_20        = $_POST['SensoresRevisionGrupo_20'];
	if ( !empty($_POST['SensoresRevisionGrupo_21']) )        $SensoresRevisionGrupo_21        = $_POST['SensoresRevisionGrupo_21'];
	if ( !empty($_POST['SensoresRevisionGrupo_22']) )        $SensoresRevisionGrupo_22        = $_POST['SensoresRevisionGrupo_22'];
	if ( !empty($_POST['SensoresRevisionGrupo_23']) )        $SensoresRevisionGrupo_23        = $_POST['SensoresRevisionGrupo_23'];
	if ( !empty($_POST['SensoresRevisionGrupo_24']) )        $SensoresRevisionGrupo_24        = $_POST['SensoresRevisionGrupo_24'];
	if ( !empty($_POST['SensoresRevisionGrupo_25']) )        $SensoresRevisionGrupo_25        = $_POST['SensoresRevisionGrupo_25'];
	if ( !empty($_POST['SensoresRevisionGrupo_26']) )        $SensoresRevisionGrupo_26        = $_POST['SensoresRevisionGrupo_26'];
	if ( !empty($_POST['SensoresRevisionGrupo_27']) )        $SensoresRevisionGrupo_27        = $_POST['SensoresRevisionGrupo_27'];
	if ( !empty($_POST['SensoresRevisionGrupo_28']) )        $SensoresRevisionGrupo_28        = $_POST['SensoresRevisionGrupo_28'];
	if ( !empty($_POST['SensoresRevisionGrupo_29']) )        $SensoresRevisionGrupo_29        = $_POST['SensoresRevisionGrupo_29'];
	if ( !empty($_POST['SensoresRevisionGrupo_30']) )        $SensoresRevisionGrupo_30        = $_POST['SensoresRevisionGrupo_30'];
	if ( !empty($_POST['SensoresRevisionGrupo_31']) )        $SensoresRevisionGrupo_31        = $_POST['SensoresRevisionGrupo_31'];
	if ( !empty($_POST['SensoresRevisionGrupo_32']) )        $SensoresRevisionGrupo_32        = $_POST['SensoresRevisionGrupo_32'];
	if ( !empty($_POST['SensoresRevisionGrupo_33']) )        $SensoresRevisionGrupo_33        = $_POST['SensoresRevisionGrupo_33'];
	if ( !empty($_POST['SensoresRevisionGrupo_34']) )        $SensoresRevisionGrupo_34        = $_POST['SensoresRevisionGrupo_34'];
	if ( !empty($_POST['SensoresRevisionGrupo_35']) )        $SensoresRevisionGrupo_35        = $_POST['SensoresRevisionGrupo_35'];
	if ( !empty($_POST['SensoresRevisionGrupo_36']) )        $SensoresRevisionGrupo_36        = $_POST['SensoresRevisionGrupo_36'];
	if ( !empty($_POST['SensoresRevisionGrupo_37']) )        $SensoresRevisionGrupo_37        = $_POST['SensoresRevisionGrupo_37'];
	if ( !empty($_POST['SensoresRevisionGrupo_38']) )        $SensoresRevisionGrupo_38        = $_POST['SensoresRevisionGrupo_38'];
	if ( !empty($_POST['SensoresRevisionGrupo_39']) )        $SensoresRevisionGrupo_39        = $_POST['SensoresRevisionGrupo_39'];
	if ( !empty($_POST['SensoresRevisionGrupo_40']) )        $SensoresRevisionGrupo_40        = $_POST['SensoresRevisionGrupo_40'];
	if ( !empty($_POST['SensoresRevisionGrupo_41']) )        $SensoresRevisionGrupo_41        = $_POST['SensoresRevisionGrupo_41'];
	if ( !empty($_POST['SensoresRevisionGrupo_42']) )        $SensoresRevisionGrupo_42        = $_POST['SensoresRevisionGrupo_42'];
	if ( !empty($_POST['SensoresRevisionGrupo_43']) )        $SensoresRevisionGrupo_43        = $_POST['SensoresRevisionGrupo_43'];
	if ( !empty($_POST['SensoresRevisionGrupo_44']) )        $SensoresRevisionGrupo_44        = $_POST['SensoresRevisionGrupo_44'];
	if ( !empty($_POST['SensoresRevisionGrupo_45']) )        $SensoresRevisionGrupo_45        = $_POST['SensoresRevisionGrupo_45'];
	if ( !empty($_POST['SensoresRevisionGrupo_46']) )        $SensoresRevisionGrupo_46        = $_POST['SensoresRevisionGrupo_46'];
	if ( !empty($_POST['SensoresRevisionGrupo_47']) )        $SensoresRevisionGrupo_47        = $_POST['SensoresRevisionGrupo_47'];
	if ( !empty($_POST['SensoresRevisionGrupo_48']) )        $SensoresRevisionGrupo_48        = $_POST['SensoresRevisionGrupo_48'];
	if ( !empty($_POST['SensoresRevisionGrupo_49']) )        $SensoresRevisionGrupo_49        = $_POST['SensoresRevisionGrupo_49'];
	if ( !empty($_POST['SensoresRevisionGrupo_50']) )        $SensoresRevisionGrupo_50        = $_POST['SensoresRevisionGrupo_50'];
	
	
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
			case 'idTelemetria':              if(empty($idTelemetria)){              $error['idTelemetria']            = 'error/No ha ingresado el id';}break;
			case 'idSistema':                 if(empty($idSistema)){                 $error['idSistema']               = 'error/No ha seleccionado el sistema';}break;
			case 'idEstado':                  if(empty($idEstado)){                  $error['idEstado']                = 'error/No ha seleccionado el estado';}break;
			case 'Identificador':             if(empty($Identificador)){             $error['Identificador']           = 'error/No ha ingresado el identificador';}break;
			case 'Nombre':                    if(empty($Nombre)){                    $error['Nombre']                  = 'error/No ha ingresado el nombre';}break;
			case 'idCiudad':                  if(empty($idCiudad)){                  $error['idCiudad']                = 'error/No ha seleccionado la ciudad';}break;
			case 'idComuna':                  if(empty($idComuna)){                  $error['idComuna']                = 'error/No ha seleccionado la comuna';}break;
			case 'Direccion':                 if(empty($Direccion)){                 $error['Direccion']               = 'error/No ha ingresado la direccion';}break;
			case 'GeoLatitud':                if(empty($GeoLatitud)){                $error['GeoLatitud']              = 'error/No ha ingresado la latitud';}break;
			case 'GeoVelocidad':              if(empty($GeoVelocidad)){              $error['GeoVelocidad']            = 'error/No ha ingresado la velocidad';}break;
			case 'GeoDireccion':              if(empty($GeoDireccion)){              $error['GeoDireccion']            = 'error/No ha ingresado la direccion';}break;
			case 'GeoMovimiento':             if(empty($GeoMovimiento)){             $error['GeoMovimiento']           = 'error/No ha ingresado el movimiento';}break;
			case 'GeoTiempoDetencion':        if(empty($GeoTiempoDetencion)){        $error['GeoTiempoDetencion']      = 'error/No ha ingresado el tiempo de detencion';}break;
			case 'LastUpdateFecha':           if(empty($LastUpdateFecha)){           $error['LastUpdateFecha']         = 'error/No ha ingresado la fecha de actualizacion';}break;
			case 'LastUpdateHora':            if(empty($LastUpdateHora)){            $error['LastUpdateHora']          = 'error/No ha ingresado la hora de actualizacion';}break;
			case 'id_Geo':                    if(empty($id_Geo)){                    $error['id_Geo']                  = 'error/No ha seleccionado la geolocalizacion';}break;
			case 'id_Sensores':               if(empty($id_Sensores)){               $error['id_Sensores']             = 'error/No ha seleccionado los sensores';}break;
			case 'cantSensores':              if(empty($cantSensores)){              $error['cantSensores']            = 'error/No ha ingresado la cantidad de sensores';}break;
			case 'idDispositivo':             if(empty($idDispositivo)){             $error['idDispositivo']           = 'error/No ha seleccionado el dispositivo';}break;
			case 'idShield':                  if(empty($idShield)){                  $error['idShield']                = 'error/No ha seleccionado la placa shield';}break;
			case 'Sim_Num_Tel':               if(empty($Sim_Num_Tel)){               $error['Sim_Num_Tel']             = 'error/No ha ingresado el numero telefonico de la SIM';}break;
			case 'Sim_Num_Serie':             if(empty($Sim_Num_Serie)){             $error['Sim_Num_Serie']           = 'error/No ha ingresado el numero de serie de la SIM';}break;
			case 'Sim_marca':                 if(empty($Sim_marca)){                 $error['Sim_marca']               = 'error/No ha seleccionado la bodega';}break;
			case 'Sim_modelo':                if(empty($Sim_modelo)){                $error['Sim_modelo']              = 'error/No ha seleccionado la ruta';}break;
			case 'Sim_Compania':              if(empty($Sim_Compania)){              $error['Sim_Compania']            = 'error/No ha seleccionado al trabajador';}break;
			case 'tabla_relacionada':         if(empty($tabla_relacionada)){         $error['tabla_relacionada']       = 'error/No ha ingresado la tabla relacionada';}break;
			case 'LimiteVelocidad':           if(empty($LimiteVelocidad)){           $error['LimiteVelocidad']         = 'error/No ha ingresado el limite de velocidad';}break;
			case 'idAlarmaGeneral':           if(empty($idAlarmaGeneral)){           $error['idAlarmaGeneral']         = 'error/No ha seleccionado la alrama general';}break;
			case 'IdentificadorEmpresa':      if(empty($IdentificadorEmpresa)){      $error['IdentificadorEmpresa']    = 'error/No ha ingresado el identificador de la empresa';}break;
			case 'NDetenciones':              if(empty($NDetenciones)){              $error['NDetenciones']            = 'error/No ha ingresado el numero de detenciones';}break;
			case 'TiempoFueraLinea':          if(empty($TiempoFueraLinea)){          $error['TiempoFueraLinea']        = 'error/No ha ingresado el tiempo fuera de linea';}break;
			case 'TiempoDetencion':           if(empty($TiempoDetencion)){           $error['TiempoDetencion']         = 'error/No ha ingresado el tiempo de detencion';}break;
			case 'idZona':                    if(empty($idZona)){                    $error['idZona']                  = 'error/No ha seleccionado la zona';}break;
			case 'IP_Client':                 if(empty($IP_Client)){                 $error['IP_Client']               = 'error/No ha ingresado el IP del cliente';}break;
			case 'SensorActivacionID':        if(empty($SensorActivacionID)){        $error['SensorActivacionID']      = 'error/No ha seleccionado el sensor de activacion';}break;
			case 'SensorActivacionValor':     if(empty($SensorActivacionValor)){     $error['SensorActivacionValor']   = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Jornada_inicio':            if(empty($Jornada_inicio)){            $error['Jornada_inicio']          = 'error/No ha ingresado la hora de inicio de la jornada de trabajo';}break;
			case 'Jornada_termino':           if(empty($Jornada_termino)){           $error['Jornada_termino']         = 'error/No ha ingresado la hora de termino de la jornada de trabajo';}break;
			case 'Colacion_inicio':           if(empty($Colacion_inicio)){           $error['Colacion_inicio']         = 'error/No ha ingresado la hora de inicio de la colacion';}break;
			case 'Colacion_termino':          if(empty($Colacion_termino)){          $error['Colacion_termino']        = 'error/No ha ingresado la hora de termino de la colacion';}break;
			case 'Microparada':               if(empty($Microparada)){               $error['Microparada']             = 'error/No ha ingresado el tiempo de las microparadas';}break;
			case 'idUsoContrato':             if(empty($idUsoContrato)){             $error['idUsoContrato']           = 'error/No ha seleccionado el uso del contrato';}break;
			case 'idContrato':                if(empty($idContrato)){                $error['idContrato']              = 'error/No ha seleccionado el contrato relacionado';}break;
			case 'Codigo':                    if(empty($Codigo)){                    $error['Codigo']                  = 'error/No ha ingresado el codigo';}break;
			case 'F_Inicio':                  if(empty($F_Inicio)){                  $error['F_Inicio']                = 'error/No ha ingresado la fecha de inicio';}break;
			case 'F_Termino':                 if(empty($F_Termino)){                 $error['F_Termino']               = 'error/No ha ingresado la fecha de termino';}break;
			case 'idUsoPredio':               if(empty($idUsoPredio)){               $error['idUsoPredio']             = 'error/No ha ingresado el id del predio';}break;
			case 'idMantencion':              if(empty($idMantencion)){              $error['idMantencion']            = 'error/No ha ingresado el id de mantencion';}break;
			case 'idUsuarioMan':              if(empty($idUsuarioMan)){              $error['idUsuarioMan']            = 'error/No ha seleccionado el usuario de la mantencion';}break;
			case 'idMatriz':                  if(empty($idMatriz)){                  $error['idMatriz']                = 'error/No ha seleccionado la matriz de mantencion';}break;
			case 'FechaMantencionIni':        if(empty($FechaMantencionIni)){        $error['FechaMantencionIni']      = 'error/No ha ingresado la fecha de inicio de mantencion';}break;
			case 'FechaMantencionTer':        if(empty($FechaMantencionTer)){        $error['FechaMantencionTer']      = 'error/No ha ingresado la fecha de termino de mantencion';}break;
			case 'HoraMantencionIni':         if(empty($HoraMantencionIni)){         $error['HoraMantencionIni']       = 'error/No ha ingresado la hora de inicio de mantencion';}break;
			case 'HoraMantencionTer':         if(empty($HoraMantencionTer)){         $error['HoraMantencionTer']       = 'error/No ha ingresado la hora de termino de mantencion';}break;
			case 'Hor_idActivo_dia1':         if(empty($Hor_idActivo_dia1)){         $error['Hor_idActivo_dia1']       = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Hor_idActivo_dia2':         if(empty($Hor_idActivo_dia2)){         $error['Hor_idActivo_dia2']       = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Hor_idActivo_dia3':         if(empty($Hor_idActivo_dia3)){         $error['Hor_idActivo_dia3']       = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Hor_idActivo_dia4':         if(empty($Hor_idActivo_dia4)){         $error['Hor_idActivo_dia4']       = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Hor_idActivo_dia5':         if(empty($Hor_idActivo_dia5)){         $error['Hor_idActivo_dia5']       = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Hor_idActivo_dia6':         if(empty($Hor_idActivo_dia6)){         $error['Hor_idActivo_dia6']       = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Hor_idActivo_dia7':         if(empty($Hor_idActivo_dia7)){         $error['Hor_idActivo_dia7']       = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Hor_Inicio_dia1':           if(empty($Hor_Inicio_dia1)){           $error['Hor_Inicio_dia1']         = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Hor_Inicio_dia2':           if(empty($Hor_Inicio_dia2)){           $error['Hor_Inicio_dia2']         = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Hor_Inicio_dia3':           if(empty($Hor_Inicio_dia3)){           $error['Hor_Inicio_dia3']         = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Hor_Inicio_dia4':           if(empty($Hor_Inicio_dia4)){           $error['Hor_Inicio_dia4']         = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Hor_Inicio_dia5':           if(empty($Hor_Inicio_dia5)){           $error['Hor_Inicio_dia5']         = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Hor_Inicio_dia6':           if(empty($Hor_Inicio_dia6)){           $error['Hor_Inicio_dia6']         = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Hor_Inicio_dia7':           if(empty($Hor_Inicio_dia7)){           $error['Hor_Inicio_dia7']         = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Hor_Termino_dia1':          if(empty($Hor_Termino_dia1)){          $error['Hor_Termino_dia1']        = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Hor_Termino_dia2':          if(empty($Hor_Termino_dia2)){          $error['Hor_Termino_dia2']        = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Hor_Termino_dia3':          if(empty($Hor_Termino_dia3)){          $error['Hor_Termino_dia3']        = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Hor_Termino_dia4':          if(empty($Hor_Termino_dia4)){          $error['Hor_Termino_dia4']        = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Hor_Termino_dia5':          if(empty($Hor_Termino_dia5)){          $error['Hor_Termino_dia5']        = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Hor_Termino_dia6':          if(empty($Hor_Termino_dia6)){          $error['Hor_Termino_dia6']        = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Hor_Termino_dia7':          if(empty($Hor_Termino_dia7)){          $error['Hor_Termino_dia7']        = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Observacion':               if(empty($Observacion)){               $error['Observacion']             = 'error/No ha ingresado una observacion';}break;
			case 'Capacidad':                 if(empty($Capacidad)){                 $error['Capacidad']             = 'error/No ha ingresado una observacion';}break;
			
	
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
			
			//Verifico otros datos
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows ('Nombre', 'telemetria_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn);
			}
			//Se verifica si el dato existe
			if(isset($Identificador)&&isset($idSistema)){
				$ndata_2 = db_select_nrows ('Nombre', 'telemetria_listado', '', "Identificador='".$Identificador."' AND idSistema='".$idSistema."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ingresado ya existe';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El identificador ingresado ya existe';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){                    $a  = "'".$idSistema."'" ;               }else{$a  ="''";}
				if(isset($Identificador) && $Identificador != ''){            $a .= ",'".$Identificador."'" ;          }else{$a .= ",''";}
				if(isset($Nombre) && $Nombre != ''){                          $a .= ",'".$Nombre."'" ;                 }else{$a .= ",''";}
				if(isset($id_Geo) && $id_Geo != ''){                          $a .= ",'".$id_Geo."'" ;                 }else{$a .= ",''";}
				if(isset($id_Sensores) && $id_Sensores != ''){                $a .= ",'".$id_Sensores."'" ;            }else{$a .= ",''";}
				if(isset($idEstado) && $idEstado != ''){                      $a .= ",'".$idEstado."'" ;               }else{$a .= ",''";}
				if(isset($idAlarmaGeneral) && $idAlarmaGeneral != ''){        $a .= ",'".$idAlarmaGeneral."'" ;        }else{$a .= ",''";}
				if(isset($idUsoContrato) && $idUsoContrato != ''){            $a .= ",'".$idUsoContrato."'" ;          }else{$a .= ",''";}
				if(isset($Hor_idActivo_dia1) && $Hor_idActivo_dia1 != ''){    $a .= ",'".$Hor_idActivo_dia1."'" ;      }else{$a .= ",''";}
				if(isset($Hor_idActivo_dia2) && $Hor_idActivo_dia2 != ''){    $a .= ",'".$Hor_idActivo_dia2."'" ;      }else{$a .= ",''";}
				if(isset($Hor_idActivo_dia3) && $Hor_idActivo_dia3 != ''){    $a .= ",'".$Hor_idActivo_dia3."'" ;      }else{$a .= ",''";}
				if(isset($Hor_idActivo_dia4) && $Hor_idActivo_dia4 != ''){    $a .= ",'".$Hor_idActivo_dia4."'" ;      }else{$a .= ",''";}
				if(isset($Hor_idActivo_dia5) && $Hor_idActivo_dia5 != ''){    $a .= ",'".$Hor_idActivo_dia5."'" ;      }else{$a .= ",''";}
				if(isset($Hor_idActivo_dia6) && $Hor_idActivo_dia6 != ''){    $a .= ",'".$Hor_idActivo_dia6."'" ;      }else{$a .= ",''";}
				if(isset($Hor_idActivo_dia7) && $Hor_idActivo_dia7 != ''){    $a .= ",'".$Hor_idActivo_dia7."'" ;      }else{$a .= ",''";}
				if(isset($Hor_Inicio_dia1) && $Hor_Inicio_dia1 != ''){        $a .= ",'".$Hor_Inicio_dia1."'" ;        }else{$a .= ",''";}
				if(isset($Hor_Inicio_dia2) && $Hor_Inicio_dia2 != ''){        $a .= ",'".$Hor_Inicio_dia2."'" ;        }else{$a .= ",''";}
				if(isset($Hor_Inicio_dia3) && $Hor_Inicio_dia3 != ''){        $a .= ",'".$Hor_Inicio_dia3."'" ;        }else{$a .= ",''";}
				if(isset($Hor_Inicio_dia4) && $Hor_Inicio_dia4 != ''){        $a .= ",'".$Hor_Inicio_dia4."'" ;        }else{$a .= ",''";}
				if(isset($Hor_Inicio_dia5) && $Hor_Inicio_dia5 != ''){        $a .= ",'".$Hor_Inicio_dia5."'" ;        }else{$a .= ",''";}
				if(isset($Hor_Inicio_dia6) && $Hor_Inicio_dia6 != ''){        $a .= ",'".$Hor_Inicio_dia6."'" ;        }else{$a .= ",''";}
				if(isset($Hor_Inicio_dia7) && $Hor_Inicio_dia7 != ''){        $a .= ",'".$Hor_Inicio_dia7."'" ;        }else{$a .= ",''";}
				if(isset($Hor_Termino_dia1) && $Hor_Termino_dia1 != ''){      $a .= ",'".$Hor_Termino_dia1."'" ;       }else{$a .= ",''";}
				if(isset($Hor_Termino_dia2) && $Hor_Termino_dia2 != ''){      $a .= ",'".$Hor_Termino_dia2."'" ;       }else{$a .= ",''";}
				if(isset($Hor_Termino_dia3) && $Hor_Termino_dia3 != ''){      $a .= ",'".$Hor_Termino_dia3."'" ;       }else{$a .= ",''";}
				if(isset($Hor_Termino_dia4) && $Hor_Termino_dia4 != ''){      $a .= ",'".$Hor_Termino_dia4."'" ;       }else{$a .= ",''";}
				if(isset($Hor_Termino_dia5) && $Hor_Termino_dia5 != ''){      $a .= ",'".$Hor_Termino_dia5."'" ;       }else{$a .= ",''";}
				if(isset($Hor_Termino_dia6) && $Hor_Termino_dia6 != ''){      $a .= ",'".$Hor_Termino_dia6."'" ;       }else{$a .= ",''";}
				if(isset($Hor_Termino_dia7) && $Hor_Termino_dia7 != ''){      $a .= ",'".$Hor_Termino_dia7."'" ;       }else{$a .= ",''";}
				if(isset($idMantencion) && $idMantencion != ''){              $a .= ",'".$idMantencion."'" ;           }else{$a .= ",''";}
				if(isset($idEstadoEncendido) && $idEstadoEncendido != ''){    $a .= ",'".$idEstadoEncendido."'" ;      }else{$a .= ",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `telemetria_listado` (idSistema, Identificador, Nombre, id_Geo, 
				id_Sensores, idEstado, idAlarmaGeneral, idUsoContrato, Hor_idActivo_dia1, 
				Hor_idActivo_dia2, Hor_idActivo_dia3, Hor_idActivo_dia4, Hor_idActivo_dia5, 
				Hor_idActivo_dia6, Hor_idActivo_dia7, Hor_Inicio_dia1, Hor_Inicio_dia2, 
				Hor_Inicio_dia3, Hor_Inicio_dia4, Hor_Inicio_dia5, Hor_Inicio_dia6, 
				Hor_Inicio_dia7, Hor_Termino_dia1, Hor_Termino_dia2, Hor_Termino_dia3, 
				Hor_Termino_dia4, Hor_Termino_dia5, Hor_Termino_dia6, Hor_Termino_dia7,
				idMantencion, idEstadoEncendido) 
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
					
					// elimino la tabla si es que existe
					$query  = "DROP TABLE IF EXISTS `telemetria_listado_tablarelacionada_".$ultimo_id."`";
					$result = mysqli_query($dbConn, $query);
					
					// se crea la nueva tabla
					$query  = "CREATE TABLE `telemetria_listado_tablarelacionada_".$ultimo_id."` (
					`idTabla` int(11) unsigned NOT NULL AUTO_INCREMENT,
					`idTelemetria` int(11) unsigned NOT NULL,
					`idContrato` int(11) unsigned NOT NULL,
					`idSolicitud` int(11) unsigned NOT NULL,
					`idZona` int(11) unsigned NOT NULL,
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
					`Sensor_1` decimal(20,6) NOT NULL,
					`Sensor_2` decimal(20,6) NOT NULL,
					`Sensor_3` decimal(20,6) NOT NULL,
					`Sensor_4` decimal(20,6) NOT NULL,
					`Sensor_5` decimal(20,6) NOT NULL,
					`Sensor_6` decimal(20,6) NOT NULL,
					`Sensor_7` decimal(20,6) NOT NULL,
					`Sensor_8` decimal(20,6) NOT NULL,
					`Sensor_9` decimal(20,6) NOT NULL,
					`Sensor_10` decimal(20,6) NOT NULL,
					`Sensor_11` decimal(20,6) NOT NULL,
					`Sensor_12` decimal(20,6) NOT NULL,
					`Sensor_13` decimal(20,6) NOT NULL,
					`Sensor_14` decimal(20,6) NOT NULL,
					`Sensor_15` decimal(20,6) NOT NULL,
					`Sensor_16` decimal(20,6) NOT NULL,
					`Sensor_17` decimal(20,6) NOT NULL,
					`Sensor_18` decimal(20,6) NOT NULL,
					`Sensor_19` decimal(20,6) NOT NULL,
					`Sensor_20` decimal(20,6) NOT NULL,
					`Sensor_21` decimal(20,6) NOT NULL,
					`Sensor_22` decimal(20,6) NOT NULL,
					`Sensor_23` decimal(20,6) NOT NULL,
					`Sensor_24` decimal(20,6) NOT NULL,
					`Sensor_25` decimal(20,6) NOT NULL,
					`Sensor_26` decimal(20,6) NOT NULL,
					`Sensor_27` decimal(20,6) NOT NULL,
					`Sensor_28` decimal(20,6) NOT NULL,
					`Sensor_29` decimal(20,6) NOT NULL,
					`Sensor_30` decimal(20,6) NOT NULL,
					`Sensor_31` decimal(20,6) NOT NULL,
					`Sensor_32` decimal(20,6) NOT NULL,
					`Sensor_33` decimal(20,6) NOT NULL,
					`Sensor_34` decimal(20,6) NOT NULL,
					`Sensor_35` decimal(20,6) NOT NULL,
					`Sensor_36` decimal(20,6) NOT NULL,
					`Sensor_37` decimal(20,6) NOT NULL,
					`Sensor_38` decimal(20,6) NOT NULL,
					`Sensor_39` decimal(20,6) NOT NULL,
					`Sensor_40` decimal(20,6) NOT NULL,
					`Sensor_41` decimal(20,6) NOT NULL,
					`Sensor_42` decimal(20,6) NOT NULL,
					`Sensor_43` decimal(20,6) NOT NULL,
					`Sensor_44` decimal(20,6) NOT NULL,
					`Sensor_45` decimal(20,6) NOT NULL,
					`Sensor_46` decimal(20,6) NOT NULL,
					`Sensor_47` decimal(20,6) NOT NULL,
					`Sensor_48` decimal(20,6) NOT NULL,
					`Sensor_49` decimal(20,6) NOT NULL,
					`Sensor_50` decimal(20,6) NOT NULL,
					  PRIMARY KEY (`idTabla`)
					) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COMMENT='Dinamica';";
					$result = mysqli_query($dbConn, $query);
					
					//Actualizo el nombre de la tabla relacionada
					$a = "tabla_relacionada='telemetria_listado_tablarelacionada_".$ultimo_id."'" ;
					$query  = "UPDATE `telemetria_listado` SET ".$a." WHERE idTelemetria = '$ultimo_id'";
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
						
					header( 'Location: '.$location.'&id='.$ultimo_id.'&created=true' );
					die;
				}
				
				
			}
	
		break;
/*******************************************************************************************************************/		
		case 'update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Verifico otros datos
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows ('Nombre', 'telemetria_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."' AND idTelemetria!='".$idTelemetria."'", $dbConn);
			}
			//Se verifica si el dato existe
			if(isset($Identificador)&&isset($idSistema)){
				$ndata_2 = db_select_nrows ('Nombre', 'telemetria_listado', '', "Identificador='".$Identificador."' AND idSistema='".$idSistema."' AND idTelemetria!='".$idTelemetria."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ingresado ya existe';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El identificador ingresado ya existe';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idTelemetria='".$idTelemetria."'" ;
				if(isset($idSistema) && $idSistema != ''){                          $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idEstado) && $idEstado != ''){                            $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($Identificador) && $Identificador != ''){                  $a .= ",Identificador='".$Identificador."'" ;}
				if(isset($Nombre) && $Nombre != ''){                                $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($idCiudad) && $idCiudad != ''){                            $a .= ",idCiudad='".$idCiudad."'" ;}
				if(isset($idComuna) && $idComuna != ''){                            $a .= ",idComuna='".$idComuna."'" ;}
				if(isset($Direccion) && $Direccion != ''){                          $a .= ",Direccion='".$Direccion."'" ;}
				if(isset($GeoLatitud) && $GeoLatitud != ''){                        $a .= ",GeoLatitud='".$GeoLatitud."'" ;}
				if(isset($GeoLongitud) && $GeoLongitud != ''){                      $a .= ",GeoLongitud='".$GeoLongitud."'" ;}
				if(isset($GeoVelocidad) && $GeoVelocidad != ''){                    $a .= ",GeoVelocidad='".$GeoVelocidad."'" ;}
				if(isset($GeoDireccion) && $GeoDireccion != ''){                    $a .= ",GeoDireccion='".$GeoDireccion."'" ;}
				if(isset($GeoMovimiento) && $GeoMovimiento != ''){                  $a .= ",GeoMovimiento='".$GeoMovimiento."'" ;}
				if(isset($GeoTiempoDetencion) && $GeoTiempoDetencion != ''){        $a .= ",GeoTiempoDetencion='".$GeoTiempoDetencion."'" ;}
				if(isset($LastUpdateFecha) && $LastUpdateFecha != ''){              $a .= ",LastUpdateFecha='".$LastUpdateFecha."'" ;}
				if(isset($LastUpdateHora) && $LastUpdateHora != ''){                $a .= ",LastUpdateHora='".$LastUpdateHora."'" ;}
				if(isset($id_Geo) && $id_Geo != ''){                                $a .= ",id_Geo='".$id_Geo."'" ;}
				if(isset($id_Sensores) && $id_Sensores != ''){                      $a .= ",id_Sensores='".$id_Sensores."'" ;}
				if(isset($cantSensores) && $cantSensores != ''){                    $a .= ",cantSensores='".$cantSensores."'" ;}
				if(isset($idDispositivo) && $idDispositivo != ''){                  $a .= ",idDispositivo='".$idDispositivo."'" ;}
				if(isset($idShield) ){                                              $a .= ",idShield='".$idShield."'" ;}
				if(isset($Direccion_img) && $Direccion_img != ''){                  $a .= ",Direccion_img='".$Direccion_img."'" ;}
				if(isset($Sim_Num_Tel) && $Sim_Num_Tel != ''){                      $a .= ",Sim_Num_Tel='".$Sim_Num_Tel."'" ;}
				if(isset($Sim_Num_Serie) && $Sim_Num_Serie != ''){                  $a .= ",Sim_Num_Serie='".$Sim_Num_Serie."'" ;}
				if(isset($Sim_modelo) && $Sim_modelo != ''){                        $a .= ",Sim_modelo='".$Sim_modelo."'" ;}
				if(isset($Sim_marca) && $Sim_marca != ''){                          $a .= ",Sim_marca='".$Sim_marca."'" ;}
				if(isset($Sim_Compania) && $Sim_Compania != ''){                    $a .= ",Sim_Compania='".$Sim_Compania."'" ;}
				if(isset($tabla_relacionada)&& $tabla_relacionada != '' ){          $a .= ",tabla_relacionada='".$tabla_relacionada."'" ;}
				if(isset($LimiteVelocidad) ){                                       $a .= ",LimiteVelocidad='".$LimiteVelocidad."'" ;}
				if(isset($idAlarmaGeneral) ){                                       $a .= ",idAlarmaGeneral='".$idAlarmaGeneral."'" ;}
				if(isset($IdentificadorEmpresa) ){                                  $a .= ",IdentificadorEmpresa='".$IdentificadorEmpresa."'" ;}
				if(isset($NDetenciones) ){                                          $a .= ",NDetenciones='".$NDetenciones."'" ;}
				if(isset($TiempoFueraLinea) ){                                      $a .= ",TiempoFueraLinea='".$TiempoFueraLinea."'" ;}
				if(isset($TiempoDetencion) ){                                       $a .= ",TiempoDetencion='".$TiempoDetencion."'" ;}
				if(isset($idZona) ){                                                $a .= ",idZona='".$idZona."'" ;}
				if(isset($IP_Client)&& $IP_Client != '' ){                          $a .= ",IP_Client='".$IP_Client."'" ;}
				if(isset($SensorActivacionID) ){                                    $a .= ",SensorActivacionID='".$SensorActivacionID."'" ;}
				if(isset($SensorActivacionValor) ){                                 $a .= ",SensorActivacionValor='".$SensorActivacionValor."'" ;}
				if(isset($Jornada_inicio)&& $Jornada_inicio != '' ){                $a .= ",Jornada_inicio='".$Jornada_inicio."'" ;}
				if(isset($Jornada_termino)&& $Jornada_termino != '' ){              $a .= ",Jornada_termino='".$Jornada_termino."'" ;}
				if(isset($Colacion_inicio)&& $Colacion_inicio != '' ){              $a .= ",Colacion_inicio='".$Colacion_inicio."'" ;}
				if(isset($Colacion_termino)&& $Colacion_termino != '' ){            $a .= ",Colacion_termino='".$Colacion_termino."'" ;}
				if(isset($Microparada)&& $Microparada != '' ){                      $a .= ",Microparada='".$Microparada."'" ;}
				if(isset($idUsoContrato)&& $idUsoContrato != '' ){                  $a .= ",idUsoContrato='".$idUsoContrato."'" ;}
				if(isset($idContrato)&& $idContrato != '' ){                        $a .= ",idContrato='".$idContrato."'" ;}
				if(isset($Capacidad)&& $Capacidad != '' ){                          $a .= ",Capacidad='".$Capacidad."'" ;}
				if(isset($Codigo)&& $Codigo != '' ){                                $a .= ",Codigo='".$Codigo."'" ;}
				if(isset($F_Inicio)&& $F_Inicio != '' ){                            $a .= ",F_Inicio='".$F_Inicio."'" ;}
				if(isset($F_Termino)&& $F_Termino != '' ){                          $a .= ",F_Termino='".$F_Termino."'" ;}
				if(isset($idMantencion)&& $idMantencion != '' ){                    $a .= ",idMantencion='".$idMantencion."'" ;}
				if(isset($idUsuarioMan)&& $idUsuarioMan != '' ){                    $a .= ",idUsuarioMan='".$idUsuarioMan."'" ;}
				if(isset($idMatriz)&& $idMatriz != '' ){                            $a .= ",idMatriz='".$idMatriz."'" ;}
				if(isset($FechaMantencionIni)&& $FechaMantencionIni != '' ){        $a .= ",FechaMantencionIni='".$FechaMantencionIni."'" ;}
				if(isset($FechaMantencionTer)&& $FechaMantencionTer != '' ){        $a .= ",FechaMantencionTer='".$FechaMantencionTer."'" ;}
				if(isset($HoraMantencionIni)&& $HoraMantencionIni != '' ){          $a .= ",HoraMantencionIni='".$HoraMantencionIni."'" ;}
				if(isset($HoraMantencionTer)&& $HoraMantencionTer != '' ){          $a .= ",HoraMantencionTer='".$HoraMantencionTer."'" ;}
				if(isset($Hor_idActivo_dia1)&& $Hor_idActivo_dia1 != '' ){          $a .= ",Hor_idActivo_dia1='".$Hor_idActivo_dia1."'" ;}
				if(isset($Hor_idActivo_dia2)&& $Hor_idActivo_dia2 != '' ){          $a .= ",Hor_idActivo_dia2='".$Hor_idActivo_dia2."'" ;}
				if(isset($Hor_idActivo_dia3)&& $Hor_idActivo_dia3 != '' ){          $a .= ",Hor_idActivo_dia3='".$Hor_idActivo_dia3."'" ;}
				if(isset($Hor_idActivo_dia4)&& $Hor_idActivo_dia4 != '' ){          $a .= ",Hor_idActivo_dia4='".$Hor_idActivo_dia4."'" ;}
				if(isset($Hor_idActivo_dia5)&& $Hor_idActivo_dia5 != '' ){          $a .= ",Hor_idActivo_dia5='".$Hor_idActivo_dia5."'" ;}
				if(isset($Hor_idActivo_dia6)&& $Hor_idActivo_dia6 != '' ){          $a .= ",Hor_idActivo_dia6='".$Hor_idActivo_dia6."'" ;}
				if(isset($Hor_idActivo_dia7)&& $Hor_idActivo_dia7 != '' ){          $a .= ",Hor_idActivo_dia7='".$Hor_idActivo_dia7."'" ;}
				if(isset($Hor_Inicio_dia1)&& $Hor_Inicio_dia1 != '' ){              $a .= ",Hor_Inicio_dia1='".$Hor_Inicio_dia1."'" ;}
				if(isset($Hor_Inicio_dia2)&& $Hor_Inicio_dia2 != '' ){              $a .= ",Hor_Inicio_dia2='".$Hor_Inicio_dia2."'" ;}
				if(isset($Hor_Inicio_dia3)&& $Hor_Inicio_dia3 != '' ){              $a .= ",Hor_Inicio_dia3='".$Hor_Inicio_dia3."'" ;}
				if(isset($Hor_Inicio_dia4)&& $Hor_Inicio_dia4 != '' ){              $a .= ",Hor_Inicio_dia4='".$Hor_Inicio_dia4."'" ;}
				if(isset($Hor_Inicio_dia5)&& $Hor_Inicio_dia5 != '' ){              $a .= ",Hor_Inicio_dia5='".$Hor_Inicio_dia5."'" ;}
				if(isset($Hor_Inicio_dia6)&& $Hor_Inicio_dia6 != '' ){              $a .= ",Hor_Inicio_dia6='".$Hor_Inicio_dia6."'" ;}
				if(isset($Hor_Inicio_dia7)&& $Hor_Inicio_dia7 != '' ){              $a .= ",Hor_Inicio_dia7='".$Hor_Inicio_dia7."'" ;}
				if(isset($Hor_Termino_dia1)&& $Hor_Termino_dia1 != '' ){            $a .= ",Hor_Termino_dia1='".$Hor_Termino_dia1."'" ;}
				if(isset($Hor_Termino_dia2)&& $Hor_Termino_dia2 != '' ){            $a .= ",Hor_Termino_dia2='".$Hor_Termino_dia2."'" ;}
				if(isset($Hor_Termino_dia3)&& $Hor_Termino_dia3 != '' ){            $a .= ",Hor_Termino_dia3='".$Hor_Termino_dia3."'" ;}
				if(isset($Hor_Termino_dia4)&& $Hor_Termino_dia4 != '' ){            $a .= ",Hor_Termino_dia4='".$Hor_Termino_dia4."'" ;}
				if(isset($Hor_Termino_dia5)&& $Hor_Termino_dia5 != '' ){            $a .= ",Hor_Termino_dia5='".$Hor_Termino_dia5."'" ;}
				if(isset($Hor_Termino_dia6)&& $Hor_Termino_dia6 != '' ){            $a .= ",Hor_Termino_dia6='".$Hor_Termino_dia6."'" ;}
				if(isset($Hor_Termino_dia7)&& $Hor_Termino_dia7 != '' ){            $a .= ",Hor_Termino_dia7='".$Hor_Termino_dia7."'" ;}
				if(isset($SensoresNombre_1) && $SensoresNombre_1 != ''){            $a .= ",SensoresNombre_1='".$SensoresNombre_1."'" ;}
				if(isset($SensoresNombre_2) && $SensoresNombre_2 != ''){            $a .= ",SensoresNombre_2='".$SensoresNombre_2."'" ;}
				if(isset($SensoresNombre_3) && $SensoresNombre_3 != ''){            $a .= ",SensoresNombre_3='".$SensoresNombre_3."'" ;}
				if(isset($SensoresNombre_4) && $SensoresNombre_4 != ''){            $a .= ",SensoresNombre_4='".$SensoresNombre_4."'" ;}
				if(isset($SensoresNombre_5) && $SensoresNombre_5 != ''){            $a .= ",SensoresNombre_5='".$SensoresNombre_5."'" ;}
				if(isset($SensoresNombre_6) && $SensoresNombre_6 != ''){            $a .= ",SensoresNombre_6='".$SensoresNombre_6."'" ;}
				if(isset($SensoresNombre_7) && $SensoresNombre_7 != ''){            $a .= ",SensoresNombre_7='".$SensoresNombre_7."'" ;}
				if(isset($SensoresNombre_8) && $SensoresNombre_8 != ''){            $a .= ",SensoresNombre_8='".$SensoresNombre_8."'" ;}
				if(isset($SensoresNombre_9) && $SensoresNombre_9 != ''){            $a .= ",SensoresNombre_9='".$SensoresNombre_9."'" ;}
				if(isset($SensoresNombre_10) && $SensoresNombre_10 != ''){          $a .= ",SensoresNombre_10='".$SensoresNombre_10."'" ;}
				if(isset($SensoresNombre_11) && $SensoresNombre_11 != ''){          $a .= ",SensoresNombre_11='".$SensoresNombre_11."'" ;}
				if(isset($SensoresNombre_12) && $SensoresNombre_12 != ''){          $a .= ",SensoresNombre_12='".$SensoresNombre_12."'" ;}
				if(isset($SensoresNombre_13) && $SensoresNombre_13 != ''){          $a .= ",SensoresNombre_13='".$SensoresNombre_13."'" ;}
				if(isset($SensoresNombre_14) && $SensoresNombre_14 != ''){          $a .= ",SensoresNombre_14='".$SensoresNombre_14."'" ;}
				if(isset($SensoresNombre_15) && $SensoresNombre_15 != ''){          $a .= ",SensoresNombre_15='".$SensoresNombre_15."'" ;}
				if(isset($SensoresNombre_16) && $SensoresNombre_16 != ''){          $a .= ",SensoresNombre_16='".$SensoresNombre_16."'" ;}
				if(isset($SensoresNombre_17) && $SensoresNombre_17 != ''){          $a .= ",SensoresNombre_17='".$SensoresNombre_17."'" ;}
				if(isset($SensoresNombre_18) && $SensoresNombre_18 != ''){          $a .= ",SensoresNombre_18='".$SensoresNombre_18."'" ;}
				if(isset($SensoresNombre_19) && $SensoresNombre_19 != ''){          $a .= ",SensoresNombre_19='".$SensoresNombre_19."'" ;}
				if(isset($SensoresNombre_20) && $SensoresNombre_20 != ''){          $a .= ",SensoresNombre_20='".$SensoresNombre_20."'" ;}
				if(isset($SensoresNombre_21) && $SensoresNombre_21 != ''){          $a .= ",SensoresNombre_21='".$SensoresNombre_21."'" ;}
				if(isset($SensoresNombre_22) && $SensoresNombre_22 != ''){          $a .= ",SensoresNombre_22='".$SensoresNombre_22."'" ;}
				if(isset($SensoresNombre_23) && $SensoresNombre_23 != ''){          $a .= ",SensoresNombre_23='".$SensoresNombre_23."'" ;}
				if(isset($SensoresNombre_24) && $SensoresNombre_24 != ''){          $a .= ",SensoresNombre_24='".$SensoresNombre_24."'" ;}
				if(isset($SensoresNombre_25) && $SensoresNombre_25 != ''){          $a .= ",SensoresNombre_25='".$SensoresNombre_25."'" ;}
				if(isset($SensoresNombre_26) && $SensoresNombre_26 != ''){          $a .= ",SensoresNombre_26='".$SensoresNombre_26."'" ;}
				if(isset($SensoresNombre_27) && $SensoresNombre_27 != ''){          $a .= ",SensoresNombre_27='".$SensoresNombre_27."'" ;}
				if(isset($SensoresNombre_28) && $SensoresNombre_28 != ''){          $a .= ",SensoresNombre_28='".$SensoresNombre_28."'" ;}
				if(isset($SensoresNombre_29) && $SensoresNombre_29 != ''){          $a .= ",SensoresNombre_29='".$SensoresNombre_29."'" ;}
				if(isset($SensoresNombre_30) && $SensoresNombre_30 != ''){          $a .= ",SensoresNombre_30='".$SensoresNombre_30."'" ;}
				if(isset($SensoresNombre_31) && $SensoresNombre_31 != ''){          $a .= ",SensoresNombre_31='".$SensoresNombre_31."'" ;}
				if(isset($SensoresNombre_32) && $SensoresNombre_32 != ''){          $a .= ",SensoresNombre_32='".$SensoresNombre_32."'" ;}
				if(isset($SensoresNombre_33) && $SensoresNombre_33 != ''){          $a .= ",SensoresNombre_33='".$SensoresNombre_33."'" ;}
				if(isset($SensoresNombre_34) && $SensoresNombre_34 != ''){          $a .= ",SensoresNombre_34='".$SensoresNombre_34."'" ;}
				if(isset($SensoresNombre_35) && $SensoresNombre_35 != ''){          $a .= ",SensoresNombre_35='".$SensoresNombre_35."'" ;}
				if(isset($SensoresNombre_36) && $SensoresNombre_36 != ''){          $a .= ",SensoresNombre_36='".$SensoresNombre_36."'" ;}
				if(isset($SensoresNombre_37) && $SensoresNombre_37 != ''){          $a .= ",SensoresNombre_37='".$SensoresNombre_37."'" ;}
				if(isset($SensoresNombre_38) && $SensoresNombre_38 != ''){          $a .= ",SensoresNombre_38='".$SensoresNombre_38."'" ;}
				if(isset($SensoresNombre_39) && $SensoresNombre_39 != ''){          $a .= ",SensoresNombre_39='".$SensoresNombre_39."'" ;}
				if(isset($SensoresNombre_40) && $SensoresNombre_40 != ''){          $a .= ",SensoresNombre_40='".$SensoresNombre_40."'" ;}
				if(isset($SensoresNombre_41) && $SensoresNombre_41 != ''){          $a .= ",SensoresNombre_41='".$SensoresNombre_41."'" ;}
				if(isset($SensoresNombre_42) && $SensoresNombre_42 != ''){          $a .= ",SensoresNombre_42='".$SensoresNombre_42."'" ;}
				if(isset($SensoresNombre_43) && $SensoresNombre_43 != ''){          $a .= ",SensoresNombre_43='".$SensoresNombre_43."'" ;}
				if(isset($SensoresNombre_44) && $SensoresNombre_44 != ''){          $a .= ",SensoresNombre_44='".$SensoresNombre_44."'" ;}
				if(isset($SensoresNombre_45) && $SensoresNombre_45 != ''){          $a .= ",SensoresNombre_45='".$SensoresNombre_45."'" ;}
				if(isset($SensoresNombre_46) && $SensoresNombre_46 != ''){          $a .= ",SensoresNombre_46='".$SensoresNombre_46."'" ;}
				if(isset($SensoresNombre_47) && $SensoresNombre_47 != ''){          $a .= ",SensoresNombre_47='".$SensoresNombre_47."'" ;}
				if(isset($SensoresNombre_48) && $SensoresNombre_48 != ''){          $a .= ",SensoresNombre_48='".$SensoresNombre_48."'" ;}
				if(isset($SensoresNombre_49) && $SensoresNombre_49 != ''){          $a .= ",SensoresNombre_49='".$SensoresNombre_49."'" ;}
				if(isset($SensoresNombre_50) && $SensoresNombre_50 != ''){          $a .= ",SensoresNombre_50='".$SensoresNombre_50."'" ;}
				if(isset($SensoresTipo_1) && $SensoresTipo_1 != ''){                $a .= ",SensoresTipo_1='".$SensoresTipo_1."'" ;}
				if(isset($SensoresTipo_2) && $SensoresTipo_2 != ''){                $a .= ",SensoresTipo_2='".$SensoresTipo_2."'" ;}
				if(isset($SensoresTipo_3) && $SensoresTipo_3 != ''){                $a .= ",SensoresTipo_3='".$SensoresTipo_3."'" ;}
				if(isset($SensoresTipo_4) && $SensoresTipo_4 != ''){                $a .= ",SensoresTipo_4='".$SensoresTipo_4."'" ;}
				if(isset($SensoresTipo_5) && $SensoresTipo_5 != ''){                $a .= ",SensoresTipo_5='".$SensoresTipo_5."'" ;}
				if(isset($SensoresTipo_6) && $SensoresTipo_6 != ''){                $a .= ",SensoresTipo_6='".$SensoresTipo_6."'" ;}
				if(isset($SensoresTipo_7) && $SensoresTipo_7 != ''){                $a .= ",SensoresTipo_7='".$SensoresTipo_7."'" ;}
				if(isset($SensoresTipo_8) && $SensoresTipo_8 != ''){                $a .= ",SensoresTipo_8='".$SensoresTipo_8."'" ;}
				if(isset($SensoresTipo_9) && $SensoresTipo_9 != ''){                $a .= ",SensoresTipo_9='".$SensoresTipo_9."'" ;}
				if(isset($SensoresTipo_10) && $SensoresTipo_10 != ''){              $a .= ",SensoresTipo_10='".$SensoresTipo_10."'" ;}
				if(isset($SensoresTipo_11) && $SensoresTipo_11 != ''){              $a .= ",SensoresTipo_11='".$SensoresTipo_11."'" ;}
				if(isset($SensoresTipo_12) && $SensoresTipo_12 != ''){              $a .= ",SensoresTipo_12='".$SensoresTipo_12."'" ;}
				if(isset($SensoresTipo_13) && $SensoresTipo_13 != ''){              $a .= ",SensoresTipo_13='".$SensoresTipo_13."'" ;}
				if(isset($SensoresTipo_14) && $SensoresTipo_14 != ''){              $a .= ",SensoresTipo_14='".$SensoresTipo_14."'" ;}
				if(isset($SensoresTipo_15) && $SensoresTipo_15 != ''){              $a .= ",SensoresTipo_15='".$SensoresTipo_15."'" ;}
				if(isset($SensoresTipo_16) && $SensoresTipo_16 != ''){              $a .= ",SensoresTipo_16='".$SensoresTipo_16."'" ;}
				if(isset($SensoresTipo_17) && $SensoresTipo_17 != ''){              $a .= ",SensoresTipo_17='".$SensoresTipo_17."'" ;}
				if(isset($SensoresTipo_18) && $SensoresTipo_18 != ''){              $a .= ",SensoresTipo_18='".$SensoresTipo_18."'" ;}
				if(isset($SensoresTipo_19) && $SensoresTipo_19 != ''){              $a .= ",SensoresTipo_19='".$SensoresTipo_19."'" ;}
				if(isset($SensoresTipo_20) && $SensoresTipo_20 != ''){              $a .= ",SensoresTipo_20='".$SensoresTipo_20."'" ;}
				if(isset($SensoresTipo_21) && $SensoresTipo_21 != ''){              $a .= ",SensoresTipo_21='".$SensoresTipo_21."'" ;}
				if(isset($SensoresTipo_22) && $SensoresTipo_22 != ''){              $a .= ",SensoresTipo_22='".$SensoresTipo_22."'" ;}
				if(isset($SensoresTipo_23) && $SensoresTipo_23 != ''){              $a .= ",SensoresTipo_23='".$SensoresTipo_23."'" ;}
				if(isset($SensoresTipo_24) && $SensoresTipo_24 != ''){              $a .= ",SensoresTipo_24='".$SensoresTipo_24."'" ;}
				if(isset($SensoresTipo_25) && $SensoresTipo_25 != ''){              $a .= ",SensoresTipo_25='".$SensoresTipo_25."'" ;}
				if(isset($SensoresTipo_26) && $SensoresTipo_26 != ''){              $a .= ",SensoresTipo_26='".$SensoresTipo_26."'" ;}
				if(isset($SensoresTipo_27) && $SensoresTipo_27 != ''){              $a .= ",SensoresTipo_27='".$SensoresTipo_27."'" ;}
				if(isset($SensoresTipo_28) && $SensoresTipo_28 != ''){              $a .= ",SensoresTipo_28='".$SensoresTipo_28."'" ;}
				if(isset($SensoresTipo_29) && $SensoresTipo_29 != ''){              $a .= ",SensoresTipo_29='".$SensoresTipo_29."'" ;}
				if(isset($SensoresTipo_30) && $SensoresTipo_30 != ''){              $a .= ",SensoresTipo_30='".$SensoresTipo_30."'" ;}
				if(isset($SensoresTipo_31) && $SensoresTipo_31 != ''){              $a .= ",SensoresTipo_31='".$SensoresTipo_31."'" ;}
				if(isset($SensoresTipo_32) && $SensoresTipo_32 != ''){              $a .= ",SensoresTipo_32='".$SensoresTipo_32."'" ;}
				if(isset($SensoresTipo_33) && $SensoresTipo_33 != ''){              $a .= ",SensoresTipo_33='".$SensoresTipo_33."'" ;}
				if(isset($SensoresTipo_34) && $SensoresTipo_34 != ''){              $a .= ",SensoresTipo_34='".$SensoresTipo_34."'" ;}
				if(isset($SensoresTipo_35) && $SensoresTipo_35 != ''){              $a .= ",SensoresTipo_35='".$SensoresTipo_35."'" ;}
				if(isset($SensoresTipo_36) && $SensoresTipo_36 != ''){              $a .= ",SensoresTipo_36='".$SensoresTipo_36."'" ;}
				if(isset($SensoresTipo_37) && $SensoresTipo_37 != ''){              $a .= ",SensoresTipo_37='".$SensoresTipo_37."'" ;}
				if(isset($SensoresTipo_38) && $SensoresTipo_38 != ''){              $a .= ",SensoresTipo_38='".$SensoresTipo_38."'" ;}
				if(isset($SensoresTipo_39) && $SensoresTipo_39 != ''){              $a .= ",SensoresTipo_39='".$SensoresTipo_39."'" ;}
				if(isset($SensoresTipo_40) && $SensoresTipo_40 != ''){              $a .= ",SensoresTipo_40='".$SensoresTipo_40."'" ;}
				if(isset($SensoresTipo_41) && $SensoresTipo_41 != ''){              $a .= ",SensoresTipo_41='".$SensoresTipo_41."'" ;}
				if(isset($SensoresTipo_42) && $SensoresTipo_42 != ''){              $a .= ",SensoresTipo_42='".$SensoresTipo_42."'" ;}
				if(isset($SensoresTipo_43) && $SensoresTipo_43 != ''){              $a .= ",SensoresTipo_43='".$SensoresTipo_43."'" ;}
				if(isset($SensoresTipo_44) && $SensoresTipo_44 != ''){              $a .= ",SensoresTipo_44='".$SensoresTipo_44."'" ;}
				if(isset($SensoresTipo_45) && $SensoresTipo_45 != ''){              $a .= ",SensoresTipo_45='".$SensoresTipo_45."'" ;}
				if(isset($SensoresTipo_46) && $SensoresTipo_46 != ''){              $a .= ",SensoresTipo_46='".$SensoresTipo_46."'" ;}
				if(isset($SensoresTipo_47) && $SensoresTipo_47 != ''){              $a .= ",SensoresTipo_47='".$SensoresTipo_47."'" ;}
				if(isset($SensoresTipo_48) && $SensoresTipo_48 != ''){              $a .= ",SensoresTipo_48='".$SensoresTipo_48."'" ;}
				if(isset($SensoresTipo_49) && $SensoresTipo_49 != ''){              $a .= ",SensoresTipo_49='".$SensoresTipo_49."'" ;}
				if(isset($SensoresTipo_50) && $SensoresTipo_50 != ''){              $a .= ",SensoresTipo_50='".$SensoresTipo_50."'" ;}
				if(isset($SensoresMedMin_1) && $SensoresMedMin_1 != ''){            $a .= ",SensoresMedMin_1='".$SensoresMedMin_1."'" ;}
				if(isset($SensoresMedMin_2) && $SensoresMedMin_2 != ''){            $a .= ",SensoresMedMin_2='".$SensoresMedMin_2."'" ;}
				if(isset($SensoresMedMin_3) && $SensoresMedMin_3 != ''){            $a .= ",SensoresMedMin_3='".$SensoresMedMin_3."'" ;}
				if(isset($SensoresMedMin_4) && $SensoresMedMin_4 != ''){            $a .= ",SensoresMedMin_4='".$SensoresMedMin_4."'" ;}
				if(isset($SensoresMedMin_5) && $SensoresMedMin_5 != ''){            $a .= ",SensoresMedMin_5='".$SensoresMedMin_5."'" ;}
				if(isset($SensoresMedMin_6) && $SensoresMedMin_6 != ''){            $a .= ",SensoresMedMin_6='".$SensoresMedMin_6."'" ;}
				if(isset($SensoresMedMin_7) && $SensoresMedMin_7 != ''){            $a .= ",SensoresMedMin_7='".$SensoresMedMin_7."'" ;}
				if(isset($SensoresMedMin_8) && $SensoresMedMin_8 != ''){            $a .= ",SensoresMedMin_8='".$SensoresMedMin_8."'" ;}
				if(isset($SensoresMedMin_9) && $SensoresMedMin_9 != ''){            $a .= ",SensoresMedMin_9='".$SensoresMedMin_9."'" ;}
				if(isset($SensoresMedMin_10) && $SensoresMedMin_10 != ''){          $a .= ",SensoresMedMin_10='".$SensoresMedMin_10."'" ;}
				if(isset($SensoresMedMin_11) && $SensoresMedMin_11 != ''){          $a .= ",SensoresMedMin_11='".$SensoresMedMin_11."'" ;}
				if(isset($SensoresMedMin_12) && $SensoresMedMin_12 != ''){          $a .= ",SensoresMedMin_12='".$SensoresMedMin_12."'" ;}
				if(isset($SensoresMedMin_13) && $SensoresMedMin_13 != ''){          $a .= ",SensoresMedMin_13='".$SensoresMedMin_13."'" ;}
				if(isset($SensoresMedMin_14) && $SensoresMedMin_14 != ''){          $a .= ",SensoresMedMin_14='".$SensoresMedMin_14."'" ;}
				if(isset($SensoresMedMin_15) && $SensoresMedMin_15 != ''){          $a .= ",SensoresMedMin_15='".$SensoresMedMin_15."'" ;}
				if(isset($SensoresMedMin_16) && $SensoresMedMin_16 != ''){          $a .= ",SensoresMedMin_16='".$SensoresMedMin_16."'" ;}
				if(isset($SensoresMedMin_17) && $SensoresMedMin_17 != ''){          $a .= ",SensoresMedMin_17='".$SensoresMedMin_17."'" ;}
				if(isset($SensoresMedMin_18) && $SensoresMedMin_18 != ''){          $a .= ",SensoresMedMin_18='".$SensoresMedMin_18."'" ;}
				if(isset($SensoresMedMin_19) && $SensoresMedMin_19 != ''){          $a .= ",SensoresMedMin_19='".$SensoresMedMin_19."'" ;}
				if(isset($SensoresMedMin_20) && $SensoresMedMin_20 != ''){          $a .= ",SensoresMedMin_20='".$SensoresMedMin_20."'" ;}
				if(isset($SensoresMedMin_21) && $SensoresMedMin_21 != ''){          $a .= ",SensoresMedMin_21='".$SensoresMedMin_21."'" ;}
				if(isset($SensoresMedMin_22) && $SensoresMedMin_22 != ''){          $a .= ",SensoresMedMin_22='".$SensoresMedMin_22."'" ;}
				if(isset($SensoresMedMin_23) && $SensoresMedMin_23 != ''){          $a .= ",SensoresMedMin_23='".$SensoresMedMin_23."'" ;}
				if(isset($SensoresMedMin_24) && $SensoresMedMin_24 != ''){          $a .= ",SensoresMedMin_24='".$SensoresMedMin_24."'" ;}
				if(isset($SensoresMedMin_25) && $SensoresMedMin_25 != ''){          $a .= ",SensoresMedMin_25='".$SensoresMedMin_25."'" ;}
				if(isset($SensoresMedMin_26) && $SensoresMedMin_26 != ''){          $a .= ",SensoresMedMin_26='".$SensoresMedMin_26."'" ;}
				if(isset($SensoresMedMin_27) && $SensoresMedMin_27 != ''){          $a .= ",SensoresMedMin_27='".$SensoresMedMin_27."'" ;}
				if(isset($SensoresMedMin_28) && $SensoresMedMin_28 != ''){          $a .= ",SensoresMedMin_28='".$SensoresMedMin_28."'" ;}
				if(isset($SensoresMedMin_29) && $SensoresMedMin_29 != ''){          $a .= ",SensoresMedMin_29='".$SensoresMedMin_29."'" ;}
				if(isset($SensoresMedMin_30) && $SensoresMedMin_30 != ''){          $a .= ",SensoresMedMin_30='".$SensoresMedMin_30."'" ;}
				if(isset($SensoresMedMin_31) && $SensoresMedMin_31 != ''){          $a .= ",SensoresMedMin_31='".$SensoresMedMin_31."'" ;}
				if(isset($SensoresMedMin_32) && $SensoresMedMin_32 != ''){          $a .= ",SensoresMedMin_32='".$SensoresMedMin_32."'" ;}
				if(isset($SensoresMedMin_33) && $SensoresMedMin_33 != ''){          $a .= ",SensoresMedMin_33='".$SensoresMedMin_33."'" ;}
				if(isset($SensoresMedMin_34) && $SensoresMedMin_34 != ''){          $a .= ",SensoresMedMin_34='".$SensoresMedMin_34."'" ;}
				if(isset($SensoresMedMin_35) && $SensoresMedMin_35 != ''){          $a .= ",SensoresMedMin_35='".$SensoresMedMin_35."'" ;}
				if(isset($SensoresMedMin_36) && $SensoresMedMin_36 != ''){          $a .= ",SensoresMedMin_36='".$SensoresMedMin_36."'" ;}
				if(isset($SensoresMedMin_37) && $SensoresMedMin_37 != ''){          $a .= ",SensoresMedMin_37='".$SensoresMedMin_37."'" ;}
				if(isset($SensoresMedMin_38) && $SensoresMedMin_38 != ''){          $a .= ",SensoresMedMin_38='".$SensoresMedMin_38."'" ;}
				if(isset($SensoresMedMin_39) && $SensoresMedMin_39 != ''){          $a .= ",SensoresMedMin_39='".$SensoresMedMin_39."'" ;}
				if(isset($SensoresMedMin_40) && $SensoresMedMin_40 != ''){          $a .= ",SensoresMedMin_40='".$SensoresMedMin_40."'" ;}
				if(isset($SensoresMedMin_41) && $SensoresMedMin_41 != ''){          $a .= ",SensoresMedMin_41='".$SensoresMedMin_41."'" ;}
				if(isset($SensoresMedMin_42) && $SensoresMedMin_42 != ''){          $a .= ",SensoresMedMin_42='".$SensoresMedMin_42."'" ;}
				if(isset($SensoresMedMin_43) && $SensoresMedMin_43 != ''){          $a .= ",SensoresMedMin_43='".$SensoresMedMin_43."'" ;}
				if(isset($SensoresMedMin_44) && $SensoresMedMin_44 != ''){          $a .= ",SensoresMedMin_44='".$SensoresMedMin_44."'" ;}
				if(isset($SensoresMedMin_45) && $SensoresMedMin_45 != ''){          $a .= ",SensoresMedMin_45='".$SensoresMedMin_45."'" ;}
				if(isset($SensoresMedMin_46) && $SensoresMedMin_46 != ''){          $a .= ",SensoresMedMin_46='".$SensoresMedMin_46."'" ;}
				if(isset($SensoresMedMin_47) && $SensoresMedMin_47 != ''){          $a .= ",SensoresMedMin_47='".$SensoresMedMin_47."'" ;}
				if(isset($SensoresMedMin_48) && $SensoresMedMin_48 != ''){          $a .= ",SensoresMedMin_48='".$SensoresMedMin_48."'" ;}
				if(isset($SensoresMedMin_49) && $SensoresMedMin_49 != ''){          $a .= ",SensoresMedMin_49='".$SensoresMedMin_49."'" ;}
				if(isset($SensoresMedMin_50) && $SensoresMedMin_50 != ''){          $a .= ",SensoresMedMin_50='".$SensoresMedMin_50."'" ;}
				if(isset($SensoresMedMax_1) && $SensoresMedMax_1 != ''){            $a .= ",SensoresMedMax_1='".$SensoresMedMax_1."'" ;}
				if(isset($SensoresMedMax_2) && $SensoresMedMax_2 != ''){            $a .= ",SensoresMedMax_2='".$SensoresMedMax_2."'" ;}
				if(isset($SensoresMedMax_3) && $SensoresMedMax_3 != ''){            $a .= ",SensoresMedMax_3='".$SensoresMedMax_3."'" ;}
				if(isset($SensoresMedMax_4) && $SensoresMedMax_4 != ''){            $a .= ",SensoresMedMax_4='".$SensoresMedMax_4."'" ;}
				if(isset($SensoresMedMax_5) && $SensoresMedMax_5 != ''){            $a .= ",SensoresMedMax_5='".$SensoresMedMax_5."'" ;}
				if(isset($SensoresMedMax_6) && $SensoresMedMax_6 != ''){            $a .= ",SensoresMedMax_6='".$SensoresMedMax_6."'" ;}
				if(isset($SensoresMedMax_7) && $SensoresMedMax_7 != ''){            $a .= ",SensoresMedMax_7='".$SensoresMedMax_7."'" ;}
				if(isset($SensoresMedMax_8) && $SensoresMedMax_8 != ''){            $a .= ",SensoresMedMax_8='".$SensoresMedMax_8."'" ;}
				if(isset($SensoresMedMax_9) && $SensoresMedMax_9 != ''){            $a .= ",SensoresMedMax_9='".$SensoresMedMax_9."'" ;}
				if(isset($SensoresMedMax_10) && $SensoresMedMax_10 != ''){          $a .= ",SensoresMedMax_10='".$SensoresMedMax_10."'" ;}
				if(isset($SensoresMedMax_11) && $SensoresMedMax_11 != ''){              $a .= ",SensoresMedMax_11='".$SensoresMedMax_11."'" ;}
				if(isset($SensoresMedMax_12) && $SensoresMedMax_12 != ''){              $a .= ",SensoresMedMax_12='".$SensoresMedMax_12."'" ;}
				if(isset($SensoresMedMax_13) && $SensoresMedMax_13 != ''){              $a .= ",SensoresMedMax_13='".$SensoresMedMax_13."'" ;}
				if(isset($SensoresMedMax_14) && $SensoresMedMax_14 != ''){              $a .= ",SensoresMedMax_14='".$SensoresMedMax_14."'" ;}
				if(isset($SensoresMedMax_15) && $SensoresMedMax_15 != ''){              $a .= ",SensoresMedMax_15='".$SensoresMedMax_15."'" ;}
				if(isset($SensoresMedMax_16) && $SensoresMedMax_16 != ''){              $a .= ",SensoresMedMax_16='".$SensoresMedMax_16."'" ;}
				if(isset($SensoresMedMax_17) && $SensoresMedMax_17 != ''){              $a .= ",SensoresMedMax_17='".$SensoresMedMax_17."'" ;}
				if(isset($SensoresMedMax_18) && $SensoresMedMax_18 != ''){              $a .= ",SensoresMedMax_18='".$SensoresMedMax_18."'" ;}
				if(isset($SensoresMedMax_19) && $SensoresMedMax_19 != ''){              $a .= ",SensoresMedMax_19='".$SensoresMedMax_19."'" ;}
				if(isset($SensoresMedMax_20) && $SensoresMedMax_20 != ''){              $a .= ",SensoresMedMax_20='".$SensoresMedMax_20."'" ;}
				if(isset($SensoresMedMax_21) && $SensoresMedMax_21 != ''){              $a .= ",SensoresMedMax_21='".$SensoresMedMax_21."'" ;}
				if(isset($SensoresMedMax_22) && $SensoresMedMax_22 != ''){              $a .= ",SensoresMedMax_22='".$SensoresMedMax_22."'" ;}
				if(isset($SensoresMedMax_23) && $SensoresMedMax_23 != ''){              $a .= ",SensoresMedMax_23='".$SensoresMedMax_23."'" ;}
				if(isset($SensoresMedMax_24) && $SensoresMedMax_24 != ''){              $a .= ",SensoresMedMax_24='".$SensoresMedMax_24."'" ;}
				if(isset($SensoresMedMax_25) && $SensoresMedMax_25 != ''){              $a .= ",SensoresMedMax_25='".$SensoresMedMax_25."'" ;}
				if(isset($SensoresMedMax_26) && $SensoresMedMax_26 != ''){              $a .= ",SensoresMedMax_26='".$SensoresMedMax_26."'" ;}
				if(isset($SensoresMedMax_27) && $SensoresMedMax_27 != ''){              $a .= ",SensoresMedMax_27='".$SensoresMedMax_27."'" ;}
				if(isset($SensoresMedMax_28) && $SensoresMedMax_28 != ''){              $a .= ",SensoresMedMax_28='".$SensoresMedMax_28."'" ;}
				if(isset($SensoresMedMax_29) && $SensoresMedMax_29 != ''){              $a .= ",SensoresMedMax_29='".$SensoresMedMax_29."'" ;}
				if(isset($SensoresMedMax_30) && $SensoresMedMax_30 != ''){              $a .= ",SensoresMedMax_30='".$SensoresMedMax_30."'" ;}
				if(isset($SensoresMedMax_31) && $SensoresMedMax_31 != ''){              $a .= ",SensoresMedMax_31='".$SensoresMedMax_31."'" ;}
				if(isset($SensoresMedMax_32) && $SensoresMedMax_32 != ''){              $a .= ",SensoresMedMax_32='".$SensoresMedMax_32."'" ;}
				if(isset($SensoresMedMax_33) && $SensoresMedMax_33 != ''){              $a .= ",SensoresMedMax_33='".$SensoresMedMax_33."'" ;}
				if(isset($SensoresMedMax_34) && $SensoresMedMax_34 != ''){              $a .= ",SensoresMedMax_34='".$SensoresMedMax_34."'" ;}
				if(isset($SensoresMedMax_35) && $SensoresMedMax_35 != ''){              $a .= ",SensoresMedMax_35='".$SensoresMedMax_35."'" ;}
				if(isset($SensoresMedMax_36) && $SensoresMedMax_36 != ''){              $a .= ",SensoresMedMax_36='".$SensoresMedMax_36."'" ;}
				if(isset($SensoresMedMax_37) && $SensoresMedMax_37 != ''){              $a .= ",SensoresMedMax_37='".$SensoresMedMax_37."'" ;}
				if(isset($SensoresMedMax_38) && $SensoresMedMax_38 != ''){              $a .= ",SensoresMedMax_38='".$SensoresMedMax_38."'" ;}
				if(isset($SensoresMedMax_39) && $SensoresMedMax_39 != ''){              $a .= ",SensoresMedMax_39='".$SensoresMedMax_39."'" ;}
				if(isset($SensoresMedMax_40) && $SensoresMedMax_40 != ''){              $a .= ",SensoresMedMax_40='".$SensoresMedMax_40."'" ;}
				if(isset($SensoresMedMax_41) && $SensoresMedMax_41 != ''){              $a .= ",SensoresMedMax_41='".$SensoresMedMax_41."'" ;}
				if(isset($SensoresMedMax_42) && $SensoresMedMax_42 != ''){              $a .= ",SensoresMedMax_42='".$SensoresMedMax_42."'" ;}
				if(isset($SensoresMedMax_43) && $SensoresMedMax_43 != ''){              $a .= ",SensoresMedMax_43='".$SensoresMedMax_43."'" ;}
				if(isset($SensoresMedMax_44) && $SensoresMedMax_44 != ''){              $a .= ",SensoresMedMax_44='".$SensoresMedMax_44."'" ;}
				if(isset($SensoresMedMax_45) && $SensoresMedMax_45 != ''){              $a .= ",SensoresMedMax_45='".$SensoresMedMax_45."'" ;}
				if(isset($SensoresMedMax_46) && $SensoresMedMax_46 != ''){              $a .= ",SensoresMedMax_46='".$SensoresMedMax_46."'" ;}
				if(isset($SensoresMedMax_47) && $SensoresMedMax_47 != ''){              $a .= ",SensoresMedMax_47='".$SensoresMedMax_47."'" ;}
				if(isset($SensoresMedMax_48) && $SensoresMedMax_48 != ''){              $a .= ",SensoresMedMax_48='".$SensoresMedMax_48."'" ;}
				if(isset($SensoresMedMax_49) && $SensoresMedMax_49 != ''){              $a .= ",SensoresMedMax_49='".$SensoresMedMax_49."'" ;}
				if(isset($SensoresMedMax_50) && $SensoresMedMax_50 != ''){              $a .= ",SensoresMedMax_50='".$SensoresMedMax_50."'" ;}
				if(isset($SensoresMedErrores_1) && $SensoresMedErrores_1 != ''){                $a .= ",SensoresMedErrores_1='".$SensoresMedErrores_1."'" ;}
				if(isset($SensoresMedErrores_2) && $SensoresMedErrores_2 != ''){                $a .= ",SensoresMedErrores_2='".$SensoresMedErrores_2."'" ;}
				if(isset($SensoresMedErrores_3) && $SensoresMedErrores_3 != ''){                $a .= ",SensoresMedErrores_3='".$SensoresMedErrores_3."'" ;}
				if(isset($SensoresMedErrores_4) && $SensoresMedErrores_4 != ''){                $a .= ",SensoresMedErrores_4='".$SensoresMedErrores_4."'" ;}
				if(isset($SensoresMedErrores_5) && $SensoresMedErrores_5 != ''){                $a .= ",SensoresMedErrores_5='".$SensoresMedErrores_5."'" ;}
				if(isset($SensoresMedErrores_6) && $SensoresMedErrores_6 != ''){                $a .= ",SensoresMedErrores_6='".$SensoresMedErrores_6."'" ;}
				if(isset($SensoresMedErrores_7) && $SensoresMedErrores_7 != ''){                $a .= ",SensoresMedErrores_7='".$SensoresMedErrores_7."'" ;}
				if(isset($SensoresMedErrores_8) && $SensoresMedErrores_8 != ''){                $a .= ",SensoresMedErrores_8='".$SensoresMedErrores_8."'" ;}
				if(isset($SensoresMedErrores_9) && $SensoresMedErrores_9 != ''){                $a .= ",SensoresMedErrores_9='".$SensoresMedErrores_9."'" ;}
				if(isset($SensoresMedErrores_10) && $SensoresMedErrores_10 != ''){              $a .= ",SensoresMedErrores_10='".$SensoresMedErrores_10."'" ;}
				if(isset($SensoresMedErrores_11) && $SensoresMedErrores_11 != ''){              $a .= ",SensoresMedErrores_11='".$SensoresMedErrores_11."'" ;}
				if(isset($SensoresMedErrores_12) && $SensoresMedErrores_12 != ''){              $a .= ",SensoresMedErrores_12='".$SensoresMedErrores_12."'" ;}
				if(isset($SensoresMedErrores_13) && $SensoresMedErrores_13 != ''){              $a .= ",SensoresMedErrores_13='".$SensoresMedErrores_13."'" ;}
				if(isset($SensoresMedErrores_14) && $SensoresMedErrores_14 != ''){              $a .= ",SensoresMedErrores_14='".$SensoresMedErrores_14."'" ;}
				if(isset($SensoresMedErrores_15) && $SensoresMedErrores_15 != ''){              $a .= ",SensoresMedErrores_15='".$SensoresMedErrores_15."'" ;}
				if(isset($SensoresMedErrores_16) && $SensoresMedErrores_16 != ''){              $a .= ",SensoresMedErrores_16='".$SensoresMedErrores_16."'" ;}
				if(isset($SensoresMedErrores_17) && $SensoresMedErrores_17 != ''){              $a .= ",SensoresMedErrores_17='".$SensoresMedErrores_17."'" ;}
				if(isset($SensoresMedErrores_18) && $SensoresMedErrores_18 != ''){              $a .= ",SensoresMedErrores_18='".$SensoresMedErrores_18."'" ;}
				if(isset($SensoresMedErrores_19) && $SensoresMedErrores_19 != ''){              $a .= ",SensoresMedErrores_19='".$SensoresMedErrores_19."'" ;}
				if(isset($SensoresMedErrores_20) && $SensoresMedErrores_20 != ''){              $a .= ",SensoresMedErrores_20='".$SensoresMedErrores_20."'" ;}
				if(isset($SensoresMedErrores_21) && $SensoresMedErrores_21 != ''){              $a .= ",SensoresMedErrores_21='".$SensoresMedErrores_21."'" ;}
				if(isset($SensoresMedErrores_22) && $SensoresMedErrores_22 != ''){              $a .= ",SensoresMedErrores_22='".$SensoresMedErrores_22."'" ;}
				if(isset($SensoresMedErrores_23) && $SensoresMedErrores_23 != ''){              $a .= ",SensoresMedErrores_23='".$SensoresMedErrores_23."'" ;}
				if(isset($SensoresMedErrores_24) && $SensoresMedErrores_24 != ''){              $a .= ",SensoresMedErrores_24='".$SensoresMedErrores_24."'" ;}
				if(isset($SensoresMedErrores_25) && $SensoresMedErrores_25 != ''){              $a .= ",SensoresMedErrores_25='".$SensoresMedErrores_25."'" ;}
				if(isset($SensoresMedErrores_26) && $SensoresMedErrores_26 != ''){              $a .= ",SensoresMedErrores_26='".$SensoresMedErrores_26."'" ;}
				if(isset($SensoresMedErrores_27) && $SensoresMedErrores_27 != ''){              $a .= ",SensoresMedErrores_27='".$SensoresMedErrores_27."'" ;}
				if(isset($SensoresMedErrores_28) && $SensoresMedErrores_28 != ''){              $a .= ",SensoresMedErrores_28='".$SensoresMedErrores_28."'" ;}
				if(isset($SensoresMedErrores_29) && $SensoresMedErrores_29 != ''){              $a .= ",SensoresMedErrores_29='".$SensoresMedErrores_29."'" ;}
				if(isset($SensoresMedErrores_30) && $SensoresMedErrores_30 != ''){              $a .= ",SensoresMedErrores_30='".$SensoresMedErrores_30."'" ;}
				if(isset($SensoresMedErrores_31) && $SensoresMedErrores_31 != ''){              $a .= ",SensoresMedErrores_31='".$SensoresMedErrores_31."'" ;}
				if(isset($SensoresMedErrores_32) && $SensoresMedErrores_32 != ''){              $a .= ",SensoresMedErrores_32='".$SensoresMedErrores_32."'" ;}
				if(isset($SensoresMedErrores_33) && $SensoresMedErrores_33 != ''){              $a .= ",SensoresMedErrores_33='".$SensoresMedErrores_33."'" ;}
				if(isset($SensoresMedErrores_34) && $SensoresMedErrores_34 != ''){              $a .= ",SensoresMedErrores_34='".$SensoresMedErrores_34."'" ;}
				if(isset($SensoresMedErrores_35) && $SensoresMedErrores_35 != ''){              $a .= ",SensoresMedErrores_35='".$SensoresMedErrores_35."'" ;}
				if(isset($SensoresMedErrores_36) && $SensoresMedErrores_36 != ''){              $a .= ",SensoresMedErrores_36='".$SensoresMedErrores_36."'" ;}
				if(isset($SensoresMedErrores_37) && $SensoresMedErrores_37 != ''){              $a .= ",SensoresMedErrores_37='".$SensoresMedErrores_37."'" ;}
				if(isset($SensoresMedErrores_38) && $SensoresMedErrores_38 != ''){              $a .= ",SensoresMedErrores_38='".$SensoresMedErrores_38."'" ;}
				if(isset($SensoresMedErrores_39) && $SensoresMedErrores_39 != ''){              $a .= ",SensoresMedErrores_39='".$SensoresMedErrores_39."'" ;}
				if(isset($SensoresMedErrores_40) && $SensoresMedErrores_40 != ''){              $a .= ",SensoresMedErrores_40='".$SensoresMedErrores_40."'" ;}
				if(isset($SensoresMedErrores_41) && $SensoresMedErrores_41 != ''){              $a .= ",SensoresMedErrores_41='".$SensoresMedErrores_41."'" ;}
				if(isset($SensoresMedErrores_42) && $SensoresMedErrores_42 != ''){              $a .= ",SensoresMedErrores_42='".$SensoresMedErrores_42."'" ;}
				if(isset($SensoresMedErrores_43) && $SensoresMedErrores_43 != ''){              $a .= ",SensoresMedErrores_43='".$SensoresMedErrores_43."'" ;}
				if(isset($SensoresMedErrores_44) && $SensoresMedErrores_44 != ''){              $a .= ",SensoresMedErrores_44='".$SensoresMedErrores_44."'" ;}
				if(isset($SensoresMedErrores_45) && $SensoresMedErrores_45 != ''){              $a .= ",SensoresMedErrores_45='".$SensoresMedErrores_45."'" ;}
				if(isset($SensoresMedErrores_46) && $SensoresMedErrores_46 != ''){              $a .= ",SensoresMedErrores_46='".$SensoresMedErrores_46."'" ;}
				if(isset($SensoresMedErrores_47) && $SensoresMedErrores_47 != ''){              $a .= ",SensoresMedErrores_47='".$SensoresMedErrores_47."'" ;}
				if(isset($SensoresMedErrores_48) && $SensoresMedErrores_48 != ''){              $a .= ",SensoresMedErrores_48='".$SensoresMedErrores_48."'" ;}
				if(isset($SensoresMedErrores_49) && $SensoresMedErrores_49 != ''){              $a .= ",SensoresMedErrores_49='".$SensoresMedErrores_49."'" ;}
				if(isset($SensoresMedErrores_50) && $SensoresMedErrores_50 != ''){              $a .= ",SensoresMedErrores_50='".$SensoresMedErrores_50."'" ;}
				if(isset($SensoresMedErrores_2_1) && $SensoresMedErrores_2_1 != ''){                $a .= ",SensoresMedErrores_2_1='".$SensoresMedErrores_2_1."'" ;}
				if(isset($SensoresMedErrores_2_2) && $SensoresMedErrores_2_2 != ''){                $a .= ",SensoresMedErrores_2_2='".$SensoresMedErrores_2_2."'" ;}
				if(isset($SensoresMedErrores_2_3) && $SensoresMedErrores_2_3 != ''){                $a .= ",SensoresMedErrores_2_3='".$SensoresMedErrores_2_3."'" ;}
				if(isset($SensoresMedErrores_2_4) && $SensoresMedErrores_2_4 != ''){                $a .= ",SensoresMedErrores_2_4='".$SensoresMedErrores_2_4."'" ;}
				if(isset($SensoresMedErrores_2_5) && $SensoresMedErrores_2_5 != ''){                $a .= ",SensoresMedErrores_2_5='".$SensoresMedErrores_2_5."'" ;}
				if(isset($SensoresMedErrores_2_6) && $SensoresMedErrores_2_6 != ''){                $a .= ",SensoresMedErrores_2_6='".$SensoresMedErrores_2_6."'" ;}
				if(isset($SensoresMedErrores_2_7) && $SensoresMedErrores_2_7 != ''){                $a .= ",SensoresMedErrores_2_7='".$SensoresMedErrores_2_7."'" ;}
				if(isset($SensoresMedErrores_2_8) && $SensoresMedErrores_2_8 != ''){                $a .= ",SensoresMedErrores_2_8='".$SensoresMedErrores_2_8."'" ;}
				if(isset($SensoresMedErrores_2_9) && $SensoresMedErrores_2_9 != ''){                $a .= ",SensoresMedErrores_2_9='".$SensoresMedErrores_2_9."'" ;}
				if(isset($SensoresMedErrores_2_10) && $SensoresMedErrores_2_10 != ''){              $a .= ",SensoresMedErrores_2_10='".$SensoresMedErrores_2_10."'" ;}
				if(isset($SensoresMedErrores_2_11) && $SensoresMedErrores_2_11 != ''){              $a .= ",SensoresMedErrores_2_11='".$SensoresMedErrores_2_11."'" ;}
				if(isset($SensoresMedErrores_2_12) && $SensoresMedErrores_2_12 != ''){              $a .= ",SensoresMedErrores_2_12='".$SensoresMedErrores_2_12."'" ;}
				if(isset($SensoresMedErrores_2_13) && $SensoresMedErrores_2_13 != ''){              $a .= ",SensoresMedErrores_2_13='".$SensoresMedErrores_2_13."'" ;}
				if(isset($SensoresMedErrores_2_14) && $SensoresMedErrores_2_14 != ''){              $a .= ",SensoresMedErrores_2_14='".$SensoresMedErrores_2_14."'" ;}
				if(isset($SensoresMedErrores_2_15) && $SensoresMedErrores_2_15 != ''){              $a .= ",SensoresMedErrores_2_15='".$SensoresMedErrores_2_15."'" ;}
				if(isset($SensoresMedErrores_2_16) && $SensoresMedErrores_2_16 != ''){              $a .= ",SensoresMedErrores_2_16='".$SensoresMedErrores_2_16."'" ;}
				if(isset($SensoresMedErrores_2_17) && $SensoresMedErrores_2_17 != ''){              $a .= ",SensoresMedErrores_2_17='".$SensoresMedErrores_2_17."'" ;}
				if(isset($SensoresMedErrores_2_18) && $SensoresMedErrores_2_18 != ''){              $a .= ",SensoresMedErrores_2_18='".$SensoresMedErrores_2_18."'" ;}
				if(isset($SensoresMedErrores_2_19) && $SensoresMedErrores_2_19 != ''){              $a .= ",SensoresMedErrores_2_19='".$SensoresMedErrores_2_19."'" ;}
				if(isset($SensoresMedErrores_2_20) && $SensoresMedErrores_2_20 != ''){              $a .= ",SensoresMedErrores_2_20='".$SensoresMedErrores_2_20."'" ;}
				if(isset($SensoresMedErrores_2_21) && $SensoresMedErrores_2_21 != ''){              $a .= ",SensoresMedErrores_2_21='".$SensoresMedErrores_2_21."'" ;}
				if(isset($SensoresMedErrores_2_22) && $SensoresMedErrores_2_22 != ''){              $a .= ",SensoresMedErrores_2_22='".$SensoresMedErrores_2_22."'" ;}
				if(isset($SensoresMedErrores_2_23) && $SensoresMedErrores_2_23 != ''){              $a .= ",SensoresMedErrores_2_23='".$SensoresMedErrores_2_23."'" ;}
				if(isset($SensoresMedErrores_2_24) && $SensoresMedErrores_2_24 != ''){              $a .= ",SensoresMedErrores_2_24='".$SensoresMedErrores_2_24."'" ;}
				if(isset($SensoresMedErrores_2_25) && $SensoresMedErrores_2_25 != ''){              $a .= ",SensoresMedErrores_2_25='".$SensoresMedErrores_2_25."'" ;}
				if(isset($SensoresMedErrores_2_26) && $SensoresMedErrores_2_26 != ''){              $a .= ",SensoresMedErrores_2_26='".$SensoresMedErrores_2_26."'" ;}
				if(isset($SensoresMedErrores_2_27) && $SensoresMedErrores_2_27 != ''){              $a .= ",SensoresMedErrores_2_27='".$SensoresMedErrores_2_27."'" ;}
				if(isset($SensoresMedErrores_2_28) && $SensoresMedErrores_2_28 != ''){              $a .= ",SensoresMedErrores_2_28='".$SensoresMedErrores_2_28."'" ;}
				if(isset($SensoresMedErrores_2_29) && $SensoresMedErrores_2_29 != ''){              $a .= ",SensoresMedErrores_2_29='".$SensoresMedErrores_2_29."'" ;}
				if(isset($SensoresMedErrores_2_30) && $SensoresMedErrores_2_30 != ''){              $a .= ",SensoresMedErrores_2_30='".$SensoresMedErrores_2_30."'" ;}
				if(isset($SensoresMedErrores_2_31) && $SensoresMedErrores_2_31 != ''){              $a .= ",SensoresMedErrores_2_31='".$SensoresMedErrores_2_31."'" ;}
				if(isset($SensoresMedErrores_2_32) && $SensoresMedErrores_2_32 != ''){              $a .= ",SensoresMedErrores_2_32='".$SensoresMedErrores_2_32."'" ;}
				if(isset($SensoresMedErrores_2_33) && $SensoresMedErrores_2_33 != ''){              $a .= ",SensoresMedErrores_2_33='".$SensoresMedErrores_2_33."'" ;}
				if(isset($SensoresMedErrores_2_34) && $SensoresMedErrores_2_34 != ''){              $a .= ",SensoresMedErrores_2_34='".$SensoresMedErrores_2_34."'" ;}
				if(isset($SensoresMedErrores_2_35) && $SensoresMedErrores_2_35 != ''){              $a .= ",SensoresMedErrores_2_35='".$SensoresMedErrores_2_35."'" ;}
				if(isset($SensoresMedErrores_2_36) && $SensoresMedErrores_2_36 != ''){              $a .= ",SensoresMedErrores_2_36='".$SensoresMedErrores_2_36."'" ;}
				if(isset($SensoresMedErrores_2_37) && $SensoresMedErrores_2_37 != ''){              $a .= ",SensoresMedErrores_2_37='".$SensoresMedErrores_2_37."'" ;}
				if(isset($SensoresMedErrores_2_38) && $SensoresMedErrores_2_38 != ''){              $a .= ",SensoresMedErrores_2_38='".$SensoresMedErrores_2_38."'" ;}
				if(isset($SensoresMedErrores_2_39) && $SensoresMedErrores_2_39 != ''){              $a .= ",SensoresMedErrores_2_39='".$SensoresMedErrores_2_39."'" ;}
				if(isset($SensoresMedErrores_2_40) && $SensoresMedErrores_2_40 != ''){              $a .= ",SensoresMedErrores_2_40='".$SensoresMedErrores_2_40."'" ;}
				if(isset($SensoresMedErrores_2_41) && $SensoresMedErrores_2_41 != ''){              $a .= ",SensoresMedErrores_2_41='".$SensoresMedErrores_2_41."'" ;}
				if(isset($SensoresMedErrores_2_42) && $SensoresMedErrores_2_42 != ''){              $a .= ",SensoresMedErrores_2_42='".$SensoresMedErrores_2_42."'" ;}
				if(isset($SensoresMedErrores_2_43) && $SensoresMedErrores_2_43 != ''){              $a .= ",SensoresMedErrores_2_43='".$SensoresMedErrores_2_43."'" ;}
				if(isset($SensoresMedErrores_2_44) && $SensoresMedErrores_2_44 != ''){              $a .= ",SensoresMedErrores_2_44='".$SensoresMedErrores_2_44."'" ;}
				if(isset($SensoresMedErrores_2_45) && $SensoresMedErrores_2_45 != ''){              $a .= ",SensoresMedErrores_2_45='".$SensoresMedErrores_2_45."'" ;}
				if(isset($SensoresMedErrores_2_46) && $SensoresMedErrores_2_46 != ''){              $a .= ",SensoresMedErrores_2_46='".$SensoresMedErrores_2_46."'" ;}
				if(isset($SensoresMedErrores_2_47) && $SensoresMedErrores_2_47 != ''){              $a .= ",SensoresMedErrores_2_47='".$SensoresMedErrores_2_47."'" ;}
				if(isset($SensoresMedErrores_2_48) && $SensoresMedErrores_2_48 != ''){              $a .= ",SensoresMedErrores_2_48='".$SensoresMedErrores_2_48."'" ;}
				if(isset($SensoresMedErrores_2_49) && $SensoresMedErrores_2_49 != ''){              $a .= ",SensoresMedErrores_2_49='".$SensoresMedErrores_2_49."'" ;}
				if(isset($SensoresMedErrores_2_50) && $SensoresMedErrores_2_50 != ''){              $a .= ",SensoresMedErrores_2_50='".$SensoresMedErrores_2_50."'" ;}
				if(isset($SensoresMedErrores_3_1) && $SensoresMedErrores_3_1 != ''){                $a .= ",SensoresMedErrores_3_1='".$SensoresMedErrores_3_1."'" ;}
				if(isset($SensoresMedErrores_3_2) && $SensoresMedErrores_3_2 != ''){                $a .= ",SensoresMedErrores_3_2='".$SensoresMedErrores_3_2."'" ;}
				if(isset($SensoresMedErrores_3_3) && $SensoresMedErrores_3_3 != ''){                $a .= ",SensoresMedErrores_3_3='".$SensoresMedErrores_3_3."'" ;}
				if(isset($SensoresMedErrores_3_4) && $SensoresMedErrores_3_4 != ''){                $a .= ",SensoresMedErrores_3_4='".$SensoresMedErrores_3_4."'" ;}
				if(isset($SensoresMedErrores_3_5) && $SensoresMedErrores_3_5 != ''){                $a .= ",SensoresMedErrores_3_5='".$SensoresMedErrores_3_5."'" ;}
				if(isset($SensoresMedErrores_3_6) && $SensoresMedErrores_3_6 != ''){                $a .= ",SensoresMedErrores_3_6='".$SensoresMedErrores_3_6."'" ;}
				if(isset($SensoresMedErrores_3_7) && $SensoresMedErrores_3_7 != ''){                $a .= ",SensoresMedErrores_3_7='".$SensoresMedErrores_3_7."'" ;}
				if(isset($SensoresMedErrores_3_8) && $SensoresMedErrores_3_8 != ''){                $a .= ",SensoresMedErrores_3_8='".$SensoresMedErrores_3_8."'" ;}
				if(isset($SensoresMedErrores_3_9) && $SensoresMedErrores_3_9 != ''){                $a .= ",SensoresMedErrores_3_9='".$SensoresMedErrores_3_9."'" ;}
				if(isset($SensoresMedErrores_3_10) && $SensoresMedErrores_3_10 != ''){              $a .= ",SensoresMedErrores_3_10='".$SensoresMedErrores_3_10."'" ;}
				if(isset($SensoresMedErrores_3_11) && $SensoresMedErrores_3_11 != ''){              $a .= ",SensoresMedErrores_3_11='".$SensoresMedErrores_3_11."'" ;}
				if(isset($SensoresMedErrores_3_12) && $SensoresMedErrores_3_12 != ''){              $a .= ",SensoresMedErrores_3_12='".$SensoresMedErrores_3_12."'" ;}
				if(isset($SensoresMedErrores_3_13) && $SensoresMedErrores_3_13 != ''){              $a .= ",SensoresMedErrores_3_13='".$SensoresMedErrores_3_13."'" ;}
				if(isset($SensoresMedErrores_3_14) && $SensoresMedErrores_3_14 != ''){              $a .= ",SensoresMedErrores_3_14='".$SensoresMedErrores_3_14."'" ;}
				if(isset($SensoresMedErrores_3_15) && $SensoresMedErrores_3_15 != ''){              $a .= ",SensoresMedErrores_3_15='".$SensoresMedErrores_3_15."'" ;}
				if(isset($SensoresMedErrores_3_16) && $SensoresMedErrores_3_16 != ''){              $a .= ",SensoresMedErrores_3_16='".$SensoresMedErrores_3_16."'" ;}
				if(isset($SensoresMedErrores_3_17) && $SensoresMedErrores_3_17 != ''){              $a .= ",SensoresMedErrores_3_17='".$SensoresMedErrores_3_17."'" ;}
				if(isset($SensoresMedErrores_3_18) && $SensoresMedErrores_3_18 != ''){              $a .= ",SensoresMedErrores_3_18='".$SensoresMedErrores_3_18."'" ;}
				if(isset($SensoresMedErrores_3_19) && $SensoresMedErrores_3_19 != ''){              $a .= ",SensoresMedErrores_3_19='".$SensoresMedErrores_3_19."'" ;}
				if(isset($SensoresMedErrores_3_20) && $SensoresMedErrores_3_20 != ''){              $a .= ",SensoresMedErrores_3_20='".$SensoresMedErrores_3_20."'" ;}
				if(isset($SensoresMedErrores_3_21) && $SensoresMedErrores_3_21 != ''){              $a .= ",SensoresMedErrores_3_21='".$SensoresMedErrores_3_21."'" ;}
				if(isset($SensoresMedErrores_3_22) && $SensoresMedErrores_3_22 != ''){              $a .= ",SensoresMedErrores_3_22='".$SensoresMedErrores_3_22."'" ;}
				if(isset($SensoresMedErrores_3_23) && $SensoresMedErrores_3_23 != ''){              $a .= ",SensoresMedErrores_3_23='".$SensoresMedErrores_3_23."'" ;}
				if(isset($SensoresMedErrores_3_24) && $SensoresMedErrores_3_24 != ''){              $a .= ",SensoresMedErrores_3_24='".$SensoresMedErrores_3_24."'" ;}
				if(isset($SensoresMedErrores_3_25) && $SensoresMedErrores_3_25 != ''){              $a .= ",SensoresMedErrores_3_25='".$SensoresMedErrores_3_25."'" ;}
				if(isset($SensoresMedErrores_3_26) && $SensoresMedErrores_3_26 != ''){              $a .= ",SensoresMedErrores_3_26='".$SensoresMedErrores_3_26."'" ;}
				if(isset($SensoresMedErrores_3_27) && $SensoresMedErrores_3_27 != ''){              $a .= ",SensoresMedErrores_3_27='".$SensoresMedErrores_3_27."'" ;}
				if(isset($SensoresMedErrores_3_28) && $SensoresMedErrores_3_28 != ''){              $a .= ",SensoresMedErrores_3_28='".$SensoresMedErrores_3_28."'" ;}
				if(isset($SensoresMedErrores_3_29) && $SensoresMedErrores_3_29 != ''){              $a .= ",SensoresMedErrores_3_29='".$SensoresMedErrores_3_29."'" ;}
				if(isset($SensoresMedErrores_3_30) && $SensoresMedErrores_3_30 != ''){              $a .= ",SensoresMedErrores_3_30='".$SensoresMedErrores_3_30."'" ;}
				if(isset($SensoresMedErrores_3_31) && $SensoresMedErrores_3_31 != ''){              $a .= ",SensoresMedErrores_3_31='".$SensoresMedErrores_3_31."'" ;}
				if(isset($SensoresMedErrores_3_32) && $SensoresMedErrores_3_32 != ''){              $a .= ",SensoresMedErrores_3_32='".$SensoresMedErrores_3_32."'" ;}
				if(isset($SensoresMedErrores_3_33) && $SensoresMedErrores_3_33 != ''){              $a .= ",SensoresMedErrores_3_33='".$SensoresMedErrores_3_33."'" ;}
				if(isset($SensoresMedErrores_3_34) && $SensoresMedErrores_3_34 != ''){              $a .= ",SensoresMedErrores_3_34='".$SensoresMedErrores_3_34."'" ;}
				if(isset($SensoresMedErrores_3_35) && $SensoresMedErrores_3_35 != ''){              $a .= ",SensoresMedErrores_3_35='".$SensoresMedErrores_3_35."'" ;}
				if(isset($SensoresMedErrores_3_36) && $SensoresMedErrores_3_36 != ''){              $a .= ",SensoresMedErrores_3_36='".$SensoresMedErrores_3_36."'" ;}
				if(isset($SensoresMedErrores_3_37) && $SensoresMedErrores_3_37 != ''){              $a .= ",SensoresMedErrores_3_37='".$SensoresMedErrores_3_37."'" ;}
				if(isset($SensoresMedErrores_3_38) && $SensoresMedErrores_3_38 != ''){              $a .= ",SensoresMedErrores_3_38='".$SensoresMedErrores_3_38."'" ;}
				if(isset($SensoresMedErrores_3_39) && $SensoresMedErrores_3_39 != ''){              $a .= ",SensoresMedErrores_3_39='".$SensoresMedErrores_3_39."'" ;}
				if(isset($SensoresMedErrores_3_40) && $SensoresMedErrores_3_40 != ''){              $a .= ",SensoresMedErrores_3_40='".$SensoresMedErrores_3_40."'" ;}
				if(isset($SensoresMedErrores_3_41) && $SensoresMedErrores_3_41 != ''){              $a .= ",SensoresMedErrores_3_41='".$SensoresMedErrores_3_41."'" ;}
				if(isset($SensoresMedErrores_3_42) && $SensoresMedErrores_3_42 != ''){              $a .= ",SensoresMedErrores_3_42='".$SensoresMedErrores_3_42."'" ;}
				if(isset($SensoresMedErrores_3_43) && $SensoresMedErrores_3_43 != ''){              $a .= ",SensoresMedErrores_3_43='".$SensoresMedErrores_3_43."'" ;}
				if(isset($SensoresMedErrores_3_44) && $SensoresMedErrores_3_44 != ''){              $a .= ",SensoresMedErrores_3_44='".$SensoresMedErrores_3_44."'" ;}
				if(isset($SensoresMedErrores_3_45) && $SensoresMedErrores_3_45 != ''){              $a .= ",SensoresMedErrores_3_45='".$SensoresMedErrores_3_45."'" ;}
				if(isset($SensoresMedErrores_3_46) && $SensoresMedErrores_3_46 != ''){              $a .= ",SensoresMedErrores_3_46='".$SensoresMedErrores_3_46."'" ;}
				if(isset($SensoresMedErrores_3_47) && $SensoresMedErrores_3_47 != ''){              $a .= ",SensoresMedErrores_3_47='".$SensoresMedErrores_3_47."'" ;}
				if(isset($SensoresMedErrores_3_48) && $SensoresMedErrores_3_48 != ''){              $a .= ",SensoresMedErrores_3_48='".$SensoresMedErrores_3_48."'" ;}
				if(isset($SensoresMedErrores_3_49) && $SensoresMedErrores_3_49 != ''){              $a .= ",SensoresMedErrores_3_49='".$SensoresMedErrores_3_49."'" ;}
				if(isset($SensoresMedErrores_3_50) && $SensoresMedErrores_3_50 != ''){              $a .= ",SensoresMedErrores_3_50='".$SensoresMedErrores_3_50."'" ;}
				if(isset($SensoresMedAlerta_1) && $SensoresMedAlerta_1 != ''){                $a .= ",SensoresMedAlerta_1='".$SensoresMedAlerta_1."'" ;}
				if(isset($SensoresMedAlerta_2) && $SensoresMedAlerta_2 != ''){                $a .= ",SensoresMedAlerta_2='".$SensoresMedAlerta_2."'" ;}
				if(isset($SensoresMedAlerta_3) && $SensoresMedAlerta_3 != ''){                $a .= ",SensoresMedAlerta_3='".$SensoresMedAlerta_3."'" ;}
				if(isset($SensoresMedAlerta_4) && $SensoresMedAlerta_4 != ''){                $a .= ",SensoresMedAlerta_4='".$SensoresMedAlerta_4."'" ;}
				if(isset($SensoresMedAlerta_5) && $SensoresMedAlerta_5 != ''){                $a .= ",SensoresMedAlerta_5='".$SensoresMedAlerta_5."'" ;}
				if(isset($SensoresMedAlerta_6) && $SensoresMedAlerta_6 != ''){                $a .= ",SensoresMedAlerta_6='".$SensoresMedAlerta_6."'" ;}
				if(isset($SensoresMedAlerta_7) && $SensoresMedAlerta_7 != ''){                $a .= ",SensoresMedAlerta_7='".$SensoresMedAlerta_7."'" ;}
				if(isset($SensoresMedAlerta_8) && $SensoresMedAlerta_8 != ''){                $a .= ",SensoresMedAlerta_8='".$SensoresMedAlerta_8."'" ;}
				if(isset($SensoresMedAlerta_9) && $SensoresMedAlerta_9 != ''){                $a .= ",SensoresMedAlerta_9='".$SensoresMedAlerta_9."'" ;}
				if(isset($SensoresMedAlerta_10) && $SensoresMedAlerta_10 != ''){              $a .= ",SensoresMedAlerta_10='".$SensoresMedAlerta_10."'" ;}
				if(isset($SensoresMedAlerta_11) && $SensoresMedAlerta_11 != ''){              $a .= ",SensoresMedAlerta_11='".$SensoresMedAlerta_11."'" ;}
				if(isset($SensoresMedAlerta_12) && $SensoresMedAlerta_12 != ''){              $a .= ",SensoresMedAlerta_12='".$SensoresMedAlerta_12."'" ;}
				if(isset($SensoresMedAlerta_13) && $SensoresMedAlerta_13 != ''){              $a .= ",SensoresMedAlerta_13='".$SensoresMedAlerta_13."'" ;}
				if(isset($SensoresMedAlerta_14) && $SensoresMedAlerta_14 != ''){              $a .= ",SensoresMedAlerta_14='".$SensoresMedAlerta_14."'" ;}
				if(isset($SensoresMedAlerta_15) && $SensoresMedAlerta_15 != ''){              $a .= ",SensoresMedAlerta_15='".$SensoresMedAlerta_15."'" ;}
				if(isset($SensoresMedAlerta_16) && $SensoresMedAlerta_16 != ''){              $a .= ",SensoresMedAlerta_16='".$SensoresMedAlerta_16."'" ;}
				if(isset($SensoresMedAlerta_17) && $SensoresMedAlerta_17 != ''){              $a .= ",SensoresMedAlerta_17='".$SensoresMedAlerta_17."'" ;}
				if(isset($SensoresMedAlerta_18) && $SensoresMedAlerta_18 != ''){              $a .= ",SensoresMedAlerta_18='".$SensoresMedAlerta_18."'" ;}
				if(isset($SensoresMedAlerta_19) && $SensoresMedAlerta_19 != ''){              $a .= ",SensoresMedAlerta_19='".$SensoresMedAlerta_19."'" ;}
				if(isset($SensoresMedAlerta_20) && $SensoresMedAlerta_20 != ''){              $a .= ",SensoresMedAlerta_20='".$SensoresMedAlerta_20."'" ;}
				if(isset($SensoresMedAlerta_21) && $SensoresMedAlerta_21 != ''){              $a .= ",SensoresMedAlerta_21='".$SensoresMedAlerta_21."'" ;}
				if(isset($SensoresMedAlerta_22) && $SensoresMedAlerta_22 != ''){              $a .= ",SensoresMedAlerta_22='".$SensoresMedAlerta_22."'" ;}
				if(isset($SensoresMedAlerta_23) && $SensoresMedAlerta_23 != ''){              $a .= ",SensoresMedAlerta_23='".$SensoresMedAlerta_23."'" ;}
				if(isset($SensoresMedAlerta_24) && $SensoresMedAlerta_24 != ''){              $a .= ",SensoresMedAlerta_24='".$SensoresMedAlerta_24."'" ;}
				if(isset($SensoresMedAlerta_25) && $SensoresMedAlerta_25 != ''){              $a .= ",SensoresMedAlerta_25='".$SensoresMedAlerta_25."'" ;}
				if(isset($SensoresMedAlerta_26) && $SensoresMedAlerta_26 != ''){              $a .= ",SensoresMedAlerta_26='".$SensoresMedAlerta_26."'" ;}
				if(isset($SensoresMedAlerta_27) && $SensoresMedAlerta_27 != ''){              $a .= ",SensoresMedAlerta_27='".$SensoresMedAlerta_27."'" ;}
				if(isset($SensoresMedAlerta_28) && $SensoresMedAlerta_28 != ''){              $a .= ",SensoresMedAlerta_28='".$SensoresMedAlerta_28."'" ;}
				if(isset($SensoresMedAlerta_29) && $SensoresMedAlerta_29 != ''){              $a .= ",SensoresMedAlerta_29='".$SensoresMedAlerta_29."'" ;}
				if(isset($SensoresMedAlerta_30) && $SensoresMedAlerta_30 != ''){              $a .= ",SensoresMedAlerta_30='".$SensoresMedAlerta_30."'" ;}
				if(isset($SensoresMedAlerta_31) && $SensoresMedAlerta_31 != ''){              $a .= ",SensoresMedAlerta_31='".$SensoresMedAlerta_31."'" ;}
				if(isset($SensoresMedAlerta_32) && $SensoresMedAlerta_32 != ''){              $a .= ",SensoresMedAlerta_32='".$SensoresMedAlerta_32."'" ;}
				if(isset($SensoresMedAlerta_33) && $SensoresMedAlerta_33 != ''){              $a .= ",SensoresMedAlerta_33='".$SensoresMedAlerta_33."'" ;}
				if(isset($SensoresMedAlerta_34) && $SensoresMedAlerta_34 != ''){              $a .= ",SensoresMedAlerta_34='".$SensoresMedAlerta_34."'" ;}
				if(isset($SensoresMedAlerta_35) && $SensoresMedAlerta_35 != ''){              $a .= ",SensoresMedAlerta_35='".$SensoresMedAlerta_35."'" ;}
				if(isset($SensoresMedAlerta_36) && $SensoresMedAlerta_36 != ''){              $a .= ",SensoresMedAlerta_36='".$SensoresMedAlerta_36."'" ;}
				if(isset($SensoresMedAlerta_37) && $SensoresMedAlerta_37 != ''){              $a .= ",SensoresMedAlerta_37='".$SensoresMedAlerta_37."'" ;}
				if(isset($SensoresMedAlerta_38) && $SensoresMedAlerta_38 != ''){              $a .= ",SensoresMedAlerta_38='".$SensoresMedAlerta_38."'" ;}
				if(isset($SensoresMedAlerta_39) && $SensoresMedAlerta_39 != ''){              $a .= ",SensoresMedAlerta_39='".$SensoresMedAlerta_39."'" ;}
				if(isset($SensoresMedAlerta_40) && $SensoresMedAlerta_40 != ''){              $a .= ",SensoresMedAlerta_40='".$SensoresMedAlerta_40."'" ;}
				if(isset($SensoresMedAlerta_41) && $SensoresMedAlerta_41 != ''){              $a .= ",SensoresMedAlerta_41='".$SensoresMedAlerta_41."'" ;}
				if(isset($SensoresMedAlerta_42) && $SensoresMedAlerta_42 != ''){              $a .= ",SensoresMedAlerta_42='".$SensoresMedAlerta_42."'" ;}
				if(isset($SensoresMedAlerta_43) && $SensoresMedAlerta_43 != ''){              $a .= ",SensoresMedAlerta_43='".$SensoresMedAlerta_43."'" ;}
				if(isset($SensoresMedAlerta_44) && $SensoresMedAlerta_44 != ''){              $a .= ",SensoresMedAlerta_44='".$SensoresMedAlerta_44."'" ;}
				if(isset($SensoresMedAlerta_45) && $SensoresMedAlerta_45 != ''){              $a .= ",SensoresMedAlerta_45='".$SensoresMedAlerta_45."'" ;}
				if(isset($SensoresMedAlerta_46) && $SensoresMedAlerta_46 != ''){              $a .= ",SensoresMedAlerta_46='".$SensoresMedAlerta_46."'" ;}
				if(isset($SensoresMedAlerta_47) && $SensoresMedAlerta_47 != ''){              $a .= ",SensoresMedAlerta_47='".$SensoresMedAlerta_47."'" ;}
				if(isset($SensoresMedAlerta_48) && $SensoresMedAlerta_48 != ''){              $a .= ",SensoresMedAlerta_48='".$SensoresMedAlerta_48."'" ;}
				if(isset($SensoresMedAlerta_49) && $SensoresMedAlerta_49 != ''){              $a .= ",SensoresMedAlerta_49='".$SensoresMedAlerta_49."'" ;}
				if(isset($SensoresMedAlerta_50) && $SensoresMedAlerta_50 != ''){              $a .= ",SensoresMedAlerta_50='".$SensoresMedAlerta_50."'" ;}
				if(isset($SensoresGrupo_1) && $SensoresGrupo_1 != ''){                $a .= ",SensoresGrupo_1='".$SensoresGrupo_1."'" ;}
				if(isset($SensoresGrupo_2) && $SensoresGrupo_2 != ''){                $a .= ",SensoresGrupo_2='".$SensoresGrupo_2."'" ;}
				if(isset($SensoresGrupo_3) && $SensoresGrupo_3 != ''){                $a .= ",SensoresGrupo_3='".$SensoresGrupo_3."'" ;}
				if(isset($SensoresGrupo_4) && $SensoresGrupo_4 != ''){                $a .= ",SensoresGrupo_4='".$SensoresGrupo_4."'" ;}
				if(isset($SensoresGrupo_5) && $SensoresGrupo_5 != ''){                $a .= ",SensoresGrupo_5='".$SensoresGrupo_5."'" ;}
				if(isset($SensoresGrupo_6) && $SensoresGrupo_6 != ''){                $a .= ",SensoresGrupo_6='".$SensoresGrupo_6."'" ;}
				if(isset($SensoresGrupo_7) && $SensoresGrupo_7 != ''){                $a .= ",SensoresGrupo_7='".$SensoresGrupo_7."'" ;}
				if(isset($SensoresGrupo_8) && $SensoresGrupo_8 != ''){                $a .= ",SensoresGrupo_8='".$SensoresGrupo_8."'" ;}
				if(isset($SensoresGrupo_9) && $SensoresGrupo_9 != ''){                $a .= ",SensoresGrupo_9='".$SensoresGrupo_9."'" ;}
				if(isset($SensoresGrupo_10) && $SensoresGrupo_10 != ''){              $a .= ",SensoresGrupo_10='".$SensoresGrupo_10."'" ;}
				if(isset($SensoresGrupo_11) && $SensoresGrupo_11 != ''){              $a .= ",SensoresGrupo_11='".$SensoresGrupo_11."'" ;}
				if(isset($SensoresGrupo_12) && $SensoresGrupo_12 != ''){              $a .= ",SensoresGrupo_12='".$SensoresGrupo_12."'" ;}
				if(isset($SensoresGrupo_13) && $SensoresGrupo_13 != ''){              $a .= ",SensoresGrupo_13='".$SensoresGrupo_13."'" ;}
				if(isset($SensoresGrupo_14) && $SensoresGrupo_14 != ''){              $a .= ",SensoresGrupo_14='".$SensoresGrupo_14."'" ;}
				if(isset($SensoresGrupo_15) && $SensoresGrupo_15 != ''){              $a .= ",SensoresGrupo_15='".$SensoresGrupo_15."'" ;}
				if(isset($SensoresGrupo_16) && $SensoresGrupo_16 != ''){              $a .= ",SensoresGrupo_16='".$SensoresGrupo_16."'" ;}
				if(isset($SensoresGrupo_17) && $SensoresGrupo_17 != ''){              $a .= ",SensoresGrupo_17='".$SensoresGrupo_17."'" ;}
				if(isset($SensoresGrupo_18) && $SensoresGrupo_18 != ''){              $a .= ",SensoresGrupo_18='".$SensoresGrupo_18."'" ;}
				if(isset($SensoresGrupo_19) && $SensoresGrupo_19 != ''){              $a .= ",SensoresGrupo_19='".$SensoresGrupo_19."'" ;}
				if(isset($SensoresGrupo_20) && $SensoresGrupo_20 != ''){              $a .= ",SensoresGrupo_20='".$SensoresGrupo_20."'" ;}
				if(isset($SensoresGrupo_21) && $SensoresGrupo_21 != ''){              $a .= ",SensoresGrupo_21='".$SensoresGrupo_21."'" ;}
				if(isset($SensoresGrupo_22) && $SensoresGrupo_22 != ''){              $a .= ",SensoresGrupo_22='".$SensoresGrupo_22."'" ;}
				if(isset($SensoresGrupo_23) && $SensoresGrupo_23 != ''){              $a .= ",SensoresGrupo_23='".$SensoresGrupo_23."'" ;}
				if(isset($SensoresGrupo_24) && $SensoresGrupo_24 != ''){              $a .= ",SensoresGrupo_24='".$SensoresGrupo_24."'" ;}
				if(isset($SensoresGrupo_25) && $SensoresGrupo_25 != ''){              $a .= ",SensoresGrupo_25='".$SensoresGrupo_25."'" ;}
				if(isset($SensoresGrupo_26) && $SensoresGrupo_26 != ''){              $a .= ",SensoresGrupo_26='".$SensoresGrupo_26."'" ;}
				if(isset($SensoresGrupo_27) && $SensoresGrupo_27 != ''){              $a .= ",SensoresGrupo_27='".$SensoresGrupo_27."'" ;}
				if(isset($SensoresGrupo_28) && $SensoresGrupo_28 != ''){              $a .= ",SensoresGrupo_28='".$SensoresGrupo_28."'" ;}
				if(isset($SensoresGrupo_29) && $SensoresGrupo_29 != ''){              $a .= ",SensoresGrupo_29='".$SensoresGrupo_29."'" ;}
				if(isset($SensoresGrupo_30) && $SensoresGrupo_30 != ''){              $a .= ",SensoresGrupo_30='".$SensoresGrupo_30."'" ;}
				if(isset($SensoresGrupo_31) && $SensoresGrupo_31 != ''){              $a .= ",SensoresGrupo_31='".$SensoresGrupo_31."'" ;}
				if(isset($SensoresGrupo_32) && $SensoresGrupo_32 != ''){              $a .= ",SensoresGrupo_32='".$SensoresGrupo_32."'" ;}
				if(isset($SensoresGrupo_33) && $SensoresGrupo_33 != ''){              $a .= ",SensoresGrupo_33='".$SensoresGrupo_33."'" ;}
				if(isset($SensoresGrupo_34) && $SensoresGrupo_34 != ''){              $a .= ",SensoresGrupo_34='".$SensoresGrupo_34."'" ;}
				if(isset($SensoresGrupo_35) && $SensoresGrupo_35 != ''){              $a .= ",SensoresGrupo_35='".$SensoresGrupo_35."'" ;}
				if(isset($SensoresGrupo_36) && $SensoresGrupo_36 != ''){              $a .= ",SensoresGrupo_36='".$SensoresGrupo_36."'" ;}
				if(isset($SensoresGrupo_37) && $SensoresGrupo_37 != ''){              $a .= ",SensoresGrupo_37='".$SensoresGrupo_37."'" ;}
				if(isset($SensoresGrupo_38) && $SensoresGrupo_38 != ''){              $a .= ",SensoresGrupo_38='".$SensoresGrupo_38."'" ;}
				if(isset($SensoresGrupo_39) && $SensoresGrupo_39 != ''){              $a .= ",SensoresGrupo_39='".$SensoresGrupo_39."'" ;}
				if(isset($SensoresGrupo_40) && $SensoresGrupo_40 != ''){              $a .= ",SensoresGrupo_40='".$SensoresGrupo_40."'" ;}
				if(isset($SensoresGrupo_41) && $SensoresGrupo_41 != ''){              $a .= ",SensoresGrupo_41='".$SensoresGrupo_41."'" ;}
				if(isset($SensoresGrupo_42) && $SensoresGrupo_42 != ''){              $a .= ",SensoresGrupo_42='".$SensoresGrupo_42."'" ;}
				if(isset($SensoresGrupo_43) && $SensoresGrupo_43 != ''){              $a .= ",SensoresGrupo_43='".$SensoresGrupo_43."'" ;}
				if(isset($SensoresGrupo_44) && $SensoresGrupo_44 != ''){              $a .= ",SensoresGrupo_44='".$SensoresGrupo_44."'" ;}
				if(isset($SensoresGrupo_45) && $SensoresGrupo_45 != ''){              $a .= ",SensoresGrupo_45='".$SensoresGrupo_45."'" ;}
				if(isset($SensoresGrupo_46) && $SensoresGrupo_46 != ''){              $a .= ",SensoresGrupo_46='".$SensoresGrupo_46."'" ;}
				if(isset($SensoresGrupo_47) && $SensoresGrupo_47 != ''){              $a .= ",SensoresGrupo_47='".$SensoresGrupo_47."'" ;}
				if(isset($SensoresGrupo_48) && $SensoresGrupo_48 != ''){              $a .= ",SensoresGrupo_48='".$SensoresGrupo_48."'" ;}
				if(isset($SensoresGrupo_49) && $SensoresGrupo_49 != ''){              $a .= ",SensoresGrupo_49='".$SensoresGrupo_49."'" ;}
				if(isset($SensoresGrupo_50) && $SensoresGrupo_50 != ''){              $a .= ",SensoresGrupo_50='".$SensoresGrupo_50."'" ;}
				if(isset($SensoresUniMed_1) && $SensoresUniMed_1 != ''){                $a .= ",SensoresUniMed_1='".$SensoresUniMed_1."'" ;}
				if(isset($SensoresUniMed_2) && $SensoresUniMed_2 != ''){                $a .= ",SensoresUniMed_2='".$SensoresUniMed_2."'" ;}
				if(isset($SensoresUniMed_3) && $SensoresUniMed_3 != ''){                $a .= ",SensoresUniMed_3='".$SensoresUniMed_3."'" ;}
				if(isset($SensoresUniMed_4) && $SensoresUniMed_4 != ''){                $a .= ",SensoresUniMed_4='".$SensoresUniMed_4."'" ;}
				if(isset($SensoresUniMed_5) && $SensoresUniMed_5 != ''){                $a .= ",SensoresUniMed_5='".$SensoresUniMed_5."'" ;}
				if(isset($SensoresUniMed_6) && $SensoresUniMed_6 != ''){                $a .= ",SensoresUniMed_6='".$SensoresUniMed_6."'" ;}
				if(isset($SensoresUniMed_7) && $SensoresUniMed_7 != ''){                $a .= ",SensoresUniMed_7='".$SensoresUniMed_7."'" ;}
				if(isset($SensoresUniMed_8) && $SensoresUniMed_8 != ''){                $a .= ",SensoresUniMed_8='".$SensoresUniMed_8."'" ;}
				if(isset($SensoresUniMed_9) && $SensoresUniMed_9 != ''){                $a .= ",SensoresUniMed_9='".$SensoresUniMed_9."'" ;}
				if(isset($SensoresUniMed_10) && $SensoresUniMed_10 != ''){              $a .= ",SensoresUniMed_10='".$SensoresUniMed_10."'" ;}
				if(isset($SensoresUniMed_11) && $SensoresUniMed_11 != ''){              $a .= ",SensoresUniMed_11='".$SensoresUniMed_11."'" ;}
				if(isset($SensoresUniMed_12) && $SensoresUniMed_12 != ''){              $a .= ",SensoresUniMed_12='".$SensoresUniMed_12."'" ;}
				if(isset($SensoresUniMed_13) && $SensoresUniMed_13 != ''){              $a .= ",SensoresUniMed_13='".$SensoresUniMed_13."'" ;}
				if(isset($SensoresUniMed_14) && $SensoresUniMed_14 != ''){              $a .= ",SensoresUniMed_14='".$SensoresUniMed_14."'" ;}
				if(isset($SensoresUniMed_15) && $SensoresUniMed_15 != ''){              $a .= ",SensoresUniMed_15='".$SensoresUniMed_15."'" ;}
				if(isset($SensoresUniMed_16) && $SensoresUniMed_16 != ''){              $a .= ",SensoresUniMed_16='".$SensoresUniMed_16."'" ;}
				if(isset($SensoresUniMed_17) && $SensoresUniMed_17 != ''){              $a .= ",SensoresUniMed_17='".$SensoresUniMed_17."'" ;}
				if(isset($SensoresUniMed_18) && $SensoresUniMed_18 != ''){              $a .= ",SensoresUniMed_18='".$SensoresUniMed_18."'" ;}
				if(isset($SensoresUniMed_19) && $SensoresUniMed_19 != ''){              $a .= ",SensoresUniMed_19='".$SensoresUniMed_19."'" ;}
				if(isset($SensoresUniMed_20) && $SensoresUniMed_20 != ''){              $a .= ",SensoresUniMed_20='".$SensoresUniMed_20."'" ;}
				if(isset($SensoresUniMed_21) && $SensoresUniMed_21 != ''){              $a .= ",SensoresUniMed_21='".$SensoresUniMed_21."'" ;}
				if(isset($SensoresUniMed_22) && $SensoresUniMed_22 != ''){              $a .= ",SensoresUniMed_22='".$SensoresUniMed_22."'" ;}
				if(isset($SensoresUniMed_23) && $SensoresUniMed_23 != ''){              $a .= ",SensoresUniMed_23='".$SensoresUniMed_23."'" ;}
				if(isset($SensoresUniMed_24) && $SensoresUniMed_24 != ''){              $a .= ",SensoresUniMed_24='".$SensoresUniMed_24."'" ;}
				if(isset($SensoresUniMed_25) && $SensoresUniMed_25 != ''){              $a .= ",SensoresUniMed_25='".$SensoresUniMed_25."'" ;}
				if(isset($SensoresUniMed_26) && $SensoresUniMed_26 != ''){              $a .= ",SensoresUniMed_26='".$SensoresUniMed_26."'" ;}
				if(isset($SensoresUniMed_27) && $SensoresUniMed_27 != ''){              $a .= ",SensoresUniMed_27='".$SensoresUniMed_27."'" ;}
				if(isset($SensoresUniMed_28) && $SensoresUniMed_28 != ''){              $a .= ",SensoresUniMed_28='".$SensoresUniMed_28."'" ;}
				if(isset($SensoresUniMed_29) && $SensoresUniMed_29 != ''){              $a .= ",SensoresUniMed_29='".$SensoresUniMed_29."'" ;}
				if(isset($SensoresUniMed_30) && $SensoresUniMed_30 != ''){              $a .= ",SensoresUniMed_30='".$SensoresUniMed_30."'" ;}
				if(isset($SensoresUniMed_31) && $SensoresUniMed_31 != ''){              $a .= ",SensoresUniMed_31='".$SensoresUniMed_31."'" ;}
				if(isset($SensoresUniMed_32) && $SensoresUniMed_32 != ''){              $a .= ",SensoresUniMed_32='".$SensoresUniMed_32."'" ;}
				if(isset($SensoresUniMed_33) && $SensoresUniMed_33 != ''){              $a .= ",SensoresUniMed_33='".$SensoresUniMed_33."'" ;}
				if(isset($SensoresUniMed_34) && $SensoresUniMed_34 != ''){              $a .= ",SensoresUniMed_34='".$SensoresUniMed_34."'" ;}
				if(isset($SensoresUniMed_35) && $SensoresUniMed_35 != ''){              $a .= ",SensoresUniMed_35='".$SensoresUniMed_35."'" ;}
				if(isset($SensoresUniMed_36) && $SensoresUniMed_36 != ''){              $a .= ",SensoresUniMed_36='".$SensoresUniMed_36."'" ;}
				if(isset($SensoresUniMed_37) && $SensoresUniMed_37 != ''){              $a .= ",SensoresUniMed_37='".$SensoresUniMed_37."'" ;}
				if(isset($SensoresUniMed_38) && $SensoresUniMed_38 != ''){              $a .= ",SensoresUniMed_38='".$SensoresUniMed_38."'" ;}
				if(isset($SensoresUniMed_39) && $SensoresUniMed_39 != ''){              $a .= ",SensoresUniMed_39='".$SensoresUniMed_39."'" ;}
				if(isset($SensoresUniMed_40) && $SensoresUniMed_40 != ''){              $a .= ",SensoresUniMed_40='".$SensoresUniMed_40."'" ;}
				if(isset($SensoresUniMed_41) && $SensoresUniMed_41 != ''){              $a .= ",SensoresUniMed_41='".$SensoresUniMed_41."'" ;}
				if(isset($SensoresUniMed_42) && $SensoresUniMed_42 != ''){              $a .= ",SensoresUniMed_42='".$SensoresUniMed_42."'" ;}
				if(isset($SensoresUniMed_43) && $SensoresUniMed_43 != ''){              $a .= ",SensoresUniMed_43='".$SensoresUniMed_43."'" ;}
				if(isset($SensoresUniMed_44) && $SensoresUniMed_44 != ''){              $a .= ",SensoresUniMed_44='".$SensoresUniMed_44."'" ;}
				if(isset($SensoresUniMed_45) && $SensoresUniMed_45 != ''){              $a .= ",SensoresUniMed_45='".$SensoresUniMed_45."'" ;}
				if(isset($SensoresUniMed_46) && $SensoresUniMed_46 != ''){              $a .= ",SensoresUniMed_46='".$SensoresUniMed_46."'" ;}
				if(isset($SensoresUniMed_47) && $SensoresUniMed_47 != ''){              $a .= ",SensoresUniMed_47='".$SensoresUniMed_47."'" ;}
				if(isset($SensoresUniMed_48) && $SensoresUniMed_48 != ''){              $a .= ",SensoresUniMed_48='".$SensoresUniMed_48."'" ;}
				if(isset($SensoresUniMed_49) && $SensoresUniMed_49 != ''){              $a .= ",SensoresUniMed_49='".$SensoresUniMed_49."'" ;}
				if(isset($SensoresUniMed_50) && $SensoresUniMed_50 != ''){              $a .= ",SensoresUniMed_50='".$SensoresUniMed_50."'" ;}
				if(isset($SensoresActivo_1) && $SensoresActivo_1 != ''){                $a .= ",SensoresActivo_1='".$SensoresActivo_1."'" ;}
				if(isset($SensoresActivo_2) && $SensoresActivo_2 != ''){                $a .= ",SensoresActivo_2='".$SensoresActivo_2."'" ;}
				if(isset($SensoresActivo_3) && $SensoresActivo_3 != ''){                $a .= ",SensoresActivo_3='".$SensoresActivo_3."'" ;}
				if(isset($SensoresActivo_4) && $SensoresActivo_4 != ''){                $a .= ",SensoresActivo_4='".$SensoresActivo_4."'" ;}
				if(isset($SensoresActivo_5) && $SensoresActivo_5 != ''){                $a .= ",SensoresActivo_5='".$SensoresActivo_5."'" ;}
				if(isset($SensoresActivo_6) && $SensoresActivo_6 != ''){                $a .= ",SensoresActivo_6='".$SensoresActivo_6."'" ;}
				if(isset($SensoresActivo_7) && $SensoresActivo_7 != ''){                $a .= ",SensoresActivo_7='".$SensoresActivo_7."'" ;}
				if(isset($SensoresActivo_8) && $SensoresActivo_8 != ''){                $a .= ",SensoresActivo_8='".$SensoresActivo_8."'" ;}
				if(isset($SensoresActivo_9) && $SensoresActivo_9 != ''){                $a .= ",SensoresActivo_9='".$SensoresActivo_9."'" ;}
				if(isset($SensoresActivo_10) && $SensoresActivo_10 != ''){              $a .= ",SensoresActivo_10='".$SensoresActivo_10."'" ;}
				if(isset($SensoresActivo_11) && $SensoresActivo_11 != ''){              $a .= ",SensoresActivo_11='".$SensoresActivo_11."'" ;}
				if(isset($SensoresActivo_12) && $SensoresActivo_12 != ''){              $a .= ",SensoresActivo_12='".$SensoresActivo_12."'" ;}
				if(isset($SensoresActivo_13) && $SensoresActivo_13 != ''){              $a .= ",SensoresActivo_13='".$SensoresActivo_13."'" ;}
				if(isset($SensoresActivo_14) && $SensoresActivo_14 != ''){              $a .= ",SensoresActivo_14='".$SensoresActivo_14."'" ;}
				if(isset($SensoresActivo_15) && $SensoresActivo_15 != ''){              $a .= ",SensoresActivo_15='".$SensoresActivo_15."'" ;}
				if(isset($SensoresActivo_16) && $SensoresActivo_16 != ''){              $a .= ",SensoresActivo_16='".$SensoresActivo_16."'" ;}
				if(isset($SensoresActivo_17) && $SensoresActivo_17 != ''){              $a .= ",SensoresActivo_17='".$SensoresActivo_17."'" ;}
				if(isset($SensoresActivo_18) && $SensoresActivo_18 != ''){              $a .= ",SensoresActivo_18='".$SensoresActivo_18."'" ;}
				if(isset($SensoresActivo_19) && $SensoresActivo_19 != ''){              $a .= ",SensoresActivo_19='".$SensoresActivo_19."'" ;}
				if(isset($SensoresActivo_20) && $SensoresActivo_20 != ''){              $a .= ",SensoresActivo_20='".$SensoresActivo_20."'" ;}
				if(isset($SensoresActivo_21) && $SensoresActivo_21 != ''){              $a .= ",SensoresActivo_21='".$SensoresActivo_21."'" ;}
				if(isset($SensoresActivo_22) && $SensoresActivo_22 != ''){              $a .= ",SensoresActivo_22='".$SensoresActivo_22."'" ;}
				if(isset($SensoresActivo_23) && $SensoresActivo_23 != ''){              $a .= ",SensoresActivo_23='".$SensoresActivo_23."'" ;}
				if(isset($SensoresActivo_24) && $SensoresActivo_24 != ''){              $a .= ",SensoresActivo_24='".$SensoresActivo_24."'" ;}
				if(isset($SensoresActivo_25) && $SensoresActivo_25 != ''){              $a .= ",SensoresActivo_25='".$SensoresActivo_25."'" ;}
				if(isset($SensoresActivo_26) && $SensoresActivo_26 != ''){              $a .= ",SensoresActivo_26='".$SensoresActivo_26."'" ;}
				if(isset($SensoresActivo_27) && $SensoresActivo_27 != ''){              $a .= ",SensoresActivo_27='".$SensoresActivo_27."'" ;}
				if(isset($SensoresActivo_28) && $SensoresActivo_28 != ''){              $a .= ",SensoresActivo_28='".$SensoresActivo_28."'" ;}
				if(isset($SensoresActivo_29) && $SensoresActivo_29 != ''){              $a .= ",SensoresActivo_29='".$SensoresActivo_29."'" ;}
				if(isset($SensoresActivo_30) && $SensoresActivo_30 != ''){              $a .= ",SensoresActivo_30='".$SensoresActivo_30."'" ;}
				if(isset($SensoresActivo_31) && $SensoresActivo_31 != ''){              $a .= ",SensoresActivo_31='".$SensoresActivo_31."'" ;}
				if(isset($SensoresActivo_32) && $SensoresActivo_32 != ''){              $a .= ",SensoresActivo_32='".$SensoresActivo_32."'" ;}
				if(isset($SensoresActivo_33) && $SensoresActivo_33 != ''){              $a .= ",SensoresActivo_33='".$SensoresActivo_33."'" ;}
				if(isset($SensoresActivo_34) && $SensoresActivo_34 != ''){              $a .= ",SensoresActivo_34='".$SensoresActivo_34."'" ;}
				if(isset($SensoresActivo_35) && $SensoresActivo_35 != ''){              $a .= ",SensoresActivo_35='".$SensoresActivo_35."'" ;}
				if(isset($SensoresActivo_36) && $SensoresActivo_36 != ''){              $a .= ",SensoresActivo_36='".$SensoresActivo_36."'" ;}
				if(isset($SensoresActivo_37) && $SensoresActivo_37 != ''){              $a .= ",SensoresActivo_37='".$SensoresActivo_37."'" ;}
				if(isset($SensoresActivo_38) && $SensoresActivo_38 != ''){              $a .= ",SensoresActivo_38='".$SensoresActivo_38."'" ;}
				if(isset($SensoresActivo_39) && $SensoresActivo_39 != ''){              $a .= ",SensoresActivo_39='".$SensoresActivo_39."'" ;}
				if(isset($SensoresActivo_40) && $SensoresActivo_40 != ''){              $a .= ",SensoresActivo_40='".$SensoresActivo_40."'" ;}
				if(isset($SensoresActivo_41) && $SensoresActivo_41 != ''){              $a .= ",SensoresActivo_41='".$SensoresActivo_41."'" ;}
				if(isset($SensoresActivo_42) && $SensoresActivo_42 != ''){              $a .= ",SensoresActivo_42='".$SensoresActivo_42."'" ;}
				if(isset($SensoresActivo_43) && $SensoresActivo_43 != ''){              $a .= ",SensoresActivo_43='".$SensoresActivo_43."'" ;}
				if(isset($SensoresActivo_44) && $SensoresActivo_44 != ''){              $a .= ",SensoresActivo_44='".$SensoresActivo_44."'" ;}
				if(isset($SensoresActivo_45) && $SensoresActivo_45 != ''){              $a .= ",SensoresActivo_45='".$SensoresActivo_45."'" ;}
				if(isset($SensoresActivo_46) && $SensoresActivo_46 != ''){              $a .= ",SensoresActivo_46='".$SensoresActivo_46."'" ;}
				if(isset($SensoresActivo_47) && $SensoresActivo_47 != ''){              $a .= ",SensoresActivo_47='".$SensoresActivo_47."'" ;}
				if(isset($SensoresActivo_48) && $SensoresActivo_48 != ''){              $a .= ",SensoresActivo_48='".$SensoresActivo_48."'" ;}
				if(isset($SensoresActivo_49) && $SensoresActivo_49 != ''){              $a .= ",SensoresActivo_49='".$SensoresActivo_49."'" ;}
				if(isset($SensoresActivo_50) && $SensoresActivo_50 != ''){              $a .= ",SensoresActivo_50='".$SensoresActivo_50."'" ;}
				if(isset($SensoresUso_1) && $SensoresUso_1 != ''){                $a .= ",SensoresUso_1='".$SensoresUso_1."'" ;}
				if(isset($SensoresUso_2) && $SensoresUso_2 != ''){                $a .= ",SensoresUso_2='".$SensoresUso_2."'" ;}
				if(isset($SensoresUso_3) && $SensoresUso_3 != ''){                $a .= ",SensoresUso_3='".$SensoresUso_3."'" ;}
				if(isset($SensoresUso_4) && $SensoresUso_4 != ''){                $a .= ",SensoresUso_4='".$SensoresUso_4."'" ;}
				if(isset($SensoresUso_5) && $SensoresUso_5 != ''){                $a .= ",SensoresUso_5='".$SensoresUso_5."'" ;}
				if(isset($SensoresUso_6) && $SensoresUso_6 != ''){                $a .= ",SensoresUso_6='".$SensoresUso_6."'" ;}
				if(isset($SensoresUso_7) && $SensoresUso_7 != ''){                $a .= ",SensoresUso_7='".$SensoresUso_7."'" ;}
				if(isset($SensoresUso_8) && $SensoresUso_8 != ''){                $a .= ",SensoresUso_8='".$SensoresUso_8."'" ;}
				if(isset($SensoresUso_9) && $SensoresUso_9 != ''){                $a .= ",SensoresUso_9='".$SensoresUso_9."'" ;}
				if(isset($SensoresUso_10) && $SensoresUso_10 != ''){              $a .= ",SensoresUso_10='".$SensoresUso_10."'" ;}
				if(isset($SensoresUso_11) && $SensoresUso_11 != ''){              $a .= ",SensoresUso_11='".$SensoresUso_11."'" ;}
				if(isset($SensoresUso_12) && $SensoresUso_12 != ''){              $a .= ",SensoresUso_12='".$SensoresUso_12."'" ;}
				if(isset($SensoresUso_13) && $SensoresUso_13 != ''){              $a .= ",SensoresUso_13='".$SensoresUso_13."'" ;}
				if(isset($SensoresUso_14) && $SensoresUso_14 != ''){              $a .= ",SensoresUso_14='".$SensoresUso_14."'" ;}
				if(isset($SensoresUso_15) && $SensoresUso_15 != ''){              $a .= ",SensoresUso_15='".$SensoresUso_15."'" ;}
				if(isset($SensoresUso_16) && $SensoresUso_16 != ''){              $a .= ",SensoresUso_16='".$SensoresUso_16."'" ;}
				if(isset($SensoresUso_17) && $SensoresUso_17 != ''){              $a .= ",SensoresUso_17='".$SensoresUso_17."'" ;}
				if(isset($SensoresUso_18) && $SensoresUso_18 != ''){              $a .= ",SensoresUso_18='".$SensoresUso_18."'" ;}
				if(isset($SensoresUso_19) && $SensoresUso_19 != ''){              $a .= ",SensoresUso_19='".$SensoresUso_19."'" ;}
				if(isset($SensoresUso_20) && $SensoresUso_20 != ''){              $a .= ",SensoresUso_20='".$SensoresUso_20."'" ;}
				if(isset($SensoresUso_21) && $SensoresUso_21 != ''){              $a .= ",SensoresUso_21='".$SensoresUso_21."'" ;}
				if(isset($SensoresUso_22) && $SensoresUso_22 != ''){              $a .= ",SensoresUso_22='".$SensoresUso_22."'" ;}
				if(isset($SensoresUso_23) && $SensoresUso_23 != ''){              $a .= ",SensoresUso_23='".$SensoresUso_23."'" ;}
				if(isset($SensoresUso_24) && $SensoresUso_24 != ''){              $a .= ",SensoresUso_24='".$SensoresUso_24."'" ;}
				if(isset($SensoresUso_25) && $SensoresUso_25 != ''){              $a .= ",SensoresUso_25='".$SensoresUso_25."'" ;}
				if(isset($SensoresUso_26) && $SensoresUso_26 != ''){              $a .= ",SensoresUso_26='".$SensoresUso_26."'" ;}
				if(isset($SensoresUso_27) && $SensoresUso_27 != ''){              $a .= ",SensoresUso_27='".$SensoresUso_27."'" ;}
				if(isset($SensoresUso_28) && $SensoresUso_28 != ''){              $a .= ",SensoresUso_28='".$SensoresUso_28."'" ;}
				if(isset($SensoresUso_29) && $SensoresUso_29 != ''){              $a .= ",SensoresUso_29='".$SensoresUso_29."'" ;}
				if(isset($SensoresUso_30) && $SensoresUso_30 != ''){              $a .= ",SensoresUso_30='".$SensoresUso_30."'" ;}
				if(isset($SensoresUso_31) && $SensoresUso_31 != ''){              $a .= ",SensoresUso_31='".$SensoresUso_31."'" ;}
				if(isset($SensoresUso_32) && $SensoresUso_32 != ''){              $a .= ",SensoresUso_32='".$SensoresUso_32."'" ;}
				if(isset($SensoresUso_33) && $SensoresUso_33 != ''){              $a .= ",SensoresUso_33='".$SensoresUso_33."'" ;}
				if(isset($SensoresUso_34) && $SensoresUso_34 != ''){              $a .= ",SensoresUso_34='".$SensoresUso_34."'" ;}
				if(isset($SensoresUso_35) && $SensoresUso_35 != ''){              $a .= ",SensoresUso_35='".$SensoresUso_35."'" ;}
				if(isset($SensoresUso_36) && $SensoresUso_36 != ''){              $a .= ",SensoresUso_36='".$SensoresUso_36."'" ;}
				if(isset($SensoresUso_37) && $SensoresUso_37 != ''){              $a .= ",SensoresUso_37='".$SensoresUso_37."'" ;}
				if(isset($SensoresUso_38) && $SensoresUso_38 != ''){              $a .= ",SensoresUso_38='".$SensoresUso_38."'" ;}
				if(isset($SensoresUso_39) && $SensoresUso_39 != ''){              $a .= ",SensoresUso_39='".$SensoresUso_39."'" ;}
				if(isset($SensoresUso_40) && $SensoresUso_40 != ''){              $a .= ",SensoresUso_40='".$SensoresUso_40."'" ;}
				if(isset($SensoresUso_41) && $SensoresUso_41 != ''){              $a .= ",SensoresUso_41='".$SensoresUso_41."'" ;}
				if(isset($SensoresUso_42) && $SensoresUso_42 != ''){              $a .= ",SensoresUso_42='".$SensoresUso_42."'" ;}
				if(isset($SensoresUso_43) && $SensoresUso_43 != ''){              $a .= ",SensoresUso_43='".$SensoresUso_43."'" ;}
				if(isset($SensoresUso_44) && $SensoresUso_44 != ''){              $a .= ",SensoresUso_44='".$SensoresUso_44."'" ;}
				if(isset($SensoresUso_45) && $SensoresUso_45 != ''){              $a .= ",SensoresUso_45='".$SensoresUso_45."'" ;}
				if(isset($SensoresUso_46) && $SensoresUso_46 != ''){              $a .= ",SensoresUso_46='".$SensoresUso_46."'" ;}
				if(isset($SensoresUso_47) && $SensoresUso_47 != ''){              $a .= ",SensoresUso_47='".$SensoresUso_47."'" ;}
				if(isset($SensoresUso_48) && $SensoresUso_48 != ''){              $a .= ",SensoresUso_48='".$SensoresUso_48."'" ;}
				if(isset($SensoresUso_49) && $SensoresUso_49 != ''){              $a .= ",SensoresUso_49='".$SensoresUso_49."'" ;}
				if(isset($SensoresUso_50) && $SensoresUso_50 != ''){              $a .= ",SensoresUso_50='".$SensoresUso_50."'" ;}
				
				if(isset($SensoresFechaUso_1) && $SensoresFechaUso_1 != ''&&$SensoresFechaUso_1!=$SensoresFechaUso_Fake){                 $a .= ",SensoresFechaUso_1='".$SensoresFechaUso_1."'" ;$a .= ",SensoresAccionMedC_1=''" ;$a .= ",SensoresAccionMedT_1=''" ;}
				if(isset($SensoresFechaUso_2) && $SensoresFechaUso_2 != ''&&$SensoresFechaUso_2!=$SensoresFechaUso_Fake){                 $a .= ",SensoresFechaUso_2='".$SensoresFechaUso_2."'" ;$a .= ",SensoresAccionMedC_2=''" ;$a .= ",SensoresAccionMedT_2=''" ;}
				if(isset($SensoresFechaUso_3) && $SensoresFechaUso_3 != ''&&$SensoresFechaUso_3!=$SensoresFechaUso_Fake){                 $a .= ",SensoresFechaUso_3='".$SensoresFechaUso_3."'" ;$a .= ",SensoresAccionMedC_3=''" ;$a .= ",SensoresAccionMedT_3=''" ;}
				if(isset($SensoresFechaUso_4) && $SensoresFechaUso_4 != ''&&$SensoresFechaUso_4!=$SensoresFechaUso_Fake){                 $a .= ",SensoresFechaUso_4='".$SensoresFechaUso_4."'" ;$a .= ",SensoresAccionMedC_4=''" ;$a .= ",SensoresAccionMedT_4=''" ;}
				if(isset($SensoresFechaUso_5) && $SensoresFechaUso_5 != ''&&$SensoresFechaUso_5!=$SensoresFechaUso_Fake){                 $a .= ",SensoresFechaUso_5='".$SensoresFechaUso_5."'" ;$a .= ",SensoresAccionMedC_5=''" ;$a .= ",SensoresAccionMedT_5=''" ;}
				if(isset($SensoresFechaUso_6) && $SensoresFechaUso_6 != ''&&$SensoresFechaUso_6!=$SensoresFechaUso_Fake){                 $a .= ",SensoresFechaUso_6='".$SensoresFechaUso_6."'" ;$a .= ",SensoresAccionMedC_6=''" ;$a .= ",SensoresAccionMedT_6=''" ;}
				if(isset($SensoresFechaUso_7) && $SensoresFechaUso_7 != ''&&$SensoresFechaUso_7!=$SensoresFechaUso_Fake){                 $a .= ",SensoresFechaUso_7='".$SensoresFechaUso_7."'" ;$a .= ",SensoresAccionMedC_7=''" ;$a .= ",SensoresAccionMedT_7=''" ;}
				if(isset($SensoresFechaUso_8) && $SensoresFechaUso_8 != ''&&$SensoresFechaUso_8!=$SensoresFechaUso_Fake){                 $a .= ",SensoresFechaUso_8='".$SensoresFechaUso_8."'" ;$a .= ",SensoresAccionMedC_8=''" ;$a .= ",SensoresAccionMedT_8=''" ;}
				if(isset($SensoresFechaUso_9) && $SensoresFechaUso_9 != ''&&$SensoresFechaUso_9!=$SensoresFechaUso_Fake){                 $a .= ",SensoresFechaUso_9='".$SensoresFechaUso_9."'" ;$a .= ",SensoresAccionMedC_9=''" ;$a .= ",SensoresAccionMedT_9=''" ;}
				if(isset($SensoresFechaUso_10) && $SensoresFechaUso_10 != ''&&$SensoresFechaUso_10!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_10='".$SensoresFechaUso_10."'" ;$a .= ",SensoresAccionMedC_10=''" ;$a .= ",SensoresAccionMedT_10=''" ;}
				if(isset($SensoresFechaUso_11) && $SensoresFechaUso_11 != ''&&$SensoresFechaUso_11!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_11='".$SensoresFechaUso_11."'" ;$a .= ",SensoresAccionMedC_11=''" ;$a .= ",SensoresAccionMedT_11=''" ;}
				if(isset($SensoresFechaUso_12) && $SensoresFechaUso_12 != ''&&$SensoresFechaUso_12!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_12='".$SensoresFechaUso_12."'" ;$a .= ",SensoresAccionMedC_12=''" ;$a .= ",SensoresAccionMedT_12=''" ;}
				if(isset($SensoresFechaUso_13) && $SensoresFechaUso_13 != ''&&$SensoresFechaUso_13!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_13='".$SensoresFechaUso_13."'" ;$a .= ",SensoresAccionMedC_13=''" ;$a .= ",SensoresAccionMedT_13=''" ;}
				if(isset($SensoresFechaUso_14) && $SensoresFechaUso_14 != ''&&$SensoresFechaUso_14!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_14='".$SensoresFechaUso_14."'" ;$a .= ",SensoresAccionMedC_14=''" ;$a .= ",SensoresAccionMedT_14=''" ;}
				if(isset($SensoresFechaUso_15) && $SensoresFechaUso_15 != ''&&$SensoresFechaUso_15!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_15='".$SensoresFechaUso_15."'" ;$a .= ",SensoresAccionMedC_15=''" ;$a .= ",SensoresAccionMedT_15=''" ;}
				if(isset($SensoresFechaUso_16) && $SensoresFechaUso_16 != ''&&$SensoresFechaUso_16!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_16='".$SensoresFechaUso_16."'" ;$a .= ",SensoresAccionMedC_16=''" ;$a .= ",SensoresAccionMedT_16=''" ;}
				if(isset($SensoresFechaUso_17) && $SensoresFechaUso_17 != ''&&$SensoresFechaUso_17!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_17='".$SensoresFechaUso_17."'" ;$a .= ",SensoresAccionMedC_17=''" ;$a .= ",SensoresAccionMedT_17=''" ;}
				if(isset($SensoresFechaUso_18) && $SensoresFechaUso_18 != ''&&$SensoresFechaUso_18!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_18='".$SensoresFechaUso_18."'" ;$a .= ",SensoresAccionMedC_18=''" ;$a .= ",SensoresAccionMedT_18=''" ;}
				if(isset($SensoresFechaUso_19) && $SensoresFechaUso_19 != ''&&$SensoresFechaUso_19!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_19='".$SensoresFechaUso_19."'" ;$a .= ",SensoresAccionMedC_19=''" ;$a .= ",SensoresAccionMedT_19=''" ;}
				if(isset($SensoresFechaUso_20) && $SensoresFechaUso_20 != ''&&$SensoresFechaUso_20!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_20='".$SensoresFechaUso_20."'" ;$a .= ",SensoresAccionMedC_20=''" ;$a .= ",SensoresAccionMedT_20=''" ;}
				if(isset($SensoresFechaUso_21) && $SensoresFechaUso_21 != ''&&$SensoresFechaUso_21!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_21='".$SensoresFechaUso_21."'" ;$a .= ",SensoresAccionMedC_21=''" ;$a .= ",SensoresAccionMedT_21=''" ;}
				if(isset($SensoresFechaUso_22) && $SensoresFechaUso_22 != ''&&$SensoresFechaUso_22!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_22='".$SensoresFechaUso_22."'" ;$a .= ",SensoresAccionMedC_22=''" ;$a .= ",SensoresAccionMedT_22=''" ;}
				if(isset($SensoresFechaUso_23) && $SensoresFechaUso_23 != ''&&$SensoresFechaUso_23!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_23='".$SensoresFechaUso_23."'" ;$a .= ",SensoresAccionMedC_23=''" ;$a .= ",SensoresAccionMedT_23=''" ;}
				if(isset($SensoresFechaUso_24) && $SensoresFechaUso_24 != ''&&$SensoresFechaUso_24!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_24='".$SensoresFechaUso_24."'" ;$a .= ",SensoresAccionMedC_24=''" ;$a .= ",SensoresAccionMedT_24=''" ;}
				if(isset($SensoresFechaUso_25) && $SensoresFechaUso_25 != ''&&$SensoresFechaUso_25!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_25='".$SensoresFechaUso_25."'" ;$a .= ",SensoresAccionMedC_25=''" ;$a .= ",SensoresAccionMedT_25=''" ;}
				if(isset($SensoresFechaUso_26) && $SensoresFechaUso_26 != ''&&$SensoresFechaUso_26!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_26='".$SensoresFechaUso_26."'" ;$a .= ",SensoresAccionMedC_26=''" ;$a .= ",SensoresAccionMedT_26=''" ;}
				if(isset($SensoresFechaUso_27) && $SensoresFechaUso_27 != ''&&$SensoresFechaUso_27!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_27='".$SensoresFechaUso_27."'" ;$a .= ",SensoresAccionMedC_27=''" ;$a .= ",SensoresAccionMedT_27=''" ;}
				if(isset($SensoresFechaUso_28) && $SensoresFechaUso_28 != ''&&$SensoresFechaUso_28!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_28='".$SensoresFechaUso_28."'" ;$a .= ",SensoresAccionMedC_28=''" ;$a .= ",SensoresAccionMedT_28=''" ;}
				if(isset($SensoresFechaUso_29) && $SensoresFechaUso_29 != ''&&$SensoresFechaUso_29!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_29='".$SensoresFechaUso_29."'" ;$a .= ",SensoresAccionMedC_29=''" ;$a .= ",SensoresAccionMedT_29=''" ;}
				if(isset($SensoresFechaUso_30) && $SensoresFechaUso_30 != ''&&$SensoresFechaUso_30!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_30='".$SensoresFechaUso_30."'" ;$a .= ",SensoresAccionMedC_30=''" ;$a .= ",SensoresAccionMedT_30=''" ;}
				if(isset($SensoresFechaUso_31) && $SensoresFechaUso_31 != ''&&$SensoresFechaUso_31!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_31='".$SensoresFechaUso_31."'" ;$a .= ",SensoresAccionMedC_31=''" ;$a .= ",SensoresAccionMedT_31=''" ;}
				if(isset($SensoresFechaUso_32) && $SensoresFechaUso_32 != ''&&$SensoresFechaUso_32!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_32='".$SensoresFechaUso_32."'" ;$a .= ",SensoresAccionMedC_32=''" ;$a .= ",SensoresAccionMedT_32=''" ;}
				if(isset($SensoresFechaUso_33) && $SensoresFechaUso_33 != ''&&$SensoresFechaUso_33!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_33='".$SensoresFechaUso_33."'" ;$a .= ",SensoresAccionMedC_33=''" ;$a .= ",SensoresAccionMedT_33=''" ;}
				if(isset($SensoresFechaUso_34) && $SensoresFechaUso_34 != ''&&$SensoresFechaUso_34!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_34='".$SensoresFechaUso_34."'" ;$a .= ",SensoresAccionMedC_34=''" ;$a .= ",SensoresAccionMedT_34=''" ;}
				if(isset($SensoresFechaUso_35) && $SensoresFechaUso_35 != ''&&$SensoresFechaUso_35!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_35='".$SensoresFechaUso_35."'" ;$a .= ",SensoresAccionMedC_35=''" ;$a .= ",SensoresAccionMedT_35=''" ;}
				if(isset($SensoresFechaUso_36) && $SensoresFechaUso_36 != ''&&$SensoresFechaUso_36!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_36='".$SensoresFechaUso_36."'" ;$a .= ",SensoresAccionMedC_36=''" ;$a .= ",SensoresAccionMedT_36=''" ;}
				if(isset($SensoresFechaUso_37) && $SensoresFechaUso_37 != ''&&$SensoresFechaUso_37!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_37='".$SensoresFechaUso_37."'" ;$a .= ",SensoresAccionMedC_37=''" ;$a .= ",SensoresAccionMedT_37=''" ;}
				if(isset($SensoresFechaUso_38) && $SensoresFechaUso_38 != ''&&$SensoresFechaUso_38!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_38='".$SensoresFechaUso_38."'" ;$a .= ",SensoresAccionMedC_38=''" ;$a .= ",SensoresAccionMedT_38=''" ;}
				if(isset($SensoresFechaUso_39) && $SensoresFechaUso_39 != ''&&$SensoresFechaUso_39!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_39='".$SensoresFechaUso_39."'" ;$a .= ",SensoresAccionMedC_39=''" ;$a .= ",SensoresAccionMedT_39=''" ;}
				if(isset($SensoresFechaUso_40) && $SensoresFechaUso_40 != ''&&$SensoresFechaUso_40!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_40='".$SensoresFechaUso_40."'" ;$a .= ",SensoresAccionMedC_40=''" ;$a .= ",SensoresAccionMedT_40=''" ;}
				if(isset($SensoresFechaUso_41) && $SensoresFechaUso_41 != ''&&$SensoresFechaUso_41!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_41='".$SensoresFechaUso_41."'" ;$a .= ",SensoresAccionMedC_41=''" ;$a .= ",SensoresAccionMedT_41=''" ;}
				if(isset($SensoresFechaUso_42) && $SensoresFechaUso_42 != ''&&$SensoresFechaUso_42!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_42='".$SensoresFechaUso_42."'" ;$a .= ",SensoresAccionMedC_42=''" ;$a .= ",SensoresAccionMedT_42=''" ;}
				if(isset($SensoresFechaUso_43) && $SensoresFechaUso_43 != ''&&$SensoresFechaUso_43!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_43='".$SensoresFechaUso_43."'" ;$a .= ",SensoresAccionMedC_43=''" ;$a .= ",SensoresAccionMedT_43=''" ;}
				if(isset($SensoresFechaUso_44) && $SensoresFechaUso_44 != ''&&$SensoresFechaUso_44!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_44='".$SensoresFechaUso_44."'" ;$a .= ",SensoresAccionMedC_44=''" ;$a .= ",SensoresAccionMedT_44=''" ;}
				if(isset($SensoresFechaUso_45) && $SensoresFechaUso_45 != ''&&$SensoresFechaUso_45!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_45='".$SensoresFechaUso_45."'" ;$a .= ",SensoresAccionMedC_45=''" ;$a .= ",SensoresAccionMedT_45=''" ;}
				if(isset($SensoresFechaUso_46) && $SensoresFechaUso_46 != ''&&$SensoresFechaUso_46!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_46='".$SensoresFechaUso_46."'" ;$a .= ",SensoresAccionMedC_46=''" ;$a .= ",SensoresAccionMedT_46=''" ;}
				if(isset($SensoresFechaUso_47) && $SensoresFechaUso_47 != ''&&$SensoresFechaUso_47!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_47='".$SensoresFechaUso_47."'" ;$a .= ",SensoresAccionMedC_47=''" ;$a .= ",SensoresAccionMedT_47=''" ;}
				if(isset($SensoresFechaUso_48) && $SensoresFechaUso_48 != ''&&$SensoresFechaUso_48!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_48='".$SensoresFechaUso_48."'" ;$a .= ",SensoresAccionMedC_48=''" ;$a .= ",SensoresAccionMedT_48=''" ;}
				if(isset($SensoresFechaUso_49) && $SensoresFechaUso_49 != ''&&$SensoresFechaUso_49!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_49='".$SensoresFechaUso_49."'" ;$a .= ",SensoresAccionMedC_49=''" ;$a .= ",SensoresAccionMedT_49=''" ;}
				if(isset($SensoresFechaUso_50) && $SensoresFechaUso_50 != ''&&$SensoresFechaUso_50!=$SensoresFechaUso_Fake){              $a .= ",SensoresFechaUso_50='".$SensoresFechaUso_50."'" ;$a .= ",SensoresAccionMedC_50=''" ;$a .= ",SensoresAccionMedT_50=''" ;}
				
				if(isset($SensoresAccionC_1) && $SensoresAccionC_1 != ''){                $a .= ",SensoresAccionC_1='".$SensoresAccionC_1."'" ;}
				if(isset($SensoresAccionC_2) && $SensoresAccionC_2 != ''){                $a .= ",SensoresAccionC_2='".$SensoresAccionC_2."'" ;}
				if(isset($SensoresAccionC_3) && $SensoresAccionC_3 != ''){                $a .= ",SensoresAccionC_3='".$SensoresAccionC_3."'" ;}
				if(isset($SensoresAccionC_4) && $SensoresAccionC_4 != ''){                $a .= ",SensoresAccionC_4='".$SensoresAccionC_4."'" ;}
				if(isset($SensoresAccionC_5) && $SensoresAccionC_5 != ''){                $a .= ",SensoresAccionC_5='".$SensoresAccionC_5."'" ;}
				if(isset($SensoresAccionC_6) && $SensoresAccionC_6 != ''){                $a .= ",SensoresAccionC_6='".$SensoresAccionC_6."'" ;}
				if(isset($SensoresAccionC_7) && $SensoresAccionC_7 != ''){                $a .= ",SensoresAccionC_7='".$SensoresAccionC_7."'" ;}
				if(isset($SensoresAccionC_8) && $SensoresAccionC_8 != ''){                $a .= ",SensoresAccionC_8='".$SensoresAccionC_8."'" ;}
				if(isset($SensoresAccionC_9) && $SensoresAccionC_9 != ''){                $a .= ",SensoresAccionC_9='".$SensoresAccionC_9."'" ;}
				if(isset($SensoresAccionC_10) && $SensoresAccionC_10 != ''){              $a .= ",SensoresAccionC_10='".$SensoresAccionC_10."'" ;}
				if(isset($SensoresAccionC_11) && $SensoresAccionC_11 != ''){              $a .= ",SensoresAccionC_11='".$SensoresAccionC_11."'" ;}
				if(isset($SensoresAccionC_12) && $SensoresAccionC_12 != ''){              $a .= ",SensoresAccionC_12='".$SensoresAccionC_12."'" ;}
				if(isset($SensoresAccionC_13) && $SensoresAccionC_13 != ''){              $a .= ",SensoresAccionC_13='".$SensoresAccionC_13."'" ;}
				if(isset($SensoresAccionC_14) && $SensoresAccionC_14 != ''){              $a .= ",SensoresAccionC_14='".$SensoresAccionC_14."'" ;}
				if(isset($SensoresAccionC_15) && $SensoresAccionC_15 != ''){              $a .= ",SensoresAccionC_15='".$SensoresAccionC_15."'" ;}
				if(isset($SensoresAccionC_16) && $SensoresAccionC_16 != ''){              $a .= ",SensoresAccionC_16='".$SensoresAccionC_16."'" ;}
				if(isset($SensoresAccionC_17) && $SensoresAccionC_17 != ''){              $a .= ",SensoresAccionC_17='".$SensoresAccionC_17."'" ;}
				if(isset($SensoresAccionC_18) && $SensoresAccionC_18 != ''){              $a .= ",SensoresAccionC_18='".$SensoresAccionC_18."'" ;}
				if(isset($SensoresAccionC_19) && $SensoresAccionC_19 != ''){              $a .= ",SensoresAccionC_19='".$SensoresAccionC_19."'" ;}
				if(isset($SensoresAccionC_20) && $SensoresAccionC_20 != ''){              $a .= ",SensoresAccionC_20='".$SensoresAccionC_20."'" ;}
				if(isset($SensoresAccionC_21) && $SensoresAccionC_21 != ''){              $a .= ",SensoresAccionC_21='".$SensoresAccionC_21."'" ;}
				if(isset($SensoresAccionC_22) && $SensoresAccionC_22 != ''){              $a .= ",SensoresAccionC_22='".$SensoresAccionC_22."'" ;}
				if(isset($SensoresAccionC_23) && $SensoresAccionC_23 != ''){              $a .= ",SensoresAccionC_23='".$SensoresAccionC_23."'" ;}
				if(isset($SensoresAccionC_24) && $SensoresAccionC_24 != ''){              $a .= ",SensoresAccionC_24='".$SensoresAccionC_24."'" ;}
				if(isset($SensoresAccionC_25) && $SensoresAccionC_25 != ''){              $a .= ",SensoresAccionC_25='".$SensoresAccionC_25."'" ;}
				if(isset($SensoresAccionC_26) && $SensoresAccionC_26 != ''){              $a .= ",SensoresAccionC_26='".$SensoresAccionC_26."'" ;}
				if(isset($SensoresAccionC_27) && $SensoresAccionC_27 != ''){              $a .= ",SensoresAccionC_27='".$SensoresAccionC_27."'" ;}
				if(isset($SensoresAccionC_28) && $SensoresAccionC_28 != ''){              $a .= ",SensoresAccionC_28='".$SensoresAccionC_28."'" ;}
				if(isset($SensoresAccionC_29) && $SensoresAccionC_29 != ''){              $a .= ",SensoresAccionC_29='".$SensoresAccionC_29."'" ;}
				if(isset($SensoresAccionC_30) && $SensoresAccionC_30 != ''){              $a .= ",SensoresAccionC_30='".$SensoresAccionC_30."'" ;}
				if(isset($SensoresAccionC_31) && $SensoresAccionC_31 != ''){              $a .= ",SensoresAccionC_31='".$SensoresAccionC_31."'" ;}
				if(isset($SensoresAccionC_32) && $SensoresAccionC_32 != ''){              $a .= ",SensoresAccionC_32='".$SensoresAccionC_32."'" ;}
				if(isset($SensoresAccionC_33) && $SensoresAccionC_33 != ''){              $a .= ",SensoresAccionC_33='".$SensoresAccionC_33."'" ;}
				if(isset($SensoresAccionC_34) && $SensoresAccionC_34 != ''){              $a .= ",SensoresAccionC_34='".$SensoresAccionC_34."'" ;}
				if(isset($SensoresAccionC_35) && $SensoresAccionC_35 != ''){              $a .= ",SensoresAccionC_35='".$SensoresAccionC_35."'" ;}
				if(isset($SensoresAccionC_36) && $SensoresAccionC_36 != ''){              $a .= ",SensoresAccionC_36='".$SensoresAccionC_36."'" ;}
				if(isset($SensoresAccionC_37) && $SensoresAccionC_37 != ''){              $a .= ",SensoresAccionC_37='".$SensoresAccionC_37."'" ;}
				if(isset($SensoresAccionC_38) && $SensoresAccionC_38 != ''){              $a .= ",SensoresAccionC_38='".$SensoresAccionC_38."'" ;}
				if(isset($SensoresAccionC_39) && $SensoresAccionC_39 != ''){              $a .= ",SensoresAccionC_39='".$SensoresAccionC_39."'" ;}
				if(isset($SensoresAccionC_40) && $SensoresAccionC_40 != ''){              $a .= ",SensoresAccionC_40='".$SensoresAccionC_40."'" ;}
				if(isset($SensoresAccionC_41) && $SensoresAccionC_41 != ''){              $a .= ",SensoresAccionC_41='".$SensoresAccionC_41."'" ;}
				if(isset($SensoresAccionC_42) && $SensoresAccionC_42 != ''){              $a .= ",SensoresAccionC_42='".$SensoresAccionC_42."'" ;}
				if(isset($SensoresAccionC_43) && $SensoresAccionC_43 != ''){              $a .= ",SensoresAccionC_43='".$SensoresAccionC_43."'" ;}
				if(isset($SensoresAccionC_44) && $SensoresAccionC_44 != ''){              $a .= ",SensoresAccionC_44='".$SensoresAccionC_44."'" ;}
				if(isset($SensoresAccionC_45) && $SensoresAccionC_45 != ''){              $a .= ",SensoresAccionC_45='".$SensoresAccionC_45."'" ;}
				if(isset($SensoresAccionC_46) && $SensoresAccionC_46 != ''){              $a .= ",SensoresAccionC_46='".$SensoresAccionC_46."'" ;}
				if(isset($SensoresAccionC_47) && $SensoresAccionC_47 != ''){              $a .= ",SensoresAccionC_47='".$SensoresAccionC_47."'" ;}
				if(isset($SensoresAccionC_48) && $SensoresAccionC_48 != ''){              $a .= ",SensoresAccionC_48='".$SensoresAccionC_48."'" ;}
				if(isset($SensoresAccionC_49) && $SensoresAccionC_49 != ''){              $a .= ",SensoresAccionC_49='".$SensoresAccionC_49."'" ;}
				if(isset($SensoresAccionC_50) && $SensoresAccionC_50 != ''){              $a .= ",SensoresAccionC_50='".$SensoresAccionC_50."'" ;}
				if(isset($SensoresAccionT_1) && $SensoresAccionT_1 != ''){                $a .= ",SensoresAccionT_1='".($SensoresAccionT_1*3600)."'" ;}
				if(isset($SensoresAccionT_2) && $SensoresAccionT_2 != ''){                $a .= ",SensoresAccionT_2='".($SensoresAccionT_2*3600)."'" ;}
				if(isset($SensoresAccionT_3) && $SensoresAccionT_3 != ''){                $a .= ",SensoresAccionT_3='".($SensoresAccionT_3*3600)."'" ;}
				if(isset($SensoresAccionT_4) && $SensoresAccionT_4 != ''){                $a .= ",SensoresAccionT_4='".($SensoresAccionT_4*3600)."'" ;}
				if(isset($SensoresAccionT_5) && $SensoresAccionT_5 != ''){                $a .= ",SensoresAccionT_5='".($SensoresAccionT_5*3600)."'" ;}
				if(isset($SensoresAccionT_6) && $SensoresAccionT_6 != ''){                $a .= ",SensoresAccionT_6='".($SensoresAccionT_6*3600)."'" ;}
				if(isset($SensoresAccionT_7) && $SensoresAccionT_7 != ''){                $a .= ",SensoresAccionT_7='".($SensoresAccionT_7*3600)."'" ;}
				if(isset($SensoresAccionT_8) && $SensoresAccionT_8 != ''){                $a .= ",SensoresAccionT_8='".($SensoresAccionT_8*3600)."'" ;}
				if(isset($SensoresAccionT_9) && $SensoresAccionT_9 != ''){                $a .= ",SensoresAccionT_9='".($SensoresAccionT_9*3600)."'" ;}
				if(isset($SensoresAccionT_10) && $SensoresAccionT_10 != ''){              $a .= ",SensoresAccionT_10='".($SensoresAccionT_10*3600)."'" ;}
				if(isset($SensoresAccionT_11) && $SensoresAccionT_11 != ''){              $a .= ",SensoresAccionT_11='".($SensoresAccionT_11*3600)."'" ;}
				if(isset($SensoresAccionT_12) && $SensoresAccionT_12 != ''){              $a .= ",SensoresAccionT_12='".($SensoresAccionT_12*3600)."'" ;}
				if(isset($SensoresAccionT_13) && $SensoresAccionT_13 != ''){              $a .= ",SensoresAccionT_13='".($SensoresAccionT_13*3600)."'" ;}
				if(isset($SensoresAccionT_14) && $SensoresAccionT_14 != ''){              $a .= ",SensoresAccionT_14='".($SensoresAccionT_14*3600)."'" ;}
				if(isset($SensoresAccionT_15) && $SensoresAccionT_15 != ''){              $a .= ",SensoresAccionT_15='".($SensoresAccionT_15*3600)."'" ;}
				if(isset($SensoresAccionT_16) && $SensoresAccionT_16 != ''){              $a .= ",SensoresAccionT_16='".($SensoresAccionT_16*3600)."'" ;}
				if(isset($SensoresAccionT_17) && $SensoresAccionT_17 != ''){              $a .= ",SensoresAccionT_17='".($SensoresAccionT_17*3600)."'" ;}
				if(isset($SensoresAccionT_18) && $SensoresAccionT_18 != ''){              $a .= ",SensoresAccionT_18='".($SensoresAccionT_18*3600)."'" ;}
				if(isset($SensoresAccionT_19) && $SensoresAccionT_19 != ''){              $a .= ",SensoresAccionT_19='".($SensoresAccionT_19*3600)."'" ;}
				if(isset($SensoresAccionT_20) && $SensoresAccionT_20 != ''){              $a .= ",SensoresAccionT_20='".($SensoresAccionT_20*3600)."'" ;}
				if(isset($SensoresAccionT_21) && $SensoresAccionT_21 != ''){              $a .= ",SensoresAccionT_21='".($SensoresAccionT_21*3600)."'" ;}
				if(isset($SensoresAccionT_22) && $SensoresAccionT_22 != ''){              $a .= ",SensoresAccionT_22='".($SensoresAccionT_22*3600)."'" ;}
				if(isset($SensoresAccionT_23) && $SensoresAccionT_23 != ''){              $a .= ",SensoresAccionT_23='".($SensoresAccionT_23*3600)."'" ;}
				if(isset($SensoresAccionT_24) && $SensoresAccionT_24 != ''){              $a .= ",SensoresAccionT_24='".($SensoresAccionT_24*3600)."'" ;}
				if(isset($SensoresAccionT_25) && $SensoresAccionT_25 != ''){              $a .= ",SensoresAccionT_25='".($SensoresAccionT_25*3600)."'" ;}
				if(isset($SensoresAccionT_26) && $SensoresAccionT_26 != ''){              $a .= ",SensoresAccionT_26='".($SensoresAccionT_26*3600)."'" ;}
				if(isset($SensoresAccionT_27) && $SensoresAccionT_27 != ''){              $a .= ",SensoresAccionT_27='".($SensoresAccionT_27*3600)."'" ;}
				if(isset($SensoresAccionT_28) && $SensoresAccionT_28 != ''){              $a .= ",SensoresAccionT_28='".($SensoresAccionT_28*3600)."'" ;}
				if(isset($SensoresAccionT_29) && $SensoresAccionT_29 != ''){              $a .= ",SensoresAccionT_29='".($SensoresAccionT_29*3600)."'" ;}
				if(isset($SensoresAccionT_30) && $SensoresAccionT_30 != ''){              $a .= ",SensoresAccionT_30='".($SensoresAccionT_30*3600)."'" ;}
				if(isset($SensoresAccionT_31) && $SensoresAccionT_31 != ''){              $a .= ",SensoresAccionT_31='".($SensoresAccionT_31*3600)."'" ;}
				if(isset($SensoresAccionT_32) && $SensoresAccionT_32 != ''){              $a .= ",SensoresAccionT_32='".($SensoresAccionT_32*3600)."'" ;}
				if(isset($SensoresAccionT_33) && $SensoresAccionT_33 != ''){              $a .= ",SensoresAccionT_33='".($SensoresAccionT_33*3600)."'" ;}
				if(isset($SensoresAccionT_34) && $SensoresAccionT_34 != ''){              $a .= ",SensoresAccionT_34='".($SensoresAccionT_34*3600)."'" ;}
				if(isset($SensoresAccionT_35) && $SensoresAccionT_35 != ''){              $a .= ",SensoresAccionT_35='".($SensoresAccionT_35*3600)."'" ;}
				if(isset($SensoresAccionT_36) && $SensoresAccionT_36 != ''){              $a .= ",SensoresAccionT_36='".($SensoresAccionT_36*3600)."'" ;}
				if(isset($SensoresAccionT_37) && $SensoresAccionT_37 != ''){              $a .= ",SensoresAccionT_37='".($SensoresAccionT_37*3600)."'" ;}
				if(isset($SensoresAccionT_38) && $SensoresAccionT_38 != ''){              $a .= ",SensoresAccionT_38='".($SensoresAccionT_38*3600)."'" ;}
				if(isset($SensoresAccionT_39) && $SensoresAccionT_39 != ''){              $a .= ",SensoresAccionT_39='".($SensoresAccionT_39*3600)."'" ;}
				if(isset($SensoresAccionT_40) && $SensoresAccionT_40 != ''){              $a .= ",SensoresAccionT_40='".($SensoresAccionT_40*3600)."'" ;}
				if(isset($SensoresAccionT_41) && $SensoresAccionT_41 != ''){              $a .= ",SensoresAccionT_41='".($SensoresAccionT_41*3600)."'" ;}
				if(isset($SensoresAccionT_42) && $SensoresAccionT_42 != ''){              $a .= ",SensoresAccionT_42='".($SensoresAccionT_42*3600)."'" ;}
				if(isset($SensoresAccionT_43) && $SensoresAccionT_43 != ''){              $a .= ",SensoresAccionT_43='".($SensoresAccionT_43*3600)."'" ;}
				if(isset($SensoresAccionT_44) && $SensoresAccionT_44 != ''){              $a .= ",SensoresAccionT_44='".($SensoresAccionT_44*3600)."'" ;}
				if(isset($SensoresAccionT_45) && $SensoresAccionT_45 != ''){              $a .= ",SensoresAccionT_45='".($SensoresAccionT_45*3600)."'" ;}
				if(isset($SensoresAccionT_46) && $SensoresAccionT_46 != ''){              $a .= ",SensoresAccionT_46='".($SensoresAccionT_46*3600)."'" ;}
				if(isset($SensoresAccionT_47) && $SensoresAccionT_47 != ''){              $a .= ",SensoresAccionT_47='".($SensoresAccionT_47*3600)."'" ;}
				if(isset($SensoresAccionT_48) && $SensoresAccionT_48 != ''){              $a .= ",SensoresAccionT_48='".($SensoresAccionT_48*3600)."'" ;}
				if(isset($SensoresAccionT_49) && $SensoresAccionT_49 != ''){              $a .= ",SensoresAccionT_49='".($SensoresAccionT_49*3600)."'" ;}
				if(isset($SensoresAccionT_50) && $SensoresAccionT_50 != ''){              $a .= ",SensoresAccionT_50='".($SensoresAccionT_50*3600)."'" ;}
				if(isset($SensoresAccionAlerta_1) && $SensoresAccionAlerta_1 != ''){                $a .= ",SensoresAccionAlerta_1='".$SensoresAccionAlerta_1."'" ;}
				if(isset($SensoresAccionAlerta_2) && $SensoresAccionAlerta_2 != ''){                $a .= ",SensoresAccionAlerta_2='".$SensoresAccionAlerta_2."'" ;}
				if(isset($SensoresAccionAlerta_3) && $SensoresAccionAlerta_3 != ''){                $a .= ",SensoresAccionAlerta_3='".$SensoresAccionAlerta_3."'" ;}
				if(isset($SensoresAccionAlerta_4) && $SensoresAccionAlerta_4 != ''){                $a .= ",SensoresAccionAlerta_4='".$SensoresAccionAlerta_4."'" ;}
				if(isset($SensoresAccionAlerta_5) && $SensoresAccionAlerta_5 != ''){                $a .= ",SensoresAccionAlerta_5='".$SensoresAccionAlerta_5."'" ;}
				if(isset($SensoresAccionAlerta_6) && $SensoresAccionAlerta_6 != ''){                $a .= ",SensoresAccionAlerta_6='".$SensoresAccionAlerta_6."'" ;}
				if(isset($SensoresAccionAlerta_7) && $SensoresAccionAlerta_7 != ''){                $a .= ",SensoresAccionAlerta_7='".$SensoresAccionAlerta_7."'" ;}
				if(isset($SensoresAccionAlerta_8) && $SensoresAccionAlerta_8 != ''){                $a .= ",SensoresAccionAlerta_8='".$SensoresAccionAlerta_8."'" ;}
				if(isset($SensoresAccionAlerta_9) && $SensoresAccionAlerta_9 != ''){                $a .= ",SensoresAccionAlerta_9='".$SensoresAccionAlerta_9."'" ;}
				if(isset($SensoresAccionAlerta_10) && $SensoresAccionAlerta_10 != ''){              $a .= ",SensoresAccionAlerta_10='".$SensoresAccionAlerta_10."'" ;}
				if(isset($SensoresAccionAlerta_11) && $SensoresAccionAlerta_11 != ''){              $a .= ",SensoresAccionAlerta_11='".$SensoresAccionAlerta_11."'" ;}
				if(isset($SensoresAccionAlerta_12) && $SensoresAccionAlerta_12 != ''){              $a .= ",SensoresAccionAlerta_12='".$SensoresAccionAlerta_12."'" ;}
				if(isset($SensoresAccionAlerta_13) && $SensoresAccionAlerta_13 != ''){              $a .= ",SensoresAccionAlerta_13='".$SensoresAccionAlerta_13."'" ;}
				if(isset($SensoresAccionAlerta_14) && $SensoresAccionAlerta_14 != ''){              $a .= ",SensoresAccionAlerta_14='".$SensoresAccionAlerta_14."'" ;}
				if(isset($SensoresAccionAlerta_15) && $SensoresAccionAlerta_15 != ''){              $a .= ",SensoresAccionAlerta_15='".$SensoresAccionAlerta_15."'" ;}
				if(isset($SensoresAccionAlerta_16) && $SensoresAccionAlerta_16 != ''){              $a .= ",SensoresAccionAlerta_16='".$SensoresAccionAlerta_16."'" ;}
				if(isset($SensoresAccionAlerta_17) && $SensoresAccionAlerta_17 != ''){              $a .= ",SensoresAccionAlerta_17='".$SensoresAccionAlerta_17."'" ;}
				if(isset($SensoresAccionAlerta_18) && $SensoresAccionAlerta_18 != ''){              $a .= ",SensoresAccionAlerta_18='".$SensoresAccionAlerta_18."'" ;}
				if(isset($SensoresAccionAlerta_19) && $SensoresAccionAlerta_19 != ''){              $a .= ",SensoresAccionAlerta_19='".$SensoresAccionAlerta_19."'" ;}
				if(isset($SensoresAccionAlerta_20) && $SensoresAccionAlerta_20 != ''){              $a .= ",SensoresAccionAlerta_20='".$SensoresAccionAlerta_20."'" ;}
				if(isset($SensoresAccionAlerta_21) && $SensoresAccionAlerta_21 != ''){              $a .= ",SensoresAccionAlerta_21='".$SensoresAccionAlerta_21."'" ;}
				if(isset($SensoresAccionAlerta_22) && $SensoresAccionAlerta_22 != ''){              $a .= ",SensoresAccionAlerta_22='".$SensoresAccionAlerta_22."'" ;}
				if(isset($SensoresAccionAlerta_23) && $SensoresAccionAlerta_23 != ''){              $a .= ",SensoresAccionAlerta_23='".$SensoresAccionAlerta_23."'" ;}
				if(isset($SensoresAccionAlerta_24) && $SensoresAccionAlerta_24 != ''){              $a .= ",SensoresAccionAlerta_24='".$SensoresAccionAlerta_24."'" ;}
				if(isset($SensoresAccionAlerta_25) && $SensoresAccionAlerta_25 != ''){              $a .= ",SensoresAccionAlerta_25='".$SensoresAccionAlerta_25."'" ;}
				if(isset($SensoresAccionAlerta_26) && $SensoresAccionAlerta_26 != ''){              $a .= ",SensoresAccionAlerta_26='".$SensoresAccionAlerta_26."'" ;}
				if(isset($SensoresAccionAlerta_27) && $SensoresAccionAlerta_27 != ''){              $a .= ",SensoresAccionAlerta_27='".$SensoresAccionAlerta_27."'" ;}
				if(isset($SensoresAccionAlerta_28) && $SensoresAccionAlerta_28 != ''){              $a .= ",SensoresAccionAlerta_28='".$SensoresAccionAlerta_28."'" ;}
				if(isset($SensoresAccionAlerta_29) && $SensoresAccionAlerta_29 != ''){              $a .= ",SensoresAccionAlerta_29='".$SensoresAccionAlerta_29."'" ;}
				if(isset($SensoresAccionAlerta_30) && $SensoresAccionAlerta_30 != ''){              $a .= ",SensoresAccionAlerta_30='".$SensoresAccionAlerta_30."'" ;}
				if(isset($SensoresAccionAlerta_31) && $SensoresAccionAlerta_31 != ''){              $a .= ",SensoresAccionAlerta_31='".$SensoresAccionAlerta_31."'" ;}
				if(isset($SensoresAccionAlerta_32) && $SensoresAccionAlerta_32 != ''){              $a .= ",SensoresAccionAlerta_32='".$SensoresAccionAlerta_32."'" ;}
				if(isset($SensoresAccionAlerta_33) && $SensoresAccionAlerta_33 != ''){              $a .= ",SensoresAccionAlerta_33='".$SensoresAccionAlerta_33."'" ;}
				if(isset($SensoresAccionAlerta_34) && $SensoresAccionAlerta_34 != ''){              $a .= ",SensoresAccionAlerta_34='".$SensoresAccionAlerta_34."'" ;}
				if(isset($SensoresAccionAlerta_35) && $SensoresAccionAlerta_35 != ''){              $a .= ",SensoresAccionAlerta_35='".$SensoresAccionAlerta_35."'" ;}
				if(isset($SensoresAccionAlerta_36) && $SensoresAccionAlerta_36 != ''){              $a .= ",SensoresAccionAlerta_36='".$SensoresAccionAlerta_36."'" ;}
				if(isset($SensoresAccionAlerta_37) && $SensoresAccionAlerta_37 != ''){              $a .= ",SensoresAccionAlerta_37='".$SensoresAccionAlerta_37."'" ;}
				if(isset($SensoresAccionAlerta_38) && $SensoresAccionAlerta_38 != ''){              $a .= ",SensoresAccionAlerta_38='".$SensoresAccionAlerta_38."'" ;}
				if(isset($SensoresAccionAlerta_39) && $SensoresAccionAlerta_39 != ''){              $a .= ",SensoresAccionAlerta_39='".$SensoresAccionAlerta_39."'" ;}
				if(isset($SensoresAccionAlerta_40) && $SensoresAccionAlerta_40 != ''){              $a .= ",SensoresAccionAlerta_40='".$SensoresAccionAlerta_40."'" ;}
				if(isset($SensoresAccionAlerta_41) && $SensoresAccionAlerta_41 != ''){              $a .= ",SensoresAccionAlerta_41='".$SensoresAccionAlerta_41."'" ;}
				if(isset($SensoresAccionAlerta_42) && $SensoresAccionAlerta_42 != ''){              $a .= ",SensoresAccionAlerta_42='".$SensoresAccionAlerta_42."'" ;}
				if(isset($SensoresAccionAlerta_43) && $SensoresAccionAlerta_43 != ''){              $a .= ",SensoresAccionAlerta_43='".$SensoresAccionAlerta_43."'" ;}
				if(isset($SensoresAccionAlerta_44) && $SensoresAccionAlerta_44 != ''){              $a .= ",SensoresAccionAlerta_44='".$SensoresAccionAlerta_44."'" ;}
				if(isset($SensoresAccionAlerta_45) && $SensoresAccionAlerta_45 != ''){              $a .= ",SensoresAccionAlerta_45='".$SensoresAccionAlerta_45."'" ;}
				if(isset($SensoresAccionAlerta_46) && $SensoresAccionAlerta_46 != ''){              $a .= ",SensoresAccionAlerta_46='".$SensoresAccionAlerta_46."'" ;}
				if(isset($SensoresAccionAlerta_47) && $SensoresAccionAlerta_47 != ''){              $a .= ",SensoresAccionAlerta_47='".$SensoresAccionAlerta_47."'" ;}
				if(isset($SensoresAccionAlerta_48) && $SensoresAccionAlerta_48 != ''){              $a .= ",SensoresAccionAlerta_48='".$SensoresAccionAlerta_48."'" ;}
				if(isset($SensoresAccionAlerta_49) && $SensoresAccionAlerta_49 != ''){              $a .= ",SensoresAccionAlerta_49='".$SensoresAccionAlerta_49."'" ;}
				if(isset($SensoresAccionAlerta_50) && $SensoresAccionAlerta_50 != ''){              $a .= ",SensoresAccionAlerta_50='".$SensoresAccionAlerta_50."'" ;}
				if(isset($SensoresRevision_1) && $SensoresRevision_1 != ''){                $a .= ",SensoresRevision_1='".$SensoresRevision_1."'" ;}
				if(isset($SensoresRevision_2) && $SensoresRevision_2 != ''){                $a .= ",SensoresRevision_2='".$SensoresRevision_2."'" ;}
				if(isset($SensoresRevision_3) && $SensoresRevision_3 != ''){                $a .= ",SensoresRevision_3='".$SensoresRevision_3."'" ;}
				if(isset($SensoresRevision_4) && $SensoresRevision_4 != ''){                $a .= ",SensoresRevision_4='".$SensoresRevision_4."'" ;}
				if(isset($SensoresRevision_5) && $SensoresRevision_5 != ''){                $a .= ",SensoresRevision_5='".$SensoresRevision_5."'" ;}
				if(isset($SensoresRevision_6) && $SensoresRevision_6 != ''){                $a .= ",SensoresRevision_6='".$SensoresRevision_6."'" ;}
				if(isset($SensoresRevision_7) && $SensoresRevision_7 != ''){                $a .= ",SensoresRevision_7='".$SensoresRevision_7."'" ;}
				if(isset($SensoresRevision_8) && $SensoresRevision_8 != ''){                $a .= ",SensoresRevision_8='".$SensoresRevision_8."'" ;}
				if(isset($SensoresRevision_9) && $SensoresRevision_9 != ''){                $a .= ",SensoresRevision_9='".$SensoresRevision_9."'" ;}
				if(isset($SensoresRevision_10) && $SensoresRevision_10 != ''){              $a .= ",SensoresRevision_10='".$SensoresRevision_10."'" ;}
				if(isset($SensoresRevision_11) && $SensoresRevision_11 != ''){              $a .= ",SensoresRevision_11='".$SensoresRevision_11."'" ;}
				if(isset($SensoresRevision_12) && $SensoresRevision_12 != ''){              $a .= ",SensoresRevision_12='".$SensoresRevision_12."'" ;}
				if(isset($SensoresRevision_13) && $SensoresRevision_13 != ''){              $a .= ",SensoresRevision_13='".$SensoresRevision_13."'" ;}
				if(isset($SensoresRevision_14) && $SensoresRevision_14 != ''){              $a .= ",SensoresRevision_14='".$SensoresRevision_14."'" ;}
				if(isset($SensoresRevision_15) && $SensoresRevision_15 != ''){              $a .= ",SensoresRevision_15='".$SensoresRevision_15."'" ;}
				if(isset($SensoresRevision_16) && $SensoresRevision_16 != ''){              $a .= ",SensoresRevision_16='".$SensoresRevision_16."'" ;}
				if(isset($SensoresRevision_17) && $SensoresRevision_17 != ''){              $a .= ",SensoresRevision_17='".$SensoresRevision_17."'" ;}
				if(isset($SensoresRevision_18) && $SensoresRevision_18 != ''){              $a .= ",SensoresRevision_18='".$SensoresRevision_18."'" ;}
				if(isset($SensoresRevision_19) && $SensoresRevision_19 != ''){              $a .= ",SensoresRevision_19='".$SensoresRevision_19."'" ;}
				if(isset($SensoresRevision_20) && $SensoresRevision_20 != ''){              $a .= ",SensoresRevision_20='".$SensoresRevision_20."'" ;}
				if(isset($SensoresRevision_21) && $SensoresRevision_21 != ''){              $a .= ",SensoresRevision_21='".$SensoresRevision_21."'" ;}
				if(isset($SensoresRevision_22) && $SensoresRevision_22 != ''){              $a .= ",SensoresRevision_22='".$SensoresRevision_22."'" ;}
				if(isset($SensoresRevision_23) && $SensoresRevision_23 != ''){              $a .= ",SensoresRevision_23='".$SensoresRevision_23."'" ;}
				if(isset($SensoresRevision_24) && $SensoresRevision_24 != ''){              $a .= ",SensoresRevision_24='".$SensoresRevision_24."'" ;}
				if(isset($SensoresRevision_25) && $SensoresRevision_25 != ''){              $a .= ",SensoresRevision_25='".$SensoresRevision_25."'" ;}
				if(isset($SensoresRevision_26) && $SensoresRevision_26 != ''){              $a .= ",SensoresRevision_26='".$SensoresRevision_26."'" ;}
				if(isset($SensoresRevision_27) && $SensoresRevision_27 != ''){              $a .= ",SensoresRevision_27='".$SensoresRevision_27."'" ;}
				if(isset($SensoresRevision_28) && $SensoresRevision_28 != ''){              $a .= ",SensoresRevision_28='".$SensoresRevision_28."'" ;}
				if(isset($SensoresRevision_29) && $SensoresRevision_29 != ''){              $a .= ",SensoresRevision_29='".$SensoresRevision_29."'" ;}
				if(isset($SensoresRevision_30) && $SensoresRevision_30 != ''){              $a .= ",SensoresRevision_30='".$SensoresRevision_30."'" ;}
				if(isset($SensoresRevision_31) && $SensoresRevision_31 != ''){              $a .= ",SensoresRevision_31='".$SensoresRevision_31."'" ;}
				if(isset($SensoresRevision_32) && $SensoresRevision_32 != ''){              $a .= ",SensoresRevision_32='".$SensoresRevision_32."'" ;}
				if(isset($SensoresRevision_33) && $SensoresRevision_33 != ''){              $a .= ",SensoresRevision_33='".$SensoresRevision_33."'" ;}
				if(isset($SensoresRevision_34) && $SensoresRevision_34 != ''){              $a .= ",SensoresRevision_34='".$SensoresRevision_34."'" ;}
				if(isset($SensoresRevision_35) && $SensoresRevision_35 != ''){              $a .= ",SensoresRevision_35='".$SensoresRevision_35."'" ;}
				if(isset($SensoresRevision_36) && $SensoresRevision_36 != ''){              $a .= ",SensoresRevision_36='".$SensoresRevision_36."'" ;}
				if(isset($SensoresRevision_37) && $SensoresRevision_37 != ''){              $a .= ",SensoresRevision_37='".$SensoresRevision_37."'" ;}
				if(isset($SensoresRevision_38) && $SensoresRevision_38 != ''){              $a .= ",SensoresRevision_38='".$SensoresRevision_38."'" ;}
				if(isset($SensoresRevision_39) && $SensoresRevision_39 != ''){              $a .= ",SensoresRevision_39='".$SensoresRevision_39."'" ;}
				if(isset($SensoresRevision_40) && $SensoresRevision_40 != ''){              $a .= ",SensoresRevision_40='".$SensoresRevision_40."'" ;}
				if(isset($SensoresRevision_41) && $SensoresRevision_41 != ''){              $a .= ",SensoresRevision_41='".$SensoresRevision_41."'" ;}
				if(isset($SensoresRevision_42) && $SensoresRevision_42 != ''){              $a .= ",SensoresRevision_42='".$SensoresRevision_42."'" ;}
				if(isset($SensoresRevision_43) && $SensoresRevision_43 != ''){              $a .= ",SensoresRevision_43='".$SensoresRevision_43."'" ;}
				if(isset($SensoresRevision_44) && $SensoresRevision_44 != ''){              $a .= ",SensoresRevision_44='".$SensoresRevision_44."'" ;}
				if(isset($SensoresRevision_45) && $SensoresRevision_45 != ''){              $a .= ",SensoresRevision_45='".$SensoresRevision_45."'" ;}
				if(isset($SensoresRevision_46) && $SensoresRevision_46 != ''){              $a .= ",SensoresRevision_46='".$SensoresRevision_46."'" ;}
				if(isset($SensoresRevision_47) && $SensoresRevision_47 != ''){              $a .= ",SensoresRevision_47='".$SensoresRevision_47."'" ;}
				if(isset($SensoresRevision_48) && $SensoresRevision_48 != ''){              $a .= ",SensoresRevision_48='".$SensoresRevision_48."'" ;}
				if(isset($SensoresRevision_49) && $SensoresRevision_49 != ''){              $a .= ",SensoresRevision_49='".$SensoresRevision_49."'" ;}
				if(isset($SensoresRevision_50) && $SensoresRevision_50 != ''){              $a .= ",SensoresRevision_50='".$SensoresRevision_50."'" ;}
				if(isset($SensoresRevisionGrupo_1) && $SensoresRevisionGrupo_1 != ''){                $a .= ",SensoresRevisionGrupo_1='".$SensoresRevisionGrupo_1."'" ;}
				if(isset($SensoresRevisionGrupo_2) && $SensoresRevisionGrupo_2 != ''){                $a .= ",SensoresRevisionGrupo_2='".$SensoresRevisionGrupo_2."'" ;}
				if(isset($SensoresRevisionGrupo_3) && $SensoresRevisionGrupo_3 != ''){                $a .= ",SensoresRevisionGrupo_3='".$SensoresRevisionGrupo_3."'" ;}
				if(isset($SensoresRevisionGrupo_4) && $SensoresRevisionGrupo_4 != ''){                $a .= ",SensoresRevisionGrupo_4='".$SensoresRevisionGrupo_4."'" ;}
				if(isset($SensoresRevisionGrupo_5) && $SensoresRevisionGrupo_5 != ''){                $a .= ",SensoresRevisionGrupo_5='".$SensoresRevisionGrupo_5."'" ;}
				if(isset($SensoresRevisionGrupo_6) && $SensoresRevisionGrupo_6 != ''){                $a .= ",SensoresRevisionGrupo_6='".$SensoresRevisionGrupo_6."'" ;}
				if(isset($SensoresRevisionGrupo_7) && $SensoresRevisionGrupo_7 != ''){                $a .= ",SensoresRevisionGrupo_7='".$SensoresRevisionGrupo_7."'" ;}
				if(isset($SensoresRevisionGrupo_8) && $SensoresRevisionGrupo_8 != ''){                $a .= ",SensoresRevisionGrupo_8='".$SensoresRevisionGrupo_8."'" ;}
				if(isset($SensoresRevisionGrupo_9) && $SensoresRevisionGrupo_9 != ''){                $a .= ",SensoresRevisionGrupo_9='".$SensoresRevisionGrupo_9."'" ;}
				if(isset($SensoresRevisionGrupo_10) && $SensoresRevisionGrupo_10 != ''){              $a .= ",SensoresRevisionGrupo_10='".$SensoresRevisionGrupo_10."'" ;}
				if(isset($SensoresRevisionGrupo_11) && $SensoresRevisionGrupo_11 != ''){              $a .= ",SensoresRevisionGrupo_11='".$SensoresRevisionGrupo_11."'" ;}
				if(isset($SensoresRevisionGrupo_12) && $SensoresRevisionGrupo_12 != ''){              $a .= ",SensoresRevisionGrupo_12='".$SensoresRevisionGrupo_12."'" ;}
				if(isset($SensoresRevisionGrupo_13) && $SensoresRevisionGrupo_13 != ''){              $a .= ",SensoresRevisionGrupo_13='".$SensoresRevisionGrupo_13."'" ;}
				if(isset($SensoresRevisionGrupo_14) && $SensoresRevisionGrupo_14 != ''){              $a .= ",SensoresRevisionGrupo_14='".$SensoresRevisionGrupo_14."'" ;}
				if(isset($SensoresRevisionGrupo_15) && $SensoresRevisionGrupo_15 != ''){              $a .= ",SensoresRevisionGrupo_15='".$SensoresRevisionGrupo_15."'" ;}
				if(isset($SensoresRevisionGrupo_16) && $SensoresRevisionGrupo_16 != ''){              $a .= ",SensoresRevisionGrupo_16='".$SensoresRevisionGrupo_16."'" ;}
				if(isset($SensoresRevisionGrupo_17) && $SensoresRevisionGrupo_17 != ''){              $a .= ",SensoresRevisionGrupo_17='".$SensoresRevisionGrupo_17."'" ;}
				if(isset($SensoresRevisionGrupo_18) && $SensoresRevisionGrupo_18 != ''){              $a .= ",SensoresRevisionGrupo_18='".$SensoresRevisionGrupo_18."'" ;}
				if(isset($SensoresRevisionGrupo_19) && $SensoresRevisionGrupo_19 != ''){              $a .= ",SensoresRevisionGrupo_19='".$SensoresRevisionGrupo_19."'" ;}
				if(isset($SensoresRevisionGrupo_20) && $SensoresRevisionGrupo_20 != ''){              $a .= ",SensoresRevisionGrupo_20='".$SensoresRevisionGrupo_20."'" ;}
				if(isset($SensoresRevisionGrupo_21) && $SensoresRevisionGrupo_21 != ''){              $a .= ",SensoresRevisionGrupo_21='".$SensoresRevisionGrupo_21."'" ;}
				if(isset($SensoresRevisionGrupo_22) && $SensoresRevisionGrupo_22 != ''){              $a .= ",SensoresRevisionGrupo_22='".$SensoresRevisionGrupo_22."'" ;}
				if(isset($SensoresRevisionGrupo_23) && $SensoresRevisionGrupo_23 != ''){              $a .= ",SensoresRevisionGrupo_23='".$SensoresRevisionGrupo_23."'" ;}
				if(isset($SensoresRevisionGrupo_24) && $SensoresRevisionGrupo_24 != ''){              $a .= ",SensoresRevisionGrupo_24='".$SensoresRevisionGrupo_24."'" ;}
				if(isset($SensoresRevisionGrupo_25) && $SensoresRevisionGrupo_25 != ''){              $a .= ",SensoresRevisionGrupo_25='".$SensoresRevisionGrupo_25."'" ;}
				if(isset($SensoresRevisionGrupo_26) && $SensoresRevisionGrupo_26 != ''){              $a .= ",SensoresRevisionGrupo_26='".$SensoresRevisionGrupo_26."'" ;}
				if(isset($SensoresRevisionGrupo_27) && $SensoresRevisionGrupo_27 != ''){              $a .= ",SensoresRevisionGrupo_27='".$SensoresRevisionGrupo_27."'" ;}
				if(isset($SensoresRevisionGrupo_28) && $SensoresRevisionGrupo_28 != ''){              $a .= ",SensoresRevisionGrupo_28='".$SensoresRevisionGrupo_28."'" ;}
				if(isset($SensoresRevisionGrupo_29) && $SensoresRevisionGrupo_29 != ''){              $a .= ",SensoresRevisionGrupo_29='".$SensoresRevisionGrupo_29."'" ;}
				if(isset($SensoresRevisionGrupo_30) && $SensoresRevisionGrupo_30 != ''){              $a .= ",SensoresRevisionGrupo_30='".$SensoresRevisionGrupo_30."'" ;}
				if(isset($SensoresRevisionGrupo_31) && $SensoresRevisionGrupo_31 != ''){              $a .= ",SensoresRevisionGrupo_31='".$SensoresRevisionGrupo_31."'" ;}
				if(isset($SensoresRevisionGrupo_32) && $SensoresRevisionGrupo_32 != ''){              $a .= ",SensoresRevisionGrupo_32='".$SensoresRevisionGrupo_32."'" ;}
				if(isset($SensoresRevisionGrupo_33) && $SensoresRevisionGrupo_33 != ''){              $a .= ",SensoresRevisionGrupo_33='".$SensoresRevisionGrupo_33."'" ;}
				if(isset($SensoresRevisionGrupo_34) && $SensoresRevisionGrupo_34 != ''){              $a .= ",SensoresRevisionGrupo_34='".$SensoresRevisionGrupo_34."'" ;}
				if(isset($SensoresRevisionGrupo_35) && $SensoresRevisionGrupo_35 != ''){              $a .= ",SensoresRevisionGrupo_35='".$SensoresRevisionGrupo_35."'" ;}
				if(isset($SensoresRevisionGrupo_36) && $SensoresRevisionGrupo_36 != ''){              $a .= ",SensoresRevisionGrupo_36='".$SensoresRevisionGrupo_36."'" ;}
				if(isset($SensoresRevisionGrupo_37) && $SensoresRevisionGrupo_37 != ''){              $a .= ",SensoresRevisionGrupo_37='".$SensoresRevisionGrupo_37."'" ;}
				if(isset($SensoresRevisionGrupo_38) && $SensoresRevisionGrupo_38 != ''){              $a .= ",SensoresRevisionGrupo_38='".$SensoresRevisionGrupo_38."'" ;}
				if(isset($SensoresRevisionGrupo_39) && $SensoresRevisionGrupo_39 != ''){              $a .= ",SensoresRevisionGrupo_39='".$SensoresRevisionGrupo_39."'" ;}
				if(isset($SensoresRevisionGrupo_40) && $SensoresRevisionGrupo_40 != ''){              $a .= ",SensoresRevisionGrupo_40='".$SensoresRevisionGrupo_40."'" ;}
				if(isset($SensoresRevisionGrupo_41) && $SensoresRevisionGrupo_41 != ''){              $a .= ",SensoresRevisionGrupo_41='".$SensoresRevisionGrupo_41."'" ;}
				if(isset($SensoresRevisionGrupo_42) && $SensoresRevisionGrupo_42 != ''){              $a .= ",SensoresRevisionGrupo_42='".$SensoresRevisionGrupo_42."'" ;}
				if(isset($SensoresRevisionGrupo_43) && $SensoresRevisionGrupo_43 != ''){              $a .= ",SensoresRevisionGrupo_43='".$SensoresRevisionGrupo_43."'" ;}
				if(isset($SensoresRevisionGrupo_44) && $SensoresRevisionGrupo_44 != ''){              $a .= ",SensoresRevisionGrupo_44='".$SensoresRevisionGrupo_44."'" ;}
				if(isset($SensoresRevisionGrupo_45) && $SensoresRevisionGrupo_45 != ''){              $a .= ",SensoresRevisionGrupo_45='".$SensoresRevisionGrupo_45."'" ;}
				if(isset($SensoresRevisionGrupo_46) && $SensoresRevisionGrupo_46 != ''){              $a .= ",SensoresRevisionGrupo_46='".$SensoresRevisionGrupo_46."'" ;}
				if(isset($SensoresRevisionGrupo_47) && $SensoresRevisionGrupo_47 != ''){              $a .= ",SensoresRevisionGrupo_47='".$SensoresRevisionGrupo_47."'" ;}
				if(isset($SensoresRevisionGrupo_48) && $SensoresRevisionGrupo_48 != ''){              $a .= ",SensoresRevisionGrupo_48='".$SensoresRevisionGrupo_48."'" ;}
				if(isset($SensoresRevisionGrupo_49) && $SensoresRevisionGrupo_49 != ''){              $a .= ",SensoresRevisionGrupo_49='".$SensoresRevisionGrupo_49."'" ;}
				if(isset($SensoresRevisionGrupo_50) && $SensoresRevisionGrupo_50 != ''){              $a .= ",SensoresRevisionGrupo_50='".$SensoresRevisionGrupo_50."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `telemetria_listado` SET ".$a." WHERE idTelemetria = '$idTelemetria'";
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
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
	
		break;	
						
/*******************************************************************************************************************/
		case 'del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el nombre del logo
			$query = "SELECT Direccion_img
			FROM `telemetria_listado`
			WHERE idTelemetria = {$_GET['del']}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//se borra el dato de la base de datos
			$query  = "DELETE FROM `telemetria_listado` WHERE idTelemetria = {$_GET['del']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				// elimino la tabla si es que existe
				$query  = "DROP TABLE IF EXISTS `telemetria_listado_tablarelacionada_".$_GET['del']."`";
				$result = mysqli_query($dbConn, $query);
					
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
		//Cambia el nivel del permiso
		case 'submit_img':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ($_FILES["Direccion_img"]["error"] > 0){ 
				$error['Direccion_img']     = 'error/Ha ocurrido un error'; 
			} else {
			  //Se verifican las extensiones de los archivos
			  $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
			  //Se verifica que el archivo subido no exceda los 100 kb
			  $limite_kb = 1000;
			  //Sufijo
			  $sufijo = 'tel_img_';
			  
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
						if ( !empty($_POST['idTelemetria']) )    $idTelemetria       = $_POST['idTelemetria'];
						
						$a = "Direccion_img='".$sufijo.$_FILES['Direccion_img']['name']."'" ;

						// inserto los datos de registro en la db
						$query  = "UPDATE `telemetria_listado` SET ".$a." WHERE idTelemetria = '$idTelemetria'";
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
						
						header( 'Location: '.$location.'&id='.$idTelemetria );
						die;
						
						
					} else {
					$error['Direccion_img']     = 'error/Ocurrio un error al mover el archivo'; 
				  }
				} else {
				  $error['Direccion_img']     = 'error/El archivo '.$_FILES['Direccion_img']['name'].' ya existe'; 
				}
			  } else {
				$error['Direccion_img']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
			  }
			}


		break;	
/*******************************************************************************************************************/
		case 'del_img':	
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el nombre del logo
			$query = "SELECT Direccion_img
			FROM `telemetria_listado`
			WHERE idTelemetria = {$_GET['del_img']}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//se borra el dato de la base de datos
			$query  = "UPDATE `telemetria_listado` SET Direccion_img='' WHERE idTelemetria = '{$_GET['del_img']}'";
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
		//Cambio el estado de activo a inactivo
		case 'estado':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//variables
			$idTelemetria  = $_GET['id'];
			$idEstado      = $_GET['estado'];
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idTelemetria)&&$idTelemetria!=''){
				$ndata_1 = db_select_nrows ('idEstado', 'telemetria_listado', '', "idEstado=2 AND idMantencion=1 AND idTelemetria='".$idTelemetria."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El equipo de telemetria se encuentra en mantencion , favor esperar a que la mantencion sea terminada';}
			/*******************************************************************/
			
				
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$query  = "UPDATE telemetria_listado SET idEstado = '$idEstado'	
				WHERE idTelemetria    = '$idTelemetria'";
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
		//Cambio la alerta general de activo a inactivo
		case 'alerta':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$idTelemetria  = $_GET['id'];
			$idAlerta      = $_GET['alerta'];
			$query  = "UPDATE telemetria_listado SET idAlarmaGeneral = '$idAlerta'	
			WHERE idTelemetria    = '$idTelemetria'";
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
		case 'clone_Equipo':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
		
			//obtengo los datos de la maquina previamente seleccionada
			$query = "SELECT idSistema
			FROM `telemetria_listado`
			WHERE idTelemetria = {$idTelemetria}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($rowdata['idSistema'])){
				$ndata_1 = db_select_nrows ('Nombre', 'telemetria_listado', '', "Nombre='".$Nombre."' AND idSistema='".$rowdata['idSistema']."'", $dbConn);
			}
			//Se verifica si el dato existe
			if(isset($Identificador)&&isset($rowdata['idSistema'])){
				$ndata_2 = db_select_nrows ('Identificador', 'telemetria_listado', '', "Identificador='".$Identificador."' AND idSistema='".$rowdata['idSistema']."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre del equipo ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El identificador del equipo ya existe en el sistema';}
			/*******************************************************************/
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//bucle
				$qry = '';
				for ($i = 1; $i <= 50; $i++) {
					$qry .= ',SensoresNombre_'.$i;
					$qry .= ',SensoresTipo_'.$i;
					$qry .= ',SensoresMedMin_'.$i;
					$qry .= ',SensoresMedMax_'.$i;
					$qry .= ',SensoresMedErrores_'.$i;
					$qry .= ',SensoresMedAlerta_'.$i;
					$qry .= ',SensoresGrupo_'.$i;
					$qry .= ',SensoresUniMed_'.$i;
					$qry .= ',SensoresActivo_'.$i;
					
				}

				/*******************************************************************/
				// Se traen todos los datos de la maquina
				$query = "SELECT 
				idSistema,idCiudad, idComuna, Direccion, GeoLatitud, GeoLongitud, GeoVelocidad, GeoDireccion,
				GeoMovimiento, GeoTiempoDetencion, id_Geo, id_Sensores, cantSensores, idDispositivo, idShield,LimiteVelocidad, idAlarmaGeneral,
				NDetenciones, TiempoFueraLinea, TiempoDetencion, idZona, Direccion_img,SensorActivacionID, SensorActivacionValor,
				Hor_idActivo_dia1, Hor_idActivo_dia2, Hor_idActivo_dia3, Hor_idActivo_dia4, Hor_idActivo_dia5, Hor_idActivo_dia6, Hor_idActivo_dia7,
				Hor_Inicio_dia1, Hor_Inicio_dia2, Hor_Inicio_dia3, Hor_Inicio_dia4, Hor_Inicio_dia5, Hor_Inicio_dia6, Hor_Inicio_dia7,
				Hor_Termino_dia1, Hor_Termino_dia2, Hor_Termino_dia3, Hor_Termino_dia4, Hor_Termino_dia5, Hor_Termino_dia6, Hor_Termino_dia7
				 ".$qry."
				FROM `telemetria_listado`
				WHERE idTelemetria = {$idTelemetria}";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata = mysqli_fetch_assoc ($resultado);

				/*******************************************************************/
				//filtros
				if(isset($rowdata['idSistema']) && $rowdata['idSistema'] != ''){                              $a  = "'".$rowdata['idSistema']."'" ;                }else{$a  ="''";}
				if(isset($idEstado) && $idEstado != ''){                                                      $a .= ",'".$idEstado."'" ;                           }else{$a .= ",''";}
				if(isset($Identificador) && $Identificador != ''){                                            $a .= ",'".$Identificador."'" ;                      }else{$a .= ",''";}
				if(isset($Nombre) && $Nombre != ''){                                                          $a .= ",'".$Nombre."'" ;                             }else{$a .= ",''";}
				if(isset($rowdata['idCiudad']) && $rowdata['idCiudad'] != ''){                                $a .= ",'".$rowdata['idCiudad']."'" ;                }else{$a .= ",''";}
				if(isset($rowdata['idComuna']) && $rowdata['idComuna'] != ''){                                $a .= ",'".$rowdata['idComuna']."'" ;                }else{$a .= ",''";}
				if(isset($rowdata['Direccion']) && $rowdata['Direccion'] != ''){                              $a .= ",'".$rowdata['Direccion']."'" ;               }else{$a .= ",''";}
				if(isset($rowdata['GeoLatitud']) && $rowdata['GeoLatitud'] != ''){                            $a .= ",'".$rowdata['GeoLatitud']."'" ;              }else{$a .= ",''";}
				if(isset($rowdata['GeoLongitud']) && $rowdata['GeoLongitud'] != ''){                          $a .= ",'".$rowdata['GeoLongitud']."'" ;             }else{$a .= ",''";}
				if(isset($rowdata['GeoVelocidad']) && $rowdata['GeoVelocidad'] != ''){                        $a .= ",'".$rowdata['GeoVelocidad']."'" ;            }else{$a .= ",''";}
				if(isset($rowdata['GeoDireccion']) && $rowdata['GeoDireccion'] != ''){                        $a .= ",'".$rowdata['GeoDireccion']."'" ;            }else{$a .= ",''";}
				if(isset($rowdata['GeoMovimiento']) && $rowdata['GeoMovimiento'] != ''){                      $a .= ",'".$rowdata['GeoMovimiento']."'" ;           }else{$a .= ",''";}
				if(isset($rowdata['GeoTiempoDetencion']) && $rowdata['GeoTiempoDetencion'] != ''){            $a .= ",'".$rowdata['GeoTiempoDetencion']."'" ;      }else{$a .= ",''";}
				if(isset($rowdata['id_Geo']) && $rowdata['id_Geo'] != ''){                                    $a .= ",'".$rowdata['id_Geo']."'" ;                  }else{$a .= ",''";}
				if(isset($rowdata['id_Sensores']) && $rowdata['id_Sensores'] != ''){                          $a .= ",'".$rowdata['id_Sensores']."'" ;             }else{$a .= ",''";}
				if(isset($rowdata['cantSensores']) && $rowdata['cantSensores'] != ''){                        $a .= ",'".$rowdata['cantSensores']."'" ;            }else{$a .= ",''";}
				if(isset($rowdata['idDispositivo']) && $rowdata['idDispositivo'] != ''){                      $a .= ",'".$rowdata['idDispositivo']."'" ;           }else{$a .= ",''";}
				if(isset($rowdata['idShield']) && $rowdata['idShield'] != ''){                                $a .= ",'".$rowdata['idShield']."'" ;                }else{$a .= ",''";}
				if(isset($rowdata['LimiteVelocidad']) && $rowdata['LimiteVelocidad'] != ''){                  $a .= ",'".$rowdata['LimiteVelocidad']."'" ;         }else{$a .= ",''";}
				if(isset($rowdata['idAlarmaGeneral']) && $rowdata['idAlarmaGeneral'] != ''){                  $a .= ",'".$rowdata['idAlarmaGeneral']."'" ;         }else{$a .= ",''";}
				if(isset($rowdata['NDetenciones']) && $rowdata['NDetenciones'] != ''){                        $a .= ",'".$rowdata['NDetenciones']."'" ;            }else{$a .= ",''";}
				if(isset($rowdata['TiempoFueraLinea']) && $rowdata['TiempoFueraLinea'] != ''){                $a .= ",'".$rowdata['TiempoFueraLinea']."'" ;        }else{$a .= ",''";}
				if(isset($rowdata['TiempoDetencion']) && $rowdata['TiempoDetencion'] != ''){                  $a .= ",'".$rowdata['TiempoDetencion']."'" ;         }else{$a .= ",''";}
				if(isset($rowdata['idZona']) && $rowdata['idZona'] != ''){                                    $a .= ",'".$rowdata['idZona']."'" ;                  }else{$a .= ",''";}
				if(isset($rowdata['Direccion_img']) && $rowdata['Direccion_img'] != ''){                      $a .= ",'".$rowdata['Direccion_img']."'" ;           }else{$a .= ",''";}
				if(isset($rowdata['SensorActivacionID']) && $rowdata['SensorActivacionID'] != ''){            $a .= ",'".$rowdata['SensorActivacionID']."'" ;      }else{$a .= ",''";}
				if(isset($rowdata['SensorActivacionValor']) && $rowdata['SensorActivacionValor'] != ''){      $a .= ",'".$rowdata['SensorActivacionValor']."'" ;   }else{$a .= ",''";}
				if(isset($rowdata['Hor_idActivo_dia1']) && $rowdata['Hor_idActivo_dia1'] != ''){              $a .= ",'".$rowdata['Hor_idActivo_dia1']."'" ;       }else{$a .= ",''";}
				if(isset($rowdata['Hor_idActivo_dia2']) && $rowdata['Hor_idActivo_dia2'] != ''){              $a .= ",'".$rowdata['Hor_idActivo_dia2']."'" ;       }else{$a .= ",''";}
				if(isset($rowdata['Hor_idActivo_dia3']) && $rowdata['Hor_idActivo_dia3'] != ''){              $a .= ",'".$rowdata['Hor_idActivo_dia3']."'" ;       }else{$a .= ",''";}
				if(isset($rowdata['Hor_idActivo_dia4']) && $rowdata['Hor_idActivo_dia4'] != ''){              $a .= ",'".$rowdata['Hor_idActivo_dia4']."'" ;       }else{$a .= ",''";}
				if(isset($rowdata['Hor_idActivo_dia5']) && $rowdata['Hor_idActivo_dia5'] != ''){              $a .= ",'".$rowdata['Hor_idActivo_dia5']."'" ;       }else{$a .= ",''";}
				if(isset($rowdata['Hor_idActivo_dia6']) && $rowdata['Hor_idActivo_dia6'] != ''){              $a .= ",'".$rowdata['Hor_idActivo_dia6']."'" ;       }else{$a .= ",''";}
				if(isset($rowdata['Hor_idActivo_dia7']) && $rowdata['Hor_idActivo_dia7'] != ''){              $a .= ",'".$rowdata['Hor_idActivo_dia7']."'" ;       }else{$a .= ",''";}
				if(isset($rowdata['Hor_Inicio_dia1']) && $rowdata['Hor_Inicio_dia1'] != ''){                  $a .= ",'".$rowdata['Hor_Inicio_dia1']."'" ;         }else{$a .= ",''";}
				if(isset($rowdata['Hor_Inicio_dia2']) && $rowdata['Hor_Inicio_dia2'] != ''){                  $a .= ",'".$rowdata['Hor_Inicio_dia2']."'" ;         }else{$a .= ",''";}
				if(isset($rowdata['Hor_Inicio_dia3']) && $rowdata['Hor_Inicio_dia3'] != ''){                  $a .= ",'".$rowdata['Hor_Inicio_dia3']."'" ;         }else{$a .= ",''";}
				if(isset($rowdata['Hor_Inicio_dia4']) && $rowdata['Hor_Inicio_dia4'] != ''){                  $a .= ",'".$rowdata['Hor_Inicio_dia4']."'" ;         }else{$a .= ",''";}
				if(isset($rowdata['Hor_Inicio_dia5']) && $rowdata['Hor_Inicio_dia5'] != ''){                  $a .= ",'".$rowdata['Hor_Inicio_dia5']."'" ;         }else{$a .= ",''";}
				if(isset($rowdata['Hor_Inicio_dia6']) && $rowdata['Hor_Inicio_dia6'] != ''){                  $a .= ",'".$rowdata['Hor_Inicio_dia6']."'" ;         }else{$a .= ",''";}
				if(isset($rowdata['Hor_Inicio_dia7']) && $rowdata['Hor_Inicio_dia7'] != ''){                  $a .= ",'".$rowdata['Hor_Inicio_dia7']."'" ;         }else{$a .= ",''";}
				if(isset($rowdata['Hor_Termino_dia1']) && $rowdata['Hor_Termino_dia1'] != ''){                $a .= ",'".$rowdata['Hor_Termino_dia1']."'" ;        }else{$a .= ",''";}
				if(isset($rowdata['Hor_Termino_dia2']) && $rowdata['Hor_Termino_dia2'] != ''){                $a .= ",'".$rowdata['Hor_Termino_dia2']."'" ;        }else{$a .= ",''";}
				if(isset($rowdata['Hor_Termino_dia3']) && $rowdata['Hor_Termino_dia3'] != ''){                $a .= ",'".$rowdata['Hor_Termino_dia3']."'" ;        }else{$a .= ",''";}
				if(isset($rowdata['Hor_Termino_dia4']) && $rowdata['Hor_Termino_dia4'] != ''){                $a .= ",'".$rowdata['Hor_Termino_dia4']."'" ;        }else{$a .= ",''";}
				if(isset($rowdata['Hor_Termino_dia5']) && $rowdata['Hor_Termino_dia5'] != ''){                $a .= ",'".$rowdata['Hor_Termino_dia5']."'" ;        }else{$a .= ",''";}
				if(isset($rowdata['Hor_Termino_dia6']) && $rowdata['Hor_Termino_dia6'] != ''){                $a .= ",'".$rowdata['Hor_Termino_dia6']."'" ;        }else{$a .= ",''";}
				if(isset($rowdata['Hor_Termino_dia7']) && $rowdata['Hor_Termino_dia7'] != ''){                $a .= ",'".$rowdata['Hor_Termino_dia7']."'" ;        }else{$a .= ",''";}
				//no esta en mantencion
				$a .= ",'2'" ;
				

				for ($i = 1; $i <= 50; $i++) {
					if(isset($rowdata['SensoresNombre_'.$i]) && $rowdata['SensoresNombre_'.$i] != ''){            $a .= ",'".$rowdata['SensoresNombre_'.$i]."'" ;       }else{$a .= ",''";}
					if(isset($rowdata['SensoresTipo_'.$i]) && $rowdata['SensoresTipo_'.$i] != ''){                $a .= ",'".$rowdata['SensoresTipo_'.$i]."'" ;         }else{$a .= ",''";}
					if(isset($rowdata['SensoresMedMin_'.$i]) && $rowdata['SensoresMedMin_'.$i] != ''){            $a .= ",'".$rowdata['SensoresMedMin_'.$i]."'" ;       }else{$a .= ",''";}
					if(isset($rowdata['SensoresMedMax_'.$i]) && $rowdata['SensoresMedMax_'.$i] != ''){            $a .= ",'".$rowdata['SensoresMedMax_'.$i]."'" ;       }else{$a .= ",''";}
					if(isset($rowdata['SensoresMedErrores_'.$i]) && $rowdata['SensoresMedErrores_'.$i] != ''){    $a .= ",'".$rowdata['SensoresMedErrores_'.$i]."'" ;   }else{$a .= ",''";}
					if(isset($rowdata['SensoresMedAlerta_'.$i]) && $rowdata['SensoresMedAlerta_'.$i] != ''){      $a .= ",'".$rowdata['SensoresMedAlerta_'.$i]."'" ;    }else{$a .= ",''";}
					if(isset($rowdata['SensoresGrupo_'.$i]) && $rowdata['SensoresGrupo_'.$i] != ''){              $a .= ",'".$rowdata['SensoresGrupo_'.$i]."'" ;        }else{$a .= ",''";}
					if(isset($rowdata['SensoresUniMed_'.$i]) && $rowdata['SensoresUniMed_'.$i] != ''){            $a .= ",'".$rowdata['SensoresUniMed_'.$i]."'" ;       }else{$a .= ",''";}
					if(isset($rowdata['SensoresActivo_'.$i]) && $rowdata['SensoresActivo_'.$i] != ''){            $a .= ",'".$rowdata['SensoresActivo_'.$i]."'" ;       }else{$a .= ",''";}
					
				}
					
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `telemetria_listado` (idSistema,idEstado,Identificador,Nombre,
				idCiudad, idComuna, Direccion, GeoLatitud, GeoLongitud, GeoVelocidad, GeoDireccion,
				GeoMovimiento, GeoTiempoDetencion, id_Geo, id_Sensores, cantSensores, idDispositivo, idShield,LimiteVelocidad, idAlarmaGeneral,
				NDetenciones, TiempoFueraLinea, TiempoDetencion, idZona, Direccion_img,SensorActivacionID, SensorActivacionValor,
				Hor_idActivo_dia1, Hor_idActivo_dia2, Hor_idActivo_dia3, Hor_idActivo_dia4, Hor_idActivo_dia5, Hor_idActivo_dia6, Hor_idActivo_dia7,
				Hor_Inicio_dia1, Hor_Inicio_dia2, Hor_Inicio_dia3, Hor_Inicio_dia4, Hor_Inicio_dia5, Hor_Inicio_dia6, Hor_Inicio_dia7,
				Hor_Termino_dia1, Hor_Termino_dia2, Hor_Termino_dia3, Hor_Termino_dia4, Hor_Termino_dia5, Hor_Termino_dia6, Hor_Termino_dia7 ,
				idMantencion
				".$qry.") 
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
					
					// elimino la tabla si es que existe
					$query  = "DROP TABLE IF EXISTS `telemetria_listado_tablarelacionada_".$ultimo_id."`";
					$result = mysqli_query($dbConn, $query);
					
					// se crea la nueva tabla
					$query  = "CREATE TABLE `telemetria_listado_tablarelacionada_".$ultimo_id."` (
					`idTabla` int(11) unsigned NOT NULL AUTO_INCREMENT,
					`idTelemetria` int(11) unsigned NOT NULL,
					`idContrato` int(11) unsigned NOT NULL,
					`idSolicitud` int(11) unsigned NOT NULL,
					`idZona` int(11) unsigned NOT NULL,
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
					`Sensor_1` decimal(20,6) NOT NULL,
					`Sensor_2` decimal(20,6) NOT NULL,
					`Sensor_3` decimal(20,6) NOT NULL,
					`Sensor_4` decimal(20,6) NOT NULL,
					`Sensor_5` decimal(20,6) NOT NULL,
					`Sensor_6` decimal(20,6) NOT NULL,
					`Sensor_7` decimal(20,6) NOT NULL,
					`Sensor_8` decimal(20,6) NOT NULL,
					`Sensor_9` decimal(20,6) NOT NULL,
					`Sensor_10` decimal(20,6) NOT NULL,
					`Sensor_11` decimal(20,6) NOT NULL,
					`Sensor_12` decimal(20,6) NOT NULL,
					`Sensor_13` decimal(20,6) NOT NULL,
					`Sensor_14` decimal(20,6) NOT NULL,
					`Sensor_15` decimal(20,6) NOT NULL,
					`Sensor_16` decimal(20,6) NOT NULL,
					`Sensor_17` decimal(20,6) NOT NULL,
					`Sensor_18` decimal(20,6) NOT NULL,
					`Sensor_19` decimal(20,6) NOT NULL,
					`Sensor_20` decimal(20,6) NOT NULL,
					`Sensor_21` decimal(20,6) NOT NULL,
					`Sensor_22` decimal(20,6) NOT NULL,
					`Sensor_23` decimal(20,6) NOT NULL,
					`Sensor_24` decimal(20,6) NOT NULL,
					`Sensor_25` decimal(20,6) NOT NULL,
					`Sensor_26` decimal(20,6) NOT NULL,
					`Sensor_27` decimal(20,6) NOT NULL,
					`Sensor_28` decimal(20,6) NOT NULL,
					`Sensor_29` decimal(20,6) NOT NULL,
					`Sensor_30` decimal(20,6) NOT NULL,
					`Sensor_31` decimal(20,6) NOT NULL,
					`Sensor_32` decimal(20,6) NOT NULL,
					`Sensor_33` decimal(20,6) NOT NULL,
					`Sensor_34` decimal(20,6) NOT NULL,
					`Sensor_35` decimal(20,6) NOT NULL,
					`Sensor_36` decimal(20,6) NOT NULL,
					`Sensor_37` decimal(20,6) NOT NULL,
					`Sensor_38` decimal(20,6) NOT NULL,
					`Sensor_39` decimal(20,6) NOT NULL,
					`Sensor_40` decimal(20,6) NOT NULL,
					`Sensor_41` decimal(20,6) NOT NULL,
					`Sensor_42` decimal(20,6) NOT NULL,
					`Sensor_43` decimal(20,6) NOT NULL,
					`Sensor_44` decimal(20,6) NOT NULL,
					`Sensor_45` decimal(20,6) NOT NULL,
					`Sensor_46` decimal(20,6) NOT NULL,
					`Sensor_47` decimal(20,6) NOT NULL,
					`Sensor_48` decimal(20,6) NOT NULL,
					`Sensor_49` decimal(20,6) NOT NULL,
					`Sensor_50` decimal(20,6) NOT NULL,
					  PRIMARY KEY (`idTabla`)
					) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COMMENT='Dinamica';";
					$result = mysqli_query($dbConn, $query);
					
					//Actualizo el nombre de la tabla relacionada
					$a = "tabla_relacionada='telemetria_listado_tablarelacionada_".$ultimo_id."'" ;
					$query  = "UPDATE `telemetria_listado` SET ".$a." WHERE idTelemetria = '$ultimo_id'";
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
						
					header( 'Location: '.$location.'&id='.$ultimo_id.'&created=true' );
					die;
				}
				
			}
			
		break;	
/*******************************************************************************************************************/		
		case 'mant_create':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idTelemetria='".$idTelemetria."'" ;
				if(isset($idEstado) && $idEstado != ''){                            $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idMantencion)&& $idMantencion != '' ){                    $a .= ",idMantencion='".$idMantencion."'" ;}
				if(isset($idUsuarioMan)&& $idUsuarioMan != '' ){                    $a .= ",idUsuarioMan='".$idUsuarioMan."'" ;}
				if(isset($idMatriz)&& $idMatriz != '' ){                            $a .= ",idMatriz='".$idMatriz."'" ;}
				if(isset($FechaMantencionIni)&& $FechaMantencionIni != '' ){        $a .= ",FechaMantencionIni='".$FechaMantencionIni."'" ;}
				if(isset($HoraMantencionIni)&& $HoraMantencionIni != '' ){          $a .= ",HoraMantencionIni='".$HoraMantencionIni."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `telemetria_listado` SET ".$a." WHERE idTelemetria = '$idTelemetria'";
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
				
				header( 'Location: '.$location.'&create=true&verify='.$idTelemetria );
				die;
			}
		
	
		break;	
/*******************************************************************************************************************/		
		case 'mant_reset':			
		
		//Se elimina la restriccion del sql 5.7
		mysqli_query($dbConn, "SET SESSION sql_mode = ''");
		
		//Traigo todos los valores	
		$a = "SensoresMant_1=''";
		for ($i = 1; $i <= 50; $i++) {
			$a .= ",SensoresMant_".$i."=''";

		}
			
			
		//se borran los datos
		$query  = "UPDATE `telemetria_listado` SET ".$a." WHERE idTelemetria = '".$_GET['verify']."'";
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
			
						
		header( 'Location: '.$location.'&reseted=true' );
		die;
		

		break;	
/*******************************************************************************************************************/		
		case 'mant_end':	
		
		//Se elimina la restriccion del sql 5.7
		mysqli_query($dbConn, "SET SESSION sql_mode = ''");
		
		/***************************************************************/
		//Se consultan los datos
		$subquery = '';
		for ($i = 1; $i <= 50; $i++) {
			$subquery .= ',SensoresMant_'.$i.' AS Tel_Sensor_Valor_'.$i;
		}

		// Se traen todos los datos de mi usuario
		$query = "SELECT 
		idTelemetria,
		idUsuarioMan,
		idMatriz,
		FechaMantencionIni,
		HoraMantencionIni

		".$subquery."

		FROM `telemetria_listado`
		WHERE idTelemetria = {$_GET['verify']}";
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
		$rowdata = mysqli_fetch_assoc ($resultado);
		
		
		/***************************************************************/
		//Se guardan los datos
		if(isset($rowdata['idTelemetria']) && $rowdata['idTelemetria'] != ''){              $a  = "'".$rowdata['idTelemetria']."'" ;          }else{$a ="''";}
		if(isset($rowdata['idUsuarioMan']) && $rowdata['idUsuarioMan'] != ''){              $a .= ",'".$rowdata['idUsuarioMan']."'" ;         }else{$a .= ",''";}
		if(isset($rowdata['idMatriz']) && $rowdata['idMatriz'] != ''){                      $a .= ",'".$rowdata['idMatriz']."'" ;             }else{$a .= ",''";}
		if(isset($rowdata['FechaMantencionIni']) && $rowdata['FechaMantencionIni'] != ''){  $a .= ",'".$rowdata['FechaMantencionIni']."'" ;   }else{$a .= ",''";}
		if(isset($rowdata['HoraMantencionIni']) && $rowdata['HoraMantencionIni'] != ''){    $a .= ",'".$rowdata['HoraMantencionIni']."'" ;    }else{$a .= ",''";}
		$a .= ",'".fecha_actual()."'" ;		
		$a .= ",'".hora_actual()."'" ;		
		$a .= ",'1'" ;	
		$a .= ",'Sin Observaciones'" ;	
		
		//Se guardan los datos en la tabla de mantenciones ejecutadas
		$in_qry = '';
		for ($i = 1; $i <= 50; $i++) {
			$in_qry .= ',SensoresMant_'.$i;
			$a .= ",'".$rowdata['Tel_Sensor_Valor_'.$i]."'" ;	
		}
		
		$query  = "INSERT INTO `telemetria_mantencion_ejecutada` (idTelemetria,idUsuarioMan,
		idMatriz,FechaMantencionIni,HoraMantencionIni,FechaMantencionTer,HoraMantencionTer,
		idEstado, Observacion
		".$in_qry."
		) 
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
		
		
		/***************************************************************/
		//Actualizo el estado y saco la maquina de mantencion
		$a = "idMantencion='2'";
		$a .= ",idEstado='1'";
			
		//se borran los datos
		$query  = "UPDATE `telemetria_listado` SET ".$a." WHERE idTelemetria = '".$rowdata['idTelemetria']."'";
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
			
						
		header( 'Location: '.$location.'&ended=true' );
		die;
		

		
		break;	
/*******************************************************************************************************************/		
		case 'mant_cancel':	
		
		//Se elimina la restriccion del sql 5.7
		mysqli_query($dbConn, "SET SESSION sql_mode = ''");
		
		/***************************************************************/
		//Se consultan los datos
		$subquery = '';
		for ($i = 1; $i <= 50; $i++) {
			$subquery .= ',SensoresMant_'.$i.' AS Tel_Sensor_Valor_'.$i;
		}

		// Se traen todos los datos de mi usuario
		$query = "SELECT 
		idTelemetria,
		idUsuarioMan,
		idMatriz,
		FechaMantencionIni,
		HoraMantencionIni

		".$subquery."

		FROM `telemetria_listado`
		WHERE idTelemetria = {$idTelemetria}";
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
		$rowdata = mysqli_fetch_assoc ($resultado);
		
		
		/***************************************************************/
		//Se guardan los datos
		if(isset($rowdata['idTelemetria']) && $rowdata['idTelemetria'] != ''){              $a  = "'".$rowdata['idTelemetria']."'" ;          }else{$a ="''";}
		if(isset($rowdata['idUsuarioMan']) && $rowdata['idUsuarioMan'] != ''){              $a .= ",'".$rowdata['idUsuarioMan']."'" ;         }else{$a .= ",''";}
		if(isset($rowdata['idMatriz']) && $rowdata['idMatriz'] != ''){                      $a .= ",'".$rowdata['idMatriz']."'" ;             }else{$a .= ",''";}
		if(isset($rowdata['FechaMantencionIni']) && $rowdata['FechaMantencionIni'] != ''){  $a .= ",'".$rowdata['FechaMantencionIni']."'" ;   }else{$a .= ",''";}
		if(isset($rowdata['HoraMantencionIni']) && $rowdata['HoraMantencionIni'] != ''){    $a .= ",'".$rowdata['HoraMantencionIni']."'" ;    }else{$a .= ",''";}
		$a .= ",'".fecha_actual()."'" ;		
		$a .= ",'".hora_actual()."'" ;		
		$a .= ",'2'" ;	
		$a .= ",'".$Observacion."'" ;	
		
		//Se guardan los datos en la tabla de mantenciones ejecutadas
		$in_qry = '';
		for ($i = 1; $i <= 50; $i++) {
			$in_qry .= ',SensoresMant_'.$i;
			$a .= ",'".$rowdata['Tel_Sensor_Valor_'.$i]."'" ;	
		}
		
		$query  = "INSERT INTO `telemetria_mantencion_ejecutada` (idTelemetria,idUsuarioMan,
		idMatriz,FechaMantencionIni,HoraMantencionIni,FechaMantencionTer,HoraMantencionTer,
		idEstado, Observacion
		".$in_qry."
		) 
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
		
		
		/***************************************************************/
		//Actualizo el estado y saco la maquina de mantencion
		$a = "idMantencion='2'";
		$a .= ",idEstado='1'";
			
		//se borran los datos
		$query  = "UPDATE `telemetria_listado` SET ".$a." WHERE idTelemetria = '".$rowdata['idTelemetria']."'";
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
			
						
		header( 'Location: '.$location.'&ended=true' );
		die;
		

		
		break;	

/*******************************************************************************************************************/
		//Cambio el estado de activo a inactivo
		case 'EstadoEncendido':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//variables
			$idTelemetria       = $_GET['idTelemetria'];
			$idEstadoEncendido  = $_GET['idEstadoEncendido'];
			$idUsuario          = $_SESSION['usuario']['basic_data']['idUsuario'];
			$Fecha              = fecha_actual();
			$Hora               = hora_actual();
			$TimeStamp          = fecha_actual().' '.hora_actual();
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica el tipo de usuario
			if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
				//Se verifica si el dato existe
				if(isset($idTelemetria)&&$idTelemetria!=''){
					$ndata_1 = db_select_nrows ('idTelemetria', 'usuarios_equipos_telemetria', '', "idTelemetria='".$idTelemetria."' AND idUsuario='".$idUsuario."'", $dbConn);
				}
				//generacion de errores
				if($ndata_1==0) {$error['ndata_1'] = 'error/No tiene permiso para la edicion de este equipo de telemetria';}
			}
			/*******************************************************************/
			
				
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$query  = "UPDATE telemetria_listado SET idEstadoEncendido = '$idEstadoEncendido'	
				WHERE idTelemetria    = '$idTelemetria'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//filtros
					if(isset($idTelemetria) && $idTelemetria != ''){            $a  = "'".$idTelemetria."'" ;         }else{$a  ="''";}
					if(isset($Fecha) && $Fecha != ''){                          $a .= ",'".$Fecha."'" ;               }else{$a .=",''";}
					if(isset($Hora) && $Hora != ''){                            $a .= ",'".$Hora."'" ;                }else{$a .=",''";}
					if(isset($TimeStamp) && $TimeStamp != ''){                  $a .= ",'".$TimeStamp."'" ;           }else{$a .=",''";}
					if(isset($idEstadoEncendido) && $idEstadoEncendido != ''){  $a .= ",'".$idEstadoEncendido."'" ;   }else{$a .=",''";}
					if(isset($idUsuario) && $idUsuario != ''){                  $a .= ",'".$idUsuario."'" ;           }else{$a .=",''";}
					
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `telemetria_listado_historial_encendidos` (idTelemetria, Fecha, Hora, TimeStamp,
					idEstadoEncendido, idUsuario) VALUES ({$a} )";
					//Consulta
					$result = mysqli_query ($dbConn, $query);
					//Si ejecuto correctamente la consulta
					if($result){
						
						try {
							if(!is_writable('upload/equipo_tel_'.$idTelemetria.'.json')){
								//Contenido del archivo
								$content = '{"sensor": "'.$idEstadoEncendido.'"}';
								//creacion del archivo
								file_put_contents('upload/equipo_tel_'.$idTelemetria.'.json', $content, FILE_APPEND | LOCK_EX);
							}else{
								//Elimino el archivo
								unlink('upload/equipo_tel_'.$idTelemetria.'.json');
								//Contenido del archivo
								$content = '{"sensor": "'.$idEstadoEncendido.'"}';
								//creacion del archivo
								file_put_contents('upload/equipo_tel_'.$idTelemetria.'.json', $content, FILE_APPEND | LOCK_EX);	
							}
						}catch(Exception $e) { 
							//guardar el dato en un archivo log
						}
						//Redirijo
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
