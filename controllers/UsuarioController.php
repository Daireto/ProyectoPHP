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

    public function listar()
    {
        return $this->model->listar();
    }

    public function login()
    {
        $this->errors = null;

        if (isset($_POST['usuario']) && isset($_POST['password'])) {
            $usuario = $this->model->login($_POST['usuario'], $_POST['password']);
            if (isset($usuario)) {
                $_SESSION['usuario'] = $usuario;
            } else {
                $this->errors = array('Usuario o contraseña incorrectos');
            }
        }
    }
}
