<?php
	
	//Se crean las constantes para el tipo de error
	define('CONTRASENAS_NO_COINCIDEN', 1);
	define('CONTRASENAS_FUERA_RANGO', 2);
	define('USUARIO_INVALIDO', 3);
	define('CORREO_INVALIDO', 4);
	define('CORREO_FUERA_RANGO', 5);
	define('TELEFONO_INVALIDO', 6);
	define('TELEFONO_FUERA_RANGO', 7);
	define('DIRECCION_INVALIDA', 8);
	define('RAZON_SOCIAL_INVALIDA', 9);
	define('RAZON_SOCIAL_FUERA_RANGO', 10);
	define('NOMBRE_INVALIDO', 11);
	define('NOMBRE_FUERA_RANGO', 12);
	define('RIF_INVALIDO', 13);
	define('RIF_FUERA_RANGO', 14);
	define('INPUT_VACIO', 15);
	define('RIF_YA_EXISTENTE', 16);

	define('LOGIN_INVALIDO', 17);

	define('CEDULA_YA_EXISTENTE', 18);
	define('CEDULA_FUERA_RANGO', 19);

	define('PRIMER_NOMBRE_INVALIDO', 20);
	define('PRIMER_NOMBRE_FUERA_RANGO', 21);

	define('SEGUNDO_NOMBRE_INVALIDO', 22);
	define('SEGUNDO_NOMBRE_FUERA_RANGO', 23);

	define('PRIMER_APELLIDO_INVALIDO', 24);
	define('PRIMER_APELLIDO_FUERA_RANGO', 25);

	define('SEGUNDO_APELLIDO_INVALIDO', 26);
	define('SEGUNDO_APELLIDO_FUERA_RANGO', 27);

	//Funcion que retorna el aviso de un error
	function error($tipo)
	{

		$mensajeError = " ";

		switch ($tipo) 
		{

			case CONTRASENAS_NO_COINCIDEN:    
				
				$mensajeError = " Las contraseñas no coinciden.";

				break;

			case CONTRASENAS_FUERA_RANGO:    
				
				$mensajeError = " La contraseña debe de tener entre 6 y 20 caracteres.";

				break;

			case USUARIO_INVALIDO:    
				
				$mensajeError = " El usuario debe de tener entre 6 y 20 caracteres, y no debe de tener espacios ni caracteres no permitidos.";

				break;

			case CORREO_INVALIDO:    
				
				$mensajeError = " Dirección de correo electrónico inválido.";

				break;

			case CORREO_FUERA_RANGO:    
				
				$mensajeError = " La dirección de correo electrónico debe de tener entre 10 y 255 caracteres.";

				break;

			case TELEFONO_INVALIDO:    
				
				$mensajeError = " El número de teléfono inválido.";

				break;

			case TELEFONO_FUERA_RANGO:    
				
				$mensajeError = " El número de teléfono debe de tener 11 caracteres.";

				break;

			case DIRECCION_INVALIDA:    
				
				$mensajeError = " Dirección inválida.";

				break;

			case RAZON_SOCIAL_INVALIDA:    
				
				$mensajeError = " Razón social inválida.";

				break;

			case RAZON_SOCIAL_FUERA_RANGO:    
				
				$mensajeError = " La razón social debe de tener entre 5 y 50 caracteres.";

				break;

			case NOMBRE_INVALIDO:    
				
				$mensajeError = " Nombre comercial inválido.";

				break;

			case NOMBRE_FUERA_RANGO:    
				
				$mensajeError = " El nombre comercial debe de tener entre 5 y 20 caracteres.";

				break;

			case RIF_INVALIDO:    
				
				$mensajeError = " R.I.F inválido.";

				break;

			case RIF_FUERA_RANGO:    
				
				$mensajeError = " El R.I.F debe de tener entre 9 caracteres.";

				break;

			case INPUT_VACIO:    
				
				$mensajeError = " Campo(-s) vacio(-s)";

				break;

			case RIF_YA_EXISTENTE:    
				
				$mensajeError = " El R.I.F ya existe en la base de datos.";

				break;

			case LOGIN_INVALIDO:    
				
				$mensajeError = " Usuario o contraseña inválidos.";

				break;

			case CEDULA_YA_EXISTENTE:    
				
				$mensajeError = " La cédula ya existe en la base de datos.";

				break;

			case CEDULA_FUERA_RANGO:    
				
				$mensajeError = " La cédula debe de estar entre 6000000 y 31000000";

				break;

			case PRIMER_NOMBRE_INVALIDO:    
				
				$mensajeError = " El primer nombre debe tener solo caracteres";

				break;

			case PRIMER_NOMBRE_FUERA_RANGO:    
				
				$mensajeError = " El primer nombre debe tener entre 3 y 20 caracteres";

				break;

			case SEGUNDO_NOMBRE_INVALIDO:    
				
				$mensajeError = " El segundo nombre debe tener solo caracteres";

				break;

			case SEGUNDO_NOMBRE_FUERA_RANGO:    
				
				$mensajeError = " El segundo nombre debe tener entre 3 y 20 caracteres";

				break;

			case PRIMER_APELLIDO_INVALIDO:    
				
				$mensajeError = " El primer apellido debe tener solo caracteres";

				break;

			case PRIMER_APELLIDO_FUERA_RANGO:    
				
				$mensajeError = " El primer apellido debe tener entre 3 y 20 caracteres";

				break;

			case SEGUNDO_APELLIDO_INVALIDO:    
				
				$mensajeError = " El segundo apellido debe tener solo caracteres";

				break;

			case SEGUNDO_APELLIDO_FUERA_RANGO:    
				
				$mensajeError = " El segundo apellido debe tener entre 3 y 20 caracteres";

				break;

		}

		return $mensajeError;

	}




?>