<?php
require_once 'config/db.php';

class Usuario
{
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
            if ($registro['usuario'] == $usuario && $registro['password'] == $password) {
                return $registro;
            }
        }
        return null;
    }
}
