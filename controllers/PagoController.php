<?php
require_once 'models/Pago.php';

class PagoController
{
    private $codigo;
    private $monto;
    private $medio;
    private $codigo_est;
    private $fecha_creacion;
    private $fecha_actualizacion;

    public function __construct()
    {
        $this->model = new Pago();
        $this->errors = null;
        $this->cantidadPago = 0;
        $this->cantidadPago = 8;
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
        $this->Pago = $this->model->listar($page, $this->cantidadPago);
        $_GET['pages'] = ceil($this->cantidadEstadias / $this->cantidadPago);
        include 'views/Pago/lista.php';
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
        $this->Pago = $this->consultar();
        include 'views/Pago/ver.php';
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
                header('Location:' . 'index.php?url=Pago');
            } else {
                $this->errors = array('No se pudo crear el pago);
            }
        }
        include 'views/Pago/crear.php';
    }

    public function editar()
    {
        $this->Pago = $this->consultar();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && validar_campos('placa', 'cedula', 'fecha_ingreso', 'fecha_salida')) {
            $this->model->setPlaca($_POST['placa']);
            $this->model->setCedula($_POST['cedula']);
            $this->model->setFechaIngreso($_POST['fecha_ingreso']);
            $this->model->setFechaSalida($_POST['fecha_salida']);
            $resultado = $this->model->editar($_GET['id']);
            if ($resultado) {
                header('Location:' . 'index.php?url=estadias');
            } else {
                $this->errors = array('No se pudo editar el pago');
            }
        }
        include 'views/Pago/editar.php';
    }

    public function eliminar()
    {
        $this->Pago = $this->consultar();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && validar_campos('id')) {
            $resultado = $this->model->eliminar($_POST['id']);
            if ($resultado) {
                header('Location:' . 'index.php?url=estadias');
            } else {
                $this->errors = array('No se pudo eliminar el pago');
            }
        }
        include 'views/Pago/eliminar.php';
    }
}







