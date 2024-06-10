//

	let fechaLimite = null;

function imprimirCronometro(segundos)
{

	//Se obtiene el valor de la etiqueta milisegundos
	milisegundos = document.getElementById("milisegundos");
	
	milisegundos.innerHTML = "milisegundos";

}

function cronometro(segundos)
{

	//setTimeout(() => window.location.href = '../pages/pruebaTerminada.php', segundos * 1000);
	var i = 0;

	while(1)
	{

		i++;

		setTimeout(() => console.log(i), segundos * 1000)

	}

}
