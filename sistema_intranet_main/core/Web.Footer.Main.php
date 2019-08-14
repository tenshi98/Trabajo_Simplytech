			</div>
		</div>
	</div> 
</div>
<footer id="footer">
	<p><?php echo ano_actual();?> &copy; <?php echo DB_EMPRESA_NAME ?> Todos los derechos reservados.</p>
</footer>

<!--Otros archivos javascript -->
<script src="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/lib/screenfull/screenfull.js"></script> 
<script src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/js/main.min.js"></script>

<?php
/******************************************************************************************************/
/*                              Ventana Debug Superadministrador                                      */
/******************************************************************************************************/
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Utils.Result.php'; 
/******************************************************************************************************/
//cuadro mensajes
require_once '../LIBS_js/avgrund/avgrund.php';
/******************************************************************************************************/
/*                                                                                                    */
/*                                              CIERRE DE LA BASE                                     */
/*                                                                                                    */
/******************************************************************************************************/
mysqli_close($dbConn);

?>
</body>
</html>
