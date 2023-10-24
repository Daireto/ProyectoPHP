<?php
require_once 'models/Usuario.php';

class UsuarioController
{
    public $model;
    public $errors;
    public $usuario;
    public $usuarios;

    public function __construct()
    {
        $this->model = new Usuario();
        $this->errors = null;
    }

    public function ejecutar()
    {
        validar_sesion('Admin');
        $accion = isset($_GET['accion']) ? $_GET['accion'] : 'listar';
        switch ($accion) {
            case 'listar':
                $this->usuarios = $this->listar();
                include 'views/usuarios/lista.php';
                break;

            case 'crear':
                $this->usuario = $this->crear();
                include 'views/usuarios/crear.php';
                break;

            case 'ver':
                $this->usuario = $this->consultar();
                include 'views/usuarios/ver.php';
                break;

            case 'editar':
                $this->usuario = $this->editar();
                include 'views/usuarios/editar.php';
                break;

            case 'eliminar':
                $this->eliminar();
                include 'views/usuarios/eliminar.php';
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

    public function consultar()
    {
        if (isset($_GET['id'])) {
            $usuario = $this->model->consultar($_GET['id']);
            if ($usuario != null) {
                return $usuario;
            }
        }
        mostrar_error('Usuario no encontrado');
    }

    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && validar_campos('nombre', 'apellido', 'cedula', 'usuario', 'email',  'rol', 'password', 'confirm-password')) {
            if ($_POST['password'] == $_POST['confirm-password']) {
                $this->model->setNombre($_POST['nombre']);
                $this->model->setApellido($_POST['apellido']);
                $this->model->setCedula($_POST['cedula']);
                $this->model->setUsuario($_POST['usuario']);
                $this->model->setEmail($_POST['email']);
                $this->model->setPassword($_POST['password']);
                $this->model->setRol($_POST['rol']);
                $registro = $this->model->guardar();
                if (isset($registro)) {
                    header('Location:' . 'index.php?url=usuarios&accion=ver&id=' . $this->model->getCedula());
                } else {
                    $this->errors = array('No se pudo crear el usuario');
                }
            } else {
                $this->errors = array('La contraseña y la confirmación no coinciden');
            }
        }
        include 'views/usuarios/crear.php';
    }

    public function editar()
    {
        $this->consultar();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && validar_campos('nombre', 'apellido', 'cedula', 'usuario', 'email',  'rol')) {
            $this->model->setNombre($_POST['nombre']);
            $this->model->setApellido($_POST['apellido']);
            $this->model->setCedula($_POST['cedula']);
            $this->model->setUsuario($_POST['usuario']);
            $this->model->setEmail($_POST['email']);
            $this->model->setRol($_POST['rol']);
            $registro = $this->model->editar($_GET['id']);
            if (isset($registro)) {
                header('Location:' . 'index.php?url=usuarios&accion=ver&id=' . $this->model->getCedula());
            } else {
                $this->errors = array('No se pudo editar el usuario');
            }
        }
        include 'views/usuarios/editar.php';
    }

    public function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->consultar();
            if ($this->model->eliminar($_GET['id'])) {
                header('Location:' . 'index.php?url=usuarios');
            } else {
                $this->errors = array('No se pudo eliminar el usuario');
            }
        }
        include 'views/usuarios/eliminar.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && validar_campos('usuario', 'password')) {
            $registro = $this->model->login($_POST['usuario'], $_POST['password']);
            if (isset($registro)) {
                unset($_SESSION['usuario']);
                $_SESSION['usuario'] = $registro['usuario'];
                $_SESSION['rol'] = $registro['rol'];
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
                $this->model->setRol('Usuario');
                $registro = $this->model->guardar();
                if (isset($registro)) {
                    unset($_SESSION['usuario']);
                    $_SESSION['usuario'] = $registro['usuario'];
                    $_SESSION['rol'] = $registro['rol'];
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
