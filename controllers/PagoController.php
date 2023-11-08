<?php
require_once 'models/Pago.php';

class PagoController
{
    public $model;
    public $errors;
    public $pago;
    public $pagos;
    public $cantidadPago;
    public $cantidadPorPagina;
    public $medios;
 
    public function __construct()
    {
        $this->model = new Pago();
        $this->errors = null;
        $this->cantidadPago = 0;
        $this->cantidadPorPagina = 8;
        $this->medios = array('Efectivo','Tarjeta','Transferencia');
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
        $this->cantidadPago = $this->model->contar();
        $this->pagos = $this->model->listar($page, $this->cantidadPorPagina);
        $_GET['pages'] = ceil($this->cantidadPago / $this->cantidadPorPagina);
        include 'views/pago/lista.php';
    }

    public function consultar()
    {
        if (isset($_GET['id'])) {
            $Pago = $this->model->consultar($_GET['id']);
            if ($Pago != null) {
                return $Pago;
            }
        }
        mostrar_error('Pago no encontrada');
    }

    public function ver()
    {
        $this->pago = $this->consultar();
        include 'views/pago/ver.php';
    }

    public function crear()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && validar_campos('monto', 'medio', 'codigo_est')) {
            $this->model->setMonto($_POST['monto']);
            $this->model->setMedio($_POST['medio']);
            $this->model->setCodigoEstadia($_POST['codigo_est']);
            
            $resultado = $this->model->crear();
            if ($resultado) {
                header('Location:' . 'index.php?url=pago');
            } else {
                $this->errors = array('No se pudo crear el pago');
            }
        }
        include 'views/pago/crear.php';
    }

    public function editar()
    {
        $this->pago = $this->consultar();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && validar_campos('monto', 'medio', 'codigo_est')) {
            $this->model->setMonto($_POST['monto']);
            $this->model->setMedio($_POST['medio']);
            $this->model->setCodigoEstadia($_POST['codigo_est']);
            $resultado = $this->model->editar($_GET['id']);
            if ($resultado) {
                header('Location:' . 'index.php?url=pago');
            } else {
                $this->errors = array('No se pudo editar el pago');
            }
        }
        include 'views/pago/editar.php';
    }

    public function eliminar()
    {
        $this->pago = $this->consultar();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && validar_campos('id')) {
            $resultado = $this->model->eliminar($_POST['id']);
            if ($resultado) {
                header('Location:' . 'index.php?url=pago');
            } else {
                $this->errors = array('No se pudo eliminar el pago');
            }
        }
        include 'views/pago/eliminar.php';
    }
}







