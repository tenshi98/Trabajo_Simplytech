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
$original = "principal.php";
$location = $original;

/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/

/*****************************************************************************************************************/
/*                                        Se verifica la plataforma                                              */
/*****************************************************************************************************************/
echo obtenerNavegador();
echo obtenerSistOperativo();
/*****************************************************************************************************************/
/*                                Se verifica si se ha cambiado la clave de inicio                               */
/*****************************************************************************************************************/
if($_SESSION['usuario']['basic_data']['password']=='81dc9bdb52d04dc20036dbd8313ed055') {  ?>	
	
	<script type="text/javascript">
		$(window).on('load',function(){
			$('#ModalPass').modal('show');
		});
	</script>

	<!-- Modal -->
	<div class="modal fade" id="ModalPass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Cambio de Contraseña</h4>
				</div>
				<div class="modal-body">
					<p>Aun no ha cambiado su contraseña inicial, 
					por seguridad debe cambiarla ahora, recuerde ingresar una 
					contraseña que le sea facil de recordar.</p>
				</div>
				<div class="modal-footer">
					<a href="principal_datos_password.php" class="btn btn-primary">Cambiar</a>
				</div>
			</div>
		</div>
	</div>
<?php } ?>	
	


			<!-- InstanceBeginEditable name="Bodytext" -->

			<?php include '1include_principal.php'; ?>
			<?php widget_validator(); ?>
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
