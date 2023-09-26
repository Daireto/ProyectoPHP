<?php

class Usuario
{
    public function listar()
    {
        return array(
            array('usuario' => 'john.doe', 'email' => 'john.doe@example.com', 'nombre' => 'John', 'apellido' => 'Doe', 'cedula' => '123456789'),
            array('usuario' => 'jane.doe', 'email' => 'jane.doe@example.com', 'nombre' => 'Jane', 'apellido' => 'Doe', 'cedula' => '987654321'),
            array('usuario' => 'michael.smith', 'email' => 'michael.smith@example.com', 'nombre' => 'Michael', 'apellido' => 'Smith', 'cedula' => '555555555'),
            array('usuario' => 'susan.johnson', 'email' => 'susan.johnson@example.com', 'nombre' => 'Susan', 'apellido' => 'Johnson', 'cedula' => '666666666'),
            array('usuario' => 'david.wilson', 'email' => 'david.wilson@example.com', 'nombre' => 'David', 'apellido' => 'Wilson', 'cedula' => '777777777'),
        );
    }

    public function login($usuario, $password)
    {
        if ($usuario == 'admin' && $password == 'admin') {
            return 'admin';
        } else {
            return null;
        }
    }
}
