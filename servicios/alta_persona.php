<?php 
session_start();

/* 
* === ALTA DE PERSONA ===
* Objetivo: Añadir una nueva persona al array de sesion a partir de los datos recibidos por POST.
*/

require_once("funciones/validardatos.php");

//Paso 1: Comprobamos que se han recibido todos los datos necesarios por POST.
if (isset($_POST['nif'], $_POST['nombre'], $_POST['direccion'])) {

    //Paso 2: Recuperar y limpiar los datos recibidos.
    $nif = trim($_POST['nif']);
    $nombre = trim($_POST['nombre']);
    $direccion = trim($_POST['direccion']);

    //Paso 3: Validar que los campos no esten vacios, enviando a la funcion los parametros.
    if (!validarDatos($nif, $nombre, $direccion)) {

        //Si hay errores, volver sin procesar alta
        header("Location: ../personas.php");
        exit;
    }
    
    //Paso 4: Inicializar el array de sesion si aun no existe.
    if (!isset($_SESSION['personas'])) {
        $_SESSION['personas'] = [];
    }

    //Paso 5: Validar que el dni no este ya resgistrado con otro usuario/persona
    if (!isNifUnico($nif, $_SESSION['personas'])) {
        header("Location: ../personas.php");
        exit;
    }

    //Paso 6: Añadir la nueva persona al array.
    $_SESSION['personas'][] = [
        "nif" => $nif,
        "nombre" => $nombre,
        "direccion" => $direccion
    ];

    //Añadimos mensaje de confirmación.
    $_SESSION['mensaje'] = "Alta efectuada correctamente.";
    unset($_SESSION['error']);

}

//Volver a la pagina principal
header("Location: ../personas.php");//Escribe bien la direccion.
exit;