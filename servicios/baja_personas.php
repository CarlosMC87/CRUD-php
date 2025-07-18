<?php 
    session_start();
/* 
* === BAJA DE TODAS LAS PERSONAs ===
* Objetivo: Eliminar todas las personas del array.
*/

//Paso 1: Borra todas las personas del array de sesion.

//Primera forma
// if (isset($_SESSION['personas'])) {
//     unset($_SESSION['personas']);
// }

//Segunda forma
$_SESSION['personas'] = [];

//Añadimos mensaje de confirmación.
$_SESSION['mensaje2'] = "Lista borrada con exito.";
unset($_SESSION['error']);

//Tercera forma
//Volvemos a la pagina principal, y ahi se borran del array de sesion personas. ../index.php
header("Location: ../personas.php"); //Escribe bien la direccion.
exit;