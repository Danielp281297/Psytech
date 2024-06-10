<?php
	
	// Establecer la zona horaria de Venezuela (America/Caracas)
		date_default_timezone_set('America/Caracas');

	//Se requiere las consultas de sql
	require_once "../config/dbConnect.php";
	require_once "../config/sqlConsultas.php";

	//Si no existe la sesion, se crea...
	if (!isset($_SESSION))
		session_start();


	//Si no existen las variables de los atributos del aspirante, se crean 
	if(!isset($_SESSION["atributosAspirante"]))
		$_SESSION["atributosAspirante"] = array("interpretacion" => 0, "percepcion" => 0, "agilidad" => 0);

	//Se define la hora limite, como una variable de sesion. Si no existe, se crea...
	if (!isset($_SESSION['fechaHoraFormateada']))
	{
	
		// Obtener la fecha y hora actual
		$fechaHoraActual = new DateTime();
	
		// Incrementar la hora en 1 hora
		$fechaHoraActual->add(new DateInterval('PT1H'));
	
		// Formatear la fecha y hora para mostrar
		$_SESSION['fechaHoraFormateada'] = $fechaHoraActual->format('D M Y j G:i:s \\G\\M\\TP');
	
	}

	//unset($_SESSION['fechaHoraFormateada']);

	if (!isset($_SESSION["tiempo-inicio"]))
		$_SESSION["tiempo-inicio"] = date("h:i:s");

	if (!isset($_SESSION['index']))
		$_SESSION['index'] = 1;

	//Si se encuentra variables post, significa que el usuario pulso el boton CONTINUAR
	if(isset($_POST["opcion"]) && isset($_POST["respuesta-ejercicio"]))
	{

		//Si la respuesta es correcta, se almacena en una variable de sesion como una respuesta correcta
		if($_POST["opcion"] == $_POST["respuesta-ejercicio"])
		{
			
			//Se almacena su valor dentro de la variable de sesion atributosAspirante
			switch($_POST["tipo"] - 1)
			{

				case 0:
					$_SESSION["atributosAspirante"]["interpretacion"] += 1;
					break;
				case 1:
					$_SESSION["atributosAspirante"]["percepcion"] += 1;
					break;
				case 2:
					$_SESSION["atributosAspirante"]["agilidad"] += 1;
					break;

			}	
			

			var_dump($_SESSION["atributosAspirante"]);

		}

		$_SESSION['index']++;

		//Se redirige a la pagina para evitar que se vuelva a ejecutar esta condicion al recargar...
		
		if($_SESSION['index'] > 25)
		{

			header("Location: pruebaTerminada.php");

		}else
		header("Location: ejercicio.php");
		
		exit();
		
	}

	$resultados = $connect->query(consultaEjercicio($_SESSION['index']));

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../style/style.css">
	<script type="text/javascript" src="../js/script.js"></script>
	<link rel="icon" href="../img/favicon.ico">
	<title>Prueba Psytech</title>
