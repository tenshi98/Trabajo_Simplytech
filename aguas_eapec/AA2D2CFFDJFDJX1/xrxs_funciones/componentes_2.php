<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                                  Funciones                                                      */
/*******************************************************************************************************************/
function submit($nombre, $valor){	
	$input = '<input type="submit" name="'.$nombre.'" class="btn btn-lg btn-primary btn-block" value="'.$valor.'" />';
	return $input;
}
/*******************************************************************************************************************/
function fancyBox($width, $height,$web,$funcion){	

	$input .= '<script type="text/javascript" src="assets/js/jquery.fancybox.js"></script>';
	$input .= '<link rel="stylesheet" type="text/css" href="assets/css/fancybox/jquery.fancybox.css" media="screen" />';
	$input .= "<script type='text/javascript'>
					$(document).ready(function() {
						$('.fancybox').fancybox({
							type: 'iframe',
							'width':".$width.",
							'height':".$height.",
							'autoSize' : false,
							afterClose: function () { 
								//parent.location.reload(false);
								".$funcion."
							}
						});
					});
				</script>";
	$input .= '<a title="Ver Informacion"  class="icon-ver info-tooltip fancybox fancybox.iframe" href="'.$web.'"></a>';
	
	return $input;
}
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                                                                                 */
/*                                            INPUT NORMALES                                                       */
/*                                                                                                                 */
/*                                                                                                                 */
/*******************************************************************************************************************/
function input($type,$placeholder,$name, $value, $required){
	if($value==0){$w='';}elseif($value!=0){$w=$value;}
	if($required==1){$x='';}elseif($required==2){$x='required';}	
	$input = '<input class="form-control" type="'.$type.'" placeholder="'.$placeholder.'"  name="'.$name.'" value="'.$w.'" '.$x.' >';	
	return $input;
}
/*******************************************************************************************************************/
function input_text($type,$placeholder,$name,$required,$extra_class,$style){
	
	if($required==1){$x='';}elseif($required==2){$x='required';}	
	$input = '<input class="form-control '.$extra_class.'" style="'.$style.'" "type="'.$type.'" placeholder="'.$placeholder.'"  name="'.$name.'" id="'.$name.'"  '.$x.' >';	
	return $input;
}
/*******************************************************************************************************************/
function input_text_val($type,$placeholder,$name,$required,$extra_class,$style,$value){
	if($value==''){$w='';}else{$w=$value;}
	if($required==1){$x='';}elseif($required==2){$x='required';}	
	$input = '<input class="form-control '.$extra_class.'" style="'.$style.'" type="'.$type.'" placeholder="'.$placeholder.'"  name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' >';	
	return $input;
}
/*******************************************************************************************************************/
function input_values($type,$placeholder,$name,$required,$extra_class,$style){
	if($required==1){$x='';}elseif($required==2){$x='required';}	
	
	$input ='<input placeholder="'.$placeholder.'"  class="form-control '.$extra_class.'" style="'.$style.'" type="'.$type.'" name="'.$name.'" id="'.$name.'"  '.$x.' onkeypress="return isNumberKey(event)"  >
              ';
			
	$input .= '<script>
				
				  <!--
				  function isNumberKey(evt)
				  {
					var charCode = (evt.which) ? evt.which : event.keyCode
					if (charCode > 31 && (charCode < 48 || charCode > 57)){
						//verifico si presiono el punto
						if (charCode == 46) {
							return true;
						}else{
							return false;
						}
					}else{
						return true;
					}
				  }
				  //-->
 
				</script>';
	
	return $input;
}
/*******************************************************************************************************************/
function input_values_val($type,$placeholder,$name,$required,$extra_class,$style,$value){
	if($value==''){$w='';}else{$w=$value;}
	if($required==1){$x='';}elseif($required==2){$x='required';}	
	
	$input ='<input placeholder="'.$placeholder.'"  class="form-control '.$extra_class.'" style="'.$style.'" type="'.$type.'" name="'.$name.'" id="'.$name.'"  '.$x.' onkeypress="return isNumberKey(event)" value="'.$w.'" >
              ';
			
	$input .= '<script>
				
				  <!--
				  function isNumberKey(evt)
				  {
					var charCode = (evt.which) ? evt.which : event.keyCode
					if (charCode > 31 && (charCode < 48 || charCode > 57)){
						//verifico si presiono el punto
						if (charCode == 46) {
							return true;
						}else{
							return false;
						}
					}else{
						return true;
					}
				  }
				  //-->
 
				</script>';
	
	return $input;
}
 
