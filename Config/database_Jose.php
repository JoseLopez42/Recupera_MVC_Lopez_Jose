<?php
class Database
{
    private $host = 'localhost';
    private $dbname = 'database_jose';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';

    public function conectar()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";

            $opciones = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            return new PDO($dsn, $this->user, $this->pass, $opciones);

        } catch (PDOException $e) {
            die('Error en la conexión a MySQL: ' . $e->getMessage());
        }
    }
}
