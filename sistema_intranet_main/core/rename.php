<?php
//se verifica si existe
if(isset($_SESSION['usuario']['basic_data']['idSistema'])){
	//Se verifica el sistema
	switch ($_SESSION['usuario']['basic_data']['idSistema']) {
		//Valores Sistema 1
		case 1:
			$x_column_maquina_sing = 'Maquina';
			$x_column_maquina_plur = 'Maquinas';
			$x_column_lubricacion  = 'Operaciones x Contrato';
			$x_column_cliente_sing = 'Cliente';
			$x_column_cliente_plur = 'Clientes';
			$x_column_producto_cat_sing = 'Categoria';
			$x_column_producto_cat_plur = 'Categorias';
			$x_column_producto_tipo_sing = 'Tipo de Producto';
			$x_column_producto_tipo_plur = 'Tipos de Productos';
			$x_column_producto_nombre_sing = 'Producto';
			$x_column_producto_nombre_plur = 'Productos';
			$x_column_ubicacion  = 'Ubicacion';
			$x_column_ubicacion_item  = 'Itemizado';
			$x_column_ubicacion_lvl_1  = 'Nivel 1';
			$x_column_ubicacion_lvl_2  = 'Nivel 2';
			$x_column_ubicacion_lvl_3  = 'Nivel 3';
			$x_column_ubicacion_lvl_4  = 'Nivel 4';
			$x_column_ubicacion_lvl_5  = 'Nivel 5';
			$x_column_puntomed_aceptable = 'Aceptable';
			$x_column_puntomed_alerta = 'Alerta';
			$x_column_puntomed_condenatorio = 'Condenatorio';
			break;
		
		//Valores Sistema 2
		case 2:
			$x_column_maquina_sing = 'Maquina';
			$x_column_maquina_plur = 'Maquinas';
			$x_column_lubricacion  = 'Operaciones x Contrato';
			$x_column_cliente_sing = 'Cliente';
			$x_column_cliente_plur = 'Clientes';
			$x_column_producto_cat_sing = 'Categoria';
			$x_column_producto_cat_plur = 'Categorias';
			$x_column_producto_tipo_sing = 'Tipo de Producto';
			$x_column_producto_tipo_plur = 'Tipos de Productos';
			$x_column_producto_nombre_sing = 'Nombre';
			$x_column_producto_nombre_plur = 'Nombres';
			$x_column_ubicacion  = 'Ubicacion';
			$x_column_ubicacion_item  = 'Itemizado';
			$x_column_ubicacion_lvl_1  = 'Nivel 1';
			$x_column_ubicacion_lvl_2  = 'Nivel 2';
			$x_column_ubicacion_lvl_3  = 'Nivel 3';
			$x_column_ubicacion_lvl_4  = 'Nivel 4';
			$x_column_ubicacion_lvl_5  = 'Nivel 5';
			$x_column_puntomed_aceptable = 'Aceptable';
			$x_column_puntomed_alerta = 'Alerta';
			$x_column_puntomed_condenatorio = 'Condenatorio';
			break;
		
		//Valores Sistema 3
		case 3:
			$x_column_maquina_sing = 'Maquina';
			$x_column_maquina_plur = 'Maquinas';
			$x_column_lubricacion  = 'Operaciones x Contrato';
			$x_column_cliente_sing = 'Cliente';
			$x_column_cliente_plur = 'Clientes';
			$x_column_producto_cat_sing = 'Categoria';
			$x_column_producto_cat_plur = 'Categorias';
			$x_column_producto_tipo_sing = 'Tipo de Producto';
			$x_column_producto_tipo_plur = 'Tipos de Productos';
			$x_column_producto_nombre_sing = 'Nombre';
			$x_column_producto_nombre_plur = 'Nombres';
			$x_column_ubicacion  = 'Ubicacion';
			$x_column_ubicacion_item  = 'Itemizado';
			$x_column_ubicacion_lvl_1  = 'Nivel 1';
			$x_column_ubicacion_lvl_2  = 'Nivel 2';
			$x_column_ubicacion_lvl_3  = 'Nivel 3';
			$x_column_ubicacion_lvl_4  = 'Nivel 4';
			$x_column_ubicacion_lvl_5  = 'Nivel 5';
			$x_column_puntomed_aceptable = 'Aceptable';
			$x_column_puntomed_alerta = 'Alerta';
			$x_column_puntomed_condenatorio = 'Condenatorio';
			break;
		
		//Valores Sistema 4
		case 4:
			$x_column_maquina_sing = 'Maquina';
			$x_column_maquina_plur = 'Maquinas';
			$x_column_lubricacion  = 'Operaciones x Contrato';
			$x_column_cliente_sing = 'Cliente';
			$x_column_cliente_plur = 'Clientes';
			$x_column_producto_cat_sing = 'Categoria';
			$x_column_producto_cat_plur = 'Categorias';
			$x_column_producto_tipo_sing = 'Tipo de Producto';
			$x_column_producto_tipo_plur = 'Tipos de Productos';
			$x_column_producto_nombre_sing = 'Nombre';
			$x_column_producto_nombre_plur = 'Nombres';
			$x_column_ubicacion  = 'Ubicacion';
			$x_column_ubicacion_item  = 'Itemizado';
			$x_column_ubicacion_lvl_1  = 'Nivel 1';
			$x_column_ubicacion_lvl_2  = 'Nivel 2';
			$x_column_ubicacion_lvl_3  = 'Nivel 3';
			$x_column_ubicacion_lvl_4  = 'Nivel 4';
			$x_column_ubicacion_lvl_5  = 'Nivel 5';
			$x_column_puntomed_aceptable = 'Aceptable';
			$x_column_puntomed_alerta = 'Alerta';
			$x_column_puntomed_condenatorio = 'Condenatorio';
			break;
		
		//Valores Sistema 5
		case 5:
			$x_column_maquina_sing = 'Maquina';
			$x_column_maquina_plur = 'Maquinas';
			$x_column_lubricacion  = 'Operaciones x Contrato';
			$x_column_cliente_sing = 'Cliente';
			$x_column_cliente_plur = 'Clientes';
			$x_column_producto_cat_sing = 'Categoria';
			$x_column_producto_cat_plur = 'Categorias';
			$x_column_producto_tipo_sing = 'Tipo de Producto';
			$x_column_producto_tipo_plur = 'Tipos de Productos';
			$x_column_producto_nombre_sing = 'Nombre';
			$x_column_producto_nombre_plur = 'Nombres';
			$x_column_ubicacion  = 'Ubicacion';
			$x_column_ubicacion_item  = 'Itemizado';
			$x_column_ubicacion_lvl_1  = 'Nivel 1';
			$x_column_ubicacion_lvl_2  = 'Nivel 2';
			$x_column_ubicacion_lvl_3  = 'Nivel 3';
			$x_column_ubicacion_lvl_4  = 'Nivel 4';
			$x_column_ubicacion_lvl_5  = 'Nivel 5';
			$x_column_puntomed_aceptable = 'Aceptable';
			$x_column_puntomed_alerta = 'Alerta';
			$x_column_puntomed_condenatorio = 'Condenatorio';
			break;
		
		//Valores Sistema 6
		case 6:
			$x_column_maquina_sing = 'Maquina';
			$x_column_maquina_plur = 'Maquinas';
			$x_column_lubricacion  = 'Operaciones x Contrato';
			$x_column_cliente_sing = 'Cliente';
			$x_column_cliente_plur = 'Clientes';
			$x_column_producto_cat_sing = 'Categoria';
			$x_column_producto_cat_plur = 'Categorias';
			$x_column_producto_tipo_sing = 'Tipo de Producto';
			$x_column_producto_tipo_plur = 'Tipos de Productos';
			$x_column_producto_nombre_sing = 'Nombre';
			$x_column_producto_nombre_plur = 'Nombres';
			$x_column_ubicacion  = 'Ubicacion';
			$x_column_ubicacion_item  = 'Itemizado';
			$x_column_ubicacion_lvl_1  = 'Nivel 1';
			$x_column_ubicacion_lvl_2  = 'Nivel 2';
			$x_column_ubicacion_lvl_3  = 'Nivel 3';
			$x_column_ubicacion_lvl_4  = 'Nivel 4';
			$x_column_ubicacion_lvl_5  = 'Nivel 5';
			$x_column_puntomed_aceptable = 'Aceptable';
			$x_column_puntomed_alerta = 'Alerta';
			$x_column_puntomed_condenatorio = 'Condenatorio';
			break;
		
		//Valores Sistema 7
		case 7:
			$x_column_maquina_sing = 'Maquina';
			$x_column_maquina_plur = 'Maquinas';
			$x_column_lubricacion  = 'Operaciones x Contrato';
			$x_column_cliente_sing = 'Cliente';
			$x_column_cliente_plur = 'Clientes';
			$x_column_producto_cat_sing = 'Categoria';
			$x_column_producto_cat_plur = 'Categorias';
			$x_column_producto_tipo_sing = 'Tipo de Producto';
			$x_column_producto_tipo_plur = 'Tipos de Productos';
			$x_column_producto_nombre_sing = 'Nombre';
			$x_column_producto_nombre_plur = 'Nombres';
			$x_column_ubicacion  = 'Ubicacion';
			$x_column_ubicacion_item  = 'Itemizado';
			$x_column_ubicacion_lvl_1  = 'Nivel 1';
			$x_column_ubicacion_lvl_2  = 'Nivel 2';
			$x_column_ubicacion_lvl_3  = 'Nivel 3';
			$x_column_ubicacion_lvl_4  = 'Nivel 4';
			$x_column_ubicacion_lvl_5  = 'Nivel 5';
			$x_column_puntomed_aceptable = 'Aceptable';
			$x_column_puntomed_alerta = 'Alerta';
			$x_column_puntomed_condenatorio = 'Condenatorio';
			break;
		
		//Valores Sistema 8
		case 8:
			$x_column_maquina_sing = 'Maquina';
			$x_column_maquina_plur = 'Maquinas';
			$x_column_lubricacion  = 'Operaciones x Contrato';
			$x_column_cliente_sing = 'Cliente';
			$x_column_cliente_plur = 'Clientes';
			$x_column_producto_cat_sing = 'Categoria';
			$x_column_producto_cat_plur = 'Categorias';
			$x_column_producto_tipo_sing = 'Tipo de Producto';
			$x_column_producto_tipo_plur = 'Tipos de Productos';
			$x_column_producto_nombre_sing = 'Nombre';
			$x_column_producto_nombre_plur = 'Nombres';
			$x_column_ubicacion  = 'Ubicacion';
			$x_column_ubicacion_item  = 'Itemizado';
			$x_column_ubicacion_lvl_1  = 'Nivel 1';
			$x_column_ubicacion_lvl_2  = 'Nivel 2';
			$x_column_ubicacion_lvl_3  = 'Nivel 3';
			$x_column_ubicacion_lvl_4  = 'Nivel 4';
			$x_column_ubicacion_lvl_5  = 'Nivel 5';
			$x_column_puntomed_aceptable = 'Aceptable';
			$x_column_puntomed_alerta = 'Alerta';
			$x_column_puntomed_condenatorio = 'Condenatorio';
			break;
		
		//Valores Sistema 9
		case 9:
			$x_column_maquina_sing = 'Maquina';
			$x_column_maquina_plur = 'Maquinas';
			$x_column_lubricacion  = 'Operaciones x Contrato';
			$x_column_cliente_sing = 'Cliente';
			$x_column_cliente_plur = 'Clientes';
			$x_column_producto_cat_sing = 'Categoria';
			$x_column_producto_cat_plur = 'Categorias';
			$x_column_producto_tipo_sing = 'Tipo de Producto';
			$x_column_producto_tipo_plur = 'Tipos de Productos';
			$x_column_producto_nombre_sing = 'Nombre';
			$x_column_producto_nombre_plur = 'Nombres';
			$x_column_ubicacion  = 'Ubicacion';
			$x_column_ubicacion_item  = 'Itemizado';
			$x_column_ubicacion_lvl_1  = 'Nivel 1';
			$x_column_ubicacion_lvl_2  = 'Nivel 2';
			$x_column_ubicacion_lvl_3  = 'Nivel 3';
			$x_column_ubicacion_lvl_4  = 'Nivel 4';
			$x_column_ubicacion_lvl_5  = 'Nivel 5';
			$x_column_puntomed_aceptable = 'Aceptable';
			$x_column_puntomed_alerta = 'Alerta';
			$x_column_puntomed_condenatorio = 'Condenatorio';
			break;
		
		//Valores Sistema 10
		case 10:
			$x_column_maquina_sing = 'Maquina';
			$x_column_maquina_plur = 'Maquinas';
			$x_column_lubricacion  = 'Operaciones x Contrato';
			$x_column_cliente_sing = 'Cliente';
			$x_column_cliente_plur = 'Clientes';
			$x_column_producto_cat_sing = 'Categoria';
			$x_column_producto_cat_plur = 'Categorias';
			$x_column_producto_tipo_sing = 'Tipo de Producto';
			$x_column_producto_tipo_plur = 'Tipos de Productos';
			$x_column_producto_nombre_sing = 'Nombre';
			$x_column_producto_nombre_plur = 'Nombres';
			$x_column_ubicacion  = 'Ubicacion';
			$x_column_ubicacion_item  = 'Itemizado';
			$x_column_ubicacion_lvl_1  = 'Nivel 1';
			$x_column_ubicacion_lvl_2  = 'Nivel 2';
			$x_column_ubicacion_lvl_3  = 'Nivel 3';
			$x_column_ubicacion_lvl_4  = 'Nivel 4';
			$x_column_ubicacion_lvl_5  = 'Nivel 5';
			$x_column_puntomed_aceptable = 'Aceptable';
			$x_column_puntomed_alerta = 'Alerta';
			$x_column_puntomed_condenatorio = 'Condenatorio';
			break;
		
		//Valores Sistema 11
		case 11:
			$x_column_maquina_sing = 'Unidad de Negocio';
			$x_column_maquina_plur = 'Unidades de Negocio';
			$x_column_lubricacion  = 'Operaciones x Proyecto';
			$x_column_cliente_sing = 'Proyecto';
			$x_column_cliente_plur = 'Proyectos';
			$x_column_producto_cat_sing = 'Categoria';
			$x_column_producto_cat_plur = 'Categorias';
			$x_column_producto_tipo_sing = 'Tipo de Producto';
			$x_column_producto_tipo_plur = 'Tipos de Productos';
			$x_column_producto_nombre_sing = 'Nombre';
			$x_column_producto_nombre_plur = 'Nombres';
			$x_column_ubicacion  = 'Ubicacion';
			$x_column_ubicacion_item  = 'Itemizado';
			$x_column_ubicacion_lvl_1  = 'Nivel 1';
			$x_column_ubicacion_lvl_2  = 'Nivel 2';
			$x_column_ubicacion_lvl_3  = 'Nivel 3';
			$x_column_ubicacion_lvl_4  = 'Nivel 4';
			$x_column_ubicacion_lvl_5  = 'Nivel 5';
			$x_column_puntomed_aceptable = 'Aceptable';
			$x_column_puntomed_alerta = 'Alerta';
			$x_column_puntomed_condenatorio = 'Condenatorio';
			break;
			
		//Valores Sistema 12
		case 12:
			$x_column_maquina_sing = 'Maquina';
			$x_column_maquina_plur = 'Maquinas';
			$x_column_lubricacion  = 'Operaciones x Contrato';
			$x_column_cliente_sing = 'Cliente';
			$x_column_cliente_plur = 'Clientes';
			$x_column_producto_cat_sing = 'Categoria';
			$x_column_producto_cat_plur = 'Categorias';
			$x_column_producto_tipo_sing = 'Tipo de Producto';
			$x_column_producto_tipo_plur = 'Tipos de Productos';
			$x_column_producto_nombre_sing = 'Producto';
			$x_column_producto_nombre_plur = 'Productos';
			$x_column_ubicacion  = 'Ubicacion';
			$x_column_ubicacion_item  = 'Itemizado';
			$x_column_ubicacion_lvl_1  = 'Nivel 1';
			$x_column_ubicacion_lvl_2  = 'Nivel 2';
			$x_column_ubicacion_lvl_3  = 'Nivel 3';
			$x_column_ubicacion_lvl_4  = 'Nivel 4';
			$x_column_ubicacion_lvl_5  = 'Nivel 5';
			$x_column_puntomed_aceptable = 'Aceptable';
			$x_column_puntomed_alerta = 'Alerta';
			$x_column_puntomed_condenatorio = 'Condenatorio';
			break;
			
		//Valores Sistema 13
		case 13:
			$x_column_maquina_sing = 'Maquina';
			$x_column_maquina_plur = 'Maquinas';
			$x_column_lubricacion  = 'Operaciones x Contrato';
			$x_column_cliente_sing = 'Cliente';
			$x_column_cliente_plur = 'Clientes';
			$x_column_producto_cat_sing = 'Categoria';
			$x_column_producto_cat_plur = 'Categorias';
			$x_column_producto_tipo_sing = 'Tipo de Producto';
			$x_column_producto_tipo_plur = 'Tipos de Productos';
			$x_column_producto_nombre_sing = 'Producto';
			$x_column_producto_nombre_plur = 'Productos';
			$x_column_ubicacion  = 'Ubicacion';
			$x_column_ubicacion_item  = 'Itemizado';
			$x_column_ubicacion_lvl_1  = 'Nivel 1';
			$x_column_ubicacion_lvl_2  = 'Nivel 2';
			$x_column_ubicacion_lvl_3  = 'Nivel 3';
			$x_column_ubicacion_lvl_4  = 'Nivel 4';
			$x_column_ubicacion_lvl_5  = 'Nivel 5';
			$x_column_puntomed_aceptable = 'Aceptable';
			$x_column_puntomed_alerta = 'Alerta';
			$x_column_puntomed_condenatorio = 'Condenatorio';
			break;
			
		//Valores Sistema 14
		case 14:
			$x_column_maquina_sing = 'Maquina';
			$x_column_maquina_plur = 'Maquinas';
			$x_column_lubricacion  = 'Operaciones x Contrato';
			$x_column_cliente_sing = 'Cliente';
			$x_column_cliente_plur = 'Clientes';
			$x_column_producto_cat_sing = 'Categoria';
			$x_column_producto_cat_plur = 'Categorias';
			$x_column_producto_tipo_sing = 'Tipo de Producto';
			$x_column_producto_tipo_plur = 'Tipos de Productos';
			$x_column_producto_nombre_sing = 'Producto';
			$x_column_producto_nombre_plur = 'Productos';
			$x_column_ubicacion  = 'Ubicacion';
			$x_column_ubicacion_item  = 'Itemizado';
			$x_column_ubicacion_lvl_1  = 'Nivel 1';
			$x_column_ubicacion_lvl_2  = 'Nivel 2';
			$x_column_ubicacion_lvl_3  = 'Nivel 3';
			$x_column_ubicacion_lvl_4  = 'Nivel 4';
			$x_column_ubicacion_lvl_5  = 'Nivel 5';
			$x_column_puntomed_aceptable = 'Aceptable';
			$x_column_puntomed_alerta = 'Alerta';
			$x_column_puntomed_condenatorio = 'Condenatorio';
			break;
			
		//Valores Sistema 15
		case 15:
			$x_column_maquina_sing = 'Maquina';
			$x_column_maquina_plur = 'Maquinas';
			$x_column_lubricacion  = 'Operaciones x Contrato';
			$x_column_cliente_sing = 'Cliente';
			$x_column_cliente_plur = 'Clientes';
			$x_column_producto_cat_sing = 'Categoria';
			$x_column_producto_cat_plur = 'Categorias';
			$x_column_producto_tipo_sing = 'Tipo de Producto';
			$x_column_producto_tipo_plur = 'Tipos de Productos';
			$x_column_producto_nombre_sing = 'Producto';
			$x_column_producto_nombre_plur = 'Productos';
			$x_column_ubicacion  = 'Ubicacion';
			$x_column_ubicacion_item  = 'Itemizado';
			$x_column_ubicacion_lvl_1  = 'Nivel 1';
			$x_column_ubicacion_lvl_2  = 'Nivel 2';
			$x_column_ubicacion_lvl_3  = 'Nivel 3';
			$x_column_ubicacion_lvl_4  = 'Nivel 4';
			$x_column_ubicacion_lvl_5  = 'Nivel 5';
			$x_column_puntomed_aceptable = 'Aceptable';
			$x_column_puntomed_alerta = 'Alerta';
			$x_column_puntomed_condenatorio = 'Condenatorio';
			break;
			
		//Valores Sistema 16
		case 16:
			$x_column_maquina_sing = 'Maquina';
			$x_column_maquina_plur = 'Maquinas';
			$x_column_lubricacion  = 'Operaciones x Contrato';
			$x_column_cliente_sing = 'Cliente';
			$x_column_cliente_plur = 'Clientes';
			$x_column_producto_cat_sing = 'Categoria';
			$x_column_producto_cat_plur = 'Categorias';
			$x_column_producto_tipo_sing = 'Tipo de Producto';
			$x_column_producto_tipo_plur = 'Tipos de Productos';
			$x_column_producto_nombre_sing = 'Producto';
			$x_column_producto_nombre_plur = 'Productos';
			$x_column_ubicacion  = 'Ubicacion';
			$x_column_ubicacion_item  = 'Itemizado';
			$x_column_ubicacion_lvl_1  = 'Nivel 1';
			$x_column_ubicacion_lvl_2  = 'Nivel 2';
			$x_column_ubicacion_lvl_3  = 'Nivel 3';
			$x_column_ubicacion_lvl_4  = 'Nivel 4';
			$x_column_ubicacion_lvl_5  = 'Nivel 5';
			$x_column_puntomed_aceptable = 'Aceptable';
			$x_column_puntomed_alerta = 'Alerta';
			$x_column_puntomed_condenatorio = 'Condenatorio';
			break;

		//Valores Sistema 17
		case 17:
			$x_column_maquina_sing = 'Maquina';
			$x_column_maquina_plur = 'Maquinas';
			$x_column_lubricacion  = 'Operaciones x Contrato';
			$x_column_cliente_sing = 'Cliente';
			$x_column_cliente_plur = 'Clientes';
			$x_column_producto_cat_sing = 'Categoria';
			$x_column_producto_cat_plur = 'Categorias';
			$x_column_producto_tipo_sing = 'Tipo de Producto';
			$x_column_producto_tipo_plur = 'Tipos de Productos';
			$x_column_producto_nombre_sing = 'Producto';
			$x_column_producto_nombre_plur = 'Productos';
			$x_column_ubicacion  = 'Ubicacion';
			$x_column_ubicacion_item  = 'Itemizado';
			$x_column_ubicacion_lvl_1  = 'Nivel 1';
			$x_column_ubicacion_lvl_2  = 'Nivel 2';
			$x_column_ubicacion_lvl_3  = 'Nivel 3';
			$x_column_ubicacion_lvl_4  = 'Nivel 4';
			$x_column_ubicacion_lvl_5  = 'Nivel 5';
			$x_column_puntomed_aceptable = 'Aceptable';
			$x_column_puntomed_alerta = 'Alerta';
			$x_column_puntomed_condenatorio = 'Condenatorio';
			break;
		

		   
	}
//si no existe muestra valores por defecto	
}else{
	$x_column_maquina_sing = 'Maquina';
	$x_column_maquina_plur = 'Maquinas';
	$x_column_lubricacion  = 'Operaciones x Contrato';
	$x_column_cliente_sing = 'Cliente';
	$x_column_cliente_plur = 'Clientes';
	$x_column_producto_cat_sing = 'Categoria';
	$x_column_producto_cat_plur = 'Categorias';
	$x_column_producto_tipo_sing = 'Tipo de Producto';
	$x_column_producto_tipo_plur = 'Tipos de Productos';
	$x_column_producto_nombre_sing = 'Producto';
	$x_column_producto_nombre_plur = 'Productos';
	$x_column_ubicacion  = 'Ubicacion';
	$x_column_ubicacion_item  = 'Itemizado';
	$x_column_ubicacion_lvl_1  = 'Nivel 1';
	$x_column_ubicacion_lvl_2  = 'Nivel 2';
	$x_column_ubicacion_lvl_3  = 'Nivel 3';
	$x_column_ubicacion_lvl_4  = 'Nivel 4';
	$x_column_ubicacion_lvl_5  = 'Nivel 5';
	$x_column_puntomed_aceptable = 'Aceptable';
	$x_column_puntomed_alerta = 'Alerta';
	$x_column_puntomed_condenatorio = 'Condenatorio';
}



?>
