<?php session_start();

	 
if(isset($_GET['variable']) && $_GET['variable']!=''){
	$_SESSION['menu'] =  $_GET['variable']; 	
 }


?>
