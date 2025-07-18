<?php 
    session_start();
/*
 * === MODIFICACION DE UNA PERSONA ===
 * Objetivo: Actualizar los datos de una persona en el array de sesión.
 */

//Variable para verificar si se encontró y modificó la persona.
$modificado = false;

//Paso 1: Inicializar el array de sesion si no existe.
if (!isset($_SESSION['personas'])) {
    $_SESSION['personas'] = [];
}

//Paso 2: Recuperar los datos enviados por POST.
$nif = $_POST['nifModi'];				//NIF nuevo
$nombre = $_POST['nombreModi'];		    //nombre nuevo
$direccion = $_POST['direccionModi'];	//direccion nueva

//Paso 3: Buscar a la persona en el array por su NIF original y actualizar los datos.
foreach ($_SESSION['personas'] as $index => $persona) {
    if ($persona['nif'] === $nif) {
        $_SESSION['personas'][$index] = [
            "nif" => $nif,
            "nombre" => $nombre,
            "direccion" => $direccion
        ];
        $modificado = true;
        break;//Salimos tras modificar.
    }
}

//Añadimos mensaje de confirmación.
if($modificado) {
    
    $_SESSION['mensaje_modi'] = "Modificación realizada con éxito.";
    unset($_SESSION['error']);
} else {
    $_SESSION['error'] = "Error: No se pudo encontrar la persona para modificar.";

}

//Volvemos a la pagina principal.
header("Location: ../personas.php");
exit;