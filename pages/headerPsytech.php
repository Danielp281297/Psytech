<?php 

	//Se inicia la sesion 
	//Si no existe la sesion, se crea...
	if (!isset($_SESSION))
		session_start();


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../style/style.css">
	<link rel="icon" href="../img/favicon.ico">
	<title></title>
</head>
<body>

	
	<header id="header-contenedor">
		
		<div id="header"> 

			<a href="<?php if (strpos($_SERVER['SCRIPT_FILENAME'], "index.php") === false) echo "../"; echo "index.php"; ?> "> <img id="logo" src= <?php if (strpos($_SERVER['SCRIPT_FILENAME'], "index.php") === false) echo "../"; echo "img/logo.png"; ?> > </a>


				<?php if (isset($_SESSION["usuarioActivo"]) || strpos($_SERVER['SCRIPT_FILENAME'], "CuentaUsuario.php") === true): ?>

				<a href="../config/cerrarSesion.php"><button id="boton-salir" class ="boton"> Salir </button></a></li>

				<a href="aspiranteRegister.php"><button id="boton-realizar-prueba" class ="boton"> Empezar Prueba </button></a>

				

				<?php else: ?>

				<a href="pages/login.php"><button id="boton-login" class ="boton"> Login </button></a>

				<?php endif; ?>

					
					

		</div>

	</header>

</body>
</html>