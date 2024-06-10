<?php 
	
	require_once "../config/errores.php";

	//Se inicia la sesion 
	//Si no existe la sesion, se crea...
	if (!isset($_SESSION))
		session_start();

	//Si hay una seccion activa, se va directamente a la cuenta del usuario
	if (isset($_SESSION["usuarioActivo"]))
	{

		header("Location: pages/cuentaUsuario.php");
		exit();

	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../style/style.css">
	<link rel="icon" href="../img/favicon.ico">
	<title>Psytech - Login</title>
</head>
<body>

	<?php require_once "../pages/headerPsytech02.php"; ?>

	<section id="login-contenedor">
		
		<div id="login">
			<h1> Login</h1>
			<h2> Ingrese los datos correspondientes: </h2>

			<?php

				//Si hay un error, se captura en pantalla
				if(isset($_GET['error'])):	
					?>
					
					<section id="mensaje-error-contenedor">
							
						<div id="mensaje-error" style="color: red;" > Error: <?php echo error(intval($_GET['error'])); ?></div>

					</section>

			<?php endif;	?>

			<br>

			<form action="../config/validaciones.php" method="POST">

				<label for="usuario">Usuario:</label><br>
				<input type="text" id="usuario" name="usuario" required minlength="6" maxlength="20"> <br>

				<br>

				<label for="contraseña">Contraseña:</label><br>
				<input type="password" id="contraseña" name="contraseña" required minlength="6" maxlength="20"><br>

				<br>

				<input type="hidden" name="login-empresa" value="true"><br>

				<div id="botones-login">

					
					<button id="boton-ingresar" class="boton" type="submit"> Ingresar </button>
					<input type="reset" class="boton" id="boton-limpiar" name="limpiar" value="Limpiar">

				</div>

			</form>

			<hr>

			<div id="register-aviso-contenedor">
				
				<p style="text-align: center;" id="register-aviso"> ¿Tu empresa no tiene una cuenta?<br> <a href="empresaRegister.php">Regístrala aquí</a> </p>

			</div>

		
	</section>
	
	<hr>

	<?php require_once "../pages/footer.php"; ?>

	<?php 

		if (isset($_GET['empresaRegistrada'])) 
		{
			echo "<script> alert('Datos de la empresa guardados con éxito.') </script>";
		}


	?>
	
</body>
</html>