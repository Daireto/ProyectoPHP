<?php

// Verifica que el usuario tenga un rol determinado
function validar_rol($rol)
{
    return isset($_SESSION['rol']) && $_SESSION['rol'] == $rol;
}

// Verifica que el usuario esté autenticado
function validar_sesion($rol = null)
{
    if (!isset($_SESSION['usuario']) || !isset($_SESSION['cedula'])) {
        header('Location:' . 'index.php?url=no-autorizado');
    }
    if ($rol != null && !validar_rol($rol)) {
        header('Location:' . 'index.php?url=no-autorizado');
    }
}

// Valida que todos los campos se hayan enviado
function validar_campos()
{
    $listaCampos = func_get_args();
    $resultado = true;
    $camposFaltantes = array();

    foreach ($listaCampos as $campo) {
        if (!isset($_POST[$campo]) || !$_POST[$campo] || !trim(strval($_POST[$campo]))) {
            array_push($camposFaltantes, $campo);
            $resultado = false;
        }
    }

    if (!$resultado) {
        if (count($camposFaltantes) == 1) {
            $_GET['mensaje'] = 'El campo "' . $camposFaltantes[0] . '" es requerido';
        } else {
            $_GET['mensaje'] = 'Los campos "' . implode(', ', $camposFaltantes) . '" son requeridos';
        }
    }

    return $resultado;
}

// Muestra un valor enviado previamente sólo si existe
function mostrar_campo($campo)
{
    echo isset($_POST[$campo]) ? $_POST[$campo] : null;
}

// Mostrar la página de error con un mensaje especifico
function mostrar_error($mensaje)
{
    header('Location:' . 'index.php?url=error&texto='.$mensaje);
}
