<?php 
/*****************************************************************************************************************/
/*                                         Se arma la interfaz                                                   */
/*****************************************************************************************************************/
//INTERFACES
switch ($_SESSION['usuario']['basic_data']['idInterfaz']) {
    
    case 1: include '1include_principal_interfaz_1.php'; break;//Interfaz Nueva v1
    case 2: include '1include_principal_interfaz_2.php'; break;//Interfaz Antigua
    case 3: include '1include_principal_interfaz_3.php'; break;//Interfaz Nueva v2
    case 4: include '1include_principal_interfaz_4.php'; break;//Interfaz Solo telemetria
    case 5: include '1include_principal_interfaz_5.php'; break;//Interfaz CrossChecking
    case 6: include '1include_principal_interfaz_6.php'; break;//Interfaz CrossTech
    case 7: include '1include_principal_interfaz_7.php'; break;//Interfaz Intranet CrossTech
    case 8: include '1include_principal_interfaz_8.php'; break;//Interfaz Seguridad Vecinal
}
?>

