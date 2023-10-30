<?php
require_once 'config/db.php';

class Mensaje
{
    private $db;

    private $codigo;
    private $nombre;
    private $email;
    private $fecha_creacion;
    private $mensaje;
    private $asunto;
    private $FK_cedula;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function listarMensajes($page = 1, $cantidadPorPagina = 8)
    {
        $page = ($page - 1) * $cantidadPorPagina;
        $sql = "SELECT * FROM Mensajes
            ORDER BY fecha_creacion DESC LIMIT {$cantidadPorPagina} OFFSET {$page}";
        $resultado = $this->db->query($sql);
        if ($resultado->num_rows > 0) {
            $mensajes = $resultado->fetch_all(MYSQLI_ASSOC);
            $resultado->free_result();
            return $mensajes;
        }
        return array();
    }

    public function consultarMensaje($codigo)
    {
        $sql = "SELECT * FROM Mensajes
            WHERE codigo = {$this->db->real_escape_string($codigo)} LIMIT 1";
        $resultado = $this->db->query($sql);
        if ($resultado->num_rows > 0) {
            $mensaje = $resultado->fetch_assoc();
            $resultado->close();
            return $mensaje;
        }
        return null;
    }

    public function crearMensaje()
    {
        $sql = "INSERT INTO Mensajes (nombre, email, mensaje, asunto, FK_cedula)
            VALUES ('{$this->getNombre()}', '{$this->getEmail()}', '{$this->getMensaje()}', '{$this->getAsunto()}', {$this->getFKCedula()})";

        return $this->db->query($sql);
    }

    public function eliminarMensaje($codigo)
    {
        $sql = "DELETE FROM Mensajes
            WHERE codigo = {$this->db->real_escape_string($codigo)}";

        return $this->db->query($sql);
    }

    // Resto de los métodos, setters y getters...
    public function getNombre()
    {
        return trim($this->nombre);
    }

    public function getEmail()
    {
        return trim($this->email);
    }

    public function getMensaje()
    {
        return trim($this->mensaje);
    }

    public function getAsunto()
    {
        return trim($this->asunto);
    }

    public function getFKCedula()
    {
        return $this->FK_cedula;
    }

    public function getFechaCreacion()
    {
        return trim($this->fecha_creacion);
    }

    public function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function setEmail($email)
    {
        $this->email = $this->db->real_escape_string($email);
    }

    public function setMensaje($mensaje)
    {
        $this->mensaje = $this->db->real_escape_string($mensaje);
    }

    public function setAsunto($asunto)
    {
        $this->asunto = $this->db->real_escape_string($asunto);
    }

    public function setFKCedula($cedula)
    {
        $this->FK_cedula = $this->db->real_escape_string($cedula);
    }

}
?>
