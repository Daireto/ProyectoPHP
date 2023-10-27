<?php
require_once 'models/Usuario.php';

class UsuarioController
{
    public $model;
    public $errors;
    public $usuario;
    public $usuarios;
    public $cantidadUsuarios;
    public $cantidadPorPagina;
    public $roles;

    public function __construct()
    {
        $this->model = new Usuario();
        $this->errors = null;
        $this->cantidadUsuarios = 0;
        $this->cantidadPorPagina = 8;
        $this->roles = array('Usuario', 'Admin');
    }

    public function ejecutar()
    {
        validar_sesion('Admin');
        $accion = isset($_GET['accion']) ? $_GET['accion'] : 'listar';
        switch ($accion) {
            case 'listar':
                $this->listar();
                break;

            case 'crear':
                $this->crear();
                break;

            case 'ver':
                $this->ver();
                break;

            case 'editar':
                $this->editar();
                break;

            case 'eliminar':
                $this->eliminar();
                break;

            default:
                $_GET['mensaje'] = 'Acción desconocida';
                include 'views/error.php';
                break;
        }
    }

    public function listar()
    {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $this->cantidadUsuarios = $this->model->contar();
        $this->usuarios = $this->model->listar($page, $this->cantidadPorPagina);
        $_GET['pages'] = ceil($this->cantidadUsuarios / $this->cantidadPorPagina);
        include 'views/usuarios/lista.php';
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

    public function ver()
    {
        $this->usuario = $this->consultar();
        include 'views/usuarios/ver.php';
    }

    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && validar_campos('nombre', 'apellido', 'cedula', 'usuario', 'email',  'rol', 'password', 'confirm-password')) {
            if($this->model->comprobarUsuario($_POST['cedula'], $_POST['usuario'])) {
                $this->model->setNombre($_POST['nombre']);
                $this->model->setApellido($_POST['apellido']);
                $this->model->setCedula($_POST['cedula']);
                $this->model->setUsuario($_POST['usuario']);
                $this->model->setEmail($_POST['email']);
                $this->model->setPassword($_POST['password']);
                $this->model->setRol($_POST['rol']);
                if ($_POST['password'] == $_POST['confirm-password']) {
                    $resultado = $this->model->crear();
                    if ($resultado) {
                        header('Location:' . 'index.php?url=usuarios&accion=ver&id=' . $this->model->getCedula());
                    } else {
                        $this->errors = array('No se pudo crear el usuario');
                    }
                } else {
                    $this->errors = array('La contraseña y la confirmación no coinciden');
                }
            } else {
                $this->errors = array('Este usuario ya existe');
            }
        }
        include 'views/usuarios/crear.php';
    }

    public function editar()
    {
        $this->usuario = $this->consultar();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && validar_campos('nombre', 'apellido', 'cedula', 'usuario', 'email',  'rol')) {
            $this->model->setNombre($_POST['nombre']);
            $this->model->setApellido($_POST['apellido']);
            $this->model->setCedula($_POST['cedula']);
            $this->model->setUsuario($_POST['usuario']);
            $this->model->setEmail($_POST['email']);
            $this->model->setRol($_POST['rol']);
            $resultado = $this->model->editar($_GET['id']);
            if ($resultado) {
                header('Location:' . 'index.php?url=usuarios&accion=ver&id=' . $this->model->getCedula());
            } else {
                $this->errors = array('No se pudo editar el usuario');
            }
        }
        include 'views/usuarios/editar.php';
    }

    public function eliminar()
    {
        $this->usuario = $this->consultar();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && validar_campos('id')) {
            $resultado = $this->model->eliminar($_POST['id']);
            if ($resultado) {
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
            if($this->model->comprobarUsuario($_POST['cedula'], $_POST['usuario'])) {
                $this->model->setNombre($_POST['nombre']);
                $this->model->setApellido($_POST['apellido']);
                $this->model->setCedula($_POST['cedula']);
                $this->model->setUsuario($_POST['usuario']);
                $this->model->setEmail($_POST['email']);
                $this->model->setPassword($_POST['password']);
                $this->model->setRol('Usuario');
                if ($_POST['password'] == $_POST['confirm-password']) {
                    $registro = $this->model->crear();
                    if (isset($registro)) {
                        unset($_SESSION['usuario']);
                        $_SESSION['usuario'] = $_POST['usuario'];
                        $_SESSION['rol'] = 'Usuario';
                        $this->errors = null;
                        header('Location:' . 'index.php');
                    } else {
                        $this->errors = array('No se pudo realizar el registro');
                    }
                } else {
                    $this->errors = array('La contraseña y la confirmación no coinciden');
                }
            } else {
                $this->errors = array('Este usuario ya existe');
            }
        }
        include 'views/auth/register.php';
    }
}
