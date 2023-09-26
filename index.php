<?php
require_once 'controllers/UsuarioController.php';

// Inicializar sesión
session_start();

// Controladores
$userController = new UsuarioController();

// Variables
$url = 'index';
$form = '';
unset($_GET['mensaje']);

if (isset($_GET['url'])) {
    $url = $_GET['url'];
}

if (isset($_GET['form'])) {
    $form = $_GET['form'];
}

// Funciones
function render($vista, $rol = null) {
    if(isset($_SESSION['usuario'])) {
        if($rol != null && (!isset($_SESSION['rol']) || $rol != $_SESSION['rol'])) {
            $_GET['mensaje'] = 'Acceso no autorizado';
            return render('views/error.php');
        }
        return $vista;
    } else {
        return 'views/auth/login.php';
    }
}

// Formularios
switch ($form) {
    case 'login':
        $userController->login();
        header('Location:'.'index.php');
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

// Rutas
switch ($url) {
    case 'index':
        include render('views/index.php');
        break;

    case 'login':
        if(!isset($_SESSION['usuario'])) {
            include 'views/auth/login.php';
        } else {
            include 'views/index.php';
        }
        break;

    case 'register':
        if(!isset($_SESSION['usuario'])) {
            include 'views/auth/register.php';
        } else {
            include 'views/index.php';
        }
        break;

    case 'logout':
        session_destroy();
        header('Location:'.'index.php?url=login');
        break;

    case 'usuarios':
        $usuarios = $userController->listar();
        include render('views/usuarios/lista.php');
        break;

    case 'mensajes':
        include render('views/index.php', 'admin');
        break;

    case 'ingresos':
        include render('views/index.php', 'admin');
        break;

    case 'salidas':
        include render('views/index.php', 'admin');
        break;

    case 'pagos':
        include render('views/index.php', 'admin');
        break;

    case 'perfil':
        include render('views/index.php');
        break;

    default:
        $_GET['mensaje'] = 'Página no encontrada';
        include render('views/error.php');
        break;
}
