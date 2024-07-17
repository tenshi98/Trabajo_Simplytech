<?php
if(isset($_GET['dir'])&&$_GET['dir']!=''&&isset($_GET['file'])&&$_GET['file']!=''){
	$enlace = $_GET['dir']."/".$_GET['file'];
	header ("Content-Disposition: attachment; filename=".$_GET['file']." ");
	header ("Content-Type: application/octet-stream");
	header ("Content-Length: ".filesize($enlace));
	readfile($enlace);
}
?> 


