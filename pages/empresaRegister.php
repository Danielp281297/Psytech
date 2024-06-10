<?php 
	
	//Se requiere el archivo sqlConsultas.php
	require_once "../config/sqlConsultas.php";
	require_once "../config/dbConnect.php";
	require_once "../config/errores.php";

	//Se inicia la sesion 
	//Si no existe la sesion, se crea...
	if (!isset($_SESSION))
		session_start();

	//Se almacenan los datos de las tabla sector empresa
	$tablaSectorEmpresa = consultaSectorEmpresa($connect);

	//Se almacenan los datos de las tabla actividad economica empresa
	$tablaActividadEconomica = consultasActividadEconomicaEmpresa($connect);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../style/style.css">
	<link rel="icon" href="../img/favicon.ico">
	<title>Psytech - Registro de la Empresa</title>
</head>
<body>

	<?php require_once "../pages/headerPsytech02.php"; ?>

	<section id="register-contenedor">
		
		<div id="register">
			<h1> Crear cuenta </h1>
			<h2> Ingrese los datos correspondientes: </h2>

			<?php

				//Si hay un error, se captura en pantalla
				if(isset($_GET['error'])):	
					?>
					
					<section id="mensaje-error-contenedor">
							
						<div id="mensaje-error" style="color: red;" > Error: <?php echo error(intval($_GET['error'])); ?></div>

					</section>

			<?php endif;	?>

			<form action="../config/validaciones.php" method="POST" enctype="multipart/form-data">
				
				<h3> Datos de la empresa: </h3>
				<label for="rif-empresa">R.I.F:</label><br>

				<select id="nacionalidad-rif"  name="nacionalidad-rif" required >
					<option value="" selected="true" disabled="disabled" >--Selecionar</option>
					<option value="J" >J</option>
					<option value="G" >G</option>
				</select>

				<input type="text" id="rif-empresa" name="rif-empresa" required minlength="9" maxlength="9" placeholder="XXXXXXXXX" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"><br>

				<br>

				<label for="nombre-empresa">Nombre comercial:</label><br>
				<input type="text" id="nombre-empresa" name="nombre-empresa" required minlength="6" maxlength="20" pattern="/[^[a-zA-Z0-9.,]/" placeholder="mín 6 máx 20 caracteres"><br>

				<br>

				<label for="razon-social-empresa">Razón social:</label><br>
				<input type="text" id="razon-social-empresa" name="razon-social-empresa" required minlength="6" maxlength="50" placeholder="mín 6 máx 50 caracteres"><br>

				<br>

				<label for="sector-empresa">Sector de la empresa:</label><br>
				<select id="sector-empresa" name="sector-empresa" required >
					
					<option value="" selected="true" disabled="disabled" >--Selecionar</option>

					<?php 

					if($tablaSectorEmpresa):
					

						while ($sector = $tablaSectorEmpresa->fetch(PDO::FETCH_ASSOC)) 
							echo '<option value = "'.$sector["id_sector_empresa"].'"> '.$sector["nombre_sector_empresa"].' </option>';

					endif;

					?>

				</select>
				<br>

				<br>

				<label for="actividad-economica">Actividad económica de la empresa:</label><br>
				<select id="actividad-economica" name="actividad-economica" required >
					
					<option value="" selected="true" disabled="disabled" >--Selecionar</option>

					<?php 

					if($tablaSectorEmpresa):
					

						while ($actividadEconomica = $tablaActividadEconomica->fetch(PDO::FETCH_ASSOC)) 
						{
							
							echo '<option value = "'.$actividadEconomica["id_actividad_económica_empresa"].'"> '.$actividadEconomica["nombre_actividad_económica_empresa"].' </option>';

						}

					endif;

					?>

				</select>
				<br>

				<br>

				<label for="direccion-empresa">Dirección de la empresa:</label><br>
				<input type="text" id="direccion-empresa" name="direccion-empresa" required minlength="5" maxlength="50" placeholder="máx 50 caracteres"><br>

				<br>

				<label for="telefono-empresa">Teléfono de la empresa:</label><br>
				<input type="text" id="telefono-empresa" name="telefono-empresa" required minlength="11" maxlength="11" placeholder="0XXXXXXXXXX" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"><br>

				<br>

				<label for="correo-electronico-empresa">Correo electrónico:</label><br>
				<input type="text" id="correo-electronico-empresa" name="correo-electronico-empresa" required minlength="5" maxlength="50" placeholder="máx 255 caracteres"><br>

				<br>

				<h3> Datos de la cuenta: </h3>
				<label for="usuario">Usuario:</label><br>
				<input type="text" id="usuario" name="usuario" required minlength="6" maxlength="20" placeholder="mín 6 máx 20 caracteres"> <br>

				<br>

				<label for="contraseña">Contraseña:</label><br>
				<input type="password" id="contraseña" name="contraseña" required minlength="6" maxlength="20" placeholder="mín 6 máx 20 caracteres"><br>

				<br>

				<label for="confirmar-contraseña">Confirmar contraseña:</label><br>
				<input type="password" id="confirmar-contraseña" name="confirmar-contraseña" required minlength="6" maxlength="20" placeholder="mín 6 máx 20 caracteres"><br>

				<br>

				<input type="hidden" name="registro-empresa" value="true">

				<div id="botones-register">
					
					<button class="boton" type="submit"> Registrar </button>
					<input type="reset" id="boton-limpiar" class="boton" name="limpiar" value="Limpiar">

				</div>

			</form>

			<hr>

			<div id="login-aviso-contenedor">
				
				<p id="login-aviso"> ¿Tu empresa ya tiene una cuenta?, <br><a href="login.php">Ingresa aquí</a> </p>

			</div>

	</div>
	</section>

	<hr>

	<?php require_once "../pages/footer.php"; ?>

</body>
</html>