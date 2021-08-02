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
$original = "principal_arriendos_alt.php";
$location = $original;
//Se agregan ubicaciones
if(isset($_GET['Mes']) && $_GET['Mes'] != ''){        $location .= "?Mes=".$_GET['Mes'];        } else { $location .= "?Mes=".mes_actual(); }
if(isset($_GET['Ano']) && $_GET['Ano'] != ''){        $location .= "&Ano=".$_GET['Ano'];        } else { $location .= "&Ano=".ano_actual(); }
if(isset($_GET['idTipo']) && $_GET['idTipo'] != ''){  $location .= "&idTipo=".$_GET['idTipo'];  } else { $location .= "&idTipo=1"; }
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Views.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/

?>

<div class="col-sm-12">
	<?php
	//Manejador de errores
	if(isset($error)&&$error!=''){echo notifications_list($error);};
	//Include de la presentacion
	include '1include_principal_arriendos.php';
	?>
</div>



	

<?php if(isset($_GET['return'])&&$_GET['return']!=''){ ?>
	<div class="clearfix"></div>
		<div class="col-sm-12" style="margin-bottom:30px;margin-top:30px;">
		<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>
<?php } ?>



		
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>
