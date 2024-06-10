<?php

	//Se inicia la sesion
	//Si no existe la sesion, se crea...
	if (!isset($_SESSION))
		session_start();

	//Se borra el indice de la empesa registrada
	if(isset($_SESSION['userId']))
		unset($_SESSION['userId']);

	//Se destruye la sesion
	session_destroy();

	//Se regresa a la pagina principal
	header("Location: ../index.php");
	exit();
?>