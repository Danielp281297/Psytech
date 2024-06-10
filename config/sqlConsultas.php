<?php
	
	// Establecer la zona horaria de Venezuela (America/Caracas)
		date_default_timezone_set('America/Caracas');

	//Se requiere las consultas de sql
	require_once "dbConnect.php";

	//Funcion que regresa la consulta para almacenar el contenido de la tabla ejercicios
	function consultaEjercicio($indice)
	{

		$sql = "SELECT
			    *
			FROM
			    `ejercicio` a
			INNER JOIN `opciones_ejercicio` b ON
			    a.id_opciones_ejercicio = b.id_opciones_ejercicio
			INNER JOIN `tipo_ejercicio` c ON
			    a.id_tipo_ejercicio = c.id_tipo_ejercicio
			WHERE 
			a.id_ejercicio = ".$indice."
			ORDER BY a.id_tipo_ejercicio;";

		return $sql;
	}

	//Funcion que da de salida, el contenido de la tabla actividad_economica_empresa
	function consultasActividadEconomicaEmpresa($connect)
	{

		$actividadEconomicaEmpresa = " ";

		//Genera la consulta
		$sql = 'SELECT * FROM `actividad_económica_empresa`;';

		//Prepara y realiza la consulta
		$actividadEconomicaEmpresa = $connect->query($sql);

		//Devuelve el contenido de la tabla
		return $actividadEconomicaEmpresa;

	}

	//Funcion que da de salida, el contenido de la tabla sector_empresa
	function consultaSectorEmpresa($connect)
	{

		$sectorEmpresa = " ";

		//Genera la consulta
		$sql = 'SELECT * 
				FROM `sector_empresa`;';

		//Prepara y realiza la consulta
		$sectorEmpresa = $connect->query($sql);

		//Devuelve el contenido de la tabla
		return $sectorEmpresa;

	}

	//Funcion que da de salida, el contenido de la consulta para insertar en la tabla tipo_empresa, usuario, y empresa
	function consultaInsertarEmpresa($datosEmpresa, $connect)
	{

		$sql = " 

		INSERT INTO `usuario`(
            `id_usuario`,
            `nombre_usuario`,
            `contrasena_usuario`
        )
        VALUES(
            NULL,
            '".$datosEmpresa['usuarioEmpresa']."',
            '".$datosEmpresa['contrasenaEmpresa']."'
        );
        
		INSERT INTO `tipo_empresa`(
		            `id_tipo_empresa`,
		            `id_sector_empresa`,
		            `id_actividad_económica_empresa`
		        )
		        VALUES(
		            NULL,
		            '".$datosEmpresa['sectorEmpresa']."',
		            '".$datosEmpresa['actividadEconomicaEmpresa']."'
		        );
		        
		INSERT INTO `empresa`(
		            `id_empresa`,
		            `RIF_empresa`,
		            `nombre_empresa`,
		            `razón_social_empresa`,
		            `id_tipo_empresa`,
		            `dirección_empresa`,
		            `telefono_empresa`,
		            `correo_empresa`,
		            `logo_empresa`,
		            `id_usuario`
		        )
		        VALUES(
		            NULL,
		            '".$datosEmpresa["rifEmpresa"]."',
		            '".$datosEmpresa["nombreEmpresa"]."',
		            '".$datosEmpresa["razonSocialEmpresa"]."',
		            (SELECT COUNT(*) FROM `tipo_empresa`),
		            '".$datosEmpresa["direccionEmpresa"]."',
		            '".$datosEmpresa["telefonoEmpresa"]."',
		            '".$datosEmpresa["correoElectronicoEmpresa"]."',
		            NULL,
		            (SELECT COUNT(*) FROM `usuario`)
		        );

		";

		//Prepara y realiza la consulta
		$insertarDatosEmpresa = $connect->query($sql);

		//Devuelve el contenido de la tabla
		return $insertarDatosEmpresa;

	}

	function consultainsertarAspirante($datosAspirante, $connect)
	{

		//Se captura el periodo de tiempo 
		// Obtener la fecha actual
		$fechaActual = new DateTime();
		$fechaSiguiente = new DateTime();

		// Sumar 6 meses a la fecha actual
		$fechaSiguiente = $fechaSiguiente->add(new DateInterval('P6M'));

		// Formatear la fecha en formato Y-m-d
		//Se crea la consulta
		$sql = "


		INSERT INTO `persona`(
		    `id_persona`,
		    `cédula_persona`,
		    `primer_nombre_persona`,
		    `segundo_nombre_persona`,
		    `primer_apellido_persona`,
		    `segundo_apellido_persona`,
		    `fecha_nacimiento_persona`,
		    `dirección_persona`,
		    `teléfono_persona`,
		    `correo_persona`

		)
		VALUES(
		    NULL,
		    '".$datosAspirante["cedulaAspirante"]."',
		    '".$datosAspirante["primerNombreAspirante"]."',
		    '".$datosAspirante["segundoNombreAspirante"]."',
		    '".$datosAspirante["primerApellidoAspirante"]."',
		    '".$datosAspirante["segundoApellidoAspirante"]."',
		    '".$datosAspirante["fechaNacimientoAspirante"]."',
		    '".$datosAspirante["direccionAspirante"]."',
		    '".$datosAspirante["telefonoAspirante"]."',
		    '".$datosAspirante["correoElectronicoAspirante"]."'
		);


		INSERT INTO `periodo_prospecto`(
		    `id_periodo_prospecto`,
		    `fecha_inicio_prospecto`,
		    `fecha_fin_prospecto`
		)
		VALUES(
		    NULL,
		    '".$fechaActual->format('Y-m-d')."',
		    '".$fechaSiguiente->format('Y-m-d')."'
		);

		";



		//Se genera la consulta
		$datosAspirante = $connect->query($sql);

		//Se retorna su valor
		return $datosAspirante;

	}

	//Funcion que da de salida, el contenido de un usuario para comprobarlo en el login
	function consultaLoginEmpresa($username ,$connect)
	{

		$loginEmpresa = " ";

		//Genera la consulta
		$sql = "SELECT
				    *
				FROM
				    `usuario`
				WHERE 
				`nombre_usuario` = '".$username."';
				";

		//Prepara y realiza la consulta
		$loginEmpresa = $connect->query($sql);

		//Devuelve el contenido de la tabla
		return $loginEmpresa;

	}

	function consultaCargoAspirante($connect)
	{

		$sql = "

			SELECT
				 * 
			FROM 
				`cargo` 
			WHERE 
				1;
		";

		$consultaCargoAspirante = $connect->query($sql);

		return $consultaCargoAspirante;

	}


	function consultaResultadosProspecto($resultados, $connect)
	{

		$sql = "

		INSERT INTO `resultados`(
            `id_resultados`,
            `interpretación_resultados`,
            `percepción_resultados`,
            `agilidad_resultados`,
            `total_respuestas_resultados`,
            `hora_inicio_prueba_resultados`,
            `hora_fin_prueba_resultados`
        )
        VALUES(
            NULL,
            '".$resultados["interpretacion"]."',
            '".$resultados["percepcion"]."',
            '".$resultados["agilidad"]."',
            '".$resultados["totalRespuestas"]."',
            '".$resultados["tiempoInicio"]."',
            '".$resultados["tiempoFin"]."'
        );

		INSERT INTO `prospecto`(
		    `id_prospecto`,
		    `id_persona`,
		    `id_empresa`,
		    `id_cargo`,
		    `id_periodo_prospecto`,
		    `id_resultados`
		)
		VALUES(
		    NULL,
		    (SELECT COUNT(*) FROM `persona`),
		    '".$resultados["indiceEmpresa"]."',
		    '".$resultados["cargoAspirante"]."',
		    (SELECT COUNT(*) FROM `periodo_prospecto`),
		    (SELECT COUNT(*) FROM `resultados`)
		);


		";

		$consultaResultadosProspecto = $connect->query($sql);

		return $consultaResultadosProspecto;

	}

	function consultaAspiranteFecha($date, $connect)
	{

		$sql = "

			SELECT
			    *
			FROM
			    `periodo_prospecto`a
			INNER JOIN
				`persona`b 
			ON a.id_periodo_prospecto = b.id_persona
			INNER JOIN
				`resultados`c
			ON a.id_periodo_prospecto = c.id_resultados

			WHERE
			    `fecha_inicio_prospecto` = '".$date."';

		";

		$consulta = $connect->query($sql);

		return $consulta;

	}

	function consultaBuscarRif($rif, $connect)
	{

		$sql = "
				SELECT
			    `RIF_empresa`
			FROM
			    `empresa`
			WHERE
			    `RIF_empresa` = '".$rif."';
			   ";

		$consulta = $connect->query($sql);

		return $consulta;

	}

	function consultaBuscarCedula($cedula, $connect)
	{

		$sql = "
				SELECT
				    `cédula_persona`
				FROM
				    `persona`
				WHERE
				    `cédula_persona` = '".$cedula."';
			   ";

		$consulta = $connect->query($sql);

		return $consulta;

	}

	

	function consulta()
	{

		$consulta = null;

		return $consulta;

	}

?>