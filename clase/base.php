<?php
class BaseDeDatos { 

    private $servername;
    private $username;
    private $password;
    private $database;
    private $port;
    private $socket;

    private $conn; // Mantenemos la conexión en esta propiedad

    public function __construct($servername, $port,$socket, $username, $password , $database) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->port = $port;
        $this->socket = $socket;
    }

    public function connect() {
        // Crear una conexión a la base de datos
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database, $this->port, $this->socket);

        // Verificar la conexión
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
            return false;
        }
        return true;
    }

    public function close() {
        // Cierra la conexión
        if ($this->conn) {
            $this->conn->close();
        }
    }

    public function executeQuery($sql) {
        if ($this->conn) {
            $result = $this->conn->query($sql);

            if ($result === false) {
                die("Error en la consulta: " . $this->conn->error);
            }
            return $result;
        } else {
            die("La conexión no está establecida. Debes llamar a connect() primero.");
        }
    }

    public function escapeString($string) {
        if ($this->conn) {
            return $this->conn->real_escape_string($string);
        }
        return $string; // Devuelve el string sin escapar si no hay conexión
    }
}
?>