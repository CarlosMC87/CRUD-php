<?php 
    session_start();
/* 
* === BAJA DE PERSONA ===
* Objetivo: Eliminar del array de sesion a la persona cuyo NIF se ha recibido por POST.
*/

//Paso 1: Recuperar las personas del array de sesion.

//Paso 2: Comprobamos que hemos recibido el NIF a dar de baja y que existe el array en sesion.
if (isset($_POST['nifBaja']) && isset($_SESSION['personas'])) {
    
    //Paso 3: recuperar el nif.
    $nifBaja = $_POST['nifBaja'];

    //Paso 4: Recorremos el array y eliminamos la persona con ese NIF.
    foreach ($_SESSION['personas'] as $indice => $persona) {
        if ($persona['nif'] === $nifBaja) {
            unset($_SESSION['personas'][$indice]);
            break; //Salimos del bucle, ya la encontramos.
        }
    }

    //Paso 5: Reindexar el array para que no queden huecos entre celdas de memoria.
    $_SESSION['personas'] = array_values($_SESSION['personas']);

    //Añadimos mensaje de confirmación.
    $_SESSION['mensaje_baja'] = "Usuario dado de baja con éxito.";

}

//Volvemos a la pagina principal actualizada.
header("Location: ../personas.php"); //Escribe bien la direccion.
exit;