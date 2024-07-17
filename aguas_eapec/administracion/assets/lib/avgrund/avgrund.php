<link rel="stylesheet" href="assets/lib/avgrund/style.css">
<link rel="stylesheet" href="assets/lib/avgrund/avgrund.css">
<script src="assets/lib/avgrund/jquery.avgrund.js"></script>
<script>
	
function dialogBox(direccion, mensaje){
	
	$(document).avgrund({
		openOnEvent: false,
		height: 200,
		holderClass: 'custom',
		showClose: true,
		showCloseText: 'Cerrar',
		onBlurContainer: '#wrap',
		template: '<p><i class="fa fa-warning fa-2x faa-flash animated" style="color: #ED5E2F;"></i> '+mensaje+'</p>' +
		'<div class="to_bottom">' +
		'<a href="'+ direccion +'" class="btn_ok">Aceptar</a>' +
		'<a href="#" class="btn_cancel avgrund-cierra">Cancelar</a>' +
		'</div>'
	});
	
}

	

</script>
