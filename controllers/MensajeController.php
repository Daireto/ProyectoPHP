<?php
require_once 'models/Mensaje.php';

class MensajeController
{
    public $model;
    public $errors;
    public $mensaje;
    public $mensajes;
    public $cantidadMensajes;
    public $cantidadPorPagina;

    public function __construct()
    {
        $this->model = new Mensaje();
        $this->errors = null;
        $this->cantidadMensajes = 0;
        $this->cantidadPorPagina = 8;
    }

    public function ejecutar()
    {
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

            case 'marcarLeido':
                $this->marcarLeido();
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
        $this->cantidadMensajes = $this->model->contar();
        $this->mensajes = $this->model->listar($page, $this->cantidadPorPagina);
        $_GET['pages'] = ceil($this->cantidadMensajes / $this->cantidadPorPagina);
        include 'views/mensajes/lista_mensajes.php';
    }

    public function consultar()
    {
        if (isset($_GET['id'])) {
            $mensaje = $this->model->consultar($_GET['id']);
            if ($mensaje != null) {
                return $mensaje;
            }
        }
        mostrar_error('Mensaje no encontrado');
    }

    public function ver()
    {
        $this->mensaje = $this->consultar();
        include 'views/mensajes/ver_mensaje.php';
    }

    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && validar_campos('nombre', 'email', 'asunto')) {
            $this->model->setNombre($_POST['nombre']);
            $this->model->setEmail($_POST['email']);
            $this->model->setAsunto($_POST['asunto']);
            $resultado = $this->model->crear();
            if ($resultado) {
                header('Location:' . 'index.php?url=mensajes');
            } else {
                $this->errors = array('No se pudo crear el mensaje');
            }
        }
        include 'views/mensajes/crear_mensaje.php';
    }

    public function editar()
    {
        $this->mensaje = $this->consultar();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && validar_campos('nombre', 'email', 'asunto')) {
            $this->model->setNombre($_POST['nombre']);
            $this->model->setEmail($_POST['email']);
            $this->model->setAsunto($_POST['asunto']);
            $resultado = $this->model->editar($_GET['id']);
            if ($resultado) {
                header('Location:' . 'index.php?url=mensajes');
            } else {
                $this->errors = array('No se pudo editar el mensaje');
            }
        }
        include 'views/mensajes/editar_mensaje.php';
    }

    public function eliminar()
    {
        $this->mensaje = $this->consultar();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && validar_campos('id')) {
            $resultado = $this->model->eliminar($_POST['id']);
            if ($resultado) {
                header('Location:' . 'index.php?url=mensajes');
            } else {
                $this->errors = array('No se pudo eliminar el mensaje');
            }
        }
        include 'views/mensajes/eliminar_mensaje.php';
    }

    public function marcarLeido()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && validar_campos('id')) {
            $resultado = $this->model->marcarComoLeido($_POST['id'], $_SESSION['cedula']);
            if ($resultado) {
                header('Location:' . 'index.php?url=mensajes');
            } else {
                $this->errors = array('No se pudo marcar el mensaje como leído');
            }
        }
    }
}
