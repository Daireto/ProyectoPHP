<?php
require_once 'config/db.php';

class Estadia
{
    private $db;

    private $codigo;
    private $placa;
    private $cedula;
    private $fecha_ingreso;
    private $fecha_salida;
    private $fecha_creacion;
    private $fecha_actualizacion;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function listar($page = 1, $cantidadPorPagina = 8, $cedula = null)
    {
        $page = ($page - 1) * $cantidadPorPagina;
        if ($cedula != null) {
            $sql = "SELECT * FROM estadias
                WHERE cedula = {$this->db->real_escape_string($cedula)}
                ORDER BY fecha_creacion DESC LIMIT {$cantidadPorPagina} OFFSET {$page}";
        } else {
            $sql = "SELECT * FROM estadias
                ORDER BY fecha_creacion DESC LIMIT {$cantidadPorPagina} OFFSET {$page}";
        }
        $resultado = $this->db->query($sql);
        if ($resultado->num_rows > 0) {
            $estadias = $resultado->fetch_all(MYSQLI_ASSOC);
            $resultado->free_result();
            return $estadias;
        }
        return array();
    }

    public function consultar($id, $cedula = null)
    {
        if ($cedula != null) {
            $sql = "SELECT e.codigo as codigo_estadia, e.placa, e.cedula, e.fecha_ingreso, e.fecha_salida, e.fecha_creacion as creacion_estadia, e.fecha_actualizacion as act_estadia, p.codigo as codigo_pago, p.monto, p.medio, p.fecha_creacion as creacion_pago, p.fecha_actualizacion as act_pago FROM estadias as e
                LEFT JOIN pagos as p ON e.codigo = p.codigo_est
                WHERE e.codigo = {$this->db->real_escape_string($id)} AND e.cedula = {$this->db->real_escape_string($cedula)} LIMIT 1";
        } else {
            $sql = "SELECT e.codigo, e.placa, e.cedula, e.fecha_ingreso, e.fecha_salida, e.fecha_creacion, e.fecha_actualizacion, p.codigo_est FROM estadias as e
                LEFT JOIN pagos as p ON e.codigo = p.codigo_est
                WHERE e.codigo = {$this->db->real_escape_string($id)} LIMIT 1";
        }
        $resultado = $this->db->query($sql);
        if ($resultado->num_rows > 0) {
            $estadia = $resultado->fetch_assoc();
            $resultado->close();
            return $estadia;
        }
        return null;
    }

    public function crear()
    {
        $sql = "INSERT INTO estadias (codigo, placa, cedula, fecha_ingreso, fecha_salida)
            VALUES (null, '{$this->getPlaca()}', {$this->getCedula()}, '{$this->getFechaIngreso()}', '{$this->getFechaSalida()}')";

        return $this->db->query($sql);
    }

    public function editar($id)
    {

        $sql = "UPDATE estadias
            SET placa = '{$this->getPlaca()}', cedula = {$this->getCedula()}, fecha_ingreso = '{$this->getFechaIngreso()}', fecha_salida = '{$this->getFechaSalida()}'
            WHERE codigo = {$this->db->real_escape_string($id)}";

        return $this->db->query($sql);
    }

    public function eliminar($id)
    {
        $sql = "DELETE FROM estadias
            WHERE codigo = {$this->db->real_escape_string($id)}";

        return $this->db->query($sql);
    }

    public function contar($cedula = null)
    {
        if ($cedula != null) {
            $sql = "SELECT COUNT(codigo) as total FROM estadias WHERE cedula = {$this->db->real_escape_string($cedula)}";
        } else {
            $sql = "SELECT COUNT(codigo) as total FROM estadias";
        }
        $resultado = $this->db->query($sql);
        $total = $resultado->fetch_assoc()['total'];
        $resultado->free();
        return $total;
    }

    // Setters

    public function setPlaca($placa)
    {
        $this->placa = $this->db->real_escape_string(trim(strtoupper($placa)));
    }

    public function setCedula($cedula)
    {
        $this->cedula = $this->db->real_escape_string($cedula);
    }

    public function setFechaIngreso($fecha_ingreso)
    {
        $fecha_ingreso = date("Y-m-d H:i:s",strtotime($fecha_ingreso));
        $this->fecha_ingreso = $this->db->real_escape_string($fecha_ingreso);
    }

    public function setFechaSalida($fecha_salida)
    {
        $fecha_salida = date("Y-m-d H:i:s",strtotime($fecha_salida));
        $this->fecha_salida = $this->db->real_escape_string($fecha_salida);
    }

    // Getters

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function getPlaca()
    {
        return trim($this->placa);
    }

    public function getCedula()
    {
        return $this->cedula;
    }

    public function getFechaIngreso()
    {
        return trim($this->fecha_ingreso);
    }

    public function getFechaSalida()
    {
        return trim($this->fecha_salida);
    }

    public function getFechaDeCreacion()
    {
        return trim($this->fecha_creacion);
    }

    public function getFechaDeActualizacion()
    {
        return trim($this->fecha_actualizacion);
    }
}
