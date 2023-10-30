<?php
require_once 'config/db.php';

class Usuario
{
    private $db;

    private $nombre;
    private $apellido;
    private $cedula;
    private $usuario;
    private $email;
    private $password;
    private $rol;
    private $fecha_creacion;
    private $fecha_actualizacion;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function listar($page = 1, $cantidadPorPagina = 8)
    {
        $page = ($page - 1) * $cantidadPorPagina;
        $sql = "SELECT * FROM usuarios
            ORDER BY rol ASC, fecha_creacion DESC LIMIT {$cantidadPorPagina} OFFSET {$page}";
        $resultado = $this->db->query($sql);
        if ($resultado->num_rows > 0) {
            $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);
            $resultado->free_result();
            return $usuarios;
        }
        return array();
    }

    public function consultar($id)
    {
        $sql = "SELECT * FROM usuarios
            WHERE cedula = {$this->db->real_escape_string($id)} LIMIT 1";
        $resultado = $this->db->query($sql);
        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            $resultado->close();
            return $usuario;
        }
        return null;
    }

    public function crear()
    {
        $sql = "INSERT INTO usuarios (cedula, usuario, nombre, apellido, email, password, rol)
            VALUES ({$this->getCedula()}, '{$this->getUsuario()}', '{$this->getNombre()}', '{$this->getApellido()}', '{$this->getEmail()}', '{$this->getPassword()}', '{$this->getRol()}')";

        return $this->db->query($sql);
    }

    public function editar($id)
    {

        $sql = "UPDATE usuarios
            SET cedula = {$this->getCedula()}, usuario = '{$this->getUsuario()}', nombre = '{$this->getNombre()}', apellido = '{$this->getApellido()}', email = '{$this->getEmail()}', rol = '{$this->getRol()}'
            WHERE cedula = {$this->db->real_escape_string($id)}";

        return $this->db->query($sql);
    }

    public function eliminar($id)
    {
        $sql = "DELETE FROM usuarios
            WHERE cedula = {$this->db->real_escape_string($id)}";

        return $this->db->query($sql);
    }

    public function contar()
    {
        $sql = "SELECT COUNT(cedula) as total FROM usuarios";
        $resultado = $this->db->query($sql);
        $total = $resultado->fetch_assoc()['total'];
        $resultado->free();
        return $total;
    }

    public function login($usuario, $password)
    {
        $sql = "SELECT * FROM usuarios WHERE usuario = '{$this->db->real_escape_string($usuario)}'";
        $resultado = $this->db->query($sql);
        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            $resultado->close();
            if (password_verify($password, $usuario['password'])) {
                return $usuario;
            }
        }
        return null;
    }

    public function comprobarUsuario($cedula, $usuario)
    {
        $sql = "SELECT * FROM usuarios WHERE cedula = {$this->db->real_escape_string($cedula)} OR usuario = '{$this->db->real_escape_string($usuario)}'";
        $resultado = $this->db->query($sql);
        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            $resultado->close();
            return false;
        }
        return true;
    }

    public function comprobarPassword($cedula, $password)
    {
        $sql = "SELECT * FROM usuarios WHERE cedula = {$this->db->real_escape_string($cedula)}";
        $resultado = $this->db->query($sql);
        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            $resultado->close();
            return password_verify($password, $usuario['password']);
        }
        return false;
    }

    public function cambiarPassword($cedula)
    {
        $sql = "UPDATE usuarios
            SET password = '{$this->getPassword()}'
            WHERE cedula = {$this->db->real_escape_string($cedula)}";

        return $this->db->query($sql);
    }

    // Setters

    public function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function setApellido($apellido)
    {
        $this->apellido = $this->db->real_escape_string($apellido);
    }

    public function setCedula($cedula)
    {
        $this->cedula = $this->db->real_escape_string($cedula);
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $this->db->real_escape_string(trim(strtolower($usuario)));
    }

    public function setEmail($email)
    {
        $this->email = $this->db->real_escape_string($email);
    }

    public function setPassword($password)
    {
        $this->password = $this->db->real_escape_string($password);
    }

    public function setRol($rol)
    {
        $this->rol = $this->db->real_escape_string($rol);
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

    public function getFechaDeCreacion()
    {
        return trim($this->fecha_creacion);
    }

    public function getFechaDeActualizacion()
    {
        return trim($this->fecha_actualizacion);
    }
}
