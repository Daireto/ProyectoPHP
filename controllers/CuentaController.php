<?php
require_once 'models/Usuario.php';
require_once 'models/Estadia.php';
require_once 'models/Pago.php';

class CuentaController
{
    public $usuariosModel;
    public $estadiasModel;
    public $pagosModel;
    public $errors;
    public $usuario;
    public $estadia;
    public $pago;
    public $estadias;
    public $pagos;
    public $cantidadEstadias;
    public $cantidadPagos;
    public $cantidadPorPagina;

    public function __construct()
    {
        $this->usuariosModel = new Usuario();
        $this->estadiasModel = new Estadia();
        $this->pagosModel = new Pago();
        $this->errors = null;
        $this->cantidadEstadias = 0;
        $this->cantidadPagos = 0;
        $this->cantidadPorPagina = 8;
    }

    public function ejecutar()
    {
        validar_sesion();
        $accion = isset($_GET['accion']) ? $_GET['accion'] : 'perfil';
        switch ($accion) {
            case 'perfil':
                $this->perfil();
                break;

            case 'cambiar-contraseña':
                $this->cambiarContraseña();
                break;

            case 'estadias':
                $this->listarEstadias();
                break;

            case 'pagos':
                $this->listarPagos();
                break;

            case 'ver-estadia':
                $this->verEstadia();
                break;

            case 'ver-pago':
                $this->verPago();
                break;

            default:
                $_GET['mensaje'] = 'Acción desconocida';
                include 'views/error.php';
                break;
        }
    }

    public function consultar()
    {
        $usuario = $this->usuariosModel->consultar($_SESSION['cedula']);
        if ($usuario != null) {
            return $usuario;
        }
        header('Location:' . 'index.php?url=logout');
    }

    public function perfil()
    {
        $this->usuario = $this->consultar();
        include 'views/cuenta/perfil.php';
    }

    public function cambiarContraseña()
    {
        $this->usuario = $this->consultar();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && validar_campos('password-actual', 'password-nueva',  'confirm-password')) {
            if ($this->usuariosModel->comprobarPassword($_SESSION['cedula'], $_POST['password-actual'])) {
                if ($_POST['password-nueva'] == $_POST['confirm-password']) {
                    $this->usuariosModel->setPassword($_POST['password-nueva']);
                    $resultado = $this->usuariosModel->cambiarPassword($_SESSION['cedula']);
                    if ($resultado) {
                        header('Location:' . 'index.php?url=cuenta');
                    } else {
                        $this->errors = array('No se pudo cambiar la contraseña');
                    }
                } else {
                    $this->errors = array('La contraseña y la confirmación no coinciden');
                }
            } else {
                $this->errors = array('La contraseña actual es incorrecta');
            }
        }
        include 'views/cuenta/cambiar-contraseña.php';
    }

    public function listarEstadias()
    {
        $this->consultar();
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $this->cantidadEstadias = $this->estadiasModel->contar($_SESSION['cedula']);
        $this->estadias = $this->estadiasModel->listar($page, $this->cantidadPorPagina, $_SESSION['cedula']);
        $_GET['pages'] = ceil($this->cantidadEstadias / $this->cantidadPorPagina);
        include 'views/cuenta/estadias.php';
    }

    public function listarPagos()
    {
        $this->consultar();
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $this->cantidadPagos = $this->pagosModel->contar($_SESSION['cedula']);
        $this->pagos = $this->pagosModel->listar($page, $this->cantidadPorPagina, $_SESSION['cedula']);
        $_GET['pages'] = ceil($this->cantidadPagos / $this->cantidadPorPagina);
        include 'views/cuenta/pagos.php';
    }

    public function verEstadia()
    {
        $this->consultar();
        if (isset($_GET['id'])) {
            $this->estadia = $this->estadiasModel->consultar($_GET['id'], $_SESSION['cedula']);
            if ($this->estadia != null) {
                $this->pago = null; // FIXME: Fill with correct data
                $this->estadia['registrado'] = ($this->usuariosModel->consultar($this->estadia['cedula']) != null);
                include 'views/cuenta/ver-estadia-pago.php';
            }
        }
        mostrar_error('Estadía no encontrada');
    }

    public function verPago()
    {
        $this->consultar();
        if (isset($_GET['id'])) {
            $this->pago = $this->pagosModel->consultar($_GET['id'], $_SESSION['cedula']);
            if ($this->pago != null) {
                $this->estadia = array(); // FIXME: Fill with correct data
                include 'views/cuenta/ver-estadia-pago.php';
            }
        }
        mostrar_error('Pago no encontrado');
    }
}
