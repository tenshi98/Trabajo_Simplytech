<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                  Funciones                                                      */
/*                                                                                                                 */
/*******************************************************************************************************************/
class Form_Inputs extends Basic_Form_Inputs{

	/*******************************************************************************************************************/
	public function form_select_temporada($placeholder,$name, $value, $required, $data){

		//Validacion de variables
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
			
		//generacion del input
		$input = '
			<div class="form-group" id="div_'.$name.'">
				<label for="text2" class="control-label col-sm-4" id="label_'.$name.'">'.$placeholder.'</label>
				<div class="col-sm-8 field">
					<select name="'.$name.'" id="'.$name.'" class="form-control" '.$x.' >
					<option value="" selected>Seleccione una Opcion</option>';
					//pongo rango de +4 y -4
					$desde = $data - 4;
					$hasta = $data + 4;
					for ($i = $desde; $i <= $hasta; $i++) {
						$w = '';
						$x = $i+1;
						$xdata = $i.' - '.$x;
						if($value==$xdata){
							$w .= 'selected="selected"';
						}
						$input .= '<option value="'.$xdata.'" '.$w.' >'.$xdata.'</option>';
					}
						
					$input .= '
					</select>
				</div>
			</div>';
		
		//Imprimir dato	
		echo $input;

	}
	/*******************************************************************************************************************/
	public function form_select_temporada_2($placeholder,$name, $value, $required, $data){

		//Validacion de variables
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
			
		//generacion del input
		$input = '
			<div class="form-group" id="div_'.$name.'">
				<label for="text2" class="control-label col-sm-4" id="label_'.$name.'">'.$placeholder.'</label>
				<div class="col-sm-8 field">
					<select name="'.$name.'" id="'.$name.'" class="form-control" '.$x.' >
						<option value="" selected>Seleccione una Opcion</option>';
						//pongo rango de +4 y -4
						$desde = $data;
						$hasta = $data;
						for ($i = $desde; $i <= $hasta; $i++) {
							$w = '';
							$x = $i+1;
							$xdata = $i.' - '.$x;
							if($value==$xdata){
								$w .= 'selected="selected"';
							}
							$input .= '<option value="'.$xdata.'" '.$w.' >'.$xdata.'</option>';
						}
						
					$input .= '
					</select>
				</div>
			</div>';
			
		//Imprimir dato	
		echo $input;

	}
	/*******************************************************************************************************************/
	public function form_visualizacion($placeholder,$name, $value, $required, $data1, $data2, $table, $filter, $dbConn){

		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
		//FILTRO
		$filtro = '';
		if ($filter!='0'){$filtro .="WHERE ".$filter." ";	}
		
		//se trae un listado con todas las categorias
		$arrSelect = array();
		$query = "SELECT  
		".$data1." AS idData, 
		".$data2." AS Nombre
		FROM `".$table."` 
		".$filtro." 
		ORDER BY Nombre";
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
		//Si ejecuto correctamente la consulta
		if($resultado){
			while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrSelect,$row );
			}
			mysqli_free_result($resultado);
			
			$input = '<div class="form-group" id="div_'.$name.'">
						<label for="text2" class="control-label col-sm-4">'.$placeholder.'</label>
						<div class="col-sm-8 field">
						<select name="'.$name.'" id="'.$name.'" class="form-control" '.$x.' >
						<option value="" selected>Seleccione una Opcion</option>';
						
			$w1 = '';
			$w2 = '';
			if($value==9998){
				$w1 = 'selected="selected"';
			}elseif($value==9999){
				$w2 = 'selected="selected"';
			}			
			$input .= '<option value="9998" '.$w1.' >Todos</option>';
			$input .= '<option value="9999" '.$w2.'>Solo Superadministradores</option>';
										

			
			
						
						foreach ( $arrSelect as $select ) {
							$w = '';
							if($value==$select['idData']){
								$w .= 'selected="selected"';
							} 	
			$input .= '<option value="'.$select['idData'].'" '.$w.' >'.$select['Nombre'].'</option>';
						 } 
			$input .= '</select>
						</div>
					</div>';
					
			echo $input;
			
		//si da error, guardar en el log de errores una copia
		}else{
			//Genero numero aleatorio
			$vardata = genera_password(8,'alfanumerico');
			
			//Guardo el error en una variable temporal
			$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
			$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
			$_SESSION['ErrorListing'][$vardata]['query']        = $query;
			
			//Devuelvo mensaje
			echo '<p>Error en la consulta, consulte con el administrador</p>';			
		}

		
	}
	/*******************************************************************************************************************/
	public function form_select_sys($placeholder,$name, $value, $required, $data1, $data2, $table, $filter, $dbConn){

		//si dato es requerido
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
		//Filtro para el where
		$filtro = '';
		if ($filter!='0'){$filtro .="WHERE ".$filter." ";	}
		//explode para poder crear cadena
		$datos = explode(",", $data2);
		if(count($datos)==1){
			$data_required = ','.$datos[0].' AS '.$datos[0];
			$order_by = $datos[0].' ASC ';
			if($filter!=''){$filtro .=" AND ".$datos[0]."!='' ";}elseif($filter==''){$filtro .="WHERE ".$datos[0]."!='' ";}
		}else{
			$data_required = '';
			$order_by = $datos[0].' ASC ';
			if($filter!=''){$filtro .=" AND ".$datos[0]."!='' ";}elseif($filter==''){$filtro .="WHERE ".$datos[0]."!='' ";}
			foreach($datos as $dato){
				$data_required .= ','.$dato.' AS '.$dato;
			}
		}

		//se trae un listado con todas las categorias
		$arrSelect = array();
		$query = "SELECT  
		".$data1." AS idData 
		".$data_required."
		FROM `".$table."`  
		".$filtro."
		ORDER BY ".$order_by;
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
		//Si ejecuto correctamente la consulta
		if($resultado){
			while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrSelect,$row );
			}
			mysqli_free_result($resultado);
			
			$input = '<div class="form-group" id="div_'.$name.'">
						<label for="text2" class="control-label col-sm-4" id="label_'.$name.'">'.$placeholder.'</label>
						<div class="col-sm-8 field">
						<select name="'.$name.'" id="'.$name.'" class="form-control" '.$x.' >
						<option value="" selected>Seleccione una Opcion</option>';
					   
						$w = '';
						if($value==9999){
							$w .= 'selected="selected"';
						}   
			$input .= '<option value="9999" '.$w.' >Todos</option>';
						
						foreach ( $arrSelect as $select ) {
							$w = '';
							if($value==$select['idData']){
								$w .= 'selected="selected"';
							}  	
							if(count($datos)==1){
								$data_writing = $select[$datos[0]].' ';
							}else{
								$data_writing = '';
								foreach($datos as $dato){
									$data_writing .= $select[$dato].' ';
								}
							}
			$input .= '<option value="'.$select['idData'].'" '.$w.' >'.$data_writing.'</option>';
						 } 
			$input .= '</select>
						</div>
					</div>';
					
			
			echo $input;
			
		//si da error, guardar en el log de errores una copia
		}else{
			//Genero numero aleatorio
			$vardata = genera_password(8,'alfanumerico');
			
			//Guardo el error en una variable temporal
			$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
			$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
			$_SESSION['ErrorListing'][$vardata]['query']        = $query;
			
			//Devuelvo mensaje
			echo '<p>Error en la consulta, consulte con el administrador</p>';			
		}

		
	}
	
}

?>
