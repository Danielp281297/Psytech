<?php 
	
	require_once "../config/sqlConsultas.php";
	require_once "../config/dbConnect.php";

	//Se inicia la sesion 
	//Si no existe la sesion, se crea...
	if (!isset($_SESSION))
		session_start();

	//Se comprueba si la cuenta esta abierta
	if (isset($_SESSION["usuarioActivo"])):

	//Se captura la variable registro-aspirante
	if (isset($_POST["registro-aspirante"])) 
	{

		
		//Se redirecciona a la misma pagina
		header("Location: cuentaUsuario.php");
		exit();
	
	}

	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../img/favicon.ico">
	<title>Psytech</title>
</head>
<body>

	<?php require_once "headerPsytech.php"; ?>

	<section id="resultados-pruebas-contenedor">
		
		<div id="resultados-pruebas">
			
			<h1> Resultados de las pruebas </h1>
			<!-- Se le pide al usuario que ingrese la fecha que se hizo la prueba -->
			<form action="#" method="POST">
					
					<input type="date" required name="fecha-prueba" min="2024-04-01" max="<?php echo date("Y-m-d");?>"><br>

					<br>

					<input type="reset" class="boton" name="limpiar" value="Limpiar">
					<button class="boton" type="submit"> Ingresar </button>
					
			</form>
			
			<!-- Se muestra los resultados de los aspirantes a realizar la prueba en esta seccion -->
			<?php

			function resolucionAspirante($campo)
			{

				$resultado = "";

				switch ($campo) 
						{

							case 0:
							case 1:
							case 2:
								$resultado = "baja";
								break;
							case 3:
							case 4:
								$resultado = "media";
								break;
							case 5:
							case 6:
							case 7:
							case 8:
							case 9:
							case 10:
								$resultado = "alta";
								break;
						
						}

				return $resultado;

			}

			//Se captura la fecha para mostrar los resultados
			if (isset($_POST["fecha-prueba"])) 
			{
		
				//Se manda el valor de la fecha para extraer el contenido de la consulta
				$aspirantes = consultaAspiranteFecha($_POST["fecha-prueba"], $connect);

				if ($aspirantes) 
				{

					echo "Aspirantes: <br>";

					while ($aspirante = $aspirantes->fetch(PDO::FETCH_ASSOC))
					{

						echo "Cédula: ".$aspirante["cédula_persona"]."<br>";
						echo "Nombre completo: ".$aspirante["primer_nombre_persona"]." ".$aspirante["segundo_nombre_persona"]." ".$aspirante["primer_apellido_persona"]." ".$aspirante["segundo_apellido_persona"]."<br>";
						echo "Dirección: ".$aspirante["dirección_persona"]."<br>";
						echo "Teléfono: ".$aspirante["teléfono_persona"]."<br>";
						echo "Correo:".$aspirante["correo_persona"]."<br>";

						echo "Resultados: <br>";
						echo "Interpretación: ".$aspirante["interpretación_resultados"]."<br>";
						echo "Percepción: ".$aspirante["percepción_resultados"]."<br>";
						echo "Agilidad: ".$aspirante["agilidad_resultados"]."<br>";
						echo "Respuestas correctas: ".$aspirante["total_respuestas_resultados"]."<br>";
						echo "Hora Inicio: ".$aspirante["hora_inicio_prueba_resultados"]."<br>";
						echo "Hora Fin: ".$aspirante["hora_fin_prueba_resultados"]."<br>";

						echo "Resolución : Interpretación ". resolucionAspirante($aspirante["interpretación_resultados"]).", percepción ". resolucionAspirante($aspirante["percepción_resultados"]).", y agilidad ". resolucionAspirante($aspirante["agilidad_resultados"])."<br>"; 
						

						echo "<hr>";

					}

				}


			}


			?>

		</div>

	</section>

	<hr>
	
	<?php require_once "../pages/footer.php"; ?>

</body>
</html>
<?php
	
	//En caso contrario, se regresa a la pagina principal
	else: header("Location: ../index.php");

	endif;
?>