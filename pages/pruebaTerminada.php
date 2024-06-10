<?php
	
	require_once "../config/sqlConsultas.php";
	require_once "../config/dbConnect.php";

	// Establecer la zona horaria de Venezuela (America/Caracas)
		date_default_timezone_set('America/Caracas');

	//Se inicia la sesion 
	if (!isset($_SESSION))
		session_start();

	//Al terminar la prueba, se almacena el tiempo en que se finaliza
	if (!isset($_SESSION['finTiempo']))

		$_SESSION['finTiempo'] = date("Y-m-d h:m:s");

	//Si existen las variables de sesion concernientes a los ejercicios, estos se eliminan...
	if(isset($_SESSION["atributosAspirante"]) && 
		isset($_SESSION["fechaHoraFormateada"]) && 
		isset($_SESSION["index"]) && 
		isset($_SESSION["tiempo-inicio"]) &&
		isset($_SESSION['cargoAspirante'])) 
	{

		$totalRespuestas = ($_SESSION["atributosAspirante"]["interpretacion"] + $_SESSION["atributosAspirante"]["percepcion"] + $_SESSION["atributosAspirante"]["agilidad"]);

		//Se calcula los resultados de sus atributos

		$interpretacion = (round($_SESSION["atributosAspirante"]["interpretacion"] * 100) / 100);
		$percepcion = (round($_SESSION["atributosAspirante"]["percepcion"] * 100) / 100);
		$agilidad = (round($_SESSION["atributosAspirante"]["agilidad"] * 100) / 100);

		$tiempoInicio = $_SESSION["tiempo-inicio"];
		$tiempoFin = date("h:i:s");

		
		//Se guarda las variables en un array
		$resultadosAspirantes = array(
										"interpretacion" => $interpretacion,
										"percepcion" => $percepcion,
										"agilidad" => $agilidad,
										"totalRespuestas" => $totalRespuestas,
										"tiempoInicio" => $tiempoInicio,
										"tiempoFin" => $tiempoFin,
										"cargoAspirante" => $_SESSION['cargoAspirante'],
										"indiceEmpresa" => $_SESSION['userId']
									  );

		//Se genera la consulta
		consultaResultadosProspecto($resultadosAspirantes, $connect);

		//Se borran las variables de sesion 
		unset($_SESSION["atributosAspirante"]);
		unset($_SESSION["fechaHoraFormateada"]);
		unset($_SESSION["index"]);
		unset($_SESSION["tiempo-inicio"]);
		unset($_SESSION['cargoAspirante']);
		

	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../style/style.css">
	<link rel="icon" href="../img/favicon.ico">
	<title>Prueba Psytech</title>
</head>
<body>

	<?php require_once "../pages/headerPsytech02.php"; ?>

	<section id="aviso-prueba-terminada-contenedor">
		
		<p id="aviso-prueba-terminada"> Prueba Terminada.<br> Gracias por participar</p>

	</section>

	<?php require_once "../pages/footer.php"; ?>

</body>
</html>