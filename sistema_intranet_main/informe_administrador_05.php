<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Web.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "informe_administrador_05.php";
$location = $original;
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
?>

<script type="text/javascript">
    var int=self.setInterval("refresh()",60000);
    function refresh()
    {
       location.reload(true);
    }
</script>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

             
  

/*****************************************************************************************************************/
/*                                   Conexxiones a las bases de datos                              */
/*****************************************************************************************************************/
//Funcion para conectarse
function conectarDB ($servidor, $usuario, $password, $base_datos) {
	$db_con = mysqli_connect($servidor, $usuario, $password, $base_datos);
	$db_con->set_charset("utf8");
	return $db_con; 
}

//Bases de Datos
$BasesDatos = array();	
$BasesDatos[1] = 'exilon36_pe_aerosan';
$BasesDatos[2] = 'exilon36_pe_agrofruta';
$BasesDatos[3] = 'exilon36_pe_hendaya';
$BasesDatos[4] = 'exilon36_cm_ironmountain';
//$BasesDatos[5] = 'exilon36_pe_lasmoras';
$BasesDatos[6] = 'exilon36_pe_storbox';


$DB_Servidor = 'localhost';
$DB_Usuario  = 'exilon36_admin';
$DB_Pass     = 'Inicio1*';

//Conexiones
$dbConn1 = conectarDB($DB_Servidor, $DB_Usuario, $DB_Pass, $BasesDatos[1]);
$dbConn2 = conectarDB($DB_Servidor, $DB_Usuario, $DB_Pass, $BasesDatos[2]);
$dbConn3 = conectarDB($DB_Servidor, $DB_Usuario, $DB_Pass, $BasesDatos[3]);
$dbConn4 = conectarDB($DB_Servidor, $DB_Usuario, $DB_Pass, $BasesDatos[4]);
//$dbConn5 = conectarDB($DB_Servidor, $DB_Usuario, $DB_Pass, $BasesDatos[5]);
$dbConn6 = conectarDB($DB_Servidor, $DB_Usuario, $DB_Pass, $BasesDatos[6]);


/*****************************************************************************************************************/
/*                                   Visualizacion de los widget de geolocalizacion                              */
/*****************************************************************************************************************/

echo '<h3 class="supertittle text-primary">Aerosan</h3>';
//Variables
$arreglo = array();
$arreglo[1] = 'si'; //recorrerlo
$arreglo[2] = 'http://aerosan.exilon360.com/upload/'; //carpeta de imagenes del sitio
//Se llama a los widget
echo widget_Equipos('Equipo', 2, 0,'#', 1, 1, 1, $dbConn1);
echo widget_Resumen_equipo('Ultimas Mediciones del equipo', 2, 0, $arreglo[2], 1, 1, 1, $dbConn1);
/*****************************************************************************************************************/

echo '<h3 class="supertittle text-primary">Agrofruta</h3>';
//Variables
$arreglo = array();
$arreglo[1] = 'si'; //recorrerlo
$arreglo[2] = 'http://agrofruta.exilon360.com/upload/'; //carpeta de imagenes del sitio
//Se llama a los widget
echo widget_Equipos('Equipo', 2, 0,'#', 1, 1, 1, $dbConn2);
echo widget_Resumen_equipo('Ultimas Mediciones del equipo', 2, 0, $arreglo[2], 1, 1, 1, $dbConn2);
/*****************************************************************************************************************/

echo '<h3 class="supertittle text-primary">Hendaya</h3>';
echo widget_GPS_equipos('Mapa GPS','Colegios', 2, 2, 1,$_SESSION['usuario']['basic_data']['Config_IDGoogle'],1,1,$dbConn3);
echo widget_Resumen_GPS_equipos('Colegios', 2, 1, 1, 1, $dbConn3);

/*****************************************************************************************************************/

echo '<h3 class="supertittle text-primary">Ironmountain</h3>';
//Variables
$arreglo = array();
$arreglo[1] = 'si'; //recorrerlo
$arreglo[2] = 'http://ironmountain.exilon360.com/upload/'; //carpeta de imagenes del sitio
//Se llama a los widget
echo widget_Equipos('Equipo', 2, 0,'#', 1, 1, 1, $dbConn4);
echo widget_Resumen_equipo('Ultimas Mediciones del equipo', 2, 0, $arreglo[2], 1, 1, 1, $dbConn4);
/*****************************************************************************************************************/

/*echo '<h3 class="supertittle text-primary">Las Moras</h3>';
echo widget_GPS_equipos('Mapa GPS','Controles', 2, 2, 1,$_SESSION['usuario']['basic_data']['Config_IDGoogle'], 1,1,$dbConn5);
echo widget_Resumen_GPS_equipos('Controles', 2, 1, 1, 1, $dbConn5);							

/*****************************************************************************************************************/

echo '<h3 class="supertittle text-primary">Storbox</h3>';
//Variables
$arreglo = array();
$arreglo[1] = 'si'; //recorrerlo
$arreglo[2] = 'http://storbox.exilon360.com/upload/'; //carpeta de imagenes del sitio
//Se llama a los widget
echo widget_Equipos('Equipo', 2, 0,'#', 1, 1, 1, $dbConn6);
echo widget_Resumen_equipo('Ultimas Mediciones del equipo', 2, 0, $arreglo[2], 1, 1, 1, $dbConn6);



?>           
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
