<?php 
	session_start();

	//eliminar datos de accesos anteriores
	$_SESSION['personas'] = [];
	
	//acciones a realizar al entrar en la aplicación
	header("Location: personas.php");