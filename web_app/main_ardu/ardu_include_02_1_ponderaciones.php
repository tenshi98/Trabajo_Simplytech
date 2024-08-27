<?php
/******************************************************************************************************/
/*                                                                                                    */
/*                                  MODIFICACION MANUAL A LOS DATOS RECIBIDOS                         */
/*                                                                                                    */
/******************************************************************************************************/
switch ($Identificador) {
	/**************************************/
	//Cambio del Identificador
	case '175':
	case '197':
	case '155':
	case '234':
		/******************************************/
		//cambio de valores
		switch ($Identificador) {
			case 175:
			case 197:
				//se crea sensor inexistente de voltaje
				if(isset($Sensor[7]['valor'])&&$Sensor[7]['valor']==99900){ $Sensor[7]['valor'] = 0;}
				$Sensor[37]['valor'] = $Sensor[7]['valor'];
				//asigno el total de sensores
				$Var_Counter = 37;
				break;
		}

		/******************************************/
		//se cambia el nombre del identificador
		switch ($Identificador) {
			case 175:$Identificador = 'gen_175';break;
			case 197:$Identificador = 'gen_197';break;
			case 155:$Identificador = 'elv-5';break;
			case 234:$Identificador = '236';break;

		}

		break;
	/**************************************/
	//CrossWeather
	case 'CrossWhether':
	case 'az1':
	case 'cw3':
	case 'az2':
		//si el sensor tiene un valor superior a 100 le asigna el valor 100
		if(isset($Sensor[2]['valor'])&&$Sensor[2]['valor']>100&&$Sensor[2]['valor']!=99900){
			$Sensor[2]['valor']=100;
		}
		break;
	/**************************************/
	//Del Monte
	case 'dm1-LPC':
		if(isset($Sensor[1]['valor'])&&$Sensor[1]['valor']==25){   $Sensor[1]['valor']  = 99900;}
		if(isset($Sensor[2]['valor'])&&$Sensor[2]['valor']==25){   $Sensor[2]['valor']  = 99900;}
		if(isset($Sensor[3]['valor'])&&$Sensor[3]['valor']==25){   $Sensor[3]['valor']  = 99900;}
		if(isset($Sensor[4]['valor'])&&$Sensor[4]['valor']==25){   $Sensor[4]['valor']  = 99900;}
		if(isset($Sensor[5]['valor'])&&$Sensor[5]['valor']==25){   $Sensor[5]['valor']  = 99900;}
		if(isset($Sensor[6]['valor'])&&$Sensor[6]['valor']==25){   $Sensor[6]['valor']  = 99900;}
		if(isset($Sensor[11]['valor'])&&$Sensor[11]['valor']==25){ $Sensor[11]['valor'] = 99900;}
		if(isset($Sensor[12]['valor'])&&$Sensor[12]['valor']==25){ $Sensor[12]['valor'] = 99900;}

		if(isset($Sensor[4]['valor'])&&$Sensor[4]['valor']==999){   $Sensor[4]['valor']  = 99901;}
		if(isset($Sensor[5]['valor'])&&$Sensor[5]['valor']==999){   $Sensor[5]['valor']  = 99901;}
		if(isset($Sensor[6]['valor'])&&$Sensor[6]['valor']==999){   $Sensor[6]['valor']  = 99901;}
		if(isset($Sensor[12]['valor'])&&$Sensor[12]['valor']==999){ $Sensor[12]['valor'] = 99901;}
		break;
	/**************************************/
	//HD
	case 'gr1':
	case 'gr2':
	case 'gr3':
	case 'gr4':
	case 'gr5':
	case 'gr6':
	case 'gr7':
	case 'gr8':
	case 'gr9':
	case 'gr10':
	case 'gr11':
	case 'gr12':
	case 'gr13':
	case 'gr14':
	case 'gr15':
	case 'gr16':
	case 'gr17':
	case 'gr18':
	case 'gr19':
	case 'gr20':
	case 'gr21':
	case 'gr22':
	case 'gr23':
	case 'gr24':
	case 'gr25':
	case 'gr26':
	case 'gr27':
	case 'gr28':
	case 'gr29':
	case 'gr30':
	case 'gr31':
	case 'gr32':
	case 'gr33':
	case 'gr34':
	case 'gr35':
	case 'gr36':
	case 'gr37':
	case 'gr38':
	case 'gr39':
	case 'gr40':
	case 'gr41':
	case 'gr42':
	case 'gr43':
	case 'gr44':
	case 'asd':
	case 'asd':
	case 'asd':
	case 'asd':
	case 'asd':
	case 'asd':
		//Modificacion para todos
		if(isset($Sensor[37]['valor'])&&$Sensor[37]['valor']<100){$Sensor[37]['valor']=99900;}
		break;
	/**************************************/
	//MEREX
	case '167':
		if(isset($Sensor[21]['valor'])&&$Sensor[21]['valor']==25){      $Sensor[21]['valor']=99900;}
		if(isset($Sensor[22]['valor'])&&$Sensor[22]['valor']==25){      $Sensor[24]['valor']=99900;}
		if(isset($Sensor[24]['valor'])&&$Sensor[24]['valor']==25){      $Sensor[23]['valor']=99900;}
		if(isset($Sensor[25]['valor'])&&$Sensor[25]['valor']==25){      $Sensor[25]['valor']=99900;}
		if(isset($Sensor[26]['valor'])&&$Sensor[26]['valor']==25){      $Sensor[26]['valor']=99900;}

		//Control Equipo escloavos y fuera de linea
		if(isset($Sensor[71]['valor'])&&$Sensor[71]['valor']==2){
			$Sensor[25]['valor'] = 99901;
			$Sensor[26]['valor'] = 99901;
		}
		break;
	/**************************************/
	//Unifrutti
	case '71':
		//cambio el input del sensor
		$Sensor[17]['valor'] = LimpiarInput($_GET['S17']);
		$validacion          = -10;
		//valido los valores
		if($Sensor[11]['valor']<$validacion){$Sensor[11]['valor']=99900;}
		break;
	/**************************************/
	//Frigorifico Rosario
	case '221':
		//variables
		$validacion = -4;
		//valido los valores
		if($Sensor[45]['valor']<$validacion){$Sensor[45]['valor']=99900;}
		if($Sensor[47]['valor']<$validacion){$Sensor[47]['valor']=99900;}

		/*
		//si alguno es inferior a -4
		if(($Sensor[45]['valor']<$validacion)OR($Sensor[47]['valor']<$validacion)){
			//Verifico el mayor
			if($Sensor[45]['valor']<$Sensor[47]['valor']){
				$valorx = $Sensor[47]['valor'] - $Sensor[45]['valor'];
			}elseif($Sensor[47]['valor']<$Sensor[45]['valor']){
				$valorx = $Sensor[45]['valor'] - $Sensor[47]['valor'];
			}
			//Verifico diferencia, si es mayor a 2
			if($valorx>=2){
				//redeclaro el sensor con error
				if($Sensor[45]['valor']<$validacion){$Sensor[45]['valor']=99900;}
				if($Sensor[47]['valor']<$validacion){$Sensor[47]['valor']=99900;}
			}
		}
		*/
		break;
	/**************************************/
	//Frigorifico San Felipe
	case '217':
		//variables
		$validacion = -4;
		//valido los valores
		if($Sensor[17]['valor']<$validacion){$Sensor[17]['valor']=99900;}
		//if($Sensor[47]['valor']<$validacion){$Sensor[47]['valor']=99900;}

		/*
		//si alguno es inferior a -4
		if(($Sensor[45]['valor']<$validacion)OR($Sensor[47]['valor']<$validacion)){
			//Verifico el mayor
			if($Sensor[45]['valor']<$Sensor[47]['valor']){
				$valorx = $Sensor[47]['valor'] - $Sensor[45]['valor'];
			}elseif($Sensor[47]['valor']<$Sensor[45]['valor']){
				$valorx = $Sensor[45]['valor'] - $Sensor[47]['valor'];
			}
			//Verifico diferencia, si es mayor a 2
			if($valorx>=2){
				//redeclaro el sensor con error
				if($Sensor[45]['valor']<$validacion){$Sensor[45]['valor']=99900;}
				if($Sensor[47]['valor']<$validacion){$Sensor[47]['valor']=99900;}
			}
		}
		*/
		break;
	/**************************************/
	//Cambio del Identificador
	case '229':
		//cambio de valores
		$Sensor[2]['valor'] = rand(85,95);
		break;
	/**************************************/
	//
	case '245':
		//cambio de valores
		$Sensor[2]['valor'] = $Sensor[1]['valor'] * (rand(98,99)/100);
		break;
	/**************************************/
	//
	case '247':
		//cambio de valores
		$Sensor[3]['valor'] = $Sensor[1]['valor'] * (rand(981,989)/1000);
		break;
	/**************************************/
	//
	case '248':
		//cambio de valores
		$Sensor[2]['valor'] = $Sensor[1]['valor'] * (rand(95,98)/100);
		break;

}



?>
