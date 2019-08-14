//Confirmacion de eliminacion
function add_job(data,direccion){
	var datas = document.getElementById('idItemList_'+data).value
	location=direccion+'&val_select='+datas;
} 
//Confirmacion de eliminacion
function add_sup(direccion){
	var datas = document.getElementById('idSupervisor').value
	location=direccion+'&val_select='+datas;
} 
//Confirmacion de eliminacion
function addtemp(direccion, valorid){
	var t0 = document.getElementById('T0_'+valorid).value
	var t1 = document.getElementById('T1_'+valorid).value
	var t2 = document.getElementById('T2_'+valorid).value
	var t3 = document.getElementById('T3_'+valorid).value
	var t4 = document.getElementById('T4_'+valorid).value
	var Observacion = document.getElementById('Observacion_'+valorid).value
	location=direccion+'&T0='+t0+'&T1='+t1+'&T2='+t2+'&T3='+t3+'&T4='+t4+'&Observacion='+Observacion;
}
//Confirmacion de eliminacion
function addaceite(direccion, valorid){
	var idEstadoAceite = document.getElementById('idEstadoAceite_'+valorid).value
	var idNivelAgua = document.getElementById('idNivelAgua_'+valorid).value
	var idNivelAceite = document.getElementById('idNivelAceite_'+valorid).value
	var idNivelSilice = document.getElementById('idNivelSilice_'+valorid).value
	var TempAceite = document.getElementById('TempAceite_'+valorid).value
	var idFlujoAgua = document.getElementById('idFlujoAgua_'+valorid).value
	var Observacion = document.getElementById('Observacion_'+valorid).value
	location=direccion+'&idEstadoAceite='+idEstadoAceite+'&idNivelAgua='+idNivelAgua+'&idNivelAceite='+idNivelAceite+'&idNivelSilice='+idNivelSilice+'&TempAceite='+TempAceite+'&idFlujoAgua='+idFlujoAgua+'&Observacion='+Observacion;
} 
//Confirmacion de eliminacion
function addrevgen(direccion, valorid){
	var Observacion = document.getElementById('Observacion_'+valorid).value
	location=direccion+'&Observacion='+Observacion;
}
//Confirmacion de eliminacion
function addfalla(direccion, valorid){
	var Observacion = document.getElementById('Observacion_'+valorid).value
	location=direccion+'&Observacion='+Observacion;
} 
//Confirmacion de eliminacion
function add_obs(direccion){
	var datas = document.getElementById('Observaciones').value
	location=direccion+'&val_select='+datas;
} 
//Confirmacion de eliminacion
function addfter(direccion){
	var datas = document.getElementById('f_termino').value
	location=direccion+'&val_select='+datas;
} 
//Confirmacion de eliminacion
function addhoraini(direccion){
	var datas = document.getElementById('horaInicio').value
	location=direccion+'&val_select='+datas;
} 
//Confirmacion de eliminacion
function addhoraterm(direccion){
	var datas = document.getElementById('horaTermino').value
	location=direccion+'&val_select='+datas;
} 
//Confirmacion de eliminacion
function addconsumo1(direccion, valorid){
	var Grasa_inicial = document.getElementById('Grasa_inicial_'+valorid).value
	var Grasa_relubricacion = document.getElementById('Grasa_relubricacion_'+valorid).value
	var idUml = document.getElementById('idUml_'+valorid).value
	var idProducto = document.getElementById('idProducto_'+valorid).value
	var Observacion = document.getElementById('Observacion_'+valorid).value
	location=direccion+'&Grasa_inicial='+Grasa_inicial+'&Grasa_relubricacion='+Grasa_relubricacion+'&idUml='+idUml+'&idProducto='+idProducto+'&Observacion='+Observacion;
} 
//Confirmacion de eliminacion
function addconsumo2(direccion, valorid){
	var Aceite = document.getElementById('Aceite_'+valorid).value
	var idUml = document.getElementById('idUml_'+valorid).value
	var idProducto = document.getElementById('idProducto_'+valorid).value
	var Observacion = document.getElementById('Observacion_'+valorid).value
	location=direccion+'&Aceite='+Aceite+'&idUml='+idUml+'&idProducto='+idProducto+'&Observacion='+Observacion;
} 
//Confirmacion de eliminacion
function addconsumo3(direccion, valorid){
	var Cantidad = document.getElementById('Cantidad_'+valorid).value
	var idUml = document.getElementById('idUml_'+valorid).value
	var idProducto = document.getElementById('idProducto_'+valorid).value
	var Observacion = document.getElementById('Observacion_'+valorid).value
	location=direccion+'&Cantidad='+Cantidad+'&idUml='+idUml+'&idProducto='+idProducto+'&Observacion='+Observacion;
} 
//Confirmacion de eliminacion
function addfpago(direccion){
	var datas = document.getElementById('f_pago').value
	location=direccion+'&val_select='+datas;
} 

