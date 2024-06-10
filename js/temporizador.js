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
	      ejercicio.innerHTML = finalMessage;
	    }

	  }, 1000)
	};

	var avisoTiempoAcabado = '¡Terminó la prueba!';

	function cuentaRegresiva()
		{

			//Se crea la fecha actual como la fecha limite
			//Se le suma una hora mas a la fecha actual para crear coordinar el cronometro 
			//Basicamente, se extrae la hora actual para devolverlo incrementado a 1
			fechaLimite = new Date().setHours(new Date().getHours() + 1);

			//Esta es una prueba. Hay que eliminarla una vez se termine la prueba
			//fechaLimite = new Date(new Date().setSeconds(new Date().getSeconds() + 5 ));
			console.log(fechaLimite);

			//Se ejecuta la funcion
			countdown(fechaLimite, 'ejercicio', 'clock', avisoTiempoAcabado);

		}
