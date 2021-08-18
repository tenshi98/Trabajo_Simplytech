		<!--Otros archivos javascript -->
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/prism/prism.js"></script>
		<!-- Animacion carga pagina -->
		<script>
			//ocultar el loader
			$(document).ready(function() {
				setTimeout(function(){
					$('body').addClass('loaded');
				}, 1000);
			});
			//ajustar tamaño de todos los textarea
			autosize(document.querySelectorAll('textarea'));
		</script>
	</body>
</html>

