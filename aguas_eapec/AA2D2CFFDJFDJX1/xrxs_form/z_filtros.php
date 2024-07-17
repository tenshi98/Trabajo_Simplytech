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
	if ( !empty($_POST['idBodega']) )            $idBodega             = $_POST['idBodega'];
	if ( !empty($_POST['idProducto']) )          $idProducto           = $_POST['idProducto'];
	if ( !empty($_POST['f_inicio']) )            $f_inicio             = $_POST['f_inicio'];
	if ( !empty($_POST['f_termino']) )           $f_termino            = $_POST['f_termino'];
	if ( !empty($_POST['Creacion_ano']) )        $Creacion_ano         = $_POST['Creacion_ano'];
	if ( !empty($_POST['Creacion_mes']) )        $Creacion_mes         = $_POST['Creacion_mes'];
	if ( !empty($_POST['idProveedor']) )         $idProveedor          = $_POST['idProveedor'];
	if ( !empty($_POST['idCliente']) )           $idCliente            = $_POST['idCliente'];
	if ( !empty($_POST['idBodegaOrigen']) )      $idBodegaOrigen       = $_POST['idBodegaOrigen'];
	if ( !empty($_POST['idSistemaDestino']) )    $idSistemaDestino     = $_POST['idSistemaDestino'];
	if ( !empty($_POST['idBodegaDestino']) )     $idBodegaDestino      = $_POST['idBodegaDestino'];
	if ( !empty($_POST['idTrabajador']) )        $idTrabajador         = $_POST['idTrabajador'];
	if ( !empty($_POST['idTipo']) )              $idTipo               = $_POST['idTipo'];
	if ( !empty($_POST['idMaquina']) )           $idMaquina            = $_POST['idMaquina'];
	if ( !empty($_POST['idEstado']) )            $idEstado             = $_POST['idEstado'];
	if ( !empty($_POST['N_Doc']) )               $N_Doc                = $_POST['N_Doc'];
	if ( !empty($_POST['idDocPago']) )           $idDocPago            = $_POST['idDocPago'];
	if ( !empty($_POST['N_DocPago']) )           $N_DocPago            = $_POST['N_DocPago'];
	if ( !empty($_POST['f_inicio_p']) )          $f_inicio_p           = $_POST['f_inicio_p'];
	if ( !empty($_POST['f_termino_p']) )         $f_termino_p          = $_POST['f_termino_p'];
	if ( !empty($_POST['idSistema']) )           $idSistema            = $_POST['idSistema'];
	if ( !empty($_POST['f_muestra_inicio']) )    $f_muestra_inicio     = $_POST['f_muestra_inicio'];
	if ( !empty($_POST['f_muestra_termino']) )   $f_muestra_termino    = $_POST['f_muestra_termino'];
	if ( !empty($_POST['f_recibida_inicio']) )   $f_recibida_inicio    = $_POST['f_recibida_inicio'];
	if ( !empty($_POST['f_recibida_termino']) )  $f_recibida_termino   = $_POST['f_recibida_termino'];
	if ( !empty($_POST['idSector']) )            $idSector             = $_POST['idSector'];
	if ( !empty($_POST['idPuntoMuestreo']) )     $idPuntoMuestreo      = $_POST['idPuntoMuestreo'];
	if ( !empty($_POST['idTipoMuestra']) )       $idTipoMuestra        = $_POST['idTipoMuestra'];
	if ( !empty($_POST['idParametros']) )        $idParametros         = $_POST['idParametros'];
	if ( !empty($_POST['idSigno']) )             $idSigno              = $_POST['idSigno'];
	if ( !empty($_POST['idLaboratorio']) )       $idLaboratorio        = $_POST['idLaboratorio'];
	if ( !empty($_POST['idFacturable']) )        $idFacturable         = $_POST['idFacturable'];
	
	

