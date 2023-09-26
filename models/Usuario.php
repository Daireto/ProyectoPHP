<?php

class Usuario
{
    public function login($usuario, $password)
    {
        if ($usuario == 'admin' && $password == 'admin') {
            return 'admin';
        } else {
            return null;
        }
    }
}
