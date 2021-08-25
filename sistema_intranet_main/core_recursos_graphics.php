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
//Cargamos la ubicacion 
$original = "core_sistemas.php";
$location = $original;
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Sistema creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Sistema editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Sistema borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
?>


<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/plotly_js/dist/plotly.min.js"></script>
<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/plotly_js/dist/plotly-locale-es-ar.js"></script>


<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#lineal" data-toggle="tab">Lineales</a></li>
				<li class=""><a href="#barra" data-toggle="tab">Barra</a></li>
				<li class=""><a href="#pie" data-toggle="tab">Torta</a></li>
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
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

?>			
			<div class="tab-pane fade active in" id="lineal">
				<?php GraphLinear_1('graphLinear_1', 'Seleccion Normal', 'Eje-x Titulo', 'Eje-y Titulo', $Graphics_xData, $Graphics_yData, $Graphics_names, $Graphics_types, $Graphics_texts, $Graphics_lineColors, $Graphics_lineDash, $Graphics_lineWidth); ?>
				<?php GraphLinear_2('graphLinear_2', 'Seleccion con Rango', 'Eje-x Titulo', 'Eje-y Titulo', $Graphics_xData, $Graphics_yData, $Graphics_names, $Graphics_types, $Graphics_texts, $Graphics_lineColors, $Graphics_lineDash, $Graphics_lineWidth); ?>
				
			
			</div>	
			
			<div class="tab-pane fade" id="barra">
				<div id="graphBarra_1"></div>
				<div id="graphBarra_2"></div>
				<div id="graphBarra_3"></div>
				<div id="graphBarra_4"></div>
				<div id="graphBarra_5"></div>
			</div>
			
			<div class="tab-pane fade" id="pie">
				<div id="graphPie_1"></div>
				<div id="graphPie_2"></div>
				<div id="graphPie_3"></div>
			</div>	
			
			
        </div>	
	</div>
</div>




<script>



/*****************************************************************/
var data = [
  {
    x: ['giraffes', 'orangutans', 'monkeys'],
    y: [20, 14, 23],
    type: 'bar'
  }
];

Plotly.newPlot('graphBarra_1', data);

/*****************************************************************/
var trace1 = {
  x: ['giraffes', 'orangutans', 'monkeys'],
  y: [20, 14, 23],
  name: 'SF Zoo',
  type: 'bar'
};

var trace2 = {
  x: ['giraffes', 'orangutans', 'monkeys'],
  y: [12, 18, 29],
  name: 'LA Zoo',
  type: 'bar'
};

var data = [trace1, trace2];

var layout = {barmode: 'group'};

Plotly.newPlot('graphBarra_2', data, layout);
/*****************************************************************/
var trace1 = {
  x: ['giraffes', 'orangutans', 'monkeys'],
  y: [20, 14, 23],
  name: 'SF Zoo',
  type: 'bar'
};

var trace2 = {
  x: ['giraffes', 'orangutans', 'monkeys'],
  y: [12, 18, 29],
  name: 'LA Zoo',
  type: 'bar'
};

var data = [trace1, trace2];

var layout = {barmode: 'stack'};

Plotly.newPlot('graphBarra_3', data, layout);

/*****************************************************************/
var xValue = ['Product A', 'Product B', 'Product C'];

var yValue = [20, 14, 23];

var trace1 = {
  x: xValue,
  y: yValue,
  type: 'bar',
  text: yValue.map(String),
  textposition: 'auto',
  hoverinfo: 'none',
  marker: {
    color: 'rgb(158,202,225)',
    opacity: 0.6,
    line: {
      color: 'rgb(8,48,107)',
      width: 1.5
    }
  }
};

var data = [trace1];

var layout = {
  title: 'January 2013 Sales Report',
  barmode: 'stack'
};

Plotly.newPlot('graphBarra_4', data, layout);
/*****************************************************************/
var xValue = ['Product A', 'Product B', 'Product C'];

var yValue = [20, 14, 23];
var yValue2 = [24, 16, 20];

var trace1 = {
  x: xValue,
  y: yValue,
  type: 'bar',
  text: yValue.map(String),
  textposition: 'auto',
  hoverinfo: 'none',
  opacity: 0.5,
  marker: {
    color: 'rgb(158,202,225)',
    line: {
      color: 'rgb(8,48,107)',
      width: 1.5
    }
  }
};

var trace2 = {
  x: xValue,
  y: yValue2,
  type: 'bar',
  text: yValue2.map(String),
  textposition: 'auto',
  hoverinfo: 'none',
  marker: {
    color: 'rgba(58,200,225,.5)',
    line: {
      color: 'rgb(8,48,107)',
      width: 1.5
    }
  }
};

var data = [trace1,trace2];

var layout = {
  title: 'January 2013 Sales Report'
};

Plotly.newPlot('graphBarra_5', data, layout);
/*****************************************************************/
var data = [{
  values: [19, 26, 55],
  labels: ['Residential', 'Non-Residential', 'Utility'],
  type: 'pie'
}];

var layout = {
  height: 400,
  width: 500
};

Plotly.newPlot('graphPie_1', data, layout);


/*****************************************************************/
var data = [{
  values: [16, 15, 12, 6, 5, 4, 42],
  labels: ['US', 'China', 'European Union', 'Russian Federation', 'Brazil', 'India', 'Rest of World' ],
  domain: {column: 0},
  name: 'GHG Emissions',
  hoverinfo: 'label+percent+name',
  hole: .4,
  type: 'pie'
},{
  values: [27, 11, 25, 8, 1, 3, 25],
  labels: ['US', 'China', 'European Union', 'Russian Federation', 'Brazil', 'India', 'Rest of World' ],
  text: 'CO2',
  textposition: 'inside',
  domain: {column: 1},
  name: 'CO2 Emissions',
  hoverinfo: 'label+percent+name',
  hole: .4,
  type: 'pie'
}];

var layout = {
  title: 'Global Emissions 1990-2011',
  annotations: [
    {
      font: {
        size: 20
      },
      showarrow: false,
      text: 'GHG',
      x: 0.17,
      y: 0.5
    },
    {
      font: {
        size: 20
      },
      showarrow: false,
      text: 'CO2',
      x: 0.82,
      y: 0.5
    }
  ],
  height: 400,
  width: 600,
  showlegend: false,
  grid: {rows: 1, columns: 2}
};

Plotly.newPlot('graphPie_2', data, layout);
/*****************************************************************/
var data = [{
  type: "pie",
  values: [2, 3, 4, 4],
  labels: ["Wages", "Operating expenses", "Cost of sales", "Insurance"],
  textinfo: "label+percent",
  textposition: "outside",
  automargin: true
}]

var layout = {
  height: 400,
  width: 400,
  margin: {"t": 0, "b": 0, "l": 0, "r": 0},
  showlegend: false
  }

Plotly.newPlot('graphPie_3', data, layout)
/*****************************************************************/

/*****************************************************************/

/*****************************************************************/

/*****************************************************************/

</script>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
