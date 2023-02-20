<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Web.php';
//Verifico si es superusuario
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Type.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion original
$original = "core_sistemas.php";
$location = $original;
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
?>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#lineal" data-toggle="tab">Lineales</a></li>
				<li class=""><a href="#barra" data-toggle="tab">Barra</a></li>
				<li class=""><a href="#barraLat" data-toggle="tab">Barra Lateral</a></li>
				<li class=""><a href="#pie" data-toggle="tab">Torta</a></li>
				<li class=""><a href="#embudo" data-toggle="tab">Embudo</a></li>
			</ul>
		</header>
        <div class="tab-content">
		
			<div class="tab-pane fade active in" id="lineal">
				<?php
				$Graphics_xData = 'var xData = [
				  [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2013, 2014, 2015, 2016],
				  [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2013, 2014, 2015, 2016],
				  [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2013, 2014, 2015, 2016],
				  [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2013, 2014, 2015, 2016],
				  [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2013, 2014, 2015, 2016],
				  [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2013, 2014, 2015, 2016],
				  [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2013, 2014, 2015, 2016]
				];';	
				$Graphics_yData = 'var yData = [
				  [10, 15, 13, 17, 10, 15, 13, 17, 10, 15, 13, 17, 10, 15, 13, 17],
				  [12, 17, 15, 19, 12, 17, 15, 19, 12, 17, 15, 19, 12, 17, 15, 19],
				  [14, 19, 17, 21, 14, 19, 17, 21, 14, 19, 17, 21, 14, 19, 17, 21],
				  [16, 21, 19, 23, 16, 21, 19, 23, 16, 21, 19, 23, 16, 21, 19, 23],
				  [18, 23, 21, 25, 18, 23, 21, 25, 18, 23, 21, 25, 18, 23, 21, 25],
				  [20, 25, 23, 27, 20, 25, 23, 27, 20, 25, 23, 27, 20, 25, 23, 27],
				  [22, 27, 25, 29, 22, 27, 25, 29, 22, 27, 25, 29, 22, 27, 25, 29],
				];';
				$Graphics_names = "var names = ['Normal', 'Solo linea', 'Solo marcador', 'Linea+marcador', 'Comentario simple', 'dashdot', 'dot'];";
				$Graphics_types = "var types = ['', 'lines', 'markers', 'lines+markers', '', '', ''];";
				$Graphics_texts = "var texts = [ 
				[],
				[],
				[],
				[],
				['1° Linea de prueba A<br>2° Linea de prueba A', 
				  '1° Linea de prueba B<br>2° Linea de prueba B', 
				  '1° Linea de prueba C<br>2° Linea de prueba C', 
				  '1° Linea de prueba D<br>2° Linea de prueba D', 
				  '1° Linea de prueba E<br>2° Linea de prueba E', 
				  '1° Linea de prueba F<br>2° Linea de prueba F', 
				  '1° Linea de prueba G<br>2° Linea de prueba G', 
				  '1° Linea de prueba H<br>2° Linea de prueba H', 
				  '1° Linea de prueba I<br>2° Linea de prueba I', 
				  '1° Linea de prueba J<br>2° Linea de prueba J', 
				  '1° Linea de prueba K<br>2° Linea de prueba K', 
				  '1° Linea de prueba L<br>2° Linea de prueba L', 
				  '1° Linea de prueba M<br>2° Linea de prueba M', 
				  '1° Linea de prueba N<br>2° Linea de prueba N', 
				  '1° Linea de prueba O<br>2° Linea de prueba O', 
				  '1° Linea de prueba P<br>2° Linea de prueba P'],
				[],
				[]
				];";
				$Graphics_lineColors = "var lineColors = ['#FF0000', '#1E90FF', '#90EE90','#800080','#4D4D4D','#FFA500','#90EE90'];";
				$Graphics_lineDash = "var lineDash = ['', '', '','','','dashdot','dot'];";
				$Graphics_lineWidth = "var lineWidth = ['', '', '','','','4','4'];";

				echo GraphLinear_1('graphLinear_1', 'Seleccion Normal', 'Eje-x Titulo', 'Eje-y Titulo', $Graphics_xData, $Graphics_yData, $Graphics_names, $Graphics_types, $Graphics_texts, $Graphics_lineColors, $Graphics_lineDash, $Graphics_lineWidth, 0); 
				echo GraphLinear_2('graphLinear_2', 'Seleccion con Rango', 'Eje-x Titulo', 'Eje-y Titulo', $Graphics_xData, $Graphics_yData, $Graphics_names, $Graphics_types, $Graphics_texts, $Graphics_lineColors, $Graphics_lineDash, $Graphics_lineWidth, 0); 
				
				?>
			</div>

			<div class="tab-pane fade" id="barra">
				<?php 
				/***************************************************************/
				$Graphics_xData = 'var xData = [
				  [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2013, 2014, 2015, 2016],
				];';	
				$Graphics_yData = 'var yData = [
				  [10, 15, 13, 17, 10, 15, 13, 17, 10, 15, 13, 17, 10, 15, 13, 17],
				];';
				$Graphics_names       = "var names = ['Normal'];";
				$Graphics_info        = "var grf_info = [''];";
				$Graphics_markerColor = "var markerColor = [''];";
				$Graphics_markerLine  = "var markerLine = [''];";
				
				echo GraphBarr_1('graphBarra_1', 'Basico', 'Eje-x Titulo', 'Eje-y Titulo', $Graphics_xData, $Graphics_yData, $Graphics_names, $Graphics_info, $Graphics_markerColor, $Graphics_markerLine,1, 0); 
				
				/***************************************************************/
				$Graphics_xData = 'var xData = [
				  [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2013, 2014, 2015, 2016],
				  [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2013, 2014, 2015, 2016],
				  [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2013, 2014, 2015, 2016],
				  [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2013, 2014, 2015, 2016],
				  [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2013, 2014, 2015, 2016],
				];';	
				$Graphics_yData = 'var yData = [
				  [10, 15, 13, 17, 10, 15, 13, 17, 10, 15, 13, 17, 10, 15, 13, 17],
				  [12, 17, 15, 19, 12, 17, 15, 19, 12, 17, 15, 19, 12, 17, 15, 19],
				  [14, 19, 17, 21, 14, 19, 17, 21, 14, 19, 17, 21, 14, 19, 17, 21],
				  [16, 21, 19, 23, 16, 21, 19, 23, 16, 21, 19, 23, 16, 21, 19, 23],
				  [18, 23, 21, 25, 18, 23, 21, 25, 18, 23, 21, 25, 18, 23, 21, 25],
				];';
				$Graphics_names       = "var names = ['data 1', 'data 2', 'data 3', 'data 4', 'data 5'];";
				$Graphics_info        = "var grf_info = ['','','','',''];";
				$Graphics_markerColor = "var markerColor = ['','','','',''];";
				$Graphics_markerLine  = "var markerLine = ['','','','',''];";
				
				echo GraphBarr_1('graphBarra_2', 'Agrupado', 'Eje-x Titulo', 'Eje-y Titulo', $Graphics_xData, $Graphics_yData, $Graphics_names, $Graphics_info, $Graphics_markerColor, $Graphics_markerLine,1, 1); 
				echo GraphBarr_1('graphBarra_3', 'Apilado', 'Eje-x Titulo', 'Eje-y Titulo', $Graphics_xData, $Graphics_yData, $Graphics_names, $Graphics_info, $Graphics_markerColor, $Graphics_markerLine,2, 2); 
				
				?>
			</div>

			<div class="tab-pane fade" id="barraLat">
				<?php
				/***************************************************************/
				$Graphics_xData = 'var xData = [
				  [10, 15, 13, 17, 10, 15, 13, 17, 10, 15, 13, 17],
				];';
				$Graphics_yData = "var yData = [
				  ['test 1', 'test 2', 'test 3', 'test 4', 'test 5', 'test 6', 'test 7', 'test 8', 'test 9', 'test 10', 'test 11'],
				];";	
				$Graphics_names       = "var names = ['Normal'];";
				$Graphics_info        = "var grf_info = [''];";
				$Graphics_markerColor = "var markerColor = [''];";
				$Graphics_markerLine  = "var markerLine = [''];";
				
				echo GraphBarrLat_1('graphBarraLat_1', 'Basico', 'Eje-x Titulo', 'Eje-y Titulo', $Graphics_xData, $Graphics_yData, $Graphics_names, $Graphics_info, $Graphics_markerColor, $Graphics_markerLine,1, 0); 
				
				/***************************************************************/
				$Graphics_xData = 'var xData = [
				  [10, 15, 13, 17, 10, 15, 13, 17, 10],
				  [12, 17, 15, 19, 12, 17, 15, 19, 12],
				];';
				$Graphics_yData = 'var yData = [
				  [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008],
				  [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008],
				];';	
				$Graphics_names       = "var names = ['data 1', 'data 2'];";
				$Graphics_info        = "var grf_info = ['',''];";
				$Graphics_markerColor = "var markerColor = ['',''];";
				$Graphics_markerLine  = "var markerLine = ['',''];";
				
				echo GraphBarrLat_1('graphBarraLat_2', 'Agrupado', 'Eje-x Titulo', 'Eje-y Titulo', $Graphics_xData, $Graphics_yData, $Graphics_names, $Graphics_info, $Graphics_markerColor, $Graphics_markerLine,1, 1); 
				echo GraphBarrLat_1('graphBarraLat_3', 'Apilado', 'Eje-x Titulo', 'Eje-y Titulo', $Graphics_xData, $Graphics_yData, $Graphics_names, $Graphics_info, $Graphics_markerColor, $Graphics_markerLine,2, 3); 
				
				?>
			</div>
				
			<div class="tab-pane fade" id="pie">
				<?php
				$Graphics_values = 'var allValues = [2, 3, 4, 4];';
				$Graphics_labels = 'var allLabels = ["Wages", "Operating expenses", "Cost of sales", "Insurance"];';
				$Graphics_width  = 600;
				$Graphics_height = 400;
				
				echo GraphPie_1('graphPie_1', 'Normal', $Graphics_values,$Graphics_labels,$Graphics_width,$Graphics_height, 1,0);
				echo GraphPie_1('graphPie_2', 'Valores fuera', $Graphics_values,$Graphics_labels,$Graphics_width,$Graphics_height, 2,1);
				echo GraphPie_1('graphPie_3', 'Donut Chart', $Graphics_values,$Graphics_labels,$Graphics_width,$Graphics_height, 3,0);
				
				?>
			</div>

			<div class="tab-pane fade" id="embudo">
				<?php
				$Graphics_xData = 'var xData = [225, 220, 100, 88, 78, 65, 56, 46, 43, 25, 13, 7];';
				$Graphics_yData = "var yData = ['test 1', 'test 2', 'test 3', 'test 4', 'test 5', 'test 6', 'test 7', 'test 8', 'test 9', 'test 10', 'test 11'];";	
				$Graphics_width  = 1000;
				$Graphics_height = 800;
				
				echo GraphEmbudo_1('graphEmbudo_1', 'Normal', $Graphics_xData, $Graphics_yData, $Graphics_width, $Graphics_height, 0);
				?>
			</div>
				
        </div>
	</div>
</div>






<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