/*******************************************************************************************************************/
function input_select($placeholder,$name, $required, $data1, $data2, $table, $filter,$style, $dbConn){

	//si dato es requerido
	if($required==1){$x='';}elseif($required==2){$x='required';}
	//Filtro para el where
	$filtro = '';
	if ($filter!='0'){$filtro .="WHERE ".$filter." ";	}
	//explode para poder crear cadena
	$datos = explode(",", $data2);
	if(count($datos)==1){
		$data_required = ','.$datos[0].' AS '.$datos[0];
	}else{
		$data_required = '';
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
	ORDER BY Nombre";
	$resultado = mysqli_query ($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrSelect,$row );
	}
	mysqli_free_result($resultado);

	$input = '<select name="'.$name.'" id="'.$name.'" class="form-control" '.$x.' style="'.$style.'">
                <option value="" selected>Seleccione '.$placeholder.'</option>';
				
				foreach ( $arrSelect as $select ) {
					$w = '';
					  	
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
    $input .= '</select>';
        	
	return $input;

}
/*******************************************************************************************************************/
function input_select_val_filter($placeholder,$name, $required, $data1, $data2, $table, $filter,$style,$value, $dbConn){

	//si dato es requerido
	if($required==1){$x='';}elseif($required==2){$x='required';}
	//Filtro para el where
	$filtro = '';
	if ($filter!='0'){$filtro .="WHERE ".$filter." ";	}
	//explode para poder crear cadena
	$datos = explode(",", $data2);
	if(count($datos)==1){
		$data_required = ','.$datos[0].' AS '.$datos[0];
	}else{
		$data_required = '';
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
	ORDER BY Nombre";
	$resultado = mysqli_query ($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrSelect,$row );
	}
	mysqli_free_result($resultado);
	
	
	$input = '<link rel="stylesheet" href="assets/lib/chosen/chosen.css">';
	$input .= '<select name="'.$name.'" id="'.$name.'" '.$x.' style="'.$style.'" data-placeholder="Seleccione una Opcion" class="form-control chosen-select" tabindex="2">
					<option value=""></option>';

						
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
				<script src="assets/lib/chosen/chosen.jquery.js" type="text/javascript"></script>
				<script src="assets/lib/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
				<script type="text/javascript">
					$("#'.$name.'").chosen()
				</script>';
				

        	
	return $input;

}
					
/*******************************************************************************************************************/
function input_select_val($placeholder,$name, $required, $data1, $data2, $table, $filter,$style,$value, $dbConn){

	//si dato es requerido
	if($required==1){$x='';}elseif($required==2){$x='required';}
	//Filtro para el where
	$filtro = '';
	if ($filter!='0'){$filtro .="WHERE ".$filter." ";	}
	//explode para poder crear cadena
	$datos = explode(",", $data2);
	if(count($datos)==1){
		$data_required = ','.$datos[0].' AS '.$datos[0];
	}else{
		$data_required = '';
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
	ORDER BY Nombre";
	$resultado = mysqli_query ($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrSelect,$row );
	}
	mysqli_free_result($resultado);

	$input = '<select name="'.$name.'" id="'.$name.'" class="form-control" '.$x.' style="'.$style.'" >
                <option value="" selected>Seleccione '.$placeholder.'</option>';
				
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
    $input .= '</select>';
        	
	return $input;
}
/*******************************************************************************************************************/
function input_select_val_disabled($placeholder,$name, $required, $data1, $data2, $table, $filter,$style,$value, $dbConn){

	//si dato es requerido
	if($required==1){$x='';}elseif($required==2){$x='required';}
	//Filtro para el where
	$filtro = '';
	if ($filter!='0'){$filtro .="WHERE ".$filter." ";	}
	//explode para poder crear cadena
	$datos = explode(",", $data2);
	if(count($datos)==1){
		$data_required = ','.$datos[0].' AS '.$datos[0];
	}else{
		$data_required = '';
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
	ORDER BY Nombre";
	$resultado = mysqli_query ($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrSelect,$row );
	}
	mysqli_free_result($resultado);

	$input = '<select name="'.$name.'" id="'.$name.'" class="form-control" '.$x.' disabled style="'.$style.'" >
                <option value="" selected>Seleccione '.$placeholder.'</option>';
				
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
    $input .= '</select>';
        	
	return $input;
}
/*******************************************************************************************************************/
function input_textarea($placeholder,$name, $required,$style){

	if($required==1){$x='';}elseif($required==2){$x='required';}
	
	$input = '<textarea placeholder="'.$placeholder.'" name="'.$name.'" id="'.$name.'" class="form-control" style="overflow: auto; word-wrap: break-word; resize: horizontal; '.$style.'" '.$x.' ></textarea>';
	
	   	
	return $input;
}
/*******************************************************************************************************************/
function input_textarea_obs($placeholder,$name, $required,$style,$value){

	if($value==''){$w='';}else{$w=$value;}
	if($required==1){$x='';}elseif($required==2){$x='required';}
	
	$input = '<textarea placeholder="'.$placeholder.'" name="'.$name.'" id="'.$name.'" class="form-control" style="overflow: auto; word-wrap: break-word; resize: horizontal; '.$style.'" '.$x.' >'.$w.'</textarea>';
	
	   	
	return $input;
}
/*******************************************************************************************************************/
function input_date($placeholder,$name, $required){


	if($required==1){$x='';}elseif($required==2){$x='required';}	
	
	$input ='<link rel="stylesheet" href="assets/lib/material_datetimepicker/css/bootstrap-material-datetimepicker.css" />';
	$input .='<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';
	$input .='<script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>';
	$input .='<script type="text/javascript" src="assets/lib/material_datetimepicker/js/bootstrap-material-datetimepicker.js"></script>';
		
	$input .='<input placeholder="'.$placeholder.'" class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'"  '.$x.'> ';
              
              
	
	$input .='<script type="text/javascript">
		$(document).ready(function()
		{
			$("#'.$name.'").bootstrapMaterialDatePicker
			({
				time: false,
				lang: "es",
				weekStart: 1,
				cancelText : "Cancelar",
				clearButton: false
			});
			
		});
		</script>';
			
	return $input;
	
	
}
/*******************************************************************************************************************/
function input_time($placeholder,$name, $value, $required){
	$w='';
	if($value!=''){$w.=$value;}
	if($required==1){$x='';}elseif($required==2){$x='required';}
	
	$input  ='<link rel="stylesheet" type="text/css" href="assets/lib/clock_timepicker/dist/bootstrap-clockpicker.min.css">';
	
	$input .='<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.'   >';
	
	
	$input .='<script type="text/javascript" src="assets/lib/clock_timepicker/dist/bootstrap-clockpicker.min.js"></script>';
	$input .='<script type="text/javascript">
		$("#'.$name.'").clockpicker({
			placement: "top",
			align: "right",
			donetext: "Listo"
		});
		</script>';
	
	return $input;
}
/*******************************************************************************************************************/
function input_select_val_filter_ot($placeholder,$name, $required, $data1, $data2, $table, $filter,$style,$value, $dbConn){

	//si dato es requerido
	if($required==1){$x='';}elseif($required==2){$x='required';}
	//Filtro para el where
	$filtro = '';
	if ($filter!='0'){$filtro .="WHERE ".$filter." ";	}
	//explode para poder crear cadena
	$datos = explode(",", $data2);
	if(count($datos)==1){
		$data_required = ','.$datos[0].' AS '.$datos[0];
	}else{
		$data_required = '';
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
	ORDER BY Nombre";
	$resultado = mysqli_query ($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrSelect,$row );
	}
	mysqli_free_result($resultado);
	
	
	$input = '<link rel="stylesheet" href="assets/lib/chosen/chosen.css">';
	$input .= '<select name="'.$name.'" id="'.$name.'" '.$x.' style="'.$style.'" data-placeholder="Seleccione una Opcion" class="form-control chosen-select" tabindex="2">
					<option value=""></option>';

						
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
				
				<script type="text/javascript">
					$("#'.$name.'").chosen()
				</script>';
				

        	
	return $input;

}





/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                                                                                 */
/*                                          INPUT DE FORMULARIOS                                                   */
/*                                                                                                                 */
/*                                                                                                                 */
/*******************************************************************************************************************/
function form_input($type,$placeholder,$name, $value, $required){
	if($value==''){$w='';}else{$w=$value;}
	if($required==1){$x='';}elseif($required==2){$x='required';}	
	$input = '<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-lg-4" id="label_'.$name.'">'.$placeholder.'</label>
				<div class="col-lg-8">
					<input type="'.$type.'" placeholder="'.$placeholder.'" class="form-control"  name="'.$name.'" id="'.$name.'" value="'.$w.'"  '.$x.' >
				</div>
			</div>';	
	return $input;
}

/*******************************************************************************************************************/
function form_input_disabled($type,$placeholder,$name, $value, $required){
	if($value==''){$w='';}else{$w=$value;}
	if($required==1){$x='';}elseif($required==2){$x='required';}	
	$input = '<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-lg-4">'.$placeholder.'</label>
				<div class="col-lg-8">
					<input type="'.$type.'" placeholder="'.$placeholder.'" name="'.$name.'" id="'.$name.'" class="form-control" value="'.$w.'"  '.$x.' disabled="disabled">
				</div>
			</div>';	
	return $input;
}
/*******************************************************************************************************************/
function form_input_icon($type,$placeholder,$name, $value, $required, $icon){
	if($value==''){$w='';}else{$w=$value;}
	if($required==1){$x='';}elseif($required==2){$x='required';}			
	$input ='<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-lg-4" id="label_'.$name.'" >'.$placeholder.'</label>
				<div class="col-lg-8">
					<div class="input-group bootstrap-timepicker">
						<input type="'.$type.'" placeholder="'.$placeholder.'"  class="form-control timepicker-default" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.'  >
                        <span class="input-group-addon add-on"><i class="'.$icon.'"></i></span> 
						
					</div>
				</div>
			</div>';		
	return $input;
}
/*******************************************************************************************************************/
function form_textarea($placeholder,$name, $value, $required){
	if($value==''){$w='';}else{$w=$value;}
	if($required==1){$x='';}elseif($required==2){$x='required';}	
	$input = '<div class="form-group" id="div_'.$name.'">
            	<label for="text2" class="control-label col-lg-4">'.$placeholder.'</label>
                <div class="col-lg-8">
                    <textarea name="'.$name.'" id="autosize" class="form-control" style="overflow: auto; word-wrap: break-word; resize: horizontal; height: 320px;" '.$x.' >'.$w.'</textarea>
                </div>
            </div>';	
	return $input;
}  
/*******************************************************************************************************************/
function form_date($placeholder,$name, $value, $required){
	if($value==0){$w='';}elseif($value!=0){$w=$value;}
	if($required==1){$x='';}elseif($required==2){$x='required';}	
	
	$input ='<link rel="stylesheet" href="assets/lib/material_datetimepicker/css/bootstrap-material-datetimepicker.css" />';
	$input .='<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';
	$input .='<script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>';
	$input .='<script type="text/javascript" src="assets/lib/material_datetimepicker/js/bootstrap-material-datetimepicker.js"></script>';
		
	$input .='<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-lg-4">'.$placeholder.'</label>
				<div class="col-lg-8">
					<div class="input-group bootstrap-timepicker">
						<input placeholder="'.$placeholder.'" class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.'>
						<span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span> 
					</div>
				</div>
			</div>
			
			';
	$input .='<script type="text/javascript">
		$(document).ready(function()
		{
			$("#'.$name.'").bootstrapMaterialDatePicker
			({
				time: false,
				lang: "es",
				weekStart: 1,
				cancelText : "Cancelar",
				clearButton: true
			});
			
		});
		</script>
	
	
		';
			
	return $input;
}       
/*******************************************************************************************************************/
function form_time($placeholder,$name, $value, $required){
	$w='';
	if($value!=''){$w.=$value;}
	if($required==1){$x='';}elseif($required==2){$x='required';}
	
	$input  ='<link rel="stylesheet" type="text/css" href="assets/lib/clock_timepicker/dist/bootstrap-clockpicker.min.css">';
	
	$input .='<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-lg-4">'.$placeholder.'</label>
				<div class="col-lg-8">
					<div class="input-group bootstrap-timepicker">
						<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.'   >
                        <span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span> 
						
					</div>
				</div>
			</div>';
	
	$input .='<script type="text/javascript" src="assets/lib/clock_timepicker/dist/bootstrap-clockpicker.min.js"></script>';
	$input .='<script type="text/javascript">
		$("#'.$name.'").clockpicker({
			placement: "top",
			align: "left",
			donetext: "Listo"
		});
		</script>';
	
	return $input;
}
/*******************************************************************************************************************/
function form_values($placeholder,$name, $value, $required){
	if($value==0){$w='';}elseif($value!=0){$w=$value;}
	if($required==1){$x='';}elseif($required==2){$x='required';}	
	
	$input ='<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-lg-4">'.$placeholder.'</label>
				<div class="col-lg-8">
					<div class="input-group bootstrap-timepicker">
						<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return isNumberKey(event)"  >
                        <span class="input-group-addon add-on"><i class="fa fa-usd"></i></span> 
						
					</div>
				</div>
			</div>';
			
	$input .= '<script>
				
				  <!--
					function isNumberKey(evt){
						var charCode = (evt.which) ? evt.which : event.keyCode
						if (charCode > 31 && (charCode < 48 || charCode > 57)){
							return false;
						}else{
							return true;
						}
					}
				  //-->
 
				</script>';
	
	return $input;
}
/*******************************************************************************************************************/
function form_input_phone($placeholder,$name, $value, $required){
	if($value==0){$w='';}elseif($value!=0){$w=$value;}
	if($required==1){$x='';}elseif($required==2){$x='required';}	
	
	$input ='<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-lg-4">'.$placeholder.'</label>
				<div class="col-lg-8">
					<div class="input-group bootstrap-timepicker">
						<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return isNumberKey(event)"  >
                        <span class="input-group-addon add-on"><i class="fa fa-phone"></i></span> 
						
					</div>
				</div>
			</div>';
			
	$input .= '<script>
				
				  <!--
				  function isNumberKey(evt)
				  {
					var charCode = (evt.which) ? evt.which : event.keyCode
					if (charCode > 31 && (charCode < 48 || charCode > 57)){
						return false;
					}else{
						return true;
					}
				  }
				  //-->
 
				</script>';
	
	return $input;
}
/*******************************************************************************************************************/
function form_input_fax($placeholder,$name, $value, $required){
	if($value==0){$w='';}elseif($value!=0){$w=$value;}
	if($required==1){$x='';}elseif($required==2){$x='required';}	
	
	$input ='<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-lg-4">'.$placeholder.'</label>
				<div class="col-lg-8">
					<div class="input-group bootstrap-timepicker">
						<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return isNumberKey(event)"  >
                        <span class="input-group-addon add-on"><i class="fa fa-fax"></i></span> 
						
					</div>
				</div>
			</div>';
			
	$input .= '<script>
				
				  <!--
				  function isNumberKey(evt)
				  {
					var charCode = (evt.which) ? evt.which : event.keyCode
					if (charCode > 31 && (charCode < 48 || charCode > 57)){
						return false;
					}else{
						return true;
					}
				  }
				  //-->
 
				</script>';
	
	return $input;
}
/*******************************************************************************************************************/
function form_input_number($placeholder,$name, $value, $required){
	//if($value==0){$w='';}elseif($value!=0){$w=$value;}
	$w=$value;
	
	if($required==1){$x='';}elseif($required==2){$x='required';}	
	
	$input ='<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-lg-4">'.$placeholder.'</label>
				<div class="col-lg-8">
					<div class="input-group bootstrap-timepicker">
						<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return isNumberKey(event)"  >
                        <span class="input-group-addon add-on"><i class="fa fa-subscript"></i></span> 
						
					</div>
				</div>
			</div>';
			
	$input .= '<script>
				
				  <!--
				  function isNumberKey(evt)
				  {
					var charCode = (evt.which) ? evt.which : event.keyCode
					if (charCode > 31 && (charCode < 48 || charCode > 57)){
						//verifico si presiono el punto
						if (charCode == 46) {
							return true;
						}else{
							return false;
						}
					}else{
						return true;
					}
				  }
				  //-->
 
				</script>';
	
	return $input;
}
/*******************************************************************************************************************/
function form_select($placeholder,$name, $value, $required, $data1, $data2, $table, $filter, $dbConn){

	//si dato es requerido
	if($required==1){$x='';}elseif($required==2){$x='required';}
	//Filtro para el where
	$filtro = '';
	if ($filter!='0'){$filtro .="WHERE ".$filter." ";	}
	//explode para poder crear cadena
	$datos = explode(",", $data2);
	if(count($datos)==1){
		$data_required = ','.$datos[0].' AS '.$datos[0];
	}else{
		$data_required = '';
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
	ORDER BY Nombre";
	$resultado = mysqli_query ($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrSelect,$row );
	}
	mysqli_free_result($resultado);

	$input = '<div class="form-group" id="div_'.$name.'">
            	<label for="text2" class="control-label col-lg-4" id="label_'.$name.'">'.$placeholder.'</label>
                <div class="col-lg-8">
                <select name="'.$name.'" id="'.$name.'" class="form-control" '.$x.' >
                <option value="" selected>Seleccione una Opcion</option>';
				
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
        	
	
	return $input;
}
/*******************************************************************************************************************/
function form_select_bodega($placeholder,$name, $value, $required, $data1, $data2, $table1, $table2, $filter, $dbConn){

	//si dato es requerido
	if($required==1){$x='';}elseif($required==2){$x='required';}
	//Filtro para el where
	$filtro = '';
	if ($filter!='0'){$filtro .="WHERE ".$filter." ";	}
	

	//se trae un listado con todas las categorias
	$arrSelect = array();
	$query = "SELECT  
	".$table1.".".$data1." AS idData, 
	".$table1.".".$data2."
	FROM `".$table1."`  
	INNER JOIN ".$table2." ON ".$table2.".".$data1." = ".$table1.".".$data1."
	".$filtro."
	GROUP BY ".$table1.".".$data1."
	ORDER BY ".$table1.".".$data2." ASC";
	$resultado = mysqli_query ($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrSelect,$row );
	}
	mysqli_free_result($resultado);


	$input = '<div class="form-group" id="div_'.$name.'">
            	<label for="text2" class="control-label col-lg-4" id="label_'.$name.'">'.$placeholder.'</label>
                <div class="col-lg-8">
                <select name="'.$name.'" id="'.$name.'" class="form-control" '.$x.' >
                <option value="" selected>Seleccione una Opcion</option>';
				
				foreach ( $arrSelect as $select ) {
					$w = '';
					if($value==$select['idData']){
						$w .= 'selected="selected"';
					}  	
					
    $input .= '<option value="'.$select['idData'].'" '.$w.' >'.$select[$data2].'</option>';
                 } 
    $input .= '</select>
                </div>
            </div>';
        	
	
	return $input;
}
/*******************************************************************************************************************/
function form_select_filter($placeholder,$name, $value, $required, $data1, $data2, $table, $filter, $dbConn){

	//si dato es requerido
	if($required==1){$x='';}elseif($required==2){$x='required';}
	//Filtro para el where
	$filtro = '';
	if ($filter!='0'){$filtro .="WHERE ".$filter." ";	}
	//explode para poder crear cadena
	$datos = explode(",", $data2);
	if(count($datos)==1){
		$data_required = ','.$datos[0].' AS '.$datos[0];
	}else{
		$data_required = '';
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
	ORDER BY Nombre";
	$resultado = mysqli_query ($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrSelect,$row );
	}
	mysqli_free_result($resultado);
	
	
	$input  = '<link rel="stylesheet" href="assets/lib/chosen/chosen.css">';
	$input .= '<div class="form-group" id="div_'.$name.'">
					<label for="text2" class="control-label col-lg-4" id="label_'.$name.'">'.$placeholder.'</label>
					<div class="col-lg-8">
						<select name="'.$name.'" id="'.$name.'" '.$x.' data-placeholder="Seleccione una Opcion" class="form-control chosen-select chosendiv_'.$name.'" tabindex="2">
							<option value=""></option>';
							
						
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
				</div>
            
				<script src="assets/lib/chosen/chosen.jquery.js" type="text/javascript"></script>
				<script src="assets/lib/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
				<script type="text/javascript">
					$(".chosendiv_'.$name.'").chosen()
				</script>';
			//validacion si es requerido
			if($required==2){	
				$input .='
				<style>
				#div_'.$name.' .chosen-single {background:url(img/required.png) no-repeat 5px center !important;background-color: #fff !important;}
				</style>';
			}
        	
	return $input;

}
/*******************************************************************************************************************/
function form_select_filter_custom($placeholder,$name, $value, $required, $data1, $data2, $table, $filter, $orderby, $dbConn){

	//si dato es requerido
	if($required==1){$x='';}elseif($required==2){$x='required';}
	//Filtro para el where
	$filtro = '';
	if ($filter!='0'){$filtro .="WHERE ".$filter." ";	}
	//explode para poder crear cadena
	$datos = explode(",", $data2);
	if(count($datos)==1){
		$data_required = ','.$datos[0].' AS '.$datos[0];
	}else{
		$data_required = '';
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
	ORDER BY ".$orderby."";
	$resultado = mysqli_query ($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrSelect,$row );
	}
	mysqli_free_result($resultado);
	
	
	$input  = '<link rel="stylesheet" href="assets/lib/chosen/chosen.css">';
	$input .= '<div class="form-group" id="div_'.$name.'">
					<label for="text2" class="control-label col-lg-4" id="label_'.$name.'">'.$placeholder.'</label>
					<div class="col-lg-8">
						<select name="'.$name.'" id="'.$name.'" '.$x.' data-placeholder="Seleccione una Opcion" class="form-control chosen-select" tabindex="2">
							<option value=""></option>';
							
						
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
				</div>
            
				<script src="assets/lib/chosen/chosen.jquery.js" type="text/javascript"></script>
				<script src="assets/lib/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
				<script type="text/javascript">
					$(".chosen-select").chosen()
				</script>';
			//validacion si es requerido
			if($required==2){	
				$input .='
				<style>
				#div_'.$name.' .chosen-single {background:url(img/required.png) no-repeat 5px center !important;background-color: #fff !important;}
				</style>';
			}	

        	
	return $input;

}
/*******************************************************************************************************************/
function form_select_class($placeholder,$name, $value, $required, $class, $data1, $data2, $table, $filter, $dbConn){

	//si dato es requerido
	if($required==1){$x='';}elseif($required==2){$x='required';}
	//Filtro para el where
	$filtro = '';
	if ($filter!='0'){$filtro .="WHERE ".$filter." ";	}
	//explode para poder crear cadena
	$datos = explode(",", $data2);
	if(count($datos)==1){
		$data_required = ','.$datos[0].' AS '.$datos[0];
	}else{
		$data_required = '';
		foreach($datos as $dato){
			$data_required .= ','.$dato.' AS '.$dato;
		}
	}

	//se trae un listado con todas las categorias
	$arrSelect = array();
	$query = "SELECT 
	".$class." AS class, 
	".$data1." AS idData 
	".$data_required."
	FROM `".$table."`  
	".$filtro."
	ORDER BY Nombre";
	$resultado = mysqli_query ($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrSelect,$row );
	}
	mysqli_free_result($resultado);

	$input = '<div class="form-group" id="div_'.$name.'">
            	<label for="text2" class="control-label col-lg-4">'.$placeholder.'</label>
                <div class="col-lg-8">
                <select name="'.$name.'" class="form-control" '.$x.' >
                <option value="" selected>Seleccione una Opcion</option>';
				
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
    $input .= '<option class="'.$select['class'].'" value="'.$select['idData'].'" '.$w.' >'.$select['Nombre'].'</option>';
                 } 
    $input .= '</select>
                </div>
            </div>';
        	
	return $input;
}

