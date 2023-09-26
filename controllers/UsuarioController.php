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

    public function ejecutar() {
        validar_sesion();
        $accion = isset($_GET['accion']) ? $_GET['accion'] : 'listar';
        switch ($accion) {
            case 'listar':
                $this->listar();
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario']) && isset($_POST['password'])) {
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
        $this->errors = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario'])) {
            $_SESSION['usuario'] = $_POST['usuario'];
            header('Location:' . 'index.php');
        }

        include 'views/auth/register.php';
    }
}
