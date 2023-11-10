<?php
require_once 'config/funciones.php';
require_once 'controllers/UsuarioController.php';
require_once 'controllers/EstadiaController.php';
require_once 'controllers/CuentaController.php';
require_once 'controllers/PagoController.php';
require_once 'controllers/MensajeController.php';

// Inicializar sesión y variables
session_start();
unset($_GET['mensaje']);

// Controladores
$usuarioController = new UsuarioController();
$estadiaController = new EstadiaController();
$cuentaController = new CuentaController();
$pagoController = new PagoController();
$mensajeController = new MensajeController();

// Mensajes pendientes
$_GET['mensajesPendientes'] = validar_rol('Admin') ? $mensajeController->contarNoLeidos() : null;

// Rutas
$url = isset($_GET['url']) ? $_GET['url'] : 'principal';
try {
    switch ($url) {
        case 'principal':
            include 'views/principal.php';
            break;

        case 'login':
            $usuarioController->login();
            break;

        case 'register':
            $usuarioController->register();
            break;

        case 'logout':
            session_destroy();
            header('Location:' . 'index.php?url=login');
            break;

        case 'cuenta':
            $cuentaController->ejecutar();
            break;

        case 'usuarios':
            $usuarioController->ejecutar();
            break;

        case 'estadias':
            $estadiaController->ejecutar();
            break;

        case 'pago':
            $pagoController->ejecutar();
            break;

        case 'mensajes':
            $mensajeController->ejecutar();
            break;

        case 'no-autorizado':
            $_GET['mensaje'] = 'Acceso no autorizado';
            include 'views/error.php';
            break;

        case 'error':
            $_GET['mensaje'] = isset($_GET['texto']) ? $_GET['texto'] : 'Ha ocurrido un error desconocido';
            include 'views/error.php';
            break;

        default:
            $_GET['mensaje'] = 'Página no encontrada';
            include 'views/error.php';
            break;
    }
} catch (Throwable $th) {
    $_GET['mensaje'] = 'Ha ocurrido un error desconocido';
    include 'views/error.php';
}