/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'filtro_por_fechas':

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Genero el filtro
				$q = '';
				if(isset($idBodega) && $idBodega != '') {                       $q .= '&idBodega='.$idBodega ; }
				if(isset($idProducto) && $idProducto != '') {                   $q .= '&idProducto='.$idProducto ; }
				if(isset($f_inicio) && $f_inicio != '') {                       $q .= '&f_inicio='.$f_inicio ; }
				if(isset($f_termino) && $f_termino != '') {                     $q .= '&f_termino='.$f_termino ; }
				if(isset($Creacion_ano) && $Creacion_ano != '') {               $q .= '&Creacion_ano='.$Creacion_ano ; }
				if(isset($Creacion_mes) && $Creacion_mes != '') {               $q .= '&Creacion_mes='.$Creacion_mes ; }
				if(isset($idProveedor) && $idProveedor != '') {                 $q .= '&idProveedor='.$idProveedor ; }
				if(isset($idCliente) && $idCliente != '') {                     $q .= '&idCliente='.$idCliente ; }
				if(isset($idBodegaOrigen) && $idBodegaOrigen != '') {           $q .= '&idBodegaOrigen='.$idBodegaOrigen ; }
				if(isset($idSistemaDestino) && $idSistemaDestino != '') {       $q .= '&idSistemaDestino='.$idSistemaDestino ; }
				if(isset($idBodegaDestino) && $idBodegaDestino != '') {         $q .= '&idBodegaDestino='.$idBodegaDestino ; }
				if(isset($idTrabajador) && $idTrabajador != '') {               $q .= '&idTrabajador='.$idTrabajador ; }
				if(isset($idTipo) && $idTipo != '') {                           $q .= '&idTipo='.$idTipo ; }
				if(isset($idMaquina) && $idMaquina != '') {                     $q .= '&idMaquina='.$idMaquina ; }
				if(isset($idEstado) && $idEstado != '') {                       $q .= '&idEstado='.$idEstado ; }
				if(isset($N_Doc) && $N_Doc != '') {                             $q .= '&N_Doc='.$N_Doc ; }
				if(isset($idDocPago) && $idDocPago != '') {                     $q .= '&idDocPago='.$idDocPago ; }
				if(isset($N_DocPago) && $N_DocPago != '') {                     $q .= '&N_DocPago='.$N_DocPago ; }
				if(isset($f_inicio_p) && $f_inicio_p != '') {                   $q .= '&f_inicio_p='.$f_inicio_p ; }
				if(isset($f_termino_p) && $f_termino_p != '') {                 $q .= '&f_termino_p='.$f_termino_p ; }
				if(isset($idSistema) && $idSistema != '') {                     $q .= '&idSistema='.$idSistema ; }
				if(isset($f_muestra_inicio) && $f_muestra_inicio != '') {       $q .= '&f_muestra_inicio='.$f_muestra_inicio ; }
				if(isset($f_muestra_termino) && $f_muestra_termino != '') {     $q .= '&f_muestra_termino='.$f_muestra_termino ; }
				if(isset($f_recibida_inicio) && $f_recibida_inicio != '') {     $q .= '&f_recibida_inicio='.$f_recibida_inicio ; }
				if(isset($f_recibida_termino) && $f_recibida_termino != '') {   $q .= '&f_recibida_termino='.$f_recibida_termino ; }
				if(isset($idSector) && $idSector != '') {                       $q .= '&idSector='.$idSector ; }
				if(isset($idPuntoMuestreo) && $idPuntoMuestreo != '') {         $q .= '&idPuntoMuestreo='.$idPuntoMuestreo ; }
				if(isset($idTipoMuestra) && $idTipoMuestra != '') {             $q .= '&idTipoMuestra='.$idTipoMuestra ; }
				if(isset($idParametros) && $idParametros != '') {               $q .= '&idParametros='.$idParametros ; }
				if(isset($idSigno) && $idSigno != '') {                         $q .= '&idSigno='.$idSigno ; }
				if(isset($idLaboratorio) && $idLaboratorio != '') {             $q .= '&idLaboratorio='.$idLaboratorio ; }
				if(isset($idFacturable) && $idFacturable != '') {             $q .= '&idFacturable='.$idFacturable ; }
				

				
				
	
				header( 'Location: '.$location.$q );
				die;
				
			}
	
		break;
	
/*******************************************************************************************************************/
	}
?>
