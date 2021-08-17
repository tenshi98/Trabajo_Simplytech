<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                    Se llama a la clase de la que se hereda                                      */
/*                                                                                                                 */
/*******************************************************************************************************************/
require_once '../A2XRXS_gears/xrxs_funciones/Components.UI.FormInputs.php';
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
		if ($filter!='0'){$filtro .="WHERE ".$filter;	}
		
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
		if ($filter!='0'){$filtro .="WHERE ".$filter;	}
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
	/*******************************************************************************************************************/
	public function form_input_validate($placeholder,$name, $value, $required, $aValidar){
		
		//Validacion de variables
		if($value==''){$w='';}else{$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		
		//generacion del input
		$input = '
			<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-sm-4" id="label_'.$name.'">'.$placeholder.'</label>
				<div class="col-sm-8 field autocomplete">
					<input type="text" placeholder="'.$placeholder.'" class="form-control"  name="'.$name.'" id="'.$name.'" value="'.$w.'"  '.$x.' onkeypress="return soloLetras(event)" autocomplete="off">
					<input type="hidden" name="rev_'.$name.'" id="rev_'.$name.'" value="'.$aValidar.'" >
				</div>
			</div>';	
		
		//ejecucion script		
		$input .= '
				<script>
				function autocomplete(inp, arr) {
					/*the autocomplete function takes two arguments,
					the text field element and an array of possible autocompleted values:*/
					var currentFocus;
					/*execute a function when someone writes in the text field:*/
					inp.addEventListener("input", function(e) {
						var a, b, i, val = this.value;
						/*close any already open lists of autocompleted values*/
						closeAllLists();
						if (!val) { return false;}
						currentFocus = -1;
						/*create a DIV element that will contain the items (values):*/
						a = document.createElement("DIV");
						a.setAttribute("id", this.id + "autocomplete-list");
						a.setAttribute("class", "autocomplete-items");
						/*append the DIV element as a child of the autocomplete container:*/
						this.parentNode.appendChild(a);
						/*for each item in the array...*/
						for (i = 0; i < arr.length; i++) {
							/*check if the item starts with the same letters as the text field value:*/
							if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
								/*create a DIV element for each matching element:*/
								b = document.createElement("DIV");
								/*make the matching letters bold:*/
								b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
								b.innerHTML += arr[i].substr(val.length);
								/*insert a input field that will hold the current array items value:*/
								b.innerHTML += "<input type=\'hidden\' value=\'" + arr[i] + "\'>";
								/*execute a function when someone clicks on the item value (DIV element):*/
								b.addEventListener("click", function(e) {
									/*insert the value for the autocomplete text field:*/
									inp.value = this.getElementsByTagName("input")[0].value;
									/*close the list of autocompleted values,
									(or any other open lists of autocompleted values:*/
									closeAllLists();
								});
							a.appendChild(b);
							}
						}
					});
					/*execute a function presses a key on the keyboard:*/
					inp.addEventListener("keydown", function(e) {
						var x = document.getElementById(this.id + "autocomplete-list");
						if (x) x = x.getElementsByTagName("div");
						if (e.keyCode == 40) {
							/*If the arrow DOWN key is pressed,
							increase the currentFocus variable:*/
							currentFocus++;
							/*and and make the current item more visible:*/
							addActive(x);
						} else if (e.keyCode == 38) { //up
							/*If the arrow UP key is pressed,
							decrease the currentFocus variable:*/
							currentFocus--;
							/*and and make the current item more visible:*/
							addActive(x);
						} else if (e.keyCode == 13) {
							/*If the ENTER key is pressed, prevent the form from being submitted,*/
							e.preventDefault();
							if (currentFocus > -1) {
								/*and simulate a click on the "active" item:*/
								if (x) x[currentFocus].click();
							}
						}
					});
					function addActive(x) {
						/*a function to classify an item as "active":*/
						if (!x) return false;
						/*start by removing the "active" class on all items:*/
						removeActive(x);
						if (currentFocus >= x.length) currentFocus = 0;
						if (currentFocus < 0) currentFocus = (x.length - 1);
						/*add class "autocomplete-active":*/
						x[currentFocus].classList.add("autocomplete-active");
					}
					function removeActive(x) {
						/*a function to remove the "active" class from all autocomplete items:*/
						for (var i = 0; i < x.length; i++) {
						  x[i].classList.remove("autocomplete-active");
						}
					}
					function closeAllLists(elmnt) {
						/*close all autocomplete lists in the document,
						except the one passed as an argument:*/
						var x = document.getElementsByClassName("autocomplete-items");
						for (var i = 0; i < x.length; i++) {
						  if (elmnt != x[i] && elmnt != inp) {
							x[i].parentNode.removeChild(x[i]);
						  }
						}
					}
					/*execute a function when someone clicks in the document:*/
					document.addEventListener("click", function (e) {
						closeAllLists(e.target);
					});
				}';
				
			$input .= '
				/*An array containing all the country names in the world:*/
				var vali_val = [""';
				
				//limpio y separo los datos de la cadena de comprobacion
				$obligatorios = str_replace(' ', '', $aValidar);
				$piezas = explode(",", $obligatorios);
				//recorro los elementos
				foreach ($piezas as $validd) {
					$input .= ',"'.$validd.'"';
				}		
				
				
			$input .= '];

			/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
			autocomplete(document.getElementById("'.$name.'"), vali_val);
		</script>';
				
		//Imprimir dato	
		echo $input;
	}
	
}

?>
