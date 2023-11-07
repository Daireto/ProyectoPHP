<?php
require_once 'config/db.php';

class Pago
{
    private $db;

    private $codigo;
    private $monto;
    private $medio;
    private $codigo_est;
    private $fecha_creacion;
    private $fecha_actualizacion;

