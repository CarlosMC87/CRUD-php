

//Paso 1: Definir función para trasladar los datos de la persona a modificar al formulario oculto.
function transladarDatos(ev) {

    //console.log(ev.target);

    //Paso 2: Situarnos en la etiqueta tr que corresponda a la fila donde se encuentra el botón.

	let botonPulsado = ev.target;
    let tr = botonPulsado.closest("tr")

    //Paso 3: Recuperar los datos de la persona.
    let celdas = tr.querySelectorAll('td');
	let nif = celdas[0].innerText.trim(); // Primer <td>, donde esta el NIF
    // let nif = tr.querySelector('.nif').innerText
    let nombre = tr.querySelector('.nombre').value
    let direccion = tr.querySelector('.direccion').value

    console.log(nif, nombre, direccion)

    //Paso 4: Trasladar los datos al formulario oculto.
    document.querySelector('#nifModi').value = nif
    document.querySelector('#nombreModi').value = nombre
    document.querySelector('#direccionModi').value = direccion

    //Paso 5: Formulario.submit();
    document.querySelector('#formularioModi').submit();
}