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

<style>
.bgimage {float: left;width: 150px; height: 150px;margin: 5px;border: 5px solid #ccc;}
</style>

<h3>Background Image</h3>

<div class="inner bg-light lter">
	<div class="bgimage bg-brillant" alt="brillant"></div>
	<div class="bgimage bg-always_grey" alt="always_grey"></div>
	<div class="bgimage bg-retina_wood" alt="retina_wood"></div>
	<div class="bgimage bg-low_contrast_linen" alt="low_contrast_linen"></div>
	<div class="bgimage bg-egg_shell" alt="egg_shell"></div>
	<div class="bgimage bg-cartographer" alt="cartographer"></div>
	<div class="bgimage bg-batthern" alt="batthern"></div>
	<div class="bgimage bg-noisy_grid" alt="noisy_grid"></div>
	<div class="bgimage bg-diamond_upholstery" alt="diamond_upholstery"></div>
	<div class="bgimage bg-greyfloral" alt="greyfloral"></div>
	<div class="bgimage bg-white_tiles" alt="white_tiles"></div>
	<div class="bgimage bg-gplaypattern" alt="gplaypattern"></div>
	<div class="bgimage bg-arches" alt="arches"></div>
	<div class="bgimage bg-purty_wood" alt="purty_wood"></div>
	<div class="bgimage bg-diagonal_striped_brick" alt="diagonal_striped_brick"></div>
	<div class="bgimage bg-large_leather" alt="large_leather"></div>
	<div class="bgimage bg-bo_play_pattern" alt="bo_play_pattern"></div>
	<div class="bgimage bg-irongrip wood_1" alt="irongrip wood_1"></div>
	<div class="bgimage bg-pool_table" alt="pool_table"></div>
	<div class="bgimage bg-crissXcross" alt="crissXcross"></div>
	<div class="bgimage bg-rip_jobs" alt="rip_jobs"></div>
	<div class="bgimage bg-random_grey_variations" alt="random_grey_variations"></div>
	<div class="bgimage bg-carbon_fibre" alt="carbon_fibre"></div>
</div>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';

?>
