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
					

		</div>

	</header>

</body>
</html>