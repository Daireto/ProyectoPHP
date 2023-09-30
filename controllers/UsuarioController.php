<?php
require_once 'models/Usuario.php';

class UsuarioController
{
    public $model;
    public $errors;

    public function __construct()
    {
        $this->model = new Usuario();
        $this->errors = null;
    }

    public function ejecutar()
    {
        validar_sesion();
        $accion = isset($_GET['accion']) ? $_GET['accion'] : 'listar';
        switch ($accion) {
            case 'listar':
                include 'views/usuarios/lista.php';
                break;

            case 'ver':
                include 'views/usuarios/lista.php';
                break;

            case 'editar':
                include 'views/usuarios/lista.php';
                break;

            case 'eliminar':
                include 'views/usuarios/lista.php';
                break;

            default:
                $_GET['mensaje'] = 'Acción desconocida';
                include 'views/error.php';
                break;
        }
    }

    public function listar()
    {
        return $this->model->listar();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && validar_campos('usuario', 'password')) {
            $registro = $this->model->login($_POST['usuario'], $_POST['password']);
            if (isset($registro)) {
                unset($_SESSION['usuario']);
                $_SESSION['usuario'] = $registro['usuario'];
                $this->errors = null;
                header('Location:' . 'index.php');
            } else {
                $this->errors = array('Usuario o contraseña incorrectos');
            }
        }

        include 'views/auth/login.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && validar_campos('nombre', 'apellido', 'cedula', 'usuario', 'email', 'password', 'confirm-password')) {
            if ($_POST['password'] == $_POST['confirm-password']) {
                $this->model->setNombre($_POST['nombre']);
                $this->model->setApellido($_POST['apellido']);
                $this->model->setCedula($_POST['cedula']);
                $this->model->setUsuario($_POST['usuario']);
                $this->model->setEmail($_POST['email']);
                $this->model->setPassword($_POST['password']);
                $registro = $this->model->guardar();
                if (isset($registro)) {
                    unset($_SESSION['usuario']);
                    $_SESSION['usuario'] = $registro['usuario'];
                    $this->errors = null;
                    header('Location:' . 'index.php');
                } else {
                    $this->errors = array('No se pudo realizar el registro');
                }
            } else {
                $this->errors = array('La contraseña y la confirmación no coinciden');
            }
        }

        include 'views/auth/register.php';
    }
}