/*******************************************************************************************************************/
function form_visualizacion($placeholder,$name, $value, $required, $data1, $data2, $table, $filter, $dbConn){

	if($required==1){$x='';}elseif($required==2){$x='required';}
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
	$resultado = mysqli_query ($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrSelect,$row );
	}
	mysqli_free_result($resultado);

	$input = '<div class="form-group" id="div_'.$name.'">
            	<label for="text2" class="control-label col-lg-4">'.$placeholder.'</label>
                <div class="col-lg-8">
                <select name="'.$name.'" class="form-control" '.$x.' >
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
        	
	return $input;
}

/*******************************************************************************************************************/
function form_select_n_auto($placeholder,$name, $value, $required, $valor_ini, $valor_fin){

	if($required==1){$x='';}elseif($required==2){$x='required';}

	$input = '<div class="form-group" id="div_'.$name.'">			
				<label for="text2" class="control-label col-lg-4">'.$placeholder.'</label>			
				<div class="col-lg-8">				
					<select class="form-control" name="'.$name.'" '.$x.'>
						<option value="">Seleccione una Opcion</option>';
						for ($i = $valor_ini; $i <= $valor_fin; $i++) {
							$j = '';
							if(isset($value)&&$value==$i) {
								$j .= 'selected="selected"';
							}
								$input .= '<option value="'.$i.'" '.$j.'>'.$i.'</option>';					
						} 	       				
					$input .= '</select>			
				</div>		
			</div>';
        	
	return $input;
}
/*******************************************************************************************************************/
function form_input_file($placeholder,$name){
	
	$input = '<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-lg-4">'.$placeholder.'</label>
				<div class="col-lg-8">
                	<input id="uploadFile" placeholder="'.$placeholder.'" disabled="disabled" />
                    <div class="fileUpload btn btn-primary">
                        <span>Seleccionar Archivo</span>
                        <input id="uploadBtn" type="file" class="upload" name="'.$name.'" />
                    </div>
				</div>
			</div>';
	$input .= '<script>
				document.getElementById("uploadBtn").onchange = function () {
					document.getElementById("uploadFile").value = this.value;
				};
				</script>';

	return $input;
}
/*******************************************************************************************************************/
function form_select_depend1($placeholder1,$name1, $value1, $required1, $dataA1, $dataA2, $table1, $filter1,
							 $placeholder2,$name2, $value2, $required2, $dataB1, $dataB2, $dataB3, $table2, $filter2, 
							 $dbConn, $form_name){

	if($required1==1){$x1='';}elseif($required1==2){$x1='required';}
	if($required2==1){$x2='';}elseif($required2==2){$x2='required';}
	//FILTROS
	
	$filtro1 = ''; if ($filter1!='0'){$filtro1 .="WHERE ".$filter1." ";	}
	$filtro2a = ''; if ($filter2!='0'){$filtro2a .="WHERE ".$filter2." ";	}
	$filtro2b = ''; if ($filter2!='0'){$filtro2b .=" AND ".$filter2." ";	}
	
	//visualizar listado
	if ($value2!=0&&$value2!=''){$display='';}else{$display='style="display:none;"';}
		
		
		
	//explode para poder crear cadena
	$datosA = explode(",", $dataA2);
	if(count($datosA)==1){
		$data_requiredA2 = ','.$datosA[0].' AS '.$datosA[0];
	}else{
		$data_requiredA2 = '';
		foreach($datosA as $dato){
			$data_requiredA2 .= ','.$dato.' AS '.$dato;
		}
	}
	//explode para poder crear cadena
	$datosB = explode(",", $dataB3);
	if(count($datosB)==1){
		$data_requiredB3 = ','.$datosB[0].' AS '.$datosB[0];
	}else{
		$data_requiredB3 = '';
		foreach($datosB as $dato){
			$data_requiredB3 .= ','.$dato.' AS '.$dato;
		}
	}
	
	//se trae un listado con todas los datos
	$arrSelect1 = array();
	$query = "SELECT  
	".$dataA1." AS idData1 
	".$data_requiredA2."
	FROM `".$table1."`  
	".$filtro1;
	$resultado = mysqli_query ($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrSelect1,$row );
	}
	mysqli_free_result($resultado);
	// Se trae un listado con todas las comunas
	if ($value1!=0&&$value1!=''){
		$arrSelect2 = array();
		$query = "SELECT 
		".$dataB1." AS idData2 
		".$data_requiredB3."
		FROM `".$table2."`
		WHERE ".$dataB2." = ".$value1." ".$filtro2b;
		$resultado = mysqli_query ($dbConn, $query);
		while ( $row = mysqli_fetch_assoc ($resultado)) {
		array_push( $arrSelect2,$row );
		}
	} 
	// Se trae un listado de todas las comunas
	$query = "SELECT 
	".$dataB2." AS idCat2,
	".$dataB1." AS idData2 
	".$data_requiredB3."
	FROM `".$table2."` 
	".$filtro2a."";
	$resultado = mysqli_query ($dbConn, $query);
	while ($Select[] = mysqli_fetch_assoc ($resultado)); 
	mysqli_free_result($resultado);
	array_pop($Select);
	array_multisort($Select, SORT_ASC);
	//Primer select
	$input = '<div class="form-group" id="div_'.$name.'">
            	<label for="text2" class="control-label col-lg-4">'.$placeholder1.'</label>
                <div class="col-lg-8">
                <select name="'.$name1.'" id="'.$name1.'" class="form-control" '.$x1.' onChange="cambia_'.$name1.'()" >
                <option value="" selected>Seleccione una Opcion</option>';
				
				foreach ( $arrSelect1 as $select1 ) {
					$w = ''; 
					if($value1==$select1['idData1']){ 
						$w .= 'selected="selected"'; 
					}  	
					if(count($datosA)==1){
						$data_writing = $select1[$datosA[0]].' ';
					}else{
						$data_writing = '';
						foreach($datosA as $dato){
							$data_writing .= $select1[$dato].' ';
						}
					}
    $input .= '<option value="'.$select1['idData1'].'" '.$w.' >'.$data_writing.'</option>';
                 } 
    $input .= '</select>
                </div>
            </div>';
			
	//Segundo select
	$input .= '<div class="form-group" id="div_'.$name2.'" '.$display.' >
            	<label for="text2" class="control-label col-lg-4">'.$placeholder2.'</label>
                <div class="col-lg-8">
                <select name="'.$name2.'" id="'.$name2.'" class="form-control" '.$x2.' >
                <option value="" selected>Seleccione una Opcion</option>';
				if ($value1!=0&&$value1!=''){
					foreach ( $arrSelect2 as $select2 ) {
						$w = ''; 
						if($value2==$select2['idData2']){ 
							$w .= 'selected="selected"'; 
						}  
						if(count($datosB)==1){
							$data_writing = $select2[$datosB[0]].' ';
						}else{
							$data_writing = '';
							foreach($datosB as $dato){
								$data_writing .= $select2[$dato].' ';
							}
						}
		$input .= '<option value="'.$select2['idData2'].'" '.$w.' >'.$data_writing.'</option>';
					 } 
				}
    $input .= '</select>
                </div>
            </div>';
	
	//script		
	$input .= '<script>';	
	filtrar($Select, 'idCat2'); 
	foreach($Select as $tipo=>$componentes){ 
	$input .= 'var id_data_'.$tipo.'=new Array(""';
	foreach ($componentes as $idcomp) { 
	$input .= ',"'.$idcomp['idData2'].'"';
	 }
	$input .= ')
	';
	}
	
	//se imprime el nombre de la tarea
	foreach($Select as $tipo=>$componentes){ 
		$input .= 'var data_'.$tipo.'=new Array("Seleccione una Opcion"';
		foreach ($componentes as $comp) { 
		
			if(count($datosB)==1){
				$input .= ',"'.str_replace('"', '',$comp[$datosB[0]]).'"';
			}else{
				$input .= ',"';
				foreach($datosB as $dato){
					$input .= str_replace('"', '',$comp[$dato]).' ';
				}
				$input .= '"';
			}
		}
		$input .= ')
		';
	}	
	
	
	$input .= 'function cambia_'.$name1.'(){
	var Componente
	Componente = document.'.$form_name.'.'.$name1.'[document.'.$form_name.'.'.$name1.'.selectedIndex].value
	try {
	if (Componente != "") {
		id_data=eval("id_data_" + Componente)
		data=eval("data_" + Componente)
		num_int = id_data.length
		document.'.$form_name.'.'.$name2.'.length = num_int
		for(i=0;i<num_int;i++){
		   document.'.$form_name.'.'.$name2.'.options[i].value=id_data[i]
		   document.'.$form_name.'.'.$name2.'.options[i].text=data[i]
		}
		document.getElementById("div_'.$name2.'").style.display = "block";	
	}else{
		document.'.$form_name.'.'.$name2.'.length = 1
		document.'.$form_name.'.'.$name2.'.options[0].value = ""
	    document.'.$form_name.'.'.$name2.'.options[0].text = "Seleccione una Opcion"
	    document.getElementById("div_'.$name2.'").style.display = "none";
	}
	} catch (e) {
	document.'.$form_name.'.'.$name2.'.length = 1
	document.'.$form_name.'.'.$name2.'.options[0].value = ""
	document.'.$form_name.'.'.$name2.'.options[0].text = "Seleccione una Opcion"
	document.getElementById("div_'.$name2.'").style.display = "none";
    
}
	document.'.$form_name.'.'.$name2.'.options[0].selected = true
}
</script>';	
			
        	
	return $input;
}
/*******************************************************************************************************************/
function form_select_depend2($placeholder1,$name1, $value1, $required1, $dataA1, $dataA2, $table1, $filter1,
							 $placeholder2,$name2, $value2, $required2, $dataB1, $dataB2, $dataB3, $table2, $filter2, 
							 $placeholder3,$name3, $value3, $required3, $dataC1, $dataC2, $dataC3, $table3, $filter3, 
							$dbConn, $form_name){

	if($required1==1){$x1='';}elseif($required1==2){$x1='required';}
	if($required2==1){$x2='';}elseif($required2==2){$x2='required';}
	if($required3==1){$x3='';}elseif($required3==2){$x3='required';}
	//FILTROS
	$filtro1 = ''; if ($filter1!='0'){$filtro1 .="WHERE ".$filter1." ";	}
	$filtro2a = ''; if ($filter2!='0'){$filtro2a .="WHERE ".$filter2." ";	}
	$filtro2b = ''; if ($filter2!='0'){$filtro2b .=" AND ".$filter2." ";	}
	$filtro3a = ''; if ($filter3!='0'){$filtro3a .="WHERE ".$filter3." ";	}
	$filtro3b = ''; if ($filter3!='0'){$filtro3b .=" AND ".$filter3." ";	}
	
	//visualizar listado
	if ($value2!=0&&$value2!=''){$display1='';}else{$display1='style="display:none;"';}
	if ($value3!=0&&$value3!=''){$display2='';}else{$display2='style="display:none;"';}
	
	//se trae un listado con todas los datos
	$arrSelect1 = array();
	$query = "SELECT  
	".$dataA1." AS idData1, 
	".$dataA2." AS Nombre1
	FROM `".$table1."`  
	".$filtro1."
	ORDER BY Nombre1";
	$resultado = mysqli_query ($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrSelect1,$row );
	}
	mysqli_free_result($resultado);
	// Se trae un listado con todas las comunas
	 if ($value1!=0&&$value1!=''){
		$arrSelect2 = array();
		$query = "SELECT 
		".$dataB1." AS idData2, 
		".$dataB3." AS Nombre2
		FROM `".$table2."`
		WHERE ".$dataB2." = ".$value1." ".$filtro2b."
		ORDER BY Nombre2 ASC ";
		$resultado = mysqli_query ($dbConn, $query);
		while ( $row = mysqli_fetch_assoc ($resultado)) {
		array_push( $arrSelect2,$row );
		}
	} 
	// Se trae un listado de todas las comunas
	$query = "SELECT 
	".$dataB1." AS idData2, 
	".$dataB2." AS idCat2, 
	".$dataB3." AS Nombre2
	FROM `".$table2."` 
	".$filtro2a."";
	$resultado = mysqli_query ($dbConn, $query);
	while ($Select2[] = mysqli_fetch_assoc ($resultado)); 
	mysqli_free_result($resultado);
	array_pop($Select2);
	array_multisort($Select2, SORT_ASC);
	
	// Se trae un listado con todas las comunas
	 if ($value2!=0&&$value2!=''){
		$arrSelect3 = array();
		$query = "SELECT 
		".$dataC1." AS idData3, 
		".$dataC3." AS Nombre3
		FROM `".$table3."`
		WHERE ".$dataC2." = ".$value2." ".$filtro3b."
		ORDER BY Nombre3 ASC ";
		$resultado = mysqli_query ($dbConn, $query);
		while ( $row = mysqli_fetch_assoc ($resultado)) {
		array_push( $arrSelect3,$row );
		}
	} 
	// Se trae un listado de todas las comunas
	$query = "SELECT 
	".$dataC1." AS idData3, 
	".$dataC2." AS idCat3, 
	".$dataC3." AS Nombre3
	FROM `".$table3."` 
	".$filtro3a."";
	$resultado = mysqli_query ($dbConn, $query);
	while ($Select3[] = mysqli_fetch_assoc ($resultado)); 
	mysqli_free_result($resultado);
	array_pop($Select3);
	array_multisort($Select3, SORT_ASC);

	//Primer select
	$input = '<div class="form-group" id="div_'.$name.'">
            	<label for="text2" class="control-label col-lg-4">'.$placeholder1.'</label>
                <div class="col-lg-8">
                <select name="'.$name1.'" class="form-control" '.$x1.' onChange="cambia_'.$name1.'()" >
                <option value="" selected>Seleccione una Opcion</option>';
				
				foreach ( $arrSelect1 as $select1 ) {
					$w = ''; if($value1==$select1['idData1']){ $w .= 'selected="selected"'; }  	
    $input .= '<option value="'.$select1['idData1'].'" '.$w.' >'.$select1['Nombre1'].'</option>';
                 } 
    $input .= '</select>
                </div>
            </div>';
			
	//Segundo select
	$input .= '<div class="form-group" id="div_'.$name2.'" '.$display1.'>
            	<label for="text2" class="control-label col-lg-4">'.$placeholder2.'</label>
                <div class="col-lg-8">
                <select name="'.$name2.'" class="form-control" '.$x2.' onChange="cambia_'.$name2.'()"  >
                <option value="" selected>Seleccione una Opcion</option>';
				if ($value1!=0&&$value1!=''){
					foreach ( $arrSelect2 as $select2 ) {
						$w = ''; if($value2==$select2['idData2']){ $w .= 'selected="selected"'; }  	
		$input .= '<option value="'.$select2['idData2'].'" '.$w.' >'.$select2['Nombre2'].'</option>';
					 } 
				}
    $input .= '</select>
                </div>
            </div>';
	
	//script		
	$input .= '<script>';	
	filtrar($Select2, 'idCat2'); 
	foreach($Select2 as $tipo=>$componentes){ 
	$input .= 'var id_data1_'.$tipo.'=new Array(""';
	foreach ($componentes as $idcomp) { 
	$input .= ',"'.$idcomp['idData2'].'"';
	 }
	$input .= ')
	';
	}
	
	//se imprime el nombre de la tarea
	foreach($Select2 as $tipo=>$componentes){ 
	$input .= 'var data1_'.$tipo.'=new Array("Seleccione una Opcion"';
	foreach ($componentes as $comp) { 
	$input .= ',"'.str_replace('"', '',$comp['Nombre2']).'"';
	 }
	$input .= ')
	';
	}	
	
	
	$input .= 'function cambia_'.$name1.'(){
	var Componente
	Componente = document.'.$form_name.'.'.$name1.'[document.'.$form_name.'.'.$name1.'.selectedIndex].value
	try {
	if (Componente != "") {
		id_data1=eval("id_data1_" + Componente)
		data1=eval("data1_" + Componente)
		num_int = id_data1.length
		document.'.$form_name.'.'.$name2.'.length = num_int
		for(i=0;i<num_int;i++){
		   document.'.$form_name.'.'.$name2.'.options[i].value=id_data1[i]
		   document.'.$form_name.'.'.$name2.'.options[i].text=data1[i]
		}
		document.getElementById("div_'.$name2.'").style.display = "block";	
	}else{
		document.'.$form_name.'.'.$name2.'.length = 1
		document.'.$form_name.'.'.$name2.'.options[0].value = ""
	    document.'.$form_name.'.'.$name2.'.options[0].text = "Seleccione una Opcion"
	    document.getElementById("div_'.$name2.'").style.display = "none";
	}
	} catch (e) {
    document.'.$form_name.'.'.$name2.'.length = 1
	document.'.$form_name.'.'.$name2.'.options[0].value = ""
	document.'.$form_name.'.'.$name2.'.options[0].text = "Seleccione una Opcion"
	document.getElementById("div_'.$name2.'").style.display = "none";
	
}
	document.'.$form_name.'.'.$name2.'.options[0].selected = true
}
</script>';	

	//Tercer select
	$input .= '<div class="form-group" id="div_'.$name3.'" '.$display2.'>
            	<label for="text2" class="control-label col-lg-4">'.$placeholder3.'</label>
                <div class="col-lg-8">
                <select name="'.$name3.'" class="form-control" '.$x3.' >
                <option value="" selected>Seleccione una Opcion</option>';
				if ($value2!=0&&$value2!=''){
					foreach ( $arrSelect3 as $select3) {
						$w = ''; if($value3==$select3['idData3']){ $w .= 'selected="selected"'; }  	
		$input .= '<option value="'.$select3['idData3'].'" '.$w.' >'.$select3['Nombre3'].'</option>';
					 } 
				}
    $input .= '</select>
                </div>
            </div>';
	
	//script		
	$input .= '<script>';	
	filtrar($Select3, 'idCat3'); 
	foreach($Select3 as $tipo=>$componentes){ 
	$input .= 'var id_data2_'.$tipo.'=new Array(""';
	foreach ($componentes as $idcomp) { 
	$input .= ',"'.$idcomp['idData3'].'"';
	 }
	$input .= ')
	';
	}
	
	//se imprime el nombre de la tarea
	foreach($Select3 as $tipo=>$componentes){ 
	$input .= 'var data2_'.$tipo.'=new Array("Seleccione una Opcion"';
	foreach ($componentes as $comp) { 
	$input .= ',"'.str_replace('"', '',$comp['Nombre3']).'"';
	 }
	$input .= ')
	';
	}	
	
	
	$input .= 'function cambia_'.$name2.'(){
	var Componente
	Componente = document.'.$form_name.'.'.$name2.'[document.'.$form_name.'.'.$name2.'.selectedIndex].value
	try {
	if (Componente != "") {
		id_data2=eval("id_data2_" + Componente)
		data2=eval("data2_" + Componente)
		num_int = id_data2.length
		document.'.$form_name.'.'.$name3.'.length = num_int
		for(i=0;i<num_int;i++){
		   document.'.$form_name.'.'.$name3.'.options[i].value=id_data2[i]
		   document.'.$form_name.'.'.$name3.'.options[i].text=data2[i]
		}
		document.getElementById("div_'.$name3.'").style.display = "block";	
	}else{
		document.'.$form_name.'.'.$name3.'.length = 1
		document.'.$form_name.'.'.$name3.'.options[0].value = ""
	    document.'.$form_name.'.'.$name3.'.options[0].text = "Seleccione una Opcion"
	    document.getElementById("div_'.$name3.'").style.display = "none";
	}
	} catch (e) {
    document.'.$form_name.'.'.$name3.'.length = 1
	document.'.$form_name.'.'.$name3.'.options[0].value = ""
	document.'.$form_name.'.'.$name3.'.options[0].text = "Seleccione una Opcion"
	document.getElementById("div_'.$name3.'").style.display = "none";
    
}
	document.'.$form_name.'.'.$name3.'.options[0].selected = true
}
</script>';
			
        	
	return $input;
}
/*******************************************************************************************************************/
function form_select_depend3($placeholder1,$name1, $value1, $required1, $dataA1, $dataA2, $table1, $filter1,
							 $placeholder2,$name2, $value2, $required2, $dataB1, $dataB2, $dataB3, $table2, $filter2, 
							 $placeholder3,$name3, $value3, $required3, $dataC1, $dataC2, $dataC3, $table3, $filter3,
							 $placeholder4,$name4, $value4, $required4, $dataD1, $dataD2, $dataD3, $table4, $filter4, 
							$dbConn, $form_name){

	if($required1==1){$x1='';}elseif($required1==2){$x1='required';}
	if($required2==1){$x2='';}elseif($required2==2){$x2='required';}
	if($required3==1){$x3='';}elseif($required3==2){$x3='required';}
	if($required4==1){$x4='';}elseif($required4==2){$x4='required';}
	//FILTROS
	$filtro1 = ''; if ($filter1!='0'){$filtro1 .="WHERE ".$filter1." ";	}
	$filtro2a = ''; if ($filter2!='0'){$filtro2a .="WHERE ".$filter2." ";	}
	$filtro2b = ''; if ($filter2!='0'){$filtro2b .=" AND ".$filter2." ";	}
	$filtro3a = ''; if ($filter3!='0'){$filtro3a .="WHERE ".$filter3." ";	}
	$filtro3b = ''; if ($filter3!='0'){$filtro3b .=" AND ".$filter3." ";	}
	$filtro4a = ''; if ($filter4!='0'){$filtro4a .="WHERE ".$filter4." ";	}
	$filtro4b = ''; if ($filter4!='0'){$filtro4b .=" AND ".$filter4." ";	}
	
	//visualizar listado
	if ($value2!=0&&$value2!=''){$display1='';}else{$display1='style="display:none;"';}
	if ($value3!=0&&$value3!=''){$display2='';}else{$display2='style="display:none;"';}
	if ($value4!=0&&$value4!=''){$display3='';}else{$display3='style="display:none;"';}
	
	//se trae un listado con todas los datos
	$arrSelect1 = array();
	$query = "SELECT  
	".$dataA1." AS idData1, 
	".$dataA2." AS Nombre1
	FROM `".$table1."`  
	".$filtro1."
	ORDER BY Nombre1";
	$resultado = mysqli_query ($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrSelect1,$row );
	}
	mysqli_free_result($resultado);
	// Se trae un listado con todas las comunas
	 if ($value1!=0&&$value1!=''){
		$arrSelect2 = array();
		$query = "SELECT 
		".$dataB1." AS idData2, 
		".$dataB3." AS Nombre2
		FROM `".$table2."`
		WHERE ".$dataB2." = ".$value1." ".$filtro2b."
		ORDER BY Nombre2 ASC ";
		$resultado = mysqli_query ($dbConn, $query);
		while ( $row = mysqli_fetch_assoc ($resultado)) {
		array_push( $arrSelect2,$row );
		}
	} 
	// Se trae un listado de todas las comunas
	$query = "SELECT 
	".$dataB1." AS idData2, 
	".$dataB2." AS idCat2, 
	".$dataB3." AS Nombre2
	FROM `".$table2."` 
	".$filtro2a."";
	$resultado = mysqli_query ($dbConn, $query);
	while ($Select2[] = mysqli_fetch_assoc ($resultado)); 
	mysqli_free_result($resultado);
	array_pop($Select2);
	array_multisort($Select2, SORT_ASC);
	
	// Se trae un listado con todas las comunas
	 if ($value2!=0&&$value2!=''){
		$arrSelect3 = array();
		$query = "SELECT 
		".$dataC1." AS idData3, 
		".$dataC3." AS Nombre3
		FROM `".$table3."`
		WHERE ".$dataC2." = ".$value2." ".$filtro3b."
		ORDER BY Nombre3 ASC ";
		$resultado = mysqli_query ($dbConn, $query);
		while ( $row = mysqli_fetch_assoc ($resultado)) {
		array_push( $arrSelect3,$row );
		}
	} 
	// Se trae un listado de todas las comunas
	$query = "SELECT 
	".$dataC1." AS idData3, 
	".$dataC2." AS idCat3, 
	".$dataC3." AS Nombre3
	FROM `".$table3."` 
	".$filtro3a."";
	$resultado = mysqli_query ($dbConn, $query);
	while ($Select3[] = mysqli_fetch_assoc ($resultado)); 
	mysqli_free_result($resultado);
	array_pop($Select3);
	array_multisort($Select3, SORT_ASC);
	
	// Se trae un listado con todas las comunas
	 if ($value3!=0&&$value3!=''){
		$arrSelect4 = array();
		$query = "SELECT 
		".$dataD1." AS idData3, 
		".$dataD3." AS Nombre3
		FROM `".$table4."`
		WHERE ".$dataD2." = ".$value3." ".$filtro4b."
		ORDER BY Nombre3 ASC ";
		$resultado = mysqli_query ($dbConn, $query);
		while ( $row = mysqli_fetch_assoc ($resultado)) {
		array_push( $arrSelect4,$row );
		}
	} 
	// Se trae un listado de todas las comunas
	$query = "SELECT 
	".$dataD1." AS idData3, 
	".$dataD2." AS idCat3, 
	".$dataD3." AS Nombre3
	FROM `".$table4."` 
	".$filtro4a."";
	$resultado = mysqli_query ($dbConn, $query);
	while ($Select4[] = mysqli_fetch_assoc ($resultado)); 
	mysqli_free_result($resultado);
	array_pop($Select4);
	array_multisort($Select4, SORT_ASC);

	//Primer select
	$input = '<div class="form-group" id="div_'.$name.'">
            	<label for="text2" class="control-label col-lg-4">'.$placeholder1.'</label>
                <div class="col-lg-8">
                <select name="'.$name1.'" class="form-control" '.$x1.' onChange="cambia_'.$name1.'()" >
                <option value="" selected>Seleccione una Opcion</option>';
				
				foreach ( $arrSelect1 as $select1 ) {
					$w = ''; if($value1==$select1['idData1']){ $w .= 'selected="selected"'; }  	
    $input .= '<option value="'.$select1['idData1'].'" '.$w.' >'.$select1['Nombre1'].'</option>';
                 } 
    $input .= '</select>
                </div>
            </div>';
			
	//Segundo select
	$input .= '<div class="form-group" id="div_'.$name2.'" '.$display1.'>
            	<label for="text2" class="control-label col-lg-4">'.$placeholder2.'</label>
                <div class="col-lg-8">
                <select name="'.$name2.'" class="form-control" '.$x2.' onChange="cambia_'.$name2.'()"  >
                <option value="" selected>Seleccione una Opcion</option>';
				if ($value1!=0&&$value1!=''){
					foreach ( $arrSelect2 as $select2 ) {
						$w = ''; if($value2==$select2['idData2']){ $w .= 'selected="selected"'; }  	
		$input .= '<option value="'.$select2['idData2'].'" '.$w.' >'.$select2['Nombre2'].'</option>';
					 } 
				}
    $input .= '</select>
                </div>
            </div>';
	
	//script		
	$input .= '<script>';	
	filtrar($Select2, 'idCat2'); 
	foreach($Select2 as $tipo=>$componentes){ 
	$input .= 'var id_data1_'.$tipo.'=new Array(""';
	foreach ($componentes as $idcomp) { 
	$input .= ',"'.$idcomp['idData2'].'"';
	 }
	$input .= ')
	';
	}
	
	//se imprime el nombre de la tarea
	foreach($Select2 as $tipo=>$componentes){ 
	$input .= 'var data1_'.$tipo.'=new Array("Seleccione una Opcion"';
	foreach ($componentes as $comp) { 
	$input .= ',"'.str_replace('"', '',$comp['Nombre2']).'"';
	 }
	$input .= ')
	';
	}	
	
	
	$input .= 'function cambia_'.$name1.'(){
	var Componente
	Componente = document.'.$form_name.'.'.$name1.'[document.'.$form_name.'.'.$name1.'.selectedIndex].value
	try {
	if (Componente != "") {
		id_data1=eval("id_data1_" + Componente)
		data1=eval("data1_" + Componente)
		num_int = id_data1.length
		document.'.$form_name.'.'.$name2.'.length = num_int
		for(i=0;i<num_int;i++){
		   document.'.$form_name.'.'.$name2.'.options[i].value=id_data1[i]
		   document.'.$form_name.'.'.$name2.'.options[i].text=data1[i]
		}	
		document.getElementById("div_'.$name2.'").style.display = "block";
	}else{
		document.'.$form_name.'.'.$name2.'.length = 1
		document.'.$form_name.'.'.$name2.'.options[0].value = ""
	    document.'.$form_name.'.'.$name2.'.options[0].text = "Seleccione una Opcion"
	    document.getElementById("div_'.$name2.'").style.display = "none";
	}
	} catch (e) {
    document.'.$form_name.'.'.$name2.'.length = 1
	document.'.$form_name.'.'.$name2.'.options[0].value = ""
	document.'.$form_name.'.'.$name2.'.options[0].text = "Seleccione una Opcion"
	document.getElementById("div_'.$name2.'").style.display = "none";
	
}
	document.'.$form_name.'.'.$name2.'.options[0].selected = true
}
</script>';	

	//Tercer select
	$input .= '<div class="form-group"  id="div_'.$name3.'" '.$display2.'>
            	<label for="text2" class="control-label col-lg-4">'.$placeholder3.'</label>
                <div class="col-lg-8">
                <select name="'.$name3.'" class="form-control" '.$x3.' onChange="cambia_'.$name3.'()">
                <option value="" selected>Seleccione una Opcion</option>';
				if ($value2!=0&&$value2!=''){
					foreach ( $arrSelect3 as $select3) {
						$w = ''; if($value3==$select3['idData3']){ $w .= 'selected="selected"'; }  	
		$input .= '<option value="'.$select3['idData3'].'" '.$w.' >'.$select3['Nombre3'].'</option>';
					 } 
				}
    $input .= '</select>
                </div>
            </div>';
	
	//script		
	$input .= '<script>';	
	filtrar($Select3, 'idCat3'); 
	foreach($Select3 as $tipo=>$componentes){ 
	$input .= 'var id_data2_'.$tipo.'=new Array(""';
	foreach ($componentes as $idcomp) { 
	$input .= ',"'.$idcomp['idData3'].'"';
	 }
	$input .= ')
	';
	}
	
	//se imprime el nombre de la tarea
	foreach($Select3 as $tipo=>$componentes){ 
	$input .= 'var data2_'.$tipo.'=new Array("Seleccione una Opcion"';
	foreach ($componentes as $comp) { 
	$input .= ',"'.str_replace('"', '',$comp['Nombre3']).'"';
	 }
	$input .= ')
	';
	}	
	
	
	$input .= 'function cambia_'.$name2.'(){
	var Componente
	Componente = document.'.$form_name.'.'.$name2.'[document.'.$form_name.'.'.$name2.'.selectedIndex].value
	try {
	if (Componente != "") {
		id_data2=eval("id_data2_" + Componente)
		data2=eval("data2_" + Componente)
		num_int = id_data2.length
		document.'.$form_name.'.'.$name3.'.length = num_int
		for(i=0;i<num_int;i++){
		   document.'.$form_name.'.'.$name3.'.options[i].value=id_data2[i]
		   document.'.$form_name.'.'.$name3.'.options[i].text=data2[i]
		}
		document.getElementById("div_'.$name3.'").style.display = "block";
	}else{
		document.'.$form_name.'.'.$name3.'.length = 1
		document.'.$form_name.'.'.$name3.'.options[0].value = ""
	    document.'.$form_name.'.'.$name3.'.options[0].text = "Seleccione una Opcion"
	    document.getElementById("div_'.$name3.'").style.display = "none";
	}
	} catch (e) {
    document.'.$form_name.'.'.$name3.'.length = 1
	document.'.$form_name.'.'.$name3.'.options[0].value = ""
	document.'.$form_name.'.'.$name3.'.options[0].text = "Seleccione una Opcion"
	document.getElementById("div_'.$name3.'").style.display = "none";
    
}
	document.'.$form_name.'.'.$name3.'.options[0].selected = true
}
</script>';

	//Cuarto select
	$input .= '<div class="form-group" id="div_'.$name4.'" '.$display3.'>
            	<label for="text2" class="control-label col-lg-4">'.$placeholder4.'</label>
                <div class="col-lg-8">
                <select name="'.$name4.'" class="form-control" '.$x4.' >
                <option value="" selected>Seleccione una Opcion</option>';
				if ($value3!=0&&$value3!=''){
					foreach ( $arrSelect4 as $select4) {
						$w = ''; if($value4==$select4['idData3']){ $w .= 'selected="selected"'; }  	
		$input .= '<option value="'.$select4['idData3'].'" '.$w.' >'.$select4['Nombre3'].'</option>';
					 } 
				}
    $input .= '</select>
                </div>
            </div>';
	
	//script		
	$input .= '<script>';	
	filtrar($Select4, 'idCat3'); 
	foreach($Select4 as $tipo=>$componentes){ 
	$input .= 'var id_data3_'.$tipo.'=new Array(""';
	foreach ($componentes as $idcomp) { 
	$input .= ',"'.$idcomp['idData3'].'"';
	 }
	$input .= ')
	';
	}
	
	//se imprime el nombre de la tarea
	foreach($Select4 as $tipo=>$componentes){ 
	$input .= 'var data3_'.$tipo.'=new Array("Seleccione una Opcion"';
	foreach ($componentes as $comp) { 
	$input .= ',"'.str_replace('"', '',$comp['Nombre3']).'"';
	 }
	$input .= ')
	';
	}	
	
	
	$input .= 'function cambia_'.$name3.'(){
	var Componente
	Componente = document.'.$form_name.'.'.$name3.'[document.'.$form_name.'.'.$name3.'.selectedIndex].value
	try {
	if (Componente != "") {
		id_data3=eval("id_data3_" + Componente)
		data3=eval("data3_" + Componente)
		num_int = id_data3.length
		document.'.$form_name.'.'.$name4.'.length = num_int
		for(i=0;i<num_int;i++){
		   document.'.$form_name.'.'.$name4.'.options[i].value=id_data3[i]
		   document.'.$form_name.'.'.$name4.'.options[i].text=data3[i]
		}	
		document.getElementById("div_'.$name4.'").style.display = "block";
	}else{
		document.'.$form_name.'.'.$name4.'.length = 1
		document.'.$form_name.'.'.$name4.'.options[0].value = ""
	    document.'.$form_name.'.'.$name4.'.options[0].text = "Seleccione una Opcion"
	    document.getElementById("div_'.$name4.'").style.display = "none";
	}
	} catch (e) {
    document.'.$form_name.'.'.$name4.'.length = 1
	document.'.$form_name.'.'.$name4.'.options[0].value = ""
	document.'.$form_name.'.'.$name4.'.options[0].text = "Seleccione una Opcion"
	document.getElementById("div_'.$name4.'").style.display = "none";
    
}
	document.'.$form_name.'.'.$name4.'.options[0].selected = true
}
</script>';
			
        	
	return $input;
}
/*******************************************************************************************************************/
function form_ckeditor($placeholder,$name, $value, $required, $tipo){

	if($required==1){$x='';}elseif($required==2){$x='required';}
	
	$input = "<div class='txtckedit'  >
				<h3>".$placeholder."</h3>
				<textarea id='ckeditor' class='ckeditor' name='".$name."' ".$x.">".$value."</textarea>
                <script src='assets/lib/ckeditor/ckeditor.js'></script>
                <script>";
      
    
    //se selecciona el tipo de editor a mostrar
    switch ($tipo) {
		case 1:
			$input .= "CKEDITOR.replace( 'ckeditor', {				
						toolbar: [										
						[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],					
						{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule' ] },						
						{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ], 
						items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },					
						'/',
						{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },					
						{ name: 'styles', items: [ 'Styles', 'Format' ] }";
			break;
		case 2:
			
			break;
		case 3:
			break;
	}           
    $input .= "</script>   
            </div>";
	
	   	
	return $input;
}
/*******************************************************************************************************************/
function form_select_sys($placeholder,$name, $value, $required, $data1, $data2, $table, $filter, $dbConn){

	//si dato es requerido
	if($required==1){$x='';}elseif($required==2){$x='required';}
	//Filtro para el where
	$filtro = '';
	if ($filter!='0'){$filtro .="WHERE ".$filter." ";	}
	//explode para poder crear cadena
	$datos = explode(",", $data2);
	if(count($datos)==1){
		$data_required = ','.$datos[0].' AS '.$datos[0];
	}else{
		$data_required = '';
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
	ORDER BY Nombre";
	$resultado = mysqli_query ($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrSelect,$row );
	}
	mysqli_free_result($resultado);

	$input = '<div class="form-group" id="div_'.$name.'">
            	<label for="text2" class="control-label col-lg-4" id="label_'.$name.'">'.$placeholder.'</label>
                <div class="col-lg-8">
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
        	
	
	return $input;
}
/*******************************************************************************************************************/
function form_input_inline_x3($placeholder,$name, $value1, $value2, $value3, $required){
	
	if($value1==0){$w1='';}elseif($value1!=0){$w1=$value1;}
	if($value2==0){$w2='';}elseif($value2!=0){$w2=$value2;}
	if($value3==0){$w3='';}elseif($value3!=0){$w3=$value3;}
	
	
	if($required==1){$x='';}elseif($required==2){$x='required';}	
	
	$input ='<div class="form-group col-lg-12" id="div_'.$name.'">
				<label class="control-label col-lg-4" id="label_Nombre">'.$placeholder.'</label>
				<div class="col-lg-8">

					<div class="input-group bootstrap-timepicker col-lg-4" style="display: inline-table;">
						<input placeholder="Aceptable" class="form-control timepicker-default" type="text" name="'.$name.'_1" id="'.$name.'_1" value="'.$w1.'" '.$x.' onkeypress="return isNumberKey(event)"  >
						<span class="input-group-addon add-on"><i class="fa fa-subscript"></i></span> 
					</div>
					
					<div class="input-group bootstrap-timepicker col-lg-4" style="display: inline-table;">
						<input placeholder="Alerta" class="form-control timepicker-default" type="text" name="'.$name.'_2" id="'.$name.'_2" value="'.$w2.'" '.$x.' onkeypress="return isNumberKey(event)"  >
						<span class="input-group-addon add-on"><i class="fa fa-subscript"></i></span> 
					</div>
					
					<div class="input-group bootstrap-timepicker col-lg-4" style="display: inline-table;">
						<input placeholder="Condenatorio" class="form-control timepicker-default" type="text" name="'.$name.'_3" id="'.$name.'_3" value="'.$w3.'" '.$x.' onkeypress="return isNumberKey(event)"  >
						<span class="input-group-addon add-on"><i class="fa fa-subscript"></i></span> 
					</div>
				
				</div>
			</div>';
			
	$input .= '<script>
				
				  <!--
				  function isNumberKey(evt)
				  {
					var charCode = (evt.which) ? evt.which : event.keyCode
					if (charCode > 31 && (charCode < 48 || charCode > 57)){
						//verifico si presiono el punto
						if (charCode == 46) {
							return true;
						}else{
							return false;
						}
					}else{
						return true;
					}
				  }
				  //-->
 
				</script>';
	
	return $input;
}
?>
