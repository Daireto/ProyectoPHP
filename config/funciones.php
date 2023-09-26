<?php

// Verifica que el usuario esté autenticado
function validar_sesion()
{
    if (!isset($_SESSION['usuario'])) {
        header('Location:' . 'index.php?url=no-autorizado');
    }
}
