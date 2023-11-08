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

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function listar($page = 1, $cantidadPorPagina = 8, $cedula = null)
    {
        $page = ($page - 1) * $cantidadPorPagina;
        if ($cedula != null) {
            $sql = "SELECT p.codigo, p.monto, p.medio, p.codigo_est, e.cedula FROM pagos as p
                INNER JOIN estadias as e ON e.codigo = p.codigo_est
                WHERE e.cedula = {$this->db->real_escape_string($cedula)}
                ORDER BY p.fecha_creacion DESC LIMIT {$cantidadPorPagina} OFFSET {$page}";
        } else {
            $sql = "SELECT p.codigo, p.monto, p.medio, p.codigo_est, e.cedula FROM pagos as p
                INNER JOIN estadias as e ON e.codigo = p.codigo_est
                ORDER BY p.fecha_creacion DESC LIMIT {$cantidadPorPagina} OFFSET {$page}";
        }
        $resultado = $this->db->query($sql);
        if ($resultado->num_rows > 0) {
            $pagos = $resultado->fetch_all(MYSQLI_ASSOC);
            $resultado->free_result();
            return $pagos;
        }
        return array();
    }

    public function consultar($id, $cedula = null)
    {
        if ($cedula != null) {
            $sql = "SELECT p.codigo as codigo_pago, p.monto, p.medio, p.codigo_est, p.fecha_creacion as creacion_pago, p.fecha_actualizacion as act_pago, e.placa, e.cedula, e.fecha_ingreso, e.fecha_salida, e.fecha_creacion as creacion_estadia, e.fecha_actualizacion as act_estadia FROM pagos as p
                INNER JOIN estadias as e ON e.codigo = p.codigo_est
                WHERE p.codigo = {$this->db->real_escape_string($id)} AND e.cedula = {$this->db->real_escape_string($cedula)} LIMIT 1";
        } else {
            $sql = "SELECT p.codigo, p.monto, p.medio, p.codigo_est, p.fecha_creacion, p.fecha_actualizacion, e.cedula FROM pagos as p
                INNER JOIN estadias as e ON e.codigo = p.codigo_est
                WHERE p.codigo = {$this->db->real_escape_string($id)} LIMIT 1";
        }
        $resultado = $this->db->query($sql);
        if ($resultado->num_rows > 0) {
            $pago = $resultado->fetch_assoc();
            $resultado->close();
            return $pago;
        }
        return null;
    }

    public function crear()
    {
        $sql = "INSERT INTO pagos (codigo, monto, medio, codigo_est)
            VALUES (null, {$this->getMonto()}, '{$this->getMedio()}', {$this->getCodigoEstadia()})";

        return $this->db->query($sql);
    }

    public function editar($id)
    {

        $sql = "UPDATE pagos
            SET monto = {$this->getMonto()}, medio = '{$this->getMedio()}', codigo_est = {$this->getCodigoEstadia()}
            WHERE codigo = {$this->db->real_escape_string($id)}";

        return $this->db->query($sql);
    }

    public function eliminar($id)
    {
        $sql = "DELETE FROM pagos
            WHERE codigo = {$this->db->real_escape_string($id)}";

        return $this->db->query($sql);
    }

    public function contar($cedula = null)
    {
        if ($cedula != null) {
            $sql = "SELECT COUNT(p.codigo) as total FROM pagos as p
                INNER JOIN estadias as e ON e.codigo = p.codigo_est
                WHERE e.cedula = {$this->db->real_escape_string($cedula)}";
        } else {
            $sql = "SELECT COUNT(p.codigo) as total FROM pagos as p";
        }
        $resultado = $this->db->query($sql);
        $total = $resultado->fetch_assoc()['total'];
        $resultado->free();
        return $total;
    }

    // Setters

    public function setMonto($monto)
    {
        $this->monto = $this->db->real_escape_string($monto);
    }

    public function setMedio($medio)
    {
        $this->medio = $this->db->real_escape_string(trim($medio));
    }

    public function setCodigoEstadia($codigo_est)
    {
        $this->codigo_est = $this->db->real_escape_string($codigo_est);
    }

    // Getters

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function getMonto()
    {
        return $this->monto;
    }

    public function getMedio()
    {
        return trim($this->medio);
    }

    public function getCodigoEstadia()
    {
        return trim($this->codigo_est);
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
