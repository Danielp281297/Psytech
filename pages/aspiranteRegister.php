<?php 
	
	require_once "../config/sqlConsultas.php";
	require_once "../config/dbConnect.php";
	require_once "../config/errores.php";

	//Se inicia la sesion 
	//Si no existe la sesion, se crea...
	if (!isset($_SESSION))
		session_start();

	//Una funcion que devuelva el formato de fecha para hacer el intervalo al input de la fecha  de nacimiento
	function fecha($formato)
	{

		// Obtener la fecha actual
		$fechaActual = date('Y-m-d');

		// Calcular la fecha 64 años antes
		$intervalo = new DateInterval($formato);
		$fechaAnterior = new DateTime($fechaActual);
		$fechaAnterior->sub($intervalo);

		// Formatear la fecha anterior en formato Y-m-d
		$fechaAnteriorFormato = $fechaAnterior->format('Y-m-d');

		return $fechaAnteriorFormato;
	}

	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../style/style.css">
	<link rel="icon" href="../img/favicon.ico">
	<title>Psytech - Registro de aspirante</title>
</head>
<body>

	<?php require_once "../pages/headerPsytech02.php"; ?>

	<section id="aspirante-register-contenedor">

		<div id="aspirante-register">
			<h1> Bienvenido a la prueba psicotécnica Psytech. </h1>
			
			<p>Lo que realizará a continuación es una prueba para conocer sus capacidades en diferentes habilidades. Primero ingrese los datos de los campos correspondientes:</p>

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
				
				<label for="cedula">Cédula:</label><br>
				<input type="number" id="cedula" name="cedula" placeholder="Rango: [6000000; 31000000]"> <br>

				<br>

				<label for="primer-nombre">Primer Nombre:</label><br>
				<input type="text" id="primer-nombre" name="primer-nombre" required minlength="3" maxlength="20"  > <br>

				<br>

				<label for="segundo-nombre">Segundo Nombre:</label><br>
				<input type="text" id="segundo-nombre" name="segundo-nombre" required minlength="3" maxlength="20" > <br>

				<br>

				<label for="primer-apellido">Primer Apellido:</label><br>
				<input type="text" id="primer-apellido" name="primer-apellido" required minlength="3" maxlength="20" > <br>

				<br>

				<label for="segundo-apellido">Segundo Apellido:</label><br>
				<input type="text" id="segundo-apellido" name="segundo-apellido" required minlength="3" maxlength="20" > <br>

				<br>

				<label for="fecha-nacimiento">Fecha de nacimiento:</label><br>
				<input type="date" id="fecha-nacimiento" name="fecha-nacimiento" required min="<?php echo fecha('P64Y');?>" max="<?php echo fecha('P18Y');?>"> <br>

				<br>

				<label for="direccion-aspirante">Dirección:</label><br>
				<input type="text" id="direccion-aspirante" name="direccion-aspirante" required minlength="5" maxlength="50"><br>

				<br>

				<label for="telefono-aspirante">Teléfono:</label><br>
				<input type="text" id="telefono-aspirante" name="telefono-aspirante" required minlength="11" maxlength="11" placeholder="0XXXXXXXXXX" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" ><br>

				<br>

				<label for="correo-electronico-aspirante">Correo electrónico:</label><br>
				<input type="text" id="correo-electronico-aspirante" name="correo-electronico-aspirante" required minlength="5" maxlength="50"><br>

				<br>

				<label for="cargo-aspirante">Cargo:</label><br>
				<select type="text" id="cargo-aspirante" name="cargo-aspirante" required> 

					<option value="" selected="true" disabled="disabled" >--Selecionar</option>

					<?php

					//Se reune la informacion de la tabla cargo
					$cargos = consultaCargoAspirante($connect);

						if($cargos)
						{

							while ($cargo = $cargos->fetch(PDO::FETCH_ASSOC)) 
							{
								
								echo '<option value = "'.$cargo["id_cargo"].'"> '.$cargo["nombre_cargo"].' </option>';

							}

						}

					?>

				</select><br>

				<br>

				<br>
				
				<div id="botones-aspirante">
				<input type="hidden" name="registro-aspirante" value="true">
				<button class="boton" type="submit"> Ingresar </button>
				<input type="reset" class="boton" name="limpiar" id="boton-limpiar" value="Limpiar">
				
				</div>

			</form>
		</div>
			</section>

		<hr>
		<?php require_once "../pages/footer.php"; ?>

</body>
</html>