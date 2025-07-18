<?php

//Array para almacenar multiples errores.
$errores = [];

//FUNCION DE VALIDACION DE DATOS
function validarDatos($nif, $nombre, $direccion)
{

    //Valida que los campos no esten vacios. Y almacena cada error que pueda producirse dentro del aarray.
    if (empty($nif)) {
        $errores[] = "El campo NIF es obligatorio.";
    }

    if (empty($nombre)) {
        $errores[] = "El campo Nombre es obligatorio.";
    }

    if (empty($direccion)) {
        $errores[] = "El campo Dirección es obligatorio.";
    }

    //Si hay errores, lanzar excepcion con todos ellos.
    if (!empty($errores)) {

        // En vez de lanzar excepcion, lo guardamos en la sesion.
        $_SESSION['errores'] = $errores;
        return false;
    }

    return true;
}

//fUNCION PARA VALIDAR NIF NO REPETIDO
function isNifUnico($nifNuevo, $personas)
{

    foreach ($personas as $persona) {

        if ($persona['nif'] === $nifNuevo) {

            $errores[] = "NIF no valido! Introducelo de nuevo.";
            $_SESSION['errores'] = $errores;
            return false; // Ya existe ese NIF
        }
    }

    // //Si hay errores, lanzar excepcion con todos ellos.
    // if (!empty($errores)) {

    //     // En vez de lanzar excepcion, lo guardamos en la sesion.
    //     $_SESSION['errores'] = $errores;
    //     return false;
    // }

    return true; //Es unico.
}
