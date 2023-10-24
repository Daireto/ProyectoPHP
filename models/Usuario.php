<?php
require_once 'config/db.php';

class Usuario
{
    private $nombre;
    private $apellido;
    private $cedula;
    private $usuario;
    private $email;
    private $password;
    private $rol;

    public function listar()
    {
        return array(
            array('usuario' => 'john.doe', 'email' => 'john.doe@example.com', 'nombre' => 'John', 'apellido' => 'Doe', 'cedula' => '123456789', 'password' => 'john.doe', 'rol' => 'Usuario'),
            array('usuario' => 'jane.doe', 'email' => 'jane.doe@example.com', 'nombre' => 'Jane', 'apellido' => 'Doe', 'cedula' => '987654321', 'password' => 'jane.doe', 'rol' => 'Usuario'),
            array('usuario' => 'michael.smith', 'email' => 'michael.smith@example.com', 'nombre' => 'Michael', 'apellido' => 'Smith', 'cedula' => '555555555', 'password' => 'michael.smith', 'rol' => 'Usuario'),
            array('usuario' => 'susan.johnson', 'email' => 'susan.johnson@example.com', 'nombre' => 'Susan', 'apellido' => 'Johnson', 'cedula' => '666666666', 'password' => 'susan.johnson', 'rol' => 'Usuario'),
            array('usuario' => 'david.wilson', 'email' => 'david.wilson@example.com', 'nombre' => 'David', 'apellido' => 'Wilson', 'cedula' => '777777777', 'password' => 'david.wilson', 'rol' => 'Usuario'),
            array('usuario' => 'admin', 'email' => 'admin@example.com', 'nombre' => 'Admin', 'apellido' => 'Admin', 'cedula' => '100000000', 'password' => 'admin', 'rol' => 'Admin'),
        );
    }

    public function login($usuario, $password)
    {
        foreach ($this->listar() as $registro) {
            // if ($registro['usuario'] == $usuario && password_verify($registro['password'], $password)) {
            if ($registro['usuario'] == $usuario && $registro['password'] == $password) {
                return $registro;
            }
        }
        return null;
    }

    public function consultar($id)
    {
        foreach ($this->listar() as $registro) {
            if ($registro['cedula'] == $id) {
                return $registro;
            }
        }
        return null;
    }

    public function guardar()
    {
        return array(
            'usuario' => $this->getUsuario(),
            'email' => $this->getEmail(),
            'nombre' => $this->getNombre(),
            'apellido' => $this->getApellido(),
            'cedula' => $this->getCedula(),
            'password' => $this->getPassword()
        );
    }

    public function editar($id)
    {
        $this->getNombre();
        $this->getApellido();
        $this->getCedula();
        $this->getUsuario();
        $this->getEmail();
        $this->getPassword();
        $this->getRol();
        return null;
    }

    public function eliminar($id)
    {
        return true;
    }

    // Setters

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function setCedula($cedula)
    {
        $this->cedula = $cedula;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    // Getters

    public function getNombre()
    {
        return trim($this->nombre);
    }

    public function getApellido()
    {
        return trim($this->apellido);
    }

    public function getCedula()
    {
        return $this->cedula;
    }

    public function getUsuario()
    {
        return trim($this->usuario);
    }

    public function getEmail()
    {
        return trim($this->email);
    }

    public function getPassword()
    {
        return password_hash($this->password, PASSWORD_BCRYPT, ['COST' => 4]);
    }

    public function getRol()
    {
        return trim($this->rol);
    }
}
