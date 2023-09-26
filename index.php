<?php
require_once 'controllers/UsuarioController.php';

$userController = new UsuarioController();

session_start();

// Inicializar variables

$url = 'index';
$action = '';

if (isset($_GET['url'])) {
    $url = $_GET['url'];
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

// Acciones

switch ($action) {
    case 'login':
        $userController->login();
        break;

    case 'register':
        break;

    case 'contacto':
        break;

    default:
        break;
}

// Validar sesión del usuario

if (!isset($_SESSION['usuario']) && ($url != 'login' && $url != 'register')) {
    $url = 'login';
}

function render($vista) {
    if(isset($_SESSION['usuario'])) {
        include $vista;
    } else {
        include 'views/auth/login.php';
    }
}

// Rutas

switch ($url) {
    case 'logout':
        session_destroy();
        header('Location:'.'index.php?url=login');
        break;

    case 'login':
        if(!isset($_SESSION['usuario'])) {
            include 'views/auth/login.php';
        } else {
            include 'views/main.php';
        }
        break;

    case 'register':
        if(!isset($_SESSION['usuario'])) {
            include 'views/auth/register.php';
        } else {
            include 'views/main.php';
        }
        break;

    case 'usuarios':
        render('views/main.php');
        break;

    case 'mensajes':
        render('views/main.php');
        break;

    case 'ingresos':
        render('views/main.php');
        break;

    case 'salidas':
        render('views/main.php');
        break;

    case 'pagos':
        render('views/main.php');
        break;

    case 'perfil':
        render('views/main.php');
        break;

    default:
        render('views/main.php');
        break;
}
