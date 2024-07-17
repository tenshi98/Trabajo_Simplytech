<footer id="footer">
<?php if (isset($arrUsuario['RazonSocial'])&&$arrUsuario['RazonSocial']!=''){?>
   	<p><?php echo ano_actual();?> &copy; <?php echo $arrUsuario['RazonSocial']; ?>. Todos los derechos reservados.</p>
<?php }else{?>
	<p><?php echo ano_actual();?> &copy;  Todos los derechos reservados.</p>
<?php } ?>    
</footer>

<!--Otros archivos javascript -->
<script src="assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/lib/screenfull/screenfull.js"></script> 
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/main.min.js"></script>
