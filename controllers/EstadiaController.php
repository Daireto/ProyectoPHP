<?php
require_once 'models/Estadia.php';

class EstadiaController
{
    public $model;
    public $errors;
    public $estadia;
    public $estadias;
    public $cantidadEstadias;
    public $cantidadPorPagina;
    public $roles;

    public function __construct()
    {
        $this->model = new Estadia();
        $this->errors = null;
        $this->cantidadEstadias = 0;
        $this->cantidadPorPagina = 8;
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
        $this->cantidadEstadias = $this->model->contar();
        $this->estadias = $this->model->listar($page, $this->cantidadPorPagina);
        $_GET['pages'] = ceil($this->cantidadEstadias / $this->cantidadPorPagina);
        include 'views/estadias/lista.php';
    }

    public function consultar()
    {
        if (isset($_GET['id'])) {
            $estadia = $this->model->consultar($_GET['id']);
            if ($estadia != null) {
                return $estadia;
            }
        }
        mostrar_error('Estadía no encontrada');
    }

    public function ver()
    {
        $this->estadia = $this->consultar();
        include 'views/estadias/ver.php';
    }

    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && validar_campos('placa', 'cedula', 'fecha_ingreso', 'fecha_salida')) {
            $this->model->setPlaca($_POST['placa']);
            $this->model->setCedula($_POST['cedula']);
            $this->model->setFechaIngreso($_POST['fecha_ingreso']);
            $this->model->setFechaSalida($_POST['fecha_salida']);
            $resultado = $this->model->crear();
            if ($resultado) {
                header('Location:' . 'index.php?url=estadias');
            } else {
                $this->errors = array('No se pudo crear la estadía');
            }
        }
        include 'views/estadias/crear.php';
    }

    public function editar()
    {
        $this->estadia = $this->consultar();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && validar_campos('placa', 'cedula', 'fecha_ingreso', 'fecha_salida')) {
            $this->model->setPlaca($_POST['placa']);
            $this->model->setCedula($_POST['cedula']);
            $this->model->setFechaIngreso($_POST['fecha_ingreso']);
            $this->model->setFechaSalida($_POST['fecha_salida']);
            $resultado = $this->model->editar($_GET['id']);
            if ($resultado) {
                header('Location:' . 'index.php?url=estadias');
            } else {
                $this->errors = array('No se pudo editar la estadía');
            }
        }
        include 'views/estadias/editar.php';
    }

    public function eliminar()
    {
        $this->estadia = $this->consultar();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && validar_campos('id')) {
            $resultado = $this->model->eliminar($_POST['id']);
            if ($resultado) {
                header('Location:' . 'index.php?url=estadias');
            } else {
                $this->errors = array('No se pudo eliminar la estadía');
            }
        }
        include 'views/estadias/eliminar.php';
    }
}
