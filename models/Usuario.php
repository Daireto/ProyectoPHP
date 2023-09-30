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

    public function listar()
    {
        return array(
            array('usuario' => 'john.doe', 'email' => 'john.doe@example.com', 'nombre' => 'John', 'apellido' => 'Doe', 'cedula' => '123456789', 'password' => 'john.doe'),
            array('usuario' => 'jane.doe', 'email' => 'jane.doe@example.com', 'nombre' => 'Jane', 'apellido' => 'Doe', 'cedula' => '987654321', 'password' => 'jane.doe'),
            array('usuario' => 'michael.smith', 'email' => 'michael.smith@example.com', 'nombre' => 'Michael', 'apellido' => 'Smith', 'cedula' => '555555555', 'password' => 'michael.smith'),
            array('usuario' => 'susan.johnson', 'email' => 'susan.johnson@example.com', 'nombre' => 'Susan', 'apellido' => 'Johnson', 'cedula' => '666666666', 'password' => 'susan.johnson'),
            array('usuario' => 'david.wilson', 'email' => 'david.wilson@example.com', 'nombre' => 'David', 'apellido' => 'Wilson', 'cedula' => '777777777', 'password' => 'david.wilson'),
            array('usuario' => 'admin', 'email' => 'admin@example.com', 'nombre' => 'Admin', 'apellido' => 'Admin', 'cedula' => '100000000', 'password' => 'admin'),
        );
    }

    public function login($usuario, $password)
    {
        foreach ($this->listar() as $registro) {
            if ($registro['usuario'] == $usuario && password_verify($registro['password'], $password)) {
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
}
