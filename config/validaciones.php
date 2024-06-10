<?php 
	
	//Se requiere conectarse a la base de datos
	require_once "dbConnect.php";
	require_once "sqlConsultas.php";

	//Se inicia la sesion 
	//Si no existe la sesion, se crea...
	if (!isset($_SESSION))
		session_start();

	//Funcion para saber si una cadena de caracteres tiene vocales con acento
	function tieneCaracteresEspeciales($cadena) {
	    $caracteresEspeciales = "!@#$%^&*()_+-{}[]:;'<>/?=\~|\\";
	    $excepciones = ",.";

	    for ($i = 0; $i < strlen($cadena); $i++) {
	        $caracter = $cadena[$i];
	        if (strpbrk($caracteresEspeciales, $caracter) && !strpbrk($excepciones, $caracter)) {
	            return true;
	        }
	    }

	    return false;
	}


	//En caso que se haya accedido por la pagina registerAspirante, se regresa a este
	if (isset($_POST["registro-aspirante"]))
	{

		$error = 0;

		//Se valida de que los campos no esten vacios
		if (    !empty($_POST['cedula']) &&
				!empty($_POST['primer-nombre']) &&
				!empty($_POST['segundo-nombre']) &&
				!empty($_POST['primer-apellido']) &&
				!empty($_POST['segundo-apellido']) &&
				!empty($_POST['fecha-nacimiento']) &&
				!empty($_POST['direccion-aspirante']) &&
				!empty($_POST['telefono-aspirante']) &&
				!empty($_POST['correo-electronico-aspirante']) 
			) 
		{

			//Cedula
			//Se valida de que ya haya una cedula en la base de dato
			$cedulaDB = consultaBuscarCedula($_POST['cedula'], $connect);

			if ($cedulaDB)
			{

				$cedulaDB = $cedulaDB->fetch(PDO::FETCH_ASSOC);

				if ($cedulaDB)
					$error = 18;
			}

			//Se comprueba que la cedula sea de 9 digitos
			if ($_POST['cedula'] < 6000000 || $_POST['cedula'] > 31000000) 
				$error = 19;

			//Se comprueba de que la cedula este entre 6 y 30 millones

			//Primer Nombre
			//Se comprueba de que sea una cadena solo de texto
			if(!preg_match('/^[A-Za-z]+$/', $_POST['primer-nombre']))
				$error = 20;

			//Se comprueba de que la cadena tenga entre 3 y 20 caracteres
			if(strlen($_POST['primer-nombre']) < 3 || strlen($_POST['primer-nombre']) > 20)
				$error = 21;


			//Segundo Nombre
			//Se comprueba de que sea una cadena solo de texto
			if(!preg_match('/^[A-Za-z]+$/', $_POST['segundo-nombre']))
				$error = 22;

			//Se comprueba de que la cadena tenga entre 3 y 20 caracteres
			if(strlen($_POST['segundo-nombre']) < 3 || strlen($_POST['segundo-nombre']) > 20)
				$error = 23;


			//Primer Apellido
			//Se comprueba de que sea una cadena solo de texto
			if(!preg_match('/^[A-Za-z]+$/', $_POST['primer-apellido']))
				$error = 24;

			//Se comprueba de que la cadena tenga entre 3 y 20 caracteres
			if(strlen($_POST['primer-apellido']) < 3 || strlen($_POST['primer-apellido']) > 20)
				$error = 25;

			//Segundo Apellido
			//Se comprueba de que sea una cadena solo de texto
			if(!preg_match('/^[A-Za-z]+$/', $_POST['segundo-apellido']))
				$error = 26;

			//Se comprueba de que la cadena tenga entre 3 y 20 caracteres
			if(strlen($_POST['segundo-apellido']) < 3 || strlen($_POST['segundo-apellido']) > 20)
				$error = 27;

			//Direccion de la empresa
			if (strlen($_POST["direccion-aspirante"]) < 5 ||strlen($_POST["direccion-aspirante"]) > 50 || !is_string($_POST["direccion-aspirante"]) || !preg_match("/^[a-zA-Z0-9\s,.]+$/", $_POST["direccion-aspirante"]))
				$error = 8;

			
			//Telefono
			if (strlen($_POST['telefono-aspirante']) != 11)
				$error = 7;

			//Se valida si la cadena de caracteres esta conformada solo por numeros
			if (!preg_match('/^[0-9]+$/', $_POST['telefono-aspirante']))
				$error = 6;
			
			//Correo Electronico
			if (strlen($_POST["correo-electronico-aspirante"]) < 10 ||
	            strlen($_POST["correo-electronico-aspirante"]) > 255)
				$error = 5;


			if (!filter_var($_POST["correo-electronico-aspirante"], FILTER_VALIDATE_EMAIL) ||
				 preg_match("/[,;'´`\"\\s]/", $_POST["correo-electronico-aspirante"]))
				$error = 4;

		
		} else $error = 15;

		//Si el valor de la variable error es mayor a 0, se retorna su valor a la pagina de registro de la empresa
		if ($error > 0) {
					header("Location: ../pages/aspiranteRegister.php?error=".$error);
					exit();}

		//Se mantiene una variable de sesion que almacene el contenido del cargo para el final
		if (!isset($_SESSION['cargoAspirante'])) 
			$_SESSION['cargoAspirante'] = $_POST['cargo-aspirante'];

		
		//Se crea un arreglo para almacenar los datos de la aspirante
		$datosAspirante = array(
								"cedulaAspirante" => $_POST['cedula'],
								"primerNombreAspirante" => $_POST['primer-nombre'],
								"segundoNombreAspirante" => $_POST['segundo-nombre'],
								"primerApellidoAspirante" => $_POST['primer-apellido'],
								"segundoApellidoAspirante" => $_POST['segundo-apellido'],
								"fechaNacimientoAspirante" => $_POST['fecha-nacimiento'],
								"direccionAspirante" => $_POST['direccion-aspirante'],
								"telefonoAspirante" => $_POST['telefono-aspirante'],
								"correoElectronicoAspirante" => $_POST['correo-electronico-aspirante']

								 );

		//Si se inserta los datos correctamente, se redirige al aviso para los aspirantes
		if (consultainsertarAspirante($datosAspirante, $connect)) //Se redirige a la aviso del aspirante;
		{
			header("Location: ../pages/avisoAspirante.php");
			exit();
		}
		
	}

	//En caso de que se haya enviado los datos para registrar una nueva empresa...
	if (isset($_POST["registro-empresa"]))
	{

		$error = 0;
		
		//Se comprueba si los campos han quedado vacios
		if (!empty($_POST['nacionalidad-rif']) &&
			!empty($_POST['rif-empresa']) &&
			!empty($_POST['nombre-empresa']) &&
			!empty($_POST['razon-social-empresa']) &&
			!empty($_POST['sector-empresa']) &&
			!empty($_POST['actividad-economica']) &&
			!empty($_POST['direccion-empresa']) &&
			!empty($_POST['telefono-empresa']) &&
			!empty($_POST['correo-electronico-empresa']) &&
			!empty($_POST['usuario']) &&
			!empty($_POST['contraseña']) &&
			!empty($_POST['confirmar-contraseña']))
		{

			
			

			//RIF
			//Se comprueba que el rif no se encuentre en la base de datos
			$rifDB = consultaBuscarRif($_POST['nacionalidad-rif']."-".$_POST['rif-empresa'], $connect);
			if ($rifDB)
			{

				$rifDB = $rifDB->fetch(PDO::FETCH_ASSOC);

				if ($rifDB)
					$error = 16;
			}


			//Se comprueba que el numero de rif sea igual a 9
			if (!strlen($_POST['rif-empresa']) == 9) 
				$error = 14;

			//Se comprueba que la cadena este conformada solo por numeros
			if (!preg_match('/^[0-9]+$/', $_POST['rif-empresa'])) 
				$error = 13;

			
			//Nombre comercial
			if(strlen($_POST["nombre-empresa"]) < 5 || strlen($_POST["nombre-empresa"]) > 20)
				$error = 12;

			if(!preg_match("/[^[a-zA-Z0-9.,]/", $_POST["nombre-empresa"]) || tieneCaracteresEspeciales($_POST["nombre-empresa"]) === true)
				$error = 11;

			
			//Razon social 
			if(strlen($_POST["razon-social-empresa"]) < 5 || strlen($_POST["razon-social-empresa"]) > 50)
				$error = 10;

			if(!preg_match("/[^[a-zA-Z0-9.,]/", $_POST["razon-social-empresa"]) || tieneCaracteresEspeciales($_POST["razon-social-empresa"]) == true)
				$error = 9;

			//Direccion de la empresa
			if (strlen($_POST["direccion-empresa"]) < 5 ||strlen($_POST["direccion-empresa"]) > 50 || !is_string($_POST["direccion-empresa"]) || !preg_match("/^[a-zA-Z0-9\s,.]+$/", $_POST["direccion-empresa"]))
				$error = 8;

			
			//Telefono
			if (strlen($_POST['telefono-empresa']) != 11)
				$error = 7;

			//Se valida si la cadena de caracteres esta conformada solo por numeros
			if (!preg_match('/^[0-9]+$/', $_POST['telefono-empresa']))
				$error = 6;
			
			//Correo Electronico
			if (strlen($_POST["correo-electronico-empresa"]) < 10 ||
	            strlen($_POST["correo-electronico-empresa"]) > 255)
				$error = 5;


			if (!filter_var($_POST["correo-electronico-empresa"], FILTER_VALIDATE_EMAIL) ||
				 preg_match("/[,;'´`\"\\s]/", $_POST["correo-electronico-empresa"]))
				$error = 4;

			
			//Usuario
			//Se valida que sea una cadena de caracteres, que sea de entre 6 y 20 caracteres, y que no se encuentren espacios dentro
			if (strlen($_POST["usuario"]) < 6 || strlen($_POST["usuario"]) > 20 || !is_string($_POST["usuario"]) || strpos($_POST["usuario"], ' ')) 
	        	$error = 3;

			
			//Contrasena
			if (strlen($_POST["contraseña"]) < 6 || strlen($_POST["contraseña"]) > 20) //Se valida de que la contrasena sea de entre 6 y 20
				$error = 2;

			//Se valida que las contrasenas coincidan 
			if($_POST["contraseña"] !== $_POST["confirmar-contraseña"])

				$error = 1;
			

		}
		else $error = 15;

		//Si el valor de la variable error es mayor a 0, se retorna su valor a la pagina de registro de la empresa
		if ($error > 0) 
		{
						header("Location: ../pages/empresaRegister.php?error=".$error);
						exit();
					}

		//$binario = base64_encode(file_get_contents($_FILES['logo']['tmp_name']));
		//echo $binario."<br><br>";
		
		//Se almacenan los valores en un array
		$datosEmpresa = array( 'rifEmpresa' => $_POST['nacionalidad-rif']."-".$_POST['rif-empresa'],
							   'nombreEmpresa' => $_POST['nombre-empresa'],
							   'razonSocialEmpresa' => $_POST['razon-social-empresa'],
							   'sectorEmpresa' => $_POST['sector-empresa'],
							   'actividadEconomicaEmpresa' => $_POST['actividad-economica'],
							   'direccionEmpresa' => $_POST['direccion-empresa'],
							   'telefonoEmpresa' => $_POST['telefono-empresa'],
							   'correoElectronicoEmpresa' => $_POST['correo-electronico-empresa'],
							   'usuarioEmpresa' => $_POST['usuario'],
							   'contrasenaEmpresa' => hash("sha256", $_POST['contraseña']));

		//Se genera la consulta. De guardarse en la base de datos, se muestra el mensaje y se va al login
		if(consultaInsertarEmpresa($datosEmpresa, $connect)) 
		{

			header("Location: ../pages/login.php?empresaRegistrada=true");
			exit();

		}
		else //En caso contrario, se avisa del error y se regresa a la pagina de registro.
		{

			echo "<script> alert('Error al cargar los datos. Comuníquese con el centro de servicio.') </script>";

			header("Location: ../pages/empresaRegister.php");
			exit();

		}

	}

	//En caso de que se quiera ingresar desde el login...
	if (isset($_POST["login-empresa"]))
	{

		//Se valida que los campos no esten vacios
		//Se comprueba si los campos han quedado vacios
		if (!empty($_POST['usuario']) && !empty($_POST['contraseña']))
		{
			
			//Usuario
			//Se valida que sea una cadena de caracteres, que sea de entre 6 y 20 caracteres, y que no se encuentren espacios dentro
			if (strlen($_POST["usuario"]) < 6 || strlen($_POST["usuario"]) > 20 || !is_string($_POST["usuario"]) || strpos($_POST["usuario"], ' ')) 
	        	$error = 3;

			
			//Contrasena
			if (strlen($_POST["contraseña"]) < 6 || strlen($_POST["contraseña"]) > 20) //Se valida de que la contrasena sea de entre 6 y 20
				$error = 2;

		}
		else $error = 15;

		//Se extrae la informacion de la base de datos
		$login = array("user" => $_POST['usuario'], "pass" => hash("sha256", $_POST['contraseña']));

		$userEmpresa = consultaLoginEmpresa($login["user"], $connect);

		//Se comprueba de que haya informacion en la consulta
		if ($userEmpresa) 
		{

			//Se convierte la fila de la base de datos, en un array
			$userEmpresa = $userEmpresa->fetch(PDO::FETCH_ASSOC);

			//Si se encontro el dato, se realiza la comparacion
			if (!empty($userEmpresa)) 
			{
				
				//Se comprara el usuario y la contrasena
				if ((strcmp($login["user"], $userEmpresa["nombre_usuario"]) === 0) && (strcmp($login["pass"], $userEmpresa["contrasena_usuario"]) === 0))
				{

					//Se usa una variable de sesion para que pueda mantener la sesion activa
					if (!isset($_SESSION["usuarioActivo"])) $_SESSION["usuarioActivo"] = true;

					//Se almacena el indice de la empresa dentro de la tabla en otra variable de sesion
					if (!isset($_SESSION["userId"])) $_SESSION["userId"] = $userEmpresa["id_usuario"];

					header("Location: ../pages/cuentaUsuario.php");
					exit();

				}else $error = 17;
				

			}else $error = 17;
		
		}

		//Se regresa con el valor del error
		if ($error > 0)
		{
			header("Location: ../pages/login.php?error=".$error);
			exit();
		}

	}

	//Si todo ha salido bien, se regresa a la paginna principal
	//header("Location: ../index.php");

?>

