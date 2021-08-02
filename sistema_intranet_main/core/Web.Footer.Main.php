			</div>
		</div>
	</div> 
</div>
<footer id="footer">
	<p><?php echo ano_actual();?> &copy; <?php echo DB_EMPRESA_NAME ?> Todos los derechos reservados.</p>
</footer>

<!-- Animacion carga pagina -->
<script>
	$(document).ready(function() {
		setTimeout(function(){
			$('body').addClass('loaded');
		}, 500);
	});
</script>

<!--Otros archivos javascript -->
<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIB_assets/lib/bootstrap3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIB_assets/lib/screenfull/screenfull.js"></script> 
<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIB_assets/js/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIB_assets/js/main.min.js"></script>
<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/prism/prism.js"></script>

<?php
/******************************************************************************************************/
/*                              Ventana Debug Superadministrador                                      */
/******************************************************************************************************/
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Utils.Result.php'; 
/******************************************************************************************************/
//cuadro mensajes
widget_avgrund();
/******************************************************************************************************/
/*                                                                                                    */
/*                                              CIERRE DE LA BASE                                     */
/*                                                                                                    */
/******************************************************************************************************/
mysqli_close($dbConn);

?>
		
		<!-- Librerias -->
		<?php widget_tooltipster();?>
	</body>
</html>
