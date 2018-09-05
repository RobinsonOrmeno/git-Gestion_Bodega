
<!-- Verificar que la variable sal sea igual a si.
Cerrar la sesión. 
Redirigir el flujo a la pagina del login --> 
<?php 
	

if ($_GET['sal']=='si'){
	session_start();
	session_destroy();
	//echo 'cerraste sesión exitosamente';
}





 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 </br>
 <span style='color:green; font-size:2em;'>CERRASTE SESIÓN EXITOSAMENTE </span>
 </br>
 </br>
 	<a href="login.php">deseas volver a logearte?</a>


 </body>
 </html>