</head>
<body onload="javascript: cuentaRegresiva();">

	<?php require_once "../pages/headerPsytech02.php"; ?>
		
		<!-- Se muestra el temporizador -->
		<div id="clock-contenedor">
			
			<div id="clock"></div>

		</div>

	<br>

	<!-- Aqui aparecen las preguntas con las opciones -->
	<section id="pregunta-ejercicio-contenedor">
							<form id="pregunta-ejercicio" action="#" method="POST">

								<?php if($resultados): 
									

										while ($ejercicio = $resultados->fetch(PDO::FETCH_ASSOC)): ?>

											<?php 

											echo " <h1>".$ejercicio["nombre_tipo_ejercicio"]."</h1> <br>";

											?>

											<div id="contenido-ejercicio">

											<?php
											echo "<strong>".$ejercicio['contenido_ejercicio']."</strong><br>"; 

											 if(!base64_encode($ejercicio["imagen_ejercicio"]) == null): //Si en el campo imagen_ejercicio no es null, se imprime el contenido en pantalla?>
											<img src="data:image/png;base64, <?php echo base64_encode($ejercicio["imagen_ejercicio"]); ?>" id="imagen-ejercicio" />
											<?php endif; ?>
											</div>

											<div id="opciones-ejercicio">
											<p>Opciones: </p>

											<?php

												echo '<input type="radio" required id="opcion-A" name="opcion" value="A"> <label for="opcion-A">'.$ejercicio["opción_ejercicio_A"].'</label><br>
													  <input type="radio" required id="opcion-B" name="opcion" value="B"> <label for="opcion-B">'.$ejercicio["opción_ejercicio_B"].'</label><br>
													  <input type="radio" required id="opcion-C" name="opcion" value="C"> <label for="opcion-C">'.$ejercicio["opción_ejercicio_C"].'</label><br>
													  <input type="radio" required id="opcion-D" name="opcion" value="D"> <label for="opcion-D">'.$ejercicio["opción_ejercicio_D"].'</label><br>'; 
												echo '<input type="hidden" name="tipo" value="'.$ejercicio["id_tipo_ejercicio"].'">';
												echo '<input type="hidden" name="respuesta-ejercicio" value="'.$ejercicio["respuesta_correcta_ejercicio"].'">';
													  
											?>
											
											<br>

											<input type="hidden" name="incrementar-indice" value="true"> 
											<button id="boton-continuar" class="boton" type="submit"> Continuar </button>
											</div>

										<?php endwhile; //while ($producto = $resultados->fetch(PDO::FETCH_ASSOC)):

									 endif; // if($resultados) ?>
							
							</form>

		</section>
	<hr>
	
	<?php require_once "../pages/footer.php"; ?>

</body>
<script type="text/javascript">
	
	//Este codigo redirige la pagina si el usuario intenta recargar la pagina
	function noRecargar()
	{
		if (performance.navigation.type !== 0) 
	  		location.replace('pruebaTerminada.php');
	}
	
	var avisoTiempoAcabado = '¡Se acabó el tiempo!';

	const getRemainingTime = deadline => {
  let now = new Date(),
      remainTime = (new Date(deadline) - now + 1000) / 1000,
      remainSeconds = ('0' + Math.floor(remainTime % 60)).slice(-2),
      remainMinutes = ('0' + Math.floor(remainTime / 60 % 60)).slice(-2),
      remainHours = ('0' + Math.floor(remainTime / 3600 % 24)).slice(-2),
      remainDays = Math.floor(remainTime / (3600 * 24));

  return {
	    remainSeconds,
	    remainMinutes,
	    remainHours,
	    remainDays,
	    remainTime
	  }
	};

	//Funcion que muestra el temporizador, tomando como parametro el formato del deadline(tiempo limite), el nombre de la etiqueta donde se mostrara la etiqueta, y el mensaje al momento de terminar el temporizador 
	const countdown = (deadline, elemEjercicio, elemTemporizador,finalMessage) => {
	  const el = document.getElementById(elemTemporizador);
	  const ejercicio = document.getElementById(elemEjercicio);

	  const timerUpdate = setInterval( () => {
	    let t = getRemainingTime(deadline);
	    el.innerHTML = `${t.remainHours}h:${t.remainMinutes}m:${t.remainSeconds}s`;

	    //Cuando el remainTime haya finalizado, se actualiza el tiempo del navegador
	    if(t.remainTime <= 0) {
	      clearInterval(timerUpdate);
	      //Se redirecciona a la pagina de la prueba terminada
	      location.replace('pruebaTerminada.php');

	      //ejercicio.innerHTML = finalMessage;
	    }

	  }, 0)
	};

	function cuentaRegresiva()
		{

				fechaLimite = <?php echo json_encode($_SESSION['fechaHoraFormateada']);?>;
				//Esta es una prueba. Hay que eliminarla una vez se termine la prueba
				//fechaLimite = new Date(new Date().setSeconds(new Date().getSeconds() + 5 ));
				
			//Se ejecuta la funcion
			countdown(fechaLimite, 'ejercicio', 'clock', avisoTiempoAcabado);

		}

		noRecargar();

</script>
</html>
