<?php 

	//Se conecta el sistema a la base de datos
	require_once "config/dbConnect.php";

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
	<link rel="stylesheet" type="text/css" href="style/style.css">

	<title>Psytech</title>
</head>
<body>

	<?php require_once "pages/headerPsytech.php"; ?>
	
	<section id="encabezado-contenedor">
		
		<div id="encabezado"> 

			<h1>Sistema Psytech</h1>
			<p>Encuentra a los mejores empleados para tu empresa, usando Psytech</p>
			<a href="pages/login.php"><button class="boton"> EMPEZAR AHORA </button></a>

		</div>

	</section>

	

	<section id="psytech-contenedor">
		
		<div id="psytech"> 

			<h1>¿Qué es Psytech?</h1>

			<p>
			Psytech es una herramienta diseñada para que las empresas puedan realizar y analizar pruebas psicotécnicas a sus futuros aspirantes a optar por un cargo laboral.
			<br><br>
			Psytech fue diseñado por el equipo Lucerna Technologies, al ver la necesidad de tener una herramienta que automatice la realización y el análisis de estas pruebas de forma precisa y eficiente. 
			<br><br>
			Las pruebas psicotécnicas son pruebas realizadas para medir el nivel de las habilidades de un individuo. Con esto en mente, además de la necesidad de pruebas eficientes en los departamentos de recursos humanos, en Lucerna Technologies proponemos a nuestros clientes un recurso que le permita conocer el nivel de competencia que tendrán sus futuros empleados en diferentes habilidades.
			<br><br>
			Puedes ingresar al sistema o registrar a tu empresa para poder hacer las pruebas.
			<br><br>
			</p>
		</div>

	</section>

	
	
	<section id="lucerna-technologies-contenedor">
		
		

		<div id="lucerna-technologies"> 		

			<h1 id="lucerna-technologies-titulo">Lucerna Technologies</h1>
			<p>
			

			Somos una startup conformada por un equipo multidisciplinario destacado en investigación y desarrollo. Nuestra misión es poder desarrollar soluciones tecnológicas innovadoras y accesibles para nuestros clientes. Nuestra visión es ser vanguardia en el desarrollo de soluciones tanto de software como de hardware dentro del país, y convertirnos en un referente en investigación y desarrollo.
			</p>

		</div>

		<div> <img id="imagen-lucerna-technologies" src="img/lucernaTechnologies.jpg"> </div>

	</section>

	

	<section id="testimonios-contenedor">

		<h1 id="testimonios-titulo">Testimonios</h1>

		<div id="testimonios">
			<div id="testimonio"> 

				<p>“El sistema ha sido muy fácil de usar, y he podido capacitar personas que han pasado hasta 6 meses sin renunciar. Lo recomiendo” <br><strong> -Lorenzo de Mendoza </strong> </p>

			</div>

			<div id="testimonio"> 

				<p>“La cantidad de personas que quieren optar por un puesto de trabajo no da para un solo reclutador, y Psytech me ha servido para muchísimo.” <br><strong> -Martin Ortega </strong> </p>

			</div>

			<div id="testimonio"> 

				<p>“Hemos aumentado nuestro capital humano en un 10% este último año gracias a la herramienta Psytech. La recomiendo mucho” <br><strong> -Sandra Artiaga</strong></p>

			</div>
		</div>

	</section>

	<hr>
	

	<?php require_once "pages/footer.php"; ?>

</body>
</html>

